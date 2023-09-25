<?php
/*
* -------------------------------------------------------------------------------------
* @author: Doothemes
* @author URI: https://doothemes.com/
* @aopyright: (c) 2021 Doothemes. All rights reserved
* -------------------------------------------------------------------------------------
*
* @since 2.5.0
*
*/

// Compose data MODULE
$auto = dooplay_get_option('autocontentslider');
$pitm = dooplay_get_option('slideritems','10');
$orde = dooplay_get_option('slidermodorderby','date');
$ordr = dooplay_get_option('slidermodorder','DESC');
$typs = dooplay_get_option('sliderpostypes','all');
$html = '';
// Set Post Types
switch ($typs){
	case 'all':
		$post_types = array('tvshows','movies');
		break;
	case 'movies':
		$post_types = array('movies');
		break;
	case 'tvshows':
		$post_types = array('tvshows');
		break;
}

// Compose Query
if(dooplay_get_option('autocontentslider')){
	$query = array(
	'post_type' => $post_types,
	'showposts' => $pitm,
	'orderby' 	=> $orde,
	'order' 	=> $ordr
	);
}else{
	$query = array(
		'post__in' => doo_multiexplode(array(',',', '), dooplay_get_option('sliderpostids')),
		'post_type' => 'any',
		'orderby' 	=> $orde,
		'order' 	=> $ordr		
	);	
}

// HTML
echo '<div id="slider-movies-tvshows" class="animation-1 slider">';
query_posts($query); while(have_posts()){ the_post();get_template_part('inc/parts/item_b'); } wp_reset_query();
echo '</div>';
