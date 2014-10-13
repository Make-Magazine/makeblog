jQuery( document ).ready( function( $ ) {


	// When clicking our search button, stop it from runnin a search and open the serach field and remove and add some classes
	$( '.search-make input[type="image"].disabled' ).click( function( event ) {

		if ( ! $(this).parent().hasClass( 'open' ) ) {
			event.preventDefault();

			// console.log( $(this) );
			$(this).removeClass( 'disabled' ).parent().addClass( 'open' ).children( '.search-field' ).css( 'display', 'inline-block' ).animate({
				width: '178px'
			});

			$( '.open .search-field' ).focus();
		}
	});

	// Check each li item to see if it contains a ul, if so, add our dropdown class for Bootstrap's menu stuff
	$( '.site-navigation li' ).each( function() {

		if ( $(this).children( 'ul' ).length === 1 ) {

			// Add our class to the parent LI, then a class and data attribute to the A tag and then a class on the UL
			$(this).addClass( 'dropdown' ).children( 'a' ).addClass( 'dropdown-toggle' ).next().addClass( 'dropdown-menu' );

		}
	});


	// Add our popdown slide effect yea?
	$( '.make-popdown .popdown-btn' ).click( function() {

		if ( $(this).hasClass('open') ) {
			$(this).removeClass('open');
		} else {
			$(this).addClass('open');
		}

		$( '.make-popdown .container' ).slideToggle( 'fast' );
	});


	// Track links clicked
	$( '.ga-nav a' ).click( function(e) {
		var link_name = $(this).text();
		var menu_name = $(this).parents('ul.nav').attr('id');

		// Track this click with Google, yo.
		ga('send', 'event', menu_name, 'Click', link_name);
	});

});
