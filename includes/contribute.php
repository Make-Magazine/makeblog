<?php

add_action( 'wp_ajax_makeblog_page2form', 'makeblog_page2form' );
add_action( 'wp_ajax_nopriv_makeblog_page2form', 'makeblog_page2form' );

add_action( 'wp_ajax_makeblog_linksubform', 'makeblog_linksubform' );
add_action( 'wp_ajax_nopriv_makeblog_linksubform', 'makeblog_linksubform' );

add_action( 'wp_ajax_makeblog_articleform', 'makeblog_articleform' );
add_action( 'wp_ajax_nopriv_makeblog_articleform', 'makeblog_articleform' );

add_action( 'fu_after_upload', function( $attachment_ids ) {

	$reversed = array_reverse( $attachment_ids );
	$post_id = intval( $_POST['post_ID'] );

	foreach ($reversed as $index => $attach_id) {
		$meta_key = $index < count($reversed) ? 'attached_image_' . $index : 'attached_image';
		makeblog_update_post_meta( $post_id, $meta_key, $attach_id );
		makeblog_update_post_meta( $post_id, '_thumbnail_id', $attach_id );
	}

	wp_redirect( home_url( '/submission' ) );

	exit;

} );


function makeblog_update_post_meta( $post_id, $field_name, $value = '' ) {

	if ( empty( $value ) OR ! $value ) {

		delete_post_meta( $post_id, $field_name );

	} elseif ( ! get_post_meta( $post_id, $field_name ) ) {

		add_post_meta( $post_id, $field_name, $value );

	} else {

		update_post_meta( $post_id, $field_name, $value );

	}

}

function makeblog_page2form (){

	if( check_admin_referer('page2form_submit','page2form_subform') ){

		// Sanitize User Input
		$post_content = wp_filter_post_kses($_POST['page2_content']);
		$post_title = sanitize_text_field($_POST['page2_title']);
		$post_link = esc_url_raw($_POST['page2_link']);

		if( !is_user_logged_in() ) {

			$post_author = sanitize_text_field($_POST['page2_author']);
			$post_author_email = is_email( $_POST['page2_email'] ) !== false ? $_POST['page2_email'] : false;
			$post_author_website =  esc_url_raw($_POST['page2_website']);
			$post_author_bio =  wp_filter_post_kses($_POST['page2_bio']);
			$post_author_id = 604631; // id of page 2

		} else {

			$user = wp_get_current_user();
			$post_author = $user->display_name;
			$post_author_email = $user->user_email;
			$post_author_website = $user->user_url;
			$post_author_bio = get_the_author_meta( 'description', $user->ID);

		}

		$post = array(
			'post_content' => $post_content, //The full text of the post.
			'post_title' => $post_title, //The title of your post.
			'post_author' => $post_author_id,
			'post_status' => 'draft',
			'post_type' => 'page_2'
		);

		$make_post_id = wp_insert_post( $post );

		makeblog_update_post_meta( $make_post_id, 'author',  $post_author );
		makeblog_update_post_meta( $make_post_id, 'author_email',  $post_author_email );
		makeblog_update_post_meta( $make_post_id, 'author_website', $post_author_website );
		makeblog_update_post_meta( $make_post_id, 'author_bio',  $post_author_bio );
		makeblog_update_post_meta( $make_post_id, 'link', $post_link );

		echo $make_post_id;

		$email = array( 'jspurlock@makermedia.com','editor@makezine.com');

		$page2_title = "Page2 Submission: " . $post_title;

		$page2_content = '<html><body>';
		$page2_content .= '<p>A summary of the content in the form you just submitted to MAKE.</p>';
		$page2_content .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
		$page2_content .= "<tr style='background: #eee;'><td><strong>Page2 Submission</strong> </td><td></td></tr>";
		$page2_content .= "<tr><td><strong>Title:</strong> </td><td>" . $post_title . "</td></tr>";
		$page2_content .= "<tr><td><strong>Content:</strong> </td><td>" . $post_content . "</td></tr>";
		$page2_content .= "<tr><td><strong>URL:</strong> </td><td>" . $post_link . "</td></tr>";
		$page2_content .= "<tr><td><strong>Author Name:</strong> </td><td>" . $post_author . "</td></tr>";
		$page2_content .= "<tr><td><strong>Author Email:</strong> </td><td>" . $post_author_email . "</td></tr>";
		$page2_content .= "<tr><td><strong>Author Website:</strong> </td><td>" . $post_author_website . "</td></tr>";
		$page2_content .= "<tr><td><strong>Author Bio:</strong> </td><td>" . $post_author_bio . "</td></tr>";
		$page2_content .= "</table>";
		$page2_content .= "</body></html>";

		$headers = array( 'From: ' . $post_author .  ' <' . $post_author_email . '>'.  "\r\n" , 'Content-Type:text/html; charset=UTF-8' );

		wp_mail($email, $page2_title, $page2_content, $headers);

		if( $post_author_email !== false )
			wp_mail($post_author_email, $page2_title, $page2_content, $headers[1]);

	}

	exit;

}


