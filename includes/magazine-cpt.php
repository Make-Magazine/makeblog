<?php

add_action( 'init', 'register_cpt_article' );

function register_cpt_article() {

	add_rewrite_rule( 'magazine/([^/]*)/([^/]*)/?$','index.php?magazine=$matches[2]','top' );

	$labels = array(
		'name' => _x( 'Articles', 'article' ),
		'singular_name' => _x( 'Article', 'article' ),
		'add_new' => _x( 'Add New', 'article' ),
		'add_new_item' => _x( 'Add New Article', 'article' ),
		'edit_item' => _x( 'Edit Article', 'article' ),
		'new_item' => _x( 'New Article', 'article' ),
		'view_item' => _x( 'View Article', 'article' ),
		'search_items' => _x( 'Search Articles', 'article' ),
		'not_found' => _x( 'No articles found', 'article' ),
		'not_found_in_trash' => _x( 'No articles found in Trash', 'article' ),
		'parent_item_colon' => _x( 'Parent Article:', 'article' ),
		'menu_name' => _x( 'Articles', 'article' ),
	);

	$args = array(
		'labels' => $labels,
		'hierarchical' => true,
		'description' => 'MAKE magazine articles will be stored here. Goal is to build the back archive of all issues and articles.',
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
		'menu_position' => 41,
	);

	register_post_type( 'magazine', $args );
}

add_action( 'init', 'volume_register_cpt_article' );

function volume_register_cpt_article() {

	$labels = array(
		'name' => _x( 'Volumes', 'volume' ),
		'singular_name' => _x( 'Volume', 'volume' ),
		'add_new' => _x( 'Add New', 'volume' ),
		'add_new_item' => _x( 'Add New Volume', 'volume' ),
		'edit_item' => _x( 'Edit Volume', 'volume' ),
		'new_item' => _x( 'New Volume', 'volume' ),
		'view_item' => _x( 'View Volume', 'volume' ),
		'search_items' => _x( 'Search Volumes', 'volume' ),
		'not_found' => _x( 'No volumes found', 'volume' ),
		'not_found_in_trash' => _x( 'No volumes found in Trash', 'volume' ),
		'parent_item_colon' => _x( 'Parent Volume:', 'volume' ),
		'menu_name' => _x( 'Volumes', 'volume' ),
	);

	$args = array(
		'labels' => $labels,
		'hierarchical' => true,
		'description' => 'MAKE magazine articles will be stored here. Goal is to build the back archive of all issues and articles.',
		'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes' ),
		'taxonomies' => array(),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => true,
		'has_archive' => true,
		'query_var' => true,
		'can_export' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'menu_position' => 46,
	);

	register_post_type( 'volume', $args );
}

$field_data = array (
	'magazine_meta' => array (
		'fields' => array(
			'Hed'				=> array(),
			'Description'		=> array(),
			'PullQuotes'		=> array(),
			'PageNumber'		=> array(),
			'ProjectsTeaser'	=> array(),
			'Cost'	 			=> array(),
			'Byline' 			=> array(),
			'Conclusion'		=> array(
									'type' 	=> 'textarea',
									'label'	=> 'Projects Conclusion',
									),
			'Updates'			=> array(
									'type' 	=> 'textarea',
									'label'	=> 'Updates',
									),
	),
	'title'		=> 'Magazine Meta',
	'context'	=> 'side',
	'pages'		=> array( 'magazine' ),
	),
);

$easy_cf = new Easy_CF($field_data);

// Add a description (aka Dek) field for posts - We are going to stick this here because
// no other spot makes sense
$field_data = array (
	'magazine_meta' => array (
		'fields' => array(
			'Description'		=> array(),
		),
		'title'		=> 'Post Meta',
		'context'	=> 'side',
		'pages'		=> array( 'post', 'craft' ),
	),
);
$easy_cf = new Easy_CF($field_data);


$field_data = array (
	'magazine_author' => array (
		'fields' => array(
			'AuthorBio'			=> array( 'type' => 'textarea', 'label' => 'Author Bio' ),
			'Phone'				=> array(),
			'Email'				=> array(),
	),
	'title'		=> 'Magazine Author',
	'context'	=> 'side',
	'pages'		=> array( 'magazine', 'review', 'projects' ),
	),
);

$easy_cf = new Easy_CF($field_data);

