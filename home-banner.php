<?php if ( make_has_takeover_mod( 'make_banner_takeover' ) ) : ?>
	<div class="banner" style="background-image: url( <?php echo esc_url( get_theme_mod( 'make_banner_takeover' ) ); ?> ); background-position: center top;" onclick="location.href='http://google.com'">
<?php else : ?>
	<div class="banner" style="background-image: url( 'https://cdn.makezine.com/make/banner/Connected-Home-Package3-BG.jpg' );">
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
					<?php if ( make_has_takeover_mod( 'make_banner_feat_post_id' ) ) : ?>
						<?php
							$post_id = absint( get_theme_mod( 'make_banner_feat_post_id' ) );
							$the_post = get_post( $post_id );
							echo get_the_post_thumbnail( $post_id, 'archive-thumb', array('class' => 'pull-left' ) );
							$title = get_theme_mod( 'make_banner_feat_post_title', get_the_title( $the_post ) );
							echo '<h3>' . wp_kses_post( $title ) . '</h3>';
							echo Markdown( wp_trim_words( strip_shortcodes( get_theme_mod( 'make_banner_feat_post_blurb',  $the_post->post_content ) ), 14, '...' ) . ' <a href="' . get_permalink( $post_id ) . '">MORE</a>');

						?>
					<?php endif; ?>
					<div class="clearfix"></div>				

				</div>

			</div>

		</div>

	</div>

</div>