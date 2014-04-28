<?php

require_once( WP_CONTENT_DIR . '/themes/vip/plugins/vip-init.php' );

if ( function_exists( 'wpcom_vip_enable_opengraph' ) ) {
	wpcom_vip_enable_opengraph();
}

if ( function_exists( 'vip_contrib_add_upload_cap' ) ) {
	vip_contrib_add_upload_cap();
}

if ( function_exists( 'wpcom_vip_sharing_twitter_via' ) ) {
	wpcom_vip_sharing_twitter_via( 'make' );
}

wpcom_vip_load_plugin( 'wp-help' );
wpcom_vip_load_plugin( 'easy-custom-fields' );
wpcom_vip_load_plugin( 'edit-flow' );
wpcom_vip_load_plugin( 'get-the-image' );
wpcom_vip_load_plugin( 'cheezcap' );
wpcom_vip_load_plugin( 'add-meta-tags-mod' );
wpcom_vip_load_plugin( 'wpcom-thumbnail-editor' );
wpcom_vip_load_plugin( 'wpcom-elasticsearch' );
wpcom_vip_load_plugin( 'msm-sitemap' );
wpcom_vip_load_plugin( 'wp-frontend-uploader' );
wpcom_vip_load_plugin( 'multiple-post-thumbnails' );
wpcom_vip_load_plugin( 'taxonomy-images' );
wpcom_vip_load_plugin( 'simply-show-ids' );
wpcom_vip_load_plugin( 'view-all-posts-pages' );
wpcom_vip_load_plugin( 'co-authors-plus' );
wpcom_vip_load_plugin( 'disqus' );

function make_sitemap_post_types() {
	$types = array( 'post', 'page', 'projects', 'review', 'craft', 'newsletter', 'magazine', 'video', 'volume', 'errata', 'page_2', 'slideshow' );
	return $types;
}

add_filter( 'msm_sitemap_entry_post_type', 'make_sitemap_post_types' );

wpcom_vip_load_plugin( 'facebook' );


/**
 * Redirects to handle legacy URL structure from old site
 */
if ( function_exists( 'vip_redirects' ) ) {

	// Setup this redirect before we get to the regex ones...
	vip_redirects( array( '/projects/37' => 'http://makezine.com/make-37-drones-projects/' ) );
}

if ( function_exists( 'vip_regex_redirects' ) ) {
	$redirects = array(
		'|^/archive/([0-9]{4})/([0-9]{2})/([^/]+)\.html|'  => '|/$1/$2/$3/|', // MT articles
		'|^/([0-9]+)\.html$|' 							   => '|/$1/|', // MT page structure - just redirect to postname and WordPress will resolve
		'|^/archive/category/([a-zA-Z_]+)|' 			   => '|/category/$1/|', // MT category
		'|^/archive/category/([a-zA-Z_]+)/index.xml$|'	   => '|/category/$1/feed/', // MT category feed
		'|^/archive/category/([a-zA-Z_]+)/feed|' 		   => '|/category/$1/feed/', // Old WordPress Podcast feeds
		'|^/archive/category/([a-zA-Z]+)/([0-9]+)\.html$|' => '|/category/$1/page/$2/', // MT paginated category structure
		'|^/([0-9]{2})/(.*)|'							   => 'http://archive.makezine.com/$1/$2|',
		'|^/blog/category/([a-zA-Z0-9 -]+)|' 			   => '|/category/$1/|', // handle any redirects from blog.makezine with categories
		'|^/blog/tag/([a-zA-Z0-9 -]+)|'				  	   => '|/tag/$1/|', // handle any redirects from blog.makezine with tags
		'|^/blog/author/([a-zA-Z0-9 -]+)|'				   => '|/author/$1/', // handle any redirects from blog.makezine marked as authors
		'|^/tv/(.*)|'									   => 'http://archive.makezine.com/tv/$1', // Old Makezine TV redirects
	);
	vip_regex_redirects( $redirects );
}
if ( function_exists( 'vip_redirects' ) ) {
	vip_redirects( array(
		'/index.xml'         => 'http://makezine.com/feed/', // really old feeds
		'/feed/rss'          => 'http://makezine.com/feed/', // really old feeds
		'/podcast'           => 'http://makezine.com/video/', // Old podcast => video
		//'/home-page-include' => 'http://makezine.com/', // Old podcast => video
	) );
}

