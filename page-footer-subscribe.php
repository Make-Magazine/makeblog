<?php
   /**
    * The generic footer template for the subscribe page.
    *
    * @package    makeblog
    * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
    * @author     Jake Spurlock <jspurlock@makermedia.com>
    * Template name: Subscribe Footer
    *
    */
?>
							</div>
						</div>
					</div>
				</div>
			</div>
		<section id="footer" class="new-footer">
			<div class="container">
				<div class="row">
					<div class="span12 logo" >
						<img src="<?php bloginfo('stylesheet_directory'); ?>/img/make-160-footer.png" alt="MAKE">
					</div>
					<div class="clear"></div>
				<!-- END row -->
				</div>
				<div class="row">
					<div class="span3 trending">
						<h5>Trending Topics</h5>
						<?php echo wp_kses_post( stripslashes( make_get_cap_option( 'hot_topics' ) ) ); ?>
					<!-- END span trending -->
					</div>
					<div class="span newsletter">
						<h5>Get our Newsletters</h5>
						<form action="http://makermedia.createsend.com/t/r/s/jrsydu/" method="post" id="subForm">
							<fieldset>
								<div class="control-group">
								<label class="control-label" for="optionsCheckbox">Sign up to receive exclusive content and offers.</label>
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
								<!-- control-group email-area -->
								</div>
							</fieldset>
						</form>
					<!-- END span newsletter -->
					</div>
					<div class="span3 about-us">
						<h5>About <a href="http://makermedia.com">Maker Media</a></h5>
						<div class="about-column-01">
							<ul>
								<li><a href="<?php echo esc_url( home_url( '/how-to-get-help/' ) ); ?>">Help</a></li>
								<li><a href="http://makermedia.com/contact-us/" target="_blank">Contact</a></li>
								<li><a href="http://makermedia.com/work-with-us/advertising/" target="_blank">Advertise</a></li>
								<li><a href="http://makermedia.com/privacy/" target="_blank">Privacy</a></li>
							</ul>
						<!-- END span about-column-01 --></div>
						<div class="about-column-02">
							<ul>
								<li><a href="http://makermedia.com/about-us/management-team/" target="_blank">About Us</a></li>
								<li><a href="<?php echo esc_url( home_url( '/faq/' ) ); ?>">FAQ</a></li>
								<li><a href="http://www.makershed.com/Articles.asp?ID=322">Become an Affiliate</a></li>
								<li><a href="http://makermedia.com/work-with-us/job-openings/" target="_blank">Jobs</a></li>
							</ul>
						<!-- END span about-column-02 -->
						</div>
						<div class="clearfix"></div>
						<div class="socialArea">
							<p class="links">
								<span class="soci"><a href="http://twitter.com/make" target="_blank"><img src="https://s2.wp.com/wp-content/themes/vip/makeblog/img/twitter.png?m=1351191030g" alt="Make on Twitter"></a></span>
								<span class="soci"><a href="http://youtube.com/make" target="_blank"><img src="https://s2.wp.com/wp-content/themes/vip/makeblog/img/youtube.png?m=1347432875g" alt="Make on YouTube"></a></span>
								<span class="soci"><a href="http://pinterest.com/makemagazine/" target="_blank"><img src="https://s2.wp.com/wp-content/themes/vip/makeblog/img/pinterest.png?m=1351191030g" alt="Make on Pintrest"></a></span>
								<span class="soci"><a href="http://facebook.com/makemagazine" target="_blank"><img src="https://s2.wp.com/wp-content/themes/vip/makeblog/img/facebook.png?m=1347432875g" alt="Make on Facebook"></a></span>
								<span class="soci"><a href="https://google.com/+MAKE/" target="_blank"><img src="https://s2.wp.com/wp-content/themes/vip/makeblog/img/google-plus.png?m=1347432875g" alt="MAKE on Google+"></a></span>
							</p>
						<!-- END socialArea -->
						</div>
					<!-- END span3 about-us -->
					</div>
					<div class="span3 subscribe">
						<a href="https://readerservices.makezine.com/mk/subscribe.aspx?PC=MK&amp;PK=M**NEWB">
							<img src="<?php echo wpcom_vip_get_resized_remote_image_url( make_get_cover_image(), '130', '170' ); ?>" alt="MAKE Magazine Robotics" width="130" height="170" id="mag-cover">
						</a>
						<img src="https://s2.wp.com/wp-content/themes/vip/makeblog/img/arrow-footer.png" width="80" height="48" id="mag-arrow">
						<h5>Subscribe<br /> to MAKE!</h5>
						<p>Get the print and digital versions when you subscribe</p>
						<hr />
					<!-- END span subscribe -->
					</div>
				<!-- END MAIN row (main) -->
				</div>
				<?php echo make_copyright_footer(); ?>
			<!-- END container -->
			</div>
		<!-- END new-footer -->
		</section>
	</div>
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
	<!-- Google Code for Make Subscription Conversion Page -->
	<script type="text/javascript">
	   /* <![CDATA[ */
	   var google_conversion_id = 1001991112;
	   var google_conversion_language = "en";
	   var google_conversion_format = "3";
	   var google_conversion_color = "ffffff";
	   var google_conversion_label = "-_fOCJjpogQQyNfk3QM";
	   var google_conversion_value = 0;
	   /* ]]> */
	</script>
	<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js"></script>
	<noscript>
	   <div style="display:inline;">
	      <img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/1001991112/?value=0&amp;label=-_fOCJjpogQQyNfk3QM&amp;guid=ON&amp;script=0"/>
	   </div>
	</noscript>
	</body>
</html>
