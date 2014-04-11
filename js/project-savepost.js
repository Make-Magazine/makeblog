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


	// We need a way to allow autosaving of post meta, but only when the user actually needs it.
	// Let's setup a timeout feature that will stop autosaving of post meta when the user is idle for 5 minutes or more.
	idle_timer = null;
	idle_state = false;
	idle_wait = 300000; // Set to 5 minutes in milliseconds

	$( 'body' ).bind( 'mousemove keydown scroll', function () {
		clearTimeout( idle_timer );

		if ( idle_state === true ) {
			$( '#connection-lost' ).css({
				'background' : '#dff0d8',
				'color' : '#3c763d',
				'border-color' : '#d6e9c6'
			}).html( 'Welcome Back. Autosave has been resumed.' ).delay( 3000 ).fadeOut( 'fast', function() {
				$(this).remove();
			});
		}

		idle_state = false;

		idle_timer = setTimeout( function() {
			$( 'body' ).append( '<div id="connection-lost" style="position:fixed;bottom:0;width:100%;padding:10px;background:#f2dede;color:#b94a48;border-color:#eed3d7;z-index:999;text-align:center;font-weight:bold;">This page has been idle longer than 5 minutes. Autosave has been paused.</div>' ).fadeIn( 'slow' );
			idle_state = true;
		}, idle_wait );
	});
	$( 'body' ).trigger( 'mousemove' );


	// Handles auto saving of the post meta for projects
	setInterval( function() {
		if ( idle_state === false ) {
			var post = $( '#post ').serialize();
			
			$.ajax({
				type: 'POST',
				dataType: 'json',
				url: ajaxurl,
				data: {
					'action' : 'projects_save_step_manager',
					'post'   : post
				},
				success: function() {
					console.log('success!');
					if ( $( '#connection-lost').length >= 1 ) {
						$( '#connection-lost' ).css({
							'background' : '#dff0d8',
							'color' : '#3c763d',
							'border-color' : '#d6e9c6'
						}).html( 'Autosave successful. We can breath again :)' ).delay( 3000 ).fadeOut( 'fast', function() {
							$(this).remove();
						});
					}
				},
				error: function() {
					if ( $( '#connection-lost' ).length === 0 ) {
						$( 'body' ).append( '<div id="connection-lost" style="position:fixed;bottom:0;width:100%;padding:10px;background:#f2dede;color:#b94a48;border-color:#eed3d7;z-index:999;text-align:center;font-weight:bold;">An error happened when auto saving. Trying again in 1 minute. If this message persists, please check your internet connection.</div>' ).fadeIn( 'slow' );
					}
				}
			});
		}
	}, 60000 ); // Autosave every minute.
});