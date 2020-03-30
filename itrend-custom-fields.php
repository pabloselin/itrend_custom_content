<?php
/**
 * Funciones para generar los campos personalizados
 * 
 */



function itrend_populate_regiones() {
	$regiones = array(
		"Región de Arica y Parinacota",
		"Región de Tarapacá",
		"Región de Antofagasta",
		"Región de Atacama",
		"Región de Coquimbo",
		"Región de Valparaíso",
		"Región del Libertador General Bernardo O'Higgins",
		"Región del Maule",
		"Región del Biobío",
		"Región de Ñuble",
		"Región de la Araucanía",
		"Región de los Ríos",
		"Región de los Lagos",
		"Región Aysén del General Carlos Ibáñez del Campo",
		"Región de Magallanes y la Antártica Chilena",
		"Región Metropolitana de Santiago"
	);

	$regiones_options = array();

	foreach($regiones as $region) {
		$regiones_options[$region] = $region;
	}

	return $regiones_options;
}


function itrend_populate_comunas() {

	$regiones = array(
		//0 Arica y Parinacota
		"Región de Arica y Parinacota" => array("Arica", "Camarones", "Putre", "General Lagos"),
		//1 Tarapaca
		"Región de Tarapacá" => array("Iquique", "Alto Hospicio", "Pozo Almonte", "Camiña", "Colchane", "Huara", "Pica"),
		//2 Antofagasta
		"Región de Antofagasta" => array("Antofagasta", "Mejillones", "Sierra Gorda", "Taltal", "Calama", "Ollagüe", "San Pedro de Atacama", "Tocopilla", "María Elena"),
		//3 Atacama
		"Región de Atacama" => array("Copiapó", "Caldera", "Tierra Amarilla", "Chañaral", "Diego de Almagro", "Vallenar", "Alto del Carmen", "Freirina", "Huasco"),
		//4 Coquimbo
		"Región de Coquimbo" => array("La Serena", "Coquimbo", "Andacollo", "La Higuera", "Paiguano", "Vicuña", "Illapel", "Canela", "Los Vilos", "Salamanca", "Ovalle", "Combarbalá", "Monte Patria", "Punitaqui", "Río Hurtado"),
		//5 Valparaiso
		"Región de Valparaíso" => array("Valparaíso", "Casablanca", "Concón", "Juan Fernández", "Puchuncaví", "Quintero", "Viña del Mar", "Isla de Pascua", "Los Andes", "Calle Larga", "Rinconada", "San Esteban", "La Ligua", "Cabildo", "Papudo", "Petorca", "Zapallar", "Quillota", "Calera", "Hijuelas", "La Cruz", "Nogales", "San Antonio", "Algarrobo", "Cartagena", "El Quisco", "El Tabo", "Santo Domingo", "San Felipe", "Catemu", "Llaillay", "Panquehue", "Putaendo", "Santa María", "Quilpué", "Limache", "Olmué", "Villa Alemana"),
		//6 Libertador Bdo Ohiggins
		"Región del Libertador General Bernardo O'Higgins" => array("Rancagua", "Codegua", "Coinco", "Coltauco", "Doñihue", "Graneros", "Las Cabras", "Machalí", "Malloa", "Mostazal", "Olivar", "Peumo", "Pichidegua", "Quinta de Tilcoco", "Rengo", "Requínoa", "San Vicente", "Pichilemu", "La Estrella", "Litueche", "Marchihue", "Navidad", "Paredones", "San Fernando", "Chépica", "Chimbarongo", "Lolol", "Nancagua", "Palmilla", "Peralillo", "Placilla", "Pumanque", "Santa Cruz"),
		//7 Del Maule
		"Región del Maule" => array("Talca", "Constitución", "Curepto", "Empedrado", "Maule", "Pelarco", "Pencahue", "Río Claro", "San Clemente", "San Rafael", "Cauquenes", "Chanco", "Pelluhue", "Curicó", "Hualañé", "Licantén", "Molina", "Rauco", "Romeral", "Sagrada Familia", "Teno", "Vichuquén", "Linares", "Colbún", "Longaví", "Parral", "Retiro", "San Javier", "Villa Alegre", "Yerbas Buenas"),
		//8 Ñuble
		"Región de Ñuble" => array("Cobquecura", "Coelemu", "Ninhue", "Portezuelo", "Quirihue", "Ránquil", "Trehuaco", "Bulnes", "Chillán Viejo", "Chillán", "El Carmen", "Pemuco", "Pinto", "Quillón", "San Ignacio", "Yungay", "Coihueco", "Ñiquén", "San Carlos", "San Fabián", "San Nicolás"),
		//8 Biobio
		"Región del Biobío" => array("Concepción", "Coronel", "Chiguayante", "Florida", "Hualqui", "Lota", "Penco", "San Pedro de la Paz", "Santa Juana", "Talcahuano", "Tomé", "Hualpén", "Lebu", "Arauco", "Cañete", "Contulmo", "Curanilahue", "Los Álamos", "Tirúa", "Los Ángeles", "Antuco", "Cabrero", "Laja", "Mulchén", "Nacimiento", "Negrete", "Quilaco", "Quilleco", "San Rosendo", "Santa Bárbara", "Tucapel", "Yumbel", "Alto Biobío", "Bulnes", "Quillón", "Quirihue", "San Ignacio", "Treguaco", "Yungay"),
		//9 Araucania
		"Región de la Araucanía" => array("Temuco", "Carahue", "Cunco", "Curarrehue", "Freire", "Galvarino", "Gorbea", "Lautaro", "Loncoche", "Melipeuco", "Nueva Imperial", "Padre las Casas", "Perquenco", "Pitrufquén", "Pucón", "Saavedra", "Teodoro Schmidt", "Toltén", "Vilcún", "Villarrica", "Cholchol", "Angol", "Collipulli", "Curacautín", "Ercilla", "Lonquimay", "Los Sauces", "Lumaco", "Purén", "Renaico", "Traiguén", "Victoria"),
		//10 Los Rios
		"Región de los Ríos" => array("Valdivia", "Corral", "Lanco", "Los Lagos", "Máfil", "Mariquina", "Paillaco", "Panguipulli", "La Unión", "Futrono", "Lago Ranco", "Río Bueno"),
		//11 Los Lagos
		"Región de los Lagos" => array("Puerto Montt", "Calbuco", "Cochamó", "Fresia", "Frutillar", "Los Muermos", "Llanquihue", "Maullín", "Puerto Varas", "Castro", "Ancud", "Chonchi", "Curaco de Vélez", "Dalcahue", "Puqueldón", "Queilén", "Quellón", "Quemchi", "Quinchao", "Osorno", "Puerto Octay", "Purranque", "Puyehue", "Río Negro", "San Juan de la Costa", "San Pablo", "Chaitén", "Futaleufú", "Hualaihué", "Palena"),
		//12 Aysen
		"Región Aysén del General Carlos Ibáñez del Campo" => array("Coihaique", "Lago Verde", "Aisén", "Cisnes", "Guaitecas", "Cochrane", "O’Higgins", "Tortel", "Chile Chico", "Río Ibáñez"),
		//13 Magallanes
		"Región de Magallanes y la Antártica Chilena" => array("Punta Arenas", "Laguna Blanca", "Río Verde", "San Gregorio", "Cabo de Hornos (Ex Navarino)", "Antártica", "Porvenir", "Primavera", "Timaukel", "Natales", "Torres del Paine"),
		//14 Metropolitana
		"Región Metropolitana de Santiago" => array("Cerrillos", "Cerro Navia", "Conchalí", "El Bosque", "Estación Central", "Huechuraba", "Independencia", "La Cisterna", "La Florida", "La Granja", "La Pintana", "La Reina", "Las Condes", "Lo Barnechea", "Lo Espejo", "Lo Prado", "Macul", "Maipú", "Ñuñoa", "Pedro Aguirre Cerda", "Peñalolén", "Providencia", "Pudahuel", "Quilicura", "Quinta Normal", "Recoleta", "Renca", "San Joaquín", "San Miguel", "San Ramón","Santiago", "Vitacura", "Puente Alto", "Pirque", "San José de Maipo", "Colina", "Lampa", "TilTil", "San Bernardo", "Buin", "Calera de Tango", "Paine", "Melipilla", "Alhué", "Curacaví", "María Pinto", "San Pedro", "Talagante", "El Monte", "Isla de Maipo", "Padre Hurtado", "Peñaflor")
	);

$sortedcomunas = array();
foreach($regiones as $key=>$region) {
	sort($region);
	foreach($region as $comuna) {
		$sortedcomunas[$key][] = $comuna;
	}
}

return $sortedcomunas;
}

