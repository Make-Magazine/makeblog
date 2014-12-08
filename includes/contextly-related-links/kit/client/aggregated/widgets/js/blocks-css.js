/**
 * @class
 * @extends Contextly.widget.CssCustomBuilder
 */
Contextly.widget.BlocksCssCustomBuilder = Contextly.createClass({

  extend: Contextly.widget.CssCustomBuilder,

  statics: /** @lends Contextly.widget.BlocksCssCustomBuilder */ {

    buildCSS: function(entry, settings) {
      var css_code = "";

      if (settings.css_code) {
        css_code += Contextly.widget.Utils.escape(settings.css_code);
      }

      if (settings.font_family) {
        css_code += this.buildCSSRule(entry, ".ctx-content-block .ctx-link-title p", "font-family", settings.font_family);
      }
      if (settings.font_size) {
        css_code += this.buildCSSRule(entry, ".ctx-content-block .ctx-link-title p", "font-size", settings.font_size);
      }

      if (settings.color_links) {
        css_code += this.buildCSSRule(entry, ".ctx-content-block .ctx-link-title p", "color", settings.color_links);

        var getOppositeColor = this.oppositeColorGenerator(settings.color_links);
        css_code += this.buildCSSRule(entry, ".ctx-link-title .ctx-video-icon", "background-color", settings.color_links);
        css_code += this.buildCSSRule(entry, ".ctx-link-title .ctx-video-icon:after", "border-left-color", getOppositeColor);
      }

      if (settings.color_background) {
        css_code += this.buildCSSRule(entry, ".ctx-content-block .ctx-links-header", "background-color", settings.color_background);
      }

      if (settings.color_border) {
        var color_border = settings.color_border;
        var rgb = this.hex2Vals(color_border);

        if (rgb.length == 3) {
          var r = rgb[0];
          var g = rgb[1];
          var b = rgb[2];

          css_code += this.buildCSSRule(entry, ".ctx-content-block .ctx-link .ctx-link-title", "background", "rgba(" + r + "," + g + "," + b + ",0.5)");
        }
      }

      return css_code;
    }

  }

});
