<?php
/**
 * @package MakeZine
 * Template Name: Maker Shed Homepage Widget
 */
?>
<?php 

header("Content-type: text/javascript");

$args = array(
  'post_type' => 'from-the-maker-shed',
  'post_status' => 'publish',
  'posts_per_page' => 1,
);

$wp_query = new WP_Query($args); 


?>

<?php if( have_posts() ) : while ($wp_query->have_posts()) : $wp_query->the_post(); ?>

var newcontent = document.createElement('p');
newcontent.id = 'js-shed-homepage';
newcontent.appendChild(document.write('
	<div id="dotd">
		<a href="<?php the_permalink(); ?>">
			<?php if (class_exists('MultiPostThumbnails')) : MultiPostThumbnails::the_post_thumbnail('from-the-maker-shed', 'product-thumbnail', NULL, 'shed-thumb'); endif; ?>
		</a>
		<p><?php the_title(); ?></p>
		<p><a href="<?php the_permalink(); ?>" class="cta">Learn more</a></p>
	</div>'));
var scr = document.getElementById('maker-shed-grabber');
scr.parentNode.insertBefore(newcontent, scr);

<?php endwhile; endif; ?><!-- /loop -->