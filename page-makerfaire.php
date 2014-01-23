<?php
/**
 * Template Name: Maker Faire Landing Page
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Cole Geissinger <cgeissinger@makermedia.com>
 * 
 */
get_header(); ?>
		
	<div class="makerfaire-lp flags">
	
		<div class="container">
									
			<div class="row">
			
				<div class="span12 mf-top">
				
					<article <?php post_class(); ?>>
						
						<div class="row-fluid">
							<div class="span4"><a href="http://makerfaire.com" target="_blank"><img src="http://makezineblog.files.wordpress.com/2013/09/maker-faire-logo.png" ></a></div>
							<div class="span8 top-header">
								<div class="pull-right"><img src="http://s2.wp.com/wp-content/themes/vip/makerfaire/images/mr-makey.png" style="height:69px;"></div>
								<h3>A family-friendly festival of invention,<br />creativity, resourcefulness, and the maker movement</h3>
							</div>
						</div>
						<div class="row-fluid">
							<div class="span8 main-content">
								<div class="slideshow-wrapper">
									<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
										<?php the_content(); ?>
									<?php endwhile; endif; ?>
									<?php
										$args = array(
											'post_type' => array( 'post', 'projects', 'video', 'magazine', 'craft', 'review', 'newsletter' ),
											'posts_per_page' => 8,
											'paged' => ( get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1 ),
											'tag' => 'maker-faire',
										);
										$query = new WP_Query( $args );

										$output = '';
										$count = 1;

										$output .= '<div class="feed-wrapper">';
										if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();

											$pos = ( $count % 2 == 0 ) ? 'even' : 'odd';
											$output .= '<div class="' . implode( ' ', get_post_class( 'custom-feed simple col-2 ' . esc_attr( $pos ) ) ) . '">';

												$has_image = '';
												$image_url = wp_get_attachment_url( get_post_thumbnail_id() );
												if ( ! empty( $image_url ) ) {
													$has_image = 'has-image';
													$output .= '<a href="' . get_permalink() . '" class="feed-thumb"><img src="' . wpcom_vip_get_resized_remote_image_url( esc_url( $image_url ), 268, 167 ) .'" alt="' . esc_attr( get_the_title() ) . '" /></a>';
												}

												$output .= '<h2 class="feed-title"><a href="' . get_permalink() . '" class="' . esc_attr( $has_image ) . '">' . get_the_title() . '</a></h2>';

											$output .= '</div>';

											$count++;
										endwhile;
											$output .= '</div>';
											$output .= '<div class="alignleft">' . get_previous_posts_link( 'PREVIOUS POSTS' ) . '</div>';
											$output .= '<div class="alignright">' . get_next_posts_link( 'NEWEST POSTS', absint( $query->max_num_pages ) ) . '</div>';
											wp_reset_postdata();
										else :
											$output .= '<p>No posts found</p>';
											$output .= '</div>';
										endif;

										echo $output;
									?>
								</div>
							</div>
							<div class="span4 sidebar-content">
								<a class="button big block" href="http://makefaire.com" target="_blank">Learn More</a>
								<div class="boxer">
									<h3>Innovation Stage</h3>
									<p>Ideas and Voices from the Maker Movement</p>
									<div class="preview-box">
										<a href="http://fora.tv/2013/09/22/the_maker_movement_manifesto" target="_blank"><img src="http://makezineblog.files.wordpress.com/2013/10/makerfaire-innovation-01.jpg" alt="Makerfaire New York 2013 Innovation Stage"></a><h4><a href="http://fora.tv/2013/09/22/the_maker_movement_manifesto" target="_blank">The Maker Movement Manifesto</a></h4>
									</div>
									<div class="preview-box">
										<a href="http://fora.tv/2013/09/22/when_makers_apply_for_college" target="_blank"><img src="http://makezineblog.files.wordpress.com/2013/10/makerfaire-innovation-02.jpg" alt="Makerfaire New York 2013 Innovation Stage"></a><h4><a href="http://fora.tv/2013/09/22/when_makers_apply_for_college" target="_blank">When Makers Apply for College</a></h4>
									</div>
									<div class="preview-box">
										<a href="http://fora.tv/2013/09/22/makernurse_the_stealth_ingenuity_of_inventive_nurses_in_america" target="_blank"><img src="http://makezineblog.files.wordpress.com/2013/10/makerfaire-innovation-03.jpg" alt="Makerfaire New York 2013 Innovation Stage"></a><h4><a href="http://fora.tv/2013/09/22/makernurse_the_stealth_ingenuity_of_inventive_nurses_in_america" target="_blank">MakerNurse: The Stealth Ingenuity of Nurses</a></h4>
									</div>
									<p class="more-link"><a href="http://fora.tv/conference/world_maker_faire_new_york_2013" target="_blank">More Videos</a></p>
								</div>
								<div class="boxer">
									<h3>Live Stage</h3>
									<p>Conversations about Emerging Tech, New Practices &amp; Community</p>
									<div class="preview-box">
										<a href="http://www.youtube.com/watch?v=mXlmQ1ilpbs&amp;feature=share" target="_blank"><img src="http://makezineblog.files.wordpress.com/2013/10/makerfaire-live-01.jpg" alt="Makerfaire New York 2013 Live Stage"></a><h4><a href="http://www.youtube.com/watch?v=mXlmQ1ilpbs&amp;feature=share" target="_blank">21st Century Robot: Meet Jimmy, the robot you can make at home</a></h4>
									</div>
									<div class="preview-box">
										<a href="http://www.youtube.com/watch?v=oTfHtaHDBtE&amp;feature=share" target="_blank"><img src="http://makezineblog.files.wordpress.com/2013/10/makerfaire-live-02.jpg" alt="Makerfaire New York 2013 Live Stage"></a><h4><a href="http://www.youtube.com/watch?v=oTfHtaHDBtE&amp;feature=share" target="_blank">Maker Collaboration: The Air Rocket Glider</a></h4>
									</div>
									<div class="preview-box">
										<a href="http://www.youtube.com/watch?v=2YRdOHdMVCo&amp;feature=share" target="_blank"><img src="http://makezineblog.files.wordpress.com/2013/10/makerfaire-live-03.jpg" alt="Makerfaire New York 2013 Live Stage"></a><h4><a href="http://www.youtube.com/watch?v=2YRdOHdMVCo&amp;feature=share" target="_blank">Make: Live 3D Design Practice</a></h4>
									</div>
									<p class="more-link"><a href="http://www.youtube.com/playlist?list=PLwhkA66li5vBNzjL2XQN9xQ012REpIP07" target="_blank">More Videos</a></p>	
								</div>
							</div>

						</div>

					</article>
					
				<div>
				
			</div>

		</div>

	</div>

<?php get_footer(); ?>