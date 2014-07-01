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
  $output .= '<div id="<?php echo esc_attr( intval( $id ) ); ?>" class="carousel slide" data-interval="false"><div class="carousel-inner"><div class="item active"><div class="row">';

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
 *   if ( function_exists('make_shopify_featured_products_slider') ) {
 *     echo make_shopify_featured_products_slider( 'row-fluid' ); // If this is a category page, use 'row' as the parameter. (Or, just leave empty...)
 *   }
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
  This is an abstraction of the xml feed results to handle failover
  @return results of xml results
 */

function grab_xml_feed() {
  $url = 'http://makershed.com/net/webservice.aspx?api_name=generic\featured_products';
  $xml = wpcom_vip_file_get_contents( $url, 3, 60*60,  array( 'obey_cache_control_header' => false ) );
  return $xml;
}

/**
 * The old shed product feed.
 *
 * Grabs the feed of featured products, randomizes it, and then spits out the products at the bottom of blog posts and archive pages.
 * @return   string HTML for featured products.
 */
function make_featured_products() {


  $xml = false; #get_transient("in-the-maker-shed");
  // no cache available so grab it and set it.
  if(!$xml) {
    $xml = grab_xml_feed();
    if(is_wp_error($xml)) {
      $error_string = $xml->get_error_message();
      echo '<div id="message" class="error hide"><p>' . $error_string . '</p></div>';
    } else if($xml) {
      // set cache
      set_transient("in-the-maker-shed", $xml, 60*60*12);
    }
  }

  if(!$xml) {
    return;
  }

  // Testing for XML, if not available, just return from function call -- no output;

  $simpleXmlElem = simplexml_load_string( $xml );
  if ( ! $simpleXmlElem ) {
    echo '<div id="message" class="error hide"><p>Can\'t parse XML.</p></div>';
    return;
  }

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
  <?php for($i = 0; $i < 4; $i++): ?>
    <div class="twenty-five">
      <a href="<?php echo esc_url( 'http://www.makershed.com/ProductDetails.asp?&Click=107309&ProductCode=' . $products[$arr[$i]]->ProductCode ); ?>">
        <?php
          if ( function_exists( 'wpcom_vip_get_resized_remote_image_url' ) ) {
            echo '<img src="' . wpcom_vip_get_resized_remote_image_url( $products[$arr[$i]]->PhotoURL, 115, 115 ) . '" alt="'. esc_attr( $products[$arr[$i]]->ProductName ) .'" />';
          } else {
            echo '<img src="' . esc_url( $products[$arr[$i]]->PhotoURL ) .'" alt="'. esc_attr( $products[$arr[$i]]->ProductName ) .'" class="small-thumb"/>';
          }
        ?>
      </a>
      <div class="clear"></div>
      <div class="blurb">
        <h4>
        <a href="<?php echo esc_url( 'http://www.makershed.com/ProductDetails.asp?&Click=107309&ProductCode=' . $products[$arr[$i]]->ProductCode ); ?>"><?php echo esc_html( $products[$arr[$i]]->ProductName ); ?></a>
        </h4>
      </div>
    </div>
  <?php endfor; ?>
  <div class="clear"></div>
</div><!-- /features-well -->

<?php }
