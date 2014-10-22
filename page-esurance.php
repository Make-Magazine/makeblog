<?php
/**
 * Template Name: Esurance
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * 
 */
get_header(); ?>
		
	<div class="single">
	
		<div class="container">

			<div class="row">
				
				<div class="span8">
					
					<img src="http://makezineblog.files.wordpress.com/2013/06/620x250-landing-page.jpg" alt="Road to Maker Faire Challenge">
					
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
					<li class="active"><a href="#about" data-toggle="tab">About</a></li>
					<!-- <li class=""><a href="#enter" data-toggle="tab">Enter Now</a></li> 
					<li class="active"><a href="#entries" data-toggle="tab">View Entries</a></li>
					<li class=""><a href="#winners" data-toggle="tab">Previous Winners</a></li>
					<li class=""><a href="#rules" data-toggle="tab">Rules</a></li>-->
				</ul>
				
				<div class="tab-content">
					<div class="tab-pane active" id="about">
						
						<?php 
							if ( have_posts() ) : 
								while ( have_posts() ) : 
									the_post();
									the_content();
								endwhile;
							endif;
						?>
					
					</div>
					
					<!-- <div class="tab-pane" id="enter">
						
						<iframe src = "http://app.wizehive.com/webform/makermedia2013" scrolling="auto" frameborder="0" width="940px" height="2000px"></iframe>
						<p><a href="http://www.wizehive.com/photo-contest-software" target="_blank">Photo Contest Software</a> provided by WizeHive</p>
						
					</div>
					
					<div class="tab-pane active" id="entries">
					
						<iframe onload="window.parent.parent.scrollTo(0,0)" id="wizehiveportal" scrolling="auto" frameborder="0" width="940px" height="3434px"></iframe>
						<script src="http://app.wizehive.com/js/portaliframe.js" type="text/javascript"></script><script type="text/javascript">displayPortal('makermedia2013');</script>
						<p><a href="http://www.wizehive.com/photo-contest-software" target="_blank">Photo Contest Software</a> provided by WizeHive</p>
						
					</div>
					
					<div class="tab-pane" id="winners">
						
					<p>After two years of bringing the Road to Maker Faire Challenge to the Bay Area Maker Faire, we&rsquo;re pleased to bring the challenge to New York City for <a href="http://makerfaire.com/">World Maker Faire</a>! See the previous Winners and Runners-up below. Click any of the images to see more information about each project.</p>
<h3>2013 BAY AREA WINNER:</h3>
<div id="attachment_316225"><a href="http://makezine.com/2013/04/30/winners-on-the-road-to-maker-faire-bay-area/"><img src="http://makezineblog.files.wordpress.com/2013/06/rtmfcba2013_ghl2_crop.jpg?w=1024&h=673" alt="Greathouse Labs" width="1024" height="673" data-lazy-loaded="true"></a>
  <p>Greathouse Labs</p>
</div>
<h3>2013 BAY AREA RUNNERS-UP:</h3>
<div id="attachment_316228"><a href="http://makezine.com/2013/04/30/winners-on-the-road-to-maker-faire-bay-area/"><img src="http://makezineblog.files.wordpress.com/2013/06/rtmfcba2013_laserkaleidoscope02.jpg?w=150&h=99" alt="Laser Kaleidoscope" width="150" height="99" data-lazy-loaded="true"></a>
  <p>Laser Kaleidoscope</p>
</div>
<div id="attachment_316236"><a href="http://makezine.com/2013/04/30/winners-on-the-road-to-maker-faire-bay-area/"><img src="http://makezineblog.files.wordpress.com/2013/06/rtmfcba2013_modelbox-3d_.jpg?w=150&h=100" alt="ModelBox 3D" width="150" height="100" data-lazy-loaded="true"></a>
  <p>ModelBox 3D</p>
</div>
<div></div>
<hr>
<h3>2012 BAY AREA WINNER:</h3>
<div id="attachment_316242"><a href="http://makezine.com/2012/04/25/winners-on-the-road-to-maker-faire-challenge/"><img src="http://makezineblog.files.wordpress.com/2013/06/7225210940_312b4cdec9_h.jpg?w=1024&h=1535" alt="The Vardo" width="1024" height="1535" data-lazy-loaded="true"></a>
  <p>The Vardo</p>
</div>
<h3>2012 BAY AREA RUNNERS-UP:</h3>
<div id="attachment_316266"><a href="http://makezine.com/2012/04/25/winners-on-the-road-to-maker-faire-challenge/"><img src="http://makezineblog.files.wordpress.com/2013/06/plastic-injection-molding.jpg?w=143&h=150" alt="Plastic Injection Molding from Scratch" width="143" height="150" data-lazy-loaded="true"></a>
  <p>Plastic Injection Molding from Scratch</p>
