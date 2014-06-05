<?php
/**
 * The generic sidebar template
 *
 * We use this template for just about everything. 
 * // TODO: Consolidate the other files into this one using some conditionals.
 * 
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Jake Spurlock <jspurlock@makermedia.com>
 */
?>
					
					<div class="span4 sidebar">

						<?php dynamic_sidebar( 'sidebar_top' ); ?>

						<div class="sidebar-ad">

							<!-- Beginning Sync AdSlot 2 for Ad unit header ### size: [[300,250]]  -->
							<div id='div-gpt-ad-664089004995786621-2'>
								<script type='text/javascript'>
									googletag.cmd.push(function(){googletag.display('div-gpt-ad-664089004995786621-2')});
								</script>
							</div>
							<!-- End AdSlot 2 -->

						</div>

						<div class="plus_forum widget">
							<a href="http://www.makershed.com/Make_Ultimate_Guide_to_3D_Printing_2_0_p/9781457183027-p.htm?Click=163251">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/Make_SIP6-3D_1213_v1-B_300x124.gif" alt="23 3D printers reviewed, get your copy today">
							</a>
						</div>
						
						<div class="tabbable">
							<ul class="nav nav-pills">
								<li class="active"><a href="#1" data-toggle="tab">Trending</a></li>
								<li><a href="#2" data-toggle="tab">Shared</a></li>
								<li><a href="#3" data-toggle="tab">Commented</a></li>
							</ul>
							<div class="tab-content">
								<div class="tab-pane active" id="1">
									<h3>// What's Trending</h3>
									<?php echo make_the_dash_shares_widget('realtime', 'Hits:', 8, 70); ?>
								</div>
								<div class="tab-pane" id="2">
									<h3>// What's Shared</h3>
									<?php echo make_the_dash_shares_widget('shares', 'Shares:', 8, 70); ?>
								</div>
								<div class="tab-pane" id="3">
									<h3>// Most Commented</h3>
									<?php echo make_most_commented_query(); ?>
								</div>
							</div>
						</div>

						<div class="new-dotw widget">

							<?php echo makershed_weekly_deal(); ?>

						</div>
						
						<div class="sidebar-ad">

							<!-- Beginning Sync AdSlot 3 for Ad unit header ### size: [[300,250]]  -->
							<div id='div-gpt-ad-664089004995786621-3'>
								<script type='text/javascript'>
									googletag.cmd.push(function(){googletag.display('div-gpt-ad-664089004995786621-3')});
								</script>
							</div>
							<!-- End AdSlot 3 -->

						</div>

						<?php dynamic_sidebar( 'sidebar_bottom' ); ?>


				</div>