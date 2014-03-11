jQuery( document ).ready( function( $ ) {

	// var myUploader = new plupload.Uploader({
	// 	browse_button: 'browse_file', // id of the browser button
	// 	multipart: true,              // <- this is important because you want to pass other data as well
	// 	url: make_gigya.ajax
	// });

	// myUploader.init();

	// myUploader.bind('FilesAdded', function( up, files ) {
	// 	$('#browse_file').text('Selected: ' + files[0].name);
	// 	// do a console.log(files) to see what file was selected...
	// });

	// // before upload starts, get the value of the other fields
	// // and send them with the file
	// myUploader.bind('BeforeUpload', function( up ) {
	// 	myUploader.settings.multipart_params = {
	//   		action : 		'contribute_post',
	// 		nonce : 		$( '.contribute-form #contribute_post' ).val(),
	// 		title : 		$( '.contribute-form #post_title' ).val(),
	// 		post_content : 	$( '.contribute-form #post_content' ).val(),
	// 		category : 		$( '.contribute-form #cat' ).val(),
	// 	};
	// });

	// // equivalent of the your "success" callback
	// myUploader.bind('FileUploaded', function( up, file, ret ) {
	// 	console.log( ret.response );
	// });

	// // trigger submission when this button is clicked
	// $( '.submit-review' ).on( 'click', function( e ) {
	// 	myUploader.start();
	// 	e.preventDefault();
	// });

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