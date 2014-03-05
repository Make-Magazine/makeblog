<?php
/**
 * Categories functions
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author 	   Jake Spurlock <jspurlock@makermedia.com>
 * 
 */

/**
 * Globals for category links
 *
 * When redoing the category structure, we wanted have a list of categories that we would feature all over the site.
 * If we did wp_list_categories, we would get all of them, so I created these functions to spit everything out based on the categories that we wanted.
 */
$GLOBALS['catslugs'] = array( 'Electronics', 'Workshop', 'Craft', 'Science', 'Home', 'Art &amp; Design', /*'Maker Pro'*/ );

/**
 * Search for a page with the same name as a category, and then dump the content into the existing page.
 *
 * Easier way to build category super pages. We could build them as pages, and then include it on existing category pages.
 */
function make_category_page_fill() {
	
	$cat_name = get_queried_object()->name;
	$page = wpcom_vip_get_page_by_title( $cat_name );
	
	$args = array(
		'page_id' => $page->ID,
		);
	
	$category_post = new WP_Query( $args );

	while ($category_post->have_posts()) : $category_post->the_post();

		the_content();

	endwhile;
}

/**
 * Generate the list items for the child categories, given a slug.
 *
 * When redoing the category structure, we wanted have a list of categories that we would feature all over the site.
 * If we did wp_list_categories, we would get all of them, so I created these functions to spit everything out based on the categories that we wanted.
 * @uses wpcom_vip_get_term_by()
 * @uses get_categories()
 * @uses get_category_link()
 * @param string|array $slug Slugs of category.
 * @param bool Whether or not to add projects as a query string.
 * @return string List items containing link to child categories. If none exist, nothing.
 */
function make_sub_category_list( $id, $projects = false ) {
	$args = array();
	if ( $projects == false && isset( $id->term_id ) ) {
		$args = array(
			'orderby' => 'name',
			'child_of' => $id->term_id
		);
	} else {
		$args = array(
			'orderby' => 'name',
			'child_of' => $id
			);
	}
	if ( $args['child_of'] == null ) {
		return;
	}
	$categories = get_categories( $args );
	$output = null;
	foreach($categories as $category) { 
		if ($projects == true ) { 
			$output .= '<li><a href="' . get_category_link( $category->term_id ) . '?post_type=projects" title="' . sprintf( __( "View all posts in %s" ), $category->name ) . '" ' . '>' . $category->name.'</a> </li>';
		} else {
			$output .= '<li><a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "View all posts in %s" ), $category->name ) . '" ' . '>' . $category->name.'</a> </li>';
		}
	}
	return $output;
}

/**
 * Retrives the URL of a given slug.
 * Switched to just use the full term object so we don't have to check against the taxonomy.
 * 
 * @uses get_category_link() Returns the correct url for a given Category ID.
 * @uses wpcom_vip_get_term_by() Cached version of get_category_by_slug
 * @param string|array $slug Slugs of category.
 * @param string $taxonomy to query against. Defaults to category.
 * @return string Link to slug archive page.
 */
function make_get_category_url( $slug, $taxonomy='category', $field = 'name' ) {
	$category = wpcom_vip_get_term_by( $field, $slug, $taxonomy );
	if ( ! $category ) {
		return false;
	} else {
		return get_term_link( $category );
	}
}

/**
 * Generates a page of categories and sub categories.
 *
 * @uses get_category_link() Returns the correct url for a given Category ID.
 * @uses wpcom_vip_get_term_by() Cached version of get_category_by_slug
 */
function make_category_list() {
	global $catslugs;
	foreach($catslugs as $slug) {
		echo '<div class="cat" id="' . $slug . '"><div class="cat-home">';
		echo '<h2><a href="' . make_get_category_url( $slug ) .'">' . $slug . '</a></h2>';
		echo '<ul class="drop-down">';
		echo make_sub_category_list( wpcom_vip_get_category_by_slug( $slug ) );
		echo '</ul></div></div><!-- ' . $slug . ' -->';
	}
}


/**
 * Generate the list items for categories, given a slug.
 *
 * @uses get_category_link() Returns the correct url for a given Category ID.
 * @uses wpcom_vip_get_term_by() Cached version of get_category_by_slug
 */
