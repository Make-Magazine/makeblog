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

	<?php wp_head(); ?>

</head>
<body class="container">

	<div class="navbar">
		<div class="navbar-inner">
			<a class="brand" href="http://makezine.com">Make:</a>
			<ul class="nav">
				<li class="active nav-home"><a href="#">Home</a></li>
				<li class="nav-map"><a href="#">Makers on the Map</a></li>
			</ul>
		</div>
	</div>

	<header id="header" class="">

		<div class="row">

			<div class="span12">

				<img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/img/DayofMaking_logo.png' ); ?>" width="600" alt="Day of Making">

			</div>

		</div>

	</header><!-- /header -->

	<section class="thanks hide">

		<div class="row">

			<div class="span12">

				<p><strong>Thank you for Making!</strong> You’ve now declared your membership in the most fascinating and fastest-growing community in the world. Now claim your badge and post it to your social media profiles. Then download your FREE version of Zero to Maker and learn more about how to develop your skills and influence as a Maker.</p>

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

						<a href="#" class="button button-block" title="">Download Your E-Book</a>

					</div>

					<div class="span3 samesies">

						<a href="<?php echo esc_url( get_stylesheet_directory_uri() . '/img/day-of-making-badge.png' ); ?>" target="_blank" class="button button-block" title="">Download Your Badge</a>

					</div>

				</div>

			</div>

		</div>

	</section>

	<section class="end-page hide">

		<div class="row">

			<div class="span8">

				<h1>Makers on the Map</h1>

				<p class="lead">Everywhere! Put yourself on the Maker Map: Tweet your location to #MakerWhere and include a picture of what you’re making on this Day of Making 2014.</p>

				<div class="map-holder"></div>

				<h3>More DC based events:</h3>

				<dl>
					<dt>June 17th:</dt>
						<dd>TechShop Grand Opening</dd>
						<dd>Maker Summit</dd>
					<dt>June 18th:</dt>
						<dd>White House Maker Faire</dd>
				</dl>

				<h3>Make More Stuff</h3>

				<div class="media">
					<div class="media-body">
						<h4 class="media-heading"><a href="http://makezine.com/projects/">Start a Project</a></h4>
						<p>Explore our growing cookbook of DIY projects for all levels.</p>

						<div class="row">

							<div class="span2">
								<div class="thumbnail">
									<img src="http://placekitten.com/200/200" alt="Project">
									<div class="caption">
										<h4>Project Name</h4>
									</div>
								</div>
							</div>

							<div class="span2">
								<div class="thumbnail">
									<img src="http://placekitten.com/200/200" alt="Project">
									<div class="caption">
										<h4>Project Name</h4>
									</div>
								</div>
							</div>

							<div class="span2">
								<div class="thumbnail">
									<img src="http://placekitten.com/200/200" alt="Project">
									<div class="caption">
										<h4>Project Name</h4>
									</div>
								</div>
							</div>

							<div class="span2">
								<div class="thumbnail">
									<img src="http://placekitten.com/200/200" alt="Project">
									<div class="caption">
										<h4>Project Name</h4>
									</div>
								</div>
							</div>

						</div>

					</div>
				</div>

				<div class="media">
					<div class="media-body">
						<h4 class="media-heading"><a href="http://makerfaire.com/map/">Find a Faire</a></h4>
						<p>Community-based, independently produced Maker Faires are happening all over the globe.</p>
					</div>
				</div>

				<div class="media">

						<div class="media-body">

						<h4 class="media-heading">Maker Shed: Shop for Kits, Tools</h4>

						<div class="row">

							<div class="span2">
								<div class="thumbnail">
									<img src="http://placekitten.com/200/200" alt="Project">
									<div class="caption">
										<h4>Project Name</h4>
									</div>
								</div>
							</div>

							<div class="span2">
								<div class="thumbnail">
									<img src="http://placekitten.com/200/200" alt="Project">
									<div class="caption">
										<h4>Project Name</h4>
									</div>
								</div>
							</div>

							<div class="span2">
								<div class="thumbnail">
									<img src="http://placekitten.com/200/200" alt="Project">
									<div class="caption">
										<h4>Project Name</h4>
									</div>
								</div>
							</div>

							<div class="span2">
								<div class="thumbnail">
									<img src="http://placekitten.com/200/200" alt="Project">
									<div class="caption">
										<h4>Project Name</h4>
									</div>
								</div>
							</div>

						</div>

					</div>

				</div>

				<div class="media">
					<div class="media-body">
						<h4 class="media-heading"><a href="https://www.pubservice.com/MK/subscribe.aspx?PC=MK&PK=M3AMZB">Subscribe to Make:</a></h4>
						<p>Get the Digital Edition</p>
					</div>
				</div>


			</div>

			<div class="span4">

				<h3>Day of Making Agenda</h3>

				<h4>White House Mini Maker Faire</h4>

				<img src="http://placekitten.com/570/200" alt="">

				<div class="spacer"></div>

				<a class="twitter-timeline" href="https://twitter.com/search?q=%23NationOfMakers" width="570" data-widget-id="476445295467704320">Tweets about "#NationOfMakers"</a>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>


				<h3>Make More Makers</h3>

				<div class="media">
					<div class="media-body">
						<h4 class="media-heading"><a href="http://makerspace.com">Create a Makerspace</a></h4>
						<p>Makerspaces are community centers with tools. Download your FREE Makerspace playbook and start planning your own.</p>
					</div>
				</div>

				<div class="media">
					<div class="media-body">
						<h4 class="media-heading"><a href="http://makezine.com/maker-camp/">Make a Maker Faire</a></h4>
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

	</section>

	<section class="call-out">

		<div class="row">

			<div class="span7">

				<h1>I'm a Maker!</h1>

				<h3>Add your voice to the National Day of Making!</h3>

				<p>Today, we’re joing with the White House and calling on all makers to stand up and be counted. If you’re passionate about making and love to design, hack, create, build, tinker or engineer, we want to hear from you! </p>

			</div>

			<div class="span5">

				<img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/img/Zero-to-Maker-Cover.jpg' ); ?>" class="pull-right thumbnail" width="100" alt="">

				<p><strong>Add your story today</strong> and demonstrate your proud support of makers around the country. Receive an electronic badge like this to post on your social media channels.</p>

				<p>Plus, get a free PDF of the book Zero to Maker by David Lang.</p>

				<a role="button" data-toggle="modal" class="button btn-block" title="Join other makers" data-toggle="modal" href="#join">Add Your Story</a>

			</div>

		</div>

	</section>

	<section class="list-of-makers">

		<header>

			<h2>Our Maker Community</h2>

			<p>Over <span class="count"><?php echo intval( wp_count_posts( 'makers' )->publish ); ?></span> added. Share your story.</p>

		</header><!-- /header -->

		<?php do_action( 'maker_rows' ); ?>

	</section>

	<div class="modal hide fade" id="join">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h3>Register for the Day of Making</h3>
		</div>
		<div class="modal-body">
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
						<p class="help-block"><small><em>We use Gravatar for the images. Don't see yours? Try tying to an account here: <a href="http://en.gravatar.com">http://en.gravatar.com</a></em></small></p>
					</div>
				</div>

				<!-- Email Address-->
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
						<select id="experience" name="experience" class="input-xlarge">
							<option value="Fan">Fan: I love finding out what other people are making.</option>
							<option value="Newbie">Newbie: I want to start my first project.</option>
							<option value="Beginner">Beginner: I’m still learning the basics.</option>
							<option value="Intermediate">Intermediate: I’ve completed a few projects and am eager to learn more.</option>
							<option value="Advanced">Advanced: I’m ready to share my knowledge.</option>
							<option value="Expert">Expert: I am a Maker Pro or recognized expert.</option>
						</select>
					</div>
				</div>

				<!-- Category -->
				<div class="control-group">
					<label class="control-label" for="category">Main Maker Interest</label>
					<div class="controls">
						<?php wp_dropdown_categories( array( 'class' => 'input-xlarge' ) ); ?>
					</div>
				</div>

				<!-- What do you make... -->
				<div class="control-group">
					<label class="control-label" for="post_content">What I Make<span class="red">*</span></label>
					<div class="controls">
						<textarea id="post_content" class="input-xlarge" maxlength="250" rows="3" required="" name="post_content"></textarea>
					</div>
				</div>

				<?php echo wp_nonce_field( 'day-of-making', 'day-of-making' ); ?>
		</div>
		<div class="modal-footer">
				<button type="submit" class="add-maker btn btn-primary">Submit</button>
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

	<?php wp_footer(); ?>
</body>
</html>