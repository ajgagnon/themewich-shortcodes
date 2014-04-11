<?php
/**
 * This file loads the tinymce dropdown
 * @package Themewich Shortcodes
 * @since 1.2
 * @author Andre Gagnon
 * @link http://themewich.com
 * @License: GNU General Public License version 3.0
 * @License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */

global $tinymce_version; // Get tinymce version

/** 
 * New TinyMCE Compatibility
 * @since  v1.2
 */
if ( version_compare( $tinymce_version, '4021-20140407' ) >= 0 ) { 
	require_once( dirname(__FILE__) . '/button/themewich-tinymce-4.0.php' ); // MCE at least 4.0
} else { 
	require_once( dirname(__FILE__) . '/button/themewich-tinymce-3.0.php' ); // MCE previous version
}

/** 
 * Translatable Strings in tinyMCE dialog box
 * @since  v1.0
 */
if( ! function_exists('themewich_add_tinymce_lang') ) {
	function themewich_add_tinymce_lang( $arr ) {
	    $arr[] = plugins_url( '/lang/shortcode-languages.php',__FILE__ );
	    return $arr;
	}
	add_filter( 'mce_external_languages', 'themewich_add_tinymce_lang', 10, 1 );
}