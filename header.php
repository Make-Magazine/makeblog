<!DOCTYPE html>
<html lang="en" xmlns:fb="http://ogp.me/ns/fb#">
	<head>
		<meta charset="utf-8">
		<title><?php echo make_generate_title_tag(); ?></title>
		<meta name="description" content="<?php echo esc_attr( make_generate_description() ); ?>" />
		<meta name="twitter:widgets:csp" content="on">
		<meta name="p:domain_verify" content="c4e1096cb904ca6df87a2bb867715669" >
		<meta name="google-site-verification" content="tjgq9UGR8WCMZI_40j_B5wda_oVYqKyFtQW547LzMgQ" />
		<meta property="fb:admins" content="1612614584" />
		<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<!-- Le fav and touch icons -->
		<link rel="shortcut icon" href="http://1.gravatar.com/blavatar/dab43acfe30c0e28a023bb3b7a700440?s=14">

		<!-- Begin Inspectlet Embed Code -->
		<script type="text/javascript" id="inspectletjs">
			window.__insp = window.__insp || [];
			__insp.push(['wid', 510463564]);
			(function() {
				function __ldinsp(){var insp = document.createElement('script'); insp.type = 'text/javascript'; insp.async = true; insp.id = "inspsync"; insp.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://cdn.inspectlet.com/inspectlet.js'; var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(insp, x); }
				if (window.attachEvent){
					window.attachEvent('onload', __ldinsp);
				}else{
					window.addEventListener('load', __ldinsp, false);
				}
			})();
		</script>
		<!-- End Inspectlet Embed Code -->

		<!-- Pingdom for site monitoring -->
		<script>
		var _prum = [['id', '53fcea2fabe53d341d4ae0eb'],
		            ['mark', 'firstbyte', (new Date()).getTime()]];
		(function() {
		    var s = document.getElementsByTagName('script')[0]
		      , p = document.createElement('script');
		    p.async = 'async';
		    p.src = '//rum-static.pingdom.net/prum.min.js';
		    s.parentNode.insertBefore(p, s);
		})();
		</script>

		<?php wp_head(); ?>

		<?php get_template_part('dfp'); ?>

		<script type="text/javascript">
			dataLayer = [];
		</script>
	</head>

	<body <?php body_class(); ?>
		<!-- Google Universal Analytics -->
		<script type="text/javascript">
			  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			  ga('create', 'UA-51157-1', 'auto');
			  // Optimizely Universal Analytics Integration
			  window.optimizely = window.optimizely || [];
			  window.optimizely.push("activateUniversalAnalytics");
			  ga('require', 'displayfeatures');
			  ga('send', 'pageview', {
			 'page': location.pathname + location.search  + location.hash
			  });
		</script>
		
		<?php if ( is_404() ) : // Load this last. ?>
			 <script>
			ga('send', 'event', '404', document.location.pathname + document.location.search, document.referrer);
			</script>
		<?php endif; ?>

		<!-- Google Tag Manager  Maker Shed-->
		<noscript>
			<iframe src="//www.googletagmanager.com/ns.html?id=GTM-WR8NLB" height="0" width="0" style="display:none;visibility:hidden"></iframe>
		</noscript>
		<script>
			(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
			new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
			j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
			'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
			})(window,document,'script','dataLayer','GTM-WR8NLB');
		</script>
		<!-- End Google Tag Manager -->
		
		<!-- Google Tag Manager -->
			<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-PC5R77"
			height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
			<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
			new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
			j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
			'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
			})(window,document,'script','dataLayer','GTM-PC5R77');</script>
		<!-- End Google Tag Manager  -->

		<div class="container hidden-print">
			<div class="row">
				<div id="div-gpt-ad-664089004995786621-1" class="text-center">
					<script type='text/javascript'>
						googletag.cmd.push(function(){googletag.display('div-gpt-ad-664089004995786621-1')});
					</script>
				</div>
			</div>
		</div>
		<header class="top-navigation-wrapper">
			<div class="main-header">
				<div class="container">
					<div class="row">
						<div class="logo span2">
    						<?php if ( is_front_page() || is_home() ) : ?>
								<h1 title="Make Magazine - <?php echo bloginfo( 'description' ); ?>"><a href="<?php echo home_url(); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/make-logo.png"  alt="Tech-savvy DIY Enthusiasts Innovative Projects and Ideas" /></a></h1>
							<?php else : ?>
								<h2 title="Make Magazine - <?php echo bloginfo( 'description' ); ?>"><a href="<?php echo home_url(); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/make-logo.png"  alt="Tech-savvy DIY Enthusiasts Innovative Projects and Ideas" /></a></h2>
							<?php endif; ?>
						</div>
						<nav role="navigation" class="span7 site-navigation primary-navigation hidden-print">
							<?php
								wp_nav_menu( array(
									'theme_location'  => 'make-primary',
									'container'       => false,
									'menu_class'      => 'nav menu-primary-nav ga-nav clearfix',
								) );
							?>
						</nav>


						<div class="additional-content hidden-print">
							<form action="<?php echo home_url(); ?>" class="search-make open">
								<input type="text" class="search-field" name="s" placeholder="Search" />
								<input type="submit" class="open submit" value="" />
							</form>
							<div class="clearfix"></div>
							<div class="hdr-sub-ad-01" >
								<a href="https://www.pubservice.com/MK/subscribe.aspx?PC=MK&amp;PK=M3BMZA"><img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/img/hdr-mag-sub-01.jpg"  alt="Subscribe to Make Magazine Today!" /></a>
							</div>
							
						</div>
						<div class="login-wrapper">
								<a href="<?php echo esc_url( home_url( '/contribute/' ) ); ?>" class="user-creds profile">Share Your Project</a>
							</div>
					</div>
				</div>
			</div>
			<div class="secondary-header hidden-print">
				<div class="container">
					<div class="row">
						<nav class="span12 site-navigation secondary-navigation">
							<?php
								wp_nav_menu( array(
									'theme_location' => 'make-secondary',
									'container'		 => false,
									'menu_class' 	 => 'nav menu-secondary-nav ga-nav clearfix',
								) );
							?>
						</nav>
					</div>
				</div>
			</div>
			<div class="makershed-banner">
				<div class="container">
					<div class="row">
						<div class="span10">
							<a href="http://www.makershed.com?utm_source=makezine.com&utm_medium=ads&utm_term=Shop+Now&utm_campaign=makershed+banner" title="Find all your DIY electronics in the MakerShed. 3D Printing, Kits, Arduino, Raspberry Pi, Books &amp; more!">
								<p>Find your DIY supplies in the Maker Shed &rarr; Kits, Books, Components, 3D Printers, Arduino, Raspberry Pi, More!</p>
							</a>
						</div>
						<div class="span2">
							<a href="http://www.makershed.com?utm_source=makezine.com&utm_medium=ads&utm_term=Shop+Now&utm_campaign=makershed+banner" title="Find all your DIY electronics in the MakerShed. 3D Printing, Kits, Arduino, Raspberry Pi, Books &amp; more!"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/maker-shed-banner-02.png" alt="Find all your DIY electronics in the MakerShed. 3D Printing, Kits, Arduino, Raspberry Pi, Books &amp; more!" /></a>
						</div>
					</div>
				</div>
			</div>
		</header>

		<?php if ( ! is_page_template( 'page-home.php' ) ) :
			if ( ! is_post_type_archive() ) :
				if ( ! is_author() ) :
					if ( ! is_page( 'weekendprojects' ) ) : ?>

		<div class="canvas-ad">
			<div id="div-gpt-ad-664089004995786621-7" class="banner-canvas">
				<script type='text/javascript'>
					googletag.cmd.push(function(){googletag.display('div-gpt-ad-664089004995786621-7')});
				</script>
			</div>
		</div>

		<?php endif; endif; endif; endif; ?>
