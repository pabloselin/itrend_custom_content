<?php
	$select_taxonomies = itrend_relevant_taxonomies();
	$introtextfield = 'itrend_filtro_intro_text';
	$intro =itrend_get_option($introtextfield);
?>
<div class="container-fluid" id="itrend-filters">
	<div class="row status-row">
		<div class="col m3 intro-presentation">
			
		</div>
		<div class="col m6">
			
		</div>
	</div>
	<div class="row">
		<div class="col m3 orgs-filter-list">
			
			<div class="intro-presentation">
				<h1 class="itrend-section-title"><a href="<?php echo get_post_type_archive_link( 'actor' );?>"><img src="<?php echo plugin_dir_url( __FILE__ );?>../img/logo_mapa.svg" alt="Mapa de Actores"></a></h1>
				<?php echo apply_filters('the_content', $intro);?>
				<span class="border"></span>
			</div>

			<form id="itrend_search_mobile" class="show-on-small">
				<div class="input-field">
					<i class="prefix fas fa-search"></i>
					<input type="search" id="search-field_mobile" name="q" data-action="search" placeholder="Buscar por actor, palabra clave, campo...">
					<button type="submit" class="btn waves-light">Buscar</button>
				</div>
			</form>

			<div class="filters-info-zone panel">
				<div class="append-zone-filter">
					
				</div>
				
				<button class="btn black" data-action="clean_filters">Quitar filtros</button>
				<button class="btn red darken-3" data-action="apply_filters">Filtrar</button>

			</div>

			<div class="accordion" id="accordion-filters">
				<h2>Filtros</h2>
			<ul class="collapsible">
			<?php 
			foreach($select_taxonomies as $key=>$taxonomy):
				$labels = get_taxonomy_labels( get_taxonomy($taxonomy) );
				?>
			
			
				<li>
					<div class="collapsible-header <?php echo ($key == 0 ? 'active' : 'collapsed');?>" id="heading-<?php echo $taxonomy;?>" data-toggle="collapse" data-target="#collapse-<?php echo $taxonomy;?>" aria-expanded="<?php echo ($key == 0 ? 'true' : 'false');?>" aria-controls="collapse-<?php echo $taxonomy;?>">
						<h5 class="mb-0">
							<?php echo $labels->name;?> <i class="fas fa-chevron-up"></i>
						</h5>
					</div>
					<div id="collapse-<?php echo $taxonomy;?>" class="collapsible-body <?php echo ($key == 0 ? 'show' : 'noshow');?>" aria-labelledby="heading-<?php echo $taxonomy;?>" data-parent="#accordion-filters">
						<div class="card-body">
							<?php echo itrend_select_taxonomy_field($taxonomy, ($taxonomy == 'tareas' ? true : false));?>		
						</div>
					</div>
				</li>
				

			<?php 

			endforeach;
			
			?>
			</ul>
			</div>
			

			<button class="btn black" data-action="clean_filters">Quitar filtros</button>
			<button class="btn red darken-3" data-action="apply_filters">Filtrar</button>

		</div>

		<div class="col m9 orgs-table-list">
			
			<form id="itrend_search" class="hide-on-small-only">
				<div class="input-field">
					<i class="prefix fas fa-search"></i>
					<input type="search" id="search-field" name="q" data-action="search" placeholder="Buscar por actor, palabra clave, campo...">
				</div>
			</form>

			<div id="itrend_results_count">
				<!-- Numero de resultados -->
			</div>

			<div id="itrend_messages">
				
			</div>
			
			<table class="table" id="itrend_table_results">
				<thead>
					<tr>
						<th>
							Institución
						</th>
						<th>
							Sector
						</th>
						<th>
							Alcances Territoriales
						</th>
						<th>
							Tareas
						</th>
						<th>
							Acciones
						</th>
					</tr>
				</thead>
				<tbody class="results">
					<!-- Ajax loaded content goes here -->
				</tbody>
			</table>
			<div id="itrend_mobile_results">
				<!--ajax mobile results-->
			</div>
		</div>
	</div>
	
</div>