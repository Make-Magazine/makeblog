<?php 

add_action( 'init', 'make_register_cpt_slideshow' );

function make_register_cpt_slideshow() {

	$labels = array( 
		'name' => _x( 'Slideshows', 'slideshow' ),
		'singular_name' => _x( 'Slideshow', 'slideshow' ),
		'add_new' => _x( 'Add New', 'slideshow' ),
		'add_new_item' => _x( 'Add New Slideshow', 'slideshow' ),
		'edit_item' => _x( 'Edit Slideshow', 'slideshow' ),
		'new_item' => _x( 'New Slideshow', 'slideshow' ),
		'view_item' => _x( 'View Slideshow', 'slideshow' ),
		'search_items' => _x( 'Search Slideshows', 'slideshow' ),
		'not_found' => _x( 'No slideshows found', 'slideshow' ),
		'not_found_in_trash' => _x( 'No slideshows found in Trash', 'slideshow' ),
		'parent_item_colon' => _x( 'Parent Slideshow:', 'slideshow' ),
		'menu_name' => _x( 'Slideshows', 'slideshow' ),
	);

	$args = array( 
		'labels' => $labels,
		'hierarchical' => false,
		'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions' ),
		'taxonomies' => array( 'category', 'post_tag' ),
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
		'menu_position' => 49,
	);

	register_post_type( 'slideshow', $args );
}


add_filter( 'the_content', 'slideshow_content_filter', 5 );

function slideshow_content_filter( $content ) {

	$post_args = array(
		'before'			=> '<div class="clear"></div><p class="self"><h4>Pages:</h4>',
		'after'				=> '</p>',
		'link_before'		=> '<span class="badge">',
		'link_after'		=> '</span>',
		'next_or_number'	=> 'number',
		'pagelink'			=> '%',
		'echo'				=> 0
	);

	$other_args = array(
		'before'			=> '<div class="clear"></div><p class="self"> ',
		'after'				=> '</p>',
		'link_before'		=> '<span class="badge">',
		'link_after'		=> '</span>',
		'next_or_number'	=> 'number',
		'pagelink'			=> '%',
		'echo'				=> 0
	);
	$args = array(
		'before'			=> '<div id="nav-buttons">',
		'after'				=> '</div>',
		'link_before'		=> '',
		'link_after'		=> '',
		'next_or_number'	=> 'next',
		'nextpagelink'		=> __('<span class="carousel-control new next" style="font-size:60px;">&rsaquo;</span>'),
		'previouspagelink'	=> __('<span class="carousel-control new prev" style="font-size:60px;">&lsaquo;</span>'),
		'pagelink'			=> '%',
		'echo'				=> 0
	);

	if ( 'slideshow' == get_post_type() ) {
		$content = wp_link_pages($other_args).wp_link_pages($args).$content/*.make_vapp_the_link('View All Slides', 'self')*/;
		return $content;
	} elseif ( 'post' == get_post_type() ) {
		$content = $content.wp_link_pages( $post_args );
		return $content;
	} else {
		return $content;
	}
}

function make_slideshow_hotkeys() {
	if ( ('slideshow' ) == get_post_type() ) {
		wp_enqueue_script( 'hotkeys', get_stylesheet_directory_uri() . '/js/jquery.hotkeys.js', array( 'jquery' ) );
	}
}
add_action('wp_enqueue_scripts', 'make_slideshow_hotkeys');