function make_post_loop( $args ) {
	$defaults = array(
		'post_type'			=> 'projects',
		'title' 			=> 'Articles',
		'cat'	 			=> null,
		'parent' 			=> null,
		'posts_per_page' 	=> 100,
		'orderby' 			=> 'name',
		'order' 			=> 'asc',
		'tax_query'			=> array()
		);

	$args = wp_parse_args( $args, $defaults );

	global $post;

	$the_query = new WP_Query( $args );

	// Need a way to filter out the title if there are no results in the query.
	if($post->post_parent == 0 && !empty($the_query->posts) ) {
		echo '<h3 class="heading look_like_h4_cat">'. esc_html( $args['title']  ) .'</h3>';

	}

	while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

		<div <?php post_class(); ?>>

			<div class="media video-box">

				<div class="media-object pull-left">
					<?php $type = get_post_type( $post ); ?>
					<?php echo '<span class="' . $type .'-icon"></span>';
					$image = get_post_custom_values('Image', $post->ID);
					if ( !empty( $image[0] ) )  {
						echo '<img src="' . wpcom_vip_get_resized_remote_image_url( make_projects_to_s3( $image[0] ), 218, 146 ) . '" alt="' . esc_attr( the_title('', '', false ) ) . '" />';
					} else {
						get_the_image( array( 'image_scan' => true, 'size' => 'category-thumb-small', 'image_class' => 'hide-thumbnail pull-left' ) );
					} ?>
				</div>

				<div class="media-body">

					<h3><a class="" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

					<p><?php echo wp_trim_words(get_the_excerpt(), 8, '...'); ?></p>

					<p class="meta">
						<?php
						if(function_exists('coauthors_posts_links')) {
							coauthors();
						} else {
							the_author_posts_link();
						}
						echo make_page_number();
						?>
					</p>

					<?php if ($args['post_type'] == 'projects' ) {
						$time = get_post_custom_values( 'TimeRequired' );
						$terms = get_the_terms( $post->ID, 'difficulty' );
						echo '<ul class="unstyled">';
						if ($terms) {
							foreach ($terms as $term) {
								echo '<li><strong>Difficulty:</strong> ' . esc_html( $term->name ) . '</li>';
							}
						}
						if (!empty($time[0])) {
							echo '<li><strong>Time Required:</strong> ' . esc_html( $time[0] ) . '</li>';
						}

					} else { ?>
						<p>Categories: <?php the_category(', '); ?> | <?php comments_popup_link(); ?> <?php edit_post_link('Fix me...', ' | '); ?></p>
					<?php }	?>

				</div>

			</div>

		</div>

	<?php endwhile;

	// Reset Post Data
	wp_reset_postdata();

	echo '<div class="clear"></div>';

}

add_shortcode( 'make_toc', 'make_magazine_toc' );

function make_magazine_toc( $args ) {
	global $post;

	$defaults = array(
		'post_type' 		=> 'magazine',
		'title' 			=> 'Articles',
		'cat' 				=> '',
		'post_parent' 		=> null,
		'posts_per_page' 	=> 200,
		'orderby' 			=> 'name',
		'order' 			=> 'asc',
		'post_status'		=> array( 'publish', 'published-in-mag' ),
		);

	$args = wp_parse_args( $args, $defaults );

	$the_query = new WP_Query( $args );
	$output = '';

	// Need a way to filter out the title if there are no results in the query.

	if( !empty( $the_query->posts ) ) {
		$output .= '<h3>'. esc_html( $args['title']  ) .'</h3>';
	}

	while ( $the_query->have_posts() ) : $the_query->the_post(); setup_postdata( $post );

		$post_class = get_post_class( 'row' );
		$classes = '';
		foreach ($post_class as $class) {
			$classes .= ' ' . $class;
		}

		$output .= '<article  class="' . $classes .  '">';

			$output .= '<div class="span2">';
					$image = get_post_custom_values('Image', $post->ID);
					if ( !empty( $image[0] ) )  {
						$output .= '<img src="' . wpcom_vip_get_resized_remote_image_url( make_projects_to_s3( $image[0] ), 140, 140 ) . '" alt="' . esc_attr( the_title('', '', false ) ) . '" />';
					} else {
						$output .= get_the_image( array( 'image_scan' => true, 'size' => 'new-thumb', 'image_class' => 'hide-thumbnail', 'echo' => false, 'link_to_post' => false ) );
					}
			$output .= '</div>';

			$output .= '<div class="span6">';

				$output .= '<h3>';

				if ( $post->post_status != 'published-in-mag' ) {
					$output .= '<a class="red" href="' . get_permalink($post->ID) . '">' . get_the_title() . '</a>';
				} else {
					$output .= get_the_title();
				}

				$output .= '</h3>';

				$output .= '<p>' . wp_trim_words(get_the_excerpt(), 30, '...') . '</p>';

				$output .= '<p class="meta">';
					if(function_exists('coauthors_posts_links')) {
						$output .= coauthors_posts_links( ', ', ', and ', 'By ', null, false );
					} else {
						$output .= 'By <a href="' .  get_author_posts_url( get_the_author_meta( 'ID' ) ) . '">' . the_author_meta( 'display_name' ) . '</a>';
					}
					$output .= make_page_number();
				$output .= '</p>';
				$categories = get_the_category();
				$separator = ' ';
				$cats = '';
				if( $categories ){
					foreach( $categories as $category ) {
						$cats .= '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '">'.$category->cat_name.'</a>'.$separator;
					}
					$output .= '<p>Categories: ' . trim($cats, $separator) . '</p>';
				}

			$output .= '</div>';

		$output .= '</article>';




	endwhile;

	return $output;

	// Reset Post Data
	wp_reset_postdata();

}


