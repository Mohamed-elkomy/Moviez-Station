<?php
/*
* ----------------------------------------------------
* @author: Doothemes
* @author URI: https://doothemes.com/
* @copyright: (c) 2021 Doothemes. All rights reserved
* ----------------------------------------------------
* @since 2.5.0
*/

class DDbmoviesAjax extends DDbmoviesHelpers{

    /**
     * @since 2.5.0
     * @version 1.1
     */
    public function __construct(){
        add_action('wp_ajax_dbmovies_genereditor', array(&$this,'genereditor'));
        add_action('wp_ajax_dbmovies_updatedimdb', array(&$this,'updatedimdb'));
        add_action('wp_ajax_dbmovies_savesetting', array(&$this,'savesettings'));
        add_action('wp_ajax_dbmovies_insert_tmdb', array(&$this,'tmdbinsert'));
        add_action('wp_ajax_dbmovies_generate_se', array(&$this,'tmdbseasons'));
        add_action('wp_ajax_dbmovies_generate_ep', array(&$this,'tmdbepisodes'));
        add_action('wp_ajax_dbmovies_generate_te', array(&$this,'tmdbseasepis'));
        add_action('wp_ajax_dbmovies_clean_cache', array(&$this,'cleancaching'));
    }

    /**
     * @since 2.5.0
     * @version 1.0
     */
    public function cleancaching(){
        if(is_user_logged_in() && current_user_can('administrator')){
            foreach(glob(DBMOVIES_CACHE_DIR."*") as $file){
                if(is_file($file)) unlink($file);
            }
            wp_redirect(esc_url($this->Disset($_SERVER,'HTTP_REFERER')),302);
            exit;
        }
    }

    /**
     * @since 2.5.0
     * @version 1.1
     */
    public function tmdbseasepis(){
        if(!empty($_POST)){
            $type = $this->Disset($_POST,'type');
            $tmdb = $this->Disset($_POST,'tmdb');
            $name = $this->Disset($_POST,'name');
            $seas = $this->Disset($_POST,'seas');
            $item = $this->Disset($_POST,'item');
            $totl = $this->Disset($_POST,'totl');
            $post = $this->Disset($_POST,'pare');
            $meta = get_post_meta( $post,'clgnrt',true);
            if(!$meta){
                update_post_meta($post, 'clgnrt', '1');
            }
            switch($type){
                case 'seasons':
                    new DDbmoviesImporters('seasons', array('id' => $tmdb, 'se' => $item, 'nm' => $name, 'ed' => false));
                    break;

                case 'episodes':
                    new DDbmoviesImporters('episodes', array('id' => $tmdb, 'se' => $seas, 'ep' => $item, 'nm' => $name, 'ed' => false));
                    break;
            }
        }
    }

    /**
     * @since 2.5.0
     * @version 1.1
     */
    public function genereditor(){
        $type = $this->Disset($_POST,'typept');
        $post = $this->Disset($_POST,'idpost');
        $tmdb = $this->Disset($_POST,'tmdbid');
        $seas = $this->Disset($_POST,'season');
        $epis = $this->Disset($_POST,'episde');
        $name = $this->Disset($_POST,'tvname');
        switch($type){
            case 'movies':
            case 'tvshows':
                new DDbmoviesImporters($type, array('id' => $tmdb, 'ed' => $post));
                break;
            case 'seasons':
                new DDbmoviesImporters('seasons', array('id' => $tmdb, 'se' => $seas, 'nm' => $name, 'ed' => $post));
                break;
            case 'episodes':
                new DDbmoviesImporters('episodes', array('id' => $tmdb, 'se' => $seas, 'ep' => $epis, 'nm' => $name, 'ed' => $post));
                break;
            default:
                wp_send_json(array('response' => false,'message' => __d('Complete required data')));
                break;
        }
    }

    /**
     * @since 2.5.0
     * @version 1.0
     */
    public function updatedimdb(){
        // POST Data
        $post = $this->Disset($_POST,'id');
        $imdb = $this->Disset($_POST,'imdb');
        if($post && $imdb){
            // Api Rest
            $rest = self::UpdateIMDb($imdb,$post);
            // HTML
            if($this->Disset($rest,'imdb')){
                echo '<strong>'.$this->Disset($rest,'rating').'</strong> '.doo_format_number($this->Disset($rest,'votes')).' '. __d('votes');
            } else {
                echo $this->Disset($rest,'message');
            }
        }
        wp_die();
    }

