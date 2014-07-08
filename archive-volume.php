<?php
/**
 * Volume Page archive
 * This template is loaded on makezine.com/volume
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * 
 */

get_header(); ?>
		
	<div class="single">
	
		<div class="container">

			<div class="row">

				<div class="span8">
					
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

						<article <?php post_class( 'row volume' ); ?>>
							<div class="span2">
								<?php
									echo get_the_image( array(
										'image_scan' => true,
									) );
								?>
							</div>
							<div class="span6">
								<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
							
								<div class="media">
									<div class="media-body">
										<p><?php echo wp_trim_words(get_the_excerpt(), 50, '...'); ?> <a href="<?php the_permalink(); ?>">Read more &raquo;</a></p>
									</div>
								</div>
							</div>
						
						</article>

					<?php endwhile; ?>
					
						<ul class="pager">
								
							<li class="previous"><?php previous_posts_link('&larr; Previous Page'); ?></li>
							<li class="next"><?php next_posts_link('Next Page &rarr;'); ?></li>
						
						</ul>

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