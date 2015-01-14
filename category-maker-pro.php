<?php
/**
 * The template for displaying the Maker Pro category archives.
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

					<div class="span8 add30">

							<div class="content-type h1">

								<?php 

									print apply_filters( 'taxonomy-images-queried-term-image', '', array( 'after' => '</div>', 'before' => '<div id="taxonomy-image">', 'image_size' => 'full') );
								?>

										<h1><?php single_cat_title('', true); ?></h1>

										<p>
										<strong>"If you come, we will build it."</strong>

										<em>Maker Pro is about the impact of makers on business and technology. Our coverage includes hardware startups, new products, incubators, innovators, along with technology and market trends. Please send items to us at <a href="mailto:makerpro@makermedia.com">makerpro@makermedia.com</a></em>. 
										<br/>
										<strong><a href="<?php echo esc_url( home_url( '/maker-pro-newsletter/' ) ); ?>">Click here to subscribe to the Maker Pro newsletter!</a></strong>
										</p>

								<div class="clear"></div>

							</div>

							 <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			
							 	<article <?php post_class(); ?>>

							 		<div class="cat-thumb">

							 			<?php get_the_image( array( 'image_scan' => true, 'size' => 'archive-thumb' ) ); ?>

							 		</div>

							 		<div class="cat-blurb">

							 			<?php 
							 				if ( ! empty( $_REQUEST['parent'] ) ) { ?>
							 					<h3><a class="red" href="<?php echo esc_url( add_query_arg( 'parent', rawurlencode( strip_tags( $_REQUEST['parent'] ) ), get_permalink() ) ); ?>"><?php the_title(); ?></a></h3>
							 				<?php } else { ?>
							 					<h3><a class="red" href="<?php echo esc_url( add_query_arg( 'parent', make_get_category_name_strip_slash(), get_permalink() ) ); ?>"><?php the_title(); ?></a></h3>
							 				<?php } ?>

										<p><?php echo wp_trim_words(get_the_excerpt(), 50, '...'); ?> <a href="<?php the_permalink(); ?>">Read more &raquo;</a></p>

										<p class="meta">By <?php the_author_posts_link(); ?>, <?php the_time('m/d/Y \@ g:i a') ?></p>
										<p>Categories: <?php the_category(', '); ?> | <?php comments_popup_link(); ?> <?php edit_post_link('Fix me...', ' | '); ?></p>

									</div>

									<div class="clear"></div>
									
									<hr />

								</article>

							<?php endwhile; ?>

							<div class="clear"></div>

						<div>

								<ul class="pager">
							
									<li class="previous"><?php previous_posts_link('&larr; Previous Page'); ?></li>
									<li class="next"><?php next_posts_link('Next Page &rarr;'); ?></li>
							
								</ul>

						</div>

							<?php if ( function_exists('make_shopify_featured_products_slider') ) {
		     					echo make_shopify_featured_products_slider( 'row-fluid' );
		    				} ?>
						
							<?php else: ?>
							
								<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
							
							<?php endif; ?>

					</div>

					<?php 
						if ( ( 'craft' == get_post_type() ) || in_category( 30694999 ) || post_is_in_descendant_category( 30694999 ) ) {
							get_sidebar('craft');
							get_footer('craft');
						} else { 
							get_sidebar();
							get_footer();
						}
					?>