    /**
     * @since 2.5.0
     * @version 1.1
     */
    public function savesettings(){
        // POST Data
        $nonce = $this->Disset($_POST,'cnonce');
        $stngs = $this->Disset($_POST,'dbmvsettings');
        $relod = false;
        // Verifications
        if(is_array($stngs) && wp_verify_nonce($nonce,'dbmovies-save-settings')){
            if($this->Disset($stngs,'dbmovies') !== $this->get_option('dbmovies')){
                delete_transient('dbmovies_activator');
                $relod = true;
            }
            if($this->Disset($stngs,'themoviedb') !== $this->get_option('themoviedb')){
                delete_transient('themoviedb_activator');
                $relod = true;
            }
            if($this->Disset($stngs,'updatermethod') !== $this->get_option('updatermethod')){
                wp_clear_scheduled_hook('dbmovies_cron_metaupdater');
                $relod = true;
            }
            $update = update_option(DBMOVIES_OPTIONS,$stngs);
            if($update){
                $response = array(
                    'response' => true,
                    'message' => __d('Settings saved'),
                    'reload' => $relod
                );
            }else{
                $response = array(
                    'response' => true,
                    'message' => __d('No changes to save'),
                    'reload' => $relod
                );
            }
        } else {
            $response = array(
                'response' => false,
                'message' => __d('Validation is not completed'),
                'reload' => $relod
            );
        }
        // The Json Response
        wp_send_json($response);
    }

    /**
     * @since 2.5.0
     * @version 1.1
     */
    public function tmdbinsert(){
        // Post Data
        $type = $this->Disset($_REQUEST,'ptype');
        $tmdb = $this->Disset($_REQUEST,'ptmdb');
        // Nonce condiction
        if($type && $tmdb){
            new DDbmoviesImporters($type, array('id' => $tmdb, 'ed' => false));
        }else{
            wp_send_json(array('response' => false,'message' => __d('Complete required data')));
        }
    }

    /**
     * @since 2.5.0
     * @version 1.1
     */
    public function tmdbseasons(){
        // Post Data
        $tmdb = $this->Disset($_REQUEST,'tmdb');
        $tmse = $this->Disset($_REQUEST,'tmse');
        $tnam = $this->Disset($_REQUEST,'name');
        $post = $this->Disset($_REQUEST,'post');
        $meta = get_post_meta( $post,'clgnrt',true);
        if(!$meta){
            update_post_meta( $post, 'clgnrt', '1');
        }
        // Verify
        if($tmdb && $tmse && $tnam){
            $season_data = array(
                'id' => $tmdb,
                'se' => $tmse,
                'nm' => $tnam,
                'ed' => false,
            );
            new DDbmoviesImporters('seasons',$season_data);
        } else {
            wp_send_json(array('response' => false,'message' => __d('Complete required data')));
        }
    }

    /**
     * @since 2.5.0
     * @version 1.1
     */
    public function tmdbepisodes(){
        // Post Data
        $tmdb = $this->Disset($_REQUEST,'tmdb');
        $tmse = $this->Disset($_REQUEST,'tmse');
        $tmep = $this->Disset($_REQUEST,'tmep');
        $tnam = $this->Disset($_REQUEST,'name');
        $post = $this->Disset($_REQUEST,'post');
        $meta = get_post_meta( $post,'clgnrt',true);
        if(!$meta){
            update_post_meta( $post, 'clgnrt', '1');
        }
        // Verify
        if($tmdb && $tmse && $tmep && $tnam){
            $episode_data = array(
                'id' => $tmdb,
                'se' => $tmse,
                'ep' => $tmep,
                'nm' => $tnam,
                'ed' => false,
            );
            new DDbmoviesImporters('episodes',$episode_data);
        }else{
            wp_send_json(array('response' => false,'message' => __d('Complete required data')));
        }
    }
}

new DDbmoviesAjax;
