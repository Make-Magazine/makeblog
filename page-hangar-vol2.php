<?php
/**
 * Archive page template for projects custom post type.
 *
 * Template Name: Hangar 2
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Jake Spurlock <jspurlock@makermedia.com>
 * 
 */
get_header(); ?>
		
	<div class="projects-home">
	
		<div class="container">
		
			<h1>Maker Hangar</h1>
			<div style="height:10px;"></div>
		
			<div class="row">

				<div class="span3">
					
					<img class="thumbnail" src="<?php echo esc_attr( get_stylesheet_directory_uri() ); ?>/img/1-Learning-How-To-Fly-210x140.jpg" alt="" />
					<div style="height:10px;"></div>
					<img class="thumbnail" src="<?php echo esc_attr( get_stylesheet_directory_uri() ); ?>/img/2-lucasonset-210x140.jpg" alt="" />
					<div style="height:10px;"></div>
					<div class="thumbnail">
						<img src="<?php echo esc_attr( get_stylesheet_directory_uri() ); ?>/img/3-tricopter-210x140.jpg" alt="" />
						<div style="padding:5px;color:#555;">
							<p>Follow along with Lucas and build three custom R/C aircraft.</p>
						</div>
					</div>
					
				</div>
				
				<div class="span9">
				
					<img src="<?php echo esc_attr( get_stylesheet_directory_uri() ); ?>/img/Maker-Hangar-Main-700x400.jpg" alt="Hangar" />
					<div style="height:20px;"></div>
				
					<div class="row">
						
						<div class="span5">
							
							<p><strong>MAKE Magazine</strong> and <strong>Lucas Weakley</strong> have teamed up to bring you Maker Hangar, a 23-episode tutorial series that will teach you everything you need to know to build and fly three custom R/C aircraft.</p>
							<p>It can be daunting to get started with your first R/C plane. What motor and speed controller should you get? How should you charge the batteries? What is a BEC and why do you need one? How do you fly?!</p>
							<p>Maker Hangar answers these questions and more. A one-stop, free resource that anyone can use to easily get into the R/C hobby. Plus, join <a href="https://plus.google.com/communities/111848781234483620161" target="_blank">a community of more than 1,000 members</a> all sharing pictures, videos, and knowledge.</p>
							
							<ul>
								<li><a href="#parts" role="button" class="" data-toggle="modal">Parts List</a></li>
								<li><a href="http://cdn.makezine.com/make/makerhanger/makertrainerver3_1.pdf" target="_blank">Download the PDF Plans</a></li>
							</ul>
							
							<!-- Modal -->
							<div id="parts" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
									<h3 id="myModalLabel">Maker Trainer Parts</h3>
								</div>
								<div class="modal-body">
									<?php 
										$parts = get_post_meta( 463558, 'parts' );
										echo make_projects_parts( $parts );
									?>
								</div>
								<div class="modal-footer">
									<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
								</div>
							</div>
							
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
					
				</div>
				
			</div>
												
		</div>

	</div>
					
	<div class="grey content">

		<div class="container">
								
			<div class="row">
			
				<div class="span12">
				
					<?php 

						$args = array(
							'post_type'			=> 'video',
							'title'				=> 'Recent Videos',
							'projects_landing'	=> false,
							'all'				=> false,
							'playlist'			=> 'maker-hangar',
							'order'				=> 'ASC',
							'limit'				=> 4,
							'posts_per_page'	=> 4,
						);
						echo make_carousel($args);
					?>
					
				</div>
			
			</div>
			
			<div class="row">
			
				<div class="span12">
				
					<?php 

						$args = array(
							'post_type'			=> 'video',
							'title'				=> '',
							'projects_landing'	=> false,
							'all'				=> false,
							'playlist'			=> 'maker-hangar',
							'order'				=> 'ASC',
							'limit'				=> 4,
							'offset'			=> 4,
							'posts_per_page'	=> 4,
						);
						echo make_carousel($args);
					?>
					
				</div>
			
			</div>
			
			<div class="row">
			
				<div class="span12">
				
					<?php 
						$args = array(
							'post_type'			=> 'video',
							'title'				=> '',
							'projects_landing'	=> false,
							'all'				=> false,
							'playlist'			=> 'maker-hangar',
							'order'				=> 'ASC',
							'limit'				=> 4,
							'offset'			=> 8,
							'posts_per_page'	=> 4,
						);
						echo make_carousel($args);
					?>
					
				</div>
			
			</div>

			<div class="row">
			
				<div class="span12">
				
					<?php 
						$args = array(
							'post_type'			=> 'video',
							'title'				=> '',
							'projects_landing'	=> false,
							'all'				=> false,
							'playlist'			=> 'maker-hangar',
							'order'				=> 'ASC',
							'limit'				=> 4,
							'offset'			=> 12,
							'posts_per_page'	=> 4,
						);
						echo make_carousel($args);
					?>
					
				</div>
			
			</div>
		
			<div class="row">
			
				<div class="span12">
				
					<?php 

						$args = array(
							'post_type'			=> 'video',
							'title'				=> '',
							'projects_landing'	=> false,
							'all'				=> false,
							'playlist'			=> 'maker-hangar',
							'order'				=> 'ASC',
							'limit'				=> 4,
							'offset'			=> 15,
							'posts_per_page'	=> 4,
						);
						echo make_carousel($args);
					?>
					
				</div>
			
			</div>
			
			<div class="row">
			
				<div class="span12">
				
					<?php 

						$args = array(
							'post_type'			=> 'video',
							'title'				=> '',
							'projects_landing'	=> false,
							'all'				=> false,
							'playlist'			=> 'maker-hangar',
							'order'				=> 'ASC',
							'limit'				=> 4,
							'offset'			=> 19,
							'posts_per_page'	=> 4,
						);
						echo make_carousel($args);
					?>
					
				</div>
			
			</div>

		</div>
		
	</div>

	<div class="projects-home">

		<div class="container">

			<div class="row">
			
				<div class="span9">
				
					<h3>About Lucas</h3>
					
					<p>Lucas Weakley is studying aeronautics engineering at Embry Riddle Aeronautical University. He also makes and sells aircraft kits at lucasweakley.com. He’s a certified AutoCAD draftsman, an Eagle Scout, and the host of Make:’s Maker Hangar video series.</p>
					
				</div>
				
				<div class="span3">
					
					<img src="<?php echo esc_attr( get_stylesheet_directory_uri() ); ?>/img/lukas.jpg" alt="Lucas Weakley" />
					
					<div style="height:20px;"></div>
					
				</div>
				
			</div>

		</div>

	</div>

<?php get_footer(); ?>
