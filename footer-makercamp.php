<?php
/**
 * Maker Camp footer template.
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Cole Geissinger <cgeissinger@makermedia.com>
 * 
 */
?>
			<section id="footer" class="white-bg new-footer">
				<div class="container">
					<div class="row">
						<div class="span12 logo">	
							<img class="footer_logo" src="<?php bloginfo('stylesheet_directory'); ?>/img/make-logo.png" alt="MAKE">	
							<a href="http://make-digital.com/" target="_blank"><div class="sprite sprite-digital-book-foot"></div></a>
							<h5><a href="http://make-digital.com/" target="_blank">Read Digital Edition</a></h5>
							<a href="http://www.makershed.com/" target="_blank"><div class="sprite sprite-makershed_footer1"></div></a> 
							<h5><a href="http://www.makershed.com/" target="_blank">Shop Maker Shed</a></h5>					
						<!-- END span12 -->
						</div>
						<div class="clear"></div>
					<!-- END row -->
					</div>
					<div class="row">
						<div class="span3 trending">
							<h5>Maker Camp Resources</h5>
								<ul>
									<li><a href="http://cdn.makezine.com/make/maker-camp/coordinator/MakerCamp_Talent_Release.pdf" target="_blank">Hangout Participant Release Form</a></li>
									<li><a href="https://support.google.com/plus/answer/2407397?hl=en&amp;topic=2409412&amp;ctx=topic" target="_blank">G+ Teen Safety Guide</a></li>
									<li><a href="http://www.google.com/intl/en/+/safety/" target="_blank">Safety Center</a></li>
									<li><a href="https://support.google.com/plus/answer/2423637?hl=en&amp;topic=2401644&amp;ctx=topic" target="_blank">For Parents</a></li>
									<li><a href="https://support.google.com/plus/answer/2403357?hl=en&amp;topic=2401644&amp;ctx=topic" target="_blank">For Education</a></li>
									<li class="last"><a href="http://makezine.com/maker-camp/schedule-2012/">2012 Schedule</a></li>
								</ul>
						<!-- END trending -->
						</div>
						<div class="span3 newsletter visible-desktop">
							<h5>Get our Newsletters</h5>  
							<form action="http://makermedia.createsend.com/t/r/s/jrsydu/" method="post" id="subForm">
								<fieldset>
									<div class="control-group">
									<label class="control-label" for="optionsCheckbox">Sign up to receive exclusive content and offers.</label>
										<div class="controls">
											<label for="MAKENewsletter">
												<input type="checkbox" name="cm-ol-jjuylk" id="MAKENewsletter"> MAKE Newsletter
											</label>
											<label for="MakerFaireNewsletter">
												<input type="checkbox" name="cm-ol-jjuruj" id="MakerFaireNewsletter"> Maker Faire Newsletter
											</label>
											<label for="MakerShed-MasterList">
												<input type="checkbox" name="cm-ol-tyvyh" id="MakerShed-MasterList"> Maker Shed
											</label> 
											<label for="MarketWireNewsletter">
												<input type="checkbox" name="cm-ol-jrsydu" id="MAKEMarketWirenewsletter"> Maker Pro Newsletter
											</label> 
										<!-- END controls -->
										</div>
									<!-- control-group -->
									</div>
									<div class="input-append control-group email-area">
										<input class="span2" id="appendedInputButton" name="cm-jrsydu-jrsydu" type="text" placeholder="Enter your email">
										<button type="submit" class="btn" value="Subscribe">JOIN</button>
									<!-- control-group email-area -->
									</div>
								</fieldset>
							</form>
						<!-- END span newsletter -->
						</div>
						<div class="span3 about-us hidden-phone">
							<h5>About <a href="http://makermedia.com" target="_blank">Maker Media</a></h5>
							<div class="row">
								<div class="span">
								<div class="about-column-01">
									<ul>
										<li><a href="<?php echo esc_url( home_url( '/how-to-get-help/' ) ); ?>">Help</a></li>
										<li><a href="http://makermedia.com/contact-us/" target="_blank">Contact</a></li>
										<li><a href="https://www.pubservice.com/MK/subscribe.aspx?PC=MK&amp;PK=M3AMZF">Subscribe</a></li>
										<li><a href="http://makermedia.com/work-with-us/advertising/" target="_blank">Advertise</a></li> 
										<li><a href="http://makermedia.com/privacy/" target="_blank">Privacy</a></li>
									</ul>
								<!-- END span about-column-01 --></div>
								<div class="about-column-02">
									<ul>
										<li><a href="http://makermedia.com" target="_blank">About Us</a></li>
										<li><a href="<?php echo esc_url( home_url( '/faq/' ) ); ?>">FAQ</a></li>
										<li><a href="<?php echo esc_url( home_url( '/forums/' ) ); ?>">Forums</a></li>
										<li><a href="<?php echo esc_url( home_url( '/contribute/' ) ); ?>">Contribute to MAKE</a></li>
									</ul>
								<!-- END about-column-02 -->
								</div>
								<!-- END span -->
								</div>
							<!-- END row -->
							</div>
							<div class="clearfix"></div>
							<div class="soc_icons">
								<a class="sprite sprite-twitter"  href="http://twitter.com/make" title="Twitter" target="_blank"></a>
								<a class="sprite sprite-youtube" href="http://youtube.com/make" title="Youtube" target="_blank"></a>
								<a class="sprite sprite-pinterest" href="http://pinterest.com/makemagazine/" title="Pinterest" target="_blank"></a>
								<a class="sprite sprite-flickr" href="http://www.flickr.com/groups/make/" title="Flickr" target="_blank"></a>
								<a class="sprite sprite-facebook" href="http://facebook.com/makemagazine" title="Facebook" target="_blank"></a>
								<a class="sprite sprite-stumbleupon" href="http://www.stumbleupon.com/to/stumble/stumblethru:makezine.com?utm_source=Makezine&amp;utm_medium=StumbleThru&amp;utm_campaign=StumbleThruButton" title="Stumbleupon" target="_blank"></a>
								<a class="sprite sprite-instagram" href="http://www.instagram.com/makemagazine" title="Instagram" target="_blank"></a>
								<a class="sprite sprite-google-plus" href="https://google.com/+MAKE/" rel="publisher" title="Google+" target="_blank"></a>
							<!-- END socialArea -->
							</div> 
						<!-- END span3 about-us -->
						</div>
						<div class="span3 subscribe hidden-phone">
							<div class="sprite sprite-arrow-footer"></div>
							<a href="https://readerservices.makezine.com/mk/subscribe.aspx?PC=MK&amp;PK=M**NEWB" target="_blank">
								<img src="<?php echo wpcom_vip_get_resized_remote_image_url( make_get_cover_image(), '128', '181' ); ?>" alt="MAKE Magazine Drones" width="128" height="181" id="mag-cover" class="pull-right">
							</a>
							<h5>Subscribe<br> to MAKE!</h5>
							<p>Get the print and digital versions when you subscribe</p>
							<hr>
						<!-- END span3 subscribe -->
						</div>
					<!-- END row -->
					</div>
					<?php echo make_copyright_footer(); ?>
				<!-- END container -->
				</div>
			</section>	
			
		</div> <!-- /container -->

		<!-- Place this tag after the last badge tag. -->
		<script type="text/javascript">
			(function() {
				var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
				po.src = 'https://apis.google.com/js/plusone.js';
				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
			})();
		</script>
		
		<?php wp_footer(); ?>
	</body>
</html>
