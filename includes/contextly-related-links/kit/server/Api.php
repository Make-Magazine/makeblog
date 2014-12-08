<?php

/**
 * Provides low-level API access.
 */
class ContextlyKitApi extends ContextlyKitBase {

  const API_VERSION = '1.3.6';

  const HEADER_TOKEN = 'Contextly-Access-Token';
  const HEADER_APP_ID = 'Contextly-App-ID';

  /**
   * API calls queue.
   *
   * @var ContextlyKitApiRequest[]
   */
  protected $requests = array();

  /**
   * Current API request.
   *
   * Parameters and POST data will be added to this request until a new one is
   * generated with the api() method.
   *
   * @var ContextlyKitApiRequest|null
   */
  protected $currentRequest = NULL;

  /**
   * @var ContextlyKitApiSessionInterface
   */
  protected $session;

  /**
   * @var ContextlyKitApiTransportInterface
   */
  protected $transport;

  /**
   * @param ContextlyKit $kit
   * @param ContextlyKitApiSessionInterface $session
   * @param ContextlyKitApiTransportInterface $transport
   */
  public function __construct($kit, $session = NULL, $transport = NULL) {
    parent::__construct($kit);

    if (!isset($session)) {
      $session = $this->kit->newApiSession();
    }
    $this->session = $session;

    if (!isset($transport)) {
      $transport = $this->kit->newApiTransport();
    }
    $this->transport = $transport;
  }

  protected function cleanupRequests() {
    $this->requests = array();
    $this->currentRequest = NULL;
  }

  /**
   * Returns current active call.
   *
   * @return ContextlyKitApiRequest
   *
   * @throws ContextlyKitException
   */
  protected function getCurrentRequest() {
    if (!isset($this->currentRequest)) {
      throw $this->kit->newException('The request was not yet initialized.');
    }

    return $this->currentRequest;
  }

  public function method($apiName, $methodName) {
    $this->currentRequest = $this->kit->newApiRequest();
    $this->requests[] = $this->currentRequest;

    $this->currentRequest->setMethod($apiName, $methodName);

    return $this;
  }

  /**
   * @param $name
   * @param $value
   *
   * @return ContextlyKitApi
   */
  public function param($name, $value) {
    $this->getCurrentRequest()->addParams(array($name => $value));

    return $this;
  }

  /**
   * Adds single POST parameter to the current call.
   *
   * @param $name
   * @param $value
   *
   * @return ContextlyKitApi
   */
  public function extraParam($name, $value) {
    $this->getCurrentRequest()->addData(array($name => $value));

    return $this;
  }

  /**
   * Adds parameters to the current call.
   *
   * @param array $params
   *
   * @return ContextlyKitApi
   */
  public function params(array $params) {
    $this->getCurrentRequest()->addParams($params);

    return $this;
  }

  /**
   * Adds POST data to the current call.
   *
   * @param array $extraParams
   *
   * @return ContextlyKitApi
   */
  public function extraParams(array $extraParams) {
    $this->getCurrentRequest()->addData($extraParams);

    return $this;
  }

  /**
   * Adds search query to the call.
   *
   * @param $column
   * @param $type
   * @param $value
   *
   * @return ContextlyKitApi
   *
   * @throws ContextlyKitException
   */
  public function searchParam($column, $type, $value) {
    $this->getCurrentRequest()->addSearchQuery($column, $type, $value);

    return $this;
  }

  /**
   * Executes all pending requests and returns result of the latest one.
   *
   * @return object|bool
   *   Decoded JSON object or FALSE if there are no pending request.
   */
  public function get() {
    $results = $this->getMultiple();
    return end($results);
  }

  /**
   * Executes all pending requests and returns all the results.
   *
   * @return array
   */
  public function getMultiple() {
    // Exit immediately if there are no pending requests.
    if (empty($this->requests)) {
      return array();
    }

    $this->authorize();

    // Default headers.
    $headers = array(
      self::HEADER_TOKEN => (string) $this->session->getToken(),
      self::HEADER_APP_ID => $this->settings->appID,
    );

    // TODO Use system/multicall when API server will support it.
    $results = array();
    foreach ($this->requests as $index => $request) {
      $request->addHeaders($headers);
      $results[$index] = $this->call($request);
    }

    $this->cleanupRequests();
    return $results;
  }

