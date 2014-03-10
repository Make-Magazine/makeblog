jQuery( document ).ready( function( $ ) {

	// Set URL hashes for the tab interface
    if ( location.hash !== '' )
		$( 'a[href="' + location.hash + '"]' ).tab( 'show' );

    return $( 'a[data-toggle="tab"]' ).on( 'shown', function( e ) {
		return location.hash = $( e.target ).attr( 'href' ).substr( 1 );
    });
});