<?php

add_action( 'init', 'make_register_cpt_video' );

function make_register_cpt_video() {

	add_rewrite_rule( 'video/([^/]*)/([^/]*)/?$','index.php?video=$matches[2]','top' );

	$labels = array( 
		'name' => _x( 'Videos', 'video' ),
		'singular_name' => _x( 'Video', 'video' ),
		'add_new' => _x( 'Add New', 'video' ),
		'add_new_item' => _x( 'Add New Video', 'video' ),
		'edit_item' => _x( 'Edit Video', 'video' ),
		'new_item' => _x( 'New Video', 'video' ),
		'view_item' => _x( 'View Video', 'video' ),
		'search_items' => _x( 'Search Videos', 'video' ),
		'not_found' => _x( 'No videos found', 'video' ),
		'not_found_in_trash' => _x( 'No videos found in Trash', 'video' ),
		'parent_item_colon' => _x( 'Parent Video:', 'video' ),
		'menu_name' => _x( 'Videos', 'video' ),
	);

	$args = array( 
		'labels' => $labels,
		'hierarchical' => true,
		'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes' ),
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

	register_post_type( 'video', $args );
}

add_action( 'init', 'make_register_taxonomy_playlist' );

function make_register_taxonomy_playlist() {

	$labels = array( 
		'name' => _x( 'Playlists', 'playlist' ),
		'singular_name' => _x( 'Playlist', 'playlist' ),
		'search_items' => _x( 'Search Playlists', 'playlist' ),
		'popular_items' => _x( 'Popular Playlists', 'playlist' ),
		'all_items' => _x( 'All Playlists', 'playlist' ),
		'parent_item' => _x( 'Parent Playlist', 'playlist' ),
		'parent_item_colon' => _x( 'Parent Playlist:', 'playlist' ),
		'edit_item' => _x( 'Edit Playlist', 'playlist' ),
		'update_item' => _x( 'Update Playlist', 'playlist' ),
		'add_new_item' => _x( 'Add New Playlist', 'playlist' ),
		'new_item_name' => _x( 'New Playlist', 'playlist' ),
		'separate_items_with_commas' => _x( 'Separate playlists with commas', 'playlist' ),
		'add_or_remove_items' => _x( 'Add or remove playlists', 'playlist' ),
		'choose_from_most_used' => _x( 'Choose from the most used playlists', 'playlist' ),
		'menu_name' => _x( 'Playlists', 'playlist' ),
	);

	$args = array( 
		'labels' => $labels,
		'public' => true,
		'show_in_nav_menus' => true,
		'show_ui' => true,
		'show_tagcloud' => true,
		'hierarchical' => true,
		'rewrite' => true,
		'query_var' => true
	);

	register_taxonomy( 'playlist', array('video','post'), $args );
}

$field_data = array (
	'advanced_testgroup' => array (
		'fields' => array(
			'Description'				=> array(),
			'Link'						=> array(
											'hint' => 'Add a URL here for the YouTube video that is the in post. This is also where the thumbnail comes from.',
											),
			'MakeProjectsGuideNumber'	=> array(),
			'Image'						=> array(),
	),
	'title'		=> 'Video Meta',
	'context'	=> 'side',
	'pages'		=> array( 'video' ),
	),
);

$easy_cf = new Easy_CF($field_data);


function make_magazine_video_toc() {
	global $post;
	$args = array(
		'post_parent' => $post->ID,
		'no_found_rows' => true,
		'post_type' => 'video'
	);
	
	if($post->post_parent == 0) {
		echo '<h3>Videos</h3>';
	}

	$the_query = new WP_Query( $args );

	while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

		<Project <?php post_class(); ?>>

			<div class="cat-thumb">

				<?php get_the_image( array( 'image_scan' => true, 'size' => 'archive-thumb' ) ); ?>

			</div>

			<div class="cat-blurb">

				<h3><a class="red" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

				<p><?php echo wp_trim_words(get_the_excerpt(), 30, '...'); ?></p>

				<p class="meta">By <?php the_author_posts_link(); ?>, <?php the_time('m/d/Y \@ g:i a') ?></p>
				<p>Categories: <?php the_category(', '); ?> | <?php comments_popup_link(); ?> <?php edit_post_link('Fix me...', ' | '); ?></p>

			</div>

			<div class="clear"></div>
			
			<hr />

		</Project> 

	<?php endwhile;

	// Reset Post Data
	wp_reset_postdata();

}


add_action('add_meta_boxes', 'make_video_add_meta_box');

function make_video_add_meta_box() { 
	add_meta_box('volume-parent', 'Magazine Volume', 'make_magazine_parent_page', 'video', 'side', 'high');
}

add_action( 'admin_menu', 'make_video_remove_parent_meta_box' );

function make_video_remove_parent_meta_box() { 
	remove_meta_box('pageparentdiv', 'video', 'normal');
}

add_filter( 'the_content', 'make_video_add_review' );

function make_video_add_review($content) {
	global $post;
	if ('video' == get_post_type()) {
		$guide = get_post_custom_values('MakeProjectsGuideNumber');
		if (isset($guide[0])) {
			$content .= js_make_project($guide);
		}
		return $content;
	} else {
		return $content;
	}
}