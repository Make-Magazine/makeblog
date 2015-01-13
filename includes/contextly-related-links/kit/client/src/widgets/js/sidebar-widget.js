(function($) {

  /**
   * @class
   * @extends Contextly.widget.Base
   */
  Contextly.widget.Sidebar = Contextly.createClass( /** @lends Contextly.widget.Sidebar.prototype */ {

    extend: Contextly.widget.Base,

    construct: function(widget) {
      if (widget) {
        this.widget = widget;
        this.widget_type = Contextly.widget.types.SIDEBAR;
        this.widget_html_id = 'contextly-' + widget.id;
      }
    },

    getWidgetHTML: function() {
      return "<div class='ctx-content-sidebar'><div class='ctx-sb-content'>"
        + this.getLinksHTMLOfType('previous')
        + "</div></div>";
    },

    getLinkATag: function(link, content) {

      return "<a href=\"" +
        this.escape(link.native_url) + "\" title=\"" +
        this.escape(link.title) + "\" class='ctx-clearfix ctx-nodefs ctx-no-images' " +
        this.getEventTrackingHtml(link) + ">" + content + "</a>";
    },

    getLinkHTML: function(link) {
      var html = "<div class='ctx-sb-fotmater'>";

      if (link.thumbnail_url) {

        var image_html = "<img src='" + link.thumbnail_url + "' />";
        var image_href;

        if (link.video) {
          image_href = this.getVideoLinkATag(link, image_html);
        }
        else {
          image_href = this.getLinkATag(link, image_html);
        }

        html += "<div class='ctx-sb-img'>" + image_href + "</div>";
      }

      if (link.video) {
        html += "<div class='ctx-sb-text'><p>" + this.getVideoLinkATag(link, link.title) + "</p></a>";
      }
      else {
        html += "<div class='ctx-sb-text'><p>" + this.getLinkATag(link, link.title) + "</p></a>";
      }

      if (this.widget.settings.display_link_dates && link.publish_date) {
        html += " <span class='link-pub-date'>" + Contextly.widget.Utils.dateTextDiff(link.publish_date) + "</span>";
      }

      html += "</div>";
      html += "</div>";

      return html;
    },

    getLinksHTMLOfType: function(type) {
      var html = "";
      if (this.widget && this.widget.links && this.widget.links[ type ]) {
        for (var link_idx in this.widget.links[ type ]) {
          var link = this.widget.links[ type ][ link_idx ];

          if (link.id && link.title) {
            html += "<div class='ctx-sb-link'>" + this.getLinkHTML(link) + "</div>";
          }
        }
      }

      return html;
    },

    display: function() {
      if ( this.hasWidgetData() && !Contextly.Settings.isAdmin() ) {
        this.show();
      }
    },

    show: function () {
        // Build widget html and display it
        var html = this.getWidgetHTML();
        this.displayHTML(html);

        // Do some sidebar modifications
        this.getDisplayElement().removeClass('ctx-sidebar-container')
            .addClass('ctx-sidebar')
            .addClass('ctx-sidebar-' + this.widget.layout)
            .addClass('ctx-sb-clearfix');

        // Check if we need to add sidebar title and description
        var title = this.widget.name;
        var description = this.widget.description;
        var sidebar_content = this.getDisplayElement().find('.ctx-content-sidebar');

        if (description) {
            sidebar_content.prepend("<div class='ctx-sb-description'><p>" + this.escape(description) + "</p></div>");
        }
        if (title) {
            sidebar_content.prepend("<div class='ctx-sb-title'><p>" + this.escape(title) + "</p></div>");
        }

        this.loadCss('sidebar-css');
        this.setResponsiveFunction();
    },

    getWidgetCSSUrl: function() {
      return Contextly.Settings.getSidebarCssUrl(this.getSettings());
    },

    getCustomCssCode: function() {
      return Contextly.widget.SidebarCssCustomBuilder
        .buildCSS('.ctx-sidebar', this.getSettings());
    },

    setResponsiveFunction: function ()
    {
        var self = this;

        $(window).resize(function() {
            self.runResponsive();
        });

        window.setTimeout(function() {
            self.runResponsive();
        }, 100);
    },

    runResponsive: function ()
    {
        var minWidth = 200;
        var minWidthRatio = 2.7;
        var width = this.getDisplayElementWidth();

        if ( width < minWidth || minWidth * minWidthRatio >= this.getScreenWidth() )
        {
            this.getDisplayElement()
                .addClass( "ctx-sb-clearfix" )
                .addClass( "ctx-sidebar-mobile" )
                .removeClass( "ctx-sidebar-default" );
        }
        else
        {
            this.getDisplayElement()
                .addClass( "ctx-sb-clearfix" )
                .addClass( "ctx-sidebar-default" )
                .removeClass( "ctx-sidebar-mobile" );
        }
    }
  })

})(jQuery);
