<?php
/*
 * Makers Post Type
 *
 */
class Make_Makers {

	/**
	 * Let's get this going...
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'create_post_type' ) );
		add_action( 'init', array( $this, 'custom_fields' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'load_resources' ), 30 );
		add_action( 'wp_ajax_nopriv_add_maker', array( $this, 'add_maker' ) );
		add_action( 'wp_ajax_add_maker', array( $this, 'add_maker' ) );
		add_filter( 'get_avatar', array( $this, 'change_avatar_css') );
		add_action( 'maker_rows', array( $this, 'build_rows' ) );
	}

	/**
	 * Register the makers post type.
	 */
	static function create_post_type() {
		$labels = array(
			'name' 					=> 'Makers',
			'singular_name' 		=> 'Maker',
			'add_new' 				=> 'Add New Maker',
			'all_items' 			=> 'All Makers',
			'add_new_item' 			=> 'Add New Maker',
			'edit_item' 			=> 'Edit Maker',
			'new_item' 				=> 'New Maker',
			'view_item' 			=> 'View Maker',
			'search_items' 			=> 'Search Makers',
			'not_found' 			=> 'No Makers found...',
			'not_found_in_trash' 	=> 'No Makers found in trash',
			'parent_item_colon' 	=> 'Parent Maker:',
			'menu_name' 			=> 'Makers'
		);
		$args = array(
			'labels' 				=> $labels,
			'description' 			=> 'Makers',
			'public' 				=> false,
			'exclude_from_search' 	=> true,
			'publicly_queryable' 	=> false,
			'show_ui' 				=> true,
			'show_in_nav_menus' 	=> true,
			'show_in_menu' 			=> true,
			'show_in_admin_bar' 	=> true,
			'menu_position' 		=> 46,
			'menu_icon' 			=> null,
			'capability_type'		=> 'post',
			'hierarchical' 			=> true,
			'supports' 				=> array( 'title', 'editor', 'thumbnail', 'revisions',  ),
			'has_archive' 			=> false,
			'rewrite' 				=> array(
				'slug' 			=> 'makers',
				'with_front'	=> 'makers'
			),
			'query_var' 			=> true,
			'can_export' 			=> true
		);
		register_post_type( 'makers', $args );
	}

	public function load_resources() {
		if ( is_page_template( 'page-day-of-making.php' ) && ! is_admin() ) {
			// JavaScript
			$localize = array(
				'admin_post' 	=> admin_url( 'admin-ajax.php' ),
				'logged_in' 	=> is_user_logged_in(),
				'jake'			=> 'awesome',
			);
			wp_enqueue_style( 'day-of-making', get_stylesheet_directory_uri() . '/css/day-of-making.css' );
			wp_enqueue_script( 'day-of-making', get_stylesheet_directory_uri() . '/js/makers.js', array( 'jquery' ) );
			wp_enqueue_script( 'md5', get_stylesheet_directory_uri() . '/js/md5.js', array( 'jquery' ) );
			wp_localize_script( 'day-of-making', 'contribute', $localize );
			wp_deregister_style( 'make-css' );
			wp_deregister_style( 'make-print-css' );
			wp_deregister_style( 'frontend-uploader-css' );
		}
	}

