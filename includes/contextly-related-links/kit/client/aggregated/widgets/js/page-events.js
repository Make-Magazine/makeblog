/**
 * @class
 */
Contextly.PageEvents = Contextly.createClass({

  statics: /** @lends Contextly.PageEvents */{

    trackLink: function(widget_type, link_type, link_url, link_title) {
      if (!widget_type || !link_type || !link_url || !link_title) {
        return;
      }

      var category = 'Contextly';
      var action = '';

      if (widget_type === Contextly.widget.types.SIDEBAR) {
          action = 'Sidebar_';
      }
      else {
          action = 'Module_';
      }

      if ( link_type == Contextly.widget.linkTypes.WEB ) {
        action += 'External_';
      } else if ( link_type == Contextly.widget.linkTypes.PREVIOUS || link_type == Contextly.widget.linkTypes.RECENT ) {
        action += 'Related_';
      } else if ( link_type == Contextly.widget.linkTypes.PROMO ) {
        action += 'Promo_';
      } else {
        action += link_type.charAt(0).toUpperCase() + link_type.slice(1) + '_';
      }

      var page_type = 'Post';
      var url_parts = link_url.split('?');
      var url_params = url_parts[1].split(':');
      if (url_params.length >= 3 ) {
        var algorithm_id = url_params[3];
        if (algorithm_id == Contextly.widget.recommendationTypes.PRODUCT) {
          page_type = 'Product';
        }
        else if (algorithm_id == Contextly.widget.recommendationTypes.VIDEO) {
          page_type = 'Video';
        }
      }
      action += page_type;

      var label_limit = 30;
      var label = link_title;

      if (label.length > label_limit) {
        label = label.substr(0, label_limit);
      }

      if (typeof window.pageTracker != 'undefined') {
        pageTracker._trackEvent(category, action, label);
      }
      else if (typeof window._gaq != 'undefined') {
        _gaq.push(['_trackEvent', category, action, label]);
      }
    }
  }

});
