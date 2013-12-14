<?php 

/*

Table of Contents
-----------------

1.	Error Reporting
2.	WordPress.com VIP Stuff
3.	Page Numbering
4.	Comments Function
5.	Short Codes
6.	Theme Stuff
7.	Custom Taxonomies
8.	Page 2 - Custom Post Type
9.	YouTube Embed Function
10.	Contribute Function
11.	Scheduled Posts
12.	From the Maker Shed
13.	Search Engine
14.	Search Terms Custom Post Type
*/

// 1. Error Reporting

if ( defined( 'WP_CLI' ) && WP_CLI )
	include_once dirname( __FILE__ ) . '/includes/class-make-cli.php';

// 2. WordPress.com VIP Hosting Stuff
include_once dirname( __FILE__ ) . '/includes/vip.php';

// 3. NUMBERED PAGE NAVIGATION
include_once dirname( __FILE__ ) . '/includes/pagenavi.php';

// 4. Comments Function
include_once dirname( __FILE__ ) . '/includes/comment.php';

// 5. Shortcodes
include_once dirname( __FILE__ ) . '/includes/shortcodes.php';

// 6. Theme Stuff
include_once dirname( __FILE__ ) . '/includes/theme_stuff.php';

// 7. Custom Taxonomies
include_once dirname( __FILE__ ) . '/includes/taxonomies.php';

// 8. Page 2 - Custom Post Type
include_once dirname( __FILE__ ) . '/includes/page_2.php';

// 9. YouTube Embed Function 
include_once dirname( __FILE__ ) . '/includes/youtube.php';

// 10. Contribute Function
include_once dirname( __FILE__ ) . '/includes/contribute.php';

// 11. Scheduled Posts
include_once dirname( __FILE__ ) . '/includes/wordpress-scheduled-time.php';

// 12. From the Maker Shed
include_once dirname( __FILE__ ) . '/includes/ftms.php';

// 13. Search Engine
include_once dirname( __FILE__ ) . '/includes/search-terms.php';

// 14. Search Terms Custom Post Type
include_once dirname( __FILE__ ) . '/includes/search-terms-cpt.php';

// 15. Search Terms Custom Post Type
include_once dirname( __FILE__ ) . '/includes/featured-makers.php';

// 16. Search Terms Custom Post Type
include_once dirname( __FILE__ ) . '/includes/cheezcap-config.php';

// 17. House Ads Custom Post Type
include_once dirname( __FILE__ ) . '/includes/house-ads-cpt.php';

// 18. Parse.ly Dash
include_once dirname( __FILE__ ) . '/includes/wp-parsely/wp-parsely.php';

// 19. Magazine Articles
include_once dirname( __FILE__ ) . '/includes/magazine-cpt.php';

// 20. Craft Feed Meta Box
include_once dirname( __FILE__ ) . '/includes/craft-cpt-stuff.php';

// 21. Slideshow CPT
include_once dirname( __FILE__ ) . '/includes/slideshow.php';

// 22. Reviews CPT
include_once dirname( __FILE__ ) . '/includes/reviews.php';

// 23. Dash API Stuff
include_once dirname( __FILE__ ) . '/includes/dash.php';

// 24. Projects CPT
include_once dirname( __FILE__ ) . '/includes/projects-cpt.php';

// 25. Video CPT
include_once dirname( __FILE__ ) . '/includes/video-cpt.php';

// 26. Order Bender
include_once dirname( __FILE__ ) . '/includes/order-bender.php';

// 27. Errata CPT
include_once dirname( __FILE__ ) . '/includes/errata-cpt.php';

// 28. Contextly
include_once dirname( __FILE__ ) . '/includes/contextly-related-links/contextly-linker.php';

// 28. Markdown
include_once dirname( __FILE__ ) . '/includes/markdown/markdown.php';

// 29. Categories
include_once dirname( __FILE__ ) . '/includes/categories.php';

// 30. JSON Endpoint
include_once dirname( __FILE__ ) . '/includes/json-endpoint.php';

// 31. Projects Step Manager
include_once dirname( __FILE__ ) . '/includes/projects-manager.php';

// 31. Maker Camp
include_once dirname( __FILE__ ) . '/includes/maker-camp.php';

// 33. CLI CSV
if ( defined('WP_CLI') && WP_CLI )
	include_once dirname( __FILE__ ) . '/includes/wp-cli.php';

// 34. Author Bio
include_once dirname(  __FILE__  ) . '/includes/class-author-bio.php';

// 35. Go Links
include_once dirname(  __FILE__  ) . '/includes/post-types/go.php';

// 36. Bit.ly Functions
include_once dirname(  __FILE__  ) . '/includes/bitly.php';

// 37. Maker Camp Map
include_once dirname( __FILE__ ) . '/includes/google-maps.php';

// 38. Content Manager
include_once dirname( __FILE__ ) . '/includes/magazine-dashboard/magazine-dashboard.php';

// 39. Newsletter Post Type
include_once dirname(  __FILE__  ) . '/includes/post-types/newsletter.php';

// 40. Social Stats
include_once dirname(  __FILE__  ) . '/includes/stats/stats.php';

// 41. Blog Dashboard
include_once dirname( __FILE__ ) . '/includes/blog-dashboard/blog-dashboard.php';

// 42. Search Facets
include_once dirname( __FILE__ ) . '/includes/search/search.php';

// 43. Maker Shed Functions
include_once dirname( __FILE__ ) . '/includes/shed/shed.php';

// 44. Bootstrap Navbar Walker
include_once dirname( __FILE__ ) . '/includes/bootstrap-walker.php';


?>