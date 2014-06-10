jQuery( document ).ready( function( $ ) {

	// Save all of the tools data.
	$( '.add-maker' ).on( 'click', function( e ) {

		// Prevent the button from triggering
		e.preventDefault();

		$( this ).prop( 'disabled', true );

		// Grab all of the inputs
		var inputs = $( '#day-of-making-form :input' );

		// Grab all of the form data.
		var form = {};
		inputs.each( function() {
			form[ this.name ] = $( this ).val();
		});

		form.action = 'add_maker';

		console.log( form );

		// Make the ajax request with the form data.
		$.ajax({
			url: contribute.admin_post,
			data: form,
			type: 'POST',
			xhrFields: {
				withCredentials: true
			},
			success: function( data ){
				post_obj = JSON.parse( data );
				console.log( post_obj );
				$('#join').modal('hide');
				$('.call-out').slideUp();
				$('.thanks').slideDown();
				$('.end-page').slideDown();
				$('.list-of-makers').hide();
				$('.maker-added .image').append( post_obj.email ).addClass('pull-left');
				$('.maker-added .media-heading').prepend( post_obj.post_title );
				$('.maker-added .media-heading small').append( ' ' + post_obj.city + ', ' + post_obj.state );
				$('.maker-added .media').append( post_obj.formatted_content );
				if ( post_obj.url ) {
					$('.maker-added .media').append( '<a class="btn btn-mini btn-danger" target="_blank" href="' + post_obj.url + '">Website</a>' );
				}
				if ( post_obj.cats[0].name ) {
					$('.maker-added .media-heading').after( ' <span class="label">' + post_obj.cats[0].name + '</span> ' );
				}
				if ( post_obj.experience ) {
					$('.maker-added .media-heading').after( ' <span class="label">' + post_obj.experience + '</span> ' );
				}
			}
		});
	});

	// Get the city and the state based on the ZIP code.
	// Should we store the Lat/Long while we are at it?
	$( '#zip' ).focusout( function(){

		// Build the URL.
		api_base = 'http://api.zippopotam.us/';
		country = $('#country option:selected').val();
		zip = $( '#zip' ).val();
		url = api_base + country + '/' + zip;

		// Send off the AJAX call.
		$.ajax({
			url: url,
			type: 'GET',
			success: function( location_meta ){
				$('#city').val( location_meta.places[0]['place name'] );
				$('#state').val( location_meta.places[0]['state'] );
				$('.city-state').slideDown();
			}
		});
	});

	$( '#email_address' ).focusout( function() {

		// Get the Email address.
		var email = $( '#email_address' ).val();

		// Create a new image with the src pointing to the user's gravatar
		var gravatar = $('<img>').attr({
			'src'	: 'http://www.gravatar.com/avatar/' + md5( email ),
			'class'	: 'thumbnail'
		});

		// Add this image to the placeholder
		$( '#gravatar-placeholder' ).html( gravatar );
	});

});