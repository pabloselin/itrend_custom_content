<?php include( plugin_dir_path( __FILE__ ) . '/itrend-header.php');?>

<?php

$filter = get_query_var( 'funcion' );
switch($filter){
	case('filtro'):
		include( plugin_dir_path( __FILE__ ) . '/itrend-filters.php');
	break;
	case('visualizacion'):
		echo do_shortcode( '[netviz]', false );
	break;
	case('metodologia'):
		echo '.';
	break;
	case(''):
		include( plugin_dir_path( __FILE__ ) . '/itrend-home.php');
	};
?>

<?php include( plugin_dir_path( __FILE__ ) . '/itrend-footer.php');?>