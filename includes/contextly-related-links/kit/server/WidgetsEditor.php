<?php

class ContextlyKitWidgetsEditor extends ContextlyKitBase {

  const WIDGET_TYPE_SNIPPET = 'snippet';
  const WIDGET_TYPE_SIDEBAR = 'sidebar';
  const WIDGET_TYPE_AUTO_SIDEBAR = 'auto-sidebar';

  /**
   * @var ContextlyKitApi
   */
  protected $api;

  public function __construct($kit, $api = NULL) {
    parent::__construct($kit);

    if (!isset($api)) {
      $api = $this->kit->newApi();
    }
    $this->api = $api;
  }

  public function queuePageWidgetsLoading($postId) {
    $this->api
      ->method('pagewidgets', 'get')
      ->param('page_id', $postId)
      ->param('admin', 1)
      ->param('editor', 1)
      ->requireSuccess()
      ->returnProperty('entry');
  }

  /**
   * Loads page widgets from Contextly.
   *
   * @param int $pageId
   *   Post ID on the website.
   *
   * @return object
   *
   * @throws ContextlyKitException
   */
  public function loadPageWidgets($postId) {
    $this->queuePageWidgetsLoading($postId);
    return $this->api->get();
  }

  public function handleAddSnippetLinkRequest(array $params) {
    // Get default URL title if not passed.
    if (!isset($params['title'])) {
      $urlInfo = $this->fetchUrlInfo($params['url']);
      $params['title'] = $urlInfo->title;
    }

    if (!isset($params['snippet_id'])) {
      // Create new snippet first to get its ID.
      $snippetId = $this->putSnippet(array(
        'custom_id' => $params['custom_id'],
      ));
    }
    else {
      // Just update links of existing snippet.
      $snippetId = $params['snippet_id'];
    }

    // Build fake list with single link and save it. Saving method doesn't
    // change links that are not passed to it.
    $links = array();
    $links[] = array(
      'url' => $params['url'],
      'title' => $params['title'],
      'type' => $params['type'],
      'pos' => $params['pos'],
    );
    $this->queueWidgetLinksSaving($snippetId, $links);

    // Load full updated snippet.
    $this->queueSnippetLoading($snippetId);
    $snippet = $this->api->get();

    return array(
      'url' => $params['url'],
      'snippet' => $snippet,
    );
  }

  public function queueAnnotationsLoading($activeOnly = TRUE) {
    $this->api
      ->method('annotations', 'list')
      ->requireSuccess()
      ->returnProperty('list');

    if ($activeOnly) {
      $this->api->searchParam('status', ContextlyKitApiRequest::SEARCH_TYPE_EQUAL, 'active');
    }
  }

  public function loadAnnotations($activeOnly = TRUE) {
    // TODO Handle request paging (on lower API level).
    $this->queueAnnotationsLoading($activeOnly);
    return $this->api->get();
  }

  public function searchLinks($siteUrl, $query, $page, $perPage) {
    $extraParams = array();
    if (!empty($siteUrl)) {
      $extraParams = array(
        'url' => $siteUrl,
      );
    }

    $response = $this->api
      ->method('search', 'list')
      ->extraParam('query', $query)
      ->param('page', $page)
      ->param('per_page', $perPage)
      ->extraParams($extraParams)
      ->requireSuccess()
      ->get();

    $nextPage = $response->next_page;

    // API returns 10 first pages only.
    // TODO Move this limitation to the API server.
    if ($response->page >= 10) {
      $nextPage = FALSE;
    }

    $result = array(
      'query' => $response->query,
      'page' => $response->page,
      'siteUrl' => !empty($response->url) ? $response->url : '',
      'list' => array_values($response->list),
      'nextPage' => $nextPage,
    );

    return $result;
  }

  public function searchSidebars($sidebarId, $query, $page, $perPage) {
    $response = $this->api
      ->method('sidebars', 'search')
      ->searchParam('name', ContextlyKitApiRequest::SEARCH_TYPE_LIKE_BOTH, $query)
      ->searchParam('id', ContextlyKitApiRequest::SEARCH_TYPE_NOT_EQUAL, $sidebarId)
      ->searchParam('type', ContextlyKitApiRequest::SEARCH_TYPE_EQUAL, 'all')
      ->param('page', $page)
      ->param('per_page', $perPage)
      ->requireSuccess()
      ->get();

    if ($response->page < $response->pages) {
      $nextPage = TRUE;
    }
    else {
      $nextPage = FALSE;
    }

    $result = array(
      'query' => $query,
      'page' => $response->page,
      'list' => array_values($response->list),
      'nextPage' => $nextPage,
    );

    return $result;
  }

