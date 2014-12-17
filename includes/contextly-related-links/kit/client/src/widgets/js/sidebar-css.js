/**
 * @class
 * @extends Contextly.widget.CssCustomBuilder
 */
Contextly.widget.SidebarCssCustomBuilder = Contextly.createClass({

  extend: Contextly.widget.CssCustomBuilder,

  statics: /** @lends Contextly.widget.SidebarCssCustomBuilder.prototype */ {

    buildCSS: function(entry, settings) {
      var css_code = "";

      if (settings.css_code) {
        var site_custom_code = Contextly.widget.Utils.escape(settings.css_code);
        if (site_custom_code.indexOf(entry) == -1) {
          site_custom_code += entry + site_custom_code;
        }

        css_code += site_custom_code;
      }

      if (settings.font_family) {
        css_code += this.buildCSSRule(entry, ".ctx-sb-link a", "font-family", settings.font_family);
        css_code += this.buildCSSRule(entry, ".ctx-sb-description p", "font-family", settings.font_family);
        css_code += this.buildCSSRule(entry, ".ctx-sb-title p", "font-family", settings.font_family);
      }
      if (settings.font_size) {
        css_code += this.buildCSSRule(entry, ".ctx-sb-link a", "font-size", settings.font_size);
      }

      if (settings.color_background) {
        css_code += this.buildCSSRule(entry, ".ctx-content-sidebar", "background-color", settings.color_background);
      }

      if (settings.color_links) {
        css_code += this.buildCSSRule(entry, ".ctx-sb-link a", "color", settings.color_links);
      }

      if (settings.color_border) {
        css_code += this.buildCSSRule(entry, ".ctx-content-sidebar", "border-color", settings.color_border + " !important;");
      }

      if (settings.title_font_size) {
        css_code += this.buildCSSRule(entry, ".ctx-sb-title p", "font-size", settings.title_font_size);
      }

      if (settings.description_font_size) {
        css_code += this.buildCSSRule(entry, ".ctx-sb-description p", "font-size", settings.description_font_size);
      }

      return css_code;
    }

  }

});
