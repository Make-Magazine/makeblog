jQuery(document).ready(function($) {

	// Add our icon class to the meta box title
	$('#make_magazine_projects_step_manager h3.hndle').prepend('<span class="steps-ico"></span>');

	// Add our remove button for images uploaded to the Projects Manager
	$('#image-list .has-image').prepend('<img src="' + make_projects_js.stylesheet_uri + '/images/icon-view.png" class="view-image" /><img src="' + make_projects_js.stylesheet_uri + '/images/icon-remove.png" class="remove-image" />');

	// Call our image removal and hover state
	make_projects_manager_image_removal();

	// Call our view image button and hover state
	make_projects_manager_view_image();

	/**
	 * Run our "Add Step" click event. This seems like too much. Can probably re-work this and optimize it...
	 *
	 * @version 1.0
	 */
	$('.add-step').click(function() {

		// Count how many LI tags we currently have so we can change the ID number when duplicated.
		var num = $('.step-wrapper').length;

		// Duplicate our list template and remove the .list-template class.
		var clone = $('.steps-template').clone(true).removeClass('steps-template').addClass('hide').attr('id', 'step-' + num);

		$('input[name="total-steps"]').val(num);

		// Append our cloned template item into the bottom of our current ul#sub-lists.
		clone.appendTo($(this).parent()).slideDown().find('.step-title h3').html('Step ' + num);

		// Remove the .list-template that get duplicated in the cloning process
		$('#step-' + num + ' li.list-template').removeClass();

		// Update our step number field
		$('#step-' + num + ' > input[type="hidden"]').attr({
			name: 'step-number-' + num,
			value: num
		});

		// Update our images
		$('#step-' + num + ' #image-list input.image-url' ).each( function() {
			$(this).attr('name', 'step-images-' + num + '[]');
		});

		// Update our sub-lists title
		$('#step-' + num + ' #list input[name="step-title-0"]' ).attr('name', 'step-title-' + num);

		// Update our sub-lists
		$('#step-' + num + ' #sub-lists textarea[name="step-lines-0[]"]').attr({
			name: 'step-lines-' + num + '[]',
			id: 'line-' + num
		});

	}).disableSelection();


	/**
	 * Run our "Remove Step" click event.
	 *
	 * @version 1.0
	 */
	$('.remove-step').click(function() {
		// Remove the main .parts-wrapper div.
		$(this).parent().parent().slideUp(500, function() {
			// Remove this element
			jQuery(this).remove();

			// Update our parts
			make_step_manager_update_steps();

			// Count how many parts we have and update the total-parts field. This is needed to compile our onject upon save.
			var num = $('.step-wrapper').length - 1;
			$('input[name="total-steps"]').val(num);
		});
	});


	/**
	 * Define our sortable steps
	 * Using jQuery UI, we hook onto the class ".sort" on the sort icon so this become the "handle".
	 * Chain disableSelection() to the end so we can deactivate text selection when users are dragging.
	 *
	 * @version 1.0
	 */
	$('.steps-step').sortable({

		// The class assigned to the
		placeholder: 'ui-state-highlight',

		// Stop allowing our template code from being a drop target. This will stop users from sorting above it.
		items: "div.step-wrapper:not(.steps-template)",

		axis: 'y',

		// fired when a sortable list receives an item from a connected list.
		receive: function(event, ui) { make_steps_manager_sort_received( this ); },

		// Removing a child from a sortable fires this event.
		remove: function(event, ui) { make_steps_manager_sort_removed( this ); },

		// Check when sort has been completed and update the list numerically
		update: function(event, ui) { make_steps_manager_sort_update( this ); }
	});

	// Call our "Add List" function.
	make_projects_manager_add_list();

	// Call our "Remove List" function.
	make_projects_manager_remove_list();
});


/**
 * Used in the jQuery UI $.sortable() function for our #sub-lists.
 * This method allows us to add the text empty to a list when its last item is removed
 *
 * @version 1.0
 */
