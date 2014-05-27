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
if( ! function_exists('themewich_shortcode_styles') ) {
	function themewich_shortcode_styles() {
		wp_register_style('themewich-shortcodes', plugins_url( 'css/themewich-shortcodes.css' , dirname(__FILE__) ));
		wp_enqueue_style( 'themewich-shortcodes' );
	}
	add_action( 'wp_print_styles', 'themewich_shortcode_styles' );
}

if( !function_exists ('themewich_shortcodes_scripts') ) {
	function themewich_shortcodes_scripts() {
		// Load jquery if not already loaded
		if ( ! wp_script_is('jquery') ) wp_enqueue_script('jquery');

		// Register and load shortcodes custom script
		wp_register_script('modernizr', plugins_url( 'js/modernizr.min.js', dirname(__FILE__) ), 'jquery', '2.8.2', false);
		wp_register_script('themewich-shortcodes', plugins_url( 'js/themewich.shortcodes.js', dirname(__FILE__) ), 'jquery', '1.0', true);
		wp_register_script('magnificpopup', plugins_url( '/js/jquery.magnific-popup.min.js', dirname(__FILE__) ), 'jquery', '0.9.4', true);
		wp_register_script('themewich-tabs', plugins_url( '/js/jquery.themewichtabs.min.js', dirname(__FILE__) ), 'jquery', '1.0', true);

		wp_enqueue_script('modernizr');
		wp_enqueue_script('themewich-shortcodes');

	    }

	add_action('wp_enqueue_scripts', 'themewich_shortcodes_scripts');
}

/**
 * Loads lightbox javascript
 * 
 * @since ThemewichShortcodes 1.0
 */
if (!function_exists('themewich_print_lightbox_script')) :
	function themewich_print_lightbox_script() {
		global $add_lightbox;
		if ( ! $add_lightbox ) { return; }
	
		wp_print_scripts('magnificpopup');
	}
	add_action('wp_footer', 'themewich_print_lightbox_script');
endif;


/**
 * Loads isotope javascript
 * 
 * @since ThemewichShortcodes 1.0
 */
if (!function_exists('themewich_print_isotope_script')) :
	function themewich_print_isotope_script() {
		global $add_isotope;
		if ( ! $add_isotope ) { return; }
	
		wp_print_scripts('isotope');
	}
	add_action('wp_footer', 'themewich_print_isotope_script');
endif;


/**
 * Loads tabs javascript
 * 
 * @since ThemewichShortcodes 1.0
 */
if (!function_exists('themewich_print_tabs_script')) :
	function themewich_print_tabs_script() {
		global $add_tabs;
		if ( ! $add_tabs ) { return; }
	
		wp_print_scripts('themewich-tabs');
	}
	add_action('wp_footer', 'themewich_print_tabs_script');
endif;


/**
 * Loads accordion javascript
 * 
 * @since ThemewichShortcodes 1.0
 */
if (!function_exists('themewich_print_accordion_script')) :
	function themewich_print_accordion_script() {
		global $add_accordion;
		if ( ! $add_accordion ) { return; }

		wp_dequeue_script('themewich-shortcodes');
		wp_enqueue_script('jquery-ui-core');	
		wp_enqueue_script('jquery-ui-widget');
		wp_enqueue_script('jquery-ui-accordion');
		wp_enqueue_script('themewich-shortcodes');

	}
	add_action('wp_footer', 'themewich_print_accordion_script');
endif;	