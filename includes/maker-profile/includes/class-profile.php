<?php


class Make_Maker_Profiles {

	// static const 
	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'add_resources' ) );
	}

	public function add_resources() {
		// 120% sure we already load jQuery, but just incase...
		wp_enqueue_script( 'jQuery' );

		// Load Underscore and Backbone
		wp_enqueue_script( 'underscore' );
		wp_enqueue_script( 'backbone' );

		// Load some misc scripts that make things work outside of Backbone
		// wp_enqueue_script( 'make-profile-common', get_stylesheet_directory_uri() . )
	}
}

$make_maker_profiles = new Make_Maker_Profiles();