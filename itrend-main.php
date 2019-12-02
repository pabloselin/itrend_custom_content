<?php 
/**
 * Plugin Name:      	Contenido personalizado para visualizacion Itrend
 * Plugin URI:       	https://itrend.cl
 * Description:      	Los tipos de contenido, taxonomias y campos personalizados para la visualizacion de actores de Itrend, ademas de algunas utilidades
 * Version:           	0.0.2
 * Requires at least: 	5.2
 * Requires PHP:      	7.2
 * Author:            	ArtNumerica / APie
 * Author URI:        	https://apie.cl
 * License:           	GPL v2 or later
 * License URI:       	https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       	itrend
 * Domain Path:       	/lang
 */

define( 'ITREND_PLUGIN_VERSION', '0.0.2' );

include( plugin_dir_path( __FILE__ ) . 'itrend-custom-fields.php' );
include( plugin_dir_path( __FILE__ ) . 'itrend-custom-posts.php' );
include( plugin_dir_path( __FILE__ ) . 'itrend-custom-taxonomies.php' );

function itrend_admin_scripts() {
	wp_register_script( 'fields-logic', plugin_dir_url(__FILE__) . 'itrend-fields-logic.js', array('jquery'), ITREND_PLUGIN_VERSION, false );
	wp_enqueue_script( 'fields-logic' );
	wp_localize_script( 'fields-logic', 'itrend_fields', itrend_populate_comunas() );
}

add_action( 'admin_enqueue_scripts', 'itrend_admin_scripts', 10, 0 );

function itrend_create_regiones_terms() {
	//Cargo las taxonomias antes
	cptui_register_my_taxes();
	
	$regiones = itrend_populate_regiones();
	$alcances = array('Nacional', 'Internacional', 'Regional');

	foreach($alcances as $alcance):
		if( !term_exists( $alcance, 'alcance_territorial' )):
			wp_insert_term( $alcance, 'alcance_territorial' );
		endif;
	endforeach;

	foreach($regiones as $region):
		$slug = sanitize_title( $region );
		if( !term_exists( $region, 'alcance_territorial' )):
			wp_insert_term( $region, 'alcance_territorial', array('slug' => $slug) );
		endif;
	endforeach;
}

register_activation_hook( __FILE__ , 'itrend_create_regiones_terms' );