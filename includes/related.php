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

	$output = '<aside class="' . esc_attr( $class ) . '">';
		if ( $count == 2 ) {
			foreach ( $ids as $id ) {
				$blurb = get_post( $id );
				$output .= get_the_post_thumbnail( $blurb->ID, 'comment-thumb', array( 'class=' => 'pull-left' ) );
				$output .= '<h4>' . apply_filters( 'the_title', $blurb->post_title ) . '</h4>';
				$output .= Markdown( wp_trim_words( strip_shortcodes( $blurb->post_content ), 10, '...' ) );
				wp_reset_postdata();
			}
		}
	$output .= '</aside>';
	return $output;
}