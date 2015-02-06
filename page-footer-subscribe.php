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
						<img class="footer_logo" src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/img/make-logo.png" alt="MAKE Logo">
					</div>
					<div class="clear"></div>
				<!-- END row -->
				</div>
				<div class="row">
					<div class="span3 trending">
						<h5>Trending</h5>
						<?php echo wp_kses_post( stripslashes( make_get_cap_option( 'hot_topics' ) ) ); ?>
					<!-- END span trending -->
					</div>
					<div class="span4 newsletter">
						<h5>Get our Newsletters</h5>
						<form action="http://makermedia.createsend.com/t/r/s/jrsydu/" method="post" id="subForm">
							<fieldset>
								<div class="control-group">
								<label class="control-label" for="optionsCheckbox">Sign up to receive exclusive content and offers.</label>
									<div class="controls">
										<label for="MAKENewsletter">
										<input type="checkbox" name="cm-ol-jjuylk" id="MAKENewsletter" /> Make: News
										</label>
										<label for="MarketWireNewsletter">
										<input type="checkbox" name="cm-ol-jrsydu" id="MAKEMarketWirenewsletter" /> Maker Pro 
										</label>
										<label for="MakerFaireNewsletter">
										<input type="checkbox" name="cm-ol-jjuruj" id="MakerFaireNewsletter" /> Maker Faire 
										</label>
										<label for="MakerShed-MasterList">
										<input type="checkbox" name="cm-ol-tyvyh" id="MakerShed-MasterList" /> Maker Shed
										</label>
		
									<!-- END controls -->
									</div>
								<!-- control-group -->
								</div>
								<div class="input-append control-group email-area">
									<input class="span2" id="appendedInputButton" name="cm-jrsydu-jrsydu" id="jrsydu-jrsydu" type="text" placeholder="Enter your email">
									<button type="submit" class="btn" value="Subscribe" onclick="ga('send', 'event', 'Newsletter Sub', 'Join', jQuery('[name|=cm]').serialize().replace(/&/g, ' ') );">JOIN</button>
								<!-- control-group email-area -->
								</div>
							</fieldset>
						</form>
					<!-- END span newsletter -->
					</div>
					<div class="span5 about-us">
						<h5>About Maker Media</h5>
						<div class="about-column-01">
							<ul>
								<li><a href="http://makermedia.com" target="_blank">About Us</a></li>
								<li><a href="http://makermedia.com/work-with-us/advertising/" target="_blank">Advertise with Us</a></li>
								<li><a href="http://makermedia.com/work-with-us/job-openings/" target="_blank">Careers</a></li>
							</ul>
							
						<div class="clearfix"></div>
							<h5  class="follow">Follow Make:</h5>
						<div class="soc_icons">
							<a class="sprite sprite-twitter"  href="http://twitter.com/make" title="Twitter" target="_blank"></a>
							<a class="sprite sprite-youtube" href="http://youtube.com/make" title="Youtube" target="_blank"></a>
							<a class="sprite sprite-pinterest" href="http://pinterest.com/makemagazine/" title="Pinterest" target="_blank"></a>
							<a class="sprite sprite-facebook" href="http://facebook.com/makemagazine" title="Facebook" target="_blank"></a>
							<a class="sprite sprite-google-plus" href="https://plus.google.com/+MAKE/posts" rel="publisher" title="Google+" target="_blank"></a>
						<!-- END socialArea -->
						</div>
						<!-- END span about-column-01 --></div>
						<div class="about-column-02">
							<ul>
								<li><a href="<?php echo esc_url( home_url( '/contactus' ) ); ?>">Contact Us</a></li>
								<li><a href="http://makermedia.com/privacy/" target="_blank">Privacy</a></li>
								<li><a href="https://www.pubservice.com/MK/subscribe.aspx?PC=MK&PK=M3AMZB">Subscribe to Make:</a></li>
							</ul>
							
							<h5>
								<a href="<?php echo esc_url( home_url( '/contribute/' ) ); ?>">Show Us Your Project</a>
							</h5>
							
						<!-- END span about-column-02 -->
						</div>
	
					<!-- END span3 about-us -->
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
