<?php

	/**
	 * The function to display author/maker bios
	 *
	 * @version  1.0
	 * @author  Cole Geissinger <cgeissinger@makermedia.com>
	 * 
	 */
	

	class Make_Authors {

		/**
		 * Get our authors information via Gravatar
		 * @return Object
		 *
		 * @version  1.0
		 * @since    1.0
		 */
		public function make_get_author_data() {
			global $post;
			$coauthors = get_coauthors();

			$data = array();
			$i = 0;
			foreach( $coauthors as $coauthor ) {
				if ( !empty( $coauthor->linked_account ) ) {
					// We need the ID of the linked author so we can get their posts.
					$linked_author = get_user_by( 'slug', $author->linked_account );
					// When an account is linked, we want to add this email into mix to see if we return gravatar data
					$username = $linked_author->user_login;
				} elseif ( isset( $coauthor->data->user_login ) ) {
					$username = $coauthor->data->user_login;
				} else {
					$username = $coauthor->user_login;
				}
				$url = 'http://en.gravatar.com/' . $username . '.json';	
				$contents  = wpcom_vip_file_get_contents( $url );
				if ( $contents == false ) {
					$data[$i] = $coauthor;
				} else {
					$json = json_decode( $contents );
					$data[$i] = $json;
				}
				$i++;
			}
			return $data;
		}

		/**
		 * Generate a gravatar url based on the hash
		 * @return String
		 *
		 * @version  1.0
		 * @since    1.0
		 */
		public function get_gravatar_img_url( $url, $size ) {
			$gravurl = add_query_arg( array( 's' => $size ), $url );
			return esc_url( $gravurl );
		}


		/**
		 * Return the full HTML block for our author-bio's
		 * @return String|Bool
		 *
		 * @version  1.0
		 * @since    1.0
		 */
		public function full_author_formatted() {
			$authors = $this->make_get_author_data();
			$output = '';
			
			// Make sure a user was loaded.
			foreach ( $authors as $author ) {
				$output .= '<div class="author-bio row">';
					$output .= '<div class="author-photo span2">';
					
						// Return the authro bio photo.
						if ( isset( $author->entry[0] ) ) {
							$output .= '<a href="' . esc_url( home_url( '/author/' . $author->entry[0]->requestHash ) ) . '"><img src="' . $this->get_gravatar_img_url( $author->entry[0]->thumbnailUrl, 200 ) . '" alt="' . esc_attr( $author->entry['0']->displayName ) . '" /></a>';
						} else {
							$output .= '<a href="' . esc_url( home_url( '/author/' . $author->user_login ) ) . '">' .  get_the_post_thumbnail( $author->ID, 'archive-thumb' ) . '</a>';
						}
						
					$output .= '</div>';

					$output .= '<div class="span6">';

						// Return the author name.
						if ( isset( $author->entry[0] ) ) {
							$output .= '<h3 class="jumbo">BY <a class="noborder" href="' . esc_url( home_url( '/author/' . $author->entry[0]->requestHash ) ) . '">' . esc_html( $author->entry['0']->displayName ) . '</a></h3>';
						} else {
							$output .= '<h3 class="jumbo">BY <a class="noborder" href="' . esc_url( home_url( '/author/' . $author->user_login ) ) . '">' . esc_html( $author->display_name ) . '</a></h3>';
						}

						// Display the bio info.
						if ( isset( $author->entry[0]->aboutMe ) ) {
							$output .= Markdown( $author->entry[0]->aboutMe );
						} elseif ( isset( $author->description ) ) {
							$output .= Markdown( $author->description );
						}

						// Display the soical media accounts.
						if ( isset( $author->entry[0]->accounts ) ) {
							$output .= $this->author_social( $author->entry[0]->accounts );
						}
						
						// Display the author website urls. We'll also pass it our already quried Author data.
						if ( isset( $author->entry[0]->urls ) ) {
							$output .= $this->author_urls( $author->entry[0]->urls );
						};
					$output .= '</div>';
				$output .= '</div>';
			}
			return $output;
		}


		/**
		 * Returns only the data for the author name
		 * @return String
		 *
		 * @version  1.0
		 * @since    1.0
		 */
		public function author_name() {
			global $post;

			$output = '<h3 class="jumbo">BY <a class="noborder" href="' . get_author_posts_url( $post->post_author ) . '">' . get_the_author_meta( 'display_name' ) . '</a></h3>';

			return $output;
		}


		/**
		 * Returns only the data for the author bio photo
		 * @return String
		 *
		 * @version  1.0
		 * @since    1.0
		 */
		public function author_photo() {
			global $post;

			$coauthor = array_shift( get_coauthors() );

			$output = '<a href="' . get_author_posts_url( $post->post_author ) . '">' . get_avatar( $coauthor->user_email, 200 ) . '</a>';

			return $output;
		}


		/**
		 * Returns only the data for the author website urls.
		 * @param  Object $author Allows us to pass through the $author object if we need to or else we'll load it ourselves.
		 * @return String
		 *
		 * @version 1.0
		 * @since   1.0
		 */
		public function author_urls( $urls ) {
			
			$output = '<ul class="links">';
				foreach ( $urls as $url ) {
					if ( strpos( $url->value, 'google' ) ) {
						$output .= '<li><a class="noborder" href="' . esc_url( $url->value . '?rel=author' ) . '">' . esc_html( $url->title ) . '</a></li>';
					} else {
						$output .= '<li><a class="noborder" href="' . esc_url( $url->value ) . '">' . esc_html( $url->title ) . '</a></li>';
					}
				}
			$output .= '</ul>';

			return $output;
		}


		/**
		 * Returns only the data for the authors social media websites.
		 * @param  Object $author Allows us to pass through the $author object if we need to or else we'll load it ourselves.
		 * @return String
		 *
		 * @version  1.0
		 * @since    1.0
		 */
		public function author_social( $accounts ) {
			
			$output = '<ul class="social">';
				foreach ( $accounts as $account ) {
					if ( strpos( $account->url, 'google' ) ) {
						$output .= '<li class="' . esc_attr( $account->shortname ) . '"><a class="noborder" href="' . esc_url( $account->url . '?rel=author' ) . '"><span class="sp">&nbsp;</span></a></li>';
					} else {
						$output .= '<li class="' . esc_attr( $account->shortname ) . '"><a class="noborder" href="' . esc_url( $account->url ) . '"><span class="sp">&nbsp;</span></a></li>';
					}
					
				}

				if ( isset( $author->emails[0]->value ) ) {
					$output .= '<a href="' . esc_attr( antispambot( "mailto:" . $author->emails[0]->value ) ) . '">' . antispambot( $author->emails[0]->value ) . '</a>';
				}
			$output .= '</ul>';

			$output .= '<div class="clearfix"></div>';

			return $output;
		}


		public function author_bio( $author ) {
			// Only load our author data if we aren't passing it already
			if ( empty( $author ) )
				$author = $this->make_get_author_data();

			$output = Markdown( $author->aboutMe );

			return $output;
		}
	}

	// Load our class into a handy dandy variable so we can use this in our helper function.
	$make_author_class = new Make_Authors;


	/**
	 * Helper function for returning all of our bio info stuff.
	 * @param  String $type   Insert the type of data you want returned
	 *         Accepted Para  full - DEFAULT
	 *         				  name
	 *         				  photo
	 *         				  bio
	 *         				  social
	 *         				  urls
	 * @return Mixed
	 *
	 * @version  1.0
	 * @since    1.0
	 */
	function make_author_bio( $type = 'full' ) {
		global $make_author_class;

		// Return the full HTML block
		if ( $type == 'full' )
			return $make_author_class->full_author_formatted();

		// Return the author name only
		if ( $type == 'name' )
			echo $make_author_class->author_name();

		// Return the author photo
		if ( $type == 'photo' )
			echo $make_author_class->author_photo();

		// Returns the author bio
		if ( $type == 'bio' )
			echo $make_author_class->author_bio();

		// Return the author website urls
		if ( $type == 'urls' )
			echo $make_author_class->author_urls();

		// Return the author social media buttons
		if ( $type == 'social' )
			echo $make_author_class->author_social();
	}

	function hook_bio_into_content( $content ) {
		global $post;
		if ( class_exists( 'WPCOM_Liveblog' ) ) {
			if( ! WPCOM_Liveblog::is_liveblog_post() && is_single() && is_main_query() && !in_array( get_post_type(),  array( 'page_2', 'projects' ) ) && $post->post_parent == 0  ) {
				$content .= make_author_bio();
			}
		} else {
			if( is_single() && is_main_query() && !in_array( get_post_type(),  array( 'page_2', 'projects' ) ) && $post->post_parent == 0  ) {
				$content .= make_author_bio();
			}
		}
		return $content;
	}

	add_filter( 'the_content', 'hook_bio_into_content', 5 );