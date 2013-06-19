<?php
/**
 * Sidebar for Projects Page
 *
 * 
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Jake Spurlock <jspurlock@makermedia.com>
 */
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 *
 * @uses add_theme_support() To add support for post thumbnails, custom headers and backgrounds, and automatic feed links.
 * @uses add_image_size() To set a custom post thumbnail size.
 *
 */
function make_action_after_setup_theme() {

	add_theme_support('post-thumbnails' );
	add_image_size( 'comment-thumb', 70, 70, true );				// Used in the most commented area of the sidebar.
	add_image_size( 'attachment-thumb', 75, 75, true ); 			// Maker Faire Sidebar
	add_image_size( 'shed-thumb', 90, 999, false); 					// Used in Maker Shed homepage widget
	add_image_size( 'ftms-thumb', 300, 999, false); 				// Used in the From the Maker Shed widget on homepage
	add_image_size( 'left-rail-home-thumb', 269, 120, true );		// Small blog posts on left rail
	add_image_size( 'house-ad', 279, 170, true );					// Top right corner of all pages
	add_image_size( 'small-home-feature-boxes', 285, 144, true );	// Feature boxes on home page.
	add_image_size( 'new-thumb', 140, 140, true ); 					// Used on Super Pages
	add_image_size( 'side-thumb', 280, 95, true );					// Used on Super Pages
	add_image_size( 'archive-thumb', 200, 200, true );				// Used on archives pages
	add_image_size( 'faire-thumb', 130, 130, true );				// Used on Maker Faire homepage
	add_image_size( 'volume-thumb', 144, 144, true );				// Used on volume page
	add_image_size( 'category-thumb', 298, 146, true );				// Used on Category archive pages when in a .span4
	add_image_size( 'category-thumb-small', 218, 146, true );		// Used on Category archive pages when in a .span3
	add_image_size( 'related-thumb', 98, 55, true );				// Used on related blocks.
	add_image_size( 'featured-thumb', 105, 105, true );				// Used on related blocks.
	/**
	  * Depracated image sizes.
	 */
	// add_image_size( 'super-thumb', 290, 170, true );
	// add_image_size( 'search-thumb', 100, 100, true );
	// add_image_size( 'big-thumb', 300, 300, true ); //300 pixels wide (and unlimited height)
	// add_image_size( 'dotw', 300, 209, true );
	// add_image_size( 'small-thumb', 50, 50, true );
	// add_image_size( 'home-biggest', 380, 264, true );

	// Content Width
	if ( ! isset( $content_width ) )
		$content_width = 620;
	// Post Formats
	add_theme_support( 'post-formats', array( 'gallery', 'aside', 'video' ) );
	// Custom Backgrounds
	add_theme_support( 'custom-background' );
	//Infinite Scroll!
	//add_theme_support( 'infinite-scroll', 'content' );
	add_theme_support( 'automatic-feed-links' );

	if ( array('volume', 'project' ) == get_post_type() ) {
		remove_action('the_content', 'contextly_linker_widget');
	}

}
add_action( 'after_setup_theme', 'make_action_after_setup_theme' );

/**
 * Initiate the Easy Custom Fields class
 */
$field_data = array (
	'advanced_testgroup' => array (										// unique group id
		'fields' => array(												// array "fields" with field definitions 
			/** 
			  * @depracated
			 */
			'Big_Video'		=> array(									// globally unique field id
				'label' 		=> 'Big YouTube Video',					// Field Label
				'hint'			=> 'Add the video ID from the YouTube video URL',	// A descriptive hint for the field
				'type' 			=> 'text',							// Custom Field Type (see Ref: field_type)
				'class'			=> 'aclass',							// CSS Wrapper class for the field
				'input_class' 	=> 'theEditor',							// CSS class for the input field
				'error_msg' 	=> 'The Advanced Field is wrong' ),		// Error message to show when validate fails
			'FeauturedID' 	=> array(									// globally unique field id
				'label' 		=> 'Maker Faire Project Profile',		// Field Label
				'hint'			=> 'Add the Maker Exhibit ID',			// A descriptive hint for the field
				'type' 			=> 'text',							// Custom Field Type (see Ref: field_type)
				'class'			=> 'aclass',							// CSS Wrapper class for the field
				'input_class' 	=> 'theEditor',							// CSS class for the input field
				'error_msg' 	=> 'The Maker ID is wrong' ),			// Error message to show when validate fails
		),
		'title' => 'Big Stuff',	// Group Title
		'context' => 'advanced',			// context as in http://codex.wordpress.org/Function_Reference/add_meta_box
		'pages' => array( 'post', 'page' ),	// pages as in http://codex.wordpress.org/Function_Reference/add_meta_box
	),
);
$easy_cf = new Easy_CF($field_data);


/**
 * A fancy schmancy method to stick a big video in the post area.
 *
 * The goal was to copy what BoingBoing was doing, editors never really got excited about it. Now, deprecated.
 * 
 * @deprecated 	Since January 2013.
 * @param 		$content
 * @return 		string $content with video.
 */
