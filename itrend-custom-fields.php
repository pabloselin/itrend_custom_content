<?php

add_action( 'cmb2_init', 'itrend_cmb2_add_metabox' );
function itrend_cmb2_add_metabox() {

	$postid = $_GET['post'];

	$prefix = '_itrend_';

	$cmb = new_cmb2_box( array(
		'id'           => $prefix . 'itrend_actor_instituciones',
		'title'        => __( 'INSTITUCIONES', 'itrend' ),
		'object_types' => array( 'actor' ),
		'context'      => 'normal',
		'priority'     => 'default',
	) );

	$cmb->add_field( array(
		'name' => __( 'Código o Abreviación', 'itrend' ),
		'id' => $prefix . 'codigo',
		'type' => 'text_small',
	) );

	$cmb->add_field( array(
		'name'    => __( 'Instituciones de cual depende', 'itrend' ),
		'desc'    => __( 'Arrastra las instituciones desde la izquierda a la derecha para asociarlas a esta organización.', 'itrend' ),
		'id'      =>  $prefix . 'institucion_depende',
		'type'    => 'custom_attached_posts',
		'column'  => true, // Output in the admin post-listing as a custom column. https://github.com/CMB2/CMB2/wiki/Field-Parameters#column
		'options' => array(
			'show_thumbnails' => false, // Show thumbnails on the left
			'filter_boxes'    => true, // Show a text box for filtering the results
			'query_args'      => array(
				'posts_per_page' => 10,
				'post_type'      => 'actor',
			), // override the get_posts args
		),
	) );

	$contacto = new_cmb2_box( array(
		'id'           => $prefix . 'itrend_contacto_actor',
		'title'        => __( 'INFORMACION DE CONTACTO', 'itrend' ),
		'object_types' => array( 'actor' ),
		'context'      => 'normal',
		'priority'     => 'default',
	) );

	$contacto->add_field( array(
		'name' => __( 'Nombre de Contacto', 'itrend' ),
		'id' => $prefix . 'contacto_nombre',
		'type' => 'text',
	) );

	$contacto->add_field( array(
		'name' => __( 'Cargo', 'itrend' ),
		'id' => $prefix . 'contacto_cargo',
		'type' => 'text',
	) );

	$contacto->add_field( array(
		'name' => __( 'Teléfono', 'itrend' ),
		'id' => $prefix . 'contacto_telefono',
		'type' => 'text',
		'default' => '+56',
		'repeatable'	=> true,
		'text'	=> array(
			'add_row_text'	=> 'Añadir otro teléfono'
		)
	) );

	$contacto->add_field( array(
		'name' => __( 'Región', 'itrend' ),
		'id' => $prefix . 'contacto_region',
		'type' => 'text'
	) );

	$contacto->add_field( array(
		'name' => __( 'Comuna', 'itrend' ),
		'id' => $prefix . 'contacto_comuna',
		'type' => 'text'
	) );

	$contacto->add_field( array(
		'name' => __( 'Dirección', 'itrend' ),
		'id' => $prefix . 'contacto_direccion',
		'type' => 'text'
	) );

	$contacto->add_field( array(
		'name' => __( 'Correo', 'itrend' ),
		'id' => $prefix . 'contacto_correo',
		'type' => 'text_email',
		'repeatable'	=> true,
		'text'	=> array(
			'add_row_text' => 'Añadir otro correo'
		)
	) );

	$contacto->add_field( array(
		'name' => __( 'Sitio Web', 'itrend' ),
		'id' => $prefix . 'contacto_web',
		'type' => 'text_url',
	) );

	
	// Tareas conditional fields

	$tareasbox = new_cmb2_box( array(
		'id'           => $prefix . 'itrend_tareas_actor',
		'title'        => __( 'TAREAS', 'itrend' ),
		'object_types' => array( 'actor' ),
		'context'      => 'normal',
		'priority'     => 'default',
	) );

	$tareas = get_terms( array(
							'hide_empty' => false,
							'taxonomy'	 => 'tareas'
						) );

	$tareasbox->add_field( array(
		'name'	=> __('Asignar Tarea', 'itrend'),
		'id'	=> $prefix . 'tareas_taxonomy_replacement',
		'type'	=> 'taxonomy_multicheck',
		'select_all_button' => false,
		'taxonomy'	=> 'tareas',
		'text'	=> array(
			'no_terms_text' => __('No se encontraron tareas', 'itrend')
		),
		'query_args'	=> array(
			'hide_empty'	=> false,
			'childless'		=> true
		),
		'remove_default'	=> true
	));

	foreach($tareas as $tarea) {

			$tareasbox->add_field( array(
				'name' => __( 'Descripción para tarea: ' . $tarea->name , 'itrend' ),
				'id' => $prefix . 'descripcion_relacion_tarea_' . $tarea->slug,
				'type' => 'wysiwyg'
			));

	}

	// ACCIONES conditional fields

	$accionesbox = new_cmb2_box( array(
		'id'           => $prefix . 'itrend_acciones_actor',
		'title'        => __( 'ACCIONES GRRD', 'itrend' ),
		'object_types' => array( 'actor' ),
		'context'      => 'normal',
		'priority'     => 'default',
	) );

	$accionesbox->add_field( array(
		'name' => __( 'Resumen Rol en acciones de GRRD', 'itrend' ),
		'id' => $prefix . 'resumen_rol',
		'type' => 'wysiwyg',
	) );

	$acciones = get_terms( array(
							'hide_empty' => false,
							'taxonomy'	 => 'acciones_grrd'
						) );

	$accionesbox->add_field( array(
		'name'	=> __('Asignar Acción', 'itrend'),
		'id'	=> $prefix . 'acciones_taxonomy_replacement',
		'type'	=> 'taxonomy_multicheck',
		'select_all_button' => false,
		'taxonomy'	=> 'acciones_grrd',
		'query_args'	=> array(
			'hide_empty'	=> false,
			'childless'		=> true
		),
		'text'	=> array(
			'no_terms_text' => __('No se encontraron acciones', 'itrend')
		),
		'remove_default'	=> true
	));

	foreach($acciones as $accion) {
			$accionesbox->add_field( array(
				'name' => __( 'Descripción para Acción GRRD: ' . $accion->name , 'itrend' ),
				'id' => $prefix . 'descripcion_relacion_accion_' . $accion->slug,
				'type' => 'wysiwyg'
			));
	}
}