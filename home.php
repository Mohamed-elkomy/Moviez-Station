<?php
/*
* -------------------------------------------------------------------------------------
* @author: Doothemes
* @author URI: https://doothemes.com/
* @copyright: (c) 2021 Doothemes. All rights reserved
* -------------------------------------------------------------------------------------
*
* @since 2.5.0
*
*/
// Header
get_header();
// Glossary
doo_glossary();
// Modules
$default = array(
	'slider'        => false,
	'featured-post' => false,
	'movies'        => false,
	'ads'           => false,
	'tvshows'       => false,
	'seasons'       => false,
	'episodes'      => false,
	'top-imdb'      => false,
	'blog'          => false
);
// Options
$fullwid = dooplay_get_option('homefullwidth');
$modules = dooplay_get_option('homepage');
$sidebar = dooplay_get_option('sidebar_position_home','right');
$maxwidth = dooplay_get_option('max_width','1200');
$maxwidth = ($maxwidth >= 1400) ? 'full' : 'normal';
$modules = (isset($modules['enabled'])) ? $modules['enabled'] : $default;
$hoclass = ($fullwid == true) ? ' full_width_layout' : ' '.$sidebar;
// Print home
echo '<div class="module">';
echo '<div class="content'.$hoclass.' '.$maxwidth.'">';
if(!empty($modules)){
	// Get template
	foreach($modules as $template => $template_name) {
		get_template_part('inc/parts/modules/'.$template);
	}
}
echo '</div>';
// Sidebar
if(!$fullwid) {
	echo '<div class="sidebar '.$sidebar.' scrolling"><div class="fixed-sidebar-blank">';
	dynamic_sidebar('sidebar-home');
	echo '</div></div>';
}
echo '</div>';
// Footer
get_footer();
