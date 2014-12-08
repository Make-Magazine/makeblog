(function($) {

  // Init global namespace and templates property.
  Contextly = window.Contextly || {};
  Contextly.templates = Contextly.templates || {};

  /**
   * Compiles "dev" mode templates on DOM ready.
   */
  $(function() {
    $('script[type="text/x-contextly-template"][data-template-name]').each(function() {
      var container = $(this);
      var name = container.attr('data-template-name');
      var content = container.html();
      Contextly.templates[name] = Handlebars.compile(content);
    });
  });

})(jQuery);
