/**
 * This script contains all the JavaScript that controls or interfaces with the socialize features of Gigya (AKA Facebook, Twitter, etc etc logins)
 * To hit our deadline for Maker Faire Bay Area, we need to rely on the JavaScript SDK from Gigya.
 * A server-side SDK is preferred, but a new spec and time is needed to be done to do so.
 *
 * @since  SPRINT_NAME
 */

// Set debugging mode.
var gigya_debug = false;

jQuery( document ).ready(function() {

	// Return our makers information. If a session is not found, Gigya will report back with an error and handled in the callback.
	gigya.accounts.getAccountInfo({ callback: make_is_logged_in });

	// Listen for a click event to open the login screen
	jQuery( document ).on( 'click', '.user-creds.signin', function( e ) {
		e.preventDefault();

		gigya.accounts.showScreenSet({
			screenSet: 'Login-web',
			mobileScreenSet: 'Login-mobile'
		});
	});

	// Listen for a click event to open the register screen
	jQuery( document ).on( 'click', '.user-creds.join', function( e ) {
		e.preventDefault();

		gigya.accounts.showScreenSet({
			screenSet: 'makezine-login',
			mobileScreenSet: 'makezine-mobile-login',
			startScreen: 'gigya-register-screen'
		});
	});

	// Check that we aren't dealing with a logged in WP user, if not, log them out of Gigya.
	if ( make_gigya.loggedin ) {
		jQuery( document ).on( 'click', '.user-creds.signout', function( e ) {
			e.preventDefault();

			if ( gigya_debug )
				console.log( 'Logout Started' );

			gigya.accounts.logout();
		});
	}
});


/**
 * The Gigya service generates several global application events for various situations that are driven by user interactions.
 * Global application events are fired whenever the event to which they refer occurs, regardless of what was the action that triggered the event.
 * This method allows setting event handlers for each of the supported global events.
 * @url http://developers.gigya.com/020_Client_API/020_Accounts/accounts.addEventHandlers
 *
 * @since  SPRINT_NAME
 */
gigya.accounts.addEventHandlers({ //
	onLogin: make_on_login,
	onLogout: make_on_logout
});


/**
 * Event handler of socialize.
 * http://developers.gigya.com/020_Client_API/010_Socialize/socialize.addEventHandlers#section_1
 *
 * NOTE: It is important to use the REST API for logging in or registering users http://developers.gigya.com/037_API_reference/010_Socialize
 *
 * @param  object eventObj The event object?
 * @since  SPRINT_NAME
 */
function make_on_login( eventObj ) {
	if ( gigya_debug )
		console.log( 'Logged in to Gigya!' );

	jQuery( 'body' ).append( '<div id="logging-in" class="modal fade"><div class="modal-body"><h2 class="text-center" style="margin-bottom:20px;">Please wait while we redirect you...<h2><div class="progress progress-striped active"><div class="bar" style="width: 100%;"></div></div></div></div>' );
	jQuery( '#logging-in' ).modal( 'show' );

	// Send our data via Ajax to the server to verify if the user is a returning user or a new one and create their profile.
	jQuery.ajax({
		type: 'POST',
		dataType: 'json',
		url: make_gigya.ajax,
		xhrFields: {
			withCredentials: true
		},
		data: {
			'action'   : 'make_login_user', // Calls our wp_ajax_nopriv_make_ajax_login or wp_ajax_make_ajax_login actions
			'request'  : 'login',
			'object'   : eventObj,
			'nonce'    : make_gigya.secure_it
		},
		success: function( results ) {
			if ( gigya_debug )
				console.log( results.message );

			// Check that everything went well
			if ( results.loggedin === true ) {
				document.location = make_gigya.root_path + '/author/' + results.maker;
			} else {
				// We may have logged into Gigya, but something happened on our end. Let's correct Gigya.
				gigya.accounts.logout();

				jQuery( '#logging-in' ).remove();
				alert( 'Something went wrong and we couldn\'t log you in. Please try again.' );
			}

		},
		error: function( jqXHR, textStatus, errorThrown ) {
			if ( gigya_debug ) {
				console.log( 'ERROR' );
				console.log( textStatus );
				console.log( errorThrown );
			}
		},
		complete: function( jqXHR, textStatus ) {
			if ( gigya_debug )
				console.log( 'Login Complete.' );
		}
	});
}


/**
 * onLogout Event handler
 * After we have successfully logged out, we'll redirect to the homepage.
 *
 * @since SPRINT_NAME
 */
function make_on_logout() {
	if ( gigya_debug )
		console.log( 'User logged out' );

	// Redirect back to the homepage
	document.location = make_gigya.root_path;
}


/**
 * Checks if gigya returned a user account and verifies the signature for additional security
 * @param  object maker The object returned by gigya.accounts.getAccountInfo()
 * @return mixed
 *
 * @since  SPRINT_NAME
 */
function make_is_logged_in( maker ) {
	if ( gigya_debug ) {
		console.log( maker );

		if ( make_gigya.loggedin === 'false' ) {
			console.log( 'WP not logged in' );
		} else {
			console.log( 'WP logged in' );
		}
	}

	// Check if we are logged into either WP or Gigya
	if ( make_gigya.loggedin === 'true' || maker.errorCode === 0 ) {
		if ( gigya_debug )
			console.log( 'User Logged In.' );

		// We need to ensure that if we are logged into WP, we force Gigya signout
		if ( make_gigya.loggedin === 'true' && maker.errorCode === 0 ) {
			gigya.accounts.logout();

			alert( 'It appears you are logged in twice. We\'ll need to log you out of your guest author account to continue.' );
			return;
		}

		// We only want to provide a sign out feature for Gigya users
		var signout = ( make_gigya.loggedin === 'false' ) ? '<a href="#signout" class="user-creds signout">Sign Out</a> / ' : '';

		jQuery( '.main-header' ).find( '.row' ).append( '<div class="login-wrapper">' + signout + '<a href="' + make_gigya.root_path + 'contribute/" class="user-creds profile">Share Your Project</a></div>' );

		// Display our content
		jQuery( '.container.authentication' ).show();

		// Append the Gigya UID to the contribute form
		if ( make_gigya.loggedin === 'false' ) {
			if ( typeof make_contribute_add_gigya_id == 'function' ) {
				make_contribute_add_gigya_id( maker.UID );
			}

			jQuery( '.author-profile-bio' ).append( '<a href="' + make_gigya.root_path + 'contribute/" class="btn btn-large btn-primary">Contribute to MAKE!</a>' );
		}
	} else {
		if ( gigya_debug )
			console.log( 'User Not Logged In.' );

		// Add our login/register links
		jQuery( '.main-header' ).find( '.row' ).append( '<div class="login-wrapper"><a href="#signin" class="user-creds signin">Sign In</a> / <a href="#join" class="user-creds join">Join</a></div>' );

		jQuery( '.container.authentication' ).html( '<div class="row"><div class="span12 login-required"><h2>You must be logged in to access this area. Please <a href="#signin" class="user-creds signin">Sign In</a> or <a href="#join" class="user-creds join">Join</a>.</h2></div></div>' ).show();
	}
}
