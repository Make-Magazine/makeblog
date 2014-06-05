<?php
/**
 * Dash Analytics Tools
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Jake Spurlock <jspurlock@makermedia.com>
 * 
 */
/**
 * Pulls content from the Dash API.
 * With the make_the_dash_shares_widget(), we want to ping the stats from dash, and then return each item in a list.
 *
 * @param string $type Which analytivs to return. Current options are 'realtime', 'analytics', and 'shares'.
 * @param string $hits String to preface the hit counter. If blank, nothing is added.
 * @param string $limit Integer, defaults to 5
 * @param string $size Integer, size of image to return.
 * @return string Unordered list
 */

function make_the_dash_shares_widget($type, $hits = null, $limit = 5, $size = 80) {

	$pop_posts = wp_cache_get( $type . '-dash' );
	if ( false === $pop_posts ) {
		$url = 'http://api.parsely.com/v2/'.$type.'/posts?limit=' . $limit . '&apikey=makezine.com&secret=C0RtpmzLu7lpfYSOq66jGKUesnseRPQYyNu8HBYvRMQ';
		$contents = wpcom_vip_file_get_contents( $url, 3, 900, array( 'obey_cache_control_header' => false ) );
		$json_output = json_decode($contents);
		wp_cache_set( 'pop_posts', $pop_posts );
	}

	$data = $json_output->data;

	$content = null;

	foreach ($data as $key => $item) {
		$needles = array( 'Craft Home', 'MAKE', 'Search',  );
		$exclude = false;
		foreach ($needles as $needle) {
			$pos = strpos( $item->title, $needle );
			if ( $pos !== false || empty( $item->title ) ) {
				$exclude = true;
				break 1;
			}
		}
		if(!$exclude){

			$slideshow = '/slideshow/';
			if ($type == 'shares') {
				$url = $item->url;
			} else {
				$url = $item->link;
			}
			$rand = mt_rand();

			$pos = strpos( $url, $slideshow );
			$content .= '<div class="media">';
			$content .= '<a href="' . esc_url( $url ) . '" class="pull-left">';

			if ( $type == 'realtime' && ( isset( $item->image_url ) ) ) {
				if ( function_exists( 'wpcom_vip_get_resized_remote_image_url' ) ) {
					$content .= '<img src="' . wpcom_vip_get_resized_remote_image_url( $item->image_url, $size, $size ) . '" class="thumbnail media-object" alt="' . esc_attr($item->title) . '" />';
				} else {
					$content .= '<img src="' . esc_url($item->image_url) . '" class="thumbnail media-object" alt="' . esc_attr($item->title) . '" />';
				}
			} else {
				if (isset($item->thumb_url_medium)) {
					if ( function_exists( 'wpcom_vip_get_resized_remote_image_url' ) ) {
						$content .= '<img src="' . wpcom_vip_get_resized_remote_image_url( $item->thumb_url_medium, $size, $size ) . '" class="thumbnail media-object" alt="' . esc_attr($item->title) . '" />';
					} else {
						$content .= '<img src="' . esc_url($item->thumb_url_medium) . '" class="thumbnail media-object" alt="' . esc_attr($item->title) . '" />';
					}
				} else {
					$content .= '<img src="http://1.gravatar.com/blavatar/dab43acfe30c0e28a023bb3b7a700440?s=70" class="thumbnail media-object" alt="' . esc_attr($item->title) . '" />';
				}				
			}
			
			$content .= '</a>';
			$content .= '<div class="media-body">';
			$content .= '<div class="media-heading"><h5><a href="' . esc_url( $url ) . '">' . esc_html($item->title) . '</a></h5></div>';
			$content .= '<ul class="unstyled">';
			$content .= '<li>By: ' . esc_html($item->author)  . '</li>';
			if ($type == 'shares' && $hits != null) {
				$content .= '<li>'  . $hits .' <span class="badge badge-info">'.  esc_html($item->_shares) . '</span></li>';
			} elseif ($hits != null) {
				$content .= '<li>'  . $hits .' <span class="badge badge-info">'.  esc_html($item->_hits) . '</span></li>';
			}
			$content .= '</ul>';
			$content .= '</div></div>';
		}
	}

	return $content;

}

/**
 * Grab the shares for a post.
 * This function just grabs the totals, but could be adapted to grab the individual stats.
 *
 * @uses wp_cache_get()
 * @uses wpcom_vip_file_get_contents()
 * @uses json_decode()
 * @uses wp_cache_set()
 * @param string|array $url URL of post to get stats for.
 * @return string Totals shares, combined of Twitter, Facebook, Linkedin, StumbleUpon, and Pinterest
 */
function make_dash_get_the_shares( $url ) {

	$post_shares = wp_cache_get( $url . '-dash' );
	if ( false === $post_shares ) {
		$url = 'http://api.parsely.com/v2/shares/post/detail?apikey=makezine.com&url=' . urlencode( $url );
		$contents = wpcom_vip_file_get_contents( $url, 3, 900, array( 'obey_cache_control_header' => false ) );
		$json_output = json_decode($contents);
		wp_cache_set( 'post_shares', $post_shares );
	}

	if (isset($json_output->data[0])) {
		$total = $json_output->data[0]->total;
		return $total;
	} else {
		return 0;
	}

}

/**
 * Generate the a list of most commented posts.
 *
 */
function make_most_commented_query() {
	$pop_query = new WP_Query( array(
		'post_type'              => 'post',
		'post_status'            => 'publish',
		'monthnum'               => date( 'n' ),
		'year'                   => date( 'Y' ),
		'orderby'                => 'comment_count',
		'posts_per_page'         => 8,
		'update_post_term_cache' => false,
		'no_found_rows'          => true,
	) );

	while ( $pop_query->have_posts() ) : $pop_query->the_post(); ?>
		<div class="row-fluid item">
			<div class="span4">
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail('comment-thumb', array('class' => 'thumbnail', )); ?>
				</a>
			</div>
			<div class="span8">
				<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
				<ul class="unstyled">
					<li>By: <?php the_author() ?></li>
					<li>Comments: <span class="badge badge-info"><?php comments_number( '0', '1', '%' ); ?></span></li>
				</ul>
			</div>
		</div>
	<?php endwhile; ?>

	<?php wp_reset_postdata(); ?>

<?php }
