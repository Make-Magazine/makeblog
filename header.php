<!DOCTYPE html>
<html lang="en" xmlns:fb="http://ogp.me/ns/fb#">
	<head>
		<meta charset="utf-8">
		<title><?php bloginfo('name'); ?> | <?php is_home() || is_front_page() ? bloginfo('description') : wp_title(''); ?></title>
		<meta name="description" content="<?php if ( is_single() ) {
				echo wp_trim_words( strip_shortcodes( $post->post_content ), 20 );
			} else {
				bloginfo('name'); echo " - "; bloginfo('description');
			}
			?>" />

		<meta name="p:domain_verify" content="c4e1096cb904ca6df87a2bb867715669" >
		<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<?php get_template_part('dfp'); ?>

		<!-- Le fav and touch icons -->
		<link rel="shortcut icon" href="http://1.gravatar.com/blavatar/dab43acfe30c0e28a023bb3b7a700440?s=14">
		<script type="text/javascript" src="http://use.typekit.com/fzm8sgx.js"></script>
		<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
		<script type="text/javascript">

		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-51157-1']);
		_gaq.push(['_trackPageview']);

		(function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();

		</script>

		<?php if ( is_page( array( 'home-page-include', 'home-page', 'home', 116357 ) ) ) : ?>

			<link rel="canonical" href="http://makezine.com/" />
			<link rel="alternate" type="application/rss+xml" title="RSS" href="http://feeds.feedburner.com/makezineonline" />

		<?php endif; ?>

		<?php wp_head(); ?>

	</head>

	<body <?php body_class(); ?>>

		<div class="navbar navbar-inverse navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
					<div class="pull-left">
						<ul class="nav">
							<li class="active"><a href="http://makezine.com">MAKE</a></li>
							<li class=""><a href="http://blog.makezine.com">Blog</a></li>
							<li class=""><a href="http://makezine.com/magazine">Magazine</a></li>
							<li class=""><a href="http://makerfaire.com">Maker Faire</a></li>
							<li class=""><a href="http://makeprojects.com">Make: Projects</a></li>
							<li class=""><a href="http://makershed.com">Maker Shed</a></li>
							<li class=""><a href="http://kits.makezine.com">Kits</a></li>
						</ul>
					</div>
					<div class="pull-right">
						<form action="http://blog.makezine.com/search/" class="form navbar-search">
							<input type="text" class="span2 search-query" style="width:126px;" name="q" placeholder="" />
							<input type="submit" class="btn btn-primary" style="height:28px" value="Search" />
						</form>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>

		<div class="fix">

			<div id="header">
				
				<div class="container">
					
					<div class="row">

						<div class="span topad">
							
							<!-- Beginning Sync AdSlot 1 for Ad unit header ### size: [[728,90]]  -->
							<div id='div-gpt-ad-664089004995786621-1'>
								<script type='text/javascript'>
									googletag.cmd.push(function(){googletag.display('div-gpt-ad-664089004995786621-1')});
								</script>
							</div>
							<!-- End AdSlot 1 -->
							
						</div>

						<div class="biggins">

							<?php
								
								$ad_query = new WP_Query( array(
									'post_type' => 'house-ads',
									'posts_per_page' => 20,
									'fields' => 'ids',
									'no_found_rows' => true,
								) );
								$ad_ids = $ad_query->get_posts();

								if ( ! empty( $ad_ids ) ) :
									shuffle( $ad_ids );
									$ad_id = array_shift( $ad_ids );
									$post = get_post( $ad_id );

									if ( $post ) : setup_postdata( $post );
										echo '<a href="'. esc_url( get_post_meta( $post->ID, 'LinkURL', true ) ).'">';
										the_post_thumbnail('house-ad');
										echo '</a>';
									endif;
								endif;

								// Reset Post Data
								wp_reset_postdata();

							?>

						</div>

					</div>

					<div class="clear"></div>

					<h1><a href="http://makezine.com/"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/make.png" alt="MAKE" title="MAKE" /></a></h1>

					<ul class="navi">
						
						<li class="active"><a href="http://blog.makezine.com">Blog</a></li>
						<li><a href="http://makezine.com/magazine">Magazine</a></li>
						<li><a href="http://makeprojects.com">Projects</a></li>
						<li><a href="http://kits.makezine.com">Reviews</a></li>
						<li><a href="http://www.makershed.com/?Click=19208">Shop</a></li>
					</ul>

				</div>

			</div>

			<div class="header-bottom">

				<div class="container">

					<div class="topics">

						<h5 class="blue">Hot&nbsp;Topics:</h5>

						<?php echo wp_kses_post( stripslashes( make_get_cap_option( 'hot_topics' ) ) ); ?>

					</div>

					<div class="pull-right">

						<a href="http://blog.makezine.com/topics"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/see_all_topics.png" alt="See All Topics" class="see pull-right" /></a><!--  -->

					</div>

				</div>

			</div>

		</div>
