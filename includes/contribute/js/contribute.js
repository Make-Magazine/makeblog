jQuery( document ).ready( function( $ ) {

	//////////////////////
	// Let's hide all of the steps.
	$('.contribute-form-steps, .contribute-form-parts, .contribute-form-tools' ).hide();

	//////////////////////
	// Handle the AJAX for saving the first stage of the post. The rest will be over Backbone.
	$( '.submit-review' ).on( 'click', function( e ) {

		input_disabler( 'contribute-form' );

		e.preventDefault();

		tinyMCE.triggerSave();

		var form = $('contribute-form');

		var data = new FormData( form );
		jQuery.each( $( '#file' )[0].files, function( i, file ) {
			data.append( 'file-'+ i, file );
		});

		data.append( 'nonce',			$( '.contribute-form #contribute_post' ).val() );
		data.append( 'post_title',		$( '.contribute-form #post_title' ).val() );
		data.append( 'post_content',	tinyMCE.activeEditor.getContent() );
		data.append( 'cat',				$( '.contribute-form #cat' ).val() );
		data.append( 'post_type',		$( this ).data( 'type' ) );
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
				console.log( post_obj );
				$('.contribute-form').slideUp();
				post_filler( post_obj );
				$('.contribute-form-steps').slideDown();
			}
		});
	});

	//////////////////////
	// Take the saved data, and display it on the page.
	function post_filler( data ) {
		$('.post-title').html( 'Submitted:  ' + data.post_title );
		$('.post-content').html( data.post_content );
	}

	//////////////////////
	// Disable inputs
	function input_disabler( form ) {
		// Grab the inputs
		var inputs = jQuery('.' + form + ' :input');

		// Disable them all.
		inputs.each( function() {
			jQuery( this ).prop('disabled', true);
		});
	}

	//////////////////////
	// Save all of the tools data.
	$( '.submit-tools' ).on( 'click', function( e ) {

		// Prevent the button from trggering
		e.preventDefault();

		// Grab all of the inputs
		var inputs = $('.contribute-form-parts :input');

		// Grab all of the form data.
		var form = {};
		inputs.each( function() {
			form[this.name] = $(this).val();
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

	//////////////////////
	// Save the parts data
	$( '.submit-parts' ).on( 'click', function( e ) {

		// Prevent the button from trggering
		e.preventDefault();

		var inputs = $('.contribute-form-parts :input');

		var form = {};
		inputs.each(function() {
			form[this.name] = $(this).val();
		});

		form.action = 'add_parts';

		console.log( form );

		// Make the ajax request with the form data.
		$.ajax({
			url: make_gigya.ajax,
			data: form,
			type: 'POST',
			success: function( data ){
				parts_obj = JSON.parse( data );
				console.log( parts_obj );
			}
		});

	});

	//////////////////////
	// Save the steps.
	$( '.submit-steps' ).on( 'click', function( e ) {

		// Prevent the button from trggering
		e.preventDefault();

		// Let's get the steps initialized.
		var form = $('contribute-form-steps');

		// Grab all of the inputs.
		var the_files = $('.contribute-form-steps :file');
		var inputs = $('.contribute-form-steps input:not(:file), .contribute-form-steps textarea');

		// New FormData
		var data = new FormData( form );

		// Setup the form object, just kinda playing with this as a source of data.
		var form_obj = {};

		// Add the add_steps action to the object.
		form_obj['action'] = 'add_steps';

		// Append each of the images to the object, giving each a name.
		jQuery.each( the_files, function( i, file_obj ) {
			jQuery.each( file_obj.files, function( key, file ) {
				data.append( 'step-images-' + ( i + 1 ), file );
			});
		});

		// Loop through all of the inputs, with the exception of the file ones, and add the to the form_object, and then to the data object.
		inputs.each(function() {
			form_obj[this.name] = $(this).val();
			data.append( this.name, $(this).val() );
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
				post_obj = JSON.parse( response );
				console.log( response );
			}
		});

	});

});