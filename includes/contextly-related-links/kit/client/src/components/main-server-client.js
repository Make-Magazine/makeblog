/**
 * @class
 */
Contextly.MainServerAjaxClient = Contextly.createClass({

  statics: /** @lends Contextly.MainServerAjaxClient */ {

    getXhr: function() {
      if (!this.xhr) {
        var remote_url = Contextly.Settings.getMainServerUrl() + '/easy_xdm/cors/index.html';

        this.xhr = new easyXDM.Rpc(
          {
            remote: remote_url
          },
          {
            remote: {
              request: {}
            }
          }
        );
      }

      return this.xhr;
    },

    call: function(url, callback) {
        this.getXhr().request(
        {
          url: url.replace('http://', 'https://'),
          method: "POST"
        },
        function(response) {
          if (callback) {
            callback(response);
          }
        }
      );
    }

  }

});
