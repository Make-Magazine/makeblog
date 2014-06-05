jQuery( document ).ready( function( $ ) {

	var position = $('.progress-footer').position();
	var height = $('.progress-footer').height();

	// This seems totally hacky...
	var total = position.top + ( 2 * height ) + 15;

	var admin = false;

	if ( $('body').hasClass('admin-bar') ) {
		total = total - 32;
		admin = true;
	}

	$( window ).scroll( function( e ) {
		if ( total < $('body').scrollTop() ) {
			$('.progress-footer').addClass('static');
			if ( admin ) {
				$('body').css( 'padding-top', 70 );
			} else {
				$('body').css( 'padding-top', 40 );
			}

		}
		if ( total > $('body').scrollTop() ) {
			$('.progress-footer').removeClass('static');
			$('body').css( 'padding-top', '' );
		}
	});

	// Load the nifty file input styling for Bootstrap
	$('.file-inputs').bootstrapFileInput();

	// Let's hide all of the steps.
	$( '.contribute-form-steps, .contribute-form-parts, .contribute-form-tools' ).hide();

	// Init our form validation
	$( '.validate-form' ).parsley();

	// On post creation, we need a way to tell if we are creating a project or post.
	// The below will help us set a variable accessed in the submission of the form.
	var make_contribute_post_type = '';
	$( '.submit-review' ).click( function( e ) {

		// Prevent the button from sending the form.
		e.preventDefault();

		// Validate that we our form has passed our preliminary check.
		var check_form = $( '#add-post-content' ).parsley().validate();
		if ( ! check_form )
			return;

		// Disable the inputs
		$( this, '.submit-review' ).prop( 'disabled', true );

		// Figure out the type.
		make_contribute_post_type = $( this ).data( 'type' );

		// Submit the form.
		make_submit_contribute_form( $('#add-post-content') );

	});


	// Handle the AJAX for saving the first stage of the post. The rest will be over Backbone.
	function make_submit_contribute_form( the_form ) {

		if ( make_contribute_post_type === 'post' ) {
			$( '.btn-content' ).prop( 'disabled', true ).html('Edit Content');
			$( '.submit-review' ).prop( 'disabled', true );
		}

		console.log('Started');

		// Disable the inputs.
		make_contribute_input_disabler( 'contribute-form' );

		console.log('Inputs disabled');

		// Hide the form
		make_contribute_close_forms();

		console.log('Closed');

		// Add the loading bar
		make_contribute_loading_screen();

		if ( make_contribute_post_type === 'projects' ) {
			$( '.contribute-form-steps' ).slideDown();
		}

		// Let's hide this, and bring it back when we have something to put in it.
		$( '.parts-tools').hide();

		// Setup the form.
		var form = $( 'contribute-form' )[0];

		var data = new FormData( form );

		jQuery.each( $( '#file' )[0].files, function( i, file ) {
			// Inject the files
			data.append( 'file-' + i, file );
		});

		// Save the form, pushing the data back.
		tinyMCE.triggerSave();

		var post_content = '';

		if ( $( '.contribute-form #post_content' ).val.length ) {
			post_content += $( '.contribute-form #post_content' ).val();
		} else {
			post_content += tinyMCE.activeEditor.getContent();
		}


		// Append all of the other fields.
		data.append( 'post_ID',			$( '.post_ID' ).val() );
		data.append( 'contribute_post',	$( '.contribute-form #contribute_post' ).val() );
		data.append( 'post_title',		$( '.contribute-form #post_title' ).val() );
		data.append( 'user_id',			$( '.contribute-form #user_id' ).val() );
		data.append( 'post_content',	post_content );
		data.append( 'cat',				$( '.contribute-form #cat' ).val() );
		data.append( 'post_type',		make_contribute_post_type );
		data.append( 'post_author',		$( '.user_id' ).val() );
		data.append( 'action',			'contribute_post' );

		// Send off the AJAX request.
		$.ajax({
			url: contribute.admin_post,
			data: data,
			cache: false,
			contentType: false,
			processData: false,
			type: 'POST',
			xhrFields: {
				withCredentials: true
			},
			success: function( data ){
				post_obj = JSON.parse( data );
				if ( post_obj.failed ) {

					make_contribute_remove_progress_bar();

					alert( 'Shoot, looks like the ' + post_obj.failed + '\n\r It was probably Jake\'s fault...' );

					console.log( post_obj.post );

					// Let's bring the form back...
					$('.contribute-form').slideDown();

					// Disable the inputs.
					make_contribute_input_enabler( 'contribute-form' );

					// Hide the other buttons
					$('.submit-review').hide();

					// Let's bring the form back...
					$('.contribute-form .resubmit').show();

				} else {

					console.log( post_obj );

					make_contribute_post_filler( post_obj );

					if ( make_contribute_post_type === 'projects' ) {

						// Hide the other buttons
						$('.submit-review').hide();

						// Drop the button group class
						$('.progress-footer .btn-group.show').fadeOut();

						// Show the correct button
						$('.btn-group.hide.save-steps').fadeIn();

						$('.save-steps').show();

						$('.btn-content').addClass('btn-success edit-post').html('Edit Content');

						$('.btn-step').removeAttr('disabled');

						$( '.post_ID' ).each( function() {
							$( this ).val( post_obj.ID );
						});

						// Allow users to save steps now that we have the post id
						$( 'button.submit-steps' ).removeAttr( 'disabled' );
					} else {
						$( '.btn-content').addClass('btn-success').prop( 'disabled', false );
						$( '.submit-review' ).prop( 'disabled', true );
						$( '.thanks' ).show();
					}

					make_contribute_remove_progress_bar();

				}
			}
		});
	}


	$( '.save-steps' ).click( function( e ) {

		// Prevent the button from sending the form.
		e.preventDefault();

		$( this ).prop( 'disabled', true );

		// Validate that we our form has passed our preliminary check.
		var check_form = $( '#add-steps' ).parsley('validate');
		if ( ! check_form )
			return;

		// Submit the form.
		make_submit_steps_form( $('#add-steps') );

	});


	// Save the steps.
	function make_submit_steps_form( steps ) {

		$('.edit-row').slideUp();

		// Disable the form inputs
		make_contribute_input_disabler( 'contribute-form-steps' );

		// Hide the steps.
		make_contribute_close_forms();

		// Added this for Cole...
		make_contribute_loading_screen();

		// Display the parts form.
		jQuery( '.contribute-form-parts' ).slideDown();

		// Let's get the steps initialized.
		var form = $( 'contribute-form-steps' )[0];

		// Grab all of the inputs.
		var the_files = $( '.contribute-form-steps :file' );
		var inputs = $( '.contribute-form-steps input:not(:file), .contribute-form-steps textarea' );

		// New FormData
		var data = new FormData( form );

		// Setup the form object, just kinda playing with this as a source of data.
		var form_obj = {};

		// Add the add_steps action to the object.
		form_obj.action = 'add_steps';

		// Append each of the images to the object, giving each a name.
		jQuery.each( the_files, function( i, file_obj ) {
			jQuery.each( file_obj.files, function( key, file ) {
				form_obj['step-images-' + ( i + 1 )] = file;
				data.append( 'step-images-' + ( i + 1 ), file );
			});
		});

		// Loop through all of the inputs, with the exception of the file ones, and add the to the form_object, and then to the data object.
		inputs.each( function() {
			form_obj[ this.name ] = $( this ).val();
			data.append( this.name, $( this ).val() );
		});

		// Append the action to the data object.
		data.append( 'action', 'add_steps' );

		// Ajax request.
		$.ajax({
			url: contribute.admin_post,
			data: data,
			cache: false,
			contentType: false,
			processData: false,
			type: 'POST',
			xhrFields: {
				withCredentials: true
			},
			success: function( response ){
				response = JSON.parse( response );
				// Allow users to save steps now that we have the post id
				$( 'button.submit-parts' ).removeAttr( 'disabled' );
				make_contribute_display_steps( response.post_id );
				$('.btn-step').html('Edit Steps').addClass('btn-success edit-steps').removeAttr('disabled');
				$('.save-steps').hide();
				$('.save-parts').show();

			}
		});

	}

	// Save the parts data
	$( '.submit-parts' ).on( 'click', function( e ) {

		// Prevent the button from trggering
		e.preventDefault();

		$( this ).prop( 'disabled', true );

		// Disable the inputs.
		make_contribute_input_disabler( 'contribute-form-parts' );

		// Hide the form
		make_contribute_close_forms();

		// Display the tools form.
		jQuery( '.contribute-form-tools' ).slideDown();

		// Add the loading bar.
		make_contribute_loading_screen();

		// Let's start gathering values.
		var inputs = $( '.contribute-form-parts :input' );

		// Create the form array.
		var form = {};
		inputs.each( function() {
			form[ this.name ] = $( this ).val();
		});

		// Add the action here.
		form.action = 'add_parts';

		// Make the ajax request with the form data.
		$.ajax({
			url: contribute.admin_post,
			data: form,
			type: 'POST',
			success: function( data ){
				make_contribute_remove_progress_bar();
				$('.btn-parts').html('Edit Parts').addClass('btn-success edit-parts').removeAttr('disabled');
				$( '.parts-tools' ).show();
				$( '.parts-pane' ).empty();
				$( '.parts-pane' ).html( data );
				// Allow users to save steps now that we have the post id
				$( 'button.submit-tools' ).removeAttr( 'disabled' );
				$('.save-parts').hide();
				$('.save-tools').show();
			}
		});
	});

	// Save all of the tools data.
	$( '.submit-tools' ).on( 'click', function( e ) {

		// Prevent the button from triggering
		e.preventDefault();

		$( this ).prop( 'disabled', true );

		// Disable the inputs.
		make_contribute_input_disabler( 'contribute-form-tools' );

		// Grab all of the inputs
		var inputs = $( '.contribute-form-tools :input' );

		// Hide the form
		make_contribute_close_forms();

		// Add the loading bar.
		make_contribute_loading_screen();

		// Grab all of the form data.
		var form = {};
		inputs.each( function() {
			form[ this.name ] = $( this ).val();
		});

		form.action = 'add_tools';

		// Make the ajax request with the form data.
		$.ajax({
			url: contribute.admin_post,
			data: form,
			type: 'POST',
			success: function( data ){
				make_contribute_remove_progress_bar();
				$('.btn-tools').html('Edit Tools').addClass('btn-success edit-tools').removeAttr('disabled');
				$('.btn-submit').addClass('btn-success').removeAttr('disabled');
				$( '.tools-pane' ).empty();
				$( '.tools-pane' ).html( data );
				$( '.thanks' ).show();
				$( '.save-tools').hide();
			}
		});
	});

	// Bring back the contribute form so that it can be edited
	$( '.btn-content' ).on( 'click', function( e ) {

		// Prevent the button from triggering
		e.preventDefault();

		// Hide the form
		make_contribute_close_forms();

		make_contribute_hide_save_buttons();

		$('.save-content').each( function() {
			$( '.save-content' ).removeAttr('disabled').show();
		});

		// Let's bring the form back...
		$('.contribute-form').slideDown();

		// Disable the inputs.
		make_contribute_input_enabler( 'contribute-form' );

		// Let's bring the form back...
		$('.contribute-form .resubmit').show();

	});

	// Bring back the steps form so that it can be edited
	$( 'body' ).on( 'click', '.btn-parts', function( e ) {

		// Prevent the button from triggering
		e.preventDefault();

		// Hide the form
		make_contribute_close_forms();

		make_contribute_hide_save_buttons();

		$('.save-parts').each( function() {
			$( '.save-parts' ).removeAttr('disabled').show();
		});

		// Let's bring the form back...
		$('.contribute-form-parts').slideDown();

		// Disable the inputs.
		make_contribute_input_enabler( 'contribute-form-parts' );

	});

	// Bring back the steps form so that it can be edited
	$( 'body' ).on( 'click', '.btn-tools', function( e ) {

		// Prevent the button from triggering
		e.preventDefault();

		// Hide the form
		make_contribute_close_forms();

		make_contribute_hide_save_buttons();

		$('.save-tools').each( function() {
			$( '.save-tools' ).removeAttr('disabled').show();
		});

		// Let's bring the form back...
		$('.contribute-form-tools').slideDown();

		// Disable the inputs.
		make_contribute_input_enabler( 'contribute-form-tools' );

	});

	// Bring back the steps form so that it can be edited
	$( 'body' ).on( 'click', '.edit-steps', function( e ) {

		// Prevent the button from triggering
		e.preventDefault();

		// Hide the form
		make_contribute_close_forms();

		make_contribute_hide_save_buttons();

		$('.save-steps').each( function() {
			$( '.save-steps' ).removeAttr('disabled').show();
		});

		// Let's bring the form back...
		$('.contribute-form-steps').slideDown();

		// Disable the inputs.
		make_contribute_input_enabler( 'contribute-form-steps' );

	});

	// Bring back the steps form so that it can be edited
	$( 'body' ).on( 'click', '.cancel-edit-steps', function( e ) {

		// Prevent the button from triggering
		e.preventDefault();

		// Disable the inputs.
		make_contribute_input_disabler( 'contribute-form-steps' );

		// Let's bring the form back...
		$('.contribute-form-steps').slideUp();

	});



});

