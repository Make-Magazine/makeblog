(function($) {

  /**
   * Base class for renderers of complex UI with Handlebars templates.
   *
   * @class
   * @extends Contextly.Proxy
   */
  Contextly.UiRenderer = Contextly.createClass( /** @lends Contextly.TemplateRenderer.prototype */ {

    extend: Contextly.Proxy,

    construct: function() {
      this.initElements();
      this.initTemplates();
      this.registerPartials();
    },

    initTemplates: function() {
      // Get template handlers once and keep them.
      this.templateHandlers = this.getTemplateHandlers();
    },

    initElements: function() {
      // Storage of elements of the widget, for quick access.
      this.e = {};
    },

    getTemplate: function(name) {
      if (!Contextly.templates[name]) {
        $.error("Missing template " + name);
      }

      return Contextly.templates[name];
    },

    alterTemplateVariables: function(name, vars) {
      // Do nothing by default.
    },

    /**
     * Renders template and adds result to the container.
     *
     * @param name
     * @param [vars]
     * @param [container]
     * @param [method]
     */
    renderTemplate: function(name, vars, container, method) {
      vars = vars || {};
      this.alterTemplateVariables(name, vars);

      var template = this.getTemplate(name);
      var html = template(vars);

      // Parse HTML using innerHTML property on a temporary element to prevent
      // problems with edge cases like empty or text-only results.
      var tmp = document.createElement('div');
      tmp.innerHTML = html;
      var elements = $(tmp).contents();

      if (typeof container === 'string') {
        if (!this.e[container]) {
          $.error('Container ' + container + ' not found on ' + name + ' template rendering.');
        }

        container = this.e[container];
      }

      if (container) {
        method = method || 'append';
        container[method](elements);
        this.attachTemplateHandlers(name, container, elements);
      }

      return elements;
    },

    getTemplateHandlers: function() {
      return {};
    },

    attachTemplateHandlers: function(name, container, elements) {
      if (!this.templateHandlers[name]) {
        return;
      }

      this.each(this.templateHandlers[name], function(handler) {
        handler.call(this, container, elements);
      });
    },

    getPartials: function() {
      return {};
    },

    registerPartials: function() {
      var map = this.getPartials();
      for (var partialName in map) {
        if (!map[partialName]) {
          continue;
        }

        var template = this.getTemplate(partialName);
        Handlebars.registerPartial(partialName, template);
      }
    }

  });

})(jQuery);