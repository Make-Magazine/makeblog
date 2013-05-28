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
	function make_magazine_projects_add_scripts() {
		if(is_admin() && ('projects' == get_post_type())) {
			wp_enqueue_media();
			wp_enqueue_script( 'make-projects-custom-js', get_stylesheet_directory_uri() . '/js/projects-manager.js', array('jquery' ) );
			wp_enqueue_script( 'make-parts-custom-js', get_stylesheet_directory_uri() . '/js/parts-manager.js', array( 'jquery' ) );
			wp_enqueue_script( 'make-tools-custom-js', get_stylesheet_directory_uri() . '/js/tools-manager.js', array( 'jquery' ) );
			echo '<script>var stylesheet_uri = "' . get_stylesheet_directory_uri() . '";</script>';
		}
	}
	add_action('admin_print_scripts', 'make_magazine_projects_add_scripts');


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
		<div class="step group">
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
							<input type="hidden" name="step-image-0[]" class="image-url" value="">
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
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-sort.png" class="project-button sort" />
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-minus.png" class="project-button remove">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-add.png" class="project-button add">
							</li>
						</ul>
					</div><!--[END #list]-->
				</div><!--[END .step-contents]-->
			</div><!--[END .steps-template]-->
			<?php if ( isset( $steps ) && is_array( $steps ) ) : ?>
				<?php $step_num = 1; foreach( $steps as $step ) : ?>
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
								<input type="text" name="step-title-<?php echo $step_num; ?>" id="project-header" class="widefat" placeholder="Add A Title" value="<?php echo ( ! empty( $step->title ) ) ? wp_filter_post_kses( $step->title ) : ''; ?>">
								<ul id="sub-lists" class="sortable reset-list">
									<?php if ( isset( $step->lines ) ) : ?>
										<?php
											$total = count( $step->lines ); // Count the number of sub-steps
											$i = 1; // Used to set the right ID's and to check against
											foreach ( $step->lines as $key ) : ?>
											<li>
												<textarea name="step-lines-<?php echo $step_num; ?>[]" id="line-<?php echo $i; ?>" rows="5"><?php echo stripslashes( wp_filter_post_kses( $key->text ) ); ?></textarea>
												<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-sort.png" class="project-button sort" />
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
											<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-sort.png" class="project-button sort" />
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
	 * @version 1.0
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
			<?php if( isset( $parts ) && is_array( $parts ) ) : ?>
				<?php $parts_num = 1; foreach( $parts as $part ) : 

					// Unserialize our Parts here as each array is serialized while the parent isn't.
					$part = unserialize( $part ); ?>
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
									<input type="text" name="parts-type-<?php echo $parts_num; ?>" id="parts-type" class="widefat" value="<?php echo ( ! empty( $part['type'] ) ) ? htmlspecialchars_decode( esc_attr( $part['type'] ) ) : ''; ?>" />
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
					</ul><!--[END .step-contents]-->
					<ul class="two-column reset-list">
						<li>
							<label for="tools-thumb">Thumbnail</label>
							<input type="text" name="tools-thumb-0" id="tools-thumb" class="widefat" value="" />
						</li>
						<li>
							<label for="tools-notes">Notes</label>
							<textarea name="tools-notes-0" id="tools-notes" rows="4"></textarea>
						</li>
					</ul>
				</div><!--[END .step-contents]-->
			</div><!--[END .tools-template]-->
			<?php if( isset( $tools ) && is_array( $tools ) ) : ?>
				<?php $tools_num = 1; foreach( $tools as $tool ) : ?>
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
	 * Save our metaboxes into the databse. First we need to format the data to match the returned data in make_magazine_get_project_data()
	 * @param  Int $post_id Returns the $post->ID
	 * @return void
	 *
	 * @version 1.0
	 */
	function make_magazine_projects_save_step_manager( $post_id ) {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
		if ( ! isset( $_POST['meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['meta_box_nonce'], 'make-mag-projects-metabox-nonce' ) ) return;
		if ( ! current_user_can( 'edit_post' ) ) return;


		// Check if any of our "Step" data exists and isn't empty. Then, loop through each step and create an object for each by looping through the number of total steps sent through the $_POST array.
		if ( $_POST['total-steps'] != '-1' ) {
			for ( $i = 1; $i <= intval( $_POST['total-steps'] ); $i++ ) {
				// Define a new $step array. Other wise, we'll end up getting duplicate content...
				$step = array();

				// Add our title to the object
				$step['title'] = wp_filter_post_kses( $_POST[ 'step-title-' . $i ] );

				// Create the lines array and contain each line as an object in the Steps object
				$int = 0;
			 	foreach( $_POST[ 'step-lines-' . $i ] as $line ) {
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
				foreach( $_POST[ 'step-images-' . $i ] as $image ) {
					$step['images'][ $int ] = (object) array(
						'imageid' => $post_id,
						'orderby' => $int,
						'text'    => esc_url_raw( $image )
					);
					$int++; // Only increase the integer variable when we encounter a non-empty image value
				}

				// Count the number of Steps set in the step manager and save that number
				$step['number'] = intval( $_POST[ 'step-number-' . $i ] );

				// Contain the whole $steps array into an object
				$step_object[] = (object) $step;

			}

			// Update our post meta for Steps.
			update_post_meta( $post_id, 'Steps', $step_object );
		}


		// Check if any of our "Parts" data exists and isn't empty. Then, loop through each part and create an array for each by looping through the number of total parts sent through the $_POST array.
		if ( $_POST['total-parts'] != '-1' ) {
			
			// We need to check if post meta already exists.
			$post_meta = get_post_meta( $post_id, 'parts' );

			// If our data exists, delete it, otherwise, we'll get dupes.
			if ( ! empty( $post_meta ) || is_array( $post_meta ) )
				delete_post_meta( $post_id, 'parts' );

			// Loop through all of our parts.
			for ( $i = 1; $i <= intval( $_POST['total-parts'] ); $i++ ) {
				// Define a new $parts array. Other wise, we'll end up getting duplicate content...
				$parts = array();

				// Check if old data exists and add it to the array
				if ( isset( $_POST['part_id-' . $i ] ) )
					$parts['part_id'] = intval( $_POST['part_id-' . $i ] );

				// Add our Name to the array
				$parts['text'] = wp_filter_post_kses( $_POST[ 'parts-name-' . $i ] );

				// Add our Notes to the array
				$parts['notes'] = wp_filter_post_kses( $_POST[ 'parts-notes-' . $i ] );

				// Add our Type to the array
				$parts['type'] = wp_filter_post_kses( $_POST[ 'parts-type-' . $i ] );

				// Add our Quantity to the array
				$parts['quantity'] = ( isset( $_POST[ 'parts-qty-' . $i ] ) ) ? intval( $_POST[ 'parts-qty-' . $i ] ) : '';

				// Add our URL to the array
				$parts['url'] = esc_url( $_POST[ 'parts-url-' . $i ] );

				// Check if old data exists and add it to the array
				if ( isset( $_POST['pid-' . $i ] ) )
					$parts['pid'] = intval( $_POST['pid-' . $i ] );

				// Check if old data exists and add it to the array
				if ( isset( $_POST['post_ID-' . $i ] ) )
					$parts['post_ID'] = intval( $_POST['post_ID-' . $i ] );

				// Save each part as a new post meta with matching keys. Unlike Steps and Tools, we need a new key for every part...
				add_post_meta( $post_id, 'parts', $parts );
			}
		}


		// Check if any of our "Tools" data exists and isn't empty. Then, loop through each tool and create an array for each by looping through the number of total tools sent through the $_POST array.
		if ( $_POST['total-tools'] != '-1' )  {

			// Loop through all of our tools.
			for ( $i = 1; $i <= intval( $_POST['total-tools'] ); $i++ ) {
				// Define a new $tools array. Other wise, we'll end up getting duplicate content...
				$tools = array();

				// Add our Name to the array
				$tools['text'] = wp_filter_post_kses( $_POST[ 'tools-name-' . $i ] );

				// Add our Notes to the array
				$tools['notes'] = wp_filter_post_kses( $_POST[ 'tools-notes-' . $i ] );

				// Add our URL to the array
				$tools['url'] = esc_url( $_POST[ 'tools-url-' . $i ] );

				// Add our Thumbnail to the array
				$tools['thumbnail'] = esc_url( $_POST[ 'tools-thumb-' . $i ] );

				// Contain the whole $steps array into an object
				$tools_object[] = (object) $tools;
			}

			// Update our post meta for Steps. Unlike Parts and Tools, we want one meta key.
			update_post_meta( $post_id, 'Tools', $tools_object );
		}
	}
	add_action('save_post', 'make_magazine_projects_save_step_manager');

