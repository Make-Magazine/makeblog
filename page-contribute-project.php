<?php
/*
 * Template Name: Post Contribute Form
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 *
 */
get_header(); ?>

	<?php do_action( 'before_contribute' ); ?>

	<div class="single">

		<div class="container authentication">

			<div class="row">

				<div class="span12">

					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

						<article class="post-holder category-top" style="display:none;">

							<div class="thanks hide">
								<div class="row">
									<div class="span8 offset2">
										<h2>Thanks for your project submission!</h2>
										<p>We'll review your project and contact you shortly</p>
									</div>
								</div>
							</div>

							<div class="row content-wrapper">
								<div class="span8 offset2">

									<h3 class="submitted-title hide">Preview</h3>

									<header class="projects-masthead">
										<h1 class="post-title">
											<span class="the-title"></span>
											<?php
												if ( is_user_logged_in() )
													echo '<a href="#" class="btn btn-warning wordpress-edit">WordPress Edit</button></a>';
											?>
										</h1>

									</header>

									<section class="post-content"></section>

								</div>
							</div>

							<div class="bottom-steps" id="target">

								<form class="form form-horizontal contribute-form-get-steps" method="post">
									<?php echo wp_nonce_field( 'get_steps', 'get_steps' ); ?>
									<input type="hidden" name="post_id" value="80">
								</form>

								<div class="row">

									<div class="span4">

										<div class="steps-list-output"></div>

										<!-- Beginning Sync AdSlot 3 for Ad unit header ### size: [[300,250]]  -->
										<div id='div-gpt-ad-664089004995786621-3'>
											<script type='text/javascript'>
												// We should find a way to display this ad...
												// googletag.display('div-gpt-ad-664089004995786621-3');
											</script>
										</div>
										<!-- End AdSlot 3 -->

										<div class="parts-tools">

										<ul class="top">
												<li class="active"><a href="#1" data-toggle="tab">Parts</a></li>
												<li class="divider"> / </li>
												<li><a href="#2" data-toggle="tab">Tools</a></li>
											</ul>
											<div class="tab-content">
												<div class="tab-pane parts-pane active" id="1">No parts, yet...</div>
												<div class="tab-pane tools-pane" id="2">No tools, yet...</div>

											</div>

										</div>

									</div>

									<div class="span8">

										<div class="tab-content" id="steppers">

											<div class="steps-output"></div>

										</div>

									</div>

								</div>
							</div>

							<div class="saving-progress"></div>
						</article>


						<section id="contribute-form-wrapper" <?php post_class(); ?>>

							<!-- Contribute -->
							<form class="form form-horizontal validate-form contribute-form" id="add-post-content" method="post">
								<?php echo wp_nonce_field( 'contribute_post', 'contribute_post' ); ?>
								<?php echo wp_nonce_field( 'update_post_nonce', 'update_post' ); ?>
								<input type="hidden" name="user_id" id="user_id" class="user_id" value="<?php echo get_current_user_id(); ?>">
								<fieldset>
									<div class="control-group">
										<div class="control-label"></div>
										<div class="controls">
											<div class="projects-masthead">
												<h1><?php the_title(); ?></h1>
												<input type="hidden" class="post_ID" name="post_ID" value="">
											</div>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="post_title">Title</label>
										<div class="controls">
											<input type="text" class="input-xlarge" name="post_title" id="post_title" required>
											<p class="help-block">Add the name of the post here.</p>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="post_content">Summary</label>
										<div class="controls">
											<?php
												$args = array(
													'teeny' 	=> true,
													'tinymce' 	=> true,
													);
												wp_editor( '', 'post_content', $args );
											?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="category">Category</label>
										<div class="controls">
											<?php
												$categories = get_categories();

												if ( ! empty( $categories ) ) {

													echo '<select name="cat" id="cat" class="postform" required>';
														echo '<option value="">– Select A Category –</option>';
														foreach ( $categories as $cat ) {
															echo '<option class="category-' . absint( $cat->term_id ) . ' category-' . esc_attr( $cat->slug ) . '" value="' . absint( $cat->term_id ) . '">' . esc_html( $cat->name ) . '</option>';
														}
													echo '</select>';

												}
											?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="browse_file">Image</label>
										<div class="controls">
											<input type="file" name="" value="" title="Add One or More Images" id="file" class="file-inputs" multiple required>
										</div>
									</div>
								</fieldset>
							</form>

							<!-- Steps -->
							<form class="form form-horizontal validate-form contribute-form-steps" id="add-steps" action="add_steps" method="post">
								<fieldset>
									<section class="control-group">
										<div class="control-label"></div>
										<div class="controls">
											<h1>Add Steps to the Project</h1>
										</div>
									</section>
									<section class="nonce">
										<?php echo wp_nonce_field( 'contribute_steps_nonce', 'contribute_steps_nonce' ); ?>
										<input type="hidden" name="total-steps" value="1">
										<input type="hidden" class="post_ID" name="post_ID" value="">
									</section>
									<section class="steps-wrapper">
										<div class="steps-list">
											<div class="step row">
												<div class="span12">
													<h4 class="step-title">Step 1</h4>
													<input type="hidden" class="step-number" name="step-number-1" value="1">
												</div>
												<div class="image-wrapper span3">
													<div class="fileinput fileinput-new" data-provides="fileinput">
														<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
														<div>
															<span class="btn btn-default btn-file">
																<span class="fileinput-new">Select image</span>
																<span class="fileinput-exists">Change</span>
																<input type="file" class="step-file" id="step-image" name="step-images-1[]" required>
															</span>
															<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
														</div>
													</div>
												</div>
												<div class="content-wrapper span9">
													<input type="text" class="title" name="step-title-1" placeholder="Enter your step title..." value="">
													<textarea name="step-lines-1[]" id="step_content"></textarea>
												</div>
											</div>
										</div>
										<script id="steps-template" type="text/template">
											<div class="step row">
												<div class="span12">
													<h4 class="step-title">Step ##count##</h4>
													<input type="hidden" class="step-number" name="step-number-##count##" value="##count##">
												</div>
												<div class="image-wrapper span3">
													<div class="fileinput fileinput-new" data-provides="fileinput">
														<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
														<div>
															<span class="btn btn-default btn-file">
																<span class="fileinput-new">Select image</span>
																<span class="fileinput-exists">Change</span>
																<input type="file" class="step-file" id="step-image" require name="step-images-##count##[]">
															</span>
															<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
														</div>
													</div>
												</div>
												<div class="content-wrapper span9">
													<input type="text" class="title" name="step-title-##count##" placeholder="Enter your step title..." value="">
													<textarea name="step-lines-##count##[]" class="step_content" id="step_content"></textarea>
													<button class="btn alignright remove-step"><i class="icon icon-minus"></i> Remove Step</button>
												</div>
											</div>
										</script>
										<section class="repeater-tools">
											<div class="control-group">
												<label class="control-label" for="tools-url"></label>
												<div class="controls">
													<button class="btn add-step"><i class="icon icon-plus"></i> Add Another Step</button>
												</div>
											</div>
										</section>
									</section>
								</fieldset>
							</form>

							<!-- Parts Form -->
							<form class="form form-horizontal validate-form contribute-form-parts" id="add-parts" method="post">
								<fieldset>
									<section class="control-group">
										<div class="control-label"></div>
										<div class="controls">
											<h1>Add Parts to the Project</h1>
										</div>
									</section>
									<section class="nonce">
										<?php echo wp_nonce_field( 'contribute_parts', 'contribute_parts' ); ?>
										<input type="hidden" name="total-parts" value="1">
										<input type="hidden" class="post_ID" name="post_ID" value="">
									</section>
									<div class="parts-wrapper">
										<div class="parts-list">
											<div class="part row">
												<div class="span12">
													<div class="control-group">
														<label class="control-label"></label>
														<div class="controls">
															<h4 class="part-title">Part 1</h4>
															<input type="hidden" name="part-number-1" value="1">
															<input type="hidden" name="parts-notes-1" class="parts-notes" id="parts-notes">
														</div>
													</div>
													<section class="part">
														<div class="control-group">
															<label class="control-label" for="parts-name">Name</label>
															<div class="controls">
																<input type="text" name="parts-name-1" id="parts-name" class="input-xlarge parts-name" value="">
															</div>
														</div>
														<div class="control-group">
															<label class="control-label" for="parts-qty">Quantity</label>
															<div class="controls">
																<input type="number" name="parts-qty-1" id="parts-qty" class="input-xlarge parts-qty" value="">
															</div>
														</div>
														<div class="control-group">
															<label class="control-label" for="parts-url">URL</label>
															<div class="controls">
																<input type="url" name="parts-url-1" id="parts-url" class="input-xlarge parts-url" value="">
															</div>
														</div>
														<div class="control-group">
															<label class="control-label" for="parts-type">Type</label>
															<div class="controls">
																<input type="text" name="parts-type-1" id="parts-type" class="input-xlarge parts-type" value="">
															</div>
														</div>
													</section>
												</div>
											</div>
										</div>
										<script id="parts-template" type="text/template">
											<div class="part row">
												<div class="span12">
													<div class="control-group">
														<label class="control-label"></label>
														<div class="controls">
															<h4 class="part-title">Part ##count##</h4>
															<input type="hidden" name="part-number-##count##" class="part-number" value="##count##">
															<input type="hidden" name="parts-notes-##count##" class="parts-notes" id="parts-notes">
														</div>
													</div>
													<section class="part">
														<div class="control-group">
															<label class="control-label" for="parts-name">Name</label>
															<div class="controls">
																<input type="text" name="parts-name-##count##" id="parts-name" class="input-xlarge parts-name" value="">
															</div>
														</div>
														<div class="control-group">
															<label class="control-label" for="parts-qty">Quantity</label>
															<div class="controls">
																<input type="number" name="parts-qty-##count##" id="parts-qty" class="input-xlarge parts-qty" value="">
															</div>
														</div>
														<div class="control-group">
															<label class="control-label" for="parts-url">URL</label>
															<div class="controls">
																<input type="url" name="parts-url-##count##" id="parts-url" class="input-xlarge parts-url" value="">
															</div>
														</div>
														<div class="control-group">
															<label class="control-label" for="parts-type">Type</label>
															<div class="controls">
																<input type="text" name="parts-type-##count##" id="parts-type" class="input-xlarge parts-type" value="">
															</div>
														</div>
														<div class="control-group">
															<label for="" class="control-label"></label>
															<div class="controls">
																<button class="btn alignleft remove-part"><i class="icon icon-minus"></i> Remove Part</button>
															</div>
														</div>
													</section>
												</div>
											</div>
										</script>
										<section class="repeater-tools clear">
											<div class="control-group">
												<label class="control-label" for="parts-url"></label>
												<div class="controls">
													<button class="btn add-part"><i class="icon icon-plus"></i> Add Another Part</button>
												</div>
											</div>
										</section>
									</section>
								</fieldset>
							</form>

							<!-- Let's add the tools -->
							<form class="form form-horizontal validate-form contribute-form-tools" id="add-tools" method="post">
								<fieldset>
									<section class="control-group">
										<div class="control-label"></div>
										<div class="controls">
											<h1>Add Tools to the Project</h1>
										</div>
									</section>
									<section class="nonce">
										<?php echo wp_nonce_field( 'contribute_tools', 'contribute_tools' ); ?>
										<input type="hidden" name="total-tools" value="1">
										<input type="hidden" class="post_ID" name="post_ID" value="">
									</section>
									<div class="tool-wrapper">
										<div class="tools-list">
											<div class="tool row">
												<div class="span12">
													<div class="control-group">
														<label class="control-label"></label>
														<div class="controls">
															<h4 class="part-title">Tool 1</h4>
															<input type="hidden" name="tools-number-1" value="1">
															<input type="hidden" name="tools-thumb-1" value="">
															<input type="hidden" name="tools-notes-1" value="">
														</div>
													</div>
													<div class="control-group">
														<label class="control-label" for="tools-name">Name</label>
														<div class="controls">
															<input type="text" name="tools-name-1" id="tools-name" class="input-xlarge" value="">
														</div>
													</div>
													<div class="control-group">
														<label class="control-label" for="tools-url">URL</label>
														<div class="controls">
															<input type="url" name="tools-url-1" id="tools-url" class="input-xlarge" value="">
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<script id="tools-template" type="text/template">
										<div class="tool row">
											<div class="span12">
												<div class="control-group">
													<label class="control-label"></label>
													<div class="controls">
														<h4 class="tool-title">Tool ##count##</h4>
														<input type="hidden" name="tools-number-##count##" class="tools-number" value="">
														<input type="hidden" name="tools-thumb-##count##" class="tools-thumb" value="">
														<input type="hidden" name="tools-notes-##count##" class="tools-notes" value="">
													</div>
												</div>
												<div class="control-group">
													<label class="control-label" for="tools-name">Name</label>
													<div class="controls">
														<input type="text" name="tools-name-##count##" id="tools-name" class="input-xlarge tools-name" value="">
													</div>
												</div>
												<div class="control-group">
													<label class="control-label" for="tools-url">URL</label>
													<div class="controls">
														<input type="url" name="tools-url-##count##" id="tools-url" class="input-xlarge tools-url" value="">
													</div>
												</div>
												<div class="control-group">
													<label for="" class="control-label"></label>
													<div class="controls">
														<button class="btn alignleft remove-tool"><i class="icon icon-minus"></i> Remove Tool</button>
													</div>
												</div>
											</div>
										</div>
									</script>
									<section class="repeater-tools">
										<div class="control-group">
												<label class="control-label" for="tools-url"></label>
												<div class="controls">
													<button class="btn add-tool"><i class="icon icon-plus"></i> Add Another Tool</button>
												</div>
											</div>
									</section>
								</fieldset>
							</form>
						</section>

					<?php endwhile; else: endif; ?>

				<div>

			</div>

		</div>

	</div>

<?php get_footer(); ?>