<?php

	/**
	 * The function to display author/maker bios
	 *
	 * @version  1.1
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
			// Fetch coauthors plug data
			$authors = get_coauthors();
			
			// Also get the author ID as a fallback
			$author_id = get_the_author_id();

			var_dump($author_id);

			// Check if any authors were returned
			if ( ! empty( $authors ) ) {
				$author = $authors[0];
			} elseif ( ! empty( $author_id ) && $author_id !== 0 ) {
				// If coauthors plus couldn't return an author, we'll try and manually get it
				$author = get_userdata( absint( $author_id ) );

				// Last check... if $author is empty at this point, then we have a linked account
				if ( empty( $author ) ) {
					$authors = get_coauthors( $author_id );
					$author = $authors[0];
				}
			}
			
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
					$author = get_userdata( absint( $author_id ) );
					
					return $author;
				}
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
			$author = $this->get_author_data(); ?>
			<div class="span4">
				<?php echo $this->author_avatar( $author ); ?>
			</div>
			<div class="span8">
				<h1 class="jumbo"><?php echo esc_html( $this->author_name( $author ) ); ?></h1>
				<?php echo $this->author_bio( $author ); ?>
				<?php echo $this->author_contact_info( $author ); ?>
				<?php echo $this->author_urls( $author ); ?>
			</div>
		<?php }


		/**
		 * Returns the profile photo of the author
		 * @param  object $author The author object
		 * @return string
		 *
		 * @version  1.1
		 * @since    1.0
		 */
		public function author_avatar( $author ) {
			$output = '';

			// If we have a Gravatar object, we'll process that, other wise, we need to hook into WordPress
			if ( isset( $author->thumbnailUrl ) ) {
				
				$url = $author->thumbnailUrl . '?s=298&d=retro';

				$output = '<img src="' . esc_url( $url ) . '" alt="' . esc_attr( $this->author_name( $author ) ) . '" class="avatar avatar-298" width="298" height="298">';

			} else {
				// Use the featued image if its set, other wise fall to get_avatar which will check for another solution with a fall back to default retro image
				if ( has_post_thumbnail( absint( $author->ID ) ) ) {
					$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $author->ID ) );

					$output = '<img src="' . wpcom_vip_get_resized_remote_image_url( $image_url[0], 298, 298 ) . '" alt="' . esc_attr( $this->author_name( $author ) ) . '" width="298" height="298" class="avatar avatar-298">';
					// $output = get_the_post_thumbnail( absint( $author->ID ), array( 298, 298 ), array( 'alt' => esc_attr( $this->author_name( $author ) ), 'class' => 'avatar avatar-298' ) );
				} else {
					$output = get_avatar( sanitize_email( $author->user_email ), 298, 'retro', esc_attr( $this->author_name( $author ) ) );
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
					$urls = array( (object) array( 'title' => 'website', 'value' => $author->website ) );
				}

				$output = '<ul class="links">';

					foreach ( $urls as $url ) {
						$output .= '<li><a class="noborder" href="' . esc_url( $url->value ) . '">' . esc_html( $url->title ) . '</a></li>';
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

		return $make_author_class->full_author_formatted();
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