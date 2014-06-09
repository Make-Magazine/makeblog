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

	<header id="header" class="">

		<div class="row">

			<div class="span12">

				<img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/img/day-of-making.gif' ); ?>" alt="Day of Making">

			</div>

		</div>

	</header><!-- /header -->

	<div class="thanks hide">

		<div class="row">

			<div class="span12">

				<h1>Thank You!</h1>

				<p>Bacon ipsum dolor sit amet pork belly cupidatat laborum prosciutto shankle incididunt, tail nisi chuck kevin nulla anim adipisicing ut nostrud. Sed eu meatloaf, nisi excepteur qui consequat. Porchetta aute in enim sint leberkas. Tail quis tempor pariatur duis in kevin hamburger andouille capicola drumstick nulla ea swine prosciutto.</p>

				<p>Bacon ullamco tri-tip adipisicing, pastrami veniam cillum chicken pork chop. Id aliquip incididunt occaecat voluptate. Tempor non ham cillum, ea salami meatball nostrud porchetta aliqua beef ribs. Pork nulla short ribs biltong ea ad nostrud shank chuck elit tri-tip incididunt sunt. Short loin ad quis consectetur drumstick reprehenderit. Shoulder turducken elit ex meatloaf eiusmod qui ad id fugiat sausage magna laborum.</p>

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

					<div class="span3">

						<img src="http://placekitten.com/260/180" alt="" class="thumbnail" >

						<a href="#" class="btn btn-block" title="">Download Your E-Book</a>

					</div>

					<div class="span3">

						<img src="http://placekitten.com/260/180" alt="" class="thumbnail" >

						<a href="#" class="btn btn-block" title="">Download Your Badge</a>

					</div>

				</div>

			</div>

		</div>

	</div>

	<section class="call-out">

		<div class="row">

			<div class="span7">

				<p>Bacon ipsum dolor sit amet consectetur strip steak nulla exercitation swine. Magna commodo excepteur turkey dolore cupidatat turducken. Sed ut landjaeger, boudin consequat anim laborum fatback. Prosciutto doner veniam tri-tip kevin fatback turducken ad. Pork chop pastrami irure, tail turkey esse drumstick brisket et eu meatball commodo proident. Pariatur exercitation turducken brisket enim pork chop frankfurter flank.</p>

				<p>Tongue voluptate occaecat eu turducken nostrud incididunt meatball ut spare ribs qui. Ut id jowl pork loin jerky. Short ribs brisket anim sirloin voluptate, laboris dolore ex id beef ribs. Meatball duis prosciutto pork ut. Irure beef nostrud sausage.</p>

			</div>

			<div class="span5">

				<h3>Here is a headline</h3>

				<p>Tongue voluptate occaecat eu turducken nostrud incididunt meatball ut spare ribs qui. Ut id jowl pork loin jerky. Short ribs brisket anim sirloin voluptate, laboris dolore ex id beef ribs. Meatball duis prosciutto pork ut. Irure beef nostrud sausage.</p>

				<a role="button" data-toggle="modal" class="btn btn-large btn-block" title="Call to Action" data-toggle="modal" href="#myModal">Call to Action</a>

			</div>

		</div>

	</section>

	<section class="list-of-makers">

		<header>

			<h2>Join over <span class="count"><?php echo intval( wp_count_posts( 'makers' )->publish ); ?></span> Makers!</h2>

			<p>You have what it takes to join an elite force of makers? Sign up here:</p>

		</header><!-- /header -->



		<div class="row">

			<div class="span6">

				<div class="maker media">

					<a href="#" title="" class="pull-left">
						<img src="http://placekitten.com/200/200" alt="Maker Name" class="media-object">
					</a>

					<div class="media-body">

						<h4 class="media-heading">Jake Spurlock <small>Santa Rosa, CA</small></h4>

						<div class="media">

							<p>Bacon ipsum dolor sit amet consectetur strip steak nulla exercitation swine. Magna commodo excepteur turkey dolore cupidatat turducken. Sed ut landjaeger, boudin consequat anim laborum fatback. Prosciutto doner veniam tri-tip kevin fatback turducken ad. Pork chop pastrami irure, tail turkey esse drumstick brisket et eu meatball commodo proident. Pariatur exercitation turducken brisket enim pork chop frankfurter flank.</p>

						</div>

					</div>

				</div>

			</div>

			<div class="span6">

				<div class="maker media">

					<a href="#" title="" class="pull-left">
						<img src="http://placekitten.com/200/200" alt="Maker Name" class="media-object">
					</a>

					<div class="media-body">

						<h4 class="media-heading">Jake Spurlock <small>Santa Rosa, CA</small></h4>

						<div class="media">

							<p>Bacon ipsum dolor sit amet consectetur strip steak nulla exercitation swine. Magna commodo excepteur turkey dolore cupidatat turducken. Sed ut landjaeger, boudin consequat anim laborum fatback. Prosciutto doner veniam tri-tip kevin fatback turducken ad. Pork chop pastrami irure, tail turkey esse drumstick brisket et eu meatball commodo proident. Pariatur exercitation turducken brisket enim pork chop frankfurter flank.</p>

						</div>

					</div>

				</div>

			</div>

		</div>

		<div class="row">

			<div class="span6">

				<div class="maker media">

					<a href="#" title="" class="pull-left">
						<img src="http://placekitten.com/200/200" alt="Maker Name" class="media-object">
					</a>

					<div class="media-body">

						<h4 class="media-heading">Jake Spurlock <small>Santa Rosa, CA</small></h4>

						<div class="media">

							<p>Bacon ipsum dolor sit amet consectetur strip steak nulla exercitation swine. Magna commodo excepteur turkey dolore cupidatat turducken. Sed ut landjaeger, boudin consequat anim laborum fatback. Prosciutto doner veniam tri-tip kevin fatback turducken ad. Pork chop pastrami irure, tail turkey esse drumstick brisket et eu meatball commodo proident. Pariatur exercitation turducken brisket enim pork chop frankfurter flank.</p>

						</div>

					</div>

				</div>

			</div>

			<div class="span6">

				<div class="maker media">

					<a href="#" title="" class="pull-left">
						<img src="http://placekitten.com/200/200" alt="Maker Name" class="media-object">
					</a>

					<div class="media-body">

						<h4 class="media-heading">Jake Spurlock <small>Santa Rosa, CA</small></h4>

						<div class="media">

							<p>Bacon ipsum dolor sit amet consectetur strip steak nulla exercitation swine. Magna commodo excepteur turkey dolore cupidatat turducken. Sed ut landjaeger, boudin consequat anim laborum fatback. Prosciutto doner veniam tri-tip kevin fatback turducken ad. Pork chop pastrami irure, tail turkey esse drumstick brisket et eu meatball commodo proident. Pariatur exercitation turducken brisket enim pork chop frankfurter flank.</p>

						</div>

					</div>

				</div>

			</div>

		</div>

		<div class="row">

			<div class="span6">

				<div class="maker media">

					<a href="#" title="" class="pull-left">
						<img src="http://placekitten.com/200/200" alt="Maker Name" class="media-object">
					</a>

					<div class="media-body">

						<h4 class="media-heading">Jake Spurlock <small>Santa Rosa, CA</small></h4>

						<div class="media">

							<p>Bacon ipsum dolor sit amet consectetur strip steak nulla exercitation swine. Magna commodo excepteur turkey dolore cupidatat turducken. Sed ut landjaeger, boudin consequat anim laborum fatback. Prosciutto doner veniam tri-tip kevin fatback turducken ad. Pork chop pastrami irure, tail turkey esse drumstick brisket et eu meatball commodo proident. Pariatur exercitation turducken brisket enim pork chop frankfurter flank.</p>

						</div>

					</div>

				</div>

			</div>

			<div class="span6">

				<div class="maker media">

					<a href="#" title="" class="pull-left">
						<img src="http://placekitten.com/200/200" alt="Maker Name" class="media-object">
					</a>

					<div class="media-body">

						<h4 class="media-heading">Jake Spurlock <small>Santa Rosa, CA</small></h4>

						<div class="media">

							<p>Bacon ipsum dolor sit amet consectetur strip steak nulla exercitation swine. Magna commodo excepteur turkey dolore cupidatat turducken. Sed ut landjaeger, boudin consequat anim laborum fatback. Prosciutto doner veniam tri-tip kevin fatback turducken ad. Pork chop pastrami irure, tail turkey esse drumstick brisket et eu meatball commodo proident. Pariatur exercitation turducken brisket enim pork chop frankfurter flank.</p>

						</div>

					</div>

				</div>

			</div>

		</div>

		<div class="row">

			<div class="span6">

				<div class="maker media">

					<a href="#" title="" class="pull-left">
						<img src="http://placekitten.com/200/200" alt="Maker Name" class="media-object">
					</a>

					<div class="media-body">

						<h4 class="media-heading">Jake Spurlock <small>Santa Rosa, CA</small></h4>

						<div class="media">

							<p>Bacon ipsum dolor sit amet consectetur strip steak nulla exercitation swine. Magna commodo excepteur turkey dolore cupidatat turducken. Sed ut landjaeger, boudin consequat anim laborum fatback. Prosciutto doner veniam tri-tip kevin fatback turducken ad. Pork chop pastrami irure, tail turkey esse drumstick brisket et eu meatball commodo proident. Pariatur exercitation turducken brisket enim pork chop frankfurter flank.</p>

						</div>

					</div>

				</div>

			</div>

			<div class="span6">

				<div class="maker media">

					<a href="#" title="" class="pull-left">
						<img src="http://placekitten.com/200/200" alt="Maker Name" class="media-object">
					</a>

					<div class="media-body">

						<h4 class="media-heading">Jake Spurlock <small>Santa Rosa, CA</small></h4>

						<div class="media">

							<p>Bacon ipsum dolor sit amet consectetur strip steak nulla exercitation swine. Magna commodo excepteur turkey dolore cupidatat turducken. Sed ut landjaeger, boudin consequat anim laborum fatback. Prosciutto doner veniam tri-tip kevin fatback turducken ad. Pork chop pastrami irure, tail turkey esse drumstick brisket et eu meatball commodo proident. Pariatur exercitation turducken brisket enim pork chop frankfurter flank.</p>

						</div>

					</div>

				</div>

			</div>

		</div>

	</section>

	<div class="modal hide fade" id="myModal">
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

				<!-- Experience Level -->
				<div class="control-group">
				  <label class="control-label" for="experience">Experience Level</label>
				  <div class="controls">
				    <select id="experience" name="experience" class="input-medium">
				      <option>Goldsmith</option>
				      <option>Coppersmith</option>
				    </select>
				  </div>
				</div>

				<!-- Category -->
				<div class="control-group">
					<label class="control-label" for="category">Category</label>
					<div class="controls">
						<?php wp_dropdown_categories( array( 'class' => 'input-medium' ) ); ?>
					</div>
				</div>

				<!-- What do you make... -->
				<div class="control-group">
					<label class="control-label" for="post_content">What I make: <span class="red">*</span></label>
					<div class="controls">
				    	<textarea id="post_content" class="input-xlarge" rows="3" required="" name="post_content"></textarea>
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

	<?php wp_footer(); ?>
</body>
</html>