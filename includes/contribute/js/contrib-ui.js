/**
 * This file handles all the UI stuff like adding new fields
 */

jQuery( document ).ready( function( $ ) {
	// Trigger the step addition when we click the "Add Step" button
	$( '.btn.add-step' ).click( function( e ) {
		e.preventDefault();

		make_contribute_add_field( 'steps' );
	});

	// Trigger the parts addition when we click the "Add Parts" button
	$( '.btn.add-part' ).click( function( e ) {
		e.preventDefault();

		make_contribute_add_field( 'parts' );
	});
});


/**
 * Adds new elements of our contributor form to the page
 * @param  strong fields the type of field we are dealing with
 * @return void
 */
function make_contribute_add_field( fields ) {
	// Count the number of fields we have and increment
	var count = jQuery( 'input[name="total-' + fields + '"]' ).val();
	count++;

	// Get the template
	var template = jQuery( '#' + fields + '-template' ).html();

	// Run a find and replace on the template to add our field count variable
	temp = template.replace( new RegExp( '##count##', 'g' ), count );

	// Append the new template to our list of items
	jQuery( '.' + fields + '-list' ).append( temp );

	// Update our item count
	jQuery( 'input[name="total-' + fields + '"]' ).val( count );

	// Make sure we trigger the removal event of the field after its been added
	make_contribute_remove_field( fields );
}


/**
 * Removes an element from the contribute form
 * @param  string fields the type of field we are dealing with
 * @return void
 */
function make_contribute_remove_field( fields ) {

	// The field variable is passed as a plural, let's remove make singular
	field = fields.substring( 0, fields.length - 1 );

	// Trigger the field removal
	jQuery( '.btn.remove-' + field ).click( function( e ) {
		e.preventDefault();

		// Remove the element
		jQuery( this ).parents( '.' + field + '.row' ).remove();

		// Make sure we reiterate over our steps and update their count. This will allow users to remove steps in-between steps
		make_contribute_get_update_fields( fields );
	});
}


/**
 * A controller function to determine what function we need to use based on the form field type
 * @param  string fields The type of field we are dealing with
 * @return void
 */
function make_contribute_get_update_fields( fields ) {
	if ( fields === 'steps' ) {
		make_contribute_update_steps();
	} else if ( fields === 'parts' ) {
		make_contribute_update_parts();
	} else if ( fields === 'tools' ) {
		make_contribute_update_tools();
	}

}


/**
 * Updates the step form fields to ensure they are all labeled with the right number
 * @return void
 */
function make_contribute_update_steps() {
	var i = 1;
	jQuery( '.step.row' ).each( function() {
		var step = jQuery(this);

		// Update the step number title
		step.find( '.step-title' ).html( 'Step ' + i );

		// Update the step number
		step.find( 'input[type="hidden"].step-number' ).attr({
			'name'  : 'step-number-' + i,
			'value' : i
		});

		// Update the step image
		step.find( 'input[type="file"].step-file' ).attr( 'name', 'step-images-' + i + '[]' );

		// Update the step title
		step.find( 'input[type="text"].title' ).attr( 'name', 'step-title-' + i );

		// Update the step lines
		step.find( 'textarea.step_content' ).attr( 'name', 'step-lines-' + i + '[]' );

		i++;
	});

	// Update the total step count
	jQuery( '#add-steps' ).find( 'input[type="hidden"][name="total-steps"]' ).val( i - 1 );
}


/**
 * Updates the part form fields to ensure they are all labeled with the right number
 * @return void
 */
function make_contribute_update_parts() {
	var i = 1;
	jQuery( '.part.row' ).each( function() {
		var step = jQuery(this);

		// Update the step number title
		step.find( '.part-title' ).html( 'Part ' + i );

		// Update the step number
		step.find( 'input[type="hidden"].part-number' ).attr({
			'name'  : 'part-number-' + i,
			'value' : i
		});

		// Update the parts notes count
		step.find( 'input[type="hidden"].parts-notes' ).attr( 'name', 'parts-notes-' + i );

		// Update the part name
		step.find( 'input[type="text"].parts-name' ).attr( 'name', 'parts-name-' + i );

		// Update the parts quantity
		step.find( 'input[type="number"].parts-qty' ).attr( 'name', 'parts-qty-' + i );

		// Update the parts url
		step.find( 'input[type="url"].parts-url' ).attr( 'name', 'parts-url-' + i );

		// Update the parts type
		step.find( 'input[type="text"].parts-type' ).attr( 'name', 'parts-type-' + i );

		i++;
		console.log(i);
	});

	// Update the total step count
	jQuery( '#add-parts' ).find( 'input[type="hidden"][name="total-parts"]' ).val( i );
}


/**
 * Updates the tools form fields to ensure they are all labeled with the right number
 * @return void
 */
function make_contribute_update_tools() {

}