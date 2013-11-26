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
	$products_count = count( $products );

	var_dump( $products_count );

	if ( $products_count > 8 ) {
		$input = range(1, $products_count);
		$arr = array_rand($input, 4);
	} else {
		$input = range(1, 8);
		$arr = array_rand($input, 4);
	}

}