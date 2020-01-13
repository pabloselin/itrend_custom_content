<?php
	$select_taxonomies = itrend_relevant_taxonomies();
?>
<h1 class="itrend-section-title">Buscador de Actores</h1>
<div class="container-fluid">
	<div class="row col m6">
		<?php 
		$intro =itrend_get_option('itrend_filtro_intro_text');
		echo apply_filters( 'the_content', $intro );?>
	</div>
</div>
<div class="container-fluid" id="itrend-filters">
	<div class="row status-row">
		<div class="col m3">
			
		</div>
		<div class="col m6">
			<form id="itrend_search">
				<div class="input-field">
					<i class="prefix fas fa-search"></i>
					<input type="search" id="search-field" name="q" data-action="search" placeholder="Buscar por actor, palabra clave, campo...">
				</div>
			</form>
		</div>
		<div class="col m2 download-zone">
			<i class="fas fa-download"></i> Descargar CSV
		</div>
	</div>
	<div class="row">
		<div class="col m3 orgs-filter-list">

			<div class="filters-info-zone panel">
				<h2>Tus filtros</h2>
				
				<div class="append-zone-filter">
					
				</div>
				
				<button class="btn red darken-4" data-action="clean_filters">Quitar filtros</button>
				<button class="btn" data-action="apply_filters">Filtrar</button>

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
			

			<button class="btn red darken-4" data-action="clean_filters">Quitar filtros</button>
			<button class="btn" data-action="apply_filters">Filtrar</button>

		</div>

		<div class="col m9 orgs-table-list">
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
		</div>
	</div>
	
</div>