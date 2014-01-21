<?php

/**
 * Maker Profile  Template
 * Template Name: Maker Profile
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @since 	   SPRINT_NAME
 * 
 */
make_get_header() ?>
	<div class="container profile">
		<div class="row">
			<div class="span12 main-head">
				<h2 class="top-header">Maker Profile <span class="secondary">(beta)</span></h2>
				<p class="feedback"><a href="#">Give Us Feedback</a></p>
				<ul class="nav nav-tabs">
					<li class="active"><a href="#profile" data-toggle="tab">Profile</a></li>
					<li><a href="#updates" data-toggle="tab">Status Updates</a></li>
					<li><a href="#make" data-toggle="tab">To Make</a></li>
					<li><a href="#favorites" data-toggle="tab">Favorites</a></li>
					<li><a href="#create" data-toggle="tab">Create</a></li>
				</ul>
			</div>
		</div>
		<div class="row">
			<div class="span12 tab-content">
				<div class="tab-pane active" id="profile">
					<div class="row-fluid">
						<div class="span12">
							<h3 class="title">My Profile</h2>
						</div>
					</div>
					<div class="row-fluid">
						<div class="span3 profile-photo editable">
							<img src="http://baconmockup.com/220/220" alt="">
						</div>
						<div class="span9 maker-info">
							<p>Member Since Januaray 17th, 2014</p>
							<div class="maker-bio editable">
								<h2 class="maker-name">Cole Geissinger</h2>
								<p class="maker-location">Cloverdale, CA</p>
								<p>I like turtles.</p>
							</div>
						</div>
					</div>
					<div class="row-fluid">
						<div class="span6">
							<div class="panel panel-default interests">
								<div class="panel-heading">Interests</div>
								<div class="panel-body">
									<p>Electronics, Computers &amp; Mobile, 3D Printing, Science, Energy, Home Hacks</p>
								</div>
							</div>

							<div class="panel panel-default skills">
								<div class="panel-heading">Skills &amp; Expertise</div>
								<div class="panel-body">
									<h3 class="secondary header">What are your area of expertise?</h3>
									<p><input type="text" class="full-width"> <input type="submit" class="btn btn-primary" value="ADD"></p>
								</div>
							</div>
						</div>
						<div class="span6">
							<div class="panel panel-default maker-info">
								<div class="panel-heading">Maker Info</div>
								<div class="panel-body">
									<ul class="list-group">
										<li class="list-group-item">
											<h3 class="secondary header">Are you a member of a <a href="#">Makerspace</a>?</h3>
											<p><input type="text" class="full-width" placeholder="Name"> <input type="submit" class="btn btn-primary" value="ADD"></p>
										</li>
										<li class="list-group-item">
											<h3 class="secondary header">Have you been featured in MAKE Magazine?</h3>
											<p><input type="text" class="full-width" placeholder="Volume #"> <input type="submit" class="btn btn-primary" value="ADD"></p>
										</li>
										<li class="list-group-item">
											<h3 class="secondary header">Have you been an exhibitor, performer, or presenter at a Maker Faire?</h3>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane" id="updates">
					<div class="row-fluid">
						<div class="span12">
							<h3 class="title">Status Updates</h2>
							<h4>COMING SOON!</h4>
						</div>
					</div>
				</div>
				<div class="tab-pane" id="make">
					<div class="row-fluid">
						<div class="span12">
							<h3 class="title">Project I Want To Make</h2>
							<h4>COMING SOON!</h4>
						</div>
					</div>
				</div>
				<div class="tab-pane" id="favorites">
					<div class="row-fluid">
						<div class="span12">
							<h3 class="title">Favorite Projects</h2>
							<h4>COMING SOON!</h4>
						</div>
					</div>
				</div>
				<div class="tab-pane" id="create">
					<div class="row-fluid">
						<div class="span12">
							<h3 class="title">Create</h2>
							<h4>COMING SOON!</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php get_footer(); ?>