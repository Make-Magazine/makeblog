<?php
/**
 * Template Name: Day of Making
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo esc_html( make_generate_title_tag() ); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="<?php esc_attr( the_excerpt() ); ?>">

	<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
		<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<meta property="og:description" content="Make's National Day of Making is June 18th. Celebrated around the nation, this day celebrates making in any way." />

	<?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>

	<header id="header" class="">

		<div class="container">

			<div class="row">

				<div class="span12">

					<img data-show="activities" class="linker nav-map" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/img/DayofMaking_logo.png' ); ?>" width="600" alt="Day of Making" style="cursor:pointer;">

				</div>

			</div>

		</div>

	</header><!-- /header -->

	<nav>

		<div class="container">

			<ul class="inline">
				<li data-show="activities" class="linker nav-map"><a href="#activities">Day of <br>Making</a></li>
				<li data-show="null" class="nav-white-house"><a href="http://makerfaire.com/white-house/">White House <br>Maker Faire</a></li>
				<li data-show="proclamation" class="linker nav-proclamation"><a href="#proclamation">Presidential <br>Proclamation</a></li>
				<li data-show="signup" class="linker active nav-home"><a href="#signup">Support Your <br>Maker Community</a></li>
				<li data-show="map" class="linker nav-map-full"><a href="#map">#NationOfMakers <br>Map</a></li>
				<li data-show="pledge" class="linker nav-pledge"><a href="#pledge">Maker <br>Pledge</a></li>
			</ul>

		</div>

	</nav>

	<section class="thanks hide">

		<div class="container">

			<div class="row">

				<div class="span12">

					<p><strong>Thank you for Making.</strong> You’ve now declared your membership in the most fascinating and fastest-growing community in the world. Now claim your badge and post it to your social media profiles. Then download your FREE version of Zero to Maker and learn more about how to develop your skills and influence as a Maker.</p>

				</div>

			</div>

			<div class="row">

				<div class="span6">

					<div class="maker media maker-added">

						<div class="image"></div>

						<div class="media-body">

							<h4 class="media-heading"> <small></small></h4>

							<div class="media"></div>

						</div>

					</div>

				</div>

				<div class="span6">

					<div class="row">

						<div class="span3 samesies">

							<img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/img/Zero-to-Maker-Cover.jpg' ) ; ?>" width="160" height="160" alt="" class="thumbnail" >

						</div>

						<div class="span3 samesies">

							<img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/img/day-of-making-badge.png' ); ?>" width="160" height="160" alt="" class="Day of Making" >

						</div>

					</div>

					<div class="row">

						<div class="span3 samesies">

							<a href="http://cdn.makezine.com/make/day-of-making/Zero_to_Maker.pdf" target="_blank" class="btn btn-danger" title="Zero to Maker" download>Download Your E-Book</a>

						</div>

						<div class="span3 samesies">

							<a href="<?php echo esc_url( get_stylesheet_directory_uri() . '/img/day-of-making-badge.png' ); ?>" target="_blank" class="btn btn-danger" title="Download your badge" download>Download Your Badge</a>

						</div>

					</div>

				</div>

			</div>

		</div>

		<div class="spacer"></div>

	</section>

	<section class="activities hide">

		<div class="container">

			<div class="row">

				<div class="span8 schtuff">

					<iframe width="620" height="360" src="//www.youtube.com/embed/HaTgKLym0Dg" frameborder="0" allowfullscreen></iframe>

					<div class="spacer"></div>
					<div class="spacer"></div>

					<div class="row">

						<div class="span2">

							<img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/img/white-house.png' ); ?>" class="pull-left" alt="White House Mini Maker Faire" style="margin-right: 20px;">

						</div>

						<div class="span6">

							<p>On June 18th, a select group of makers will get to show off their projects at the White House and talk with the President about making and how it has shaped their lives.</p>

						</div>

					</div>

					<h3>Make More Stuff</h3>

					<div class="media">
						<div class="media-body">
							<h4 class="media-heading"><a href="http://makezine.com/projects/">Start a Project</a></h4>
							<p>Explore our growing cookbook of DIY projects for all levels.</p>

							<div class="row">

								<div class="span8">

									<?php $args = array(
										'post_type'			=> 'projects',
										'title'				=> '',
										'limit'				=> 2,
										'tag'				=> 'Featured',
										'projects_landing'	=> true,
										'all'				=> false
									);
									echo make_carousel( $args ); ?>

								</div>

							</div>

						</div>
					</div>

					<p class="stars"><img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/img/stars.png' ); ?>" alt="Stars"></p>

					<div class="shed-dotd">

						<?php make_featured_products(); ?>

					</div>

					<p class="stars"><img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/img/stars.png' ); ?>" alt="Stars"></p>

					<div class="row subs">

						<div class="span4 offset2">

							<p class="stars"><a href="http://makerfaire.com"><img src="http://cdn.makezine.com/make/makerfaire/bayarea/2012/images/logo.jpg" width="200"></a></p>

							<h4><a href="http://makerfaire.com/map/">Find a Faire</a></h4>
							<p>Community-based, independently produced Maker Faires are happening all over the globe.</p>

						</div>

					</div>

					<p class="stars"><img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/img/stars.png' ); ?>" alt="Stars"></p>

					<div class="row subs">

						<div class="span4 offset2">

							<p class="stars"><a href="https://www.pubservice.com/MK/subscribe.aspx?PC=MK&PK=M3AMZB"><img src="<?php echo esc_url( make_get_cover_image(), '120', '160'); ?>"></a></p>

							<h4><a href="https://www.pubservice.com/MK/subscribe.aspx?PC=MK&PK=M3AMZB">Subscribe to Make:</a></h4>
							<p>Get the Digital Edition</p>

						</div>

					</div>

				</div>

				<div class="span4 dom-sidebar">

					<h3>Day of Making Activities</h3>

					<a href="http://makezine.com/2014/06/04/white-house-maker-faire/"><img src="http://makezineblog.files.wordpress.com/2013/03/obama.jpg?w=300" alt="Maker Faire at the White House"></a>

					<h4><a href="http://makezine.com/2014/06/04/white-house-maker-faire/">White House Hosts Its Own Maker Faire</a></h4>

					<div class="spacer"></div>

					<a class="twitter-timeline" href="https://twitter.com/search?q=%23NationOfMakers" width="570" data-widget-id="476445295467704320">Tweets about "#NationOfMakers"</a>
					<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

					<p class="stars"><img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/img/stars.png' ); ?>" alt="Stars"></p>

					<h3>Make More Makers</h3>

					<div class="media">
						<div class="media-body">
							<h4 class="media-heading"><a href="http://makerspace.com">Create a Makerspace</a></h4>
							<p>Makerspaces are community centers with tools. Download your FREE Makerspace playbook and start planning your own.</p>
						</div>
					</div>

					<div class="media">
						<div class="media-body">
							<h4 class="media-heading"><a href="http://makerfaire.com">Make a Maker Faire</a></h4>
							<p>Our Mini Maker Faire program provides all the tools and resources to help you launch a Maker Faire event that reflects the creativity, spirit and ingenuity of your community.</p>
						</div>
					</div>

					<div class="media">
						<div class="media-body">
							<h4 class="media-heading"><a href="http://makezine.com/maker-camp/">Host a Maker Camp for teens</a></h4>
							<p>Librarians, Summer Camp Directors, and Teen Program Directors: Check out all the ways you can integrate Maker Camp into your summer program.</p>
						</div>
					</div>

					<div class="media">
						<div class="media-body">
							<h4 class="media-heading"><a href="http://makered.org/">Teach Making</a></h4>
							<p>Calling all Educators: Create more opportunities to develop confidence, creativity and interest in science, technology, engineering, math, arts and learning as a whole through making.</p>
						</div>
					</div>

					<div class="media">
						<div class="media-body">
							<h4 class="media-heading"><a href="http://makerfaire.com/maker-movement/">Learn about the Maker Movement</a></h4>
							<p>This is grassroots innovation that we can foster in every community. Found out more about the movement and Maker Media.</p>
						</div>
					</div>

				</div>

			</div>

		</div>

	</section>

	<section class="map hide">

		<div class="container maker-map">

			<div class="row">

				<div class="span12">

					<h1>Makers on the Map</h1>

					<p class="lead">Put yourself on the Maker Map: Tweet your location to #NationofMakers and include a picture of what you’re making today.</p>

					<div class="map-holder"></div>

					<p class="stars"><a role="button" data-toggle="modal" class="btn btn-danger btn-large" title="Join other makers" data-toggle="modal" href="#join">Sign the "Building Maker Communities" pledge</a></p>

					<p class="stars"><img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/img/stars.png' ); ?>" alt="Stars"></p>

				</div>

			</div>

		</div>

	</section>

	<section class="signup hide">

		<div class="container">

			<div class="row">

				<div class="span7">

					<h1>Support Making in Your Community</h1>

					<p>President Obama is hosting the first-ever White House Maker Faire on June 18 to recognize the contributions of makers who bring creativity and technical ability to a broad range of projects.  If you are a maker or a friend of makers, please become an advocate for expanding opportunities for making and makers in your community.</p>

					<p>"As individuals, as members of families and community groups, and as makers, we want to help support the continued growth and impact of maker movement in our community and in America.  We want to ensure that more people have access to the tools, materials and mentorship that allows them to develop as makers.   We want our communities to develop a thriving maker ecosystem that takes advantage of new opportunities in manufacturing, education, innovation and design."  &mdash; <a data-show="pledge"  class="linker nav-pledge" href="#pledge">Maker Pledge</a></p>

				</div>

				<div class="span5">

					<div class="row">

						<div class="span5">

							<img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/img/Zero-to-Maker-Cover.jpg' ); ?>" class="pull-right thumbnail" width="100" alt="">

							<h4>Sign the "Building Maker Communities" pledge</h4>

							<p>Sign the pledge and get a <strong>FREE</strong> PDF of the book "Zero to Maker" by David Lang, which tells David's inspiring story of becoming a maker.</p>

						</div>

					</div>

					<div class="spacer"></div>
					<div class="spacer"></div>


					<a role="button" data-toggle="modal" class="btn btn-danger btn-large btn-block" title="Join other makers" data-toggle="modal" href="#join">Sign the "Building Maker Communities" pledge</a>

					<p class="stars"><strong>Read the <a data-show="pledge"  class="linker nav-pledge" href="#pledge" style="text-decoration:underline;">complete pledge here</a>.</strong></p>

				</div>

			</div>

		</div>

		<div class="container list-of-makers">

			<header>

				<p class=><img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/img/stars.png' ); ?>" alt="Stars"></p>

				<h2>Committed to Building Maker Communities</h2>

				<p>Over <span class="count"><?php echo intval( wp_count_posts( 'makers' )->publish ); ?></span> added. Share your story.</p>

			</header><!-- /header -->

			<div class="makers-fill">

				<?php do_action( 'maker_rows' ); ?>

			</div>

			<header>

				<div class="spacer"></div>

				<p><a role="button" data-toggle="modal" class="btn btn-danger btn-large" title="Join other makers" data-toggle="modal" href="#join">Sign the "Building Maker Communities" pledge</a></p>

				<p><img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/img/stars.png' ); ?>" alt="Stars"></p>

			</header><!-- /header -->

		</div>

	</section>

	<section class="pledge hide">

		<div class="container">

			<div class="row">

				<div class="span8 offset2">

					<p class="stars"><img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/img/stars.png' ); ?>" alt="Stars"></p>

					<p>President Barack Obama<br>
					The White House<br>
					1600 Pennsylvania Avenue NW<br>
					Washington, DC 20500</p>

					<p>Dear President Obama:</p>

					<p>The Maker Movement today encourages everyone to think of themselves as makers, and see themselves as producers, not just consumers.   The emergence of the Maker Movement as a social movement might be attributed to three drivers: </p>

					<ol>
						<li>The broad participation of makers who combine creative goals and technical skills to develop their own projects, some of which become products and lead to new businesses;</li>
						<li>The self-organizing nature of the movement shows how individual makers and small groups have acted at the grassroots level to foster making in their community and recognize its social and economic value;</li>
						<li>More children and their parents are recognizing that making provides a personal and social context for learning about science and technology and developing the practices and mindset that empower them to lead productive and meaningful lives.</li>
					</ol>

					<p>Maker Faire has been a catalyst for bringing together makers and connecting them in communities in America and throughout the world.  The number of events and the size of them continues to grow each year, inviting new people of any age to become makers.   The number of makerspaces continues to expand in cities and rural areas across the country, and they play an important role in providing an on-ramp to the maker community.  At the same time, there are new tools such as 3D printers and new platforms that support collaborative production that make it easier for more and more people to make things.   All this accounts for the growth of the maker movement.</p>

					<p>As individuals, as members of families and community groups, and as makers, we want to help support the continued growth and impact of maker movement in our community and in America.  We want to ensure that more and more people have access to the tools, materials and mentorship that allows them to develop as makers.   We want our communities to develop a thriving maker ecosystem that takes advantage of new opportunities in manufacturing, education, innovation and design. </p>

					<p>As the White House prepares to hold its first-ever Maker Faire, we are committed to working with others in our community and with institutions to advance one or more of the following goals to promote Making, including:</p>

					<ul>
						<li>To foster a local community of makers who participate in events, workshops, and outreach to grow a vibrant local maker community that is open and inclusive.</li>
						<li>To create and sustain makerspaces that serve all youth in our community.  We recognize the need for makerspaces in schools, libraries, museums and other community-serving organizations.</li>
						<li>To provide mentorship and support for students to develop projects that support the engaging, hands-on learning in the classroom and outside class.<br></li>
						<li>To help organize school-based Maker Faires that showcase student projects for the local community;</li>
						<li>To provide mentorship and support for makers who are starting new businesses or expanding existing businesses;</li>
						<li>To recognize and celebrate makers as well as the contributions of those who organize the local maker community.</li>
						<li>To participate in local and regional efforts to create a productive Maker ecosystem that involves companies, investors, skilled volunteers, state and local officials, libraries, museums, schools, after-school programs, labor unions, and community-based organizations.</p></li>
					</ul>

					<p>We are working together to build maker communities throughout America and the world that introduce the maker movement to more people and expand the benefits that makers can realize through their participation. Thank you for your recognition of the maker community and its strategic importance for our future.  We look forward to working with you and your Administration to make this effort a huge success.</p>

					<p>Dale Dougherty, CEO of Maker Media &amp; supporters of the <a data-show="call-out" href="#community" class="linker nav-home active">Maker Community</a></p>

					<p class="stars"><a role="button" data-toggle="modal" class="btn btn-danger btn-large" title="Join other makers" data-toggle="modal" href="#join">Sign the "Building Maker Communities" pledge</a></p>

					<p class="stars"><img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/img/stars.png' ); ?>" alt="Stars"></p>


				</div>

			</div>

		</div>

	</section>

	<section class="proclamation hide container">

		<div class="row">

			<div class="span8 offset2">

				<h2>Presidential Proclamation &mdash; National Day of Making, 2014</h2>

				<h1>NATIONAL DAY OF MAKING, 2014</h1>

				<hr>

				<h3>BY THE PRESIDENT OF THE UNITED STATES OF AMERICA</h3>

				<p><strong>A PROCLAMATION</strong></p>

				<p>Our Nation is home to a long line of innovators who have fueled our economy and transformed our world. Through the generations, American inventors have lit our homes, propelled humanity into the skies, and helped people across the planet connect at the click of a button. American manufacturers have never stopped chasing the next big breakthrough. As a country, we respond to challenge with discovery, determined to meet our great tests while seeking out new frontiers. During the National Day of Making, we celebrate and carry forward this proud tradition.</p>

				<p>Today, more and more Americans are gaining access to 21st century tools, from 3D printers and scanners to design software and laser cutters. Thanks to the democratization of technology, it is easier than ever for inventors to create just about anything. Across our Nation, entrepreneurs, students, and families are getting involved in the Maker Movement. My Administration is increasing their access to advanced design and research tools while organizations, businesses, public servants, and academic institutions are doing their part by investing in makerspaces and mentoring aspiring inventors.</p>

				<p>I am committed to helping Americans of all ages bring their ideas to life. Alongside our partners, my Administration is getting tens of thousands of young people involved in making. We are supporting an apprenticeship program for modern manufacturing and encouraging startups to build their products here at home. Because science, technology, engineering, and mathematics (STEM) are essential to invention, we launched a decade-long national effort to train 100,000 excellent STEM teachers. And we are expanding STEM AmeriCorps so that this summer, 18,000 low-income students will have learning opportunities in these vital fields.</p>

				<p>As we observe this day, I am proud to host the first-ever White House Maker Faire. This event celebrates every maker -- from students learning STEM skills to entrepreneurs launching new businesses to innovators powering the renaissance in American manufacturing. I am calling on people across the country to join us in sparking creativity and encouraging invention in their communities.</p>

				<p>Today, let us continue on the path of discovery, experimentation, and innovation that has been the hallmark not only of human progress, but also of our Nation's progress. ￼ Together, let us unleash the imagination of our people, affirm that we are a Nation of makers, and ensure that the next great technological revolution happens right here in America.</p>

				<p>NOW, THEREFORE, I, BARACK OBAMA, President of the United States of America, by virtue of the authority vested in me by the Constitution and the laws of the United States, do hereby proclaim June 18, 2014, as National Day of Making. I call upon all Americans to observe this day with programs, ceremonies, and activities that encourage a new generation of makers and manufacturers to share their talents and hone their skills.</p>

				<p>IN WITNESS WHEREOF, I have hereunto set my hand this seventeenth day of June, in the year of our Lord two thousand fourteen, and of the Independence of the United States of America the two hundred and thirty-eighth.</p>

				<p><strong>BARACK OBAMA</strong></p>

			</div>

		</div>

	</section>

	<div class="modal hide fade" id="join">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h3>I Support the Day of Making</h3>
		</div>
		<div class="modal-body">
			<p>We are working together to build maker communities throughout America and the world that introduce the maker movement to more people and expand the benefits that makers can realize through their participation.</p>
			<form class="form-horizontal" id="day-of-making-form">

				<!-- Name -->
				<div class="control-group">
					<label class="control-label" for="firstname">Full Name <span class="red">*</span></label>
					<div class="controls">
						<input id="firstname" name="firstname" type="text" placeholder="First Name" class="input-medium" required="">
						<input id="firstname" name="lastname" type="text" placeholder="Last Name" class="input-medium" required="">
					</div>
				</div>

				<!-- Location (city/state) -->
				<div class="control-group">
					<label class="control-label" for="city">Location <span class="red">*</span></label>
					<div class="controls">
						<select id="country" name="country" class="input-medium">
							<option value="" selected="selected">Select a Country</option>
							<option></option>
							<option value="US">United States</option>
							<option></option>
							<option value="AS">American Samoa</option>
							<option value="AD">Andorra</option>
							<option value="AR">Argentina</option>
							<option value="AU">Australia</option>
							<option value="AT">Austria</option>
							<option value="BD">Bangladesh</option>
							<option value="BE">Belgium</option>
							<option value="BR">Brazil</option>
							<option value="BG">Bulgaria</option>
							<option value="CA">Canada</option>
							<option value="HR">Croatia</option>
							<option value="CZ">Czech Republic</option>
							<option value="DK">Denmark</option>
							<option value="DO">Dominican Republic</option>
							<option value="FO">Faroe Islands</option>
							<option value="FI">Finland</option>
							<option value="FR">France</option>
							<option value="GF">French Guyana</option>
							<option value="RE">French Reunion</option>
							<option value="DE">Germany</option>
							<option value="GB">Great Britain</option>
							<option value="GL">Greenland</option>
							<option value="GP">Guadeloupe</option>
							<option value="GU">Guam</option>
							<option value="GT">Guatemala</option>
							<option value="GG">Guernsey</option>
							<option value="GY">Guyana</option>
							<option value="NL">Holland</option>
							<option value="HU">Hungary</option>
							<option value="IS">Iceland</option>
							<option value="IN">India</option>
							<option value="IM">Isle of Man</option>
							<option value="IT">Italy</option>
							<option value="JP">Japan</option>
							<option value="JE">Jersey</option>
							<option value="LI">Liechtenstein</option>
							<option value="LT">Lithuania</option>
							<option value="LU">Luxembourg</option>
							<option value="MK">Macedonia</option>
							<option value="MY">Malaysia</option>
							<option value="MH">Marshall Islands</option>
							<option value="MQ">Martinique</option>
							<option value="YT">Mayotte</option>
							<option value="MX">Mexico</option>
							<option value="MD">Moldavia</option>
							<option value="MC">Monaco</option>
							<option value="NZ">New Zealand</option>
							<option value="MP">Northern Mariana Islands</option>
							<option value="NO">Norway</option>
							<option value="PK">Pakistan</option>
							<option value="PH">Phillippines</option>
							<option value="PL">Poland</option>
							<option value="PT">Portugal</option>
							<option value="PR">Puerto Rico</option>
							<option value="RU">Russia</option>
							<option value="PM">Saint Pierre and Miquelon</option>
							<option value="SM">San Marino</option>
							<option value="SK">Slovak Republic</option>
							<option value="SI">Slovenia</option>
							<option value="ZA">South Africa</option>
							<option value="ES">Spain</option>
							<option value="LK">Sri Lanka</option>
							<option value="SJ">Svalbard &amp; Jan Mayen Islands</option>
							<option value="SE">Sweden</option>
							<option value="CH">Switzerland</option>
							<option value="TH">Thailand</option>
							<option value="TR">Turkey</option>
							<option value="US">United States</option>
							<option value="VA">Vatican</option>
							<option value="VI">Virgin Islands</option>
						</select>
						<input id="zip" name="zip" type="text" placeholder="Zip or Territory Code" class="input-medium" required="">
					</div>
				</div>

				<!-- City/State-->
				<div class="control-group hide city-state">
					<label class="control-label" for="firstname">City/State <span class="red">*</span></label>
					<div class="controls">
						<input id="city" name="city" type="text" placeholder="City" class="input-medium" required="">
						<input id="state" name="state" type="text" placeholder="State" class="input-medium" required="">
					</div>
				</div>

				<!-- Email Address-->
				<div class="control-group">
					<label class="control-label" for="email_address">Email Address <span class="red">*</span></label>
					<div class="controls">
						<input id="email_address" name="email_address" type="email" placeholder="" class="input-xlarge" required="">
						<div class="spacer"></div>
						<div id="gravatar-placeholder" class="pull-left spacerings"></div>
						<p class="help-block"><small><em>We'll never publish or resell your email address.</em></small></p>
					</div>
				</div>

				<!-- Category -->
				<div class="control-group">
					<label class="control-label" for="category">Main Maker Interest <span class="red">*</span></label>
					<div class="controls">
						<select name="interest" class="span4">
							<option name="interest" value="Digital Fabrication">Digital Fabrication</option>
							<option name="interest" value="Microcontrollers">Microcontrollers</option>
							<option name="interest" value="DIY Electronics">DIY Electronics</option>
							<option name="interest" value="Art &amp; Design">Art &amp; Design</option>
							<option name="interest" value="Crafts">Crafts</option>
							<option name="interest" value="Workshop">Workshop</option>
						</select>
					</div>
				</div>

				<!-- Photo-->
				<div class="control-group">
					<label class="control-label" for="email_address">Photo <span class="red">*</span></label>
					<div class="controls">
						<input id="photo" name="photo" type="file" placeholder="" class="input-xlarge" required=""><br>
					</div>
				</div>

				<!-- URL -->
				<div class="control-group">
					<label class="control-label" for="url">Show Us Your Maker Site</label>
					<div class="controls">
						<input id="url" name="url" type="url" placeholder="" class="input-xlarge">
					</div>
				</div>

				<!-- Experience Level -->
				<div class="control-group">
					<label class="control-label" for="experience">Experience</label>
					<div class="controls">
						<select id="experience" name="experience" class="input-xlarge span4">
							<option value="Fan">Fan: I love finding out what other people are making.</option>
							<option value="Newbie">Newbie: I want to start my first project.</option>
							<option value="Beginner">Beginner: I’m still learning the basics.</option>
							<option value="Intermediate">Intermediate: I’ve completed a few projects and am eager to learn more.</option>
							<option value="Advanced">Advanced: I’m ready to share my knowledge.</option>
							<option value="Expert">Expert: I am a Maker Pro or recognized expert.</option>
						</select>
					</div>
				</div>

				<!-- What do you make... -->
				<div class="control-group">
					<label class="control-label" for="post_content">What I Make <span class="red">*</span></label>
					<div class="controls">
						<textarea id="post_content" class="input-xlarge" maxlength="250" rows="3" required="" name="post_content"></textarea>
					</div>
				</div>

				<div class="control-group">
					<label class="control-label"><span class="red">Required *</span></label>
				</div>

				<?php echo wp_nonce_field( 'day-of-making', 'day-of-making' ); ?>
		</div>
		<div class="modal-footer">
				<button type="submit" class="add-maker btn btn-danger">Claim Your Badge</button>
				<div class="clearfix"></div>
			</form>
		</div>
	</div>

	<div class="modal hide fade" id="tweet">

		<div class="modal-header">

			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h3>Add yourself to the Maker Map</h3>

		</div>

		<div class="modal-body map-holder">



		</div>

		<div class="modal-footer">

			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

		</div>

	</div>

	<?php get_footer(); ?>
</body>
</html>
