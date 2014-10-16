<?php
/**
 * Template Name: Materials
 *
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

						<?php 
							$tags = array( 'advancedmaterials',	'naturalmaterial', 'concretematerial', 'reusedmat',	'ceramicsmat', 'plywoodmat', 'metalmat', 'castmat',	'papermat',	'glassmat' );

							foreach ( $tags as $tag ) {
								$term = wpcom_vip_get_term_by( 'slug', $tag, 'post_tag' );
								if ( $term === false ) {
									break;
								}
								echo '<div class="cat" id="' . $term->slug . '">';
								echo '<div class="cat-' . $term->slug . '">';
								echo '<h2><a href="' . get_term_link( $term ) . '">' . esc_html( make_get_better_tag_title( $term->name ) ) . '</a></h2>';
								$my_query = wp_cache_get( 'page-materials-query-' . $term->slug );
										
								if( $my_query == false ) {
									$args = array(
										'tag'				=> $term->slug,
										'posts_per_page'	=> 30,
										'no_found_rows'		=> true,
										'post_type'			=> array('post', 'review', 'craft', 'projects', 'video' ),
										);
									$my_query = new WP_Query( $args );
									wp_cache_set( 'page-materials-query-advancedmaterials', $my_query, '', 43200  );
								}
								
								echo '<ul>';
								
								while ($my_query->have_posts()) : $my_query->the_post();
									
								echo '<li><a href="' . get_permalink() . '">' . get_the_title() .  '</a></li>';
										
								endwhile;
									
								echo '</ul>';

								echo '</div>';

								echo '</div><!-- ' . $term->name . ' -->';
							}
						?>
					
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
				
				
				<?php get_sidebar(); ?>
					
					
			</div>

		</div>

	</div>

<?php get_footer(); ?>