jQuery( document ).ready( function( $ ) {

	// Load the nifty file input styling for Bootstrap
	$('.file-inputs').bootstrapFileInput();

	// Let's hide all of the steps.
	$( '.contribute-form-steps, .contribute-form-parts, .contribute-form-tools' ).hide();

	// Init our form validation
	$( '.validate-form' ).parsley();

	// On post creation, we need a way to tell if we are creating a project or post.
	// The below will help us set a variable accessed in the submission of the form.
	var make_contribute_post_type = '';
	$( '.submit-review' ).click( function() {
		make_contribute_post_type = $( this ).data( 'type' );
	});

	// Handle the AJAX for saving the first stage of the post. The rest will be over Backbone.
	$( '#add-post-content' ).submit( function( e ) {

		// Prevent the button from sending the form.
		e.preventDefault();

		// Validate that we our form has passed our preliminary check.
		var check_form = $( this ).parsley( 'validate' );
		if ( ! check_form.validationResult )
			return;

		// Disable the inputs.
		make_contribute_input_disabler( 'contribute-form' );

		// Hide the form
		make_contribute_close_forms();

		// Add the loading bar
		make_contribute_loading_screen();

		if ( make_contribute_post_type === 'projects' ) {
			$( '.contribute-form-steps' ).slideDown();
		}

		// Let's hide this, and bring it back when we have something to put in it.
		$( '.parts-tools').hide();

		// Save the form, pushing the data back.
		tinyMCE.triggerSave();

		// Setup the form.
		var form = $( 'contribute-form' );

		var data = new FormData( form );
		jQuery.each( $( '#file' )[0].files, function( i, file ) {
			// Inject the files
			data.append( 'file-' + i, file );
		});

		// Append all of the other fields.
		data.append( 'post_ID',			$( '.post_ID' ).val() );
		data.append( 'contribute_post',	$( '.contribute-form #contribute_post' ).val() );
		data.append( 'post_title',		$( '.contribute-form #post_title' ).val() );
		data.append( 'user_id',			$( '.contribute-form #user_id' ).val() );
		data.append( 'post_content',	tinyMCE.activeEditor.getContent() );
		data.append( 'cat',				$( '.contribute-form #cat' ).val() );
		data.append( 'post_type',		make_contribute_post_type );
		data.append( 'post_author',		$( '.user_id' ).val() );
		data.append( 'action',			'contribute_post' );

		// Send off the AJAX request.
		$.ajax({
			url: make_gigya.ajax,
			data: data,
			cache: false,
			contentType: false,
			processData: false,
			type: 'POST',
			success: function( data ){
				post_obj = JSON.parse( data );
				make_contribute_post_filler( post_obj );

				if ( make_contribute_post_type === 'projects' ) {
					$( '.post_ID' ).each( function() {
						$( this ).val( post_obj.ID );
					});

					// Allow users to save steps now that we have the post id
					$( 'button.submit-steps' ).removeAttr( 'disabled' );
				} else {
					$( '.content-wrapper' ).append( '<h2>Thanks for submitting your post!</h2><p>We\'ll review your post and contact you shortly.<p>' );
				}

				make_contribute_remove_progress_bar();
			}
		});
	});


	// Save the steps.
	$( '#add-steps' ).submit( function( e ) {

		// Prevent the button from triggering
		e.preventDefault();

		$('.edit-row').slideUp();

		// Validate that we our form has passed our preliminary check.
		var check_form = $( this ).parsley( 'validate' );
		if ( ! check_form.validationResult )
			return;

		// Disable the form inputs
		make_contribute_input_disabler( 'contribute-form-steps' );

		// Hide the steps.
		make_contribute_close_forms();

		// Added this for Cole...
		make_contribute_loading_screen();

		// Display the parts form.
		jQuery( '.contribute-form-parts' ).slideDown();

		// Let's get the steps initialized.
		var form = $( 'contribute-form-steps' );

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
			url: make_gigya.ajax,
			data: data,
			cache: false,
			contentType: false,
			processData: false,
			type: 'POST',
			success: function( response ){
				response = JSON.parse( response );
				// Allow users to save steps now that we have the post id
				$( 'button.submit-parts' ).removeAttr( 'disabled' );
				make_contribute_display_steps( response.post_id );
			}
		});

	});

	// Save the parts data
	$( '.submit-parts' ).on( 'click', function( e ) {

		// Prevent the button from trggering
		e.preventDefault();

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
			url: make_gigya.ajax,
			data: form,
			type: 'POST',
			success: function( data ){
				make_contribute_remove_progress_bar();
				$( '.parts-tools' ).show();
				$( '.parts-pane' ).empty();
				$( '.parts-pane' ).html( data );
				// Allow users to save steps now that we have the post id
				$( 'button.submit-tools' ).removeAttr( 'disabled' );
			}
		});
	});

	// Save all of the tools data.
	$( '.submit-tools' ).on( 'click', function( e ) {

		// Prevent the button from triggering
		e.preventDefault();

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
			url: make_gigya.ajax,
			data: form,
			type: 'POST',
			success: function( data ){
				make_contribute_remove_progress_bar();
				$( '.tools-pane' ).empty();
				$( '.tools-pane' ).html( data );
				$( '#contribute-form-wrapper' ).html( '<div class="row"><div class="span8 offset2"><h2>Thanks for your project submission!</h2><p>We\'ll review your project and contact you shortly</p></div></div>' );
			}
		});
	});

	// Bring back the contribute form so that it can be edited
	$( '.edit-post' ).on( 'click', function( e ) {

		// Prevent the button from triggering
		e.preventDefault();

		// Let's bring the form back...
		$('.contribute-form').slideDown();

		// Disable the inputs.
		make_contribute_input_enabler( 'contribute-form' );

		// Hide the other buttons
		$('.submit-review').hide();

		// Let's bring the form back...
		$('.contribute-form .resubmit').show();

	});

	// Bring back the steps form so that it can be edited
	$( 'body' ).on( 'click', '.edit-steps', function( e ) {

		// Prevent the button from triggering
		e.preventDefault();

		// Let's bring the form back...
		$('.contribute-form-steps').slideDown();

		// Disable the inputs.
		make_contribute_input_enabler( 'contribute-form-steps' );

		jQuery('.edit-row').append(' <button class="btn cancel-edit-steps">Cancel Step Edit</button>');


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
		url: make_gigya.ajax,
		data: form,
		type: 'POST',
		success: function( data ){
			jQuery( '.saving-progress' ).html('');
			jQuery( '.steps-output' ).html( data );
		}
	});

	form.action = '';
	form.action = 'get_steps_list';

	// Make the ajax request with the form data.
	jQuery.ajax({
		url: make_gigya.ajax,
		data: form,
		type: 'POST',
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
	jQuery( '.post-title span' ).html( data.post_title + ' ' );
	jQuery( '.post-content' ).html( data.post_content );
	jQuery( '.post-content' ).append( data.media );
	jQuery( '.form-actions.edit, .edit-post, .submitted-title').show();
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