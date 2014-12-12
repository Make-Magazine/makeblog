<?php
/**
 * The generic sidebar template
 *
 * We use this template for just about everything.
 * // TODO: Consolidate the other files into this one using some conditionals.
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Jake Spurlock <jspurlock@makermedia.com>
 */
?>

					<div class="span4 sidebar">

						<?php dynamic_sidebar( 'sidebar_top' ); ?>

						<div class="sidebar-ad">

							<!-- Beginning Sync AdSlot 2 for Ad unit header ### size: [[300,250]]  -->
							<div id='div-gpt-ad-664089004995786621-2'>
								<script type='text/javascript'>
									googletag.cmd.push(function(){googletag.display('div-gpt-ad-664089004995786621-2')});
								</script>
							</div>
							<!-- End AdSlot 2 -->

						</div>

						<div class="maker-camp-promo">
							<?php

								if( is_single( array( '53649' ))) {
									echo '<a href="http://www.makershed.com/products/el-wire-starter-packs-10ft?utm_source=makezine.com&utm_medium=ads&utm_campaign=maker-camp&utm_keyword=El_Wire_Starter_Packs_10ft" target="_blank"><img src="https://makezineblog.files.wordpress.com/2014/07/elwire.gif" alt="EL-Wire Starter Pack from Maker Shed" /></a>';
								}
							 ?>
						</div>

						<div class="new-dotw widget">
							<div id="div-gpt-ad-664089004995786621-9" class="text-center">
								 <script type='text/javascript'>
								  googletag.cmd.push(function(){googletag.display('div-gpt-ad-664089004995786621-9')});
								 </script>
							</div>
						</div>

						<div class="sidebar-ad">

							<!-- Beginning Sync AdSlot 3 for Ad unit header ### size: [[300,250]]  -->
							<div id='div-gpt-ad-664089004995786621-3'>
								<script type='text/javascript'>
									googletag.cmd.push(function(){googletag.display('div-gpt-ad-664089004995786621-3')});
								</script>
							</div>
							<!-- End AdSlot 3 -->

						</div>

						<?php dynamic_sidebar( 'sidebar_bottom' ); ?>


				</div>
