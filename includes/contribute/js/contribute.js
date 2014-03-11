jQuery( document ).ready( function( $ ) {

	$( '.submit-review' ).on( 'click', function( e ) {

		e.preventDefault()

		var form = $('contribute-form');

		var data = new FormData( form );
		jQuery.each( $( '#file' )[0].files, function( i, file ) {
		    data.append( 'file-'+ i, file );
		});

		data.append( 'nonce', 			$( '.contribute-form #contribute_post' ).val() );
		data.append( 'post_title', 		$( '.contribute-form #post_title' ).val() );
		data.append( 'post_content', 	$( '.contribute-form #post_content' ).val() );
		data.append( 'cat', 			$( '.contribute-form #cat' ).val() );
		data.append( 'action', 			'contribute_post' );

		console.log( data );

		$.ajax({
			url: make_gigya.ajax,
			data: data,
			cache: false,
			contentType: false,
			processData: false,
			type: 'POST',
			success: function( data ){
				console.log( data );
			}
		});

		// We'll do something like this...
		// $('.contribute-form').slideUp();

	});

});