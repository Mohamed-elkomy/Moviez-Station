<?php
/*
Template Name: DT - Rating page
*/
get_header();
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
?>

<div class="module">
	<div class="content right <?php echo $maxwidth; ?>">
	<header>
		<h1><?php _d('Ratings'); ?></h1>
		<span class="s_trending">
			<a href="<?php the_permalink() ?>" class="m_trending <?php echo $dt == '' ? 'active' : ''; ?>"><?php _d('See all'); ?></a>
			<a href="<?php the_permalink() ?>?get=movies" class="m_trending <?php echo $dt == 'movies' ? 'active' : ''; ?>"><?php _d('Movies'); ?></a>
			<a href="<?php the_permalink() ?>?get=tv" class="m_trending <?php echo $dt == 'tv' ? 'active' : ''; ?>"><?php _d('TV Show'); ?></a>
		</span>
	</header>
		<div class="items <?php echo $maxwidth; ?>">
		<?php
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		query_posts(array(
			'post_type'    => $setion,
			'meta_key'     => 'end_time',
			'meta_compare' => '>=',
			'meta_value'   => time() ,
			'meta_key'     => DOO_MAIN_RATING,
			'orderby'      => 'meta_value_num',
			'order'        => 'DESC',
			'paged'        => $paged
		));

		while (have_posts()):
			the_post(); ?>
		<?php get_template_part('inc/parts/item'); ?>
		<?php endwhile; ?>
		</div>
		<?php doo_pagination(); ?>
		</div>
		<div class="sidebar right scrolling">
			<div class="fixed-sidebar-blank">
				<?php dynamic_sidebar('sidebar-home'); ?>
			</div>
		</div>
</div>
<?php get_footer();
