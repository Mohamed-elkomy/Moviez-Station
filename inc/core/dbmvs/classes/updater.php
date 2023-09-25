<?php
/*
* ----------------------------------------------------
* @author: Doothemes
* @author URI: https://doothemes.com/
* @copyright: (c) 2021 Doothemes. All rights reserved
* ----------------------------------------------------
* @since 3.4
*/


class DDbmoviesUpdater extends DDbmoviesHelpers{

    /**
     * @version 1.0
     * @since 1.0
     */
    protected $dbmvs_key;
    protected $tmdb_key;
    protected $tmdb_lng;
    protected $app_time;

    /**
    * @since 2.5.0
    * @version 1.0
    */
    public function __construct(){

        // Ajax Action
        add_action('wp_ajax_dbmovies_metaupdater', array($this,'ajax_action'));

        /***
        // Set new times
        add_filter('cron_schedules',array($this,'cron_schedules'));
        // Method Updated
        switch ($this->get_option('updatermethod')) {
            case 'wp-ajax':
                add_action('wp_ajax_dbmovies_metaupdater', array($this,'ajax_action'));
            break;
            case 'wp-cron':
                if(get_option('__dbmvs_cronmeta_status') == 'processing'){
                    if(!wp_next_scheduled('dbmovies_cron_metaupdater')){
                        wp_schedule_event(time(),'every_1_minute','dbmovies_cron_metaupdater');
                    }
                    add_action('dbmovies_cron_metaupdater',array($this,'cron_action'));
                }
            break;
        }
        ***/
    }

    /**
    * @since 2.5.0
    * @version 1.0
    */
    public function cron_schedules($schedules){
        if(!isset($schedules['every_5_seconds'])){
            $schedules['every_5_seconds'] = array(
                'display'  => __d('Every 5 seconds'),
                'interval' => 5
            );
        }
        if(!isset($schedules['every_10_seconds'])){
            $schedules['every_10_seconds'] = array(
                'display'  => __d('Every 10 seconds'),
                'interval' => 10
            );
        }
        if(!isset($schedules['every_30_seconds'])){
            $schedules['every_30_seconds'] = array(
                'display'  => __d('Every 30 seconds'),
                'interval' => 30
            );
        }
        if(!isset($schedules['every_1_minute'])){
            $schedules['every_1_minute'] = array(
                'display'  => __d('Every 1 minute'),
                'interval' => 60
            );
        }
        return $schedules;
    }

    /**
    * @since 2.5.0
    * @version 1.0
    */
    public function cron_action(){
        update_option('cron_dbmovies_timer', time());
    }

