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

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<div class="row">
			
				<div class="span12">
				
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
										<a class="button" id="browse_file">Add an Image</a>
									</div>
								</div>
								<div class="form-actions">
									<button type="submit" class="btn btn-warning">Want to add steps to the post?</button>
									<button type="submit" class="btn btn-primary submit-review">Submit for Review</button>
								</div>
								<section class="steps">
									here are the steps.
								</section>
								<section class="parts">
									Parts
								</section>
								<section class="tools">
									here are the steps.
								</section>
								<div class="form-actions">
									<button type="submit" class="btn btn-primary submit-review">Submit for Review</button>
								</div>
							</fieldset>
						</form>
					
					</article>
					
				<div>
				
			</div>
			
			<?php endwhile; else: endif; ?>
			
		</div>

	</div>

<?php get_footer(); ?>