// Since we have a global redirect for blog.makezine.com to makezine.com/blog, we need to append /blog/ before everything for these to return true
// Due to the fact everything is broken, we need to launch this NOW. TODO: Convert to Reg Ex so we can simplify this.
if ( function_exists( 'vip_redirects' ) ) {
	$redirects = array(
		'/blog/subscribe' 				=> 'https://readerservices.makezine.com/MK/MKSubnew1.aspx?PC=MK',
		'/blog/renew'					=> 'https://readerservices.makezine.com/mk/subinfo.aspx?pc=mk',
		'/blog/paybill'					=> 'https://readerservices.makezine.com/mk/subinfo.aspx?pc=mk',
		'/blog/account'					=> 'https://readerservices.makezine.com/mk/subinfo.aspx?pc=mk',
		'/blog/premier'					=> 'https://readerservices.makezine.com/mk/subinfo.aspx?pc=mk',
		'/blog/coolgifts'				=> 'https://readerservices.makezine.com/backissue/subbi.aspx?PC=MK&AN=&Zp=&PK=',
		'/blog/gift'					=> 'https://readerservices.makezine.com/mk/SubGiftSplash.aspx',
		'/blog/04/strobe/indstrobe.mov'	=> 'http://downloads.oreilly.com/make/04/indstrobe.mov',
		'/blog/04/flash/caps.mov'		=> 'http://downloads.oreilly.com/make/04/caps.mov',
		'/blog/save'					=> 'https://readerservices.makezine.com//MK/Subnew.aspx?PC=MK&PK=0EBSPL',
		'/blog/offer'					=> 'https://readerservices.makezine.com/MK/MKSubnew1.aspx?PC=MK',
		'/blog/bonus'					=> 'https://readerservices.makezine.com/MK/MKSubnew1.aspx?PC=MK',
		'/blog/talk'					=> 'http://makezine.com/forums',
		'/blog/fair'					=> 'http://makezine.com/faire/',
		'/blog/faire'					=> 'http://makerfaire.com/',
		'/blog/makerfaire'				=> 'http://makerfaire.com/',
		'/blog/06/legosoccer/focal'		=> 'http://digital.ni.com/public.nsf/allkb/29D716D6F4F1FBC386256AE700727AF6',
		'/blog/suboffer'				=> 'https://readerservices.makezine.com/MK/MKSubnew1.aspx?PC=MK',
		'/blog/weekendprojects'			=> 'http://makezine.com/weekendprojects/',
		'/blog/sff'						=> 'http://store.makezine.com/ProductDetails.asp?ProductCode=0596529201',
		'/blog/pdf'						=> 'http://www.makezine.com/blog/archive/make_pdf/',
		'/blog/store'					=> 'http://makershed.com/',
		'/blog/3D'						=> 'http://www.makezine.com/3d',
		'/blog/elementsofhumanity'		=> 'http://elementsofhumanity.com/',
		'/blog/pub/au/Terrie_Miller'	=> 'http://makezine.com/pub/au/Terrie_Schweitzer',
		'/blog/GO/HIW'					=> 'http://makezine.com/hardware-innovation-workshop/',
		'/blog/3Dspecial'				=> 'https://readerservices.makezine.com/MK/subscribe.aspx?PC=MK&PK=M25SCHO',
		'/blog/tellus/survey'			=> 'http://www.opinionpath.net/mke/cgi-bin/ciwweb.pl?studyname=mke',
		'/blog/mf2012'					=> 'https://readerservices.makezine.com/mk/subinfo.aspx?PC=MK&PK=M25MFIS&DO=R',
		'/blog/v/31'					=> 'http://makezine.com/31/',
		'/blog/craft/blog'				=> 'http://makezine.com/craftzine/',
		'/blog/craft/'					=> 'http://makezine.com/craft/',
		'/blog/move'					=> 'https://pubservice.com/SubGiftv2.aspx?PC=MK&PK=M2XBUS',
		'/blog/241'						=> 'https://www.pubservice.com/subgiftcombo.aspx?PC=MK&PK=42M241',
		'/blog/holidaygift'				=> 'https://pubservice.com/Subgiftcombo.aspx?PC=MK&PK=429HOL9',
		'/blog/bogo'					=> 'https://www.pubservice.com/subgiftcombo.aspx?PC=MK&PK=42BBN03',
		'/blog/PM241'					=> 'https://pubservice.com/Subgiftcombo.aspx?PC=MK&PK=42MPM24',
		'/blog/3Dfree'					=> 'https://readerservices.makezine.com/mk/subscribe.aspx?PC=MK&PK=B31BLB',
		'/blog/3Dbonus'					=> 'https://readerservices.makezine.com/mk/subscribe.aspx?PC=MK&PK=B31BIN',
		'/blog/33'						=> 'http://makezine.com/volume/make-33/',
		'/blog/5issues'					=> 'https://readerservices.makezine.com/mk/subscribe.aspx?PC=MK&PK=M34AIR',
		'/blog/3DPDF'					=> 'https://readerservices.makezine.com/mk/subscribe.aspx?PC=MK&PK=M35SIP',
		'/blog/3dpdf'					=> 'https://readerservices.makezine.com/mk/subscribe.aspx?PC=MK&PK=M35SIP',
		'/blog/34'						=> 'http://makezine.com/volume/make-34/',
		'/blog/maker-projects'			=> 'http://makezine.com/maker-projects/',
		'/blog/projects'				=> 'http://makezine.com/projects',
		'/blog/01'						=> 'http://archive.makezine.com/01/',
		'/blog/02'						=> 'http://archive.makezine.com/02/',
		'/blog/03'						=> 'http://archive.makezine.com/03/',
		'/blog/04'						=> 'http://archive.makezine.com/04/',
		'/blog/05'						=> 'http://archive.makezine.com/05/',
		'/blog/06'						=> 'http://archive.makezine.com/06/',
		'/blog/07'						=> 'http://archive.makezine.com/07/',
		'/blog/08'						=> 'http://archive.makezine.com/08/',
		'/blog/09'						=> 'http://archive.makezine.com/09/',
		'/blog/10'						=> 'http://archive.makezine.com/10/',
		'/blog/11'						=> 'http://archive.makezine.com/11/',
		'/blog/12'						=> 'http://archive.makezine.com/12/',
		'/blog/13'						=> 'http://archive.makezine.com/13/',
		'/blog/14'						=> 'http://archive.makezine.com/14/',
		'/blog/15'						=> 'http://archive.makezine.com/15/',
		'/blog/16'						=> 'http://archive.makezine.com/16/',
		'/blog/17'						=> 'http://archive.makezine.com/17/',
		'/blog/18'						=> 'http://archive.makezine.com/18/',
		'/blog/19'						=> 'http://archive.makezine.com/19/',
		'/blog/20'						=> 'http://archive.makezine.com/20/',
		'/blog/21'						=> 'http://archive.makezine.com/21/',
		'/blog/22'						=> 'http://archive.makezine.com/22/',
		'/blog/23'						=> 'http://archive.makezine.com/23/',
		'/blog/24'						=> 'http://archive.makezine.com/24/',
		'/blog/25'						=> 'http://archive.makezine.com/25/',
		'/blog/26'						=> 'http://archive.makezine.com/26/',
		'/blog/27'						=> 'http://archive.makezine.com/27/',
		'/blog/28'						=> 'http://archive.makezine.com/28/',
		'/blog/29'						=> 'http://archive.makezine.com/29/',
		'/blog/30'						=> 'http://archive.makezine.com/30/',
		'/blog/31'						=> 'http://archive.makezine.com/31/',
		'/blog/32'						=> 'http://archive.makezine.com/32/',
		'/blog/faq/index.html'			=> 'http://makezine.com/faq/',
		'/blog/community/index.html'	=> 'http://archive.makezine.com/community/index.html',
		'/blog/help/index.html'			=> 'http://archive.makezine.com/help/index.html',
		'/blog/hardware-innovation-workshop/videos.html' => 'http://archive.makezine.com/hardware-innovation-workshop/videos.html',
		'/blog/groups'					=> 'http://archive.makezine.com/groups/',
		'/blog/make-newsletter'			=> 'http://makezine.com/newsletter/',
		'/blog/page-2/'					=> 'http://makezine.com/page-2/',
		'/volume/make-36‎'				=> 'http://makezine.com/magazine/',
		'/volume/make-38‎'				=> 'http://makezine.com/magazine/',
		'/volume/make-39'				=> 'http://makezine.com/magazine/',
		'/volume/make-40‎'				=> 'http://makezine.com/magazine/',
		'/volume/make-41'				=> 'http://makezine.com/magazine/',
		'/volume/make-42‎'				=> 'http://makezine.com/magazine/',

		// Add redirects for instances that a blog folder isn't here.
		'/subscribe' 				=> 'https://readerservices.makezine.com/MK/MKSubnew1.aspx?PC=MK',
		'/renew'					=> 'https://readerservices.makezine.com/mk/subinfo.aspx?pc=mk',
		'/paybill'					=> 'https://readerservices.makezine.com/mk/subinfo.aspx?pc=mk',
		'/account'					=> 'https://readerservices.makezine.com/mk/subinfo.aspx?pc=mk',
		'/premier'					=> 'https://readerservices.makezine.com/mk/subinfo.aspx?pc=mk',
		'/coolgifts'				=> 'https://readerservices.makezine.com/backissue/subbi.aspx?PC=MK&AN=&Zp=&PK=',
		'/gift'						=> 'https://readerservices.makezine.com/mk/SubGiftSplash.aspx',
		'/04/strobe/indstrobe.mov'	=> 'http://downloads.oreilly.com/make/04/indstrobe.mov',
		'/04/flash/caps.mov'		=> 'http://downloads.oreilly.com/make/04/caps.mov',
		'/save'						=> 'https://readerservices.makezine.com//MK/Subnew.aspx?PC=MK&PK=0EBSPL',
		'/offer'					=> 'https://readerservices.makezine.com/MK/MKSubnew1.aspx?PC=MK',
		'/bonus'					=> 'https://readerservices.makezine.com/MK/MKSubnew1.aspx?PC=MK',
		'/talk'						=> 'http://makezine.com/forums',
		'/fair'						=> 'http://makezine.com/faire/',
		'/faire'					=> 'http://makerfaire.com/',
		'/makerfaire'				=> 'http://makerfaire.com/',
		'/06/legosoccer/focal'		=> 'http://digital.ni.com/public.nsf/allkb/29D716D6F4F1FBC386256AE700727AF6',
		'/suboffer'					=> 'https://readerservices.makezine.com/MK/MKSubnew1.aspx?PC=MK',
		'/sff'						=> 'http://store.makezine.com/ProductDetails.asp?ProductCode=0596529201',
		'/pdf'						=> 'http://www.makezine.com/blog/archive/make_pdf/',
		'/store'					=> 'http://makershed.com/',
		'/3D'						=> 'http://www.makezine.com/3d',
		'/elementsofhumanity'		=> 'http://elementsofhumanity.com/',
		'/pub/au/Terrie_Miller'		=> 'http://makezine.com/pub/au/Terrie_Schweitzer',
		'/GO/HIW'					=> 'http://makezine.com/hardware-innovation-workshop/',
		'/3Dspecial'				=> 'https://readerservices.makezine.com/MK/subscribe.aspx?PC=MK&PK=M25SCHO',
		'/tellus/survey'			=> 'http://www.opinionpath.net/mke/cgi-bin/ciwweb.pl?studyname=mke',
		'/mf2012'					=> 'https://readerservices.makezine.com/mk/subinfo.aspx?PC=MK&PK=M25MFIS&DO=R',
		'/v/31'						=> 'http://makezine.com/31/',
		'/craft/blog'				=> 'http://makezine.com/craftzine/',
		'/move'						=> 'https://pubservice.com/SubGiftv2.aspx?PC=MK&PK=M2XBUS',
		'/holidaygift'				=> 'https://pubservice.com/Subgiftcombo.aspx?PC=MK&PK=429HOL9',
		'/3Dfree'					=> 'https://readerservices.makezine.com/mk/subscribe.aspx?PC=MK&PK=B31BLB',
		'/3Dbonus'					=> 'https://readerservices.makezine.com/mk/subscribe.aspx?PC=MK&PK=B31BIN',
		'/33'						=> 'http://makezine.com/volume/make-33/',
		'/5issues'					=> 'https://readerservices.makezine.com/mk/subscribe.aspx?PC=MK&PK=M34AIR',
		'/3DPDF'					=> 'https://readerservices.makezine.com/mk/subscribe.aspx?PC=MK&PK=M35SIP',
		'/3dpdf'					=> 'https://readerservices.makezine.com/mk/subscribe.aspx?PC=MK&PK=M35SIP',
		'/magazine'					=> 'http://makezine.com/volume/make-38-cameras-and-av/',
		'/38'						=> 'http://makezine.com/volume/make-38-cameras-and-av/',
		'/36'						=> 'http://makezine.com/volume/make-36/',
		'/37'						=> 'http://makezine.com/volume/make-37/',
		'/35'						=> 'http://makezine.com/volume/make-35/',
		'/34'						=> 'http://makezine.com/volume/make-34/',
		'/01'						=> 'http://archive.makezine.com/01/',
		'/02'						=> 'http://archive.makezine.com/02/',
		'/03'						=> 'http://archive.makezine.com/03/',
		'/04'						=> 'http://archive.makezine.com/04/',
		'/05'						=> 'http://archive.makezine.com/05/',
		'/06'						=> 'http://archive.makezine.com/06/',
		'/07'						=> 'http://archive.makezine.com/07/',
		'/08'						=> 'http://archive.makezine.com/08/',
		'/09'						=> 'http://archive.makezine.com/09/',
		'/10'						=> 'http://archive.makezine.com/10/',
		'/11'						=> 'http://archive.makezine.com/11/',
		'/12'						=> 'http://archive.makezine.com/12/',
		'/13'						=> 'http://archive.makezine.com/13/',
		'/14'						=> 'http://archive.makezine.com/14/',
		'/15'						=> 'http://archive.makezine.com/15/',
		'/16'						=> 'http://archive.makezine.com/16/',
		'/17'						=> 'http://archive.makezine.com/17/',
		'/18'						=> 'http://archive.makezine.com/18/',
		'/19'						=> 'http://archive.makezine.com/19/',
		'/20'						=> 'http://archive.makezine.com/20/',
		'/21'						=> 'http://archive.makezine.com/21/',
		'/22'						=> 'http://archive.makezine.com/22/',
		'/23'						=> 'http://archive.makezine.com/23/',
		'/24'						=> 'http://archive.makezine.com/24/',
		'/25'						=> 'http://archive.makezine.com/25/',
		'/26'						=> 'http://archive.makezine.com/26/',
		'/27'						=> 'http://archive.makezine.com/27/',
		'/28'						=> 'http://archive.makezine.com/28/',
		'/29'						=> 'http://archive.makezine.com/29/',
		'/30'						=> 'http://archive.makezine.com/30/',
		'/31'						=> 'http://archive.makezine.com/31/',
		'/32'						=> 'http://archive.makezine.com/32/',
		'/the-weekend-projects'		=> 'http://makezine.com/weekendprojects',
		'/faq/index.html'			=> 'http://makezine.com/faq/',
		'/community/index.html'		=> 'http://archive.makezine.com/community/index.html',
		'/help/index.html'			=> 'http://archive.makezine.com/help/index.html',
		'/hardware-innovation-workshop/videos.html'	=> 'http://archive.makezine.com/hardware-innovation-workshop/videos.html',
		'/groups'					=> 'http://archive.makezine.com/groups/',
		'/make-newsletter'			=> 'http://makezine.com/newsletter/',
		'/magazine/newsletter/subscribe/free-digital-magazine.html'			=> 'http://archive.makezine.com/magazine/newsletter/subscribe/free-digital-magazine.html',
		'/unsubscribe/makershed.csp'			=> 'http://archive.makezine.com/unsubscribe/makershed.html',
		'/unsubscribe/makershed.html'			=> 'http://archive.makezine.com/unsubscribe/makershed.html',
		'/magazine/3D'              => '/volume/guide-to-3d-printing-2014/',

	);
	vip_redirects( $redirects );
}

