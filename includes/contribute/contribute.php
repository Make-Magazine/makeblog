<?php

/**
 * Contribute!
 *
 * A class that will allow for forms to contribute posts.
 *
 * @since  Quantrons
 */

/**
 * The guts.
 *
 * This little guy controls and loads all that is Gigya.
 * The namespace for this class is Make because in the future this will be expanded to other make websites.
 *
 * @since  Quantrons
 */
class Make_Contribute {
	
	/**
	 * THE CONSTRUCT.
	 *
	 * All Hooks and Filter here.
	 * Anything else that needs to run when the class is instantiated, place them here.
	 * Maybe you'll get a cake if you do.
	 *
	 * @return  void
	 * @since  Quantrons
	 */
	public function __construct() {

		add_action( 'wp_enqueue_scripts', array( $this, 'load_resources' ), 30 );

		// Process our ajax requests. We need ajax processing for both logged in and logged out users.
		// Since our login may be used by users logged into WordPress, we'll need the second option to run ajax requests.
		add_action( 'wp_ajax_nopriv_contribute_post', array( $this, 'contribute_post' ) );
		add_action( 'wp_ajax_contribute_post', array( $this, 'contribute_post' ) );
	}

	/**
	 * Let's add all of our resouces to make our magic happen.
	 * Any scripts we should include in the footer or else things will conflict due to how we have to load the socialize API file... #facepalm
	 *
	 * @return  void
	 * @since  Quantrons
	 */
	public function load_resources() {
		// JavaScript
		wp_enqueue_script( 'make-contribute',  get_stylesheet_directory_uri() . '/includes/contribute/contribute.js', array( 'jquery' ), true );
		wp_enqueue_script( 'ajax-upload-pattern', get_stylesheet_directory_uri() . '/ajaxLoops/ajax-upload_pattern.js', array('plupload-all', 'jquery'), 1.0 );


	}


	/**
	 * Process' our Gigya interactions with the database. This method will take the info processed from the Gigya JS API and pass it through to either login or log out.
	 * These users are created and managed through the Tools > Guest Authors.
	 * @return json
	 *
	 * @since  Quantrons
	 */
	public function contribute_post() {
		
		// Check our nonce and make sure it's correct
		// check_ajax_referer( 'contribute_post', 'nonce' );

		var_dump( $_POST );

		var_dump( $_FILES );

		die( 'Hey, it worked!' );
		
		// // Make sure some required fields are being passed first for security reasons
		// if ( isset( $_POST['request'] ) && $_POST['request'] == 'login' && wp_verify_nonce( $_POST['nonce'], 'ajax-nonce' ) ) {

		// 	// Before we continue we must verify this request is even a valid request from Gigya
		// 	if ( $this->verify_user( $uid, $_POST['object']['signatureTimestamp'], $_POST['object']['UIDSignature'] ) ) {

		// 		// Search for a maker and return them or else false.
		// 		$users = $this->search_for_maker( $uid, $_POST['object']['profile']['email'] );

		// 		// Check if a user already exists, if not we'll create one.
		// 		if ( $users ) {

		// 			// Check if the user existed and needs to have a Gigya ID added to the post meta
		// 			if ( isset( $users['add_guid'] ) && $users['add_guid'] ) {
		// 				update_post_meta( absint( $users[0]->ID ), 'cap-guid', sanitize_text_field( $uid ) );
		// 			}

		// 			// mark when the user logged in
		// 			update_post_meta( absint( $users[0]->ID ), 'cap-last_login', date( 'm/d/Y g:i:s a', time() ) );

		// 			$results = array(
		// 				'loggedin' => true,
		// 				'message' => 'Login Successful!',
		// 				'maker' => absint( $users[0]->ID ),
		// 			);

		// 		// User didn't exist, let's make one.
		// 		} else {
		// 			// Pass our User Info sent from Gigya
		// 			$user = ( is_array( $_POST['object']['profile'] ) ) ? $_POST['object']['profile'] : '';

		// 			// Create the maker and return their ID
		// 			$maker_id = $this->create_maker( $user, $uid );

		// 			// Report our status to pass back to the modal window
		// 			if ( is_wp_error( $maker_id ) ) {
		// 				$results = array(
		// 					'loggedin' => false,
		// 					'message'  => 'A user account could not be created. Please try again.',
		// 					'user' => absint( $maker_id ),
		// 				);
		// 			} else {
		// 				$results = array(
		// 					'loggedin' => true,
		// 					'message'  => 'User account created and logged in!',
		// 					'maker'    => absint( $maker_id ),
		// 				);
		// 			}
		// 		}
		// 	} else {
		// 		$results = array(
		// 			'loggedin' => false,
		// 			'message' => 'Request could not be validated. Please try again.',
		// 		);
		// 	}
		// } else {
		// 	$results = array(
		// 		'loggedin' => false,
		// 		'message' => 'Missing required parameters', 
		// 	);
		// }

		// Return our results and handle them in the Ajax callback
		die( json_encode( $results ) );
	}


	
}
$make_gigya = new Make_Contribute();
