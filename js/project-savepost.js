jQuery(document).ready(function($) {
	// Let's stop any room for errors. Notify when the user is navigating away from the page.
	// This is apart of an effort to stop the loss of post meta data
	$( '#save-post, #publish, delete-action a' ).on( 'click', function() {
		window.btn_clicked = true;
	});
	$( window ).on( 'beforeunload', function() {
		if( ! window.btn_clicked )
			return 'You have unsaved changes.';
	});

	// Let's further stop more errors and data loss from happening.
	// Our editors, 90% of the time, neck deep editing post meta which can get lengthy and keeps them far down the page.
	// If internet is lost, WordPress adds a warning to the top of the page. However, our editors miss it.
	// Let's add a little warning that displays that internet is lost that is seen no matter where you are.
	$(document).on('heartbeat-connection-lost.autosave', function( e, error, status ) {
		// Autosave errored out, or the status reported is returning a 503
		if ( 'timeout' === error || 503 == status ) {
			$('body').append('<div id="connection-lost" style="position:fixed;bottom:0;width:100%;padding:10px;background:#f2dede;color:#b94a48;border-color:#eed3d7;z-index:999;text-align:center"><span class="spinner"></span> <strong>Connection lost.</strong> Saving has been disabled until you’re reconnected.	We’re backing up this post in your browser, just in case.</div>').fadeIn('fast');
		}
	}).on('heartbeat-connection-restored.autosave', function() {
		$('#connection-lost').fadeOut('fast').remove();
	});


	/**
	 * Handles auto saving of the post meta for projects
	 */
	// setInterval( function() {
	// 	var post = $( '#post ').serialize();
		
	// 	$.ajax({
	// 		type: 'POST',
	// 		dataType: 'json',
	// 		url: ajaxurl,
	// 		data: {
	// 			'action' : 'projects_save_step_manager',
	// 			'post'   : post
	// 		},
	// 		success: function(result) {
	// 			console.log('DONE');
	// 		}
	// 	});
	// }, 15000);
});