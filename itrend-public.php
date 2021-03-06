<?php
// Public Frontend stuff

function itrend_enqueue_filters_js() {
	global $post;
	if( is_a( $post, 'WP_Post') && has_shortcode( $post->post_content, 'itrend_actor_filters' ) || is_a( $post, 'WP_Post') && is_singular('actor') || is_post_type_archive('actor') ) {
		wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery', 'https://code.jquery.com/jquery-3.4.1.slim.min.js', array(), '3.4.1', false );
		wp_enqueue_script( 'jquery' );
		wp_enqueue_style( 'itrend_filters_styles', plugin_dir_url( __FILE__ ) . 'css/itrend-filters-styles.css' , array(), ITREND_PLUGIN_VERSION, 'screen' );
		//wp_enqueue_style( 'itrend_bootstrap_grid', plugin_dir_url( __FILE__ ) . 'vendor/bootstrap-4.4.1-dist/css/bootstrap-grid.min.css' , array(), ITREND_PLUGIN_VERSION, 'screen' );
		if($_GET['f'] != 'visualizacion'):
			wp_enqueue_style( 'itrend_bootstrap_css', plugin_dir_url( __FILE__ ) . 'vendor/bootstrap-4.4.1-dist/css/bootstrap.min.css' , array(), ITREND_PLUGIN_VERSION, 'screen' );
			if(has_shortcode( $post->post_content, 'itrend_actor_filters' ) || is_post_type_archive('actor') ):
			
				wp_enqueue_script( 'itrend_filters_scripts', plugin_dir_url(__FILE__) . 'js/itrend-filters-scripts.js' , array('squirrely'), ITREND_PLUGIN_VERSION, false );
				wp_enqueue_script( 'itrend_bootstrap_js', plugin_dir_url(__FILE__) . 'vendor/bootstrap-4.4.1-dist/js/bootstrap.min.js' , array('jquery', 'popper'), ITREND_PLUGIN_VERSION, false );
				wp_enqueue_script( 'squirrely', 'https://cdn.jsdelivr.net/npm/squirrelly@7.5.0/dist/squirrelly.min.js', array(), false, false );
				wp_localize_script( 'itrend_filters_scripts', 'itrend_filters', array(
					'taxonomies' 	=> itrend_relevant_taxonomies(),
					'nonce'	  		=> wp_create_nonce( 'wp_rest' ),
					'rest_url'	  	=> rest_url( 'itrend/v1/actores' ),
					'search_url'	=> rest_url('relevanssi/v1/search'),
					'ids_url'		=> rest_url('itrend/v1/ids')
				));
			
			endif;

		endif;

		wp_enqueue_script( 'fontawesome', 'https://kit.fontawesome.com/14643ca681.js', array(), '5', false );
		wp_enqueue_script( 'popper', 'https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js', array(), false, false );
		
	}
}

add_action( 'wp_enqueue_scripts', 'itrend_enqueue_filters_js', 10, 0 );


//Filter the content for single actor posts
function itrend_filter_single_actor( $single )  {
	global $wp_query, $post;

	if(is_singular( 'actor' )) {
		
		$single = plugin_dir_path( __FILE__ ) . 'templates/itrend-ficha-actor.php';	

	} elseif(has_shortcode( $post->post_content, 'itrend_actor_filters' )) {

		$single = plugin_dir_path( __FILE__ ) . 'templates/itrend-filters-frontend.php';

	}

	return $single;
}

add_filter( 'single_template', 'itrend_filter_single_actor',10, 1 );

//Select options

function itrend_select_taxonomy_field( $taxonomy, $childonly = false ) {

	$output = '<form action="">';
	$output .= '<div class="itrend_select_taxonomy" name="itrend_actor_filters_' . $taxonomy . '" id="itrend_actor_filters_' . $taxonomy . '">';
	
	$options = array();
	$args = array(
		'hide_empty'	=> false,
	);

	if($childonly == false) {
		$args['parent'] = 0;
		$args['childless'] = false;

	} else {
		$args['childless'] 	= true;
		$args['orderby']	= 'meta_value_num';
		$args['meta_key']	= ITREND_PREFIX . 'numero_tarea';
	}

	$maintaxonomy = get_terms($taxonomy, $args);

	foreach( $maintaxonomy as $maintax ) {
		$options[] = itrend_render_checkbox_field($taxonomy, $maintax->slug, $maintax->name, false);

		
		$children = get_term_children( $maintax->term_id, $taxonomy );

		if($children):
			foreach($children as $child):
				$term = get_term_by( 'id', $child, $taxonomy );
				$options[] = itrend_render_checkbox_field( $taxonomy, $term->slug, $term->name, true);
			endforeach;
		endif;

	}

	$output .= implode('', $options);
	$output .= '</form>';
	$output .= '</div>';

	return $output;
}

function itrend_render_checkbox_field($taxonomy, $slug, $name, $child = false) {
	$term = get_term_by( 'slug', $slug, $taxonomy );
	$term_meta = get_term_meta( $term->term_id, ITREND_PREFIX . 'numero_tarea', true );

	$name = ($child == true ) ? $name : mb_strtoupper($name);
	
	if($term_meta) {
		$final_name = $term_meta . '.' . $name;
	} else {
		$final_name = $name;
	}

	return '	<div class="form-group form-check ' . ($child == true ? 'child-term' : 'parent-term') . '">
	<input data-termlabel="' . $name . '" data-tax="' . $taxonomy . '" data-term="' . $slug . '" class="form-check-input" type="checkbox" value="' . $slug . '" id="check-' . $slug . '"></input>
	<label class="form-check-label" for="check-' .$slug .'">' . $final_name . ' <span class="termcount-' . ($term->count > 0 ? 'some' : 'none') . '">(' . $term->count . ')</span></label>
	</div>';
}


