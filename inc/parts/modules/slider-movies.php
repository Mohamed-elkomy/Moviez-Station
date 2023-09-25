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
$pitm = dooplay_get_option('slideritems','10');
$orde = dooplay_get_option('slidermodorderby','date');
$ordr = dooplay_get_option('slidermodorder','DESC');

// Compose Query
$query = array(
	'post_type' => array('movies'),
	'showposts' => $pitm,
	'orderby' 	=> $orde,
	'order' 	=> $ordr
);

// End Data
?>
<div id="slider-movies" class="animation-1 slider">
	<?php query_posts($query); while(have_posts()){ the_post(); get_template_part('inc/parts/item_b'); } wp_reset_query(); ?>
</div>
