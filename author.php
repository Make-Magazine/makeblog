<?php 

/**
 * The template for displaying the author profiles
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * 
 */
get_header(); ?>
	
	<div class="category-top">

		<div class="container">
		
			<div class="row">
			
				<div class="span4">
				
					<?php echo make_author_avatar(); ?>
				
				</div>

				<div class="span8">
				
					<h1 class="jumbo"><?php echo make_author_name(); ?></h1>
					<?php echo make_author_bio(); ?>
					<?php echo make_author_social_links(); ?>
					<?php echo make_author_email(); ?>
					<?php echo make_author_urls(); ?>
					
				</div>
				
			</div>
		
		</div>

	</div>

	<div class="grey child">
	
		<div class="container">

			<div class="row">
			
				<div class="span12">
				
					<h2>Latest from <?php // AUTHOR NAME ?></h2>
				
				</div>
				
			</div>
			
			<?php // display Author content here ?>
			
		</div>
	
	<?php get_footer();	?>