function make_insert_video($content) {
	global $wp_query;
			$postid = $wp_query->post->ID;
			$big_video = get_post_custom_values('Big_Video');
				if (isset($big_video[0])) {
					$content = make_youtube_embed('580','325').$content;
					return $content;
					}
				else {
					return $content;
					}
			$big_gallery = get_post_custom_values('Big_Gallery');
				if (isset($big_video[0])) {
					$content = $content.'<div class"gallery"><a href="'.the_permalink().'">Click here</a> to view the full gallery.';
					return $content;
					}
				else {
					return $content;
				}
				
}
add_filter('the_excerpt_rss', 'make_insert_video');
add_filter('the_content_rss', 'make_insert_video');
//add_filter('the_content_feed', 'make_insert_video');


/**
 * Method for cleaning content. 
 *
 * This is some old code that Stefan wrote back in the day.
 * 
 * @deprecated 	Since January 2013.
 * @param 		string $text Text to be cleaned.
 * @return 		string Cleaned text
 */
function make_richClean($text) {
	$text = str_replace(
		array("\xe2\x80\x98", "\xe2\x80\x99", "\xe2\x80\x9c", "\xe2\x80\x9d", "\xe2\x80\x93", "\xe2\x80\x94", "\xe2\x80\xa6"),
		array("'", "'", '"', '"', '-', '--', '...'),
	$text);

	// Next, replace their Windows-1252 equivalents.
	$text = str_replace(
		array(chr(145), chr(146), chr(147), chr(148), chr(150), chr(151), chr(133)),
		array("'", "'", '"', '"', '-', '--', '...'),
	$text);
	
	return($text);
}

add_action('widgets_init', 'make_register_sidebar');
/**
 * Register the WordPress sidebar to site.
 * 
 */
function make_register_sidebar() {
	if( function_exists('register_sidebar')) {
		register_sidebar( 
			array(
				'id'=>'makezine',
				'name'=>__('Makezine'),
				'description'=>__('Welcome to Make: Online' ),
				'before_widget'=>'<div class="rail_content">',
				'after_widget'=>'</div>',
				'before_title'=>'<div style="rail_header"><h2 class="rail">',
				'after_title'=>'</h2></div>'
			)
		);
	}
}

/**
 * Make: Live Widget Zone - Top of Sidebar
 * @deprecated 	Since January 2013.
 */
add_action('widgets_init', 'make_live_register_sidebar');
function make_live_register_sidebar() {
	if( function_exists('register_sidebar')) {
		register_sidebar( 
			array(
				'id'=>'makelive',
				'name'=>__('Make:Live'),
				'description'=>__('Widget Area For Make:Live. Add the Make:Live widget to have the live button show up.' ),
				'before_widget'=>'<div class="rail_content">',
				'after_widget'=>'</div>',
				'before_title'=>'<div style="rail_header"><h2 class="rail">',
				'after_title'=>'</h2></div>'
			)
		);
	}
}

// This bit is added so that we can get a fresher read on the stuff. Notably the Maker Faire feed for live events.
add_filter( 'wp_feed_cache_transient_lifetime', create_function( '$a', 'return 900;' ) );


/**
 * Enqueue all scripts and stylesheets.
 */
function make_enqueue_jquery() {
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'make-bootstrap', get_stylesheet_directory_uri() . '/js/bootstrap.js', array( 'jquery' ) );
	wp_enqueue_script( 'make-projects', get_stylesheet_directory_uri() . '/js/projects.js', array( 'jquery' ) );
	wp_enqueue_style( 'make-css', get_stylesheet_directory_uri() . '/css/style.css' );
	wp_enqueue_style( 'make-print', get_stylesheet_directory_uri() . '/css/print.css', array(), false, 'print' );
}

add_action( 'wp_enqueue_scripts', 'make_enqueue_jquery' );

/**
 * Catch a description for the OG protocol
 * 
 * @deprecated 	Since January 2013.
 * @param 		string $post->post_content to be trimmed, stripped, and shortened.
 * @return 		string Cleansed text.
 */
function make_catch_that_desc() {
	global $post;
	$meta = trim( strip_tags( strip_shortcodes( $post->post_content )));
	$meta = wp_trim_words( $meta,  25,  '…' );
	return($meta);
}

/**
 * List all Makers that are associated with the post.
 * 
 * @deprecated 	Since January 2013.
 * @return 		string List of Makers
 */
function make_makers() {
	
	$terms = get_the_terms(get_the_ID(), 'maker');
	$count = count($terms);
		if($terms > 0) {
			
			echo '<hr>';
			echo '<h4>Makers in this post:</h4>';
			the_terms( get_the_ID(), 'maker');
			$location = get_the_terms(get_the_ID(), 'maker');
			$count = count($location);
			if($location > 0) {
				echo ' &#150; ';
				the_terms( get_the_ID(), 'location');
			}
		}
}

