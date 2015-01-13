/**
 * Abstract class that should be extended by the CMS integration.
 *
 * CMS integration should provide actual settings through abstract methods.
 *
 * @class
 */
Contextly.BaseSettings = Contextly.createClass({

  statics: {

    /**
     * Returns main Contextly server URL.
     *
     * @function
     */
    getMainServerUrl: function () {
        if ( this.getMode() == 'dev' ) {
            return "http" + ( this.isHttps() ? 's' : '' ) + "://dev.contextly.com/";
        } else {
            return "http" + ( this.isHttps() ? 's' : '' ) + "://contextly.com/";
        }
    },

    /**
     * Returns API server URL.
     *
     * @function
     */
    getAPIServerUrl: function () {
        if ( this.getMode() == 'dev' ) {
            return "http" + ( this.isHttps() ? 's' : '' ) + "://devrest.contextly.com/";
        } else {
            return "http" + ( this.isHttps() ? 's' : '' ) + "://rest.contextly.com/";
        }
    },

    /**
     * Returns parsed post data object.
     *
     * @function
     */
    getPostData: function () {
        var data = jQuery("meta[name='contextly-page']").attr("content");

        if ( data ) {
            return jQuery.parseJSON(data);
        }

        return null;
    },

    /**
     * Returns visitor tracking cookie.
     *
     * @function
     */
    getCookieId: function() {
        return Contextly.Loader.getCookieId();
    },

    /**
     * Returns URL of the snippet CSS.
     */
    getSnippetCssUrl: function(settings) {
      return this.getCdnCssUrl() + "wp_plugin/" + this.getPluginVersion() + "/css-api/widget/" + settings.display_type + "/template-" + settings.tabs_style + ".css";
    },

    /**
     * Returns URL of the sidebar CSS.
     */
    getSidebarCssUrl: function(settings) {
      return this.getCdnCssUrl() + "wp_plugin/" + this.getPluginVersion() + "/css-api/sidebar/template-" + settings.theme + ".css";
    },

    getPostDataForKey: function(key) {
        var data = this.getPostData();
        if ( data !== null && data[key]) {
            return data[key];
        }

        return null;
    },

    getPostDataForKeyCount: function(key) {
        var data = this.getPostDataForKey(key);

        if ( data !== null ) {
            return data.length;
        }
        return 0;
    },

    getPluginVersion: function () {
        return this.getPostDataForKey('version');
    },

    getAppId: function () {
        return this.getPostDataForKey('app_id');
    },

    getPageId: function() {
      return this.getPostDataForKey('post_id');
    },

    getPostModifiedDate: function() {
      return this.getPostDataForKey('mod_date');
    },

    getPostCreatedDate: function() {
      return this.getPostDataForKey('pub_date');
    },

    getAuthorId: function() {
      return this.getPostDataForKey('author_id');
    },

    getPageUrl: function() {
      return this.getPostDataForKey('url');
    },

    getPostType: function() {
      return this.getPostDataForKey('type');
    },

    getPostCategories: function() {
      return this.getPostDataForKey('categories');
    },

    getPostTags: function() {
      return this.getPostDataForKey('tags');
    },

    getPostCategoriesCount: function() {
      return this.getPostDataForKeyCount('categories');
    },

    getPostTagsCount: function() {
      return this.getPostDataForKeyCount('tags');
    },

    // TODO Switch to Kit CDN.
    getCdnCssUrl: function() {
      if (this.isHttps()) {
        return 'https://c714015.ssl.cf2.rackcdn.com/';
      }
      else {
        return 'http://contextlysitescripts.contextly.com/';
      }
    },

    isAdmin: function () {
      return false;
    },

    isBrandingDisplayed: function() {
      return true;
    },

    isReadyToLoad: function() {
      return true;
    },

    isHttps: function () {
      var https = this.getPostDataForKey('https');
      return  https != null;
    },

    getMode: function () {
      var mode = this.getPostDataForKey('mode');

      if ( mode != null ) {
          return mode;
      }
      return 'live';
    }

  }

});

/**
 * Default settings object, that can be overriden in any CMS
 */
Contextly.Settings = Contextly.createClass({
   extend: Contextly.BaseSettings

});

