<?php

	/**
	 * Register our Steps Manager with the projects custom post type
	 * @return void
	 *
	 * @version 1.0
	 */
	function make_magazine_projects_add_step_manager() {
		add_meta_box( 'make_magazine_projects_step_manager', 'Steps Manager', 'make_magazine_projects_step_manager_mb', 'projects', 'normal', 'high' );
		add_meta_box( 'make_magazine_parts_step_manager', 'Parts Manager', 'make_magazine_parts_step_manager_mb', 'projects', 'normal', 'high' );
		add_meta_box( 'make_magazine_tools_step_manager', 'Tools Manager', 'make_magazine_tools_step_manager_mb', 'projects', 'normal', 'high' );
	}
	add_action('add_meta_boxes', 'make_magazine_projects_add_step_manager');


	/**
	 * Load our custom styles for the Projects Manager ONLY in the projects CPT.
	 * @return void
	 *
	 * @version 1.0
	 */
	function make_magazine_projects_add_styles() {
		if( is_admin() && ( 'projects' == get_post_type() ) ) {
			wp_enqueue_style( 'make-projects-custom-styles', get_stylesheet_directory_uri() . '/css/projects-manager.css' );
		}
	}
	add_action('admin_print_styles', 'make_magazine_projects_add_styles');


	/**
	 * Load our custom scripts for the Projects Manager ONLY in the project CPT.
	 * @return void
	 *
	 * @version 1.0
	 */
	function make_magazine_projects_add_scripts( $hook ) {
		if(is_admin() && ('projects' == get_post_type())) {
			wp_enqueue_media();
			wp_enqueue_script( 'make-projects-custom-js', get_stylesheet_directory_uri() . '/js/projects-manager.js', array('jquery' ), '1.0' );
			wp_enqueue_script( 'make-parts-custom-js', get_stylesheet_directory_uri() . '/js/parts-manager.js', array( 'jquery' ), '1.0' );
			wp_enqueue_script( 'make-tools-custom-js', get_stylesheet_directory_uri() . '/js/tools-manager.js', array( 'jquery' ), '1.0' );
			wp_localize_script( 'make-projects-custom-js', 'make_projects_js', array(
				'stylesheet_uri' => get_stylesheet_directory_uri(),
			) );

			if ( $hook == 'post.php' ) {
				wp_enqueue_script( 'make-project-savepost', get_stylesheet_directory_uri() . '/js/project-savepost.js', array( 'jquery' ), '1.0' );
			}
		}
	}
	add_action('admin_enqueue_scripts', 'make_magazine_projects_add_scripts');


	/**
	 * Due to a requirement on how Parts are saved, they are not accurately returned in the correct order on production.
	 * We need to sort based on the order field saved with each part.
	 * To do this, we'll use usort to pass a user defiend comparison chart to sort based on the order field.
	 * This function is built to be used by any multidimensional array
	 * @param  array  REQUIRED $array 	  	The array of steps, parts or tools to sort by.
	 * @param  string REQUIRED $sort_field 	The field in the array you wish to sort by. TODO: Make this happen.
	 * @return array
	 *
	 * @version  1.1
	 * @since    GLaDOS
	 */
	function make_projects_sort( $array ) {

		// Unserialize our Parts here as each array is serialized while the parent isn't.
		if ( is_array( $array ) ) {
			foreach( $array as $item ) {
				// Test if we are passing a serialized string.
				if ( is_serialized( $item ) ) {
					$sorted[] = unserialize( $item );
				} else {
					$sorted[] = $item;
				}
			}
			usort( $sorted, 'make_projects_array_sort' );
		}

		// Return our results
		return $sorted;
	}


	/**
	 * The function that is used in usort() found in make_projects_sort()
	 * @return array
	 *
	 * @version 1.1
	 * @since  GLaDOS
	 */
	function make_projects_array_sort( $a, $b ) {

		// Let's make sure we have some data to sort.
		if ( ! isset( $a['order'] ) || ! isset( $b['order'] ) )
			return;

		if ( $a['order'] == $b['order'] )
			return 0;

		return ( $a['order'] < $b['order'] ) ? -1 : 1;
	}


	/**
	 * Return all the data for our current project.
	 * @param  String $key Accepts the name of another field saved in the post meta table.
	 * @return Object
	 *
	 * @version 1.0
	 */
	function make_magazine_get_project_data( $key ) {
		$data = get_post_custom_values( $key );

		if ( $key == 'Steps' || $key == 'Tools' )
			$data = unserialize( $data[0] );

		return $data;
	}


	/**
	 * The main function that displays all the magic and unicorns one will need to manage their projects.
	 * @return HTML
	 *
	 * @version 2.0
	 */
	function make_magazine_projects_step_manager_mb() {
		global $post;

		// Load our Projects steps
		$steps = make_magazine_get_project_data( 'Steps' );
		wp_nonce_field( 'make-mag-projects-metabox-nonce', 'meta_box_nonce' ); ?>
		<div class="step steps-step sortable group">
			<input type="button" value="Add A Step" class="button add-step alignright" />
			<div class="steps-template step-wrapper">
				<input type="hidden" name="step-number-0" value="0">
				<div class="step-title">
					<h3>Step 0</h3>
					<div class="remove-step"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-remove.png"></div>
				</div>
				<div class="step-contents group">
					<div id="image-list" class="alignleft">
						<div class="image-upload group">
							<img src="http://placehold.it/94x94" alt="" class="alignleft steps-image" title="Upload an Image" width="94" height="94" />
							<input type="hidden" name="step-images-0[]" class="image-url" value="">
						</div><!--[END .image-upload]-->
						<div class="image-upload group">
							<img src="http://placehold.it/94x94" alt="" class="alignleft steps-image" title="Upload an Image" width="94" height="94" />
							<input type="hidden" name="step-images-0[]" class="image-url" value="">
						</div><!--[END .image-upload]-->
						<div class="image-upload group">
							<img src="http://placehold.it/94x94" alt="" class="alignleft steps-image" title="Upload an Image" width="94" height="94" />
							<input type="hidden" name="step-images-0[]" class="image-url" value="">
						</div><!--[END .image-upload]-->
					</div><!--[END #image-list]-->
					<div id="list" class="alignleft">
						<input type="text" name="step-title-0" id="project-header" class="widefat" placeholder="Description" value="">
						<ul id="sub-lists" class="sortable group reset-list">
							<li class="list-template">
								<textarea name="step-lines-0[]" id="line-0" rows="5"></textarea>
								<!--<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-sort.png" class="project-button sort-list" />-->
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-minus.png" class="project-button remove">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-add.png" class="project-button add">
							</li>
						</ul>
					</div><!--[END #list]-->
				</div><!--[END .step-contents]-->
			</div><!--[END .steps-template]-->
			<?php $step_num = 1; ?>
			<?php if ( isset( $steps ) && is_array( $steps ) ) : ?>
				<?php foreach( $steps as $step ) : ?>
					<div id="step-<?php echo $step_num; ?>" class="step-wrapper">
						<input type="hidden" name="step-number-<?php echo $step_num; ?>" value="<?php echo ( ! empty( $step->number ) ) ? $step->number : $step_num; ?>">
						<div class="step-title">
							<h3>Step <?php echo $step_num; ?></h3>
							<div class="remove-step"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-remove.png"></div>
						</div>
						<div class="step-contents group">
							<div id="image-list" class="alignleft">
								<?php // loop through our images array 3 times, checking if images exist. If not, add placeholders.
									for ( $i = 0; $i < 3; $i++ ) :
										if ( isset( $step->images[ $i ] ) && ! empty( $step->images[ $i ]->text ) ) { ?>
											<div class="image-upload group has-image">
												<img src="<?php echo wpcom_vip_get_resized_remote_image_url( make_projects_to_s3( $step->images[ $i ]->text ), 94, 94 ) ; ?>" alt="" class="alignleft steps-image" width="94" height="94" />
												<input type="hidden" name="step-images-<?php echo $step_num; ?>[]" class="image-url" value="<?php echo esc_url( $step->images[ $i ]->text ); ?>">
											</div><!--[END .image-upload]-->
										<?php } else { ?>
											<div class="image-upload group">
												<img src="http://placehold.it/94x94" alt="" class="alignleft steps-image" title="Upload an Image" width="94" height="94" />
												<input type="hidden" name="step-images-<?php echo $step_num; ?>[]" class="image-url" value="">
											</div><!--[END .image-upload]-->
										<?php }
									endfor;
								?>
							</div><!--[END #image-list]-->
							<div id="list" class="alignleft">
								<input type="text" name="step-title-<?php echo $step_num; ?>" id="project-header" class="widefat" placeholder="Add A Title" value="<?php echo ( ! empty( $step->title ) ) ?  wp_kses_post( stripslashes( $step->title ) ) : ''; ?>">
								<ul id="sub-lists" class="sortable reset-list">
									<?php if ( isset( $step->lines ) ) : ?>
										<?php
											$total = count( $step->lines ); // Count the number of sub-steps
											$i = 1; // Used to set the right ID's and to check against
											foreach ( $step->lines as $key ) : ?>
											<li>
												<textarea name="step-lines-<?php echo $step_num; ?>[]" id="line-<?php echo $i; ?>" rows="5"><?php echo stripslashes( wp_filter_post_kses( $key->text ) ); ?></textarea>
												<!--<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-sort.png" class="project-button sort-list" />-->
												<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-minus.png" class="project-button remove">
												<?php if ( $i === $total ) : // Display our add button only on the last step on load. ?>
													<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-add.png" class="project-button add">
												<?php endif;
												$i++; ?>
											</li>
											<?php endforeach;
										?>
									<?php else : ?>
										<li>
											<textarea name="step-lines-<?php echo $step_num; ?>[]" id="line-<?php echo $step_num; ?>" rows="5"></textarea>
											<!--<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-sort.png" class="project-button sort-list" />-->
											<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-minus.png" class="project-button remove">
											<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-add.png" class="project-button add">
										</li>
									<?php endif; ?>
								</ul>
							</div><!--[END #list]-->
						</div><!--[END .step-contents]-->
					</div><!--[END step-wrapper]-->
					<?php $step_num++; ?>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
		<input type="hidden" name="total-steps" value="<?php echo $step_num - 1; ?>">
	<?php }


	/**
	 * The main function that displays all the magic and unicorns one will need to manage their projects.
	 * @return HTML
	 *
	 * @version 2.0
	 */
	function make_magazine_parts_step_manager_mb() {
		global $post;

		// Load our Parts
		$parts = make_magazine_get_project_data( 'parts' );
		wp_nonce_field( 'make-mag-projects-metabox-nonce', 'meta_box_nonce' ); ?>
		<div class="step parts sortable group">
			<input type="button" value="Add A Part" class="button add-part alignright" />
			<div class="parts-template parts-wrapper">
				<input type="hidden" name="part-number-0" value="0">
				<div class="part-title">
					<h3>Part 0</h3>
					<div class="remove-part"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-remove.png"></div>
				</div>
				<div class="step-contents group">
					<ul class="two-column reset-list">
						<li>
							<label for="parts-name">Name</label>
							<input type="text" name="parts-name-0" id="parts-name" class="widefat" value="" />
						</li>
						<li>
							<label for="parts-qty">Quantity</label>
							<input type="text" name="parts-qty-0" id="parts-qty" class="widefat" value="" />
						</li>
						<li>
							<label for="parts-url">URL</label>
							<input type="text" name="parts-url-0" id="parts-url" class="widefat" value="" />
						</li>
					</ul><!--[END .step-contents]-->
					<ul class="two-column reset-list">
						<li>
							<label for="parts-type">Type</label>
							<input type="text" name="parts-type-0" id="parts-type" class="widefat" value="" />
						</li>
						<li>
							<label for="parts-notes">Notes</label>
							<textarea name="parts-notes-0" id="parts-notes" rows="4"></textarea>
						</li>
					</ul>
				</div><!--[END .step-contents]-->
			</div><!--[END .parts-template]-->
			<?php $parts_num = 1; ?>
			<?php if( isset( $parts ) && is_array( $parts ) ) : ?>
				<?php $parts = make_projects_sort( $parts ); ?>
				<?php foreach( $parts as $part ) : ?>
					<div id="part-<?php echo $parts_num; ?>" class="parts-wrapper">
						<input type="hidden" name="part-number-<?php echo $parts_num; ?>" value="<?php echo ( ! empty( $part['number'] ) ) ? $part['number'] : $parts_num; ?>">
						<div class="part-title">
							<h3>Part <?php echo $parts_num; ?></h3>
							<div class="remove-part"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-remove.png"></div>
						</div>
						<div class="step-contents group">
							<ul class="two-column reset-list">
								<li>
									<label for="parts-name">Name</label>
									<input type="text" name="parts-name-<?php echo $parts_num; ?>" id="parts-name" class="widefat" value="<?php echo ( ! empty( $part['text'] ) ) ? esc_attr( $part['text'] ) : ''; ?>" />
								</li>
								<li>
									<label for="parts-qty">Quantity</label>
									<input type="text" name="parts-qty-<?php echo $parts_num; ?>" id="parts-qty" class="widefat" value="<?php echo ( ! empty( $part['quantity'] ) ) ? intval( $part['quantity'] ) : ''; ?>" />
								</li>
								<li>
									<label for="parts-url">URL</label>
									<input type="text" name="parts-url-<?php echo $parts_num; ?>" id="parts-url" class="widefat" value="<?php echo ( ! empty( $part['url'] ) ) ? esc_url( $part['url'] ) : ''; ?>" />
								</li>
							</ul><!--[END .step-contents]-->
							<ul class="two-column reset-list">
								<li>
									<label for="parts-type">Type</label>
									<input type="text" name="parts-type-<?php echo $parts_num; ?>" id="parts-type" class="widefat" value="<?php echo ( ! empty( $part['type'] ) ) ? htmlspecialchars_decode( esc_attr( $part['type'] ), ENT_NOQUOTES ) : ''; ?>" />
								</li>
								<li>
									<label for="parts-notes">Notes</label>
									<textarea name="parts-notes-<?php echo $parts_num; ?>" id="parts-notes" rows="4"><?php echo ( ! empty( $part['notes'] ) ) ? htmlspecialchars_decode( esc_html( $part['notes'] ) ) : ''; ?></textarea>
								</li>
							</ul>
						</div><!--[END .step-contents]-->
					</div><!--[END step-wrapper]-->
					<?php // Setup some hidden fields to still handle old data just in case we need it. Other wise, we'll loose the data.
						if ( isset( $part['part_id'] ) && ! empty( $part['part_id'] ) )
							echo '<input type="hidden" name="part_id-' . $parts_num . '" value="' . intval( $part['part_id'] ) . '">';
						if ( isset( $part['pid'] ) && ! empty( $part['pid'] ) )
							echo '<input type="hidden" name="pid-' . $parts_num . '" value="' . intval( $part['pid'] ) . '" />';
						if ( isset( $part['post_ID'] ) )
							echo '<input type="hidden" name="post_ID-' . $parts_num . '" value="' . intval( $part['post_ID'] ) . '" />';
						// Increase the parts number...
						$parts_num++;
					?>
				<?php endforeach; ?>
			<?php endif; ?>
		</div><!--[END .step.parts.group]-->
		<input type="hidden" name="total-parts" value="<?php echo $parts_num - 1; ?>">
	<?php }


	/**
	 * The main function that displays all the magic and unicorns one will need to manage their projects.
	 * @return HTML
	 *
	 * @version 1.0
	 */
	function make_magazine_tools_step_manager_mb() {
		// Load our tools
		$tools = make_magazine_get_project_data( 'Tools' );
		wp_nonce_field( 'make-mag-projects-metabox-nonce', 'meta_box_nonce' ); ?>
		<div class="step tools sortable group">
			<input type="button" value="Add A Tool" class="button add-tool alignright" />
			<div class="tools-template tools-wrapper">
				<input type="hidden" name="tool-number-0" value="0">
				<div class="tool-title">
					<h3>Tool 0</h3>
					<div class="remove-tool"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-remove.png"></div>
				</div>
				<div class="step-contents group">
					<ul class="two-column reset-list">
						<li>
							<label for="tools-name">Name</label>
							<input type="text" name="tools-name-0" id="tools-name" class="widefat" value="" />
						</li>
						<li>
							<label for="tools-url">URL</label>
							<input type="text" name="tools-url-0" id="tools-url" class="widefat" value="" />
						</li>
						<li>
							<label for="tools-thumb">Thumbnail</label>
							<input type="text" name="tools-thumb-0" id="tools-thumb" class="widefat" value="" />
						</li>
					</ul><!--[END .step-contents]-->
					<ul class="two-column reset-list">
						<li>
							<label for="tools-notes">Notes</label>
							<textarea name="tools-notes-0" id="tools-notes" rows="4"></textarea>
						</li>
					</ul>
				</div><!--[END .step-contents]-->
			</div><!--[END .tools-template]-->
			<?php $tools_num = 1; ?>
			<?php if( isset( $tools ) && is_array( $tools ) ) : ?>
				<?php foreach( $tools as $tool ) : ?>
					<div id="tool-<?php echo $tools_num; ?>" class="tools-wrapper">
						<input type="hidden" name="tool-number-<?php echo $tools_num; ?>" value="<?php echo ( ! empty( $tool->number ) ) ? $tool->number : $tools_num; ?>">
						<div class="tool-title">
							<h3>Tool <?php echo $tools_num; ?></h3>
							<div class="remove-tool"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-remove.png"></div>
						</div>
						<div class="step-contents group">
							<ul class="two-column reset-list">
								<li>
									<label for="tools-name">Name</label>
									<input type="text" name="tools-name-<?php echo $tools_num; ?>" id="tools-name" class="widefat" value="<?php echo ( ! empty( $tool->text ) ) ? esc_attr( $tool->text ) : ''; ?>" />
								</li>
								<li>
									<label for="tools-url">URL</label>
									<input type="text" name="tools-url-<?php echo $tools_num; ?>" id="tools-url" class="widefat" value="<?php echo ( ! empty( $tool->url ) ) ? esc_url( $tool->url ) : ''; ?>" />
								</li>
								<li>
									<label for="tools-thumb">Thumbnail</label>
									<input type="text" name="tools-thumb-<?php echo $tools_num; ?>" id="tools-thumb" class="widefat" value="<?php echo ( ! empty( $tool->thumbnail ) ) ? esc_attr( $tool->thumbnail ) : ''; ?>" />
								</li>
							</ul><!--[END .step-contents]-->
							<ul class="two-column reset-list">
								<li>
									<label for="tools-notes">Notes</label>
									<textarea name="tools-notes-<?php echo $tools_num; ?>" id="tools-notes" rows="4"><?php echo ( ! empty( $tool->notes ) ) ? esc_html( $tool->notes ) : ''; ?></textarea>
								</li>
							</ul>
						</div><!--[END .step-contents]-->
					</div><!--[END step-wrapper]-->
					<?php $tools_num++; ?>
				<?php endforeach; ?>
			<?php endif; ?>
		</div><!--[END .step.tools.group]-->
		<input type="hidden" name="total-tools" value="<?php echo $tools_num - 1; ?>">
	<?php }


	/**
	 * The function to process the steps data submitted from the projects post type
	 * @param  array $_POST The data passed from the edit window
	 * @return array
	 *
	 * @since  Iron Giant
	 */
	function make_magazine_projects_build_step_data( $data ) {

		// Make sure we are actually passing an array or else things break.
		if ( ! is_array( $data ) )
			return false;

		// Process the data into the right data format for saving.
		for ( $i = 1; $i <= intval( $data['total-steps'] ); $i++ ) {
			// Define a new $step array. Other wise, we'll end up getting duplicate content...
			$step = array();

			// Add our title to the object
			$step['title'] = wp_filter_post_kses( $data[ 'step-title-' . $i ] );

			// Create the lines array and contain each line as an object in the Steps object
			$int = 0;
		 	foreach( $data[ 'step-lines-' . $i ] as $line ) {
				$step['lines'][] = (object) array(
					'text'     => wp_filter_post_kses( $line ),
					'text_raw' => wp_filter_post_kses( $line ),
					'bullet'   => 'black',
					'level'    => 0
				);
				$int++;
		 	}

			// Set the object array. At this moment. It's empty.
			$step['object'] = '';

			// Set our images array and contain each image as an object in the Steps object
			$int = 0;

			if ( isset( $data[ 'step-images-' . $i ] ) ) {
				foreach( $data[ 'step-images-' . $i ] as $image ) {

					$image_url = ( ! empty( $image ) ) ? esc_url_raw( $image ) : '';
					$step['images'][ $int ] = (object) array(
						'imageid' => absint( $data['post_ID'] ),
						'orderby' => $int,
						'text'    => $image_url
					);
					$int++; // Only increase the integer variable when we encounter a non-empty image value
				}
			}

			// Count the number of Steps set in the step manager and save that number
			$step['number'] = intval( $data[ 'step-number-' . $i ] );

			// Contain the whole $steps array into an object
			$step_object[] = (object) $step;
		}

		if ( isset( $step_object ) ) {
			return $step_object;
		} else {
			return null;
		}
	}


	/**
	 * The function to process the parts data submitted from the projects post type
	 * @param  array $_POST The data passed from the edit window
	 * @return array
	 *
	 * @since  Iron Giant
	 */
	function make_magazine_projects_build_parts_data( $data ) {

		if ( ! is_array( $data ) )
			return false;

		// Start by fetching the post meta first.
		$post_meta = get_post_meta( absint( $data['post_ID'] ), 'parts' );

		// If our data exists, delete it, otherwise, we'll get dupes.
		if ( ! empty( $post_meta ) || is_array( $post_meta ) )
			delete_post_meta( absint( $data['post_ID'] ), 'parts' );

		// Yo dawg, I heard you like arrays so we put your parts array inside a parts array so you can parts array while you parts array!
		$parts_array = array();

		// Loop through all of our parts.
		for ( $i = 1; $i <= intval( $data['total-parts'] ); $i++ ) {
			// Define a new $parts array. Other wise, we'll end up getting duplicate content...
			$parts = array();

			// Check if old data exists and add it to the array
			if ( isset( $data['part_id-' . $i ] ) )
				$parts['part_id'] = intval( $data['part_id-' . $i ] );

			// Add the sort number. This is used to display the parts in the correct order.
			$parts['order'] = absint( $data['part-number-' . $i ] );

			// Add our Name to the array
			$parts['text'] = wp_filter_post_kses( $data[ 'parts-name-' . $i ] );

			// Add our Notes to the array
			$parts['notes'] = wp_filter_post_kses( $data[ 'parts-notes-' . $i ] );

			// Add our Type to the array
			$parts['type'] = wp_filter_post_kses( $data[ 'parts-type-' . $i ] );

			// Add our Quantity to the array
			$parts['quantity'] = ( isset( $data[ 'parts-qty-' . $i ] ) ) ? intval( $data[ 'parts-qty-' . $i ] ) : '';

			// Add our URL to the array
			$parts['url'] = esc_url_raw( $data[ 'parts-url-' . $i ] );

			// Check if old data exists and add it to the array
			if ( isset( $data['pid-' . $i ] ) )
				$parts['pid'] = intval( $data['pid-' . $i ] );

			// Check if old data exists and add it to the array
			if ( isset( $data['post_ID-' . $i ] ) )
				$parts['post_ID'] = intval( $data['post_ID-' . $i ] );

			// Save each part as a new post meta with matching keys. Unlike Steps and Tools, we need a new key for every part...
			array_push( $parts_array, $parts );
		}

		return $parts_array;
	}


	/**
	 * The function to process the tools data submitted from the projects post type
	 * @param  array $_POST The data passed from the edit window
	 * @return array
	 *
	 * @since  Iron Giant
	 */
	function make_magazine_projects_build_tools_data( $data ) {

		if ( ! is_array( $data ) )
			return false;

		for ( $i = 1; $i <= intval( $data['total-tools'] ); $i++ ) {
			// Define a new $tools array. Other wise, we'll end up getting duplicate content...
			$tools = array();

			// Add our Name to the array
			$tools['text'] = wp_filter_post_kses( $data[ 'tools-name-' . $i ] );

			// Add our Notes to the array
			$tools['notes'] = wp_filter_post_kses( $data[ 'tools-notes-' . $i ] );

			// Add our URL to the array
			$tools['url'] = esc_url( $data[ 'tools-url-' . $i ] );

			// Add our Thumbnail to the array
			$tools['thumbnail'] = esc_url_raw( $data[ 'tools-thumb-' . $i ] );

			// Contain the whole $steps array into an object
			$tools_object[] = (object) $tools;
		}

		if ( isset( $tools_object ) ) {
			return $tools_object;
		} else {
			return null;
		}
	}


	/**
	 * Save our metaboxes into the databse. First we need to format the data to match the returned data in make_magazine_get_project_data()
	 * @param  Int $post_id Returns the $post->ID
	 * @return void
	 *
	 * @version 1.1
	 */
	function make_magazine_projects_save_step_manager( $post_id ) {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
		if ( ! isset( $_POST['meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['meta_box_nonce'], 'make-mag-projects-metabox-nonce' ) ) return;
		if ( ! current_user_can( 'edit_post', absint( $post_id ) ) ) return;


		//////////////////////////
		// STEPS
		$step_object = make_magazine_projects_build_step_data( $_POST );

		// Update our post meta for Steps if any exist
		update_post_meta( absint( $post_id ), 'Steps', $step_object );


		///////////////////////
		// PARTS
		$parts = make_magazine_projects_build_parts_data( $_POST );

		foreach ( $parts as $part ) {
			add_post_meta( absint( $post_id ), 'parts', $part );
		}

		////////////////////
		// TOOLS
		$tools_object = make_magazine_projects_build_tools_data( $_POST );

		// Update our post meta for Steps. Unlike Parts and Tools, we want one meta key.
		update_post_meta( absint( $post_id ), 'Tools', $tools_object );

	}
	add_action( 'save_post', 'make_magazine_projects_save_step_manager' );


	/**
	 * Autosave our post meta.
	 * Since the core of our projects
	 * @return void
	 *
	 * @since  Iron Giant
	 */
	function make_magazine_projects_autosave_step_manager() {

		// The post content is returned as a query string, let's convert that to an array
		parse_str( $_POST['post'], $_POST );

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
		if ( ! isset( $_POST['meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['meta_box_nonce'], 'make-mag-projects-metabox-nonce' ) ) return;
		if ( ! current_user_can( 'edit_post', absint( $_POST['post_ID'] ) ) ) return;

		//////////////////////////
		// STEPS
		$step_object = make_magazine_projects_build_step_data( $_POST );

		// Update our post meta for Steps if any exist
		update_post_meta( absint( $_POST['post_ID'] ), 'Steps', $step_object );


		///////////////////////
		// PARTS
		$parts = make_magazine_projects_build_parts_data( $_POST );

		foreach ( $parts as $part ) {
			add_post_meta( absint( absint( $_POST['post_ID'] ) ), 'parts', $part );
		}

		////////////////////
		// TOOLS
		$tools_object = make_magazine_projects_build_tools_data( $_POST );

		// Update our post meta for Steps. Unlike Parts and Tools, we want one meta key.
		update_post_meta( absint( $_POST['post_ID'] ), 'Tools', $tools_object );

		die( json_encode( 'Setps, Parts and Tools Autosaved.' ) );
	}
	add_action( 'wp_ajax_projects_save_step_manager', 'make_magazine_projects_autosave_step_manager' );
