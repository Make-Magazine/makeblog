<?php
/**
 * Functions for the Maker Shed
 */

/**
 * Build a featured products slider for Shed products
 */
function make_featured_products_slider() {
	// Let's get the data feed
	$url = 'http://makershed.com/net/webservice.aspx?api_name=generic\featured_products';
	$xml = wpcom_vip_file_get_contents( $url, 3, 60*60,  array( 'obey_cache_control_header' => true ) );

	// If a bad response, bail.
	if ( ! $xml )
		return;

	// If not XML, bail.
	$simpleXmlElem = simplexml_load_string( $xml );
	if ( ! $simpleXmlElem )
		return;
	

	// Setup some variables
	$xml_featured_products = $simpleXmlElem->asXML();
	
	$featured_products = simplexml_load_string( $xml_featured_products );
	$products = $featured_products->Product;

	// Randomize the counter so that we can get random products.
	$counter = range( 0, ( count( $products ) - 1 ) );
	shuffle( $counter );

	// Carousel ID
	$id = 'shed-' . mt_rand(0, 100);

	// Build the main link, and the carousel wrapper
	$output = '<h2 class="look_like_h3"><a onClick="_gaq.push([\'_trackEvent\', \'Links\', \'Click\', \'Maker Shed - Products\']);" href="http://makershed.com">Featured Products from the MakerShed</a></h2>';
	$output .= '<div id="' . intval( $id ) . '" class="carousel slide" data-interval="false"><div class="carousel-inner"><div class="item active"><div class="row">';

	// Start the product loop.
	foreach ( $counter as $i => $product ) {
		$output .= '<div class="span3 shed">';
		// Add the same click tracker.
		$output .= '<a target=="_blank" onClick="_gaq.push([\'_trackEvent\', \'Links\', \'Click\', \'Maker Shed - ' . esc_js( $products[$product]->ProductName ) . '\']);" href="' . esc_url( make_shed_url( $products[$product]->ProductCode ) ) . '">';
		$output .= '<img src="' . wpcom_vip_get_resized_remote_image_url( $products[$product]->PhotoURL, 218, 146 ) . '" alt="' . esc_attr( $products[$product]->Product_Name ) . '" />';
		$output .= '</a>';
		$output .= '<h4><a target=="_blank" href="';
		// make_shed_url() has esc_url() on it already. But hey, let's add it again.
		$output .= esc_url( make_shed_url( esc_attr( $products[$product]->ProductCode ) ) );
		$output .= '">';
		$output .= wp_kses_post( $products[$product]->ProductName );
		$output .= '</a></h4>';
		$output .= MarkDown( wp_trim_words( wp_kses_post( $products[$product]->ProductDescriptionShort ), 15, '...' ) );
		$output .= '</div>';
		// Just show four posts, for now.
		if ( $i == 3 ) {
			break;
		}
	}
	// Close out the markup.
	$output .= '</div></div></div></div>';

	// Return the content.
	return $output;
}
/**
 * Build a URL from the Shed product code.
 */
function make_shed_url( $code ) {
	return esc_url( 'http://www.makershed.com/ProductDetails.asp?&Click=107309&ProductCode=' . $code  );
}