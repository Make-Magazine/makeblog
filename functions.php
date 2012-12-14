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

// error_reporting(E_ALL);

// 2. WordPress.com VIP Hosting Stuff

include_once dirname(__file__) . '/includes/vip.php';

// 3. NUMBERED PAGE NAVIGATION

include_once dirname(__file__) . '/includes/pagenavi.php';

// 4. Comments Function

include_once dirname(__file__) . '/includes/comment.php';

// 5. Shortcodes

include_once dirname(__file__) . '/includes/shortcodes.php';

// 6. Theme Stuff

include_once dirname(__file__) . '/includes/theme_stuff.php';

// 7. Custom Taxonomies

include_once dirname(__file__) . '/includes/taxonomies.php';

// 8. Page 2 - Custom Post Type

include_once dirname(__file__) . '/includes/page_2.php';

// 9. YouTube Embed Function 

include_once dirname(__file__) . '/includes/youtube.php';

// 10. Contribute Function

include_once dirname(__file__) . '/includes/contribute.php';

// 11. Scheduled Posts

include_once dirname(__file__) . '/includes/wordpress-scheduled-time.php';

// 12. From the Maker Shed

include_once dirname(__file__) . '/includes/ftms.php';

// 13. Search Engine

include_once dirname(__file__) . '/includes/search-terms.php';

// 14. Search Terms Custom Post Type

include_once dirname(__file__) . '/includes/search-terms-cpt.php';

// 15. Search Terms Custom Post Type

include_once dirname(__file__) . '/includes/featured-makers.php';

// 16. Search Terms Custom Post Type

include_once dirname(__file__) . '/includes/cheezcap-config.php';

// 17. House Ads Custom Post Type

include_once dirname(__file__) . '/includes/house-ads-cpt.php';

// 18. Parse.ly Dash

include_once dirname(__file__) . '/includes/wp-parsely/wp-parsely.php';

// 19. Magazine Articles

include_once dirname(__file__) . '/includes/magazine-cpt.php';

// 20. Craft Feed Meta Box

include_once dirname(__file__) . '/includes/craft-cpt-stuff.php';

// 21. Slideshow CPT

include_once dirname(__file__) . '/includes/slideshow.php';

// 22. Reviews CPT

include_once dirname(__file__) . '/includes/reviews.php';

// 23. Dash API Stuff

include_once dirname(__file__) . '/includes/dash.php';

// 24. Projects CPT
 
include_once dirname(__file__) . '/includes/projects-cpt.php';

// 25. Video CPT
 
include_once dirname(__file__) . '/includes/video-cpt.php';

// 26. Order Bender
 
include_once dirname(__file__) . '/includes/order-bender.php';

// 27. Errata CPT
 
include_once dirname(__file__) . '/includes/errata-cpt.php';

// 28. Contextly
 
include_once dirname(__file__) . '/includes/contextly-related-links/contextly-linker.php';

// 29. Gigya Signature
 
//include_once dirname(__file__) . '/includes/gigya/SigUtils.php';

// 30. Gigya Constants
 
//include_once dirname(__file__) . '/includes/gigya/GSConfig.php';

// 31. Gigya - Contribute
 
//include_once dirname(__file__) . '/includes/gigya/contribute-guest-author.php';
?>
