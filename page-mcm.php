<?php
/**
 * Template Name: MCM - Raspberry Pi
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Jake Spurlock <jspurlock@makermedia.com>
 * 
 */
get_header(); ?>
		
	<div class="single">
	
		<div class="container">

			<div class="row">

				<div class="span12">
					
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		
				</div>
			
			</div>
			
			<div class="row">
				
				<div class="span8">
					
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/RASPBERRYPI_AD.jpg" alt="Raspberry Pi Design Contest">
					
				</div>
				
				<div class="span4">
					
					<div class="sidebar-ad">
					
						<!-- Beginning Sync AdSlot 2 for Ad unit header ### size: [[300,250]]  -->
						<div id='div-gpt-ad-664089004995786621-2'>
							<script type='text/javascript'>
								googletag.cmd.push(function(){googletag.display('div-gpt-ad-664089004995786621-2')});
							</script>
						</div>
						<!-- End AdSlot 2 -->

					</div>
					
				</div>
				
			</div>
			
			<div class="tabbable">
				<ul class="nav nav-tabs">
					<li class=""><a href="#1" data-toggle="tab">About</a></li>
					<li class=""><a href="#3" data-toggle="tab">Prizes</a></li>
					<li class="active"><a href="#gallery" data-toggle="tab">Gallery of Pi</a></li>
					<li class=""><a href="#rules" data-toggle="tab">Rules</a></li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane" id="1">
					
						<h2>About</h2>
						
						<p><strong>Congratulations to our <a href="http://blog.makezine.com/2013/04/26/announcing-the-winners-of-the-raspberry-pi-design-contest/">Winners</a>!</strong></p>
						
						<p>MAKE's Raspberry Pi Design Contest is a celebration of the innovation inspired by this affordable single-board computer that's taking the maker world by storm. Each entry should use the Raspberry Pi as an intrinsic part of the project, but may include other circuitry, software, mechanical, or sculptural parts as needed.</p>

						<p>We've partnered with <a href="http://www.mcmelectronics.com/">MCM</a> to give away over $3,500 worth of prize packages!</p>
						
						<p>The deadline to submit an entry is 11:59pm PT on April 11th.</p>

						<p>Pi Projects will be entered into one of the following four categories, and evaluated by a panel of judges using the criteria below.</p>

						<h4>Pi Project Categories:</h4>
						
						<ul>
							<li><strong>Artistic</strong>: Use the physical computing of Raspberry Pi as a component of your music, animation, sound, performance, or art installation.</li>
							<li><strong>Utility</strong>: Detail your amazingly useful, day-to-day application for this inexpensive Linux-based computer.</li>
							<li><strong>Education</strong>: Show us a compelling idea for how the Pi can be utilized for education, whether in a classroom or a community workshop setting.</li>
							<li><strong>Enclosure</strong>: Raspberry Pi are bare PCBs with exposed ports. Do you have a design for a case that's more clever or cool than all the rest?</li>
						</ul>

						<h4>Entries will be judged by the following criteria:</h4>
						<ul>
							<li><strong>Documentation (30%)</strong>: Supporting material such as a blog, flickr set of photos, YouTube video, etc.
							<li><strong>Project Success (30%)</strong>: Did your project achieve its goal?
							<li><strong>Unique Application (40%)</strong>: Novel use of the Pi.
						</li>
						
						<?php if ( function_exists( 'sharing_display') ) echo sharing_display(); ?> 
					
					</div>
					
					<div class="tab-pane" id="3">
						
						<h2>Prizes</h2>
						
						<div class="row">
						
							<div class="span6">
								
								<p>Four (4) Category Prize Winners will each receive an MCM Raspberry Pi Prize Package (total estimated retail value of $615.91).</p>
									
								<p>One (1) Grand Prize winner will receive an MCM Raspberry Pi Prize Package &amp; a Printrbot Jr. 3D Printer (Total estimated retail value of $1,114.91)</p>

								<p>The MCM Raspberry Pi Prize Package includes: USB DMM, DC Power Supply, Digital Soldering Iron, Gertboard, Pi Face, Pi View, Wi-Pi Wireless Adapter, &amp; Raspberry Pi Iron-On Skill Badge.</p>	
								
							</div>
							
							<div class="span6">
						
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/MCM_Prizes_photoshopped.jpg" alt="MCM Grand Prize" class="pull-right">		
								
							</div>
							
						</div>
						
					</div>
					
					<div class="tab-pane" id="rules">
						
						<h2>Raspberry Pi Design Contest</h2>
						<h3>OFFICIAL RULES</h3>

						<p>This promotion is intended for play and participation in the United States only and shall be construed and evaluated according to the laws of the United States. Please do not participate if you are not a legal resident of the United States at the time of entry.</p>

						<p>NO PURCHASE NECESSARY TO ENTER OR TO WIN.  A PURCHASE WILL NOT INCREASE YOUR CHANCE OF WINNING. CONTEST OPEN ONLY TO LEGAL RESIDENTS OF THE 50 UNITED STATES AND DISTRICT OF COLUMBIA WHO ARE OF THE AGE OF MAJORITY IN THEIR STATE OF RESIDENCE AT THE TIME OF ENTRY (19 OR OLDER IN AL AND NE, 18 OR OLDER IN ALL OTHER STATES). VOID OUTSIDE THE UNITED STATES AND WHERE OTHERWISE PROHIBITED BY LAW.</p>

						<p>Important: Please read these Official Rules before entering the Raspberry Pi Design Contest (the "Contest") sponsored by Maker Media, Inc. and MCM Electronics (each a “Sponsor”, and collectively “Sponsors”).   </p>

						<ol>
						<li><p><strong>BINDING AGREEMENT</strong>: In order to enter the Contest, you must agree to these Official Rules (“Rules”).  The Rules consist of the terms and conditions on this page and the Contest Entry Form.  Because you will be bound by these Rules and these Rules will form a legally binding agreement with respect to this Contest, please read them carefully. You may not submit an Entry (as defined in Section 3 below) unless you agree to these Rules.  You agree that participation in this Contest and/or submission of an Entry in the Contest constitutes your full and unconditional agreement to these Rules and Sponsors' decisions, which are final and binding in all matters related to the Contest. </p></li>
						<li><p><strong>ELIGIBILITY</strong>: Contest open to legal residents of the 50 United States and the District of Columbia who are of the age of majority in their state of residence (19 or older in AL and NE, 18 or older in all other states) at the time of entry. Employees, directors and officers of Sponsors, their respective subsidiaries, affiliates, distributors, retailers, contractors, agents, advertising and promotional agencies, and members of their immediate family (spouse, parents, children, sibling and their respective spouse) are not eligible to participate.  Void outside of the United States and where otherwise prohibited by law.  Contest is subject to all applicable federal, state and local laws and regulations.   </p></li>
						<li><p><strong>HOW TO ENTER</strong>:  Contest begins at 12:01 a.m. PDT on March 14, 2013 and will end at 11:59 p.m. PDT on April 11, 2013 (the “Contest Period”).  During the Contest Period, participants have the opportunity to submit a Raspberry Pi project.Each entry should use the Raspberry Pi as an intrinsic part of the project, but may include other circuitry, software, mechanical, or sculptural parts as needed. To enter the Contest, please visit the Contest landing page at blog.makezine.com/raspberry-pi-design-contest and submit the Contest Entry Form. As part of entering the Contest, you will be required to select one of the following four categories, which best reflects the nature of your project. The four categories are Artistic, Utility, Enclosure, and Education. The Contest Entry Form, the Project and any other documentation and materials submitted in connection with the Contest will together constitute your entry and are collectively hereinafter referred to as “Entry”.  Automated Entries are prohibited, and any use of automated devices will cause disqualification.  You may enter as many times as you wish, but please do not submit duplicate or substantially similar Projects.  Entries must be received by 11:59 p.m. PDT on April 11, 2013 to be eligible for the Contest. <br>
						All Entries become the property of Sponsors and none will be returned. Should multiple users of the same e-mail account enter the Contest and a dispute thereafter arise regarding the identity of the contestant, the contestant shall be deemed to be the Authorized Account Holder.  “Authorized account holder” is defined as the natural person who is assigned an e-mail address by an Internet access provider, on-line service provider or other organization which is responsible for assigning e-mail addresses or the domain associated with the submitted e-mail address. Please see the privacy policy located at http://makermedia.com/privacy/ for details of Sponsor's policy regarding the use of personal information collected in connection with this Contest.  Email addresses obtained through the Contest will only be used by Sponsors to notify the winners and contestants of the Contest results, unless contestants elect to “opt in” to a particular use of his/her email address when submitting the Contest Entry Form.  Entries must be in English. Each Entry must be the original work of the submitting contestant; created solely by the submitting contestant, must not have been submitted in any other contest and won previous awards; must not have been previously published or marketed; must not infringe third-party rights of any third party, including but not limited to copyright, trademark and right of privacy and publicity, and must be suitable for publication (i.e., not be obscene or indecent). </p></li>
						<li><p><strong>WINNERS SELECTION</strong>:  All Entries will be judged by a qualified panel of 4 judges selected by Sponsors based on the following judging criteria: 
						(a) Unique Application: 40%: novel use of the Pi. 
						(b) Documentation: 30%: supporting material such as a blog, Flickr set of photos, YouTube video, etc.
						(c) Project Success: 30%: did your project achieve its goal? </p>

						<p>Contestants will submit their entry to one of the following four categories: Enclosure, Artistic, Utility, or Education. One winner will be selected from each category. Additionally, one Grand Prize Winner will be selected as best overall project.</p>

						<p>The contestant with the Entry with the highest total score among all judging criteria will be the potential Grand Prize Winner, subject to verification. The next contestant with the Entry with the next highest total score in each category will be the Category Prize Winner. The Grand Prize Winner, the Category Prize Winners are collectively hereinafter referred to as “Winners”.  In the event of a tie, tie breaker will be based upon the highest score in the first judging criteria, continuing thereafter to each judging criteria in order, as needed, to break the tie.  The decisions of the judging panel will be issued no later than April 25, 2013, and will be final and binding on all matters relating to the Contest. </p></li>
						<li><p><strong>WINNER NOTIFICATION</strong>: Each Winner will be notified by email on or before April 25, 2013. Sponsors are not responsible for any change of contestant's email address. Any prize or prize notification returned as undeliverable or otherwise not claimed within seven (7) days after notification of prize award will be forfeited and awarded to an alternate winner. Each Winner may be required to execute and return an affidavit of eligibility and publicity, liability and other release within seven (7) days of notification attempt or prize will be forfeited and an alternate Winner will be selected.</p></li>
						<li><p><strong>PRIZES</strong>: One (1) Grand Prize Winner, and four (4) Category Prize Winners will receive the following:</p>

						<ul>
						<li>Grand Prize (1):  Grand Prize Winner will receive one Printrbot Jr 3D Printer (Assembled), one USB DMM, one DC Power Supply, one Digital Soldering Iron, one Gertboard, one Pi Face, one Pi View, one Wi-Pi Wireless Adapter, and one Raspberry Pi Iron-On Skill Badge. Total estimated retail value of Grand Prize is $1,114.91.</li>
						<li>Category Prize (4):  Category Prize Winners will receive one USB DMM, one DC Power Supply, one Digital Soldering Iron, one Gertboard, one Pi Face, one Pi View, one Wi-Pi Wireless Adapter, and one Raspberry Pi Iron-On Skill Badge. Total estimated retail value of each Category Prize is $615.91.</li>
						</ul>

						<p>Estimated total value of all prizes: US $3,578.55.  All prizes amounts are in US dollars.  All prizes will be awarded, provided they are properly claimed.  Prizes are not transferable.  No cash redemptions.  No substitutions or exchanges of the prizes will be permitted, except that Sponsors reserve the right to substitute a prize of equal or greater value for any prize that becomes unavailable. The prizes are awarded "as is" and without warranty of any kind, express or implied, (including, without limitation, any implied warranty of merchantability or fitness for a particular purpose). Acceptance or use of prize is at Winners' own risk.  All federal, state, and local taxes are the responsibility of the Winners. Limit one prize per household.</p></li>
						<li><p><strong>GENERAL CONDITIONS FOR PARTICIPATION</strong>:  By submitting an Entry, you represent and warrant that:  you are the sole owner of all rights in and to the materials that constitute your Entry; your Entry is your original work; you are the photographer of any photos submitted, videographer of any videos submitted, and the author of any written materials submitted; your Entry does not violate laws prohibiting copyright or trademark infringement, defamation, misuse of trade secrets, invasion of privacy, or other laws; and use of your Entry by Sponsors will not infringe on the rights of any third parties.   By submitting an Entry, you grant Sponsors and their agents the irrevocable and perpetual nonexclusive right to print, publish, reproduce, distribute, modify, create derivative works from, promote, and provide access to any such Entry, in all media throughout the world, and without consideration to you.  By submitting an Entry, you agree that your submission is gratuitous and made without restriction and will not place Sponsors under any obligation, and that Sponsors are free to disclose or otherwise disclose the ideas contained in the Entry on a non-confidential basis to anyone or otherwise use the ideas without any additional compensation to you. You acknowledge that, by accepting your Entry, Sponsors do not waive any rights to use similar or related ideas previously known to Sponsors, or developed by their employees, or obtained from sources other than you.   Except where prohibited by law, by submitting an Entry into the Contest, you authorize Sponsors and their agents, to use your name, likeness, Entry submission materials, and/or Prize information, in any and all media without territorial or time limitation, for any advertising, promotional, or any other purpose related to the Contest, without further compensation to, or permission from, you.</p></li>
						<li><p><strong>LIMITATION OF LIABILITY</strong>:  Sponsors and any of their respective parent companies, subsidiaries, affiliates, directors, officers, professional advisors, employees, and agencies will not be responsible for (1) any late, lost, or misrouted entries or errors in transmission; (2) any disruptions to Internet connection, injuries, losses, or damages caused by events beyond the control of Sponsors; or (3) any printing or typographical errors in any materials associated with the Contest.  Sponsors and their agencies are not responsible for technical, hardware, software, or telephone malfunctions of any kind and shall not be liable for failed, incorrect, incomplete, inaccurate, garbled, or delayed electronic communications utilized in this Contest which may limit the ability to participate in the Contest. If for any reason, including infection by computer virus, bugs, tampering, unauthorized intervention, fraud, technical failures, or any other cause beyond the control of Sponsors, which corrupts or affects the administration, security, fairness, integrity, or proper conduct of this Contest, the Contest is not capable of being conducted as described in these rules, Sponsors shall have the right, at their sole discretion, to modify and/or cancel the Contest.  By entering the Contest, submitting an Entry and/or accepting a prize, you release Sponsors and any of their respective parent companies, subsidiaries, affiliates, directors, officers, employees, and agencies (collectively, the "Released Parties") from any liability whatsoever, and waive any and all causes of action, for any claims, costs, injuries, losses, or damages of any kind arising out of or in connection with the Contest or acceptance, possession, use and/or misuse of any prize (including, without limitation, claims, costs, injuries, losses, and damages related to personal injuries, death, damage to or destruction of property, rights of publicity or privacy, defamation or portrayal in a false light, whether intentional or unintentional) whether under a theory of contract, warranty, tort (including negligence, whether active, passive, or imputed), strict liability, product liability, contribution, or any other theory.</p></li>
						<li><p><strong>GOVERNING LAW</strong>: The Contest will be governed, construed, and interpreted under the laws of the United States.  Participants who violate these Rules, tamper with the operation of the Contest, or engage in any conduct that is detrimental to Sponsors, the Contest, or any other participant (as determined in Sponsors' sole discretion) are subject to disqualification. By entering the Contest, you agree that all issues and questions concerning the construction, validity, interpretation and enforceability of these Rules, your rights and obligations, or the rights and obligations of the Sponsors in connection with the Contest, shall be governed by, and construed in accordance with, the laws of State of California, without giving effect to any choice of law or conflict of law rules (whether of the State of California or any other jurisdiction), which would cause the application of the laws of any jurisdiction other than the State of California.  Participants further consent to the jurisdiction and venue of the federal, state and local courts located in San Francisco, California.</p></li>
						<li><p><strong>WINNER'S LIST</strong>: A list of Winners will be posted at blog.makezine.com/raspberry-pi-design-contest for a period of six months after the end of the Contest.</p></li>
						<li><p><strong>SPONSORS' ADDRESS</strong>:  </p>

						<ul>
						<li>Maker Media, Inc., 1005 Gravenstein Hwy N., Sebastopol, CA 95472.</li>
						<li>MCM Electronics, 650 Congress Park Drive, Centerville, OH 45459. </li>
						</ul></li>
						</ol>

						<p>The Contest and all accompanying materials are copyright © 2013 Maker Media Media, Inc. <br>
						The MAKE logo is a registered trademark of Maker Media, Inc. All other trademarks are property of their respective owners.</p>
						</body>
						
					</div>
					
					<div class="tab-pane active" id="gallery">
						
						<article <?php post_class(); ?>>

							<?php the_content(); ?>
							
							<script type="text/javascript">
								
								jQuery(document).ready(function(){
									jQuery('a[data-toggle="tab"]').on('shown', function (e) {
										jQuery('.gallery-row, .gallery-group, article a img').css('height', '').css('width', '');
									})
								});

							</script>
					
						</article>
						
					</div>
				</div>
			</div>
									
			<div class="row">
			
				<div class="span12">
					
					<?php endwhile; ?>

					<?php else: ?>
					
						<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
					
					<?php endif; ?>
				
				</div>
					
			</div>

		</div>

	</div>
	
<script>

	jQuery('a[data-toggle="tab"]').on('shown', function (e) {
		googletag.pubads().refresh();
		ga('send', 'pageview');
		console.log('Pushed a pageview, and an ad refresh, like a boss.');
	});

</script>

<?php get_footer(); ?>
