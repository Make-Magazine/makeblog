<?php get_header(); ?>
		
		<div class="clear"></div>

		<div class="sand">

			<div class="container">

				<div class="row">

					<div class="span8">

						<?php if (!is_home()) { ?>

							<ul class="breadcrumb">
			
								<?php if(class_exists('bcn_breadcrumb_trail')) {
									$breadcrumb_trail = new bcn_breadcrumb_trail;
									$breadcrumb_trail->opt['home_title'] = "Home";
									$breadcrumb_trail->opt['current_item_prefix'] = '<li class="current">';
									$breadcrumb_trail->opt['current_item_suffix'] = '</li>';
									$breadcrumb_trail->opt['separator'] = '<span class="divider">&nbsp;/&nbsp;</span>';
									$breadcrumb_trail->opt['home_prefix'] = '<li>';
									$breadcrumb_trail->opt['home_suffix'] = '</li>';
									$breadcrumb_trail->opt['max_title_length'] = 70;
									$breadcrumb_trail->fill();
									$breadcrumb_trail->display();
								} ?>
										
							</ul>

						<?php } ?>

						<div class="content">

							 <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			
								<article <?php post_class(); ?>>
		
								<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								
								<div class="entry-content">
								
								<style type="text/css">
									/*html,body { background-image:url('<?php echo $makers[0]->profileBackground->url; ?>'); }*/
									.author_meta { background-image:url('<?php echo $makers[0]->profileBackground->url; ?>'); }
									.inner_meta { margin:10px; background-color:#fff; }
									.gravatar { padding:10px;border:1px solid #efefef;margin:0 10px 10px 0; }
									.social { margin:0px 0px 10px; }
									.social li { display:inline; padding:0 0 1px; background-image: url('http://www.gravatar.com/images/grav-share-sprite.png'); background-repeat: no-repeat; }
									.sp { height:22px; width:16px; padding: 0 0 0 22px; line-height:16px; }
									.facebook { background-position: 0px 0px; }
									.twitter { background-position: 0px -464px; }
									.blogger { background-position: 0px -336px; }
									.foursquare { background-position: 0px -704px; }
									.flickr { background-position: 0px -400px; }
									.google { background-position: 0px -752px; }
									.linkedin { background-position: 0px -368px; }
									.tumblr { background-position: 0px -448px; }
									.vimeo { background-position: 0px -384px; }
									.wordpress { background-position: 0px -304px; }
									.youtube { background-position: 0px -208px; }
									.noborder { border:0px !important; }
									.clear { clear:both; }
									h3, h4, h5, h6 { line-height: 18px;margin-bottom: 10px; }
									.maker { margin-bottom:25px; }
									.links { margin:0; }
									.links li {	display:inline; margin-right:0px;}
									.links li:after { content:" // "; }
									.links li:last-child:after { content: ""; }
									.avatar { width:120px; float:left}
									.blurbish { width:468px; float:left;}
									.maker { width:598px; }
								</style>
									
								<?php 
									
									$authors = array('dalepd','garethb2','frauenfelder','phillip','snowgoli','khammondoreillycom','lauracochrane','seanmichaelragan','nerdyjb','makemattr','adfm','pushtheotherbutton','michaelcastor','nicknormal','jepstone','whyisjake');
									
									foreach ($authors as $author) {
										$url = 'http://en.gravatar.com/'.$author.'.json';
										$contents = wpcom_vip_file_get_contents( $url );

										if ( empty( $contents ) || is_wp_error( $contents ) )
											continue;
										
										$json_output = json_decode($contents);
										if ( !$json_output || !isset( $json_output->entry ) )
											continue;

											$makers = $json_output->entry;
								?>
												<div class="maker">
													<div class="avatar">
														<a class="noborder" href="http://blog.makezine.com/author/<?php if (isset($author)) {echo $author; } ?>">
															<img src="<?php echo $makers[0]->thumbnailUrl; ?>&s=100" class="gravatar" style="background-image:url('<?php echo $makers[0]->profileBackground->url; ?>');" alt="<?php if (isset($makers[0]->name->formatted)) {echo $makers[0]->name->formatted; } ?>" />
														</a>
													</div>

													<div class="blurbish">														
														<h3><a class="noborder" href="http://blog.makezine.com/author/<?php if (isset($author)) {echo $author; } ?>"><?php if (isset($makers[0]->displayName)) {echo $makers[0]->displayName; } ?></a></h3>
														<p><?php if (isset($makers[0]->aboutMe)) {echo $makers[0]->aboutMe; } ?></p>
														<?php if (isset($makers[0]->accounts)) { $accounts = $makers[0]->accounts;  ?>
															<ul class="social">
																<?php foreach ($accounts as $account) {
																	echo '<li class="'.$account->shortname.'"><a class="noborder" href="'.$account->url.'"><span class="sp">&nbsp;</span></a></li>';
																}
																?>
																<?php if (isset($makers[0]->emails[0]->value)) {echo '<a href="mailto:'.$makers[0]->emails[0]->value.'">'.$makers[0]->emails[0]->value.'</a>'; } ?>
															</ul>
														<?php } ?>
														<?php if (isset($makers[0]->urls)) { $urls = $makers[0]->urls;  ?>
															<ul class="links">
																<?php
																	foreach ($urls as $url) {
																		//echo '<img src="http://s.wordpress.com/mshots/v1/' . urlencode(clean_url($url->value)) . '?w=50" alt="'.$url->title.'" />';
																		echo '<li><a class="noborder" href="'.$url->value.'">'.$url->title.'</a></li>';
																	}
																?>
															</ul>
														<?php } ?>
													</div>

													<div class="clear"></div>
												</div>
										<?php }
									?>
								</div>
		
							</article>

							<?php endwhile; ?>

							<ul class="pager">
							
								<li class="previous"><?php previous_posts_link('&larr; Previous Page'); ?></li>
								<li class="next"><?php next_posts_link('Next Page &rarr;'); ?></li>
							
							</ul>
							<div class="comments">
								<?php comments_template(); ?>
							</div>
							<div id="contextly"></div>

							<?php if ( function_exists('make_shopify_featured_products_slider') ) {
		     					echo make_shopify_featured_products_slider( 'row-fluid' );
		    				} ?>
							
							<?php else: ?>
							
								<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
							
							<?php endif; ?>

						</div>

					</div>

					<?php get_sidebar(); ?>

			<?php get_footer(); ?>
