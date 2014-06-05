<?php

	/**
	 * The function to display author/maker bios
	 *
	 * @version  1.2
	 * @author  Cole Geissinger <cgeissinger@makermedia.com>
	 *
	 */


	class Make_Authors {

		/**
		 * Get our authors information via Gravatar
		 * @return Object
		 *
		 * @version  1.1
		 * @since    1.0
		 */
		public function get_author_data() {
			global $authordata;

			// Get the true author data
			$author = $authordata;

			if ( ! empty( $author ) ) {
				// If the user account is a guest-author, then it will always be used over Gravatar data
				if ( $author->type === 'guest-author' ) { // Author account is linked, so we'll make sure we ignor Gravatar and pull from the guest author account
					return $author;
				} else { // If no type is passed, then we'll check for Gravatar information
					$email = $author->data->user_email;

					// We need to hash out the email so we can properlly and securely request the right Gravatar account
					$hash = md5( strtolower( trim( sanitize_email( $email ) ) ) );

					// Request the data from gravatar
					$gdata = wpcom_vip_file_get_contents( esc_url( 'http://www.gravatar.com/' . $hash . '.json' ) );

					// Make sure data was actually returned
					if ( $gdata ) {
						$profile = json_decode( $gdata );

						return $profile->entry[0];
					} else {
						// well, it seems Gravatar returned empty... let's pull from WordPress then.
						$author = get_userdata( absint( $author->ID ) );

						return $author;
					}
				}
			} else {
				return false;
			}
		}


		/**
		 * Generates the HTML output of the author profile header
		 * @return html
		 *
		 * @version 1.0
		 * @since   1.1
		 */
		public function author_profile() {
			$author = $this->get_author_data();

			if ( $author ) : ?>
				<div class="span4">
					<?php echo $this->author_avatar( $author ); ?>
				</div>
				<div class="span8 author-profile-bio">
					<h1 class="jumbo"><?php echo esc_html( $this->author_name( $author ) ); ?></h1>
					<?php echo $this->author_bio( $author ); ?>
					<?php echo $this->author_contact_info( $author ); ?>
					<?php echo $this->author_urls( $author ); ?>
				</div>
			<?php else : ?>
				<div class="span12 author-profile-bio">
					<h1 class="jumbo">Author profile could not be found!</h1>
				</div>
			<?php endif; ?>
		<?php }

		/**
		 * Generates the HTML output of the author profile header
		 * @return html
		 *
		 * @version 1.1
		 * @since   1.1
		 */
		public function author_block( $author ) {
			// Let's get this going...
			$output = '<div class="row-fluid">';
			$output .= '<div class="span3">';
				// Grab the image.
				$output .= $this->author_avatar( $author, 198 );
			$output .= '</div>';
			$output .= '<div class="span9 -author-profile-bio">';
				// Author name
				$output .= '<h3 class="jumbo"><a href="' . esc_url( home_url( 'author/' . $author->user_nicename ) ) . '">' . esc_html( $this->author_name( $author ) ) . '</a></h3>';

				if ( $author->type != 'guest-author' ) {
					// Grab the meta information for WordPress.com users
					$author_meta = wpcom_vip_get_user_profile( $author->ID );

					$output .= $this->author_bio( $author_meta );
					$output .= $this->author_contact_info( $author_meta );
					$output .= $this->author_urls( $author_meta );
				} elseif ( $author->type == 'guest-author' ) {
					// Return the Guest Author information.
					$output .= $this->author_bio( $author );
					$output .= $this->author_contact_info( $author );
					$output .= $this->author_urls( $author );
				}

				$output .= '</div>';
			$output .= '</div>';
			$output .= '<hr>';
			return $output;
		}

		/**
		 * Returns the profile photo of the author
		 * @param  object $author The author object
		 * @return string
		 *
		 * @version  1.1
		 * @since    1.0
		 */
		public function author_avatar( $author, $size = 298 ) {
			$output = '';

			// If we have a Gravatar object, we'll process that, other wise, we need to hook into WordPress
			if ( isset( $author->thumbnailUrl ) ) {

				$url = $author->thumbnailUrl . '?s=' . absint( $size ) . '&d=retro';

				$output = '<img src="' . esc_url( $url ) . '" alt="' . esc_attr( $this->author_name( $author ) ) . '" class="avatar avatar-absint( $size )" width="absint( $size )" height="absint( $size )">';

			} else {
				// Use the featued image if its set, other wise fall to get_avatar which will check for another solution with a fall back to default retro image
				if ( has_post_thumbnail( absint( $author->ID ) ) ) {
					$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $author->ID ) );

					$output = '<img src="' . wpcom_vip_get_resized_remote_image_url( $image_url[0], absint( $size ), absint( $size ) ) . '" alt="' . esc_attr( $this->author_name( $author ) ) . '" width="absint( $size )" height="absint( $size )" class="avatar avatar-absint( $size )">';
					// $output = get_the_post_thumbnail( absint( $author->ID ), array( absint( $size ), absint( $size ) ), array( 'alt' => esc_attr( $this->author_name( $author ) ), 'class' => 'avatar avatar-absint( $size )' ) );
				} else {
					$output = get_avatar( sanitize_email( $author->user_email ), absint( $size ), 'retro', esc_attr( $this->author_name( $author ) ) );
				}
			}

			return $output;
		}


		/**
		 * Returns only the data for the author name
		 * @param  object $author The author object
		 * @return string
		 *
		 * @version  1.1
		 * @since    1.0
		 */
		public function author_name( $author ) {
			$output = '';

			if ( empty( $author ) )
				$author = $this->get_author_data();

			// Get the Display name from Gravatar or from Guest Authors...
			if ( isset( $author->displayName ) ) {
				$output = esc_html( $author->displayName );
			} else {
				$output = esc_html( $author->display_name );
			}

			return $output;
		}


		/**
		 * Returns the author bio. We can either pass the bio info back in its raw form or return it with auto formatting
		 * @param  object $author The author object
		 * @param  bool   $raw    Allows us to return the bio in its raw format
		 * @return string
		 *
		 * @version 1.1
		 * @since   1.0
		 */
		public function author_bio( $author, $raw = false ) {
			$output = '';

			if ( empty( $author ) )
				$author = $this->get_author_data();

			// Get the Gravatar bio or return the Guest Author bio
			if ( isset( $author->aboutMe ) ) {
				$output = $author->aboutMe;
			} elseif ( is_array( $author ) && isset( $author['aboutMe'] ) ) {
				$output = $author['aboutMe'];
			} elseif ( is_array( $author ) && isset( $author['description'] ) ) {
				$output = $author['description'];
			} else {
				$output = $author->description;
			}

			// Return the bio with formatting or else return it as it is
			if ( ! $raw && ! empty( $output ) ) {
				return Markdown( $output );
			} else {
				return $output;
			}
		}


		/**
		 * Returns the author social media accounts
		 * @param  object $author The author object
		 * @return string
		 *
		 * @version  1.1
		 * @since    1.0
		 */
		public function author_contact_info( $author ) {

			// Currently Guest Authors does not provide social media links so we'll only pull if Gravatar object is present
			if ( isset( $author->accounts ) ) {
				$output = '<ul class="social clearfix">';

					// Add social media accounts
					foreach ( $author->accounts as $account ) {
						// Update the Google URL so we can do some Author appeneding magic stuff?
						if ( $account->shortname === 'google' ) {
							$output .= '<li class="' . esc_attr( $account->shortname ) . '"><a class="noborder" href="' . esc_url( $account->url . '?rel=author' ) . '"><span class="sp">&nbsp;</span></a></li>';
						} else {
							$output .= '<li class="' . esc_attr( $account->shortname ) . '"><a class="noborder" href="' . esc_url( $account->url ) . '"><span class="sp">&nbsp;</span></a></li>';
						}
					}

					// Add the email if they got it
					if ( isset( $author->emails ) ) {
						foreach ( $author->emails as $email ) {
							$output .= '<li style="background:transparent;position:relative;top:-2px;"><a href="' . esc_attr( antispambot( "mailto:" . $email->value ) ) . '">' . antispambot( $email->value ) . '</a></li>';
						}
					}

				$output .= '</ul>';

				return $output;
			} elseif ( is_array( $author ) && isset( $author['accounts'] ) ) {
				$output = '<ul class="social clearfix">';

					// Add social media accounts
					foreach ( $author['accounts'] as $account ) {
						// Update the Google URL so we can do some Author appeneding magic stuff?
						if ( $account['shortname'] === 'google' ) {
							$output .= '<li class="' . esc_attr( $account['shortname'] ) . '"><a class="noborder" href="' . esc_url( $account['url'] . '?rel=author' ) . '"><span class="sp">&nbsp;</span></a></li>';
						} else {
							$output .= '<li class="' . esc_attr( $account['shortname'] ) . '"><a class="noborder" href="' . esc_url( $account['url'] ) . '"><span class="sp">&nbsp;</span></a></li>';
						}
					}

					// Add the email if they got it
					if ( isset( $author['emails'] ) ) {
						foreach ( $author['emails'] as $email ) {
							$output .= '<li style="background:transparent;position:relative;top:-2px;"><a href="' . esc_attr( antispambot( "mailto:" . $email['value'] ) ) . '">' . antispambot( $email['value'] ) . '</a></li>';
						}
					}

				$output .= '</ul>';

				return $output;
			}
		}


		/**
		 * Returns the author website link
		 * @param  object $author The author object
		 * @return string
		 *
		 * @version 1.1
		 * @since   1.0
		 */
		public function author_urls( $author ) {

			// Load this if we have either a list of links from Gravatar or a single website from Guest Authors
			if ( isset( $author->urls ) || isset( $author->website ) ) {

				// Update our URLs into a one variable so we have less code. First is Gravatar, second is Guest Authors which only allows one option.
				if ( isset( $author->urls ) ) {
					$urls = $author->urls;
				} else {
					$urls = array( (object) array( 'title' => 'Website', 'value' => $author->website ) );
				}

				$output = '<ul class="links">';

					foreach ( $urls as $url ) {
						if ( ! empty( $url->value ) ) {
							$output .= '<li><a class="noborder button red small-button" href="' . esc_url( $url->value ) . '">' . esc_html( $url->title ) . '</a></li>';
						}

					}

				$output .= '</ul>';

				return $output;
			}

			// So, might come over as an array instead of an object...
			if ( isset( $author['urls'] ) ) {

				$output = '<ul class="links">';

				foreach ( $author['urls'] as $url ) {
					$output .= '<li><a class="noborder" href="' . esc_url( $url['value'] ) . '">' . esc_html( $url['title'] ) . '</a></li>';
				}

				$output .= '</ul>';

				return $output;
			}
		}


		/**
		 * Returns the author email.
		 * For now we will not return emails set in guest authors for privacy reasons. Gravatar will only send them if they are set to public.
		 * @param  object $author The author object
		 * @return string
		 *
		 * @version 1.0
		 * @since   1.1
		 */
		public function author_email( $author ) {

			$output = '';

			if ( isset( $author->emails ) ) {
				foreach ( $author->emails as $email ) {
					$output .= '<a href="' . esc_attr( antispambot( "mailto:" . $email->value ) ) . '">' . antispambot( $email->value ) . '</a>';
				}
			}

			return $output;
		}
	}

	// Load our class into a handy dandy variable so we can use this in our helper functions.
	$make_author_class = new Make_Authors;


	/**
	 * Helper function to display the HTML output of the top area of the author profile
	 * @return html
	 *
	 * @version 1.0
	 * @since   1.1
	 */
	function make_author_profile() {
		global $make_author_class;

		echo $make_author_class->author_profile();
	}


	function make_author_name( $author = '' ) {
		global $make_author_class;

		return $make_author_class->author_name( $author );
	}


	function make_author_avatar() {
		global $make_author_class;

		return $make_author_class->author_photo();
	}

	function make_author_bio( $author = '' ) {
		global $make_author_class;

		return $make_author_class->author_bio( $author );
	}

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
	function make_author( $type = 'full' ) {
		global $make_author_class;

		// Get the authors.
		$authors = get_coauthors();

		$output = '';

		// For each author, build a block.
		foreach ($authors as $author ) {
			$output .= $make_author_class->author_block( $author );
		}

		// Send it out to the page.
		return $output;
	}


	/**
	 * Fixes guest authors with no posts to actually load their profile instead of returning 404
	 * As per http://wordpress.org/support/topic/advice-for-showing-author-profile-page-for-authors-without-posts
	 * @return void
	 */
	function capx_template_redirect() {
		global $wp_query;

		if ( false !== stripos( $_SERVER['REQUEST_URI'], '/author' ) && empty( $wp_query->posts ) ) {
			$wp_query->is_404 = false;
			get_template_part( 'author' );
			exit;
		}
	}
	add_action( 'template_redirect', 'capx_template_redirect' );


	function hook_bio_into_content( $content ) {
		global $post;

		if ( class_exists( 'WPCOM_Liveblog' ) ) {
			// There was a check for a post parent to == 0, I pulled that off. --JS
			if( ! WPCOM_Liveblog::is_liveblog_post() && is_single() && is_main_query() && !in_array( get_post_type(),  array( 'page_2', 'projects' ) ) ) {
				$content .= make_author();
			}
		} else {
			// There was a check for a post parent to == 0, I pulled that off. --JS
			if( is_single() && is_main_query() && !in_array( get_post_type(),  array( 'page_2', 'projects' ) ) ) {
				$content .= make_author();
			}
		}
		return $content;
	}

	// For now we will stop displaying author blocks at the end of posts until we can fix it next week.
	add_filter( 'the_content', 'hook_bio_into_content', 5 );