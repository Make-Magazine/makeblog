<?php

class ContextlyKitAssetsManager extends ContextlyKitBase {

  protected $configs = array();

  protected $configsPath;

  public function __construct($kit) {
    parent::__construct($kit);

    $this->configsPath = $this->kit->getFolderPath('config', TRUE);
  }

  protected function getConfig($packageName) {
    if (!isset($this->configs[$packageName])) {
      $path = $this->configsPath . '/' . $packageName . '.json';
      $this->configs[$packageName] = $this->kit->newAssetsConfig($path);
    }

    return $this->configs[$packageName];
  }

  /**
   * Returns list of configs keyed by package name.
   *
   * Order of packages on the "include" section is kept. Dependencies of each
   * package are included before the package itself.
   *
   * @param string $parentName
   *   Name of the parent package.
   * @param array $ignore
   *   List of ignored packages. Keys are package names, values are not used.
   * @param array $utilized
   *   Internal use only. Stores the list of already found packages, to avoid
   *   parsing of the same package multiple times.
   *
   * @return array
   *   List of configs or NULLs keyed by package name.
   */
  protected function resolveDependencies($parentName, $ignore = array(), &$utilized = array()) {
    $utilized[$parentName] = TRUE;

    $result = array();
    $config = NULL;
    if (!array_key_exists($parentName, $ignore)) {
      $config = $this->getConfig($parentName);
      if (!empty($config->include)) {
        foreach ($config->include as $package) {
          if (isset($utilized[$package])) {
            continue;
          }

          $result += $this->resolveDependencies($package, $ignore, $utilized);
        }
      }
    }

    $result[$parentName] = $config;

    return $result;
  }

  /**
   * Adds assets of the specified package to the assets list.
   *
   * @param string $packageName
   * @param ContextlyKitAssetsList $assets
	 * @param array $ignore
	 *   Keys are package names to ignore, values are not used. Should be used
	 *   to replace Kit libraries with CMS variants.
   *
   * @return array
   *   List of parsed packages, including ignored ones. Keys are package names,
   *   values are TRUE for included packages and FALSE for ignored ones.
   */
  function extractPackageAssets($packageName, $assets, $ignore = array()) {
    $configs = $this->resolveDependencies($packageName, $ignore);

    $result = array();
    foreach ($configs as $key => $config) {
      $included = isset($config);

      if ($included) {
        $assets->parseConfig($config);
      }

      $result[$key] = $included;
    }
    return $result;
  }

  function discoverPackages() {
    $root = $this->configsPath;

    $paths = array(
      $root,
    );
    $configs = array();
    for ($i = 0; $i < count($paths); $i++) {
      $files = glob($paths[$i] . '/*.json');
      foreach ($files as $file) {
        if (is_file($file)) {
          $configs[] = $file;
        }
      }

      $subdirs = glob($paths[$i] . '/*', GLOB_ONLYDIR);
      if ($subdirs) {
        $paths = array_merge($paths, $subdirs);
      }
    }

    $patterns = array(
      '@^' . preg_quote($root . '/', '@') . '@',
      '@\.json$@',
    );
    $packages = preg_replace($patterns, '', $configs);
    return $packages;
  }

  function discoverPackagesToAggregate() {
    $packages = $this->discoverPackages();
    $aggregate = array();
    foreach ($packages as $packageName) {
      $config = $this->getConfig($packageName);
      if (!empty($config->aggregate)) {
        $aggregate[$packageName] = TRUE;
      }
    }
    return $aggregate;
  }

}

class ContextlyKitAssetsConfig extends ContextlyKitBase {

  protected $config;

  protected $filepath;

  function __construct($kit, $path) {
    parent::__construct($kit);

    $this->filepath = $path;
  }

  protected function load() {
    // Load only once.
    if (isset($this->config)) {
      return;
    }

    if (!file_exists($this->filepath)) {
      throw $this->kit->newException("Unable to load config at {$this->filepath}");
    }

    $content = file_get_contents($this->filepath);
    if ($content === FALSE) {
      throw $this->kit->newException("Config at {$this->filepath} is empty.");
    }

    $config = json_decode($content);
    if (!isset($config)) {
      throw $this->kit->newException("Unable to decode config at {$this->filepath}");
    }

    $this->config = $config;
  }

  function getFilepath() {
    return $this->filepath;
  }

  function __isset($name) {
    $this->load();
    return isset($this->config->{$name});
  }

  function __get($name) {
    $this->load();
    return $this->config->{$name};
  }

}

class ContextlyKitAssetsList extends ContextlyKitBase {

  protected $js = array();

  protected $css = array();

