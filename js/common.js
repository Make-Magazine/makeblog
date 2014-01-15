
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
});