function makeblog_linksubform () {

	if( check_admin_referer('linksubform_submit','linksubform_subform') ){

		$link_title = sanitize_text_field($_POST['linksub_title']);
		$link_content =  wp_filter_post_kses($_POST['linksub_content']);
		$link_link = esc_url_raw($_POST['linksub_link']);

		if( !is_user_logged_in() ) {

			$link_name = sanitize_text_field( $_POST['linksub_name'] );
			$link_email = is_email( $_POST['linksub_email'] ) !== false ? $_POST['linksub_email'] : false;
			$link_website =  esc_url_raw($_POST['linksub_website']);
			$link_bio =  wp_filter_post_kses($_POST['linksub_bio']);

		} else {

			$user = wp_get_current_user();
			$link_name = $user->display_name;
			$link_email = $user->user_email;
			$link_website = $user->user_url;
			$link_bio = get_the_author_meta( 'description', $user->ID);

		}

		$email = 'editor@makezine.com';

		$link_title = "User Link: " . $link_title;

		$link_email_content  = '<html><body>';
		$link_email_content .= '<p>A summary of the content in the form you just submitted to MAKE.</p>';
		$link_email_content .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
		$link_email_content .= "<tr style='background: #eee;'><td><strong>User Link Submission</strong></td><td></td></tr>";
		$link_email_content .= "<tr><td><strong>Title:</strong> </td><td>" . $link_title . "</td></tr>";
		$link_email_content .= "<tr><td><strong>Content:</strong> </td><td>" . $link_content . "</td></tr>";
		$link_email_content .= "<tr><td><strong>URL:</strong> </td><td>" . $link_link . "</td></tr>";
		$link_email_content .= "<tr><td><strong>Author Name:</strong> </td><td>" . $link_name . "</td></tr>";
		$link_email_content .= "<tr><td><strong>Author Email:</strong> </td><td>" . $link_email . "</td></tr>";
		$link_email_content .= "<tr><td><strong>Author Website:</strong> </td><td>" . $link_website . "</td></tr>";
		$link_email_content .= "<tr><td><strong>Author Bio:</strong> </td><td>" . $link_bio . "</td></tr>";
		$link_email_content .= "</table>";
		$link_email_content .= "</body></html>";

		$headers = array( 'From: Editorial Submissions <submissions@makermedia.com>'.  "\r\n" , 'Content-Type:text/html; charset=UTF-8' );

		wp_mail($email, $link_title, $link_email_content, $headers);

	}

	exit;

}

