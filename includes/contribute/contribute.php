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
		wp_enqueue_script( 'underscore' );
		wp_enqueue_script( 'backbone' );
		wp_enqueue_script( 'make-contribute-models', get_stylesheet_directory_uri() . '/includes/contribute/js/models.js', array( 'jquery', 'underscore', 'backbone' ), '1.0', true );
		wp_enqueue_script( 'make-contribute-views', get_stylesheet_directory_uri() . '/includes/contribute/js/views.js', array( 'jquery', 'underscore', 'backbone' ), '1.0', true );
		wp_enqueue_script( 'make-contribute-collections', get_stylesheet_directory_uri() . '/includes/contribute/js/collections.js', array( 'jquery', 'underscore', 'backbone' ), '1.0', true );
		wp_enqueue_script( 'make-contribute',  get_stylesheet_directory_uri() . '/includes/contribute/js/contribute.js', array( 'jquery', 'backbone' ), '1.0', true );
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

			$img = array(
				'id' => $attachment_id,
				'url' => $file['url'],
				'thumb'=> ( $thumb ? $wp_upload_dir['url'] . '/' . $thumb['file'] : $file['url'] )
			);
		}
	}

	/**
	 * Take the form data, and add a post/project.
	 *
	 * @return json
	 *
	 * @since  Quantrons
	 */
	public function contribute_post() {

		// Check our nonce and make sure it's correct
		check_ajax_referer( 'contribute_post', 'nonce' );

		// Setup the post variables yo.
		$post = array(
			'post_title'	=> ( isset( $_POST['post_title'] ) ) ? sanitize_text_field( $_POST['post_title'] ) : '',
			'post_name'		=> ( isset( $_POST['post_title'] ) ) ? sanitize_title( $_POST['post_title'] ) : '',
			'post_content'	=> ( isset( $_POST['post_content'] ) ) ? wp_kses_post( $_POST['post_content'] ) : '',
			'post_category'	=> ( isset( $_POST['cat'] ) ) ? array( intval( $_POST['cat'] ) ) : '',
		);

		$pid = wp_insert_post( $post );

		$this->upload_files( $pid, $_FILES );

		$post = get_post( $pid );

		$json = json_encode( $post );

		die( $json );

	}

}
$make_gigya = new Make_Contribute();
