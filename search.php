<?php
/**
 * Index Page
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * 
 */
global $wp_query;
get_header(); ?>
		
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

							<!-- Sort By: Relevance | Newest | Oldest -->
							<h3>Search Results</h3>

						</div>

						<div class="count">

							<div class="pull-left">

								<?php echo make_search_count( $wp_query ); ?>

							</div>

							<div class="pull-right">

								<?php echo make_search_pagination( $wp_query ); ?>

							</div>

							<div class="clearfix"></div>

						</div>

						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

							<article <?php post_class('media'); ?>>

								<a href="<?php the_permalink(); ?>" class="pull-left">
									<?php 
										$args = array(
											'image_scan' => true,
											'size' => 'search-thumb',
											'image_class' => 'thumbnail',
											'link_to_post' => false,
											);
										get_the_image( $args ); 
									?>
								</a>

								<div class="media-body">

									<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
									
									<div class="meta"><?php the_time('m/d/Y \@ g:i a'); ?> | <?php echo ucfirst( make_post_type_better_name( get_post_type() ) ); ?></div>

									<div class="media-body">
										<p><?php echo wp_trim_words( get_the_excerpt(), 16, '...' ); ?> <a href="<?php the_permalink(); ?>"></a></p>
									</div>

								</div>
							
							</article>

						<?php endwhile; ?>

						<div class="count bottom">

							<div class="pull-left">

								<?php echo make_search_count( $wp_query ); ?>

							</div>

							<div class="pull-right">

								<?php echo make_search_pagination( $wp_query ); ?>

							</div>

							<div class="clearfix"></div>

						</div>

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