/**
 * Handle URLs with underscores in the post_name. Turn:
 *      http://blog.makezine.com/2009/01/toolbox_from_miserable_old_box_to_w/
 * into:
 *      http://blog.makezine.com/2009/01/toolbox-from-miserable-old-box-to-w/
 * We could do this with regex but the regex approach is much more gnarly
 * @see http://vip-support.automattic.com/tickets/4424
 */
if ( false !== strpos( $_SERVER['REQUEST_URI'], '_' ) )
	add_action( 'template_redirect', 'makeblog_redirect_urls_with_underscores' );
function makeblog_redirect_urls_with_underscores( ) {
	if ( !is_404() || is_preview() )
		return;
	$new_uri = str_replace( '_', '-', $_SERVER['REQUEST_URI'] );
	$new_url = home_url( $new_uri );
	wp_safe_redirect( $new_url );
	exit;
}

/**
 * For pre-VIP launch URLs, modify the permalink within the_content so the share buttons
 * utilitize the old URL structure. Only modify it temporarily though, and remove after finished
 */
add_filter( 'the_content', 'makeblog_add_permalink_filter' );
function makeblog_add_permalink_filter( $the_content ) {
	global $post;

	if ( $post->ID <= 171681 ) {
		add_filter( 'post_link', 'makeblog_filter_the_content_permalink', 10, 2 );
		add_filter( 'pre_get_shortlink', 'makeblog_filter_the_content_shortlink', 10, 2 );
	}

	return $the_content;
}
add_filter( 'the_content', 'makeblog_remove_permalink_filter', 1000 );
function makeblog_remove_permalink_filter( $the_content ) {

	remove_filter( 'post_link', 'makeblog_filter_the_content_permalink' );
	remove_filter( 'pre_get_shortlink', 'makeblog_filter_the_content_shortlink' );
	return $the_content;
}
function makeblog_filter_the_content_permalink( $permalink, $post ) {

	// Replace the /yyyy/mm/dd/ structure with /archive/yyyy/mm/
	$old_date_struct = date( '/Y/m/d/', strtotime( $post->post_date ) );
	$new_date_struct = date( '/Y/m/', strtotime( $post->post_date ) );
	$new_date_struct = '/archive' . $new_date_struct;
	$permalink = str_replace( $old_date_struct, $new_date_struct, $permalink );

	// Remove the trailing slash and append .html
	$permalink = rtrim( $permalink, '/' );
	$permalink .= '.html';
	return $permalink;
}
function makeblog_filter_the_content_shortlink( $ret, $post_id ) {

	$permalink = get_permalink( $post_id );
	return $permalink;
}

