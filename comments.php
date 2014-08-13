<?php
/**
 * @package MakeZine
*/
?>


<!-- don't display comments on protected posts -->
<div id="comments" class="">
	<?php if ( post_password_required() ) : ?>
		<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view and post comments.' , 'makezine' ); ?></p>
	</div>
	<?php
		return;
	endif; ?>
	
	<h3 id="comments-title"><?php printf( _n( 'One Response to %2$s', '%1$s Responses to %2$s', get_comments_number(), 'makezine' ), number_format_i18n( get_comments_number() ), '<em>' . get_the_title() . '</em>' ); ?></h3>
	
	<?php comment_form(); ?>

	<?php if ( have_comments() ) : ?>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'makezine' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'makezine' ) ); ?></div>
			</div> <!-- .navigation -->
		<?php endif; ?>
		
		<ol class="commentlist">
			<?php
				/* Loop through and list the comments. Tell wp_list_comments()
				 * to use make_comments() to format the comments.
				 * If you want to overload this in a child theme then you can
				 * define make_comments() and that will be used instead.
				 * See makezine_comment() in makezine/functions.php for more.
				 */
				wp_list_comments( array( 'callback' => 'make_comments' ) );
			?>
		</ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'makezine' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'makezine' ) ); ?></div>
			</div><!-- .navigation -->
		<?php } elseif ( ! comments_open() )  { ?>
			<p class="nocomments"><?php _e( 'Comments are closed.', 'makezine' ); ?></p>
		<?php } 
	endif; ?>

</div><!-- #comments -->
