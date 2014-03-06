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
				
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/WP_webheader_940x110-1.png" alt="Weekend Projects">
					
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
					
				</div>
				
				<div class="span4">

					<div class="widget">
						<form role="search" method="get" class="form-search" id="searchform" action="<?php echo home_url( '/' ); ?>">
							<input type="text" class="input-medium search-query" value="" name="s" id="s" placeholder="Search Weekend Projects" />
							<input type="hidden" class="btn" name="tag" id="searchsubmit" value="greatcreate" />
							<input type="submit" class="btn" id="searchsubmit" value="Search" />
						</form>
					</div>

					<?php dynamic_sidebar( 'sidebar_weekend_projects' ); ?>
					
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

						$first_row = get_post_meta( get_the_id(), 'first_row', true );

						if ( ! empty( $first_row ) ) {
							do_shortcode( wp_kses_post( $first_row ) );
						} else {

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

						echo make_carousel($args, false);

						}
					?>
				</div>
			
			</div>
			
			<div class="row">
			
				<div class="span12">
				
					<?php 

						$second_row = get_post_meta( get_the_id(), 'second_row', true );

						if ( ! empty( $first_row ) ) {
							do_shortcode( wp_kses_post( $first_row ) );
						} else {

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

						echo make_carousel($args, false);

						}
					?>
					
				</div>
			
			</div>
			
			<div class="row">
			
				<div class="span12">
				
					<?php if ( function_exists( 'sharing_display') ) echo sharing_display(); ?> 
					
				</div>
			
			</div>
			
		</div>

		<!-- post navigation -->
		<?php else: ?>
		<!-- no posts found -->
		<?php endif; ?>
		
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
				echo make_carousel( $args, false );
				echo '</div></div></div>';
			}
		?>

	<?php get_footer(); ?>