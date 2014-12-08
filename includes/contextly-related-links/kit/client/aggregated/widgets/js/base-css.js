/**
 * Base custom CSS builder.
 */
Contextly.widget.CssCustomBuilder = Contextly.createClass({

  statics: /** @lends Contextly.widget.CssCustomBuilder */ {

    buildCSSRule: function(entry, prefix, property, value) {
      if (!value) {
        return "";
      }
      return entry + " " + prefix + " {" + property + ": " + Contextly.widget.Utils.escape(value) + "}";
    },

    hex2Vals: function(hex) {
      if (hex.charAt(0) == "#") {
        hex = hex.slice(1);
      }
      hex = hex.toUpperCase();
      var hex_alphabets = "0123456789ABCDEF";
      var value = new Array(3);
      var k = 0;
      var int1, int2;

      for (var i = 0; i < 6; i += 2) {
        int1 = hex_alphabets.indexOf(hex.charAt(i));
        int2 = hex_alphabets.indexOf(hex.charAt(i + 1));
        value[k] = (int1 * 16) + int2;
        k++;
      }

      return(value);
    },

    oppositeColorGenerator: function(hexTripletColor) {
      var color = hexTripletColor;
      color = color.substring(1);
      color = parseInt(color, 16);
      color = 0xFFFFFF ^ color;
      color = color.toString(16);
      color = ("000000" + color).slice(-6);
      color = "#" + color;
      return color;
    }

  }

});
