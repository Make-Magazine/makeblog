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
	<div class="content-type">
	
		<div class="container">

			<div class="row">

				<div class="span12">
				
					<div class="content-type-top">
					
						<div class="row">
							
							<div class="span9">
										
								<h1>Make: Videos</h1>
									
								<p>Seeing is believing, and often the best way to learn how to do something is watching others do it first. Park yourself here and browse our extensive collection of how-to and project videos.</p>
								
								<h3>Find Videos by Category:</h3>
								
								<ul class="subs">
									
									<?php echo make_category_li( 'video' ); ?>		
									
								</ul>
								
							</div>

							<div class="span3"></div>
							
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
							'title'				=> 'Featured Videos',
							'limit'				=> 2,
							'tag'				=> 'Featured',
							'projects_landing'	=> false,
							'all'				=> false
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
							'post_type'			=> 'video',
							'title'				=> 'New Videos',
							'projects_landing'	=> false,
							'all'				=> false,
						);
						
						echo make_carousel($args);
					?>
					
				</div>
			
			</div>
			
		</div>
		
	</div>
				
	<?php

		if ($catslugs) {
			echo '<div class="grey topper"><div class="container"><div class="row"><div class="span12"><h2>Videos by Category</h2></div></div></div></div>';
			foreach ($catslugs as $category) {
				$category = wpcom_vip_get_term_by('name', $category, 'category');
				echo '<div class="grey"><div class="container"><div class="row"><div class="span12">';							
				$args = array(
					'post_type'			=> 'video',
					'category__in'		=> $category->term_id,
					'title'				=> $category->name,
					'projects_landing'	=> false,
					'all'				=> false

				);
				echo make_carousel( $args );
				echo '</div></div></div>';
			} 
		} 
	?>

	<?php get_footer(); ?>
