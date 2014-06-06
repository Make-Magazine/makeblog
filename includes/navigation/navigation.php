<?php
/**
 * Navigation!
 */

class Bootstrap_Walker_Nav_Menu extends Walker_Nav_Menu {

	// Used for children (IE. dropdowns)
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "\n$indent<div class=\"dropdown-wrapper container\"><div class=\"row-fluid\">\n";
	}

	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "\n$indent</div></div>\n";
	}

	// Layouts the individual elements and it's code.
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

		if ( empty( $args ) )
			return;

		$indent 		= ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$li_attributes  = '';
		$class_names 	= $value = '';

		$classes 		= empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] 		= ( isset( $args->has_children ) && $args->has_children ) ? 'dropdown' : '';
		$classes[] 		= ( $item->current || $item->current_item_ancestor ) ? 'active' : '';
		$classes[] 		= 'menu-item-' . $item->ID;

		$class_names 	= join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names 	= ' class="' . esc_attr( $class_names ) . '"';

		$id 			= apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id 			= strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

		$output 		.= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';

		$attributes  	=  ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
		$attributes 	.= ! empty( $item->target )    ? ' target="' . esc_attr( $item->target ) .'"' : '';
		$attributes 	.= ! empty( $item->xfn )       ? ' rel="'    . esc_attr( $item->xfn ) .'"' : '';
		$attributes 	.= ! empty( $item->url )       ? ' href="'   . esc_attr( $item->url ) .'"' : '';
		$attributes 	.= ( isset( $args->has_children ) && $args->has_children ) 	   ? ' class="dropdown-toggle"' : '';

		$item_output 	= ( isset( $args->before ) ) ? $args->before : '';
		$item_output 	.= '<a href="#" class="main-link-title">';
		$item_output 	.= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output    .= '<span class="sub-description">' . esc_html( $item->description ) . '</span>';
		$item_output	.= '</a>';
		$item_output 	.= ( isset( $args->after ) ) ? $args->after : '';

		$output 	    .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	// Loops through the data in the menu and displays the data
	function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {

		if ( ! $element )
			return;

		$id_field = $this->db_fields['id'];

		// Display this element
		if ( is_array( $args[0] ) ) {
			$args[0]['has_children'] = ! empty( $children_elements[ $element->$id_field ] );
		} else if ( is_object( $args[0] ) ) {
			$args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );
		}

		$cb_args = array_merge( array( &$output, $element, $depth ), $args);

		call_user_func_array( array( &$this, 'start_el' ), $cb_args );

		$id = $element->$id_field;

		// Display our mega dropdown only when the XFN field is filled in
		if ( ! empty( $element->xfn ) ) {

			$newlevel = true;

			// Start the child delimiter
			$cb_args = array_merge( array( &$output, $depth ), $args );

			// Append the relationship to our mega dropdowns. To simplify things, we'll repurpose the XFN feature
			// in menus and use that to create a relationship between a navigational item and a mega dropdown
			$cb_args[2]->parent = strtolower( sanitize_title_with_dashes( $element->xfn ) );

			call_user_func_array( array( &$this, 'start_lvl'), $cb_args );

			// Get the appropriate mega dropdown
			// We'll repurpose the XFN option in menus to create a relationship between a nav item and mega dropdown
			$this->fetch_mega_dropdown( $element->xfn, $output );
		}

		if ( isset( $newlevel ) && $newlevel ) {
			// End the child delimiter
			$cb_args = array_merge( array( &$output, $depth ), $args );

			call_user_func_array( array( &$this, 'end_lvl' ), $cb_args );
		}

		// End this element
		$cb_args = array_merge( array( &$output, $element, $depth ), $args );

		call_user_func_array( array( &$this, 'end_el' ), $cb_args );
	}


	/**
	 * Fetches the code for a specific mega dropdown.
	 * For now, we will be hardcoding this, but we'll need to automate this for managability
	 * @param  String $parent The name of the parent dropdown we need to fetch
	 * @param  String $output The HTML output of our mega dropdown. No need to return, this is handled by the walker
	 * @return String
	 *
	 * @since L-Ron
	 */
	function fetch_mega_dropdown( $parent, &$output ) {
		switch ( $parent ) {
			case 'build':
				$output .= $this->mdd_build();
				break;
			case 'explore':
				$output .= $this->mdd_explore();
				break;
			case 'connect':
				$output .= $this->mdd_connect();
				break;
			case 'shop':
				$output .= $this->mdd_shop();
				break;
		}
	}

	/**
	 * Here is the basic loop that we will use on the navigation bar.
	 */
	public function post_loop( $args ) {

		$the_query = new WP_Query( $args );

		$output = '';

		while ( $the_query->have_posts() ) : $the_query->the_post();
			$output .= '<article class="list-item-nav media ' . get_post_type() . '">';
			if ( $args['post_type'] == array( 'video' ) ) {
				$link = get_post_meta( get_the_id(), 'Link', true );
				$output .= wp_oembed_get( $link, array( 'width' => 293 ) );
			} else {
				$output .= '<a href="' . get_permalink() . '" class="pull-left">';
				$output .= get_the_post_thumbnail( get_the_id(), array( 80, 80 ), array( 'class' => 'media-object' ) );
				$output .= '</a>';
				$output .= '<div class="media-body"><h4 class="media-heading">';
				$output .= '<a href="' . get_permalink() . '">';
				$output .= get_the_title();
				$output .= '</a></h4></div>';
			}
			$output .= '</article>';
		endwhile;

		// Reset Post Data
		wp_reset_postdata();

		return $output;
	}

	/**
	 * Generate the list items for categories, given a slug.
	 *
	 * @uses get_category_link() Returns the correct url for a given Category ID.
	 * @uses wpcom_vip_get_term_by() Cached version of get_category_by_slug
	 */
	function make_category_li( $post_type = '' ) {
		global $catslugs;

		$output = null;

		if ( ! empty( $post_type ) && is_array( $post_type ) )
			$post_type = implode( ',', $post_type );

		foreach ( $catslugs as $slug ) {
			$category = wpcom_vip_get_term_by('name', $slug, 'category');
			if ( ! empty( $post_type ) ) {
				$output .= '<li><a href="' . get_category_link( $category->term_id ) . '?post_type=' . urlencode( $post_type ) . '" title="' . sprintf( __( 'View all posts in %s' ), esc_attr( $category->name ) ) . '">' . esc_html( $category->name ) .'</a></li>';
			} else {
				$output .= '<li><a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( 'View all posts in %s' ), esc_attr( $category->name ) ) . '">' . esc_html( $category->name ) .'</a></li>';
			}
		}
		return $output;
	}

	/**
	 * Top Posts
	 */
	public function top_posts() {
		// Let's grab the top stuff from Chartbeat.
		$url = 'http://api.chartbeat.com/live/toppages/v3/?apikey=09087a28e145e6da191c4ecccd60d8a4&host=makezine.com';
		$json = wpcom_vip_file_get_contents( $url );
		$posts = json_decode( $json );

		return $posts;

	}

	/**
	 * The HTML output of the build mega dropdown
	 * @return string
	 *
	 * @since L-Ron
	 */
	private function mdd_build() {
		$output = '<div class="featured-projects column span4">
			<h2 class="col-title">Featured Projects</h2>';

			// Let's add these loops one at a time.

			$args = array(
				'post_type' 		=> 'projects',
				'posts_per_page' 	=> 4,
				'post_status'		=> 'publish',
				);

			$output .= $this->post_loop( $args );

		// Projects Archive Home
		$output .= '<a href="' . home_url( '/projects/' ) . '" class="view-all-btn">View All &raquo;</a></div><div class="weekend-projects column span4"><h2 class="col-title">Weekend Projects</h2>';

		$args = array(
			'post_type' 		=> 'projects',
			'posts_per_page'	=> 4,
			'tax_query' 		=> array(
				array(
					'taxonomy'	=> 'flags',
					'field'		=> 'slug',
					'terms'		=> 'weekend-project'
					)
				)
			);

		$output .= $this->post_loop( $args );

		// Let's send the user off to Weekend Projects
		$output .= '<a href="' . home_url( '/weekendprojects/' ) . '" class="view-all-btn">View All &raquo;</a></div><div class="categories-getting-started column span4"><h2 class="col-title">Getting Started</h2>';

		$args = array(
			'post_type' 		=> 'projects',
			'posts_per_page'	=> 2,
			);

		$output .= $this->post_loop( $args );

		$output .= '<hr class="bottom-divider" /><h2 class="col-title">Categories</h2><ul class="nav nav-pills nav-stacked">';
		$output .= $this->make_category_li( 'projects' );
		$output .= '</ul></div>';

		return $output;
	}


	/**
	 * The HTML output of the explore mega dropdown
	 * @return string
	 *
	 * @since L-Ron
	 */
	private function mdd_explore() {
		$output = '<div class="featured-projects column span4"><h2 class="col-title">Trending on the Blog</h2>';

		$args = array(
			'posts_per_page'	=> 4,
			'no_found_rows'		=> true,
			'post_type'			=> array( 'post', 'review', ),
		);

		$output .= $this->post_loop( $args );

		$output .= '<a href="#" class="view-all-btn">View All &raquo;</a></div><div class="articles column span4"><h2 class="col-title">Articles</h2>';

		$args = array(
			'posts_per_page'	=> 4,
			'no_found_rows'		=> true,
			'post_type'			=> array( 'magazine' ),
		);

		$output .= $this->post_loop( $args );

		$output .= '<a href="#" class="view-all-btn">View All &raquo;</a></div><div class="categories column span4"><h2 class="col-title">Video</h2>';

		$args = array(
			'posts_per_page'	=> 1,
			'no_found_rows'		=> true,
			'post_type'			=> array( 'video' ),
		);

		$output .= $this->post_loop( $args );

		$output .= '<hr class="bottom-divider" /><h2 class="col-title">Categories</h2><ul class="nav nav-pills nav-stacked">';
		$output .= $this->make_category_li();
		$output .= '</ul></div>';

		return $output;
	}


	/**
	 * The HTML output of the connect mega dropdown
	 * @return string
	 *
	 * @since L-Ron
	 */
	private function mdd_connect() {
		$output = '<div class="maker-faire column span4">
			<h2 class="col-title">Maker Faire</h2>
			<ul class="list-item-nav">
				<li><a href="#">Find A Faire</a></li>
				<li><a href="#">Media</a></li>
				<li><a href="#">Learn More</a></li>
			</ul>

			<hr class="bottom-divider" />

			<h2 class="col-title">Latest Posts</h2>';

			$args = array(
				'tag_id' 			=> 785128,
				'posts_per_page'  	=> 3,
				'no_found_rows'		=> true,
			);

			$output .= $this->post_loop( $args );

		$output .= '<a href="' . home_url( '/tag/makerfaire' ) . '" class="view-all-btn">View All &raquo;</a></div>';
		$output .= '<div class="maker-camp column span4">
			<h2 class="col-title">Maker Camp</h2>
			<ul class="list-item-nav">
				<li><a href="http://makercamp.com/past-events/">Past Events</a></li>
				<li><a href="http://makercamp.com/participate/">Participate</a></li>
				<li><a href="http://makercamp.com/learn-more/">Learn More</a></li>
			</ul>

			<hr class="bottom-divider" />

			<h2 class="col-title">Highlights</h2>';

			$args = array(
				'tag'				=> 'maker-camp',
				'posts_per_page'	=> 3,
				'no_found_rows'		=> true,
			);

			$output .= $this->post_loop( $args );

		$output .= '<a href="' . home_url( '/tag/maker-camp/' ) . '" class="view-all-btn">View All &raquo;</a></div>';
		$output .= '<div class="categories column span4">
			<h2 class="col-title">Other Events/Community</h2>
			<ul class="nav nav-pills nav-stacked">
				<li><a href="#">MakerCon</a></li>
				<li><a href="#">Google+</a></li>
				<li><a href="#">Facebook</a></li>
				<li><a href="#">Twitter</a></li>
				<li><a href="#">MakerSpace</a></li>
			</ul>
			<div class="login-wrapper"><div></div>
		</div>';

		return $output;
	}


	/**
	 * The HTML output of the shop mega dropdown
	 * @return string
	 *
	 * @since L-Ron
	 */
	private function mdd_shop() {
		$output = '<div class="on-sale-products column span4">
			<h2 class="col-title">On Sale</h2>
			<article class="list-item-nav media">
				<a href="#" class="pull-left"><img src="http://placehold.it/80x80/0eafff/ffffff.png" class="media-object"></a>
				<div class="media-body">
					<h4 class="media-heading"><a href="#">Make: Electronics Book</a></h4>
					<p class="price"><span class="original-price">$34.99</span> $15.99</p>
					<a href="#" class="btn btn-primary add-to-cart">Add To Cart</a>
				</div>
			</article>
			<article class="list-item-nav media">
				<a href="#" class="pull-left"><img src="http://placehold.it/80x80/0eafff/ffffff.png" class="media-object"></a>
				<div class="media-body">
					<h4 class="media-heading"><a href="#">Make: Arduino Bots and Gadgets</a></h4>
					<p class="price"><span class="original-price">$34.99</span> $18.99</p>
					<a href="#" class="btn btn-primary add-to-cart">Add To Cart</a>
				</div>
			</article>
			<article class="list-item-nav media">
				<a href="#" class="pull-left"><img src="http://placehold.it/80x80/0eafff/ffffff.png" class="media-object"></a>
				<div class="media-body">
					<h4 class="media-heading"><a href="#">BrushBots</h4>
					<p class="price"><span class="original-price">$19.99</span> $14.99</a></p>
					<a href="#" class="btn btn-primary add-to-cart">Add To Cart</a>
				</div>
			</article>
			<article class="list-item-nav media">
				<a href="#" class="pull-left"><img src="http://placehold.it/80x80/0eafff/ffffff.png" class="media-object"></a>
				<div class="media-body">
					<h4 class="media-heading"><a href="#">Getting Started with Arduino, 2nd Edition</h4>
					<p class="price"><span class="original-price">$14.99</span> $7.99</a></p>
					<a href="#" class="btn btn-primary add-to-cart">Add To Cart</a>
				</div>
			</article>
			<a href="#" class="view-all-btn">View All &raquo;</a>
		</div>
		<div class="featured-products column span4">
			<h2 class="col-title">Featured Products</h2>
			<article class="list-item-nav media">
				<a href="#" class="pull-left"><img src="http://placehold.it/80x80/0eafff/ffffff.png" class="media-object"></a>
				<div class="media-body">
					<h4 class="media-heading"><a href="#">Getting Started with Arduino, 2nd Edition</h4>
					<p class="price"><span class="original-price">$14.99</span> $7.99</a></p>
					<a href="#" class="btn btn-primary add-to-cart">Add To Cart</a>
				</div>
			</article>
			<article class="list-item-nav media">
				<a href="#" class="pull-left"><img src="http://placehold.it/80x80/0eafff/ffffff.png" class="media-object"></a>
				<div class="media-body">
					<h4 class="media-heading"><a href="#">Getting Started with Arduino, 2nd Edition</h4>
					<p class="price"><span class="original-price">$14.99</span> $7.99</a></p>
					<a href="#" class="btn btn-primary add-to-cart">Add To Cart</a>
				</div>
			</article>
			<article class="list-item-nav media">
				<a href="#" class="pull-left"><img src="http://placehold.it/80x80/0eafff/ffffff.png" class="media-object"></a>
				<div class="media-body">
					<h4 class="media-heading"><a href="#">Getting Started with Arduino, 2nd Edition</h4>
					<p class="price"><span class="original-price">$14.99</span> $7.99</a></p>
					<a href="#" class="btn btn-primary add-to-cart">Add To Cart</a>
				</div>
			</article>
			<article class="list-item-nav media">
				<a href="#" class="pull-left"><img src="http://placehold.it/80x80/0eafff/ffffff.png" class="media-object"></a>
				<div class="media-body">
					<h4 class="media-heading"><a href="#">Getting Started with Arduino, 2nd Edition</h4>
					<p class="price"><span class="original-price">$14.99</span> $7.99</a></p>
					<a href="#" class="btn btn-primary add-to-cart">Add To Cart</a>
				</div>
			</article>
			<a href="#" class="view-all-btn">View All &raquo;</a>
		</div>
		<div class="new-products column span4">
			<h2 class="col-title">New Products</h2>';

			$output .= makershed_weekly_deal();

		$output .= '</div>
		<div class="email-signup span12">
			<p class="email-signup-body">Sign up for the Maker Shed newsletter to receive exclusive deals and discounts <input type="text" placeholder="me@mydomain.com" class="signup-form" /> <input type="submit" value="Sign Up" class="signup-btn btn btn-primary" /></p>
		</div>';

		return $output;
	}
}
