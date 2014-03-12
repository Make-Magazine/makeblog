// Store our post object in here as we go along.
var post_obj = {};

jQuery( document ).ready( function( $ ) {

	// Handle the AJAX for saving the first stage of the post. The rest will be over Backbone.
	$( '.submit-review' ).on( 'click', function( e ) {

		e.preventDefault();

		var form = $('contribute-form');

		var data = new FormData( form );
		jQuery.each( $( '#file' )[0].files, function( i, file ) {
			data.append( 'file-'+ i, file );
		});

		data.append( 'nonce',			$( '.contribute-form #contribute_post' ).val() );
		data.append( 'post_title',		$( '.contribute-form #post_title' ).val() );
		data.append( 'post_content',	$( '.contribute-form #post_content' ).val() );
		data.append( 'cat',				$( '.contribute-form #cat' ).val() );
		data.append( 'action',			'contribute_post' );

		console.log( data );

		$.ajax({
			url: make_gigya.ajax,
			data: data,
			cache: false,
			contentType: false,
			processData: false,
			type: 'POST',
			success: function( data ){
				post_obj = JSON.parse( data );
				console.log( data );
			}
		});
	});

	$('.fileinput').on('change.bs.fileinput', function(evt) {

		var form = $('contribute-form');

		var data = new FormData( form );
		jQuery.each( $( '.step-image' )[0].files, function( i, file ) {
			data.append( 'file-'+ i, file );
		});

		data.append( 'nonce',			$( '.fileinput .step-image' ).val() );
		// data.append( 'post_parent',		$( '.contribute-form #post_title' ).val() );
		data.append( 'action',			'upload_files' );

		console.log( data );

		$.ajax({
			url: make_gigya.ajax,
			data: data,
			cache: false,
			contentType: false,
			processData: false,
			type: 'POST',
			success: function( data ){
				post_obj = JSON.parse( data );
				console.log( data );
			}
		});

	});

	$( '.upload' ).on( 'click', function( e ) {

		e.preventDefault();

		var form = $('contribute-form');

		var data = new FormData( form );
		jQuery.each( $( '#file' )[0].files, function( i, file ) {
			data.append( 'file-'+ i, file );
		});

		data.append( 'nonce',			$( '.contribute-form #contribute_post' ).val() );
		data.append( 'post_parent',		$( '.contribute-form #post_title' ).val() );
		data.append( 'action',			'upload_files' );

		console.log( data );

		$.ajax({
			url: make_gigya.ajax,
			data: data,
			cache: false,
			contentType: false,
			processData: false,
			type: 'POST',
			success: function( data ){
				post_obj = JSON.parse( data );
				console.log( data );
			}
		});
	});

	$( '.submit-tools' ).on( 'click', function( e ) {

		// Prevent the button from trggering
		e.preventDefault();

		// Grab all of the inputs
		var inputs = $('.contribute-form-parts :input');

		// Grab all of the form data.
		var form = {};
		inputs.each( function() {
			form[this.name] = $(this).val();
		});

		form.action = 'add_tools';

		console.log( form );

		// Make the ajax request with the form data.
		$.ajax({
			url: make_gigya.ajax,
			data: form,
			type: 'POST',
			success: function( data ){
				tools_obj = JSON.parse( data );
				console.log( tools_obj );
			}
		});

	});

	$( '.submit-parts' ).on( 'click', function( e ) {

		// Prevent the button from trggering
		e.preventDefault();

		var inputs = $('.contribute-form-parts :input');

		var form = {};
		inputs.each(function() {
			form[this.name] = $(this).val();
		});

		form.action = 'add_parts';

		console.log( form );

		// Make the ajax request with the form data.
		$.ajax({
			url: make_gigya.ajax,
			data: form,
			type: 'POST',
			success: function( data ){
				parts_obj = JSON.parse( data );
				console.log( parts_obj );
			}
		});

	});

	// Handle the AJAX for saving the first stage of the post. The rest will be over Backbone.
	$( '.submit-steps' ).on( 'click', function( e ) {

		e.preventDefault();

		var form = $('contribute-form-steps');

		var data = new FormData( form );
		jQuery.each( $( '#step-images' )[0].files, function( i, file ) {
			data.append( 'step-images-'+ i, file );
		});

		data.append( 'nonce',			$( '.contribute-form #contribute_post' ).val() );
		data.append( 'post_title',		$( '.contribute-form #post_title' ).val() );
		data.append( 'post_content',	$( '.contribute-form #post_content' ).val() );
		data.append( 'cat',				$( '.contribute-form #cat' ).val() );
		data.append( 'action',			'contribute_post' );

		console.log( data );

		$.ajax({
			url: make_gigya.ajax,
			data: data,
			cache: false,
			contentType: false,
			processData: false,
			type: 'POST',
			success: function( data ){
				post_obj = JSON.parse( data );
				console.log( data );
			}
		});
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
	defaults: {
		step_title: '',
		step_content: 'Describe your step...',
		step_images: []
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
	events: {
		'click .add-step' : 'add_empty_step'
	},

	initialize: function( step ) {
		this.collection = new Contrib.Collections( step );
		this.listenTo( this.collection, 'add', this.add_step_collection );

		this.render();
	},

	// Render each project stored in the collection
	render: function() {
		this.collection.each( function( step ) {
            this.render_step( step );
        }, this );
	},

	// Add a project by creating a project_view and appending the element it render to the parent element
	render_step: function( step ) {
		var Steps = new Contrib.Views.Step({
			model: step
		});

		this.$el.find('.steps-list').append( Steps.render().el );
	},

	add_empty_step: function( e ) {
		e.preventDefault();
		console.log('TACO');
		this.collection.add( new Contrib.Models.Step({}) );
	},


});


// Run when the DOM is ready
jQuery( function()  {
	var list_steps = [
		{ step_title: 'Step 1', step_content: 'CONTENT', step_images: ['http://cl.ly/image/1U3L1v3s3w22/u66_normal.jpg'] },
		// { step_title: 'Step 2', step_content: 'CONTENT 2', step_images: ['http://cl.ly/image/1U3L1v3s3w22/u66_normal.jpg'] },
		// { step_title: 'Step 3', step_content: 'CONTENT 3', step_images: ['http://cl.ly/image/1U3L1v3s3w22/u66_normal.jpg'] }
	];


	// Load the latest projects by default
	new Contrib.Views.StepsList( list_steps );
});