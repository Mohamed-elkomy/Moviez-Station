<?php
/*
* ----------------------------------------------------
* @author: Doothemes
* @author URI: https://doothemes.com/
* @copyright: (c) 2021 Doothemes. All rights reserved
* ----------------------------------------------------
*
* @since 2.5.0
*
*/

class DooPlayScripts{

    /**
     * @since 2.5.0
     * @version 1.0
     */
    function __construct(){
        // Include Scripts / CSS files
        add_action('admin_enqueue_scripts', array($this,'admin_scripts'), 20);
        add_action('wp_enqueue_scripts',array($this,'front_scripts'));
        // Include content on Footer and Header
        add_action('wp_head', array($this,'header_scripts'));
        add_action('wp_footer', array($this,'footer_scripts'));
    }

    /**
     * @since 2.5.0
     * @version 1.0
     */
    public function header_scripts(){
        if(is_page() OR is_single()){
            $doocmts = dooplay_get_option('comments');
            switch ($doocmts) {
                case 'fb':
                    $appi = dooplay_get_option('fbappid');
                    $lang = dooplay_get_option('fblang','en_US');
                    require_once(DOO_DIR.'/inc/parts/jscomments_facebook.php');
                    break;

                case 'dq':
                    $sname = dooplay_get_option('dqshortname');
                    if($sname){
                        require_once(DOO_DIR.'/inc/parts/jscomments_disqus.php');
                    }
                    break;
            }
        }
        echo "<script type=\"text/javascript\">jQuery(document).ready(function(a){\"false\"==dtGonza.mobile&&a(window).load(function(){a(\".scrolling\").mCustomScrollbar({theme:\"minimal-dark\",scrollInertia:200,scrollButtons:{enable:!0},callbacks:{onTotalScrollOffset:100,alwaysTriggerOffsets:!1}})})});</script>";
    }

