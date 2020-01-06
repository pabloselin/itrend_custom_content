<?php include( plugin_dir_path( __FILE__ ) . '/itrend-header.php');?>

<?php 
$filter = $_GET['f'];
if($filter == 'filtro'):
	include( plugin_dir_path( __FILE__ ) . '/itrend-filters.php');
elseif($filter == 'visualizacion'):
	include( plugin_dir_path( __FILE__ ) . '/network.php' );
	//include( plugin_dir_path( __FILE__ ) . '/itrend-visualization.php');
else:
	include( plugin_dir_path( __FILE__ ) . '/itrend-filters.php');
endif;
?>

<?php include( plugin_dir_path( __FILE__ ) . '/itrend-footer.php');?>