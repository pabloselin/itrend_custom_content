<?php
function cptui_register_my_taxes() {
	/**
	 * Taxonomy: Sectores.
	 */

	$labels = [
		"name" => __( "Sectores", "twentytwenty" ),
		"singular_name" => __( "Sector", "twentytwenty" ),
		"menu_name" => __( "Sectores", "twentytwenty" ),
		"all_items" => __( "Todos los Sectores", "twentytwenty" ),
		"edit_item" => __( "Editar Sector", "twentytwenty" ),
		"view_item" => __( "Ver Sector", "twentytwenty" ),
		"update_item" => __( "Actualizar nombre del Sector", "twentytwenty" ),
		"add_new_item" => __( "Añadir nuevo Sector", "twentytwenty" ),
		"new_item_name" => __( "Nuevo nombre de Sector", "twentytwenty" ),
		"parent_item" => __( "Sector superior", "twentytwenty" ),
		"parent_item_colon" => __( "Sector superior:", "twentytwenty" ),
		"search_items" => __( "Buscar Sectores", "twentytwenty" ),
		"popular_items" => __( "Sectores más utilizados", "twentytwenty" ),
		"separate_items_with_commas" => __( "Separar Sectores con coma", "twentytwenty" ),
		"add_or_remove_items" => __( "Añadir o quitar Sectores", "twentytwenty" ),
		"choose_from_most_used" => __( "Escoger entre los más usados", "twentytwenty" ),
		"not_found" => __( "No se encontraron Sectores", "twentytwenty" ),
		"no_terms" => __( "No hay Sectores", "twentytwenty" ),
		"items_list_navigation" => __( "Navegación de lista de Sectores", "twentytwenty" ),
		"items_list" => __( "Lista de Sectores", "twentytwenty" ),
	];

	$args = [
		"label" => __( "Sectores", "twentytwenty" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'sector', 'with_front' => true, ],
		"show_admin_column" => true,
		"show_in_rest" => false,
		"rest_base" => "sector",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		];
	register_taxonomy( "sector", [ "actor" ], $args );

	/**
	 * Taxonomy: Alcances Territoriales.
	 */

	$labels = [
		"name" => __( "Alcances Territoriales", "twentytwenty" ),
		"singular_name" => __( "Alcance Territorial", "twentytwenty" ),
		"menu_name" => __( "Alcances Territoriales", "twentytwenty" ),
		"all_items" => __( "Todos los Alcances Territoriales", "twentytwenty" ),
		"edit_item" => __( "Editar Alcances Territoriales", "twentytwenty" ),
		"view_item" => __( "Ver Alcance Territorial", "twentytwenty" ),
		"update_item" => __( "Actualizar Alcance Territorial", "twentytwenty" ),
		"add_new_item" => __( "Añadir nuevo Alcance Territorial", "twentytwenty" ),
		"new_item_name" => __( "Nuevo nombre de Alcance Territorial", "twentytwenty" ),
		"parent_item" => __( "Alcance Territorial superior", "twentytwenty" ),
		"parent_item_colon" => __( "Alcance Territorial superior:", "twentytwenty" ),
		"search_items" => __( "Buscar Alcances Territoriales", "twentytwenty" ),
		"popular_items" => __( "Alcances Territoriales más usados", "twentytwenty" ),
		"separate_items_with_commas" => __( "Separar Alcances con comas", "twentytwenty" ),
		"add_or_remove_items" => __( "Añadir o quitar Alcances Territoriales", "twentytwenty" ),
		"choose_from_most_used" => __( "Escoger entre los más usados", "twentytwenty" ),
		"not_found" => __( "No encontrado", "twentytwenty" ),
		"no_terms" => __( "No hay Alcances Territoriales", "twentytwenty" ),
		"items_list_navigation" => __( "Navegación de lista de Alcances Territoriales", "twentytwenty" ),
		"items_list" => __( "Lista de Alcances Territoriales", "twentytwenty" ),
	];

	$args = [
		"label" => __( "Alcances Territoriales", "twentytwenty" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'alcance_territorial', 'with_front' => true, ],
		"show_admin_column" => true,
		"show_in_rest" => false,
		"rest_base" => "alcance_territorial",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		];
	register_taxonomy( "alcance_territorial", [ "actor" ], $args );

	/**
	 * Taxonomy: Tareas.
	 */

	$labels = [
		"name" => __( "Tareas", "twentytwenty" ),
		"singular_name" => __( "Tarea", "twentytwenty" ),
		"menu_name" => __( "Tareas", "twentytwenty" ),
		"all_items" => __( "Todas las Tareas", "twentytwenty" ),
		"edit_item" => __( "Editar Tarea", "twentytwenty" ),
		"view_item" => __( "Ver Tarea", "twentytwenty" ),
		"update_item" => __( "Actualizar nombre de Tarea", "twentytwenty" ),
		"add_new_item" => __( "Añadir nueva Tarea", "twentytwenty" ),
		"new_item_name" => __( "Nuevo nombre de Tarea", "twentytwenty" ),
		"parent_item" => __( "Tarea superior", "twentytwenty" ),
		"parent_item_colon" => __( "Tarea superior:", "twentytwenty" ),
		"search_items" => __( "Buscar Tareas", "twentytwenty" ),
		"popular_items" => __( "Tareas más usadas", "twentytwenty" ),
		"separate_items_with_commas" => __( "Separar Tareas con coma", "twentytwenty" ),
		"add_or_remove_items" => __( "Añadir o quitar Tareas", "twentytwenty" ),
		"choose_from_most_used" => __( "Escoger entre los más usados", "twentytwenty" ),
		"not_found" => __( "No encontrado", "twentytwenty" ),
		"no_terms" => __( "No hay Tareas", "twentytwenty" ),
		"items_list_navigation" => __( "Navegación de lista de Tareas", "twentytwenty" ),
		"items_list" => __( "Lista de Tareas", "twentytwenty" ),
	];

	$args = [
		"label" => __( "Tareas", "twentytwenty" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'tareas', 'with_front' => true, ],
		"show_admin_column" => true,
		"show_in_rest" => false,
		"rest_base" => "tareas",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		];
	register_taxonomy( "tareas", [ "actor" ], $args );

	/**
	 * Taxonomy: Acciones GRRD.
	 */

	$labels = [
		"name" => __( "Acciones GRRD", "twentytwenty" ),
		"singular_name" => __( "Acción GRRD", "twentytwenty" ),
		"menu_name" => __( "Acciones GRRD", "twentytwenty" ),
		"all_items" => __( "Todas las Acciones GRRD", "twentytwenty" ),
		"edit_item" => __( "Editar Acción GRRD", "twentytwenty" ),
		"view_item" => __( "Ver Acción GRRD", "twentytwenty" ),
		"update_item" => __( "Actualizar nombre de Acción GRRD", "twentytwenty" ),
		"add_new_item" => __( "Añadir nueva Acción GRRD", "twentytwenty" ),
		"new_item_name" => __( "Nuevo nombre de Acción GRRD", "twentytwenty" ),
		"parent_item" => __( "Acción GRRD superior", "twentytwenty" ),
		"parent_item_colon" => __( "Acción GRRD superior:", "twentytwenty" ),
		"search_items" => __( "Buscar Acciones GRRD", "twentytwenty" ),
		"popular_items" => __( "Acciones GRRD más usadas", "twentytwenty" ),
		"separate_items_with_commas" => __( "Separar Acciones GRRD con coma", "twentytwenty" ),
		"add_or_remove_items" => __( "Añadir o quitar Acciones GRRD", "twentytwenty" ),
		"choose_from_most_used" => __( "Escoger entre los más usados", "twentytwenty" ),
		"not_found" => __( "No encontrado", "twentytwenty" ),
		"no_terms" => __( "No hay Acciones GRRD", "twentytwenty" ),
		"items_list_navigation" => __( "Navegación de lista de Acciones GRRD", "twentytwenty" ),
		"items_list" => __( "Lista de Acciones GRRD", "twentytwenty" ),
	];

	$args = [
		"label" => __( "Acciones GRRD", "twentytwenty" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'acciones-grrd', 'with_front' => true, ],
		"show_admin_column" => true,
		"show_in_rest" => false,
		"rest_base" => "acciones-grrd",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		];
	register_taxonomy( "acciones_grrd", [ "actor" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes' );
