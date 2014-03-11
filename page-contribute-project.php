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
							<form class="form form-horizontal contribute-form-steps" method="post">
								<fieldset>
									<?php echo wp_nonce_field( 'contribute_steps', 'contribute_steps' ); ?>
									<section class="steps-wrapper"></section>
								</fieldset>
								<script id="steps-template" type="text/template">
									<div class="step row">
										<div class="image-wrapper span3">
											<input type="file" name="" value="<%= step_images %>" id="file" multiple>
										</div>
										<div class="content-wrapper span9">
											<input type="text" class="title" placeholder="Enter your step title..." value="<%= step_title %>">
											<textarea name="step_content" id="step_content"><%= step_content %></textarea>
										</div>
									</div>
								</script>
							</form>
							<form class="form form-horizontal contribute-form-parts" method="post">
								<fieldset>
									<?php echo wp_nonce_field( 'contribute_parts', 'contribute_parts' ); ?>
									<section class="parts-wrapper"></section>
								</fieldset>
							</form>
							<form class="form form-horizontal contribute-form-tools" method="post">
								<fieldset>
									<section class="control-group">
										<div class="control-label"></div>
										<div class="controls">
											<h1>Add Tools to the Project</h1>
										</div>
									</section>
									<section class="nonce">
										<?php echo wp_nonce_field( 'contribute_tools', 'contribute_tools' ); ?>
									</section>
									<section class="tools-wrapper" id="tool-1">
											<div class="control-group">
												<label class="control-label"></label>
												<div class="controls">
													<h4>Tool 1</h4>
													<input type="hidden" name="tool-number-1" value="1">
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
									<section class="repeater-tools">
										<div class="control-group">
												<label class="control-label" for="tools-url"></label>
												<div class="controls">
													<button class="btn add-part"><i class="icon icon-plus"></i> Add Another Tool</button>
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