  /**
   * Makes a call to the API.
   *
   * @param ContextlyKitApiRequest $request
   *
   * @return object
   *
   * @throws ContextlyKitApiException
   */
  protected function call($request) {
    // Construct URL. Append slash-separated parameters to it.
    $url = rtrim($this->kit->getServerUrl('api'), "/");
    $url .= "/" . $request->apiName . "/" . $request->methodName . "/";
    foreach ($request->params as $name => $value) {
      $url .= $name . '/' . $value . '/';
    }

    // POST data. Add client version.
    $data = $request->data;
    $data['version'] = self::API_VERSION;

    // HTTP headers. Add default referrer.
    $headers = $request->headers;
    if (isset($_SERVER['SERVER_NAME'])) {
      $headers += array('Referer' => $_SERVER['SERVER_NAME']);
    }

    $response = $this->transport->request('POST', $url, array(), $data, $headers);
    // TODO: HTTP error handling!

    // Parse API response and check it.
    $result = json_decode($response->body);
    if ($result === NULL) {
      throw $this->kit->newApiException("Unable to decode JSON response from server.", $request, $response);
    }

    // Check required properties on the result.
    $this->checkRequiredProperties($request, $response, $result);

    // Return result property if asked.
    if (isset($request->returnProperty)) {
      return $result->{$request->returnProperty};
    }
    else {
      return $result;
    }
  }

  /**
   * @param ContextlyKitApiRequest $request
   * @param $result
   *
   * @throws ContextlyKitApiException
   */
  protected function checkRequiredProperties($request, $response, $result) {
    foreach (array_keys($request->requiredProperties) as $name) {
      if (!isset($result->{$name})) {
        $message = 'Required property "' . $name . '" not found on the API call result.';
        throw $this->kit->newApiException($message, $request, $response, $result);
      }
    }
  }

  /**
   * Makes sure that we have a valid access token.
   *
   * @throws ContextlyKitException
   *
   * @todo Avoid logging of the app secret and the access token.
   */
  protected function authorize() {
    if ($this->session->getToken()->isValid()) {
      return;
    }

    $request = $this->kit->newApiRequest();
    $request->setMethod('auth', 'auth');
    $request->addData(array(
      'appID' => $this->settings->appID,
      'appSecret' => $this->settings->appSecret,
    ));
    $request->addRequiredProperty('success');

    $result = $this->call($request);
    if (empty($result->success)) {
      throw $this->kit->newException('Unable to get access token with passed app ID and secret.');
    }

    $token = $this->kit->newApiToken($result->access_token);
    if (!$token->isValid()) {
      throw $this->kit->newException('Received invalid access token.');
    }

    $this->session->setToken($token);
  }

  public function requireSuccess() {
    $this->getCurrentRequest()
      ->addRequiredProperty('success');

    return $this;
  }

  public function requireProperty($name) {
    $this->getCurrentRequest()
      ->addRequiredProperty($name);

    return $this;
  }

  public function returnProperty($name) {
    $this->getCurrentRequest()
      ->setReturnProperty($name);

    return $this;
  }

  public function testCredentials() {
    $this->session->cleanupToken();
    $this->authorize();
  }

  public function getAccessToken() {
    $this->authorize();
    return $this->session->getToken();
  }

}

/**
 * Represents single API call.
 */
class ContextlyKitApiRequest {

  const SEARCH_TYPE_NOT_EQUAL = '!=';
  const SEARCH_TYPE_EQUAL = '=';
  const SEARCH_TYPE_GREATER = '>';
  const SEARCH_TYPE_LESS = '<';
  const SEARCH_TYPE_GREATER_EQUAL = '>=';
  const SEARCH_TYPE_LESS_EQUAL = '<=';
  const SEARCH_TYPE_LIKE = '~';
  const SEARCH_TYPE_LIKE_LEFT = '%~';
  const SEARCH_TYPE_LIKE_RIGHT = '~%';
  const SEARCH_TYPE_LIKE_BOTH = '%~%';
  const SEARCH_TYPE_REGEXP = 'regexp';

  /**
   * @var string
   */
  public $apiName;

  /**
   * @var string
   */
  public $methodName;

  /**
   * @var array
   */
  public $params = array();

  /**
   * @var array
   */
  public $data = array();

  /**
   * @var array
   */
  public $headers = array();

  /**
   * @var array
   */
  public $requiredProperties = array();

  public $returnProperty = NULL;

  public function setMethod($api, $method) {
    $this->apiName = $api;
    $this->methodName = $method;
  }

  public function addParams(array $params) {
    $this->params = array_merge($this->params, $params);
  }

