<?php
/**
 * Instagram class for MAKE
 */
class Make_Instagram {

	/**
	 * THE CONSTRUCT.
	 *
	 * @return  void
	 */
	public function __construct() {

		add_action( 'wp_enqueue_scripts', array( $this, 'load_resources' ), 30 );

	}

	/**
	 * Let's add all of our resouces to make our magic happen.
	 */
	public function load_resources() {

	}

	/**
	 * Load the Maker Faire data feed.
	 * Might update this at some point so that you can pass in any user.
	 *
	 * @return OBJECT Instagram response
	 */
	public function load_data() {

		$base_url = 'https://api.instagram.com/v1/users/227901753/media/recent';
		$params = array(
			'access_token' => '227901753.1fb234f.3be9baa7c6d34efa821b9bf79641374e',
		);

		// Build the URL
		$url = add_query_arg( $params, $base_url );

		var_dump( $url );

		// Request the data
		$json = wpcom_vip_file_get_contents( $url );

		// Parse the JSON
		$data = json_decode( $json );

		// Send it off...
		return $data;
	}

	public function show_images() {
		$data = $this->load_data();
		echo '<img src="' . esc_url( $data->data[1]->images->standard_resolution->url ) . '" alt="Instagram">';
		var_dump( $data->data[4] );
	}

}

$instagram = new Make_Instagram();

function make_show_images() {
	$instagram = new Make_Instagram();
	echo $instagram->show_images();
}