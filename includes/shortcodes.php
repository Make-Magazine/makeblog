<?php

function the_excerpt_max_charlength($charlength) {
	$excerpt = get_the_excerpt();
	$charlength++;
	if(strlen($excerpt)>$charlength) {
		$subex = substr($excerpt,0,$charlength-5);
		$exwords = explode(" ",$subex);
		$excut = -(strlen($exwords[count($exwords)-1]));
		if($excut<0) {
			return substr($subex,0,$excut);
		} else {
			return $subex;
		}
		return "...";
		} else {
		return $excerpt;
	}
}


function make_recent_arduino($atts){

	extract(shortcode_atts(array('limit' => 5), $atts));
	$q = new WP_Query('cat=62&posts_per_page=' . $limit);
	$list = '<h4>Latest posts from makezine.com:</h4>';
	while($q->have_posts()) : $q->the_post();
		$list .= '<h2 class="entry-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a>' . '</h2><p>' .the_excerpt_max_charlength(200) . '...</p>';
	endwhile;
	wp_reset_query();
	return $list;
}

add_shortcode('recent_arduino', 'make_recent_arduino');

function make_ad_block_shortcode( $atts, $content = null ) {
	return 	'<div style="width:125px;height:125px;float:right;margin-top:0px;padding:0 10px 5px;">
		<div id=\'div-gpt-ad-664089004995786621-10\'>
			<script type=\'text/javascript\'>
				googletag.cmd.push( function(){ googletag.display(\'div-gpt-ad-664089004995786621-10\') } );
			</script>
		</div>
	</div>';
}

add_shortcode( 'ad_block', 'make_ad_block_shortcode' );


function make_projects_newsletter( $atts, $content = null ) {
	return '<form class="form-stacked" action="http://makermedia.createsend.com/t/r/s/qhiiyu/" method="post" id="subForm"><fieldset>		<legend>Sign Up for the "Weekend Projects" Newsletter</legend><div class="clearfix"><label for="name">Name:</label><div class="input">				<input class="xlarge" id="name" name="cm-name" size="30" type="text"></div></div><!-- /clearfix --><div class="clearfix"><label for="qhiiyu-qhiiyu">Email:</label><div class="input"><input class="xlarge" id="qhiiyu-qhiiyu" name="cm-qhiiyu-qhiiyu" size="30" type="text"></div></div><!-- /clearfix --></fieldset><div class="actions"><button type="submit" class="btn btn-primary">Subscribe</button>	</div></form>';
}
add_shortcode( 'weekend_projects', 'make_projects_newsletter' );

function make_newsletter( $atts, $content = null ) {
	return '
		<form class="form-stacked" action="http://makermedia.createsend.com/t/r/s/jjuylk/" method="post" id="subForm">
			<fieldset>
				<legend>Sign up for the Make: Newsletter</legend>
				<div class="clearfix">
					<label for="name">Name:</label>
					<div class="input">
						<input class="xlarge" id="name" name="cm-name" size="30" type="text">
					</div>
				</div>
				<!-- /clearfix -->
				<div class="clearfix">
					<label for="jjuylk-jjuylk">Email:</label>
					<div class="input">
						<input class="xlarge" id="jjuylk-jjuylk" name="cm-jjuylk-jjuylk" size="30" type="text">
					</div>
				</div>
				<!-- /clearfix -->
			</fieldset>
			<div class="actions">
				<button type="submit" class="btn btn-primary">Subscribe</button>
			</div>
		</form>';
}
add_shortcode( 'newsletter', 'make_newsletter' );

function make_marketron_newsletter( $atts, $content = null ) {
	return '
		<form class="form-stacked" action="http://makermedia.createsend.com/t/r/s/jrsydu/" method="post" id="subForm">
			<fieldset>
				<legend><p><em>From the editors of MAKE magazine, the Maker Pro Newsletter is about the impact of makers on business and technology. Our coverage includes hardware startups, new products, incubators, innovators, along with technology and market trends. Please send items to us at <a href="mailto:makerpro@makermedia.com">makerpro@makermedia.com</a>.</em></p></legend>
				<div>
					<label for="name">Name:</label>
					<div class="input">
						<input class="xlarge" id="name" name="cm-name" size="30" type="text">
					</div>
				</div>
				<div>
					<label for="jrsydu-jrsydu">Email:</label>
					<div class="input">
						<input class="xlarge" id="jrsydu-jrsydu" name="cm-jrsydu-jrsydu" size="30" type="text">
					</div>
				</div>
			</fieldset>
			<div class="actions">
				<button type="submit" class="btn btn-large btn-primary">Subscribe</button>
			</div>
			<p></p>
			<legend></legend>
		</form>';
}
add_shortcode( 'makerpro', 'make_marketron_newsletter' );

function meetup_newsletter( $atts, $content = null ) {
	return '
		<form class="form-stacked" action="http://newsletter.makezine.com/t/r/s/juiuilk/" method="post" id="subForm">
			<fieldset>
				<legend>Enter for a chance to win one of five Ultimate Arduino Microcontroller Packs! All entries will receive a free PDF of MAKE volume 35: Danger! </legend>
				<div class="clearfix">
					<label for="name">Name:</label>
					<div class="input">
						<input class="xlarge" id="name" name="cm-name" size="30" type="text">
					</div>
				</div>
				<!-- /clearfix -->
				<div class="clearfix">
					<label for="juiuilk-juiuilk">Email:</label>
					<div class="input">
						<input class="xlarge" id="juiuilk-juiuilk" name="cm-juiuilk-juiuilk" size="30" type="text">
					</div>
				</div>
				<!-- /clearfix -->
				<div class="clearfix">
					<div class="control-group">
						<div class="controls">
							<label class="checkbox" for="MAKENewsletter">MAKE Newsletter<input type="checkbox" name="cm-ol-jjuylk" id="MAKENewsletter" /></label>
							<label class="checkbox" for="MakerShed-MasterList">Maker Shed<input type="checkbox" name="cm-ol-tyvyh" id="MakerShed-MasterList" /></label>
							<label class="checkbox" for="MakerProNewsletter">Maker Pro Newsletter<input type="checkbox" name="cm-ol-jrsydu" id="MakerProNewsletter" /></label>
						</div>
					</div>
				</div>
				<!-- /clearfix -->
			</fieldset>
			<div class="actions">
				<button type="submit" class="btn btn-primary">Subscribe</button>
			</div>
		</form>';
}
add_shortcode( 'meetup', 'meetup_newsletter' );

add_shortcode( 'newsletter', 'make_newsletter' );

/**
 * Signup form for Galileo Book
 * http://makezine.com/books/getting-started-with-intel-galileo/
 */
function galileo_list( $atts, $content = null ) {
	return '
		<div id="galileo_form">
			<form class="form-stacked" action="http://newsletter.makezine.com/t/r/s/ttdutih/" method="post" id="subForm">
				<fieldset>
					<label for="name">Name:</label>
					<div class="input">
						<input class="xlarge" id="name" name="cm-name" size="30" type="text">
					</div>
					<label for="ttdutih-ttdutih">Email:</label>
					<div class="input">
						<input class="xlarge" id="ttdutih-ttdutih" name="cm-ttdutih-ttdutih" size="30" type="text">
					</div>
				<label for="juiuilk-juiuilk">Educational Institution:</label>
					<div class="input">
						<input class="xlarge" id="fieldjtvkhd-fieldjtvkhd" name="cm-f-jtvkhd" size="30" type="text">
					</div>
				<label for="juiuilk-juiuilk">Role:</label>
					<div class="input">
					 <select id="fieldjtvkhh" name="cm-fo-jtvkhh">
						<option value="4420691">Student</option>
						<option value="4420692">Professor</option>
					</select>
					</div>
				</fieldset>
				<div class="actions">
					<button type="submit" class="btn btn-primary btn-large">Submit</button>
				</div>
			</form>
		</div>';
}
add_shortcode( 'gal', 'galileo_list' );

/**
 * Signup form for free pdf copy of Galileo Book (different list then galileo_list)
 * http://makezine.com/books/getting-started-with-intel-galileo/
 */
function download_galileo( $atts, $content = null ) {
	return '
		<form class="form-stacked" action="http://newsletter.makezine.com/t/r/s/tiirbu/" method="post" id="subForm">
			<fieldset>
				<div class="clearfix">
					<label for="name">Name:</label>
					<div class="input">
						<input class="xlarge" id="name" name="cm-name" size="30" type="text">
					</div>
				</div>
				<!-- /clearfix -->
				<div class="clearfix">
					<label for="tiirbu-tiirbu">Email:</label>
					<div class="input">
						<input class="xlarge" id="tiirbu-tiirbu" name="cm-tiirbu-tiirbu" size="30" type="text">
					</div>
				</div>
				<!-- /clearfix -->
				<div class="clearfix">
					<div class="control-group">
						<div class="controls">
							<label class="checkbox" for="MAKENewsletter">MAKE Newsletter<input type="checkbox" name="cm-ol-jjuylk" id="MAKENewsletter" /></label>
							<label class="checkbox" for="MAKENewsletter">Maker Faire Newsletter<input type="checkbox" name="cm-ol-jjuruj" id="MAKENewsletter" /></label>
							<label class="checkbox" for="MakerShed-MasterList">Maker Shed<input type="checkbox" name="cm-ol-tyvyh" id="MakerShed-MasterList" /></label>
							<label class="checkbox" for="MakerProNewsletter">Maker Pro Newsletter<input type="checkbox" name="cm-ol-jrsydu" id="MakerProNewsletter" /></label>
						</div>
					</div>
				</div>
				<!-- /clearfix -->
			</fieldset>
			<div class="actions">
				<button type="submit" class="btn btn-primary">Subscribe</button>
			</div>
		</form>';
}
add_shortcode( 'freegal', 'download_galileo' );

/**
 * Adds check boxes for newsletter signup.
 * This can be deleted after the sweepstakes are over. Dec. 2013
 * http://makezine.com/meetup/3dprinter/
 */

function printrbot_sweepstakes_newsletter( $atts, $content = null ) {
	return '
		<form action="http://newsletter.makezine.com/t/r/s/tyilklk/" method="post">
			<p>
				<label for="fieldName">Name</label>
				<input id="fieldName" class="input-large" name="cm-name" type="text" />
			</p>
			<p>
				<label for="fieldEmail">Email</label>
				<input id="fieldEmail" class="input-large" name="cm-tyilklk-tyilklk" type="email" required />
			</p>
			<p>
				<label>Opt into another list</label>
				<input id="listjjuylk" name="cm-ol-jjuylk" type="checkbox" /> <label style="display:inline;" for="listjjuylk">MAKE Newsletter</label><br>
				<input id="listjrsydu" name="cm-ol-jrsydu" type="checkbox" /> <label style="display:inline;" for="listjrsydu">Maker Pro Newsletter</label><br>
				<input id="listttihir" name="cm-ol-ttihir" type="checkbox" /> <label style="display:inline;" for="listttihir">Maker Shed Newsletter</label><br>
			</p>
			<p>
				<button class="btn blue btn-large" type="submit">Submit</button>
			</p>
		</form>';
}
add_shortcode( 'printrbot', 'printrbot_sweepstakes_newsletter' );

function maker_camp_list( $atts, $content = null ) {
	return '
		<form class="form-stacked" action="http://makermedia.createsend.com/t/r/s/jdilcj/" method="post" id="subForm">
			<fieldset>
				<legend>Join Make: Training Camp Mailing List</legend>
				<div class="clearfix">
					<label for="name">Name:</label>
					<div class="input">
						<input class="xlarge" id="name" name="cm-name" size="30" type="text">
					</div>
				</div>
				<!-- /clearfix -->
				<div class="clearfix">
					<label for="jdilcj-jdilcj">Email:</label>
					<div class="input">
						<input class="xlarge" id="jrsydu-jrsydu" name="cm-jdilcj-jdilcj" size="30" type="text">
					</div>
				</div>
				<!-- /clearfix -->
			</fieldset>
			<div class="actions">
				<button type="submit" class="btn btn-primary">Join</button>
			</div>
		</form>';
}
add_shortcode( 'maker-camp', 'maker_camp_list' );

function youtube_playlist( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'width' => '370',
		'height' => '208',
	), $atts ) );

	return '<iframe width="' . esc_html($width) . '" height="' . esc_html( $height ) . '" src="'. esc_url( 'http://www.youtube.com/embed/videoseries?list=' . $content . '&amp;hl=en_US' ) .'" frameborder="0" allowfullscreen></iframe>';
}
add_shortcode( 'youtube_playlist', 'youtube_playlist' );

