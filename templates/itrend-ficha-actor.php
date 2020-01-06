<?php include( plugin_dir_path( __FILE__ ) . '/itrend-header.php');?>

<article id="ficha-actor-<?php the_ID();?>" class="ficha-actor">
	<div class="container">
		<header class="actor-header">
			<h2 class="codigo"><?php echo get_post_meta($post->ID, ITREND_PREFIX . 'codigo', true);?></h2>
			<h1 class="actor-longname"><?php the_title();?></h1>
			<div class="row info-header">
				<div class="col-md-6 info-left">
					
					<div class="sector">
						<?php echo itrend_plain_terms('sector', $post->ID);?>
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
				<div class="col-md-6 info-right itrend-datos-contacto">
					<?php echo itrend_contact_field( $post->ID, ITREND_PREFIX . 'contacto_correo', 'fa-envelope', false, false );?>
					<?php echo itrend_contact_field( $post->ID, ITREND_PREFIX . 'contacto_telefono', 'fa-mobile', false, false);?>
					<?php echo itrend_contact_field( $post->ID, ITREND_PREFIX . 'contacto_web', 'fa-globe', true, true);?>
					<?php echo itrend_contact_field( $post->ID, ITREND_PREFIX . 'contacto_direccion', 'fa-map-marker-alt', true, false);?>
					<?php echo itrend_contact_field( $post->ID, ITREND_PREFIX . 'contacto_comuna', 'fa-map-marker-alt', true, false );?>
					<?php echo itrend_contact_field( $post->ID, ITREND_PREFIX . 'contacto_region', 'fa-map-marker-alt', true, false );?>

				</div>
			</div>

				<?php if(is_user_logged_in()):?>
						<div class="info-private row">
								<div class="col-md-6">
									<h5>Información privada</h5>
									<span class="subtitle">(visible solo para usuarios registrados del sitio)</span>
									<?php echo itrend_contact_field( $post->ID, ITREND_PREFIX . 'contactopersona_nombre', 'fa-user', true );?>
									<?php echo itrend_contact_field( $post->ID, ITREND_PREFIX . 'contactopersona_cargo', 'fa-mobile', true );?>
									<?php echo itrend_contact_field( $post->ID, ITREND_PREFIX . 'contactopersona_correo', 'fa-envelope', false );?>
									<?php echo itrend_contact_field( $post->ID, ITREND_PREFIX . 'contactopersona_telefono', 'fa-mobile', false );?>
								</div>
						</div>
					<?php endif;?>

		</header>
		
		<?php 
			$taxonomies = array(
							'acciones_grrd',
							'tareas'
							);?>
		<?php 
		foreach($taxonomies as $taxonomy):
			if(has_term( '', $taxonomy )):
			?>	
			<?php if($taxonomy == 'acciones_grrd'):
				$resumenrol = get_post_meta( $post->ID, ITREND_PREFIX . 'resumen_rol', true );
				?>
				
				<div class="resumen-rol-accion">
					<h2>Resumen Rol en Acciones GRRD</h2>
					<?php echo apply_filters( 'the_content', $resumenrol );?>
				</div>

			<?php endif;?>

			<div class="row tax-row">
				<div class="col-md-4 title-col">
					<?php 
					$taxobj = get_taxonomy( $taxonomy );
					$taxlabels = get_taxonomy_labels( $taxobj );
					echo $taxlabels->name;
					?>
				</div>
				<div class="col-md-8 content-col">
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
											echo get_term_meta( $term->term_id, ITREND_PREFIX . 'numero_tarea', true );
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
		?>

		<div class="link-archive">
			<a href="<?php echo add_query_arg('f', 'filtro', get_post_type_archive_link( 'actor' ) );?>" class="btn btn-block btn-default">Volver a listado de actores</a>
		</div>
	</div>
</article>

<?php include( plugin_dir_path( __FILE__ ) . '/itrend-footer.php');?>