function make_slidehow_embed( $atts ) {
	extract( shortcode_atts( array(
		'slug' => 'makes-3d-print-shop-weekend/',
		'title' => 'Modal Header',
		'link' => 'Lauch Slideshow'
	), $atts ) );

	if (jetpack_is_mobile() || is_feed()) {
		return $content. '<p><a href="'.esc_url( 'http://makezine.com/slideshow/' . $slug . '/' ) . '" taget="_blank" class="btn btn-primary">View Slideshow</a></p>';
	} else {
		return '<a href="#myModal" role="button" class="btn btn-primary" data-toggle="modal">'.esc_html($link). '</a>
			<div class="modal hide slideshow" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h3 id="myModalLabel">'.esc_html($title).'</h3>
				</div>
				<div class="modal-body">
					<iframe width="940" height="600" frameborder=0 src="' . esc_url( 'http://makezine.com/slideshow/' . $slug . '/' ) . '"></iframe>
				</div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
				</div>
			</div>';
	}
}
add_shortcode( 'make_slideshow', 'make_slidehow_embed' );

function make_add_slideshow_endpoint() {
	add_rewrite_endpoint( 'embed', EP_PERMALINK | EP_PAGES );
}
//add_action( 'init', 'make_add_slideshow_endpoint' );


function make_embed_template_redirect() {
	global $wp_query;

	// if this is not a request for embed or a singular object then bail
	if ( ! isset( $wp_query->query_vars['embed'] ) || ! is_singular() )
		return;

	// include custom template
	include dirname( __FILE__ ) . '/single-slideshow-embed.php';
	exit;
}
//add_action( 'template_redirect', 'make_embed_template_redirect' );

//add_rewrite_rule( 'slideshow/([^/]+)/([0-9]+)/embed(/(.*))?/?$','index.php?slideshow=$matches[1]&embed=$matches[3]&pagename=$matches[2]','top' );


