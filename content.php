<article <?php post_class(); ?>>

	<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
	
	<ul class="projects-meta">
		<?php if ( make_get_author( $post->ID ) ) : ?>
			<?php make_get_author( $post->ID ); ?>
		<?php endif ?>
		<li>Posted <span class="blue"><?php the_time('m/d/Y \@ g:i a'); ?></span></li>
		<li>Category <?php the_category(', '); ?></li>
		<li><a href="<?php the_permalink(); ?>#comments"><?php comments_number( '0', '1', '%' ); ?></a></li>
	</ul>
	
	<div class="media">
		
		<a href="<?php the_permalink(); ?>" class="pull-left">
			<?php the_post_thumbnail( 'archive-thumb', array( 'class' => 'media-object' ) ); ?>
		</a>
		
		<div class="media-body">
			<p><?php echo wp_trim_words(get_the_excerpt(), 50, '...'); ?> <a href="<?php the_permalink(); ?>">Read more &raquo;</a></p>
		</div>
		
		<div class="jetpack-sharing">
			<?php if ( function_exists( 'sharing_display') ) echo sharing_display(); ?> 
		</div>
		
		
	</div>

</article>