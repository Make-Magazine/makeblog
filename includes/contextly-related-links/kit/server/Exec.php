<?php

class ContextlyKitExecCommand extends ContextlyKitBase{

  protected $components = array();

  public function __construct($kit, $command = NULL) {
    parent::__construct($kit);

    if (isset($command)) {
      $this->components[] = escapeshellcmd($command);
    }
  }

  public function arg($name, $value) {
    $component = "--$name";
    if (isset($value)) {
      $component .= "=" . escapeshellarg($value);
    }
    $this->components[] = $component;

    return $this;
  }

  public function args($values) {
    foreach ($values as $name => $value) {
      $this->arg($name, $value);
    }

    return $this;
  }

  public function file($filepath) {
    $this->components[] = escapeshellarg($filepath);

    return $this;
  }

  public function errorsOutput() {
    $this->components[] = '2>&1';

    return $this;
  }

  public function exec() {
    exec((string) $this, $output, $code);

    $result = $this->kit->newExecResult($this, $output, $code);
    return $result;
  }

  public function __toString() {
    return implode(' ', $this->components);
  }

}

class ContextlyKitExecResult extends ContextlyKitBase {

  protected $command;
  protected $output;
  protected $code;

  public function __construct($kit, $command, $output, $code) {
    parent::__construct($kit);

    $this->command = $command;
    $this->output = $output;
    $this->code = $code;
  }

  public function isSuccessful() {
    return $this->code === 0;
  }

  public function requireSuccess($message = NULL) {
    if ($this->isSuccessful()) {
      return;
    }

    if (!isset($message)) {
      $message[] = 'Command execution failed.';
    }

    throw $this->kit->newExecException($message, $this->command, $this->code, $this->output);
  }

  public function getOutput() {
    return $this->output;
  }

  public function getCode() {
    return $this->code;
  }

  public function getCommand() {
    return $this->command;
  }

}

class ContextlyKitExecException extends ContextlyKitException {

  protected $command;

  protected $output;

  public function __construct($message = "", $command = NULL, $code = 0, $output = '') {
    $this->command = $command;
    $this->output = $output;

    parent::__construct($message, $code);
  }

  protected function getPrintableDetails() {
    $details = parent::getPrintableDetails();

    if (isset($this->command)) {
      $details['command'] = "Command:\n" . $this->command;
    }

    if (isset($this->output)) {
      $details['command-output'] = "Command output:\n" . $this->output;
    }

    return $details;
  }

}
