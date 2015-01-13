/**
 * Created by andrew on 12/2/14.
 */

Contextly.LogPluginEventsType = {
    EMAIL: 'email'
};

Contextly.LogPluginEvents = Contextly.createClass({

    statics: {

        fireEvent: function (type, args)
        {
            // Remove the type of event.
            var args = Array.prototype.slice.call(arguments, 1);

            jQuery(window).triggerHandler(type, args);
        },

        attachEvent: function (type, handler)
        {
            var self = this;

            if ( typeof handler === 'undefined' )
            {
                handler = function(event, message) { self.emailEvent(type, message) };
            }

            jQuery(window).bind( type, handler );
        },

        emailEvent: function( event, message )
        {
            var json_message = null;

            if ( typeof message !== 'undefined' ) {
                json_message = easyXDM.getJSONObject().stringify(message);
            }

            Contextly.RESTClient.call(
                'events',
                'put',
                {
                    event_type: Contextly.LogPluginEventsType.EMAIL,
                    event_name: event,
                    event_page: window.location.href,
                    event_message: json_message
                }
            );
        }
    }

});
