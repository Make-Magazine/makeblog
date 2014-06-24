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
	$xml = wpcom_vip_file_get_contents( $url, 3, 60,  array( 'obey_cache_control_header' => true ) );
	// If a bad response, bail.
	if ( ! $xml )
		return;

	// If not XML, bail.
	$simpleXmlElem = simplexml_load_string( $xml );
	if ( ! $simpleXmlElem )
		return;

	$products = $simpleXmlElem->Product;

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
		$output .= '<a target="_blank" onClick="_gaq.push([\'_trackEvent\', \'Links\', \'Click\', \'Maker Shed - ' . esc_js( $products[$product]->ProductName ) . '\']);" href="' . esc_url( make_shed_url( $products[$product]->ProductCode ) ) . '">';
		$output .= '<img src="' . wpcom_vip_get_resized_remote_image_url( $products[$product]->PhotoURL, 218, 146 ) . '" alt="' . esc_attr( $products[$product]->Product_Name ) . '" />';
		$output .= '</a>';
		$output .= '<h4><a target="_blank" href="';
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


/**
 * Build a featured products slider for Shed products
 *
 *
 * Usage:
 * 	if ( function_exists('make_shopify_featured_products_slider') ) {
 * 		echo make_shopify_featured_products_slider( 'row-fluid' ); // If this is a category page, use 'row' as the parameter. (Or, just leave empty...)
 * 	}
 */