vip_main_feed_redirect( 'http://feeds.feedburner.com/makezineonline' );


add_action( 'init', function() {
    if ( 0 === strpos( $_SERVER['REQUEST_URI'], '/pub/' ) ) {
        wp_redirect( esc_url_raw( 'http://archive.makezine.com' . $_SERVER['REQUEST_URI'] ) );
        exit;
    }
} );

// Sets ElasticSearch facets
add_action( 'after_setup_theme', function() {

    if ( ! function_exists( 'WPCOM_elasticsearch' ) )
        return;

    WPCOM_elasticsearch()->set_facets( array(
        'Content Type' => array(
            'type'     => 'post_type',
            'count'    => 10,
        ),
        'Categories' => array(
            'type'     => 'taxonomy',
            'taxonomy' => 'category',
            'count'    => 10,
        ),
        'Tags' => array(
            'type'     => 'taxonomy',
            'taxonomy' => 'post_tag',
            'count'    => 10,
        ),
        'Year' => array(
            'type'     => 'date_histogram',
            'field'    => 'post_date',
            'interval' => 'year',
            'count'    => 10,
        ),
        'Month' => array(
            'type'     => 'date_histogram',
            'field'    => 'post_date',
            'interval' => 'month',
            'count'    => 10,
        ),
    ) );
});
