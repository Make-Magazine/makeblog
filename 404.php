<?php
/**
 * Single Page Template
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Jake Spurlock <jspurlock@makermedia.com>
 * 
 */
get_header(); ?>
		
	<div class="single">
	
		<div class="container">

			<div class="row">

				<div class="span12">
					
					<div class="projects-masthead">
						
						<div class="row">
							
							<div class="span8">
								
								<h1 class="404">Oh Nooo! A 404 Page!</h1>
								
								<p>Looks like we can't find the page that you are looking for. Sorry about that.</p>
								
								<p>Let's see if we can make it up to you. First off, let's try searching for the content. You can do that in the search form below.</p>
								
								<form action="<?php echo home_url(); ?>" class="search-make open">
									<div class="input-append">
										<input type="text" class="search-field" name="s">
										<button type="submit" class="btn btn-primary" value="Search"><i class="icon icon-search icon-white"></i> Search</button>
									</div>
								</form>
								
								<p>If that doesn't work, why not try browsing from popular categories?</p>
								
								<ul class="columns">
									<?php wp_list_categories( 'title_li=' ); ?>	
								</ul>
								
								
							</div>
							
							<?php get_sidebar(); ?>
							
						</div>						
						
					</div>
					
				</div>
					
			</div>

		</div>

	</div>

<?php get_footer(); ?>