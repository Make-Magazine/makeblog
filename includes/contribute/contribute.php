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
		add_action( 'wp_ajax_nopriv_make_contribute_post', array( $this, 'contribute_post' ) );
		add_action( 'wp_ajax_make_contribute_post', array( $this, 'contribute_post' ) );
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
		wp_enqueue_script( 'make-contribute',  get_stylesheet_directory_uri() . '/includes/contribute/js/contribute.js', array( 'jquery' ), true );
	}


	/**
	 * Process' our Gigya interactions with the database. This method will take the info processed from the Gigya JS API and pass it through to either login or log out.
	 * These users are created and managed through the Tools > Guest Authors.
	 * @return json
	 *
	 * @since  Quantrons
	 */
	public function user_login() {
		
		// Check our nonce and make sure it's correct
		check_ajax_referer( 'ajax-nonce', 'nonce' );

		$uid = $_POST['object']['UID'];
		
		// Make sure some required fields are being passed first for security reasons
		if ( isset( $_POST['request'] ) && $_POST['request'] == 'login' && wp_verify_nonce( $_POST['nonce'], 'ajax-nonce' ) ) {

			// Before we continue we must verify this request is even a valid request from Gigya
			if ( $this->verify_user( $uid, $_POST['object']['signatureTimestamp'], $_POST['object']['UIDSignature'] ) ) {

				// Search for a maker and return them or else false.
				$users = $this->search_for_maker( $uid, $_POST['object']['profile']['email'] );

				// Check if a user already exists, if not we'll create one.
				if ( $users ) {

					// Check if the user existed and needs to have a Gigya ID added to the post meta
					if ( isset( $users['add_guid'] ) && $users['add_guid'] ) {
						update_post_meta( absint( $users[0]->ID ), 'cap-guid', sanitize_text_field( $uid ) );
					}

					// mark when the user logged in
					update_post_meta( absint( $users[0]->ID ), 'cap-last_login', date( 'm/d/Y g:i:s a', time() ) );

					$results = array(
						'loggedin' => true,
						'message' => 'Login Successful!',
						'maker' => absint( $users[0]->ID ),
					);

				// User didn't exist, let's make one.
				} else {
					// Pass our User Info sent from Gigya
					$user = ( is_array( $_POST['object']['profile'] ) ) ? $_POST['object']['profile'] : '';

					// Create the maker and return their ID
					$maker_id = $this->create_maker( $user, $uid );

					// Report our status to pass back to the modal window
					if ( is_wp_error( $maker_id ) ) {
						$results = array(
							'loggedin' => false,
							'message'  => 'A user account could not be created. Please try again.',
							'user' => absint( $maker_id ),
						);
					} else {
						$results = array(
							'loggedin' => true,
							'message'  => 'User account created and logged in!',
							'maker'    => absint( $maker_id ),
						);
					}
				}
			} else {
				$results = array(
					'loggedin' => false,
					'message' => 'Request could not be validated. Please try again.',
				);
			}
		} else {
			$results = array(
				'loggedin' => false,
				'message' => 'Missing required parameters', 
			);
		}

		// Return our results and handle them in the Ajax callback
		die( json_encode( $results ) );
	}


	/**
	 * Searches the Makers lists and locates a usr based on their UID
	 * @param  string $uid The user ID from Gigya
	 * @return object
	 *
	 * @since  Quantrons
	 */
	private function search_for_maker( $uid, $email ) {
		// Stick a hashed version of our usr ID for wp cache
		$user_hash = md5( sanitize_text_field( $uid ) );

		// Check if our makers are already cached.
		$users = false; //wp_cache_get( 'mf_user_' . $user_hash );

		if ( $users == false ) {
			$maker_guid_query = array(
				'post_type'  => 'guest-author',
				'meta_key'   => 'cap-guid',
				'meta_value' => sanitize_text_field( $uid ),
			);
			$users = new WP_Query( $maker_guid_query );

			// If a user was not found with a Gigya ID, let's check for an email
			if ( empty ( $users->posts ) ) {
				$maker_email_query = array(
					'post_type'  => 'guest-author',
					'meta_key'   => 'cap-user_email',
					'meta_value' => sanitize_email( $email ),
				);
				$users = new WP_Query( $maker_email_query );

				if ( ! empty( $users->posts ) )
					$found_with_email = true;
			}

			// Save the results to the cache
			// wp_cache_set( 'mf_user_' . $user_hash, $users, '', 86400 ); // Since we are caching each user, might as well hold onto it for 24 hours.
			
			if ( isset( $found_with_email ) && $found_with_email )
				$users->posts['add_guid'] = true;
		}

		return $users->posts;
	}


	/**
	 * Creates a new maker in the makers listings and returns the makers ID
	 * @param  array $user The data passed from Gigya for use in the maker creation
	 * @return integer
	 */
	private function create_maker( $user, $uid ) {

		// Handle our user name
		if ( ! empty( $user['firstName'] ) && ! empty( $user['lastName'] ) ) {
			$user_name = $user['firstName'] . ' ' . $user['lastName'];
		} elseif ( ! empty( $user['firstName'] ) && empty( $user['lastName'] ) ) {
			$user_name = $user['firstName'];
		} elseif ( empty( $user['firstName'] ) && empty( $user['lastName'] ) && ! empty( $user['nickname'] ) ) {
			$user_name = $user['nickname'];
		} else {
			$user_name = 'Undefined Username';
		}

		// Our user doesn't exist, that means we need to sync them up, create a maker account and log them in.
		$maker = array(
			'post_title' => sanitize_text_field( $user_name ),
			'post_status' => 'publish',
			'post_type' => 'guest-author',
		);
		$maker_id = wp_insert_post( $maker );

		// If an error happens, we want to report that back before running any post meta updates.
		if ( is_wp_error( $maker_id ) )
			return 0;

		// We'll want to add some custom fields. Let's do that.
		// ****************************************************
		// Date Created && last logged in
		update_post_meta( absint( $maker_id ), 'cap-created', date( 'm/d/Y g:i:s a', time() ) );
		update_post_meta( absint( $maker_id ), 'cap-last_login', date( 'm/d/Y g:i:s a', time() ) );

		// Add the maker Display Name
		$display_name = ( isset( $user_name ) && ! empty( $user_name ) ) ? $user_name : '';
		update_post_meta( absint( $maker_id ), 'cap-display_name', sanitize_text_field( $display_name ) );

		// Add the makers unique slug
		$slug = preg_replace( '/[^A-Za-z0-9-]+/', '-', sanitize_text_field( $display_name ) );
		update_post_meta( absint( $maker_id ), 'cap-user_login', sanitize_title_with_dashes( $slug ) );

		// Add the makers first name
		$first_name = ( isset( $user['firstName'] ) && ! empty( $user['firstName'] ) ) ? $user['firstName'] : '';
		update_post_meta( absint( $maker_id ), 'cap-first_name', sanitize_text_field( $first_name ) );

		// Add the makers last name
		$last_name = ( isset( $user['lastName'] ) && ! empty( $user['lastName'] ) ) ? $user['lastName'] : '';
		update_post_meta( absint( $maker_id ), 'cap-last_name', sanitize_text_field( $user['lastName'] ) );

		// Add the makers email
		$email = ( isset( $user['email'] ) && ! empty( $user['email'] ) ) ? $user['email'] : '';
		update_post_meta( absint( $maker_id ), 'cap-user_email', sanitize_email( $email ) );

		// Add the maker photo
		$user_photo = ( isset( $user['photoURL'] ) && ! empty( $user['photoURL'] ) ) ? $user['photoURL'] : '';
		update_post_meta( absint( $maker_id ), 'cap-photo_url', esc_url( $user_photo ) );

		// Add the Maker Gigya ID
		update_post_meta( absint( $maker_id ), 'cap-guid', sanitize_text_field( $uid ) );

		return $maker_id;
	}


	/**
	 * We want to verify our Gigya interactions are valid.
	 * Since all interactions are via the JavaScript API, we'll need to verify these via AJAX
	 * @return json
	 *
	 * @since  Quantrons
	 */
	public function verify_user( $uid, $timestamp, $sig) {

		// Validate the signature is authentic
		$valid = SigUtils::validateUserSignature( sanitize_text_field( $uid ), absint( $timestamp ), MAKE_GIGYA_PRIVATE_KEY, sanitize_text_field( $sig ) );

		if ( $valid ) {
			return true;
		} else {
			return false;
		}
	}
}
$make_gigya = new Make_Contribute();
