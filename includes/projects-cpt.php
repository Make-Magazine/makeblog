<?php
/**
 * Functions for the projects custom post type.
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Jake Spurlock <jspurlock@makermedia.com>
 * 
 */

add_action( 'init', 'register_cpt_project' );

/**
 * Register the projects custom post type
 * @uses add_rewite_rule
 * @uses regoster_post_type
 */
function register_cpt_project() {

	add_rewrite_rule( 'projects/([^/]*)/([^/]*)/?$','index.php?projects=$matches[2]','top' );

	$labels = array( 
		'name' => _x( 'Projects', 'Project' ),
		'singular_name' => _x( 'Project', 'Project' ),
		'add_new' => _x( 'Add New', 'Project' ),
		'add_new_item' => _x( 'Add New Project', 'Project' ),
		'edit_item' => _x( 'Edit Project', 'Project' ),
		'new_item' => _x( 'New Project', 'Project' ),
		'view_item' => _x( 'View Project', 'Project' ),
		'search_items' => _x( 'Search Projects', 'Project' ),
		'not_found' => _x( 'No Projects found', 'Project' ),
		'not_found_in_trash' => _x( 'No Projects found in Trash', 'Project' ),
		'parent_item_colon' => _x( 'Parent Project:', 'Project' ),
		'menu_name' => _x( 'Projects', 'Project' ),
	);

	$args = array( 
		'labels' => $labels,
		'hierarchical' => true,
		'description' => 'MAKE magazine Projects will be stored here. Goal is to build the back archive of all issues and Projects.',
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
		'menu_position' => 40,
	);

	register_post_type( 'projects', $args );
}

$field_data = array (
	'advanced_testgroup' => array (
		'fields' => array(
			//'Steps'						=> array(),
			'Link'						=> array(),
			//'Tools'						=> array(),
			//'Documents'					=> array(),
			'MakeProjectsGuideNumber'	=> array(),
			//'Flags'						=> array(),
			'Type'						=> array(),
			// 'Conclusion'				=> array(),
			'Difficulty'				=> array(),
			'Image'						=> array(),
			'Description'				=> array(),
			'TimeRequired'				=> array(),
			'PageNumber'				=> array(),

	),
	'title'		=> 'Projects Meta',
	'context'	=> 'advanced',
	'pages'		=> array( 'projects' ),
	),
);

$easy_cf = new Easy_CF($field_data);

/**
 * Generate the TOC for projects.
 *
 * @deprecated February 2013. The make_magazine_toc has been made more flexible to allow for any post type.
 * 
 */
