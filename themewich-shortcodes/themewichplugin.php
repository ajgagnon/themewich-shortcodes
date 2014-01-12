<?php
/*
Plugin Name: Themewich Shortcodes
Plugin URI: http://themewich.com
Description: A better, more user-friendly shortcode plugin.
Author: Andre Gagnon
Version: 1.0
Author URI: http://www.themewich.com
*/

require_once( dirname(__FILE__) . '/functions/themewich-scripts.php' ); // Adds plugin JS and CSS
require_once( dirname(__FILE__) . '/functions/themewich-shortcodes.php' ); // Adds shortcodes
require_once( dirname(__FILE__) . '/functions/themewich-tinymce.php' ); // Adds tinymce functionality