  protected $tpl = array();

  protected $media = array();

  function extractAssets($base, $key, ContextlyKitAssetsConfig $config) {
    if (!isset($config->{$key})) {
      return;
    }

    $parsed = array();
    foreach ($config->{$key} as $filepath) {
      if (!is_string($filepath)) {
        $subkey = $this->settings->mode;
        if (!isset($filepath->{$subkey})) {
          continue;
        }
        $filepath = $filepath->{$subkey};
      }

      $parsed[$base . $filepath] = TRUE;
    }

    if (!empty($parsed)) {
      $this->{$key} += $parsed;
    }
  }

  protected function extractTpl($base, ContextlyKitAssetsConfig $config) {
    if (!isset($config->tpl)) {
      return;
    }

    $parsed = array();
    foreach ($config->tpl as $name => $filepath) {
      $parsed[$name] = $base . $filepath;
    }

    if (!empty($parsed)) {
      $this->tpl += $parsed;
    }
  }

  public function parseConfig(ContextlyKitAssetsConfig $config) {
    $base = '';

    if (!empty($config->base)) {
      $base .= rtrim($config->base, '\/') . '/';
    }

    foreach (array('js', 'css', 'media') as $key) {
      $this->extractAssets($base, $key, $config);
    }

    $this->extractTpl($base, $config);
  }

  function getJs() {
    return array_keys($this->js);
  }

  function getCss() {
    return array_keys($this->css);
  }

  function getTpl() {
    return $this->tpl;
  }

  function getMedia() {
    return array_keys($this->media);
  }

  function buildJsUrls() {
    $js = $this->getJs();
    if (empty($js)) {
      return array();
    }

    $urls = array();
    foreach ($js as $path) {
      $urls[$path] = $this->kit->buildAssetUrl($path . '.js');
    }

    return $urls;
  }

  function buildCssUrls() {
    $css = $this->getCss();
    if (empty($css)) {
      return array();
    }

    $urls = array();
    foreach ($css as $path) {
      $urls[$path] = $this->kit->buildAssetUrl($path . '.css');
    }

    return $urls;
  }

  function buildTplUrls() {
    $tpls = $this->getTpl();
    if (empty($tpls)) {
      return array();
    }

    $urls = array();
    foreach ($tpls as $path) {
      $urls[$path] = $this->kit->buildAssetUrl($path . '.handlebars');
    }

    return $urls;
  }

}

abstract class ContextlyKitAssetsRenderer extends ContextlyKitBase {

  /**
   * @var ContextlyKitAssetsList
   */
  protected $assets;

  /**
   * @param ContextlyKit $kit
   * @param ContextlyKitAssetsList $assets
   */
  public function __construct($kit, $assets) {
    parent::__construct($kit);

    $this->assets = $assets;
  }

  abstract public function renderCss();

  abstract public function renderJs();

  abstract public function renderTpl();

  abstract public function renderAll();

}

class ContextlyKitAssetsHtmlRenderer extends ContextlyKitAssetsRenderer {

  public function renderCss() {
    $urls = $this->assets->buildCssUrls();
    if (empty($urls)) {
      return '';
    }

    $output = '<style type="text/css" media="all">' . "\n";
    foreach ($urls as $url) {
      $output .= '@import url("' . $this->kit->escapeHTML($url) . '");';
      $output .= "\n";
    }
    $output .= '</style>';

    return $output;
  }

  public function renderJs() {
    $urls = $this->assets->buildJsUrls();
    if (empty($urls)) {
      return '';
    }

    $output = '';
    foreach ($urls as $url) {
      $output .= '<script type="text/javascript" src="' . $this->kit->escapeHTML($url) . '"></script>';
      $output .= "\n";
    }

    return $output;
  }

  public function renderTpl() {
    $tpl = $this->assets->getTpl();
    if (empty($tpl)) {
      return '';
    }

    if ($this->kit->isDevMode()) {
      $templates = array();
      $basePath = $this->kit->getFolderPath('client', TRUE) . '/';
      foreach ($tpl as $name => $filePath) {
        $fullPath = $basePath . $filePath . '.handlebars';
        $content = file_get_contents($fullPath);
        $templates[$this->kit->escapeHTML($name)] = $content;
      }

      $output = $this->kit->newServerTemplate('handlebars-templates')
        ->render(array(
          'templates' => $templates,
        ));
    }
    else {
      // Templates on the live mode the templates are compiled into JS file.
      $output = '';
    }

    return $output;
  }

  public function renderAll() {
    return implode("\n", array(
      $this->renderCSS(),
      $this->renderJS(),
      $this->renderTpl(),
    ));
  }

}