    /**
     * @since 2.5.0
     * @version 1.0
     */
    public function footer_scripts(){
        #globals
		global $user_ID, $post;
		# Options
		$dt_featured_slider_ac = doo_is_true('featuredcontrol','slider');
		$dt_featured_slider_ap = doo_is_true('featuredcontrol','autopl');
		$dt_mm_activate_slider = doo_is_true('moviemodcontrol','slider');
		$dt_mm_autoplay_slider = doo_is_true('moviemodcontrol','autopl');
		$dt_mt_activate_slider = doo_is_true('tvmodcontrol','slider');
		$dt_mt_autoplay_slider = doo_is_true('tvmodcontrol','autopl');
		$dt_me_autoplay_slider = doo_is_true('episodesmodcontrol','autopl');
		$dt_ms_autoplay_slider = doo_is_true('seasonsmodcontrol','autopl');
		$dt_autoplay_s_movies  = doo_is_true('sliderautoplaycontrol','autopsm');
		$dt_autoplay_s_tvshows = doo_is_true('sliderautoplaycontrol','autopst');
		$dt_autoplay_s         = doo_is_true('sliderautoplaycontrol','autopms');
		$dt_slider_speed       = dooplay_get_option('sliderspeed','4000');
		$dt_google_analytics   = dooplay_get_option('ganalytics');
	    $dt_full_width         = dooplay_get_option('homefullwidth');
        $maxwidth              = dooplay_get_option('max_width','1200');
		# conditionals
		$cond_00 = ($dt_featured_slider_ap == true) ? '3500' : 'false';
		$cond_01 = ($dt_mm_autoplay_slider == true) ? '3500' : 'false';
		$cond_02 = ($dt_mt_autoplay_slider == true) ? '3500' : 'false';
		$cond_03 = ($dt_me_autoplay_slider == true) ? '3500' : 'false';
		$cond_04 = ($dt_ms_autoplay_slider == true) ? '3500' : 'false';
		$cond_05 = ($dt_autoplay_s_movies  == true) ? $dt_slider_speed : 'false';
		$cond_06 = ($dt_autoplay_s_tvshows == true) ? $dt_slider_speed : 'false';
		$cond_07 = ($dt_autoplay_s         == true) ? $dt_slider_speed : 'false';
	    // Condicionals full width
        if($maxwidth >= 1400){
            $cond_09 = ($dt_full_width == true) ?  "7" : "6";
    	    $cond_10 = ($dt_full_width == true) ?  "7" : "6";
    	    $cond_11 = ($dt_full_width == true) ?  "5" : "4";
    	    $cond_12 = ($dt_full_width == true) ?  "3" : "3";
            $cond_13 = (is_archive()) ? '6' : $cond_10;
        } else {
            $cond_09 = ($dt_full_width == true) ?  "6" : "5";
    	    $cond_10 = ($dt_full_width == true) ?  "6" : "5";
    	    $cond_11 = ($dt_full_width == true) ?  "4" : "3";
    	    $cond_12 = ($dt_full_width == true) ?  "3" : "2";
            $cond_13 = (is_archive()) ? '5' : $cond_10;
        }
        # HTML Out
        $out_javascript = "<script type=\"text/javascript\">\n";
		$out_javascript .= "jQuery(document).ready(function($) {\n";
		if(is_single()) {
			$out_javascript .= "$(\"#dt_galery\").owlCarousel({ items:3,autoPlay:false,itemsDesktop:[1199,3],itemsDesktopSmall:[980,3],itemsTablet:[768,3],itemsTabletSmall:false,itemsMobile:[479,1]});\n";
			$out_javascript .= "$(\"#dt_galery_ep\").owlCarousel({ items:2,autoPlay:false });\n";
			$out_javascript .= "$(\"#single_relacionados\").owlCarousel({ items:6,autoPlay:3000,stopOnHover:true,pagination:false,itemsDesktop:[1199,6],itemsDesktopSmall:[980,6],itemsTablet:[768,5],itemsTabletSmall:false,itemsMobile:[479,3] });\n";
		} else {
			if($dt_featured_slider_ac == true) {
				$out_javascript .= "$(\"#featured-titles\").owlCarousel({ autoPlay:{$cond_00},items:{$cond_13},stopOnHover:true,pagination:false,itemsDesktop:[1199,4],itemsDesktopSmall:[980,4],itemsTablet:[768,3],itemsTabletSmall: false,itemsMobile:[479,3] });\n";
				$out_javascript .= "$(\".nextf\").click(function(){ $(\"#featured-titles\").trigger(\"owl.next\") });\n";
				$out_javascript .= "$(\".prevf\").click(function(){ $(\"#featured-titles\").trigger(\"owl.prev\") });\n";

			}
			if($dt_mm_activate_slider == true) {
				$out_javascript .= "$(\"#dt-movies\").owlCarousel({ autoPlay:{$cond_01},items:{$cond_09},stopOnHover:true,pagination:false,itemsDesktop:[1199,5],itemsDesktopSmall:[980,5],itemsTablet:[768,4],itemsTabletSmall: false,itemsMobile:[479,3] });\n";
				if(!$dt_mm_autoplay_slider) {
					$out_javascript .= "$(\".next3\").click(function(){ $(\"#dt-movies\").trigger(\"owl.next\") });\n";
					$out_javascript .= "$(\".prev3\").click(function(){ $(\"#dt-movies\").trigger(\"owl.prev\") });\n";
				}
			}
			if($dt_mt_activate_slider == true) {
				$out_javascript .= "$(\"#dt-tvshows\").owlCarousel({ autoPlay:{$cond_02},items:{$cond_09},stopOnHover:true,pagination:false,itemsDesktop:[1199,5],itemsDesktopSmall:[980,5],itemsTablet:[768,4],itemsTabletSmall:false,itemsMobile:[479,3] });\n";
				if(!$dt_mt_autoplay_slider) {
					$out_javascript .= "$(\".next4\").click(function(){ $(\"#dt-tvshows\").trigger(\"owl.next\") });\n";
					$out_javascript .= "$(\".prev4\").click(function(){ $(\"#dt-tvshows\").trigger(\"owl.prev\") });\n";
				}
			}
			$out_javascript .= "$(\"#dt-episodes\").owlCarousel({ autoPlay:{$cond_03},pagination:false,items:{$cond_11},stopOnHover:true,itemsDesktop:[900,3],itemsDesktopSmall:[750,3],itemsTablet:[500,2],itemsMobile:[320,1] });\n";
			if(!$dt_me_autoplay_slider) {
				$out_javascript .= "$(\".next\").click(function(){ $(\"#dt-episodes\").trigger(\"owl.next\") });\n";
				$out_javascript .= "$(\".prev\").click(function(){ $(\"#dt-episodes\").trigger(\"owl.prev\") });\n";
			}
			$out_javascript .= "$(\"#dt-seasons\").owlCarousel({ autoPlay:{$cond_04},items:{$cond_09},stopOnHover:true,pagination:false,itemsDesktop:[1199,5],itemsDesktopSmall:[980,5],itemsTablet:[768,4],itemsTabletSmall:false,itemsMobile:[479,3] });\n";
			if(!$dt_ms_autoplay_slider) {
				$out_javascript .= "$(\".next2\").click(function(){ $(\"#dt-seasons\").trigger(\"owl.next\") });\n";
				$out_javascript .= "$(\".prev2\").click(function(){ $(\"#dt-seasons\").trigger(\"owl.prev\") });\n";
			}
			$out_javascript .= "$(\"#slider-movies\").owlCarousel({ autoPlay:{$cond_05},items:{$cond_12},stopOnHover:true,pagination:true,itemsDesktop:[1199,2],itemsDesktopSmall:[980,2],itemsTablet:[768,2],itemsTabletSmall:[600,1],itemsMobile:[479,1] });\n";
			$out_javascript .= "$(\"#slider-tvshows\").owlCarousel({ autoPlay:{$cond_06},items:{$cond_12},stopOnHover:true,pagination:true,itemsDesktop:[1199,2],itemsDesktopSmall:[980,2],itemsTablet:[768,2],itemsTabletSmall:[600,1],itemsMobile:[479,1] });\n";
			$out_javascript .= "$(\"#slider-movies-tvshows\").owlCarousel({ autoPlay:{$cond_07},items:{$cond_12},stopOnHover:true,pagination:true,itemsDesktop:[1199,2],itemsDesktopSmall:[980,2],itemsTablet:[768,2],itemsTabletSmall:[600,1],itemsMobile:[479,1] });\n";
		}
		if(is_single()) {
			if($user_ID){
				if( current_user_can('level_10') ) {
					$out_javascript .= "$(\".dtload\").click(function() { var o = $(this).attr(\"id\"); 1 == o ? ($(\".dtloadpage\").hide(), $(this).attr(\"id\", \"0\")) : ($(\".dtloadpage\").show(), $(this).attr(\"id\", \"1\")) });\n";
					$out_javascript .= "$(\".dtloadpage\").mouseup(function() { return !1 });\n";
					$out_javascript .= "$(\".dtload\").mouseup(function() { return !1 });\n";
					$out_javascript .= "$(document).mouseup(function() { $(\".dtloadpage\").hide(), $(\".dtload\").attr(\"id\", \"\") });\n";
				}
			}
		}
		$out_javascript .= "$(\".reset\").click(function(event){ if (!confirm( dtGonza.reset_all )) { event.preventDefault() } });\n";
		$out_javascript .= "$(\".addcontent\").click(function(event){ if(!confirm(dtGonza.manually_content)){ event.preventDefault() } });";
		$out_javascript .= "});\n";
		if( is_single() == true AND get_post_type() != 'seasons' AND get_post_meta($post->ID, 'imagenes', true) ) {
			$out_javascript .= "document.getElementById(\"dt_galery\").onclick=function(a){a=a||window.event;var b=a.target||a.srcElement,c=b.src?b.parentNode:b,d={index:c,event:a},e=this.getElementsByTagName(\"a\");blueimp.Gallery(e,d)};\n";
		}
		if($dt_google_analytics) {
			$out_javascript .= "(function(b,c,d,e,f,h,j){b.GoogleAnalyticsObject=f,b[f]=b[f]||function(){(b[f].q=b[f].q||[]).push(arguments)},b[f].l=1*new Date,h=c.createElement(d),j=c.getElementsByTagName(d)[0],h.async=1,h.src=e,j.parentNode.insertBefore(h,j)})(window,document,\"script\",\"//www.google-analytics.com/analytics.js\",\"ga\"),ga(\"create\",\"{$dt_google_analytics}\",\"auto\"),ga(\"send\",\"pageview\");\n";
		}
		$out_javascript .= "</script>\n";
		// Out
		echo apply_filters('dooplay_front_footer', $out_javascript);
    }

