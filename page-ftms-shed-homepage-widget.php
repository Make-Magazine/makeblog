<?php
/**
 * @package MakeZine
 * Template Name: Maker Shed Homepage Widget
 */

header('Content-Type: text/javascript; charset=utf-8');

$args = array(
  'post_type' => 'from-the-maker-shed',
  'post_status' => 'publish',
  'posts_per_page' => 1,
);

$wp_query = new WP_Query($args); 

if( have_posts() ) : while ($wp_query->have_posts()) : $wp_query->the_post(); 

	$link = get_post_meta( get_the_id(), 'ftms_link', true );

?>

	$(document).ready(function(){
		var deal = '<div id="dotd"><a href="<?php echo esc_url( $link ); ?>"><?php if (class_exists('MultiPostThumbnails')) : MultiPostThumbnails::the_post_thumbnail('from-the-maker-shed', 'product-thumbnail', NULL, 'shed-thumb'); endif; ?></a><p><?php the_title(); ?></p><p><a href="<?php echo esc_url( $link ); ?>" class="cta">Learn more</a></p></div>';
		$("#dotd").remove();
		$("#maker-shed-grabber").append( deal );
	});

<?php endwhile; endif; ?>