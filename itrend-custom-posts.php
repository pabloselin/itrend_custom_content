<?php
function cptui_register_my_cpts() {

	/**
	 * Post Type: Actores.
	 */

	$labels = [
		"name" => __( "Actores", "twentytwenty" ),
		"singular_name" => __( "Actor", "twentytwenty" ),
		"menu_name" => __( "Actores", "twentytwenty" ),
		"all_items" => __( "Todos los Actores", "twentytwenty" ),
		"add_new" => __( "Añadir nuevo", "twentytwenty" ),
		"add_new_item" => __( "Añadir nuevo Actor", "twentytwenty" ),
		"edit_item" => __( "Editar Actor", "twentytwenty" ),
		"new_item" => __( "Nuevo Actor", "twentytwenty" ),
		"view_item" => __( "Ver Actor", "twentytwenty" ),
		"view_items" => __( "Ver Actores", "twentytwenty" ),
		"search_items" => __( "Buscar Actores", "twentytwenty" ),
		"not_found" => __( "No se encontraron Actores", "twentytwenty" ),
		"not_found_in_trash" => __( "No se encontraron Actores en la papelera", "twentytwenty" ),
		"parent" => __( "Actor superior", "twentytwenty" ),
		"featured_image" => __( "Imagen destacada o logotipo", "twentytwenty" ),
		"set_featured_image" => __( "Asignar imagen destacada o logotipo", "twentytwenty" ),
		"remove_featured_image" => __( "Quitar imagen destacada o logotipo", "twentytwenty" ),
		"use_featured_image" => __( "Usar imagen destacada o logotipo", "twentytwenty" ),
		"archives" => __( "Archivo de actores", "twentytwenty" ),
		"insert_into_item" => __( "Insertar", "twentytwenty" ),
		"uploaded_to_this_item" => __( "Subido a este contenido", "twentytwenty" ),
		"filter_items_list" => __( "Filtrar por lista de Actores", "twentytwenty" ),
		"items_list_navigation" => __( "Navegación por lista de Actores", "twentytwenty" ),
		"items_list" => __( "Lista de Actores", "twentytwenty" ),
		"attributes" => __( "Información adicional Actor", "twentytwenty" ),
		"name_admin_bar" => __( "Actor", "twentytwenty" ),
		"item_published" => __( "Actor publicado", "twentytwenty" ),
		"item_published_privately" => __( "Actor publicado como privado", "twentytwenty" ),
		"item_reverted_to_draft" => __( "Actor guardado como borrador", "twentytwenty" ),
		"item_scheduled" => __( "Actor con publicación programada", "twentytwenty" ),
		"item_updated" => __( "Actor actualizado", "twentytwenty" ),
		"parent_item_colon" => __( "Actor superior", "twentytwenty" ),
	];

	$args = [
		"label" => __( "Actores", "twentytwenty" ),
		"labels" => $labels,
		"description" => "Actores institucionales presentes en el ecosistema de resiliencia de desastres",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"delete_with_user" => false,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "actores", "with_front" => true ],
		"query_var" => true,
		"menu_icon" => "dashicons-universal-access-alt",
		"supports" => [ "title", "thumbnail", "custom-fields", "revisions" ],
	];

	register_post_type( "actor", $args );
}

add_action( 'init', 'cptui_register_my_cpts' );