function makeblog_articleform (){

	if( check_admin_referer('articleform_submit','articleform_subform') ){

		$article_title  = wp_filter_post_kses($_POST['article_title']);
		$article_mail  = sanitize_text_field($_POST['article_mail']);
		$article_city  = sanitize_text_field($_POST['article_city']);
		$article_state  = sanitize_text_field($_POST['article_state']);
		$article_zip = sanitize_text_field($_POST['article_zip']);
		$article_country  = sanitize_text_field($_POST['article_country']);
		$article_phone  = sanitize_text_field($_POST['article_phone']);
		$article_pitch  = sanitize_text_field($_POST['article_pitch']);
		$article_built  = sanitize_text_field($_POST['article_built']);
		$article_photo  = sanitize_text_field($_POST['article_photo']);
		$article_photo_url  = sanitize_text_field($_POST['article_photo_url']);
		$article_working  = sanitize_text_field($_POST['article_working']);
		$article_video_url  = esc_url_raw($_POST['article_video_url']);
		$article_writeup_url  = esc_url_raw($_POST['article_writeup_url']) ;
		$article_description  = wp_filter_post_kses($_POST['article_description']);
		$article_wordcount  = sanitize_text_field($_POST['article_wordcount']);


		if( !is_user_logged_in() ) {

			$article_name  = sanitize_text_field($_POST['article_name']);
			$article_email = is_email( $_POST['article_email'] ) !== false ? $_POST['article_email'] : false;
			$article_website =  esc_url_raw($_POST['article_website']);
			$article_bio  = wp_filter_post_kses($_POST['article_bio']);

		} else {

			$user = wp_get_current_user();
			$article_name = $user->display_name;
			$article_email = $user->user_email;
			$article_website = $user->user_url;
			$article_bio = get_the_author_meta( 'description', $user->ID);

		}

		$email = 'editor@makezine.com';

		$article_title = 'Article/Project: ' . $article_title;

		$article_content = '<html><body>';
		$article_content .= '<p>A summary of the content in the form you just submitted to MAKE.</p>';
		$article_content .= '<table rules="all" style="border-color: #666;border:1px solid;" cellpadding="10">';
		$article_content .= "<tr style='background: #eee;'><td><strong>User Article Submission</strong> </td><td></td></tr>";
		$article_content .= "<tr><td><strong>Article Title:</strong> </td><td>" . $article_title . "</td></tr>";
		$article_content .= "<tr><td><strong>Name:</strong> </td><td>" . $article_name. "</td></tr>";
		$article_content .= "<tr><td><strong>Email:</strong> </td><td>" . $article_email . "</td></tr>";
		$article_content .= "<tr><td><strong>Mailing Address:</strong> </td><td>" . $article_mail . "</td></tr>";
		$article_content .= "<tr><td><strong>City:</strong> </td><td>" . $article_city . "</td></tr>";
		$article_content .= "<tr><td><strong>State:</strong> </td><td>" . $article_state . "</td></tr>";
		$article_content .= "<tr><td><strong>Zip:</strong> </td><td>" . $article_zip . "</td></tr>";
		$article_content .= "<tr><td><strong>Country:</strong> </td><td>" . $article_country. "</td></tr>";
		$article_content .= "<tr><td><strong>Phone:</strong> </td><td>" . $article_phone . "</td></tr>";
		$article_content .= "<tr><td><strong>Bio:</strong> </td><td>" . $article_bio . "</td></tr>";
		$article_content .= "<tr><td><strong>Website:</strong> </td><td>" . $article_website . "</td></tr>";
		$article_content .= "<tr><td><strong>Article Pitch:</strong> </td><td>" . $article_pitch . "</td></tr>";
		$article_content .= "<tr><td><strong>Project Built?:</strong> </td><td>" . $article_built . "</td></tr>";
		$article_content .= "<tr><td><strong>Project Photos?:</strong> </td><td>" . $article_photo . "</td></tr>";
		$article_content .= "<tr><td><strong>Project Photo URL:</strong> </td><td>" . $article_photo_url . "</td></tr>";
		$article_content .= "<tr><td><strong>Video of Project Working?:</strong> </td><td>" . $article_working . "</td></tr>";
		$article_content .= "<tr><td><strong>Video URL:</strong> </td><td>" . $article_video_url . "</td></tr>";
		$article_content .= "<tr><td><strong>Write-up URL:</strong> </td><td>" . $article_writeup_url. "</td></tr>";
		$article_content .= "<tr><td><strong>Article Description:</strong> </td><td>" . $article_description . "</td></tr>";
		$article_content .= "<tr><td><strong>Word Count:</strong> </td><td>" . $article_wordcount . "</td></tr>";
		$article_content .= "</table>";
		$article_content .= "</body></html>";
		$article_content = stripslashes($article_content);

		$headers = array( 'From: Editorial Submissions <submissions@makermedia.com>' .  "\r\n" , 'Content-Type:text/html; charset=UTF-8' );

		wp_mail($email, $article_title, $article_content, $headers);

	}

	exit;

}

?>
