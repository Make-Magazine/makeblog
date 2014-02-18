/**
* This page contains all the JavaScript code for the Maker Camp pages
*
* @package    makeblog
* @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
* @author     Cole Geissinger <cgeissinger@makermedia.com>
* 
*/

jQuery(document).ready(function($) {

	// Load our Bootstrap Tab JS on the schedule page
	if ( $('.schedule-content').length >= 1 ) {

		// Run the Bootstrap tab functions
		$('#schedule li.active a').tab('show');
		$('#schedule a').click(function(e) {
			e.preventDefault();

			$(this).tab('show');
		});
		
	}
});