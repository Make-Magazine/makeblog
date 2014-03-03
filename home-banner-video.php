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
			background: linear-gradient( <?php echo esc_html( get_theme_mod( 'make_banner_video_top_gradient_color', '#bfe6fa' ) ); ?>, <?php echo esc_html( get_theme_mod( 'make_banner_video_bottom_gradient_color', '#fff' ) ); ?> );
			background-image: -moz-linear-gradient(top,  <?php echo esc_html( get_theme_mod( 'make_banner_video_top_gradient_color', '#bfe6fa' ) ); ?>, <?php echo esc_html( get_theme_mod( 'make_banner_video_bottom_gradient_color', '#fff' ) ); ?>); // FF 3.6+
			background-image: -webkit-gradient(linear, 0 0, 0 100%, from( <?php echo esc_html( get_theme_mod( 'make_banner_video_top_gradient_color', '#bfe6fa' ) ); ?>), <?php echo esc_html( get_theme_mod( 'make_banner_video_bottom_gradient_color', '#fff' ) ); ?> ) ); // Safari 4+, Chrome 2+
			background-image: -webkit-linear-gradient(top,  <?php echo esc_html( get_theme_mod( 'make_banner_video_top_gradient_color', '#bfe6fa' ) ); ?>, <?php echo esc_html( get_theme_mod( 'make_banner_video_bottom_gradient_color', '#fff' ) ); ?>); // Safari 5.1+, Chrome 10+
			background-image: -o-linear-gradient(top,  <?php echo esc_html( get_theme_mod( 'make_banner_video_top_gradient_color', '#bfe6fa' ) ); ?>, <?php echo esc_html( get_theme_mod( 'make_banner_video_bottom_gradient_color', '#fff' ) ); ?>); // Opera 11.10
			background-image: linear-gradient(to bottom,  <?php echo esc_html( get_theme_mod( 'make_banner_video_top_gradient_color', '#bfe6fa' ) ); ?>, <?php echo esc_html( get_theme_mod( 'make_banner_video_bottom_gradient_color', '#fff' ) ); ?>); // Standard, IE10
			background-repeat: repeat-x;
			filter: e(%("progid:DXImageTransform.Microsoft.gradient(startColorstr='%d', endColorstr='%d', GradientType=0)",argb( <?php echo esc_html( get_theme_mod( 'make_banner_video_top_gradient_color', '#bfe6fa' ) ); ?>), <?php echo esc_html( get_theme_mod( 'make_banner_video_bottom_gradient_color', '#fff' ) ); ?> ) )); // IE9 and down
		}
	</style>

	<div class="container pull-up">

		<div class="row-fluid">

			<div class="span12">

				<div class="pi pull-left">
					<a href="<?php echo esc_url( get_theme_mod( 'make_banner_video_contest_image_link', 'http://www.makershed.com/SearchResults.asp?Cat=227&Click=174124' ) ); ?>">
						<img src="<?php echo esc_url( get_theme_mod( 'make_banner_video_left_image' ) ); ?>" alt="Image">
					</a>
				</div>

				<div class="feat-post pull-left">
					
					<a href="<?php echo esc_url( get_theme_mod( 'make_banner_video_contest_image_link', 'http://www.makershed.com/SearchResults.asp?Cat=227&Click=174124' ) ); ?>">
						<img src="<?php echo esc_url( get_theme_mod( 'make_banner_video_top_image' ) ); ?>" alt="Image">
					</a>

					<div class="da-post">

						<div class="title pull-left">

							<h3><?php echo wp_kses_post( get_theme_mod( 'make_banner_video_post_type', 'Project:' ) ); ?></h3>

							<?php 
								$post_id = absint( get_theme_mod( 'make_banner_video_feat_post_id' ) );
								$the_post = get_post( $post_id );
								echo '<h1><a href="' . get_permalink( $post_id ) . '">' . wp_kses_post( get_theme_mod( 'make_banner_video_feat_post_title', $the_post->post_title ) ) . '</a></h1>';

							?>

							<h3 class="pink"><a href="<?php echo esc_url( get_theme_mod( 'make_banner_video_contest_image_link', 'http://www.makershed.com/SearchResults.asp?Cat=227&Click=174124' ) ); ?>">View all articles</a></h3>
							

						</div>

						<div class="video pull-right">

							<?php 

								if ( get_theme_mod( 'make_banner_video_youtube_url' ) ) {
									echo do_shortcode( '[youtube="' . esc_url( get_theme_mod( 'make_banner_video_youtube_url' ) ) . '&w=329"]' );
								} else {
									echo '<img src="' . esc_url( wpcom_vip_get_resized_remote_image_url( get_theme_mod( 'make_banner_video_featured_image' ), 329, 216 ) ) . '" alt="Image">';
								} 
							?>

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