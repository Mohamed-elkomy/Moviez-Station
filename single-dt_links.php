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

// Link Data
global $post;
$ourl = get_post_meta($post->ID, '_dool_url', true);
$murl = DooLinks::shorteners($ourl);
$time = dooplay_get_option('linktimewait');
// Get Post Link
if(have_posts()){
    while(have_posts()){
        // The Post
        the_post();
        // Count view
        doo_set_views($post->ID);
        // Check wait time
        if(!$time){
            // Redirect to URL
            wp_redirect($murl, 301);
            // Exit to new URL
            exit;
        }else{
            // Compose Options
            $outp = dooplay_get_option('linkoutputtype','btn');
            $btxt = dooplay_get_option('linkbtntext', __d('Continue'));
            $txun = dooplay_get_option('linkbtntextunder', __d('Click on the button to continue'));
            $clor = dooplay_get_option('linkbtncolor','#1e73be');
            $ganl = dooplay_get_option('ganalytics');
            // Compose Ad banners
            $adst = doo_compose_ad('_dooplay_adlinktop');
            $adsb = doo_compose_ad('_dooplay_adlinkbottom');
            // Get data of parent
            $prnt = wp_get_post_parent_id($post->ID);
            $titl = get_the_title($prnt);
            $prml = get_permalink($prnt);
            // Get post meta
            $type = get_post_meta($post->ID, '_dool_type', true );
            $lang = get_post_meta($post->ID, '_dool_lang', true );
            $size = get_post_meta($post->ID, '_dool_size', true );
            $qual = get_post_meta($post->ID, '_dool_quality', true );
            $domn = doo_compose_domainname($ourl);
            // Compose Json string
            $json = array(
                'time' => $time,
                'exit' => $outp,
                'ganl' => $ganl
            );
            // The json
            $json = json_encode($json);
            // Load Template
            require_once( DOO_DIR.'/inc/parts/single/doo_links.php');
        }
    }
}
