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
				$('#myModal').modal('hide');
				$('.call-out').slideUp();
				$('.thanks').slideDown();
				$('.maker-added .image').append( post_obj.email ).addClass('pull-left');
				$('.maker-added .media-heading').prepend( post_obj.post_title );
				$('.maker-added .media-heading small').append( ' ' + post_obj.city + ', ' + post_obj.state );
				$('.maker-added .media').append( post_obj.formatted_content );
			}
		});
	});

});