jQuery( document ).ready( function( $ ) {

	// Save all of the tools data.
	$( '.add-maker' ).on( 'click', function( e ) {

		// Prevent the button from triggering
		e.preventDefault();

		$( this ).prop( 'disabled', true );

		// Let's get the steps initialized.
		var form = $( 'day-of-making-form' )[0];

		// Grab all of the inputs.
		var the_files = $( '#day-of-making-form :file' );
		var inputs = $( '#day-of-making-form input:not(:file), #day-of-making-form textarea' );

		// New FormData
		var data = new FormData( form );

		// Setup the form object, just kinda playing with this as a source of data.
		var form_obj = {};

		// Add the add_steps action to the object.
		form_obj.action = 'add_maker';

		// Append each of the images to the object, giving each a name.
		jQuery.each( the_files, function( i, file_obj ) {
			jQuery.each( file_obj.files, function( key, file ) {
				form_obj['profile-image-' + ( i + 1 )] = file;
				data.append( 'profile-image-' + ( i + 1 ), file );
			});
		});

		// Loop through all of the inputs, with the exception of the file ones, and add the to the form_object, and then to the data object.
		inputs.each( function() {
			form_obj[ this.name ] = $( this ).val();
			data.append( this.name, $( this ).val() );
		});

		// Append the action to the data object.
		data.append( 'action', 'add_maker' );

		// Make the ajax request with the form data.
		$.ajax({
			url: contribute.admin_post,
			data: data,
			cache: false,
			contentType: false,
			processData: false,
			type: 'POST',
			xhrFields: {
				withCredentials: true
			},
			success: function( data ){
				post_obj = JSON.parse( data );
				console.log( post_obj );
				$('#join').modal('hide');
				$('.call-out').slideUp();
				$('.nav-home').removeClass('active');
				$('.nav-map').addClass('active');
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

	$('.nav-map').on('click', function() {
		$('.list-of-makers, .call-out').hide();
		$('.end-page').slideDown();
		$( this ).addClass('active');
		$( '.nav-home' ).removeClass('active');
	})

	$('.nav-home').on('click', function() {
		$('.list-of-makers, .call-out').slideDown();
		$('.end-page').hide();
		$( this ).addClass('active');
		$( '.nav-map' ).removeClass('active');
	})

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
		var email = $( this ).val();

		// Create a new image with the src pointing to the user's gravatar
		var gravatar = $('<img>').attr({
			'src'	: 'http://www.gravatar.com/avatar/' + md5( email ),
			'class'	: 'thumbnail'
		});

		// Add this image to the placeholder
		$( '#gravatar-placeholder' ).html( gravatar );
	});

});