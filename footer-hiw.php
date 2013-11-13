<?php
/**
 * HIW footer template.
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Bill Olson <bolson@makermedia.com>
 * 
 */
?>

		<div class="hiw-footer">
			<div class="container">
				<!-- HIDING FOOTER NAV AS ITS NOT USED ON ORIGINAL SITE
				<ul class="hiw-footer-nav">
						<li><a href="http://makezine.com/hardware-innovation-workshop/overview.html">Overview</a></li>
						<li><a href="http://makezine.com/hardware-innovation-workshop/register.html">Register</a></li>
						<li><a href="http://makezine.com/hardware-innovation-workshop/hotel.html">Hotel</a></li>
						<li><a href="http://makezine.com/hardware-innovation-workshop/agenda.html">Agenda at a Glance</a></li>
						<li><a href="http://makezine.com/hardware-innovation-workshop/keynotes.html">Speaker Roster</a></li>
						<li><a href="http://makezine.com/hardware-innovation-workshop/innovators.html">Showcase Innovators</a></li>  
						<li><a href="http://makezine.com/hardware-innovation-workshop/research.html">Maker Market Research</a></li>
						<li><a href="http://makezine.com/hardware-innovation-workshop/press.html">Press</a></li>
						<li><a href="http://makezine.com/hardware-innovation-workshop/contact.html">Contact</a></li>
						<li><a href="http://makezine.com/hardware-innovation-workshop/overview-2012.html">Hardware Innovation Workshop 2012</a></li>
						<li><a href="http://makezine.com/hardware-innovation-workshop/agenda-2012.html">2012 Agenda</a></li>
						<li><a href="http://makezine.com/hardware-innovation-workshop/keynotes-2012.html">2012 Speaker Roster</a></li>
						<li><a href="http://makezine.com/hardware-innovation-workshop/innovators-2012.html">2012 Showcase Innovators</a></li>
				</ul>
				-->	
				<?php echo make_copyright_footer(); ?>	
			</div><!-- END container -->
		</div><!-- END hiw-footer -->

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
		
	</body>
</html>
