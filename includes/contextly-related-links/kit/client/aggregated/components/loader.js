/**
 * Created by andrew on 12/2/14.
 */

Contextly.Loader = Contextly.createClass({

    statics: {

        isCallAvailable: function () {
            return Contextly.Settings.isReadyToLoad();
        },

        load: function () {
            if ( !this.isCallAvailable() ) return;

            this.attachLogEvents();

            var self = this;
            Contextly.RESTClient.call(
                'pagewidgets',
                'get',
                {},
                function ( response ) {
                    self.response = response;
                    self.initCookie( response );

                    self.displayWidgets( response );
                }
            );
        },

        displayWidgets: function ( response ) {
            var pageView = new Contextly.PageView( response );
            pageView.display();
        },

        attachLogEvents: function() {
            Contextly.LogPluginEvents.attachEvent( 'contextlyDataFailed' );
            Contextly.LogPluginEvents.attachEvent( 'contextlySettingsAuthSuccess' );
            Contextly.LogPluginEvents.attachEvent( 'contextlySettingsAuthFailed' );
        },

        getCookieName: function () {
            return "contextly";
        },

        initCookie: function ( rest_response ) {
            if ( rest_response && rest_response.cookie_id )	{
                if ( !this.getCookieId() ) {
                    this.setCookieId( rest_response.cookie_id );
                }
            }
        },

        setCookieId: function ( cookie_id ) {
            Contextly.Cookie.set( this.getCookieName(), {id: cookie_id}, { expires: 365, path: '/' } )
        },

        getCookieId: function () {
            var cookie = Contextly.Cookie.get( this.getCookieName() );
            if ( cookie && cookie.id && cookie.id != 'null' ) {
                return cookie.id;
            }
            return null;
        }

    }

});

Contextly.Loader.Errors = {
    ERROR_FORBIDDEN: 403,
    ERROR_SUSPENDED: 408
};
