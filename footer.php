<?php
/**
 * The generic footer template.
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     The Make Team webmaster@makermedia.com
 *
 */
?>

				<div class="footer-ad <?php echo ( make_is_parent_page() && ! is_category( 'maker-pro' ) ) ? 'grey' : '' ; ?>" style="clear:both;">

					<div class="ad-slot">

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
								<li><a href="//makermedia.com" target="_blank">About Us</a></li>
								<li><a href="//makermedia.com/work-with-us/advertising/" target="_blank">Advertise with Us</a></li>
								<li><a href="//makermedia.com/work-with-us/job-openings/" target="_blank">Careers</a></li>
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
								<li><a href="//makermedia.com/privacy/" target="_blank">Privacy</a></li>
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

	</div> <!-- /container -->

		<!-- Le javascript -->
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

		<?php wp_footer(); ?>
		<?php if ( make_get_cap_option( 'survey_monkey_script' ) == true ) : ?>
			<script src="https://www.surveymonkey.com/jsPop.aspx?sm=t5CAEJmb8Kj1m5yXEHUTOg_3d_3d"> </script>
		<?php endif; ?>

		<!-- AddRoll Retargeting Pixel -->
		<script type="text/javascript">
		adroll_adv_id = "KNRSJHIPMNCYTPL6CH6ZAM";
		adroll_pix_id = "65IC7MDQJVEX5LW2ZNA7YF";
		(function () {
		var oldonload = window.onload;
		window.onload = function(){
		   __adroll_loaded=true;
		   var scr = document.createElement("script");
		   var host = (("https:" == document.location.protocol) ? "https://s.adroll.com" : "http://a.adroll.com");
		   scr.setAttribute('async', 'true');
		   scr.type = "text/javascript";
		   scr.src = host + "/j/roundtrip.js";
		   ((document.getElementsByTagName('head') || [null])[0] ||
		    document.getElementsByTagName('script')[0].parentNode).appendChild(scr);
		   if(oldonload){oldonload()}};
		}());
		</script>

		<script type="text/javascript">
			setTimeout(function(){var a=document.createElement("script");
			var b=document.getElementsByTagName("script")[0];
			a.src=document.location.protocol+"//dnn506yrbagrg.cloudfront.net/pages/scripts/0013/2533.js?"+Math.floor(new Date().getTime()/3600000);
			a.async=true;a.type="text/javascript";b.parentNode.insertBefore(a,b)}, 1);
		</script>
	<!-- Hidden Stuff -->
    <div class="fancybox popup" style="display:none;">
	    <h3>Don't Miss Out!</h3>
	    <p>Get our free weekly newsletter and keep up with the latest Make: news and information</p>
						<?
							$isSecure = 'http://';
							if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
								$isSecure = "https://";
							}
						?>
	    	    <form action="http://whatcounts.com/bin/listctrl" method="POST">
						<input type="hidden" name="slid" value="6B5869DC547D3D46B52F3516A785F101" />
						<input type="hidden" name="cmd" value="subscribe" />
						<input type="hidden" name="custom_source" value="modal_light_blue" /> 
						<input type="hidden" name="custom_incentive" value="none" /> 
						<input type="hidden" name="custom_url" value="<?php echo $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>" />
						<input type="hidden" id="format_mime" name="format" value="mime" />
						<input type="hidden" name="goto" value="<?php echo $isSecure.$_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>?thankyou=true" />
						<input type="hidden" name="custom_host" value="<?php echo $_SERVER["HTTP_HOST"]; ?>" />
						<input type="hidden" name="errors_to" value="" />
	      <div>
	        <input name="email" id="makezinemain" placeholder="Email Address" required="required" type="text"><br>
	        <input value="Start Making" class="btn-modal newsletter-set-cookie" id="newsletter-set-cookie" type="submit">
	      </div>
	    </form>
    </div>
	</body>
</html>