</div>
<div id="attachment_316265"><a href="http://makezine.com/2012/04/25/winners-on-the-road-to-maker-faire-challenge/"><img src="http://makezineblog.files.wordpress.com/2013/06/midi-controlled-lighting.jpg?w=150&h=84" alt="Midi Controlled Lighting" width="150" height="84" data-lazy-loaded="true"></a>
  <p>Midi Controlled Lighting</p>
</div>
</div>
					
					<div class="tab-pane" id="rules">
						
						<p align="center"><strong>ROAD TO MAKER FAIRE CHALLENGE</strong><br>
  <strong><u>OFFICIAL RULES</u></strong></p>
<p><strong>No purchase OR PAYMENT OF ANY KIND necessary to enter or to win</strong>.  <strong>A purchase will not increase your chance of winning.</strong></p>
<p><strong>Contest open only to LEGAL RESIDENTS OF any one of the 50 united states or district of columbia who are AT LEAST the age of majority in their PRIMARY state OR JURISDICTION of residence at the time of entry. Void outside the 50 United States AND D.C. and where prohibited by law.  do not enter if you are not eligible and located in the united states at the time of entry. INTERNET ACCESS AND USE OF A VALID E-MAIL ADDRESS IS REQUIRED. </strong></p>
<p><strong>WINNERS WILL BE REQUIRED TO RESPOND TO WINNER NOTIFICATION AND OTHER COMMUNICATIONS FROM SPONSOR (DEFINED BELOW) WITHIN SEVEN (7) DAYS OR PRIZE MAY BE FORFEITED (IN SPONSOR&rsquo;S SOLE DISCRETION).</strong></p>
<p><strong><u>Important:</u></strong> Please read these Official Rules (&ldquo;Rules&rdquo;) before entering the Road to Maker Faire Challenge  (the &quot;Contest&quot;) sponsored by Maker Media, Inc., (&ldquo;MAKE&rdquo;) and Esurance Insurance Services, Inc. (&ldquo;Esurance&rdquo;) (each a &ldquo;Sponsor&rdquo;, and collectively &ldquo;Sponsors&rdquo;).</p>
<ol>
  <li>
    <p><strong>BINDING AGREEMENT:By entering the Contest, you agree to these Rules.   Please read these Rules carefully; these Rules will form a legally binding agreement with respect to this Contest and you will be bound by them. Without limitation, this contract includes indemnities to the Sponsors from you and a limitation of your rights and remedies. You may not submit an Entry (defined below) unless you agree to these Rules and failure to comply with these Rules may result in disqualification.  You agree that participation in this Contest and/or submission of an Entry in the Contest constitutes your full and unconditional agreement to these Rules and Sponsors&rsquo; decisions, which are final and binding in all matters related to the Contest. </strong></p>
  </li>
  <li>
    <p><strong>ELIGIBILITY</strong>: Contest open to all legal residents of any one (1) of the fifty (50) United States or the District of Columbia, who are located in the United States or the District of Columbia at the time of entry, and who are at least eighteen (18) years old and the age of majority in their primary state or jurisdiction of residence at the time of entry. Entities are not eligible and have no right to claim any prize won by their employees or agents. Employees, directors, members, managers, agents, representatives and officers of Sponsors, their respective subsidiaries, affiliates, distributors, retailers, agents, advertising and promotional agencies (collectively, the &ldquo;Contest Entities&rdquo;), and members of their immediate family (spouse, partner, parents, children, sibling, in-laws, grandparents and grandchildren ) are not eligible to participate.  Void outside of the 50 United States and D.C. and where otherwise prohibited by law.</p>
  </li>
  <li>
    <p><strong>CONTEST DESCRIPTION &amp; GUIDELINES</strong>: During the Contest Period (defined below), entrants are invited to compete for the opportunity to display a do-it-yourself project (&ldquo;Project&rdquo;) at Maker Faire (defined below). The Project must meet the &ldquo;Submission Requirements&rdquo; set forth in Section 4 of these Rules and otherwise fully comply with these Rules.  Projects can be either conceptual or feature a Project that the entrant has already created and must describe a do-it-yourself project suitable for presentation at Maker Faire.  Projects that are interactive and that highlight the process of making things are particularly encouraged.  Projects may be in one or more of the following categories: arts, crafts, engineering, green, music, science, sustainability (each, a &ldquo;Category&rdquo;). If submitted Project is conceptual, documentation and supporting material can also be conceptual in nature.<strong> </strong><strong>Grand Prize Winner will be required to exhibit and present his/her Project at Maker Faire New York 2013 held on September 21 &amp; 22, 2013 in Queens, NY, so please make sure you can fully execute your Project within the timeframe remaining after the Grand Prize Winner is selected</strong>. <strong>FAILURE TO ATTEND AND PARTICIPATE IN MAKER FAIRE WILL RESULT IN FORFEITURE OF THE PRIZE WON. </strong>The Project will be judged as more fully detailed in the &ldquo;Winner Selection&rdquo; section below among all other eligible Projects received during the Contest Period (defined below).</p>
  </li>
  <li>
    <p><strong>HOW TO ENTER</strong>: Contest begins at 12:01:00 a.m. Pacific Time (&ldquo;PT&rdquo;) on June 25, 2013 and will end at 11:59:59 p.m. PT on August 5, 2013 (the &ldquo;Entry Period&rdquo;). Public Voting will begin at 12:01:00 a.m. PT on August 6, 2013 and will end at 11:59 p.m. PT on August 13, 2013 (the &ldquo;Public Voting Period&rdquo; and together with the Entry Period, the &ldquo;Contest Period&rdquo;). To enter, eligible individuals must go to the Contest landing page at <a href="http://www.makezine.com/road-to-maker-faire-challenge">www.makezine.com/road-to-maker-faire-challenge</a> (&ldquo;Website&rdquo;) and follow all on-screen links and instructions to complete and submit the contest entry form, including providing their name, email address and &ldquo;Project Description&rdquo; (collectively with the Project, an &ldquo;Entry&rdquo;). The Project Description must include: Project title, description, byline, category, location, materials list, technical requirements, safety hazards (if any), booth proposal, and any links to images, videos, schematics, or any additional information about the Project. Entrants must provide a valid email address. Each entrant should review all personal information entered for accuracy and make all corrections necessary to inaccurate data before submitting his/her Entry.  Automated entries are prohibited, and any use of automated devices will cause disqualification.  Entries or participation that are forged, altered, incomplete, lost, late, misdirected, mutilated, illegitimate, garbled, or generated by a macro, bot, or other automated means will not be accepted and will be void.  Entries or participation made by any other individual or any entity or group, or originating at any website other than as set forth specifically above, including, without limitation, through commercial promotion subscription notification or entering services, will be declared invalid and disqualified for this Contest.  Limit one (1) Entry per person and email address.  Entrants may not enter with multiple email addresses nor may entrants use multiple identities to enter multiple times. Any entrant who attempts to enter with multiple email addresses under multiple identities or uses any device or artifice to enter multiple times will be disqualified and forfeits any and all prizes won, in Sponsors' discretion. Entries must be received by 11:59:59 pm PT on August 5, 2013 to be eligible for the Contest. The Website&rsquo;s clock will be the official timekeeper for this Contest<strong>. </strong>For purposes of this Contest, only Entries that are actually received and recorded through the Website on the Website&rsquo;s servers will be considered. Other proof of submitting or attempting to submit an Entry (such as, without limitation, a printed, saved or copied automated receipt confirming entry or a &ldquo;thanks for entering&rdquo; screen or message) does not constitute proof of actual receipt of the Entry for purposes of this Contest. Those who do not abide by these Rules, the instructions of Sponsors and the Website and provide all required information will be disqualified in Sponsors&rsquo; sole discretion. As a condition of entering the Contest, without limiting any other provision in these Rules, each entrant gives consent for Sponsor and its agents to obtain and deliver his or her name, address and other information and content to third parties for the purpose of administering this Contest and complying with applicable laws, regulations, and rules. All Entries will not be acknowledged or returned AND, IN FACT, MAY BE DESTROYED. KEEP A COPY OR THE ORIGINAL OF EACH ELEMENT OF YOUR PROJECT, PROJECT DESCRIPTION AND ANYTHING SUBMITTED IN YOUR ENTRY. ANY ENTRY OR PROJECT THAT DOES NOT CONFORM TO THE REQUIREMENTS IN THESE RULES WILL BE DEEMED INELIGIBLE IN SPONSOR&rsquo;S SOLE DISCRETION. Should multiple users of the same e-mail account enter the Contest and a dispute thereafter arise regarding the identity of the entrant, the registered account holder of said e-mail account at the time of entry will be considered the entrant.  &ldquo;Registered account holder&rdquo; is defined as the natural person who is assigned an e-mail address by an Internet access provider, on-line service provider or other organization which is responsible for assigning e-mail addresses or the domain associated with the submitted e-mail address. Potential winner may be required to provide Sponsors with proof that he/she is the registered account holder of the e-mail address associated with the potentially winning entry. If a dispute cannot be resolved to Sponsor&rsquo;s satisfaction, the entry will be deemed ineligible. Please see the privacy policy located at <a href="http://oreilly.com/oreilly/privacy.csp">http://makermedia.com/privacy/</a> and <a href="http://www.esurance.com/privacy-and-security">http://www.esurance.com/privacy-and-security</a> for details of Sponsors&rsquo; policies regarding the use of personal information collected in connection with this Contest. </p>
  </li>
  <li><p><strong>SUBMISSION REQUIREMENTS: </strong>The Project, including any related elements or materials, must meet all of the following Submission Requirements in Sponsors&rsquo; sole discretion, or the associated Entry will be disqualified:</p>