function make_magazine_projects_toc() {
	global $post;
	$args = array(
		'post_parent' => $post->ID,
		'no_found_rows' => true,
		'post_type' => 'projects'
	);
	
	if($post->post_parent == 0) {
		echo '<h3>Projects</h3>';
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

add_action('add_meta_boxes', 'make_projects_add_meta_box');

/**
 * Add the parent selector to assign to a project to a volume.
 * 
 */
function make_projects_add_meta_box() { 
	add_meta_box('volume-parent', 'Magazine Volume', 'make_magazine_parent_page', 'projects', 'side', 'high');
}

add_action( 'admin_menu', 'make_projects_remove_parent_meta_box' );

/**
 * Remove the existing parent selector meta box.
 * 
 */
function make_projects_remove_parent_meta_box() { 
	remove_meta_box('pageparentdiv', 'projects', 'normal');
}

function make_projects_add_review($content) {
	global $post;
	if ('projects' == get_post_type()) {
		$guide = get_post_custom_values('MakeProjectsGuideNumber');
		if (isset($guide[0])) {
			$content .= js_make_project($guide);
		}
		return $content;
	} else {
		return $content;
	}
}

//add_filter( 'the_content', 'make_projects_add_review' );


add_action( 'init', 'make_register_taxonomy_flags' );

/**
 * Register the flags taxonomy
 * 
 */
function make_register_taxonomy_flags() {

	$labels = array( 
		'name' => _x( 'Flags', 'flags' ),
		'singular_name' => _x( 'Flag', 'flags' ),
		'search_items' => _x( 'Search Flags', 'flags' ),
		'popular_items' => _x( 'Popular Flags', 'flags' ),
		'all_items' => _x( 'All Flags', 'flags' ),
		'parent_item' => _x( 'Parent Flag', 'flags' ),
		'parent_item_colon' => _x( 'Parent Flag:', 'flags' ),
		'edit_item' => _x( 'Edit Flag', 'flags' ),
		'update_item' => _x( 'Update Flag', 'flags' ),
		'add_new_item' => _x( 'Add New Flag', 'flags' ),
		'new_item_name' => _x( 'New Flag', 'flags' ),
		'separate_items_with_commas' => _x( 'Separate flags with commas', 'flags' ),
		'add_or_remove_items' => _x( 'Add or remove flags', 'flags' ),
		'choose_from_most_used' => _x( 'Choose from the most used flags', 'flags' ),
		'menu_name' => _x( 'Flags', 'flags' ),
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

	register_taxonomy( 'flags', array('projects'), $args );
}


add_action( 'init', 'make_register_taxonomy_difficulty' );

/**
 * Add the difficulty taxonomy
 * 
 */
function make_register_taxonomy_difficulty() {

	$labels = array( 
		'name' => _x( 'Difficulties', 'difficulty' ),
		'singular_name' => _x( 'Difficulty', 'difficulty' ),
		'search_items' => _x( 'Search Difficulties', 'difficulty' ),
		'popular_items' => _x( 'Popular Difficulties', 'difficulty' ),
		'all_items' => _x( 'All Difficulties', 'difficulty' ),
		'parent_item' => _x( 'Parent Difficulty', 'difficulty' ),
		'parent_item_colon' => _x( 'Parent Difficulty:', 'difficulty' ),
		'edit_item' => _x( 'Edit Difficulty', 'difficulty' ),
		'update_item' => _x( 'Update Difficulty', 'difficulty' ),
		'add_new_item' => _x( 'Add New Difficulty', 'difficulty' ),
		'new_item_name' => _x( 'New Difficulty', 'difficulty' ),
		'separate_items_with_commas' => _x( 'Separate difficulties with commas', 'difficulty' ),
		'add_or_remove_items' => _x( 'Add or remove difficulties', 'difficulty' ),
		'choose_from_most_used' => _x( 'Choose from the most used difficulties', 'difficulty' ),
		'menu_name' => _x( 'Difficulties', 'difficulty' ),
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

	register_taxonomy( 'difficulty', array('projects', 'video'), $args );
}

add_action( 'init', 'register_taxonomy_tools' );

/**
 * Add the tools taxonomy
 * 
 */
function register_taxonomy_tools() {

	$labels = array( 
		'name' => _x( 'Tools', 'tools' ),
		'singular_name' => _x( 'Tool', 'tools' ),
		'search_items' => _x( 'Search Tools', 'tools' ),
		'popular_items' => _x( 'Popular Tools', 'tools' ),
		'all_items' => _x( 'All Tools', 'tools' ),
		'parent_item' => _x( 'Parent Tool', 'tools' ),
		'parent_item_colon' => _x( 'Parent Tool:', 'tools' ),
		'edit_item' => _x( 'Edit Tool', 'tools' ),
		'update_item' => _x( 'Update Tool', 'tools' ),
		'add_new_item' => _x( 'Add New Tool', 'tools' ),
		'new_item_name' => _x( 'New Tool', 'tools' ),
		'separate_items_with_commas' => _x( 'Separate tools with commas', 'tools' ),
		'add_or_remove_items' => _x( 'Add or remove Tools', 'tools' ),
		'choose_from_most_used' => _x( 'Choose from most used Tools', 'tools' ),
		'menu_name' => _x( 'Tools', 'tools' ),
	);

	$args = array( 
		'labels' => $labels,
		'public' => true,
		'show_in_nav_menus' => true,
		'show_ui' => true,
		'show_tagcloud' => true,
		'hierarchical' => false,
		'rewrite' => true,
		'query_var' => true
	);

	register_taxonomy( 'tools', array('projects'), $args );
}

add_action( 'init', 'register_taxonomy_parts' );

/**
 * Add the parts taxonomy
 * 
 */
function register_taxonomy_parts() {

	$labels = array( 
		'name' => _x( 'Parts', 'parts' ),
		'singular_name' => _x( 'Part', 'parts' ),
		'search_items' => _x( 'Search Parts', 'parts' ),
		'popular_items' => _x( 'Popular Parts', 'parts' ),
		'all_items' => _x( 'All Parts', 'parts' ),
		'parent_item' => _x( 'Parent Part', 'parts' ),
		'parent_item_colon' => _x( 'Parent Part:', 'parts' ),
		'edit_item' => _x( 'Edit Part', 'parts' ),
		'update_item' => _x( 'Update Part', 'parts' ),
		'add_new_item' => _x( 'Add New Part', 'parts' ),
		'new_item_name' => _x( 'New Part', 'parts' ),
		'separate_items_with_commas' => _x( 'Separate parts with commas', 'parts' ),
		'add_or_remove_items' => _x( 'Add or remove Parts', 'parts' ),
		'choose_from_most_used' => _x( 'Choose from most used Parts', 'parts' ),
		'menu_name' => _x( 'Parts', 'parts' ),
	);

	$args = array( 
		'labels' => $labels,
		'public' => true,
		'show_in_nav_menus' => true,
		'show_ui' => true,
		'show_tagcloud' => true,
		'hierarchical' => false,

		'rewrite' => true,
		'query_var' => true
	);

	register_taxonomy( 'parts', array('projects'), $args );
}

add_action( 'init', 'register_taxonomy_types' );

/**
 * Add the types taxonomy
 * 
 */
function register_taxonomy_types() {

	$labels = array( 
		'name' => _x( 'Types', 'types' ),
		'singular_name' => _x( 'Type', 'types' ),
		'search_items' => _x( 'Search Types', 'types' ),
		'popular_items' => _x( 'Popular types', 'types' ),
		'all_items' => _x( 'All types', 'Types' ),
		'parent_item' => _x( 'Parent Type', 'types' ),
		'parent_item_colon' => _x( 'Parent Type:', 'types' ),
		'edit_item' => _x( 'Edit Type', 'types' ),
		'update_item' => _x( 'Update Type', 'types' ),
		'add_new_item' => _x( 'Add New Type', 'types' ),
		'new_item_name' => _x( 'New Type', 'types' ),
		'separate_items_with_commas' => _x( 'Separate types with commas', 'types' ),
		'add_or_remove_items' => _x( 'Add or remove types', 'types' ),
		'choose_from_most_used' => _x( 'Choose from most used types', 'types' ),
		'menu_name' => _x( 'Types', 'types' ),
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

	register_taxonomy( 'types', array('projects', 'post', 'review', 'magazine', 'craft' ), $args );
}

/**
 * Simple grid for the projects landing page.
 * 
 */
function make_projects_grid( $label, $posts, $taxonomy, $terms ) {

	$output = '<div class="' . $label . '">

		<div class="page-header">
		
			<h3>' . $label . '</h3>
			
		</div>
		
		
		<div class="row-fluid">';

				$args = array(
					'tax_query' => array(
						array(
							'taxonomy' => $taxonomy,
							'field' => 'slug',
							'terms' => $terms
						)
					),
					'post_type' => 'projects',
					'post_status' => 'publish',
					'posts_per_page' => $posts,
					'ignore_sticky_posts' => 1,
				);

				$proj_query = new WP_Query($args);

				while ( $proj_query->have_posts() ) : $proj_query->the_post();
					if ( $posts == 4 ) {
						$output .= '<div class="span3">';
					} elseif ( $posts == 3 ) {
						$output .= '<div class="span4">';
					} elseif ( $posts == 6 ) {
						$output .= '<div class="span2">';
					}
					
					$url = get_post_custom_values('Image');
					//$url = esc_url($url);
					$output .= '<img src="' . wpcom_vip_get_resized_remote_image_url( $url[0] , 293, 200 ) . '" alt="' . esc_attr( get_the_title() ) . '" />';
					$output .= '<div class="overlay"><h4><a class="red" href="' . get_permalink() . '">' . get_the_title() . '</a></h4>';
					$description = get_post_custom_values('Description');
					$output .= esc_html( $description[0] );
					$output .= '</div></div>';
				endwhile;
				
		$output .= '</div>';

	$output .= '</div><!--' . $label . '-->';
	return $output;
}

/**
 * The steps thumbmails for the projects pages.
 * 
 */
function make_projects_steps_nav( $steps ) {
	$steps = unserialize($steps[0]);
	if ( !empty( $steps ) ) {
		$arrays = array_chunk( $steps, 6 );
		foreach( $arrays as $stepped ) {
			echo '<div class="row" id="tabs">';
			foreach ($stepped as $idx =>$step) {
				echo '<div class="span2 tabs" data-toggle="tab" id="step-'  . esc_attr( $step->number ) . '" data-target="#js-step-'  . esc_attr( $step->number ) . '">';
				$image = $step->images;
				if (!empty( $image ) ) {
					if ( function_exists( 'wpcom_vip_get_resized_remote_image_url' ) ) {
						echo '<img src="' . wpcom_vip_get_resized_remote_image_url( make_projects_to_s3( $image[0]->text ), 142, 82 ) . '" alt="' . esc_attr( the_title('', '', false ) ) . '" class="js-target ' . esc_attr( $image[0]->imageid ) . ' ' . esc_attr( $image[0]->orderby ) .'" />';
					} else {
						echo '<img src="' . esc_url( make_projects_to_s3( $image[0]->text ), 142, 82 ) . '" alt="' . esc_attr( the_title('', '', false ) ) . '" class="js-target ' . esc_attr( $image[0]->imageid ) . ' ' . esc_attr( $image[0]->orderby ) .'" />';
					}
					//echo '<img src="' . esc_url( make_projects_to_s3( $image[0]->text ) ) . '" alt="' . esc_attr( the_title('', '', false ) ) . '" class="js-target ' . esc_attr( $image[0]->imageid ) . ' ' . esc_attr( $image[0]->orderby ) .'" />';
				} else {
					echo '<img src="' . get_stylesheet_directory_uri() . '/img/placeholder.jpg" alt="No Image" class="' . esc_attr( $step->number ) . '" />';
				}
				echo '<h4 class="red">Step #' . esc_html( $step->number ) . '</h4>';
				echo '</div>'; 
			}
			echo '</div>';
		}
	}
}

/**
 * Spit out the steps as a list.
 * 
 */
function make_projects_steps_list( $steps ) {
	$steps = unserialize($steps[0]);
	if ( !empty( $steps ) ) {
		echo '<div class="well" style="padding:8px 0px;"><ul class="nav nav-list" id="tabs">';
		echo '<li class="nav-header">Project Steps <span class="badge aller">View All</span></li>';
		echo '<li></li>';
		foreach ($steps as $idx =>$step) {
			echo '<li class="tabs steps" data-toggle="tab" id="step-'  . esc_attr( $step->number ) . '" data-target="#js-step-'  . esc_attr( $step->number ) . '">';
			if (!empty($step->title)) {
				echo '<a>' . esc_html( $step->number ) . ". " . esc_html( stripslashes( $step->title ) ) . '</a>';
			} else {
				echo '<a>' . esc_html( $step->number ) . ". " . esc_html( wp_trim_words( stripslashes( $step->lines[0]->text ),  5, '...' ) ) . '</a>';
			}
			
			echo '</li>'; 
		}
		echo '</ul></div>';
	}
}

/**
 * Convert the old Dozuki URLs into our S3 bucket URLs. Also append .jpg onto the end.
 * Old: http://guide-images.makeprojects.org/igi/wFhmkdeyH2foOpyl
 * New: http://make-images.s3.amazonaws.com/wFhmkdeyH2foOpyl.jpg
 * Default: http://cacher.dozuki.net/static/images/make/guide/NoImageMP_96x72.gif
 */
function make_projects_to_s3( $haystack ) {
	if ( strpos( $haystack, 'ytimg' ) !== false ) {
		return $haystack;
	}
	if ( strpos( $haystack, 'makezineblog' ) !== false ) {
		return $haystack;
	}
	$needle = 'guide-images.makeprojects.org/igi/';
	$replace = 'make-images.s3.amazonaws.com/';
	if ( $haystack == 'http://cacher.dozuki.net/static/images/make/guide/NoImageMP_96x72.gif' or empty( $haystack ) ) {
		return $haystack;
	}	
	$str = str_replace( $needle, $replace, $haystack);
	if ( strpos($str, 'make-images') !== true ) {
		return $str . '.jpg';	
	} else {
		return $str;
	}
}

/**
 * Full content of the steps.
 * 
 */
function make_projects_steps( $steps, $print = false ) {
	$steps = unserialize($steps[0]);
	$count = count($steps);
	if ( !empty( $count ) ) {
		foreach ( $steps as $idx => $step ) {
			if ( $idx == 0 or $print == true) {
				echo '<div class="jstep active" id="js-step-' . esc_attr( $step->number ) . '">';
			} else {
				echo '<div class="jstep hide" id="js-step-' . esc_attr( $step->number ) . '">';
			}

			echo '<span class="row">';

				// Output the Step title
				if ( ! $print ) {
					echo '<span class="span6"><h4><span class="black">Step #' . esc_html( $step->number ) . ':</span> ' . esc_html( stripslashes( $step->title ) ) . '</h4></span>';
				} else {
					echo '<span class="span6"><h4><span class="black">Step #' . esc_html( $step->number ) . ':</span> ' . esc_html( stripslashes( $step->title ) ) . '</h4></span>';
				}

				// Output our previous button
				if ( $idx != 0 && ! $print ) {
					echo '<span class="span1"><a class="btn pull-right btn-danger nexter" id="step-'  . esc_attr( $step->number - 1 ) . '" data-target="#js-step-'  . esc_attr( $step->number - 1 ) . '">Prev</a></span>';
				} elseif ( $idx == 0 && ! $print ) {
					echo '<span class="span1"><a class="btn pull-right disabled" id="step-'  . esc_attr( $step->number - 1 ) . '" disabled="disabled">Prev</a></span>';
				} elseif ( $print ) {
					echo '';
				}

				// Output the next button
				if ( $idx < $count - 1 && ! $print ) {
					echo '<span class="span1"><a class="btn pull-right btn-danger nexter" id="step-'  . esc_attr( $step->number + 1 ) . '" data-target="#js-step-'  . esc_attr( $step->number + 1 ) . '">Next</a></span>';
				} elseif ( $idx == $count - 1 && ! $print ) {
					echo '<span class="span1"><a class="btn pull-right disabled" id="step-'  . esc_attr( $step->number + 1 ) . '" disabled="disabled">Next</a></span>';
				} elseif ( $print ) {
					echo '';
				}
			echo '</span>';
			
			$images = $step->images;
			if ( isset( $images[0]->text ) ) {
				if ( function_exists( 'wpcom_vip_get_resized_remote_image_url' ) ) {
					echo '<img src="' . wpcom_vip_get_resized_remote_image_url( make_projects_to_s3( $images[0]->text ), 620, 465 ) . '" data-src="' . make_projects_to_s3( $images[0]->text ) . '" alt="' . esc_attr( the_title('', '', false ) ) . '" class="main ' . esc_attr( $images[0]->imageid ) . ' ' . esc_attr( $images[0]->orderby ) .'" />';
				} else {
					echo '<img src="' . esc_url( make_projects_to_s3( $images[0]->text ) ) . '" data-loc="js-step-' . esc_attr( $step->number ) . ' alt="' . esc_attr( the_title('', '', false ) ) . '" class="' . esc_attr( $images[0]->imageid ) . ' ' . esc_attr( $images[0]->orderby ) .'" />';
				}
			}
			if ( !empty( $images[1]->text ) ) {
				echo '<span class="row smalls" style="display:block">';
				foreach ($images as $image) {
					echo '<span class="span2">';
					echo ( !empty($image->text ) ) ? '<img src="' . wpcom_vip_get_resized_remote_image_url( make_projects_to_s3( $image->text ), 140, 110 ) . '" data-loc="js-step-' . esc_attr( $step->number ) . '" data-src="' . wpcom_vip_get_resized_remote_image_url( make_projects_to_s3( $image->text ), 620, 465 )  . '" alt="' . esc_attr( the_title('', '', false ) ) . '" class="thumbs ' . esc_attr( $image->imageid ) . ' ' . esc_attr( $image->orderby ) .'" />' : null ;
					echo '</span>';
				}
				echo '</span><!--.row-->';
			}
			$lines = $step->lines;
			echo '<ul>';
			foreach ($lines as $line) {
				echo '<li>' . wp_kses_post( stripslashes( $line->text ) ) . '</li>';
			}
			echo '</ul>';
			echo '</div><!--.right_column-->';
		}
	}
}

/**
 * Get all of the post meta that has parts as the ID, and then output an unordered list
 *
 */
function make_projects_parts( $parts ) {
	$output = '<h3 class="show-print">Parts</h3>';
	$output .= '<ul class="lists">';

	foreach ( $parts as $part ) {
		$notes = null;

		if( ! empty( $part['notes'] ) ) {
			$notes = $part['notes'];
		}
		if ( strpos( $part['url'], 'makeprojects' ) != true ) {
			$output .='<li><a href="' . esc_url( $part['url'] ) . '" data-toggle="tooltip" title="' . esc_attr( $notes ) .'">' . $part['text'];
		} else {
			$output .='<li><a href="#" data-toggle="tooltip" title="' . esc_attr( $notes ) .'">' . esc_html( $part['text'] );
		}

		if( ! empty( $part['type'] ) ) {
			$output .= ', ' . htmlspecialchars_decode( esc_html( $part['type'] ) );
		}

		if( ! empty( $part['quantity'] ) ) {
			$output .= ' (';
			$output .= esc_html( $part['quantity'] );
			$output .= ')';
		}

		$output .= '</a> ';
		
		$output .= ' <span class="muted">';
		$output .= wp_kses_post( $notes );
		$output .= '</span>';

		$output .= '</li>';
	}

	$output .= '</ul>';

	return $output;
}


/**
 * Get all of the post meta that has tools as the ID, and then output an unordered list
 * Due to the com
 *
 */
function make_projects_tools( $tools ) {
	$output = '<h3 class="show-print">Tools</h3>';
	$output .= '<ul class="lists">';

	// The array is complicated, thus this foreach is complicated... $tool is an object.
	if ( ! empty( $tools[0] ) && is_array( $tools[0] ) ) {
		foreach ( $tools[0] as $tool ) {

			$output .='<li>';
			if ( ! empty( $tool->url ) ) {
				$output .= '<a href="' . esc_url( $tool->url ) . '" data-toggle="tooltip" title="' . esc_attr( $tool->text ) .'">' . esc_html( $tool->text ) . '</a>';
			} else {
				$output .= esc_html( $tool->text );
			}
			$notes = null;

			if( ! empty( $tool->notes ) ) {
				$output .= '  <span class="muted">' . wp_kses_post( $tool->notes ) . '</span>';
			}
		}
	}

	$output .= '</ul>';

	return $output;
}

function make_projects_tools_shortcode( $atts ) {
	extract( shortcode_atts( array(
		'type' => 'parts',
	), $atts ) );
	$output = '';
	if ( $atts['type'] == 'parts' ) {
		$parts = get_post_meta( absint( $atts['id'] ), 'parts');
		$output .= make_projects_parts( $parts );
	} elseif ( $atts['type'] == 'tools' ) {
		$tools = get_post_meta( absint( $atts['id'] ), 'Tools');
		$output .= make_projects_tools( $tools );
	}
	return $output;
}

add_shortcode( 'make_parts', 'make_projects_tools_shortcode' );

$field_data = array (
	'Resources' => array (
		'fields' => array(
			'RequiredResources'	=> array( 'type' => 'textarea', 'label' => 'Required Resources' ),
			'ExtraResources'	=> array( 'type' => 'textarea', 'label' => 'Extra Resources' ),
	),
	'title'		=> 'Resources',
	'pages'		=> array( 'projects' ),
	),
);

$easy_cf = new Easy_CF($field_data);