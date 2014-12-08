/**
 * Just a placeholder for an actual object provided by CMS.
 *
 * @type {Contextly.BaseSettings}
 */
Contextly.Settings;

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
     * Returns API server URL.
     *
     * @function
     */
    getAPIServerUrl: Contextly.abstractMethod(),

    /**
     * Returns main Contextly server URL.
     *
     * @function
     */
    getMainServerUrl: Contextly.abstractMethod(),

    /**
     * Returns WP plug-in version.
     *
     * @todo Replace with Kit version and drop it.
     *
     * @function
     */
    getPluginVersion: Contextly.abstractMethod(),

    /**
     * @function
     */
    getAppId: Contextly.abstractMethod(),

    /**
     * @function
     */
    isAdmin: Contextly.abstractMethod(),

    /**
     * Returns parsed post data object.
     *
     * @function
     */
    getPostData: Contextly.abstractMethod(),

    /**
     * Returns true on HTTPS protocol.
     */
    isHttps: Contextly.abstractMethod(),

    /**
     * Returns visitor tracking cookie.
     *
     * @function
     */
    getCookieId: Contextly.abstractMethod(),

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

    getPostDataForKey: function(key)
    {
        var data = this.getPostData();
        if ( data !== null && data[key])
        {
            return data[key];
        }

        return null;
    },

    getPostDataForKeyCount: function(key)
    {
        var data = this.getPostDataForKey(key);

        if ( data !== null )
        {
            return data.length;
        }
        return 0;
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

    isBrandingDisplayed: function() {
      return true;
    }

  }

});
