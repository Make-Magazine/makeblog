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

		// Count the number of fields we have and decrement
		var count = jQuery( 'input[name="total-' + fields + '"]' ).val();

		// Remove the element
		jQuery( this ).parents( '.' + field + '.row' ).remove();

		// Update our field count
		jQuery( 'input[name="total-' + fields + '"]' ).val( count - 1 );

		// Make sure we reiterate over our steps and update their count. This will allow users to remove steps in-between steps
		// make_contribute_update_fields( fields );
	});
}