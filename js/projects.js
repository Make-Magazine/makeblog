jQuery(document).ready(function(){
	jQuery('#tabs div').click(function() {
		id = jQuery(this).attr('id');
		googletag.pubads().refresh();
		_gaq.push(['_trackPageview']);
		jQuery('.tab-content div#js-' + id).slideDown();
		jQuery('.tab-content div:not(#js-' + id + ')').slideUp();
	});
});