/**
 * Displays the steps
 * @param  int post_id The post ID we are going to be updating the form fields to
 * @return void
 */
function make_contribute_display_steps( post_id ) {
	var inputs = jQuery( '.contribute-form-get-steps :input' );

	var form = {
		action : 'get_steps',
		post_ID: post_id,
	};

	inputs.each( function() {
		form[ this.name ] = jQuery( this ).val();
	});

	// Make the ajax request with the form data.
	jQuery.ajax({
		url: contribute.admin_post,
		data: form,
		type: 'POST',
		xhrFields: {
			withCredentials: true
		},
		success: function( data ){
			jQuery( '.saving-progress' ).html('');
			jQuery( '.steps-output' ).html( data );
		}
	});

	form.action = '';
	form.action = 'get_steps_list';

	// Make the ajax request with the form data.
	jQuery.ajax({
		url: contribute.admin_post,
		data: form,
		type: 'POST',
		xhrFields: {
			withCredentials: true
		},
		success: function( data ) {
			make_contribute_remove_progress_bar();
			// Output the steps.
			jQuery( '.steps-list-output' ).html( data );
			// Add the edit button to the newly created element.
			jQuery('.steps-list-nav .nav-list').append('<li class="edit-row"><button class="btn edit-steps">Edit Steps</button><li>');
		}
	});

}

