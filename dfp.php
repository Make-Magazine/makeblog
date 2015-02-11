<?php
/**
 * DFP Ad Block
 *
 * Initializes all of the ads for Maker Faire.
 *
 */
 
  global $post;

  $current_page = (is_object($wp_query) && is_array($wp_query->query) && ($wp_query->query['pagename'] != '') && ($wp_query->query['pagename'] != 'wp-cron.php' )) ? $wp_query->query: null;

  if($current_page !== null) {

    $q_posts = get_posts(array('pagename' => $wp_query->query['pagename'], 'post_type' =>'any', 'post_status' => 'any'));
    $q_post_id = $q_posts[0]->ID;
	  $post_adslot_targeting_name = get_post_meta($q_post_id, '_adslot_targeting_name', true);
    $post_adslot_targeting_ids = get_post_meta($q_post_id, '_adslot_targeting_ids', true);
  } 

?>

		<script type='text/javascript'>
			var googletag = googletag || {};
			googletag.cmd = googletag.cmd || [];
			(function() {
			var gads = document.createElement('script');
			gads.async = true;
			gads.type = 'text/javascript';
			var useSSL = 'https:' == document.location.protocol;
			gads.src = (useSSL ? 'https:' : 'http:') +
			'//www.googletagservices.com/tag/js/gpt.js';
			var node = document.getElementsByTagName('script')[0];
			node.parentNode.insertBefore(gads, node);
			})();
		</script>
		<script type="text/javascript">

		googletag.cmd.push(function() {

		<?php
    if(!empty($post_adslot_targeting_name)) {
        $post_adslot_targeting_ids = (!empty($post_adslot_targeting_name)) ? $post_adslot_targeting_ids : $post->ID;
        $post_adslot_targeting_ids = "'{$post_adslot_targeting_ids}'"; //wrap commas
        echo "googletag.pubads().setTargeting('{$post_adslot_targeting_name}',[{$post_adslot_targeting_ids}]);\n";
    }
    
		$parent = (!empty($_REQUEST['parent']) ? $_REQUEST['parent'] : null);
			if (isset($parent)) { ?>
				var slot1= googletag.defineSlot('/11548178/Makezine/Blog/<?php echo esc_js( $parent ); ?>', [[728,90],[940,250]],'div-gpt-ad-664089004995786621-1').addService(googletag.pubads()).setTargeting('pos', 'atf');
				var slot2= googletag.defineSlot('/11548178/Makezine/Blog/<?php echo esc_js( $parent ); ?>', [[300,250]],'div-gpt-ad-664089004995786621-2').addService(googletag.pubads()).setTargeting('pos', 'atf');
				var slot3= googletag.defineSlot('/11548178/Makezine/Blog/<?php echo esc_js( $parent ); ?>', [[300,250]],'div-gpt-ad-664089004995786621-3').addService(googletag.pubads()).setTargeting('pos', 'btf');
				var slot4= googletag.defineSlot('/11548178/Makezine/Blog/<?php echo esc_js( $parent ); ?>', [[728,90]],'div-gpt-ad-664089004995786621-4').addService(googletag.pubads()).setTargeting('pos', 'btf');
				var slot5= googletag.defineSlot('/11548178/Makezine/Blog/<?php echo esc_js( $parent ); ?>', [[247,96]],'div-gpt-ad-664089004995786621-5').addService(googletag.pubads()).setTargeting('pos', 'atf');
				var slot9= googletag.defineSlot('/11548178/Makezine/Blog/<?php echo esc_js( $parent ); ?>', [[300,250]],'div-gpt-ad-664089004995786621-9').addService(googletag.pubads()).setTargeting('pos', 'shed');
				<?php if ( get_theme_mod( 'make_faire_banner' ) != 'on' ) : ?>
					var slot6= googletag.defineSlot('/11548178/Makezine/Blog/<?php echo esc_js( $parent ); ?>', [[940,39]],'div-gpt-ad-664089004995786621-6').addService(googletag.pubads()).setTargeting('pos', 'atf');
				<?php endif; ?>
				<?php if (has_tag('greatcreate')) { ?>
					var slot7= googletag.defineSlot('/11548178/Makezine/Blog/<?php echo esc_js( $parent ); ?>', [[125,125]],'div-gpt-ad-664089004995786621-10').addService(googletag.pubads());
				<?php } ?>
		<?php } elseif(is_page(array('home-page-include', 'home-page', 'home', 116357))) { ?>
			var slot1= googletag.defineSlot('/11548178/Makezine/Homepage', [[728,90],[940,250]],'div-gpt-ad-664089004995786621-1').addService(googletag.pubads()).setTargeting('pos', 'atf');
			var slot2= googletag.defineSlot('/11548178/Makezine/Homepage', [[300,250]],'div-gpt-ad-664089004995786621-2').addService(googletag.pubads()).setTargeting('pos', 'atf');
			var slot3= googletag.defineSlot('/11548178/Makezine/Homepage', [[300,250]],'div-gpt-ad-664089004995786621-3').addService(googletag.pubads()).setTargeting('pos', 'house');
			var slot4= googletag.defineSlot('/11548178/Makezine/Homepage', [[728,90]],'div-gpt-ad-664089004995786621-4').addService(googletag.pubads()).setTargeting('pos', 'btf');
			var slot5= googletag.defineSlot('/11548178/Makezine/Homepage', [[247,96]],'div-gpt-ad-664089004995786621-5').addService(googletag.pubads()).setTargeting('pos', 'atf');
			var slot6= googletag.defineSlot('/11548178/Makezine/Homepage', [[940,39]],'div-gpt-ad-664089004995786621-6').addService(googletag.pubads()).setTargeting('pos', 'atf');
			var slot9= googletag.defineSlot('/11548178/Makezine/Homepage', [[300,250]],'div-gpt-ad-664089004995786621-9').addService(googletag.pubads()).setTargeting('pos', 'shed');
			var slot7= googletag.defineSlot('/11548178/Makezine/Homepage', [[2160,547]],'div-gpt-ad-664089004995786621-7').addService(googletag.pubads()).setTargeting('pos', 'atf');
			var slot8= googletag.defineSlot('/11548178/Makezine/Homepage', [[1,1]],'div-gpt-ad-664089004995786621-8').addService(googletag.pubads()).setTargeting('pos', 'atf');
		<?php } elseif ( is_category() ) { ?>
			var slot1= googletag.defineSlot('/11548178/Makezine/Blog<?php echo esc_js( make_get_category_name() ); ?>', [[728,90],[940,250]],'div-gpt-ad-664089004995786621-1').addService(googletag.pubads()).setTargeting('pos', 'atf');
			var slot2= googletag.defineSlot('/11548178/Makezine/Blog<?php echo esc_js( make_get_category_name() ); ?>', [[300,250]],'div-gpt-ad-664089004995786621-2').addService(googletag.pubads()).setTargeting('pos', 'atf');
			var slot3= googletag.defineSlot('/11548178/Makezine/Blog<?php echo esc_js( make_get_category_name() ); ?>', [[300,250],[300,600]],'div-gpt-ad-664089004995786621-3').addService(googletag.pubads()).setTargeting('pos', 'btf');
			var slot4= googletag.defineSlot('/11548178/Makezine/Blog<?php echo esc_js( make_get_category_name() ); ?>', [[728,90]],'div-gpt-ad-664089004995786621-4').addService(googletag.pubads()).setTargeting('pos', 'btf');
			var slot5= googletag.defineSlot('/11548178/Makezine/Blog<?php echo esc_js( make_get_category_name() ); ?>', [[247,96]],'div-gpt-ad-664089004995786621-5').addService(googletag.pubads()).setTargeting('pos', 'atf');
			var slot9= googletag.defineSlot('/11548178/Makezine/Blog<?php echo esc_js( make_get_category_name() ); ?>', [[300,250]],'div-gpt-ad-664089004995786621-9').addService(googletag.pubads()).setTargeting('pos', 'shed');
			<?php if ( get_theme_mod( 'make_faire_banner' ) != 'on' ) : ?>
				var slot6= googletag.defineSlot('/11548178/Makezine/Blog/<?php echo esc_js( $parent ); ?>', [[940,39]],'div-gpt-ad-664089004995786621-6').addService(googletag.pubads()).setTargeting('pos', 'atf');
			<?php endif; ?>
		<?php } elseif ('craft' == get_post_type()) { ?>
		 	var slot1= googletag.defineSlot('/11548178/Makezine/Craft/Blog<?php echo esc_js( make_get_category_name() ); ?>', [[728,90],[940,250]],'div-gpt-ad-664089004995786621-1').addService(googletag.pubads()).setTargeting('pos', 'atf');
		 	var slot2= googletag.defineSlot('/11548178/Makezine/Craft/Blog<?php echo esc_js( make_get_category_name() ); ?>', [[300,250],[300,600]],'div-gpt-ad-664089004995786621-2').addService(googletag.pubads()).setTargeting('pos', 'atf');
			var slot3= googletag.defineSlot('/11548178/Makezine/Craft/Blog<?php echo esc_js( make_get_category_name() ); ?>', [[300,250],[300,600]],'div-gpt-ad-664089004995786621-3').addService(googletag.pubads()).setTargeting('pos', 'btf');
			var slot4= googletag.defineSlot('/11548178/Makezine/Craft/Blog<?php echo esc_js( make_get_category_name() ); ?>', [[728,90]],'div-gpt-ad-664089004995786621-4').addService(googletag.pubads()).setTargeting('pos', 'btf');
			var slot5= googletag.defineSlot('/11548178/Makezine/Craft/Blog<?php echo esc_js( make_get_category_name() ); ?>', [[247,96]],'div-gpt-ad-664089004995786621-5').addService(googletag.pubads()).setTargeting('pos', 'atf');
			var slot9= googletag.defineSlot('/11548178/Makezine/Craft/Blog<?php echo esc_js( make_get_category_name() ); ?>', [[300,250]],'div-gpt-ad-664089004995786621-9').addService(googletag.pubads()).setTargeting('pos', 'shed');
			<?php if ( get_theme_mod( 'make_faire_banner' ) != 'on' ) : ?>
				var slot6= googletag.defineSlot('/11548178/Makezine/Blog/<?php echo esc_js( $parent ); ?>', [[940,39]],'div-gpt-ad-664089004995786621-6').addService(googletag.pubads()).setTargeting('pos', 'atf');
			<?php endif; ?>
		<?php } elseif ('slideshow' == get_post_type()) { ?>
		 	var slot1= googletag.defineSlot('/11548178/Makezine/Blog/Slideshow', [[728,90],[940,250]],'div-gpt-ad-664089004995786621-1').addService(googletag.pubads()).setTargeting('pos', 'atf');
		 	var slot2= googletag.defineSlot('/11548178/Makezine/Blog/Slideshow', [[300,250],[300,600]],'div-gpt-ad-664089004995786621-2').addService(googletag.pubads()).setTargeting('pos', 'atf');
		<?php } elseif ( ('volume' ) == get_post_type() ) { ?>
		 	var slot1= googletag.defineSlot('/11548178/Makezine/Blog/Magazine', [[728,90],[940,250]],'div-gpt-ad-664089004995786621-1').addService(googletag.pubads()).setTargeting('pos', 'atf');
		 	var slot2= googletag.defineSlot('/11548178/Makezine/Blog/Magazine', [[300,250],[300,600]],'div-gpt-ad-664089004995786621-2').addService(googletag.pubads()).setTargeting('pos', 'atf');
			var slot3= googletag.defineSlot('/11548178/Makezine/Blog/Magazine', [[300,250],[300,600]],'div-gpt-ad-664089004995786621-3').addService(googletag.pubads()).setTargeting('pos', 'btf');
			var slot4= googletag.defineSlot('/11548178/Makezine/Blog/Magazine', [[728,90]],'div-gpt-ad-664089004995786621-4').addService(googletag.pubads()).setTargeting('pos', 'btf');
			var slot5= googletag.defineSlot('/11548178/Makezine/Blog/Magazine', [[247,96]],'div-gpt-ad-664089004995786621-5').addService(googletag.pubads()).setTargeting('pos', 'atf');
			var slot9= googletag.defineSlot('/11548178/Makezine/Blog/Magazine', [[300,250]],'div-gpt-ad-664089004995786621-9').addService(googletag.pubads()).setTargeting('pos', 'shed');
			<?php if ( get_theme_mod( 'make_faire_banner' ) != 'on' ) : ?>
				var slot6= googletag.defineSlot('/11548178/Makezine/Blog/<?php echo esc_js( $parent ); ?>', [[940,39]],'div-gpt-ad-664089004995786621-6').addService(googletag.pubads()).setTargeting('pos', 'atf');
			<?php endif; ?>
		<?php } elseif(is_page(array('kids'))) { ?>
			var slot1= googletag.defineSlot('/11548178/Makezine/Blog/Kids', [[728,90],[940,250]],'div-gpt-ad-664089004995786621-1').addService(googletag.pubads()).setTargeting('pos', 'atf');
			var slot2= googletag.defineSlot('/11548178/Makezine/Blog/Kids', [[300,250]],'div-gpt-ad-664089004995786621-2').addService(googletag.pubads()).setTargeting('pos', 'atf');
			var slot3= googletag.defineSlot('/11548178/Makezine/Blog/Kids', [[300,250]],'div-gpt-ad-664089004995786621-3').addService(googletag.pubads()).setTargeting('pos', 'btf');
			var slot4= googletag.defineSlot('/11548178/Makezine/Blog/Kids', [[728,90]],'div-gpt-ad-664089004995786621-4').addService(googletag.pubads()).setTargeting('pos', 'btf');
			var slot5= googletag.defineSlot('/11548178/Makezine/Blog/Kids', [[247,96]],'div-gpt-ad-664089004995786621-5').addService(googletag.pubads()).setTargeting('pos', 'atf');
			var slot9= googletag.defineSlot('/11548178/Makezine/Blog/Kids', [[300,250]],'div-gpt-ad-664089004995786621-9').addService(googletag.pubads()).setTargeting('pos', 'shed');
			<?php if ( get_theme_mod( 'make_faire_banner' ) != 'on' ) : ?>
				var slot6= googletag.defineSlot('/11548178/Makezine/Blog/<?php echo esc_js( $parent ); ?>', [[940,39]],'div-gpt-ad-664089004995786621-6').addService(googletag.pubads()).setTargeting('pos', 'atf');
			<?php endif; ?>
		<?php } elseif(is_page(array('craftzine', 235220 ))) { ?>
			var slot1= googletag.defineSlot('/11548178/Makezine/Craft/Homepage', [[728,90],[940,250]],'div-gpt-ad-664089004995786621-1').addService(googletag.pubads()).setTargeting('pos', 'atf');
			var slot2= googletag.defineSlot('/11548178/Makezine/Craft/Homepage', [[300,250]],'div-gpt-ad-664089004995786621-2').addService(googletag.pubads()).setTargeting('pos', 'atf');
			var slot3= googletag.defineSlot('/11548178/Makezine/Craft/Homepage', [[300,250]],'div-gpt-ad-664089004995786621-3').addService(googletag.pubads()).setTargeting('pos', 'btf');
			var slot4= googletag.defineSlot('/11548178/Makezine/Craft/Homepage', [[728,90]],'div-gpt-ad-664089004995786621-4').addService(googletag.pubads()).setTargeting('pos', 'btf');
			var slot5= googletag.defineSlot('/11548178/Makezine/Craft/Homepage', [[247,96]],'div-gpt-ad-664089004995786621-5').addService(googletag.pubads()).setTargeting('pos', 'atf');
			var slot9= googletag.defineSlot('/11548178/Makezine/Craft/Homepage', [[300,250]],'div-gpt-ad-664089004995786621-9').addService(googletag.pubads()).setTargeting('pos', 'shed');
			<?php if ( get_theme_mod( 'make_faire_banner' ) != 'on' ) : ?>
				var slot6= googletag.defineSlot('/11548178/Makezine/Blog/<?php echo esc_js( $parent ); ?>', [[940,39]],'div-gpt-ad-664089004995786621-6').addService(googletag.pubads()).setTargeting('pos', 'atf');
			<?php endif; ?>
		<?php } elseif ( is_home() || is_archive() ) { ?>
			var slot1= googletag.defineSlot('/11548178/Makezine/Blog<?php echo esc_js( make_get_category_name_strip_slash() ); ?>', [[728,90],[940,250]],'div-gpt-ad-664089004995786621-1').addService(googletag.pubads()).setTargeting('pos', 'atf');
			var slot2= googletag.defineSlot('/11548178/Makezine/Blog<?php echo esc_js( make_get_category_name_strip_slash() ); ?>', [[300,250],[300,600]],'div-gpt-ad-664089004995786621-2').addService(googletag.pubads()).setTargeting('pos', 'atf');
			var slot3= googletag.defineSlot('/11548178/Makezine/Blog<?php echo esc_js( make_get_category_name_strip_slash() ); ?>', [[300,250],[300,600]],'div-gpt-ad-664089004995786621-3').addService(googletag.pubads()).setTargeting('pos', 'btf');
			var slot4= googletag.defineSlot('/11548178/Makezine/Blog<?php echo esc_js( make_get_category_name_strip_slash() ); ?>', [[728,90]],'div-gpt-ad-664089004995786621-4').addService(googletag.pubads()).setTargeting('pos', 'btf');
			var slot5= googletag.defineSlot('/11548178/Makezine/Blog<?php echo esc_js( make_get_category_name_strip_slash() ); ?>', [[247,96]],'div-gpt-ad-664089004995786621-5').addService(googletag.pubads()).setTargeting('pos', 'atf');
			var slot9= googletag.defineSlot('/11548178/Makezine/Blog<?php echo esc_js( make_get_category_name_strip_slash() ); ?>', [[300,250]],'div-gpt-ad-664089004995786621-9').addService(googletag.pubads()).setTargeting('pos', 'shed');
			<?php if ( get_theme_mod( 'make_faire_banner' ) != 'on' ) : ?>
				var slot6= googletag.defineSlot('/11548178/Makezine/Blog/<?php echo esc_js( $parent ); ?>', [[940,39]],'div-gpt-ad-664089004995786621-6').addService(googletag.pubads()).setTargeting('pos', 'atf');
			<?php endif; ?>
			var slot7= googletag.defineSlot('/11548178/Makezine/Blog<?php echo esc_js( make_get_category_name_strip_slash() ); ?>', [[2160,547]],'div-gpt-ad-664089004995786621-7').addService(googletag.pubads()).setTargeting('pos', 'atf');
		<?php }	elseif ( is_page(array('craftzine', 'craft-home') ) ) { ?>
			var slot1= googletag.defineSlot('/11548178/Makezine/Craft/Homepage<?php echo esc_js( make_get_category_name_strip_slash() ); ?>', [[728,90],[940,250]],'div-gpt-ad-664089004995786621-1').addService(googletag.pubads()).setTargeting('pos', 'atf');
			var slot2= googletag.defineSlot('/11548178/Makezine/Craft/Homepage<?php echo esc_js( make_get_category_name_strip_slash() ); ?>', [[300,250],[300,600]],'div-gpt-ad-664089004995786621-2').addService(googletag.pubads()).setTargeting('pos', 'atf');
			var slot3= googletag.defineSlot('/11548178/Makezine/Craft/Homepage<?php echo esc_js( make_get_category_name_strip_slash() ); ?>', [[300,250],[300,600]],'div-gpt-ad-664089004995786621-3').addService(googletag.pubads()).setTargeting('pos', 'btf');
			var slot4= googletag.defineSlot('/11548178/Makezine/Craft/Homepage<?php echo esc_js( make_get_category_name_strip_slash() ); ?>', [[728,90]],'div-gpt-ad-664089004995786621-4').addService(googletag.pubads()).setTargeting('pos', 'btf');
			var slot5= googletag.defineSlot('/11548178/Makezine/Craft/Homepage<?php echo esc_js( make_get_category_name_strip_slash() ); ?>', [[247,96]],'div-gpt-ad-664089004995786621-5').addService(googletag.pubads()).setTargeting('pos', 'atf');
			var slot9= googletag.defineSlot('/11548178/Makezine/Craft/Homepage<?php echo esc_js( make_get_category_name_strip_slash() ); ?>', [[300,250]],'div-gpt-ad-664089004995786621-9').addService(googletag.pubads()).setTargeting('pos', 'shed');
			<?php if ( get_theme_mod( 'make_faire_banner' ) != 'on' ) : ?>
				var slot6= googletag.defineSlot('/11548178/Makezine/Blog/<?php echo esc_js( $parent ); ?>', [[940,39]],'div-gpt-ad-664089004995786621-6').addService(googletag.pubads()).setTargeting('pos', 'atf');
			<?php endif; ?>
		<?php } else { ?>
			var slot1= googletag.defineSlot('/11548178/Makezine/Blog<?php echo esc_js( make_get_category_name() ); ?>', [[728,90],[940,250]],'div-gpt-ad-664089004995786621-1').addService(googletag.pubads()).setTargeting('pos', 'atf');
			var slot2= googletag.defineSlot('/11548178/Makezine/Blog<?php echo esc_js( make_get_category_name() ); ?>', [[300,250],[300,600]],'div-gpt-ad-664089004995786621-2').addService(googletag.pubads()).setTargeting('pos', 'atf');
			var slot3= googletag.defineSlot('/11548178/Makezine/Blog<?php echo esc_js( make_get_category_name() ); ?>', [[300,250],[300,600]],'div-gpt-ad-664089004995786621-3').addService(googletag.pubads()).setTargeting('pos', 'btf');
			var slot4= googletag.defineSlot('/11548178/Makezine/Blog<?php echo esc_js( make_get_category_name() ); ?>', [[728,90]],'div-gpt-ad-664089004995786621-4').addService(googletag.pubads()).setTargeting('pos', 'btf');
			var slot5= googletag.defineSlot('/11548178/Makezine/Blog<?php echo esc_js( make_get_category_name() ); ?>', [[247,96]],'div-gpt-ad-664089004995786621-5').addService(googletag.pubads()).setTargeting('pos', 'atf');
			var slot9= googletag.defineSlot('/11548178/Makezine/Blog<?php echo esc_js( make_get_category_name() ); ?>', [[300,250]],'div-gpt-ad-664089004995786621-9').addService(googletag.pubads()).setTargeting('pos', 'shed');
			<?php if ( get_theme_mod( 'make_faire_banner' ) != 'on' ) : ?>
				var slot6= googletag.defineSlot('/11548178/Makezine/Blog/<?php echo esc_js( $parent ); ?>', [[940,39]],'div-gpt-ad-664089004995786621-6').addService(googletag.pubads()).setTargeting('pos', 'atf');
			<?php endif; ?>
			var slot7= googletag.defineSlot('/11548178/Makezine/Blog<?php echo esc_js( make_get_category_name() ); ?>', [[2160,547]],'div-gpt-ad-664089004995786621-7').addService(googletag.pubads()).setTargeting('pos', 'atf');
			<?php if (has_tag('greatcreate')) { ?>
				var slot7= googletag.defineSlot('/11548178/Makezine/Blog<?php echo esc_js( make_get_category_name() ); ?>', [[125,125]],'div-gpt-ad-664089004995786621-10').addService(googletag.pubads());
			<?php } ?>
		<?php } ?>

			<?php
				if (has_tag('project-remake')) {
					echo "googletag.pubads().setTargeting('sponsor',['schick']);";
				}
				elseif (has_tag('mcm')) {
					echo "googletag.pubads().setTargeting('sponsor',['mcm']);";
				}
				elseif ( ( has_tag( array( 'greatcreate', 'Weekend Projects' ) ) || is_page( array( 286853, 271492, 313151, 341320 ) ) ) && !is_category( 'electronics' )  ) {
					echo "googletag.pubads().setTargeting('sponsor',['radioshack']);";
				}
				elseif (has_tag('esurance') || is_page( array(313086, 316119, 316937) ) ) {
					echo "googletag.pubads().setTargeting('sponsor',['esurance']);";
				}
				elseif (has_tag('tinkernation')) {
					echo "googletag.pubads().setTargeting('sponsor',['tinkernation']);";
				}
				elseif (has_tag('bosch')) {
					echo "googletag.pubads().setTargeting('sponsor',['bosch']);";
				}
				elseif (is_single(array(109345,109347))) {
					echo "googletag.pubads().setTargeting('sponsor',['moneyball']);";
				}
				elseif (is_single(array(78509,120079,121013,121988,123191))) {
					echo "googletag.pubads().setTargeting('sponsor',['volt']);";
				}
				elseif (is_single(array(121818))) {
					echo "googletag.pubads().setTargeting('sponsor',['microchip']);";
				}
				elseif (is_single(array(333675))) {
					echo "googletag.pubads().setTargeting('sponsor',['energizer']);";
				}
				elseif (is_single(array(122575))) {
					echo "googletag.pubads().setTargeting('sponsor',['xobject']);";
				}
				elseif (is_page( array( 289746,271575 ) ) ) {
					echo "googletag.pubads().setTargeting('sponsor',['mcm']);";
				}
				elseif ( has_category( '3d-printing-workshop' ) ) {
					echo "googletag.pubads().setTargeting('sponsor',['sketchup']);";
				}
				elseif ( ! is_archive() && ( has_tag( 'nikon' ) || is_page( array( 388070 ) ) ) ) {
					echo "googletag.pubads().setTargeting('sponsor',['nikon']);";
				}
				elseif (is_single(array(424504))) {
					echo "googletag.pubads().setTargeting('sponsor',['element']);";
				}
				elseif (has_tag('lincolnelectric2014') || is_page( array(452017) ) ) {
					echo "googletag.pubads().setTargeting('sponsor',['lincolnelectric2014']);";
				}
				elseif (has_tag('dremel2014')) {
					echo "googletag.pubads().setTargeting('sponsor',['dremel2014']);";
				}
				elseif (has_tag('makerpro') || is_page( array(302792) ) ) {
					echo "googletag.pubads().setTargeting('sponsor',['makerpro']);";
				}
				elseif (has_tag('arrowcypress') || is_page( array(461313,463824,462353,463460,463441) ) ) {
					echo "googletag.pubads().setTargeting('sponsor',['arrowcypress']);";
				}
				elseif (has_tag('cornell') || is_page( array(466354,466367,466360,466358,466356) ) ) {
					echo "googletag.pubads().setTargeting('sponsor',['cornell']);";
				}
			?>
			googletag.enableServices();
			});
		</script>
		<!-- End: GPT -->
