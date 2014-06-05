<?php
	/**
	 * This page contains all source code pertaining to Maker Camp.
	 *
	 * @package    makeblog
	 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
	 * @author     Cole Geissinger <cgeissinger@makermedia.com>
	 * 
	 */
	
	/**
	 * Adds a menu field to the menus section of the admin area for Maker Camp.
	 * @return void
	 *
	 * @version  1.0
	 */
	function make_mc_register_menu() {
		register_nav_menu( 'mc-header-menu', __( 'Maker Camp Nav' ) );
	}
	add_action( 'init', 'make_mc_register_menu' );


	/**
	 * Load our javascript and other resources
	 * @return void
	 *
	 * @version  1.0
	 */
	function make_mc_load_resources() {
		if ( is_page_template( 'page-makercamp.php' || is_page_template( 'page-makercamp-map.php' ) ) ) {
			wp_enqueue_script( 'bootstrap' );
			wp_enqueue_script( 'maker-camp-js', get_stylesheet_directory_uri() . '/js/maker-camp.js', array('jquery'), '1.0', true );
		}
	}
	add_action( 'wp_enqueue_scripts', 'make_mc_load_resources' );

	
	/****** Shortcodes *****/

	/**
	 * A simple shortcode that will allow us to echo out the logo.
	 * Great to use becase we don't actually contain the logo in the header file...
	 * @param  Array  $atts an array of any options we'll be sending
	 * @return String
	 *
	 * @version  1.0
	 */
	function make_mc_logo( $atts ) {
		extract( shortcode_atts( array(
			'width'  => 564, // Only accepts integers
			'height' => 174, // Only accepts integers
		), $atts ) );
		
		return '<a href="http://google.com/+make" target="_blank"><img src="http://makezineblog.files.wordpress.com/2013/07/makercamp_whtlarge_logo.png?w=' . intval( $width ) . '" alt="Maker Camp - On Google+" width="' . intval( $width ) . '" height="' . intval( $height ) . '"></a>';
	}
	add_shortcode('maker-camp-logo', 'make_mc_logo' );


	/**
	 * Displays all the code needed for displaying an event or "project" in the schedule page.
	 *
	 * Use the attributes to add custom information and wrap the body description with this tag.
	 * @param  Array  $atts    An array of any options we'll be sending
	 * @param  String $content The string that holds our content wrapped in our shortcode
	 * @return String
	 *
	 * @version 1.0
	 */
	function make_mc_project_schedule_item( $atts, $content ) {
		extract( shortcode_atts( array(
			'date'  => '',        // String. The date as you want it to appear
			'img'   => '', 		  // String. URL to the project image
			'title' => '', 		  // String. Enter the title of the project
			'project_url' => '',  // String. Enter the url for title of the project
			'mentor' => '', 	  // String. Enter the name of the mentor
			'mentor_link' => '',  // URL.    Enter the mentors URL to link to.
			'link'  => '', 		  // String. Add in the URL to where you want the far right button to link to
			'link_title' => 'View on G+',    // URL. This variable takes the text that will display in the button on the far right
			'class' => '', 		  // String. Allows you to add extra classes. Separate each class with a space.
		), $atts ) );

		// wp_kses allow html array
		$allowed = array(
			'br' 	 => array(),
			'em' 	 => array(),
			'strong' => array(),
		);

		// Check if new classes are tossed at us.
		$output  = ( ! empty( $class ) ) ? '<div class="row maker ' . esc_attr( $class ) . '">' : '<div class="row maker">' ;

		// Load the project photo
		if ( ! empty( $img ) ) {
			$output .= '<div class="span3 project-photo"><img src="' . wpcom_vip_get_resized_remote_image_url( esc_url( $img ), 270, 174 ) . '" /></div>';
		} else {
			$output .= '<div class="span3 project-photo"><img src="' . get_stylesheet_directory_uri() . '/img/makercamp/schedule-placeholder.png" /></div>';
		}

		$output .= '<div class="span6 project-body">';

		// Load the project title
		if ( ! empty( $title ) )
			$output .= '<h2 class="project-title">';

			// Do we have a link?
			if ( ! empty( $project_url ) )
				$output .= '<a href="' . esc_url( $project_url ) . '">';

			$output .= esc_attr( $title );
				
			// Close the link if it exists
			if ( ! empty( $project_url ) )
				$output .= '</a>';

			$output .= '</h2>';

		// Look for a date
		if ( ! empty( $date ) )
			$output .= '<h3 class="date">' . esc_attr( $date ) . ' ';

		// Is there a mentor?
		if ( ! empty( $mentor ) ) {
			$output .= ' &mdash; Makers: ';

			// Is there a link to the mentor?
			if ( ! empty( $mentor_link ) )
				$output .= '<a href="' . esc_url( $mentor_link ) . '">';

			// Output the mentor name
			$output .= wp_kses_post( $mentor );

			// Close the link
			if ( ! empty( $mentor_link ) )
				$output .= '</a>';

		// Close the mentor if statement
		}
		
		// Close the heading
		if ( ! empty( $date ) )
			$output .= '</h3>';

		// Add the main body paragraph
		$output .= wp_kses_post( do_shortcode( $content ) );

		// Close the project body
		$output .= '</div>';

		// Start the right sidebar
		$output .= '<div class="span3 project-link">';
		
		// Let's get the links, and if there isn't one, setup the default.
		$link  = ( ! empty( $link ) ) ? esc_url( $link ) : 'http://google.com/+make';
		$links = explode(',', $link);

		// Set a counter.
		$i = 0;

		// Loop through links, might be more then one.
		foreach ($links as $link) {
			$output .= '<a href="';

			// Check if a link is set or not and display the right HTML
			$output .= esc_url( $link );
			$output .= '" class="button blue small-button">';
			
			// If there are multiple links, there might be multiple titles.
			$linktitle = explode(',', $link_title);
			$output .= esc_html( $linktitle[$i] );

			// Check again and close the needed HTML if a link is set or not
			$output .= '</a>';

			// Increase the counter
			$i++;
		}

		// Close the project link
		$output .= '</div>';
		
		// Put an end to this madness. Close the .maker class
		$output .= '</div>';

		// Now spit it out...
		return $output;
	}
	add_shortcode( 'maker-camp-project', 'make_mc_project_schedule_item' );


	/**
	 * The shortcode to displaying the project materials link and modal window
	 * @param  Array  $atts    An array of any options we'll be sending
	 * @param  String $content The string that holds our content wrapped in our shortcode
	 * @return String
	 */
	function make_mc_project_schedule_materials( $atts, $content ) {
		extract( shortcode_atts( array(
			'link_id'   => '',
			'link_name' => 'Materials and Instructions',
			'class'     => '',
			'width'     => 600,
			'height'    => 550,
		), $atts ) );

		// wp_kses allow html array
		$allowed = array(
			'br' 	 => array(),
			'em' 	 => array(),
			'strong' => array(),
		);

		if ( ! empty( $content ) ) {
			$output = '<h5><a class="' . esc_attr( $class ) . '" data-toggle="modal" href="#' . esc_attr( $link_id ) . '">' . esc_html( $link_name ) . '</a></h5>
			<div class="modal hide fade" id="' .esc_attr( $link_id ) . '">
				<div class="modal-header">
					<a class="close" data-dismiss="modal">&times;</a>
					<h3>' . esc_html( $link_name ) . '</h3>
				</div>
				<div class="modal-body">' . wp_kses_post( do_shortcode( $content ) ) . '</div>
				<div class="modal-footer">
					<a class="btn" data-dismiss="modal" aria-hidden="true">Close</a>
				</div>
			</div>';

			return $output;
		}
	}
	add_shortcode( 'maker-camp-project-materials', 'make_mc_project_schedule_materials' );