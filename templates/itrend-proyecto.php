<?php 
	
	$proyectotextfield = 'itrend_elproyecto_intro_text';
	$proyecto =itrend_get_option($proyectotextfield);

?>

<div class="container-fluid maxfluid">
	<div class="row">
		<div class="col m3 intro-presentation">
			<h1 class="itrend-section-title">
				<a href="<?php echo get_post_type_archive_link( 'actor' );?>"><img src="<?php echo plugin_dir_url( __FILE__ );?>../img/logo_mapa.svg" alt="Mapa de Actores"></a></h1>
		</div>
		<div class="col m9">
			<article id="el-proyecto" class="ficha-actor">
					<header class="actor-header">
						<div class="row info-header">
							<h1 class="actor-longname">El proyecto</h1>
							<div class="col m8 info-left">

								
							<?php echo apply_filters( 'the_content', $proyecto );?>								


							</div>
							
						</div>

						

					</header>

				
					
			</article>

		</div>
	</div>
</div>
