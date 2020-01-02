\<?php
	$select_taxonomies = itrend_relevant_taxonomies();
?>


<div class="container-fluid" id="itrend-filters">
	<div class="row">
		<h1><?php the_title();?></h1>
	</div>
	<div class="row status-row">
		<div class="col-md-4">
			<div id="itrend_results_count">
				<!-- Numero de resultados -->
			</div>
		</div>
		<div class="col-md-6">
			<form id="itrend_search">
				<input type="search" id="search-field" name="q" data-action="search" placeholder="Buscar por actor, palabra clave, campo...">
				<button class="btn btn-danger" type="submit"><i class="fas fa-search"></i></button>
			</form>
		</div>
		<div class="col-md-2 download-zone">
			<i class="fas fa-download"></i> Descargar CSV
		</div>
	</div>
	<div class="row">
		<div class="col-md-3 orgs-filter-list">

			<div class="filters-info-zone panel">
				<h2>Tus filtros</h2>
				
				<div class="append-zone-filter">
					
				</div>
				
				<button class="btn btn-block btn-primary" data-action="clean_filters">Quitar filtros</button>
				<button class="btn btn-block btn-danger" data-action="apply_filters">Filtrar</button>

			</div>

			<div class="accordion" id="accordion-filters">
				<h2>Filtros</h2>
			<?php 
			foreach($select_taxonomies as $key=>$taxonomy):
				$labels = get_taxonomy_labels( get_taxonomy($taxonomy) );
				?>
			
			
				<div class="card">
					<div class="card-header <?php echo ($key == 0 ? 'expanded' : 'collapsed');?>" id="heading-<?php echo $taxonomy;?>" data-toggle="collapse" data-target="#collapse-<?php echo $taxonomy;?>" aria-expanded="<?php echo ($key == 0 ? 'true' : 'false');?>" aria-controls="collapse-<?php echo $taxonomy;?>">
						<h5 class="mb-0">
							<?php echo $labels->name;?> <i class="fas fa-chevron-up"></i>
						</h5>
					</div>
					<div id="collapse-<?php echo $taxonomy;?>" class="collapse <?php echo ($key == 0 ? 'show' : 'noshow');?>" aria-labelledby="heading-<?php echo $taxonomy;?>" data-parent="#accordion-filters">
						<div class="card-body">
							<?php echo itrend_select_taxonomy_field($taxonomy, ($taxonomy == 'tareas' ? true : false));?>		
						</div>
					</div>
				</div>
				

			<?php 

			endforeach;
			
			?>
			</div>

			<button class="btn btn-block btn-danger" data-action="apply_filters">Filtrar</button>
		</div>

		<div class="col-md-9 orgs-table-list">
			<div id="itrend_messages">
				
			</div>

			<table class="table table-striped" id="itrend_table_results">
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