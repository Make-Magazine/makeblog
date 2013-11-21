<?php
/**
* WordPress.com Faceted Search
*/

// Bring in the search Widget
// require_once( __DIR__ . '/search-widget-facets.php' );


function make_search_facets( $args, $instance ) {
	if ( ! function_exists( 'WPCOM_elasticsearch' ) || ! is_search() )
		return;

	$facets = WPCOM_elasticsearch()->get_search_facet_data();

	$current_filters = WPCOM_elasticsearch()->get_current_filters();

	if ( ! $facets && ! $current_filters )
		return;

	$facets_found = false;
	foreach ( $facets as $facet ) {
		if ( count( $facet['items'] ) > 1 ) {
			$facets_found = true;
			break;
		}
	}
	if ( ! $facets_found && ! $current_filters )
		return;


	$title = apply_filters( 'widget_title', ! empty( $instance['title'] ) ? $instance['title'] : 'Search Refinement', $instance, $this->id_base );

	echo $args['before_widget'];

	echo $args['before_title'] . $title . $args['after_title'];

	if ( $current_filters ) {
		echo '<h3>' . __( 'Current Filters', 'wpcom-elasticsearch' ) . '</h3>';

		echo '<ul>';

		foreach ( $current_filters as $filter ) {
			echo '<li><a href="' . esc_url( $filter['url'] ) . '">' . sprintf( __( '(X) %1$s: %2$s', 'wpcom-elasticsearch' ), esc_html( $filter['type'] ), esc_html( $filter['name'] ) ) . '</a></li>';
		}

		if ( count( $current_filters ) > 1 )
			echo '<li><a href="' . esc_url( add_query_arg( 's', get_query_var( 's' ), home_url() ) ) . '">' . __( 'Remove All Filters', 'wpcom-elasticsearch' ) . '</a></li>';

		echo '</ul>';
	}

	foreach ( $facets as $label => $facet ) {
		if ( count( $facet['items'] ) < 2 )
			continue;

		echo '<h3>' . $label . '</h3>';

		echo '<ul>';
		foreach ( $facet['items'] as $item ) {
			echo '<li><a href="' . esc_url( $item['url'] ) . '">' . esc_html( $item['name'] ) . '</a> (' . number_format_i18n( absint( $item['count'] ) ). ')</li>';
		}
		echo '</ul>';
	}

	echo $args['after_widget'];
}

function make_search_count( $wp_query ) {
	$output = '<div class="results_count">';
	if ( $wp_query->found_posts > 10 ) {
		$paged = ( $wp_query->query_vars['paged'] === 0 ) ? 1 : $wp_query->query_vars['paged'];
		$post_count = ( ( $paged * $wp_query->query_vars['posts_per_page'] ) - $wp_query->query_vars['posts_per_page'] + 1 );
		$output .= '<span class="bold">' . $post_count . '</span>';
		$output .= ' - ';
		$output .= '<span class="bold">' . ( $post_count + $wp_query->post_count - 1 ) . '</span>';
		$output .= ' of <span class="bold">' . $wp_query->found_posts . '</span> results';
	}
	$output .= '</div>';

	return $output;
}