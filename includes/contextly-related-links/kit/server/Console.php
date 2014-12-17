<?php

use \Symfony\Component\Console\Command\Command;
use \Symfony\Component\Console\Input\InputInterface;
use \Symfony\Component\Console\Input\InputArgument;
use \Symfony\Component\Console\Input\InputOption;
use \Symfony\Component\Console\Output\OutputInterface;

class ContextlyKitConsolePackagerCommand extends Command {

  /**
   * @var ContextlyKit
   */
  protected $kit;

  public function __construct($kit) {
    parent::__construct();

    $this->kit = $kit;
  }

  protected function configure() {
    $this
      ->setName('run')
      ->setDescription('Perform packaging operations on the Kit.')
      ->addArgument(
        'operations',
        InputArgument::IS_ARRAY,
        'Space-separated list of operations: "aggregate-assets", "upload-assets", "build-archives", "upload-archives". Default to perform all of them. Input order is not important.'
      )
      ->addOption(
        'override',
        NULL,
        InputOption::VALUE_NONE,
        'Specify to override existing remote assets and local/remote archives. By default only local aggregated assets are overwritten.'
      )
      ->addOption(
        'build',
        NULL,
        InputOption::VALUE_REQUIRED,
        'Version of the Kit to build.',
        'dev'
      );
  }

  protected function execute(InputInterface $input, OutputInterface $output) {
    $map = array(
      "aggregate-assets" => 'aggregateAssets',
      "upload-assets" => 'uploadAssets',
      "build-archives" => 'buildArchives',
      "upload-archives" => 'uploadArchives',
    );

    $operations = $input->getArgument('operations');
    if (empty($operations)) {
      $operations = array_keys($map);
    }
    else {
      $operations = array_intersect(array_keys($map), $operations);
    }

    $options = array(
      'override' => (bool) $input->getOption('override'),
      'version' => $input->getOption('build'),
    );

    $manager = $this->kit->newPackageManager($options);
    foreach ($operations as $operation) {
      $method = $map[$operation];
      $manager->{$method}();
    }
  }

}
