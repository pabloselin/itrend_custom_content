<?php if(is_user_logged_in()):?>

<?php include( plugin_dir_path( __FILE__ ) . '/itrend-header.php');?>

<?php 
$filter = $_GET['f'];
if($filter == 'filtro'):
	include( plugin_dir_path( __FILE__ ) . '/itrend-filters.php');
elseif($filter == 'visualizacion'):
	include( plugin_dir_path( __FILE__ ) . '/network.php' );
else:
	include( plugin_dir_path( __FILE__ ) . '/itrend-filters.php');
endif;
?>

<?php include( plugin_dir_path( __FILE__ ) . '/itrend-footer.php');?>

<?php else:?>

	<p>Acceso restringido</p>

	<?php endif;?>