<?php
/**
 * makeblog commands for the WP-CLI framework
 *
 * @package wp-cli
 * @since 3.0
 * @see https://github.com/wp-cli/wp-cli
 */

WP_CLI::add_command( 'make', 'MAKE_WP_CLI_Command' );

class MAKE_WP_CLI_Command extends WP_CLI_Command {

	/**
	 * Prints permalinks for projects with the Make:Projects URL
	 *
	 * @subcommand csv
	 * 
	 */
	public function make_query_to_csv() {
		// Create a new output file
		$file = sprintf( '/tmp/%s-make-query-to-csv.csv', date( 'Y-m-d' ) );
		file_put_contents( $file, "" );

		$args = array(
			'post_type' => array( 'projects' ),
			'post_status' => 'any',
			'posts_per_page' => 3000,
		);

		$query = new WP_Query($args);

		if( $query->have_posts() ) :
			while ( $query->have_posts() ) : $query->the_post();
				$link = get_post_custom_values( 'Link' );
				file_put_contents( $file, get_the_ID() . ", " . get_permalink() . ", " . esc_url( $link[0] ) . ", " . substr(esc_url( $link[0] ), -6, -2) . "\n", FILE_APPEND );
			endwhile;
		endif;

	}

	/**
	 * Prints a redirect map for Make: Projects/
	 *
	 * @subcommand redirect
	 * 
	 */
	public function make_redirect_map() {
		// Create a new output file
		$file = sprintf( '/tmp/%s-make-query-to-csv.csv', date( 'Y-m-d' ) );
		file_put_contents( $file, "" );

		$args = array(
			'post_type' => array( 'projects' ),
			'post_status' => 'any',
			'posts_per_page' => 3000,
		);

		$query = new WP_Query($args);

		if( $query->have_posts() ) :
			while ( $query->have_posts() ) : $query->the_post();
				$link = get_post_custom_values( 'Link' );
				$bad = array(":", '/', '+');
				$good = array('\:', '\/', '\+' );
				$link = get_post_custom_values( 'Link' );
				if (!empty($link[0])) {
					if ( get_post_status ( get_the_ID() ) == 'publish' ) {
						file_put_contents( $file, "rewriterule ^" . str_replace( $bad, $good, substr( esc_url( $link[0] ), 24 ) ) . " \"" .  ( str_replace( $bad, $good, get_permalink() ) ) . "\" [R=301,L] \n", FILE_APPEND );
					} else {
						file_put_contents( $file, "rewriterule ^" . str_replace( $bad, $good, substr( esc_url( $link[0] ), 24 ) ) . " \"http\:\/\/blog.makezine.com\/projects\/\" [R=301,L] \n", FILE_APPEND );
					}
				}
			endwhile;
		endif;

	}


}