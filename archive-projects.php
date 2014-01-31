<?php
/**
 * Archive page template for projects custom post type.
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @since      SPRINT_NAME
 * 
 */
global $catslugs;
$type = ( isset( $_GET['post_type'] ) ) ? sanitize_title( $_GET['post_type'] ) : '';

if ($type == 'projects') {
	include_once 'archive-projects-category.php';
	return;
}

get_header(); ?>
		
<div class="container projects-home">
	<div class="row">
		<div class="span8">
			<h1 class="main-title">Projects</h1>
			

			<article class="top-featured-project" itemscope itemtype="http://schema.org/TechArticle">
				<figure class="featured-img">
					<img src="http://cl.ly/image/1U3L1v3s3w22/u66_normal.jpg" alt="" itemprop="thumbnailUrl">
				</figure>
				
				<div class="project-content">
					<header>
						<h2 class="project-section" itemprop="alternativeHeadline">Get Started</h2>
						<h3 class="project-title" itemprop="headline"><a href="#" itemprop="url">Learn the Basics of Arduino</a></h3>
					</header>
					<div itemprop="articleBody">
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud. Lorem ipsum dolor sit amet.</p>
					</div>
					<footer>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud. Lorem ipsum dolor sit amet.</p>
						<p><a href="#" itemprop="url">Learn more about Arduino</a></p>
					</footer>
				</div>
			</article>


			<article class="bottom-featured-project" itemscope itemtype="http://schema.org/TechArticle">
				<figure class="featured-img">
					<a href="#" itemprop="url"><img src="http://cl.ly/image/0I3B3J0S181O/u72_normal.jpg" alt="" itemprop="thumbnailUrl"></a>
				</figure>
				
				<div class="project-content">
					<header>
						<h2 class="project-section" itemprop="alternativeHeadline">Get Started</h2>
						<h3 class="project-title" itemprop="headline"><a href="#" itemprop="url">Learn the Basics of Arduino</a></h3>
					</header>
					<div itemprop="articleBody">
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud. Lorem ipsum dolor sit amet.</p>
					</div>
					<footer>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud. Lorem ipsum dolor sit amet.</p>
						<p><a href="#" itemprop="url">Learn more about Arduino</a></p>
					</footer>
				</div>
			</article>

			<section class="list-content">
				<ul class="nav nav-tabs sort-by">
					<li class="sort-title">Sort By:</li>
					<li class="active"><a href="#latest" data-toggle="tab">Latest</a></li>
					<li><a href="#easy" data-toggle="tab">Easy</a></li>
					<li><a href="#moderate" data-toggle="tab">Moderate</a></li>
					<li><a href="#difficult" data-toggle="tab">Difficult</a></li>
				</ul>
				
				<div class="tab-content project-wrapper">
					<div id="latest" class="tab-pane grid active"></div>
					<div id="easy" class="tab-pane"></div>
					<div id="moderate" class="tab-pane"></div>
					<div id="difficult" class="tab-pane"></div>
				</div>

				<script type="text/template" id="projectTemp">
					<article class="project" itemscope itemtype="http://schema.org/TechArticle">
						<figure class="project_img">
							<a href="<%= project_url %>" itemprop="url" title="<%= project_title %>"><img src="<%= project_img %>" alt="<%= project_title %>" itemprop="thumbnailUrl"></a>
						</figure>
						<header>
							<h2 class="project_title" itemprop="headline"><a href="<%= project_url %>" itemprop="url" title="<%= project_title %>"><%= project_title %></a></h2>
						</header>
					</article>
				</script>
			</section>
		</div>
		<div class="span4">
			<!-- Beginning Sync AdSlot 2 for Ad unit header ### size: [[300,250]]  -->
			<div id='div-gpt-ad-664089004995786621-2'>
				<script type='text/javascript'>googletag.cmd.push(function(){googletag.display('div-gpt-ad-664089004995786621-2')});</script>
			</div>
			<!-- End AdSlot 2 -->
		</div>
	</div>
</div>

<?php get_footer(); ?>