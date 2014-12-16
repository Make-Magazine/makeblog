<?php

/**
 * The template for displaying the author profiles
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 *
 */
get_header(); ?>

	<div class="category-top">

		<div class="container">

			<div class="row">

				<?php make_author_profile(); ?>

			</div>

		</div>

	</div>

	<div class="grey child">

		<div class="container">

			<div class="row">

				<div class="span12">

					<h2>Latest from <?php echo make_author_name(); ?></h2>

				</div>

			</div>

			<div class="row">

				<div class="span8 add30" id="content">

					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

						<div class="projects-masthead">
							<h2><a href="<?php esc_url( the_permalink() ); ?>"><?php esc_html( the_title() ); ?></a></h2>
						</div>

						<ul class="projects-meta author-meta">
							<?php if ( make_get_author( absint( $post->ID ) ) ) : ?>
								<?php make_get_author( asbint( $post->ID ) ); ?>
							<?php endif ?>
							<li><?php the_time('m/d/Y \@ g:i a'); ?></li>
							<li>Category <?php the_category(', '); ?></li>
							<?php edit_post_link( 'Edit', '<li>', '</li>' ); ?>
						</ul>

						<article <?php post_class(); ?>>

							<div class="media">

								<?php if ( has_post_thumbnail() ) : ?>
									<a href="<?php esc_url( the_permalink() ); ?>" class="pull-left">
										<?php the_post_thumbnail( 'archive-thumb', array( 'class' => 'media-object' ) ); ?>
									</a>
								<?php endif; ?>

								<div class="media-body">
									<p><?php echo wp_trim_words(get_the_excerpt(), 50, '...'); ?> <a href="<?php esc_url( the_permalink() ); ?>">Read more &raquo;</a></p>
								</div>

								<div class="jetpack-sharing">
									<?php if ( function_exists( 'sharing_display') ) echo sharing_display(); ?>
								</div>

							</div>

						</article>

					<?php endwhile; else: ?>



						<p><?php echo 'No posts found.' ?></p>

					<?php endif; ?>

						<div class="clear"></div>

						<div>
							<ul class="pager">
								<li class="previous"><?php previous_posts_link('&larr; Previous Page'); ?></li>
								<li class="next"><?php next_posts_link('Next Page &rarr;'); ?></li>
							</ul>
						</div>

				</div>

				<?php get_sidebar(); ?>

			</div>

		</div>

	<?php get_footer();	?>
