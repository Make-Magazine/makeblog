<?php 
/*
Template Name: Categories
*/
?>

<?php get_header(); ?>
		
		<div class="clear"></div>

		<div class="sand">

			<div class="container">

				<div class="row">

					<div class="span8">

						<div class="content">


							 <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			
								<article <?php post_class(); ?>>

									<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
									
									<?php make_category_list(); ?>
								
								</article>

							<?php endwhile; ?>

							<?php if ( function_exists('make_shopify_featured_products_slider') ) {
		     					echo make_shopify_featured_products_slider( 'row-fluid' );
		    				} ?>
						
							<?php else: ?>
							
								<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
							
							<?php endif; ?>

						</div>

					</div>

					<?php get_sidebar(); ?>

			<?php get_footer(); ?>