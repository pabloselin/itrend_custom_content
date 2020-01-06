<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
	<?php $function = $_GET['f'];?>
</head>
<body id="itrend-vis">
	<header id="itrend-vis-main-header" class="container-fluid">
		<div class="row justify-content-end">
			<div class="col-md-6">
				<div class="itrend-tabs">
					
						
						
						<a class="btn btn-primary waves-light <?php echo ($function == 'visualizacion'? 'active' : '');?>" href="<?php echo add_query_arg('f', 'visualizacion', get_post_type_archive_link( 'actor' ));?>">Visualización de actores</a>
						
						
						<a class="btn btn-primary waves-light <?php echo ($function == 'filtro'? 'active' : '');?>" href="<?php echo add_query_arg('f', 'filtro', get_post_type_archive_link( 'actor' ));?>">Listado de actores</a>
						
					
				</div>
			</div>
		</div>
	</header>