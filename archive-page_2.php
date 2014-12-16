<?php
/**
 * The template for displaying the archive of Page:2 posts.
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
				
					<?php
					 	$bio = get_post_custom_values('author_bio');
						$name = get_post_custom_values('author');
						$url = get_post_custom_values('author_website');
						$email = get_post_meta($post->ID, 'author_email', true);
						$size = 40;
					?>
					
					<article <?php post_class(); ?>>

						<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
						
						<ul class="projects-meta">
							<li>By <a href="<?php echo esc_url( $url[0] ); ?>"><?php echo esc_html( $name[0] ); ?></a></li>
							<li><?php the_time('m/d/Y \@ g:i a'); ?></li>
							<li>Category <?php the_category(', '); ?></li>
						</ul>
							
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
