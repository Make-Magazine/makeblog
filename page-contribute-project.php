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

							<form class="form form-horizontal" method="post">
								<?php echo wp_nonce_field( 'contribute_post' ); ?>
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
											<input type="text" class="input-xlarge" id="post_title">
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
										<label class="control-label" for="post_featured_image">Add an Image</label>
										<div class="controls">
											<input class="input-file" id="post_featured_image" type="file">
										</div>
									</div>
									<div class="form-actions">
										<button type="submit" class="btn btn-warning">Want to add steps to the post?</button>
										<button type="submit" class="btn btn-primary submit-review">Submit for Review</button>
									</div>
									<section class="steps">
										
									</section>
									<section class="parts"></section>
									<section class="tools"></section>
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