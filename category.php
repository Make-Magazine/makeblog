<?php
/**
 * The template for displaying the category archives.
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Jake Spurlock <jspurlock@makermedia.com>
 *
 */
$type = get_query_var( 'post_type' );
$tag = get_query_var( 'tag' );

if ($type == 'projects') {
	include_once 'archive-projects-category.php';
	return;
}

// Setup our default list of post types
$post_types = array( 'post', 'video', 'projects', 'review', 'craft', 'magazine' );

get_header(); ?>

	<div class="category-top">

		<div class="container">

			<div class="row">

				<?php do_action( 'category_top' ); ?>

				<?php echo '<div class="span12">'; ?>
				
					<h1 class="jumbo"><?php single_cat_title('', true); ?></h1>

					<?php //echo Markdown( strip_tags( category_description() ) ); ?>

					<?php make_child_category_list(); ?>

			</div>

		</div>

	</div>

	</div>

	<div class="grey">

		<div class="container">

			<div class="row">

				<div class="span8">

					<?php
						echo make_carousel( array(
							'category__in' => get_queried_object_id(), // Likely the queried object ID
							'title'        => 'Featured in ' . get_queried_object()->name,
							'limit'        => 2,
							'tag'          => 'Featured',
							'post_type'	   => ( ! empty( $type ) && in_array( $type, $post_types ) ) ? $type : array( 'post', 'video','projects', 'review', 'craft', 'magazine' )
					) ); ?>

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
						echo make_carousel( array(
							'category__in'   => get_queried_object_id(), // Likely the queried object ID
							'title'          => 'New in ' . get_queried_object()->name,
							'posts_per_page' => 32,
						) );
					?>

				</div>

			</div>

			<div class="row">

				<div class="span12">

					<?php echo make_shopify_featured_products_slider(); ?>

				</div>

			</div>

		</div>

	</div>

	<?php

		$children = make_children( get_queried_object_id() );
		if ($children) {
			foreach ($children as $child => $category) {
	?>

	<div class="grey child">

		<div class="container">

			<div class="row">

				<div class="span10">

					<h2 id="<?php echo esc_attr( $category->slug ); ?>" class="heading"><a href="<?php echo get_term_link( $category ); ?>">Latest in <?php echo esc_html( $category->name ); ?></a></h2>

				</div>

				<div class="span2">

					<?php echo '<p class="pull-right"><a href="' . get_term_link( $category ) . '" class="all">View All</p>'; ?>

				</div>

			</div>

			<div class="row">

				<div class="span6">

					<div class="video-box">

						<?php
							$the_query = new WP_Query( array(
								'post_type'      => 'video',
								'posts_per_page' => 1,
								'no_found_rows'  => true,
								'category__in'   => $category->term_id,
							) );

							while ( $the_query->have_posts() ) : $the_query->the_post();
								$link = get_post_custom_values( 'Link' , get_the_ID() );
								echo do_shortcode('[youtube='. esc_url( $link[0] ) .'&amp;w=442]');
								the_title( '<h4>' . '<a href="' . get_permalink() . '">', '</a></h4>' );
								echo '<p>' . wp_trim_words( strip_shortcodes( $post->post_content ), 20, '...' ) . '</p>';
							endwhile;

							// Reset Post Data
							wp_reset_postdata();

						?>

						<div class="clearfix"></div>

					</div>

				</div>

				<div class="span6">


					<?php
						make_post_loop( array(
							'title'          => 'Latest ' . $category->name . ' Projects',
							'posts_per_page' => 2,
							'post_type'      => 'projects',
							'category__in'   => $category->term_id,
							'orderby'        => 'date',
							'order'          => 'dsc',
						) );
					?>

				</div>

			</div>

			<div class="row">

				<div class="span12">

					<?php
						echo make_carousel( array(
							'category__in' => $category->term_id,
							'title'        => null
						) );
					?>

				</div>

			</div>

		</div>

	</div>

	<?php } }
	else { ?>

	<?php
		$qo_id   = get_queried_object_id();
		$qo_name = get_cat_name( $qo_id );
	?>

	<div class="grey child">

		<div class="container">

			<div class="row">

				<div class="span12">

					<?php
						echo make_carousel( array(
							'cat'       => $qo_id,
							'title'     => $qo_name . ' Videos',
							'post_type' => 'video'
						) );
					?>

				</div>

			</div>


			<div class="row">

				<div class="span12">

					<?php
						echo make_carousel( array(
							'cat'       => $qo_id,
							'title'     => $qo_name . ' Projects',
							'post_type' => 'projects'
						) );
					?>

				</div>

			</div>

			<div class="row">

				<div class="span12">

					<?php
						echo make_carousel( array(
							'cat'       => $qo_id,
							'title'     => $qo_name . ' On the Blog',
							'post_type' => 'post'
						) );
					?>

				</div>

			</div>

			<div class="row">

				<div class="span12">

					<?php
						echo make_carousel( array(
							'cat'       => $qo_id,
							'title'     => $qo_name . ' Articles',
							'post_type' => 'magazine'
						) );
					?>

				</div>

			</div>

			<?php
				if ( is_category( array( '157499811', '5094' ) ) ) { ?>

					<div class="row">

						<div class="span12">

							<?php
								echo make_carousel( array(
									'cat'       => $qo_id,
									'title'     => $qo_name . ' Reviews',
									'post_type' => 'review'
								) );
							?>

						</div>

					</div>
			</div>
			<?php } ?>


<?php
}
get_footer();
