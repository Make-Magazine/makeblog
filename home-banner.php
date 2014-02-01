<?php if ( make_has_takeover_mod( 'make_banner_takeover' ) ) : ?>
	<div class="banner" style="/* background-image: url( <?php echo esc_url( get_theme_mod( 'make_banner_takeover' ) ); ?> ); background-position: center top; */" >
<?php else : ?>
	<div class="banner">
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
							echo get_the_post_thumbnail( $post_id, 'archive-thumb', array('class' => 'pull-left' ) );
							$title = get_theme_mod( 'make_banner_feat_post_title', get_the_title( $the_post ) );
							echo '<h3>' . wp_kses_post( $title ) . '</h3>';
							echo Markdown( wp_trim_words( strip_shortcodes( get_theme_mod( 'make_banner_feat_post_blurb',  $the_post->post_content ) ), 14, '...' ) . ' <a href="' . get_permalink( $post_id ) . '">MORE</a>');
						}

						if ( make_has_takeover_mod( 'make_banner_feat_post_slug' ) ) {
							$link = make_get_category_url( get_theme_mod( 'make_banner_feat_post_slug'  ) );
							echo '<h4><a class="red" href="' . esc_url( $link ) . '">View all articles</a></h4>';
						}
					?>

					<div class="clearfix"></div>				

				</div>

				<div class="call-out">



				</div>

			</div>

		</div>

	</div>

</div>