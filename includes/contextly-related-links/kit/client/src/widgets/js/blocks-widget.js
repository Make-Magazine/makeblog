(function($) {

  /**
   * @class
   * @extends Contextly.widget.TextSnippet
   */
  Contextly.widget.BlocksSnippet = Contextly.createClass( /** @lends Contextly.widget.BlocksSnippet.prototype */ {

    extend: Contextly.widget.TextSnippet,

    getNumberOfLinksPerSection: function() {
      return 6;
    },

    getLinksHTMLOfType: function(type) {
      var html = "";
      var linkCounter = 0;
      var widget = this.widget;
      var links_limit = this.getNumberOfLinksPerSection();

      if (widget.links && widget.links[ type ]) {
        for (var link_idx in widget.links[ type ]) {
          linkCounter++;
          if (link_idx >= links_limit) {
            break;
          }

          var link = widget.links[ type ][ link_idx ];

          if (link.id && link.title) {
            html += this.getLinkHTML(link, linkCounter);
          }
        }
      }

      return html;
    },

    getWidgetStyleClass: function() {
      return 'ctx-content-block';
    },

    getWidgetHTML: function() {
      var div = "";

      div += "<div class='" + this.getWidgetStyleClass() + " ctx-nodefs'>";

      var sections = this.widget.settings.display_sections;

      div += "<div class='ctx-sections-container ctx-nomar'>";
      for (var i = 0; i < sections.length; i++ ) {
        var section_name = sections[i];

        if (this.isDisplaySection(section_name)) {
          var section_key = section_name + '_subhead';
          var section_header = this.widget.settings[ section_key ];

          div += "<div class='ctx-section ctx-clearfix'>";
          div += "<div class='ctx-links-header ctx-clearfix'><p class='ctx-nodefs'>" + this.escape(section_header) + "</p></div>";

          div += "<div class='ctx-links-content ctx-nodefs ctx-clearfix'>";
          div += this.getLinksHTMLOfType(section_name);
          div += "</div></div>";
        }
      }
      div += "</div>";

      if (this.isDisplayContextlyLogo()) {
        div += "<div class='ctx-branding ctx-clearfix'>";
        div += "<a href='#' id='ctx-branding-link' class='ctx-nodefs'>Powered by</a>";
        div += "</div>";
      }

      div += "</div>";

      return div;
    },

    getLinkHTML: function(link, linkCounter) {
      if (link.video) {
        return this.getLinkHTMLVideo(link, linkCounter);
      } else if (link.tweet) {
        return this.getLinkHTMLTweet(link, linkCounter);
      } else {
        return this.getLinkHTMLNormal(link, linkCounter);
      }
    },

    getInnerLinkHTML: function(link) {
      var inner_html = "<div class='ctx-link-title'>" +
        "<p class='ctx-nodefs'>" + this.getLinkIcon(link) + " " + link.title + "</div>";
      if (this.getLinkThumbnailUrl(link)) {
        inner_html += "<div class='ctx-link-image'><img src='" + link.thumbnail_url + "' class='ctx-nodefs' /></div>";
      }

      return inner_html;
    },

    getLinkHTMLVideo: function(link, linkCounter) {
      var linkClass = "";
      if (linkCounter > 3) {
        linkClass = " ctx-link-additional-" + linkCounter;
      }
      return "<div class='ctx-link" + linkClass + "'>" + this.getVideoLinkATag(link, this.getInnerLinkHTML(link)) + "</div>";
    },

    getLinkHTMLTweet: function(link, linkCounter) {
      var linkClass = "";
      if (linkCounter > 3) {
        linkClass = " ctx-link-additional-" + linkCounter;
      }
      return "<div class='ctx-link" + linkClass + "'>" + this.getTweetLinkATag(link, this.getInnerLinkHTML(link)) + "</div>";
    },

    getLinkHTMLNormal: function(link, linkCounter) {
      var linkClass = "";
      if (linkCounter > 3) {
        linkClass = " ctx-link-additional-" + linkCounter;
      }
      return "<div class='ctx-link" + linkClass + "'>" + this.getLinkATag(link, this.getInnerLinkHTML(link)) + "</div>";
    },

    getCustomCssCode: function() {
      return Contextly.widget.BlocksCssCustomBuilder
        .buildCSS('.ctx-module-container', this.getSettings());
    }

  });

})(jQuery);
