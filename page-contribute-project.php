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
							<form lass="form form-horizontal contribute-form-steps" method="post">
								<fieldset>
									<?php echo wp_nonce_field( 'contribute_steps', 'contribute_steps' ); ?>
									<section class="steps-wrapper">
										<div class="step row">
											<div class="image-wrapper span3">
												<input type="file" name="" value="" id="file" multiple>
											</div>
											<div class="content-wrapper span9">
												<input type="text" class="title" placeholder="Enter your step title..." value="">
												<?php wp_editor( 'Describe your step...', 'step_content', array( 'teeny' => true ) ); ?>
											</div>
										</div>
									</section>
								</fieldset>
							</form>
							<form lass="form form-horizontal contribute-form-parts" method="post">
								<fieldset>
									<?php echo wp_nonce_field( 'contribute_parts', 'contribute_parts' ); ?>
									<section class="parts-wrapper"></section>
								</fieldset>
							</form>
							<form lass="form form-horizontal contribute-form-tools" method="post">
								<fieldset>
									<?php echo wp_nonce_field( 'contribute_tools', 'contribute_tools' ); ?>
									<section class="tools-wrapper">
										<div class="tools-wrapper hide" id="tool-1" style="display: block;">
											<input type="hidden" name="tool-number-1" value="1">
											<div class="tool-title">
												<h3>Tool 1</h3>
											</div>
											<div class="control-group">
												<label class="control-label" for="tools-name">Name</label>
												<div class="controls">
													<input type="text" name="tools-name-1" id="tools-name" class="input-xlarge" value="">
												</div>
											</div>
											<div class="control-group">
												<label class="controls-label" for="tools-url">URL</label>
												<input type="text" name="tools-url-1" id="tools-url" class="input-xlarge" value="">
											</div>
										</div>
									</section>
									<div class="form-actions">
										<button type="submit" class="btn btn-primary submit-review">Submit for Review</button>
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