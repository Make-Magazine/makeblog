<?php
/**
 * Instagram photos from the Maker Faire feed
 */
?>
<div class="row-fluid">
	<div class="span6">
		<a href="http://www.ustream.tv/channel/maker-faire-bay-area-2014" title="">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/crowd.jpg " alt="Crowd at Maker Faire">
		</a>
	</div>
	<div class="span6">
		<a href="https://www.youtube.com/watch?v=7K6DfBwXfyY&list=PLwhkA66li5vDEuZtgSeshEn3AAzJKxam3">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/make-live.jpg " alt="Make: Live video stream">
		</a>
	</div>
</div>
<div class="spacer"></div>
<div class="row-fluid">
	<h2 class="red"><a href="http://instagram.com/makerfaire" title="Maker Faire on Instagram">@makerfaire</a> on Instagram</h2>
	<?php echo make_show_images(); ?>
</div>