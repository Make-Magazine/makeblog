<?php
/**
 * Maker Camp header template.
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Cole Geissinger <cgeissinger@makermedia.com>
 * 
 */
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title><?php echo make_generate_title_tag(); ?></title>
		<meta name="google-site-verification" content="tjgq9UGR8WCMZI_40j_B5wda_oVYqKyFtQW547LzMgQ" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
		<!-- Le styles -->
		<link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'>

		<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		
		<?php wp_head( 'makercamp' ); ?>

		<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/responsive.css">

	</head>
	<body <?php body_class( 'makercamp' ); ?>>
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

			<div class="black-bar hidden-phone">
				<div class="container">
					<?php
						// all Navigational items are controlled in Appearance > Menus : Maker Camp Nav
						wp_nav_menu( array(
							'theme_location' => 'mc-header-menu',
							'container' => '',
							'menu_class' => 'nav nav-inline',
						) );
					?>
				</div>
			</div>

			<div class="navbar black-bar visible-phone">
				<div class="navbar-inner">
					<div class="container">
						<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</a>
						<a class="brand" href="<?php echo home_url( '/maker-camp' ); ?>">Menu</a>
						<div class="nav-collapse in collapse">
							<?php
								// all Navigational items are controlled in Appearance > Menus : Maker Camp Nav
								wp_nav_menu( array(
									'theme_location' => 'mc-header-menu',
									'container' => '',
									'menu_class' => 'nav nav-inline',
								) );
							?>
						</div>
					</div>
				</div>
			</div>
		</header>

