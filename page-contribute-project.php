<?php
/*
* Template Name: Post Contribute Form
*
* @package    makeblog
* @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
*
*/
get_header(); ?>
<div class="single">
	<div class="container">
		<div class="row">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			
			<div class="span12 contribute">
				<?php the_content(); ?>
			</div>
			<?php endwhile; else: endif; ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
