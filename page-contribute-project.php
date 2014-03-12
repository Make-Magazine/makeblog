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
								<?php echo wp_nonce_field( 'contribute_post', 'contribute_post' ); ?>
								<fieldset>
									<div class="control-group">
										<div class="control-label"></div>
										<div class="controls">
											<div class="projects-masthead">
												<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
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
										<button type="submit" class="btn btn-warning">Want to add steps to the post?</button>
										<button type="submit" class="btn btn-primary submit-review">Submit for Review</button>
									</div>
								</fieldset>
							</form>

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
										<?php echo wp_nonce_field( 'contribute_steps', 'contribute_steps' ); ?>
										<?php echo wp_nonce_field( 'step-image', 'step-image' ); ?>
										<input type="hidden" name="total-steps" value="1">
										<input type="hidden" name="post_ID" value="80">
									</section>
									<section class="steps-wrapper">
										<div class="steps-list">
											<div class="step row">
												<div class="span12">
													<h4>Step 1</h4>
												</div>
												<div class="image-wrapper span3">
													<div class="fileinput fileinput-new" data-provides="fileinput">
														<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
														<div>
															<span class="btn btn-default btn-file">
																<span class="fileinput-new">Select image</span>
																<span class="fileinput-exists">Change</span>
																<input type="file" id="step-image" name="step-images-1">
															</span>
															<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
														</div>
													</div>
												</div>
												<div class="content-wrapper span9">
													<input type="text" class="title" name="step-title-1" placeholder="Enter your step title..." value="">
													<textarea name="step-lines-1" id="step_content"></textarea>
												</div>
											</div>
										</div>
										<script id="steps-template" type="text/template">
											<div class="step row">
												<div class="span12">
													<h4>Step ##count##</h4>
												</div>
												<div class="image-wrapper span3">
													<div class="fileinput fileinput-new" data-provides="fileinput">
														<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
														<div>
															<span class="btn btn-default btn-file">
																<span class="fileinput-new">Select image</span>
																<span class="fileinput-exists">Change</span>
																<input type="file" id="step-image" name="step-images-##count##">
															</span>
															<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
														</div>
													</div>
												</div>
												<div class="content-wrapper span9">
													<input type="text" class="title" name="step-title-##count##" placeholder="Enter your step title..." value="">
													<textarea name="step-lines-##count##" id="step_content"></textarea>
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
										<input type="hidden" name="post_ID" value="80">
									</section>
									<section class="parts-wrapper">
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
										<section class="repeater-tools">
											<div class="control-group">
													<label class="control-label" for="tools-url"></label>
													<div class="controls">
														<button class="btn add-part"><i class="icon icon-plus"></i> Add Another Tool</button>
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
										<input type="hidden" name="post_ID" value="80">
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