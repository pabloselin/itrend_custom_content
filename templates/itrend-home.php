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
				<a href="<?php echo get_post_type_archive_link( 'actor' )?>visualizacion" class="btn-home btn-action-mapa"><img src="<?php echo plugin_dir_url( __FILE__ );?>../img/red-01.svg" alt=""> Visualiza la red</a>
				<a href="<?php echo get_post_type_archive_link( 'actor' )?>buscador" class="btn-home btn-action-buscador"><img src="<?php echo plugin_dir_url( __FILE__ );?>../img/buscador-02.svg" alt=""> Busca un actor</a>
				<a href="<?php echo get_post_type_archive_link( 'actor' )?>" class="btn-home btn-action-proyecto"><img src="<?php echo plugin_dir_url( __FILE__ );?>../img/i-04.svg" alt=""> El proyecto</a>
			</div>

		</div>	
	</div>
</div>