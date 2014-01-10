<div class="waist">

				<div class="container">

					<div class="row">

						<div class="span8">

							<div class="checkers">

								<div class="row">

									<div class="span4">

										<div class="paddme">
											
											<?php if ( make_get_cap_option( 'ribbon_title_display' ) ) : 
												$ribbon_class = 'attachment-p1'; ?>
												<div class="ribbon"><?php echo esc_html( make_get_cap_option( 'ribbon_title' ) ); ?></div>
											<?php else : $ribbon_class = ''; endif; ?>

											<a href="<?php echo esc_html( make_get_cap_option( 'main_link' ) ); ?>">
											
												<?php
													if ( make_get_cap_option( 'main_id' ) ) {
														echo wp_get_attachment_image( absint( make_get_cap_option( 'main_id' ) ), 'p1', 0, array( 'class' => $ribbon_class ) );
													} else {
														echo '<img src="' . esc_url( make_get_cap_option( 'main_url' ) ) . '"'; 
														if ( make_get_cap_option( 'ribbon_title_display' ) )
															echo 'id="top-left" ';
														echo '/>';
													} 
												?>

											</a>

											<div class="caption">

												<h3><a href="<?php echo esc_html( make_get_cap_option( 'main_link' ) ); ?>"><?php echo esc_html( make_get_cap_option( 'main_title' ) ); ?></a></h3>
												<p><a href="<?php echo esc_html( make_get_cap_option( 'main_link' ) ); ?>"><?php echo esc_html( make_get_cap_option( 'main_subtitle' ) ); ?></a></p>

											</div>

										</div>

									</div>

									<div class="span4">

										<div class="row">

											<div class="span4">

												<div class="paddme small">

													<a href="<?php echo esc_url( make_get_cap_option( 'top_link' ) ); ?>">
													
														<?php
															if ( make_get_cap_option( 'top_url_id' ) ) {
																echo wp_get_attachment_image( absint( make_get_cap_option( 'top_url_id' ) ), 'p2' );
															} else {
																echo '<img class="home-biggest" src="' . esc_url( make_get_cap_option( 'top_url' ) ) . '" />';
															} 
														?>
														
													</a>

													<div class="caption">

														<h3><a href="<?php echo esc_url( make_get_cap_option( 'top_link' ) ); ?>"><?php echo esc_html( make_get_cap_option( 'top_title' ) ); ?></a></h3>
														<p><a href="<?php echo esc_url( make_get_cap_option( 'top_link' ) ); ?>"><?php echo esc_html( make_get_cap_option( 'top_subtitle' ) ); ?></a></p>

													</div>

												</div>

											</div>

											<div class="span4">

												<div class="paddme small">

													<a href="<?php echo esc_url( make_get_cap_option( 'bottom_link' ) ); ?>">
														
														<?php
															if ( make_get_cap_option( 'bottom_url_id' ) ) {
																echo wp_get_attachment_image( absint( make_get_cap_option( 'bottom_url_id' ) ), 'p2' );
															} else {
																echo '<img class="home-biggest" src="' . esc_url( make_get_cap_option( 'bottom_url' ) ) . '" />';
															} 
														?>
														
													</a>

													<div class="caption">

														<h3><a href="<?php echo esc_url( make_get_cap_option( 'bottom_link' ) ); ?>"><?php echo esc_html( make_get_cap_option( 'bottom_title' ) ); ?></a></h3>
														<p><a href="<?php echo esc_url( make_get_cap_option( 'bottom_link' ) ); ?>"><?php echo esc_html( make_get_cap_option( 'bottom_subtitle' ) ); ?></a></p>

													</div>


												</div>

											</div>

										</div>

									</div>
									
									<div class="row-fluid">
										
										<div class="span12">
										
											<div class="featured">
												
												<?php echo make_featured_post(); ?>	
												
											</div>
											
										</div>
										
									</div>

								</div>

							</div>
							
						</div>

						<div class="span4">

							<div class="home-ads">

								<!-- Beginning Sync AdSlot 2 for Ad unit header ### size: [[300,250]]  -->
								<div id='div-gpt-ad-664089004995786621-2'>
									<script type='text/javascript'>
										googletag.cmd.push(function(){googletag.display('div-gpt-ad-664089004995786621-2')});
									</script>
								</div>
								<!-- End AdSlot 2 -->

							</div>

							<div class="home-ads bottom">

								<!-- Beginning Sync AdSlot 2 for Ad unit header ### size: [[300,250]]  -->
								<div id='div-gpt-ad-664089004995786621-3'>
									<script type='text/javascript'>
										googletag.cmd.push(function(){googletag.display('div-gpt-ad-664089004995786621-3')});
									</script>
								</div>
								<!-- End AdSlot 2 -->

							</div>

						</div>

					</div>

				</div>

			</div>