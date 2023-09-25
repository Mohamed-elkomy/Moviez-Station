<?php if(!defined('ABSPATH')) die;
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

class DooPlayViews{

    /**
     * @since 3.4.0
     * @version 1.0
     */
    function __construct(){
        if(DOO_THEME_VIEWS_COUNT == true){
            add_action('wp_ajax_dooplay_viewcounter', array($this,'ajax'));
            add_action('wp_ajax_nopriv_dooplay_viewcounter', array($this,'ajax'));
        }
    }

    /**
     * @since 3.4.0
     * @version 1.0
     */
    public static function ajax(){
        // Post data
        $post_id = doo_isset($_POST,'post_id');
        // Set Response
        $response = array(
            'success' => false
        );
        // Verify post data
        if($post_id){
            $response = array(
                'success'  => true,
                'counting' => self::Counter($post_id)
            );
        }
        // Send json
        wp_send_json($response);
    }

    /**
     * @since 3.4.0
     * @version 1.0
     */
    public static function Counter($post_id = ''){
        if(!DOO_THEME_VIEWS_COUNT) return '';
        $counting = get_post_meta($post_id,'dt_views_count',true);
        if(!$counting){
            $counting = 1;
        }else{
            $counting++;
        }
        update_post_meta($post_id,'dt_views_count',$counting);
        return $counting;
    }

    /**
     * @since 3.4.0
     * @version 1.0
     */
    public static function Meta($post_id = ''){
        // Verify module active
        if(!DOO_THEME_VIEWS_COUNT) return '';
        // switching Options
        switch(dooplay_get_option('view_count_mode','regular')){
            case 'regular':
                return self::Counter($post_id);
                break;
            case 'ajax':
                echo "<meta id='dooplay-ajax-counter' data-postid='{$post_id}'/>";
                break;
            case 'none':
                return '';
            break;
        }
    }

}


new DooPlayViews;