<ul>
  <li>Project must fit in a 10&rsquo; X 10&rsquo; Maker Faire exhibition booth.  Please consider booth display and presentation in your project, and bring enough supporting material to fill booth space. </li>
  <li>Project, any demonstration, and all related materials must be in English. </li>
  <li>Project      must be the original work of and solely owned by the submitting entrant;      however a Project may contain material and elements that are not owned by      the entrant and/or which are subject to the rights of third parties only      if the entrant has obtained, prior to submission, any and all permissions      and rights necessary to permit the use and exhibition of the Project in connection      with the Grand Prize, if awarded to him or her, and use the Project      otherwise as may be applicable in connection with participation in this      Contest.  Any entrant using third      party material or elements agrees to provide Sponsors with written confirmation      of those permissions and rights promptly upon request.</li>
  <li>Project      must not create or imply any association between either Sponsor and any other      individual, entity, or anyone else or his, her, or its products or      services.</li>
  <li>The      Project must NOT identify, reference, or depict any company or its brands,      products, or services.     </li>
  <li>The Project must not have been submitted in any other competition, promotion or contest or won previous awards and must not have been previously published or marketed.</li>
  <li>The Project must not infringe, misappropriate or violate rights of any third party, including but not limited to copyright, moral rights, trade secret, trademark and right of privacy and publicity.</li>
  <li>Project must not: be sexually explicit or suggestive, violent, derogatory of any ethnic, racial, gender, religious, professional or age group, profane or pornographic; contain nudity or any materially dangerous activity; promote alcohol, illegal drugs, tobacco, firearms/weapons (or the use of any of the foregoing);promote or depict any activities that may appear unsafe or dangerous, or any particular political agenda or message; be obscene or offensive; endorse any form of hate or hate group; defame, misrepresent or contain disparaging remarks about Sponsors or their respective products, or other people, products or companies.</li>
  <li>Project must not contain materials embodying the names, likenesses, photographs, or other indicia identifying any person, living or dead, without permission. If Project depicts or includes any such material, entrant must have all permissions and rights from the individual depicted (and his/her parent or legal guardian, if a minor) and agrees to provide Sponsors with written confirmation of those permissions and rights promptly upon request.</li>
  <li>Project must not communicate messages or images inconsistent with the positive images and/or goodwill to which either Sponsor wishes to associate.</li>
  <li>Project must not contain or describe any harmful or illegal activity or content or in any way violate any federal, state, or local laws, rules, or regulations. </li>
  <li>Project must be suitable for presentation in a public forum.</li>
