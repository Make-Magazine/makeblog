<?php
/**
 * Index Page
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * 
 */
make_get_header() ?>
		
	<div class="single">
	
		<div class="container">

			<div class="row">

				<div class="span12">

					<div class="results well">

						<h1>
							Search Results for
							<form role="search" method="get" class="form-search" id="searchform" action="<?php echo home_url( '/' ); ?>">
								<input type="text" class="input-medium search-query span3" value="" name="s" id="s" placeholder="<?php echo get_search_query(); ?>" />
								<input type="submit" class="btn" id="searchsubmit" value="Search" />
							</form>
						</h1>

					</div>

				</div>

			</div>

			<div class="row">

				<?php get_sidebar( 'search' ); ?>

				<div class="span8">

					<div class="search-results">

						<div class="heading">

							Sort By: Relevance | Newest | Oldest

						</div>

						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

							<article <?php post_class('media'); ?>>

								<a href="<?php get_permalink(); ?>" class="pull-left thumbnail">
									<?php the_post_thumbnail( 'attachment-thumb' ); ?>
								</a>
					
								<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
								
								<ul class="projects-meta">
									<?php if ( make_get_author( $post->ID ) ) : ?>
										<?php make_get_author( $post->ID ); ?>
									<?php endif ?>
									<li>Posted <span class="blue"><?php the_time('m/d/Y \@ g:i a'); ?></span></li>
									<li>Category <?php the_category(', '); ?></li>
									<li>Comments <a href="<?php the_permalink(); ?>#comments"><?php comments_number( '0', '1', '%' ); ?></a></li>
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

					</div>
					
					<ul class="pager">
							
						<li class="previous"><?php previous_posts_link('&larr; Previous Page'); ?></li>
						<li class="next"><?php next_posts_link('Next Page &rarr;'); ?></li>
					
					</ul>

					<?php else: ?>
					
						<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
					
					<?php endif; ?>
				</div>
					
					
			</div>

		</div>

	</div>

<?php get_footer(); ?>