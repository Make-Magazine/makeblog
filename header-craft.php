<!DOCTYPE html>
<html lang="en" xmlns:fb="http://ogp.me/ns/fb#">
	<head>
		<meta charset="utf-8">
		<meta name="google-site-verification" content="tjgq9UGR8WCMZI_40j_B5wda_oVYqKyFtQW547LzMgQ" />
		<title><?php echo make_generate_title_tag(); ?></title>
		<meta name="description" content="<?php echo esc_attr( make_generate_description() ); ?>" />
		<meta name="twitter:widgets:csp" content="on">
		<meta name="p:domain_verify" content="c4e1096cb904ca6df87a2bb867715669" >
		<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<!-- Le fav and touch icons -->
		<link rel="shortcut icon" href="http://1.gravatar.com/blavatar/dab43acfe30c0e28a023bb3b7a700440?s=14">

		<?php if ( is_page( array( 'home-page-include', 'home-page', 'home', 116357 ) ) ) : ?>

			<link rel="canonical" href="http://makezine.com/" />
			<link rel="alternate" type="application/rss+xml" title="RSS" href="http://feeds.feedburner.com/makezineonline" />

		<?php endif; ?>

		<?php if ( is_page( 313086 ) ) 
			echo '<meta property="og:image" content="http://makezineblog.files.wordpress.com/2013/06/makercamp_300x250.jpg" />'; ?>

		<?php wp_head(); ?>

		<?php get_template_part('dfp'); ?>

		<script type="text/javascript">
			dataLayer = [];
		</script>

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

	</head>

	<body <?php body_class(); ?>>
		<!-- Google Universal Analytics -->
		<script type="text/javascript">
			  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			  ga('create', 'UA-51157-1', 'auto');
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
		
		<!-- Google Tag Manager Maker Shed -->
		<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-WR8NLB"
		height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-WR8NLB');</script>
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
		
		<div class="container">
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
						<div class="logo span2 craft_logo">
							<a href="<?php echo esc_url( home_url( '/craftzine' ) ); ?>"><img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/img/craft-logo.png" alt="MAKE" title="MAKE" /></a>
						</div>
						<nav role="navigation" class="span7 site-navigation primary-navigation">
						</nav>
						<div class="additional-content hidden-print">
							<form action="<?php echo home_url(); ?>" class="search-make open">
								<input type="text" class="search-field" name="s" placeholder="Search" />
								<input type="submit" class="open submit" value="" />
							</form>
							<div class="clearfix"></div>
							<div class="hdr-sub-ad-01" >
								<a href="https://www.pubservice.com/MK/subscribe.aspx?PC=MK&amp;PK=M3BMZA"><img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/img/hdr-mag-sub-43.jpg"  alt="Subscribe to Make Magazine Today!" /></a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="secondary-header hidden-print">
				<div class="container">
					<div class="row">
						<nav class="span12 site-navigation secondary-navigation">
							<ul id="menu-make-secondary-nav" class="nav navbar-nav ga-nav clearfix">
								<li class="mega-box dropdown"><a href="https://makezine.com/projects/?path=FromNav" class="dropdown-toggle">Projects</a>
									<ul class="sub-menu dropdown-menu container dropdown" style="width:940px;">
										<div class="span2">
											<ul class="mega-dropdown">
												<li class="top-cat-item"><a href="https://makezine.com/category/electronics/?path=FromNav">Electronics</a></li>
												<li><a href="https://makezine.com/category/electronics/arduino/?post_type=projects&amp;path=FromNav">Arduino</a></li>
												<li><a href="https://makezine.com/category/electronics/computers-mobile/?post_type=projects&amp;path=FromNav">Computers &amp; Mobile</a></li>
												<li><a href="https://makezine.com/category/electronics/raspberry-pi/?post_type=projects&amp;path=FromNav">Raspberry Pi</a></li>
												<li><a href="https://makezine.com/category/electronics/robotics/?post_type=projects&amp;path=FromNav">Robotics</a></li>
												<li class="browse-all"><a href="http://makezine.com/category/electronics/?path=FromNav">❯ Browse All</a></li>
											</ul>
										</div>
										<div class="span2">
											<ul class="mega-dropdown">
												<li class="top-cat-item"><a href="https://makezine.com/category/workshop/?path=FromNav">Workshop</a></li>
												<li><a href="https://makezine.com/category/workshop/3d-printing-workshop/?path=FromNav">3D Printing</a></li>
												<li><a href="https://makezine.com/category/workshop/cnc-machining/?path=FromNav">CNC Machining</a></li>
												<li><a href="https://makezine.com/category/workshop/computer-controlled-cutting/?path=FromNav">Computer-Controlled Cutting</a></li>
												<li><a href="https://makezine.com/category/workshop/machining/?path=FromNav">Machining</a></li>
												<li><a href="https://makezine.com/category/workshop/tools/?path=FromNav">Tools</a></li>
												<li><a href="https://makezine.com/category/workshop/woodworking/?path=FromNav">Woodworking</a></li>
												<li class="browse-all"><a href="https://makezine.com/category/workshop/?path=FromNav">❯ Browse All</a></li>
											</ul>

										</div>
										<div class="span2">
											<ul class="mega-dropdown">
												<li class="top-cat-item"><a href="http://makezine.com/craftzine/?path=FromNav">Craft</a></li>
												<li><a href="https://makezine.com/category/craft/crochet/?path=FromNav">Crochet</a></li>
												<li><a href="https://makezine.com/category/craft/knitting/?path=FromNav">Knitting</a></li>
												<li><a href="https://makezine.com/category/craft/paper-crafts/?path=FromNav">Paper Crafts</a></li>
												<li><a href="https://makezine.com/category/craft/sewing-craft/?path=FromNav">Sewing</a></li>
												<li class="browse-all"><a href="http://makezine.com/craftzine/?path=FromNav">❯ Browse All</a></li>
											</ul>
										</div>
										<div class="span2">

											<ul class="mega-dropdown">
												<li class="top-cat-item"><a href="http://makezine.com/category/science/?path=FromNav">Science</a></li>
												<li><a href="https://makezine.com/category/science/energy/?post_type=projects&amp;path=FromNav">Energy</a></li>
												<li><a href="https://makezine.com/category/science/health-science/?post_type=projects&amp;path=FromNav">Health</a></li>
												<li class="browse-all"><a href="http://makezine.com/category/science/?path=FromNav">❯ Browse All</a></li>
											</ul>
										</div>
										<div class="span2">
											<ul class="mega-dropdown">
												<li class="top-cat-item"><a href="https://makezine.com/category/home/?path=FromNav">Home</a></li>
												<li><a href="https://makezine.com/category/home/food-beverage/?post_type=projects&amp;path=FromNav">Food &amp; Beverage</a></li>
												<li><a href="https://makezine.com/category/home/fun-games/?post_type=projects&amp;path=FromNav">Fun &amp; Games</a></li>
												<li><a href="https://makezine.com/category/home/furniture/?post_type=projects&amp;path=FromNav">Furniture</a></li>
												<li><a href="https://makezine.com/category/home/gardening/?post_type=projects&amp;path=FromNav">Gardening</a></li>
												<li><a href="https://makezine.com/category/home/hacks/?post_type=projects&amp;path=FromNav">Hacks</a></li>
												<li><a href="https://makezine.com/category/home/kids-family/?post_type=projects&amp;path=FromNav">Kids &amp; Family</a></li>
												<li class="browse-all"><a href="https://makezine.com/category/home/?path=FromNav">❯ Browse All</a></li>
											</ul>
										</div>
										<div class="span2">
											<ul class="mega-dropdown">
												<li class="top-cat-item"><a href="http://makezine.com/category/art-design/?path=FromNav">Art &amp; Design</a></li>
												<li><a href="https://makezine.com/category/art-design/architecture-art-design/?post_type=projects&amp;path=FromNav">Architecture</a></li>
												<li><a href="https://makezine.com/category/art-design/music/?post_type=projects&amp;path=FromNav">Music</a></li>
												<li><a href="https://makezine.com/category/art-design/photography-video/?post_type=projects&amp;path=FromNav">Photography &amp; Video</a></li>
												<li class="browse-all"><a href="https://makezine.com/category/art-design/?path=FromNav">❯ Browse All</a></li>
											</ul>
										</div>
										<div class="span12 pull-right mega-nav-footer">
											<a href="http://makezine.com/projects/">All Projects</a>
											<a href="https://makezine.com/category/workshop/">Weekend Projects</a>
										</div>

									</ul>
								</li>
								<li id="nav-news" class="mega-box menu-item dropdown"><a href="#" class="dropdown-toggle">News</a>
									<ul class="sub-menu dropdown-menu" style="width:940px;margin-left:-89px;">
										<div class="span2">
											<ul class="mega-dropdown">
												<li class="top-cat-item"><a href="http://makezine.com/blog/?path=FromNav">All News</a></li>
											</ul>
										</div>
										<div class="span2">
											<ul class="mega-dropdown">
												<li class="top-cat-item"><a href="https://makezine.com/category/maker-pro/?path=FromNav">Maker Pro</a></li>
												<li><a href="https://makezine.com/category/maker-pro/open-source-hardware/?path=FromNav">Open Source Hardware</a></li>
												<li><a href="https://makezine.com/category/maker-pro/makerspaces/?path=FromNav">Makerspaces</a></li>
												<li><a href="https://makezine.com/category/maker-pro/crowdfunding/?path=FromNav">Crowdfunding</a></li>
												<li><a href="https://makezine.com/maker-pro-newsletter/?path=FromNav">Maker Pro Newsletter</a></li>
											</ul>
										</div>
										<div class="span2">
											<ul class="mega-dropdown">
												<li class="top-cat-item"><a href="http://makezine.com/tag/maker-faire/?path=FromNav">Maker Faire</a></li>
											</ul>
										</div>
										<div class="span3">
											<ul class="mega-dropdown">
												<li class="top-cat-item"><a href="http://makezine.com/category/makers/?path=FromNav">Meet the Makers</a></li>
											</ul>
										</div>
										<div class="span2">
											<ul class="mega-dropdown">
												<li class="top-cat-item"><a href="http://makezine.com/category/kids-family/?path=FromNav">Kids &amp; Family</a></li>
											</ul>
										</div>
									</ul>
								</li>
								<li class="menu-item dropdown"><a href="#" class="dropdown-toggle">Videos</a>
									<ul class="sub-menu dropdown-menu">
										<li class="menu-item"><a href="https://makezine.com/video?path=FromNav">All Videos</a>
									</ul>
								</li>
								<li class="menu-item dropdown"><a href="#" class="dropdown-toggle">Events</a>
									<ul class="sub-menu dropdown-menu">
										<li><a target="_blank" href="http://makerfaire.com/?path=FromNav">Maker Faire</a></li>
										<li><a target="_blank" href="http://makercon.com?path=FromNav">MakerCon</a></li>
										<li><a target="_blank" href="http://makercamp.com?path=FromNav">Maker Camp</a></li>
									</ul>
								</li>
								<li class="menu-item dropdown"><a href="#">Shop</a>
									<ul class="sub-menu dropdown-menu">
										<li id="menu-item-318846" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-318846"><a target="_blank" href="http://www.makershed.com/?utm_source=makezine.com&amp;utm_medium=ads&amp;utm_campaign=Top+Nav+Menu&amp;utm_term=Maker+Shed+Store&amp;path=FromNav">Maker Shed Store</a></li>
									</ul>
								</li>
								<li class="menu-item dropdown"><a href="#" class="dropdown-toggle">Publications</a>
									<ul class="sub-menu dropdown-menu">
										<li><a target="_blank" href="https://www.pubservice.com/MK/subscribe.aspx?PC=MK&PK=M3BMZA&amp;path=FromNav">Subscribe to Make:</a></li>
										<li><a target="_blank" href="http://makezine.com/volume/make-43/?path=FromNav">Order Current Issue</a></li>
										<li><a target="_blank" href="http://www.makershed.com/collections/make-magazine?path=FromNav">Order Back Issues</a></li>
										<li><a target="_blank" href="http://make-digital.com/?path=FromNav">Digital Edition</a></li>
										<li><a target="_blank" href="http://www.makershed.com/collections/books-magazines?path=FromNav">Buy Books</a></li>
									</ul>
								</li>
							</ul>
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
							<a href="http://www.makershed.com?utm_source=makezine.com&utm_medium=ads&utm_term=Shop+Now&utm_campaign=makershed+banner" title="Find all your DIY electronics in the MakerShed. 3D Printing, Kits, Arduino, Raspberry Pi, Books &amp; more!"><img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/img/maker-shed-banner-02.png" alt="Find all your DIY electronics in the MakerShed. 3D Printing, Kits, Arduino, Raspberry Pi, Books &amp; more!" /></a>
						</div>
					</div>
				</div>
			</div>
		</header>
