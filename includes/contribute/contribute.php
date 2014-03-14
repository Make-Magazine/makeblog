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

		// Add the steps ajax actions.
		add_action( 'wp_ajax_nopriv_add_steps', array( $this, 'add_steps' ) );
		add_action( 'wp_ajax_add_steps', array( $this, 'add_steps' ) );

		// Add the tools ajax actions.
		add_action( 'wp_ajax_nopriv_add_tools', array( $this, 'add_tools' ) );
		add_action( 'wp_ajax_add_tools', array( $this, 'add_tools' ) );

		// Add the parts ajax actions.
		add_action( 'wp_ajax_nopriv_add_parts', array( $this, 'add_parts' ) );
		add_action( 'wp_ajax_add_parts', array( $this, 'add_parts' ) );
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
		wp_enqueue_script( 'make-contribute', get_stylesheet_directory_uri() . '/includes/contribute/js/contribute.js', array( 'jquery' ), '1.0', true );
		wp_enqueue_script( 'make-contrib-ui', get_stylesheet_directory_uri() . '/includes/contribute/js/contrib-ui.js', array( 'jquery' ), '1.0', true );
	}

	/**
	 * Uploads images and documents.
	 * @param  Integer $post_id The post ID we are adding the image to
	 * @param  Array   $files   An array of files being uploaded (captured via $_FILES)
	 * @return Array
	 */
	private function upload_files( $post_id, $files ) {

		if ( ! function_exists( 'wp_handle_upload' ) )
			require_once( ABSPATH . 'wp-admin/includes/file.php' );

		if ( ! function_exists( 'wp_crop_image' ) )
				require_once( ABSPATH . 'wp-admin/includes/image.php' );

		// And array of allowed file types to be uploaded
		$allowed_file_types = array(
			'jpg',
			'jpeg',
			'png',
			'gif',
		);

		// Setup the image array
		$images = array();

		// Loop through all of our uploaded files
		foreach ( $files as $name => $values ) {

			$file_type = wp_check_filetype( $values['name'] );
			// Ensure the file type being passed matches the field type (ie. photo uploads should only allow photos and documents as documents)
			if ( ! in_array( $file_type['ext'], $allowed_file_types ) )
				return;

			$overrides = array( 'test_form' => false );
			$file = wp_handle_upload( $values, $overrides );

			// Check if there were any errors
			if ( isset( $file['error'] ) ) {
				// TODO: update this to trigger a wp_error instead...
				return $results['error'] = $file['error'];
				exit();
			}

			$attachment = array(
				'guid' => $file['url'],
				'post_mime_type' => $file['type'],
				'post_title' => preg_replace( '/\.[^.]+$/', '', basename( $values['name'] ) ),
				'post_content' => '',
				'post_status' => 'inherit'
			);
			$attachment_id = wp_insert_attachment( $attachment, $file['file'], $post_id );

			$attachment_data = wp_generate_attachment_metadata( $attachment_id, $values['name'] );

			wp_update_attachment_metadata( $attachment_id, $attachment_data );

			// Attach as a featured image if we are uploading the project photo
			if ( $name === 'file' )
				update_post_meta( $post_id, '_thumbnail_id', $attachment_id );

			// Get the upload directory
			$wp_upload_dir = wp_upload_dir();
			$thumb = image_make_intermediate_size( $file['file'], 500, 500 );

			// Due to legacy code, we need to pass two empty fields.
			// TODO: Update the image handling in make_magazine_projects_build_step_data() to allow a varying number of images, fixing the need to pass two empty values.
			$images[ sanitize_key( $name ) ] = array(
				esc_url( $file['url'] ),
				'',
				'',
			);
		}

		return $images;
	}

	/**
	 * Take the form data, and add a post/project.
	 *
	 * @return json
	 *
	 * @since  Quantrons
	 */
	public function contribute_post() {

		////////////////////
		// Check our nonce and make sure it's correct
		check_ajax_referer( 'contribute_post', 'nonce' );

		////////////////////
		// Setup the post variables yo.
		$post = array(
			'post_title'	=> ( isset( $_POST['post_title'] ) ) ? sanitize_text_field( $_POST['post_title'] ) : '',
			'post_name'		=> ( isset( $_POST['post_title'] ) ) ? sanitize_title( $_POST['post_title'] ) : '',
			'post_content'	=> ( isset( $_POST['post_content'] ) ) ? wp_kses_post( $_POST['post_content'] ) : '',
			'post_category'	=> ( isset( $_POST['cat'] ) ) ? array( intval( $_POST['cat'] ) ) : '',
			'post_type'		=> ( isset( $_POST['post_type'] ) ) ? sanitize_text_field( $_POST['post_type'] ) : 'post',
		);

		////////////////////
		// Insert the post
		$pid = wp_insert_post( $post );

		////////////////////
		// Upload the files
		$this->upload_files( $pid, $_FILES );

		////////////////////
		// Get the newly created post
		$post = get_post( $pid );

		////////////////////
		// Send back the Post as JSON
		die( json_encode( $post ) );

	}

	/**
	 * Take the form data, and add a post/project.
	 *
	 * @return json
	 *
	 * @since  Quantrons
	 */
	public function add_steps() {

		////////////////////
		// Check our nonce and make sure it's correct
		if ( ! wp_verify_nonce( $_POST['contribute_steps_nonce'], 'contribute_steps_nonce' ) )
			die( 'We weren\'t able to verify that nonce...' );

		////////////////////
		// Upload the files
		$files = $this->upload_files( absint( $_POST['post_ID'] ), $_FILES );

		////////////////////
		// Merge the files array and the $_POST array.
		$merged = array_merge( $_POST, $files );

		//////////////////////////
		// STEPS
		$step_object = make_magazine_projects_build_step_data( $merged );

		var_dump($step_object);

		// Update our post meta for Steps if any exist
		update_post_meta( absint( $_POST['post_ID'] ), 'Steps', $step_object );

		////////////////////
		// Get the newly created post
		$post = get_post( absint( $_POST['post_ID'] ) );

		////////////////////
		// Turn that post into JSON
		$json = json_encode( $post );

		////////////////////
		// Send back the JSON Post
		// die( $json );

		die();

	}

	public function add_tools() {

		////////////////////
		// Check our nonce and make sure it's correct
		if ( ! wp_verify_nonce( $_POST['contribute_tools'], 'contribute_tools' ) )
			die( 'We weren\'t able to verify that nonce...' );

		////////////////////
		// Build the tools object
		$tools_object = make_magazine_projects_build_tools_data( $_POST );

		////////////////////
		// Update our post meta for Steps. Unlike Steps and Tools, we want one meta key.
		update_post_meta( absint( absint( $_POST['post_ID'] ) ), 'Tools', $tools_object );

		////////////////////
		// Send back the tools object
		die( json_encode( $tools_object ) );

	}

	public function add_parts() {

		////////////////////
		// Check our nonce and make sure it's correct
		if ( ! wp_verify_nonce( $_POST['contribute_parts'], 'contribute_parts' ) )
			die( 'We weren\'t able to verify that nonce...' );

		///////////////////////
		// PARTS
		$parts = make_magazine_projects_build_parts_data( $_POST );

		$meta_obj = array();
		foreach ( $parts as $part ) {
			$meta_obj[] = add_post_meta( absint( $_POST['post_ID'] ), 'parts', $part );
		}

		////////////////////
		// Send back the tools object
		die( json_encode( $meta_obj ) );

	}

}

$make_contribute = new Make_Contribute();
