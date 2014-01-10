<?php 

/*
Template Name: Articles Landing Page
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
								
								<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
										
									<h1>Make: <?php the_title(); ?></h1>
										
									<?php the_content(); ?>

								<?php endwhile; endif; ?>
								
								<h3>Find <?php the_title(); ?> by Category:</h3>
								
								<ul class="subs">
									
									<?php echo make_category_li( 'magazine' ); ?>		
									
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
							'post_type'	=> array( 'magazine' ),
							'title'		=> 'Featured ' . get_the_title(),
							'limit'		=> 2,
							'tag'		=> 'featured',
							'all'		=> false

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
							'post_type'	=> array( 'magazine' ),
							'title'		=> 'New ' . get_the_title(),
							'all'		=> false,
						);
						
						echo make_carousel( $args );
					?>
					
				</div>
			
			</div>
			
		</div>
		
	</div>
				
	<?php

		if ( $catslugs ) {
			echo '<div class="grey topper"><div class="container"><div class="row"><div class="span12"><h2>' . get_the_title() . ' by Category</h2></div></div></div></div>';
			foreach ( $catslugs as $category ) {
				$category = wpcom_vip_get_term_by( 'name', $category, 'category' );
				echo '<div class="grey"><div class="container"><div class="row"><div class="span12">';							
				$args = array(
					'post_type'			=> array( 'magazine' ),
					'category__in'		=> $category->term_id,
					'title'				=> $category->name,
					'projects_landing'	=> false,
					'all'				=> false,

				);
				echo make_carousel( $args );
				echo '</div></div></div>';
			} 
		} 
	?>

</div>

	<?php get_footer(); ?>