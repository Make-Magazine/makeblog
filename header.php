<!DOCTYPE html>
<html lang="en" xmlns:fb="http://ogp.me/ns/fb#">
	<head>
		<meta charset="utf-8">
		<title><?php echo make_generate_title_tag(); ?></title>
		<meta name="description" content="<?php echo esc_attr( make_generate_description() ); ?>" />

		<meta name="p:domain_verify" content="c4e1096cb904ca6df87a2bb867715669" >
		<meta name="google-site-verification" content="tjgq9UGR8WCMZI_40j_B5wda_oVYqKyFtQW547LzMgQ" />
		<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<!-- Le fav and touch icons -->
		<link rel="shortcut icon" href="http://1.gravatar.com/blavatar/dab43acfe30c0e28a023bb3b7a700440?s=14">

		<?php if ( is_page( 313086 ) ) 
			echo '<meta property="og:image" content="http://makezineblog.files.wordpress.com/2013/06/makercamp_300x250.jpg" />'; ?>

		<?php wp_head(); ?>

		<?php get_template_part('dfp'); ?>

		<?php if ( is_404() ) : // Load this last. ?>
			<script>
				// Track our 404 errors and log them to GA
				_gaq.push(['_trackEvent', '404', 'URL', document.location.pathname + document.location.search]);
				_gap.push(['_trackEvent', '404', 'REF', document.referrer]);
			</script>
		<?php endif; ?>

	</head>

	<body <?php body_class(); ?>>
		<div class="container hidden-print">
			<div class="row">
				<div class="span9">
					<div id="div-gpt-ad-664089004995786621-1" class="text-center">
						<script type='text/javascript'>
							googletag.cmd.push(function(){googletag.display('div-gpt-ad-664089004995786621-1')});
						</script>
					</div>
				</div>
				<div class="span3 hdr-sub-ad">
					<div id="div-gpt-ad-664089004995786621-5" class="hdr-sub-ad-01" >
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/MakeAd_Circle.png?w=160" alt="MAKE Subscrption Ad" />
					</div>
				</div>
			</div>
		</div>
		<header class="top-navigation-wrapper">
			<div class="main-header">
				<div class="primary-nav-wrap">
					<div class="container">
						<div class="row">
							<div class="logo span2">
	    						<?php if ( is_front_page() || is_home() ) : ?>
									<h1 title="Make Magazine - <?php echo bloginfo( 'description' ); ?>"><a href="<?php echo home_url(); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/make-logo.png"  alt="Tech-savvy DIY Enthusiasts Innovative Projects and Ideas" /></a></h1>
								<?php else : ?>
									<h2 title="Make Magazine - <?php echo bloginfo( 'description' ); ?>"><a href="<?php echo home_url(); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/make-logo.png"  alt="Tech-savvy DIY Enthusiasts Innovative Projects and Ideas" /></a></h2>
								<?php endif; ?>
							</div>
							<nav class="span7 site-navigation primary-navigation hidden-print" role="navigation">
				                <?php wp_nav_menu( array(
				                    'theme_location' => 'make-primary',
				                    'container'		 => '',
				                    'menu_class'	 => 'nav menu-primary-nav ga-nav clearfix',
				                    'walker'		 => new Bootstrap_Walker_Nav_Menu(),
				                ) ); ?>
							</nav>
							<div class="span3 search-make additional-content hidden-print">	
								<form action="<?php echo home_url(); ?>" class="search-make open">
									<input type="text" class="search-field" name="s" placeholder="Find a project, article or video" />
									<input type="image" src="<?php echo get_stylesheet_directory_uri(); ?>/images/search-btn.png" alt="Search" class="open" value="Search" />
								</form>
							</div>				
						</div>
					</div>
				</div>
			</div>
		</header>