/**
 * Take the saved data, and display it on the page.
 * @param  obj data The data being passed back from a post save so we can inject it into the preview window
 * @return void
 */
function make_contribute_post_filler( data ) {
	jQuery( '.post-title span.the-title' ).html( data.post_title + ' ' );
	jQuery( '.post-content' ).html( data.post_content );
	jQuery( '.post-content' ).append( data.media );
	jQuery( '.form-actions.edit, .edit-post, .submitted-title').show();
	jQuery( '.wordpress-edit' ).attr('href', post_obj.edit ).show();
}


/**
 * When the forms get saved, we'll disable all inputs
 * @param  string form The form name we wish to disable
 * @return void
 */
function make_contribute_input_disabler( form ) {
	// Grab the inputs
	var inputs = jQuery( '.' + form + ' :input' );

	// Disable them all.
	inputs.each( function() {
		jQuery( this ).prop( 'disabled', true );
	});
}

/**
 * When the forms get saved, we'll enable all the inputs
 * @param  string form The form name we wish to disable
 * @return void
 */
function make_contribute_input_enabler( form ) {
	// Grab the inputs
	var inputs = jQuery( '.' + form + ' :input' );

	// Disable them all.
	inputs.each( function() {
		jQuery( this ).removeAttr('disabled');
	});
}


