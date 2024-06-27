<?php
/**
 * Plugin Name: Elementor Listings Widget
 * Description: Property Listings Widget for Elementor.
 * Version: 1.0
 * Author: The Agency
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function register_custom_widget( $widgets_manager ) {
	require_once( __DIR__ . '/listings-widget.php' );
	$widgets_manager->register( new \Elementor_Custom_Widget() );
}
add_action( 'elementor/widgets/register', 'register_custom_widget' );

function elementor_listings_enqueue_assets() {
	wp_enqueue_script('elementor-listings-script', plugin_dir_url(__FILE__) . 'build/index.js', array('jquery'), '1.0.0', true);
	wp_enqueue_style('elementor-listings-style', plugin_dir_url(__FILE__) . 'build/index.css', array(), '1.0.0');

	wp_localize_script('elementor-listings-script', 'elementorListingsAjax', array(
		'ajaxurl' => admin_url('admin-ajax.php'),
		'nonce'   => wp_create_nonce('elementor-listings-nonce'),
	));
}
add_action('wp_enqueue_scripts', 'elementor_listings_enqueue_assets');

require_once( __DIR__ . '/custom-post-type.php' );

require_once( __DIR__ . '/functions/ajax-call.php' );