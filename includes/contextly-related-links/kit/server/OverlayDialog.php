<?php

class ContextlyKitOverlayDialog extends ContextlyKitBase {

  /**
   * @var string
   */
  protected $type;

  /**
   * @param ContextlyKit $kit
   * @param string $type
   */
  function __construct($kit, $type) {
    parent::__construct($kit);

    $this->type = $type;
  }

  function render() {
    // Get the assets list.
    $assets = $this->kit->newAssetsList();
    $this->kit->newAssetsManager()
      ->extractPackageAssets('overlay-dialogs/' . $this->type, $assets);
    $head = $this->kit->newAssetsHtmlRenderer($assets)
      ->renderAll();

    // Render the dialog.
    return $this->kit->newServerTemplate('dialog')
      ->render(array(
        'language' => 'en',
        'head' => $head,
      ));
  }

}
