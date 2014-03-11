jQuery( document ).ready( function( $ ) {

	// Store our post object in here as we go along.
	var post_obj = {};

	// Handle the AJAX for saving the first stage of the post. The rest will be over Backbone.
	$( '.submit-review' ).on( 'click', function( e ) {

		e.preventDefault();

		var form = $('contribute-form');

		var data = new FormData( form );
		jQuery.each( $( '#file' )[0].files, function( i, file ) {
		    data.append( 'file-'+ i, file );
		});

		data.append( 'nonce', 			$( '.contribute-form #contribute_post' ).val() );
		data.append( 'post_title', 		$( '.contribute-form #post_title' ).val() );
		data.append( 'post_content', 	$( '.contribute-form #post_content' ).val() );
		data.append( 'cat', 			$( '.contribute-form #cat' ).val() );
		data.append( 'action', 			'contribute_post' );

		console.log( data );

		$.ajax({
			url: make_gigya.ajax,
			data: data,
			cache: false,
			contentType: false,
			processData: false,
			type: 'POST',
			success: function( data ){
				post_obj = data;
				console.log( data );
			}
		});

		// We'll do something like this...
		// $('.contribute-form').slideUp();

	});

});


// Define our projects object
var Contrib = {
	Models: {},
	Views: {},
	Collections: {}
};


// Models
///////////////////
Contrib.Models.Step = Backbone.Model.extend({

	// Default attributes
	defaults: {
		step_title: '',
		step_content: 'Describe your step...',
		step_images: {}
	}
});

// Collections
///////////////////
Contrib.Collections = Backbone.Collection.extend({
	model: Contrib.Models.Step
});

// Views
///////////////////

// This view will produce a single step
Contrib.Views.Step = Backbone.View.extend({
	tagName: 'div',
	className: 'step',
	template: _.template( jQuery( '#steps-template' ).html() ),

	render: function() {
		this.$el.html( this.template( this.model.toJSON() ) );

		return this;
	}
});

// This view will produce a list of steps
Contrib.Views.StepsList = Backbone.View.extend({
	el: '.steps-wrapper',

	initialize: function( step ) {
		this.collection = new Contrib.Collections( step );

		this.render();
	},

	// Render each project stored in the collection
	render: function() {
		this.collection.each( function( step ) {
            this.add_step( step );
        }, this );
	},

	// Add a project by creating a project_view and appending the element it render to the parent element
	add_step: function( step ) {
		var Steps = new Contrib.Views.Step({
			model: step
		});

		this.$el.append( Steps.render().el );
	}
});


// Run when the DOM is ready
jQuery( function()  {
	var list_steps = [
		{ step_title: 'Step 1', step_content: 'CONTENT', step_images: ['http://cl.ly/image/1U3L1v3s3w22/u66_normal.jpg'] },
		{ step_title: 'Step 2', step_content: 'CONTENT 2', step_images: ['http://cl.ly/image/1U3L1v3s3w22/u66_normal.jpg'] },
		{ step_title: 'Step 3', step_content: 'CONTENT 3', step_images: ['http://cl.ly/image/1U3L1v3s3w22/u66_normal.jpg'] }
	];

	// Load the latest projects by default
	new Contrib.Views.StepsList( list_steps );
});