add_action('add_meta_boxes', 'make_add_meta_box');

function make_add_meta_box() {
	add_meta_box('volume-parent', 'Magazine Volume', 'make_magazine_parent_page', 'magazine', 'side', 'high');
}

add_action( 'admin_menu', 'make_remove_parent_meta_box' );

function make_remove_parent_meta_box() {
	remove_meta_box('pageparentdiv', 'magazine', 'normal');
}


function make_magazine_parent_page($post) {
	$post_type_object = get_post_type_object($post->post_type);
	if ( $post_type_object->hierarchical ) {
		$pages = wp_dropdown_pages(array('post_type' => 'volume', 'selected' => $post->post_parent, 'name' => 'parent_id', 'show_option_none' => __('(no parent)'), 'sort_column'=> 'menu_order, post_title', 'echo' => 0));
		if ( ! empty($pages) ) {
			echo $pages;
		} // end empty pages check
	} // end hierarchical check.
}

add_action( 'init', 'register_taxonomy_section' );

function register_taxonomy_section() {

	$labels = array(
		'name' => _x( 'Section', 'section' ),
		'singular_name' => _x( 'Section', 'section' ),
		'search_items' => _x( 'Search Sections', 'section' ),
		'popular_items' => _x( 'Popular Sections', 'section' ),
		'all_items' => _x( 'All Sections', 'section' ),
		'parent_item' => _x( 'Parent Section', 'section' ),
		'parent_item_colon' => _x( 'Parent Section:', 'section' ),
		'edit_item' => _x( 'Edit Section', 'section' ),
		'update_item' => _x( 'Update Section', 'section' ),
		'add_new_item' => _x( 'Add New Section', 'section' ),
		'new_item_name' => _x( 'New Section', 'section' ),
		'separate_items_with_commas' => _x( 'Separate section with commas', 'section' ),
		'add_or_remove_items' => _x( 'Add or remove section', 'section' ),
		'choose_from_most_used' => _x( 'Choose from the most used section', 'section' ),
		'menu_name' => _x( 'Sections', 'section' ),
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

	register_taxonomy( 'section', array( 'magazine', 'projects', 'review' ), $args );
}

$field_data = array (
	'advanced_testgroup' => array (
		'fields' => array(
			'FeaturedPosts'		=> array(),
			'VideoURL'			=> array(),
			'PostsBlurb'		=> array(),
			'Categories'		=> array(),
			'MarketingCaption'	=> array(
				'type'	=> 'textarea'
			),
		),
		'title'		=> 'Magazine Volume Setup',
		'context'	=> 'side',
		'pages'		=> array( 'volume', 'magazine' ),
	),
);

$easy_cf = new Easy_CF($field_data);

function make_page_number( $date = false ) {
	global $post;
	$pagenum = get_post_meta($post->ID, 'PageNumber', true );
	if ( !empty( $pagenum ) ) {
		$output = ' | ';
		$output .= '<a href="' . get_permalink() .'">Page ';
		$output .= esc_html( get_post_meta( $post->ID, 'PageNumber', true ) );
		$output .= '</a>';
		return $output;
	}
	if ( $date == true ) {
		$output = ' | ';
		$output .= '<a href="' . get_permalink() .'">';
		$output .= get_the_time('l F jS, Y g:i A');
		$output .= '</a>';
		return $output;
	}
}

add_filter( 'manage_edit-magazine_columns', 'make_columns_filter', 10, 1 );
add_filter( 'manage_edit-projects_columns', 'make_columns_filter', 10, 1 );
add_filter( 'manage_edit-review_columns', 'make_columns_filter', 10, 1 );

function make_columns_filter( $columns ) {
	$post_parent = array( 'post_parent' => 'Post Parent' );
	$columns = array_slice( $columns, 0, 2, true ) + $post_parent + array_slice( $columns, 2, NULL, true );
	return $columns;
}

add_action( 'manage_magazine_posts_custom_column', 'make_column_action', 10, 1 );
add_action( 'manage_projects_posts_custom_column', 'make_column_action', 10, 1 );
add_action( 'manage_review_posts_custom_column', 'make_column_action', 10, 1 );

function make_column_action( $column ) {
	global $post;
	switch ( $column ) {
		case 'post_parent':
			if ( $post->post_parent !== 0  ) {
				echo '<a href="' . esc_url( add_query_arg( array( 'post_type' => $post->post_type, 'post_parent' => $post->post_parent ), admin_url( 'edit.php' ) ) ) . '">' . get_the_title( $post->post_parent ) . '</a>';
			}
			break;
	}
}

add_shortcode( 'make_projects_projects', 'make_maker_projects_projects' );

function make_maker_projects_projects() {
	$output = '';
	$args = array(
		'post__in'			=> array( 308202, 307019, 307584, 269342, 268475, 306681, 308288, 268757, 306781 ),
		'post_type' 		=> array( 'projects', 'review', 'magazine', 'volume', 'post' ),
		'title'			 	=> 'Electronics',
		);
	$output .= make_magazine_toc($args);

	$args = array(
		'post__in'			=> array( 267847, 307395, 308366, 269299, 267499, 307643, 267868, 269644, 308316, 267475 ),
		'post_type' 		=> array( 'projects', 'review', 'magazine', 'volume', 'post' ),
		'title'			 	=> 'Home',
		);
	$output .= make_magazine_toc($args);

	$args = array(
		'post__in'			=> array( 269424, 306655, 268163, 267478, 308356, 26748, 268570, 269242, 267959 ),
		'post_type' 		=> array( 'projects', 'review', 'magazine', 'volume', 'post' ),
		'title'			 	=> 'Workshop',
		);
	$output .= make_magazine_toc($args);

	$args = array(
		'post__in'			=> array( 267740, 268439, 268935, 267650, 267632, 269113, 267599 ),
		'post_type' 		=> array( 'projects', 'review', 'magazine', 'volume', 'post' ),
		'title'			 	=> 'Science',
		);
	$output .= make_magazine_toc($args);

	$args = array(
		'post__in'			=> array( 307336, 268529, 268641, 307350, 268779, 268369, 268976, 307649 ),
		'post_type' 		=> array( 'projects', 'review', 'magazine', 'volume', 'post' ),
		'title'			 	=> 'Craft',
		);
	$output .= make_magazine_toc($args);

	$args = array(
		'post__in'			=> array( 267724, 267430, 268575, 306948, 268067, 268174, 268390, 267777, 268082 ),
		'post_type' 		=> array( 'projects', 'review', 'magazine', 'volume', 'post' ),
		'title'			 	=> 'Art &amp; Design',
		);
	$output .= make_magazine_toc($args);
	return $output;
}

/**
 * Get a volume cover image
 */
function make_get_cover_image( $number = 40 ) {
	$url = esc_url( 'http://cdn.makezine.com/make/covers/MAKE_V' . absint( $number ) . '_high.jpg' );
	return $url;
}

add_action( 'the_content', 'make_update_to_content' );
/**
 * Bring updates into the the_content()
 */
function make_update_to_content( $content ) {
	global $post;
	$updates = get_post_meta( get_the_ID(), 'Updates', true );
	$output = '';
	if ( !empty( $updates ) ) {
		$output .= '<div class="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>';
		$output .= wp_kses_post( Markdown( $updates ) );
		$output .= '</div>';
	}
	$output .= $content;
	return $output;
}
