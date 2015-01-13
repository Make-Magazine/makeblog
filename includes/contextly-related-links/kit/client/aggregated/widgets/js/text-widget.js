(function($) {

  /**
   * @class
   * @extends Contextly.widget.Base
   */
  Contextly.widget.TextSnippet = Contextly.createClass( /** @lends Contextly.widget.TextSnippet.prototype */ {

    extend: Contextly.widget.Base,

    getWidgetStyleClass: function() {
      return 'ctx-content-text';
    },

    getWidgetHTML: function() {
      var div = "";

      var sections = this.widget.settings.display_sections;

      if (sections.length == 1) {
        this.addColumnCounterClass("ctx-text-column-one");
      }
      else {
        this.addColumnCounterClass("ctx-text-column-multiple");
      }

      div += "<div class='" + this.getWidgetStyleClass() + " ctx-nodefs'>";
      div += "<div class='ctx-sections-container ctx-clearfix'>";

      var sections = this.widget.settings.display_sections;

      for (var i = 0; i < sections.length; i++ ) {
        var section_name = sections[i];

        if (this.isDisplaySection(section_name)) {
          var section_key = section_name + '_subhead';
          var section_header = this.widget.settings[ section_key ];

          div += "<div class='ctx-section'>";

          div += "<div class='ctx-links-header'><p class='ctx-nodefs'>" + this.escape(section_header) + "</p></div>";

          div += "<div class='ctx-links-content'>" + this.getLinksHTMLOfType(section_name) + "</div>";
          div += "</div>";
        }
      }
      div += "</div>";
      div += "</div>";

      if (this.isDisplayContextlyLogo()) {
        div += "<div class='ctx-branding ctx-clearfix'>";
        div += "<a href='#' id='ctx-branding-link' class='ctx-nodefs'>Powered by</a>";
        div += "</div>";
      }

      return div;
    },

    addColumnCounterClass: function(className) {
      var getModuleId = this.widget_html_id;
      $("#" + getModuleId).addClass(className);
    },

    getLinksHTMLOfType: function(type) {
      var html = "";
      var widget = this.widget;

      if (widget.links && widget.links[ type ]) {
        for (var link_idx in widget.links[ type ]) {
          var link = widget.links[ type ][ link_idx ];

          if (link.id && link.title) {
            html += this.getLinkHTML(link);
          }
        }
      }

      return html;
    },

    getCustomCssCode: function() {
      return Contextly.widget.TextCssCustomBuilder
        .buildCSS('.ctx-module-container', this.getSettings());
    }

  });

})(jQuery);
