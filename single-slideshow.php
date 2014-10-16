<?php get_header('slideshow'); ?>

		<div class="container">

			<div class="row">

				<div class="span8">

					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						
						<article <?php post_class(); ?>>

							<?php the_content(); ?>
							
							<div class="clear"></div>
						
						</article>

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

			
				<?php get_sidebar('slideshow'); ?>
			
			<?php get_footer('slideshow'); ?>