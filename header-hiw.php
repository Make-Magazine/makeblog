<!DOCTYPE html>
<html lang="en" xmlns:fb="http://ogp.me/ns/fb#">
	<head>
		<meta charset="utf-8">
		<meta name="google-site-verification" content="tjgq9UGR8WCMZI_40j_B5wda_oVYqKyFtQW547LzMgQ" />
		<title><?php echo make_generate_title_tag(); ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php echo esc_attr( make_generate_description() ); ?>" />

		<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<!-- Le fav and touch icons -->
		<link rel="shortcut icon" href="http://1.gravatar.com/blavatar/dab43acfe30c0e28a023bb3b7a700440?s=14">

		<?php wp_head(); ?>

		<?php get_template_part('dfp'); ?>

	</head>
	<body <?php body_class('hiw'); ?>>
		<header>
			<div class="navbar navbar-fixed-top navbar-blue">
				<div class="navbar-inner">
					<div class="container">
						<a onClick="_gaq.push([\'_trackEvent\', \'Links\', \'Click\', \'Home\']);" class="brand" href="<?php echo get_home_url(); ?>">MAKE</a>
						<ul class="nav">
							<li><a onClick="_gaq.push([\'_trackEvent\', \'Links\', \'Click\', \'Blog\']);" href="<?php echo home_url(); ?>/blog/">Blog</a></li>
							<li><a onClick="_gaq.push([\'_trackEvent\', \'Links\', \'Click\', \'Magazine\']);" href="<?php echo home_url(); ?>/magazine/">Magazine</a></li>
							<li><a onClick="_gaq.push([\'_trackEvent\', \'Links\', \'Click\', \'Maker Faire\']);" href="http://makerfaire.com">Maker Faire</a></li>
							<li><a onClick="_gaq.push([\'_trackEvent\', \'Links\', \'Click\', \'Make: Projects\']);" href="<?php echo home_url(); ?>/projects">Make: Projects</a></li>
							<li><a onClick="_gaq.push([\'_trackEvent\', \'Links\', \'Click\', \'Maker Shed\']);" href="http://makershed.com/">Maker Shed</a></li>
						</ul>
					</div>
				</div>
			</div>	
		</header>
		<div class="clear"></div>
		<div class="fix">
			<div id="header-area">      
				<div class="container">	
					<div class="row">
						<div class="span12 header-image">
							<h1><a href="http://makezine.com/hardware-innovation-workshop/"><img style="margin:0 auto" src="<?php echo get_stylesheet_directory_uri(); ?>/images/hiw-hdr-01.png" alt="Hardware Innovation Workshop" title="Hardware Innovation Workshop" /></a></h1>
						</div> <!-- END span12 -->
					</div> <!-- END row -->	
				</div> <!-- END container -->		
				</div> <!-- END header -->
				<div class="clear"></div>
		</div> <!-- END fix -->