/**
 * Allows us to assign a Gigya ID so we can assign the coauthor to the contribute form
 *
 * @since
 */
function make_contribute_add_gigya_id( uid ) {
	jQuery( 'input#user_id[type="hidden"]' ).val( uid );
}


/**
 * Add some nifty loading text that is nerdy and fun
 */
function make_contribute_loading_screen() {
	jQuery( '.post-holder' ).fadeIn();

	var selector = '.saving-progress';
	var time = 1500;
	var text = [
		'Adjusting tension bolts',
		'Calculating feeds & speeds',
		'Preheating print gun',
		'Zeroing out CNC Machine',
		'Waiting for glue to dry',
		'Energizing primary coil',
		'Reticulating splines',
		'Rendering mesh',
		'Slicing object layer',
		'Doing science'
	];

	// Randomly get our text on each call (does it 1 - 10)
	var index = Math.floor( ( Math.random() * text.length ) );

	jQuery( selector ).html( '<h3 class="loading-text" style="text-align:center">Saving and ' + text[ index ] + '...</h3><div class="progress progress-striped active"><div class="bar" style="width: 100%;"></div></div>' );

	// Change the loading text every 5 seconds
	var interval_id = setInterval( function() {
		// Reset the Index on each new interval
		var index = Math.floor( ( Math.random() * text.length ) );

		// Only run as long as the loading text is present
		if ( jQuery( '.loading-text' ).length === 1 ) {
			jQuery( '.loading-text' ).text( 'Saving and ' + text[ index ] + '...' );
		} else {
			clearInterval( interval_id );
		}
	}, time );
}


/**
 * Removes the saving progress bar. Wunderbar!
 * @return voide
 */
function make_contribute_remove_progress_bar() {
	jQuery( '.saving-progress' ).html( '' );
}


/**
 * Any time we save a form, we want to force all form fields to close while saving.
 * @return void
 */
function make_contribute_close_forms() {
	jQuery( '.contribute-form, .contribute-form-tools, .contribute-form-parts, .contribute-form-steps' ).slideUp();
}

/**
 * Drop all save buttons.
 */
function make_contribute_hide_save_buttons() {
	jQuery('.save-buttons .btn-group .btn').hide();
}