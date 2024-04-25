<?php
/**
 * Plugin Name: Quote of the Day Widget
 * Description: Display a random quote from an api for Elementor.
 * Plugin URI:  https://github.com/coffee-sprinkler/elementor-quote
 * Version:     1.0.0
 * Author:      Dennis
 * Author URI:  https://github.com/coffee-sprinkler/
 * Text Domain: elementor-quote
 *
 * Requires Plugins: elementor
 * Elementor tested up to: 3.21.0
 * Elementor Pro tested up to: 3.21.0
 */

 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Register Quote of the Day Widget.
 *
 * Include widget file and register widget class.
 *
 * @since 1.0.0
 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
 * @return void
 */
function register_elementor_quote_widget( $widgets_manager ) {

	require_once( __DIR__ . '/widgets/quote-widget.php' );

	$widgets_manager->register( new \Elementor_Quote_Widget() );

}
add_action( 'elementor/widgets/register', 'register_elementor_quote_widget' );