	/**
	 * Take the form data, and add a post/project.
	 *
	 * @return json
	 *
	 * @since  Quantrons
	 */
	public function add_maker() {

		global $make_contribute;

		// Check our nonce and make sure it's correct
		if ( ! wp_verify_nonce( $_POST['day-of-making'], 'day-of-making' ) )
			die( json_encode( array( 'failed' => 'nonce failed.', 'post' => $_POST, ) ) );

		// Setup the post variables yo.
		$post = array(
			'post_status'	=> 'draft',
			'post_title'	=> ( isset( $_POST['firstname'] ) || isset( $_POST['lastname'] ) ) ? sanitize_text_field( $_POST['firstname'] . ' ' . $_POST['lastname'] ) : '',
			'post_name'		=> ( isset( $_POST['firstname'] ) ) ? sanitize_title( $_POST['firstname'] . ' ' . $_POST['lastname'] ) : '',
			'post_content'	=> ( isset( $_POST['post_content'] ) ) ? wp_kses_post( $_POST['post_content'] ) : '',
			'post_type'		=> 'makers',
			// When this goes to wpcom, we need to set an author to the post.
			// Or, do we?
			'post_author'	=> 604631,
		);

		// Insert the post.
		$pid = wp_insert_post( $post );

		// Get the newly created post
		$post = get_post( $pid );

		// Let's make it look purdy...
		$post->formatted_content = Markdown( $post->post_content );

		// Set the email to post_meta.
		$post->email = ( isset( $_POST['email_address'] ) && add_post_meta( $pid, '_making_email', sanitize_email( $_POST['email_address'] ) ) ) ? get_avatar( sanitize_email( $_POST['email_address'] ), 120 ) : '';
		// Zip
		$post->zip = ( isset( $_POST['zip'] ) && add_post_meta( $pid, '_zip', esc_attr( $_POST['zip'] ) ) ) ? esc_attr( $_POST['zip'] ) : '';
		// State
		$post->state = ( isset( $_POST['state'] ) && add_post_meta( $pid, '_state', esc_attr( $_POST['state'] ) ) ) ? esc_attr( $_POST['state'] ) : '';
		// City
		$post->city = ( isset( $_POST['city'] ) && add_post_meta( $pid, '_city', esc_attr( $_POST['city'] ) ) ) ? esc_attr( $_POST['city'] ) : '';
		// country
		$post->country = ( isset( $_POST['country'] ) && add_post_meta( $pid, '_country', esc_attr( $_POST['country'] ) ) ) ? esc_attr( $_POST['country'] ) : '';
		// Experience
		$post->experience = ( isset( $_POST['experience'] ) && add_post_meta( $pid, '_experience', sanitize_text_field( $_POST['experience'] ) ) ) ? sanitize_text_field( $_POST['experience'] ) : '';
		// Interest
		$post->interest = ( isset( $_POST['interest'] ) && add_post_meta( $pid, '_interest', sanitize_text_field( $_POST['interest'] ) ) ) ? sanitize_text_field( $_POST['interest'] ) : '';
		// First Name
		$post->firstname = ( isset( $_POST['firstname'] ) && add_post_meta( $pid, '_firstname', sanitize_text_field( $_POST['firstname'] ) ) ) ? sanitize_text_field( $_POST['firstname'] ) : '';
		// Last Name
		$post->lastname = ( isset( $_POST['lastname'] ) && add_post_meta( $pid, '_lastname', sanitize_text_field( $_POST['lastname'] ) ) ) ? sanitize_text_field( $_POST['lastname'] ) : '';
		// URL
		$post->url = ( isset( $_POST['url'] ) && add_post_meta( $pid, '_url', esc_url( sanitize_text_field( $_POST['url'] ) ) ) ) ? esc_url( sanitize_text_field( $_POST['url'] ) ) : '';

		// Upload the files, then build a gravatar image.
		$img_array = $make_contribute->upload_files( $pid, $_FILES );
		$post->image = ( $img_array['profile-image-1'][0] && ! empty( $img_array['profile-image-1'][0] ) && add_post_meta( $pid, '_maker_image', sanitize_text_field( $img_array['profile-image-1'][0] ) ) ) ? $this->build_avatar( $img_array['profile-image-1'][0], 120, 'pull-left' ) : get_avatar( $post->email, 120 );

		// Send back the Post as JSON
		die( json_encode( $post ) );

	}

	private function build_avatar( $url, $size = 120, $class = '' ) {
		return '<img src="' . esc_url( wpcom_vip_get_resized_remote_image_url( $url, $size, $size ) ) . '" class="avatar avatar-' . esc_attr( $size ) . ' photo ' . $class . '">';
	}