function make_steps_manager_sort_received(selector) {
	if(jQuery(selector).hasClass('empty')) {
		jQuery(selector).removeClass('empty').find('.empty').remove();
	}
}


/**
 * Used in the jQuery UI $.sortable() function for our .parts.sortable
 * Checks to see if the parent sortable has any children. If so, remove the text as soon as a new item is added.
 *
 * @version 1.0
 */
function make_steps_manager_sort_removed(selector) {
	if(jQuery(selector).children().length === 0) {
		jQuery(selector).append($('<div class="empty">empty</div>')).addClass('empty');
	}
}


/**
 * Used in the jQuery UI $.sortable() function for our .parts.sortable
 * Used to updated our parts with the right ordering in the form fields and text (IE Part 3 will be updated to Part 2 if moved to the second position).
 * 
 * @version 1.0
 */
function make_steps_manager_sort_update(selector) {

	// Go an update each of our form fields.
	make_step_manager_update_steps();
}


/**
 * The function that will actually update our form fields and text for the parts section
 * 
 * @version 1.0
 */
function make_step_manager_update_steps() {
	var i = 0;
	jQuery('.step-wrapper').each( function(e, v) {

		// Update the part ID
		jQuery(this).attr('id', 'step-' + i);

		// Update the hidden field
		jQuery('#step-' + i + ' > input[type="hidden"]').attr({
			name: 'step-number-' + i,
			value: i
		});

		// Update the step title
		jQuery('#step-' + i + ' .step-title h3').html('Part ' + i);

		// Update our images
		jQuery('#step-' + i + ' #image-list input.image-url' ).each( function() {
			jQuery(this).attr('name', 'step-images-' + i + '[]');
		});

		// Update the step title
		jQuery('#step-' + i + ' #project-header').attr('name', 'step-title-' + i);

		// Update our sub-lists
		jQuery('#step-' + i + ' #sub-lists textarea').each(function() {
			jQuery(this).attr({
				name: 'step-lines-' + i + '[]',
				id: 'line-' + i
			});
		});

		i++;
	});
}


/**
 * Put our add list functionality into a function. This allows us to reuse this code multiple times when needed
 *
 * @version 2.0
 */
function make_projects_manager_add_list() {

	jQuery('#sub-lists img.add').click(function() {
		// Get the current step number. Needed for setting the proper name field for our textarea.
		var step_num = jQuery(this).parents('.step-wrapper').children().val();

		// Count how many LI tags we currently have so we can change the ID number when duplicated.
		var num = jQuery(this).parent().parent('#sub-lists').children().length + 1;

		// Duplicate our list template and remove the .list-template class.
		var clone = jQuery('.steps-template .list-template').clone(true).removeClass('list-template');

		// Append our cloned template item into the bottom of our current ul#sub-lists.
		clone.appendTo(jQuery(this).parent().parent('#sub-lists')).find('textarea').attr({
			'id': 'line-' + num,
			'name': 'step-lines-' + step_num + '[]'
		});

		// Remove the add sign from all list items. NOTE, adding first will break the script! MUST BE LAST.
		jQuery(this).remove();
	});
}


/**
 * Put our remove list functionality into a function. This allows us to reuse this code multiple times when needed
 *
 * @version 2.0
 */
function make_projects_manager_remove_list() {
	jQuery('#sub-lists img.remove').click(function() {

		// Create a variable that will traverse to the main UL
		var parent_ul = jQuery(this).parent().parent('#sub-lists');

		// Remove the entire LI tag for the button pressed
		jQuery(this).parent().slideUp(500, function() {

			// Remove this element
			jQuery(this).remove();

			// Check if our add button exists
			var add_btn = parent_ul.find('img.add').length;

			// If add_btn does not return with 1 (AKA true), then we will add a new one.
			if(add_btn === 0) {
				parent_ul.find('li:last').append('<img src="' + make_projects_js.stylesheet_uri + '/images/icon-add.png" class="project-button add">');
			}

			// Call our add list functions again so we don't lose the click events after we append. I'm sure there's a better way to this.
			make_projects_manager_add_list();
		});
	});
}


