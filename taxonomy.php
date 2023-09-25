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
get_header();
$sidebar  = dooplay_get_option('sidebar_position_archives','right');
$maxwidth = dooplay_get_option('max_width','1200');
$maxwidth = ($maxwidth >= 1400) ? 'full' : 'normal';
?>
<div class="module">
	<div class="content <?php echo $sidebar.' '.$maxwidth; ?>">
	<h1 class="heading-archive"><?php printf( __d('%s'), '' . single_tag_title('', false ) . ''); ?></h1>
	<div class="desc_category">
		<?php echo category_description(); ?>
	</div>
	<header>
		<h2><?php _d('Recently added'); ?></h2>
	</header>
	<div class="<?php if(is_tax('dtquality')) { echo 'slider'; } else { echo 'items'; }  echo ' '.$maxwidth; ?>">
	<?php if(have_posts()) :while (have_posts()) : the_post();
		if(is_tax('dtquality')) { get_template_part('inc/parts/item_b'); } else { get_template_part('inc/parts/item'); }
	endwhile; endif; ?>
	</div>
	<?php doo_pagination(); ?>
	</div>
	<div class="sidebar <?php echo $sidebar; ?> scrolling">
		<div class="fixed-sidebar-blank">
			<?php dynamic_sidebar('sidebar-home'); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
