<?php
/**
 * Archive page template for projects custom post type.
 * Template name: Weekend Projects 2-col
 * 
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Cole Geissinger <cgeissinger@makermedia.com>
 * 
 */
get_header(); ?>
		
					
	<div class="grey">

		<div class="container">
			
			<div class="row">
			
				<div class="span8">
					
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						<?php the_content(); ?>
					<?php endwhile; endif; ?>
					
				</div>

				<?php get_sidebar(); ?>

			</div>
		
		</div>

	</div>			

<?php get_footer(); ?>
