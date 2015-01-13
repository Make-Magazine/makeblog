/**
 * @class
 * @extends Contextly.widget.CssCustomBuilder
 */
Contextly.widget.FloatCssCustomBuilder = Contextly.createClass({

  extend: Contextly.widget.CssCustomBuilder,

  statics: /** @lends Contextly.widget.FloatCssCustomBuilder */ {

    buildCSS: function(entry, settings) {
      var css_code = "";
      if (settings.css_code) {
        css_code += Contextly.widget.Utils.escape(settings.css_code);
      }

      if (settings.font_family) {
        css_code += this.buildCSSRule(entry, ".ctx-content-float .ctx-link-title p", "font-family", settings.font_family);
      }
      if (settings.font_size) {
        css_code += this.buildCSSRule(entry, ".ctx-content-float .ctx-link-title p", "font-size", settings.font_size);
      }

      if (settings.color_links) {
        css_code += this.buildCSSRule(entry, ".ctx-content-float .ctx-link-title p", "color", settings.color_links);

        var getOppositeColor = this.oppositeColorGenerator(settings.color_links);
        css_code += this.buildCSSRule(entry, ".ctx-link-title .ctx-video-icon", "background-color", settings.color_links);
        css_code += this.buildCSSRule(entry, ".ctx-link-title .ctx-video-icon:after", "border-left-color", getOppositeColor);
      }

      if (settings.color_background) {
        css_code += this.buildCSSRule(entry, ".ctx-content-float .ctx-links-header", "background-color", settings.color_background);
      }

      return css_code;
    }

  }

});