/**
 * List all Makers that are associated with the post.
 * 
 * Grabs the feed of featured products, randomizes it, and then spits out the products at the bottom of blog posts and archive pages.
 * @return 	string HTML for featured products.
 */
function make_featured_products() {

	$url = 'http://makershed.com/net/webservice.aspx?api_name=generic\featured_products';
	$xml = wpcom_vip_file_get_contents( $url, 3, 60*60,  array( 'obey_cache_control_header' => false ) );

	if ( ! $xml )
		return;

	$simpleXmlElem = simplexml_load_string( $xml );
	if ( ! $simpleXmlElem )
		return;
	$xml_featured_products = $simpleXmlElem->asXML();
	$featured_products = simplexml_load_string($xml_featured_products);
	$products = $featured_products->Product;
	$products_count = count($products);
	if ($products_count > 8) {
		$input = range(1,$products_count);
		$arr = array_rand($input, 4);
	} else {
		$input = range(1,8);
		$arr = array_rand($input, 4);
	}


?>

<div class="features well">

<h3>In the <a href="http://www.makershed.com/?Click=107309">Maker Shed</a></h3>

<?php if (isset($products[$arr[0]])) { ?>

	<div class="twenty-five">

	<a href="http://www.makershed.com/ProductDetails.asp?&Click=107309&ProductCode=<?php echo $products[$arr[0]]->ProductCode; ?>">
		<?php 
			if ( function_exists( 'wpcom_vip_get_resized_remote_image_url' ) ) {
				echo '<img src="' . wpcom_vip_get_resized_remote_image_url( $products[$arr[0]]->PhotoURL, 115, 115 ) . '" alt="'. $products[$arr[0]]->ProductName.'" />';
			} else {
				echo '<img src="'.$products[$arr[0]]->PhotoURL.'" alt="'. $products[$arr[0]]->ProductName.'" class="small-thumb"/>';
			}
		?>
	</a>
	
	<div class="clear"></div>
	
	<div class="blurb">
	
		<h4><a href="http://www.makershed.com/ProductDetails.asp?&Click=107309&ProductCode=<?php echo $products[$arr[0]]->ProductCode; ?>"><?php echo $products[$arr[0]]->ProductName; ?></a></h4>
	
	</div>
	
	</div>

<?php } ?>

<?php if (isset($products[$arr[1]])) { ?>

<div class="twenty-five">

	<a href="http://www.makershed.com/ProductDetails.asp?&Click=107309&ProductCode=<?php echo $products[$arr[1]]->ProductCode; ?>">
		<?php 
			if ( function_exists( 'wpcom_vip_get_resized_remote_image_url' ) ) {
				echo '<img src="' . wpcom_vip_get_resized_remote_image_url( $products[$arr[1]]->PhotoURL, 115, 115 ) . '" alt="'. $products[$arr[1]]->ProductName.'" />';
			} else {
				echo '<img src="'.$products[$arr[1]]->PhotoURL.'" alt="'. $products[$arr[1]]->ProductName.'" class="small-thumb"/>';
			}
		?>
	</a>
	
<div class="clear"></div>

<div class="blurb">

	<h4><a href="http://www.makershed.com/ProductDetails.asp?&Click=107309&ProductCode=<?php echo $products[$arr[1]]->ProductCode; ?>"><?php echo $products[$arr[1]]->ProductName; ?></a></h4>

</div>

</div>

<?php } ?>

<?php if (isset($products[$arr[2]])) { ?>

	<div class="twenty-five">
	
	<a href="http://www.makershed.com/ProductDetails.asp?&Click=107309&ProductCode=<?php echo $products[$arr[2]]->ProductCode; ?>">
		<?php 
			if ( function_exists( 'wpcom_vip_get_resized_remote_image_url' ) ) {
				echo '<img src="' . wpcom_vip_get_resized_remote_image_url( $products[$arr[2]]->PhotoURL, 115, 115) . '" alt="'. $products[$arr[2]]->ProductName.'" />';
			} else {
				echo '<img src="'.$products[$arr[2]]->PhotoURL.'" alt="'. $products[$arr[2]]->ProductName.'" class="small-thumb"/>';
			}
		?>
	</a>
	
	<div class="clear"></div>
	
	<div class="blurb">
	
		<h4><a href="http://www.makershed.com/ProductDetails.asp?&Click=107309&ProductCode=<?php echo $products[$arr[2]]->ProductCode; ?>"><?php echo $products[$arr[2]]->ProductName; ?></a></h4>
		
	</div>
	
	</div>
	
<?php } ?>

<?php if (isset($products[$arr[3]])) { ?>

<div class="twenty-five">

	<a href="http://www.makershed.com/ProductDetails.asp?&Click=107309&ProductCode=<?php echo $products[$arr[3]]->ProductCode; ?>">
		<?php 
			if ( function_exists( 'wpcom_vip_get_resized_remote_image_url' ) ) {
				echo '<img src="' . wpcom_vip_get_resized_remote_image_url( $products[$arr[3]]->PhotoURL, 115, 115 ) . '" alt="'. $products[$arr[2]]->ProductName.'" />';
			} else {
				echo '<img src="'.$products[$arr[3]]->PhotoURL.'" alt="'. $products[$arr[3]]->ProductName.'" class="small-thumb"/>';
			}
		?>
	</a>
	
<div class="clear"></div>

<div class="blurb">

	<h4><a href="http://www.makershed.com/ProductDetails.asp?&Click=107309&ProductCode=<?php echo $products[$arr[3]]->ProductCode; ?>"><?php echo $products[$arr[3]]->ProductName; ?></a></h4>
	
</div>

</div>

<?php } ?>

<div class="clear"></div>

</div>

<div class="clear"></div>

<?php }



