<?php
/*
Plugin Name: Headway News Ticker Block
Plugin URI: http://www.jonmather.info
Description: News Ticker block for Headway
Version: 1.0
Author: Jon Mather
Author URI: http://www.jonmather.info
License: GNU GPL v2
*/

define('NEWSTICKER_BLOCK_VERSION', '1.0');

add_action('after_setup_theme', 'register_newsticker_block');
function register_newsticker_block() {
	if ( !class_exists('Headway') )
		return;
	require_once 'block.php';
	require_once 'block-options.php';

	return headway_register_block('HeadwayNewsTickerBlock', substr(WP_PLUGIN_URL . '/' . str_replace(basename(__FILE__), '', plugin_basename(__FILE__)), 0, -1));

}