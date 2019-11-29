<?php 
/**
 * Plugin Name:      	Contenido personalizado para visualizacion Itrend
 * Plugin URI:       	https://example.com/plugins/the-basics/
 * Description:      	Handle the basics with this plugin.
 * Version:           	0.0.1
 * Requires at least: 	5.2
 * Requires PHP:      	7.2
 * Author:            	ArtNumerica / APie
 * Author URI:        	https://apie.cl
 * License:           	GPL v2 or later
 * License URI:       	https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       	itrend
 * Domain Path:       	/lang
 */

define( 'ITREND_PLUGIN_VERSION', '0.0.1' );

include( plugin_dir_path( __FILE__ ) . 'itrend-custom-fields.php' );
include( plugin_dir_path( __FILE__ ) . 'itrend-custom-posts.php' );
include( plugin_dir_path( __FILE__ ) . 'itrend-custom-taxonomies.php' );

function itrend_admin_scripts() {
	wp_register_script( 'fields-logic', plugin_dir_url(__FILE__) . 'itrend-fields-logic.js', array('jquery'), ITREND_PLUGIN_VERSION, false );
	wp_enqueue_script( 'fields-logic' );
}

add_action( 'admin_enqueue_scripts', 'itrend_admin_scripts', 10, 0 );