/**
 * Send iTunes requests to a specific feed
 */
function itunes_feed() {
	if( is_feed() && is_category('make_podcast')) {
		include(TEMPLATEPATH . '/feed-rss2-itunes.php' );
		exit;
	}
}

add_action('template_redirect', 'itunes_feed');

// add_action('pre_get_posts', 'make_mf_remove_tag_from_home' );

/**
 * Take Maker Faire posts that don't have MF tag, and remove from the main query.
 * @param $query
 */
function make_mf_remove_tag_from_home( $query ) {

	// only impact the main WordPress query and if on homepage or feed
	if( $query->is_main_query() && ( $query->is_home() || $query->is_feed() || $query->is_page(215620) ) ) {
		$query->set( 'tag__not_in', array( 5183,22815 ) );
	}
}

/**
 * Truncate the excerpt to 50 charecters.
 */
function make_custom_excerpt_length( $length ) {
	return 50;
}
add_filter( 'excerpt_length', 'make_custom_excerpt_length', 999 );

add_action( 'infinite_scroll_render', 'make_infinite_scroll_render' );

/**
 * Function to enable unlimited scroll.
 * @deprecated Since January 2013
 */
function make_infinite_scroll_render() {
	while ( have_posts() ) : the_post();
		get_template_part( 'content' );
	endwhile;
}
/**
 * Get the first category name of a post.
 * This take the category name, strips out content (spaces, &, and) and then returns.
 * @return string Main category name with a slash at the end.
 */
function make_get_category_name() {
	global $post;
	if ( is_single() && has_category() ) {
		$cats = get_the_terms($post->ID, 'category');
		$sortcats = array_shift($cats);
		if (!empty($sortcats)) {
			$cat = $sortcats; // let's just assume the post has one category
		}
	}
	elseif ( is_category() ) { // category archives
		$cat = get_queried_object();
	}
	if (is_single() || is_category()) {
		$output = '/';	
	} else {
		$output = null;
	}
	$boom = array( '&amp;', ' ', 'and' );
	if (!empty($cat->name)) {
		$output .= str_replace($boom, '', $cat->name);
	}
	return $output;
}
/**
 * Get the first category name of a post.
 * This take the category name, strips out content (spaces, &, and) and then returns.
 * @return string Main category name with a stripped slash.
 */
function make_get_category_name_strip_slash() {
	if ( is_single() ) {
		$cats =  get_the_category();
		$cat = $cats[0]; // let's just assume the post has one category
	}
	elseif ( is_category() ) { // category archives
		$cat = get_queried_object();
	}

	if (isset($cat->name)) {
		$boom = array( '&amp;', ' ', 'and' );
		$output = str_replace($boom, '', $cat->name);
		return $output;
	}
}

/**
 * Add different content types to the main queries.
 * This will bring posts, craft, projects, video into the main query. Allows for better archive pages.
 * @return string Main category name.
 */
// TODO: Bring in reviews.
function make_add_custom_types( $query ) {
	if ( ! is_admin() && $query->is_main_query() && ( $query->is_tag() || $query->is_author() || $query-> is_tax() ) && empty( $query->query_vars['suppress_filters'] ) ) {
		$query->set( 'post_type', array( 'post', 'craft', 'projects', 'video' ));
		return $query;
	}
}
add_filter( 'pre_get_posts', 'make_add_custom_types' );


add_filter( 'byline_auto_filter_author', '__return_true' );

/**
 * Tests if any of a post's assigned categories are descendants of target categories
 *
 * @param int|array $cats The target categories. Integer ID or array of integer IDs
 * @param int|object $_post The post. Omit to test the current post in the Loop or main query
 * @return bool True if at least 1 of the post's categories is a descendant of any of the target categories
 * @see get_term_by() You can get a category by name or slug, then pass ID to this function
 * @uses get_term_children() Passes $cats
 * @uses in_category() Passes $_post (can be empty)
 * @version 2.7
 * @link http://codex.wordpress.org/Function_Reference/in_category#Testing_if_a_post_is_in_a_descendant_category
 */
