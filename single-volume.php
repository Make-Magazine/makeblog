<?php
/*
 * Template name: Volume Page
 */
  get_header(); ?>
    <div class="single">
      <div class="container">
         <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
           <?php
            $video = get_post_custom_values('VideoURL');
            if ($video[0]) { ?>
              <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
              <div class="row">
                <div class="span8">
                  <div class="row">
                    <?php
                      $video = get_post_custom_values('VideoURL');
                      if ($video[0]) {
                        echo '<div class="span12">';
                          echo make_youtube_iframe($video[0], 620, 345);
                        echo '</div>';
                      }
                    ?>
                  </div>
                  <div class="row">
                    <hr>
                    <?php
                      $featuredposts = get_post_custom_values('FeaturedPosts');
                      $posts = array_map( 'get_post', explode( ',', $featuredposts[0] ) );
                      foreach ( $posts as $post ) {
                        //print_r($post); ?>
                        <div class="span2">
                          <a href="<?php echo get_permalink($post->ID); ?>">
                            <?php echo get_the_post_thumbnail( $post->ID, 'new-thumb', array('class' => 'hide-thumbnail' ) ); ?>
                            <?php echo get_the_title( $post->ID ); ?>
                          </a>
                        </div>
                      <?php }
                      wp_reset_query(); ?>
                  </div>
                </div>
                <div class="span4">
                  <?php the_content(); ?>
                </div>
              </div>
            <?php } else { ?>
              <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
              <div class="row-fluid">
                <div class="span8">
                  <?php the_content(); ?>
                </div>
                <div class="span4">
                  <div class="banner">
                    <?php
                      $featuredposts = get_post_custom_values('FeaturedPosts');
                      if ($featuredposts[0]) {
                        $posts = array_map( 'get_post', explode( ',', $featuredposts[0] ) );
                        foreach ( $posts as $post ) {
                          //print_r($post); ?>
                            <a href="<?php echo get_permalink($post->ID); ?>">
                              <?php echo get_the_post_thumbnail( $post->ID, 'side-thumb', array('class' => 'thumbnail' ) ); ?>
                              <?php echo get_the_title( $post->ID ); ?>
                            </a>
                        <?php }
                        wp_reset_query();
                      }
                    ?>
                  </div>
                </div>
              </div>
          <?php } ?>
        <div class="row">
          <div class="span8">
              <article <?php post_class(); ?>>
                <?php
                  $categories = get_post_custom_values( 'Categories' );
                  if ( !empty($categories[0]) ) {
                    $blurb = get_post_custom_values( 'PostsBlurb' );
                    echo make_magazine_toc('post', $blurb[0], $categories[0], 0, 4, 'date', 'dsc' );
                  }
                  $parent = $post->ID;
                ?>
                <div class="tabbable">
                  <ul class="nav nav-tabs">
                    <li class=""><a href="#errata" data-toggle="tab">Before You Start</a></li>
                    <li class="active"><a href="#projects" data-toggle="tab">Projects</a></li>
                    <li class=""><a href="#reviews" data-toggle="tab">Reviews</a></li>
                    <li class=""><a href="#articles" data-toggle="tab">Articles</a></li>
                  </ul>
                  <div class="tab-content">
                    <div class="tab-pane active" id="projects">
                      <?php $args = array(
                        'post_type'      => 'projects',
                        'title'        => 'Projects',
                        'post_parent'    => $parent,
                        'order'        => 'asc',
                        );
                      echo make_magazine_toc($args); ?>
                    </div>
                    <div class="tab-pane" id="errata">
                      <?php $args = array(
                        'post_type'      => 'errata',
                        'title'        => 'Before You Start',
                        'post_parent'    => $parent,
                        'order'        => 'asc',
                      );
                      echo make_magazine_toc( $args ); ?>
                    </div>
                    <div class="tab-pane" id="reviews">
                      <?php $args = array(
                        'post_type'     => 'review',
                        'title'         => 'Reviews',
                        'post_parent'    => $parent,
                        'order'       => 'asc',
                        );
                      echo make_magazine_toc( $args ); ?>
                    </div>
                    <div class="tab-pane" id="articles">
                      <?php $args = array(
                        'post_type'     => 'magazine',
                        'title'         => 'Articles',
                        'post_parent'    => $parent,
                        'order'       => 'asc',
                        );
                      echo make_magazine_toc( $args ); ?>
                    </div>
                  </div>
                </div>
                <div class="clear"></div>
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
              <?php if (function_exists('make_printer_makershed_thing')) { echo make_printer_makershed_thing(); } ?>
              <?php else: ?>
                <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
              <?php endif; ?>
          </div>
          <?php get_sidebar(); ?>
        </div>
      <?php get_footer(); ?>