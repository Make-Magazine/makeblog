<?php

function go_init() {
	register_post_type( 'go', array(
		'hierarchical'        => false,
		'public'              => true,
		'show_in_nav_menus'   => true,
		'show_ui'             => true,
		'supports'            => array( 'title' ),
		'has_archive'         => true,
		'query_var'           => true,
		'rewrite'             => true,
		'menu_position' 	  => 45,
		'publicly_queryable'  => true,
		'exclude_from_search' => true,
		'labels'              => array(
			'name'                => __( 'Go Links', 'make' ),
			'singular_name'       => __( 'Go Link', 'make' ),
			'add_new'             => __( 'Add new go link', 'make' ),
			'all_items'           => __( 'Go Links', 'make' ),
			'add_new_item'        => __( 'Add new go link', 'make' ),
			'edit_item'           => __( 'Edit go link', 'make' ),
			'new_item'            => __( 'New go link', 'make' ),
			'view_item'           => __( 'View go links', 'make' ),
			'search_items'        => __( 'Search go links', 'make' ),
			'not_found'           => __( 'No go links found', 'make' ),
			'not_found_in_trash'  => __( 'No go links found in trash', 'make' ),
			'parent_item_colon'   => __( 'Parent go link', 'make' ),
			'menu_name'           => __( 'Go Links', 'make' ),
		),
	) );

}
add_action( 'init', 'go_init' );

function go_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['go'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __('Go updated. <a target="_blank" href="%s">View go</a>', 'make'), esc_url( $permalink ) ),
		2 => __('Custom field updated.', 'make'),
		3 => __('Custom field deleted.', 'make'),
		4 => __('Go updated.', 'make'),
		/* translators: %s: date and time of the revision */
		5 => isset($_GET['revision']) ? sprintf( __('Go restored to revision from %s', 'make'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Go published. <a href="%s">View go</a>', 'make'), esc_url( $permalink ) ),
		7 => __('Go saved.', 'make'),
		8 => sprintf( __('Go submitted. <a target="_blank" href="%s">Preview go</a>', 'make'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		9 => sprintf( __('Go scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview go</a>', 'make'),
		// translators: Publish box date format, see http://php.net/date
		date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		10 => sprintf( __('Go draft updated. <a target="_blank" href="%s">Preview go</a>', 'make'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'go_updated_messages' );

$field_data = array (
	'advanced_testgroup' => array (
		'fields' => array(
			'url'				=> array(),
			'bitly_url'			=> array(),

	),
	'title'		=> 'URL',
	'context'	=> 'advanced',
	'pages'		=> array( 'go' ),
	),
);

$easy_cf = new Easy_CF($field_data);

function make_go_cpt_columns($columns) {

	$new_columns = array(
		'url' 		=> __('URL'),
		'bitly_url' => __('Bit.ly Url'),
		'slug' 		=> __('Slug'),
	);
    return array_merge($columns, $new_columns);
}
add_filter('manage_go_posts_columns' , 'make_go_cpt_columns');

add_action( 'manage_posts_custom_column' , 'make_go_custom_columns', 10, 2 );

function make_go_custom_columns( $column, $post_id ) {
	switch ( $column ) {
	case 'url' :
		echo get_post_meta( $post_id, 'url', true );
		break;
	case 'bitly_url' :
		echo get_post_meta( $post_id , 'bitly_url' , true ); 
		break;
	case 'slug' :
		echo basename( get_permalink() );
		break;
    }
}
function add_go_search_page() {
	add_submenu_page( 'edit.php?post_type=go', 'Go Link Search', 'Go Link Search', 'delete_others_pages', 'go_search', 'mf_go_search' );
}

add_action( 'admin_menu', 'add_go_search_page' );

function mf_go_search() {

	$slug = ( isset( $_GET['slug'] ) ) ? sanitize_text_field( $_GET['slug'] ) : '';
	$url = ( isset( $_GET['url'] ) ) ? sanitize_text_field( $_GET['url'] ) : '';

	//must check that the user has the required capability 
	if ( ! current_user_can( 'delete_others_pages' ) )
		wp_die( __( 'You do not have sufficient permissions to access this page.', 'make' ) );
?>
	<div class="wrap">
		<h1>Go Links Search</h1>

		<?php
		$args = array(
			'name' 			=> $slug,
			'post_type' 	=> 'go',
			'post_status' 	=> 'publish',
			'meta_value'	=> $url,
		);
		$posts = new wp_query( $args );
		?>
		<div class="tablenav top">
			<form id="posts-filter" method="get">
				<input type="hidden" name="post_type" value="go">
				<input type="hidden" name="page" value="go_search">
				<?php wp_nonce_field( 'blog-dashboard-screen-save', 'make-go-search', false ); ?>
				<label>Slug<input type="slug" id="post-search-input" name="slug" value="<?php echo ( isset( $slug ) ) ? esc_attr( $slug ) : ''; ?>"></label>
				<label>URL<input type="url" id="post-url-input" name="url" value="<?php echo ( isset( $url ) ) ? esc_attr( $url ) : ''; ?>"></label>
				<input type="submit" name="" id="search-submit" class="button" value="Search All Content">
			</form>
		</div>
		<table id="go-search" class="table wp-list-table widefat fixed posts">
			<thead>
				<tr>
					<th>Title</th>
					<th>Go URL</th>
					<th>Source URL</th>
					<th>Shortened URL</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th>Title</th>
					<th>Go URL</th>
					<th>Source URL</th>
					<th>Shortened URL</th>
				</tr>
			</tfoot>
			<tbody id="the-list">
				<?php while ( $posts->have_posts() ) : $posts->the_post(); ?>
					<tr>
						<td><?php edit_post_link( get_the_title() ); ?></td>
						<td><?php the_permalink(); ?></td>
						<td><?php echo ( get_post_meta( get_the_ID(), 'url', true ) ) ? esc_url( get_post_meta( get_the_ID(), 'url', true ) ) : ''; ?></td>
						<td><?php echo ( get_post_meta( get_the_ID(), 'bitly_url', true ) ) ? esc_url( get_post_meta( get_the_ID(), 'bitly_url', true ) ) : ''; ?></td>
					</tr>
				<?php endwhile; ?>
			</tbody>
		</table>
	</div>
<?php }