</ul>
<p><strong>Entrant agrees that his/her participation in the Contest and agreement to these Rules and any Contest Entity&rsquo;s display and use of the Project will not violate any agreement to which entrant is a signatory or party.</strong></p>
<p><strong>Entrant will indemnify and hold harmless, Sponsors and Released Parties (as defined below) from any and all claims from any third party for any use or reuse by any Contest Entity of the Project or any related elements or materials.  </strong><strong> </strong></p>
<p>By submitting an Entry in the Contest, you hereby warrant and represent that your Entry conforms to the entry requirements set forth herein. Sponsor reserves the right in its sole discretion to disqualify from the Contest and/or remove from displaying or publishing any Entry or Project that, in its sole discretion, refers, depicts, or in any way reflects negatively upon a Contest Entity, the Contest, or any other person or entity or does not comply with these requirements or these Rules. Any waiver of any obligation hereunder by Sponsors do not constitute a general waiver of any obligation to entrants. Sponsors reserve the right, in their reasonable discretion, during or upon completion of the Contest Period, to request that any entrant resubmit his or her Entry which fails to comply with the Submission Requirements prior to any judging.  </p></li>
  <li>
    <p><strong>CONTEST PUBLIC VOTING:</strong> Each Entry will be posted on the MAKE Website . During the Public Voting Period, visitors to this location will be able to vote for the Entries they think would make the best project exhibit at Maker Faire. Limit one (1) vote per person per day during the Public Voting Period. Any use of robotic, macro, automatic, programmed or like voting methods will void all such votes. Any attempt by Entrants and/or his/her respective family /friends to vote more than the number of times authorized herein using multiple names, paying or retaining third parties for the purposes of voting and/or any other fraudulent mechanism, in order to cast multiple votes will result in disqualification of all such votes received and may result in disqualification of the Entrant for whom the improper votes were received if the Sponsors determine that the Entrant was involved in any way in the perpetration of such fraud. At the end of the Public Voting Period, the ten (10) Entrants receiving the  top ten (10) number of votes will be  deemed the Finalist Entries,  which will then be judged by a panel of Judges .</p>
  </li>
  <li>
    <p><strong>WINNERS SELECTION</strong>:  All ten (10) Finalist Entries will be judged by a qualified panel of experts selected by Sponsors in their sole discretion (&ldquo;Judges&rdquo;).  Finalist Entries shall be judged by the Judges based on the following criteria according to the percentage weights indicated: (a) Originality of idea: 40%; (b) Quality of supporting materials submitted with Project (including project documentation &amp; how you plan to exhibit the project at Maker Faire) : 30%; (c) Innovative use of technology that compliments or contributes to the success of your project: 20%, and (d) challenge/difficulty of completing Project for entrant: 10%.The entrant with the Finalist Entry that receives the highest total score among all judging criteria will be the potential Grand Prize Winner, subject to verification. The two entrants with Finalist Entries with the two next highest scores will be the Runner-Up Winners, subject to verification. In the event of a tie, tie breaker will be based upon the highest score in the first judging criteria, continuing thereafter to each judging criteria in order in these Rules as needed to break the tie. All Judges&rsquo; decisions are final and binding in all matters relating to this Contest.  Entrants acknowledge that other entrants may have created ideas and concepts contained in their Project that may have familiarities or similarities to his/her Entrant Content, and that he/she will not be entitled to any compensation or right to negotiate with the Contest Entities because of these familiarities or similarities. </p>
  </li>

  <li>
    <p><strong>WINNERS NOTIFICATION</strong>: Sponsors reserve the right to contact participants for verification purposes and administration of the Contest.  Potential winners will be notified by email on or about August 16, 2013, in Sponsors&rsquo; sole discretion. Potential winners are subject to verification, including verification of age.  Sponsors are not responsible for any change of entrant&rsquo;s email address. Any prize, prize notification or Contest- related communication is rejected, faulty, returned as undeliverable, if the potential winner does not respond according to the notification&rsquo;s or Sponsors&rsquo; instructions, if the winner cannot attend or participate in any portion of the prize, if the winner or potential winner fails to comply with these Rules, or if a potential winner cannot be reached after a reasonable attempt has been made by a Sponsor (as determined by a Sponsor in its sole discretion) or does not respond according to the notification&rsquo;s or Sponsors&rsquo; instructions, that winner or potential winner may be disqualified and an alternate winner may be selected in accordance with the winner selection procedures described above. As a condition of entering the Contest, each winner agrees (if requested by Sponsor(s)) to complete, execute, and return an affidavit of eligibility and publicity, liability and other releases (unless prohibited by law) without alteration and within seven (7) days of notification attempt and if required by a Sponsor in its sole discretion (which may require providing winner&rsquo;s Social Security Number and/or government-issued identification number and/or copy thereof for tax purposes) or prize will be forfeited and an alternate winner may be selected in accordance with the winner selection method described above.  If a potential winner is found not to be eligible or not in compliance with these Rules, the potential winner will be disqualified in Sponsors&rsquo; sole discretion. In the event of noncompliance with these requirements, the prize may be forfeited in a Sponsor&rsquo;s sole discretion.  The affidavit of eligibility/declaration and liability/publicity release (unless prohibited by law) are subject to verification by Sponsors. Sponsors reserve the right to modify the notification procedures in connection with the selection of any alternate potential winner, if any. Upon prize forfeiture, no compensation will be given and Sponsors will have no responsibility or liability to that participant.  To claim a prize, winner must follow the directions in his or her notification.  In the event that a potential winner is disqualified for any reason, Sponsors reserve the right to award the prize to an alternate entrant even if the disqualified potential winner&rsquo;s name may have been announced including, without limitation, on the Website.</p>
  </li>
  <li>
    <p><strong>PRIZES</strong>: One (1)Grand Prize Winner, and Two (2) Runner-Up Winners, subject to verification, will each receive the following:</p>
 <ul> 
