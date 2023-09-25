<?php
/*
* -------------------------------------------------------------------------------------
* @author: Bescraper
* @author URI: https://bescraper.cf/
* @copyright: (c) 2021 Bescraper. All rights reserved
* -------------------------------------------------------------------------------------
*
* @Version 1.1
*
*/
####################################################################################
############################	 	Bescraper.cf	 	############################
####################################################################################

define('Bes_embed','https://cdn.bescraper.cf/api');
define('Bes_key',get_option('dooplay_license_key'));
//define('Bes_key','e12fdce8e06e8856fdsd54f6d54');

add_action('wp_ajax_dt_add_autoembed', 'filter_auto_embed');

function filter_auto_embed() {
	$post_id = doo_isset($_REQUEST,'postid');
	$nonce	 = doo_isset($_REQUEST,'nonce');	
	$imdb	 = doo_isset($_REQUEST,'imdb');	
	$tmdb	 = doo_isset($_REQUEST,'tmdb');	
	$type	 = doo_isset($_REQUEST,'type');	
	$se		 = doo_isset($_REQUEST,'se');	
	$ep	 	 = doo_isset($_REQUEST,'ep');
	if($post_id && wp_verify_nonce( $nonce,'dt-autoembed-'.$post_id)) {
		if($type == 'movies'){
			bescraper_auto_embed_movies($imdb, $tmdb, $post_id);
		}else{
			bescraper_auto_embed_tvshow($tmdb, $se ,$ep, $post_id);
		}
	}
	die();	

}
// Auto embed for movies
function bescraper_auto_embed_movies($imdb, $tmdb, $post_id){
	$verf = get_post_meta($post_id, 'auto_embed', true);	
	if (doo_is_true('auto_embed_method', 'besmv') && $verf != 1) {
		$data = array(
			'timeout'   => 30,
			'sslverify' => false,
			'body' => array(
				'license' => Bes_key,		
				'imdb' => $imdb,
				'tmdb' => $tmdb
			)
		);
        $response = wp_remote_get(Bes_embed . '/movies/', $data);
		if (!is_wp_error($response)){
			$result = json_decode(wp_remote_retrieve_body($response), true);
		}
		$servers = array();
		if(doo_is_true('auto_embed_method', 'bes2e')){
			$servers[] = array(
				"name"   => '2ru',
				"select" => 'iframe',
				"idioma" => dooplay_get_option('besidoma',''),
				"url"    => 'https://www.2embed.ru/embed/imdb/movie?id='.$imdb
			);			
		}		
		if (!isset($result['error']) && $result['status'] == 1) {
			foreach ($result['servers'] as $single_data) {
				$servers[] = array(
						'name'	 => $single_data['name'],
						'select' => $single_data['select'],
						'idioma' => dooplay_get_option('besidoma',''),
						'url' 	 => stripslashes($single_data['url'])
				);
			}
		}
		if(!empty($servers) && is_array($servers)){
			$player  = get_post_meta($post_id, 'repeatable_fields', true);
			if($player && doo_is_true('auto_embed_method', 'besmr')){
				$player  = maybe_unserialize($player);
				$servers = array_merge($player, $servers);
			}
			update_post_meta($post_id, 'repeatable_fields', $servers);
			update_post_meta($post_id, 'auto_embed', sanitize_text_field('1'));			
			$cache = new DooPlayCache;
			$cache->delete($post_id.'_postmeta');				
		}
		// Auto Download links for movies
		if (!isset($result['error']) && $result['status'] == 1 && !empty($result['downloads'])) {
			$type = 'Download';			
			foreach ($result['downloads'] as $url) {
				$data = array(
					'type'    => $type,
					'url'     => $url['url'],
					'lang'    => 'English',
					'size'    => '', //1.2 GB
					'parent'  => $post_id,
					'quality' => 'HD', //1080P
				);
				if(filter_var($url['url'],FILTER_VALIDATE_URL) && doo_is_true('auto_embed_method', 'besli')){
					insert_links($data);
				}
			}
		}	
	}
}