  public function addData(array $data) {
    $this->data = array_merge($this->data, $data);
  }

  protected function isValidSearchType($type) {
    static $allowedTypes = array(
      self::SEARCH_TYPE_NOT_EQUAL,
      self::SEARCH_TYPE_EQUAL,
      self::SEARCH_TYPE_GREATER,
      self::SEARCH_TYPE_LESS,
      self::SEARCH_TYPE_GREATER_EQUAL,
      self::SEARCH_TYPE_LESS_EQUAL,
      self::SEARCH_TYPE_LIKE,
      self::SEARCH_TYPE_LIKE_LEFT,
      self::SEARCH_TYPE_LIKE_RIGHT,
      self::SEARCH_TYPE_LIKE_BOTH,
      self::SEARCH_TYPE_REGEXP,
    );

    return in_array($type, $allowedTypes, TRUE);
  }

  /**
   * @param $column
   * @param $type
   * @param $value
   */
  public function addSearchQuery($column, $type, $value) {
    if (!$column || !$type || !$value || !$this->isValidSearchType($type)) {
      return;
    }

    $this->data += array('filters' => '');
    $this->data['filters'] .= $column . ';' . $type . ';' . urlencode($value) . ';*';
  }

  public function addHeaders(array $headers) {
    $this->headers = array_merge($this->headers, $headers);
  }

  public function addRequiredProperty($name) {
    $this->requiredProperties[$name] = TRUE;
  }

  public function setReturnProperty($name) {
    $this->addRequiredProperty($name);
    $this->returnProperty = $name;
  }

  /**
   * Returns text representation of the request, for logging.
   */
  public function __toString() {
    // TODO Better output.
    return print_r($this, TRUE);
  }

}

class ContextlyKitApiResponse {

  /**
   * HTTP response code (positive values) or internal error code (negative).
   *
   * @var int
   */
  public $code = 0;

  /**
   * HTTP status text when not successful or internal error message.
   *
   * @var string
   */
  public $error = '';

  /**
   * HTTP response body.
   *
   * @var string
   */
  public $body = '';

  /**
   * Returns text representation of the object, for logging.
   */
  public function __toString() {
    return "{$this->code} {$this->error}\n{$this->body}";
  }

}

interface ContextlyKitApiTransportInterface {

  /**
   * Performs the HTTP request.
   *
   * @param string $method
   *   "GET" or "POST".
   * @param string $url
   *   Request URL.
   * @param array $query
   *   GET query parameters.
   * @param array $data
   *   POST data.
   * @param array $headers
   *   List of headers.
   *
   * @return ContextlyKitApiResponse
   */
  public function request($method, $url, $query = array(), $data = array(), $headers = array());

}

/**
 * API transport using cURL with re-used handle.
 */
class ContextlyKitApiCurlTransport extends ContextlyKitBase implements ContextlyKitApiTransportInterface {

  protected $handle;

  function __construct($kit) {
    parent::__construct($kit);

    $this->handle = curl_init();
  }

  function __destruct() {
    curl_close($this->handle);
  }

  /**
   * Performs the HTTP request.
   *
   * @param string $method
   *   "GET" or "POST".
   * @param string $url
   *   Request URL.
   * @param array $query
   *   GET query parameters.
   * @param array $data
   *   POST data.
   * @param array $headers
   *   List of headers.
   *
   * @return ContextlyKitApiResponse
   */
  public function request($method, $url, $query = array(), $data = array(), $headers = array()) {
    $options = array();

    // Method-specific options.
    if ($method === 'POST') {
      $options[CURLOPT_POST] = TRUE;
      $options[CURLOPT_POSTFIELDS] = http_build_query($data, NULL, '&');
      $headers['Content-Type'] = 'application/x-www-form-urlencoded';
    }
    else {
      $options[CURLOPT_HTTPGET] = TRUE;
    }

    // Common options.
    if (!empty($query)) {
      $url .= '?' . http_build_query($query, NULL, '&');
    }
    $options[CURLOPT_URL] = $url;
    $options[CURLOPT_HTTPHEADER] = $headers;
    $options[CURLOPT_RETURNTRANSFER] = TRUE;

    // Set options and make a request.
    curl_setopt_array($this->handle, $options);
    $body = curl_exec($this->handle);

    // Fill the response.
    $response = $this->kit->newApiResponse();
    if ($body === FALSE) {
      // cURL error, fill the response with negative error code and message
      // provided by cURL.
      $response->code = - curl_errno($this->handle);
      $response->error = curl_error($this->handle);
    }
    else {
      $response->body = $body;
      $response->code = curl_getinfo($this->handle, CURLINFO_HTTP_CODE);
    }

    return $response;
  }

}

