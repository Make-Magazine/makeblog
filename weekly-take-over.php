<?php
	// Setup some variable goodness
	$title = make_get_cap_option( 'wto_title' );
	$subtitle = make_get_cap_option( 'wto_subtitle' );
	$post1 = make_get_cap_option( 'post1_id' );
	$post1_image = make_get_cap_option( 'post1_img' );
	$post2 = make_get_cap_option( 'post2_id' );
	$post2_image = make_get_cap_option( 'post2_img' );
	$post3 = make_get_cap_option( 'post3_id' );
	$post3_image = make_get_cap_option( 'post3_img' );
?>
<div class="waist weekly-takeover">

	<div class="container">

		<div class="row">

			<div class="span8">

				<div class="big-main-box">

					<div class="row">

						<div class="featured-left span4 paddme">
							<h1 class="weekly-title"><?php if ( ! empty( $title ) ) { echo esc_html( $title ); } ?></h1>
							<h2 class="weekly-sub-title"><?php if ( ! empty( $subtitle ) ) { echo esc_html( $subtitle ); } ?></h2>
							
							<?php if ( ! empty( $post1 ) ) : ?>
								<div class="featured-post boxed">
									<?php if ( empty( $post1_image ) ) : ?>
										<?php get_the_image( array( 'post_id' => absint( $post1 ), 'meta_key' => '', 'image_scan' => true, 'size' => 'weekly-takeover-main' ) ); ?>
									<?php else : ?>
										<img src="<?php echo esc_url( $post1_image ); ?>" width="268" height="248" />
									<?php endif; ?>
									<h3 class="featured-title"><a href="<?php echo get_permalink( absint( $post1 ) ); ?>"><?php echo esc_html( make_get_cap_option( 'post1_title' ) ); ?></a></h3>
								</div>
							<?php else : ?>
								<h3>No Posts set!</h3>
							<?php endif; ?>
						</div>

						<div class="featured-right span4 paddme">
							<div class="row">
								
								<?php if ( ! empty( $post2 ) ) : ?>
									<div class="span4 second-post boxed">
										<?php if ( empty( $post2_image ) ) : ?>
											<?php get_the_image( array( 'post_id' => absint( $post2 ), 'meta_key' => '', 'image_scan' => true, 'size' => 'weekly-takeover-secondary' ) ); ?>
										<?php else : ?>
											<img src="<?php echo esc_url( $post2_image ); ?>" width="250" height="163" />
										<?php endif; ?>
										<h3 class="featured-title"><a href="<?php echo get_permalink( absint( $post2 ) ); ?>"><?php echo esc_html( make_get_cap_option( 'post2_title' ) ); ?></a></h3>
									</div>
								<?php endif; ?>

								<?php if ( ! empty( $post3 ) ) : ?>
									<div class="span4 boxed">
										<?php if ( empty( $post3_image ) ) : ?>
											<?php get_the_image( array( 'post_id' => absint( $post3 ), 'meta_key' => '', 'image_scan' => true, 'size' => 'weekly-takeover-secondary' ) ); ?>
										<?php else : ?>
											<img src="<?php echo esc_url( $post3_image ); ?>" width="250" height="163" />
										<?php endif; ?>
										<h3 class="featured-title"><a href="<?php echo get_permalink( absint( $post3 ) ); ?>"><?php echo esc_html( make_get_cap_option( 'post3_title' ) ); ?></a></h3>
									</div>
								<?php endif; ?>

							</div>
						</div>

					</div>

				</div>
				
			</div>

			<div class="span4">

				<div class="home-ads">

					<!-- Beginning Sync AdSlot 2 for Ad unit header ### size: [[300,250]]  -->
					<div id='div-gpt-ad-664089004995786621-2'>
						<script type='text/javascript'>
							googletag.cmd.push(function(){googletag.display('div-gpt-ad-664089004995786621-2')});
						</script>
					</div>
					<!-- End AdSlot 2 -->

				</div>

				<div class="home-ads bottom">

					<!-- Beginning Sync AdSlot 2 for Ad unit header ### size: [[300,250]]  -->
					<div id='div-gpt-ad-664089004995786621-3'>
						<script type='text/javascript'>
							googletag.cmd.push(function(){googletag.display('div-gpt-ad-664089004995786621-3')});
						</script>
					</div>
					<!-- End AdSlot 2 -->

				</div>

			</div>

		</div>

	</div>

</div>