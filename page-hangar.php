<?php
/**
 * Archive page template for projects custom post type.
 *
 * Template Name: Hangar
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
					
					<img class="thumbnail" src="<?php echo get_stylesheet_directory_uri(); ?>/img/_KW06143-1.jpg" alt="" >
					<div style="height:10px;"></div>
					<img class="thumbnail" src="<?php echo get_stylesheet_directory_uri(); ?>/img/_KW06121.jpg" alt="" >
					<div style="height:10px;"></div>
					<div class="thumbnail">
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/_KW06134.jpg" alt="" >
						<div style="padding:5px;color:#555;">
							<p>Follow along with Lucas and build the Maker Trainer, a custom built RC plane.</p>
						</div>
					</div>
					
				</div>
				
				<div class="span9">
				
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/makerhangarad_04.jpg" alt="Hangar">
					<div style="height:20px;"></div>
				
					<div class="row">
						
						<div class="span5">
							
							<p><strong>MAKE Magazine</strong> and <strong>Lucas Weakley</strong> have teamed up to bring you Maker Hangar, a 15-episode tutorial series that will teach you everything you need to know to build and fly this custom RC plane, the Maker Trainer.</p>

							<p>The first installment airs July 11th and don’t miss Lucas Weakly on Maker Camp as a Guest Maker!</p>

							<p>New installments will air every Tuesday and Thursday through August 29th!</p>

							<p>Join us on the <a href="https://plus.google.com/communities/111848781234483620161">Maker Hangar Google+ Community page</a> to share your ideas, comments, photos and video and details for your own RC plane project builds.</p>

							<p>NOTE: Be sure to check out the <a href="#parts" role="button" class="" data-toggle="modal">parts list</a> for the materials you’ll need to build the Maker Trainer, and <a href="http://cdn.makezine.com/make/makerhanger/makertrainerver3_1.pdf">download the PDF plans</a>.</p>
							
							<!-- Modal -->
							<div id="parts" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
									<h3 id="myModalLabel">Maker Trainer Parts</h3>
								</div>
								<div class="modal-body">
									<?php 
										$parts = get_post_meta( 320331, 'parts' );
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
					
					<p>Lucas Weakley is a 17-year-old Eagle Scout who will be a senior next year in the Engineering and Manufacturing Institute for Technology (EMIT) at Forest High School in Ocala, Fla. He's been fascinated with making things ever since he was little and played around with Lego (he still does). As he got older, Lucas became more interested in flight and got his first RC plane for his ninth birthday. Recently he’s been designing and building his own planes and now hosts a YouTube show called BusyBee TV, a biweekly show where he does reviews, how-tos, scratch builds, and other things related with the hobby.</p>
					
					<p>Lucas also has his own aerial videography company called TopView Aerials, where he gets hired to film real estate, events, and other activities with his multicopters and other aerial vehicles. When he graduates high school, Lucas hopes to attend Embry-Riddle Aeronautical College to study mechanical engineering with an aviation emphasis. He hopes to design, build, and fly real planes in the future. </p>
					
				</div>
				
				<div class="span3">
					
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/lukas.jpg" alt="Lucas Weakley">
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
				
</div>

<?php get_footer(); ?>