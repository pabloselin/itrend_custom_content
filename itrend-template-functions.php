<?php
/*
* Funciones de ayuda para obtener la información
*
*/

function itrend_get_actor_fields(  ) {
	//Devuelve todos los nombres de los campos personalizados

	$prefix = '_itrend_';

	$actorfields = array(
		'codigo', //Texto unico
		'mision', // Texto con formato
		'institucion_depende', // Array de IDS
		'contactopersona_nombre', //Texto unico
		'contactopersona_cargo', //Texto unico
		'contactopersona_correo', //Texto multiple
		'contactopersona_telefono', //Texto multiple
		'contacto_nombre', //Texto unico
		'contacto_cargo', //Texto unico
		'contacto_telefono', //Texto multiple
		'contacto_region',//Valor de select input,
		'contacto_comuna', //Valor de select input,
		'contacto_direccion', //Texto unico,
		'contacto_correo', // Texto multiple,
		'contacto_web', // Texto unico
	);

	//Descriptores para acciones y tareas, variables segun la cantidad de acciones y tareas que se hayan creado, dependientes del slug de cada termino
	//Texto con formato (wysiwyg) utilizar filtro the_content
	$tareas = get_terms('tareas', array(
									'hide_empty' => false,
									'childless'	 => true
									 ));

	foreach($tareas as $tarea):
		array_push($actorfields, 'descripcion_relacion_tarea_' . $tarea->slug);
	endforeach;

	$acciones = get_terms('acciones_grrd', array(
									'hide_empty' => false,
									'childless'	 => true
									 ));

	foreach($acciones as $accion):
		array_push($actorfields, 'descripcion_relacion_accion_' . $tarea->slug);
	endforeach;

	return $actorfields;
}

function itrend_get_actor_metadata( $actorid, $field = null) {
	// Devuelve los campos o el campo asociado a un actor basado en su ID
	// Ejemplo: itrend_get_actor_metadata(120) 
	// Ejemplo: itrend_get_actor_metadata(120, 'codigo')

	$prefix = '_itrend_';
	$fieldnames = itrend_get_actor_fields();

	if($field != null):
		$fields_data = get_post_meta($actorid, $prefix . $fieldnames[$field], true);
	else:
		$fields_data = array();
		foreach($fieldnames as $fieldname) {
			$fields_data[$fieldname] = get_post_meta($actorid, $prefix . $fieldnames[$field], true);
		}
	endif;

	if($fields_data):
		return $fields_data;
	else:
		return false;
	endif;
}


function itrend_actor_fields_shortcode( $atts ) {
	
	// Permite tener la informacion en el frontend rapidamente
	// Ejemplo [itrend_actor id=120 all=true field=contactopersona_correo]
	// TODO: Darle formato a la informacion que se devuelve

	$a = shortcode_atts( array(
		'field' => '',
		'id' => '',
		'all' => 'false'
	), $atts );

	if($a['all'] == true):
		$fields = itrend_get_actor_metadata($a['id']);
	else:
		$fields = itrend_get_actor_metadata($a['id'], $a['field']);
	endif;

	return $fields;
}

