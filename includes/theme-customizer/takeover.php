<?php


/**
 * Register and load our JavaScript that lets us preview our changes automatically in the preview window
 * @return void
 *
 * @since  HAL 9000
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
 * @since  HAL 9000
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
		'label'   => 'Enable Takeover',
		'type' 	  => 'select',
		'choices' => array(
			'on'  => 'Enabled',
			'off' => 'Disabled',
		),
		'priority' => 10,
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
			'priority' => 15,
		) )
	);


	// Register the banner image URL
	$wp_customize->add_setting( 'make_banner_url_takeover', array(
		'default' => '',
		'sanitize_callback' => 'make_theme_customizer_sanitize_text_url',
	) );

	$wp_customize->add_control( 'make_banner_url_takeover', array(
		'section' => 'make_takeover',
		'label' => 'Top Banner Link',
		'type' => 'text',
		'priority' => 16,
	) );


	// Register the featured post ID
	$wp_customize->add_setting( 'make_featured_post_url', array(
		'default' => '',
		'sanitize_callback' => 'make_theme_customizer_sanitize_text',
	) );

	$wp_customize->add_control( 'make_featured_post_url', array(
		'section' => 'make_takeover',
		'label' => 'Featured Post ID',
		'type' => 'text',
		'priority' => 20,
	) );


	// Register the featured post image
	$wp_customize->add_setting( 'make_featured_post_image', array(
		'default' => '',
		'sanitize_callback' => 'make_theme_customizer_sanitize_text',
	) );

	$wp_customize->add_control(
		new WP_Customize_Image_Control( $wp_customize, 'make_featured_post_image', array(
			'settings' => 'make_featured_post_image',
			'section' => 'make_takeover',
			'label' => 'Featured Post Image (303x288)',
			'priority' => 21,
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
		'priority' => 22,
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
		'priority' => 23,
	) );


	// Register the top right post ID
	$wp_customize->add_setting( 'make_topright_post_url', array(
		'default' => '',
		'sanitize_callback' => 'make_theme_customizer_sanitize_text',
	) );

	$wp_customize->add_control( 'make_topright_post_url', array(
		'section' => 'make_takeover',
		'label' => 'Top Right Post ID',
		'type' => 'text',
		'priority' => 30,
	) );


	// Register the top right post image
	$wp_customize->add_setting( 'make_topright_post_image', array(
		'default' => '',
		'sanitize_callback' => 'make_theme_customizer_sanitize_text',
	) );

	$wp_customize->add_control(
		new WP_Customize_Image_Control( $wp_customize, 'make_topright_post_image', array(
			'settings' => 'make_topright_post_image',
			'section' => 'make_takeover',
			'label' => 'Top Right Post Image (283x218)',
			'priority' => 31,
		) )
	);


	// Register the top right post title
	$wp_customize->add_setting( 'make_topright_post_title', array(
		'default' => '',
		'sanitize_callback' => 'make_theme_customizer_sanitize_text',
		'transport' => 'postMessage',
	) );

	$wp_customize->add_control( 'make_topright_post_title', array(
		'section' => 'make_takeover',
		'label' => 'Top Right Post Title',
		'type' => 'text',
		'priority' => 32,
	) );


	// Register the bottom right post ID
	$wp_customize->add_setting( 'make_bottomright_post_url', array(
		'default' => '',
		'sanitize_callback' => 'make_theme_customizer_sanitize_text',
	) );

	$wp_customize->add_control( 'make_bottomright_post_url', array(
		'section' => 'make_takeover',
		'label' => 'Bottom Right Post ID',
		'type' => 'text',
		'priority' => 40,
	) );


	// Register the bottom right post image
	$wp_customize->add_setting( 'make_bottomright_post_image', array(
		'default' => '',
		'sanitize_callback' => 'make_theme_customizer_sanitize_text',
	) );

	$wp_customize->add_control(
		new WP_Customize_Image_Control( $wp_customize, 'make_bottomright_post_image', array(
			'settings' => 'make_bottomright_post_image',
			'section' => 'make_takeover',
			'label' => 'Bottom Right Post Image (283x218)',
			'priority' => 41,
		) )
	);


	// Register the bottom right post title
	$wp_customize->add_setting( 'make_bottomright_post_title', array(
		'default' => '',
		'sanitize_callback' => 'make_theme_customizer_sanitize_text',
		'transport' => 'postMessage',
	) );

	$wp_customize->add_control( 'make_bottomright_post_title', array(
		'section' => 'make_takeover',
		'label' => 'Bottom Right Post Title',
		'type' => 'text',
		'priority' => 42,
	) );

}
add_action( 'customize_register', 'make_theme_customizer_home_takeover' );


/**
 * Used within the add_settings sanitize_callback option.
 * @param  string $input The data to be sanitized
 * @return string
 *
 * @since  HAL 9000
 */
