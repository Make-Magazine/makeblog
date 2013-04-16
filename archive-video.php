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
get_header(); ?>
		
	<div class="projects-home">
	
		<div class="art">
		
			<div class="container">

				<div class="row">

					<div class="span12">
					
						<div class="projects-top">
						
							<div class="row">
								
								<div class="span8">
									
									<h1>Videos</h1>
									
									<p>Explore our growing cookbook of DIY projects for the workshop, <a href="http://blog.makezine.com/category/home/food-beverage/?post_type=projects">kitchen</a>, garage, and backyard. Learn new skills, find <a href="http://blog.makezine.com/category/home/kids-family/?post_type=projects">family fun</a>, build a <a href="http://blog.makezine.com/category/electronics/robotics/?post_type=projects">robot</a> or a <a href="http://blog.makezine.com/category/home/fun-games/?post_type=projects&amp;tag=rockets">rocket</a>. <a href="http://blog.makezine.com/category/electronics/?post_type=projects&amp;difficulty=easy">Get started in electronics</a> and use new platforms like <a href="http://blog.makezine.com/category/electronics/raspberry-pi/?post_type=projects">Raspberry Pi</a> and <a href="http://blog.makezine.com/category/electronics/arduino/?post_type=projects">Arduino</a> to power your inventions. Get inspired and start making something today.</p>

									<p class="muted" style="font-size:15px;font-style:italic;">Welcome to the new Make: Projects! User accounts are temporarily disabled. If you contributed on our old platform, you can still view your projects here, and we're working on an easy way to edit them in the future. If you'd like access to update a project, email us at <a href="mailto:projects@makezine.com">projects@makezine.com</a>.</p>
									
									<h3>Find Projects by Category:</h3>
									
									<ul class="subs">
										
										<?php echo make_category_li('true'); ?>		
										
									</ul>
									
								</div>
								
								<div class="span4"></div>
								
							</div>
						
						</div>
						
					</div>
					
				</div>
				
			</div>
		
		</div>

	</div>
					
	<div class="grey">

		<div class="container">
		
			<div class="row">
			
				<div class="span8">
					
					<?php
						$args = array(
							'post_type'			=> 'video',
							'title'				=> 'Featured Projects',
							'limit'				=> 2,
							'tag'				=> 'Featured',
							'projects_landing'	=> true,
							'all'				=> true
						);
						make_carousel( $args ); ?>
					
				</div>
				
				<div class="span4">
					
					<div class="sidebar-ad">

						<!-- Beginning Sync AdSlot 2 for Ad unit header ### size: [[300,250]]  -->
						<div id='div-gpt-ad-664089004995786621-2'>
							<script type='text/javascript'>
								googletag.display('div-gpt-ad-664089004995786621-2');
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
							'post_type'			=> 'video',
							'title'				=> 'New Videos',
							'projects_landing'	=> true,
							'all'				=> true,
						);
						
						make_carousel($args);
					?>
					
				</div>
			
			</div>
			
			<div class="row">
			
				<div class="span12">
				
					<?php 

						$args = array(
							'post_type'			=> 'videos',
							'title'				=> 'Weekend Projects',
							'tax_query' => array(
								array(
									'taxonomy' => 'flags',
									'field' => 'slug',
									'terms' => 'weekend-project'
								)
							),
							'projects_landing'	=> true,
							'all'				=> true,
							'posts_per_page'	=> 24
						);

						make_carousel($args);
					?>
					
				</div>
			
			</div>
			
		</div>
		
	</div>
				
	<?php

		if ($catslugs) {
			echo '<div class="grey dots topper"><div class="container"><div class="row"><div class="span12"><h2>Projects by Category</h2></div></div></div></div>';
			foreach ($catslugs as $category) {
				$category = wpcom_vip_get_term_by('name', $category, 'category');
				echo '<div class="grey"><div class="container"><div class="row"><div class="span12">';							
				$args = array(
					'post_type'			=> 'video',
					'category__in'		=> $category->term_id,
					'title'				=> $category->name,
					'projects_landing'	=> true,
					'all'				=> true

				);
				make_carousel( $args );
				echo '</div></div></div>';
			} 
		} 
	?>

</div>

	<?php get_footer(); ?>