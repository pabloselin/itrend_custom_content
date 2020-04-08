<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body id="itrend-vis" class="<?php echo itrend_body_class();?>" >
	<div class="topnav-header">
		<nav class="container-fluid">
			<div class="top-links">
				<a href="http://itrend.cl">Instituto</a>
				<a href="http://www.conectaresiliencia.cl">Conecta resiliencia</a>
				<a href="#">Aprende resiliencia</a>		
				<a href="#">Plataforma de datos</a>
			</div>
		</nav>
	</div>
	<header id="itrend-vis-main-header" class="container-fluid">
		<?php if(!empty(get_query_var( 'funcion' )) || is_singular('actor')):?>
		
		<div class="row row-links-main">
			<a href="<?php echo get_post_type_archive_link( 'actor' )?>visualizacion" class="btn-action btn-action-mapa"><img src="<?php echo plugin_dir_url( __FILE__ );?>../img/red-01.svg" alt=""> Visualiza la red</a>
			<a href="<?php echo get_post_type_archive_link( 'actor' )?>buscador" class="btn-action btn-action-buscador"><img src="<?php echo plugin_dir_url( __FILE__ );?>../img/buscador-02.svg" alt=""> Busca un actor</a>
			<a href="<?php echo get_post_type_archive_link( 'actor' )?>el-proyecto" class="btn-action btn-action-proyecto"><img src="<?php echo plugin_dir_url( __FILE__ );?>../img/i-04.svg" alt=""> El proyecto</a>
		</div>
		
		<?php endif;?>
	</header>