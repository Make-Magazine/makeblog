jQuery( document ).ready( function($) {
	$( '#post' ).submit( function(e) {
		console.log( 'SUBMITTED!' );
		e.preventDefault();
	});
});