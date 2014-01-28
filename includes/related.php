<?php
/**
 * Related posts for MAKE
 */

add_shortcode('related', 'make_get_related_content');
/**
 * Function to grab the content of a post and style it.
 */
function make_get_related_content( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'class'		=> 'pull-right',
	), $atts ) );

	$ids = explode( ',', $atts['ids'] );

	$count = count( $ids );

	$output = '<aside class="pull-quote ' . esc_attr( $class ) . ' pull-quote-' . esc_attr( $count ) . '">';
	$output .= ( isset( $atts['title'] ) ) ? '<h3><span>' . wp_kses_post( $atts['title'] ) . '</span></h3>' : '<h3><span>Related</span></h3>';
	$output .= '<div class="row-fluid">';
		if ( $count == 2 ) {
			foreach ( $ids as $id ) {
				$output .= '<div class="span6">';
				$blurb = get_post( $id );
				$output .= '<a href="' . esc_url( get_permalink( $id ) ) . '" class="' . esc_attr( $class ) . '">';
				$output .= get_the_post_thumbnail( $blurb->ID, 'comment-thumb', array( 'class' => 'pull-left' ) );
				$output .= '</a>';
				$output .= '<a href="' . esc_url( get_permalink( $id ) ) . '">';
				$output .= '<h4>' . apply_filters( 'the_title', $blurb->post_title ) . '</h4>';
				$output .= '</a>';
				$output .= Markdown( wp_trim_words( strip_shortcodes( $blurb->post_content ), 10, '...' ) );
				wp_reset_postdata();
				$output .= '</div>';
			}
		} elseif ( $count == 1 ) {
			$output .= '<div class="span12">';
				$blurb = get_post( $ids[0] );
				$output .= '<a href="' . esc_url( get_permalink( $ids[0] ) ) . '" class="' . esc_attr( $class ) . '">';
				$output .= get_the_post_thumbnail( $blurb->ID, 'comment-thumb', array( 'class' => 'pull-left' ) );
				$output .= '</a>';
				$output .= '<a href="' . esc_url( get_permalink( $ids[0] ) ) . '">';
				$output .= '<h4>' . apply_filters( 'the_title', $blurb->post_title ) . '</h4>';
				$output .= '</a>';
				$output .= Markdown( wp_trim_words( strip_shortcodes( $blurb->post_content ), 9, '...' ) );
				wp_reset_postdata();
				$output .= '</div>';
		}
	$output .= '</aside>';
	return $output;
}