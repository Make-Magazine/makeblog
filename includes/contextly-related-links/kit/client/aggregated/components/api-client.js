/**
 * @class
 */
Contextly.RESTClient = Contextly.createClass({

    statics: /** @lends Contextly.RESTClient */ {

        getApiRPC: function() {
            if (!this.api_rpc) {
                var remote_url = Contextly.Settings.getAPIServerUrl() + '/easy_xdm/cors/index.html';
                this.api_rpc = new easyXDM.Rpc({
                        remote: remote_url
                    },
                    {
                        remote: {
                            request: {}
                        }
                    });
            }
            return this.api_rpc;
        },

        call: function(api_name, api_method, params, callback) {
            var s = Contextly.Settings;
            var api_url = s.getAPIServerUrl() + api_name + '/' + api_method + '/';

            params = jQuery.extend(params, {
                version: s.getPluginVersion(),
                site_path: s.getAppId(),
                admin: s.isAdmin(),
                page_id: s.getPageId(),
                cookie_id: s.getCookieId(),
                type: s.getPostType(),
                c_date: s.getPostCreatedDate(),
                m_date: s.getPostModifiedDate(),
                c_count: s.getPostCategoriesCount(),
                t_count: s.getPostTagsCount(),
                url: s.getPageUrl()
            });

            var self = this;
            this.getApiRPC().request(
                {
                    url: api_url,
                    method: "POST",
                    data: params
                },
                function(response) {
                    if ( typeof callback !== 'undefined' )
                    {
                        self.restCallback(response, callback)
                    }
                }
            );
        },

        restCallback: function(response, callback) {
            if (!response.data) {
                return;
            }

            try {
                var data = easyXDM.getJSONObject().parse(response.data);
                callback(data);
            } catch (e) {

            }
        }

    }

});
