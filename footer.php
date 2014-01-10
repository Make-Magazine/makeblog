<?php
/**
 * The generic footer template.
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Jake Spurlock <jspurlock@makermedia.com>
 * 
 */
?>
				
				<div class="footer-ad <?php echo ( make_is_parent_page() && ! is_category( 'maker-pro' ) ) ? 'grey' : '' ; ?>" style="clear:both;">
				
					<div style="width:728px; margin:0 auto;">
 
						<!-- Beginning Sync AdSlot 4 for Ad unit header ### size: [[728,90]]  -->
						<div id='div-gpt-ad-664089004995786621-4'>
							<script type='text/javascript'>
								googletag.cmd.push(function(){googletag.display('div-gpt-ad-664089004995786621-4')});
							</script>
						</div>
						<!-- End AdSlot 4 -->
						 
					</div></div>

				</div></div></div>
			
			</div></div></div>
			<!-- These extra closing divs are to close all the divs opened by the functions that pull in cat posts -->

		<section id="footer" class="new-footer">
			<div class="container">
				<div class="row">
					<div class="top-links">
						<div class="logo">
							<a href="<?php echo esc_url( home_url() ); ?>" title="MAKE Magazine"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/make-160-footer.png" alt="MAKE Logo"></a>
						</div>
						<div class="digital-link sub-link">
							<h5><a href="http://make-digital.com/" target="_blank" title="Read the Digital Editon of Make Magazine"><img src="http://makezineblog.files.wordpress.com/2013/07/digital-book-foot.png" alt="Make Digital Book"> Read Digital Edition</a></h5>
						</div>
						<div class="shed-link sub-link">
							<h5><a href="http://www.makershed.com/" target="_blank" title="Shop Maker Shed"><img class="footer-cart-image" src="http://makezineblog.files.wordpress.com/2013/11/makershed_footer1.png" alt="Shop Maker Shed"> Shop Maker Shed</a></h5>
						</div>
					</div>
					<div class="clear"></div>
				<!-- END row -->
				</div>
				<div class="row">
					<div class="trending">
						<h5 class="header top-border">Trending Topics</h5>
						<?php echo wp_kses_post( stripslashes( make_get_cap_option( 'hot_topics' ) ) ); ?>
					</div>
					<div class="newsletter">
						<h5 class="header top-border">Get our Newsletters</h5>  
						<form action="http://makermedia.createsend.com/t/r/s/jrsydu/" method="post" id="subForm">
							<fieldset>
								<div class="control-group">
									<p>Sign up to receive exclusive content and offers.</p>
									<div class="controls">
										<label for="MAKENewsletter">
											<input type="checkbox" name="cm-ol-jjuylk" id="MAKENewsletter" /> MAKE Newsletter
										</label>
										<label for="MakerFaireNewsletter">
										<input type="checkbox" name="cm-ol-jjuruj" id="MakerFaireNewsletter" /> Maker Faire Newsletter
										</label>
										<label for="MakerShed-MasterList">
										<input type="checkbox" name="cm-ol-tyvyh" id="MakerShed-MasterList" /> Maker Shed
										</label> 
										<label for="MarketWireNewsletter">
										<input type="checkbox" name="cm-ol-jrsydu" id="MAKEMarketWirenewsletter" /> Maker Pro Newsletter
										</label> 
									<!-- END controls -->
									</div>
								<!-- control-group -->
								</div>
								<div class="input-append control-group email-area">
									<input class="span2" id="appendedInputButton" name="cm-jrsydu-jrsydu" id="jrsydu-jrsydu" type="text" placeholder="Enter your email">
									<button type="submit" class="btn" value="Subscribe">JOIN</button>
								</div>
							</fieldset>
						</form>
					<!-- END span newsletter -->
					</div>
					<div class="span3 about-us">
						<h5 class="header top-border">About <a href="http://makermedia.com">Maker Media</a></h5>
						<div class="row-fluid">
							<div class="about-column-01">
								<ul>
									<li><a href="<?php echo esc_url( home_url( '/how-to-get-help/' ) ); ?>">Help</a></li>
									<li><a href="http://makermedia.com/contact-us/" target="_blank">Contact</a></li>
									<li><a href="https://www.pubservice.com/MK/subscribe.aspx?PC=MK&amp;PK=M3AMZF">Subscribe</a></li>
									<li><a href="http://makermedia.com/work-with-us/advertising/" target="_blank">Advertise</a></li> 
									<li><a href="http://makermedia.com/privacy/" target="_blank">Privacy</a></li>
								</ul>
							</div>
							<div class="about-column-02">
								<ul>
									<li><a href="http://makermedia.com" target="_blank">About Us</a></li>
									<li><a href="<?php echo esc_url( home_url( '/faq/' ) ); ?>">FAQ</a></li>
									<li><a href="<?php echo esc_url( home_url( '/forums/' ) ); ?>">Forums</a></li>
									<li><a href="<?php echo esc_url( home_url( '/contribute/' ) ); ?>">Write for MAKE</a></li>
								</ul>
							</div>
						</div>
						<div class="socialArea">
							<ul class="soci">
								<li><a href="http://twitter.com/make" target="_blank" title="Follow MAKE on Twitter"><img src="http://s2.wp.com/wp-content/themes/vip/makeblog/img/twitter.png?m=1351191030g" alt="Make on Twitter"></a></li>
								<li><a href="http://youtube.com/make" target="_blank" title="Subscribe to MAKE on YouTube"><img src="http://s2.wp.com/wp-content/themes/vip/makeblog/img/youtube.png?m=1347432875g" alt="Make on YouTube"></a></li>
								<li><a href="http://pinterest.com/makemagazine/" target="_blank" title="Pin MAKE on Pintrest"><img src="http://s2.wp.com/wp-content/themes/vip/makeblog/img/pinterest.png?m=1351191030g" alt="Make on Pintrest"></a></li>
								<li><a href="http://www.flickr.com/groups/make/" target="_blank" title="View MAKE Flickr"><img src="http://s2.wp.com/wp-content/themes/vip/makeblog/img/flickr.png?m=1347432875g" alt="Make on Flickr"></a></li>
								<li><a href="http://facebook.com/makemagazine" target="_blank" title="Like MAKE on Facebook"><img src="http://s2.wp.com/wp-content/themes/vip/makeblog/img/facebook.png?m=1347432875g" alt="Make on Facebook"></a></li>
								<li><a href="http://www.stumbleupon.com/to/stumble/stumblethru:makezine.com?utm_source=Makezine&amp;utm_medium=StumbleThru&amp;utm_campaign=StumbleThruButton" target="_blank" title="Stumble MAKE on StumbleUpon"><img src="http://s2.wp.com/wp-content/themes/vip/makeblog/img/stumbleupon.png?m=1351191030g" alt="Stumble Make Magazine"></a></li>
								<li><a href="http://instagram.com/makemagazine" target="_blank" title="View MAKE on Instagram"><img src="http://makezineblog.files.wordpress.com/2012/12/instagram.png" alt="MAKE on Instagram"></a></li>
								<li><a href="https://google.com/+MAKE/" target="_blank" title="Connect with MAKE on Google+"><img src="http://s2.wp.com/wp-content/themes/vip/makeblog/img/google-plus.png?m=1347432875g" alt="MAKE on Google+"></a></li>
							</ul>
						<!-- END socialArea -->
						</div> 
					<!-- END span3 about-us -->
					</div>
					<div class="span3 subscribe">
						<div class="top-border row-fluid">
							<div class="footer-content">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/arrow-footer.png" width="80" height="48" id="mag-arrow" class="hidden-sm hidden-xs">
								<h5 class="header">Subscribe to MAKE!</h5>
								<p>Get the print and digital versions when you subscribe</p>
								<hr class="hidden-sm hidden-xs" />
							</div>
							<div class="footer-image">
								<a href="https://www.pubservice.com/MK/subscribe.aspx?PC=MK&amp;PK=M3AMZB" target="_blank" title="Subscribe to MAKE for the latest copy of the magazine!"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/footer-make-cover.gif" alt="MAKE Magazine Cover" width="115" height="163" id="mag-cover"></a>
							</div>
						</div>
					<!-- END span subscribe -->
					</div>
				<!-- END MAIN row (main) -->
				</div>
				<?php echo make_copyright_footer(); ?>
			<!-- END container -->
			</div>
		<!-- END new-footer -->
		</section>
	
	</div> <!-- /container -->

		<!-- Le javascript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script>jQuery(".entry-content:odd").addClass('odd');</script>

		<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery(".scroll").click(function(event){
				//prevent the default action for the click event
				event.preventDefault();
		 
				//get the full url - like mysitecom/index.htm#home
				var full_url = this.href;
		 
				//split the url by # and get the anchor target name - home in mysitecom/index.htm#home
				var parts = full_url.split("#");
				var trgt = parts[1];
		 
				//get the top offset of the target anchor
				var target_offset = jQuery("#"+trgt).offset();
				var target_top = target_offset.top;
		 
				//goto that anchor by setting the body scroll top to anchor top
				jQuery('html, body').animate({scrollTop:target_top - 50}, 1000);

				//Style the pagination links

				jQuery('a span.badge').addClass('badge-info');
				
			});
			jQuery('.hide-thumbnail').removeClass('thumbnail');

		});
		</script>

		<script type="text/javascript">
			setTimeout(function(){var a=document.createElement("script");
			var b=document.getElementsByTagName("script")[0];
			a.src=document.location.protocol+"//dnn506yrbagrg.cloudfront.net/pages/scripts/0013/2533.js?"+Math.floor(new Date().getTime()/3600000);
			a.async=true;a.type="text/javascript";b.parentNode.insertBefore(a,b)}, 1);
		</script>


		<?php wp_footer(); ?>
		<?php if ( make_get_cap_option( 'survey_monkey_script' ) == true ) : ?>
			<script src="https://www.surveymonkey.com/jsPop.aspx?sm=t5CAEJmb8Kj1m5yXEHUTOg_3d_3d"> </script>
		<?php endif; ?>
		
	</body>
</html>
