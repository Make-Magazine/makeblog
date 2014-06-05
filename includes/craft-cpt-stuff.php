<?php
/**
 * Functions for the Craft Custom Post Type
 *
 * 
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Jake Spurlock <jspurlock@makermedia.com>
 */
/**
 * Registers the Craft CPT
 */
function register_cpt_craft() {

	$labels = array( 
		'name' => _x( 'Craft Posts', 'craft' ),
		'singular_name' => _x( 'Craft Post', 'craft' ),
		'add_new' => _x( 'Add New', 'craft' ),
		'add_new_item' => _x( 'Add New Craft Post', 'craft' ),
		'edit_item' => _x( 'Edit Craft Post', 'craft' ),
		'new_item' => _x( 'New Craft Post', 'craft' ),
		'view_item' => _x( 'View Craft Post', 'craft' ),
		'search_items' => _x( 'Search Craft Posts', 'craft' ),
		'not_found' => _x( 'No Craft Posts found', 'craft' ),
		'not_found_in_trash' => _x( 'No Craft Posts found in Trash', 'craft' ),
		'parent_item_colon' => _x( 'Parent Craft:', 'craft' ),
		'menu_name' => _x( 'Craft', 'craft' ),
	);

	$args = array( 
		'labels' => $labels,
		'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'post-formats' ),
		'taxonomies' => array( 'category', 'post_tag', 'page-category', 'maker', 'location' ),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'has_archive' => true,
		'query_var' => true,
		'can_export' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'menu_position' => 43,
	);

	register_post_type( 'craft', $args );
}
add_action( 'init', 'register_cpt_craft' );

/**
  * Easy Custom Field Info -- Soon to be depracated.
 */
$field_data = array (
	'RSS' => array (
		'fields' => array(
			'rss' => array(
				'type' => 'toggle'
				),
		),
	'title'		=> 'RSS Feed of MAKE',
	'context'	=> 'side',
	'pages'		=> array( 'craft' ),
	),
);
$easy_cf = new Easy_CF($field_data);


$field_data = array (
	'magazine_meta' => array (
		'fields' => array(
			'Description'		=> array(),
		),
		'title'		=> 'Craft Meta',
		'context'	=> 'side',
		'pages'		=> array( 'craft' ),
	),
);
$easy_cf = new Easy_CF($field_data);

/**
  * Grab the craft header if we are on a craft page.
  * @deprecated Function deprecated in Jet Jaguar
 */
function make_get_header() {
	if (is_single()) {
		$primary_cat = get_the_category();
		if ( $primary_cat != null ) {
			$primary_cat = $primary_cat[0]->term_id;
		} else {
			$primary_cat = null;
		}
		
	} elseif (is_category()) {
		$primary_cat = get_queried_object_id();
	} else {
		$primary_cat = null;
	}
	if ( $primary_cat == 15803 || $primary_cat == 30694999 || 'craft' == get_post_type() ) {
		get_header('craft');
	} else { 
		get_header();
	}
}

function make_craft_101() {

	$craft_query = new WP_Query( array(
		'tag_id' => 29038,
		'posts_per_page'  => 20,
		'no_found_rows' => true,
		'post_type' => 'craft',
		'fields' => 'ids',
	) );
	$craft_ids = $craft_query->get_posts();

	if ( ! empty( $craft_ids ) ) :
		shuffle( $craft_ids );
		$craft_id = array_shift( $craft_ids );
		$post = get_post( $craft_id );

		$output = null;

		if ( $post ) : setup_postdata( $post );
			$output .= '<a href="' . get_permalink( $post->ID ) . '">';
			$output .= get_the_image( array( 'post_id' => $post->ID, 'image_scan' => true, 'size' => 'small-home-feature-boxes', 'image_class' => 'hide-thumbnail' ) );
			$output .= '<h4>' . get_the_title( $post->ID ) . '</h4>';
			$output .= '<p>'.wp_trim_words( strip_shortcodes( $post->post_content ), 12 ).'</p>';
			$output .= '</a>';
		endif;

		return $output;

	endif;

	// Reset Post Data
	wp_reset_postdata();

}