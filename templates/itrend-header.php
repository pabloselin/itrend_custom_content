<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
	<?php $function = get_query_var( 'funcion');
	switch($function) {
		case('visualizacion'):
		$title = 'Mapa de actores';
		$introtextfield = 'itrend_vis_intro_text';
		break;
		case('filtro'):
		$title = 'Buscador de actores';
		$introtextfield = 'itrend_filtro_intro_text';
		break;
		case('metodologia'):
		$title = 'Metodología';
		$introtextfield = 'itrend_metodologia_intro_text';
		break;
		default:
		$title = '';
		$introtextfield = null;
	}
	$intro =itrend_get_option($introtextfield);
	?>
</head>
<body id="itrend-vis" class="<?php echo itrend_body_class();?>" >
	<div class="topnav-header">
		<nav class="container-fluid">
			<div class="top-links">
				<a href="https://itrend.cl">Instituto</a>
				<a href="https://conectaresiliencia.cl">Conecta resiliencia</a>
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
			<a href="<?php echo get_post_type_archive_link( 'actor' )?>" class="btn-action btn-action-proyecto"><img src="<?php echo plugin_dir_url( __FILE__ );?>../img/i-04.svg" alt=""> El proyecto</a>
		</div>
		
		<?php endif;?>
<!-- 		<div class="row row-logo">
			<div class="col m5">
				<a href="<?php bloginfo('url');?>">
					<em>actores</em><img src="<?php echo plugin_dir_url( __FILE__ );?>../img/ConectaResiliencia.png" alt="Conecta Resiliencia">
				</a>
			</div>
			<div class="col m7">
				<div class="itrend-tabs">

					<a class="itrend-tab <?php echo ($function == 'visualizacion'? 'active' : '');?>" href="<?php echo add_query_arg('f', 'visualizacion', get_post_type_archive_link( 'actor' ));?>">Mapa de actores</a>


					<a class="itrend-tab <?php echo ($function == 'filtro'? 'active' : '');?>" href="<?php echo add_query_arg('f', 'filtro', get_post_type_archive_link( 'actor' ));?>">Buscador de actores</a>	

					<a class="itrend-tab muted first <?php echo ($function == 'about'? 'active' : '');?>" href="#">Sobre el proyecto</a>

					<a class="itrend-tab muted <?php echo ($function == 'metodologia'? 'active' : '');?>" href="#">Metodología</a>

				</div>
			</div>
		</div> -->
		
	</header>

	<?php if(!is_home()):?>
		<!-- <div class="container-fluid">
			<div class="row row-presentation-section">
				<div class="col m6">
					<h1 class="itrend-section-title"><?php echo $title;?></h1>
					<div class="introtext">
						<?php 
						echo apply_filters( 'the_content', $intro );?>
					</div>
				</div>
				
			</div>
		</div> -->
	<?php endif;?>
