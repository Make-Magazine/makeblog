<?php
/**
 * Template Name: Weekend Projects
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
			
					<div class="projects-masthead">
						
						<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
						
					</div>
		
				</div>
			
			</div>
									
			<div class="row">
			
				<div class="span8">
				
					<article <?php post_class(); ?>>

						<div class="banner">

							<img src="http://cdn.makezine.com/make/facebook/weekend_project/MakeProjectsRSLanding1.png" alt="Weekend Projects" />

						</div>

						<h2 id="Section_Check_out_the_past_weekend_projects">Latest Projects</h2>

						<div class="guideList">

							<div class="column">

								<div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="http://blog.makezine.com/projects/10-rail-model-rocket-mega-launcher/">
											<img src="http://guide-images.makeprojects.org/igi/eylPZPA32KXeFikR.thumbnail" alt="Blurb image" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href="http://blog.makezine.com/projects/10-rail-model-rocket-mega-launcher/">10-Rail Model Rocket Mega-Launcher</a></p>
									<p class="blurbBlurb">Make the cub scout rocket derby a blast.</p>
								</div><!--10 Rail Rocket Launcher-->

								<div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="http://blog.makezine.com/projects/bottle-radio/">
											<img src="http://guide-images.makeprojects.org/igi/IH43iswYQZNRMPWU.thumbnail" alt="Blurb image" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href="http://blog.makezine.com/projects/bottle-radio/">Bottle Radio</a></p>
									<p class="blurbBlurb">Explore the airwaves with this batteryless AM radio receiver.</p>
								</div><!--Bottle Radio-->
						        
								<div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="http://blog.makezine.com/projects/game-show-buttons/">
											<img src="http://guide-images.makeprojects.org/igi/vE5XNVvmEBnUAE2f.thumbnail" alt="Blurb image" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href="http://blog.makezine.com/projects/game-show-buttons/">Game Show Buttons</a></p>
									<p class="blurbBlurb">Get some trusty 555 timer ICs, and you can create a pair of game show buttons.</p>

								</div><!--Game Show Buttons-->
						        <div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="http://blog.makezine.com/projects/hotcold-leds/">
											<img src="http://guide-images.makeprojects.org/igi/MCjiWaqjfHqqWF4X.thumbnail" alt="Blurb image" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href="http://blog.makezine.com/projects/hotcold-leds/">Hot/Cold LEDs</a></p>
									<p class="blurbBlurb">Explore three "hot/cold" projects with one circuit.</p>

								</div><!--Hot/Cold LEDs-->

								<div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="http://blog.makezine.com/projects/little-big-lamp/">
											<img src="http://guide-images.makeprojects.org/igi/uxdUGulRXXjcIBGv.thumbnail" alt="Blurb image" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href="http://blog.makezine.com/projects/little-big-lamp/">Little Big Lamp</a></p>
									<p class="blurbBlurb">Build a bright, energy-efficient lamp with LEDs and PVC.</p>
										
								</div><!--Little Big Lamp-->

							
						    		<div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="http://blog.makezine.com/projects/optical-tremolo-box/">
											<img src="http://guide-images.makeprojects.org/igi/gPPW1HVe1FZNRPSG.thumbnail" alt="Blurb image" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href="http://blog.makezine.com/projects/optical-tremolo-box/">Optical Tremolo Box</a></p>
									<p class="blurbBlurb">Build a light-programmable effects box for your guitar.</p>

								</div><!--Optical Tremolo Box-->
								
								<div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="http://blog.makezine.com/projects/projects-in-motion-control-three-types-of-motors-with-555-timers">
											<img src="http://guide-images.makeprojects.org/igi/Nqqth6tOYwgTRApT.thumbnail" alt="Blurb image" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href="http://blog.makezine.com/projects/projects-in-motion-control-three-types-of-motors-with-555-timers">Projects in Motion</a></p>
									<p class="blurbBlurb">Using the humble 555 timer chip you can control three different types of motors.</p>
										
								</div><!--Project In Motion-->

							
								<div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="http://blog.makezine.com/projects/repeat-after-me-a-mintronics-memory-game/">
											<img src="http://guide-images.makeprojects.org/igi/KeXBEDVlV3lGPffR.thumbnail" alt="Blurb image" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href="http://blog.makezine.com/projects/repeat-after-me-a-mintronics-memory-game/">Repeat After Me</a></p>
									<p class="blurbBlurb">Turn a MAKE MintDuino and Mintronics Survival Pack into a fun memory game.</p>

								</div><!--Repeat After Me: A Mintronics Memory Game-->

						    	<div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="http://blog.makezine.com/projects/solar-joule-bracelet/">
											<img src="http://guide-images.makeprojects.org/igi/hWWZjP5uA1TPxrDm.thumbnail" alt="Blurb image" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href="http://blog.makezine.com/projects/solar-joule-bracelet/">Solar Joule Bracelet</a></p>
									<p class="blurbBlurb">Wearable fashion technology that glows!</p>

								</div><!--Solar Joule Bracelet-->
						    
							<div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="http://blog.makezine.com/projects/talking-booby-trap/">
											<img src="http://guide-images.makeprojects.org/igi/3jHpiQwdwXP4Y14p.thumbnail" alt="Blurb image" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href="http://blog.makezine.com/projects/talking-booby-trap/">Talking Booby Trap</a></p>
									<p class="blurbBlurb">Stop snoops with this sneaky gizmo!</p>
								</div><!--Talking Booby Trap-->

							</div>
							
							<div class="columnLast">

								<div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="http://blog.makezine.com/projects/beam-solar-chariots/">
											<img src="http://guide-images.makeprojects.org/igi/JiK6cRUqbpqkqMIE.thumbnail" alt="Blurb image" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href="http://blog.makezine.com/projects/beam-solar-chariots/">BEAM Solar Chariots</a></p>
									<p class="blurbBlurb">Build a fun solar-powered roller or symet BEAM bot.</p>
									
								</div><!--BEAM Solar Chariots-->
						        
						        <div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="http://blog.makezine.com/projects/covert-listening-book-2/">
											<img src="http://guide-images.makeprojects.org/igi/cqW2OWQFeUGhZagW.thumbnail" alt="Blurb image" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href="http://blog.makezine.com/projects/covert-listening-book-2/">Covert Listening Book</a></p>
									<p class="blurbBlurb">Make a wireless "bug" and hide it inside a hollowed-out book.</p>

								</div><!--Covert Listening Book-->
						            
						        	<div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="http://blog.makezine.com/projects/extreme-led-throwies/">
											<img src="http://guide-images.makeprojects.org/igi/Ea1cO1HAUFmYHghF.thumbnail" alt="Blurb image" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href="http://blog.makezine.com/projects/extreme-led-throwies/">Extreme LED Throwies</a></p>
									<p class="blurbBlurb">Learn about and build simple glowing circuits!</p>
								</div><!--Extreme LED Throwies-->

								<div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="http://blog.makezine.com/projects/infrared-string-bass/">
											<img src="http://guide-images.makeprojects.org/igi/itWIyE2KhZfvBdkC.thumbnail" alt="Blurb image" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href="http://blog.makezine.com/projects/infrared-string-bass/">Infrared String Bass</a></p>
									<p class="blurbBlurb">Build an optical guitar using the LM386 amp.</p>
								</div><!--Infrared String Bass-->
						        
						        
						        		<div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="http://blog.makezine.com/projects/mini-rover-redux/">
											<img src="http://guide-images.makeprojects.org/igi/GqKmam4KtLRqfT5r.thumbnail" alt="Blurb image" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href="http://blog.makezine.com/projects/mini-rover-redux/">Mini Rover Redux</a></p>
									<p class="blurbBlurb">Mod a remote-controlled toy and see what it sees.</p>
								</div><!--Mini Rover Redux-->
						        

								<div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="http://blog.makezine.com/projects/monkey-couch-guardian/">
											<img src="http://guide-images.makeprojects.org/igi/11CM4gQFKRymK3ah.thumbnail" alt="Blurb image" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href="http://blog.makezine.com/projects/monkey-couch-guardian/">Monkey Couch Guardian</a></p>
									<p class="blurbBlurb">Make an obnoxious device to discourage animals from jumping on beds and couches.</p>
								</div><!--Monkey Couch Guardian-->
						        
						        		<div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="http://blog.makezine.com/projects/monobox-powered-speaker/">
											<img src="http://guide-images.makeprojects.org/igi/fVQxlqNTOvTVKtu3.thumbnail" alt="Blurb image" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href="http://blog.makezine.com/projects/monobox-powered-speaker/">MonoBox Powered Speaker</a></p>
									<p class="blurbBlurb">Build a powered speaker and amplify your portable music player.</p>

								</div><!--Mono Box Powered Speaker-->
						        
						        	<div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="http://blog.makezine.com/projects/pir-sensor-arduino-alarm/">
											<img src="http://guide-images.makeprojects.org/igi/iSOGQVmBVaSCIygQ.thumbnail" alt="Blurb image" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href="http://blog.makezine.com/projects/pir-sensor-arduino-alarm/">PIR Sensor Arduino Alarm</a></p>
									<p class="blurbBlurb">Build a basic alarm buzzer using a PIR sensor and an Arduino.</p>

								</div><!--PIR Sensor Arduino Alarm-->
								<div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="http://blog.makezine.com/projects/sun-logger/">
											<img src="http://guide-images.makeprojects.org/igi/YIRAt1ETqxxARgNS.thumbnail" alt="Blurb image" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href="http://blog.makezine.com/projects/sun-logger/">Sun Logger</a></p>
									<p class="blurbBlurb">Build a data logger to gather information about sunlight.</p>
								</div><!--Sun Logger-->  
						        
						        
								<div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="http://blog.makezine.com/projects/a-touchless-3d-tracking-interface/">
											<img src="http://guide-images.makeprojects.org/igi/LNr1tjTZTTvni2pj.thumbnail" alt="Blurb image" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href="http://blog.makezine.com/projects/a-touchless-3d-tracking-interface/">A Touchless 3D Tracking Interface</a></p>
									<p class="blurbBlurb">Create a touchless 3D tracking interface with Arduino.</p>

								</div><!--A Touchless 3D Tracking Interface-->

							</div>
							
							<div class="clearer"></div>

						</div>


						<h2 id="Section_Check_out_the_past_weekend_projects">Check out all of the weekend projects</h2>

						<div class="guideList">

							<div class="column">
							
								<div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="http://blog.makezine.com/projects/add-volume-jack/">
											<img src="http://guide-images.makeprojects.org/igi/sWI1o1IkMWmLejfp.thumbnail" alt="Blurb image" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href="http://blog.makezine.com/projects/add-volume-jack/">Add Volume, Jack</a></p>
									<p class="blurbBlurb">Plug in and turn up any sound-making battery toy.</p>
									
								</div><!--Add Volume, Jack-->
								
								<div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="http://blog.makezine.com/projects/alarm-bag/">
											<img src="http://guide-images.makeprojects.org/igi/mbTsspJNM2AKFH3B.thumbnail" alt="Blurb image" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href="http://blog.makezine.com/projects/alarm-bag/">Alarm Bag</a></p>
									<p class="blurbBlurb">Add an anti-theft alarm to your messenger bag!</p>
									
								</div><!--Alarm Bag-->
								
								<div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="http://blog.makezine.com/projects/aircraft-band-receiver/">
											<img src="http://guide-images.makeprojects.org/igi/kHAfSuvIMxxjMond.thumbnail" alt="Blurb image" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href="http://blog.makezine.com/projects/aircraft-band-receiver/">Aircraft Band Receiver</a></p>
									<p class="blurbBlurb">Modify an ordinary AM/FM radio to eavesdrop on air traffic control.</p>
										
									</div><!--Aircraft Band Receiver-->
									
								<div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="http://blog.makezine.com/projects/floating-glow-display/">
											<img src="http://guide-images.makeprojects.org/igi/YUsQEdDM3pRQoUui.thumbnail" alt="Blurb image" />
										</a>
									</div>
									<p class="blurbTitle"><a style="word-spacing:-2px;" href="http://blog.makezine.com/projects/floating-glow-display/">Floating Glow Display</a></p>
									<p class="blurbBlurb">Glowing sign uses an LED and internal reflection for a fascinating visual effect.</p>
										
								</div><!--Floating Glow Display-->
								
								<div class="blurbMini">
									<div class="blurbImage">
										<a class="" href=" http://blog.makezine.com/projects/light-theremin/">
											<img src="http://guide-images.makeprojects.org/igi/ufIy5xsGjFveYJiL.thumbnail" alt="Blurb image" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href=" http://blog.makezine.com/projects/light-theremin/">Light Theremin</a></p>
									<p class="blurbBlurb">Use the ever-popular 555 timer chip to create an instrument of the retro-future!</p>
									
								</div><!--Light Theremin-->
								
								<div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="http://blog.makezine.com/projects/the-luna-mod-looper/">
											<img src="http://guide-images.makeprojects.org/igi/EFqhQZP5Y1OwGRTw.thumbnail" alt="Blurb image" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href="http://blog.makezine.com/projects/the-luna-mod-looper/ ">The Luna Mod Looper</a></p>
									<p class="blurbBlurb">A simple handheld synth and looper box that generates intriguing sonic rhythms.</p>
									
								</div><!--Luna Mod Looper-->
								
								<div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="http://blog.makezine.com/projects/make-23/mystery-electronic-switches-2/">
											<img src="http://guide-images.makeprojects.org/igi/ViPhGR2Ewrc1RTcJ.thumbnail" alt="Blurb image" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href="http://blog.makezine.com/projects/make-23/mystery-electronic-switches-2/">Mystery Electronic Switches</a></p>
									<p class="blurbBlurb">This prank gadget frustrates people, but only you know...</p>
									
								</div><!--Mystery Electronic Switches -->
								
								<div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="http://blog.makezine.com/projects/simple-laser-communicator/">
											<img src="http://guide-images.makeprojects.org/igi/ewn1TNGXX6WFQeUy.thumbnail" alt="Blurb image" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href="http://blog.makezine.com/projects/simple-laser-communicator/">Simple Laser Communicator</a></p>
									<p class="blurbBlurb">Talk in secret over your own private laser beam link.</p>
									
								</div><!--Simple Laser Communicator -->
								
							</div>
							
							<div class="columnLast">

								<div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="http://blog.makezine.com/projects/Project/solar-tv-remote/">
											<img src="http://guide-images.makeprojects.org/igi/aNxnuvWNVFOnSGke.thumbnail" alt="Blurb image" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href="http://blog.makezine.com/projects/Project/solar-tv-remote/">Solar TV Remote</a></p>
									<p class="blurbBlurb">Juice your flipper with sunlight.</p>
									
								</div><!--Solar TV Remote-->
								
								<div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="http://blog.makezine.com/projects/solar-usb-charger">
											<img src="http://guide-images.makeprojects.org/igi/hqAmaWobYLXmrSrk.thumbnail" alt="Blurb image" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href="http://blog.makezine.com/projects/solar-usb-charger/">Solar USB Charger</a></p>
									<p class="blurbBlurb">A simple-to-make charger that safely recharges many USB devices using solar power.</p>
									
								</div><!--Solar USB Charger-->
								
								<div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="http://blog.makezine.com/projects/treasure-finder/">
											<img src="http://guide-images.makeprojects.org/igi/A5eJBRZ6aFhcLlWu.thumbnail" alt="treasure Finder" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href="http://blog.makezine.com/projects/treasure-finder/">Treasure Finder</a></p>
									<p class="blurbBlurb">Build a metal detector for a fraction of the cost.</p>
									
								</div><!--Treasure Finder-->
								
								<div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="http://blog.makezine.com/projects/usb-webcam-microscope/">
											<img src="http://guide-images.makeprojects.org/igi/rv3pBY21Hb3AJVOF.thumbnail" alt="Blurb image" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href="http://blog.makezine.com/projects/usb-webcam-microscope/">USB Webcam Microscope</a></p>
									<p class="blurbBlurb">Convert a webcam into a fun USB microscope.</p>
									
								</div><!--USB Webcam Microscope-->
								
								<div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="http://blog.makezine.com/projects/wearable-light-organ/">
											<img src="http://guide-images.makeprojects.org/igi/hIEpEOliFpbfJaIy.thumbnail" alt="Wearable Light Organ" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href="http://blog.makezine.com/projects/wearable-light-organ/">Wearable Light Organ</a></p>
									<p class="blurbBlurb">Turn a few common components into a wearable dance floor light show!</p>
									
								</div><!--Wearable Light Organ-->
								
								<div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="http://blog.makezine.com/projects/whack-a-mole-game/">
											<img src="http://guide-images.makeprojects.org/igi/OlU3itB2CKUqMUDa.thumbnail" alt="Blurb image" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href="http://blog.makezine.com/projects/whack-a-mole-game/">Whack-a-Mole Game</a></p>
									<p class="blurbBlurb">555 timer chips create a mini version of the "Whack-a-Mole" arcade game.</p>
									
								</div><!--Whack-a-Mole Game-->
								
								<div class="blurbMini">
									<div class="blurbImage">
										<a class="" href="http://blog.makezine.com/projects/555-timer-ball-whacker/">
											<img src="http://guide-images.makeprojects.org/igi/1FH6EIMFyik3ZgTM.thumbnail" alt="Blurb image" />
										</a>
									</div>
									<p class="blurbTitle"><a class="" href="http://blog.makezine.com/projects/555-timer-ball-whacker/">555 Timer Ball Whacker</a></p>
									<p class="blurbBlurb">A wooden arm swats at objects when they draw near.</p>
								</div><!--555 Timer Ball Whacker-->
								
							</div>
							
							<div class="clearer"></div>

						<div class="clearer"></div>
							
						</div>

						
					
					</article>
					
					<?php endwhile; ?>

					<div class="comments">
						<?php comments_template(); ?>
					</div>
					<div id="contextly"></div>

					<?php if ( function_exists('make_shopify_featured_products_slider') ) {
     					echo make_shopify_featured_products_slider( 'row-fluid' );
    				} ?>
					
					<?php else: ?>
					
						<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
					
					<?php endif; ?>
				</div>
				
				
				<?php get_sidebar(); ?>
					
			</div>

		</div>

	</div>

<?php get_footer(); ?>