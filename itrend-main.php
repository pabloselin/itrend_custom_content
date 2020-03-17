<?php 
/**
 * Plugin Name:      	Contenido personalizado para visualizacion Itrend
 * Plugin URI:       	https://itrend.cl
 * Description:      	Los tipos de contenido, taxonomias y campos personalizados para la visualizacion de actores de Itrend, ademas de algunas utilidades
 * Version:           	0.1.5
 * Requires at least: 	5.2
 * Requires PHP:      	7.2
 * Author:            	ArtNumerica / APie
 * Author URI:        	https://apie.cl
 * License:           	GPL v2 or later
 * License URI:       	https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       	itrend
 * Domain Path:       	/lang
 */

define( 'ITREND_PLUGIN_VERSION', '0.3.9.3' );
define( 'ITREND_PREFIX', '_itrend_');

$pluginurl = plugin_dir_url(__FILE__);

define('ITREND_PLUGIN_URL',$pluginurl);

include( plugin_dir_path( __FILE__ ) . 'itrend-custom-fields.php' );
include( plugin_dir_path( __FILE__ ) . 'itrend-custom-posts.php' );
include( plugin_dir_path( __FILE__ ) . 'itrend-custom-taxonomies.php' );
include( plugin_dir_path( __FILE__ ) . 'itrend-template-functions.php' );
include( plugin_dir_path( __FILE__ ) . 'itrend-public.php' );

function itrend_admin_scripts() {
	wp_register_script( 'fields-logic', plugin_dir_url(__FILE__) . 'js/itrend-fields-logic.js', array('jquery'), ITREND_PLUGIN_VERSION, false );
	wp_register_style( 'fields-style', plugin_dir_url(__FILE__) . 'css/itrend-fields-style.css');
	wp_enqueue_script( 'fields-logic' );
	wp_enqueue_style( 'fields-style' );
	wp_localize_script( 'fields-logic', 'itrend_fields', itrend_populate_comunas() );
	wp_localize_script( 'fields-logic', 'itrend_tareas', itrend_tareas_tax_info() );
}

add_action( 'admin_enqueue_scripts', 'itrend_admin_scripts', 10, 0 );

function itrend_tareas_tax_info() {
	$tareas = get_terms( array('taxonomy' => 'tareas', 'hide_empty'=> false ) );
	$tareas_info = array();

	foreach($tareas as $tarea) {
		$tarea_numero = get_term_meta( $tarea->term_id, ITREND_PREFIX . 'numero_tarea', true );
		$tarea_nombre = get_term_meta( $tarea->term_id, ITREND_PREFIX . 'nombre_oficial', true);
		$tareas_info[$tarea->slug] = array(
						'slug'		=> $tarea->slug,
						'numero' 	=> $tarea_numero,
						'nombre-largo'	=> $tarea_nombre
						);
	}

	return $tareas_info;
}

function itrend_create_regiones_terms() {
	//Cargo las taxonomias antes
	cptui_register_my_taxes();
	
	$regiones = itrend_populate_regiones();
	$alcances = array('Nacional', 'Internacional', 'Regional');

	foreach($alcances as $alcance):
		if( !term_exists( $alcance, 'alcance_territorial' )):
			if($alcance == 'Regional'):
				$regionalid = wp_insert_term( $alcance, 'alcance_territorial' );
				foreach($regiones as $region):
					$slug = sanitize_title( $region );
					if( !term_exists( $region, 'alcance_territorial' )):
						wp_insert_term( $region, 'alcance_territorial', array('slug' => $slug, 'parent' => $regionalid['term_id']) );
					endif;
				endforeach;
			else:
				wp_insert_term( $alcance, 'alcance_territorial' );
			endif;
		endif;
	endforeach;
	}

	register_activation_hook( __FILE__ , 'itrend_create_regiones_terms' );

function itrend_remove_metaboxes() {
	 	remove_meta_box( 'postcustom' , 'actor' , 'normal' ); //removes custom fields for page
	  	remove_meta_box( 'slugdiv' , 'actor' , 'normal' ); //removes custom fields for page
	}

add_action( 'admin_menu' , 'itrend_remove_metaboxes' );

function itrend_translate_attached_posts_fields( $translated_text, $text, $domain ) {
	switch($translated_text):
		case 'Filter %s':
			$translated_text = 'Filtrar %s';
		break;
		case 'Attached %s':
			$translated_text = '%s asociados';
		break;
		case 'Available %s':
			$translated_text = '%s disponibles';
		break;
	endswitch;

	return $translated_text;
}

function itrend_relevant_taxonomies() {
	return array(
		'sector',
		'alcance_territorial',
		'tareas',
		'acciones_grrd'
	);
}

add_filter( 'gettext', 'itrend_translate_attached_posts_fields', 20, 3 );