if ( ! function_exists( 'post_is_in_descendant_category' ) ) {
	function post_is_in_descendant_category( $cats, $_post = null ) {
		foreach ( (array) $cats as $cat ) {
			// get_term_children() accepts integer ID only
			$descendants = get_term_children( (int) $cat, 'category' );
			if ( $descendants && in_category( $descendants, $_post ) )
				return true;
		}
		return false;
	}
}

/**
 * Adds the Quantcast tag to the bottom of the page.
 * @return string Quantcast Javascript tracking code.
 */
function make_quantcast_tag() { ?>
		<!-- Quantcast Tag -->
		<script type="text/javascript">
			var _qevents = _qevents || [];

			(function() {
				var elem = document.createElement('script');
				elem.src = (document.location.protocol == "https:" ? "https://secure" : "http://edge") + ".quantserve.com/quant.js";
				elem.async = true;
				elem.type = "text/javascript";
				var scpt = document.getElementsByTagName('script')[0];
				scpt.parentNode.insertBefore(elem, scpt);
			})();

			_qevents.push({
				qacct:"p-c0y51yWFFvFCY"
			});
		</script>

		<noscript>
			<div style="display:none;">
				<img src="//pixel.quantserve.com/pixel/p-c0y51yWFFvFCY.gif" border="0" height="1" width="1" alt="Quantcast"/>
			</div>
		</noscript>
		<!-- End Quantcast tag -->
<?php }

add_action('wp_footer', 'make_quantcast_tag');

/**
 * Adds the popover javascript for review posts.
 */
function make_add_popover() {
	if ('review' == get_post_type()) { ?>
			<script type="text/javascript">
				jQuery(document).ready(function(){
					jQuery(".define").popover();
				});
			</script>
	<?php }
}

add_action('wp_footer', 'make_add_popover' );

/**
 * Removes the thumbnail class from the homepages of Craft and make.
 */
function make_get_rid_of_thumbnail_class() {

	if ( is_page( array( 'craft-home', 'home-page-include', 'home-page' ) ) ) { ?>

		<script>
			jQuery(document).ready(function(){
				jQuery(".entry-content img").removeClass('thumbnail');
			});
		</script>

	<?php }
}

add_action('wp_footer', 'make_get_rid_of_thumbnail_class');

/**
 * Hides the post name from the breadcrumb.
 * Ideally, we would do this using PHP, but I couldn't figure out an easy method. While this might be a little jarring, it works for now.
 */
function make_hide_breadcrumb_elements() {

	if (is_single()) { ?>

		<script>
			jQuery(document).ready(function(){
				jQuery("span.divider").eq(-1).hide();
				jQuery(".current").hide();
			});
		</script>

	<?php }
}

add_action('wp_footer', 'make_hide_breadcrumb_elements');

add_action('right_now_content_table_end', 'add_magazine_article_counts');

/**
 * Counts the post numbers for the Dashboard.
 */
function add_magazine_article_counts() {
		if (!post_type_exists('magazine')) {
			 return;
		}

		$num_posts = wp_count_posts( 'magazine' );
		$num = number_format_i18n( $num_posts->publish );
		$text = _n( 'Magazine Article', 'Magazine Articles', intval($num_posts->publish) );
		if ( current_user_can( 'edit_posts' ) ) {
			$url = admin_url( 'edit.php?post_type=magazine' );
			$num = '<a href="'.$url.'">'.$num.'</a>';
			$text = '<a href="'.$url.'">'.$text.'</a>';
		}
		echo '<td class="first b b-magazine">' . $num . '</td>';
		echo '<td class="t magazine">' . $text . '</td>';

		echo '</tr>';

		if ($num_posts->pending > 0) {
			$num = number_format_i18n( $num_posts->pending );
			$text = _n( 'Magazine Articles Pending', 'Magazine Articles Pending', intval($num_posts->pending) );
			if ( current_user_can( 'edit_posts' ) ) {
				$url = admin_url( 'edit.php?post_status=pending&post_type=magazine' );
				$num = '<a href="'.$url.'">'.$num.'</a>';
				$text = '<a href="'.$url.'">'.$text.'</a>';
			}
			echo '<td class="first b b-recipes">' . $num . '</td>';
			echo '<td class="t recipes">' . $text . '</td>';

			echo '</tr>';
		}
}

add_action('right_now_content_table_end', 'add_craft_article_counts');

/**
 * Counts the craft numbers for the Dashboard.
 */
