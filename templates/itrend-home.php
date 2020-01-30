<?php 
	$options = get_option( 'itrend_options' );
?>

<div class="container" id="itrend-home">
	<div class="row">
		<div class="col m6">
			<h1 class="itrend-section-title">Mapa de Actores</h1>
			<div class="introtext">
				<?php echo $options['itrend_vis_mainintro_text'];?>
			</div>
		</div>
		<div class="col m6 logos-section">
			<img style="margin-top: 86px;" class="logo-home" src="<?php echo plugin_dir_url( __FILE__ );?>../img/ConectaResiliencia.png" alt="Conecta Resiliencia">
			<img style="max-width: 240px;" class="logo-home" src="<?php echo plugin_dir_url(__FILE__);?>../img/logo_itrend.png" alt="Itrend">
		</div>	
	</div>
	<div class="row row-buttons">
		<div class="col m6">
			<a href="<?php echo add_query_arg('f', 'visualizacion', get_post_type_archive_link( 'actor' ));?>" class="btn-arrow btn-action-mapa"> Mapa de actores</a>
		</div>
		<div class="col m6">
			<a href="<?php echo add_query_arg('f', 'filtro', get_post_type_archive_link( 'actor' ));?>" class="btn-arrow btn-action-buscador"> Buscador de actores</a>
		</div>
	</div>
</div>