    /**
     * @since 2.5.0
     * @version 1.0
     */
    public function front_scripts(){
        // Set Font Awesome
        $fontawesome = dooplay_get_option('fontawesome_mode','local');
        wp_enqueue_style('fontawesome-pro', DOO_URI.'/assets/fontawesome/css/all.min.css', array(), '5.15.1');
        wp_enqueue_style('owl-carousel', DOO_URI.'/assets/css/front.owl'.doo_devmode().'.css', array(), DOO_VERSION);
	    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family='.dooplay_get_option('font','Roboto').':300,400,500,700', array(), DOO_VERSION);
		wp_enqueue_style('scrollbar', DOO_URI.'/assets/css/front.crollbar'.doo_devmode().'.css', array(), DOO_VERSION);
		wp_enqueue_style('dooplay', DOO_URI.'/assets/css/front.style'.doo_devmode().'.css', array(), DOO_VERSION);
		wp_enqueue_style('dooplay-color-scheme', DOO_URI.'/assets/css/colors.'.dooplay_get_option('style','default').''.doo_devmode().'.css', array(), DOO_VERSION);
		wp_enqueue_style('dooplay-responsive', DOO_URI.'/assets/css/front.mobile'.doo_devmode().'.css', array(), DOO_VERSION);
        wp_enqueue_script('lazyload',DOO_URI.'/assets/js/lib/lazyload.js', array('jquery'), DOO_VERSION, false);
        wp_enqueue_script('scrollbar',DOO_URI.'/assets/js/lib/pwsscrollbar.js', array('jquery'), DOO_VERSION, false);
		wp_enqueue_script('owl-carousel',DOO_URI.'/assets/js/lib/owlcarousel.js', array('jquery'), DOO_VERSION, false);
        wp_enqueue_script('idTabs', DOO_URI.'/assets/js/lib/idtabs.js', array('jquery'), DOO_VERSION, false);
        wp_enqueue_script('dtRepeat', DOO_URI.'/assets/js/lib/isrepeater.js', array('jquery'), DOO_VERSION, false);
        // Front JavaScripts
        wp_enqueue_script('scripts', DOO_URI.'/assets/js/front.scripts'.doo_devmode().'.js', array('jquery'), DOO_VERSION, true);
        wp_enqueue_script('dt_main_ajax', DOO_URI.'/assets/js/front.ajax'.doo_devmode().'.js', array('jquery'), DOO_VERSION, false);
        wp_enqueue_script('live_search', DOO_URI.'/assets/js/front.livesearch'.doo_devmode().'.js', array('jquery'), DOO_VERSION, true);
        wp_localize_script('dt_main_ajax', 'dtAjax', array(
            'url'		  => admin_url('admin-ajax.php', 'relative'),
            'player_api'  => site_url('/wp-json/dooplayer/v2/'),
            'play_ajaxmd' => dooplay_get_option('playajax'),
            'play_method' => dooplay_get_option('playajaxmethod','admin_ajax'),
            'googlercptc' => dooplay_get_option('gcaptchasitekeyv3'),
            'classitem'   => (dooplay_get_option('max_width','1200') >= 1400 ) ? 6 : 5,
            'loading'	  => __d('Loading..'),
            'afavorites'  => __d('Add to favorites'),
            'rfavorites'  => __d('Remove of favorites'),
            'views'     => __d('Views'),
            'remove'	=> __d('Remove'),
            'isawit'	=> __d('I saw it'),
            'send'		=> __d('Data send..'),
            'updating'	=> __d('Updating data..'),
            'error'		=> __d('Error'),
            'pending'	=> __d('Pending review'),
            'ltipe'		=> __d('Download'),
            'sending'	=> __d('Sending data'),
            'enabled'	=> __d('Enable'),
            'disabled'	=> __d('Disable'),
            'trash'		=> __d('Delete'),
            'lshared'	=> __d('Links Shared'),
            'ladmin'	=> __d('Manage pending links'),
            'sendingrep'=> __d('Please wait, sending data..'),
            'ready'		=> __d('Ready'),
            'deletelin' => __d('Do you really want to delete this link?')
        ));
        wp_localize_script('live_search', 'dtGonza', array(
			'api'	           => dooplay_url_search(),
	        'glossary'         => dooplay_url_glossary(),
			'nonce'            => dooplay_create_nonce('dooplay-search-nonce'),
			'area'	           => ".live-search",
			'button'	       => ".search-button",
			'more'		       => __d('View all results'),
			'mobile'	       => doo_mobile(),
			'reset_all'        => __d('Really you want to restart all data?'),
			'manually_content' => __d('They sure have added content manually?'),
	        'loading'          => __d('Loading..'),
            'loadingplayer'    => __d('Loading player..'),
            'selectaplayer'    => __d('Select a video player'),
            'playeradstime'    => dooplay_get_option('playwait'),
            'autoplayer'       => dooplay_get_option('playautoload'),
            'livesearchactive' => doo_is_true('permits','enls'),
		));
        // Comments // gallery
        if(is_singular() && get_option('thread_comments')) {
			wp_enqueue_script('comment-reply');
		}
		if(is_singular()) {
			wp_enqueue_style('blueimp-gallery', DOO_URI.'/assets/css/front.gallery'.doo_devmode().'.css', array(), DOO_VERSION, 'all');
			wp_enqueue_script('blueimp-gallery', DOO_URI.'/assets/js/lib/blueimp.js', array('jquery'), DOO_VERSION, false);
		}
    }