function make_subscribe_iframe( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'page' => 'subscribe',
		'height' => '1000',
	), $atts ) );

	return '<iframe width="100%" height="' . esc_attr( (int)$height ) . '" src="'. esc_url( 'http://espdev.espcomp.net/mk/' . $content . '.aspx?PC=MK' ) .'" frameborder="0"></iframe>';
}
add_shortcode( 'subscribe', 'make_subscribe_iframe' );

function make_printing_guide_blurb() {

	$output = null;

	if ( 'review' == get_post_type() ) {
		$output .= '<p>To read the full review, buy the Make: Ultimate Guide to 3D Printing.</p>';
	}

	$output .= '<div class="alert alert-info">

			<img src="' . esc_url( get_stylesheet_directory_uri() ) . '/img/SIP4_Cover_RGB1.jpg" class="thumbnail pull-right" style="width:125px; height: auto;" />

			<h4>2013 MAKE Ultimate Guide To 3D Printing</h4>

			<ul>
				<li>3D Printers Buyer\'s Guide &mdash; 15 Reviewed</li>
				<li>Getting Started in 3D</li>
				<li>Learn the Software Toolchain</li>
				<li>3D Design for Beginners</li>
				<li>3D Printing without a Printer</li>

			</ul>

			<p><a class="btn btn-primary" href="http://www.makershed.com/Make_Ultimate_Guide_to_3D_Printing_p/1449357377.htm">Buy now!</a></p>

			<h4>Just Released! <a href="' . esc_url( get_permalink( 322813 ) ) . '">2014 MAKE Ultimate Guide To 3D Printing</a></h4>

		</div>';

	if ( 'review' == get_post_type() ) {
		$output .= "<p>We want to hear from you!  Share your experiences with this machine, what you like, what you don't like, where you think our test team got it wrong. We hope you’ll join in the discussion. We’d also love to see the things that you design and print out.</p>";
	}

	return $output;
}

