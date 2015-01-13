/**
 * Created by andrew on 12/2/14.
 */
Contextly.PageView = Contextly.createClass({

    construct: function ( rest )
    {
        this.entry = null;
        this.error = null;

        if ( rest && rest.entry ) {
            this.entry = rest.entry;
        } else if ( rest.error ) {
            this.error = rest;
        }
    },

    isError: function () {
        return this.error != null;
    },

    display: function () {
        if ( !this.isError() && this.entry ) {
            this.displayWidgets( this.entry.snippets );
            this.displayWidgets( this.entry.sidebars );
            this.displayWidgets( this.entry.auto_sidebars );

            if ( this.entry.update ) {
                this.updatePostAction();
            }
        }
    },

    updatePostAction: function () {
        Contextly.RESTClient.call(
            'postsimport',
            'put',
            {
            },
            function ( response ) {
            }
        );
    },

    displayWidgets: function ( widgets ) {
        if ( widgets && widgets.length ) {
            for ( var idx = 0; idx < widgets.length; idx++ ) {
                var widget_object = Contextly.widget.Factory.getWidget( widgets[ idx ] );
                if ( widget_object ) {
                    widget_object.display();

                    this.afterDisplayWidgetAction( widget_object );
                }
            }
        }
    },

    afterDisplayWidgetAction: function ( snippet ) {

    }

});
