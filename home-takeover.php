<div class="waist takeover">
	<div class="container">
		<div class="row-fluid">
			<div class="span8 takeover-wrapper">
	
				<?php if ( make_has_takeover_mod( 'make_banner_takeover' ) ) : ?>
					<div class="row-fluid">
						<div class="span12 banner">
							<?php if ( make_has_takeover_mod( 'make_banner_url_takeover' ) ) : ?>
								<a href="<?php esc_url( make_get_takeover_mod( 'make_banner_url_takeover' ) ); ?>">
							<?php endif; ?>

								<img src="<?php esc_url( make_get_takeover_mod( 'make_banner_takeover' ) ); ?>" alt="Makezine CES Consumer Electronics Show banner"></a>

							<?php if ( make_has_takeover_mod( 'make_banner_url_takeover' ) ) : ?>
								</a>
							<?php endif; ?>
						</div>
					</div>
				<?php endif; ?>

				<div class="row-fluid">
					<div class="span6">
						<?php if ( make_has_takeover_mod( 'make_featured_post_url' ) || make_has_takeover_mod( 'make_featured_post_image' ) ) : ?>
							<div class="post-wrapper primary-post">
								<a href="<?php esc_url( make_get_takeover_mod( 'make_featured_post_url' ) ); ?>">
									<img src="<?php esc_url( make_get_takeover_mod( 'make_featured_post_image' ) ); ?>" width="303" height="288" class="featured-image" alt="<?php esc_attr( make_get_takeover_mod( 'make_featured_post_title' ) ); ?>">
									<div class="content-wrapper">
										<h2><?php esc_html( make_get_takeover_mod( 'make_featured_post_title' ) ); ?></h2>
										<p><?php wp_kses_post( make_get_takeover_mod( 'make_featured_post_excerpt' ) ); ?></p>
									</div>
								</a>
							</div>
						<?php endif; ?>
					</div>
					<div class="span6">
						<?php if ( make_has_takeover_mod( 'make_topright_post_url' ) || make_has_takeover_mod( 'make_topright_post_image' ) ) : ?>
							<div class="post-wrapper second-post small">
								<a href="<?php esc_url( make_get_takeover_mod( 'make_topright_post_url' ) ); ?>">
									<img src="<?php esc_url( make_get_takeover_mod( 'make_topright_post_image' ) ); ?>" width="283" height="144" class="featured-image" alt="<?php esc_attr( make_get_takeover_mod( 'make_topright_post_title' ) ); ?>">
									<div class="content-wrapper">
										<h2><?php esc_html( make_get_takeover_mod( 'make_topright_post_title' ) ); ?></h2>
									</div>
								</a>
							</div>
						<?php endif; ?>

						<?php if ( make_has_takeover_mod( 'make_bottomright_post_url' ) || make_has_takeover_mod( 'make_bottomright_post_image' ) ) : ?>
							<div class="post-wrapper third-post small">
								<a href="<?php esc_url( make_get_takeover_mod( 'make_bottomright_post_url' ) ); ?>">
									<img src="<?php esc_url( make_get_takeover_mod( 'make_bottomright_post_image' ) ); ?>" width="283" height="144" class="featured-image" alt="<?php esc_attr( make_get_takeover_mod( 'make_bottomright_post_title' ) ); ?>">
									<div class="content-wrapper">
										<h2><?php esc_html( make_get_takeover_mod( 'make_bottomright_post_title' ) ); ?></h2>
									</div>
								</a>
							</div>
						<?php endif; ?>
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

