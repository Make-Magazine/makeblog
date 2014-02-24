<?php if ( make_has_takeover_mod( 'make_banner_video_takeover' ) ) : ?>
	<div class="home-banner-video" style="/*background-image: url( <?php echo esc_url( get_theme_mod( 'make_banner_video_takeover' ) ); ?> ); background-position: center top;*/" >
<?php else : ?>
	<div class="home-banner-video">
<?php endif; ?>

	<div id="div-gpt-ad-664089004995786621-7" class="banner-canvas">
		<script type='text/javascript'>
			googletag.cmd.push(function(){googletag.display('div-gpt-ad-664089004995786621-7')});
		</script>
	</div>

	<style type="text/css" media="screen">
		/* Wouldn't LESS be nice... */
		.pull-up {
			background: linear-gradient( <?php echo sanitize_hex_color_no_hash( get_theme_mod( 'make_banner_video_top_gradient_color', '#bfe6fa' ) ); ?>, <?php echo sanitize_hex_color_no_hash( get_theme_mod( 'make_banner_video_bottom_gradient_color', '#fff' ) ); ?> );
			background-image: -moz-linear-gradient(top,  <?php echo sanitize_hex_color_no_hash( get_theme_mod( 'make_banner_video_top_gradient_color', '#bfe6fa' ) ); ?>, <?php echo sanitize_hex_color_no_hash( get_theme_mod( 'make_banner_video_bottom_gradient_color', '#fff' ) ); ?>); // FF 3.6+
			background-image: -webkit-gradient(linear, 0 0, 0 100%, from( <?php echo sanitize_hex_color_no_hash( get_theme_mod( 'make_banner_video_top_gradient_color', '#bfe6fa' ) ); ?>), <?php echo sanitize_hex_color_no_hash( get_theme_mod( 'make_banner_video_bottom_gradient_color', '#fff' ) ); ?> ) ); // Safari 4+, Chrome 2+
			background-image: -webkit-linear-gradient(top,  <?php echo sanitize_hex_color_no_hash( get_theme_mod( 'make_banner_video_top_gradient_color', '#bfe6fa' ) ); ?>, <?php echo sanitize_hex_color_no_hash( get_theme_mod( 'make_banner_video_bottom_gradient_color', '#fff' ) ); ?>); // Safari 5.1+, Chrome 10+
			background-image: -o-linear-gradient(top,  <?php echo sanitize_hex_color_no_hash( get_theme_mod( 'make_banner_video_top_gradient_color', '#bfe6fa' ) ); ?>, <?php echo sanitize_hex_color_no_hash( get_theme_mod( 'make_banner_video_bottom_gradient_color', '#fff' ) ); ?>); // Opera 11.10
			background-image: linear-gradient(to bottom,  <?php echo sanitize_hex_color_no_hash( get_theme_mod( 'make_banner_video_top_gradient_color', '#bfe6fa' ) ); ?>, <?php echo sanitize_hex_color_no_hash( get_theme_mod( 'make_banner_video_bottom_gradient_color', '#fff' ) ); ?>); // Standard, IE10
			background-repeat: repeat-x;
			filter: e(%("progid:DXImageTransform.Microsoft.gradient(startColorstr='%d', endColorstr='%d', GradientType=0)",argb( <?php echo sanitize_hex_color_no_hash( get_theme_mod( 'make_banner_video_top_gradient_color', '#bfe6fa' ) ); ?>), <?php echo sanitize_hex_color_no_hash( get_theme_mod( 'make_banner_video_bottom_gradient_color', '#fff' ) ); ?> ) )); // IE9 and down
		}
	</style>

	<div class="container pull-up">

		<div class="row-fluid">

			<div class="span12">

				<div class="pi pull-left">

					<img src="<?php echo esc_url( get_theme_mod( 'make_banner_video_left_image' ) ); ?>" alt="Image">

				</div>

				<div class="feat-post pull-left">
					
					<img src="<?php echo esc_url( get_theme_mod( 'make_banner_video_top_image' ) ); ?>" alt="Image">

					<div class="da-post">

						<div class="title pull-left">

							<h3><?php echo wp_kses_post( make_post_type_better_name( get_post_type( get_theme_mod( 'make_banner_video_feat_post_id' ) ) ) ); ?>:</h3>

							<?php 
								$post_id = absint( get_theme_mod( 'make_banner_video_feat_post_id' ) );
								$the_post = get_post( $post_id );
								echo '<h1><a href="' . get_permalink( $post_id ) . '">' . wp_kses_post( get_theme_mod( 'make_banner_video_feat_post_title', $the_post->post_title ) ) . '</a></h1>';

							?>

						</div>

						<div class="video pull-right">

							<?php echo do_shortcode( '[youtube="' . esc_url( get_theme_mod( 'make_banner_video_youtube_url' ) ) . '&w=329"]' ); ?>

						</div>

						<div class="clearfix"></div>

					</div>

					<div class="contest">

						<a href="<?php echo esc_url( get_theme_mod( 'make_banner_video_contest_image_link', 'http://www.makershed.com/SearchResults.asp?Cat=227&Click=174124' ) ); ?>">
							<img src="<?php echo esc_url( get_theme_mod( 'make_banner_video_contest_image' ) ); ?>" alt="Enter Contest">
						</a>

					</div>

				</div>

				<div class="clearfix"></div>

			</div>

		</div>

	</div>

</div>