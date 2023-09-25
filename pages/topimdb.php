<?php
/*
Template Name: DT - TOP IMDb
*/
get_header();
doo_glossary();
?>

<div class="module">
	<div class="content right fix_posts_templante">
		<header class="top_imdb">
			<h1 class="top-imdb-h1"><?php the_title(); ?> <span><?php echo dooplay_get_option('itopimdb','50'); ?></span></h1>
		</header>
		<?php get_template_part('inc/parts/modules/top-imdb-page'); ?>
	</div>
	<div class="sidebar right scrolling">
		<div class="fixed-sidebar-blank">
			<?php dynamic_sidebar('sidebar-home'); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
