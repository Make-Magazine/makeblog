<?php
/**
 * Stats Functions
 * 
 * Moving this to the admin. The original goal, was just to make it as a private page, but Mo dropped Mjölnir on that commit...
 *
 */
function make_get_tweet_count( $url ) {
 
	$json_string = wpcom_vip_file_get_contents( 'http://urls.api.twitter.com/1/urls/count.json?url=' . $url );
	$json = json_decode( $json_string, true );
 
	return intval( $json['count'] );
}
 
function make_get_like_count( $url ) {
 
	$json_string = wpcom_vip_file_get_contents( 'http://graph.facebook.com/?ids=' . $url );
	$json = json_decode( $json_string, true );
 
	return intval( $json[$url]['shares'] );
}

function make_get_plusone_count( $url ) {
 
	$args = array(
			'method' => 'POST',
			'headers' => array(
				// setup content type to JSON
				'Content-Type' => 'application/json'
			),
			// setup POST options to Google API
			'body' => json_encode(array(
				'method' => 'pos.plusones.get',
				'id' => 'p',
				'method' => 'pos.plusones.get',
				'jsonrpc' => '2.0',
				'key' => 'p',
				'apiVersion' => 'v1',
				'params' => array(
					'nolog'=>true,
					'id'=> $url,
					'source'=>'widget',
					'userId'=>'@viewer',
					'groupId'=>'@self'
				)
			 )),
			 // disable checking SSL sertificates
			'sslverify'=>false
		);
 
	// retrieves JSON with HTTP POST method for current URL
	$json_string = wp_remote_post( "https://clients6.google.com/rpc", $args );
 
	if ( is_wp_error( $json_string ) ) {
		// return zero if response is error
		return "0";
	} else {
		$json = json_decode( $json_string['body'], true );
		// return count of Google +1 for requsted URL
		return intval( $json['result']['metadata']['globalCounts']['count'] );
	}
}

function make_get_postview_count( $post_id, $days = 30, $end, $table ) {
	$args = array( 
		'api_key'	=> '2954c2c6e490',
		'blog_uri'	=> 'makezine.com',
		'format'	=> 'json',
		'period'	=> 'days',
		'table' 	=> $table,
		'post_id'	=> $post_id,
		'days'		=> $days,
		'end'		=> $end,
		);

	$url = add_query_arg( $args, 'http://stats.wordpress.com/csv.php' );

	$json_string = wpcom_vip_file_get_contents( $url );

	$json = json_decode( $json_string, true );

	$count = null;

	foreach ( $json as $date ) {
		$count = $count + $date['views'];
	}

	return $count;
}

function make_social_stats() {
	if ( !empty( $_POST ) ) {
		$url 		= ( isset( $_POST['url'] ) )		? esc_url( $_POST['url'] ) : 			'' ;
		$post_id 	= ( isset( $_POST['post_id'] ) )	? intval( $_POST['post_id'] ) : 		'' ;
		$days		= ( isset( $_POST['days'] ) )		? intval( $_POST['days'] ) :			'' ;
		$end 		= ( isset( $_POST['end'] ) )		? sanitize_title( $_POST['end'] ) : 	'' ;
		$table 		= ( isset( $_POST['table'] ) )		? sanitize_title( $_POST['table'] ) : 	'' ;
	}
	?>
	<div class="wrap">

		<style>

			.control-group {
				clear: both;
				margin-bottom: 15px;
			}

			.control-label {
				width: 120px;
				float: left;
			}
		</style>
	
		<h1>The Social Counter!</h1>
		
		<div id="" class="postbox metabox-holder">
			<h3 class="hndle"><span>Social Stats</span></h3>
			<div class="inside">
				<div class="table table_content">
					<p class="sub">Add a URL to get stats</p>
					<form action="" method="post" class="">
						<input type="text" class="span3" placeholder="url&hellip;" name="url">
						<?php wp_nonce_field( 'make_stats_nonce', 'make_stats_nonce' ); ?>
						<button type="submit" class="button btn btn info">Submit</button>
					</form>
					
					<br class="clear">
					
					<?php
			
						if ( !empty( $_POST['make_stats_nonce'] ) && wp_verify_nonce( $_POST['make_stats_nonce'], 'make_stats_nonce' ) ) {

							echo '<table class="table table-striped table-bordered"><thead><tr><th>Site</th><th>Count</th></tr></thead><tbody>';
							echo '<tr><td>Twitter Tweets</td>';
							echo '<td>' . make_get_tweet_count( $url ) . '</td></tr>';
							echo '<tr><td>Facebook Likes</td>';
							echo '<td>' . make_get_like_count( $url ) . '</td></tr>';
							echo '<tr><td>Google Plusses</td>';
							echo '<td>' . make_get_plusone_count( $url ) . '</td></tr>';
							echo '</tbody></table>';
						}
					?>
					
					<br class="clear">
				</div>
			</div>
		</div>

		<div class="postbox metabox-holder">

			<h3 class="hndle"><span>WordPress.com Stats Counter</span></h3>

			<div class="inside">
				<div class="table table_content">
					<p class="sub">Add a Post ID to combined stats for the page.</p>
					<form action="" method="post" class="">
						<div class="control-group">
							<label class="control-label" for="post_id">Post ID</label>
							<div class="controls">
								<input type="text" class="span3" placeholder="Post ID" name="post_id">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="days">Number of Days</label>
							<div class="controls">
								<input type="text" class="span3" placeholder="Number of Days" name="days">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="end">End Date</label>
							<div class="controls">
								<input type="date" class="span3" placeholder="End Date" name="end">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="table">Table</label>
							<div class="controls">
								<select name="table">
									<option value="postviews">Post Views (Includes RSS)</option>
									<option value="views">Page Views</option>
								</select>
							</div>
						</div>
						<?php wp_nonce_field( 'make_wpcom_stats_nonce', 'make_wpcom_stats_nonce' ); ?>
						<button type="submit" class="button btn btn info">Submit</button>
					</form>
					
					<br class="clear">
					
					<?php
			
						if ( !empty( $_POST['make_wpcom_stats_nonce'] ) && wp_verify_nonce( $_POST['make_wpcom_stats_nonce'], 'make_wpcom_stats_nonce' ) ) {

							echo '<table class="table table-striped table-bordered"><thead><tr><th>Site</th><th>Count</th></tr></thead><tbody>';
							echo '<tr><td>Page Views</td>';
							echo '<td>' . make_get_postview_count( $post_id, $days, $end, $table ) . '</td></tr>';
							echo '</tbody></table>';
						}
					?>
					
					<br class="clear">
				</div>
			</div>

		</div>
	<?php
}

/**
 * Hook the page in
 */
function make_add_stats_menu_page() {
	add_submenu_page( 'index.php', 'Social Stats', 'Social Stats', 'edit_posts', 'social_stats', 'make_social_stats' );
}

add_action( 'admin_menu', 'make_add_stats_menu_page' );
