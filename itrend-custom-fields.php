<?php

add_action( 'cmb2_init', 'itrend_cmb2_add_metabox' );
function itrend_cmb2_add_metabox() {

	$postid = $_GET['post'];

	$prefix = '_itrend_';

	$cmb = new_cmb2_box( array(
		'id'           => $prefix . 'itrend',
		'title'        => __( 'Campos adicionales actor', 'itrend' ),
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

	$cmb->add_field( array(
		'name' => __( 'Información de contacto', 'itrend' ),
		'id' => $prefix . 'contacto_section_title',
		'type' => 'title',
	) );

	$cmb->add_field( array(
		'name' => __( 'Nombre de Contacto', 'itrend' ),
		'id' => $prefix . 'contacto_nombre',
		'type' => 'text',
	) );

	$cmb->add_field( array(
		'name' => __( 'Cargo', 'itrend' ),
		'id' => $prefix . 'contacto_cargo',
		'type' => 'text',
	) );

	$cmb->add_field( array(
		'name' => __( 'Teléfono', 'itrend' ),
		'id' => $prefix . 'contacto_telefono',
		'type' => 'text',
		'default' => '+56',
		'repeatable'	=> true,
		'text'	=> array(
			'add_row_text'	=> 'Añadir otro teléfono'
		)
	) );

	$cmb->add_field( array(
		'name' => __( 'Región', 'itrend' ),
		'id' => $prefix . 'contacto_region',
		'type' => 'text'
	) );

	$cmb->add_field( array(
		'name' => __( 'Comuna', 'itrend' ),
		'id' => $prefix . 'contacto_comuna',
		'type' => 'text'
	) );

	$cmb->add_field( array(
		'name' => __( 'Dirección', 'itrend' ),
		'id' => $prefix . 'contacto_direccion',
		'type' => 'text'
	) );

	$cmb->add_field( array(
		'name' => __( 'Correo', 'itrend' ),
		'id' => $prefix . 'contacto_correo',
		'type' => 'text_email',
		'repeatable'	=> true,
		'text'	=> array(
			'add_row_text' => 'Añadir otro correo'
		)
	) );

	$cmb->add_field( array(
		'name' => __( 'Sitio Web', 'itrend' ),
		'id' => $prefix . 'contacto_web',
		'type' => 'text_url',
	) );

	$cmb->add_field( array(
		'name' => __( 'Resumen Rol en acciones de GRRD', 'itrend' ),
		'id' => $prefix . 'resumen_rol',
		'type' => 'wysiwyg',
	) );

	$cmb->add_field( array(
		'name' => __( 'Acciones de GRRD', 'itrend' ),
		'id' => $prefix . 'accionesgrrd_section_title',
		'type' => 'title',
	) );

	$cmb->add_field( array(
		'name' => __( 'Acciones GRRD Prevención', 'itrend' ),
		'id' => $prefix . 'acciones_prevencion',
		'type' => 'multicheck',
		'select_all_button' => false,
		'options' => array(
			'anticipacion' => __( 'Anticipación', 'itrend' ),
			'mitigacion' => __( 'Mitigación', 'itrend' ),
			'preparacion' => __( 'Preparación', 'itrend' ),
			'alerta' => __( 'Alerta', 'itrend' ),
		),
	) );

	$cmb->add_field( array(
		'name' => __( 'Descripción acción de prevención: Anticipación', 'itrend' ),
		'id' => $prefix . 'descripcion_accion_prevencion_anticipacion',
		'type' => 'wysiwyg'
	));

	$cmb->add_field( array(
		'name' => __( 'Descripción acción de prevención: Mitigación', 'itrend' ),
		'id' => $prefix . 'descripcion_accion_prevencion_mitigacion',
		'type' => 'wysiwyg'
	));

	$cmb->add_field( array(
		'name' => __( 'Descripción acción de prevención: Preparación', 'itrend' ),
		'id' => $prefix . 'descripcion_accion_prevencion_preparacion',
		'type' => 'wysiwyg'
	));

	$cmb->add_field( array(
		'name' => __( 'Descripción acción de prevención: Alerta', 'itrend' ),
		'id' => $prefix . 'descripcion_accion_prevencion_alerta',
		'type' => 'wysiwyg'
	));

	$cmb->add_field( array(
		'name' => __( 'Acciones GRRD Respuesta', 'itrend' ),
		'id' => $prefix . 'acciones_respuesta',
		'type' => 'multicheck',
		'select_all_button' => false,
		'options' => array(
			'alarma' => __( 'Alarma', 'itrend' ),
			//El guion se convierte en dash en la clase correspondiente
			'operaciones-emergencia' => __( 'Operaciones de emergencia', 'itrend' ),
		),
	) );

	$cmb->add_field( array(
		'name' => __( 'Descripción acción de respuesta: Alarma', 'itrend' ),
		'id' => $prefix . 'descripcion_accion_respuesta_alarma',
		'type' => 'wysiwyg'
	));

	$cmb->add_field( array(
		'name' => __( 'Descripción acción de respuesta: Operación de emergencia', 'itrend' ),
		'id' => $prefix . 'descripcion_accion_respuesta_operaciones_emergencia',
		'type' => 'wysiwyg'
	));

	$cmb->add_field( array(
		'name' => __( 'Acciones GRRD Recuperación', 'itrend' ),
		'id' => $prefix . 'acciones_recuperacion',
		'type' => 'multicheck',
		'select_all_button' => false,
		'options' => array(
			'rehabilitacion' => __( 'Rehabilitación', 'itrend' ),
			'reconstruccion' => __( 'Reconstrucción', 'itrend' ),
		),
	) );

	$cmb->add_field( array(
		'name' => __( 'Descripción acción de recuperación: Rehabilitación', 'itrend' ),
		'id' => $prefix . 'descripcion_accion_recuperacion_rehabilitacion',
		'type' => 'wysiwyg'
	));

	$cmb->add_field( array(
		'name' => __( 'Descripción acción de recuperación: Reconstrucción', 'itrend' ),
		'id' => $prefix . 'descripcion_accion_recuperacion_reconstruccion',
		'type' => 'wysiwyg'
	));

	// Tareas conditional fields
	$tareas = get_terms( array(
							'hide_empty' => false,
							'taxonomy'	 => 'tareas'
						) );

	$cmb->add_field( array(
		'name'	=> __('Tareas', 'itrend'),
		'id'	=> $prefix . 'tareas_title',
		'type'	=> 'title'
	));

	$cmb->add_field( array(
		'name'	=> __('Asignar Tarea', 'itrend'),
		'id'	=> $prefix . 'tareas_taxonomy_replacement',
		'type'	=> 'taxonomy_multicheck',
		'select_all_button' => false,
		'taxonomy'	=> 'tareas',
		'text'	=> array(
			'no_terms_text' => __('No se encontraron tareas', 'itrend')
		),
		'remove_default'	=> true
	));

	foreach($tareas as $tarea) {

			$cmb->add_field( array(
				'name' => __( 'Descripción para tarea: ' . $tarea->name , 'itrend' ),
				'id' => $prefix . 'descripcion_relacion_tarea_' . $tarea->slug,
				'type' => 'wysiwyg'
			));

	}
}