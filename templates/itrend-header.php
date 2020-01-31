<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
	<?php $function = $_GET['f'];
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
<body id="itrend-vis" <?php body_class( '' );?> >
	<header id="itrend-vis-main-header" class="container-fluid">
		<div class="row row-logo">
			<div class="col m4">
				<a href="<?php bloginfo('url');?>">
					<img src="<?php echo plugin_dir_url( __FILE__ );?>../img/ConectaResiliencia.png" alt="Conecta Resiliencia">
				</a>
			</div>
		</div>
		<div class="row row-tabs">
			<div class="col m8">
				<div class="itrend-tabs">

					<a class="itrend-tab <?php echo ($function == 'visualizacion'? 'active' : '');?>" href="<?php echo add_query_arg('f', 'visualizacion', get_post_type_archive_link( 'actor' ));?>">Mapa de actores</a>


					<a class="itrend-tab <?php echo ($function == 'filtro'? 'active' : '');?>" href="<?php echo add_query_arg('f', 'filtro', get_post_type_archive_link( 'actor' ));?>">Buscador de actores</a>	

				</div>
			</div>
			
		</div>
		<div class="top-menusection">
			<a class="itrend-tab first <?php echo ($function == 'about'? 'active' : '');?>" href="#">Sobre el proyecto</a>

			<a class="itrend-tab <?php echo ($function == 'metodologia'? 'active' : '');?>" href="#">Metodología</a>
		</div>
	</header>

	<?php if(!is_home()):?>
		<div class="container-fluid">
			<div class="row">
				<div class="col m6">
					<h1 class="itrend-section-title"><?php echo $title;?></h1>
					<div class="introtext">
						<?php 
						echo apply_filters( 'the_content', $intro );?>
					</div>
				</div>
				
			</div>
		</div>
	<?php endif;?>
