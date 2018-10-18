<?php
/**
 * @package PluginDemo
 */
/*
Plugin Name: Plugin Demo
Plugin URI: https://franciscoigor.me/
Description: This is a <strong>demo plugin</strong> for development . 
Version: 1.0.0
Author: FranciscoIgor
Author URI: https://franciscoigor.me/wordpress-plugins/
License: MIT
Text Domain: franciscoigor
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2005-2015 Francisco Igor
*/


// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

define( 'DEMOPLUGIN_VERSION', '4.0.8' );
define( 'DEMOPLUGIN__MINIMUM_WP_VERSION', '4.0' );
define( 'DEMOPLUGIN__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'DEMOPLUGIN_DELETE_LIMIT', 100000 );

require_once( DEMOPLUGIN__PLUGIN_DIR . 'demo.class.php' );

register_activation_hook( __FILE__, array( 'Demo', 'plugin_activation' ) );
register_deactivation_hook( __FILE__, array( 'Demo', 'plugin_deactivation' ) );

add_action( 'init', array( 'Demo', 'init' ) );

/*
add_action( 'rest_api_init', array( 'Demo_REST_API', 'init' ) );
*/



