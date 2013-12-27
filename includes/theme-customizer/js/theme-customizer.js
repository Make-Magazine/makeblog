( function ( $ ) {
	'use strict';

	wp.customize( 'make_display_header', function( value ) {
		value.bind( function( to ) {
			false === to ? $( '.projects-masthead' ).hide() : $( '.projects-masthead' ).show();
		});
	});

	wp.customize( 'make_color_scheme', function( value ) {
		value.bind( function( to ) {
			if ( 'inverse' === to ) {
				$( 'body' ).css({
					background: '#000',
					color: '#fff'
				});
			} else {
				$( 'body' ).css({
					background: '#fff',
					color: '#000'
				});
			}
		});
	});

	wp.customize( 'make_font', function( value ) {
		value.bind( function( to ) {
			switch( to.toString().toLowerCase() ) {
				case 'times':
					sFont = 'Times New Roman';
					break;

				case 'arial':
					sFont = 'Arial';
					break;

				case 'courier':
					sFont = 'Courier New, Courier';
					break;

				case 'helvetica':
					sFont = 'Helvetica';
					break;

				default:
					sFont = 'Times new Roman';
					break;
			}

			$( 'body' ).css({
				fontFamily: sFont
			});
		});
	});

	wp.customize( 'make_background_image', function( value ) {
		value.bind( function( to ) {
			0 === $.trim( to ).length ? $( 'body' ).css( 'background-image', '' ) : $( 'body' ).css( 'background-image', 'url( ' + to + ')' );
		});
	});
})( jQuery );