	public function change_avatar_css($class) {
		$class = str_replace( "class='avatar", "class='avatar pull-left ", $class ) ;
		return $class;
	}


	/**
	 * Build the output of the rows
	 */
	public function maker_media( $post ) {

		// Let's get going...
		setup_postdata( $post );

		$meta = get_metadata( 'post', $post->ID );

		$output = '<div class="span6">';

		$output .= '<div class="maker media">';
		$output .= ( isset( $meta['_url'][0] ) ) ? '<a class="pull-left" href="' . esc_url( $meta['_url'][0] ) . '">' : '';

		// If they added a photo, use that. If no image, build a gravatar. If we don't have an email, fall back to the webmster one.
		// We might want to drop the email check, and just use the webmaster one...
		if ( ! empty( $meta['_maker_image'][0] ) ) {
			$output .= build_avatar( esc_url( $meta['_maker_image'][0] ) );
		} else {
			$email = ( isset( $meta['_making_email'][0] ) ) ? $meta['_making_email'][0] : 'webmaster@makezine.com';
			$output .= get_avatar( $email, 120, '', get_the_title() );
		}
		$output .= ( isset( $meta['_url'][0] ) ) ? '</a>' : '';
		$output .= '<div class="media-body">';
		$output .= '<h4 class="media-heading">';
		$output .= esc_html( $post->post_title );
		$output .= ' <small>';
		$output .= ( isset( $meta['_city'][0] ) ) ? esc_html( $meta['_city'][0] ) : '';
		$output .= ( isset( $meta['_city'] ) && isset( $meta['_state'] ) ) ? ', ' : '';
		$output .= ( isset( $meta['_state'][0] ) ) ? esc_html( $meta['_state'][0] ) : '';
		$output .= '</small></h4>';

		$output .= '<div class="media">';

		$output .= ( ! empty( $meta['_interest'][0] ) ) ? '<div class="category">' . esc_html( $meta['_interest'][0] ) . '</div>' : '';
		$output .= Markdown( get_the_content() );

		$output .= '</div></div></div></div>';

		return $output;
	}

	/**
	 * Build the rows of user contributed content.
	 */
	public function build_rows() {

		// Build the args array. Keep it simple right now.
		$args = array(
			'post_type'			=> 'makers',
			'posts_per_page'	=> 30,
		);

		// Build the Query.
		$query = new WP_Query( $args );

		// Start the output.
		$output = '';

		// Break the results into chunks, so that we can have rows.
		$rows = array_chunk( $query->posts, 2 );

		foreach ( $rows as $row => $posts ) {
			$output .= '<div class="row">';
			// Inside each of the rows, build the output.
			foreach ( $posts as $post ) {
				$output .= $this->maker_media( $post );
			}
			$output .= '</div>';
		}
		echo $output;
	}

	public function custom_fields() {
		/**
		 * Initiate the Easy Custom Fields class
		 */
		$field_data = array (
			'maker_info' => array(
				'fields' => array(
					'_url'			=> array(
						'label' 		=> 'Website URL',
					),
					'_making_email'	=> array(
						'label' 		=> 'Email',
					),
					'_city'			=> array(
						'label' 		=> 'City',
					),
					'_state'		=> array(
						'label' 		=> 'State',
					),
					'_zip'			=> array(
						'label' 		=> 'Zip Code',
					),
					'_country'		=> array(
						'label' 		=> 'Country',
					),
					'_experience'	=> array(
						'label' 		=> 'Experience',
					),
					'_interest'		=> array(
						'label' 		=> 'Interest',
					),
					'_maker_image'		=> array(
						'label' 		=> 'Photo URL',
					),
				),
				'title' => 'Maker Meta',
				'context' => 'side',
				'pages' => array( 'makers' ),
			),
		);

		$easy_cf = new Easy_CF($field_data);
	}
}

$makers = new Make_Makers();
