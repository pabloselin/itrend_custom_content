<?php if(is_user_logged_in()):?>

<?php include( plugin_dir_path( __FILE__ ) . '/itrend-header.php');?>

<?php 

$filter = $_GET['f'];
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
	default:
		include( plugin_dir_path( __FILE__ ) . '/itrend-filters.php');
	};
?>

<?php include( plugin_dir_path( __FILE__ ) . '/itrend-footer.php');?>

<?php else:?>

	<p>Acceso restringido</p>

	<?php endif;?>