function add_craft_article_counts() {
		if (!post_type_exists('craft')) {
			 return;
		}

		$num_posts = wp_count_posts( 'craft' );
		$num = number_format_i18n( $num_posts->publish );
		$text = _n( 'Craft Post', 'Craft Posts', intval($num_posts->publish) );
		if ( current_user_can( 'edit_posts' ) ) {
			$url = admin_url( 'edit.php?post_type=craft' );
			$num = '<a href="'.$url.'">'.$num.'</a>';
			$text = '<a href="'.$url.'">'.$text.'</a>';
		}
		echo '<td class="first b b-craft">' . $num . '</td>';
		echo '<td class="t craft">' . $text . '</td>';

		echo '</tr>';

		if ($num_posts->pending > 0) {
			$num = number_format_i18n( $num_posts->pending );
			$text = _n( 'Craft Posts Pending', 'Craft Posts Pending', intval($num_posts->pending) );
			if ( current_user_can( 'edit_posts' ) ) {
				$url = admin_url( 'edit.php?post_status=pending&post_type=craft' );
				$num = '<a href="'.$url.'">'.$num.'</a>';
				$text = '<a href="'.$url.'">'.$text.'</a>';
			}
			echo '<td class="first b b-craft">' . $num . '</td>';
			echo '<td class="t craft">' . $text . '</td>';

			echo '</tr>';
		}
}

add_action('right_now_content_table_end', 'add_page_2_article_counts');

/**
 * Counts the Page: 2 numbers for the Dashboard.
 */
function add_page_2_article_counts() {
		if (!post_type_exists('page_2')) {
			 return;
		}

		$num_posts = wp_count_posts( 'page_2' );
		$num = number_format_i18n( $num_posts->publish );
		$text = _n( 'Page:2 Post', 'Page: 2 Posts', intval($num_posts->publish) );
		if ( current_user_can( 'edit_posts' ) ) {
			$url = admin_url( 'edit.php?post_type=page_2' );
			$num = '<a href="'.$url.'">'.$num.'</a>';
			$text = '<a href="'.$url.'">'.$text.'</a>';
		}
		echo '<td class="first b b-page_2">' . $num . '</td>';
		echo '<td class="t page_2">' . $text . '</td>';

		echo '</tr>';

		if ($num_posts->pending > 0) {
			$num = number_format_i18n( $num_posts->pending );
			$text = _n( 'Page: 2 Pending', 'Page: 2 Posts Pending', intval($num_posts->pending) );
			if ( current_user_can( 'edit_posts' ) ) {
				$url = admin_url( 'edit.php?post_status=pending&post_type=page_2' );
				$num = '<a href="'.$url.'">'.$num.'</a>';
				$text = '<a href="'.$url.'">'.$text.'</a>';	
			}
			echo '<td class="first b b-page_2">' . $num . '</td>';
			echo '<td class="t b-page_2">' . $text . '</td>';

			echo '</tr>';
		}
}

/**
 * Creates a dropdown of child categories.
 * @deprecated Since January 2013.
 */
function make_cat_change() {

	if (is_category()) { ?>

		<script type="text/javascript">
			var dropdown = document.getElementById("cat");
			function onCatChange() {
				if ( dropdown.options[dropdown.selectedIndex].value > 0 ) {
					location.href = "<?php echo get_option('home'); ?>/?cat="+dropdown.options[dropdown.selectedIndex].value;
				}
			}
			dropdown.onchange = onCatChange;
		</script>

<?php } 

}

//add_action('wp_footer', 'make_cat_change');

/**
 * Takes popular tags, and renames them.
 */
function make_get_better_tag_title() {

	$title = single_cat_title('', false);
	$machine = array(
		'robotskills', 
		'castmat', 
		'advancedmaterials', 
		'reusedmat', 
		'plywoodmat', 
		'naturalmaterials', 
		'naturalmaterial', 
		'metalmat', 
		'ceramicsmat', 
		'concretematerial', 
		'circuitskills', 
		'electronskills', 
		'foodskills', 
		'hobbyskills', 
		'machineskills', 
		'MechanicSkills', 
		'metalskills',
		'Photo Skills',
		'plasticskills',
		'robotskills',
		'skillbuilder',
		'WoodSkills',
		'papermat',
		'glassmat',
		'greatcreate'
		);
	$human   = array(
		'Robot Skill Builder', 
		'Casting Materials', 
		'Advanced Mataerials', 
		'Reused Materials', 
		'Plywood', 
		'Natural Materials', 
		'Natural Materials', 
		'Metal', 
		'Ceramics', 
		'Concrete', 
		'Circuit Skill Builder',
		'Electronics Skill Builder', 
		'Food Skill Builder',
		'Hobby Skill Builder', 
		'Machining Skill Builder', 
		'Mechanic Skill Builder', 
		'Metal Skill Builder',
		'Photo Skill Builder',
		'Plastic Skill Builder',
		'Robot Skill Builder',
		'Skill Builder',
		'Woodworking Skill Builder',
		'Paper Skill Builder',
		'Glass',
		'Radio Shack\'s The Great Create'
		);
	$newtag = str_replace($machine, $human, $title);
	return $newtag;

}

/**
 * Adds the post thumbnail to the RSS feed.
 * Like a lot of people, I wish that we weren't truncating the RSS feed, but hey, not my decision!
 */
function make_rss_post_thumbnail($content) {
	global $post;
	if( has_post_thumbnail($post->ID) ) {
		$content =  '<a href="' . get_permalink() . '">' . get_the_post_thumbnail($post->ID, 'archive-thumb', array( 'style' => 'float:left; margin:0 15px 15px 0;' ) ) . '</a>' . get_the_excerpt() . '<p><a href="' . get_permalink() . '">Read more on MAKE</a></p>';
	}
	return $content;
}

