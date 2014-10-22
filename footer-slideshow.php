
			</div>

			<div class="row">

				<div class="span12">

					<!-- Beginning Sync AdSlot 2 for Ad unit header ### size: [[729,90]]  -->
					<div id='div-gpt-ad-664089004995786621-1'>
						<script type='text/javascript'>
							googletag.cmd.push(function(){googletag.display('div-gpt-ad-664089004995786621-1')});
						</script>
					</div>
					<!-- End AdSlot 2 -->

				</div>

			</div>

		<script type="text/javascript">
			var entryPermalink = '<?php the_permalink(); ?>';
			jQuery(document).ready(function(){
				jQuery('.content a').attr('target', '_blank');
				jQuery('a span.badge').addClass('badge-info');
				jQuery('#nav-buttons a:first-child').addClass('prev').attr( 'target', '_self' );
				jQuery('#nav-buttons a:last-child').addClass('next').attr( 'target', '_self' );
				jQuery('.self a').attr( 'target', '_self' ).css('border', 'none');
				jQuery('a.self').attr( 'target', '_self' );
				jQuery(document).bind('keydown', 'left', function() {
					var url = jQuery('.prev').attr('href');
					console.log(url);
					if (url) {
						window.location = url;
					}
				});
				jQuery('article img').css('display', 'block');
				jQuery(document).bind('keydown', 'right', function() {
					var url = jQuery('.next').attr('href');
					console.log(url);
					if (url) {
						window.location = url;
					}
				});

				jQuery('#myCarousel').on('slid', function () {
					jQuery('.carousel').carousel('pause');
					googletag.pubads().refresh();
					ga('send', 'pageview');
					console.log('Paused that sucker...');
				})
			});

    	</script>

		<?php wp_footer(); ?>
	</body>

</html>
