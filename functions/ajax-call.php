<?php
add_action('wp_ajax_elementor_listings_ajax_request', 'elementor_listings_ajax_handler');
add_action('wp_ajax_nopriv_elementor_listings_ajax_request', 'elementor_listings_ajax_handler');

function elementor_listings_ajax_handler() {
	check_ajax_referer('elementor-listings-nonce', 'nonce');

	if (isset($_POST['city_id']) || isset($_POST['market_id'])) {
		$city_id = sanitize_text_field($_POST['city_id']);
		$market_id = sanitize_text_field($_POST['market_id']);

		// Query posts by custom taxonomy ID
		$args = array(
			'post_type' => 'imoveis', // Replace with your custom post type
			'tax_query' => array(
				'relation' => 'AND',
				array(
					'taxonomy' => 'localization', // Replace with your custom taxonomy
					'field'    => 'term_id',
					'terms'    => $city_id,
				),
				array(
					'taxonomy' => 'market', // Replace with your custom taxonomy
					'field'    => 'term_id',
					'terms'    => $market_id,
				),
			),
		);
		$query = new WP_Query($args);

		if ($query->have_posts()) {
			$posts = array();
			while ($query->have_posts()) {
				$query->the_post();
				$neighborhood = get_post_meta( get_the_ID(), '_neighborhood', true );
				$price = get_post_meta( get_the_ID(), '_price', true );
				$rooms = get_post_meta( get_the_ID(), '_rooms', true );
				$bathroom = get_post_meta( get_the_ID(), '_bathroom', true );
				$parking = get_post_meta( get_the_ID(), '_parking', true );
				$taxName = get_taxonomy_term_names(get_the_ID(), 'market')[0];
				$posts[] = array(
					'id' => get_the_ID(),
					'title' => get_the_title(),
					'link' => get_permalink(),
					'image' => get_the_post_thumbnail_url(),
					'adress' => $neighborhood,
					'price' => $price,
					'rooms' => $rooms,
					'bathroom' => $bathroom,
					'parking' => $parking,
					'market' => $taxName
				);
			}
			wp_reset_postdata();

			wp_send_json_success($posts);
		} else {
			wp_send_json_error('No posts found');
		}
	} else {
		wp_send_json_error('Data ID not provided');
	}

	wp_die();
}