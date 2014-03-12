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

		// Prevent the button from trggering
		e.preventDefault();

		// Let's get the steps initialized.
		var form = $('contribute-form-steps');

		// Grab all of the inputs.
		var inputs = $('.contribute-form-steps :input');

		// New FormData
		var data = new FormData( form );

		// Setup the form object, just kinda playing with this as a source of data.
		var form_obj = {};

		// Add the add_steps action to the object.
		form_obj['action'] = 'add_steps';

		// Loop through all of the inputs, add the to the form_object, and then to the data object.
		inputs.each(function() {
			form_obj[this.name] = $(this).val();
			data.append( this.name, $(this).val() );
		});

		// Append the action to the data object.
		data.append( 'action', 'add_steps' );

		// Spit some stuff out so that we can see it.
		console.log( form_obj );
		console.log( data );

		// Ajax request.
		$.ajax({
			url: make_gigya.ajax,
			data: data,
			cache: false,
			contentType: false,
			processData: false,
			type: 'POST',
			success: function( response ){
				post_obj = JSON.parse( response );
				console.log( response );
			}
		});

	});

});