function itrend_selectbox_comunas() {
	$comunas = itrend_populate_comunas();
}

add_action( 'cmb2_init', 'itrend_cmb2_add_metabox' );
function itrend_cmb2_add_metabox() {

	$postid = $_GET['post'];
	$prefix = ITREND_PREFIX;

	$publicinfobox = new_cmb2_box( array(
		'id'           => $prefix . 'itrend_public_box',
		'title'        => __( 'Estado del contenido', 'itrend' ),
		'object_types' => array( 'actor' ),
		'context'      => 'side',
		'priority'     => 'default',
	) );

	$publicinfobox->add_field( array(
		'name' => __( '¿Publicar textos de Tareas y Acciones?', 'itrend' ),
		'id' => $prefix . 'public',
		'type' => 'checkbox',
		'desc'	=> 'Hacer visible para todos los usuarios las descripciones de tareas'
	) );

	$codigobox = new_cmb2_box( array(
		'id'           => $prefix . 'itrend_actor_codigo',
		'title'        => __( 'CÓDIGO O ABREVIACIÓN', 'itrend' ),
		'object_types' => array( 'actor' ),
		'context'      => 'normal',
		'priority'     => 'default',
	) );

	$codigobox->add_field( array(
		'name' => __( 'Código o Abreviación', 'itrend' ),
		'id' => $prefix . 'codigo',
		'type' => 'text_small',
	) );

	$institucionesbox = new_cmb2_box( array(
		'id'           => $prefix . 'itrend_actor_instituciones',
		'title'        => __( 'INSTITUCIONES', 'itrend' ),
		'object_types' => array( 'actor' ),
		'context'      => 'normal',
		'priority'     => 'default',
	));

	$institucionesbox->add_field( array(
		'name'    => __( 'Instituciones de cual depende', 'itrend' ),
		'desc'    => __( 'Aprieta en el signo + en las instituciones de la izquierda para asociarlas a esta organización. (También puedes arrastrarlas de la izquierda a la derecha)', 'itrend' ),
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

	$sectorbox = new_cmb2_box(
		array(
		'id'           => $prefix . 'itrend_tareas_sector',
		'title'        => __( 'SECTOR', 'itrend' ),
		'object_types' => array( 'actor' ),
		'context'      => 'normal',
		'priority'     => 'default',
		)
	);

	$sectorbox->add_field( array(
		'name'	=> __('Asignar Sector', 'itrend'),
		'id'	=> $prefix . 'sector_taxonomy_replacement',
		'type'	=> 'taxonomy_multicheck_hierarchical',
		'select_all_button' => false,
		'taxonomy'	=> 'sector',
		'text'	=> array(
			'no_terms_text' => __('No se encontraron sectores', 'itrend')
		),
		'query_args'	=> array(
			'hide_empty'	=> false
		),
		'remove_default'	=> true
	));

	$alcance_territorialbox = new_cmb2_box(
		array(
		'id'           => $prefix . 'itrend_tareas_alcance_territorial',
		'title'        => __( 'ALCANCE TERRITORIAL', 'itrend' ),
		'object_types' => array( 'actor' ),
		'context'      => 'normal',
		'priority'     => 'default',
		)
	);

	$alcance_territorialbox->add_field( array(
		'name'	=> __('Asignar Alcance Territorial', 'itrend'),
		'id'	=> $prefix . 'alcance_taxonomy_replacement',
		'type'	=> 'taxonomy_multicheck_hierarchical',
		'select_all_button' => false,
		'taxonomy'	=> 'alcance_territorial',
		'text'	=> array(
			'no_terms_text' => __('No se encontraron alcances territoriales', 'itrend')
		),
		'query_args'	=> array(
			'hide_empty'	=> false
		),
		'remove_default'	=> true
	));

	$misionbox = new_cmb2_box(
		array(
		'id'           => $prefix . 'itrend_mision',
		'title'        => __( '¿QUÉ HACE? (MISIÓN)', 'itrend' ),
		'object_types' => array( 'actor' ),
		'context'      => 'normal',
		'priority'     => 'default',
		)
	);

	$misionbox->add_field( array(
		'id'	=> $prefix . 'mision',
		'type'	=> 'wysiwyg',
		'name'	=> "¿Qué hace? (Misión)"
	));
	
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
			'childless'		=> true,
			'orderby'		=> 'meta_value_num',
			'meta_key'		=> ITREND_PREFIX . 'numero_tarea'
		),
		'remove_default'	=> true
	));

	foreach($tareas as $tarea) {

		$tarea_number = get_term_meta( $tarea->term_id, '_itrend_numero_tarea', true );
		$tareasbox->add_field( array(
			'name' => '<span>' . __( 'Descripción para tarea:', 'itrend' ) . '</span>' . $tarea_number . '. ' . $tarea->name,
			'id' => $prefix . 'descripcion_relacion_tarea_' . $tarea->slug,
			'desc'	=> $tarea->name,
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
		'childless'	 => true,
		'taxonomy'	 => 'acciones_grrd',
		'orderby'	 => 'meta_value_num',
		'meta_key'	 => ITREND_PREFIX . 'numero_accion',
		'order'		 => 'ASC'
	) );

	$accionesbox->add_field( array(
		'name'	=> __('Asignar Acción', 'itrend'),
		'id'	=> $prefix . 'acciones_taxonomy_replacement',
		'type'	=> 'taxonomy_multicheck',
		'select_all_button' => false,
		'taxonomy'	=> 'acciones_grrd',
		'query_args'	=> array(
			'hide_empty'	=> false,
			'childless'		=> true,
			'orderby'		=> 'meta_value_num',
			'meta_key'		=> ITREND_PREFIX . 'numero_accion'
		),
		'text'	=> array(
			'no_terms_text' => __('No se encontraron acciones', 'itrend')
		),
		'remove_default'	=> true
	));

	foreach($acciones as $accion) {
		$accionesbox->add_field( array(
			'name' => '<span>' . __( 'Descripción para Acción GRRD:' , 'itrend' ) . '</span>' . $accion->name,
			'id' => $prefix . 'descripcion_relacion_accion_' . $accion->slug,
			'type' => 'wysiwyg'
		));
	}

	$contactopersona = new_cmb2_box( array(
		'id'           => $prefix . 'itrend_contacto_persona',
		'title'        => __( 'PERSONA DE CONTACTO', 'itrend' ),
		'object_types' => array( 'actor' ),
		'context'      => 'normal',
		'priority'     => 'default',
	));

	$contactopersona->add_field( array(
		'name' => __( 'Nombre de Contacto', 'itrend' ),
		'id' => $prefix . 'contactopersona_nombre',
		'type' => 'text',
	) );

	$contactopersona->add_field( array(
		'name' => __( 'Cargo', 'itrend' ),
		'id' => $prefix . 'contactopersona_cargo',
		'type' => 'text',
	) );

	$contactopersona->add_field( array(
		'name' => __( 'Correo Personal', 'itrend' ),
		'id' => $prefix . 'contactopersona_correo',
		'type' => 'text_email',
		'repeatable'	=> true,
		'text'	=> array(
			'add_row_text' => 'Añadir otro correo'
		),
		'attributes' => array(
			'placeholder'	=> 'info@itrend.cl'
		)
	) );

	$contactopersona->add_field( array(
		'name' => __( 'Teléfono / Celular', 'itrend' ),
		'id' => $prefix . 'contactopersona_telefono',
		'type' => 'text',
		'repeatable'	=> true,
		'text'	=> array(
			'add_row_text'	=> 'Añadir otro teléfono'
		),
		'attributes' => array(
			'placeholder'	=> '56212345678'
		)
	) );

	$contacto = new_cmb2_box( array(
		'id'           => $prefix . 'itrend_contacto_actor',
		'title'        => __( 'UBICACIÓN Y CONTACTO INSTITUCIONAL', 'itrend' ),
		'object_types' => array( 'actor' ),
		'context'      => 'normal',
		'priority'     => 'default',
	) );

	$contacto->add_field( array(
		'name' => __( 'Correo Institucional', 'itrend' ),
		'id' => $prefix . 'contacto_correo',
		'type' => 'text_email',
		'repeatable'	=> true,
		'text'	=> array(
			'add_row_text' => 'Añadir otro correo'
		),
		'attributes' => array(
			'placeholder'	=> 'info@itrend.cl'
		)
	) );

	$contacto->add_field( array(
		'name' => __( 'Teléfono', 'itrend' ),
		'id' => $prefix . 'contacto_telefono',
		'type' => 'text',
		'repeatable'	=> true,
		'text'	=> array(
			'add_row_text'	=> 'Añadir otro teléfono'
		),
		'attributes' => array(
			'placeholder'	=> '56212345678'
		)
	) );

	
	$contacto->add_field( array(
		'name' => __( 'Sitio Web', 'itrend' ),
		'id' => $prefix . 'contacto_web',
		'type' => 'text_url',
		'attributes' => array(
			'placeholder'	=> 'https://itrend.cl'
		)
	) );

	$contacto->add_field( array(
		'name' => __( 'Región', 'itrend' ),
		'id' => $prefix . 'contacto_region',
		'type' => 'select',
		'show_option_none' => 'Escoge una región',
		'options_cb' => 'itrend_populate_regiones'
	) );

	
	$preselected_region = get_post_meta( $postid, $prefix . 'contacto_region', true );
	$preselected_comuna = get_post_meta( $postid, $prefix . 'contacto_comuna', true );
	
	if($preselected_region):

		$prepop_comunas = itrend_populate_comunas();
		$comunas_options_noajax = array();
		
		foreach($prepop_comunas[$preselected_region] as $precomunaoption) {
			$comunas_options_noajax[$precomunaoption] = $precomunaoption;
		}

		$contacto->add_field( array(
			'name' => __( 'Comuna', 'itrend' ),
			'id' => $prefix . 'contacto_comuna',
			'type' => 'select',
			'show_option_none' => false,
			'options' => $comunas_options_noajax
		) );

	else:


		$contacto->add_field( array(
			'name' => __( 'Comuna', 'itrend' ),
			'id' => $prefix . 'contacto_comuna',
			'type' => 'select',
			'show_option_none' => 'Escoge una región para ver las comunas',
			'options' => array(
			)
		) 
	);

	endif;
	

	$contacto->add_field( array(
		'name' => __( 'Dirección', 'itrend' ),
		'id' => $prefix . 'contacto_direccion',
		'type' => 'text',
		'attributes'	=> array(
			'placeholder'	=> 'Av. Vicuña Mackenna 4860'
		)
	) );
}

