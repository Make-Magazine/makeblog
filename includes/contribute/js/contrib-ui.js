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

	console.log( 'adding step ' + count );

	var step = jQuery( '#steps-template' ).html();

	step = step.replace( new RegExp( '##count##', 'g' ), count );

	jQuery( '.steps-list' ).append( step );

	// Update our step count
	jQuery( 'input[name="total-steps"]' ).val( count );
}