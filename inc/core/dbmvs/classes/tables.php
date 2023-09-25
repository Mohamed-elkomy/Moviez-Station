<?php
/*
* ----------------------------------------------------
* @author: Doothemes
* @author URI: https://doothemes.com/
* @copyright: (c) 2021 Doothemes. All rights reserved
* ----------------------------------------------------
* @since 2.5.0
*/


class DDbmoviesTables extends DDbmoviesHelpers{
    /**
     * @since 2.5.0
     * @version 1.0
     */
    public function __construct(){
        // Actions Content
        add_action('manage_movies_posts_custom_column', array(&$this,'action_movies'), 10, 2);
        add_action('manage_tvshows_posts_custom_column', array(&$this,'action_tvshows'), 10, 2);
        add_action('manage_seasons_posts_custom_column', array(&$this,'action_seasons'), 10, 2);
        add_action('manage_episodes_posts_custom_column', array(&$this,'action_episodes'), 10, 2);
        // Filters Header
        add_filter('manage_movies_posts_columns', array(&$this,'filter_movies'));
        add_filter('manage_tvshows_posts_columns', array(&$this,'filter_tvshows'));
        add_filter('manage_seasons_posts_columns', array(&$this,'filter_seasons'));
        add_filter('manage_episodes_posts_columns', array(&$this,'filter_episodes'));
    }

    /**
     * @since 2.5.0
     * @version 1.0
     */
    public function action_movies($column_name, $post_id){
        $ids = get_post_meta($post_id,'ids',true);
        $tmdb = get_post_meta($post_id,'idtmdb',true);
        $rat = get_post_meta($post_id,DOO_MAIN_RATING,true);

        $viw = get_post_meta($post_id,'dt_views_count',true);
        $fea = get_post_meta($post_id,'dt_featured_post',true);
        $aut = get_post_meta($post_id,'auto_embed',true);
		$aut = ($aut == 1) ? 'ready' : 'none';
        // Composes
        $ids = $ids ? $ids : '&mdash;';
        $rat = $rat ? $rat : '0.0';
        $viw = $viw ? $viw : '0';
        switch($column_name){
            case 'imdbid':
                echo '<code>'.$ids.'</code>';
                break;
            case 'rating':
                echo $rat;
                break;
            case 'cviews':
                echo $viw;
                break;
            case 'featur':
                $hideA = ( 1 == $fea ) ? 'style="display:none"' : '';
                $hideB = ( 1 != $fea ) ? 'style="display:none"' : '';
                echo '<a id="feature-add-'.$post_id.'" class="button add-to-featured button-primary" data-postid="'.$post_id.'" data-nonce="'.wp_create_nonce('dt-featured-'.$post_id).'"  '.$hideA.'>'. __('Add'). '</a>';
                echo '<a id="feature-del-'.$post_id.'" class="button del-of-featured" data-postid="'.$post_id.'" data-nonce="'.wp_create_nonce('dt-featured-'.$post_id).'" '.$hideB.'>'. __('Remove'). '</a>';
                break;
				/* Bescraper.cf */
            case 'autoembed':
				if($aut != 'ready'){
					echo '<a id="autoembed-add-'.$post_id.'" class="button add-to-autoembed button-primary" data-postid="'.$post_id.'" data-nonce="'.wp_create_nonce('dt-autoembed-'.$post_id).'" data-imdb="'.$ids.'" data-tmdb="'.$tmdb.'" data-type="movies" data-se="" data-ep="">'. __('Fetch'). '</a>';
				}else{
					echo '<code class="'.$aut.'">Done</code>';
				}	
                break;							
        }
    }

    /**
     * @since 2.5.0
     * @version 1.0
     */
    public function filter_movies($defaults){
        $defaults['rating'] = __d('Rating');
        $defaults['imdbid'] = __d('IMDb ID');
        $defaults['cviews'] = __d('Views');
		$defaults['featur']	= __d('Featured');
		if(doo_is_true('auto_embed_method', 'besmv')){
			$defaults['autoembed'] = __d('Autoembed');
		}
	    return $defaults;
    }

    /**
     * @since 2.5.0
     * @version 1.0
     */
    public function action_tvshows($column_name, $post_id){
        $ids = get_post_meta($post_id,'ids',true);
        $rat = get_post_meta($post_id,DOO_MAIN_RATING,true);
        $ses = get_post_meta($post_id,'number_of_seasons',true);
        $viw = get_post_meta($post_id,'dt_views_count',true);
        $fea = get_post_meta($post_id,'dt_featured_post',true);
        $ctr = get_post_meta($post_id,'clgnrt',true);

        // composes
        $ids = $ids ? $ids : '&mdash;';
        $rat = $rat ? $rat : '0.0';
        $viw = $viw ? $viw : '0';
        $ses = $ses ? $ses : '0';
        $ctr = ($ctr == 1) ? 'ready' : 'none';

        switch($column_name){
            case 'idtmdb':
            if($ctr != 'ready'){
                echo '<a href="#" id="dbgesbtn_'.$post_id.'" class="button dbmvsarchiveseep" data-type="seasons" data-parent="'.$post_id.'" data-tmdb="'.$ids.'">'.__d('Get seasons').'</a>';
                echo '<span id="gnrtse_'.$post_id.'"></span>';
            }else{
                echo '<code class="'.$ctr.'">'.$ids.'</code>';
            }
            break;
            case 'rating':
                echo $rat;
                break;
            case 'season':
                echo $ses;
                break;
            case 'cviews':
                echo $viw;
                break;
            case 'featur':
                $hideA = ( 1 == $fea ) ? 'style="display:none"' : false;
			    $hideB = ( 1 != $fea ) ? 'style="display:none"' : false;
                echo '<a id="feature-add-'.$post_id.'" class="button add-to-featured button-primary" data-postid="'.$post_id.'" data-nonce="'.wp_create_nonce('dt-featured-'.$post_id).'"  '.$hideA.'>'. __('Add'). '</a>';
			    echo '<a id="feature-del-'.$post_id.'" class="button del-of-featured" data-postid="'.$post_id.'" data-nonce="'.wp_create_nonce('dt-featured-'.$post_id).'" '.$hideB.'>'. __('Remove'). '</a>';
                break;
        }
    }

