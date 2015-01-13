<?php

/**
 * Generic kit class.
 *
 * Contains factory for the most kit classes, auto-loader and re-usable
 * functions.
 *
 * @method ContextlyKitApi newApi()
 * @method ContextlyKitApiRequest newApiRequest()
 * @method ContextlyKitApiResponse newApiResponse()
 * @method ContextlyKitApiToken newApiToken()
 * @method ContextlyKitApiTokenEmpty newApiTokenEmpty()
 * @method ContextlyKitApiSessionInterface newApiSession()
 * @method ContextlyKitApiSessionIsolated newApiSessionIsolated()
 * @method ContextlyKitApiTransportInterface newApiTransport()
 * @method ContextlyKitApiException newApiException()
 * @method ContextlyKitAssetsManager newAssetsManager()
 * @method ContextlyKitAssetsConfig newAssetsConfig()
 * @method ContextlyKitAssetsConfigAggregated newAssetsConfigAggregated()
 * @method ContextlyKitAssetsList newAssetsList()
 * @method ContextlyKitAssetsHtmlRenderer newAssetsHtmlRenderer()
 * @method ContextlyKitException newException()
 * @method ContextlyKitConsolePackagerCommand newConsolePackagerCommand()
 * @method ContextlyKitExecCommand newExecCommand()
 * @method ContextlyKitExecResult newExecResult()
 * @method ContextlyKitPackageArchiver newPackageArchiver()
 * @method ContextlyKitPackageManager newPackageManager()
 * @method ContextlyKitPackageSettings newPackageSettings()
 * @method ContextlyKitPackageUploader newPackageUploader()
 * @method ContextlyKitPackageMediaAggregator newPackageMediaAggregator()
 * @method ContextlyKitPackageTemplatesAggregator newPackageTemplatesAggregator()
 * @method ContextlyKitPackageJsAggregator newPackageJsAggregator()
 * @method ContextlyKitPackageCssAggregator newPackageCssAggregator()
 * @method ContextlyKitOverlayDialog newOverlayDialog()
 * @method ContextlyKitServerTemplate newServerTemplate()
 * @method ContextlyKitWidgetsEditor newWidgetsEditor()
 * @method ContextlyKitWidgetsEditorException newWidgetsEditorException()
 */
class ContextlyKit {

  /**
   * @var null|string
   */
  protected static $version;

  /**
   * Path of the Kit root.
   *
   * @var null|string
   */
  protected static $rootPath;

  public static function autoload($class) {
    $pattern = '/^ContextlyKit/';
    if (preg_match($pattern, $class)) {
      $words = preg_replace($pattern, '', $class);
      $words = preg_split('/(?=[A-Z])/', $words, -1, PREG_SPLIT_NO_EMPTY);

      $directory = dirname(__FILE__);
      while (!empty($words)) {
        $filename = $directory . '/' . implode('', $words) . '.php';
        if (file_exists($filename)) {
          require_once $filename;
          break;
        }

        // Remove last word for the next iteration.
        array_pop($words);
      }
    }
  }

  public static function registerAutoload() {
    spl_autoload_register(array(__CLASS__, 'autoload'));
  }

  public static function version() {
    if (!isset(self::$version)) {
      $path = self::getRootPath() . '/version';
      if (!file_exists($path)) {
        self::$version = 'dev';
      }
      else {
        self::$version = trim(file_get_contents($path));
      }
    }

    return self::$version;
  }

  /**
   * @var ContextlyKitSettings
   */
  protected $settings;

  function __construct($settings) {
    $this->settings = $settings;
  }

  /**
   * Returns asset URL.
   *
   * @param string $filepath
   *   Path relative to the "client/src" folder on dev mode and to the
   *   "client/aggregated" folder on live mode.
   * @return asset URL
   */
  function buildAssetUrl($filepath) {
	if ( $this->isCdnEnabled() ) {
      if ( strpos($filepath, '.css') === false || strpos($filepath, 'widgets--factory.css') !== false ) {
	    // TODO Avoid hard-coding "_kit/assets" path.
	    return $this->getServerUrl('cdn') . 'kit/assets/' . self::version() . '/' . $filepath;
      }
    }

    return $this->buildFileUrl($this->getFolderPath('client') . '/' . $filepath);
  }

  /**
   * Returns URL of the passed file.
   *
   * Integration should override it for more control over the URL building.
   *
   * @param string $filepath
   *   File path relative to the Kit root.
   *
   * @return string
   *   Absolute URL to the passed file.
   *
   * @throws ContextlyKitException
   */
  function buildFileUrl($filepath) {
    if (isset($this->settings->urlPrefix)) {
      return $this->settings->urlPrefix . '/' . $filepath;
    }
    else {
      throw $this->newException("Unable to convert file path to URL because of wrong kit settings.");
    }
  }

  function escapeHTML($text) {
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
  }

  function getSettings() {
    return $this->settings;
  }

  function isDevMode() {
    // TODO Optimize all 3 functions to avoid comparing strings each time over and over again.
    return $this->settings->mode === 'dev';
  }

  function isLiveMode() {
    return $this->settings->mode === 'live';
  }

  function isPackagerMode() {
    return $this->settings->mode === 'pkg';
  }

