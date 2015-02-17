<?php
/**
 * Archive page template for projects custom post type.
 * Template name: Weekend Projects Wide
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
			
				<div class="span12">
					
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						<?php the_content(); ?>
					<?php endwhile; endif; ?>
					
				</div>

			</div>
		
		</div>

	</div>			

<?php get_footer(); ?>
