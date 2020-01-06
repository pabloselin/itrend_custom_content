<?php if(is_user_logged_in()):?>

<?php include( plugin_dir_path( __FILE__ ) . '/itrend-header.php');?>

<?php 
$filter = $_GET['f'];
if($filter == 'filtro'):
	echo '<h1 class="itrend-section-title">Buscador de Actores</h1>';
	include( plugin_dir_path( __FILE__ ) . '/itrend-filters.php');
elseif($filter == 'visualizacion'):
	echo '<h1 class="itrend-section-title">Visualización de Actores</h1>';
	include( plugin_dir_path( __FILE__ ) . '/network.php' );
	//include( plugin_dir_path( __FILE__ ) . '/itrend-visualization.php');
else:
	echo '<h1 class="itrend-section-title">Buscador de Actores</h1>';
	include( plugin_dir_path( __FILE__ ) . '/itrend-filters.php');
endif;
?>

<?php include( plugin_dir_path( __FILE__ ) . '/itrend-footer.php');?>

<?php else:?>

	<p>Acceso restringido</p>

	<?php endif;?>