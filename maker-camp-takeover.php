<div class="waist-takeover">

	<div class="container">

		<div class="row">

			<div class="span8">

				<?php
					$cap_youtube = make_get_cap_option( 'camp_youtube' );
					if ( $cap_youtube ) {
						echo do_shortcode('[youtube='. esc_url( $cap_youtube .'&amp;w=620' ) . ']');
					};
				?>

				<div class="thumb">

					<div>

						<?php 
							if( make_get_cap_option( 'make_camp_takeover_heading' ) )
								echo  '<h3>' . wp_kses_post( make_get_cap_option( 'make_camp_takeover_heading' ) ) . '</h3>';
							if( make_get_cap_option( 'make_camp_takeover_content' ) ) 
								echo Markdown( wp_kses_post( make_get_cap_option( 'make_camp_takeover_content' ) ) );
						?>

					</div>

				</div>

			</div>

			<?php 
				$featuredposts = make_get_cap_option( 'make_camp_takeover_posts' );
				$posts = array_map( 'get_post', explode( ',', $featuredposts ) );
				$output = '<div class="span4">';
				foreach ( $posts as $post ) {
					$output .= '<div class="thumb">';
					$output .= '<a href="' . get_permalink() . '">';
					$output .= get_the_image( array( 'image_scan' => true, 'size' => 'category-thumb', 'image_class' => 'hide-thumbnail', 'echo' => false ) );
					$output .= '</a>';
					$output .= '<div class="">';
					$output .= '<h4><a href="' . get_permalink() . '">' . get_the_title() . '</a></h4>';
					$output .= Markdown( wp_trim_words( get_the_excerpt(), 13, '...' ) );
					$output .= '</div></div>';
				}
				$output .= '</div>';
				echo $output;
			?>

		</div>
		
		

	</div>

</div>