add_shortcode( 'printing', 'make_printing_guide_blurb' );


function make_volume_blurb() {

	$output = '<div class="alert alert-info">

			<img src="' . get_stylesheet_directory_uri() . '/img/MAKE_V33_high.jpg" class="thumbnail pull-right" style="width:125px; margin-left:10px; height: auto;" />

			<p><strong>MAKE Volume 33</strong> features our special Software for Makers section covering apps for circuit board design, 3D design and printing, microcontrollers, and programming for kids. Also, meet our new Arduino-powered Rovera robot and get started with Raspberry Pi. As usual, you’ll also find fascinating makers inside, like the maniacs on our cover, the hackers behind the popular Power Racing Series events at Maker Faire.</p>

			<p>Try your hand at 22 great DIY projects, like the Optical Tremolo guitar effects box, "Panjolele" cake-pan ukelele, Wii Nunchuk Mouse, CNC joinery tricks, treat-dispensing cat scratching post, laser-cut flexing wooden books, sake brewing, growing incredibly hot “ghost chili” peppers, and much more.</p>

			<p>On newsstands now, by <a href="https://readerservices.makezine.com/mk/subscribe.aspx?PC=MK&amp;PK=M3ANEWT">subscription</a>, or available in the <a href="http://www.makershed.com/Make_Volume_33_p/mmv33.htm">Maker Shed</a></p>

			<p><a class="btn btn-primary" href="http://www.makershed.com/ProductDetails.asp?ProductCode=9781449327651-P">Buy now!</a></p>

		</div>';
	return $output;
}

add_shortcode( 'old_volume', 'make_volume_blurb' );

function make_blurb_add_shortcode( $content ) {
	global $post;
	if ( '246865' == $post->post_parent ) {
		$content = $content . do_shortcode( '[old_volume]' );
		return $content;
	} else {
		return $content;
	}
}

add_filter( 'the_content', 'make_blurb_add_shortcode' );

function make_holiday_banner() {
	return '<img src="'. get_stylesheet_directory_uri() . '/img/holiday_banner.jpg" alt="MAKE Holiday Gift Guide 2012" />';
}

add_shortcode( 'holiday', 'make_holiday_banner' );

function make_featured_products_shortcode() {

	$xml = wpcom_vip_file_get_contents( 'http://makershed.com/net/webservice.aspx?api_name=generic\featured_products' );

	if ( ! $xml )
		return;

	$simpleXmlElem = simplexml_load_string( $xml );
	if ( ! $simpleXmlElem )
		return;
	$xml_featured_products = $simpleXmlElem->asXML();
	$featured_products = simplexml_load_string($xml_featured_products);
	$products = $featured_products->Product;
	$products_count = count($products);
	if ($products_count > 8) {
		$input = range(1,$products_count);
		$arr = array_rand($input, 4);
	} else {
		$input = range(1,8);
		$arr = array_rand($input, 4);
	}

	ob_start();

	echo '<table><tr>';

	for ( $i = 0; $i <= 2; $i++ ) {
		if ( ! isset( $products[ $arr[ $i ] ] ) ) {
			continue;
		}
?>

		<td>

			<a href="<?php echo esc_url( 'http://www.makershed.com/ProductDetails.asp?&Click=107309&ProductCode=' . rawurlencode( $products[ $arr[ $i ] ]->ProductCode ) ); ?>">
				<?php
					if ( function_exists( 'wpcom_vip_get_resized_remote_image_url' ) ) {
						echo '<img src="' . wpcom_vip_get_resized_remote_image_url( $products[ $arr[ $i ] ]->PhotoURL, 175, 175 ) . '" alt="' . esc_attr( $products[ $arr[ $i ] ]->ProductName ) . '" class="thumbnail small-thumb" />';
					} else {
						echo '<img src="' . esc_url( $products[ $arr[ $i ] ]->PhotoURL ) . '" alt="' . esc_attr( $products[ $arr[ $i ] ]->ProductName ) . '" class="thumbnail small-thumb"/>';
					}
				?>
			</a>

			<div class="blurb">
				<h4><a href="<?php echo esc_url( 'http://www.makershed.com/ProductDetails.asp?&Click=107309&ProductCode=' . rawurlencode( $products[ $arr[ $i ] ]->ProductCode ) ); ?>"><?php echo esc_html( $products[ $arr[ $i ] ]->ProductName ); ?></a></h4>
			</div>

		</td>

<?php

	} // end for()

	echo '</tr></table>';

	return ob_get_clean();
}

add_shortcode( 'featured_products', 'make_featured_products_shortcode' );