function itrend_tareas_fields( array $meta_boxes) {
	$prefix = '_itrend_';

	$meta_boxes['tareasbox'] = array(
		'id'           => $prefix . 'itrend_tareas_fields',
		'title'        => __( 'Información extra tarea', 'itrend' ),
		'object_types' => array( 'tareas' ),
		'context'      => 'normal',
		'priority'     => 'default',
		'fields'	   => array(
			array(
				'name'	=> __('Nombre oficial', 'itrend'),
				'type'	=> 'text',
				'id'	=> $prefix . 'nombre_oficial'
			),
			array(
				'name'	=> __('Número de tarea', 'itrend'),
				'type'	=> 'text_small',
				'id'	=> $prefix . 'numero_tarea'
				),
			)
		);

	$meta_boxes['accionesbox'] = array(
		'id'           => $prefix . 'itrend_acciones_fields',
		'title'        => __( 'Información extra acción GRRD', 'itrend' ),
		'object_types' => array( 'acciones_grrd' ),
		'context'      => 'normal',
		'priority'     => 'default',
		'fields'	   => array(
			array(
				'name'	=> __('Número de acción', 'itrend'),
				'type'	=> 'text_small',
				'id'	=> $prefix . 'numero_accion'
				),
			)
		);

	return $meta_boxes;
}