function make_shopify_featured_products_slider( $row = 'row' ) {
	// Let's get the data feed

	$url = 'https://my.datafeedwatch.com/static/files/1596/324605c6815f680a42b42b83010f9c5b886bb32e.xml';
	$xml = wpcom_vip_file_get_contents( $url, 3, 60*60,  array( 'obey_cache_control_header' => true ) );

	// If a bad response, bail.
	if ( ! $xml )
		return;

	// If not XML, bail.
	$simpleXmlElem = simplexml_load_string( $xml );
	if ( ! $simpleXmlElem )
		return;

	$products = $simpleXmlElem->item_data;

	// Randomize the counter so that we can get random products.
	$counter = range( 0, ( count( $products ) - 1 ) );
	shuffle( $counter );

	// Carousel ID
	$id = 'shed-' . mt_rand(0, 100);

	// Build the main link, and the carousel wrapper
	$output = '<h2 class="look_like_h3"><a onClick="_gaq.push([\'_trackEvent\', \'Links\', \'Click\', \'Maker Shed - Products\']);" href="http://makershed.com">Featured Products from the MakerShed</a></h2>';
	$output .= '<div id="' . intval( $id ) . '" class="carousel slide" data-interval="false"><div class="carousel-inner"><div class="item active"><div class="' . esc_attr( $row ) . '">';

	// Start the product loop.
	foreach ( $counter as $i => $product ) {
		$output .= '<div class="span3 shed">';
		// Add the same click tracker.
		$output .= '<a target="_blank" onClick="_gaq.push([\'_trackEvent\', \'Links\', \'Click\', \'Maker Shed - ' . esc_js( $products[$product]->item_name ) . '\']);" href="' . esc_url( $products[$product]->item_page_url ) . '">';
		$output .= '<img src="' . wpcom_vip_get_resized_remote_image_url( $products[$product]->item_image_url, 218, 146 ) . '" alt="' . esc_attr( $products[$product]->item_name ) . '" />';
		$output .= '</a>';
		$output .= '<h4><a target="_blank" href="';
		// make_shed_url() has esc_url() on it already. But hey, let's add it again.
		$output .= esc_url( $products[$product]->item_page_url );
		$output .= '">';
		$output .= wp_kses_post( $products[$product]->item_name );
		$output .= '</a></h4>';
		$output .= MarkDown( wp_trim_words( wp_kses_post( $products[$product]->item_short_desc ), 15, '...' ) );
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
 * The old shed product feed.
 *
 * Grabs the feed of featured products, randomizes it, and then spits out the products at the bottom of blog posts and archive pages.
 * @return 	string HTML for featured products.
 */
function make_featured_products() {

	$url = 'http://makershed.com/net/webservice.aspx?api_name=generic\featured_products';
	$xml = wpcom_vip_file_get_contents( $url, 3, 60*60,  array( 'obey_cache_control_header' => false ) );

	if ( ! $xml )
		return;

	$simpleXmlElem = simplexml_load_string( $xml );
	if ( ! $simpleXmlElem )
		return;

	$products = $simpleXmlElem->Product;
	$products_count = count($products);
	if ($products_count > 8) {
		$input = range(1,$products_count);
		$arr = array_rand($input, 4);
	} else {
		$input = range(1,8);
		$arr = array_rand($input, 4);
	}


?>
<div class="clearfix"></div>
<div class="features well">

<h3>In the <a href="http://www.makershed.com/?Click=107309">Maker Shed</a></h3>

<?php if (isset($products[$arr[0]])) { ?>

	<div class="twenty-five">

	<a href="http://www.makershed.com/ProductDetails.asp?&Click=107309&ProductCode=<?php echo $products[$arr[0]]->ProductCode; ?>">
		<?php
			if ( function_exists( 'wpcom_vip_get_resized_remote_image_url' ) ) {
				echo '<img src="' . wpcom_vip_get_resized_remote_image_url( $products[$arr[0]]->PhotoURL, 115, 115 ) . '" alt="'. $products[$arr[0]]->ProductName.'" />';
			} else {
				echo '<img src="'.$products[$arr[0]]->PhotoURL.'" alt="'. $products[$arr[0]]->ProductName.'" class="small-thumb"/>';
			}
		?>
	</a>

	<div class="clear"></div>

	<div class="blurb">

		<h4><a href="http://www.makershed.com/ProductDetails.asp?&Click=107309&ProductCode=<?php echo $products[$arr[0]]->ProductCode; ?>"><?php echo $products[$arr[0]]->ProductName; ?></a></h4>

	</div>

	</div>

<?php } ?>

<?php if (isset($products[$arr[1]])) { ?>

<div class="twenty-five">

	<a href="http://www.makershed.com/ProductDetails.asp?&Click=107309&ProductCode=<?php echo $products[$arr[1]]->ProductCode; ?>">
		<?php
			if ( function_exists( 'wpcom_vip_get_resized_remote_image_url' ) ) {
				echo '<img src="' . wpcom_vip_get_resized_remote_image_url( $products[$arr[1]]->PhotoURL, 115, 115 ) . '" alt="'. $products[$arr[1]]->ProductName.'" />';
			} else {
				echo '<img src="'.$products[$arr[1]]->PhotoURL.'" alt="'. $products[$arr[1]]->ProductName.'" class="small-thumb"/>';
			}
		?>
	</a>

<div class="clear"></div>

<div class="blurb">

	<h4><a href="http://www.makershed.com/ProductDetails.asp?&Click=107309&ProductCode=<?php echo $products[$arr[1]]->ProductCode; ?>"><?php echo $products[$arr[1]]->ProductName; ?></a></h4>

</div>

</div>

<?php } ?>

<?php if (isset($products[$arr[2]])) { ?>

	<div class="twenty-five">

	<a href="http://www.makershed.com/ProductDetails.asp?&Click=107309&ProductCode=<?php echo $products[$arr[2]]->ProductCode; ?>">
		<?php
			if ( function_exists( 'wpcom_vip_get_resized_remote_image_url' ) ) {
				echo '<img src="' . wpcom_vip_get_resized_remote_image_url( $products[$arr[2]]->PhotoURL, 115, 115) . '" alt="'. $products[$arr[2]]->ProductName.'" />';
			} else {
				echo '<img src="'.$products[$arr[2]]->PhotoURL.'" alt="'. $products[$arr[2]]->ProductName.'" class="small-thumb"/>';
			}
		?>
	</a>

	<div class="clear"></div>

	<div class="blurb">

		<h4><a href="http://www.makershed.com/ProductDetails.asp?&Click=107309&ProductCode=<?php echo $products[$arr[2]]->ProductCode; ?>"><?php echo $products[$arr[2]]->ProductName; ?></a></h4>

	</div>

	</div>

<?php } ?>

<?php if (isset($products[$arr[3]])) { ?>

<div class="twenty-five">

	<a href="http://www.makershed.com/ProductDetails.asp?&Click=107309&ProductCode=<?php echo $products[$arr[3]]->ProductCode; ?>">
		<?php
			if ( function_exists( 'wpcom_vip_get_resized_remote_image_url' ) ) {
				echo '<img src="' . wpcom_vip_get_resized_remote_image_url( $products[$arr[3]]->PhotoURL, 115, 115 ) . '" alt="'. $products[$arr[2]]->ProductName.'" />';
			} else {
				echo '<img src="'.$products[$arr[3]]->PhotoURL.'" alt="'. $products[$arr[3]]->ProductName.'" class="small-thumb"/>';
			}
		?>
	</a>

<div class="clear"></div>

<div class="blurb">

	<h4><a href="http://www.makershed.com/ProductDetails.asp?&Click=107309&ProductCode=<?php echo $products[$arr[3]]->ProductCode; ?>"><?php echo $products[$arr[3]]->ProductName; ?></a></h4>

</div>

</div>

<?php } ?>

<div class="clear"></div>

</div>

<div class="clear"></div>

<?php }
