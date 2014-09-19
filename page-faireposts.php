<?php
/**
 * @package MakeZine
 * Template Name: Maker Faire Posts
 */
?>
<div class="beat-report" style="margin-bottom:20px;">
	
	<div class="top">
		
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/beat_report.jpg" alt="Maker Faire Beat Report">
		
	</div>
	
</div>

<div class="newsies">
	
	<div class="news post">
		
		<?php 
			$args = array(
				'post_type' => array( 'post', 'craft', 'magazine', 'video', 'projects' ),
				'post_status' => 'publish',
				'posts_per_page' => 5,
				'ignore_sticky_posts' => 1,
				'tag' => 'maker-faire'
			);
			
			$query = new WP_Query($args);
		
			if( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
		?>
				
		<div class="row">

			<div class="span2">
				
				<?php get_the_image( array( 'image_scan' => true, 'size' => 'faire-thumb' ) ); ?>
			
			</div>

			<div class="span6">

				<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

				<p><?php echo get_the_excerpt() ; ?></p>
		
				<p class="read_more"><strong><a href="<?php the_permalink(); ?>" class="btn btn-primary btn-mini">Read full story &rarr;</a></strong></p>
				
				<ul class="unstyled">
					<li>Posted by <?php if( function_exists( 'coauthors_posts_links' ) ) {	coauthors_posts_links(); } else { the_author_posts_link(); 	} ?> | <?php the_time('F jS, Y g:i A') ?> <?php edit_post_link('Fix me...'); ?></li>
					<li>Categories: <?php the_category(', ') ?> | <?php comments_popup_link(); ?></li>
				</ul>

			</div>

		</div>
		
		<?php endwhile; endif; ?>

		<h4><a href="http://blog.makezine.com/tag/maker-faire/">Read More &rarr;</a></h4>
		
	</div>

</div>
