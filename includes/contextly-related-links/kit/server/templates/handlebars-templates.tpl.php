<?php foreach ($templates as $name => $content) : ?>
  <script data-template-name="<?php print $name; ?>" type="text/x-contextly-template">
    <?php print $content; ?>
  </script>
<?php endforeach; ?>
