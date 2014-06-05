<?php
/**
 * Sidebar for Projects Page
 *
 * 
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Jake Spurlock <jspurlock@makermedia.com>
 */
?>
					<div class="span4 sidebar">

						<div class="sidebar-ad">

							<!-- Beginning Sync AdSlot 2 for Ad unit header ### size: [[300,250]]  -->
							<div id='div-gpt-ad-664089004995786621-2'>
								<script type='text/javascript'>
									googletag.cmd.push(function(){googletag.display('div-gpt-ad-664089004995786621-2')});
								</script>
							</div>
							<!-- End AdSlot 2 -->

						</div>

						<div class="plus_forum">
							<a href="https://plus.google.com/communities/105413589856236995389">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/Make_Forum_join_banner_mini.jpg" alt="Join the MAKE Forum">
							</a>
						</div>
						
						<?php 
							global $post;
							$meta = get_post_meta( get_the_ID(), 'hide' );
							if ('review' == get_post_type() && (empty($meta[0]) == 'on') ) { ?>

								<div class="drill side">

									<div class="inner">
								
										<h3>Narrow Your Search</h3>
										
										<ul id="sidebar">
										
											<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>
											<?php endif; ?>
										
										</ul>
										
									</div>

								</div>
								
						<?php } ?>

						<div class="new-dotw">

							<?php
								
								$the_query = new WP_Query( 'post_type=from-the-maker-shed&posts_per_page=1' );

								while ( $the_query->have_posts() ) : $the_query->the_post();
									$ftms_link = get_post_custom_values( 'ftms_link' );
									if( !isset($ftms_link[0]) ){
										$ftms_link[0] = 'http://www.makershed.com/';
									}
									echo '<a href="'. esc_url( $ftms_link[0] ).'">';
									the_post_thumbnail('ftms-thumb');
									echo '</a>';
								endwhile;

								// Reset Post Data
								wp_reset_postdata();

							?>

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
						
						<div class="sidebar-ad">

							<!-- Beginning Sync AdSlot 2 for Ad unit header ### size: [[300,250]]  -->
						<div id='div-gpt-ad-664089004995786621-3'>
							<script type='text/javascript'>
								googletag.cmd.push(function(){googletag.display('div-gpt-ad-664089004995786621-2')});
							</script>
						</div>
						<!-- End AdSlot 2 -->

						</div>

					</div>