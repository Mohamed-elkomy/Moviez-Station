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
// Sidebar
$sidebar = dooplay_get_option('sidebar_position_single','right');
?>
<div id="single" class="dtsingle">
<?php if (have_posts()) :while (have_posts()) : the_post(); ?>
	<div class="content  <?php echo $sidebar; ?>">
		<div class="posts">
			<header class="pos">
				<h1 class="titl"><?php the_title(); ?></h1>
				<?php if($desc = doo_get_postmeta('dt_post_desc')) { echo '<h2 class="desc">'. $desc .'</h2>'; } ?>
			</header>
			<div class="meta">
				<span class="autor"><i class="fas fa-user-circle"></i> <?php the_author(); ?></span>
				<span class="date"><?php doo_post_date('F j, Y'); ?></span>
				<?php if($views = doo_get_postmeta('dt_views_count')) { echo '<span class="views">'. __d('Views') .' <strong>'. $views .'</strong></span>'; } ?>
			</div>
			<div class="wp-content">
				<?php the_content(); ?>
			</div>
			<div class="tax_post">
				<?php if(get_the_category()) { ?>
				<div class="tax_box">
					<div class="title"><?php _d('Categories'); ?></div>
					<div class="links"><?php the_category(' '); ?></div>
				</div>
				<?php } if(get_the_tags()) { ?>
				<div class="tax_box">
					<div class="title"><?php _d('Tags'); ?></div>
					<div class="links"><?php the_tags(' ', ' '); ?></div>
				</div>
				<?php } ?>
			</div>
		</div>
		<div class="sbox">
			<?php doo_social_sharelink($post->ID); ?>
		</div>
		<?php get_template_part('inc/parts/comments'); ?>
	</div>
<?php endwhile; endif; ?>
	<div class="sidebar <?php echo $sidebar; ?> scrolling">
		<?php if($widgets = dynamic_sidebar('sidebar-posts')) { $widgets; } else { echo '<a href="'. esc_url( home_url() ) .'/wp-admin/widgets.php">'. __d('Add widgets') .'</a>'; } ?>
	</div>
</div>
