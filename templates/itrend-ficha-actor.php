<?php include( plugin_dir_path( __FILE__ ) . '/itrend-header.php');?>

<article id="ficha-actor-<?php the_ID();?>" class="ficha-actor">
	<div class="container">
		<header class="actor-header">
			<h2 class="codigo"><?php echo get_post_meta($post->ID, ITREND_PREFIX . 'codigo', true);?></h2>
			<h1 class="actor-longname"><?php the_title();?></h1>
			<div class="row info-header">
				<div class="col m6 info-left">
					
					<div class="sector">
						Sector/es: <?php echo itrend_plain_terms('sector', $post->ID);?>
					</div>

					<?php 
						$instituciones = get_post_meta( $post->ID, ITREND_PREFIX . 'institucion_depende', true);
						
						if($instituciones):?>
							Depende de: <br>
							<?php
							foreach($instituciones as $institucion):?>
							
							
								<p class="institucion-depende">
									<a href="<?php echo get_permalink($institucion);?>">
										<?php echo get_the_title($institucion);?>	
									</a>
								</p>
							

							<?php
							endforeach;
						endif;
					?>
					

					<div class="mision-content">
					<?php 
						$mision = get_post_meta( $post->ID, ITREND_PREFIX . 'mision', true );
						echo apply_filters( 'the_content', $mision );
					?>
					</div>
				</div>
				<div class="col m6 info-right itrend-datos-contacto">
					<?php echo itrend_contact_field( $post->ID, ITREND_PREFIX . 'contacto_correo', 'fa-envelope', false, false );?>
					<?php echo itrend_contact_field( $post->ID, ITREND_PREFIX . 'contacto_telefono', 'fa-mobile', false, false);?>
					<?php echo itrend_contact_field( $post->ID, ITREND_PREFIX . 'contacto_web', 'fa-globe', true, true);?>
					<?php echo itrend_contact_field( $post->ID, ITREND_PREFIX . 'contacto_direccion', 'fa-map-marker-alt', true, false);?>
					<?php echo itrend_contact_field( $post->ID, ITREND_PREFIX . 'contacto_comuna', 'fa-map-marker-alt', true, false );?>
					<?php echo itrend_contact_field( $post->ID, ITREND_PREFIX . 'contacto_region', 'fa-map-marker-alt', true, false );?>
				</div>
			</div>

				<?php if(is_user_logged_in()):
					$nombrepersona = itrend_contact_field( $post->ID, ITREND_PREFIX . 'contactopersona_nombre', '', true );
					$cargopersona = itrend_contact_field( $post->ID, ITREND_PREFIX . 'contactopersona_cargo', '', true );
					$correopersona = itrend_contact_field( $post->ID, ITREND_PREFIX . 'contactopersona_correo', '', false );
					$fonopersona = itrend_contact_field( $post->ID, ITREND_PREFIX . 'contactopersona_telefono', '', false );

					if($nombrepersona || $cargopersona || $correopersona || $fonopersona):
					?>
						<div class="info-private row">
								<div class="col m12">
									<h5>Información privada</h5>
									<span class="subtitle">(visible solo para usuarios registrados del sitio)</span>
									<ul class="datos-privados">
										<li><strong>Persona de contacto:</strong> <?php echo $nombrepersona;?></li>
										<li><strong>Cargo:</strong> <?php echo $cargopersona;?></li>
										<li><strong>E-mail: </strong><?php echo $correopersona;?></li>
										<li><strong>Teléfono: </strong><?php echo $fonopersona;?></li>
									</ul>
								</div>
						</div>
					<?php 
					endif;
				endif;?>

		</header>


			<?php
				$resumenrol = get_post_meta( $post->ID, ITREND_PREFIX . 'resumen_rol', true );
				?>
				
		<div class="resumen-rol-accion">
			<h2>Resumen Rol en Acciones GRRD</h2>
			<?php echo apply_filters( 'the_content', $resumenrol );?>
		</div>
		
		<?php 
		if( get_post_meta( $post->ID, ITREND_PREFIX . 'public', true) == true ):
			$taxonomies = array(
							'acciones_grrd',
							'tareas'
							);?>
		<?php 
		foreach($taxonomies as $taxonomy):
			if(has_term( '', $taxonomy )):
			?>	

			<div class="row tax-row">
				<div class="col m4 title-col">
					<?php 
					$taxobj = get_taxonomy( $taxonomy );
					$taxlabels = get_taxonomy_labels( $taxobj );
					echo $taxlabels->name;
					?>
				</div>
				<div class="col m8 content-col">
					<?php

						if($taxonomy == 'tareas'):
							$terms = wp_get_post_terms( $post->ID, 'tareas', array( 
																				'orderby' => 'meta_value_num',
																				'order'	  => 'ASC',
																				'meta_key'=> ITREND_PREFIX . 'numero_tarea'
																				));			
						else:
							$terms = get_the_terms( $post->ID, $taxonomy );
						endif;

						if($terms):

						foreach( $terms as $term ) {
							$term_desc = get_post_meta( $post->ID, ITREND_PREFIX . 'descripcion_relacion_' . ($taxonomy == 'tareas' ? 'tarea' : 'accion') . '_' . $term->slug, true );
							?>
							
							<h4 class="accion-name">
								<?php 	if($taxonomy == 'tareas'):
											echo get_term_meta( $term->term_id, ITREND_PREFIX . 'numero_tarea', true ) . '. ';
										endif;
								?>
								<?php echo $term->name;?>
							</h4>
							
							<div class="accion-desc">
								<?php echo apply_filters( 'the_content', $term_desc );?>
							</div>	

							<?php
							};
						endif;
					?>
				</div>
			</div>
		<?php
		//End check if has any term in taxonomy 
		endif;
		//End taxonomy cycle
		endforeach;
	//End check public info
	endif;
		?>

		<div class="link-archive">
			<?php $options = get_option( 'itrend_options' );?>

			<p class="itrend-email-fixes">Sugerencias y consultas a <a href="mailto:<?php echo $options['itrend_email'];?>"><?php echo $options['itrend_email'];?></a></p>
			<p>
				<a href="<?php echo add_query_arg('f', 'filtro', get_post_type_archive_link( 'actor' ) );?>" class="btn btn-block btn-primary">Volver al buscador de actores</a>
			</p>
		</div>
	</div>
</article>

<?php include( plugin_dir_path( __FILE__ ) . '/itrend-footer.php');?>