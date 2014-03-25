/**
 * This file handles all the UI stuff like adding new fields
 */

jQuery( document ).ready( function( $ ) {
	// Trigger the step addition when we click the "Add Step" button
	$( '.btn.add-step' ).click( function( e ) {
		e.preventDefault();

		make_contribute_add_field( 'steps' );
	});
});


function make_contribute_add_field( fields ) {
	// Count the number of fields we have and increment
	var count = jQuery( 'input[name="total-' + fields + '"]' ).val();
	count++;

	var field_obj = jQuery( '#' + fields + '-template' ).html();

	// Run a find and replace on the template to add our field count variable
	field_obj = field_obj.replace( new RegExp( '##count##', 'g' ), count );

	jQuery( '.' + fields + '-list' ).append( field_obj );

	// Update our step count
	jQuery( 'input[name="total-' + fields + '"]' ).val( count );

	// Make sure we trigger the removal event of the field after its been added
	make_contribute_remove_field( fields );
}

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


function make_contribute_get_update_fields( fields ) {
	if ( fields === 'steps' ) {
		make_contribute_update_steps();
	} else if ( fields === 'parts' ) {
		make_contribute_update_parts();
	} else if ( fields === 'tools' ) {
		make_contribute_update_tools();
	}

}


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

function make_contribute_update_parts() {

}

function make_contribute_update_tools() {

}