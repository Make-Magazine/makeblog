<?php if ( make_has_takeover_mod( 'make_banner_takeover' ) ) : ?>
	<div class="home-banner" style="/* background-image: url( <?php echo esc_url( get_theme_mod( 'make_banner_takeover' ) ); ?> ); background-position: center top; */" >
<?php else : ?>
	<div class="home-banner">
<?php endif; ?>

	<div id="div-gpt-ad-664089004995786621-7" class="banner-canvas">
		<script type='text/javascript'>
			googletag.cmd.push(function(){googletag.display('div-gpt-ad-664089004995786621-7')});
		</script>
	</div>

	<div class="container pull-up">

		<div class="row">

			<div class="span5 offset7">

				<div class="top-image">

					<?php if ( make_has_takeover_mod( 'make_banner_top_image' ) ) : ?>
						<img src="<?php echo esc_url( get_theme_mod( 'make_banner_top_image' ) ); ?>" alt="">
					<?php endif; ?>

				</div>

				<div class="feat-post">
					<?php 
						if ( make_has_takeover_mod( 'make_banner_feat_post_id' ) ) {
							$post_id = absint( get_theme_mod( 'make_banner_feat_post_id' ) );
							$the_post = get_post( $post_id );
							echo '<a href="' . get_permalink( $post_id ) . '">';
							echo get_the_post_thumbnail( $post_id, 'archive-thumb', array('class' => 'pull-left' ) );
							echo '</a>';
							$title = get_theme_mod( 'make_banner_feat_post_title', get_the_title( $the_post ) );
							echo '<h3><a href="' . get_permalink( $post_id ) . '">' . wp_kses_post( $title ) . '</a></h3>';
							echo Markdown( wp_trim_words( strip_shortcodes( get_theme_mod( 'make_banner_feat_post_blurb',  $the_post->post_content ) ), 14, '...' ) . ' <a href="' . get_permalink( $post_id ) . '">MORE</a>');
						}

						if ( make_has_takeover_mod( 'make_banner_feat_post_slug' ) ) {
							$link = make_get_category_url( get_theme_mod( 'make_banner_feat_post_slug'  ), 'post_tag', 'slug' );
							echo '<h4><a class="red" href="' . esc_url( $link ) . '">View all articles</a></h4>';
						}
					?>

					<div class="clearfix"></div>				

				</div>

				<div class="call-out">

					<?php 
						$link = get_theme_mod( 'make_banner_call_out_link' );
						$title = get_theme_mod( 'make_banner_call_out_title' );
						if ( !empty( $link ) && !empty( $title ) ) {
							echo '<h2><a href="' . esc_url( $link ) . '">' . wp_kses_post( $title ) . '</a></h2>';
						}
					?>

					<?php

						if ( make_has_takeover_mod( 'make_banner_feat_post_slug' ) ) {
							echo '<ul>';
							$args = array(
								'tag'				=> sanitize_title( get_theme_mod( 'make_banner_feat_post_slug' ) ),
								'posts_per_page'  	=> absint( get_theme_mod( 'make_banner_feat_post_number', 4 ) ),
								'no_found_rows' 	=> true,
								'post_type' 		=> array( 'post', 'projects', 'video', 'craft', 'magazine' ),
								'order'				=> sanitize_sql_orderby( get_theme_mod( 'make_banner_post_order', 'DESC' ) ),
							);
							
							$blurbs = new WP_Query( $args );

							while ( $blurbs->have_posts() ) : $blurbs->the_post();
								echo '<li><h4><a href="'.get_permalink().'">';
								echo wp_trim_words( ( get_the_title() ), 8 );
								echo '</a></h4></li>';
							endwhile;

							// Reset Post Data
							wp_reset_postdata();
						}
					?>

				</div>

			</div>

		</div>

	</div>

</div>