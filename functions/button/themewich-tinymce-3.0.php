<?php
/**
 * Creates TinyMCE Dropdown Menu
 * @since  v1.0
 */
class Themewich_TinyMCE_Buttons {
	function __construct() {
    	add_action( 'init', array(&$this,'init') );
    }
    function init() {
		if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
			return;		
		if ( get_user_option('rich_editing') == 'true' ) {  
			add_filter( 'mce_external_plugins', array(&$this, 'add_plugin') );  //add plugin
			add_filter( 'mce_buttons', array(&$this,'register_button') );  // register button
			wp_enqueue_script( 'jquery' );
			// Localize directory
			wp_localize_script( 'jquery', 'themewichShortcodesVars', array('template_url' => realpath(dirname(__FILE__) . '/..') ) );
		}  
    }  
	function add_plugin($plugin_array) {  
	   $plugin_array['themewich_shortcodes'] = plugins_url( '/js/themewich.admin.dropdown.3.0.js', realpath(dirname(__FILE__) . '/..') );
	   return $plugin_array; 
	}
	function register_button($buttons) {  
	   array_push($buttons, "themewich_shortcodes_button");
	   return $buttons; 
	} 	
}
$themewichshortcode = new Themewich_TinyMCE_Buttons; 