function make_row_shortcode( $atts, $content = null ) {
   return '<div class="row">' . $content . '</div>';
}

add_shortcode( 'row', 'make_row_shortcode' );

function make_email_encode_function( $atts, $content ){
	if (is_email( $content )) {
		return '<a href="' . esc_attr( antispambot("mailto:".$content) ) . '">'.antispambot($content).'</a>';
	} else {
		return $content;
	}
}
add_shortcode( 'email', 'make_email_encode_function' );

function make_platt() {

	$output = '<div class="alert alert-info">

			<img src="' . get_stylesheet_directory_uri() . '/img/platt.jpg" class="thumbnail pull-right" style="width:125px; margin-left:10px; height: auto;" />

			<p>For more on microswitches, rockers, sliders, toggles, DIPs, SIPs, paddle switches, and more, check out the Encyclopedia of Electronic Components Volume 1 by Charles Platt. It’s the informative, concise, and well-organized resource that\'s perfect for teachers, hobbyists, engineers, and students wanting a go-to electronics quick reference.<p>
			<p><a class="btn btn-primary" href="http://www.makershed.com/Encyclopedia_of_Electronic_Components_Vol_1_p/mkbk17.htm">Buy now!</a></p>

		</div>';
	return $output;
}

add_shortcode( 'platt', 'make_platt' );

function make_rpi() {

	$output = '<div class="clearfix"></div>';

	$output .='<div class="alert alert-info">
		<p>
			<a href="http://pubads.g.doubleclick.net/gampad/clk?id=29978938&iu=/11548178/Makezine">
				<img class="" style="width: 100%; height: auto;" alt="Raspberry Pi Design Contest" src="'. get_stylesheet_directory_uri() .'/img/RASPBERRYPI_AD.jpg" />
			</a>
		</p>
		<h4>Enter Your Project In Our Raspberry Pi Design Contest</h4>
		<ul>
			<li>Over $3,500 in prizes from MCM Electronics</li>
			<li>Best In Show wins a Printrbot Jr.</li>
			<li>Four Categories: Artistic, Utility, Education and Enclosures</li>
			<li>Submissions due by April 11th, 2013</li>
		</ul>
		<a class="btn btn-primary" href="http://pubads.g.doubleclick.net/gampad/clk?id=29978938&iu=/11548178/Makezine">Enter Today!</a>
	</div>';
	return $output;
}

add_shortcode( 'make_rpi', 'make_rpi' );

function make_rtm() {
	$output = '<div class="alert alert-info">
		<a href="http://pubads.g.doubleclick.net/gampad/clk?id=40563538&iu=/11548178/Makezine">
			<img src="http://makezineblog.files.wordpress.com/2013/07/rtmfc_esurance_boilerplate.png?w=620" alt="RTMFC_620x120" width="620" height="120" style="margin-bottom:10px;" class="alignnone size-full wp-image-292301" />
		</a>
		<p>The <a href="http://pubads.g.doubleclick.net/gampad/clk?id=40563538&iu=/11548178/Makezine">Road to Maker Faire Challenge</a> will award $2,500 to one winner to bring his or her project to World Maker Faire on Sep. 21 & 22, 2013 in New York. Use the funding for materials, transport, or anything else you might need to get to Maker Faire. Applications are due by 11:59pm PT on August 5, 2013.</p>
		<p><a href="http://pubads.g.doubleclick.net/gampad/clk?id=40563538&iu=/11548178/Makezine" class="btn btn-primary">Enter Now!</a></p>
		</div>';
	return $output;
}

add_shortcode( 'make_road_to_maker_faire', 'make_rtm' );

function join_make_forum() {
	$output = '<div class="join-make-forum">
		<p>Whether you&#39;re making it with electronics, wood, a 3D printer, or just about anything else, the MAKE: Forum is probably talking about. All that&#39;s missing is you. Stop by and share your projects, ideas, or questions.</p>
		<a href="https://plus.google.com/communities/105413589856236995389" target="_blank"><img src="http://makezineblog.files.wordpress.com/2013/04/join-make-forum.jpeg" width="620px" height="174px" alt="Join Make Forums" /></a>
		</div>';
	return $output;
}

add_shortcode( 'join_forum', 'join_make_forum' );

function promo_vol_34() {

	$output = '<div class="alert alert-info">

			<img src="http://makezineblog.files.wordpress.com/2013/04/m34-cover1.jpg?w=148" class="thumbnail pull-right" style="width:125px; margin-left:10px; height: auto;" />

			<p><strong>MAKE Volume 34:</strong> Join the robot uprising! As MAKE&#39;s Volume 34 makes clear, there’s never been a better time to delve into robotics, whether you’re a tinkerer or a more serious explorer. With the powerful tools and expertise now available, the next great leap in robot evolution is just as likely to come from your garage as a research lab. The current issue of MAKE will get you started. Explore robot prototyping systems, ride along with the inventors of the OpenROV submersible, and learn how you can 3D-print your own cutting-edge humanoid robot for half the price. Plus, build a coffee-can Arduino robot, a lip balm linear actuator, a smartphone servo controller, and much more</p>

			<p>On newsstands now, by <a href="https://readerservices.makezine.com/mk/subscribe.aspx?PC=MK&PK=M3ANEWT">subscription</a>, or available in the <a href="http://www.makershed.com/MAKE_Volume_34_p/9781449327668.htm">Maker Shed</a></p>

			<p><a class="btn btn-primary" href="http://www.makershed.com/ProductDetails.asp?ProductCode=9781449327668-P">Buy now!</a></p>

		</div>';
	return $output;
}

add_shortcode( 'promo_34', 'promo_vol_34' );


function make_github_3d_viewer($atts) {
	$url = str_replace( array( 'https://github.com/', 'http://github.com/', '/blob'), array( '', '', ''), $atts['url']);
	$output = '<script src="' . esc_url( 'https://embed.github.com/view/3d/' . $url ) . '"></script>';
	return $output;
}

add_shortcode('github', 'make_github_3d_viewer');

/**
 * Modal Window Builder
 */
