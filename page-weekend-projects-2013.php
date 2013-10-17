<?php
/**
 * Archive page template for projects custom post type.
 * Template name: Weekend Projects 2013
 * 
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Jake Spurlock <jspurlock@makermedia.com>
 * 
 */
global $catslugs;
get_header(); ?>
		
	<div class="projects-home">
	
		<div class="container">

			<div class="row">

				<div class="span12">
				
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/projects-banner.png" alt="Weekend Projects" style="margin-top:-20px;margin-bottom:-20px;">
					
				</div>
				
			</div>
			
		</div>

	</div>
					
	<div class="grey">

		<div class="container">
			
			<div class="row">
			
				<div class="span12">
					
					<h3 class="heading">Featured Project</h3>
					
				</div>
			
			</div>
			
			<div class="row">
			
				<div class="span8">
					
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						<?php the_content(); ?>
					<?php endwhile; ?>
					<!-- post navigation -->
					<?php else: ?>
					<!-- no posts found -->
					<?php endif; ?>
					
				</div>
				
				<div class="span4">
					
					<a href="http://pubads.g.doubleclick.net/gampad/clk?id=66651178&iu=/11548178/Makezine">
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/weekendprojects_hangoutsonair_bur08.png" alt="Weekend Projects Hangout on Air" style="margin-bottom:20px;">
					</a>
					
					<div class="sidebar-ad">

						<!-- Beginning Sync AdSlot 2 for Ad unit header ### size: [[300,250]]  -->
						<div id='div-gpt-ad-664089004995786621-2'>
							<script type='text/javascript'>
								googletag.cmd.push(function(){googletag.display('div-gpt-ad-664089004995786621-2')});
							</script>
						</div>
						<!-- End AdSlot 2 -->

					</div>
					
				</div>
				
			</div>
								
			<div class="row">
			
				<div class="span12">
				
					<?php 

						$args = array(
							'post_type'			=> 'projects',
							'title'				=> 'Latest Weekend Projects',
							'tax_query' => array(
								array(
									'taxonomy' => 'flags',
									'field' => 'slug',
									'terms' => 'weekend-project'
								)
							),
							'projects_landing'	=> true,
							'all'				=> false,
							'posts_per_page'	=> 36,
							'orderby'			=> 'date',
							'order'				=> 'dsc'
						);

						make_carousel($args, false);
					?>
				</div>
			
			</div>
			
			<div class="row">
			
				<div class="span12">
				
					<?php 

						$args = array(
							'post_type'			=> array( 'post', 'video' ),
							'title'				=> 'Weekend Projects News',
							'tag'				=> 'weekend-projects',
							'projects_landing'	=> true,
							'all'				=> false,
							'posts_per_page'	=> 36,
							'orderby'			=> 'date',
							'order'				=> 'dsc',
							'debug'				=> false
						);

						make_carousel($args, false);
					?>
					
				</div>
			
			</div>
			
			<div class="row">
			
				<div class="span12">
				
					<?php if ( function_exists( 'sharing_display') ) echo sharing_display(); ?> 
					
				</div>
			
			</div>
			
		</div>
		
	</div>

	<div class="grey topper">
		
		<div class="container">
			<div class="row">
				
				<div class="span12">
				
					<h2>Weekend Projects by Difficulty</h2>
				
				</div>
				
			</div>
		
		</div>
	
		<?php

			$difficulties = array('easy', 'moderate', 'difficult' );

			foreach ($difficulties as $difficulty) {
				echo '<div class="grey"><div class="container"><div class="row"><div class="span12">';							
				$args = array(
					'post_type'			=> 'projects',
					'difficulty'		=> $difficulty,
					'category__in'		=> 0,
					'projects_landing'	=> true,
					'all'				=> false,
					'posts_per_page'	=> 36,
					'tax_query' => array(
						array(
							'taxonomy' => 'flags',
							'field' => 'slug',
							'terms' => 'weekend-project'
						)
					),

				);
				make_carousel( $args, false );
				echo '</div></div></div>';
			}
		?>

	<?php get_footer(); ?>