
// This file contains common JavaScript that is loaded into every page.
// We want to register and enqueue these scripts with WordPress.

// Load Typekit
try{Typekit.load();}catch(e){}


// Load Google Analytics
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-51157-1']);
_gaq.push(['_trackPageview']);

(function() {
	var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();

// Sadly the Facebook Comment Box does not allow us to change the positioning
jQuery( document ).ready( function( $ ) {
	$( '.comment-list' ).appendTo( '#comments' );

	// Sticky Navigation
	var navigation = jQuery( '.primary-nav-wrap' );
	var position = navigation.position();
	var admin_bar = ( $( 'body.admin-bar' ).length === 0 ) ? "false" : "true";

	jQuery( window ).scroll( function() {
		var window_position;

		// Check if the admin bar is present, if it is, trigger the event at 32px
		if ( admin_bar !== "false" ) {
			window_position = $( window ).scrollTop() + 26;
		} else {
			window_position = $( window ).scrollTop() - 11;
		}

		// Add our sticky class when the navbar is at the top
		if ( window_position >= position.top ) {
			$( '.main-header' ).css( 'height', '65' );
			navigation.addClass( 'sticky' );
		} else {
			$( '.main-header' ).css( 'height', '' );
			navigation.removeClass( 'sticky' );
		}
	});
});

// Track links clicked
jQuery( '.ga-nav a' ).click( function(e) {
	var link_name = $(this).text();
	var menu_name = $(this).parents('ul.nav').attr('id');

	// Track this click with Google, yo.
	_gaq.push(['_trackEvent', menu_name, 'Click', link_name]);
});