<?php

class ContextlyKitServerTemplate extends ContextlyKitBase {

  protected $path;

  function __construct($kit, $name) {
    parent::__construct($kit);

    $this->path = $this->kit->getFolderPath('server', TRUE) . '/templates/' . $name . '.tpl.php';
  }

  function render($vars) {
    extract($vars);
    ob_start();
    require $this->path;
    return ob_get_clean();
  }

}
