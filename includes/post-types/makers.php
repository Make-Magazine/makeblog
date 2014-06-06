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
			'not_found' 			=>  'No Makers found...',
			'not_found_in_trash' 	=> 'No Makers found in trash',
			'parent_item_colon' 	=> 'Parent Maker:',
			'menu_name' 			=> 'Makers'
		);
		$args = array(
			'labels' 				=> $labels,
			'description' 			=> 'Makers',
			'public' 				=> true,
			'exclude_from_search' 	=> true,
			'publicly_queryable' 	=> true,
			'show_ui' 				=> true,
			'show_in_nav_menus' 	=> true,
			'show_in_menu' 			=> true,
			'show_in_admin_bar' 	=> true,
			'menu_position' 		=> 20,
			'menu_icon' 			=> null,
			'capability_type'		=> 'post',
			'hierarchical' 			=> true,
			'supports' 				=> array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions',  ),
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
}

$makers = new Make_Makers();
