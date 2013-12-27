<div class="waist takeover">
	<div class="container">
		<div class="row">
			<div class="span8">

				<?php if ( ! empty( make_tc_takeover( 'banner' ) ) ) : ?>
					<div class="row-fluid">
						<div class="span12 banner">
							<?php if ( ! empty( make_tc_takeover( 'banner-url' ) ) ) : ?>
								<a href="<?php echo esc_url( make_tc_takeover( 'banner-url' ) ); ?>">
							<?php endif; ?>

								<img src="<?php echo esc_url( make_tc_takeover( 'make_banner_takeover' ) ); ?>" alt=""></a>

							<?php if ( ! empty( make_tc_takeover( 'banner-url' ) ) ) : ?>
								</a>
							<?php endif; ?>
						</div>
					</div>
				<?php endif; ?>

				<div class="row-fluid">
					<div class="span6">
						<div class="post-wrapper primary-post">
							<a href="">
								<img src="<?php echo esc_url( make_tc_takeover( 'featured-image' ) ); ?>" class="featured-image" alt="">
								<div class="content-wrapper">
									<h2><?php echo sanitize_title( make_tc_takeover( 'featured-title' ) ); ?></h2>
									<p><?php echo wp_filter_post_kses( make_tc_takeover( 'featured-excerpt' ) ); ?></p>
								</div>
							</a>
						</div>
					</div>
					<div class="span6">
						<div class="post-wrapper second-post small">
							<a href="#">
								<img src="http://baconmockup.com/283/144" class="featured-image" alt="">
								<div class="content-wrapper">
									<h2>This is the Title of the Really Cool Video Blog Post</h2>
								</div>
							</a>
						</div>
						<div class="post-wrapper third-post small">
							<a href="#">
								<img src="http://baconmockup.com/283/144" class="featured-image" alt="">
								<div class="content-wrapper">
									<h2>This is the Title of the Really Cool Video Blog Post</h2>
								</div>
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="span4">
				<div class="home-ads">
					<div id='div-gpt-ad-664089004995786621-2'>
						<script type='text/javascript'>
							googletag.cmd.push(function(){googletag.display('div-gpt-ad-664089004995786621-2')});
						</script>
					</div>
				</div>
				<div class="home-ads bottom">
					<div id='div-gpt-ad-664089004995786621-3'>
						<script type='text/javascript'>
							googletag.cmd.push(function(){googletag.display('div-gpt-ad-664089004995786621-3')});
						</script>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