function make_theme_customizer_sanitize_text( $input ) {
	return strip_tags( stripslashes( $input ) );
}


/**
 * Sanitize urls like a boss
 * @param  string $input The data to be sanitized
 * @return string
 *
 * @since  HAL 9000
 */
function make_theme_customizer_sanitize_text_url( $input ) {
	return esc_url( $input );
}


/**
 * Helper function to fetch and process our theme customizer data
 * @param  string  $mod_name The name of the modification to return
 * @param  boolean $echo     Choose to return or echo the data
 * @return string
 *
 * @since  HAL 9000
 */
function make_get_takeover_mod( $mod_name, $echo = true ) {

	switch( $mod_name ) {

		// Handle the banner image
		case 'make_banner_takeover' :
			$result = get_theme_mod( 'make_banner_takeover' );
			break;

		// Handle the banner image url (this can be a post ID or a full URL.)
		case 'make_banner_url_takeover' :
			$val = get_theme_mod( 'make_banner_url_takeover' );

			if ( absint( $val ) ) {
				$result = get_permalink( absint( $val ) );
			} else {
				$result = $val;
			}
			break;

		// Handle the post URLs
		case 'make_featured_post_url' :
		case 'make_topright_post_url' :
		case 'make_bottomright_post_url' :
			$result = get_permalink( absint( get_theme_mod( sanitize_text_field( $mod_name ) ) ) );
			break;

		// Handle the post images
		case 'make_featured_post_image' :
		case 'make_topright_post_image' :
		case 'make_bottomright_post_image' :
			$featured_image = get_theme_mod( sanitize_text_field( $mod_name ) );

			if ( $mod_name == 'make_featured_post_image' ) {
				$size = 'takeover-featured';
			} else {
				$size = 'takeover-thumb';
			}

			if ( $mod_name == 'make_featured_post_image' ) {
				$id = 'make_featured_post_url';
			} elseif ( $mod_name == 'make_topright_post_image' ) {
				$id = 'make_topright_post_url';
			} elseif ( $mod_name == 'make_bottomright_post_image' ) {
				$id = 'make_bottomright_post_url';
			}

			if ( ! empty( $featured_image ) ) {
				$result = $featured_image;
			} else {
				$image = get_the_image( array(
					'post_id' => absint( get_theme_mod( sanitize_text_field( $id ) ) ),
					'image_scan' => true,
					'size' => $size,
					'format' => 'array',
					'echo' => false,
				) );

				$result = $image['src'];
			}
			break;

		// Handle the post titles
		case 'make_featured_post_title' :
		case 'make_topright_post_title' :
		case 'make_bottomright_post_title' :
			$featured_title = get_theme_mod( sanitize_text_field( $mod_name ) );

			if ( ! empty( $featured_title ) ) {
				$result = $featured_title;
			} else {
				if ( $mod_name == 'make_featured_post_title' ) {
					$mod_post_id_field = 'make_featured_post_url';
				} elseif ( $mod_name == 'make_topright_post_title' ) {
					$mod_post_id_field = 'make_topright_post_url';
				} elseif ( $mod_name == 'make_bottomright_post_title' ) {
					$mod_post_id_field = 'make_bottomright_post_url';
				}

				$result = get_the_title( absint( get_theme_mod( $mod_post_id_field ) ) );
			}
			break;

		// Handle the featured post excerpt
		case 'make_featured_post_excerpt' :
			$featured_excerpt = get_theme_mod( 'make_featured_post_excerpt' );
			
			if ( ! empty( $featured_excerpt ) ) {
				$result = $featured_excerpt;
			} else {
				$the_post = get_post( absint( get_theme_mod( 'make_featured_post_url' ) ) );
				$result = $the_post->post_excerpt;
			}

	}

	if ( $echo ) {
		echo $result;
	} else {
		return $result;
	}
}