  function isHttps() {
	if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') {
      return TRUE;
    }
    else {
      return FALSE;
    }
  }

  function isCdnEnabled() {
    return !$this->isDevMode() && $this->settings->cdn;
  }

  protected function getServerUrls() {
    return array(
      'cdn' => array(
        'http' => 'http://contextlysitescripts.contextly.com/',
        'https' => 'https://c714015.ssl.cf2.rackcdn.com/',
      ),
      'main' => array(
        'dev' => 'http://dev.contextly.com/',
        'live' => 'http://contextly.com/',
      ),
      'cp' => array(
        'dev' => 'https://dev.contextly.com/',
        'live' => 'https://contextly.com/',
      ),
      'api' => array(
        'dev' => 'http://devrest.contextly.com/',
        'live' => array(
          'http' => 'http://rest.contextly.com/',
          'https' => 'https://rest.contextly.com/',
        ),
      ),
    );
  }

  function getServerUrl($serverType) {
    $urls = $this->getServerUrls();
    if (!isset($urls[$serverType])) {
      throw $this->newException("Unknown server type: {$serverType}");
    }

    $serverUrls = $urls[$serverType];
    if (is_string($serverUrls)) {
      return $serverUrls;
    }
    else {
      $keys = array();
      $keys[] = $this->settings->mode;
      $keys[] = $this->isHttps() ? 'https' : 'http';

      foreach ($keys as $key) {
        if (isset($serverUrls[$key])) {
          if (is_string($serverUrls[$key])) {
            return $serverUrls[$key];
          }
          else {
            $serverUrls = $serverUrls[$key];
          }
        }
      }

      // No URL found for the case.
      $keys = implode(', ', $keys);
      throw $this->newException("Server URL {$serverType} not found for keys {$keys}");
    }
  }

  /**
   * Returns absolute path to the root folder of the kit.
   *
   * @return string
   */
  static public function getRootPath() {
    if (!isset(self::$rootPath)) {
      // Get parent directory of the current file.
      self::$rootPath = dirname(dirname(__FILE__));
    }

    return self::$rootPath;
  }

  /**
   * Returns path to the Kit sub-folder.
   *
   * @param string $folder
   *   Top-level folder of the Kit. Optionally with first level sub-folder. If
   *   sub-folder is not specified it will be automatically set depending on the
   *   Kit mode for "client" and "config" top-level folders.
   * @param bool $absolute
   *   Pass TRUE to get absolute path, otherwise path related to the kit root
   *   is returned.
   *
   * @return string
   *   For "client" and "config" folders it returns path to the sub-folder
   *   depending on the current mode.
   */
  function getFolderPath($folder, $absolute = FALSE) {
    $path = '';

    if ($absolute) {
      $path .= self::getRootPath() . '/';
    }

    $path .= $folder;

    if (in_array($folder, array('client', 'config'), TRUE)) {
      if ($this->isLiveMode()) {
        $path .= '/aggregated';
      }
      else {
        $path .= '/src';
      }
    }

    return $path;
  }

  /**
   * Returns default implementations of some interfaces.
   *
   * Should be overwritten on child classes to use alternatives.
   *
   * @return array
   */
  protected function getClassesMap() {
    return array(
      'ApiSession' => 'ContextlyKitApiSessionIsolated',
      'ApiTransport' => 'ContextlyKitApiCurlTransport',
      'PackageUploader' => 'ContextlyKitPackageCloudFilesUploader',
    );
  }

  protected function getClassName($baseName) {
    $map = $this->getClassesMap();
    if (isset($map[$baseName])) {
      return $map[$baseName];
    }
    else {
      return 'ContextlyKit' . $baseName;
    }
  }

  /**
   * Magic method to create new instances of the kit classes.
   *
   * To override some classes the child class is able to just implement
   * non-magic new*() methods and create instances of custom classes there.
   */
  function __call($name, $arguments) {
    $replaced = 0;
    $baseName = preg_replace('/^new/', '', $name, -1, $replaced);
    if (!$replaced) {
      throw $this->newException("Undefined method {$name}.");
    }

    $className = $this->getClassName($baseName);
    $reflection = new ReflectionClass($className);
    if ($reflection->isSubclassOf('ContextlyKitBase')) {
      array_unshift($arguments, $this);
    }

    if (!empty($arguments)) {
      return $reflection->newInstanceArgs($arguments);
    }
    else {
      return $reflection->newInstance();
    }
  }

}

class ContextlyKitSettings {

  /**
   * Kit mode.
   *
   * Valid values are:
   * - live: production mode
   * - dev: development mode
   * - pkg: resources packager mode
   *
   * @var string
   */
  public $mode = 'live';

  /**
   * Whether to use CDN for resources or not.
   *
   * Is only used on the "live" mode.
   *
   * @var bool
   */
  public $cdn = TRUE;

  /**
   * Contextly application ID.
   *
   * @var string
   */
  public $appID = '';

  /**
   * Contextly application secret.
   *
   * @var string
   */
  public $appSecret = '';

  /**
	 * URL of the kit root folder.
	 *
	 * No trailing slash!
   *
   * Integration should either specify this setting or override the
   * ContextlyKit::buildFileURL().
	 *
	 * @var string|null
	 */
	public $urlPrefix = NULL;

}

/**
 * Base class for all the kit classes holding link to the kit instance.
 */
class ContextlyKitBase {

  /**
   * @var ContextlyKit
   */
  protected $kit;

  protected $settings;

  /**
   * @param ContextlyKit $kit
   */
  public function __construct($kit) {
    $this->kit = $kit;
    $this->settings = $kit->getSettings();
  }

}

class ContextlyKitException extends Exception {

  protected function getPrintableDetails() {
    $details = array();

    $details['class'] = get_class($this) . '. Code: ' . $this->getCode();
    $details['message'] = 'Message: "' . $this->getMessage() . '"';
    $details['file'] = 'File: ' . $this->getFile() . ':' . $this->getLine();

    return $details;
  }

  public function __toString() {
    $details = $this->getPrintableDetails();

    // Add call stack to the end.
    $details['stack'] = "Stack trace:\n" . $this->getTraceAsString();

    return implode("\n\n", $details);
  }

}
