( function( $ ) {
	'use strict';

	var make_takeover_hook = $( '.waist.takeover' );

	// Handle the Top Banner image upload
	wp.customize( 'make_banner_takeover', function( value ) {
		value.bind( function( val ) {
			make_takeover_hook.find( '.banner > a > img' ).attr( 'src', val );
		});
	});

	// Handle the Featured Post Title
	wp.customize( 'make_featured_post_title', function( value ) {
		value.bind( function( val ) {
			make_takeover_hook.find( '.primary-post h2' ).text( val );
		});
	});

	// Handle the Featured Post Excerpt
	wp.customize( 'make_featured_post_excerpt', function( value ) {
		value.bind( function( val ) {
			make_takeover_hook.find( '.primary-post p' ).text( val );
		});
	});

	// Handle the Top Right Post Title
	wp.customize( 'make_topright_post_title', function( value ) {
		value.bind( function( val ) {
			make_takeover_hook.find( '.second-post h2' ).text( val );
		});
	});

	// Handle the Bottom Right Post Title
	wp.customize( 'make_bottomright_post_title', function( value ) {
		value.bind( function( val ) {
			make_takeover_hook.find( '.third-post h2' ).text( val );
		});
	});

})( jQuery );