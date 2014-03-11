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
									<section class="steps-wrapper">
										<div class="step row">
											<div class="image-wrapper span3">
												<ul>
													<li>
														<a class="button" id="browse_file">Add an Image</a>
													</li>
												</ul>
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
									<section class="parts-wrapper"></section>
								</fieldset>
							</form>
							<form lass="form form-horizontal contribute-form-tools" method="post">
								<fieldset>
									<section class="tools-wrapper"></section>
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