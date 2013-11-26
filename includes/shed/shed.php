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

	$counter = range( 0, ( count( $products ) - 1 ) );

	shuffle( $counter );

	$rand = mt_rand(0, 100);
	$id = 'shed-' . $rand;

	$output = '<div id="' . $id . '" class="carousel slide" data-interval="false"><div class="carousel-inner"><div class="row">';

	foreach ( $counter as $key => $i ) {
		$output .= '<div class="span3 shed">';
		$output .= '<a href="' . make_shed_url( $products[$i]->ProductCode ) . '"><img src="' . wpcom_vip_get_resized_remote_image_url( $products[$i]->PhotoURL, 218, 146 ) . '" alt="' . esc_attr( $products[$i]->Product_Name ) . '" /></a>';
		$output .= '<h4><a href="';
		$output .= make_shed_url( esc_attr( $products[$i]->ProductCode ) );
		$output .= '">';
		$output .= wp_kses_post( $products[$i]->ProductName );
		$output .= '</a></h4>';
		$output .= MarkDown( wp_trim_words( wp_kses_post( $products[$i]->ProductDescriptionShort ), 15, '...' ) );
		$output .= '</div>';
		if ( $key == 3 ) {
			break;
		}
	}
	$output .= '</div></div></div>';
	return $output;
}
/**
 * Build a URL from the Shed product code.
 */
function make_shed_url( $code ) {
	return esc_url( 'http://www.makershed.com/ProductDetails.asp?&Click=107309&ProductCode=' . $code  );
}