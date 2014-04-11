<?php

function newsletter_init() {
	register_post_type( 'newsletter', array(
		'hierarchical'			=> true,
		'public'				=> true,
		'show_in_nav_menus'		=> true,
		'show_ui'				=> true,
		'supports'				=> array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'trackbacks', 'comments', 'revisions', 'page-attributes' ),
		'has_archive'			=> true,
		'query_var'				=> true,
		'rewrite'				=> array( 'slug' => 'newsletters' ),
		'taxonomies'			=> array( 'category', 'post_tag', 'maker' ),
		'labels'				=> array(
			'name'					=> __( 'Newsletters', 'makeblog' ),
			'singular_name'			=> __( 'Newsletter', 'makeblog' ),
			'add_new'				=> __( 'Add new newsletter', 'makeblog' ),
			'all_items'				=> __( 'Newsletters', 'makeblog' ),
			'add_new_item'			=> __( 'Add new newsletter', 'makeblog' ),
			'edit_item'				=> __( 'Edit newsletter', 'makeblog' ),
			'new_item'				=> __( 'New newsletter', 'makeblog' ),
			'view_item'				=> __( 'View newsletter', 'makeblog' ),
			'search_items'			=> __( 'Search newsletters', 'makeblog' ),
			'not_found'				=> __( 'No newsletters found', 'makeblog' ),
			'not_found_in_trash'	=> __( 'No newsletters found in trash', 'makeblog' ),
			'parent_item_colon'		=> __( 'Parent newsletter', 'makeblog' ),
			'menu_name'				=> __( 'Newsletters', 'makeblog' ),
		),
	) );

}
add_action( 'init', 'newsletter_init' );

function newsletter_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['newsletter'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __('Newsletter updated. <a target="_blank" href="%s">View newsletter</a>', 'makeblog'), esc_url( $permalink ) ),
		2 => __('Custom field updated.', 'makeblog'),
		3 => __('Custom field deleted.', 'makeblog'),
		4 => __('Newsletter updated.', 'makeblog'),
		/* translators: %s: date and time of the revision */
		5 => isset($_GET['revision']) ? sprintf( __('Newsletter restored to revision from %s', 'makeblog'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Newsletter published. <a href="%s">View newsletter</a>', 'makeblog'), esc_url( $permalink ) ),
		7 => __('Newsletter saved.', 'makeblog'),
		8 => sprintf( __('Newsletter submitted. <a target="_blank" href="%s">Preview newsletter</a>', 'makeblog'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		9 => sprintf( __('Newsletter scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview newsletter</a>', 'makeblog'),
		// translators: Publish box date format, see http://php.net/date
		date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		10 => sprintf( __('Newsletter draft updated. <a target="_blank" href="%s">Preview newsletter</a>', 'makeblog'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'newsletter_updated_messages' );


function make_get_newsletter_children( $id ) {
	$args = array(
		'post_parent'	=> $id,
		'post_status'	=> 'published',
		'post_type'		=> 'newsletter',
		'orderby'		=> 'menu_order',
		'order'			=> 'ASC'

	);
	// Get the kids
	$kids = new WP_Query( $args );
	// Drop them off at the pool...
	$output = '';
	while ( $kids->have_posts() ) : $kids->the_post();
		$post_ID = get_the_ID();
		$output .= '<section>';
		$output .= '<h2>' . get_the_title() . '</h2>';
		$output .= get_the_content();
		$output .= '<div class="comment-link"><a href="' . get_comments_link( $post_ID ) . '">Leave a comment on this section</a></div>';
		$output .= '</section>';
		$output .= make_get_newsletter_children( get_the_ID() );
	endwhile;
	// Get ready for the next round.
	wp_reset_postdata();
	return $output;
}

function make_add_children($content) {
	global $post;
	if ('newsletter' == get_post_type() ) {
		$content = $content . make_get_newsletter_children( get_the_ID() );
	}
	return $content;
}

add_filter( 'the_content', 'make_add_children', 4 );


/**
 * Add private/draft/future/pending pages to parent dropdown in page attributes metabox and Quick Edit
 *
 * @param array $dropdown_args
 * @param object $post (Optional)
 * @return array $dropdown_args
 */
function make_page_attributes_metabox_add_parents( $dropdown_args, $post = NULL ) {
	$dropdown_args['post_status'] = array('publish', 'draft', 'pending', 'future', 'private');
	return $dropdown_args;
}

add_filter( 'page_attributes_dropdown_pages_args', 'make_page_attributes_metabox_add_parents', 10, 2 );
add_filter( 'quick_edit_dropdown_pages_args', 'make_page_attributes_metabox_add_parents', 10);

/**
 * Add (status) to titles in page parent dropdowns
 *
 * @param string $title
 * @param object $page
 * @return string $title
 */
function make_page_parent_status_filter( $title, $page ) {
	$status = $page->post_status;
	if ($status != __('publish'))
		$title .= " ($status)";
	return $title;
}

add_filter( 'list_pages', 'make_page_parent_status_filter', 10, 2);

/**
 * Filter pages metabox on menu admin screen to include all built-in statuses.
 *
 * @param object $query
 * @return object $query
 */
function make_private_page_query_filter($query) {
	if ( is_admin() ) {
		if ( function_exists( 'get_current_screen' ) ) {
			$screen = get_current_screen();
			// if ( 'nav-menus' == $screen->base )
				// $query->set( 'post_status', 'publish,private,future,pending,draft' );
		}
	}
	return $query;
}

add_filter('pre_get_posts', 'make_private_page_query_filter');

/**
 * Filter lists of pages to include privately published ones.
 * This a duplicate of wp_list_pages() except we change post_status in the default args, and we return without echoing.
 *
 * @param string $output Original output of wp_list_pages(), which we will overwrite.
 * @param array|string $args Parsed arguments passed from wp_list_pages().
 * @return string HTML content.
 */
function make_wp_list_pages_with_private($output, $args) {
	$defaults = array( 'post_status' => 'publish,private' );  // other defaults already parsed in wp_list_pages()

	$r = wp_parse_args( $args, $defaults );
	extract( $r, EXTR_SKIP );

	$output = '';
	$current_page = 0;

	// sanitize, mostly to keep spaces out
	$r['exclude'] = preg_replace('/[^0-9,]/', '', $r['exclude']);

	// Allow plugins to filter an array of excluded pages (but don't put a nullstring into the array)
	$exclude_array = ( $r['exclude'] ) ? explode(',', $r['exclude']) : array();
	$r['exclude'] = implode( ',', apply_filters('wp_list_pages_excludes', $exclude_array) );

	// Query pages.
	$r['hierarchical'] = 0;
	$pages = get_pages($r);

	if ( !empty($pages) ) {
		if ( $r['title_li'] )
			$output .= '<li class="pagenav">' . $r['title_li'] . '<ul>';

		global $wp_query;
		if ( is_page() || is_attachment() || $wp_query->is_posts_page )
			$current_page = $wp_query->get_queried_object_id();
		$output .= walk_page_tree($pages, $r['depth'], $current_page, $r);

		if ( $r['title_li'] )
			$output .= '</ul></li>';
	}

	return $output;
}

add_filter('wp_list_pages', 'make_wp_list_pages_with_private', 1, 2);