    /**
     * @since 2.5.0
     * @version 1.0
     */
    public function filter_tvshows($defaults){
        $defaults['idtmdb'] = __d('ID TMDb');
        $defaults['rating'] = __d('Rating');
		$defaults['season'] = __d('Seasons');
        $defaults['cviews'] = __d('Views');
		$defaults['featur'] = __d('Featured');
	    return $defaults;
    }

    /**
     * @since 2.5.0
     * @version 1.0
     */
    public function action_seasons($column_name, $post_id){
        $ids = get_post_meta($post_id,'ids',true);
        $viw = get_post_meta($post_id,'dt_views_count',true);
        $ctr = get_post_meta($post_id,'clgnrt',true);
        $tvs = get_post_meta($post_id,'serie',true);
        $sea = get_post_meta($post_id,'temporada',true);
        // composes
        $ids = $ids ? $ids : '&mdash;';
        $viw = $viw ? $viw : '0';
        $ctr = ($ctr == 1) ? 'ready' : 'none';
        switch($column_name){
            case 'tvshow':
                if($tvs){
                    echo '<strong>'.$tvs.'</strong>';
                }else{
                    echo '&mdash;';
                }
            break;
            case 'tmdbid':
                if($ctr != 'ready'){
                    echo '<a href="#" id="dbgesbtn_'.$post_id.'" class="button dbmvsarchiveseep" data-type="episodes" data-parent="'.$post_id.'" data-tmdb="'.$ids.'" data-season="'.$sea.'">'.__d('Get episodes').'</a>';
                    echo '<span id="gnrtse_'.$post_id.'"></span>';
                } else {
                    echo '<code class="'.$ctr.'">'.$ids.'</code>';
                }
            break;
            case 'cviews':
                echo $viw;
                break;
        }
    }

    /**
     * @since 2.5.0
     * @version 1.0
     */
    public function filter_seasons($defaults){
        $defaults['tmdbid'] = __d('TMDb ID');
        $defaults['tvshow'] = __d('TV Show');
        $defaults['cviews'] = __d('Views');
        return $defaults;
    }

    /**
     * @since 2.5.0
     * @version 1.0
     */
    public function action_episodes($column_name, $post_id){
        $ids = get_post_meta($post_id,'ids',true);
        $viw = get_post_meta($post_id,'dt_views_count',true);
        $nam = get_post_meta($post_id,'episode_name',true);
        $tvs = get_post_meta($post_id,'serie',true);
        $se = get_post_meta($post_id,'temporada',true);
        $ep = get_post_meta($post_id,'episodio',true);
        $aut = get_post_meta($post_id,'auto_embed',true);
		$aut = ($aut == 1) ? 'ready' : 'none';		
        // composes
        $nam = $nam ? $nam : '&mdash;';
        $ids = $ids ? $ids : '&mdash;';
        $viw = $viw ? $viw : '0';
        switch($column_name){
            case 'episde':
                echo $nam.'<br>';
                echo '<small><strong>'.$tvs.'</strong></small>';
            break;
            case 'tmdbid':
                echo '<code>'.$ids.'</code>';
            break;
            case 'cviews':
                echo $viw;
            break;
				/* Bescraper.cf */
            case 'autoembed':
				if($aut != 'ready'){
					echo '<a id="autoembed-add-'.$post_id.'" class="button add-to-autoembed button-primary" data-postid="'.$post_id.'" data-nonce="'.wp_create_nonce('dt-autoembed-'.$post_id).'" data-tmdb="'.$ids.'" data-type="episodes" data-se="'.$se.'" data-ep="'.$ep.'">'. __('Fetch'). '</a>';
				}else{
					echo '<code class="'.$aut.'">Done</code>';
				}	
                break;			
        }
    }

    /**
     * @since 2.5.0
     * @version 1.0
     */
    public function filter_episodes($defaults){
        $defaults['episde'] = __d('Episode');
        $defaults['tmdbid'] = __d('TMDb ID');
        $defaults['cviews'] = __d('Views');
		if(doo_is_true('auto_embed_method', 'bestv')){
			$defaults['autoembed'] = __d('Autoembed');
		}
        return $defaults;
    }
}

new DDbmoviesTables;