<li><strong>One (1) Grand Prize: </strong>One (1) Grand Prize Winner will receive $2,500 in the form of a check from Esurance to be solely used for the purpose of defraying costs of trip for Grand Prize Winner to Maker Faire in Queens, New York for Grand Prize Winner to present and exhibit his or her winning Project. If he/she does not attend Maker Faire the Grand Prize will be forfeited. Approximate retail value (&ldquo;ARV&rdquo;) of the Grand Prize: $2,500.  <strong> </strong></li>
<li><strong>Two (2) Runner-Up Prizes: </strong>Two (2) Runner-Up Prize Winners will each receive one (1) Maker&rsquo;s Notebook, a 1-year subscription to Make Magazine, and 2 Adult weekend passes to Maker Faire.  The total ARV of each Runner-Up Prize is $184.98.</li>
<li><strong>No air or ground transportation to Maker Faire or lodging will be provided as part of any prize.</strong></li></ul>
<p>Total ARV of all prizes: US $2,869. All prizes amounts are in US dollars.  ARV is as of the date of printing of these Rules.  The difference in the value of the prize as stated herein and value at time of prize notification, if any, will not be awarded. Prizes are not transferable.  No cash redemptions.  No substitutions or exchanges of the prizes will be permitted, except that Sponsors reserve the right to substitute a prize of equal or greater value for any prize that becomes unavailable for any reason. The prizes are awarded &quot;as is&quot; and without warranty of any kind, express or implied (including, without limitation, any implied warranty of merchantability or fitness for a particular purpose). Acceptance and use of Prizes is at each winner&rsquo;s own risk.  All federal, state, and local taxes, as well as any meals, gratuities, accommodations, in-room charges, travel expenses, travel and other insurance, carrier fees, government charges, transfers, ground transportation or other expenses not specified in these Rules as provided as part of a prize are the responsibility of the winner. Limit one (1) prize per person/household.  Prize winners may be issued an IRS 1099 form.  Prize, if legitimately claimed, will be awarded. Prize details not specifically stated in these Rules will be determined in Sponsor&rsquo;s sole discretion. Sponsors are not responsible for and will not replace any lost, mutilated or stolen prize or any prize that is undeliverable or does not reach a winner because of incorrect or changed contact information.  If winner does not accept or use the entire prize, the unaccepted or unused part of the prize will be forfeited and Sponsors will have no further obligation with respect to that prize or portion of the prize.  Sponsors are not responsible for any inability of any winner to accept or use any prize (or portion thereof) for any reason. No more than the stated prizes will be awarded.</p>
<p>By entering this Contest and accepting the prize, each winner agrees to maintain his/her behavior in accordance with all applicable laws and generally accepted social practices in connection with participation in any Contest- or prize-related activity, including, without limitation, attending Maker Faire. The winner understands and agrees that Sponsors or prize providers have the right, in their sole discretion, to disqualify and remove a winner or his/her guest from any activity at any time if a winner&rsquo;s or his/her guest&rsquo;s behavior at any point is uncooperative, disruptive, or may or does cause damage to person, property, or the reputation of Sponsors or otherwise violates the policies of the prize providers, and in such a case, the winner will still be solely responsible for all taxes and other expenses related to the prize. Participants waive the right to assert as a cost of winning any prize, any and all costs of verification and redemption or travel to claim the prize and any liability and publicity which might arise from claiming or seeking to claim said prize.</p></li>
  <li><p><strong>LICENSE: </strong>By submitting an Entry, except where prohibited by law, each entrant grants the Contest Entities and their respective licensees, successors and assigns the irrevocable, sublicensable, absolute right and permission to publish, post, edit, adapt, display, and otherwise use the content of and elements embodied in the Project and Entry in any form, in any manner, in perpetuity, and in any and all media (whether now known or hereafter devised) without compensation of any kind to entrant. Each entrant acknowledges that Sponsors have no obligation to use or post any Entry you submit. By submitting an Entry, you agree that your submission is gratuitous and made without restriction and will not place Sponsors under any obligation, and that Sponsors are free to disclose or otherwise disclose the ideas contained in the Entry on a non-confidential basis to anyone or otherwise use the ideas without any additional compensation to you. You acknowledge that, by accepting your Entry, Sponsors do not waive any rights to use similar or related ideas previously known to Sponsors, or developed by their employees, or obtained from sources other than you.   Each participant acknowledges and agrees that nothing in these Rules will require a Contest Entity to use the Project in part or in whole or to include the Project in any Contest Entity-related property, including, without limitation, any Contest Entities&rsquo; web site or any other online or offline property.  Each participant hereby acknowledges and agrees that the relationship between the participant and any of the Released Parties is not a confidential, fiduciary, or other special relationship, and that the participant&rsquo;s decision to submit his/her Project for purposes of the Contest does not place any of the Released Parties in a position that is any different from the position held by members of the general public with regard to elements of the Project, other than as set forth in these Rules. Each participant acknowledges and agrees that Contest Entities do not now and will not have in the future any duty or liability, direct or indirect, vicarious, contributory, or otherwise, with respect to the infringement or protection of the participant&rsquo;s copyright in and to his/her Project. Each participant acknowledges that, with respect to any claim by participant relating to or arising out of a Contest Entity&rsquo;s actual or alleged use of any Projector other material submitted in connection with the Contest, the damage, if any, thereby caused to the applicable participant will not be irreparable or otherwise sufficient to entitle such participant to seek injunctive or other equitable relief or in any way enjoin the production, distribution, exhibition, or other exploitation of any Contest Entity property or production, and participant&rsquo;s rights and remedies in any such event are strictly limited to the right to recover damages, if any, in an action at law<strong>. </strong>Except where prohibited by law, by submitting an Entry into the Contest, you authorize Sponsors and their agents, to use your name, likeness, the Project and all Entry submission materials, and/or prize information, in any and all media without territorial or time limitation, for any advertising, promotional, or any other purpose without further compensation to, or permission from you and each entrant releases all Released Parties from any and all liability related thereto. Nothing contained in these Rules obligates any Contest Entity to make use of any of the rights granted herein and winner waives any right to inspect or approve any such use.  <strong> </strong></p>
  </li>
  <li>
    <p><strong>GENERAL CONDITIONS: </strong>Participants agree to not damage or cause interruption of the Contest and/or prevent others from using the Contest. Sponsors reserve the right to restrict or void online entries or participation from any IP address if any suspicious entry and/or participation is detected.  Sponsors reserve the right, in their sole discretion, to void entries of any entrants who a Sponsor believes have attempted to tamper with or impair the administration, security, fairness or proper play of this Contest. Either Sponsor&rsquo;s failure to or decision not to enforce any provision in these Rules will not constitute a waiver of that or any other provision.  In the event there is an alleged or actual ambiguity, discrepancy or inconsistency between disclosures or other statements contained in any Contest-related materials and/or these Rules (including any alleged discrepancy or inconsistency in these Rules), it will be resolved in Sponsors&rsquo; sole discretion.  Entrants waive any right to claim ambiguity in the Contest or these Rules.  If either Sponsor determines at any time in its sole discretion that the winner or potential winner is disqualified, ineligible, in violation of these Rules, or engaging in behavior that Sponsor deems obnoxious, inappropriate, threatening, illegal or that is intended to annoy, abuse, threaten or harass any other person, The invalidity or unenforceability of any provision of these Rules will not affect the validity or enforceability of any other provision.  In the event that any provision is determined to be invalid or otherwise unenforceable or illegal, these Rules will otherwise remain in effect and will be construed in accordance with their terms as if the invalid or illegal provision were not contained herein.  If any person supplies false information, obtains entries by fraudulent means or is otherwise determined to be in violation of these Rules in an attempt to obtain any prize, Sponsors may disqualify that person and seek damages from him or her and that person may be prosecuted to the full extent of the law. CAUTION: ANY ATTEMPT TO DAMAGE ANY ONLINE SERVICE OR WEB SITE OR UNDERMINE THE LEGITIMATE OPERATIONS OF THE CONTEST VIOLATES CRIMINAL AND CIVIL LAWS. IF SUCH AN ATTEMPT IS MADE, SPONSOR MAY DISQUALIFY ANY PARTICIPANT MAKING SUCH ATTEMPT AND MAY SEEK DAMAGES TO THE FULLEST EXTENT PERMITTED BY LAW.</p>
  </li>
  <li>
    <p><strong>LIMITATION OF LIABILITY:  </strong>Contest Entities and the respective officers, directors, members, managers, employees, representatives and agents of each(collectively, the &ldquo;Released Parties&rdquo;) will not be responsible for any of the following, whether caused by a Released Party, the entrant or by human error: (1) any late, lost, or misrouted entries, e-mail, mail or Contest-related correspondence or materials or postage-due mail; (2)any error, omission, interruption, defect or delay in transmission or communication; (3) any disruptions to Internet connection; (4) any printing or typographical errors in any materials associated with the Contest, including, without limitation, these Rules; (5) technical, hardware, software, or telephone malfunctions of any kind, including, without limitation, viruses; (6) failed, incorrect, incomplete, inaccurate, garbled, or delayed electronic communications utilized in this Contest which may limit the ability to participate in the Contest; (5) entries that are submitted by illegitimate means (such as, without limitation, by an automated computer program) or entries in excess of the stated limit.   If for any reason, including infection by computer virus, bugs, tampering, unauthorized intervention, fraud, technical failures, or any other cause beyond the control of Sponsors, which corrupts or affects the administration, security, fairness, integrity, or proper conduct of this Contest, the Contest is not capable of being conducted as described in these Rules, Sponsors shall have the right, at their sole discretion, to modify, suspend and/or cancel the Contest and determine winners from Entries already received or as otherwise deemed fair and equitable by Sponsors. Released Parties are not responsible, and may disqualify an entrant, if his or her e-mail address, telephone, or other contact information does not work or is changed without entrant giving prior written notice to Sponsor. Released Parties are not responsible for communications that are undeliverable as a result of any form of active or passive filtering of any kind, or insufficient space in entrant&rsquo;s e-mail or other account to receive e-mail or other messages.  Without limiting any other provision in these Rules, Released Parties are not responsible or liable to any entrant or winner or any person claiming through such entrant or winner for failure to supply the prize or any part thereof in the event that any of the Contest activities or the Released Parties&rsquo; operations or activities are affected, as determined by the Sponsor in its sole discretion, including, without limitation, by reason of any acts of God, any action, regulation, order or request by any governmental or quasi-governmental entity (whether or not the action, regulations, order or request proves to be invalid), equipment failure, threatened terrorist acts, terrorist acts, air raid, blackout, act of public enemy, earthquake, war (declared or undeclared), fire, flood, epidemic, explosion, unusually severe weather, hurricane, embargo, labor dispute or strike (whether legal or illegal) labor or material shortage, transportation interruption of any kind, work slow-down, civil disturbance, insurrection, riot, or any law, rule, regulation, order or other action adopted or taken by any governmental, federal, state or local government authority, or any other cause, whether or not specifically mentioned above.</p>

