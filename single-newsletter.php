<?php
/**
 * Single Newsletter Template
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
							Posted <span class="blue"><?php the_date('m/d/Y \@ g:i a'); ?></span>
						</li>
						<li>
							Category <?php the_category(', '); ?>
						</li>
						<li>
							<a href="<?php the_permalink(); ?>#disqus_thread"><?php comments_number( '0', '1', '%' ); ?></a>
						</li>
					</ul>
		
				</div>
			
			</div>
									
			<div class="row">
			
				<div class="span8">
				
					<article <?php post_class(); ?>>

						<?php the_content(); ?>
					
					</article>
					
					<?php if ( function_exists( 'make_author_bio' ) ) { make_author_bio(); } ?>

					<?php endwhile; ?>
					
					<div class="comments">
						<?php comments_template(); ?>
					</div>
					
					<?php if ( function_exists('make_shopify_featured_products_slider') ) {
     					echo make_shopify_featured_products_slider( 'row-fluid' );
    				} ?>
					
					<?php else: ?>
					
						<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
					
					<?php endif; ?>
				</div>
				
				
				<?php get_sidebar(); ?>
					
					
			</div>

		</div>

	</div>

<?php get_footer(); ?>
