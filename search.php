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
doo_glossary();
?>
<div class="module">
	<div class="content rigth csearch">
	<?php
    if(doo_isset($_GET,'letter') == 'true') {
		get_template_part('pages/letter');
	} else {
		get_template_part('pages/search');
	}
    doo_pagination();
    ?>
	</div>
	<div class="sidebar right scrolling">
		<div class="fixed-sidebar-blank">
			<?php dynamic_sidebar('sidebar-home'); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