add_filter('the_excerpt_rss', 'make_rss_post_thumbnail');
add_filter('the_content_feed', 'make_rss_post_thumbnail');


//add_filter( 'the_content', 'make_add_sharing_to_content_top' ); 

/**
 * Adds the WordPress.com sharing bar to the top of posts.
 */
function make_add_sharing_to_content_top( $content ) {

	if ( ('post' == get_post_type()) && function_exists( 'sharing_display') )
		$content = sharing_display() . $content;
		return $content; 
}

/**
 * Add category nicenames in body and post class
 * @deprecated Since January 2013
 */
function make_category_id_class($classes) {
	foreach((get_the_category( get_the_ID() )) as $category)
		$classes[] = $category->category_nicename;
	return $classes;
}
//add_filter('post_class', 'make_category_id_class');
//add_filter('body_class', 'make_category_id_class');

/**
 * Adds a View All link to the slideshow.
 */
function make_vapp_the_link( $link_text = 'View All', $class = 'vapp' ) {
	$url = vapp_get_url( get_the_ID() );

	if ( $url ) {
		$link = '<a ' . ( $class ? 'class="' . esc_attr( $class ) . '"' : '' ) . ' href="' . esc_url( $url ) . '">' . esc_html( $link_text ) . '</a>';

		return $link;
	}
}

add_action( 'admin_head', 'make_cpt_icons' );
/**
 * Adds icons for the custom post types that are in the admin.
 */
function make_cpt_icons() { ?>
	<style type="text/css" media="screen">
		#menu-posts-video .wp-menu-image {
			background: url('<?php bloginfo('template_url') ?>/images/camcorder.png') no-repeat 6px -17px !important;
		}
		#menu-posts-video:hover .wp-menu-image, #menu-posts-video.wp-has-current-submenu .wp-menu-image {
			background-position:6px 7px!important;
		}
		#menu-posts-slideshow .wp-menu-image {
			background: url('<?php bloginfo('template_url') ?>/images/slides.png') no-repeat 6px -17px !important;
		}
		#menu-posts-slideshow:hover .wp-menu-image, #menu-posts-slideshow.wp-has-current-submenu .wp-menu-image {
			background-position:6px 7px!important;
		}
		#menu-posts-craft .wp-menu-image {
			background: url('<?php bloginfo('template_url') ?>/images/cutter.png') no-repeat 6px -17px !important;
		}
		#menu-posts-craft:hover .wp-menu-image, #menu-posts-craft.wp-has-current-submenu .wp-menu-image {
			background-position:6px 7px!important;
		}
		#menu-posts-volume .wp-menu-image {
			background: url('<?php bloginfo('template_url') ?>/images/book.png') no-repeat 6px -17px !important;
		}
		#menu-posts-volume:hover .wp-menu-image, #menu-posts-volume.wp-has-current-submenu .wp-menu-image {
			background-position:6px 7px!important;
		}
		#menu-posts-magazine .wp-menu-image {
			background: url('<?php bloginfo('template_url') ?>/images/book-open.png') no-repeat 6px -17px !important;
		}
		#menu-posts-magazine:hover .wp-menu-image, #menu-posts-magazine.wp-has-current-submenu .wp-menu-image {
			background-position:6px 7px!important;
		}
		#menu-posts-review .wp-menu-image {
			background: url('<?php bloginfo('template_url') ?>/images/application-dialog.png') no-repeat 6px -17px !important;
		}
		#menu-posts-review:hover .wp-menu-image, #menu-posts-review.wp-has-current-submenu .wp-menu-image {
			background-position:6px 7px!important;
		}
		#menu-posts-page_2 .wp-menu-image {
			background: url('<?php bloginfo('template_url') ?>/images/application-form.png') no-repeat 6px -17px !important;
		}
		#menu-posts-page_2:hover .wp-menu-image, #menu-posts-page_2.wp-has-current-submenu .wp-menu-image {
			background-position:6px 7px!important;
		}
		#menu-posts-errata .wp-menu-image {
			background: url('<?php bloginfo('template_url') ?>/images/application-list.png') no-repeat 6px -17px !important;
		}
		#menu-posts-errata:hover .wp-menu-image, #menu-posts-errata.wp-has-current-submenu .wp-menu-image {
			background-position:6px 7px!important;
		}
		#menu-posts-projects .wp-menu-image {
			background: url('<?php bloginfo('template_url') ?>/images/application-tile.png') no-repeat 6px -17px !important;
		}
		#menu-posts-projects:hover .wp-menu-image, #menu-posts-projects.wp-has-current-submenu .wp-menu-image {
			background-position:6px 7px!important;
		}
	</style>
<?php }

add_action( 'pre_get_posts', 'make_support_post_parent_queries_in_admin' );
/**
 * Adds the ability to get all posts from a given parent in the admin.
 */
