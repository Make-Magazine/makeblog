<?php
/**
 * The template for displaying the archive of Page:2 posts.
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Jake Spurlock <jspurlock@makermedia.com>
 * Template Name: Archives Page
 * 
 */

get_header(); ?>

		<div class="single">
		
			<div class="container">

				<div class="row">

					<div class="span8">

						<ul class="breadcrumb">
		
							<?php if(class_exists('bcn_breadcrumb_trail')) {
								$breadcrumb_trail = new bcn_breadcrumb_trail;
								$breadcrumb_trail->opt['home_title'] = "Home";
								$breadcrumb_trail->opt['current_item_prefix'] = '<li class="current">';
								$breadcrumb_trail->opt['current_item_suffix'] = '</li>';
								$breadcrumb_trail->opt['separator'] = '<span class="divider">&nbsp;/&nbsp;</span>';
								$breadcrumb_trail->opt['home_prefix'] = '<li>';
								$breadcrumb_trail->opt['home_suffix'] = '</li>';
								$breadcrumb_trail->opt['max_title_length'] = 70;
								$breadcrumb_trail->fill();
								$breadcrumb_trail->display();
							} ?>
									
						</ul>

						<div class="content">


							 <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			
							 	<article <?php post_class(); ?>>


							 	<div class="row">

							 		<div class="span2">

							 			<?php get_the_image(); ?>

							 		</div>

							 		<div class="span5">

										<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

										<?php the_content(); ?>

										<p class="meta top">By <?php the_author_link(); ?>, <?php the_time('m/d/Y \@ g:i a') ?></p>
										<p>Categories: <?php the_category(', '); ?> | <?php comments_popup_link(); ?> <?php edit_post_link('Fix me...', ' | '); ?></p>

									</div>
								
								</div>
								
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

					</div>

					<?php get_sidebar(); ?>

			<?php get_footer(); ?>