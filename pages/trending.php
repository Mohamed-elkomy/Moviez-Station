<?php
/*
Template Name: DT - Trending page
*/


get_header();
global $user_ID;
$dt = isset( $_GET['get'] ) ? $_GET['get'] : null;
$admin = isset( $_GET['admin'] ) ? $_GET['admin'] : null;
if($dt == 'movies'):
	$setion = array('movies');
elseif($dt == 'tv'):
	$setion = array('tvshows');
else:
	$setion = array('movies','tvshows');
endif;
doo_glossary();
$maxwidth = dooplay_get_option('max_width','1200');
$maxwidth = ($maxwidth >= 1400) ? 'full' : 'normal';
echo '<div class="module">';
echo '<div class="content right '.$maxwidth.'">';
?>
<header>
	<h1><?php _d('Trending'); ?></h1>
	<span class="s_trending">
		<a href="<?php the_permalink() ?>" class="m_trending <?php echo $dt == '' ? 'active' : ''; ?>"><?php _d('See all'); ?></a>
		<a href="<?php the_permalink() ?>?get=movies" class="m_trending <?php echo $dt == 'movies' ? 'active' : ''; ?>"><?php _d('Movies'); ?></a>
		<a href="<?php the_permalink() ?>?get=tv" class="m_trending <?php echo $dt == 'tv' ? 'active' : ''; ?>"><?php _d('TV Show'); ?></a>
	</span>
</header>
<?php
// Items
echo '<div class="items '.$maxwidth.'">';
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
query_posts(array(
	'post_type'    => $setion,
	'post_status'  => 'publish',
	'meta_key'     => 'dt_views_count',
	'orderby'      => 'meta_value_num',
	'order'        => 'DESC',
	'paged'        => $paged
));
while (have_posts()): the_post();
	get_template_part('inc/parts/item');
endwhile;
echo '</div>';
doo_pagination();
echo '</div>';
echo '<div class="sidebar right scrolling"><div class="fixed-sidebar-blank">';
dynamic_sidebar('sidebar-home');
echo '</div></div>';
echo '</div>';
get_footer();
