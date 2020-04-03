<?php if(!is_user_logged_in()):
	wp_redirect( wp_login_url(), 302, 'WordPress' );
	die();
endif;
?>

<?php include( plugin_dir_path( __FILE__ ) . '/itrend-header.php');?>


<?php

$filter = get_query_var( 'funcion' );
switch($filter){
	case('filtro'):
	include( plugin_dir_path( __FILE__ ) . '/itrend-filters.php');
	break;
	case('visualizacion'):

	?>

	<!-- Modal Structure -->


<div id="modal-instrucciones" class="modal">
	<div class="modal-content">
		<h4>Navegación</h4>
		<div class="modal-content-wrapper">
			<div class="row">
				<div class="col m6 s12">
					<h5>Tareas</h5>
					
					<div class="instruccion">
						<img src="<?php echo plugin_dir_url( __FILE__ );?>../img/zoom.gif" alt="">
						<p>Haz scroll para hacer zoom en la red</p>
					</div>
					
					<div class="instruccion">
						<img src="<?php echo plugin_dir_url( __FILE__ );?>../img/click1.gif" alt="">
						<p>Haz click en una tarea para conocer los actores asociados</p>
					</div>
					
					<div class="instruccion">
						<img src="<?php echo plugin_dir_url( __FILE__ );?>../img/click_ir.gif" alt="">
						<p>Haz click en un actor para ver la ficha completa</p>
					</div>
				</div>
				<div class="col m6 s12">
					<h5>Alcance Territorial / Sectorial</h5>

					<div class="instruccion">
						<img src="<?php echo plugin_dir_url( __FILE__ );?>../img/open.gif" alt="">
						<p>Haz click en un nodo para abrir la red</p>
					</div>
					
					<div class="instruccion">
						<img src="<?php echo plugin_dir_url( __FILE__ );?>../img/close.gif" alt="">
						<p>Haz click en un nodo para cerrar la red</p>
					</div>
					
					<div class="instruccion">
						<img src="<?php echo plugin_dir_url( __FILE__ );?>../img/click_actor.gif" alt="">
						<p>Haz click en un actor para ver la ficha completa</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<a href="javascript:void(0)" class="modal-close btn red">CERRAR</a>
	</div>
</div>

<?php

echo do_shortcode( '[netviz]', false );
break;

case('proyecto'):
	include( plugin_dir_path( __FILE__ ) . '/itrend-proyecto.php');
break;

case(''):
	include( plugin_dir_path( __FILE__ ) . '/itrend-home.php');
};

?>

<?php include( plugin_dir_path( __FILE__ ) . '/itrend-footer.php');?>