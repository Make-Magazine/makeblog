=== Parse.ly - Dash ===
Contributors: parsely_mike
Tags: analytics, post, page
Requires at least: 3.0
Tested up to: 3.4.1
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Parse.ly's Dash is the world's first analytics tool designed and built for digital publishers.  The wp-parsely WordPress plugin makes it a snap to add the required tracking code to enable Dash on your WordPress site.

== Description ==

[Parse.ly's Dash](http://www.parsely.com/ "Parse.ly - Dash") is an analytics tool designed and made for content publishers.   Tired of trying to figure out Google Analytics reports when all you really want to know is what's working and what isn't?  Then Dash was made for you.  It doesn't matter if you're CNN attracting millions of people per month or trying to build a following on a niche blog covering fashion and style, Dash will help you understand your audience and how your content is performing.

**Features**

* Inserts the required parsely-page <meta> tag as well as JavaScript on all your published pages and posts.
* Allows you to specify the JavaScript implementation to use: standard, DOM free or asynchronous.

Feedback, suggestions, questions or concerns? E-mail us at [support@parsely.com](mailto:support@parsely.com) we always want to hear from you.

== Installation ==

1. If you haven't already done so, [sign up for your free trial of Dash](http://dash.parsely.com/try/)
1. Download the plugin
1. Upload the entire `wp-parsely` folder to your `/wp-content/plugins` directory
1. Activate the plugin through the 'Plugins' menu in WordPress (look for "Parse.ly - Dash")
1. Head to the settings page for the plugin (should be /wp-admin/options-general.php?page=parsely-dash)
1. Add a your API key and choose a tracker implementation method (your API key can be found in the "Setup" settings screen of your Parse.ly account `/mysite.com/settings/code`.)
1. Save your changes and enjoy your data!

Feedback, suggestions, questions or concerns? E-mail us at [support@parsely.com](mailto:support@parsely.com) we always want to hear from you.

== Frequently Asked Questions ==

= Where do I find my API key? =

In the "Setup" settings screen for your account (`/mysite.com/settings/code`) you'll see a snippet of tracking code.  On the
third line of this code look for `data-parsely-site="[API KEY]"`, you want to take the value in between the quotations (usually 
something like mysite.com) and use that for the API key.

= What tracker implementation should I use? =

It's really up to you and your requirements, but [this article in our documentation](http://www.parsely.com/api/tracker.html#javascript-tracker) should help you make a decision.  If you still have questions then reach out to us at [support@parsely.com](mailto:support@parsely.com).

= Why can't I see Dash code on my post when I preview? =

Dash code will only be placed on pages and posts which have been published in WordPress to ensure we don't track traffic generated while you're still writing a post/page.

== Screenshots ==

1. The main settings screen of the wp-parsely plugin
2. The standard JavaScript include being inserted before </body>
3. A sample `parsely-page` meta tag for a home page
4. A sample `parsely-page` meta tag for an article or post

== Changelog ==

= 1.1 =
* Added ability to add prefix to content IDs
* Ensured plugin only uses long tags `<?php` instead of `<?`
* Security updates to prevent HTML/JavaScript injection attacks (values are now sanitized)
* Better error checking of values for API key / implementation method
* Bug fixes

= 1.0 =
* Initial version
* Support for parsely-page and JavaScript on home page and published pages and posts as well as archive pages (date/author/category/tag)

== Upgrade Notice ==

= 1.1 =
This version adds the ability to add a prefix to content IDs and fixes a number of security issues, please upgrade immediately.

= 1.0 =
Initial version.
