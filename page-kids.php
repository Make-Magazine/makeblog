<?php
/**
 *
 * Template Name: Kids
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 *
 */
get_header(); ?>
		
	<div class="single">
	
		<div class="container">

			<div class="row">

				<div class="span12">
					
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			
					<div class="projects-masthead">
						
						<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
						
					</div>
					
				</div>
			
			</div>
									
			<div class="row">
			
				<div class="span8">
				
					<article <?php post_class(); ?>>

						<h3 class="red">Kids &amp; Family on the Blog</h3>	

						<div class="top">

							<div class="row">

								<div class="span8">

									<?php $the_query = new WP_Query( 'cat=129975&posts_per_page=6' ); ?>

									<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

									<article <?php post_class('row'); ?>>
										
										<div class="span2 blurb-thumbnail">

											<?php the_post_thumbnail( 'new-thumb' ); ?>

										</div>

										<div class="span6 blurb-blurb">

											<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
											
											<p><?php echo wp_trim_words(get_the_excerpt(), 50, '...'); ?> <a href="<?php the_permalink(); ?>">Read more &raquo;</a></p>

											<p class="meta">By <?php the_author_posts_link(); ?>, <?php the_date(); ?> @ <?php the_time(); ?></p>
										
										</div>
									
									</article>

									<hr />

									<?php endwhile; wp_reset_postdata(); ?>

									<p><a href="<?php echo esc_attr( home_url() ); ?>/category/kids/"><span class="pull-right light aqua seeall right">Read More News</span></a></p>

								</div>

							</div>

						</div>

						<?php the_content(); ?>
					
					</article>
					
					<?php endwhile; ?>

					<?php endif; ?>

				</div>
					
				<?php get_sidebar(); ?>
					
			</div>

		</div>

	</div>

<?php get_footer(); ?>
