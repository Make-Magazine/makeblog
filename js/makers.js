jQuery( document ).ready( function( $ ) {

	// Save all of the tools data.
	$( '.add-maker' ).on( 'click', function( e ) {

		// Prevent the button from triggering
		e.preventDefault();

		if ( ! $("#day-of-making-form").parsley().validate() ) {
			return;
		}

		$( this ).prop( 'disabled', true );

		// Let's get the steps initialized.
		var form = $( 'day-of-making-form' )[0];

		// Grab all of the inputs.
		var the_files = $( '#day-of-making-form :file' );
		var inputs = $( '#day-of-making-form input:not(:file), #day-of-making-form textarea, #day-of-making-form select' );

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
				$('section').hide();
				$('.thanks' ).slideDown();
				$('.activities' ).slideDown();
				$( '.inline li' ).removeClass('active');
				$( '.nav-map' ).addClass('active');
				$('.maker-added .image').append( post_obj.image ).addClass('pull-left');
				$('.maker-added .media-heading').prepend( post_obj.post_title );
				$('.maker-added .media-heading small').append( ' ' + post_obj.city + ', ' + post_obj.state );
				$('.maker-added .media').append( post_obj.formatted_content );
				if ( post_obj.url.length > 0 ) {
					$('.maker-added .media').append( '<a class="" target="_blank" href="' + post_obj.url + '">Website</a>' );
				}
				if ( post_obj.interest ) {
					$('.maker-added .media-heading').after( ' <span class="label">' + post_obj.interest + '</span> ' );
				}
				if ( post_obj.experience ) {
					$('.maker-added .media-heading').after( ' <span class="label">' + post_obj.experience + '</span> ' );
				}

				$('#tweet').modal('show');
				tweeet( post_obj );
			}
		});
	});

	$('#tweet').on('hidden', function () {
		refresh_map();
	});

	function refresh_map() {
		map_holder = '<iframe frameborder="0" src="http://storymaps.esri.com/stories/2014/makerwhere/" width="100%" height="400"></iframe>';
		$('.map-holder').html( map_holder );
	}

	function tweeet( post_obj ){
		iframe = '<iframe frameborder="0" src="http://storymaps.esri.com/stories/2014/makerwhere/" width="100%" height="400"></iframe>';
		button_hashtag = 'NationofMakers';
		text = post_obj.post_content;
		url = 'https://twitter.com/intent/tweet?button_hashtag=' + encodeURIComponent( button_hashtag ) + '&text=' + encodeURIComponent( text + ' ' + post_obj.city + ', ' + post_obj.state );
		link = '<a href="' + url + '" class="twitter-hashtag-button" data-related="make" data-url="http://storymaps.esri.com/stories/2014/makerwhere/">Tweet #MakerMap</a>';
		blurb = "<p>Want to add yourself to the Maker Map? Simply tweet your location and get added!</p>";
		$( '#tweet .modal-body' ).html( blurb + link + iframe );
		twttr.widgets.load();
	}


	$('.linker').on('click', function() {
		$('section').hide();
		section_class = $( this ).data('show');
		$('.' + section_class ).slideDown();
		$( '.inline li' ).removeClass('active');
		$( this ).addClass('active');
		refresh_map();
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

	// Let's bring in some more posts...
	$( 'body' ).on( 'click', '.advance a', function() {

		$( this ).prop( 'disabled', true );

		var form_obj = {};
		form_obj.paged =  $( this ).data('page');
		form_obj.action = 'build_rows';
		form_obj.nonce = $( this ).data('nonce');

		$.ajax({
			url: contribute.admin_post,
			type: 'POST',
			data: form_obj,
			success: function( content ){
				$('.makers-fill').html( content );
			}
		});
	});

	$( '#email_address' ).focusout( function() {

		return;

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

    // Allow links within bootstrap tabs for sharing URL of a particular tab
    var url = document.location.toString();
    if ( url.match( '#' ) ) {
        // $( '.nav-tabs a[href=#' + url.split( '#' )[1] + ']').tab( 'show' ) ;
        $('section').hide();
		// section_class = $( url.split( '#' )[1] ).data('show');
		$('.' + url.split( '#' )[1] ).slideDown();
		refresh_map();
    } else {
		$('.signup').slideDown();
    }

});