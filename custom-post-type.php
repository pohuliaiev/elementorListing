<?php
function create_custom_post_type() {
	// Register Custom Post Type
	$labels = array(
		'name'                  => _x( 'Imoveis', 'Post Type General Name', 'plugin-name' ),
		'singular_name'         => _x( 'Imoveis', 'Post Type Singular Name', 'plugin-name' ),
		'menu_name'             => __( 'Imoveis', 'plugin-name' ),
		'name_admin_bar'        => __( 'Imoveis', 'plugin-name' ),
		'archives'              => __( 'Imoveis Archives', 'plugin-name' ),
		'attributes'            => __( 'IImoveis Attributes', 'plugin-name' ),
		'parent_item_colon'     => __( 'Parent Item:', 'plugin-name' ),
		'all_items'             => __( 'All Items', 'plugin-name' ),
		'add_new_item'          => __( 'Add New Item', 'plugin-name' ),
		'add_new'               => __( 'Add New', 'plugin-name' ),
		'new_item'              => __( 'New Item', 'plugin-name' ),
		'edit_item'             => __( 'Edit Item', 'plugin-name' ),
		'update_item'           => __( 'Update Item', 'plugin-name' ),
		'view_item'             => __( 'View Item', 'plugin-name' ),
		'view_items'            => __( 'View Items', 'plugin-name' ),
		'search_items'          => __( 'Search Item', 'plugin-name' ),
		'not_found'             => __( 'Not found', 'plugin-name' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'plugin-name' ),
		'featured_image'        => __( 'Featured Image', 'plugin-name' ),
		'set_featured_image'    => __( 'Set featured image', 'plugin-name' ),
		'remove_featured_image' => __( 'Remove featured image', 'plugin-name' ),
		'use_featured_image'    => __( 'Use as featured image', 'plugin-name' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'plugin-name' ),
		'items_list'            => __( 'Items list', 'plugin-name' ),
		'items_list_navigation' => __( 'Items list navigation', 'plugin-name' ),
		'filter_items_list'     => __( 'Filter items list', 'plugin-name' ),
	);
	$args = array(
		'label'                 => __( 'Imoveis', 'plugin-name' ),
		'description'           => __( 'Imoveis', 'plugin-name' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'elementor'),
		'taxonomies'            => array( 'genre', 'type' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'show_in_rest'          => true,
	);
	register_post_type( 'imoveis', $args );

	// Register Taxonomy Genre
	$labels = array(
		'name'                       => _x( 'Market', 'Taxonomy General Name', 'plugin-name' ),
		'singular_name'              => _x( 'Market', 'Taxonomy Singular Name', 'plugin-name' ),
		'menu_name'                  => __( 'Market', 'plugin-name' ),
		'all_items'                  => __( 'All Market', 'plugin-name' ),
		'parent_item'                => __( 'Parent Market', 'plugin-name' ),
		'parent_item_colon'          => __( 'Parent Market:', 'plugin-name' ),
		'new_item_name'              => __( 'New Market Name', 'plugin-name' ),
		'add_new_item'               => __( 'Add New Market', 'plugin-name' ),
		'edit_item'                  => __( 'Edit Market', 'plugin-name' ),
		'update_item'                => __( 'Update Market', 'plugin-name' ),
		'view_item'                  => __( 'View Market', 'plugin-name' ),
		'separate_items_with_commas' => __( 'Separate Markets with commas', 'plugin-name' ),
		'add_or_remove_items'        => __( 'Add or remove Market', 'plugin-name' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'plugin-name' ),
		'popular_items'              => __( 'Popular Market', 'plugin-name' ),
		'search_items'               => __( 'Search Market', 'plugin-name' ),
		'not_found'                  => __( 'Not Found', 'plugin-name' ),
		'no_terms'                   => __( 'No genres', 'plugin-name' ),
		'items_list'                 => __( 'Market list', 'plugin-name' ),
		'items_list_navigation'      => __( 'Market list navigation', 'plugin-name' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'market', array( 'imoveis' ), $args );

	// Register Taxonomy Type
	$labels = array(
		'name'                       => _x( 'Types', 'Taxonomy General Name', 'plugin-name' ),
		'singular_name'              => _x( 'Type', 'Taxonomy Singular Name', 'plugin-name' ),
		'menu_name'                  => __( 'Type', 'plugin-name' ),
		'all_items'                  => __( 'All Types', 'plugin-name' ),
		'parent_item'                => __( 'Parent Type', 'plugin-name' ),
		'parent_item_colon'          => __( 'Parent Type:', 'plugin-name' ),
		'new_item_name'              => __( 'New Type Name', 'plugin-name' ),
		'add_new_item'               => __( 'Add New Type', 'plugin-name' ),
		'edit_item'                  => __( 'Edit Type', 'plugin-name' ),
		'update_item'                => __( 'Update Type', 'plugin-name' ),
		'view_item'                  => __( 'View Type', 'plugin-name' ),
		'separate_items_with_commas' => __( 'Separate types with commas', 'plugin-name' ),
		'add_or_remove_items'        => __( 'Add or remove types', 'plugin-name' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'plugin-name' ),
		'popular_items'              => __( 'Popular Types', 'plugin-name' ),
		'search_items'               => __( 'Search Types', 'plugin-name' ),
		'not_found'                  => __( 'Not Found', 'plugin-name' ),
		'no_terms'                   => __( 'No types', 'plugin-name' ),
		'items_list'                 => __( 'Types list', 'plugin-name' ),
		'items_list_navigation'      => __( 'Types list navigation', 'plugin-name' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'type', array( 'imoveis' ), $args );

	$labels = array(
		'name'                       => _x( 'Localization', 'Taxonomy General Name', 'plugin-name' ),
		'singular_name'              => _x( 'Localization', 'Taxonomy Singular Name', 'plugin-name' ),
		'menu_name'                  => __( 'Localization', 'plugin-name' ),
		'all_items'                  => __( 'All Localizations', 'plugin-name' ),
		'parent_item'                => __( 'Parent Localization', 'plugin-name' ),
		'parent_item_colon'          => __( 'Parent Localization:', 'plugin-name' ),
		'new_item_name'              => __( 'New Localization Name', 'plugin-name' ),
		'add_new_item'               => __( 'Add New Localization', 'plugin-name' ),
		'edit_item'                  => __( 'Edit Localization', 'plugin-name' ),
		'update_item'                => __( 'Update Localization', 'plugin-name' ),
		'view_item'                  => __( 'View Localization', 'plugin-name' ),
		'separate_items_with_commas' => __( 'Separate Localization with commas', 'plugin-name' ),
		'add_or_remove_items'        => __( 'Add or remove Localization', 'plugin-name' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'plugin-name' ),
		'popular_items'              => __( 'Popular Localization', 'plugin-name' ),
		'search_items'               => __( 'Search Localization', 'plugin-name' ),
		'not_found'                  => __( 'Not Found', 'plugin-name' ),
		'no_terms'                   => __( 'No types', 'plugin-name' ),
		'items_list'                 => __( 'Localization list', 'plugin-name' ),
		'items_list_navigation'      => __( 'TLocalization list navigation', 'plugin-name' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);

	register_taxonomy( 'localization', array( 'imoveis' ), $args );
}
add_action( 'init', 'create_custom_post_type', 0 );

function add_custom_meta_box() {
	add_meta_box(
		'custom_meta_box',
		'Property options',
		'custom_meta_box_html',
		'imoveis',
		'normal',
		'high'
	);
}
add_action('add_meta_boxes', 'add_custom_meta_box');

// Meta box HTML
function custom_meta_box_html($post) {
	$price = get_post_meta($post->ID, '_price', true);
	$rooms = get_post_meta($post->ID, '_rooms', true);
	$bathroom = get_post_meta($post->ID, '_bathroom', true);
	$neighborhood = get_post_meta($post->ID, '_neighborhood', true);
	$parking = get_post_meta($post->ID, '_parking', true);
	wp_nonce_field('custom_meta_box_nonce', 'custom_meta_box_nonce_field');
	?>
	<p>
		<label for="price">Price</label>
		<input type="number" name="price" id="price" value="<?php echo esc_attr($price); ?>" class="widefat">
	</p>
	<p>
		<label for="neighborhood">Neighborhood</label>
		<input type="text" name="neighborhood" id="neighborhood" value="<?php echo esc_attr($neighborhood); ?>" class="widefat">
	</p>
	<p>
		<label for="rooms">Rooms</label>
		<input type="number" name="rooms" id="rooms" value="<?php echo esc_attr($rooms); ?>" class="widefat">
	</p>
	<p>
		<label for="bathroom">Bathrooms</label>
		<input type="number" name="bathroom" id="bathroom" value="<?php echo esc_attr($bathroom); ?>" class="widefat">
	</p>
	<p>
		<label for="parking">Parking</label>
		<input type="checkbox" name="parking" id="parking" <?php checked($parking, 'on'); ?>>
	</p>
	<?php
}


function save_custom_meta_box_data($post_id) {
	// Verify nonce
	if (!isset($_POST['custom_meta_box_nonce_field']) || !wp_verify_nonce($_POST['custom_meta_box_nonce_field'], 'custom_meta_box_nonce')) {
		return $post_id;
	}

	// Check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}

	// Check permissions
	if (isset($_POST['post_type']) && 'imoveis' === $_POST['post_type']) {
		if (!current_user_can('edit_post', $post_id)) {
			return $post_id;
		}
	}

	// Save fields
	if (isset($_POST['price'])) {
		update_post_meta($post_id, '_price', sanitize_text_field($_POST['price']));
	}

	if (isset($_POST['rooms'])) {
		update_post_meta($post_id, '_rooms', sanitize_text_field($_POST['rooms']));
	}

	if (isset($_POST['bathroom'])) {
		update_post_meta($post_id, '_bathroom', intval($_POST['bathroom']));
	}

	if (isset($_POST['neighborhood'])) {
		update_post_meta($post_id, '_neighborhood', sanitize_text_field($_POST['neighborhood']));
	}

	$parking_value = isset($_POST['parking']) ? 'on' : '';
	update_post_meta($post_id, '_parking', $parking_value);
}
add_action('save_post', 'save_custom_meta_box_data');

function get_taxonomy_term_names($post_id, $taxonomy) {

	$terms = wp_get_post_terms($post_id, $taxonomy);


	if (!is_wp_error($terms) && !empty($terms)) {

		$term_names = array();
		foreach ($terms as $term) {
			$term_names[] = $term->name;
		}
		return $term_names;
	} else {
		return array();
	}
}

