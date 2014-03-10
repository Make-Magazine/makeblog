<?php

/**
 * While guest-authors is defiend by CoAuthors Plus, we need to integrate some extra info
 * To better cater to our custom user login interface.
 *
 * @since SPRINT_NAME
 */

/**
 * Add custom meta boxes to the edit screen of Guest Authors
 * @return void
 *
 * @since SPRINT_NAME
 */
function make_guest_author_meta_boxes() {
	add_meta_box( 'make_ga_custom_fieldds', 'Additional Info', 'make_guest_authors_custom_fields', 'guest-author', 'normal', 'low' );
}
add_action( 'add_meta_boxes', 'make_guest_author_meta_boxes' );


/**
 * Displays random, additional information for makers accounts
 * IE. Gigya ID, Last Logged in, Date Created on Gigya, etc etc
 * @param  object $guest_authors Post object
 * @return html
 *
 * @since SPRINT_NAME
 */
function make_guest_authors_custom_fields( $guest_author ) { 
	$guid = get_post_meta( absint( $guest_author->ID ), 'cap-guid', true );
	$last_login = get_post_meta( absint( $guest_author->ID ), 'cap-last_login', true );
	$created  = get_post_meta( absint( $guest_author->ID ), 'cap-created', true ); ?>
	<table class="form-table">
		<tbody>
			<tr>
				<th><label for="cap-guid">Gigya ID</label></th>
				<td><input type="text" name="cap-guid" value="<?php echo ( ! empty( $guid ) ) ? sanitize_text_field( $guid ) : ''; ?>" class="regular-text"></td>
			</tr>
			<tr>
				<th><label for="cap-last_login">Last Login</label></th>
				<td><input type="text" name="cap-last_login" value="<?php echo ( ! empty( $last_login ) ) ? sanitize_text_field( $last_login ) : ''; ?>" class="regular-text" disabled="disabled"></td>
			</tr>
			<tr>
				<th><label for="cap-created">Date Created (via Gigya)</label></th>
				<td><input type="text" name="cap-created" value="<?php echo ( ! empty( $created ) ) ? sanitize_text_field( $created ) : ''; ?>" class="regular-text" disabled="disabled"></td>
			</tr>
		</tbody>
	</table>
	<?php wp_nonce_field( 'save_guest_author_custom_fields', 'ga_custom_fields' );
}


/**
 * Save our custom Guest Author meta boxes
 * @param  integer $id           The post ID
 * @return void
 *
 * @since SPRINT_NAME
 */
function make_guest_authors_save( $id ) {

	// Make sure we are only saving Guest Authors
	if ( get_post_type() == 'guest-author' )
		return;

	if ( ! isset( $_POST['ga_custom_fields'] ) || ! wp_verify_nonce( $_POST['ga_custom_fields'], 'save_guest_author_custom_fields' ) )
		return;

	if ( isset( $_POST['cap-guid'] ) )
		update_post_meta( absint( $id ), 'cap-guid', sanitize_text_field( $_POST['cap-guid'] ) );

	// We never want to allow updating of last login and creation dates manually, only systematically.
}
add_action( 'save_post', 'make_guest_authors_save' );