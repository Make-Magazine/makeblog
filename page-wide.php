<?php
/**
 * Template Name: Full Width
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Jake Spurlock <jspurlock@makermedia.com>
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
					
					<ul class="projects-meta">
						<li>
							By <?php 
							if( function_exists( 'coauthors_posts_links' ) ) {	
								coauthors_posts_links(); 
							} else { 
								the_author_posts_link(); 
							} ?>
						</li>
						<li>
							<?php the_date(); ?>
						</li>
						<li>
							Category <?php the_category(', '); ?>
						</li>
					</ul>
		
				</div>
			
			</div>
									
			<div class="row">
			
				<div class="span12">
				
					<article <?php post_class(); ?>>

						<?php the_content(); ?>
					
					</article>
					
				<div>
				
			</div>
			
			<div class="row">
			
				<div class="span8">
					
					<?php endwhile; ?>
					<div class="comments">
						<?php comments_template(); ?>
					</div>
					<div id="contextly"></div>

					<?php if ( function_exists('make_shopify_featured_products_slider') ) {
     					echo make_shopify_featured_products_slider( 'row-fluid' );
    				} ?>
					
					<?php else: ?>
					
						<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
					
					<?php endif; ?>
				</div>
					
			</div>

		</div>

	</div>

<?php get_footer(); ?>