add_filter('cmb2-taxonomy_meta_boxes', 'itrend_tareas_fields');

/**
 * This snippet has been updated to reflect the official supporting of options pages by CMB2
 * in version 2.2.5.
 *
 * If you are using the old version of the options-page registration,
 * it is recommended you swtich to this method.
 */
add_action( 'cmb2_admin_init', 'itrend_register_theme_options_metabox' );
/**
 * Hook in and register a metabox to handle a theme options page and adds a menu item.
 */
function itrend_register_theme_options_metabox() {

	/**
	 * Registers options page menu item and form.
	 */
	$cmb_options = new_cmb2_box( array(
		'id'           => 'itrend_option_metabox',
		'title'        => esc_html__( 'Opciones de Visualizacion', 'itrend' ),
		'object_types' => array( 'options-page' ),

		/*
		 * The following parameters are specific to the options-page box
		 * Several of these parameters are passed along to add_menu_page()/add_submenu_page().
		 */

		'option_key'      => 'itrend_options', // The option key and admin menu page slug.
		// 'icon_url'        => 'dashicons-palmtree', // Menu icon. Only applicable if 'parent_slug' is left empty.
		// 'menu_title'      => esc_html__( 'Options', 'itrend' ), // Falls back to 'title' (above).
		 'parent_slug'     => 'edit.php?post_type=actor', // Make options page a submenu item of the themes menu.
		// 'capability'      => 'manage_options', // Cap required to view options-page.
		// 'position'        => 1, // Menu position. Only applicable if 'parent_slug' is left empty.
		// 'admin_menu_hook' => 'network_admin_menu', // 'network_admin_menu' to add network-level options page.
		// 'display_cb'      => false, // Override the options-page form output (CMB2_Hookup::options_page_output()).
		// 'save_button'     => esc_html__( 'Save Theme Options', 'itrend' ), // The text for the options-page save button. Defaults to 'Save'.
	) );

	/*
	 * Options fields ids only need
	 * to be unique within this box.
	 * Prefix is not needed.
	 */

	$cmb_options->add_field( array(
		'name' => __( 'Texto de presentación general (que sale al principio de la página)', 'itrend' ),
		'desc' => __( 'Texto con formato', 'itrend' ),
		'id'   => 'itrend_vis_mainintro_text',
		'type' => 'wysiwyg',
	) );

	$cmb_options->add_field( array(
		'name' => __( 'Texto de introduccion para Sección Visualización de Actores', 'itrend' ),
		'desc' => __( 'Texto con formato', 'itrend' ),
		'id'   => 'itrend_vis_intro_text',
		'type' => 'wysiwyg',
	) );


	$cmb_options->add_field( array(
		'name' => __( 'Texto de introduccion para Sección Buscador de Actores', 'itrend' ),
		'desc' => __( 'Texto con formato', 'itrend' ),
		'id'   => 'itrend_filtro_intro_text',
		'type' => 'wysiwyg',
	) );

	$cmb_options->add_field( array(
		'name' => __( 'Texto de introduccion para Ficha de Actores', 'itrend' ),
		'desc' => __( 'Texto con formato', 'itrend' ),
		'id'   => 'itrend_filtro_ficha_text',
		'type' => 'wysiwyg',
	) );

	$cmb_options->add_field( array(
		'name' => __( 'Texto para sección el proyecto', 'itrend' ),
		'desc' => __( 'Texto con formato', 'itrend' ),
		'id'   => 'itrend_elproyecto_intro_text',
		'type' => 'wysiwyg',
	) );

	$cmb_options->add_field( array(
		'name' => __( 'Email de contacto para revisiones', 'itrend' ),
		'desc' => __( 'E mail', 'itrend' ),
		'id'   => 'itrend_email',
		'type' => 'text_email',
	) );

	$cmb_options->add_field( array(
		'name' => __( 'Texto ayuda leyenda Tareas', 'itrend' ),
		'desc' => __( 'Tareas leyenda', 'itrend' ),
		'id'   => 'itrend_tareas_leyenda',
		'type' => 'textarea',
	) );

	$cmb_options->add_field( array(
		'name' => __( 'Texto ayuda leyenda Sectores', 'itrend' ),
		'desc' => __( 'Sectores leyenda', 'itrend' ),
		'id'   => 'itrend_sectores_leyenda',
		'type' => 'textarea',
	) );

	$cmb_options->add_field( array(
		'name' => __( 'Texto ayuda leyenda Acciones GRRD', 'itrend' ),
		'desc' => __( 'Acciones GRRD leyenda', 'itrend' ),
		'id'   => 'itrend_acciones_leyenda',
		'type' => 'textarea',
	) );


}

/**
 * Wrapper function around cmb2_get_option
 * @since  0.1.0
 * @param  string $key     Options array key
 * @param  mixed  $default Optional default value
 * @return mixed           Option value
 */
function itrend_get_option( $key = '', $default = false ) {
	if ( function_exists( 'cmb2_get_option' ) ) {
		// Use cmb2_get_option as it passes through some key filters.
		return cmb2_get_option( 'itrend_options', $key, $default );
	}

	// Fallback to get_option if CMB2 is not loaded yet.
	$opts = get_option( 'itrend_options', $default );

	$val = $default;

	if ( 'all' == $key ) {
		$val = $opts;
	} elseif ( is_array( $opts ) && array_key_exists( $key, $opts ) && false !== $opts[ $key ] ) {
		$val = $opts[ $key ];
	}

	return $val;
}