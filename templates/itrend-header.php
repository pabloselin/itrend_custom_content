<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>
<body id="itrend-vis">
	<header id="itrend-vis-main-header">
		<nav class="itrend-tabs">
			<ul class="nav nav-pills">
				<li class="nav-item">
					<a class="nav-link" href="<?php echo add_query_arg('f', 'filtro', get_post_type_archive_link( 'actor' ));?>">Listado de actores</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo add_query_arg('f', 'visualizacion', get_post_type_archive_link( 'actor' ));?>">Visualización de actores</a>
				</li>
			</ul>
		</nav>
	</header>