//Auto embed for Tvshow->episodes
function bescraper_auto_embed_tvshow($tmdb, $se ,$ep, $post_id){
	$verf = get_post_meta($post_id, 'auto_embed', true);	
	if (doo_is_true('auto_embed_method', 'bestv') && $verf != 1) {	
		$data = array(
			'timeout'   => 30,
			'sslverify' => false,
			'body' => array(
				'license' => Bes_key,		
				'tmdb' => $tmdb,
				'se' => $se,
				'ep' => $ep
			)
		);
        $response = wp_remote_get(Bes_embed . '/tvshows/', $data);
		if (!is_wp_error($response)){
			$result = json_decode(wp_remote_retrieve_body($response), true);
		}
		$servers = array();
			if(doo_is_true('auto_embed_method', 'bes2e')){
				$servers[] = array(
					"name"   => '2ru',
					"select" => 'iframe',
					"idioma" => dooplay_get_option('besidoma',''),
					"url"  => 'https://www.2embed.ru/embed/tmdb/tv?id='.$tmdb.'&s='.$se.'&e='.$ep
				);			
			}		
		if (!isset($result['error']) && $result['status'] == 1) {
			foreach ($result['servers'] as $single_data) {
				$servers[] = array(
						'name'	 => $single_data['name'],
						'select' => $single_data['select'],
						'idioma' => dooplay_get_option('besidoma',''),
						'url' 	 => stripslashes($single_data['url'])
				);
			}
		}
		if(!empty($servers) && is_array($servers)){
			$player  = get_post_meta($post_id, 'repeatable_fields', true);
			if($player && doo_is_true('auto_embed_method', 'besmr')){
				$player  = maybe_unserialize($player);
				$servers = array_merge($player, $servers);
			}
			update_post_meta($post_id, 'repeatable_fields', $servers);
			update_post_meta($post_id, 'auto_embed', sanitize_text_field('1'));
			$cache = new DooPlayCache;
			$cache->delete($post_id.'_postmeta');				
		}		
	}
}

function insert_links($data){
	if(is_array($data)){
		$url     = doo_isset($data,'url');
		$lang    = doo_isset($data,'lang');
		$size    = doo_isset($data,'size');
		$type    = doo_isset($data,'type');
		$parent  = doo_isset($data,'parent');
		$quality = doo_isset($data,'quality');
		if($url && $parent){
			$post = array(
				'post_title'  => insert_key(),
				'post_status' => 'publish',
				'post_type'   => 'dt_links',
				'post_parent' => $parent,
				'post_author' => get_current_user_id(),
			);
			$post_id = wp_insert_post($post);
			if($post_id){
				// Add Post Metas
				if(filter_var($url, FILTER_VALIDATE_URL)){
					add_post_meta($post_id, '_dool_url', esc_url($url), true);
				} else {
					add_post_meta($post_id, '_dool_url', sanitize_text_field($url), true);
				}
				if($lang)
					add_post_meta($post_id, '_dool_lang', sanitize_text_field($lang), true);
				if($size)
					add_post_meta($post_id, '_dool_size', sanitize_text_field($size), true);
				if($type)
					add_post_meta($post_id, '_dool_type', sanitize_text_field($type), true);
				if($quality)
					add_post_meta($post_id, '_dool_quality', sanitize_text_field($quality), true);
			}
		}
	}
}

function insert_key(){
        $string  = 'abcdefhiklmnorstuvwxz1234567890ABCDEFGHIJKLMNOPQRSTUVWYZ';
        $comkey  = array();
        $stringL = strlen($string) - 1;
        for ($i = 0; $i < 10; $i++) {
            $n = rand(0, $stringL);
            $comkey[] = $string[$n];
        }
        return implode($comkey);
}