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
		$( '.contribute-form' ).slideUp();

		// Added this for Cole... - Cole appreciates it.
		make_contribute_loading_screen( '.post-content' );

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

		// Append all of the other field.s
		data.append( 'contribute_post',	$( '.contribute-form #contribute_post' ).val() );
		data.append( 'post_title',		$( '.contribute-form #post_title' ).val() );
		data.append( 'user_id',			$( '.contribute-form #user_id' ).val() );
		data.append( 'post_content',	$( '.submit-review[clicked="true"]').val() );
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
				$( '.contribute-form-steps' ).slideDown();
				$( '.post_ID' ).each( function() {
					$( this ).val( post_obj.ID );
				});
			}
		});
	});


	// Save all of the tools data.
	$( '.submit-tools' ).on( 'click', function( e ) {

		// Prevent the button from triggering
		e.preventDefault();

		// Grab all of the inputs
		var inputs = $( '.contribute-form-parts :input' );

		// Grab all of the form data.
		var form = {};
		inputs.each( function() {
			form[ this.name ] = $( this ).val();
		});

		form.action = 'add_tools';

		console.log( form );

		// Make the ajax request with the form data.
		$.ajax({
			url: make_gigya.ajax,
			data: form,
			type: 'POST',
			success: function( data ){
				tools_obj = JSON.parse( data );
				console.log( tools_obj );
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
		$( '.contribute-form-parts' ).slideUp();

		// Add the loading bar.
		make_contribute_loading_screen( 'steps-progress' );

		// Let's start gathering values.
		var inputs = $( '.contribute-form-parts :input' );

		// Create the form array.
		var form = {};
		inputs.each( function() {
			form[ this.name ] = $( this ).val();
		});

		// Add the action here.
		form.action = 'add_parts';

		// Check the form
		console.log( form );

		// Make the ajax request with the form data.
		$.ajax({
			url: make_gigya.ajax,
			data: form,
			type: 'POST',
			success: function( data ){
				$( '.parts-tools' ).show();
				$( '.parts-pane' ).html( data );
				$( '.contribute-form-tools' ).slideDown();
			}
		});

	});

	//////////////////////
	// Save the steps.
	$( '.submit-steps' ).on( 'click', function( e ) {

		// Prevent the button from trggering
		e.preventDefault();

		// Disable the form inputs
		make_contribute_input_disabler( 'contribute-form-steps' );

		// Hide the steps.
		$( '.contribute-form-steps' ).slideUp();

		// Added this for Cole...
		make_contribute_loading_screen( '.steps-progress' );

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
				console.log( response );
				$( '.contribute-form-steps' ).slideUp();
				make_contribute_display_steps( response.post_id );
			}
		});

	});

	// Grab the steps.
	function make_contribute_display_steps( post_id ) {

		var inputs = $( '.contribute-form-get-steps :input' );

		var form = {
			action : 'get_steps',
			post_ID: post_id,
		};

		inputs.each( function() {
			form[ this.name ] = $( this ).val();
		});

		console.log( form );

		// Make the ajax request with the form data.
		$.ajax({
			url: make_gigya.ajax,
			data: form,
			type: 'POST',
			success: function( data ){
				$( '.steps-progress' ).html('');
				$( '.steps-output' ).html( data );
			}
		});

		form.action = '';
		form.action = 'get_steps_list';

		console.log( form );

		// Make the ajax request with the form data.
		$.ajax({
			url: make_gigya.ajax,
			data: form,
			type: 'POST',
			success: function( data ){
				// Output the steps.
				$( '.steps-list-output' ).html( data );
				// Display the parts form.
				$( '.contribute-form-parts' ).slideDown();
			}
		});

	}

});

//////////////////////
// Take the saved data, and display it on the page.
function make_contribute_post_filler( data ) {
	jQuery( '.post-title' ).html( data.post_title );
	jQuery( '.post-content' ).html( data.post_content );
}

//////////////////////
// Disable inputs
function make_contribute_input_disabler( form ) {
	// Grab the inputs
	var inputs = jQuery( '.' + form + ' :input' );

	// Disable them all.
	inputs.each( function() {
		jQuery( this ).prop( 'disabled', true );
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
function make_contribute_loading_screen( selector ) {
	jQuery( '.post-holder' ).fadeIn();

	var time = 1500;
	var text = [
		'', // Pass an empty variable here as our random number goes from 1-10 and 0 will never be called
		'Adjusting tension bolts',
		'Calculating feeds & speeds',
		'Preheating print gun',
		'Zeroing out CNC Machine...',
		'Waiting for glue to dry',
		'Energizing primary coil...',
		'Reticulating splines',
		'Rendering mesh',
		'Slicing object layer',
		'Doing science'
	];
	// Randomly get our text on each call (does it 1 - 10)
	var index = Math.floor( ( Math.random() * 10 ) + 1 );

	jQuery( selector ).html( '<h3 class="loading-text" style="text-align:center">' + text[ index ] + '</h3><div class="progress progress-striped active"><div class="bar" style="width: 100%;"></div></div>' );

	// Change the loading text every 5 seconds
	var interval_id = setInterval( function() {
		// Reset the Index on each new interval
		index = Math.floor( ( Math.random() * 10 ) + 1 );

		// Only run as long as the loading text is present
		if ( jQuery( '.loading-text' ).length === 1 ) {
			jQuery( '.post-content' ).find( '.loading-text' ).text(  text[ index ] + '...' );
		} else {
			clearInterval( interval_id );
		}
	}, time );
}