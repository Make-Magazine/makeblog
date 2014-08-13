<?php
/**
 * Index Page
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 *
 */

get_header(); ?>

	<div class="single">

		<div class="container">

			<div class="row">

				<div class="span8">

					<div id="content">

						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

						<article <?php post_class(); ?>>

							<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

							<ul class="projects-meta">
								<?php if ( make_get_author( $post->ID ) ) : ?>
									<?php make_get_author( $post->ID ); ?>
								<?php endif ?>
								<li>Posted <span class="blue"><?php the_time('m/d/Y \@ g:i a'); ?></span></li>
								<li>Category <?php the_category(', '); ?></li>
								<li><a href="<?php the_permalink(); ?>#disqus_thread"><?php comments_number( '0', '1', '%' ); ?></a></li>
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

						<?php endwhile; ?>

						<div class="comments">
							<?php comments_template(); ?>
						</div>

						<?php else: ?>

							<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>

						<?php endif; ?>

					</div>

					<ul class="pager">

						<li class="previous"><?php previous_posts_link('&larr; Previous Page'); ?></li>
						<li class="next"><?php next_posts_link('Next Page &rarr;'); ?></li>

					</ul>

					<?php
					if ( function_exists( 'make_featured_products' ) ) : make_featured_products(); endif;
					?>

				</div>



				<?php get_sidebar(); ?>

			</div>

		</div>

	</div>

<?php get_footer(); ?>
