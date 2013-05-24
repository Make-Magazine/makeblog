<?php 
	$bio = get_post_custom_values('author_bio');
	$name = get_post_custom_values('author');
	$url = get_post_custom_values('author_website');
	$email = get_post_meta($post->ID, 'author_email', true);
	$size = 72;
	$link = get_post_custom_values('link');
?>

<?php
/**
 * Page 2 Template 
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Jake Spurlock <jspurlock@makermedia.com>
 * 
 */
make_get_header() ?>
		
	<div class="single">
	
		<div class="container">

			<div class="row">

				<div class="span12">
					
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			
					<div class="projects-masthead">
						
						<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
						
					</div>
					
					<ul class="projects-meta">
						<li>
							By <?php echo esc_html( $name[0] ); ?>
						</li>
						<li>
							Posted <span class="blue"><?php the_date(); ?></span>
						</li>
						<li>
							Category <?php the_category(', '); ?>
						</li>
					</ul>
		
				</div>
			
			</div>
									
			<div class="row">
			
				<div class="span8">
				
					<article <?php post_class(); ?>>

						<?php the_content(); ?>
					
					</article>

					<div class="postmeta">

						<div class="span-thumb thumbnail">
						
							<?php echo get_avatar( $email, $size ); ?>
						
						</div>
						
						<div class="span-well well">
						
							<p>Posted by: <a href="<?php echo esc_url( $url[0] ); ?>"><?php echo esc_html( $name[0] ); ?></a> | <a href="<?php the_permalink(); ?>"><?php the_time('l F jS, Y g:i A'); ?></a></p>
							<?php 
								if (isset($bio[0])) {
									echo '<p>Bio: ';
									echo wp_kses_post( $bio[0] );
									echo '</p>';
								}
							?>
							<p>Categories: <?php the_category(', '); ?> | <?php comments_popup_link(); ?> <?php edit_post_link('Fix me...', ' | '); ?></p>

						</div>

					</div>
					
					<div class="clearfix"></div>
					
					<?php endwhile; ?>

					<?php if (function_exists('make_featured_products')) { make_featured_products(); } ?>

					<div class="comments">
						<?php comments_template(); ?>
					</div>
					
					<?php else: ?>
					
						<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
					
					<?php endif; ?>
				</div>
				
				
				<?php get_sidebar(); ?>
					
			</div>

		</div>

	</div>

<?php get_footer(); ?>