  protected function fetchUrlInfo($url) {
    $response = $this->api
      ->method('urls', 'get')
      ->extraParams(array(
        'url' => $url,
      ))
      ->requireSuccess()
      ->requireProperty('entry')
      ->get();

    return $response->entry;
  }

  public function handleUrlInfoRequest($params) {
    return $this->fetchUrlInfo($params['url']);
  }

  public function handleRemoveSnippetRequest($params) {
    $this->api
      ->method('snippets', 'delete')
      ->param('id', $params['snippet_id'])
      ->requireSuccess()
      ->get();

    return array('success' => TRUE);
  }

  public function handleRemoveSidebarRequest($params) {
    $this->api
      ->method($this->getSidebarApiType($params['type']), 'delete')
      ->param('id', $params['sidebar_id'])
      ->requireSuccess()
      ->get();

    return array('success' => TRUE);
  }

  public function handleSaveSnippetRequest($params) {
    if (!isset($params['snippet_id'])) {
      // Create new snippet first to get its ID.
      $snippetId = $this->putSnippet(array(
        'custom_id' => $params['custom_id'],
      ));
    }
    else {
      // Just update links of existing snippet.
      $snippetId = $params['snippet_id'];
    }

    // Remove links.
    if (!empty($params['remove_links'])) {
      $this->queueWidgetLinksRemoval($snippetId, $params['remove_links']);
    }

    // Add and update links.
    if (!empty($params['save_links'])) {
      $this->queueWidgetLinksSaving($snippetId, $params['save_links']);
    }

    // Load full updated snippet.
    $this->queueSnippetLoading($snippetId);
    $snippet = $this->api->get();
    return array(
      'snippet' => $snippet,
    );
  }

  public function putSidebar($sidebar, $sidebarType) {
    $response = $this->api
      ->method($this->getSidebarApiType($sidebarType), 'put')
      ->extraParams($sidebar)
      ->requireSuccess()
      ->requireProperty('id')
      ->get();

    return $response->id;
  }

  public function handleSaveSidebarRequest(array $params) {
    $params += array(
      'sidebar_id' => NULL,
			'type' => self::WIDGET_TYPE_SIDEBAR,
      'name' => '',
      'description' => '',
    );
    $addToRelated = !empty($params['related_links']);

    // First, update/insert the sidebar itself.
    $sidebar = array(
      'id' => $params['sidebar_id'],
    );
    $sidebarParams = array('name', 'description', 'layout', 'custom_id');
    foreach ($sidebarParams as $key) {
      $sidebar[$key] = $params[$key];
    }
    $sidebarType = $params['type'];
    $sidebarId = $this->putSidebar($sidebar, $sidebarType);

    // If we're going to add links to the snippet too, get its ID if not passed.
    $snippetId = NULL;
    if ($addToRelated) {
      if (!isset($params['snippet_id'])) {
        $snippetId = $this->putSnippet(array(
          'custom_id' => $params['custom_id'],
        ));
      }
      else {
        $snippetId = $params['snippet_id'];
      }
    }

    // Remove links.
    if (!empty($params['remove_links'])) {
      $this->queueWidgetLinksRemoval($sidebarId, $params['remove_links']);
    }

    // Add and update links.
    if (!empty($params['save_links'])) {
      $this->queueWidgetLinksSaving($sidebarId, $params['save_links']);
    }

    // Add links to the snippet and reload it if asked.
    if ($addToRelated) {
      $this->queueWidgetLinksSaving($snippetId, $params['related_links']);
      $this->queueSnippetLoading($snippetId);
    }

    // Load full updated sidebar.
    $this->queueSidebarLoading($sidebarId, $sidebarType);

    // Extract results.
    $results = $this->api->getMultiple();
    $output = array(
      'sidebar' => array_pop($results),
    );
    if ($addToRelated) {
      $output += array(
        'snippet' => array_pop($results),
      );
    }

    return $output;
  }