function make_bs_slideshow() {
	global $post;
	$images = get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID') );

	$output = '<div id="myCarousel" class="carousel slide" data-interval=""><div class="carousel-inner">';
	$i = 0;
	foreach( $images as $image ) {
		$i++;
		if ($i == 1) {
			$output .= '<div class="item active">';	
		} else {
			$output .= '<div class="item">';
		}
		$output .= wp_get_attachment_image( $image->ID, 'medium');
		if (isset($image->post_title)) {
			$output .= '<div class="carousel-caption">';
			$output .= '<h4>' . $image->post_title . '</h4>';
			if (isset($image->post_excerpt)) {
				$output .= '<p>' . $image->post_excerpt . '</p>';
			}
			$output .= '</div>';
			
		}
		$output .= '</div>';
		
	} //foreach
	$output .= '</div>
		<a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
		<a class="right carousel-control" href="#myCarousel" data-slide="next">›</a>
	</div>';
	$output .= '<p class="pull-right"><span class="viewall" style="cursor:pointer">View All</span></p>';
	$output .= '
		<script>
			jQuery(document).ready(function(){
				jQuery(".viewall").click(function() {
					jQuery(".carousel-inner").removeClass("carousel-inner");
					googletag.pubads().refresh();
					ga(\'send\', \'pageview\');
					console.log(\'Pushed a pageview, and an ad refresh, like a boss.\');
					urlref = location.href;
					PARSELY.beacon.trackPageView({
						url: urlref,
						urlref: urlref,
						js: 1,
						action_name: "Next Slide"
					});
					return true;
				})
			});
		</script>
	';
	return $output;
}

add_shortcode( 'bs_slideshow', 'make_bs_slideshow' );

function make_get_arg_title( $args, $title ) {
	$output = null;
	if ( $title == true ) {
		$view = $args['title'];
	} else {
		$view = 'View All';
	}
	if ( $args['all'] == false ) {
		$output = null;
	} elseif (isset($args['tag'])) {
		$output .= '<a href="' . esc_url( get_term_link( $args['tag'], 'post_tag' ) );
		if( $args['post_type'] == 'projects' ){
			$output .= '?post_type=projects';
		} 
		$output .= '">' . $view . '</a>';
	} elseif ( isset( $args['category__in'] ) && ($args['category__in'] > 0 )  ) {
		$output .= '<a href="' . esc_url( get_term_link( intval( $args['category__in'] ), 'category' ) );
		if( $args['post_type'] == 'projects' ){
			$output .= '?post_type=projects';
		} 
		$output .= '">' . $view . '</a>';
	} else {
		$output .= $view;
	}
	return $output;
}


/**
 * Adds a cool little carousel. 
 * @param  array   $args 	   The array of arguments
 * @param  boolean $title_link The ability to enable or display links in the title. Some pages want it, others dont.
 * @return mixed
 *
 * @version  1.1
 */
function make_carousel( $args, $title_link = true ) {

	$defaults = array(
		'cat'				=> 0, 				// Likely the queried object ID
		'posts_per_page'	=> 8,				// Need to have this divisable by 8, ideally.
		'no_found_rows'		=> true,			// Helps to keep the query fast.
		'title'				=> 'New Posts!',	// To be changed, immediately.
		'all'				=> null,
		'limit'				=> 4,
		'projects_landing'	=> false,
		'post_type'			=> array( 
								'post',
								'video',
								'projects',
								'review',
								'craft',
								'magazine' ),
	);

	$args = wp_parse_args( $args, $defaults );

	$rand = mt_rand(0, 100);
	$id = 'make-carousel-' . $rand;

	$the_query = new WP_Query( $args );

	if ( $the_query->post_count == 0 ) {
		return;
	}

	$output = '<div class="row-fluid">
		<div class="span10">
			<h2 class="look_like_h3">';			
					if ( isset( $args['difficulty'] ) ) {
						if ( $title_link )
							$output .= '<a href="' . make_get_category_url($args['difficulty'], 'difficulty') . '?cat=' . intval($args['category__in']) . '">';

						$output .= $args['difficulty'];

						if ( $title_link )
							$output .= '</a>';

					} elseif ( isset( $args['category__in'] ) ) {
						if ( $title_link ) {
							$output .= '<a href="';
							$output .= get_term_link( intval($args['category__in']), 'category', 'id');
							if ($args['projects_landing'] != false ) {
								$output .= '?post_type=projects">';	
							} else {
								$output .= '">';
							}
						}

						$output .= $args['title'];

						if ( $title_link )
							$output .= '</a>';

					} elseif ( isset($args['tag'] ) ) {
						if ( $title_link ) {
							$output .= '<a href="';
							$output .= get_term_link( $args['tag'], 'post_tag');
							if ($args['projects_landing'] != false ) {
								$output .= '?post_type=projects">';	
							} else {
								$output .= '">';
							}
						}

						$output .= $args['title'];

						if ( $title_link )
							$output .= '</a>';
					} else {
						$output .= $args['title'];
					}
		$output .= '</h2></div><div class="span2">';
				if ($args['all'] != null ) {
					if ( isset( $args['difficulty'] ) ) {
						$output .= '<p class="pull-right"><a href="' . make_get_category_url($args['difficulty'], 'difficulty') . '?cat=' . intval($args['category__in']) . '" class="all">View All</p>';
					} elseif ( isset($args['category__in']) && ($args['all']) == true ) {
						$output .= '<p class="pull-right"><a href="';
						$output .= get_term_link( intval($args['category__in']), 'category', 'id');
						$output .= '?post_type=projects" class="all">';
						$output .= 'View All';
						$output .= '</p>';	
					} elseif ( isset($args['tag'] ) ) {
						$output .= '<p class="pull-right"><a href="';
						$output .= get_term_link( $args['tag'], 'post_tag');
						$output .= '?post_type=projects" class="all">View All</a></p>';
					}
				}

		$output .= '</div></div>';

		$output .= '<div id="' . esc_attr( $id ) . '" class="carousel slide" data-interval="false"><div class="carousel-inner">';
		
			$arrays = array_chunk( $the_query->posts, $args['limit'], true );

				foreach( $arrays as $idx => $posts) {
					
					if ( $idx == 0 ) {
						$output .= '<div class="item active">';	
					} else {
						$output .= '<div class="item">';
					}
					$output .= '<div class="row">';
						global $post;
						foreach ($posts as $post) {
							setup_postdata( $post );
							$type = get_post_type( $post );
							if ($args['limit'] == 4 ) {
								$output .= '<div class="span3 ' . $type . '">';
								if ($type == 'video') {
									$output .= '<a class="" data-toggle="modal" onclick="_gaq.push([\'_trackPageview\', \'' . get_permalink( $post->ID ) . '\']);" href="#myModal-' . $post->ID . '">';
									$output .= '<span class="' . $type .'-icon"></span>';
									$output .= '</a>';
								} elseif ( $args['projects_landing'] == false ) {
										$output .= '<a href="'. get_permalink( $post->ID ) . '"><span class="' . $type .'-icon"></span></a>';
								}
								$image = get_post_custom_values('Image', $post->ID);
								if ( !empty( $image[0] ) )  {
									$output .= '<a href="'. get_permalink( $post->ID ) . '"><img src="' . wpcom_vip_get_resized_remote_image_url( make_projects_to_s3( $image[0] ), 218, 146 ) . '" alt="' . the_title_attribute( array('echo' => false ) ) . '" /></a>';
								} elseif ( $type == 'video' ) {
									$link = get_post_custom_values( 'Link' , $post->ID );
									$link = 'http://www.youtube.com/oembed?format=json&amp;url=' . esc_url( $link[0] );
									$contents = wpcom_vip_file_get_contents( $link );
									if ($contents != false) {
										$json_output = json_decode($contents);
										$img = $json_output->thumbnail_url;
										update_post_meta( $post->ID, 'Image', $img );
										$output .= '<a href="'. get_permalink( $post->ID ) . '"><img src="' . wpcom_vip_get_resized_remote_image_url( get_post_meta( $post->ID, 'Image', true ), 218, 146 ) . '" alt="' . the_title_attribute( array('echo' => false ) ) . '" /></a>';
									} elseif ( has_post_thumbnail() ) {
										$image = get_the_post_thumbnail( 'category-thumb-small' );
										$output .= '<a href="' . get_permalink( $post->ID ) . '">' . $image . '</a>';
									}
								} else {
									$output .= '<a href="'. get_permalink( $post->ID ) . '">';
									$output .= get_the_image( array( 'post_id' => $post->ID, 'image_scan' => true, 'size' => 'category-thumb-small', 'image_class' => 'hide-thumbnail', 'echo' => false ) );
									$output .= '</a>';
								}
							} elseif ($args['limit'] == 2) {
								$output .= '<div class="span4 ' . $type . '">';
								if ($type == 'video') {
									$output .= '<a class="" data-toggle="modal" onclick="_gaq.push([\'_trackPageview\', \'' . get_permalink( $post->ID ) . '\']);" href="#myModal-' . $post->ID . '">';
									$output .= '<span class="' . $type .'-icon"></span>';
									$output .= '</a>';
								} else {
									$output .= '<span class="' . $type .'-icon"></span>';
								}
								$image = get_post_custom_values('Image', $post->ID);
								if ( !empty( $image[0] ) )  {
									$output .= '<a href="'. get_permalink( $post->ID ) . '">';
									$output .= '<img src="' . wpcom_vip_get_resized_remote_image_url( make_projects_to_s3( $image[0] ), 298, 146 ) . '" alt="' . the_title_attribute( array('echo' => false ) ) . '" />';
									$output .= '</a>';
								} else {
									$output .= '<a href="'. get_permalink( $post->ID ) . '">';
									$output .= get_the_image( array( 'post_id' => $post->ID, 'image_scan' => true, 'size' => 'category-thumb', 'image_class' => 'hide-thumbnail', 'echo' => false) );
									$output .= '</a>';

								}  
								
							}
							
							if ( $args['projects_landing'] == true ) {
								$output .= '<div class="project-meta"><ul>';
								$time = get_post_custom_values('TimeRequired', $post->ID);
								if ($time[0]) {
									$output .= '<li>Time: <span>' . esc_html( $time[0] ) . '</span></li>';
								}
								$terms = get_the_terms( $post->ID, 'difficulty' );
								if ($terms) {
									foreach ($terms as $term) {
										$output .= '<li>Difficulty: <span>' . esc_html( $term->name ) . '</span></li>';
									}
								}
								$output .= '</ul></div>';
							}
							$output .= '<h4><a href="';
							$output .= get_permalink( $post->ID );
							$output .= '">';
							$output .= get_the_title( $post->ID );
							$output .= '</a></h4>';
							$output .= ( ! empty( $post->post_excerpt ) ) ? Markdown( wp_trim_words( strip_shortcodes( $post->post_excerpt ), 15, '...' ) ) : Markdown( wp_trim_words( strip_shortcodes( $post->post_content ), 15, '...' ) ) ;
							$output .= '</div>'. "\n";
							if ($type == 'video') {
								$link = get_post_meta( $post->ID, 'Link', true );
								$output .= '<div class="modal hide" id="myModal-' . $post->ID . '" data-video="' . esc_url( $link ) . '">
									<div class="modal-header">
										<a class="close" data-dismiss="modal">&times;</a>
										<h3>' . get_the_title( $post->ID ) . '</h3>
									</div>
									<div class="modal-body">
										<div class="link"></div>';
										$output .= Markdown( strip_shortcodes( $post->post_content ) );
									$output .= '</div>
									<div class="modal-footer">
										<a href="#" class="btn" data-dismiss="modal">Close</a>
									</div>
								</div>';
							}
						}
						$output .= '</div>';
					$output .= '</div>';

				}

				// Reset Post Data
				wp_reset_postdata();
		
		$output .= '</div>';

	if ( $the_query->post_count > 4 ) {
		$output .= '<a class="left cat-carousel-control" href="#' . esc_attr( $id ) . '" data-slide="prev"><img src="' . get_stylesheet_directory_uri() . '/img/larr.png" alt="Left"></a>';
		$output .= '<a class="right cat-carousel-control" href="#' . esc_attr( $id ) . '" data-slide="next"><img src="' . get_stylesheet_directory_uri() . '/img/rarr.png" alt="Left"></a>';
	}

	$output .= '</div>';
	
	return $output;

}

add_shortcode( 'carousel', 'make_carousel' );


/**
 * The Better Gallery shortcode, courtesy of WordPress Core
 *
 * Wanted to extend our Bootstrap Slideshow so that you could put in Post IDs and get back a slideshow.
 * Basically the same thing that the default slideshow does, so why not use that!
 *
 * @since 1.0
 *
 * @param array $attr Attributes of the shortcode.
 * @return string HTML content to display gallery.
 */
function make_new_gallery_shortcode($attr) {
	$post = get_post();

	static $instance = 0;
	$instance++;

	if ( ! empty( $attr['ids'] ) ) {
		// 'ids' is explicitly ordered, unless you specify otherwise.
		if ( empty( $attr['orderby'] ) )
			$attr['orderby'] = 'post__in';
		$attr['include'] = $attr['ids'];
	}

	// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( !$attr['orderby'] )
			unset( $attr['orderby'] );
	}

	extract(shortcode_atts(array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post->ID,
		'itemtag'    => 'dl',
		'icontag'    => 'dt',
		'captiontag' => 'dd',
		'columns'    => 3,
		'size'       => 'medium',
		'include'    => '',
		'exclude'    => ''
	), $attr));

	
	$rand = mt_rand( 0, $id );

	$id = intval($id);
	if ( 'RAND' == $order )
		$orderby = 'none';

	if ( !empty($include) ) {
		$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif ( !empty($exclude) ) {
		$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	} else {
		$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	}

	if ( empty($attachments) )
		return '';

	$output = '<div id="myCarousel-' . $rand . '" class="carousel slide" data-interval=""><div class="carousel-inner">';

	$i = 0;
	foreach( $attachments as $id => $attachment ) {
		$i++;
		if ($i == 1) {
			$output .= '<div class="item active">';	
		} else {
			$output .= '<div class="item">';
		}
		$output .= wp_get_attachment_link( $attachment->ID, sanitize_title_for_query( $size ) );
		if ( isset( $attachment->post_excerpt ) && ! empty( $attachment->post_excerpt ) ) {
			$attachment_caption = $attachment->post_excerpt;
		} elseif ( isset( $attachment->post_title ) && ! empty( $attachment->post_title ) ) {
			$attachment_caption = $attachment->post_title;
		} else {
			$attachment_caption = '';
		}
		if ( isset( $attachment_caption ) && ! empty( $attachment_caption ) ) {
			$output .= '<div class="carousel-caption">';
			$output .= '<h4>' . Markdown( wp_kses_post( $attachment_caption ) ) . '</h4>';
			$output .= '</div>';
			
		}
		$output .= '</div>';
		
	} //foreach
	$output .= '</div>
		<a class="left carousel-control" href="#myCarousel-' . $rand . '" data-slide="prev">‹</a>
		<a class="right carousel-control" href="#myCarousel-' . $rand . '" data-slide="next">›</a>
	</div>';
	$output .= '<p class="pull-right"><span class="label viewall" style="cursor:pointer">View All</span></p>';
	$output .= '
		<script>
			jQuery(document).ready(function(){
				jQuery(".viewall").click(function() {
					jQuery(".carousel-inner").removeClass("carousel-inner");
					jQuery(".carousel-control").hide();
					googletag.pubads().refresh();
					ga(\'send\', \'pageview\');
					urlref = location.href;
					PARSELY.beacon.trackPageView({
						url: urlref,
						urlref: urlref,
						js: 1,
						action_name: "Next Slide"
					});
					jQuery(this).addClass(\'hide\');
					return true;
				})
			});
		</script>
	';
	$output .= '<div class="clearfix"></div>';
	return $output;
}

add_shortcode( 'new_gallery', 'make_new_gallery_shortcode' );


/**
 * The Video/Image Gallery
 *
 * Wanted to extend our Bootstrap Slideshow so that you could put in Post IDs and get back a slideshow.
 * Basically the same thing that the default slideshow does, so why not use that!
 *
 * @since 1.0
 *
 * @param array $attr Attributes of the shortcode.
 * @return string HTML content to display gallery.
 */
function make_video_photo_gallery( $attr ) {

	$posts = explode( ',', $attr['ids'] );

	$rand = mt_rand( 0, get_the_ID() );

	global $post;

	$output = '<div id="myCarousel-' . $rand . '" class="carousel slide video" data-interval=""><div class="carousel-inner">';
	$i = 0;

	foreach( $posts as $post ) {
		$vine = false;
		$youtube = false;
		$vimeo = false;
		if ( strpos( $post, 'youtu' ) ) {
			$youtube = true;
		} elseif ( strpos( $post, 'vimeo' ) ) {
			$vimeo = true;
		} elseif ( strpos( $post, 'vine' ) ) {
			$vine = true;
		} else {
			$post = get_post( $post );
			setup_postdata( $post );
		}

		$i++;

		if ($i == 1) {
			$output .= '<div class="item active">';	
		} else {
			$output .= '<div class="item">';
		}
		if ( $youtube == true ) {
			$output .= do_shortcode('[youtube='. esc_url( $post ) .'&amp;w=620]');
		} elseif ( $vimeo == true ) {
			$output .= do_shortcode( '[vimeo '. esc_url( $post ) . ' w=620]');
		} elseif ( $vine == true ) {
			$output .= do_shortcode( '[vine url="' . esc_url( $post ) . '" type="simple" width="620"]' );
		} else {
			if ( get_post_type() == 'video' ) {
				$url = get_post_meta( get_the_ID(), 'Link', true );
				$output .= do_shortcode('[youtube='. esc_url( $url ) .'&amp;w=620]');
			} else {
				$output .= wp_get_attachment_image( get_the_ID(), 'medium' );
			}
			if (isset($post->post_title)) {
				$output .= '<div class="carousel-caption" style="position:relative;">';
				$output .= '<h4>' . get_the_title() . '</h4>';
				$output .= ( isset( $post->post_excerpt ) ) ? Markdown( wp_kses_post( $post->post_excerpt ) ) : '';
				$output .= '</div>';
			}
		}
		$output .= '</div>';
		
	} //foreach
	wp_reset_postdata();
	$output .= '</div>
		<a class="topper left carousel-control" href="#myCarousel-' . $rand . '" data-slide="prev">‹</a>
		<a class="topper right carousel-control" href="#myCarousel-' . $rand . '" data-slide="next">›</a>
	</div>';
	$output .= '<div class="clearfix"></div>';
	return $output;
}

add_shortcode( 'video_gallery', 'make_video_photo_gallery' );


/**
 * The Huff-Po style slideshow
 *
 *
 * @param array $attr Attributes of the shortcode.
 * @return string HTML content to display gallery.
 */
function make_huff_po_gallery_shortcode($attr) {
	$post = get_post();

	static $instance = 0;
	$instance++;

	if ( ! empty( $attr['ids'] ) ) {
		// 'ids' is explicitly ordered, unless you specify otherwise.
		if ( empty( $attr['orderby'] ) )
			$attr['orderby'] = 'post__in';
		$attr['include'] = $attr['ids'];
	}

	// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( !$attr['orderby'] )
			unset( $attr['orderby'] );
	}

	extract(shortcode_atts(array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post->ID,
		'itemtag'    => 'dl',
		'icontag'    => 'dt',
		'captiontag' => 'dd',
		'columns'    => 3,
		'size'       => 'slideshow-thumb',
		'include'    => '',
		'exclude'    => ''
	), $attr));

	
	$rand = mt_rand( 0, $id );

	$id = intval($id);
	if ( 'RAND' == $order )
		$orderby = 'none';

	if ( !empty($include) ) {
		$args = array(
			'include' 			=> $include,
			'post_status'		=> 'inherit',
			'post_type'			=> 'attachment',
			'post_mime_type'	=> 'image',
			'order' 			=> $order,
			'orderby' 			=> $orderby,
			'suppress_filters'	=> false,
			);
		$_attachments = get_posts( $args );
		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif ( !empty($exclude) ) {
		$args = array(
			'post_parent' 		=> $id, 
			'exclude' 			=> $exclude, 
			'post_status' 		=> 'inherit', 
			'post_type' 		=> 'attachment', 
			'post_mime_type' 	=> 'image', 
			'order' 			=> $order, 
			'orderby' 			=> $orderby,
			'suppress_filters'	=> false,
			);
		$attachments = get_children( $args );
	} else {
		$args = array(
			'post_parent' 		=> $id, 
			'post_status' 		=> 'inherit', 
			'post_type' 		=> 'attachment', 
			'post_mime_type' 	=> 'image', 
			'order' 			=> $order, 
			'orderby' 			=> $orderby,
			'suppress_filters'	=> false,
			);
		$attachments = get_children( $args );
	}

	if ( empty($attachments) )
		return '';


	$output = '';

	// Start the modal, with the carousel inside of it.
	$output .= '<div id="myModal-' . intval( $rand ) . '" class="modal small huff" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
	$output .= '<div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><h3>';
	$output .= ( isset( $attr['title'] ) ) ? wp_kses_post( $attr['title'] ) : get_the_title();
	$output .= '</h3></div>';
	$output .= '<div class="modal-body"><div id="myCarousel-' . intval( $rand ) . '" class="carousel slide container huffington" data-interval=""><div class="carousel-inner">';

	$i = 0;
	foreach( $attachments as $id => $attachment ) {
		if ($i == 0) {
			$output .= '<div class="item active" data-index="' . intval( $i ) . '">';	
		} else {
			$output .= '<div class="item" data-index="' . intval( $i ) . '">';
		}
		$output .= '<div class="row">';
		$output .= '<div class="span8">';
		$output .= wp_get_attachment_link( $attachment->ID, sanitize_title_for_query( $size ) );
		$output .= '</div>';	
		$output .= '<div class="span4"><div class="scroller">';
		$output .= ( isset( $attachment->post_title ) && ! empty( $attachment->post_title ) ) ? '<h4>' . Markdown( wp_kses_post( $attachment->post_title ) ) . '</h4>' : '';
		$output .= ( isset( $attachment->post_excerpt ) && ! empty( $attachment->post_excerpt ) ) ? Markdown( wp_kses_post( $attachment->post_excerpt ) ) : '';
		$output .= '</div></div>';
		$output .= '</div>';
		$output .= '</div>';
		$i++;
	} //foreach
	// Add another slide at the end for other slideshows.
	$output .= '<div class="item" data-index="' . intval( $i++ ) . '"><div class="row"><div class="span12">';

	$args = array(
		'types'				=> 'slideshow',
		'posts_per_page'	=> 6,
		'post__not_in'		=> array( $post->ID ),
		);

	$query = new WP_Query( $args );

	$results = array_chunk( $query->posts, 3 );

	foreach ( $results as $row ) {
		$output .= '<div class="row">';

		foreach ( $row as $post_object ) {
			$output .= '<div class="span4"><a target="_blank" href="';
			$output .= get_permalink( $post_object->ID );
			$output .= '">';
			$output .= get_the_post_thumbnail( $post_object->ID, 'side-thumb' );
			$output .= '<h4>' . get_the_title( $post_object ) . '</h4>';
			$output .= Markdown( wp_trim_words( strip_shortcodes( ( $post_object->post_excerpt ) ? $post_object->post_excerpt : $post_object->post_content  ), 10, '...' ) );
			$output .= '</a></div>';
		}

		$output .= '</div>';
	}

	$output .= '</div></div></div>';
	$output .= '</div></div></div>';
	
	// Let's build the thumbnails.
	$output .= '<div class="inner-thumbs container">';
	$i = 0;

	$rows = array_chunk( $attachments, 12 );	

	foreach ( $rows as $row ) {
		
		$output .= '<div class="row">';

		foreach( $row as $id => $attachment ) {
			$output .= '<div class="span1">';
			$output .= ( $i == 0 ) ? '<a href="#myCarousel-' . intval( $rand ) . '" data-slide-to="' . esc_attr( $i ) . '" class="active">' : '<a href="#myCarousel-' . intval( $rand ) . '" data-slide-to="' . esc_attr( $i ) . '">';
			$image = wp_get_attachment_image_src( $attachment->ID, sanitize_title_for_query( 'slideshow-small-thumb' ) );
			$output .= '<img src="' . esc_url( $image[0] ) . '">';
			$output .= '</a>';
			$output .= '</div>';
			$i++;
		}

		$output .= '</div>';
	}

	$output .= '<div class="clearfix"></div></div>';

	$output .= '<div class="modal-footer">
		<ul class="pager">
			<li class="previous">
				<a href="#myCarousel-' . intval( $rand ) . '" class="nexus" data-slide="prev">&larr; Previous</a>
			</li>
			<li class="next">
				<a href="#myCarousel-' . intval( $rand ) . '" class="nexus" data-slide="next">Next &rarr;</a>
			</li>
		</ul>
		<span href="#myCarousel-' . intval( $rand ) . '" class="starter btn btn-primary">Start Slideshow</span>
	</div></div>';
	$output .= '<div class="clearfix"></div>';
	return $output;
}

add_shortcode( 'huff_gallery', 'make_huff_po_gallery_shortcode' );	