function make_modal_builder( $atts, $content = null ) {

	extract( shortcode_atts( array(
		'launch' 	=> 'Launch Window',
		'title' 	=> 'Modal Title',
		'btn_class'	=> '',
		'embed'	=> ''
	), $atts ) );

	$number = mt_rand();
	$args = array(
		'a' => array(
			'href' => array(),
			'title' => array()
		),
		'br' => array(),
		'em' => array(),
		'strong' => array(),
		'iframe' => array(
			'src' => array(),
			'height' => array(),
			'border' => array(),
			'frameborder' => array(),
			'width' => array(),
			'allowfullscreen' => array(),
			)
	);
	$output = '<a class="btn  ' . esc_attr( $btn_class ) . '" data-toggle="modal" href="#modal-' . $number . '">' . esc_html( $launch ) . '</a>';
	$output .= '<div id="modal-' . $number . '" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
	$output .= '	<div class="modal-header">';
	$output .= '		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
	$output .= '		<h3>' . esc_html( $title ) . '</h3>';
	$output .= '	</div>';
	$output .= '	<div class="modal-body">';
	$output .= ( !empty( $embed ) ) ? wpcom_vip_wp_oembed_get( esc_url( $embed ), array( 'width' => 530 ) ) : '';
	$output .= 			wp_kses( $content, $args );
	$output .= '	</div>';
	$output .= '	<div class="modal-footer">';
	$output .= '		<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>';
	$output .= '	</div>';
	$output .= '</div>';

	return $output;
}
add_shortcode( 'modal', 'make_modal_builder' );

/**
 * Maker Camp Register Summer Program Google Form
 */