  protected function queueSnippetLoading($snippetId) {
    $this->api
      ->method('snippets', 'get')
      ->param('id', $snippetId)
      ->param('admin', 1)
      ->param('editor', 1)
      ->requireSuccess()
      ->returnProperty('entry');
  }

  public function loadSnippet($snippetId) {
    $this->queueSnippetLoading($snippetId);
    return $this->api->get();
  }

  protected function getSidebarApiType($sidebarType) {
    if ($sidebarType === self::WIDGET_TYPE_AUTO_SIDEBAR) {
      return 'autosidebars';
    }
    else {
      return 'sidebars';
    }
  }

  protected function queueSidebarLoading($sidebarId, $sidebarType) {
    $this->api
      ->method($this->getSidebarApiType($sidebarType), 'get')
      ->param('id', $sidebarId)
      ->param('admin', 1)
      ->param('editor', 1)
      ->requireSuccess()
      ->returnProperty('entry');
  }

  public function loadSidebar($sidebarId, $sidebarType) {
    $this->queueSidebarLoading($sidebarId, $sidebarType);
    return $this->api->get();
  }

  public function queueSnippetSettingsLoading() {
    $this->api
      ->method('widgetsettings', 'get')
      ->requireSuccess()
      ->returnProperty('entry');
  }

  public function loadSnippetSettings() {
    $this->queueSnippetSettingsLoading();
    return $this->api->get();
  }

  protected function queueWidgetLinksSaving($id, array $links) {
    foreach ($links as $link) {
      // Force title to be single line, collapse multiple spaces into one and
      // remove leading/trailing spaces.
      $link['title'] = trim(preg_replace(array(
        '/\r\n|\n|\r/',
        '/\s+/'
      ), ' ', $link['title']));

      $this->api
        ->method('links', 'put')
        ->extraParams(array('snippet_id' => $id) + $link)
        ->requireSuccess();
    }
  }

  protected function queueWidgetLinksRemoval($id, array $links) {
    foreach ($links as $link) {
      $this->api
        ->method('links', 'delete')
        ->param('id', $link['id'])
        ->requireSuccess();
    }
  }

  public function putSnippet($data) {
    $response = $this->api
      ->method('snippets', 'put')
      ->extraParams($data)
      ->requireSuccess()
      ->requireProperty('id')
      ->get();

    return $response->id;
  }

  /**
   * Map of the request machine name to the handler function and its parameters.
   */
  protected function getRequestsMap() {
    return array(
      'search' => array(
        'handleSearchRequest',
        array(
          'type' => TRUE,
          'query' => FALSE,
          'page' => TRUE,
          'site_url' => FALSE,
          'sidebar_id' => FALSE,
        ),
      ),
      'url-info' => array(
        'handleUrlInfoRequest',
        array(
          'url' => TRUE,
        ),
      ),
      'save-snippet' => array(
        'handleSaveSnippetRequest',
        array(
          'custom_id' => TRUE,
          'snippet_id' => FALSE,
          'save_links' => FALSE,
          'remove_links' => FALSE,
        ),
      ),
      'remove-snippet' => array(
        'handleRemoveSnippetRequest',
        array(
          'snippet_id' => TRUE,
        ),
      ),
      'save-sidebar' => array(
        'handleSaveSidebarRequest',
        array(
          'sidebar_id' => FALSE,
          'type' => FALSE,
          'custom_id' => TRUE,
          'name' => FALSE,
          'description' => FALSE,
          'layout' => TRUE,
          'snippet_id' => FALSE,
          'save_links' => FALSE,
          'remove_links' => FALSE,
          'related_links' => FALSE,
        ),
      ),
      'remove-sidebar' => array(
        'handleRemoveSidebarRequest',
        array(
          'sidebar_id' => TRUE,
          'type' => TRUE,
        ),
      ),
      'add-snippet-link' => array(
        'handleAddSnippetLinkRequest',
        array(
          'custom_id' => TRUE,
          'url' => TRUE,
          'title' => FALSE,
          'type' => TRUE,
          'pos' => TRUE,
          'snippet_id' => FALSE,
        ),
      ),
      'get-editor-data' => array(
        'handleGetEditorDataRequest',
        array(
          'custom_id' => TRUE,
        ),
      ),
    );
  }

