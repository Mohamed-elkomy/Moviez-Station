<?php
/*
* ----------------------------------------------------
* @author: Doothemes
* @author URI: https://doothemes.com/
* @copyright: (c) 2021 Doothemes. All rights reserved
* ----------------------------------------------------
*
* @since 2.5.0
*
*/
get_header();
doo_glossary('movies');
$sidebar = dooplay_get_option('sidebar_position_archives','right');
echo '<div class="module"><div class="content '.$sidebar.'">';
get_template_part('inc/parts/modules/featured-post-movies');
echo '<header class="archive_post"><h1>'. __d('Movies').'</h1><span>'.doo_total_count('movies').'</span></header>';
echo '<div id="archive-content" class="animation-2 items">';
if(have_posts()){
    while(have_posts()){
        the_post();
		get_template_part('inc/parts/item');
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
