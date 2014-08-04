<?php
/**
 * The search sidebar template
 *
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 */
?>

					<div class="span4">

						<?php dynamic_sidebar( 'search' ); ?>

						<div class="box">

							<?php
								$args = array(
									'before_widget'		=> '<div class="inner">',
									'before_title'		=> '<div class="heading">',
									'title'				=> '<h3>Refine Search</h3>',
									'after_title'		=> '</div>',
									'after_widget'		=> '</div>',
									);

								make_search_facets( $args );
							?>

						</div>

						<div class="sidebar-ad">

							<!-- Beginning Sync AdSlot 2 for Ad unit header ### size: [[300,250]]  -->
							<div id='div-gpt-ad-664089004995786621-2'>
								<script type='text/javascript'>
									googletag.cmd.push(function(){googletag.display('div-gpt-ad-664089004995786621-2')});
								</script>
							</div>
							<!-- End AdSlot 2 -->

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

					</div>