  public function handleRequest($request, array $params = array()) {
    $map = $this->getRequestsMap();

    if (!isset($map[$request])) {
      throw $this->kit->newException('Unknown request type "' . $request . '"');
    }

    list($func, $specs) = $map[$request];
    $params = $this->extractRequestParams($request, $params, $specs);

    return $this->{$func}($params);
  }

  protected function extractRequestParams($request, $params, $specs) {
    $result = array();

    foreach ($specs as $key => $isRequired) {
      if (isset($params[$key]) && $params[$key] !== '') {
        $result[$key] = $params[$key];
      }
      elseif ($isRequired) {
        throw $this->kit->newWidgetsEditorException("Required parameter $key is empty.", $request, $params);
      }
    }

    return $result;
  }

  protected function handleSearchRequest($params) {
    // TODO: Make it configurable from outside of the class.
    $limit = 10;

    $map = array(
      'links' => array(
        'method' => 'searchLinks',
        'params' => array(
          'site_url' => '',
        ),
      ),
      'sidebars' => array(
        'empty_query' => TRUE,
        'method' => 'searchSidebars',
        'params' => array(
          'sidebar_id' => NULL,
        ),
      ),
    );

    $type = $params['type'];
    if (!isset($map[$type])) {
      throw $this->kit->newWidgetsEditorException('Unknown search type ' . $type, 'search', $params);
    }

    $specs = $map[$type];
    $params += $specs['params'];

    // Trim and validate query.
    $params['query'] = isset($params['query']) ? trim($params['query']) : '';
    if ($params['query'] === '' && empty($specs['empty_query'])) {
      throw $this->kit->newWidgetsEditorException("Query is required for this type of search.", 'search', $params);
    }

    // Run search method.
    $method = $specs['method'];
    $args = array_values(array_intersect_key($params, $specs['params']));
    $args = array_merge($args, array($params['query'], $params['page'], $limit));
    $result = call_user_func_array(array($this, $method), $args);

    // Normalize URL to be at least empty string.
    if (empty($result['siteUrl'])) {
      $result['siteUrl'] = '';
    }

    // Return type back.
    $result['type'] = $type;

    return $result;
  }

  protected function handleGetEditorDataRequest($params) {
    $postId = $params['custom_id'];
    return $this->loadEditorData($postId);
  }

  /**
   * Loads settings and widgets for the overlay editor from Contextly.
   *
   * @param int $post_id
   *
   * @return array
   */
  public function loadEditorData($postId) {
    $this->queuePageWidgetsLoading($postId);
    $this->queueAnnotationsLoading();

    // When there are no snippets we need at least its settings to still
    // work properly. Always load it in the same queue to save time.
    $this->queueSnippetSettingsLoading();

    list($widgets, $annotations, $snippetSettings) = $this->api->getMultiple();

    if (!empty($widgets->snippets) && is_array($widgets->snippets)) {
      $snippet = reset($widgets->snippets);
    }
    else {
      $snippet = array(
        'settings' => $snippetSettings,
      );
    }

    // Put both normal sidebars and auto-sidebars to the same collection. We can
    // always get actual type from the sidebar itself.
    $sidebars = array();
    foreach (array('sidebars', 'auto_sidebars') as $key) {
      if (!empty($widgets->{$key})) {
        foreach ($widgets->{$key} as $sidebar) {
          if (!empty($sidebar->id)) {
            $sidebars[$sidebar->id] = $sidebar;
          }
        }
      }
    }

    // Force annotations to be zero-based array. Add default "Web" tab to the
    // end of the list with zero ID and empty URL.
    $annotations = array_values($annotations);
    $annotations[] = (object) array(
      'id' => '0',
      'site_name' => 'Web',
      'site_url' => '',
      'status' => 'active',
    );

    return array(
      'snippet' => $snippet,
      'sidebars' => $sidebars,
      'annotations' => $annotations,
    );
  }

}

class ContextlyKitWidgetsEditorException extends ContextlyKitException {

  protected $request;

  protected $params;

  public function getRequest() {
    return $this->request;
  }

  public function getParams() {
    return $this->params;
  }

  protected function getPrintableDetails() {
    $details = parent::getPrintableDetails();

    $details['request'] = "Editor request: {$this->request}";
    $details['params'] = "Params: " . print_r($this->params, TRUE);

    return $details;
  }

  public function __construct($message = "", $request = '', $params = array()) {
    $this->request = $request;
    $this->params = $params;

    parent::__construct($message);
  }

}
