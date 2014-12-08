<?php
/**
* WordPress.com Faceted Search
*/

/**
 * Search Facets
 * Majority of this code is from the Elastic Search plugin. Using this as a starting point.
 */
function make_search_facets( $args ) {
	if ( ! function_exists( 'WPCOM_elasticsearch' ) )
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

	echo $args['before_widget'];

	echo $args['before_title'] . $args['title'] . $args['after_title'];

	if ( $current_filters ) {
		echo '<h4>' . __( 'Current Filters', 'wpcom-elasticsearch' ) . '</h4>';

		echo '<ul class="unstyled">';

		foreach ( $current_filters as $filter ) {
			echo '<li><a href="' . esc_url( $filter['url'] ) . '">' . sprintf( __( '<i class="icon icon-remove"></i> %1$s: %2$s', 'wpcom-elasticsearch' ), esc_html( $filter['type'] ), esc_html( $filter['name'] ) ) . '</a></li>';
		}

		if ( count( $current_filters ) > 1 )
			echo '<li><a href="' . esc_url( add_query_arg( 's', get_query_var( 's' ), home_url() ) ) . '">' . __( 'Remove All Filters', 'wpcom-elasticsearch' ) . '</a></li>';

		echo '</ul>';
	}

	foreach ( $facets as $label => $facet ) {
		if ( count( $facet['items'] ) < 2 )
			continue;

		echo '<h4>' . $label . '</h4>';

		echo '<ul class="unstyled">';
		foreach ( $facet['items'] as $item ) {
			echo '<li><a href="' . esc_url( $item['url'] ) . '">' . esc_html( $item['name'] ) . '</a> (' . number_format_i18n( absint( $item['count'] ) ). ')</li>';
		}
		echo '</ul>';
	}

	echo $args['after_widget'];
}

/**
 * Getting the post count for a given loop.
 * There is probably a WordPress function that does this for ya, but this works for now.
 */
function make_search_count( $wp_query ) {
	$output = '<div class="results_count">';
	if ( $wp_query->found_posts > 10 ) {
		$paged = ( $wp_query->query_vars['paged'] === 0 ) ? 1 : $wp_query->query_vars['paged'];
		$post_count = ( ( $paged * $wp_query->query_vars['posts_per_page'] ) - $wp_query->query_vars['posts_per_page'] + 1 );
		$output .= '<span class="bold">' . absint( $post_count ) . '</span>';
		$output .= ' - ';
		$output .= '<span class="bold">' . ( $post_count + $wp_query->post_count - 1 ) . '</span>';
		$output .= ' of <span class="bold">' . $wp_query->found_posts . '</span> results';
	}
	$output .= '</div>';

	return $output;
}

/**
 * Build the output pagination for the search page.
 */
function make_search_pagination( $wp_query ) {
	$big = 999999999; // need an unlikely integer

	return paginate_links( array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' => '?paged=%#%',
		'current' => max( 1, $wp_query->query_vars['paged'] ),
		'total' => $wp_query->max_num_pages,
		'prev_text'    => __('<span class="prev">«</span>'),
		'next_text'    => __('<span class="next">»</span>'),
		'add_args'     => false,
	) );
}