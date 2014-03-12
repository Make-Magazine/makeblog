/**
 * This file handles all the UI stuff like adding new fields
 */

jQuery( document ).ready( function( $ ) {
	// Trigger the step addition when we click the "Add Step" button
	$( '.btn.add-step' ).click( function( e ) {
		e.preventDefault();

		add_step();
	});
});


function add_step() {
	// Count the number of steps we have and increment
	var count = jQuery( 'input[name="total-steps"]' ).val();
	count++;

	var step = jQuery( '#steps-template' ).html();

	// Run a find and replace on the template to add our step count
	step = step.replace( new RegExp( '##count##', 'g' ), count );

	jQuery( '.steps-list' ).append( step );

	// Update our step count
	jQuery( 'input[name="total-steps"]' ).val( count );

	// Make sure we load the removal of the step after its been added
	remove_step();

}

function remove_step() {
	// Trigger the step removal
	jQuery( '.btn.remove-step' ).click( function( e ) {
		e.preventDefault();

		// Count the number of steps we have and decrement
		var count = jQuery( 'input[name="total-steps"]' ).val();
		count--;

		console.log(jQuery(this).parent());
		jQuery( this ).parent( '.step.row' ).remove();
	});
}