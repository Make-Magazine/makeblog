<?php
/**
 * Sidebar for Projects Page
 *
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Jake Spurlock <jspurlock@makermedia.com>
 */
?>
					<div class="span4 sidebar">

						<?php
							global $post;
							$meta = get_post_meta( get_the_ID(), 'hide' );
							if ('review' == get_post_type() && (empty($meta[0]) == 'on') ) { ?>

								<div class="drill side">

									<div class="inner">

										<h3>Narrow Your Search</h3>

										<ul id="sidebar">

											<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>
											<?php endif; ?>

										</ul>

									</div>

								</div>

						<?php } ?>

					</div>
