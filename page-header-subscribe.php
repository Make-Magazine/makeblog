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
							<?php
								wp_nav_menu( array(
									'theme_location'  => 'make-primary', 
									'container'       => false, 
									'menu_class'      => 'nav menu-primary-nav clearfix',
								) );
							?>
						</nav>
					</div>
				</div>
			</div>
			<div class="secondary-header">
				<div class="container">
					<div class="row">
						<nav class="span12 site-navigation secondary-navigation">
							<?php
								wp_nav_menu( array(
									'theme_location' => 'make-secondary',
									'container'		 => false,
									'menu_class' 	 => 'nav menu-secondary-nav clearfix',
								) );
							?>
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
						
