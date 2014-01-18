<div class="canvas">

	<div class="container">

	<?php if ( make_has_takeover_mod( 'make_canvas_takeover' ) ) : ?>
		<video autoplay loop poster="<?php echo esc_url( get_theme_mod( 'make_canvas_takeover' ) ); ?>" id="bgvid">
			<source src="http://cdn.makezine.com/make/cover/drone.webm">
			<source src="http://cdn.makezine.com/make/cover/drone.mp4">
			<source src="http://cdn.makezine.com/make/cover/drone.ogv">
		</video>
	<?php endif; ?>

		<div class="blur">
			
			<div class="heading">
				<!-- Bring in the big image -->
				<img alt="Flight of the Drones Week" src="<?php echo get_stylesheet_directory_uri(); ?>/img/flight-of-the-drones.png" class="">
			</div>

			<?php if ( make_has_takeover_mod( 'make_canvas_html_box' ) ) : ?>
				<?php echo wp_kses_post( get_theme_mod( 'make_canvas_html_box' ) ); ?>
			<?php endif; ?>

		</div>

	</div>

</div>