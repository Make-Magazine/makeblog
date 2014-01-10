jQuery(document).ready(function($) {


	// Add our icon class to the meta box title
	$('#make_magazine_tools_step_manager h3.hndle').prepend('<span class="tools-ico"></span>');


	/**
	 * Run our "Add tool" click event. This seems like too much. Can probably re-work this and optimize it...
	 *
	 * @version 1.0
	 */
	$('.add-tool').click(function() {

		// Count how many LI tags we currently have so we can change the ID number when duplicated.
		var num = $('.tools-wrapper').length;

		// Duplicate our list template and remove the .list-template class.
		var clone = $('.tools-template').clone(true).removeClass('tools-template').addClass('hide').attr('id', 'tool-' + num);

		$('input[name="total-tools"]').val(num);

		// Append our cloned template item into the bottom of our current ul#sub-lists.
		clone.appendTo($(this).parent()).slideDown().find('.tool-title h3').html('Tool ' + num);

		// Update our tool number field
		$('#tool-' + num + ' > input[type="hidden"]').attr({
			name: 'tool-number-' + num,
			value: num
		});

		// Update the the number in the name field
		$('#tool-' + num + ' input[name="tools-name-0"]').attr('name', 'tools-name-' + num);

		// Update the the number in the URL field
		$('#tool-' + num + ' input[name="tools-url-0"]').attr('name', 'tools-url-' + num);

		// Update the the number in the thumbnail field
		$('#tool-' + num + ' input[name="tools-thumb-0"]').attr('name', 'tools-thumb-' + num);

		// Update the the number in the notes field
		$('#tool-' + num + ' textarea[name="tools-notes-0"]').attr('name', 'tools-notes-' + num);
	});


	/**
	 * Run our "Remove Step" click event.
	 *
	 * @version 1.0
	 */
	$('.remove-tool').click(function() {
		// Remove the main .parts-wrapper div.
		$(this).parent().parent().slideUp(500, function() {
			// Remove this element
			jQuery(this).remove();

			// Update our parts
			make_tools_manager_update_tools();

			// Count how many parts we have and update the total-parts field. This is needed to compile our onject upon save.
			var num = $('.tools-wrapper').length - 1;
			$('input[name="total-tools"]').val(num);
		});
	});


	/**
	 * Define our sortable sub-lists
	 * Using jQuery UI, we hook onto the class ".sort" on the sort icon so this become the "handle".
	 * Chain disableSelection() to the end so we can deactivate text selection when users are dragging.
	 *
	 * @version 1.0
	 */
	$('.tools.sortable').sortable({

		// The class assigned to the
		placeholder: 'ui-state-highlight',

		// Stop allowing our template code from being a drop target. This will stop users from sorting above it.
		items: "div.tools-wrapper:not(.tools-template)",

		axis: 'y',

		// fired when a sortable list receives an item from a connected list.
		receive: function(event, ui) { make_tools_manager_sort_received( this ); },

		// Removing a child from a sortable fires this event.
		remove: function(event, ui) { make_tools_manager_sort_removed( this ); },

		// Check when sort has been completed and update the list numerically
		update: function(event, ui) { make_tools_manager_sort_update( this ); }
	});
});


/**
 * Used in the jQuery UI $.sortable() function for our #sub-lists.
 * This method allows us to add the text empty to a list when its last item is removed
 *
 * @version 1.0
 */
function make_tools_manager_sort_received(selector) {
	if(jQuery(selector).hasClass('empty')) {
		jQuery(selector).removeClass('empty').find('.empty').remove();
	}
}


/**
 * Used in the jQuery UI $.sortable() function for our #sub-lists.
 * Checks to see if the parent sortable has any children. If so, remove the text as soon as a new item is added.
 *
 * @version 1.0
 */
function make_tools_manager_sort_removed(selector) {
	if(jQuery(selector).children().length === 0) {
		jQuery(selector).append($('<div class="empty">empty</div>')).addClass('empty');
	}
}

/**
 * When the sorting has been completed and updated, we'll want to update the list of tools
 *
 * @version 1.0
 */
function make_tools_manager_sort_update(selector) {
	// console.log('sorted');

	// Go an update each of our form fields.
	make_tools_manager_update_tools();
}


/**
 * The function that will allow us to update our list of tools
 *
 * @version 1.0
 */
function make_tools_manager_update_tools() {
	var i = 0;
	jQuery('.tools-wrapper').each( function(e, v) {

		// Update the tool ID
		jQuery(this).attr('id', 'tool-' + i);

		// Update the hidden field
		jQuery('#tool-' + i + ' input[type="hidden"]').attr({
			name: 'tool-number-' + i,
			value: i
		});

		// Update the title
		jQuery('#tool-' + i + ' .tool-title h3').html('Tool ' + i);

		// Update the the number in the name field
		jQuery('#tool-' + i + ' input#tools-name').attr('name', 'tools-name-' + i);

		// Update the the number in the URL field
		jQuery('#tool-' + i + ' input#tools-url').attr('name', 'tools-url-' + i);

		// Update the the number in the thumbnail field
		jQuery('#tool-' + i + ' input#tools-thumb').attr('name', 'tools-thumb-' + i);

		// Update the the number in the notes field
		jQuery('#tool-' + i + ' textarea#tools-notes').attr('name', 'tools-notes-' + i);

		i++;
	});
}
