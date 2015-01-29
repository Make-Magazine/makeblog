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
					
					<img class="thumbnail" src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/img/_KW06143-1.jpg" alt="" >
					<div style="height:10px;"></div>
					<img class="thumbnail" src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/img/_KW06121.jpg" alt="" >
					<div style="height:10px;"></div>
					<div class="thumbnail">
						<img src="<?php echo esc_url ( get_stylesheet_directory_uri() ); ?>/img/_KW06134.jpg" alt="" >
						<div style="padding:5px;color:#555;">
							<p>Follow along with Lucas and build the Maker Trainer, a custom built RC plane.</p>
						</div>
					</div>
					
				</div>
				
				<div class="span9">
				
					<img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/img/makerhangarad_04.jpg" alt="Hangar">
					<div style="height:20px;"></div>
				
					<div class="row">
						
						<div class="span5">
							
							<p><strong>MAKE Magazine</strong> and <strong>Lucas Weakley</strong> have teamed up to bring you Maker Hangar, a 15-episode tutorial series that will teach you everything you need to know to build and fly this custom RC plane, the Maker Trainer.</p>

							<p>I think we’ve all been fascinated by flight at one point in our lives. Whether that fascination leads to folding paper airplanes or piloting full-sized aircraft, we all dream to make something fly. And many of us get there using radio-controlled (R/C) hobby aircraft.</p>

							<p>We’ve all been fascinated by flight at one point in our lives. Whether that fascination leads to folding paper airplanes or piloting full-sized aircraft, we all dream to make something fly. And many of us get there using radio-controlled (R/C) hobby aircraft.</p>

							<p>Plenty of toys can give you limited control of a flying craft, but to get the full sense of flight you need to dive right into the R/C community. You’ll soon be doing exciting activities like acrobatics, speed trials, formation flying, combat, slope soaring, and aerial photography.</p>

							<p>However, it can be daunting to get started with your first R/C plane. What motor and speed controller should you get? How should you charge the batteries? What is a BEC and why do you need one? How do you fly?!</p>

							<p>To answer all these questions <em>Make:</em> created Maker Hangar, a one-stop, free resource that anyone can use to easily get into the R/C hobby. Maker Hangar consists of 23 video tutorials, three aircraft you can build, and <a href="https://plus.google.com/communities/111848781234483620161">a community of more than 1,000 members</a> all sharing pictures, videos, and knowledge.</p>

							<p>Join us on the <a href="https://plus.google.com/communities/111848781234483620161">Maker Hangar Google+ Community page</a> to share your ideas, comments, photos and video and details for your own RC plane project builds.</p>

							<p>NOTE: Be sure to check out the <a href="#parts" role="button" class="" data-toggle="modal">parts list</a> for the materials you’ll need to build the Maker Trainer, and <a href="http://cdn.makezine.com/make/makerhanger/makertrainerver3_1.pdf">download the PDF plans</a>.</p>
							<p><ul><li><a href="#parts" role="button" class="" data-toggle="modal">parts list</a></li><li><a href="http://cdn.makezine.com/make/makerhanger/makertrainerver3_1.pdf">Download the PDF plans</a></li></ul></p>
							
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
			
			<hr>
							
			<div class="row">
				
				<div class="span9">
				
					<h3>About Lucas</h3>
					
					<p>Lucas Weakley is studying aeronautics engineering at Embry Riddle Aeronautical University. He also makes and sells aircraft kits at lucasweakley.com. He’s a certified AutoCAD draftsman, an Eagle Scout, and the host of Make:’s Maker Hangar video series.</p>
										
				</div>
				
				<div class="span3">
					
					<img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/img/lukas.jpg" alt="Lucas Weakley">
					<div style="height:20px;"></div>
					
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
							'limit'				=> 3,
							'offset'			=> 12,
							'posts_per_page'	=> 3,
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
							'offset'			=> 12,
							'posts_per_page'	=> 4,
						);
						echo make_carousel($args);
					?>
					
				</div>
			
			</div>			
		
		</div>
		
	</div>

			<div class="row">
				
				<div class="span9">
				
					<h3>About Lucas</h3>
					
					<p>Lucas Weakley is studying aeronautics engineering at Embry Riddle Aeronautical University. He also makes and sells aircraft kits at lucasweakley.com. He’s a certified AutoCAD draftsman, an Eagle Scout, and the host of Make:’s Maker Hangar video series.</p>
										
				</div>
				
				<div class="span3">
					
					<img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/img/lukas.jpg" alt="Lucas Weakley">
					<div style="height:20px;"></div>
					
				</div>
			
			</div>
		
		</div>

	</div>
									
</div>

<?php get_footer(); ?>