function make_makercamp_register_summer_program_gf() {
	$output = '<script type="text/javascript">var submitted=false;</script>';
	$output = '<iframe name="hidden_iframe" id="hidden_iframe" style="display:none;" onload="if(submitted){window.location="' . home_url() . '/maker-camp/thank-you/";}"></iframe>
 <form action="https://docs.google.com/spreadsheet/formResponse?formkey=dGJINmxpaVdpWEk2c0pBY1JuNTY5RlE6MQ" method="post" target="_blank" onsubmit="submitted=true;">
	<br>
	<div class="errorbox-good">
	   <div class="ss-item ss-item-required ss-text">
		  <div class="ss-form-entry">
			 <label class="ss-q-title" for="entry_0">Program Name</label> <input type="text" name="entry.0.single" value="" class="ss-q-short" id="entry_0">
		  </div>
	   </div>
	</div>
	<br>
	<div class="errorbox-good">
	   <div class="ss-item ss-item-required ss-text">
		  <div class="ss-form-entry">
			 <label class="ss-q-title" for="entry_10">Organization Name</label> <input type="text" name="entry.10.single" value="" class="ss-q-short" id="entry_10">
		  </div>
	   </div>
	</div>
	<br>
	<div class="errorbox-good">
	   <div class="ss-item ss-item-required ss-text">
		  <div class="ss-form-entry">
			 <label class="ss-q-title" for="entry_11">Program Description (25 words or less)</label>
			 <textarea type="text" name="entry.11.single" value="" class="ss-q-short" id="entry_11" rows="4"></textarea>
			 <div style="clear:both;"></div>
		  </div>
	   </div>
	</div>
	<br>
	<div class="errorbox-good">
	   <div class="ss-item ss-item-required ss-text">
		  <div class="ss-form-entry">
			 <label class="ss-q-title" for="entry_1">Program Google+ Link<span class="ss-required-asterisk"> (optional)</span></label> <input type="text" name="entry.1.single" value="" class="ss-q-short" id="entry_1">
		  </div>
	   </div>
	</div>
	<br>
	<div class="errorbox-good">
	   <div class="ss-item ss-item-required ss-text">
		  <div class="ss-form-entry">
			 <label class="ss-q-title" for="entry_5">Contact Name</label> <input type="text" name="entry.5.single" value="" class="ss-q-short" id="entry_5">
		  </div>
	   </div>
	</div>
	<br>
	<div class="errorbox-good">
	   <div class="ss-item ss-item-required ss-text">
		  <div class="ss-form-entry">
			 <label class="ss-q-title" for="entry_7">Email Address</label> <input type="text" name="entry.7.single" value="" class="ss-q-short" id="entry_7">
		  </div>
	   </div>
	</div>
	<br>
	<div class="errorbox-good">
	   <div class="ss-item ss-item-required ss-text">
		  <div class="ss-form-entry">
			 <label class="ss-q-title" for="entry_2">City <span class="ss-required-asterisk"></span></label><input type="text" name="entry.2.single" value="" class="ss-q-short" id="entry_2">
		  </div>
	   </div>
	</div>
	<br>
	<div class="errorbox-good">
	   <div class="ss-item ss-item-required ss-text">
		  <div class="ss-form-entry">
			 <label class="ss-q-title" for="entry_3">State <span class="ss-required-asterisk"></span></label> <input type="text" name="entry.3.single" value="" class="ss-q-short" id="entry_3">
		  </div>
	   </div>
	</div>
	<br>
	<div class="errorbox-good">
	   <div class="ss-item ss-item-required ss-text">
		  <div class="ss-form-entry">
			 <label class="ss-q-title" for="entry_4">Zipcode <span class="ss-required-asterisk"></span></label> <input type="text" name="entry.4.single" value="" class="ss-q-short" id="entry_4">
		  </div>
	   </div>
	</div>
	<br>
	<div class="errorbox-good">
	   <div class="ss-item ss-text">
		  <div class="ss-form-entry">
			 <label class="ss-q-title" for="entry_6">Phone <span class="ss-required-asterisk">(optional)</span></label> <input type="text" name="entry.6.single" value="" class="ss-q-short" id="entry_6">
		  </div>
	   </div>
	</div>
	<br>
	<input type="hidden" name="pageNumber" value="0"> <input type="hidden" name="backupCache" value="">
	<div class="ss-item ss-navigate">
	   <div class="ss-form-entry">
		  <input class="button" type="submit" name="Submit" value="Register Your Program">
	   </div>
	</div>
</form>
	 <script type="text/javascript">
		(function() {
		var divs = document.getElementById(\'ss-form\').getElementsByTagName(\'div\');
		var numDivs = divs.length;
		for (var j = 0; j < numDivs; j++) {
			if (divs[j].className == \'errorbox-bad\') {
			divs[j].lastChild.firstChild.lastChild.focus();
			return;
		}
		}
		for (var i = 0; i < numDivs; i++) {
		var div = divs[i];
		if (div.className == \'ss-form-entry\' &&
		div.firstChild &&
		div.firstChild.className == \'ss-q-title\') {
		div.lastChild.focus();
		return;
		}
		}
		})();
	 </script>';

	 return $output;
}
add_shortcode('makercamp_register_summer_program_form', 'make_makercamp_register_summer_program_gf' );

// Maker Camp Sign Up Form

function maker_camp_registration( $atts, $content = null ) {
	return '
		<form class="form-stacked" action="http://newsletter.makezine.com/t/r/s/jkeiit/" method="post" id="subForm sign-up">
			<fieldset>
				<div class="clearfix">
					<label for="name">Name:</label>
					<div class="input">
						<input class="xlarge" id="name" name="cm-name" size="30" type="text">
					</div>
				</div>
				<!-- /clearfix -->
				<div class="clearfix">
					<label for="jkeiit-jkeiit">Email:</label>
					<div class="input">
						<input class="xlarge" id="jkeiit-jkeiit" name="cm-jkeiit-jkeiit" size="30" type="text">
					</div>
				</div>
				<!-- /clearfix -->
			</fieldset>
			<div class="actions">
				<button type="submit" class="button blue">Sign Up for Camp</button>
			</div>
		</form>';
}
add_shortcode( 'maker_camp_sign_up', 'maker_camp_registration' );

// Multi Newsletter Subscribe

function multi_newsletter_subscribe( $atts, $content = null ) {
	return '
		<div class="newsletter-signup">
			<form action="http://makermedia.createsend.com/t/r/s/jrourr/" method="post" id="subForm" class="form form-horizontal">
				<fieldset>
					<div class="control-group">
						<label class="control-label" for="name">Name:</label>
						<div class="controls">
							<input type="text" name="cm-name" id="name" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="jrourr-jrourr">Email:</label>
						<div class="controls">
							<input type="text" name="cm-jrourr-jrourr" id="jrourr-jrourr" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="optionsCheckbox">Plus, sign me up for these FREE newsletters</label>
						<div class="controls">
							<label for="MAKENewsletter">
								<input type="checkbox" name="cm-ol-jjuylk" id="MAKENewsletter" />
								MAKE Newsletter
							</label>
							<label for="MakerFaireNewsletter">
								<input type="checkbox" name="cm-ol-jjuruj" id="MakerFaireNewsletter" />
								Maker Faire Newsletter
							</label>
							<label for="MakerShed-MasterList">
								<input type="checkbox" name="cm-ol-tyvyh" id="MakerShed-MasterList" />
								Maker Shed
							</label>
						<label for="MarketWireNewsletter">
													<input type="checkbox" name="cm-ol-jrsydu" id="MAKEMarketWirenewsletter" /> Maker Pro Newsletter
													</label>
						</div>
					</div>
					<div class="form-actions">
						<button type="submit" class="btn btn-large btn-primary">Subscribe!</button>
					</div>
				</fieldset>
			</form>
		</div>';
}
add_shortcode( 'newsletters', 'multi_newsletter_subscribe' );

/**
 * * Adds a campaign monitor form to the post content
 * @param  Array  $atts    The array of attributes passed through the shortcode
 * @param  String $content The string of content wrapped inside the shortcode
 * @param  Shortcode attributes:
 *         url           Insert the full URL as per the Campaign Monitor source code (IE http://newsletter.makezine.com/t/r/s/jkdduth/)
 *         class         Insert any classes you wish to enter. Separate each class with spaces. EG button btn-primary
 *         id            Insert any ID you want to use. By default this is set to 'subForm'.
 *         title         Want to display a title? Enter one then! :)
 *         name_id       This field will allow you to customize the ID field in the name and label tags for the name fields. Defaults to 'name'
 *         email_id      This field will allow you to customize the ID field in the name and label tags for the email fields.
 *         name_class    Sometime we want to add classes to the input fields. Use this attribute
 *         email_class   As with the name_class above, apply custom classes to the email input field.
 *         name          You can customize the default "Name" text in label with this.
 *         email         You can customize the default "Email" text in label with this.
 *         submit_class  Add a custom class to the submit button
 *         submit        Change the default text of the submit button
 *
 * 		   EG of all fields in use [make-compagin-monitor url="http://newsletter.makezine.com/t/r/s/jkdduth/" class="my-form-class" id="my-form-id" title="My CM Title" name_id="name" email_id="jkdduth-jkdduth" name_class="input-class" email_class="input-class" name="Your Name" email="Your Email" submit_class="btn btn-primary" submit="Submit Your Application"]
 * @return String
 */
function make_campaign_monitor_form( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'url' 		   => '',
		'class' 	   => '',
		'id'		   => 'subForm',
		'title'        => '',
		'name_id'	   => 'name',
		'email_id'	   => '',
		'name_class'   => '',
		'email_class'  => '',
		'name'		   => 'Name',
		'email'		   => 'Email',
		'submit_class' => '',
		'submit'       => 'Subscribe',
	), $atts ) );

	if ( ! empty( $class ) ) {
		$output .= '<form action="' . esc_url( $url ) . '" method="post" id="' . esc_attr( $id ) . '" class="' . esc_attr( $class ) . '">';
	} else {
		$output .= '<form action="' . esc_url( $url ) . '" method="post" id="' . esc_attr( $id ) . '">';
	}
		$output .=	'<fieldset>';

			// Add a title to the CM form
			if ( ! empty( $title ) )
				$output .= '<legend>' . esc_attr( $title ) . '</legend>';

			// Start our Name label and input fields
			$output .= '<div class="clearfix">
				<label for="' . esc_attr( $name_id ) . '">' . esc_attr( $name ) . ':</label>
				<div class="input">
					<input type="text" name="cm-' . esc_attr( $name_id ) . '" id="' . esc_attr( $name_id ) . '"';

					// Add a class to the name field if needed
					if ( ! empty( $name_class ) )
						$output .= ' ' . esc_attr( $name_class );

					$output .= ' />';
				$output .= '</div>
			</div>';

			// Start our Email label and input fields
			$output .= '<div class="clearfix">
				<label for="' . esc_attr( $email_id ) . '">' . esc_attr( $email ) . ':</label>
				<div class="input">
					<input type="text" name="cm-' . esc_attr( $email_id ) . '" id="' . esc_attr( $email_id ) . '"';

					// Add a class to the email field if needed
					if ( ! empty( $email_class ) )
						$output .= ' ' . esc_attr( $email_class );

					$output .= ' />';
				$output .= '</div>
			</div>
		</fieldset>
		<div class="actions">
			<input type="submit" value="' . esc_attr( $submit ) . '" ';

				// Add a class to the submit field if needed
				if ( ! empty( $submit_class ) )
					$output .= 'class="' . esc_attr( $submit_class ) . '" ';

			$output .= '/>
		</div>
	</form>';

	return $output;
}
add_shortcode( 'make-compagin-monitor', 'make_campaign_monitor_form' );

