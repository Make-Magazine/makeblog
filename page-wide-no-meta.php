<?php
/**
 * Template Name: Full Width (No Meta)
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Cole Geissinger <cgeissinger@makermedia.com>
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
			
				<div class="span12">
				
					<article <?php post_class(); ?>>

						<?php the_content(); ?>
					
					</article>
					
				<div>
				
			</div>
			
			<div class="row">
			
				<div class="span8">
					
					<?php endwhile; else: ?>
					
						<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
					
					<?php endif; ?>
				</div>
					
			</div>

		</div>

	</div>

<?php get_footer(); ?>