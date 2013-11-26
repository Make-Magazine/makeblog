<?php
/**
 * Functions for the Maker Shed
 */

/**
 * Build a featured products slider for Shed products
 */
function make_featured_products_slider() {
	$url = 'http://makershed.com/net/webservice.aspx?api_name=generic\featured_products';
	$xml = wpcom_vip_file_get_contents( $url, 3, 60*60,  array( 'obey_cache_control_header' => true ) );

	if ( ! $xml )
		return;

	$simpleXmlElem = simplexml_load_string( $xml );
	if ( ! $simpleXmlElem )
		return;
	
	$xml_featured_products = $simpleXmlElem->asXML();
	$featured_products = simplexml_load_string($xml_featured_products);

	$products = $featured_products->Product;

	$i = 0;
	while ( $i <= 3 ) {
		var_dump( $products[$i] );
		$i++;
	}
}