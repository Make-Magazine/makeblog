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

	// $('.fileinput').on('change.bs.fileinput', function(evt) {

	// 	var form = $('contribute-form');

	// 	var data = new FormData( form );
	// 	jQuery.each( $( '.step-image' )[0].files, function( i, file ) {
	// 		data.append( 'file-'+ i, file );
	// 	});

	// 	data.append( 'nonce',			$( '.fileinput .step-image' ).val() );
	// 	// data.append( 'post_parent',		$( '.contribute-form #post_title' ).val() );
	// 	data.append( 'action',			'upload_files' );

	// 	console.log( data );

	// 	$.ajax({
	// 		url: make_gigya.ajax,
	// 		data: data,
	// 		cache: false,
	// 		contentType: false,
	// 		processData: false,
	// 		type: 'POST',
	// 		success: function( data ){
	// 			post_obj = JSON.parse( data );
	// 			console.log( data );
	// 		}
	// 	});

	// });

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

		// Prevent the button from trggering
		e.preventDefault();

		console.log( form );

		var form = $('contribute-form');

		var inputs = $('.contribute-form-steps :input');

		var data = new FormData( form );

		inputs.each(function() {
			data.append( 'this.name', $(this).val());
		});

		console.log( data );

		// $.ajax({
		// 	url: make_gigya.ajax,
		// 	data: data,
		// 	cache: false,
		// 	contentType: false,
		// 	processData: false,
		// 	type: 'POST',
		// 	success: function( data ){
		// 		post_obj = JSON.parse( data );
		// 		console.log( data );
		// 	}
		// });

	});

});