jQuery( document ).ready( function( $ ) {

	// Setup Ajax for our screen options
	$( '.submit-review' ).on( 'click', function() {

		// Save our new options to the database
		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: make_gigya.ajax,
			data: {
				'action' : 'blog_dash_screen_opt',
				'nonce' : $( '#blog-dashboard-screen-options input#make-blog-dashboard' ).val(),
				'submission' : $( '#blog-dashboard-screen-options input[name="submission"]:hidden' ).val(),
				'data'   : $( '#blog-dashboard-screen-options input:checked' ).serialize()
			}
		});
	});
});