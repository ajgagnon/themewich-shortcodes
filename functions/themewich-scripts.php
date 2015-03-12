<?php
/**
 * This file loads the CSS and JS for the shortcodes
 * @package Themewich Shortcodes
 * @since 1.0
 * @author Andre Gagnon
 * @link http://themewich.com
 * @License: GNU General Public License version 3.0
 * @License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */

/**
 * Register and Load Shortcodes CSS
 *
 * @since v1.0
 */
if( ! function_exists( 'themewich_plugin_shortcode_styles' ) ) {
	function themewich_plugin_shortcode_styles() {
		wp_register_style( 'themewich-shortcodes', plugins_url( 'css/themewich-shortcodes.css' , dirname(__FILE__) ) );
		wp_enqueue_style( 'themewich-shortcodes' );
	}
	add_action( 'wp_print_styles', 'themewich_plugin_shortcode_styles' );
}

if( ! function_exists( 'themewich_plugin_shortcodes_scripts' ) ) {
	function themewich_plugin_shortcodes_scripts() {
		// Load jquery if not already loaded
		if ( ! wp_script_is('jquery') ) wp_enqueue_script('jquery');

		// Register and load shortcodes custom script
		wp_register_script( 'modernizr', plugins_url( 'js/modernizr.min.js', dirname(__FILE__) ), 'jquery', '2.8.2', false );
		wp_register_script( 'themewich-shortcodes', plugins_url( 'js/themewich.shortcodes.js', dirname(__FILE__) ), 'jquery', '1.0', true );
		wp_register_script( 'magnificpopup', plugins_url( '/js/jquery.magnific-popup.min.js', dirname(__FILE__) ), 'jquery', '0.9.4', true );
		wp_register_script( 'isotope', plugins_url( '/js/jquery.isotope.min.js', dirname(__FILE__) ), 'jquery', '1.5.25', true );
		wp_register_script( 'imagesloaded', plugins_url( '/js/imagesloaded.pkgd.min.js', dirname(__FILE__) ), 'jquery', '3.1.8', true );
		wp_register_script( 'themewich-tabs', plugins_url( '/js/jquery.themewichtabs.min.js', dirname(__FILE__) ), 'jquery', '1.0', true );

		wp_enqueue_script( 'modernizr' );
		wp_enqueue_script( 'magnificpopup' );
		wp_enqueue_script( 'imagesloaded' );
		wp_enqueue_script( 'isotope' );
		wp_enqueue_script( 'themewich-tabs' );
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-widget' );
		wp_enqueue_script( 'jquery-ui-accordion' );
		wp_enqueue_script( 'themewich-shortcodes' );
	}
	add_action( 'wp_enqueue_scripts', 'themewich_plugin_shortcodes_scripts' );
}