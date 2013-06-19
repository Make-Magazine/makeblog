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
				$number = get_post_custom_values( 'MakeProjectsGuideNumber' );
				file_put_contents( $file, get_the_ID() . ", " . get_permalink() . ", " . esc_url( $link[0] ) . ", " . $number[0] . "\n", FILE_APPEND );
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
		$file = sprintf( '/tmp/%s-htaccess.txt', date( 'Y-m-d' ) );
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

	/**
	 * Inserts comments from Make: Projects
	 *
	 * @subcommand comments
	 * 
	 */
	public function make_projects_comment_import() {
		include_once 'comments.php';
		foreach ($comments as $comment) {
			$date = date( 'Y-m-d H:i:s', $comment['comment_date'] );
			$data = array(
				'comment_post_ID' => $comment['comment_post_ID'],
				'comment_author' => $comment['comment_author'],
				'comment_author_email' => $comment['comment_author_email'],
				'comment_content' => $comment['comment_content'],
				'comment_date' => $date
			);
			$comment_id = wp_insert_comment( $data );
			if ( !$comment_id ) {
				WP_CLI::warning( "Could not create comment" );
			} else {
				WP_CLI::success( "Inserted comment " . $comment_id . ", posted on " . $date);
			}
		}
	}

	/**
	 * Inserts parts from Make: Projects
	 *
	 * @subcommand parts
	 * 
	 */
	public function make_projects_parts_import() {
		include_once 'parts.php';
		foreach ($parts as $part) {
			$del = delete_post_meta( $part['post_ID'], 'parts' );
			$pid = add_post_meta( $part['post_ID'], 'parts', $part );
			if ( !$del ) {
				WP_CLI::warning( "Nothing to delete" );
			} else {
				WP_CLI::success( 'Deleted ' . $part['post_ID'] );
			}
			if ( !$pid ) {
				WP_CLI::warning( "Could not create part..." );
			} else {
				WP_CLI::success( 'Inserted part: ' . $part['text'] );
			}
		}
	}

	/**
	 * Inserts parts from Make: Projects
	 *
	 * @subcommand switcher
	 * 
	 */
	public function make_post_type_switcher() {
		$args = array(
			'tag' 				=> 'reviews',
			'posts_per_page' 	=> 300,
			'post_type'			=> 'post'
			);
		$the_query = new WP_Query( $args );
		while ( $the_query->have_posts() ) : $the_query->the_post();
			$set = set_post_type( get_the_ID(), 'review' );
			if ( $set == 0 ) {
				WP_CLI::warning( "Blerg... Wasn't able to update " . get_the_title() );
			} else {
				WP_CLI::success( 'Updated ' . get_the_title() );
			}
		endwhile;
	}

	/**
	 * Inserts the Go: Redirects
	 *
	 * @subcommand go
	 * 
	 */
	public function make_go_links_import() {
		include_once 'post-types/redirects.php';
		foreach ($redirects as $redirect) {
			$post = array(
				'post_title'    => $redirect['title'],
				'post_name'		=> $redirect['name'],
				'post_type'  	=> 'go',
				'post_status'   => 'publish',
				'post_author'   => 0,
			);
			$post_id = wp_insert_post( $post );
			$title = get_the_title( $post_id );
			WP_CLI::line('☆.。.:*・°☆.。.:*・°☆.。.:*・°☆.。.:*・°☆');
			if ( !$post_id ) {
				WP_CLI::warning( "Couldn't insert post... Sorry about that." );
			} else {
				WP_CLI::success( "Inserted redirect: " . $title  );
			}
			$meta_id = update_post_meta( $post_id, 'url', esc_url( $redirect['url'] ) );
			if ( !$meta_id ) {
				WP_CLI::warning( "Didn't add the URL meta..." );
			} else {
				WP_CLI::success( "Added " . $redirect['url'] . " to " . $title );
			}
			$bitly = make_bitly_url( esc_url_raw ($redirect['url'] ) );
			$bitlyurl = update_post_meta( $post_id, 'bitly_url', $bitly );
			if ( !$bitlyurl ) {
				WP_CLI::warning( "Didn't add the Bit.ly URL meta..." );
			} else {
				WP_CLI::success( "Added a shorturl of " . $bitly . " to " . $title );
			}
			WP_CLI::line('');
		}
	}
}
