jQuery( document ).ready( function( $ ) {

	// Does that cookie exist?
	// console.debug($.cookie("hide-popup"));

	// If the cookie doesn't exist, show the popup 5 seconds after page load.
	if ( ! $.cookie("hide-popup") ) {
		jQuery('.popup').delay(5000).fadeIn();
		// If a user clicks the close button, set a cookie and keep it hidden for a day.
		jQuery('.x').click(function () {
			$.cookie('hide-popup', true, { expires: 1 });
			jQuery('.popup').fadeOut();
		});
		// If the user clicks either of the subscribe links, set a cookie for those too.
		jQuery('.subscribe-link').click(function () {
			$.cookie('clicked-subscribe', true, { expires: 1 });
		});
	};

	// Track links clicked
	$( '.popup a' ).click( function(e) {
		var link_name = $(this).attr('data-link-name');
		var menu_name = $(this).attr('data-tracker');

		// Track this click with Google, yo.
		ga('send', 'event', menu_name, 'Click', link_name);
	});

});