<p><strong>By entering the Contest, submitting an Entry and/or accepting a prize, you agree to release, indemnify and hold harmless the Released Parties for any liability whatsoever, and waive any and all causes of action, for any claims, costs, injuries, losses, or damages of any kind arising out of or in connection with the Contest or acceptance, possession, use misuse, or awarding of any prize, while preparing for, participating in or traveling to or from any prize- or contest- related activity (including, without limitation, claims, costs, injuries, losses, and damages related to personal injuries, death, damage to or destruction of property, rights of publicity or privacy, defamation or portrayal in a false light, whether intentional or unintentional) whether under a theory of contract, warranty, tort (including negligence, whether active, passive, or imputed), strict liability, product liability, contribution, or any other theory</strong>. <strong>Winner acknowledges that he/she is solely responsible for any actions, claims or liabilities of his/her guest related to any Contest-related activity, including, without, limitation, any actions, claims or liabilities related to guest&rsquo;s use of the prize. </strong></p>
<p>As a condition of entering, except where prohibited, entrants agree (and agree to confirm in writing): (a) under no circumstances will entrant be permitted to obtain awards for, and entrant hereby waives all rights to claim, punitive, incidental, consequential, or any other damages, other than for actual out-of-pocket expenses(if any) not to exceed two hundred and fifty U.S. Dollars ($250 USD); (b) all causes of action arising out of or connected with this Contest, or any prize awarded, shall be resolved individually, without resort to any form of class action; and (c) any and all claims, judgments, and award shall be limited to actual out-of-pocket costs incurred (if any)  not to exceed two hundred and fifty U.S. Dollars ($250 USD), excluding attorneys&rsquo; fees and court costs, and entrant further waives all rights to have damages multiplied or increased.</p>
<p><strong>IN NO EVENT WILL THE RELEASED PARTIES BE RESPONSIBLE OR OTHERWISE LIABLE FOR ANY DAMAGES OR LOSSES OF ANY KIND, INCLUDING DIRECT, INDIRECT, INCIDENTAL, CONSEQUENTIAL OR PUNITIVE DAMAGES RELATED TO THE CONTEST, INCLUDING ANY ACCESS TO OR USE OF THE WEBSITEOR ANY DOWNLOADING FROM OR PRINTING MATERIAL FROM THE WEBSITE.  EVERYTHING ON THE WEBSITE IS PROVIDED &ldquo;AS IS&rdquo; WITHOUT WARRANTY OF ANY KIND, EITHER EXPRESSED OR IMPLIED, INCLUDING IMPLIED WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, OR NON-INFRINGEMENT.  </strong></p></li>
  <li><p><strong>GOVERNING LAW</strong>: The Contest and any dispute arising under or related thereto (whether for breach of contract, tortious conduct or otherwise) will be governed, construed, and interpreted under the laws of the State of California, without reference to its conflicts of law principles. Any legal actions, suits or proceedings related to this Contest (whether for breach of contract, tortious conduct or otherwise) will be brought exclusively in the state or federal courts located in San Francisco, California and each entrant accepts and submits to the personal jurisdiction of these California courts with respect to any legal actions, suits or proceedings arising out of or related to this Contest. </p>
  </li>
  <li>
    <p><strong>WINNERS LIST</strong><strong>: </strong>A list of the winners&rsquo; names will be posted at <a href="http://makezine.com/road-to-maker-faire-challenge">http://makezine.com/road-to-maker-faire-challenge</a> for a period of six months after the end of the Contest<strong>.</strong></p>
  </li>
  <li>
    <p><strong>OFFICIAL RULES: </strong>For a copy of these Rules, visit <a href="http://makezine.com/road-to-maker-faire-challenge">http://makezine.com/road-to-maker-faire-challenge</a> during the Contest Period or send a legal-size, self-addressed, stamped envelope prior to the end of the Contest Period to: Sales Department, Maker Media, Inc., 1005 Gravenstein Hwy North, Sebastopol, CA  95472.  Only one (1) request per outer envelope will be fulfilled.</p>
  </li>
  <li>
    <p><strong>SPONSORS&rsquo;S ADDRESSES</strong><strong>:</strong>  Maker Media, Inc., 1005 Gravenstein Hwy N., Sebastopol, CA 95472 and Esurance Insurance Services, Inc.: 650 Davis Street, San Francisco, CA 94111.</p>
  </li>
</ol>
	
						
					</div> -->
					
				</div>
			</div>

		</div>

	</div>
	
<script>

	jQuery('a[data-toggle="tab"]').on('shown', function (e) {
		googletag.pubads().refresh();
		ga('send', 'pageview');
	});

	// Javascript to enable tabs in Bootstrap via IDs in the URL
	jQuery(document).ready(function() {
		var activeTab = jQuery('[href=' + location.hash + ']');

		// Enable our Bootstrap Tab we
		activeTab && activeTab.tab('show');

		// Update the URL when clicking any of our tabs
		jQuery('a[data-toggle="tab"]').click( function(e) {
	    	history.pushState(null, null, jQuery(this).attr('href') );
	    });

	});

	// Stop the page from jumping.. Yes there's a flicker but it works for now.
	jQuery(window).load(function() {
		var activeTab = jQuery('[href=' + location.hash + ']');
		if(activeTab.length === 1) {
			jQuery(window).scrollTop(0);
		}
	});

</script>

<?php get_footer(); ?>
