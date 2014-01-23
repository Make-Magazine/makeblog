<?php
/**
 * Template Name: Holiday Gift Guide 2013
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
						
						<img style="width:940px;margin:10px 0 30px 0;" src="http://makezineblog.files.wordpress.com/2013/12/makegiftguides620x80_bur01.png" alt="Holiday Gift Guide 2013">
						
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