    /**
     * @since 2.5.0
     * @version 1.0
     */
    public function admin_scripts(){
        // Admin CSS
    	wp_enqueue_style('admin_css', DOO_URI.'/assets/css/admin.style'.doo_devmode().'.css', false, DOO_VERSION);
        // Admin Javascript
        wp_enqueue_script('ajax_dooplay_upload', DOO_URI.'/assets/js/lib/wpupload.js', array('jquery'), DOO_VERSION, false);
        wp_enqueue_script('ajax_dooplay_admin', DOO_URI.'/assets/js/admin.ajax'.doo_devmode().'.js', array('jquery'), DOO_VERSION, false);
		wp_localize_script('ajax_dooplay_admin', 'dooAj', array(
			'url'                => admin_url('admin-ajax.php', 'relative'),
            'rem_featu'	         => __('Remove'),
			'add_featu'          => __('Add'),
			'loading'	         => __d('Loading...'),
			'reloading'          => __d('Reloading..'),
			'exists'	         => __d('Domain has already been registered'),
			'updb'		         => __d('Updating database..'),
			'completed'          => __d('Action completed'),
            'nolink'             => __d('The links field is empty'),
            'deletelink'         => __d('Do you really want to delete this item?'),
            'confirmdbtool'      => __d('Do you really want to delete this register, once completed this action will not recover the data again?'),
            'confirmpublink'     => __d('Do you want to publish the links before continuing?'),
			'domain'	         => doo_compose_domain( get_site_url() ),
			'doothemes_server'	 => 'https://cdn.bescraper.cf/api',
			'doothemes_license'  => (current_user_can('administrator')) ? get_option(DOO_THEME_SLUG. '_license_key') : '',
			'doothemes_item'	 => DOO_THEME,
		));
    }
}

// Dooplay Front/Admin Scripts
new DooPlayScripts;
