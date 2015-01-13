(function($) {

  // Init global namespace.
  Contextly.widget = Contextly.widget || {};

  // Widget types.
  Contextly.widget.types = {
    SNIPPET: 'snippet',
    SIDEBAR: 'sidebar',
    AUTO_SIDEBAR: 'auto-sidebar'
  };

  // Snippet styles.
  Contextly.widget.styles = {
    TEXT: 'default',
    TABS: 'tabs',
    BLOCKS: 'blocks',
    BLOCKS2: 'blocks2',
    FLOAT: 'float'
  };

  // Widget link types.
  Contextly.widget.linkTypes = {
    PREVIOUS: 'previous',
    RECENT: 'recent',
    WEB: 'web',
    INTERESTING: 'interesting',
    CUSTOM: 'custom',
    PROMO: 'sticky'
  };

  // Widget recommendation types.
  Contextly.widget.recommendationTypes = {
    VIDEO: 10,
    PRODUCT: 9,
    COOKIE: 8,
    EVERGREEN: 7,
    OPTIMIZATION: 6
  };

  /**
   * Base class for all widgets.
   *
   * @class
   * @extends Contextly.Proxy
   */
  Contextly.widget.Base = Contextly.createClass( /** @lends Contextly.widget.Base.prototype */ {

    extend: Contextly.Proxy,

    construct: function(widget) {
      this.widget = widget;
      this.widget_type = Contextly.widget.types.SNIPPET;
      this.widget_html_id = 'ctx-module';
    },

    // TODO Replace with template rendering and drop.
    abstracts: [ 'getWidgetHTML' ],

    getDisplayElement: function() {
      return $('#' + this.widget_html_id);
    },

    getDisplayElementWidth: function() {
      return this.getDisplayElement().width();
    },

    getScreenWidth: function () {
        return $(window).width();
    },

    hasWidgetData: function () {
        if ( this.widget && this.widget.links ) {
            var links = this.widget.links;
            for(var prop in links) {
                if (links.hasOwnProperty(prop)) {
                    return true;
                }
            }
        }
        return false;
    },

    // TODO Replace use cases with template and drop.
    displayHTML: function (html) {
      this.getDisplayElement().html(html);
    },

    // TODO Replace use cases with template and drop.
    appendHTML: function(html) {
      this.getDisplayElement().append(html);
    },

    isDisplaySection: function(section) {
      var display_section = $.inArray(section, this.widget.settings.display_sections) != -1;
      var have_to_display = this.widget.links && this.widget.links[ section ] && this.widget.links[ section ].length > 0;

      return display_section && have_to_display;
    },

    display: function() {
      if (this.hasWidgetData()) {
        var widget_html = this.getWidgetHTML();

        this.displayHTML( widget_html );
        this.loadCss('widget-css');

        var settings = this.getSettings();
        if (settings && settings.display_type) {
          this.getDisplayElement().attr('widget-type', settings.display_type);
        }

        this.attachLinksPopups();
      }
      else {
        // Hide content of the snippet placeholder (e.g. Loading...)
        this.getDisplayElement().empty();
      }

      this.setResponsiveFunction();
    },

    attachLinksPopups: function() {
      function onVideoLinkClick(target, e) {
        e.preventDefault();
        target = $(target);
        var videoUrl = getVideoUrl(target);
        var videoTitle = getVideoTitle(target);
        openVideoPopup(videoUrl, videoTitle);

        var contextly_url = getContextlyUrl(target);
        Contextly.MainServerAjaxClient.call(contextly_url);
      }

      function onTweetLinkClick(target, e) {
        e.preventDefault();
        target = $(target);
        var tweetUrl = getVideoUrl(target);
        openTweetPopup(tweetUrl);

        var contextly_url = getContextlyUrl(target);
        Contextly.MainServerAjaxClient.call(contextly_url);
      }

      $("a[rel='ctx-video-dataurl']").click(this.proxy(onVideoLinkClick, true, true));
      $("a[rel='ctx-tweet-dataurl']").click(this.proxy(onTweetLinkClick, true, true));

      function getVideoClass() {
        return "ctx-video-modal";
      }

      function videoOverlay() {
        return "ctx-video-overlay";
      }

      function getCloseClass() {
        return "ctx-video-close";
      }

      function getVideoUrl(getEvent) {
        return getEvent.attr('href');
      }

      function getContextlyUrl(getEvent) {
        return getEvent.attr('contextly-url');
      }

      function getVideoTitle(getEvent) {
        return getEvent.attr('title');
      }

      function openVideoPopup(ctxVideoUrl, videoTitle) {
        $('body').append(createVideoTmp(ctxVideoUrl, videoTitle));
        showVideoPopup();
      }

      function openTweetPopup(ctxVideoUrl) {
        $('body').append(createTweetTmp(ctxVideoUrl));
        showVideoPopup();
      }

      function showVideoPopup() {
        modalFadeIn(getVideoClass());
        modalFadeIn(videoOverlay());
        modalClose();
      }

      function modalFadeIn(elClass) {
        $("." + elClass).fadeIn("fast");
      }

      function modalClose() {
        closeVideoEvent();
        closeModalEsc();
        closeModalBg();
      }

      function createVideoTmp(ctxVideoUrl, videoTitle) {
        var videoLink = formattedYoutubeLink(ctxVideoUrl);
        var videoId = linkFormatter('v', ctxVideoUrl);
        var videoClass = getVideoClass();
        var videotmp = '<div class="' + videoClass + '">' +
          '<iframe src="' + videoLink + '" frameborder="no" class="ctx-video-frame"></iframe>' +
          '<div class="ctx-video-loading" ></div>' +
          '<p class="ctx-video-title">' + videoTitle + '</p>' +
          '<a  href="#" class="ctx-video-close">&#215;</a>' +
          '<div class="ctx-modal-social">' + facebookLike(ctxVideoUrl) + twitterIframe(videoId, videoTitle) + '</div>' +
          '</div>' +
          '<div class="' + videoOverlay() + '" /></div>';
        return videotmp;
      }

      function createTweetTmp(tweetUrl) {
        return '<div class="' + getVideoClass() + '">' +
          '<div class="ctx-video-frame"><blockquote class="twitter-tweet" width="700px"><a href="' + encodeURI(tweetUrl) + '"></a>' +
          '<div class="ctx-video-loading" ></div></blockquote></div>' +
          '<script src="//platform.twitter.com/widgets.js" charset="utf-8"></script>' +
          '<a  href="#" class="ctx-video-close">&#215;</a>' +
          '</div>' +
          '<div class="' + videoOverlay() + '" /></div>';
      }

      function facebookLike(ctxVideoUrl) {
        var script = '<iframe src="//www.facebook.com/plugins/like.php?href=' + ctxVideoUrl +
          '&amp;width=100&amp;layout=button&amp;action=like&amp;show_faces=true&amp;share=true&amp;height=20" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100px; height:20px;" allowTransparency="true"></iframe>';
        return script;
      }

      function twitterIframe(videoId, videoTitle) {
        var script = "<iframe allowtransparency='true' frameborder='0' scrolling='no' src='//platform.twitter.com/widgets/tweet_button.html?text=" + videoTitle + "&url=https%3A%2F%2Fwww.youtube.com%2Fwatch%3Fv%3D" + videoId + "' style='width:98px; height:20px;'></iframe>";
        return script;
      }

      function formattedYoutubeLink(videoUrl) {
        var videoId = linkFormatter('v', videoUrl);
        var fullLink = '//www.youtube.com/embed/' + videoId + "?rel=1&autoplay=1";
        return fullLink;
      }

      function linkFormatter(name, url) {
        name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
        var regexS = "[\\?&]" + name + "=([^&#]*)";
        var regex = new RegExp(regexS);
        var results = regex.exec(url);
        return ( results == null ) ? "" : results[1];
      }

      function closeVideoModal() {
        modalFadeOut(getVideoClass());
        modalFadeOut(videoOverlay());
      }

      function modalFadeOut(elClass) {
        var removeEle = function() {
          $(this).remove();
        };
        $("." + elClass).fadeOut("fast", removeEle);
      }

      function closeVideoEvent() {
        $("." + getCloseClass()).click(function(e) {
          e.preventDefault();
          closeVideoModal();
        });
      }

      function closeModalEsc() {
        $('body').keyup(function(e) {
          if (e.which === 27) {
            closeVideoModal();
          }
        });
      }

      function closeModalBg() {
        $("." + videoOverlay()).click(function(e) {
          closeVideoModal();
        });
      }
    },

    loadCss: function(contextly_id) {
      var css_url = this.getWidgetCSSUrl();

      Contextly.widget.Utils.loadCssFile(css_url, contextly_id);

      // Make needed css rules and load custom widget css
      var custom_css = this.getCustomCssCode();
      if (custom_css) {
        Contextly.widget.Utils.loadCustomCssCode(custom_css, this.getWidgetType() + '-custom');
      }
    },

    getWidgetCSSUrl: function() {
      return Contextly.Settings.getSnippetCssUrl(this.getSettings());
    },

    getCustomCssCode: function() {
      return Contextly.CssCustomBuilder.buildCSS('.ctx-module-container', this.getSettings());
    },

    getImageDimension: function() {
      return this.getImageDimensionFor(this.getSettings().images_type);
    },

    getImageDimensionFor: function(image_type) {
      image_type = image_type.replace('square', '').replace('letter', '');

      var dimensions = image_type.split('x');
      var w = 0;
      var h = 0;

      if (dimensions.length == 2) {
        w = parseInt(dimensions[0]);
        h = parseInt(dimensions[1]);
      }

      return {width: w, height: h};
    },

    getImagesHeight: function() {
      var image_dimension = this.getImageDimension();
      return image_dimension.height;
    },

    getImagesWidth: function() {
      var image_dimension = this.getImageDimension();
      return image_dimension.width;
    },

    getWidget: function() {
      return this.widget;
    },

    getWidgetType: function() {
      return this.widget_type;
    },

    getSettings: function() {
      return this.getWidget().settings;
    },

    getWidgetLinks: function() {
      if (this.getWidget() && this.getWidget().links) {
        return this.getWidget().links;
      }

      return null;
    },

    getModuleType: function() {
      return this.getSettings().display_type;
    },

    getWidgetSectionLinks: function(section) {
      var widget_links = this.getWidgetLinks();

      if (widget_links && widget_links[ section ]) {
        return widget_links[ section ];
      }

      return null;
    },

    getLinkThumbnailUrl: function(link) {
      if (link.thumbnail_url) {
        return link.thumbnail_url;
      }

      return null;
    },

    getWidgetStyleClass: function() {
      return 'default-widget';
    },

    getLinkIcon: function(link) {
      if (link.video) {
        return '<span class="ctx-video-icon"></span>';
      } else if (link.tweet) {
        return '<span class="ctx-tweet-icon"><img src="//abs.twimg.com/favicons/favicon.ico"></span>';
      }
      return '';
    },

    // TODO Check if any use cases left after moving to templates and drop.
    escape: function(text) {
      return Contextly.widget.Utils.escape(text);
    },

    getEventTrackingHtml: function(link) {
      var settings = this.getSettings();
      var html = " onmousedown=\"";

      if (!link.video && !link.tweet) {
          html += "this.href='" + this.escape(link.url) + "';"
      }

      if (settings && settings.utm_enable) {
        html += this.getTrackLinkJSHtml(link);
      }

      html += "\"";

      return html;
    },

    getLinkATag: function(link, content) {
      return "<a href=\"" +
        this.escape(link.native_url) + "\" title=\"" +
        this.escape(link.title) + "\" class='ctx-clearfix ctx-nodefs' " +
        this.getEventTrackingHtml(link) + ">" +
        content + "</a>";
    },

    getModuleLinkIcon: function(link) {
        if (this.getModuleType() == Contextly.widget.styles.TEXT) {
            return this.getLinkIcon(link);
        }
        else {
            return '';
        }
    },

    getVideoLinkATag: function(link, content) {
      return "<a rel=\"ctx-video-dataurl\" class='ctx-clearfix ctx-nodefs' href=\"" +
        this.escape(link.native_url) + "\" title=\"" +
        this.escape(link.title) + "\" contextly-url=\"" + link.url + "\" " +
        this.getEventTrackingHtml(link) + ">" + this.getModuleLinkIcon(link) + " " + content + "</a>";
    },

    getTweetLinkATag: function(link, content) {
      return "<a rel=\"ctx-tweet-dataurl\" class='ctx-clearfix ctx-nodefs' href=\"" +
        this.escape(link.native_url) + "\" title=\"" +
        this.escape(link.title) + "\" contextly-url=\"" + link.url + "\" " +
        this.getEventTrackingHtml(link) + ">" + this.getModuleLinkIcon(link) + " " + content + "</a>";
    },

    getTrackLinkJSHtml: function(link) {
      var widget_type = this.escape(this.getWidgetType());
      var link_type = this.escape(link.type);
      var link_url = this.escape(link.url);
      var link_title = this.escape(link.title);

      return this.escape("Contextly.PageEvents.trackLink('" + widget_type + "','" + link_type + "','" + link_url + "','" + link_title + "');");
    },

    getLinkHTML: function(link) {
      if (link.video) {
        return this.getLinkHTMLVideo(link);
      } else if (link.tweet) {
        return this.getLinkHTMLTweet(link);
      } else {
        return this.getLinkHTMLNormal(link);
      }
    },

    getInnerLinkHTML: function(link) {
      return link.title;
    },

    getLinkHTMLVideo: function(link) {
      return "<div class='ctx-link'>" + this.getVideoLinkATag(link, this.getInnerLinkHTML(link)) + "</div>";
    },

    getLinkHTMLTweet: function(link) {
      return "<div class='ctx-link'>" + this.getTweetLinkATag(link, this.getInnerLinkHTML(link)) + "</div>";
    },

    getLinkHTMLNormal: function(link) {
      return "<div class='ctx-link'><div class='ctx-link-title'>" + this.getLinkATag(link, this.getInnerLinkHTML(link)) + "</div></div>";
    },

    isDisplayContextlyLogo: function() {
      return Contextly.Settings.isBrandingDisplayed();
    },

    setResponsiveFunction: function() {

      function ctxResponsiveResizeHandler() {
        // Blocks2
        var mobileModule = 400;
        var normalModule = 650;
        var wideModule = 790;

        // Float
        var mobileModuleFl = 240;
        var mediumModuleFl = 400;
        var normalModuleFl = 700;

        // Blocks
        var mobileModuleBl = 200;
        var tabletModuleBl = 450;
        var normalModuleBl = 650;
        var wideModuleBl = 790;

        // Text
        var mobileModuleTx = 450;

        function getBlocks2Width() {
          var width = $(".ctx-content-block2").width();
          return width;
        }

        function getFloatWidth() {
          var width = $(".ctx-content-float").width();
          return width;
        }

        function getTextWidth() {
          var width = $(".ctx-content-text").width();
          return width;
        }

        function getScreenWidth() {
          var getwidth = $(window).width();
          return getwidth;
        }

        function getWidgetType() {
          var widgetType = $("#ctx-module").attr("widget-type");
          return widgetType;
        }

        function extraLinksAction(linkNumberArray, linkCondition) {

          if (linkCondition == "show") {
            var dispCond = "block";
            var visCond = "visible";
          }
          else if (linkCondition == "hide") {
            var dispCond = "none";
            var visCond = "hidden";
          }

          for ( var i = 0; i < linkNumberArray.length; i++ ) {
            var link_pos = linkNumberArray[i];
            $(".ctx-link-additional-" + link_pos).css("display", dispCond).css("visibility", visCond);
          }
        }

        function respClassChanger(respClass, baseClass) {
          $("." + baseClass).attr("class", baseClass + " ctx-nodefs " + respClass);
        }

        // Blocks
        if (getWidgetType() == 'blocks') {
          if (getBlocksWidth() < mobileModuleBl) {
            respClassChanger("ctx-module-mobile", "ctx-content-block");
            extraLinksAction([5, 6], "hide");
          }
          else if (getBlocksWidth() <= tabletModuleBl && getBlocksWidth() >= mobileModuleBl) {
            respClassChanger("ctx-module-tablet", "ctx-content-block");
            extraLinksAction([5, 6], "hide");
          }
          else if (getBlocksWidth() <= normalModuleBl && getBlocksWidth() >= tabletModuleBl) {
            extraLinksAction([5, 6], "hide");
            respClassChanger("ctx-module-default", "ctx-content-block");
          }
          else if (getBlocksWidth() > normalModuleBl && getBlocksWidth() <= wideModuleBl) {
            respClassChanger("ctx-module-sec5", "ctx-content-block");
            extraLinksAction([6], "hide");
            extraLinksAction([5], "show");
          }
          else if (getBlocksWidth() > wideModuleBl) {
            respClassChanger("ctx-module-sec6", "ctx-content-block");
            extraLinksAction([5, 6], "show");
          }
        }

        // Blocks2
        if (getWidgetType() == 'blocks2') {
          if (getBlocks2Width() < mobileModule) {
            extraLinksAction([5, 6], "hide");
            respClassChanger("ctx-module-mobile", "ctx-content-block2");
          }
          else if (getBlocks2Width() <= normalModule && getBlocks2Width() >= mobileModule) {
            extraLinksAction([5, 6], "hide");
            respClassChanger("ctx-module-default", "ctx-content-block2");
          }
          else if (getBlocks2Width() > normalModule && getBlocks2Width() <= wideModule) {
            extraLinksAction([6], "hide");
            extraLinksAction([5], "show");
            respClassChanger("ctx-module-sec5", "ctx-content-block2");
          }
          else if (getBlocks2Width() > wideModule) {
            respClassChanger("ctx-module-sec6", "ctx-content-block2");
            extraLinksAction([5, 6], "show");
          }
        }

        // Float
        if (getWidgetType() == 'float') {
          if (getFloatWidth() < mobileModuleFl) {
            extraLinksAction([4, 5, 6], "hide");
            respClassChanger("ctx-module-mobile", "ctx-content-float");
          }
          else if (getFloatWidth() <= mediumModuleFl && getFloatWidth() >= mobileModuleFl) {
            extraLinksAction([4, 5, 6], "hide");
            respClassChanger("ctx-module-medium", "ctx-content-float");
          }
          else if (getFloatWidth() > mediumModuleFl && getFloatWidth() <= normalModuleFl) {
            extraLinksAction([4, 5, 6], "hide");
            respClassChanger("ctx-module-normal", "ctx-content-float");
          }
          else if (getFloatWidth() > normalModuleFl) {
            extraLinksAction([5, 6], "hide");
            extraLinksAction([4], "show");
            respClassChanger("ctx-module-wide", "ctx-content-float");
          }
        }

        // Text
        if (getTextWidth() < mobileModuleTx) {
          respClassChanger("ctx-module-mobile", "ctx-content-text");
        }
        else if (getTextWidth() >= mobileModuleTx) {
          respClassChanger("ctx-module-default", "ctx-content-text");
        }
      }

      var slideMinHeightBl = 54;

      function getBlocksWidth() {
        var width = $(".ctx-content-block").width();
        return width;
      }

      function getSliderContentBl(classname) {
        return $(".ctx-link .ctx-link-title");
      }

      if (getBlocksWidth() >= 450) {
        getSliderContentBl().css("height", slideMinHeightBl);

        $('.ctx-links-content .ctx-link a').hover(
          function() {
            $(this).addClass('ctx-blocks-slider');
            var getTextHeight = $(".ctx-blocks-slider .ctx-link-title p").height();
            if (getTextHeight > 59) {
              $(".ctx-blocks-slider .ctx-link-title").stop(true, true).animate({
                height: getTextHeight + 10
              }, 200);
            }
          },
          function() {
            $(".ctx-blocks-slider .ctx-link-title").stop(true, true).animate({
              height: slideMinHeightBl
            }, 200);
            $(this).removeClass('ctx-blocks-slider');
          }
        )
      }

      function getDocument() {
        var wdocument = $(window);
        return wdocument;
      }

      function getBrdPopup() {
        var getpopup = $(".ctx-show-popup");
        return getpopup;
      }

      function getBrdOnlyPopup() {
        var getpopup = $("#ctx-branding-content");
        return getpopup;
      }

      function showBrdPopup() {
        getBrdPopup().fadeIn("fast");
      }

      function closeBrdPopup() {
        getBrdPopup().fadeOut("fast", function() {
          $(this).remove();
        });
      }

      /* Branding Popup */
      $("#ctx-branding-link").click(function(event) {
        event.preventDefault();
        $("body").append(getBrandingHtml());
        showBrdPopup();

        $("#ctx-brd-close").click(function(event) {
          event.preventDefault();
          closeBrdPopup();
        });

        getDocument().mouseup(function(e) {
          if (!getBrdOnlyPopup().is(e.target) && getBrdOnlyPopup().has(e.target).length == 0) {
            closeBrdPopup();
          }
        });

        getDocument().keyup(function(e) {
          if (e.keyCode == 27) {
            closeBrdPopup()
          }
        });
      });

      function getBrandingHtml() {
        var content = '<div class="ctx-brd-overlay ctx-show-popup" style="display:none"></div>';
        content += '<div id="ctx-branding-content" class="ctx-show-popup" style="display:none">';
        content += '<div id="ctx-brd-modal">';
        content += '<div id="ctx-brd-left-content">';
        content += '<div id="ctx-brd-logo"></div>';
        content += '<div id="ctx-brd-text-head"></div>';
        content += '<div id="ctx-brd-text"><p>Contextly recommends interesting and related stories using a unique combination of algorithms and editorial choices.<br><br>Publishers or advertisers who would like to learn more about Contextly can contact us&nbsp;<a href="http://contextly.com/sign-up/publishers/" target="_blank">here</a>.<br><br>We respect <a href="http://contextly.com/privacy/" target="_blank">readers&#8217; privacy </a>.&nbsp;</p></div>';
        content += '</div>';
        content += '<div id="ctx-brd-right-content"></div>';
        content += '</div>';
        content += '<a href="#" id="ctx-brd-close">X</a>';
        content += '</div>';

        return content;
      }

      ctxResponsiveResizeHandler();

      $(window).resize(function() {
        ctxResponsiveResizeHandler();
      });

      var documentLoadInterval = null;
      var documentLoadCheckCount = 0;

      documentLoadInterval = self.setInterval(function() {
        documentLoadCheckCount++;

        ctxResponsiveResizeHandler();

        if (documentLoadCheckCount > 5) {
          clearInterval(documentLoadInterval);
        }
      }, 500);
    }

  });

})(jQuery);