function make_category_li( $post_type = '' ) {
	global $catslugs;

	$output = null;

	if ( ! empty( $post_type ) && is_array( $post_type ) )
		$post_type = implode( ',', $post_type );

	foreach ( $catslugs as $slug ) {
		$category = wpcom_vip_get_term_by('name', $slug, 'category');
		if ( ! empty( $post_type ) ) {
			$output .= '<div class="dropdown">';
			$output .= '<li><a href="' . get_category_link( $category->term_id ) . '?post_type=' . urlencode( $post_type ) . '" title="' . sprintf( __( 'View all posts in %s' ), esc_attr( $category->name ) ) . '" data-target="#" data-toggle="dropdown" class="dropdown-toggle" ' . '>' . esc_html( $category->name ) .'  <b class="caret"></b></a>';
			$children = get_categories( $args = array( 'parent' => $category->term_id, ) );
			if (isset($children)) {
				$output .= '<ul class="dropdown-menu">';
				$output .= '<li><a href="' . get_category_link( $category->term_id ) . '?post_type=' . urlencode( $post_type ) . '" title="' . sprintf( __( 'View all posts in %s' ), esc_attr( $category->name ) ) . '"' . '>' . esc_html( $category->name ) .'</a>';
				$output .= '<li class="divider"></li>';
				foreach ( $children as $child ) {
					$output .= '<li><a href="' . get_category_link( $child->term_id ) . '?post_type=' . urlencode( $post_type ) . '" title="' . sprintf( __( 'View all posts in %s' ), esc_attr( $child->name ) ) . '" ' . '>' . esc_html( $child->name ) .'</a>';
				}
				$output .= '</ul>';
			}
			$output .= '</li>';
			$output .= '</div>';

		} else {
			$output .= '<li><a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( 'View all posts in %s' ), esc_attr( $category->name ) ) . '" ' . '>' . esc_html( $category->name ) .'</a></li>';
		}
	} 

	$output .= '<li><a href="' . home_url( 'weekendprojects' ) . '">Weekend Projects</li>';
	
	return $output;
}


/**
 * Generate an ordered list, with bullets inbetween the links.
 *
 * @uses get_categories() Retrieves all of the child categories for the given category.
 * @uses get_category_link() Returns the correct url for a given Category ID.
 * @uses get_queried_object_id() Finds the page that we are on.
 */
function make_child_category_list() {
	$catobj = get_queried_object();
	$cat_ID = $catobj->cat_ID;
	$args = array(
		'type'                     => 'post',
		'child_of'                 => $cat_ID,
		'parent'                   => '',
		'orderby'                  => 'name',
		'order'                    => 'ASC',
		'hide_empty'               => 1,
		'hierarchical'             => 1,
		'exclude'                  => '',
		'include'                  => '',
		'number'                   => '',
		'taxonomy'                 => 'category',
		'pad_counts'               => false);

	$categories = get_categories( $args );
	
	if ( make_pregnancy_check( $cat_ID ) ) {
		echo '<h3>More in ' . get_queried_object()->name . '</h3>';	
	}
	echo '<ul class="subs">';
	$count = count($categories);
	$i = 0;
	foreach ($categories as $category) {
		echo '<li><h2 class="no_h2_styles"><a href="' . get_category_link( $category->term_id ) . '">' . $category->cat_name . '</a></h2></li>';
		if(++$i != $count) {
			echo '<li>&bull;</li>';	
		}
	}
	echo '</ul>';
}

/**
 * Test to see if a category has any children.
 *	
 * @param int $id ID of category.
 * @uses get_categories() Retrieves all of the child categories for the given category.
 * @return true|false
 */
function make_pregnancy_check($id) {
	$children = get_categories( array( 'child_of' => $id, 'hide_empty' => 0 ) );
	if ( count( $children ) > 1 ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Return an array of child category IDs. If none exist, return false.
 *	
 * @param int $id ID of category.
 * @uses get_categories() Retrieves all of the child categories for the given category.
 * @return array|false
 */
function make_children($id) {
	$children = get_categories( array( 'child_of' => $id, 'hide_empty' => 0 ) );
	if ( count( $children ) > 1 ) {
		return $children;
	} else {
		return false;
	}
}