<?php 
/*
Template name: Header
*/
?>

<!DOCTYPE html>
<html lang="en" xmlns:fb="http://ogp.me/ns/fb#">
	<head>
		<meta charset="utf-8">
		<title><?php bloginfo('name'); ?> | <?php is_home() ? bloginfo('description') : wp_title(''); ?></title>
		<meta name="description" content="<?php if ( is_single() ) {
				echo wp_trim_words(strip_shortcodes(get_the_excerpt('...')), 20);
			} else {
				bloginfo('name'); echo " - "; bloginfo('description');
			}
			?>" />

		<!-- Le fav and touch icons -->
		<link rel="shortcut icon" href="https://1.gravatar.com/blavatar/dab43acfe30c0e28a023bb3b7a700440?s=14">

		<link rel="stylesheet" href="https://s0.wp.com/wp-content/themes/vip/makeblog/css/style.css">
		
		<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
		<script type="text/javascript" src="https://use.typekit.com/fzm8sgx.js"></script>
		<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
		<script type="text/javascript">
			  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			  ga('create', 'UA-51157-1', 'auto');
			  ga('send', 'pageview', {
			 'page': location.pathname + location.search  + location.hash
			  });
		</script>

		<?php // Since this loads into https://readerservices.makezine.com, the get_template_directory_uri() fails to load https, so we need to hard code. ?>
        <script src="https://s0.wp.com/wp-content/themes/vip/makeblog/js/bootstrap.min.js"></script>
        <script src="https://s0.wp.com/wp-content/themes/vip/makeblog/js/header.js"></script>

	</head>

	<body <?php body_class(); ?>>

		<header class="top-navigation-wrapper">
			<div class="main-header">
				<div class="container">
					<div class="row">
						<div class="logo span2">
							<a style="display:inline-block!important;visibility:visible!important;height:42.422px!important;" href="<?php echo home_url(); ?>"><img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/img/make-logo.png' ); ?>" /></a>
						</div>
						<nav role="navigation" class="span7 site-navigation primary-navigation">
						</nav>
					</div>
				</div>
			</div>
			<div class="secondary-header hidden-print">
				<div class="container">
					<div class="row">
						<nav class="span12 site-navigation secondary-navigation">
							<ul id="menu-make-secondary-nav" class="nav navbar-nav ga-nav clearfix">
								<li class="mega-box dropdown"><a href="#" class="dropdown-toggle">Projects</a>
									<ul class="sub-menu dropdown-menu container dropdown" style="width:940px;">
										<div class="span2">
											<ul class="mega-dropdown">
												<li class="top-cat-item"><a href="<?php echo esc_url( home_url( '/category/electronics/?path=FromNav' ) ); ?>">Electronics</a></li>
												<li><a href="<?php echo esc_url( home_url( '/category/electronics/arduino/?post_type=projects&amp;path=FromNav' ) ); ?>">Arduino</a></li>
												<li><a href="<?php echo esc_url( home_url( '/category/electronics/computers-mobile/?post_type=projects&amp;path=FromNav' ) ); ?>">Computers &amp; Mobile</a></li>
												<li><a href="<?php echo esc_url( home_url( '/category/electronics/raspberry-pi/?post_type=projects&amp;path=FromNav' ) ); ?>">Raspberry Pi</a></li>
												<li><a href="<?php echo esc_url( home_url( '/category/electronics/robotics/?post_type=projects&amp;path=FromNav' ) ); ?>">Robotics</a></li>
											</ul>
										</div>
										<div class="span2">
											<ul class="mega-dropdown">
												<li class="top-cat-item"><a href="<?php echo esc_url( home_url( '/category/workshop/?path=FromNav' ) ); ?>">Workshop</a></li>
												<li><a href="<?php echo esc_url( home_url( '/category/workshop/3d-printing-workshop/?path=FromNav' ) ); ?>">3D Printing</a></li>
												<li><a href="<?php echo esc_url( home_url( '/category/workshop/cnc-machining/?path=FromNav' ) ); ?>">CNC Machining</a></li>
												<li><a href="<?php echo esc_url( home_url( '/category/workshop/computer-controlled-cutting/?path=FromNav' ) ); ?>">Computer-Controlled Cutting</a></li>
												<li><a href="<?php echo esc_url( home_url( '/category/workshop/machining/?path=FromNav' ) ); ?>">Machining</a></li>
												<li><a href="<?php echo esc_url( home_url( '/category/workshop/tools/?path=FromNav' ) ); ?>">Tools</a></li>
												<li><a href="<?php echo esc_url( home_url( '/category/workshop/woodworking/?path=FromNav' ) ); ?>">Woodworking</a></li>
											</ul>

										</div>
										<div class="span2">
											<ul class="mega-dropdown">
												<li class="top-cat-item"><a href="<?php echo esc_url( home_url( '/craftzine/?path=FromNav' ) ); ?>">Craft</a></li>
												<li><a href="<?php echo esc_url( home_url( '/category/craft/crochet/?path=FromNav' ) ); ?>">Crochet</a></li>
												<li><a href="<?php echo esc_url( home_url( '/category/craft/knitting/?path=FromNav' ) ); ?>">Knitting</a></li>
												<li><a href="<?php echo esc_url( home_url( '/category/craft/paper-crafts/?path=FromNav' ) ); ?>">Paper Crafts</a></li>
												<li><a href="<?php echo esc_url( home_url( '/category/craft/sewing-craft/?path=FromNav' ) ); ?>">Sewing</a></li>
											</ul>
										</div>
										<div class="span2">

											<ul class="mega-dropdown">
												<li class="top-cat-item"><a href="<?php echo esc_url( home_url( '/category/science/?path=FromNav' ) ); ?>">Science</a></li>
												<li><a href="<?php echo esc_url( home_url( '/category/science/energy/?post_type=projects&amp;path=FromNav' ) ); ?>">Energy</a></li>
												<li><a href="<?php echo esc_url( home_url( '/category/science/health-science/?post_type=projects&amp;path=FromNav' ) ); ?>">Health</a></li>
											</ul>
										</div>
										<div class="span2">
											<ul class="mega-dropdown">
												<li class="top-cat-item"><a href="<?php echo esc_url( home_url( '/category/home/?path=FromNav' ) ); ?>">Home</a></li>
												<li><a href="<?php echo esc_url( home_url( '/category/home/food-beverage/?post_type=projects&amp;path=FromNav' ) ); ?>">Food &amp; Beverage</a></li>
												<li><a href="<?php echo esc_url( home_url( '/category/home/fun-games/?post_type=projects&amp;path=FromNav' ) ); ?>">Fun &amp; Games</a></li>
												<li><a href="<?php echo esc_url( home_url( '/category/home/furniture/?post_type=projects&amp;path=FromNav' ) ); ?>">Furniture</a></li>
												<li><a href="<?php echo esc_url( home_url( '/category/home/gardening/?post_type=projects&amp;path=FromNav' ) ); ?>">Gardening</a></li>
												<li><a href="<?php echo esc_url( home_url( '/category/home/hacks/?post_type=projects&amp;path=FromNav' ) ); ?>">Hacks</a></li>
												<li><a href="<?php echo esc_url( home_url( '/category/home/kids-family/?post_type=projects&amp;path=FromNav' ) ); ?>">Kids &amp; Family</a></li>
											</ul>
										</div>
										<div class="span2">
											<ul class="mega-dropdown">
												<li class="top-cat-item"><a href="<?php echo esc_url( home_url( '/category/art-design/?path=FromNav' ) ); ?>">Art &amp; Design</a></li>
												<li><a href="<?php echo esc_url( home_url( '/category/art-design/architecture-art-design/?post_type=projects&amp;path=FromNav' ) ); ?>">Architecture</a></li>
												<li><a href="<?php echo esc_url( home_url( '/category/art-design/music/?post_type=projects&amp;path=FromNav' ) ); ?>">Music</a></li>
												<li><a href="<?php echo esc_url( home_url( '/category/art-design/photography-video/?post_type=projects&amp;path=FromNav' ) ); ?>">Photography &amp; Video</a></li>
											</ul>
										</div>
										<div class="span12 pull-right mega-nav-footer">
											<a href="<?php echo esc_url( home_url( '/projects/?path=FromNav' ) ); ?>">All Projects</a>
											<a href="//pubads.g.doubleclick.net/gampad/clk?id=112551178&iu=/11548178/Makezine&amp;path=FromNav">Weekend Projects</a>
										</div>

									</ul>
								</li>
								<li id="nav-news" class="mega-box menu-item dropdown"><a href="#" class="dropdown-toggle">News</a>
									<ul class="sub-menu dropdown-menu" style="width:940px;margin-left:-89px;">
										<div class="span2">
											<ul class="mega-dropdown">
												<li class="top-cat-item"><a href="<?php echo esc_url( home_url( '/blog/?path=FromNav' ) ); ?>">All News</a></li>
											</ul>
										</div>
										<div class="span3">
											<ul class="mega-dropdown">
												<li class="top-cat-item"><a href="<?php echo esc_url( home_url( '/category/maker-pro/?path=FromNav' ) ); ?>">Maker Pro</a></li>
												<li><a href="<?php echo esc_url( home_url( '/category/maker-pro/open-source-hardware/?path=FromNav' ) ); ?>">Open Source Hardware</a></li>
												<li><a href="<?php echo esc_url( home_url( '/category/maker-pro/makerspaces/?path=FromNav' ) ); ?>">Makerspaces</a></li>
												<li><a href="<?php echo esc_url( home_url( '/category/maker-pro/crowdfunding/?path=FromNav' ) ); ?>">Crowdfunding</a></li>
												<li><a href="<?php echo esc_url( home_url( '/maker-pro-newsletter/?path=FromNav' ) ); ?>">Maker Pro Newsletter</a></li>
											</ul>
										</div>
										<div class="span3">
											<ul class="mega-dropdown">
												<li class="top-cat-item"><a href="<?php echo esc_url( home_url( '/tag/maker-faire/?path=FromNav' ) ); ?>">Maker Faire</a></li>
											</ul>
										</div>
										<div class="span3">
											<ul class="mega-dropdown">
												<li class="top-cat-item"><a href="<?php echo esc_url( home_url( '/category/makers/?path=FromNav' ) ); ?>">Meet the Makers</a></li>
											</ul>
										</div>
						
									</ul>
								</li>
								<li class="menu-item dropdown"><a href="#" class="dropdown-toggle">Videos</a>
									<ul class="sub-menu dropdown-menu">
										<li class="menu-item"><a href="<?php echo esc_url( home_url( '/video?path=FromNav' ) ); ?>">All Videos</a>
									</ul>
								</li>
								<li class="menu-item dropdown"><a href="#" class="dropdown-toggle">Events</a>
									<ul class="sub-menu dropdown-menu">
										<li><a target="_blank" href="//makerfaire.com/?path=FromNav">Maker Faire</a></li>
										<li><a target="_blank" href="//makercon.com?path=FromNav">MakerCon</a></li>
										<li><a target="_blank" href="//makercamp.com?path=FromNav">Maker Camp</a></li>
									</ul>
								</li>
								<li class="menu-item dropdown"><a href="#">Shop</a>
									<ul class="sub-menu dropdown-menu">
										<li id="menu-item-318846" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-318846"><a target="_blank" href="http://www.makershed.com/?utm_source=makezine.com&amp;utm_medium=ads&amp;utm_campaign=Top+Nav+Menu&amp;utm_term=Maker+Shed+Store">Maker Shed Store</a></li>
									</ul>
								</li>
								<li class="menu-item dropdown"><a href="#" class="dropdown-toggle">Publications</a>
									<ul class="sub-menu dropdown-menu">
										<li><a target="_blank" href="https://www.pubservice.com/MK/subscribe.aspx?PC=MK&PK=M3BMZA">Subscribe to Make:</a></li>
										<li><a target="_blank" href="//www.makershed.com/collections/make-magazine?utm_source=makezine.com&amp;utm_medium=ads&amp;utm_campaign=Top+Nav+Menu&amp;utm_term=make+magazine">Order Back Issues</a></li>
										<li><a target="_blank" href="//www.makershed.com/collections/books-magazines?utm_source=makezine.com&amp;utm_medium=ads&amp;utm_campaign=Top+Nav+Menu&amp;utm_term=books+magazines">Buy Books</a></li>
									</ul>
								</li>
							</ul>
						</nav>
					</div>
				</div>
			</div>
		</header>
		<div class="sand">

			<div class="container">

				<div class="row">

					<div class="span12">

						<div class="content" id="content">
						
							<!-- Content will go here -->