add_shortcode( 'volume', 'make_volume_tease' );
/**
 * New Shortcode for articles. Kind of a big tease with the images of the cover.
 */
function make_volume_tease( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'volume'	=> '36',
		'subscribe'	=> 'https://readerservices.makezine.com/mk/subscribe.aspx?PC=MK',
		'buy'		=> 'http://www.makershed.com/MAKE_Volume_36_p/9781449363765-p.htm'
	), $atts ) );

	$output = '<div class="tease">';
	$output .= '<h3>Preview</h3>';
	$output .= '<h4><a href="' . esc_url( $buy ) . '">Buy Volume ' . intval( $volume ) . '</a> for complete access or</h4>';
	$output .= '<div><a class="button big" href="' . esc_url ( $subscribe ) . '">Subscribe to MAKE and Save!</a></div>';
	$output .= '<div class="cover"><a href="' . esc_url ( $subscribe ) . '"><img src="' . wpcom_vip_get_resized_remote_image_url( make_get_cover_image( absint( $volume ) ), 400, 566 ) .  '" alt="" /></a></div>';
	$output .= '</div>';

	return $output;

}


/**
 * Add Posts from a category/tag to the bottom of a post via a shortcode
 */
function maker_short_post_loop( $args ) {

	$defaults = array(
		'post_type' 		=> array( 'post', 'craft', 'magazine', 'video', 'projects' ),
		'posts_per_page' 	=> 5,
		'social'			=> false,
		);

	$args = wp_parse_args( $args, $defaults );

	$output = '<div class="newsies"><div class="news post">';

	$output .= ( isset( $args['title'] ) ) ? '<h3 class="red">' . wp_kses_post( $args['title'] ) . '</h3>' : '';

	$query = new WP_Query($args);
	if( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();

		$output .= '<div class="media"><div class="pull-left">';
		$output .= get_the_image( array( 'image_scan' => true, 'size' => 'faire-thumb', 'echo' => false, 'image_class' => 'media-object hide-thumbnail' ) );
		$output .= '</div><div class="media-body">';
		$output .= '<h4 class="media-heading"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h4><p>' . get_the_excerpt() . '</p>';
		$output .= '<ul class="unstyled"><li>Posted by ';
		if( function_exists( 'coauthors_posts_links' ) ) {
			$output .= coauthors_posts_links( null, null, null, null, false);
		} else {
			$output .= the_author_posts_link();
		}
		$output .= ' | ' . get_the_time('F jS, Y g:i A') . '</li>';
		$output .= '</ul>';
		$output .= '<div class="jetpack-sharing">';
		$output .= ( $args['social'] == true ) ? sharing_display() : '';
		$output .= '</div></div></div>';

		endwhile;
	endif;
	wp_reset_postdata();

	$output .= '</div></div>';
	return $output;
}

add_shortcode( 'make_post_loop', 'maker_short_post_loop' );

/**
 * Add Maker Shed Deal of the Week
 */

function makershed_weekly_deal() {

	$output = '';

	$args = array(
		'post_type' 	=> 'from-the-maker-shed',
		'posts_per_page'=> 1
	);

	$the_query = new WP_Query( $args );

		while ( $the_query->have_posts() ) : $the_query->the_post();
			$ftms_link = get_post_meta( get_the_ID(), 'ftms_link', true );
			if( !isset( $ftms_link ) ){
				$ftms_link = 'http://www.makershed.com/';
			}
			$output .= '<a href="'. esc_url( $ftms_link ).'">';
			$output .= get_the_post_thumbnail( get_the_ID(), 'ftms-thumb');
			$output .= '</a>';
		endwhile;

		// Reset Post Data
		wp_reset_postdata();

		return $output;

}

add_shortcode( 'shedpromo', 'makershed_weekly_deal' );

function make_wizehive_shortcode() {
	$output = '<iframe id="wizehiveportal" onload="parent.scrollTo(0,0);" height="2480px" width="940px" frameborder="0" scrolling="auto"></iframe>
		<script type="text/javascript" src="http://review.wizehive.com/js/portaliframe.js"></script>
		<script type="text/javascript">displayPortal(\'makervehicle2013\');</script>
		<p><a href="http://www.wizehive.com/photo-contest-software" target="_blank">Photo Contest Software</a> provided by WizeHive</p>';
	return $output;
}

add_shortcode( 'ford_challenge', 'make_wizehive_shortcode' );

/**
 * 3D Printer SIP Promo
 * Example using left alignment: [3d_sip alignment="left"]
 */
function make_3d_promo( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'alignment' => 'left',
	), $atts ) );


	// Check what alignment we want. Always default to left if right is not given.
	if ( $alignment == 'right' ) {
		$align = 'alignright';
	} else {
		$align = 'alignleft';
	}


	$output = '<div class="sip-promo-area ' . esc_attr( $align ) . '"><a href="' . esc_url( get_permalink( 322813 ) ) . '"><img src="' . esc_url( get_stylesheet_directory_uri() ) . '/images/3DPrintingSIP_Widget_Final.jpg" class="" style="width:234px; height: auto;" /></a></div>';
	return $output;
}

add_shortcode( '3d_sip', 'make_3d_promo' );

/**
 * Volume 37 Promo
 * Example using left alignment: [promo_37 alignment="left"]
 */
function make_37_promo( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'alignment' => 'left',
	), $atts ) );


	// Check what alignment we want. Always default to left if right is not given.
	if ( $alignment == 'right' ) {
		$align = 'alignright';
	} else {
		$align = 'alignleft';
	}


	$output = '<div class="sip-promo-area ' . esc_attr( $align ) . '"><a href="' . esc_url( get_permalink( 322811 ) ) . '"><img src="' . esc_url( get_stylesheet_directory_uri() ) . '/images/Vol_37_Widget_Final.jpg" class="" style="width:234px; height: auto;" /></a></div>';
	return $output;
}

add_shortcode( 'promo_37', 'make_37_promo' );


