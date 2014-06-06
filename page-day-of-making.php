<?php
/**
 * Template Name: Day of Making
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo make_generate_title_tag(); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="<?php esc_attr( the_excerpt() ); ?>">

	<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
		<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>
<body>



	<?php wp_footer(); ?>
</body>
</html>