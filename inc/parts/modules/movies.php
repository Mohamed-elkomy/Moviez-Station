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
$sldr = doo_is_true('moviemodcontrol','slider');
$auto = doo_is_true('moviemodcontrol','autopl');
$orde = dooplay_get_option('moviemodorderby','date');
$ordr = dooplay_get_option('moviemodorder','DESC');
$pitm = dooplay_get_option('movieitems','10');
$titl = dooplay_get_option('movietitle','Movies');
$maxwidth = dooplay_get_option('max_width','1200');
$maxwidth = ($maxwidth >= 1400 && !$sldr) ? 'full' : 'normal';
$pmlk = get_post_type_archive_link('movies');
$totl = doo_total_count('movies');
$eowl = ($sldr == true) ? 'id="dt-movies" ' : false;

// Compose Query
$query = array(
	'post_type' => array('movies'),
	'showposts' => $pitm,
	'orderby' 	=> $orde,
	'order' 	=> $ordr
);

// End Data
?>
<header>
	<h2><?php echo $titl; ?></h2>
	<?php if($sldr == true && !$auto) { ?>
	<div class="nav_items_module">
	  <a class="btn prev3"><i class="fas fa-caret-left"></i></a>
	  <a class="btn next3"><i class="fas fa-caret-right"></i></a>
	</div>
	<?php } ?>
	<span><?php echo $totl; ?> <a href="<?php echo $pmlk; ?>" class="see-all"><?php _d('See all'); ?></a></span>
</header>
<div id="movload" class="load_modules"><?php _d('Loading..'); ?></div>
<div <?php echo $eowl; ?>class="items <?php echo $maxwidth; ?>">
	<?php query_posts($query); while(have_posts()){ the_post(); get_template_part('inc/parts/item'); } wp_reset_query(); ?>
</div>
