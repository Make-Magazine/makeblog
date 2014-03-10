
/**
 * This file contains code pertaining to users
 *
 * @since HAL 9000
 */

var path = window.location.pathname.substring(1);

/**
 * The JavaScript that controls a number of things in the maker profile and forms page
 * Over time, we'll be replacing all of this JavaScript with the REST API
 * @param  object maker The object returned by gigya.accounts.getAccountInfo()
 * @return mixed
 *
 * @since  HAL 9000
 */
function makerfaire_profile( maker ) {
	
	// Use jQuery to add some user info stuff on the forms
	if ( path.indexOf( 'exhibit' ) >= 0 || path.indexOf( 'presenter' ) >= 0 || path.indexOf( 'performer' ) >= 0 ) {

		// Display the forms page
		jQuery( '.wrapper.hide' ).removeClass( 'hide' ).fadeIn();

		// The maker name when present
		if ( jQuery( 'input.default-name' ).val() === '' ) {
			jQuery( 'input.default-name' ).val( maker.profile.firstName + ' ' + maker.profile.lastName );
			jQuery( 'input.default-email' ).val( maker.profile.email );
		}
		
		jQuery( 'h3.default-name' ).html( maker.profile.firstName + ' ' + maker.profile.lastName );
		jQuery( 'h3.default-email' ).html( maker.profile.email );
		
		jQuery( '#uid' ).val( maker.UID );
		jQuery( window ).bind( 'beforeunload', function() {
			return 'Are you sure you want to leave?';
		});
	} else if ( path.indexOf( 'makerprofile' ) >= 0 ) {

		// Show the content
		jQuery( '.mf-editforms.hide' ).removeClass( 'hide' ).fadeIn();

		if ( maker.profile.thumbnailURL !== undefined && maker.profile.thumbnailURL !== 'undefined' )
			jQuery( '.maker-image' ).attr( 'src', maker.profile.thumbnailURL );

		// Add our maker name to the page.
		jQuery( '.maker-name' ).html( maker.profile.firstName + ' ' + maker.profile.lastName );


		// Return the forms that belong to the current maker
		jQuery.post( make_gigya.ajax, {
			action: 'mfform_getforms', uid:maker.UID, e:maker.profile.email
		}, function( results ) {

			// Check if we are on a certain date or have passed
			var now = new Date();
			var expire_date = new Date( '2013/10/04' ); // Set a date that applications older or equal to this will be considered previous faire.
			var end_date = new Date( '2014/02/23' ); // Set the date that call to makers closes.
			
			for ( var type in results.forms ) {
				for ( var app_id in results.forms[ type ] ) {
					// Get the post date and convert the dashes to slashes. Other wise, Firefox return NaN
					var app_date = results.forms[ type ][ app_id ]['post_date'].replace( /-/g, '/' );

					// Check if the date right now is after our end date, 'August 4th, 2013', or else close the forms
					if ( Date.parse( app_date ) >= Date.parse( expire_date ) ) {
						// if the current time is less than the end date, we'll handle this form with the ability to still edit.
						if ( now.getTime() < end_date.getTime() && ( results.forms[ type ][ app_id ]['post_status'] === 'in-progress' || results.forms[ type ][ app_id ]['post_status'] === 'proposed' || results.forms[ type ] === 'presenter' ) ) {
							append = '<li><a href="' + make_gigya.root_path + type + 'form/?id=' + app_id + '">' +  app_id + ' - ' + results.forms[ type ][ app_id ]['post_title'] + ' (' + results.forms[ type ][ app_id ]['post_status'] + ')</a></li>';
						} else {
							append = '<li>' + app_id + ' - ' + results.forms[ type ][ app_id ]['post_title'] + ' (' + results.forms[ type ][ app_id ]['post_status'] + ')</li>';
						}
						jQuery( '#current-faire' ).find( '#' + type + ' ul' ).append( append );
					} else {
						// Get the application content and make sure we fix all escaped characters with double back slashes for valid JSON.
						// TODO - rework the content saving to save as valid JSON....
						var valid = results.forms[ type ][ app_id ]['post_content'].replace( /\\/g, '\\\\' );

						// Return our valid JSON content and extract the faire this application is assigned to.
						var faire = jQuery.parseJSON( valid ).maker_faire;

						// Now let's check which faire we have and output something more readable.
						if ( faire === '2013_newyork' ) {
							faire = 'New York 2013';
						} else if ( faire === '2013_bayarea' ) {
							faire = 'Bay Area 2013';
						}

						// Add our application to the Prvious Applications area.
						previous_append = '<li>' + app_id + ' - ' + results.forms[ type ][ app_id ]['post_title'] + ' (' + results.forms[ type ][ app_id ]['post_status'] + ') - ' + faire + '</li>';
						jQuery( '#previous-faire' ).find( '#' + type + ' ul' ).append( previous_append );
					}
				}
			}


			// Remove the loading notifications
			jQuery( 'div.loading' ).remove();

			// Show the Current Faire box if there are any present
			var has_current = jQuery( '#current-faire' ).find( 'ul li' ).length;

			if ( has_current >= 1 ) {
				jQuery( '#current-faire' ).show();
			}

			// Show the Previous Faires box if there are any present
			var has_previous = jQuery( '#previous-faire' ).find( 'ul li' ).length;

			if ( has_previous >= 1 ) {
				jQuery( '#previous-faire' ).show();
			}

			if ( has_current === 0 ) {
				jQuery( '.no-applications' ).show();
			}

		}, 'json' );
	}
}