function make_support_post_parent_queries_in_admin( $query ) {
	if ( is_admin() && ! empty( $_GET['post_parent'] ) && $query->is_main_query() && ! $query->get( 'post_parent' ) && empty( $_POST ) && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {
		$query->set( 'post_parent', absint( $_GET['post_parent'] ) );
	}
}

/**
 * iTunes RSS feed stuff for page templates.
 */

$field_data = array (
	'advanced_testgroup' => array (
		'fields' => array(
			'ImageURL'					=> array(),
			'Summary'				    => array(),
			'Subtitle'				    => array(),
			'Tag'						=> array()
	),
	'title'		=> 'RSS Stuff',
	'context'	=> 'side',
	'pages'		=> array( 'page' ),
	),
);

$easy_cf = new Easy_CF($field_data);

function make_get_post_meta_rss( $term ) {
	$term =  get_post_custom_values( $term );
	$term = $term[0];
	$term = ent2ncr( $term );
	return $term;

}

/**
 * Spits out a UL of all of the featured posts
 */
function make_daily_themes() {
	$featuredposts = esc_html( make_get_cap_option( 'weekly' ) );
	$posts = array_map( 'get_post', explode( ',', $featuredposts ) );
	$output = '<ul>';
	foreach ( $posts as $idx => $post ) {
		$output .= '<li><a href="' . get_permalink( $post->ID ) . '">';
		if ( $idx == 0 )
			$output .= '<strong>Monday Jolt:</strong> ';
		if ( $idx == 1 )
			$output .= '<strong>Toolsday:</strong> ';
		if ( $idx == 2 )
			$output .= '<strong>Workshop Wednesday:</strong> ';
		if ( $idx == 3 )
			$output .= '<strong>3D Thursday:</strong> ';
		if ( $idx == 4 )
			$output .= '<strong>Family Friday:</strong> ';
		$output .= get_the_title( $post->ID );
		$output .= '</a></li>';
		
	}
	$output .= '</ul>';
	return $output;
	
	wp_reset_query();
}

add_shortcode( 'make-themes', 'make_daily_themes' );

/**
 * Adds a dynamic feature block to the home page.
 */
function make_featured_post() {
	$post_id = make_get_cap_option( 'daily' );
	$post = get_post( $post_id );
	$output = '<div class="img"><a href="' . get_permalink( $post->ID) . '">';
	$output .= get_the_post_thumbnail( $post->ID , $size = 'featured-thumb' );
	$output .= '</div>';
	$output .= '<div class="blurb">';
	$output .= '<h3><span class="trending">What\'s hot:</span> ' . $post->post_title . '</h3>';
	$output .= '<p><small>By: <strong>' . get_the_author_meta( 'display_name', $post->post_author ) . '</strong></small></p>';
	$output .= '<p>'.wp_trim_words(strip_shortcodes( $post->post_content ), 20).'</p>';
	$output .= '</a></div>';
	return $output;
}


/**
 * Renames the custom post type on the front end to be a little better.
 */
function make_post_type_better_name( $name ) {
	if ($name == 'post') {
		return 'posts';
	} elseif ($name == 'projects' ) {
		return 'projects';
	} elseif ( $name == 'videos' ) {
		return 'videos';
	} elseif ( $name == 'magazine' ) {
		return 'articles';
	} elseif ( $name == 'review' ) {
		return 'reviews';
	} elseif ( $name == 'craft' ) {
		return 'craft';
	} 
}

add_action( 'init', 'make_allow_data_atts' );
function make_allow_data_atts() {
	global $allowedposttags;

	$tags = array( 'div,a,li' );
	$new_attributes = array( 
		'data-toggle'	=> true,
		'data-dismiss'	=> true,
		'data-slide'	=> true,
		);

	foreach ( $tags as $tag ) {
		if ( isset( $allowedposttags[ $tag ] ) && is_array( $allowedposttags[ $tag ] ) )
			$allowedposttags[ $tag ] = array_merge( $allowedposttags[ $tag ], $new_attributes );
	}
}

add_filter('tiny_mce_before_init', 'make_filter_tiny_mce_before_init'); 
function make_filter_tiny_mce_before_init( $options ) { 

	if ( ! isset( $options['extended_valid_elements'] ) ) 
		$options['extended_valid_elements'] = ''; 

	$options['extended_valid_elements'] .= ',a[data*|class|id|style|href]';
	$options['extended_valid_elements'] .= ',li[data*|class|id|style]';
	$options['extended_valid_elements'] .= ',div[data*|class|id|style]';

	return $options; 
}

add_filter( 'wpcom_sitemap_post_types', 'make_sitemap_add_gallery_post_type' );

function make_sitemap_add_gallery_post_type( $post_types ) {
	$post_types[] = 'gallery';
	$post_types[] = 'video';
	$post_types[] = 'craft';
	$post_types[] = 'review';
	$post_types[] = 'projects';
	return $post_types;
}