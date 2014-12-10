<?php

/*
Template Name: Home Page
*/
?>

<?php get_header(); ?>

		<?php if ( make_get_cap_option( 'make_camp_takeover' ) ) : ?>

			<?php get_template_part( 'maker-camp-takover' ); ?>

		<?php elseif ( make_get_cap_option( 'maker_week' ) ) : ?>

			<?php get_template_part( 'maker-week' ); ?>

		<?php elseif ( make_get_cap_option( 'weekly_takeover_enabled' ) ) : ?>

			<?php get_template_part( 'weekly-take-over' ); ?>

		<?php elseif ( get_theme_mod( 'make_enable_takeover' ) === 'on' ) : ?>

			<?php get_template_part( 'home-takeover' ); ?>

		<?php elseif ( get_theme_mod( 'make_enable_canvas' ) === 'on' ) : ?>

			<?php get_template_part( 'home-canvas' ); ?>

		<?php elseif ( get_theme_mod( 'make_enable_banner' ) === 'on' ) : ?>

			<?php get_template_part( 'home-banner' ); ?>

		<?php elseif ( get_theme_mod( 'make_enable_video_banner' ) === 'on' ) : ?>

			<?php get_template_part( 'home-banner-video' ); ?>

		<?php elseif ( get_theme_mod( 'make_faire_banner' ) === 'on' ) : ?>

			<?php get_template_part( 'home-faire' ); ?>

		<?php else : ?>

			<?php get_template_part( 'home-header-nomal' ); ?>

		<?php endif; ?>

		<div class="sand new-sand">

			<div class="container">

				<div class="row">

					<div class="span12">

						<?php
							$cap_livestream = make_get_cap_option( 'livestream' );
							if ( $cap_livestream ) {
								echo '<div class="big-livestream">';
								echo do_shortcode('[gigya src="' . esc_url( ( $cap_livestream ) ) . '" width="940" height="529" quality="high" wmode="transparent" allowFullScreen="true" ]');
								echo '</div>';
							}; ?>

						</div>

					</div>

				<div class="row">

					<div class="span4 posts">

						<h2 class="look_like_h3_blue"><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">Maker News</a></h2>

						<?php
							$args = array(
								'posts_per_page'  => 6,
								'no_found_rows' => true,
								'post_type' => array( 'post', 'projects', 'review', 'video', 'magazine' ),
								'tag__not_in' => array( 5183, 22815, 9947 ),
							);

							$the_query = new WP_Query( $args );

							$post_array = array();
							foreach ( $the_query->posts as $post ) {
								$post_array[] = $post->ID;
							}
						?>

						<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

						<article <?php post_class(); ?>>

							<div class="entry-content">

								<a href="<?php the_permalink(); ?>">
									<?php get_the_image( array( 'image_scan' => true, 'size' => 'left-rail-home-thumb' ) ); ?>
								</a>

								<a href="<?php the_permalink(); ?>">
									<span class="arrows">&raquo;</span> <h3 class="look_like_h4"><?php the_title(); ?></h3>
									<span class="blurb">
										<?php echo wp_trim_words(strip_shortcodes( get_the_excerpt() ), 20, '...') ; ?>
									</span>
								</a>

							</div>

						</article>

						<?php endwhile; wp_reset_postdata(); ?>

						<p><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>"><span class="pull-right aqua seeall right">See All Posts</span></a></p>

					</div>
					<!--<div class="shadow"></div>-->

					<div class="span8">

						<?php
							$feature_url = make_get_cap_option( 'feature_url' );
							if ( ! empty( $feature_url ) && absint( $feature_url ) ) : // Add a URL by post ID ?>
								<h3><a href="<?php echo get_permalink( absint( $feature_url ) ); ?>" class="red"><?php echo esc_html( make_get_cap_option( 'feature_heading' ) ); ?></a></h3>
							<?php elseif ( ! empty( $feature_url ) && filter_var( $feature_url, FILTER_VALIDATE_URL ) ) : // Add a URL to remote areas. Must be a valid URL ?>
								<h3 class="red"><a href="<?php echo esc_url( $feature_url ); ?>" class="red"><?php echo esc_html( make_get_cap_option( 'feature_heading' ) ); ?></a></h3>
							<?php else : ?>
								<h3 class="red"><?php echo esc_html( make_get_cap_option( 'feature_heading' ) ); ?></h3>
							<?php endif; ?>

						<div class="new-grid">

							<?php
							$cap_youtube = make_get_cap_option( 'youtube' );
							if ( is_numeric( $cap_youtube ) ) {
								$youtube = get_post_meta( $cap_youtube, 'Link', true );
								echo '<div class="small-youtube">';
								echo do_shortcode('[youtube='. esc_url( $youtube ) .'&amp;w=590&amp;h=332]');
								echo '</div>';
							} elseif ( $cap_youtube ) {
								echo '<div class="small-youtube">';
								echo do_shortcode('[youtube='. esc_url( $cap_youtube ) .'&amp;w=590&amp;h=332]');
								echo '</div>';
							};
							?>

							<div class="clear"></div>

						</div>

						<div class="clear"></div>

						<?php
							if ( get_theme_mod( 'make_faire_banner' ) === 'on' )
								get_template_part( 'home-faire-instagram' );
						?>

						<div class="row">

							<div class="span4">

								<h2 class="look_like_h3"><a class="red" href="<?php echo esc_url( home_url( '/projects/' ) ); ?>">New Projects</a></h2>

								<div class="grid-box boxy">

									<?php

										$args = array(
											// 'tag__in' => 70890180,
											'posts_per_page'  => 1,
											'no_found_rows' => true,
											'post_type' => 'projects',
											'tag__not_in' => '22815',
											'post__not_in'	=> $post_array,
										);

										echo make_post_card( $args );

									?>

								</div>

							</div>


							<div class="span4">

								<div class="new-dotw">
									<div id="div-gpt-ad-664089004995786621-9" class="text-center">
										 <script type='text/javascript'>
										  googletag.cmd.push(function(){googletag.display('div-gpt-ad-664089004995786621-9')});
										 </script>
									</div>
								</div>

							</div>

						</div>

						<div class="row">

							<div class="span4">

								<h2 class="look_like_h3"><a href="<?php echo esc_url( home_url( '/category/makers/' ) ); ?>" class="red">Meet the Makers</a></h2>

								<div class="grid-box boxy">

									<?php

										$args = array(
											'category_name' => 'Makers',
											'tag__not_in' => array( 92075710, 22815 ),
											'posts_per_page'  => 1,
											'no_found_rows' => true,
											'post_type' => array( 'post', 'projects', 'review', 'video', 'magazine' ),
											'post__not_in'	=> $post_array,
										);


										echo make_post_card( $args );

									?>

								</div>

							</div>


							<div class="span4">

								<h2 class="look_like_h3"><a href="<?php echo esc_url( home_url( '/tag/maker-faire/' ) ); ?>" class="red">Maker Faire News</a></h2>

								<div class="grid-box boxy">

									<?php

										$args = array(
											'tag_id' => 785128,
 											'posts_per_page'  => 1,
 											'no_found_rows' => true,
 											'post__not_in'	=> $post_array,
 										);

										echo make_post_card( $args );
									?>

								</div>

							</div>

						</div>

						<div class="row">

							<div class="span4">

								<h2 class="look_like_h3"><a href="<?php echo esc_url( home_url( '/tag/component-of-the-month/' ) ); ?>" class="red">Skill Builder</a></h2>

								<div class="grid-box boxy">

									<?php

										$args = array(
											'tag_id' => 115565268,
											'posts_per_page'  => 1,
											'no_found_rows' => true,
											'post_type' => array( 'post', 'projects', 'review', 'video', 'magazine' ),
											'post__not_in'	=> $post_array,
										);

										echo make_post_card( $args );

									?>

								</div>

							</div>


							<div class="span4">


								<h2 class="look_like_h3"><a href="http://pubads.g.doubleclick.net/gampad/clk?id=112551178&iu=/11548178/Makezine" class="red">Weekend Projects</a></h2>

								<div class="grid-box boxy weekend-projects-home">

									<?php

										$args = array(
											'weekend-projects'	=> true,
											'post_type' 		=> 'projects',
 											'posts_per_page'	=> 1,
 											'post__not_in'		=> $post_array,
 											'tax_query' 		=> array(
													array(
														'taxonomy'	=> 'flags',
														'field'		=> 'slug',
														'terms'		=> 'weekend-project'
													)
												)
 										);

										echo make_post_card( $args );

									?>

								</div>

							</div>

						</div>
					
					</div>

				</div>

		<?php get_footer(); ?>
