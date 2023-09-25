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

if( $dato = dooplay_get_option('fbadmin') ) { ?>
<meta property="fb:admins" content="<?php echo $dato; ?>"/>
<?php } if( $dato = dooplay_get_option('fbappid') ) { ?>
<meta property="fb:app_id" content="<?php echo $dato; ?>"/>
<?php }
if(dooplay_get_option('seo') == "true") {
if( $dato = dooplay_get_option('seogooglev') ) { ?>
<meta name="google-site-verification" content="<?php echo $dato; ?>" />
<?php } if( $dato = dooplay_get_option('seobingv') ) { ?>
<meta name="msvalidate.01" content="<?php echo $dato; ?>" />
<?php } if( $dato = dooplay_get_option('seoyandexv') ) { ?>
<meta name='yandex-verification' content="<?php echo $dato; ?>" />
<?php } if (is_home()) { if($data = dooplay_get_option('seodescription')) { ?>
<meta name="description" content="<?php echo $data; ?>"/>
<?php } if($data = dooplay_get_option('seokeywords')) { ?>
<meta name="keywords" content="<?php echo $data; ?>"/>
<?php } } if(is_single()) { ?>
<meta property="og:type" content="article" />
<meta property="og:title" content="<?php the_title(); ?>" />
<meta property="og:url" content="<?php the_permalink() ?>" />
<meta property="og:site_name" content="<?php bloginfo('name'); ?>" />
<?php } } ?>
