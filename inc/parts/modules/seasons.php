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
$orde = dooplay_get_option('seasonsmodorderby','date');
$ordr = dooplay_get_option('seasonsmodorder','DESC');
$auto = doo_is_true('seasonsmodcontrol','autopl');
$sldr = doo_is_true('seasonsmodcontrol','slider');
$pitm = dooplay_get_option('seasonsitems','10');
$titl = dooplay_get_option('seasonstitle','Seasons');
$maxwidth = dooplay_get_option('max_width','1200');
$maxwidth = ($maxwidth >= 1400 && !$sldr) ? 'full' : 'normal';
$pmlk = get_post_type_archive_link('seasons');
$totl = doo_total_count('seasons');

// Compose Query
$query = array(
	'post_type' => array('seasons'),
	'showposts' => $pitm,
	'orderby'   => $orde,
	'order'     => $ordr
);

// End Data
?>
<header>
	<h2><?php echo $titl; ?></h2>
	<?php if($sldr == true && !$auto){ ?>
	<div class="nav_items_module">
	  <a class="btn prev2"><i class="fas fa-caret-left"></i></a>
	  <a class="btn next2"><i class="fas fa-caret-right"></i></a>
	</div>
	<?php } ?>
	<span><?php echo $totl; ?> <a href="<?php echo $pmlk; ?>" class="see-all"><?php _d('See all'); ?></a></span>
</header>
<div id="seaload" class="load_modules"><?php _d('Loading..'); ?></div>
<div <?php if($sldr == true) echo 'id="dt-seasons" '; ?>class="animation-2 items <?php echo $maxwidth; ?>">
	<?php query_posts($query); while(have_posts()){ the_post(); get_template_part('inc/parts/item_se'); } wp_reset_query(); ?>
</div>
