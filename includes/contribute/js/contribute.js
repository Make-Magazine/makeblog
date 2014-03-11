// Store our post object in here as we go along.
var post_obj = {};

jQuery( document ).ready( function( $ ) {

	// Handle the AJAX for saving the first stage of the post. The rest will be over Backbone.
	$( '.submit-review' ).on( 'click', function( e ) {

		e.preventDefault();

		var form = $('contribute-form');

		var data = new FormData( form );
		jQuery.each( $( '#file' )[0].files, function( i, file ) {
			data.append( 'file-'+ i, file );
		});

		data.append( 'nonce',			$( '.contribute-form #contribute_post' ).val() );
		data.append( 'post_title',		$( '.contribute-form #post_title' ).val() );
		data.append( 'post_content',	$( '.contribute-form #post_content' ).val() );
		data.append( 'cat',				$( '.contribute-form #cat' ).val() );
		data.append( 'action',			'contribute_post' );

		console.log( data );

		$.ajax({
			url: make_gigya.ajax,
			data: data,
			cache: false,
			contentType: false,
			processData: false,
			type: 'POST',
			success: function( data ){
				post_obj = JSON.parse( data );
				console.log( data );
			}
		});
	});

		// Handle the AJAX for saving the first stage of the post. The rest will be over Backbone.
	$( '.submit-tools' ).on( 'click', function( e ) {

		e.preventDefault();

		var $inputs = $('.contribute-form-tools :input');

		var form = {};
		$inputs.each(function() {
			form[this.name] = $(this).val();
		});

		form.action = 'add_tools';

		console.log( form );

		$.ajax({
			url: make_gigya.ajax,
			data: form,
			type: 'POST',
			success: function( data ){
				post_obj = JSON.parse( data );
				console.log( post_obj );
			},
			error: function(blah) {
				console.log( 'Doesn\'t work...' );
			}
		});

	});

});