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
			success: function( data ){
				post_obj = JSON.parse( data );
				console.log( data );
			}
		});
	});

});