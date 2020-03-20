<?php 
	$options = get_option( 'itrend_options' );
?>

<div class="container" id="itrend-home">
	<div class="row flex-row">
		<div class="col m4">
			<h1 class="itrend-section-title"><img src="<?php echo plugin_dir_url( __FILE__ );?>../img/logo_mapa.svg" alt="Mapa de Actores"></h1>
			<div class="introtext">
				<?php echo apply_filters('the_content', $options['itrend_vis_mainintro_text']);?>
			</div>
		</div>
		<div class="col m8 buttons-section">
			
			<div class="links-stuff">
				<a href="<?php echo add_query_arg('f', 'visualizacion', get_post_type_archive_link( 'actor' ));?>" class="btn-large btn-action-mapa"> Mapa de actores</a>
				<a href="<?php echo add_query_arg('f', 'filtro', get_post_type_archive_link( 'actor' ));?>" class="btn-large btn-action-buscador"> Buscador de actores</a>
				<a href="<?php echo add_query_arg('f', 'visualizacion', get_post_type_archive_link( 'actor' ));?>" class="btn-large btn-action-proyecto"> El proyecto</a>
			</div>

		</div>	
	</div>
</div>