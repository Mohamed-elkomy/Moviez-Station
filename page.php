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
get_header(); ?>
<div id="page">
	<div class="single-page">
	<?php while ( have_posts() ) : the_post(); ?>
		<h1 class="head"><?php the_title(); ?></h1>
		<div class="wp-content">
			<?php the_content(); ?>
		</div>
		<?php if(dooplay_get_option('commentspage') == true) { get_template_part('inc/parts/comments'); } ?>
	<?php endwhile; ?>
	</div>
</div>
<?php get_footer(); ?>
