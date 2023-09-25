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
$orde = dooplay_get_option('episodesmodorderby','date');
$ordr = dooplay_get_option('episodesmodorder','DESC');
$pitm = dooplay_get_option('episodesitems','10');
$titl = dooplay_get_option('episodestitle','Episodes');
$auto = doo_is_true('episodesmodcontrol','autopl');
$slid = doo_is_true('episodesmodcontrol','slider');
$maxwidth = dooplay_get_option('max_width','1200');
$maxwidth = ($maxwidth >= 1400 && !$slid) ? 'full' : 'normal';
$pmlk = get_post_type_archive_link('episodes');
$totl = doo_total_count('episodes');

// Compose Query
$query = array(
    'post_type' => array('episodes'),
    'showposts' => $pitm,
    'orderby'   => $orde,
    'order'     => $ordr
);

// End Data
?>
<header>
    <h2><?php echo $titl; ?></h2>
    <?php if($slid == true && !$auto){ ?>
    <div class="nav_items_module">
        <a class="btn prev"><i class="fas fa-caret-left"></i></a>
        <a class="btn next"><i class="fas fa-caret-right"></i></a>
    </div>
    <?php } ?>
    <span><?php echo $totl; ?> <a href="<?php echo $pmlk; ?>" class="see-all"><?php _d('See all'); ?></a></span>
</header>
<div id="epiload" class="load_modules"><?php _d('Loading..'); ?></div>
<div <?php if($slid) echo 'id="dt-episodes" '; ?>class="animation-2 items <?php echo $maxwidth; ?>">
    <?php query_posts($query); while(have_posts()){ the_post(); get_template_part('inc/parts/item_ep'); } wp_reset_query(); ?>
</div>