function make_mf_video_highlights( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'align' => 'left',
	), $atts ) );

	// Set a random ID for the modal
	$stage1 = mt_rand();
	$stage3 = mt_rand();

	// Check if we set the alignment to right. Or else we'll just dfault to left.
	if ( $align == 'right' ) {
		$align = 'alignright';
	} else {
		$align = 'alignleft';
	}

	$output = '<div class="mf-video-highlights ' . esc_attr( $align ) . '">
		<h3 class="mf-video-title">World Maker Faire NY Video Highlights</h3>

		<div class="stage-1">
			<h3 class="stage-name">MAKE: Live Stage</h3>
			<p class="presentation-name"><a data-toggle="modal" href="#modal-' . absint( $stage1 ) . '">Live Robot Bugs! Biomimicry in Research and Development</a></p>
			<div id="modal-' . absint( $stage1 ) . '" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3>Maker Faire NY: Live Robot Bugs! Biomimicry in Research and Development</h3>
				</div>
				<div class="modal-body">';
					$output .= wpcom_vip_wp_oembed_get( 'http://www.youtube.com/watch?v=tO1YO0TOgdE', array( 'width' => 530 ) );
				$output .= '</div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
				</div>
			</div>
			<p class="see-all"><a href="http://makerfaire.com/new-york-2013/live-stage/" target="_blank">See All Videos</a></p>
		</div>

		<div class="stage-2">
			<h3 class="stage-name">Innovation Stage</h3>
			<p class="presentation-name"><a href="http://fora.tv/2013/09/21/David_Pogue_Return_of_the_Non-Scientist" target="_blank">David Pogue: The Return of the Non-Scientist</a></p>
			<p class="see-all"><a href="http://makerfaire.com/new-york-2013/innovation-stage/" target="_blank">See All Videos</a></p>
		</div>

		<div class="stage-3">
			<h3 class="stage-name">Maker Interviews</h3>
			<p class="presentation-name"><a data-toggle="modal" href="#modal-' . absint( $stage3 ) . '">NASA Chief Technologist Mason Peck</a></p>
			<div id="modal-' . absint( $stage3 ) . '" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3>Maker Faire NY: NASA Chief Technologist Mason Peck</h3>
				</div>
				<div class="modal-body">';
					$output .= wpcom_vip_wp_oembed_get( 'http://www.youtube.com/watch?v=dC84Dm45Hr4', array( 'width' => 530 ) );
				$output .= '</div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
				</div>
			</div>
			<p class="see-all"><a href="http://makerfaire.com/new-york-2013/roaming-camera/" target="_blank">See All Videos</a></p>
		</div>
	</div>';

	return $output;
}
add_shortcode( 'mf_video_highlights', 'make_mf_video_highlights' );

function make_printrbot_newsletter() {
	$output = '<form class="form-horizontal" action="http://newsletter.makezine.com/t/r/s/tillyud/" method="post">
		<div class="control-group">
			<label class="control-label" for="fieldName">Full Name</label>
			<div class="controls">
				<input type="text" name="cm-name" class="input-xlarge" id="fieldName">
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="cm-tillyud-tillyud">Email</label>
			<div class="controls">
				<input type="text" name="cm-tillyud-tillyud" class="input-xlarge" id="fieldName">
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="optionsCheckbox">Want more maker news?</label>
			<div class="controls">
				<label for="listjjuylk" class="checkbox">
					<input id="listjjuylk" name="cm-ol-jjuylk" type="checkbox" />MAKE Newsletter
				</label>
				<label for="listttihir" class="checkbox">
					<input id="listttihir" name="cm-ol-ttihir" type="checkbox" />Maker Shed Newsletter
				</label>
				<label for="listjrsydu" class="checkbox">
					<input id="listjrsydu" name="cm-ol-jrsydu" type="checkbox" />Maker Pro Newsletter
				</label>
				<label for="listttlusi" class="checkbox">
					<input id="listttlusi" name="cm-ol-ttlusi" type="checkbox" />MakerCon 2014
				</label>
			</div>
		</div>
		<div class="form-actions">
			<button type="submit" class="btn btn-primary">Submit</button>
		</div>
	</form>';
	return $output;
}
add_shortcode( 'make_printrbot_newsletter', 'make_printrbot_newsletter' );

function make_get_dfp_ad_unit( $atts ) {
	$defaults = array(
		'unit' => '2',
	);

	$atts = shortcode_atts( $defaults, $atts );

	$output = '<!-- Beginning Sync AdSlot ' . intval( $atts['unit'] ) . ' for Ad unit header ### size: [[300,250]]  -->';

	$output .= '<div id=\'div-gpt-ad-664089004995786621-' . intval( $atts['unit'] ) . '\'>';
		$output .= '<script type=\'text/javascript\'>googletag.cmd.push(function(){googletag.display(\'div-gpt-ad-664089004995786621-' . esc_js( intval( $atts['unit'] ) ) . '\')});</script>';
	$output .= '</div>';
	$output .= '<!-- End AdSlot ' . intval( $atts['unit'] ) . ' -->';
	return $output;
}

add_shortcode( 'ad_unit', 'make_get_dfp_ad_unit' );

/**
 * Some stuff for the Nikon Contest
 */
function make_nikon_shortcode_iframe( $atts ) {
	$defaults = array(
		'width'		=> 920,
		'height'	=> 2150,
		'iframe'	=> 'portal'
		);
	$atts = shortcode_atts( $defaults, $atts );
	if ( $atts[ 'iframe' ] == 'portal' ) {
		$output = '<iframe id="wizehiveportal" scrolling="auto" frameborder="0" width="' . absint( $atts[ 'width' ] ) . 'px" height="' . absint( $atts[ 'height' ] ) . 'px"></iframe> ';
		$output .= '<script src="http://review.wizehive.com/js/portaliframe.js" type="text/javascript"></script>';
		$output .= '<script type="text/javascript">displayPortal(\'nikon\');</script>';
	} elseif ( $atts[ 'iframe' ] == 'webform' ) {
		$output = '<iframe src="http://app.wizehive.com/webform/nikon2014" style="width:' . absint( $atts[ 'width' ] ) . 'px; height: ' . absint( $atts[ 'height' ] ) . 'px;" scrolling="auto" frameborder="0" onload="parent.location="http://makezine.com/make-the-shot-camera-challenge/#enter";"></iframe><p><a href="http://www.wizehive.com/contest" target="_blank">Online Contest Software</a> provided by WizeHive</p>';
	}

	return $output;
}


add_shortcode( 'nikon', 'make_nikon_shortcode_iframe' );