/**
 * Helper function to ensure a theme modification exists
 * @param  string $mod_name The name of the theme modification to check
 * @return boolean
 *
 * @since  HAL 9000
 */
function make_has_takeover_mod( $mod_name ) {
	$val = get_theme_mod( sanitize_text_field( $mod_name ) );

	if ( isset( $val ) && ! empty( $val ) ) {
		return true;
	} else {
		return false;
	}
}

add_action( 'customize_register', 'make_textarea_customize_register' );
/**
 * Add a textarea to the customize menu.
 */
function make_textarea_customize_register($wp_customize) {
	/**
	 * Class to add a textarea to the customizer.
	 * Class example from: http://ottopress.com/2012/making-a-custom-control-for-the-theme-customizer/
	 */
	class Make_Customize_Textarea_Control extends WP_Customize_Control {
		
		public $type = 'textarea';

		function render() {
			$id    = 'customize-control-' . str_replace( '[', '-', str_replace( ']', '', $this->id ) );
			$class = 'customize-control customize-control-' . $this->type;

			?><li id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $class ); ?>">
				<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
					<textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
				</label>
			</li><?php
		}
	}
}

/**
 * 
 * Sets up the interface in the theme customizer for the takeover options
 * @param  object $wp_customize An instance of the WP_Customize_Manager class
 * @return void
 *
 * @since  Iron Giant
 */
function make_theme_canvas_home_takeover( $wp_customize ) {

	// Register our section
	$wp_customize->add_section( 'make_canvas', array(
		'title' => 'Canvas Takeover',
		'priority' => 1
	) );


	// Register the enable field
	$wp_customize->add_setting( 'make_enable_canvas', array(
		'default' => 'off',
	) );

	$wp_customize->add_control( 'make_enable_canvas', array(
		'section' => 'make_canvas',
		'label'   => 'Enable Canvas Takeover',
		'type' 	  => 'select',
		'choices' => array(
			'on'  => 'Enabled',
			'off' => 'Disabled',
		),
		'priority' => 10,
	) );

	// Register the banner image
	$wp_customize->add_setting( 'make_canvas_takeover', array(
		'default' => '',
		'transport' => 'postMessage',
	) );

	$wp_customize->add_control( 
		new WP_Customize_Image_Control( $wp_customize, 'make_canvas_takeover', array(
			'settings' => 'make_canvas_takeover',
			'section' => 'make_canvas',
			'label' => 'Background Image',
			'priority' => 15,
		) )
	);

	// Register the html for the page.
	$wp_customize->add_setting( 'make_canvas_html_box', array(
		'default' => '',
		'sanitize_callback' => 'wp_kses_post',
	) );

	$wp_customize->add_control( 'make_canvas_html_box', array(
		'section' => 'make_canvas',
		'label' => 'HTML for canvas box',
		'type' => 'text',
		'priority' => 20,
	) );

}
add_action( 'customize_register', 'make_theme_canvas_home_takeover' );