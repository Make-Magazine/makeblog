( function( $ ) {
	'use strict';

	var make_takeover_hook = $( '.waist.takeover' );

	// Handle the Top Banner image upload
	wp.customize( 'make_banner_takeover', function( value ) {
		value.bind( function( val ) {
			make_takeover_hook.find( '.banner > a > img' ).attr( 'src', val );
		});
	});

	// Handle the Top banner image URL
	wp.customize( 'make_banner_url_takeover', function( value ) {
		value.bind( function( val ) {
			make_takeover_hook.find( '.banner > a' ).attr( 'href', val );
		});
	});

	// Handle the Featured Post Image
	wp.customize( 'make_featured_post_image', function( value ) {
		value.bind( function( val ) {
			make_takeover_hook.find( '.primary-post .featured-image' ).attr( 'src', val );
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

	// Handle the Featured Post ID
	wp.customize( 'make_featured_post_id', function( value ) {
		value.bind( function( val ) {
			make_takeover_hook.find( '.primary-post a' ).attr( 'href', val );
		});
	});

})( jQuery );