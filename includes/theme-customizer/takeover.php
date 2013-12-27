<?php


/**
 * Register and load our JavaScript that lets us preview our changes automatically in the preview window
 * @return void
 *
 * @since  SPRINT_NAME
 */
function make_register_theme_customizer() {
	wp_enqueue_script( 'make-theme-customizer', get_stylesheet_directory_uri() . '/js/theme-customizer.js', array( 'jquery', 'customize-preview' ), '0.1', true );
}
add_action( 'customize_preview_init', 'make_register_theme_customizer' );


/**
 * 
 * Sets up the interface in the theme customizer for the takeover options
 * @param  object $wp_customize An instance of the WP_Customize_Manager class
 * @return void
 *
 * @since  SPRINT_NAME
 */
function make_theme_customizer_home_takeover( $wp_customize ) {

	// Register our section
	$wp_customize->add_section( 'make_takeover', array(
		'title' => 'Homepage Takeover',
		'priority' => 1
	) );


	// Register the enable field
	$wp_customize->add_setting( 'make_enable_takeover', array(
		'default' => 'off',
	) );

	$wp_customize->add_control( 'make_enable_takeover', array(
		'section' => 'make_takeover',
		'label'   => 'Enable',
		'type' 	  => 'select',
		'choices' => array(
			'on'  => 'Enabled',
			'off' => 'Disabled',
		),
	) );


	// Register the banner image
	$wp_customize->add_setting( 'make_banner_takeover', array(
		'default' => '',
		'transport' => 'postMessage',
	) );

	$wp_customize->add_control( 
		new WP_Customize_Image_Control( $wp_customize, 'make_banner_takeover', array(
			'settings' => 'make_banner_takeover',
			'section' => 'make_takeover',
			'label' => 'Top Banner',
		) )
	);


	// Register the banner image URL
	$wp_customize->add_setting( 'make_banner_url_takeover', array(
		'default' => '',
		'transport' => 'postMessage',
	) );

	$wp_customize->add_control(
		new WP_Customize_Image_Control( $wp_customize, 'make_banner_url_takeover', array(
			'settings' => 'make_banner_url_takeover',
			'section' => 'make_takeover',
			'label' => 'Top Banner Link',
		) )
	);


	// Register the featured post image
	$wp_customize->add_setting( 'make_featured_post_image', array(
		'default' => '',
		'transport' => 'postMessage',
	) );

	$wp_customize->add_control(
		new WP_Customize_Image_Control( $wp_customize, 'make_featured_post_image', array(
			'settings' => 'make_featured_post_image',
			'section' => 'make_takeover',
			'label' => 'Featured Post Image',
		) )
	);


	// Register the featured post title
	$wp_customize->add_setting( 'make_featured_post_title', array(
		'default' => '',
		'sanitize_callback' => 'make_theme_customizer_sanitize_text',
		'transport' => 'postMessage',
	) );

	$wp_customize->add_control( 'make_featured_post_title', array(
		'section' => 'make_takeover',
		'label' => 'Featured Post Title',
		'type' => 'text',
	) );


	// Register the featured post excerpt
	$wp_customize->add_setting( 'make_featured_post_excerpt', array(
		'default' => '',
		'sanitize_callback' => 'make_theme_customizer_sanitize_text',
		'transport' => 'postMessage',
	) );

	$wp_customize->add_control( 'make_featured_post_excerpt', array(
		'section' => 'make_takeover',
		'label' => 'Featured Post Excerpt',
		'type' => 'text',
	) );


	// Register the featured post ID
	$wp_customize->add_setting( 'make_featured_post_id', array(
		'default' => '',
		'sanitize_callback' => 'make_theme_customizer_sanitize_text',
		'transport' => 'postMessage',
	) );

	$wp_customize->add_control( 'make_featured_post_id', array(
		'section' => 'make_takeover',
		'label' => 'Featured Post ID',
		'type' => 'text',
	) );
}
add_action( 'customize_register', 'make_theme_customizer_home_takeover' );


/**
 * Used within the add_settings sanitize_callback option.
 * @param  string $input The data to be sanitized
 * @return string
 *
 * @since  SPRINT_NAME
 */
function make_theme_customizer_sanitize_text( $input ) {
	return strip_tags( stripslashes( $input ) );
}


function make_tc_takeover( $mod_name ) {

	switch( $mod_name ) {

		// Handle the banner image
		case 'banner' :
			return get_theme_mod( 'make_banner_takeover' );
			break;

		// Handle the banner image url (this can be a post ID or a full URL.)
		case 'banner-url' :
			$val = get_theme_mod( 'make_banner_url_takeover' );

			if ( is_int( $val ) ) {
				return get_permalink( absint( $val ) );
			} else {
				return $val;
			}
			break;

		// Handle the feauted post ID
		case 'featured-id' :
			return get_theme_mod( 'make_featured_post_id' );
			break;

		// Handle the featured post image
		case 'featured-image' :
			$featured_image = get_theme_mod( 'make_featured_post_image' );

			if ( ! empty( $featured_image ) ) {
				return $featured_image;
			} else {
				return get_the_image( array(
					'post_id' => absint( get_theme_mod( 'make_featured_post_id' ) ),
					'image_scan' => true 
				) );
			}
			break;

		// Handle the featured post title
		case 'featured-title' :
			$featured_title = get_theme_mod( 'make_featured_post_title' );

			if ( ! empty( $featured_title ) ) {
				return $featured_title;
			} else {
				return get_the_title( absint( get_theme_mod( 'make_featured_post_id' ) ) );
			}
			break;

		// Handle the featured post excerpt
		case 'featured-excerpt' :
			$featured_excerpt = get_theme_mod( 'make_featured_post_excerpt' );
			if ( ! empty( $featured_excerpt ) ) {
				return $featured_excerpt;
			} else {
				$the_post = get_post( absint( get_theme_mod( 'make_featured_post_id' ) ) );

				return $the_post->post_excerpt;
			}

		// If all else fails, let's return nothing.
		default:
			return;
			break;
	}
}
