<?php

//Llamado a actores de alcance territorial regional

$args = array(
	'post_type' => 'actor',
	'numberposts' => -1,
	'tax_query'	=> array(
		array(
			'taxonomy'	=> 'alcance_territorial',
			'field'		=> 'slug',
			'terms'		=> 'regional'	
		)
	)
	
	)
);

$actores_regionales = get_posts($args);