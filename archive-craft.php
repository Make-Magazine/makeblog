<?php
/**
 * The template for displaying the Craft header.
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Jake Spurlock <jspurlock@makermedia.com>
 */

get_header(); ?>
		
	<div class="single">
	
		<div class="container">

			<div class="row">

				<div class="span8">
					
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					
					<div class="projects-masthead">
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					</div>
					
					<ul class="projects-meta">
						<?php if ( make_get_author( $post->ID ) ) : ?>
							<?php make_get_author( $post->ID ); ?>
						<?php endif ?>
						<li><?php the_time('m/d/Y \@ g:i a'); ?></li>
						<li>Category <?php the_category(', '); ?></li>
					</ul>
				
					<article <?php post_class(); ?>>
						
						<div class="media">
							
							<a href="<?php the_permalink(); ?>" class="pull-left">
								<?php the_post_thumbnail( 'archive-thumb', array( 'class' => 'media-object' ) ); ?>
							</a>
							
							<div class="media-body">
								<p><?php echo wp_trim_words(get_the_excerpt(), 50, '...'); ?> <a href="<?php the_permalink(); ?>">Read more &raquo;</a></p>
							</div>
							
							<div class="jetpack-sharing">
								<?php if ( function_exists( 'sharing_display') ) echo sharing_display(); ?> 
							</div>
							
							
						</div>
					
					</article>

					<?php endwhile; ?>
					
					<ul class="pager">
							
						<li class="previous"><?php previous_posts_link('&larr; Previous Page'); ?></li>
						<li class="next"><?php next_posts_link('Next Page &rarr;'); ?></li>
					</ul>
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
				
				
				<?php get_sidebar(); ?>
					
					
			</div>

		</div>

	</div>

<?php get_footer(); ?>
