<!DOCTYPE html>
<html lang="en" xmlns:fb="http://ogp.me/ns/fb#">
	<head>
		<meta charset="utf-8">
		<title><?php bloginfo('name'); ?> | <?php is_home() ? bloginfo('description') : wp_title(''); ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">

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

		<?php wp_head(); ?>

	</head>
	<body <?php body_class('hiw'); ?>>
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
						<div class="span12">
							<div class="clear"></div>
							<h1><a href="http://blog.makezine.com/hardware-innovation-workshop/"><img style="margin:0 auto" src="http://makezineblog.files.wordpress.com/2013/04/hiw-website-header-940w.jpg" alt="Hardware Innovation Workshop - May 14-15, 2013 at College of San Mateo" title="Hardware Innovation Workshop - May 14-15, 2013 at College of San Mateo" /></a></h1>
						</div> <!-- END span12 -->
					</div> <!-- END row -->	
				</div> <!-- END container -->		
				</div> <!-- END header -->
				<div class="header-wrap">
					<div class="container">	
						<div class="row">
							<div class="tag-area">
							<div class="span9">
								<h2>Thanks to all our great sponsors, presenters, and attendees for making the 2013 Hardware Innovation Workshop a success!</h2> 
							</div> <!-- END span9 -->
							<div class="span3">
								<a href="http://www.foliomag.com/2013/make-magazine-s-hardware-innovation-workshop" target="_blank"><img src="http://makezineblog.files.wordpress.com/2013/03/pastedgraphic-1.jpg" alt="2012 Event received FAME award for Best First Time Event"></a>
							</div> <!-- END span3 -->
							</div> <!-- END tag-area-->		
						</div> <!-- END row -->
					</div> <!-- END header-wrap -->
				</div> <!-- END container -->
				<div class="clear"></div>
		</div> <!-- END fix -->
