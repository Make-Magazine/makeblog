<?php
/*
 * Template Name: Post Contribute Form
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 *
 */
get_header(); ?>

	<div class="single">

		<div class="container authentication">

			<div class="row">

				<div class="span12">

					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

						<article <?php post_class(); ?>>

							<!-- Contribute -->
							<form class="form form-horizontal contribute-form" method="post">
								<?php echo wp_nonce_field( 'contribute_post_nonce', 'contribute_post' ); ?>
								<input type="hidden" name="user_id" id="user_id" class="user_id" value="<?php echo get_current_user_id(); ?>">
								<fieldset>
									<div class="control-group">
										<div class="control-label"></div>
										<div class="controls">
											<div class="projects-masthead">
												<h1><?php the_title(); ?></h1>
											</div>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="post_title">Title</label>
										<div class="controls">
											<input type="text" class="input-xlarge" name="post_title" id="post_title">
											<p class="help-block">Add the name of the post here.</p>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="post_content">Post Content</label>
										<div class="controls">
											<?php wp_editor( 'Tell us about your post...', 'post_content', array( 'teeny' => true ) ); ?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="category">Category</label>
										<div class="controls">
											<?php wp_dropdown_categories( array( 'hierarchical' => true, ) ); ?>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="browse_file">Image</label>
										<div class="controls">
											<input type="file" name="" value="" id="file" multiple>
										</div>
									</div>
									<div class="form-actions">
										<button type="submit" class="btn btn-warning submit-review" data-type="projects">Want to add steps to the post?</button>
										<button type="submit" class="btn btn-primary submit-review" data-type="post">Submit for Review</button>
									</div>
								</fieldset>
							</form>

							<article class="post-holder category-top">
								<header class="projects-masthead">
									<h1 class="post-title"></h1>
								</header>
								<section class="post-content">
								</section>
							</section>

							<!-- Steps -->
							<form class="form form-horizontal contribute-form-steps" action="add_steps" method="post">
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
													<h4>Step 1</h4>
													<input type="hidden" name="step-number-1" value="1">
												</div>
												<div class="image-wrapper span3">
													<div class="fileinput fileinput-new" data-provides="fileinput">
														<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
														<div>
															<span class="btn btn-default btn-file">
																<span class="fileinput-new">Select image</span>
																<span class="fileinput-exists">Change</span>
																<input type="file" class="step-file" id="step-image" name="step-images-1[]">
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
													<h4>Step ##count##</h4>
													<input type="hidden" name="step-number-##count##" value="##count##">
												</div>
												<div class="image-wrapper span3">
													<div class="fileinput fileinput-new" data-provides="fileinput">
														<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
														<div>
															<span class="btn btn-default btn-file">
																<span class="fileinput-new">Select image</span>
																<span class="fileinput-exists">Change</span>
																<input type="file" class="step-file" id="step-image" name="step-images-##count##[]">
															</span>
															<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
														</div>
													</div>
												</div>
												<div class="content-wrapper span9">
													<input type="text" class="title" name="step-title-##count##" placeholder="Enter your step title..." value="">
													<textarea name="step-lines-##count##[]" id="step_content"></textarea>
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
										<div class="form-actions">
											<button type="submit" class="btn btn-primary submit-steps">Save Steps</button>
										</div>
									</section>
								</fieldset>
							</form>

							<!-- Output the Steps -->
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

									</div>

									<div class="span8">

										<div class="tab-content" id="steppers">

											<div class="steps-output"></div>

										</div>

									</div>

								</div>

							<!-- Parts Form -->
							<form class="form form-horizontal contribute-form-parts" method="post">
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
									<section class="parts-wrapper">
										<div class="parts-list">
											<div id="part-1" class="parts-wrapper">
												<div class="control-group">
													<label class="control-label"></label>
													<div class="controls">
														<h4>Part 1</h4>
														<input type="hidden" name="part-number-1" value="1">
														<input type="hidden" name="parts-notes-1" id="parts-notes">
													</div>
												</div>
												<section class="part">
													<div class="control-group">
														<label class="control-label" for="parts-name">Name</label>
														<div class="controls">
															<input type="text" name="parts-name-1" id="parts-name" class="input-xlarge" value="">
														</div>
													</div>
													<div class="control-group">
														<label class="control-label" for="parts-qty">Quantity</label>
														<div class="controls">
															<input type="number" name="parts-qty-1" id="parts-qty" class="input-xlarge" value="">
														</div>
													</div>
													<div class="control-group">
														<label class="control-label" for="parts-url">URL</label>
														<div class="controls">
															<input type="url" name="parts-url-1" id="parts-url" class="input-xlarge" value="">
														</div>
													</div>
													<div class="control-group">
														<label class="control-label" for="parts-type">Type</label>
														<div class="controls">
															<input type="text" name="parts-type-1" id="parts-type" class="input-xlarge" value="">
														</div>
													</div>
												</section>
											</div>
										</div>
										<script id="steps-template" type="text/template">
											<div id="part-##count##" class="parts-wrapper">
												<div class="control-group">
													<label class="control-label"></label>
													<div class="controls">
														<h4>Part ##count##</h4>
														<input type="hidden" name="part-number-##count##" value="1">
														<input type="hidden" name="parts-notes-##count##" id="parts-notes">
													</div>
												</div>
												<section class="part">
													<div class="control-group">
														<label class="control-label" for="parts-name">Name</label>
														<div class="controls">
															<input type="text" name="parts-name-##count##" id="parts-name" class="input-xlarge" value="">
														</div>
													</div>
													<div class="control-group">
														<label class="control-label" for="parts-qty">Quantity</label>
														<div class="controls">
															<input type="number" name="parts-qty-##count##" id="parts-qty" class="input-xlarge" value="">
														</div>
													</div>
													<div class="control-group">
														<label class="control-label" for="parts-url">URL</label>
														<div class="controls">
															<input type="url" name="parts-url-##count##" id="parts-url" class="input-xlarge" value="">
														</div>
													</div>
													<div class="control-group">
														<label class="control-label" for="parts-type">Type</label>
														<div class="controls">
															<input type="text" name="parts-type-##count##" id="parts-type" class="input-xlarge" value="">
														</div>
													</div>
												</section>
											</div>
										</script>
										<section class="repeater-tools">
											<div class="control-group">
													<label class="control-label" for="parts-url"></label>
													<div class="controls">
														<button class="btn add-part"><i class="icon icon-plus"></i> Add Another Part</button>
													</div>
												</div>
										</section>
										<div class="form-actions">
											<button type="submit" class="btn btn-primary submit-parts">Save Parts</button>
										</div>
									</section>
								</fieldset>
							</form>

							<!-- Let's add the tools -->
							<form class="form form-horizontal contribute-form-tools" action="" method="post">
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
										<section class="tool" id="tools-1">
											<div class="control-group">
												<label class="control-label"></label>
												<div class="controls">
													<h4>Tool 1</h4>
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
													<input type="text" name="tools-url-1" id="tools-url" class="input-xlarge" value="">
												</div>
											</div>
										</section>
									</div>
									<section class="repeater-tools">
										<div class="control-group">
												<label class="control-label" for="tools-url"></label>
												<div class="controls">
													<button class="btn add-tools"><i class="icon icon-plus"></i> Add Another Tool</button>
												</div>
											</div>
									</section>
									<div class="form-actions">
										<button type="submit" class="btn btn-primary submit-tools">Save Tools</button>
									</div>
								</fieldset>
							</form>
						</article>

					<?php endwhile; else: endif; ?>

				<div>

			</div>

		</div>

	</div>

<?php get_footer(); ?>