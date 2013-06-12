<?php
/*
Template Name: Home Page
*/
?>

<?php get_header(); ?>

		<div class="waist">

			<div class="container">

				<div class="row">

					<div class="span8">

						<div class="checkers">

							<div class="row">

								<div class="span4">

									<div class="paddme">

										<div class="ribbon"><?php echo esc_html( make_get_cap_option( 'ribbon_title' ) ); ?></div>

										<a href="<?php echo esc_html( make_get_cap_option( 'main_link' ) ); ?>">

											<img src="<?php echo esc_url( make_get_cap_option( 'main_url' ) ); ?>" id="top-left" />

										</a>

										<div class="caption">

											<h3><a href="<?php echo esc_html( make_get_cap_option( 'main_link' ) ); ?>"><?php echo esc_html( make_get_cap_option( 'main_title' ) ); ?></a></h3>
											<p><a href="<?php echo esc_html( make_get_cap_option( 'main_link' ) ); ?>"><?php echo esc_html( make_get_cap_option( 'main_subtitle' ) ); ?></a></p>

										</div>

									</div>

								</div>

								<div class="span4">

									<div class="row">

										<div class="span4">

											<div class="paddme small">

												<a href="<?php echo esc_url( make_get_cap_option( 'top_link' ) ); ?>">
												
													<img class="home-biggest" src="<?php echo esc_url( make_get_cap_option( 'top_url' ) ); ?>" />

												</a>

												<div class="caption">

													<h3><a href="<?php echo esc_url( make_get_cap_option( 'top_link' ) ); ?>"><?php echo esc_html( make_get_cap_option( 'top_title' ) ); ?></a></h3>
													<p><a href="<?php echo esc_url( make_get_cap_option( 'top_link' ) ); ?>"><?php echo esc_html( make_get_cap_option( 'top_subtitle' ) ); ?></a></p>

												</div>

											</div>

										</div>

										<div class="span4">

											<div class="paddme small">

												<a href="<?php echo esc_url( make_get_cap_option( 'bottom_link' ) ); ?>">
													
													<img class="home-biggest" src="<?php echo esc_url( make_get_cap_option( 'bottom_url' ) ); ?>" />

												</a>

												<div class="caption">

													<h3><a href="<?php echo esc_url( make_get_cap_option( 'bottom_link' ) ); ?>"><?php echo esc_html( make_get_cap_option( 'bottom_title' ) ); ?></a></h3>
													<p><a href="<?php echo esc_url( make_get_cap_option( 'bottom_link' ) ); ?>"><?php echo esc_html( make_get_cap_option( 'bottom_subtitle' ) ); ?></a></p>

												</div>


											</div>

										</div>

									</div>

								</div>
								
								<div class="row-fluid">
									
									<div class="span12">
									
										<div class="featured">
											
											<?php echo make_featured_post(); ?>	
											
										</div>
										
									</div>
									
								</div>

							</div>

						</div>
						
					</div>

					<div class="span4">

						<div class="home-ads">

							<!-- Beginning Sync AdSlot 1 for Ad unit header ### size: [[300,250]]  -->
							<div id='div-gpt-ad-664089004995786621-2'>
								<script type='text/javascript'>
									googletag.display('div-gpt-ad-664089004995786621-2');
								</script>
							</div>
							<!-- End AdSlot 1 -->

						</div>

						<div class="home-ads bottom">

							<!-- Beginning Sync AdSlot 1 for Ad unit header ### size: [[300,250]]  -->
							<div id='div-gpt-ad-664089004995786621-3'>
								<script type='text/javascript'>
									googletag.display('div-gpt-ad-664089004995786621-3');
								</script>
							</div>
							<!-- End AdSlot 1 -->

						</div>

					</div>

				</div>

			</div>

		</div>

		<div class="sand new-sand">

			<div class="container">

				<div class="row sub-banner">

					<div class="span12">

						<a href="https://readerservices.makezine.com/mk/subscribe.aspx?PC=MK&PK=M36BN09">
							<img src="<?php bloginfo('stylesheet_directory'); ?>/img/Belt-2995-PDF.jpg" alt="Subscribe to MAKE magazine" />
						</a>

					</div>

				</div>

				<div class="row">

					<div class="span12">

						<?php
							$cap_livestream = make_get_cap_option( 'livestream' );
							if ( $cap_livestream ) {
								echo '<div class="big-livestream">';
								echo do_shortcode('[gigya src="'.wp_kses_post( $cap_livestream ).'" width="940" height="529" quality="high" wmode="transparent" allowFullScreen="true" ]');
								echo '</div>';
							}; ?>

						</div>

					</div>

				<div class="row">

					<div class="span4 posts">

						<h3><a href="http://blog.makezine.com">Blog Feed</a></h3>	

						<?php 
							$args = array(
								'posts_per_page'  => 6,
								'no_found_rows' => true,
							);

							$the_query = new WP_Query( $args );
						?>

						<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
	
						<article <?php post_class(); ?>>
							
							<div class="entry-content">

								<a href="<?php the_permalink(); ?>">
									<?php get_the_image( array( 'image_scan' => true, 'size' => 'left-rail-home-thumb' ) ); ?>
								</a>

								<h4>
									<a href="<?php the_permalink(); ?>">
										<span class="arrows">&raquo;</span> <?php the_title(); ?>
										<span class="blurb">
											<?php echo wp_trim_words(strip_shortcodes( get_the_excerpt() ), 20, '...') ; ?>
										</span>
									</a>
								</h4>
							
							</div>
						
						</article>

						<?php endwhile; wp_reset_postdata(); ?>

						<p><a href="http://blog.makezine.com/"><span class="pull-right light aqua seeall right">See All Posts</span></a></p>

					</div>
					<!--<div class="shadow"></div>-->

					<div class="span8">

						<h3 class="red"><?php echo esc_html( make_get_cap_option( 'feature_heading' ) ); ?></h3>

						<div class="new-grid">

							<?php
							$cap_youtube = make_get_cap_option( 'youtube' );
							if ( $cap_youtube ) {
								echo '<div class="small-youtube">';
								echo do_shortcode('[youtube='. wp_kses_post( $cap_youtube ) .'&w=590&h=332]');
								echo '</div>';
							}; 
							?>

							<div class="clear"></div>
							
						</div>

						<div class="clear"></div>

						<div class="row">

							<div class="span4">

								<h3><a class="red" href="http://blog.makezine.com/tag/diy-projects/">New Projects</a></h3>

								<div class="grid-box boxy">

									<?php

										$args = array(
											'tag__in' => 70890180,
											'posts_per_page'  => 1,
											'no_found_rows' => true,
										);
										
										$proj_query = new WP_Query( $args );

										while ( $proj_query->have_posts() ) : $proj_query->the_post();
											echo '<a href="'.get_permalink().'">';
											the_post_thumbnail('small-home-feature-boxes');
											echo '<h4>' . wp_trim_words((get_the_title()),8) . '</h4>';
											echo '<p>'.wp_trim_words( strip_shortcodes( get_the_excerpt() ), 12 ).'</p>';
											echo '</a>';
										endwhile;

										// Reset Post Data
										wp_reset_postdata();

									?>

								</div>

							</div>


							<div class="span4">

								<div class="new-dotw">

									<?php
										
										$the_query = new WP_Query( 'post_type=from-the-maker-shed&posts_per_page=1' );

										while ( $the_query->have_posts() ) : $the_query->the_post();
											$ftms_link = get_post_custom_values( 'ftms_link' );
											if( !isset($ftms_link[0]) ){
												$ftms_link[0] = 'http://www.makershed.com/';
											}
											echo '<a href="'. esc_url( $ftms_link[0] ).'">';
											the_post_thumbnail('ftms-thumb');
											echo '</a>';
										endwhile;

										// Reset Post Data
										wp_reset_postdata();

									?>

								</div>

							</div>

						</div>

						<div class="row">

							<div class="span4">

								<h3 class="red"><a href="http://blog.makezine.com/?cat=296748" class="red">Meet the Makers</a></h3>

								<div class="grid-box boxy">

									<?php
										
										$args = array(
											'tag__in' => 296748,
											'tag__not_in' => array( 92075710, 22815 ),
											'posts_per_page'  => 1,
											'no_found_rows' => true,
										);
										

										$the_query = new WP_Query( $args );

										while ( $the_query->have_posts() ) : $the_query->the_post();
											echo '<a href="'.get_permalink().'">';
											the_post_thumbnail('small-home-feature-boxes');
											echo '<h4>' . wp_trim_words((get_the_title()),8) . '</h4>';
											echo '<p>'.wp_trim_words( strip_shortcodes( get_the_excerpt() ), 12 ).'</p>';
											echo '</a>';
										endwhile;

										// Reset Post Data
										wp_reset_postdata();

									?>

								</div>

							</div>


							<div class="span4">

								<h3 class="red"><a href="http://blog.makezine.com/tag/maker-faire/" class="red">Maker Faire News</a></h3>

								<div class="grid-box boxy">

									<?php
										
										$args = array(
											'tag_id' => 785128,
											'posts_per_page'  => 1,
											'no_found_rows' => true,
											'tag__not_in' => 22815
										);
										
										$the_query = new WP_Query( $args );

										while ( $the_query->have_posts() ) : $the_query->the_post();
											echo '<a href="'.get_permalink().'">';
											the_post_thumbnail('small-home-feature-boxes');
											echo '<h4>' . wp_trim_words((get_the_title()),8) . '</h4>';
											echo '<p>'.wp_trim_words( strip_shortcodes( get_the_excerpt() ), 12 ).'</p>';
											echo '</a>';
										endwhile;

										// Reset Post Data
										wp_reset_postdata();

									?>

								</div>

							</div>

						</div>

						<div class="row">

							<div class="span4">

								<h3 class="red"><a href="http://blog.makezine.com/tag/component-of-the-month/" class="red">Skill Builder</a></h3>

								<div class="grid-box boxy">

									<?php
										
										$args = array(
											'tag_id' => 115565268,
											'posts_per_page'  => 1,
											'no_found_rows' => true,
										);

										$the_query = new WP_Query( $args );

										while ( $the_query->have_posts() ) : $the_query->the_post();
											echo '<a href="'.get_permalink().'">';
											the_post_thumbnail('small-home-feature-boxes');
											echo '<h4>' . wp_trim_words((get_the_title()),8) . '</h4>';
											echo '<p>'.wp_trim_words( strip_shortcodes( get_the_excerpt() ), 12 ).'</p>';
											echo '</a>';
										endwhile;

										// Reset Post Data
										wp_reset_postdata();

									?>

								</div>

							</div>


							<div class="span4">

								<h3 class="red"><a href="http://blog.makezine.com/page-2/" class="red">Make: Page 2</a></h3>

								<div class="grid-box boxy">

									<?php
										
										$the_query = new WP_Query( 'post_type=page_2&posts_per_page=1' );

										while ( $the_query->have_posts() ) : $the_query->the_post();
											echo '<a href="'.get_permalink().'">';
											the_post_thumbnail('small-home-feature-boxes');
											echo '<h4>' . wp_trim_words((get_the_title()),8) . '</h4>';
											echo '<p>'.wp_trim_words( strip_shortcodes( get_the_excerpt() ), 12 ).'</p>';
											echo '</a>';
										endwhile;

										// Reset Post Data
										wp_reset_postdata();

									?>

								</div>

							</div>

						</div>
						
						<div id="myCarousel" class="carousel slide">
							<ol class="carousel-indicators">
								<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
								<li data-target="#myCarousel" data-slide-to="1"></li>
							</ol>
							<div class="carousel-inner">
								<div class="item active">
									<a href="https://plus.google.com/communities/105413589856236995389">
										<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/Make_Forum_join_banner.jpg" alt="Join the +MAKE Forum">
									</a>
								</div>
								<div class="item">
									<a href="<?php bloginfo( 'url' ); ?>/contribute/">
										<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/Contribute-Page2_620x174.jpg" alt="Contribute to MAKE">
									</a>
								</div>
							</div>
							<a class="pull-left badge" href="#myCarousel" data-slide="prev">&larr;</a>
							<a class="pull-right badge" href="#myCarousel" data-slide="next">&rarr;</a>
						</div>
						<script type="text/javascript">
							jQuery(document).ready(function(){
								jQuery('#myCarousel').carousel({
									interval: false
								})
							});
							jQuery('#myCarousel').on('slid', function () {
								return true;
							});
						</script>
					</div>

				</div>

		<?php get_footer(); ?>