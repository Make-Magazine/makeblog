jQuery(document).ready(function(){
	jQuery('#tabs li.steps').click(function() {
		jQuery(this).addClass('current');
		var id = jQuery(this).attr('id');
		jQuery('#steppers div#js-' + id).slideDown().removeClass('hide').addClass('active');
		jQuery('#steppers div:not(#js-' + id + ')').slideUp();
		jQuery('#tabs li:not(#' + id + ')').removeClass('current');
		googletag.pubads().refresh();
		_gaq.push(['_trackPageview']);
		console.log('Pushed a pageview, like a boss.');
		var urlref = location.href;
		PARSELY.beacon.trackPageView({
			url: urlref,
			urlref: urlref,
			js: 1,
			action_name: "Step Clicked"
		});
		return true;
	});
	jQuery('.nexter').click(function() {
		var id = jQuery(this).attr('id');
		jQuery('#steppers div#js-' + id).slideDown().removeClass('hide');
		jQuery('#steppers div:not(#js-' + id + ')').slideUp();
		jQuery(this).addClass('current');
		jQuery('#tabs li#' + id).addClass('current');
		jQuery('#tabs li:not(#' + id + ')').removeClass('current');
		googletag.pubads().refresh();
		_gaq.push(['_trackPageview']);
		console.log('Pushed a pageview, like a boss.');
		var urlref = location.href;
		PARSELY.beacon.trackPageView({
			url: urlref,
			urlref: urlref,
			js: 1,
			action_name: "Next Project Step"
		});
		return true;
	});
	jQuery('.aller').click(function() {
		jQuery('#steppers').children().slideDown();
		jQuery('#steppers .nexter, #steppers .disabled').hide();
		googletag.pubads().refresh();
		_gaq.push(['_trackPageview']);
		console.log('Pushed a pageview, like a boss.');
		var urlref = location.href;
		PARSELY.beacon.trackPageView({
			url: urlref,
			urlref: urlref,
			js: 1,
			action_name: "View all on the projects"
		});
		return true;
	});
	jQuery('.carousel').on('slid', function () {
		jQuery('.slide').find('iframe').each( function(){
			jQuery(this).attr('src', '');
			var url = jQuery(this).attr('data-src');
			jQuery(this).delay(1000).attr('src', url);
		});
		// Find the active slide, and then add an active class to the thumb.
		var index = jQuery(this).find('.active').data('index');
		jQuery('.inner-thumbs .active').removeClass('active');
		jQuery('*[data-slide-to="' + index + '"]').addClass('active');
		if ( ! jQuery( this ).hasClass('huffington')) {
			googletag.pubads().refresh();
		}
		_gaq.push(['_trackPageview']);
		var urlref = location.href;
		PARSELY.beacon.trackPageView({
			url: urlref,
			urlref: urlref,
			js: 1,
			action_name: "Next Slide"
		});
		return true;
	});
	if ( jQuery('.item.active') ) {
		jQuery('.slide').find('iframe').each( function(){
			var url = jQuery(this).attr('src');
			jQuery(this).attr('data-src', url);
		});
	} else {
		jQuery('.slide').find('iframe').each( function(){
			var url = jQuery(this).attr('src');
			jQuery(this).attr('data-src', url);
		});
	}

	jQuery('.thumbs').click(function () {
		var mydata = jQuery(this).data();
		jQuery('#' + mydata.loc + ' .main').attr('src', mydata.src );
	});

	jQuery('.modal').on('show', function () {
		// Check to see if we have shown the video. If so, bail so that we don't embed multiples.
		if ( jQuery(this).attr('data-shown') !== 'true' ) {
			// Get the URL of the video.
			var id = jQuery(this).attr('data-video');
			// Create a link in the modal body.
			jQuery('.modal-body .link', this).append( '<a href="' + id + '" class="oembed">Video Link</a>' );
			// Trigger the jQuery Oembed
			jQuery("a.oembed").oembed();
		}
	});

	jQuery('.modal').on('hide', function () {
		// Add a data-shown="true" to the modal. Will prevent further lookups.
		jQuery(this).attr('data-shown', 'true' );
		// Look for the iframe tag, and clear the video SRC out.
		var video = jQuery('.modal-body', this).find('iframe');
		var url = video.attr('src');
		// Empty the src attribute so we can stop the video when it closes. Then we'll put it back right after.
		video.attr('src', '');
		video.attr('src', url);
	});
	jQuery('.huff .starter').click(function() {
		jQuery( '.huff' ).removeClass('small');
		jQuery( this ).hide();
		jQuery( '.nexus' ).show();

		// Open external links inside gallery into new window
		jQuery( '.scroller a' ).each( function() {
			var link = new RegExp( '/' + window.location.host + '/' );
			if ( ! link.test( this.href ) ) {
				jQuery( this ).click( function( e ) {
					e.preventDefault();
					e.stopPropagation();
					window.open( this.href, '_blank' );
				});
			}
		});

		// Listen for a keydown event and run the proper action.
		jQuery( document ).keydown( function( event ) {
			switch ( event.which ) {
				case 37:
					jQuery( '.carousel' ).carousel( 'prev' );
					jQuery( '.carousel' ).on( 'slid', function() {
						jQuery( this ).carousel( 'pause' );
					});
					break;
				case 39:
					jQuery( '.carousel' ).carousel( 'next' );
					jQuery( '.carousel' ).on( 'slid', function() {
						jQuery( this ).carousel( 'pause' );
					});
					break;
				case 27:
					jQuery( '.huff' ).addClass( 'small' );
					jQuery( '.huff .starter' ).show();

					// Disable our event listener
					jQuery( document ).off( 'keydown' );
					break;
			}
		});

	});
	jQuery( ".huff .close" ).click(function() {
		jQuery('.huff').addClass('small');
		jQuery('.huff .starter').show();

		// Disable our event listener
		jQuery( document ).off( 'keydown' );
	});
	( function( $ ) {
		$( document.body ).on( 'post-load', function () {
			googletag.pubads().refresh();
			_gaq.push(['_trackPageview']);
			} );
	} )( jQuery );

	( function( $ ) {
		$( document.body ).on( 'post-load', function () {
			googletag.pubads().refresh();
			_gaq.push(['_trackPageview']);
			} );
	} )( jQuery );
	
	jQuery('.print-page').on('click', function() {
		window.print();
	});
});