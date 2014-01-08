jQuery(document).ready(function($) {


	// Add our icon class to the meta box title
	$('#make_magazine_parts_step_manager h3.hndle').prepend('<span class="parts-ico"></span>');

	/**
	 * Run our "Add Part" click event. This seems like too much. Can probably re-work this and optimize it...
	 *
	 * @version 1.0
	 */
	$('.add-part').click(function() {

		// Count how many LI tags we currently have so we can change the ID number when duplicated.
		var num = $('.parts-wrapper').length;

		// Duplicate our list template and remove the .list-template class.
		var clone = $('.parts-template').clone(true).removeClass('parts-template').addClass('hide').attr('id', 'part-' + num);

		$('input[name="total-parts"]').val(num);

		// Append our cloned template item into the bottom of our current ul#sub-lists.
		clone.appendTo($(this).parent()).slideDown().find('.part-title h3').html('Part ' + num);

		// Update our part number field
		$('#part-' + num + ' > input[type="hidden"]').attr({
			name: 'part-number-' + num,
			value: num
		});

		// Update the the number in the name field
		$('#part-' + num + ' input[name="parts-name-0"]').attr('name', 'parts-name-' + num);

		// Update the the number in the quantity field
		$('#part-' + num + ' input[name="parts-qty-0"]').attr('name', 'parts-qty-' + num);

		// Update the the number in the URL field
		$('#part-' + num + ' input[name="parts-url-0"]').attr('name', 'parts-url-' + num);

		// Update the the number in the type field
		$('#part-' + num + ' input[name="parts-type-0"]').attr('name', 'parts-type-' + num);

		// Update the the number in the notes field
		$('#part-' + num + ' textarea[name="parts-notes-0"]').attr('name', 'parts-notes-' + num);
	}).disableSelection();


	/**
	 * Run our "Remove Step" click event.
	 *
	 * @version 1.0
	 */
	$('.remove-part').click(function() {
		// Remove the main .parts-wrapper div.
		$(this).parent().parent().slideUp(500, function() {
			// Remove this element
			jQuery(this).remove();

			// Update our parts
			make_parts_manager_update_parts();

			// Count how many parts we have and update the total-parts field. This is needed to compile our onject upon save.
			var num = $('.parts-wrapper').length - 1;
			$('input[name="total-parts"]').val(num);
		});
	});


	/**
	 * Define our sortable sub-lists
	 * Using jQuery UI, we hook onto the class ".sort" on the sort icon so this become the "handle".
	 * Chain disableSelection() to the end so we can deactivate text selection when users are dragging.
	 *
	 * @version 1.0
	 */
	$('.parts.sortable').sortable({

		// The class assigned to the
		placeholder: 'ui-state-highlight',

		// Stop allowing our template code from being a drop target. This will stop users from sorting above it.
		items: "div.parts-wrapper:not(.parts-template)",

		axis: 'y',

		// fired when a sortable list receives an item from a connected list.
		receive: function(event, ui) { make_parts_manager_sort_received( this ); },

		// Removing a child from a sortable fires this event.
		remove: function(event, ui) { make_parts_manager_sort_removed( this ); },

		// Check when sort has been completed and update the list numerically
		update: function(event, ui) { make_parts_manager_sort_update( this ); }
	});
});


/**
 * Used in the jQuery UI $.sortable() function for our #sub-lists.
 * This method allows us to add the text empty to a list when its last item is removed
 *
 * @version 1.0
 */
function make_parts_manager_sort_received(selector) {
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
function make_parts_manager_sort_removed(selector) {
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
function make_parts_manager_sort_update(selector) {
	//console.log('sorted');

	// Go an update each of our form fields.
	make_parts_manager_update_parts();
}


/**
 * The function that will actually update our form fields and text for the parts section
 * 
 * @version 1.0
 */
function make_parts_manager_update_parts() {
	var i = 0;
	jQuery('.parts-wrapper').each( function(e, v) {
		//console.log('part');

		// Update the part ID
		jQuery(this).attr('id', 'part-' + i);

		// Update the hidden field
		jQuery('#part-' + i + ' input[type="hidden"]').attr({
			name: 'part-number-' + i,
			value: i
		});

		// Update the title
		jQuery('#part-' + i + ' .part-title h3').html('Part ' + i);

		// Update the the number in the name field
		jQuery('#part-' + i + ' input#parts-name').attr('name', 'parts-name-' + i);

		// Update the the number in the quantity field
		jQuery('#part-' + i + ' input#parts-qty').attr('name', 'parts-qty-' + i);

		// Update the the number in the URL field
		jQuery('#part-' + i + ' input#parts-url').attr('name', 'parts-url-' + i);

		// Update the the number in the type field
		jQuery('#part-' + i + ' input#parts-type').attr('name', 'parts-type-' + i);

		// Update the the number in the notes field
		jQuery('#part-' + i + ' textarea#parts-notes').attr('name', 'parts-notes-' + i);

		i++;
	});
}