    /**
    * @since 2.5.0
    * @version 1.0
    */
    public function ajax_action(){
        // Pre Response
        $response = array();
        // Only POST Requests
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            // Main action
            $action = $this->Disset($_POST,'process');
            // Switching action
            switch ($action) {
                // Updating Metada
                case 'updater':
                    $page     = get_option('__dbmvs_cronmeta_paged','1');
                    $pages    = $this->calculate_pages();
                    $content  = $this->get_content_id($page);
                    if($content){
                        foreach ($content as $post_id => $post_type) {
                            $response = array(
                                'success'  => true,
                                'page'     => $page,
                                'pages'    => $pages,
                                'progress' => number_format(($page*100/$pages),1),
                                'status'   => __d('Updated'),
                                'content'  => $this->get_content($post_id, $post_type, $page)
                            );
                        }
                    }else{
                        // Update Options
                        delete_option('__dbmvs_cronmeta_total');
                        delete_option('__dbmvs_cronmeta_pages');
                        delete_option('__dbmvs_cronmeta_paged');
                        // The Response
                        $response = array(
                            'success' => false,
                            'message' => __d('There is no content to update')
                        );
                    }
                break;

                // Finish Proccess
                case 'finish':
                    // Delete Options
                    delete_option('__dbmvs_cronmeta_total');
                    delete_option('__dbmvs_cronmeta_pages');
                    delete_option('__dbmvs_cronmeta_paged');
                    // The Response
                    $response = array(
                        'success' => false,
                        'message' => __d('Process finished, the metadata update was incomplete')
                    );
                    break;
            }
        }
        // Return Reponse on Json
        wp_send_json($response);
    }

    /**
    * @since 2.5.0
    * @version 1.0
    */
    private function calculate_content(){
        $total = get_option('__dbmvs_cronmeta_total');
        if(!$total){
            $query = new WP_Query(
                array(
                    'post_type'   => $this->UpdateTypes(),
                    'post_status' => 'publish'
                )
            );
            $total = $query->found_posts;
            update_option('__dbmvs_cronmeta_total',$total);
        }
        return $total;
    }

    /**
    * @since 2.5.0
    * @version 1.0
    */
    private function calculate_pages($per_page = 1){
        $pages = get_option('__dbmvs_cronmeta_pages');
        // Compose Query
        if(!$pages){
            $pages = ceil($this->calculate_content()/$per_page);
            // Update pages
            update_option('__dbmvs_cronmeta_pages',$pages);
        }
        return $pages;
    }

    /**
    * @since 2.5.0
    * @version 1.0
    */
    private function get_content_id($page = 1, $per_page = 1){
        // Compose Query
        $query = new WP_Query(
            array(
                'post_type'      => $this->UpdateTypes(),
                'paged'          => $page,
                'posts_per_page' => $per_page,
                'post_status'    => 'publish',
                'orderby'        => 'ID',
                'order'          => 'DESC'
            )
        );
        // The Return
        return wp_list_pluck($query->posts,'post_type','ID');
    }

    /**
    * @since 2.5.0
    * @version 1.0
    */
    private function get_content($post_id, $post_type, $page){
        // Compose options
        $this->app_time  = microtime(TRUE);
        $this->dbmvs_key = $this->get_option('dbmovies');
        $this->tmdb_key  = $this->get_option('themoviedb',DBMOVIES_TMDBKEY);
        $this->tmdb_lng  = $this->get_option('language','en-US');
        // Set Response
        $response = array();
        // Verifications
        if(!empty($post_id) && !empty($post_type)){
            switch ($post_type){
                case 'movies':
                    $response = $this->movies($post_id);
                    break;

                case 'tvshows':
                    $response = $this->tvshows($post_id);
                    break;

                case 'seasons':
                    $response = $this->seasons($post_id);
                    break;

                case 'episodes':
                    $response = $this->episodes($post_id);
                    break;

                default:
                    $response = array(
                        'success' => false,
                        'message' => __d('Unknown error')
                    );
                    break;
            }
        }else{
            $response = array(
                'success' => false,
                'message' => __d('Incomplete data')
            );
        }
        // Recount page
        update_option('__dbmvs_cronmeta_paged', $page+1);
        // The Response
        return $response;
    }

    /**
    * @since 2.5.0
    * @version 1.0
    */
    private function successfully($post_id = '', $post_type = ''){
        return array(
            'response'  => true,
            'status'    => __d('Updated'),
            'post_id'   => $post_id,
            'type'      => $post_type,
            'editlink'  => admin_url('post.php?post='.$post_id.'&action=edit'),
            'permalink' => get_permalink($post_id),
            'title'     => get_the_title($post_id),
            'mtime'     => $this->TimeExe($this->app_time)
        );
    }

    /**
    * @since 2.5.0
    * @version 1.0
    */
    private function arguments($sections = ''){
        return array(
            'append_to_response'     => $sections,
            'include_image_language' => $this->tmdb_lng.',null',
            'language'               => $this->tmdb_lng,
            'api_key'                => $this->tmdb_key
        );
    }

    /**
    * @since 2.5.0
    * @version 1.0
    */
    private function images($tmdb_images = array()){
        $images = '';
        if($tmdb_images){
            $image_count = 0;
            foreach($tmdb_images as $image) if($image_count < 10){
                if($image_count == 9){
                    $images.= $this->Disset($image,'file_path');
                }else{
                    $images.= $this->Disset($image,'file_path')."\n";
                }
                $image_count++;
            }
        }
        return $images;
    }

    /**
    * @since 2.5.0
    * @version 1.0
    */
    private function movies($post_id = ''){
        // Set Response
        $response = array();
        // Post Meta data
        $finder = get_post_meta($post_id, 'ids', true);
        // Verify ID finder
        if(!$finder){
            $finder = get_post_meta($post_id, 'idtmdb', true);
        }
        // Verify the Finder ID
        if(!empty($finder)){
            // TMDb Data
            $json_tmdb = $this->RemoteJson($this->arguments('images,trailers,credits'),DBMOVIES_TMDBAPI.'/movie/'.$finder);
            // verificate
            if(!$this->Disset($json_tmdb,'status_code')){
                // Set TMDb Metada
                $imdb_id   = $this->Disset($json_tmdb,'imdb_id');
                $release   = $this->Disset($json_tmdb,'release_date');
                $ortitle   = $this->Disset($json_tmdb,'original_title');
                $poster    = $this->Disset($json_tmdb,'poster_path');
                $backdrop  = $this->Disset($json_tmdb,'backdrop_path');
                $average   = $this->Disset($json_tmdb,'vote_average');
                $votecount = $this->Disset($json_tmdb,'vote_count');
                $tagline   = $this->Disset($json_tmdb,'tagline');
                $runtime   = $this->Disset($json_tmdb,'runtime');
                $backdrops = isset($json_tmdb['images']['backdrops']) ? $json_tmdb['images']['backdrops'] : false;
                $trailers  = isset($json_tmdb['trailers']['youtube']) ? $json_tmdb['trailers']['youtube'] : false;
                // Set IMDb Data
                $json_imdb = $this->RemoteJson(array('key'=>$this->dbmvs_key,'imdb'=>$imdb_id), DBMOVIES_DBMVAPI);
                // Compose IMDb Data
                $imdb_rating  = $this->Disset($json_imdb,'rating');
                $imdb_rated   = $this->Disset($json_imdb,'rated');
                $imdb_country = $this->Disset($json_imdb,'country');
                $imdb_votes   = $this->Disset($json_imdb,'votes');
                $imdb_votes   = str_replace(',','',$imdb_votes);
				
                // Set Images
                $images = $this->images($backdrops);
                // Set Video Traiter
                $youtube = '';
                if($trailers){
                    foreach($trailers as $trailer){
                        $youtube .= '['.$this->Disset($trailer,'source').']';
                        break;
                    }
                }
                // TMDb Api Credits
                $tmdb_credits = $this->Disset($json_tmdb,'credits');
                // Cast data
                $tmdb_cast = $this->Disset($tmdb_credits,'cast');
                $tmdb_crew = $this->Disset($tmdb_credits,'crew');
                // Compose Shortcode Cast
                $meta_cast = '';
                if($tmdb_cast){
                    $cast_count = 0;
                    foreach($tmdb_cast as $cast) if($cast_count < 10){
                        // Pre Data
                        $name = $this->Disset($cast,'name');
                        $chrt = $this->Disset($cast,'character');
                        $ppat = $this->Disset($cast,'profile_path');
                        $path = ($ppat == NULL) ? 'null' : $ppat;
                        // Set Data
                        $meta_cast .= '['.$path.';'.$name.','.$chrt.']';
                        // Counter
                        $cast_count++;
                    }
                }
                // Compose Shortcode Director
                $meta_director = '';
                if($tmdb_crew){
                    foreach ($tmdb_crew as $crew){
                        // Pre data
                        $name = $this->Disset($crew,'name');
                        $detp = $this->Disset($crew,'department');
                        $ppth = $this->Disset($crew,'profile_path');
                        $path = ($ppth == NULL) ? 'null' : $ppth;
                        if($detp == 'Directing'){
                            $meta_director .= '['.$path.';'.$name.']';
                        }
                    }
                }
                ################################ UPDATE POST META ##################################
                if(!empty($poster))
                    update_post_meta($post_id,'dt_poster',sanitize_text_field($poster));
                if(!empty($backdrop))
                    update_post_meta($post_id,'dt_backdrop',sanitize_text_field($backdrop));
                if(!empty($images))
                    update_post_meta($post_id,'imagenes',esc_attr($images));
                if(!empty($youtube))
                    update_post_meta($post_id,'youtube_id',sanitize_text_field($youtube));
                if(!empty($ortitle))
                    update_post_meta($post_id,'original_title',sanitize_text_field($ortitle));
                if(!empty($release))
                    update_post_meta($post_id,'release_date',sanitize_text_field($release));
                if(!empty($average))
                    update_post_meta($post_id,'vote_average',sanitize_text_field($average));
                if(!empty($votecount))
                    update_post_meta($post_id,'vote_count',sanitize_text_field($votecount));
                if(!empty($tagline))
                    update_post_meta($post_id,'tagline',sanitize_text_field($tagline));
                if(!empty($runtime))
                    update_post_meta($post_id,'runtime',sanitize_text_field($runtime));
                if(!empty($meta_cast))
                    update_post_meta($post_id,'dt_cast',sanitize_text_field($meta_cast));
                if(!empty($meta_director))
                    update_post_meta($post_id,'dt_dir',sanitize_text_field($meta_director));
                if(!empty($imdb_rating))
                    update_post_meta($post_id,'imdbRating',sanitize_text_field($imdb_rating));
                if(!empty($imdb_rated))
                    update_post_meta($post_id,'Rated',sanitize_text_field($imdb_rated));
                if(!empty($imdb_country))
                    update_post_meta($post_id,'Country',sanitize_text_field($imdb_country));
                if(!empty($imdb_votes))
                    update_post_meta($post_id,'imdbVotes',sanitize_text_field($imdb_votes));
                // Upload Image
                if(!empty($poster) && !has_post_thumbnail($post_id))
                    $this->UploadImage('https://image.tmdb.org/t/p/w780'.$poster, $post_id, true, false);
                #####################################################################################
                $response = $this->successfully($post_id, __d('movie'));#############################
                #####################################################################################
            }else{
                $response = array(
                    'success' => false,
                    'message' => $this->Disset($json_tmdb,'status_message')
                );
            }
        } else {
            $response = array(
                'success' => false,
                'message' => __d('Undefined TMDb ID')
            );
        }
        // Response composer
        return $response;
    }

    /**
    * @since 2.5.0
    * @version 1.0
    */
    private function tvshows($post_id = ''){
        // Set Response
        $response = array();
        // Post Meta data
        $finder = get_post_meta($post_id, 'ids', true);
        // Verify the Finder ID
        if(!empty($finder)){
            // TMDb Json data
            $json_tmdb = $this->RemoteJson($this->arguments('images,videos,credits'),DBMOVIES_TMDBAPI.'/tv/'.$finder);
            // verificate
            if(!$this->Disset($json_tmdb,'status_code')){
                // Get videos
                $tmdb_videos = $this->Disset($json_tmdb,'videos');
                // Set TMDb Metada
                $orname     = $this->Disset($json_tmdb,'original_name');
                $firstdate  = $this->Disset($json_tmdb,'first_air_date');
                $lastdate   = $this->Disset($json_tmdb,'last_air_date');
                $epiruntime = $this->Disset($json_tmdb,'episode_run_time');
                $poster     = $this->Disset($json_tmdb,'poster_path');
                $backdrop   = $this->Disset($json_tmdb,'backdrop_path');
                $average    = $this->Disset($json_tmdb,'vote_average');
                $votecount  = $this->Disset($json_tmdb,'vote_count');
                $seasons    = $this->Disset($json_tmdb,'number_of_seasons');
                $episodes   = $this->Disset($json_tmdb,'number_of_episodes');
                $creators   = $this->Disset($json_tmdb,'created_by');
                $trailers   = $this->Disset($tmdb_videos,'results');
                $backdrops  = isset($json_tmdb['images']['backdrops']) ? $json_tmdb['images']['backdrops'] : false;
                // Set Images
                $images = $this->images($backdrops);
                // Set Video Traiter
                $youtube = '';
                if($trailers){
                    foreach($trailers as $trailer){
                        $youtube .= '['.$this->Disset($trailer,'key').']';
                        break;
                    }
                }
                // Set Runtime
                $runtime = '';
                if($epiruntime){
                    foreach($epiruntime as $time){
                        $runtime .= $time;
                        break;
                    }
                }
                // Compose Shortcode creators
                $meta_creator = '';
                if($creators){
                    foreach($creators as $creator){
                        // Pre Data
                        $name = $this->Disset($creator,'name');
                        $ppat = $this->Disset($creator,'profile_path');
                        $path = ($ppat == NULL) ? 'null' : $ppat;
                        // Set Data
                        $meta_creator .= '['.$path.';'.$name.']';
                    }
                }
                // TMDb Api Credits
                $tmdb_credits = $this->Disset($json_tmdb,'credits');
                // Set Cast
                $tmdb_cast = $this->Disset($tmdb_credits,'cast');
                // Shortcode composer cast
                $meta_cast = '';
                if($tmdb_cast){
                    $cast_count = 0;
                    foreach($tmdb_cast as $cast) if($cast_count < 10){
                        // Pre Data
                        $name = $this->Disset($cast,'name');
                        $chrt = $this->Disset($cast,'character');
                        $ppat = $this->Disset($cast,'profile_path');
                        $path = ($ppat == NULL) ? 'null' : $ppat;
                        // Set Data
                        $meta_cast .= '['.$path.';'.$name.','.$chrt.']';
                        // Counter
                        $cast_count++;
                    }
                }
                ################################ UPDATE POST META ##################################
                if(!empty($images))
                    update_post_meta($post_id,'imagenes',esc_attr($images));
                if(!empty($youtube))
                    update_post_meta($post_id,'youtube_id',sanitize_text_field($youtube));
                if(!empty($runtime))
                    update_post_meta($post_id,'episode_run_time',sanitize_text_field($runtime));
                if(!empty($poster))
                    update_post_meta($post_id,'dt_poster',sanitize_text_field($poster));
                if(!empty($backdrop))
                    update_post_meta($post_id,'dt_backdrop',sanitize_text_field($backdrop));
                if(!empty($firstdate))
                    update_post_meta($post_id,'first_air_date',sanitize_text_field($firstdate));
                if(!empty($lastdate))
                    update_post_meta($post_id,'last_air_date',sanitize_text_field($lastdate));
                if(!empty($episodes))
                    update_post_meta($post_id,'number_of_episodes',sanitize_text_field($episodes));
                if(!empty($seasons))
                    update_post_meta($post_id,'number_of_seasons',sanitize_text_field($seasons));
                if(!empty($orname))
                    update_post_meta($post_id,'original_name',sanitize_text_field($orname));
                if(!empty($average))
                    update_post_meta($post_id,'imdbRating',sanitize_text_field($average));
                if(!empty($votecount))
                    update_post_meta($post_id,'imdbVotes',sanitize_text_field($votecount));
                if(!empty($meta_cast))
                    update_post_meta($post_id,'dt_cast',sanitize_text_field($meta_cast));
                if(!empty($meta_creator))
                    update_post_meta($post_id,'dt_creator',sanitize_text_field($meta_creator));
                // Upload Image
                if(!empty($poster) && !has_post_thumbnail($post_id))
                    $this->UploadImage('https://image.tmdb.org/t/p/w780'.$poster, $post_id, true, false);
                #####################################################################################
                $response = $this->successfully($post_id, __d('show'));##############################
                #####################################################################################
            } else {
                $response = array(
                    'success' => false,
                    'message' => $this->Disset($json_tmdb,'status_message')
                );
            }
        } else {
            $response = array(
                'success' => false,
                'message' => __d('Undefined TMDb ID')
            );
        }
        // The response
        return $response;
    }

    /**
    * @since 2.5.0
    * @version 1.0
    */
    private function seasons($post_id = ''){
        // Set Response
        $response = array();
        // Post Meta data
        $finder = get_post_meta($post_id,'ids',true);
        $season = get_post_meta($post_id,'temporada',true);
        // Verifications
        if(!empty($finder) && !empty($season)){
            // TMDb Json data
            $json_tmdb = $this->RemoteJson($this->arguments(),DBMOVIES_TMDBAPI.'/tv/'.$finder.'/season/'.$season);
            // verificate
            if(!$this->Disset($json_tmdb,'status_code')){
                // get Data
                $poster  = $this->Disset($json_tmdb,'poster_path');
                $airdate = $this->Disset($json_tmdb,'air_date');
                ################################ UPDATE POST META ##################################
                if(!empty($poster))
                    update_post_meta($post_id, 'dt_poster',sanitize_text_field($poster));
                if(!empty($airdate))
                    update_post_meta($post_id, 'air_date',sanitize_text_field($airdate));
                // Upload Image
                if(!empty($poster) && !has_post_thumbnail($post_id))
                    $this->UploadImage('https://image.tmdb.org/t/p/w780'.$poster, $post_id, true, false);
                #####################################################################################
                $response = $this->successfully($post_id,__d('season'));#############################
                #####################################################################################
            }else{
                $response = array(
                    'success' => false,
                    'message' => $this->Disset($json_tmdb,'status_message')
                );
            }
        } else {
            $response = array(
                'success' => false,
                'message' => __d('Undefined data')
            );
        }
        // The response
        return $response;
    }

    /**
    * @since 2.5.0
    * @version 1.0
    */
    private function episodes($post_id = ''){
        // Set Response
        $response = array();
        // Post Meta data
        $finder  = get_post_meta($post_id,'ids',true);
        $season  = get_post_meta($post_id,'temporada',true);
        $episode = get_post_meta($post_id,'episodio',true);
        // Verifications
        if(!empty($finder) && !empty($season) && !empty($episode)){
            // TMDb Json data
            $json_tmdb = $this->RemoteJson($this->arguments(),DBMOVIES_TMDBAPI.'/tv/'.$finder.'/season/'.$season.'/episode/'.$episode);
            // verificate
            if(!$this->Disset($json_tmdb,'status_code')){
                $airdate      = $this->Disset($json_tmdb,'air_date');
                $backdrop     = $this->Disset($json_tmdb,'still_path');
                $episode_name = $this->Disset($json_tmdb,'name');
                $backdrops = isset($json_tmdb['images']['stills']) ? $json_tmdb['images']['stills'] : false;
                // Compose Images
                $images = '';
                if($backdrops){
                    $image_count = 0;
                    foreach($backdrops as $image) if($image_count < 10){
                        if($image_count == 9){
                            $images.= $this->Disset($image,'file_path');
                        }else{
                            $images.= $this->Disset($image,'file_path')."\n";
                        }
                        $image_count++;
                    }
                }
                ################################ UPDATE POST META ##################################
                if(!empty($episode_name))
                    update_post_meta($post_id,'episode_name',sanitize_text_field($episode_name));
                if(!empty($backdrop))
                    update_post_meta($post_id,'dt_backdrop',sanitize_text_field($backdrop));
                if(!empty($airdate))
                    update_post_meta($post_id,'air_date',sanitize_text_field($airdate));
                if(!empty($images))
                    update_post_meta($post_id,'imagenes',esc_attr($images));
                // Upload Image
                if(!empty($backdrop) && !has_post_thumbnail($post_id))
                    $this->UploadImage('https://image.tmdb.org/t/p/w500'.$backdrop, $post_id, true, false);
                #####################################################################################
                $response = $this->successfully($post_id, __d('episode'));############################
                #####################################################################################
            }else{
                $response = array(
                    'success' => false,
                    'message' => $this->Disset($json_tmdb,'status_message')
                );
            }
        } else {
            $response = array(
                'success' => false,
                'message' => __d('Undefined data')
            );
        }
        // The response
        return $response;
    }
}

new DDbmoviesUpdater;