/**
 * API session storage.
 */
interface ContextlyKitApiSessionInterface {

  /**
   * Returns stored token.
   *
   * @return ContextlyKitApiTokenInterface
   */
  public function getToken();

  /**
   * Stores the access token.
   *
   * @param ContextlyKitApiTokenInterface $token
   */
  public function setToken($token);

  /**
   * Removes stored access token.
   */
  public function cleanupToken();

}

interface ContextlyKitApiTokenInterface {

  /**
   * @return bool
   */
  public function isValid();

  public function getExpirationDate();

  public function __toString();

}

class ContextlyKitApiToken extends ContextlyKitBase implements ContextlyKitApiTokenInterface {

  const EXPIRATION_RESERVE = 60;

  protected $signature;

  protected $expires;

  public function __construct($kit, $token) {
    parent::__construct($kit);

    // Token has format "asdfasdf-123123", where first part is signature and the
    // second is expiration timestamp.
    if (!preg_match('/^([^\-]+)\-(\d+)$/', $token, $matches)) {
      throw $this->kit->newException('Unable to parse the access token ' . $token);
    }

    $this->signature = $matches[1];
    $this->expires = $matches[2];
  }

  public function isValid() {
    // Check if token is expired. Make sure we have some expiration reserve to
    // perform operations using this token before it will become expired. Also,
    // the time difference is possible between local and remote servers.
    if ($this->expires < time() + self::EXPIRATION_RESERVE) {
      return FALSE;
    }

    return TRUE;
  }

  public function getExpirationDate() {
    return $this->expires;
  }


  public function __toString() {
    return $this->signature . '-' . $this->expires;
  }

}

/**
 * Empty token, always invalid.
 */
class ContextlyKitApiTokenEmpty extends ContextlyKitBase implements ContextlyKitApiTokenInterface {

  /**
   * @return bool
   */
  public function isValid() {
    return FALSE;
  }

  public function getExpirationDate() {
    return 0;
  }

  public function __toString() {
    return '';
  }
}

/**
 * Isolated session handler, stores access token in property.
 */
class ContextlyKitApiSessionIsolated extends ContextlyKitBase implements ContextlyKitApiSessionInterface {

  /**
   * @var ContextlyKitApiTokenInterface|null
   */
  protected $token;

  public function __construct($kit) {
    parent::__construct($kit);

    $this->cleanupToken();
  }

  /**
   * Removes stored access token.
   */
  public function cleanupToken() {
    $this->token = $this->kit->newApiTokenEmpty();
  }

  /**
   * Returns stored token.
   *
   * @return ContextlyKitApiTokenInterface
   */
  public function getToken() {
    return $this->token;
  }

  /**
   * Stores the access token.
   *
   * @param ContextlyKitApiTokenInterface $token
   */
  public function setToken($token) {
    $this->token = $token;
  }

}

/**
 * API Exceptions.
 */
class ContextlyKitApiException extends ContextlyKitException {

  /**
   * @var ContextlyKitApiRequest|null
   */
  protected $request;

  /**
   * @var ContextlyKitApiResponse|null
   */
  protected $response;

  /**
   * @var object|null
   */
  protected $result;

  /**
   * @return ContextlyKitApiRequest|null
   */
  public function getApiRequest() {
    return $this->request;
  }

  /**
   * @return ContextlyKitApiResponse|null
   */
  public function getApiResponse() {
    return $this->response;
  }

  /**
   * @return object|null
   */
  public function getApiResult() {
    return $this->result;
  }

  /**
   * @param string $message
   * @param ContextlyKitApiRequest $request
   * @param ContextlyKitApiResponse $response
   * @param object $result
   */
  public function __construct($message = '', $request = NULL, $response = NULL, $result = NULL) {
    $this->request = $request;
    $this->response = $response;
    $this->result = $result;

    parent::__construct($message);
  }

  protected function getPrintableDetails() {
    $details = parent::getPrintableDetails();

    if (isset($this->result)) {
      $details['api-result'] = "Decoded result:\n" . print_r($this->result, TRUE);
    }

    if (isset($this->response)) {
      $details['api-response'] = "Server response:\n" . $this->response;
    }

    if (isset($this->request)) {
      $details['api-result'] = "API request:\n" . $this->request;
    }

    return $details;
  }

}
