<?php
/**
 * Create a Bit.ly URL
 */
function make_bitly_url( $url ) {
	// Base URL for the API
	$bitly = 'http://api.bit.ly/shorten';
	// Arguments to append.
	$args = array(
		'version' 	=> '2.0.1',
		'longUrl' 	=> $url,
		'login'		=> 'makerm',
		'apiKey'	=> 'R_959d3d6914fd1e9b1ddfb64791bc062c',
		'format'	=> 'json'
	);
	
	// Formatted long URL
	$long_url = add_query_arg( $args, $bitly );

	// Get the response
	$response = wpcom_vip_file_get_contents( $long_url );

	// Decode the JSON
	$json = json_decode( $response, true );
	// Return the URL
	return $json['results'][$url]['shortUrl'];
}

/**
 * Look for the Bit.ly URL, if it doesn't exist, create one
 */
function make_generate_redirect_url( $id ) {
	$redir_url = get_post_meta( $id, 'bitly_url', true );
	if ( !$redir_url ) {
		$url = get_post_meta( $id, 'url', true );
		$bitlyurl = make_bitly_url( esc_url( $url ) );
		if ( $bitlyurl == null ) {
			$redir_url = $url;
		} else {
			$new_bitly_url = update_post_meta( $id, 'bitly_url', $bitlyurl );
			$redir_url = $bitlyurl;
		}	
	}
	return $redir_url;
}