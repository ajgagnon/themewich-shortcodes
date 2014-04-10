<?php
/**
 * This file loads the tinymce dropdown for version 4.0
 * @package Themewich Shortcodes
 * @since 1.1
 * @author Andre Gagnon
 * @link http://themewich.com
 * @License: GNU General Public License version 3.0
 * @License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */

/** 
 * Register and Localize JS
 * @since  v1.1
 */
function themewich_register_js() {
	wp_enqueue_script( 'jquery' );
	wp_localize_script( 'jquery', 'themewichShortcodesVars', array('template_url' => plugin_dir_url( realpath(dirname(__FILE__) . '/..') ) ) );
}
add_action( 'admin_init', 'themewich_register_js' );

/** 
 * Add Scripts to Correct Admin Pages
 * @since  v1.1
 */
function themewich_add_tinymce() {
    global $typenow;
    // only on Post Type: post and page
    if( ! in_array( $typenow, array( 'post', 'page' ) ) )
        return ;

    add_filter( 'mce_external_plugins', 'themewich_add_tinymce_plugin' );
    // Add to line 1 form WP TinyMCE
    add_filter( 'mce_buttons', 'themewich_add_tinymce_button' );
}
add_action( 'admin_head', 'themewich_add_tinymce' );

/** 
 * Include JS for TinyMCE
 * @since  v1.1
 */
function themewich_add_tinymce_plugin( $plugin_array ) {
    $plugin_array['themewich_shortcodes'] = plugins_url( '/js/themewich.admin.dropdown.js', realpath(dirname(__FILE__) . '/..') );
    // Print all plugin js path
    return $plugin_array;
}

/** 
 * Include Button for TinyMCE
 * @since  v1.1
 */
function themewich_add_tinymce_button( $buttons ) {
    array_push( $buttons, 'themewich_shortcodes_button_key' );
    // Print all buttons
    return $buttons;
}

/** 
 * Custom Dropdown Icon
 * @since  v1.1
 */
function my_custom_admin_head(){
    echo '<style>
    .mce-i-shortcodes:before {
        font-family: "dashicons";
        content: "\f309";
        font-size:20px;
    }
    </style>';
}
add_action('admin_head', 'my_custom_admin_head');