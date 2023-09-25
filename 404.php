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
<div class="module">
	<div class="content right">
		<header><h1><?php _d('Page not found'); ?></h1></header>
		<div class="search-page">
			<div class="no-result animation-2">
				<h2><?php _d('ERROR'); ?> <span>404</span></h2>
				<strong><?php _d('Suggestions'); ?>:</strong>
				<ul>
					<li><?php _d('Verify that the link is correct.'); ?></li>
					<li><?php _d('Use the search box on the page.'); ?></li>
					<li><?php _d('Contact support page.'); ?></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="sidebar right scrolling">
		<div class="fixed-sidebar-blank">
			<?php dynamic_sidebar('sidebar-home'); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
