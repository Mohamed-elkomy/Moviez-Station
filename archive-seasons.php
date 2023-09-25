<?php
/*
* ----------------------------------------------------
* @author: Doothemes
* @author URI: https://doothemes.com/
* @copyright: (c) 2021 Doothemes. All rights reserved
* ----------------------------------------------------
*
* @since 2.5.2
*
*/
get_header();
$sidebar  = dooplay_get_option('sidebar_position_archives','right');
$maxwidth = dooplay_get_option('max_width','1200');
$maxwidth = ($maxwidth >= 1400) ? 'full' : 'normal';
echo '<div class="module"><div class="content '.$sidebar.' '.$maxwidth.'">';
echo '<h1 class="heading-archive">'.__d('Seasons').'</h1>';
echo '<header><h2>'. __d('Recently added'). '</h2><span>'.doo_total_count('seasons'). '</span></header>';
echo '<div id="archive-content" class="animation-2 items '.$maxwidth.'">';
if (have_posts()) {
    while (have_posts()) {
        the_post();
		get_template_part('inc/parts/item_se');
	}
}
echo '</div>';
doo_pagination();
echo '</div>';
echo '<div class="sidebar '.$sidebar.' scrolling"><div class="fixed-sidebar-blank">';
dynamic_sidebar('sidebar-home');
echo '</div></div>';
echo '</div>';
get_footer();