//Main Output for filters
function itrend_actor_filters_output_shortcode( $atts ) {
	ob_start();
	
	include( plugin_dir_path( __FILE__ ) . 'templates/itrend-filters-frontend.php');	
	
	$content = ob_get_clean();
	
	return $content;
}

add_shortcode( 'itrend_actor_filters', 'itrend_actor_filters_output_shortcode' );

function itrend_actor_archive_filter( $archive_template ) {

	if(is_post_type_archive('actor')) {
		$archive_template = plugin_dir_path( __FILE__ ) . 'templates/itrend-filters-frontend.php';
	}

	return $archive_template;
}

add_filter('archive_template', 'itrend_actor_archive_filter', 10, 1);

function itrend_filter_actor_tax( $request ) {

	$args = array(
		'post_type' => 'actor',
		'posts_per_page' => -1,
	);

	$taxonomies = itrend_relevant_taxonomies();
	

	foreach($taxonomies as $taxonomy) {
		if(isset($request[$taxonomy])):
			$args['tax_query'][] = array(
				'taxonomy' 	=> $taxonomy,
				'field'		=> 'slug',
				'terms'		=> explode(',', $request[$taxonomy])
			);
		endif;
	}
	//var_dump($args);

	$actores = get_posts($args);

	$structured_actores = itrend_build_table_row($actores);

	return $structured_actores;
}

function itrend_filter_ids( $request ) {
	
	$ids = explode(',', $request['items']);

	$args = array(
		'post_type'			=> 'actor',
		'posts_per_page'	=> -1,
		'post__in'			=> $ids
	);

	$posts = get_posts($args);

	$structured_search = itrend_build_table_row($posts);
	

	return $structured_search;
}

function itrend_build_table_row( $postobjects ) {
	
	$structured_objects = array();
	
	foreach( $postobjects as $postobject) {
		$structured_objects[] = array(
			'post_title' 			 => $postobject->post_title,
			'permalink'	 			 => get_permalink( $postobject->ID ),
			'postmeta'				 => itrend_actor_postmeta( $postobject->ID ),
			'alcance_territorial' 	 => itrend_plain_terms('alcance_territorial', $postobject->ID),
			'sector'				 => itrend_plain_terms('sector', $postobject->ID),
			'tareas'				 => itrend_plain_terms('tareas', $postobject->ID),
			'acciones_grrd'			 => itrend_plain_terms('acciones_grrd', $postobject->ID)
		);	
	}

	return $structured_objects; 
}

function itrend_actor_postmeta( $postid ) {

	$fields_data = array();

	$fields = array(
		'codigo',
		'institucion_depende',
		'mision',
		'resumen_rol',
		'contacto_correo',
		'contacto_telefono',
		'contacto_web',
		'contacto_region',
		'contacto_comuna',
		'contacto_direccion'
	);

	$private_fields = array(
		'contactopersona_nombre',
		'contactopersona_cargo',
		'contactopersona_correo',
		'contactopersona_telefono',

	);

	$acciones = get_terms( array(
		'hide_empty' => false,
		'childless'	 => true,
		'taxonomy'	 => 'acciones_grrd',
		'orderby'	 => 'meta_value_num',
		'meta_key'	 => ITREND_PREFIX . 'numero_accion',
		'order'		 => 'ASC'
	) );


	$tareas = get_terms( array(
		'hide_empty' => false,
		'taxonomy'	 => 'tareas'
	) );

	$conditional_fields = array();

	foreach( $acciones as $accion ) {
		$conditional_fields[] = 'descripcion_relacion_accion' . $accion->slug;
	}

	foreach( $tareas as $tarea ) {
		$conditional_fields[] = 'descripcion_relacion_tarea' . $tarea->slug;
	}

	foreach($fields as $key=>$field) {
		$fields_data[$field] = get_post_meta($postid, ITREND_PREFIX . $field, true);
	}

	return $fields_data;
}

function itrend_plain_terms( $taxonomy, $postid ) {
	$terms = get_the_terms( $postid, $taxonomy );
	$termArray = [];
	
	foreach($terms as $term) {
		$termArray[] = $term->name;
	}

	return implode(', ', $termArray);
}

function itrend_filter_actor_field( $field, $value ) {
	return false;
}

function itrend_actores_filter_arguments() {
	$args = array();

	$taxonomies = itrend_relevant_taxonomies();

	foreach($taxonomies as $taxonomy) {
		$args[$taxonomy] = array(
			'description' => 'Filtros para los actores con ' . $taxonomy,
			'type'		  => 'string'
		);	
	}
	

	return $args;
}

function itrend_endpoint() {
	register_rest_route( 'itrend/v1', '/actores', array(
		'methods' 	=> WP_REST_Server::READABLE,
		'callback'	=> 'itrend_filter_actor_tax'
	));
	register_rest_route( 'itrend/v1', '/actores/(?P<filters>[a-zA-Z0-9-]+)', array(
		'methods' 	=> WP_REST_Server::READABLE,
		'callback'	=> 'itrend_filter_actor_tax',
		'arguments'	=> itrend_actores_filter_arguments()
	));

	register_rest_route( 'itrend/v1', '/ids', array(
		'methods'	=> WP_REST_Server::READABLE,
		'callback'	=> 'itrend_filter_ids'
	));
	register_rest_route( 'itrend/v1', '/ids/?items=(?P<ids>[a-zA-Z0-9-]+)', array(
		'methods'	=> WP_REST_Server::READABLE,
		'callback'	=> 'itrend_filter_ids'
	));
}

add_action( 'rest_api_init', 'itrend_endpoint' );