<?php
/**
 * Archive page template for projects custom post type.
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Jake Spurlock <jspurlock@makermedia.com>
 * 
 */
global $catslugs;
$type = ( isset( $_GET['post_type'] ) ) ? sanitize_title( $_GET['post_type'] ) : '';

if ($type == 'projects') {
	include_once 'archive-projects-category.php';
	return;
}

get_header(); ?>
		
	<div class="projects-home">
	
		<div class="art">
		
			<div class="container">

				<div class="row">

					<div class="span12">
					
						<div class="projects-top">
						
							<div class="row">
								
								<div class="span9">
									
									<h1>Make: Projects</h1>
									
									<p>Explore our growing cookbook of DIY projects for the workshop, <a href="<?php echo home_url(); ?>/category/home/food-beverage/?post_type=projects">kitchen</a>, garage, and backyard. Learn new skills, find <a href="<?php echo home_url(); ?>/category/home/kids-family/?post_type=projects">family fun</a>, build a <a href="<?php echo home_url(); ?>/category/electronics/robotics/?post_type=projects">robot</a> or a <a href="<?php echo home_url(); ?>/category/home/fun-games/?post_type=projects&amp;tag=rockets">rocket</a>. <a href="<?php echo home_url(); ?>/category/electronics/?post_type=projects&amp;difficulty=easy">Get started in electronics</a> and use new platforms like <a href="<?php echo home_url(); ?>/category/electronics/raspberry-pi/?post_type=projects">Raspberry Pi</a> and <a href="<?php echo home_url(); ?>/category/electronics/arduino/?post_type=projects">Arduino</a> to power your inventions. Get inspired and start making something today.</p>
									
									<h3>Find Projects by Category:</h3>
									
									<ul class="subs">
										
										<?php echo make_category_li( 'projects' ); ?>		
										
									</ul>
									
								</div>
								
								<div class="span3"></div>
								
							</div>
						
						</div>
						
					</div>
					
				</div>
				
			</div>
		
		</div>

	</div>
					
	<div class="grey content">

		<div class="container">
		
			<div class="row">
			
				<div class="span8">
					
					<?php
						$args = array(
							'post_type'			=> 'projects',
							'title'				=> 'Featured Projects',
							'limit'				=> 2,
							'tag'				=> 'Featured',
							'projects_landing'	=> true,
							'all'				=> true
						);
						echo make_carousel( $args ); ?>
					
				</div>
				
				<div class="span4">
					
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
							'title'				=> 'New Projects',
							'projects_landing'	=> true,
							'all'				=> true,
						);
						
						echo make_carousel($args);
					?>
					
				</div>
			
			</div>
			
			<div class="row">
			
				<div class="span12">
				
					<?php 

						$args = array(
							'post_type'			=> 'projects',
							'title'				=> '<a href="' . home_url() . '/weekendprojects/">Weekend Projects</a>',
							'tax_query' => array(
								array(
									'taxonomy' => 'flags',
									'field' => 'slug',
									'terms' => 'weekend-project'
								)
							),
							'projects_landing'	=> true,
							'all'				=> true,
							'posts_per_page'	=> 36
						);

						echo make_carousel($args);
					?>
					
				</div>
			
			</div>
			
		</div>
		
	</div>
				
	<?php

		if ($catslugs) {
			echo '<div class="grey topper"><div class="container"><div class="row"><div class="span12"><h2>Projects by Category</h2></div></div></div></div>';
			foreach ($catslugs as $category) {
				$category = wpcom_vip_get_term_by('name', $category, 'category');
				echo '<div class="grey"><div class="container"><div class="row"><div class="span12">';							
				$args = array(
					'post_type'			=> 'projects',
					'category__in'		=> $category->term_id,
					'title'				=> $category->name,
					'projects_landing'	=> true,
					'all'				=> true

				);
				echo make_carousel( $args );
				echo '</div></div></div>';
			} 
		} 
	?>

	<?php get_footer(); ?>