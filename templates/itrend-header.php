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
		  		$title = 'Visualización de actores';
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
				$title = 'Metodología';
				$introtextfield = 'itrend_metodologia_intro_text';
		  }
		  $intro =itrend_get_option($introtextfield);
	?>
</head>
<body id="itrend-vis">
	<header id="itrend-vis-main-header" class="container-fluid">
		<div class="row">
			<div class="col m6">
				<div class="itrend-tabs">
							
						<a class="btn btn-primary waves-light <?php echo ($function == 'visualizacion'? 'active' : '');?>" href="<?php echo add_query_arg('f', 'visualizacion', get_post_type_archive_link( 'actor' ));?>">Visualización de actores</a>
						
						
						<a class="btn btn-primary waves-light <?php echo ($function == 'filtro'? 'active' : '');?>" href="<?php echo add_query_arg('f', 'filtro', get_post_type_archive_link( 'actor' ));?>">Buscador de actores</a>					
				</div>
			</div>
			<div class="col m3 push-m3">
				<div class="itrend-tabs right-section">
						
						<a class="btn btn-flat grey lighten-1 <?php echo ($function == 'metodologia'? 'active' : '');?>" href="<?php echo add_query_arg('f', 'metodologia', get_post_type_archive_link( 'actor' ));?>">Metodología</a>
						
				</div>
			</div>
		</div>
	</header>

		<div class="container-fluid">
			
			<div class="col m12">
				<h1 class="itrend-section-title"><?php echo $title;?></h1>
				<div class="introtext">
					<?php 
					echo apply_filters( 'the_content', $intro );?>
				</div>
			</div>
		</div>
