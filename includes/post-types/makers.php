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
			'menu_position' 		=> 25,
			'menu_icon' 			=> null,
			'capability_type'		=> 'post',
			'hierarchical' 			=> true,
			'supports' 				=> array( 'title', 'editor', 'thumbnail', 'revisions',  ),
			'taxonomies'			=> array( 'category' ),
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

		// Check our nonce and make sure it's correct
		if ( ! wp_verify_nonce( $_POST['day-of-making'], 'day-of-making' ) )
			die( json_encode( array( 'failed' => 'nonce failed.', 'post' => $_POST, ) ) );

		// Setup the post variables yo.
		$post = array(
			'post_status'	=> 'draft',
			'post_title'	=> ( isset( $_POST['firstname'] ) || isset( $_POST['lastname'] ) ) ? sanitize_text_field( $_POST['firstname'] . ' ' . $_POST['lastname'] ) : '',
			'post_name'		=> ( isset( $_POST['firstname'] ) ) ? sanitize_title( $_POST['firstname'] . ' ' . $_POST['lastname'] ) : '',
			'post_content'	=> ( isset( $_POST['post_content'] ) ) ? wp_kses_post( $_POST['post_content'] ) : '',
			'post_category'	=> ( isset( $_POST['cat'] ) ) ? array( absint( $_POST['cat'] ) ) : '',
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
		$post->email = ( isset( $_POST['email_address'] ) && add_post_meta( $pid, '_making_email', sanitize_email( $_POST['email_address'] ) ) ) ? get_avatar( sanitize_email( $_POST['email_address'] ), 200 ) : '';
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
		// First Name
		$post->firstname = ( isset( $_POST['firstname'] ) && add_post_meta( $pid, '_firstname', sanitize_text_field( $_POST['firstname'] ) ) ) ? sanitize_text_field( $_POST['firstname'] ) : '';
		// Last Name
		$post->lastname = ( isset( $_POST['lastname'] ) && add_post_meta( $pid, '_lastname', sanitize_text_field( $_POST['lastname'] ) ) ) ? sanitize_text_field( $_POST['lastname'] ) : '';
		// URL
		$post->url = ( isset( $_POST['url'] ) && add_post_meta( $pid, '_url', sanitize_text_field( $_POST['url'] ) ) ) ? sanitize_text_field( $_POST['url'] ) : '';

		// Add the category...
		$post->cats = wp_get_post_terms( $pid, 'category' );

		// Send back the Post as JSON
		die( json_encode( $post ) );

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
		$email = ( isset( $meta['_making_email'][0] ) ) ? $meta['_making_email'][0] : 'webmaster@makezine.com';
		$output .= get_avatar( $email, 200, '', get_the_title() );
		$output .= '<div class="media-body">';
		$output .= '<h4 class="media-heading">';
		$output .= esc_html( $post->post_title );
		$output .= ' <small>';
		$output .= ( isset( $meta['_city'][0] ) ) ? esc_html( $meta['_city'][0] ) : '';
		$output .= ( isset( $meta['_city'] ) && isset( $meta['_state'] ) ) ? ', ' : '';
		$output .= ( isset( $meta['_state'][0] ) ) ? esc_html( $meta['_state'][0] ) : '';
		$output .= '</small></h4>';

		$output .= '<div class="media">';
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
			foreach ($posts as $post ) {
				$output .= $this->maker_media( $post );
			}
			$output .= '</div>';
		}
		echo $output;
	}
}

$makers = new Make_Makers();