/**
 * Create a function that allows us to set the hover state and image removal functionality
 *
 * @version 1.0
 */
function make_projects_manager_image_removal() {
	// Fade in our remove button for images uploaded to the Projects Manager
	jQuery('.has-image').hover(function() {
		jQuery(this).children('img.remove-image').fadeIn(100);
	}, function() {
		jQuery(this).children('img.remove-image').fadeOut(100);
	});

	jQuery('img.remove-image').hover(function() {
		jQuery(this).next().addClass('steps-delete-hover');
	}, function() {
		jQuery(this).next().removeClass('steps-delete-hover');
	});

	// Clear the image from the preview and input field when the remove button is clicked
	jQuery('img.remove-image').click(function() {
		jQuery(this).parent().removeClass('has-image');
		jQuery(this).next().attr('src', 'http://placehold.it/94x94').removeClass('steps-delete-hover').next().attr('value', '');
		jQuery(this).remove();
	});
}


function make_projects_manager_view_image() {
	// Fade in our view button for images uploaded to the Projects Manager
	jQuery('.has-image').hover(function() {
		jQuery(this).children('img.view-image').fadeIn(100);
	}, function() {
		jQuery(this).children('img.view-image').fadeOut(100);
	});

	// View the image in a pretty modal window
	jQuery('img.view-image').click(function(e) {
		e.preventDefault();

		var image_src = jQuery(this).siblings('.image-url').val();
		window.open(image_src,'_blank');
	});
}


/**
 * Allows us to hook into the new WordPress 3.5 Media Uploader so we can add custom media in the Project Manager.
 * Function is to be applied to a wrapper element like $('.image-upload').make_project_manager();
 *
 * @version 1.0
 */
(function($) {
	$(function() {
		$.fn.make_projects_manager = function(options) {

			// Set the default options.
			var defaults = {
				'button': '.steps-image', // Button and preview select the image container.
				'url': '.image-url',      // URL will select the hidden input field. Used to be saved into DB.
				'preview': '.steps-image'
			};

			// Add our default options to the options namespace.
			var options = $.extend(defaults, options);

			// Tell the Media Uploader we are upload custom images outside of TinyMCE.
			var _custom_media = true;
			var _orig_send_attachment = wp.media.editor.send.attachment;

			// When we click our image placeholders, run the code below.
			$(options.button).click(function() {

				var button = $(this);
				var url = $(this).siblings(options.url); // set to the hidden input field.
				var send_attachment_bkp = wp.media.editor.send.attachment;

				_custom_media = true;

				// Return the URL of our image and attach it to the URL variable.
				wp.media.editor.send.attachment = function(props, attachment) {
					if(_custom_media) {
						url.val(attachment.url).trigger('change'); // Attach the URL but also copy the URL to our placeholder.
					} else {
						return _orig_send_attachment.apply(this, [props, attachment]);
					}
				};

				wp.media.editor.open(button);

				return false;
			});

			$('.add_media').on('click', function() {
				_custom_media = false;
			});

			// When we detect a change on the options.url variable, we will copy the
			// value field of our hidden input and paste it into the placeholder image tag.
			$(options.url).bind('change', function() {
				// Get the value of the current object.
				var url = this.value;

				// Set the Preview field.
				var preview = $(this).siblings(options.preview);

				// Attach tha info. Yo.
				$(preview).attr('src', url);

				// Once everything is complete, we'll add some needed UI stuff like the image removal button and viewing the image button
				// TO DO: Contain all the following code here into a function for simplicity and DRY programming.
				$(this).parent().addClass('has-image').prepend('<a href="#" class="view-image"><img src="' + make_projects_js.stylesheet_uri + '/images/icon-view.png" /></a><img src="' + make_projects_js.stylesheet_uri + '/images/icon-remove.png" class="remove-image" />');

				// Call our image removal and hover state
				make_projects_manager_image_removal();

				// Call our view image and hover state
				make_projects_manager_view_image();
			});
		};

		$('.image-upload').make_projects_manager();
   });
}(jQuery));
