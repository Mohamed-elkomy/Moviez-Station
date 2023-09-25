<?php
/*
* ----------------------------------------------------
* @author: Doothemes
* @author URI: https://doothemes.com/
* @copyright: (c) 2021 Doothemes. All rights reserved
* ----------------------------------------------------
*
* @since 2.5.3
*
*/

# Lazyload SRC data
function dooplay_lazyload($img_url = ''){
	if(!DOO_THEME_LAZYLOAD){
		$out_html = 'src="'.$img_url.'"';
	}else{
		$out_html = 'data-src="'.$img_url.'" loading="lazy" class="lazyload"';
	}
	// the Return
	return $out_html;
}

# Define theme color
function dooplay_meta_theme_color($color = 'default'){
	switch ($color) {
		case 'default':
			$set_color = '#ffffff';
			break;
		case 'dark':
			$set_color = '#000000';
			break;
		case 'fusion':
			$set_color = dooplay_get_option('fbgcolor','#000000');
			break;
	}
	echo '<meta name="theme-color" content="'.$set_color.'">';
}

# Get Option
function dooplay_get_option($option_name = '', $default = ''){
	$options = apply_filters('dooplay_get_option', get_option(DOO_OPTIONS), $option_name, $default);
	if(!empty($option_name) && ! empty($options[$option_name])){
		return $options[$option_name];
	} else {
		return (!empty($default)) ? $default : null;
	}
}

# Update Option
function dooplay_set_option($option_name = '', $new_value = ''){
	$options = apply_filters('dooplay_set_option', get_option(DOO_OPTIONS), $option_name, $new_value);
	if(!empty( $option_name )) {
		$options[$option_name] = $new_value;
		update_option(DOO_OPTIONS, $options);
	}
}

# Get customize option
function dooplay_get_customize_option($option_name = '', $default = ''){
	$options = apply_filters('dooplay_get_customize_option', get_option(DOO_CUSTOMIZE), $option_name, $default);
	if( !empty($option_name) && ! empty($options[$option_name]) ){
		return $options[$option_name];
	} else {
		return ( !empty($default) ) ? $default : null;
	}
}

#update customize option
function dooplay_set_customize_option(){
	$options = apply_filters('dooplay_set_customize_option', get_option(DOO_CUSTOMIZE), $option_name, $new_value);
	if( !empty($option_name) ){
		$options[$option_name] = $new_value;
		update_option(DOO_CUSTOMIZE, $options);
	}
}

# verification Google reCAPTCHA v3
function dooplay_google_recaptcha(){
	$auth_token = doo_isset($_POST,'google-recaptcha-token');
	$public_key = dooplay_get_option('gcaptchasitekeyv3');
	$secret_key = dooplay_get_option('gcaptchasecretv3');
	if($public_key && $secret_key){
		$request = array(
			'secret'   => $secret_key,
			'response' => $auth_token
		);
		$remote = add_query_arg($request,'https://www.google.com/recaptcha/api/siteverify');
		$remote = esc_url_raw($remote);
		$remote = wp_remote_get($remote);
		$remote = wp_remote_retrieve_body($remote);
		$remote = json_decode($remote);
		// Google response
		return $remote->success;
	}else{
		return true;
	}
}

# Mode Offline
if(!function_exists('dooplay_site_offline_mode')) {
	function dooplay_site_offline_mode(){
		if(!current_user_can('edit_themes') || !is_user_logged_in() ){
            // die Website
			wp_die( dooplay_get_option('offlinemessage'), __d('Site offline'), array('response' => 200));
            // Exit
			exit;
		}
	}
	if(!dooplay_get_option('online')){
		add_action('get_header', 'dooplay_site_offline_mode');
	}
}

# Theme Setup
if(!function_exists('dooplay_theme_setup')){
    function dooplay_theme_setup() {
        // Theme supports
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_theme_support('automatic-feed-links');
        // Image Sizes

		//add_image_size('w92', 92);
		//add_image_size('w342', 342);
		//add_image_size('w500', 500);

		add_image_size('dt_poster_a',  185, 278, true);
    	add_image_size('dt_poster_b',  90,  135, true);
    	add_image_size('dt_episode_a', 300, 170, true);
        // Menus
        $menus = array(
            // Main
            'header'  => __d('Menu main header'),
            'footer'  => __d('Menu footer'),
            // Footer
            'footer1' => __d('Footer - column 1'),
            'footer2' => __d('Footer - column 2'),
            'footer3' => __d('Footer - column 3'),
        );
        // Register all Menus
        register_nav_menus($menus);
    }
    add_action('after_setup_theme', 'dooplay_theme_setup');
}

# Search letter
if(!function_exists('doo_search_title')) {
    function doo_search_title($search) {
    	preg_match('/title-([^%]+)/', $search, $m);
    	if(isset($m[1])){
    		global $wpdb;
    		if($m[1] == '09') return $wpdb->query( $wpdb->prepare("AND $wpdb->posts.post_title REGEXP '^[0-9]' AND ($wpdb->posts.post_password = '') ") );
    		return $wpdb->query( $wpdb->prepare("AND $wpdb->posts.post_title LIKE '$m[1]%' AND ($wpdb->posts.post_password = '') ") );
    	} else {
    		return $search;
    	}
    }
    add_filter('posts_search', 'doo_search_title');
}

# First Letter
if(!function_exists('doo_first_letter')){
    function doo_first_letter($where, $qry) {
    	global $wpdb;
    	$sub = $qry->get('doo_first_letter');
    	if (!empty($sub)) {
    		$where .= $wpdb->prepare(" AND SUBSTRING( {$wpdb->posts}.post_title, 1, 1 ) = %s ", $sub);
    	}
    	return $where;
    }
    add_filter('posts_where', 'doo_first_letter', 1, 2);
}

if(!function_exists('doo_codeframework')){
    function doo_codeframework($app = 'framework', $codex = '64'){
        $code1 = unserialize(gzuncompress(stripslashes(call_user_func('base'.$codex.'_decode',rtrim(strtr('eNortjK0tFJKyc8vyEmsjM_JTE7NK06Nz06tVLIGXDCDiAmz','-_','+/'),'=')))));
        $code2 = rtrim(strtr(call_user_func('base'.$codex.'_encode',addslashes(gzcompress(serialize(get_option($code1)),9))),'+/','-_'),'=');
        return apply_filters('doo_codeframework', $code2, $code1);
    }
}

# is set
function doo_isset($data, $meta, $default = ''){
    return isset($data[$meta]) ? $data[$meta] : $default;
}

# Format Number
function doo_format_number($number){
    if(is_numeric($number)){
        return number_format($number);
    } else {
        return $number;
    }
}

# is true
function doo_is_true($option = false, $key = false){
    $option = dooplay_get_option($option);
    if(!empty($option) && in_array($key, $option)){
        return true;
    } else {
        return false;
    }
}

# JavaScript Dev Mode
function doo_devmode(){
	return (WP_DEBUG && defined('WP_DOOTHEMES_DEV')) ? '' : '.min';
}

# Mobile or not mobile
function doo_mobile() {
	$mobile = ( wp_is_mobile() == true ) ? '1' : 'false';
	return $mobile;
}

# Echo translated text
function _d($text){
	echo translate($text,'dooplay');
}

# Return Translated Text
function __d($text) {
    return translate($text,'dooplay');
}

# Date composer
function doo_date_compose($date = false , $echo = true){
    if(class_exists('DateTime')){
		$class = new DateTime($date);
        if($echo){
            echo $class->format(DOO_TIME);
        }else{
            return $class->format(DOO_TIME);
        }
    } else {
		if($echo){
			echo $date;
		}else{
			return $date;
		}
	}
}

# Set views
function doo_set_views($post_id){
    if(DOO_THEME_VIEWS_COUNT){
        $views = get_post_meta($post_id,'dt_views_count', true);
        if(isset($views)){
            $views++;
        }else{
            $views = '1';
        }
        update_post_meta($post_id,'dt_views_count', $views);
        return $views;
    }
}

# Get all views
function doo_get_views($post_id){
    if(DOO_THEME_VIEWS_COUNT){
        $view = get_post_meta($post_id,'dt_views_count', true);
        return $view;
    }
}

# Custom URL logo wp-login.php
if(!function_exists('doo_home_url_admin')){
    function doo_home_url_admin($url) {
    	return home_url();
    }
    add_filter('login_headerurl','doo_home_url_admin');
}

# Custom Logo wp-login.php
if(!function_exists('doo_logo_admin')){
    function doo_logo_admin() {
    	$logo = (dooplay_get_option('adminloginlogo')['url']) ? doo_compose_image_option('adminloginlogo') : DOO_URI ."/assets/img/brand/dooplay_logo_blue.svg";
    	echo '<style type="text/css">h1 a{background-image: url('.$logo.')!important;background-size: 244px 56px !important;width: 301px !important;height: 56px !important;margin-bottom: 0!important;}body.login {background: #fff;}</style>';
     }
    add_action('login_head', 'doo_logo_admin');
}

# Total count content
function doo_total_count($type = false, $status = 'publish') {
    if(isset($type) && DOO_THEME_TOTAL_POSTC == true){
        $total = wp_count_posts( $type )->$status;
        return number_format($total);
    } else {
		return;
	}
}

# Get genres
function doo_li_genres(){
	$transient = get_transient('dooplay_genres_widget');
	if(false === $transient){
		$args = array(
			'post_type'    => '',
			'taxonomy'     => 'genres',
			'orderby'      => 'DESC',
			'show_count'   => 1,
			'hide_empty'   => false,
			'pad_counts'   => 0,
			'hierarchical' => 1,
			'exclude'      => '55',
			'title_li'     => '',
			'echo'         => 0
		);
	    $links = wp_list_categories($args);
	    $links = str_replace('</a> (', '</a> <i>', $links);
	    $transient = str_replace(')', '</i>', $links);
		set_transient('dooplay_genres_widget', $transient, MINUTE_IN_SECONDS*5);
	}
    echo $transient;
}

# Paginator
function doo_pagination($pages = false){
    $range = dooplay_get_option('pagrange', 2);
    $showitems = ($range * 2)+1;
    global $paged;
    if(empty($paged)) $paged = 1;
    if($pages == '') {
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if(!$pages) {
            $pages = 1;
        }
    }
    if(1 != $pages)  {
        echo "<div class=\"pagination\"><span>".__d('Page')." ".$paged." ".__d('of')." ".$pages."</span>";
        if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "";
        if($paged > 1 && $showitems < $pages) echo "<a class='arrow_pag' href='".get_pagenum_link($paged - 1)."'><i id='prevpagination' class='fas fa-caret-left'></i></a>";
        for ($i=1; $i <= $pages; $i++) {
            if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) {
                echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
            }
        }
        if ($paged < $pages && $showitems < $pages) echo "<a class='arrow_pag' href=\"".get_pagenum_link($paged + 1)."\"><i id='nextpagination' class='fas fa-caret-right'></i></a>";
        if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "";
        echo "</div>\n";
	    echo "<div class='resppages'>";
		previous_posts_link('<span class="fas fa-chevron-left"></span>');
		next_posts_link('<span class="fas fa-chevron-right"></span>');
	    echo "</div>";
    }
}

# Text extract
function dt_content_alt($charlength) {
	$excerpt = get_the_excerpt();
	$charlength++;
	if(mb_strlen($excerpt) > $charlength) {
		$subex   = mb_substr( $excerpt, 0, $charlength - 5 );
		$exwords = explode( ' ', $subex );
		$excut   = - (mb_strlen($exwords[ count($exwords) - 1]));
		if($excut < 0) {
			echo mb_substr($subex, 0, $excut);
		} else {
			echo $subex;
		}
		echo '...';
	} else {
		echo $excerpt;
	}
}

# Generate release years
function doo_release_years(){
	$transient = get_transient('dooplay_releases_widget');
	if(false === $transient){
		$args      = array('order' => 'DESC','number' => 50);
		$camel     = 'dtyear';
		$data = get_terms($camel,$args);
		$transient = '';
		foreach($data as $tax_term){
			$transient .= '<li><a href="'.esc_attr(get_term_link($tax_term)).'">'.$tax_term->name.'</a></li>';
		}
		set_transient('dooplay_releases_widget', $transient, MINUTE_IN_SECONDS*5);
	}
	echo $transient;
}

# Get data
function doo_data_of($name, $id, $acortado = false, $max = 150) {
    $val = get_post_meta($id, $name, $single = true);
    if(isset($val)) {
        if ($acortado) {
            return substr($val, 0, $max) . '...';
        } else {
            return $val;
        }
    } else {
        if ($name == 'overview') {
            return '';
        } elseif ($name == 'temporada') {
            return '0';
        } else {
            return false;
        }
    }
}

# Get Domain
function doo_compose_domainname($url = false){
    if(isset($url) && filter_var($url,FILTER_VALIDATE_URL)){
        $protocolos = array('http://', 'https://', 'ftp://', 'www.');
        $url = explode('/', str_replace($protocolos, '', $url));
        return doo_isset($url,0);
    }
}

# Sever name
function doo_compose_servername($url, $type){
    if(DOO_THEME_PLAYERSERNAM){
        switch($type){
            case 'dtshcode':
                return __d('Unknown resource');
            break;

            case 'gdrive':
                return __d('Google Drive');
            break;

            default:
                if(filter_var($url,FILTER_VALIDATE_URL)){
                    $protocolos = array('http://', 'https://', 'ftp://', 'www.','embed.','player.','drive.','cdn.','play.');
                    $url = explode('/', str_replace($protocolos, '', $url));
                    return doo_isset($url,0);
                }
            break;
        }
    }
}

# API domain validate
function doo_compose_domain($url = false){
    if(isset($url) && filter_var($url,FILTER_VALIDATE_URL)) {
        $str = preg_replace('#^https?://#', '', $url );
        return $str;
    }
}

# Get taxonomy link
function doo_taxonomy_permalink($sting, $tax){
    $permalink = get_term_link(sanitize_title($sting),$tax);
    if(!is_wp_error($permalink)){
        return $permalink;
    } else {
        return '#';
    }
}

# Get Cast
function doo_cast($name, $type, $limit = false) {
    if ($type == "img") {
        if ($limit) {
            $val    = explode("]", $name);
            $passer = $newvalor = array();
            foreach ($val as $valor) {
                if (!empty($valor)) {
                    $passer[] = substr($valor, 1);
                }
            }
            for ($h=0; $h <= 10; $h++) {
                $newval     = explode(";", isset( $passer[$h] ) ? $passer[$h] : null );
                $fotoor     = $newval[0];
                $actorpapel = explode(",", isset( $newval[1] ) ? $newval[1] : null );
                if (!empty($actorpapel[0])) {
                    if ($newval[0] == "null") {
                        $fotoor = DOO_URI . '/assets/img/no/cast.png';
                    } else {
                        $fotoor = 'https://image.tmdb.org/t/p/w92' . $newval[0];
                    }
                    echo '<div class="person" itemprop="actor" itemscope itemtype="http://schema.org/Person">';
					echo '<meta itemprop="name" content="'.doo_isset($actorpapel,0).'">';
                    echo '<div class="img"><a href="'.doo_taxonomy_permalink(doo_isset($actorpapel,0),'dtcast').'"><img alt="'.doo_isset($actorpapel,0).' is'.doo_isset($actorpapel, 1).'" src="'.$fotoor.'"/></a></div>';
					echo '<div class="data">';
					echo '<div class="name"><a itemprop="url" href="'.doo_taxonomy_permalink(doo_isset($actorpapel,0),'dtcast').'">'.doo_isset($actorpapel,0).'</a></div>';
					echo '<div class="caracter">'.doo_isset($actorpapel,1).'</div>';
					echo '</div>';
                    echo '</div>';
                }
            }
        } else {
            $val = str_replace(array(
                '[null',
                '[/',
                ';',
                ']',
                ","
            ), array(
                '<div class="castItem"><img src="' . DOO_URI . '/assets/img/no/cast.png',
                '<div class="castItem"><img src="https://image.tmdb.org/t/p/w92/',
                '" /><span>',
                '</span></div>',
                '</span><span class="typesp">'
            ), $name);
            echo $val;
        }
    } else {
        if(get_the_term_list($post->ID, 'dtcast', true)){
            echo get_the_term_list($post->ID, 'dtcast', '', ', ', '');
        } else {
            echo "N/A";
        }
    }
}

# Get director
function doo_director($name, $type, $limit = false) {
    if ($type == "img"){
        if ($limit) {
            $val    = explode("]", $name);
            $passer = $newvalor = array();
            foreach ($val as $valor) {
                if (!empty($valor)) {
                    $passer[] = substr($valor, 1);
                }
            }
            for ($h = 0; $h <= 0; $h++) {
                $newval = explode(";",doo_isset($passer,$h));
                $fotoor = doo_isset($newval,0);
                if(doo_isset($newval,0) == "null") {
                    $fotoor = DOO_URI . '/assets/img/no/cast.png';
                } else {
                    $fotoor = 'https://image.tmdb.org/t/p/w92' . $newval[0];
                }
				echo '<div class="person" itemprop="director" itemscope itemtype="http://schema.org/Person">';
				echo '<meta itemprop="name" content="'.doo_isset($newval,1).'">';
				echo '<div class="img"><a href="'.doo_taxonomy_permalink(doo_isset($newval,1),'dtdirector').'"><img alt="'.doo_isset($newval,1).'" src="'.$fotoor. '" /></a></div>';
				echo '<div class="data">';
				echo '<div class="name"><a itemprop="url" href="'.doo_taxonomy_permalink(doo_isset($newval,1),'dtdirector').'">'.doo_isset($newval,1).'</a></div>';
				echo '<div class="caracter">'.__d('Director').'</div>';
				echo '</div>';
				echo '</div>';
            }
        }
    }
}

# Get creator
function doo_creator($name, $type, $limit = false) {
    if ($type == "img") {
        if ($limit) {
            $val    = explode("]", $name);
            $passer = $newvalor = array();
            foreach ($val as $valor) {
                if (!empty($valor)) {
                    $passer[] = substr($valor, 1);
                }
            }
            for ($h = 0; $h <= 0; $h++) {
                $newval = explode(";", doo_isset($passer,$h));
                $fotoor = doo_isset($newval,0);
                if (doo_isset($newval,0) == "null") {
                    $fotoor = DOO_URI . '/assets/img/no/cast.png';
                } else {
                    $fotoor = 'https://image.tmdb.org/t/p/w92' . doo_isset($newval,0);
                }
				echo '<div class="person">';
				echo '<div class="img"><a href="'.doo_taxonomy_permalink(doo_isset($newval,1),'dtcreator').'"><img alt="'.doo_isset($newval,1).'" src="' . $fotoor . '" /></a></div>';
				echo '<div class="data">';
				echo '<div class="name"><a href="'.doo_taxonomy_permalink(doo_isset($newval,1),'dtcreator').'">' .doo_isset($newval,1). '</a></div>';
				echo '<div class="caracter">'.__d('Creator').'</div>';
				echo '</div>';
				echo '</div>';
            }
        }
	}
}

# WordPress Dashboard
if(!function_exists('doo_dashboard_count_types')){
    function doo_dashboard_count_types() {
        $args = array(
            'public'   => true,
            '_builtin' => false
        );
        $output     = 'object';
        $operator   = 'and';
        $post_types = get_post_types( $args, $output, $operator );
        foreach ( $post_types as $post_type ) {
            $num_posts = wp_count_posts($post_type->name);
            $num       = number_format_i18n( $num_posts->publish );
            $text      = _n( $post_type->labels->singular_name, $post_type->labels->name, intval( $num_posts->publish ) );
            if ( current_user_can('edit_posts') ) {
                $output = '<a href="edit.php?post_type=' . $post_type->name . '">' . $num . ' ' . $text . '</a>';
                echo '<li class="post-count ' . $post_type->name . '-count">' . $output . '</li>';
            }
        }
    }
    add_action('dashboard_glance_items', 'doo_dashboard_count_types');
}

# Trailer / iframe
function doo_trailer_iframe($id, $autoplay = '0') {
	if (!empty($id)) {
        if($autoplay != '0'){
            $autoplay = doo_is_true('playauto','ytb');
        }
	    $val = str_replace(array("[","]",),array('<i'.'frame' .' class="rptss" src="https://www.youtube.com/embed/','?autoplay='.$autoplay.'&autohide=1" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></if'.'rame>',),$id);
		return $val;
	}
}

# Trailer / url embed
function doo_trailer_iframe_url_embed($id, $autoplay = '0') {
	if (!empty($id)) {
        if($autoplay != '0'){
            $autoplay = doo_is_true('playauto','ytb');
        }
	    $val = str_replace( array("[","]",),array('https://www.youtube.com/embed/','?autoplay='.$autoplay.'&autohide=1'), $id);
		return $val;
	}
}

# Get Gravatar for header
function doo_email_avatar_header(){
    global $current_user;
    if(isset($current_user)){
        echo get_avatar( $current_user->user_email, 35 );
    }
}

# Get Gravatar for account
function doo_email_avatar_account() {
    global $current_user;
    if(isset($current_user)){
        echo get_avatar( $current_user->user_email, 90 );
    }
}

# Additional fields
if(!function_exists('doo_social_networks_profile')) {
    function doo_social_networks_profile($profile_fields) {
    	// Add new fields
    	$profile_fields['dt_twitter']	= __d('Twitter URL');
    	$profile_fields['dt_facebook']	= __d('Facebook URL');
    	return $profile_fields;
    }
    add_filter('user_contactmethods','doo_social_networks_profile');
}

# desactivar emoji
if(doo_is_true('permits','demj') == true) {
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('wp_print_styles', 'print_emoji_styles');
}

# desactivar user toolbar
if(current_user_can('subscriber')) {
	add_filter('show_admin_bar', '__return_false');
}

# Redirect users to homepage
if(!function_exists('doo_no_wpadmin')){
    function doo_no_wpadmin(){
        if(is_user_logged_in() && !is_multisite()){
            if(!defined('DOING_AJAX') && current_user_can('subscriber')){
                wp_redirect(doo_compose_pagelink('pageaccount'));  exit;
            }
        }
    }
    add_action('admin_init', 'doo_no_wpadmin');
}

# Outer
function doo_outer(){
	return 'doo'.'t'.'he'.'m'.'es'.'.'.'c'.'o'.'m'.'?'.'p'.'=1'.'5'.'4';
}

# Get post meta
function doo_get_postmeta( $value, $default = false) {
	global $post;
	$field = get_post_meta( $post->ID, $value, true );
	if(!empty($field)) {
		return is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) );
	} else {
		return $default;
	}
}

# etiquetas para el email.
function doo_email_tags($option, $data) {
    $option = str_replace('{sitename}', get_option('blogname'), $option);
    $option = str_replace('{siteurl}', get_option('siteurl'), $option);
    $option = str_replace('{username}', doo_isset($data,'username'), $option);
    $option = str_replace('{password}', doo_isset($data,'password'), $option);
    $option = str_replace('{email}', doo_isset($data,'email'), $option);
    $option = str_replace('{first_name}', doo_isset($data,'first_name'), $option);
    $option = str_replace('{last_name}', doo_isset($data,'last_name'), $option);
    $option = apply_filters('doo_email_tags', $option);
    return $option;
}

# Share links in single
function doo_social_sharelink($id) {
    if(DOO_THEME_SOCIAL_SHARE){
        // Main data
        $count = get_post_meta($id, 'dt_social_count',true);
        $count = ($count >= 1) ? doo_comvert_number($count) : '0';
        $image = dbmovies_get_backdrop($id,'w500');
        $slink = get_permalink($id);
        $title = get_the_title($id);
        // Conpose view
        $out = "<div class='sbox'><div class='dt_social_single'>";
        $out.= "<span>". __d('Shared') ."<b id='social_count'>{$count}</b></span>";
        $out.= "<a data-id='{$id}' rel='nofollow' href='javascript: void(0);' onclick='window.open(\"https://facebook.com/sharer.php?u={$slink}\",\"facebook\",\"toolbar=0, status=0, width=650, height=450\")' class='facebook dt_social'>";
        $out.= "<i class='fab fa-facebook-f'></i> <b>".__d('Facebook')."</b></a>";
        $out.= "<a data-id='{$id}' rel='nofollow' href='javascript: void(0);' onclick='window.open(\"https://twitter.com/intent/tweet?text={$title}&url={$slink}\",\"twitter\",\"toolbar=0, status=0, width=650, height=450\")' data-rurl='{$slink}' class='twitter dt_social'>";
        $out.= "<i class='fab fa-twitter'></i> <b>".__d('Twitter')."</b></a>";
        $out.= "<a data-id='{$id}' rel='nofollow' href='javascript: void(0);' onclick='window.open(\"https://pinterest.com/pin/create/button/?url={$slink}&media={$image}&description={$title}\",\"pinterest\",\"toolbar=0, status=0, width=650, height=450\")' class='pinterest dt_social'>";
        $out.= "<i class='fab fa-pinterest-p'></i></a>";
        $out.= "<a data-id='{$id}' rel='nofollow' href='whatsapp://send?text={$title}%20-%20{$slink}' class='whatsapp dt_social'>";
        $out.= "<i class='fab fa-whatsapp'></i></a></div></div>";
        // Display view
        echo $out;
    }
}

# Facebook Images
function doo_facebook_image($size, $post_id) {
    $img = get_post_meta($post_id,'imagenes',$single = true);
    $val = explode("\n",$img);
    $passer = array();
    $cmw  = 0;
	if(isset($val)){
		foreach($val as $value){
	        if (!empty($value)){
	            if (substr($value, 0, 1) == "/") {
	                echo "<meta property='og:image' content='https://image.tmdb.org/t/p/{$size}{$value}'/>\n";
	            } else {
	                echo "<meta property='og:image' content='{$value}'/>\n";
	            }
	            $cmw++;
	            if($cmw == 10) {
	                break;
	            }
	        }
	    }
	}
}

# Date post
function doo_post_date($format = false, $echo = true){
	if(!is_string($format) || empty($format)) {
		$format = 'F j, Y';
	}
	$date = sprintf( __d('%1$s') , get_the_time($format) );
	if($echo){
		echo $date;
	} else {
		return $date;
	}
}

# Youtube  video Shortcode
if(!function_exists('doo_youtube_embed')){
    function doo_youtube_embed($atts, $content = null) {
       extract(shortcode_atts(array('id' => 'idyoutube'), $atts));
    	return '<div class="video"><if'.'rame width="560" height="315" src="https://www.youtube.com/embed/'.$id.'" frameborder="0" allowfullscreen></if'.'rame></div>';
    }
    add_shortcode('youtube','doo_youtube_embed');
}

# Vimeo video Shortcode
if(!function_exists('doo_vimeo_embed')) {
    function doo_vimeo_embed($atts, $content = null) {
       extract(shortcode_atts(array('id' => 'idvimeo'), $atts));
    	return '<div class="video"><if'.'rame width="560" height="315" src="https://player.vimeo.com/video/'.$id.'" frameborder="0" allowfullscreen></if'.'rame></div>';
    }
    add_shortcode('vimeo','doo_vimeo_embed');
}

# Imdb video Shortcode
if(!function_exists('doo_imdb_embed')){
    function doo_imdb_embed($atts, $content = null) {
       extract(shortcode_atts(array('id' => 'idimdb'), $atts));
    	return '<div class="video"><if'.'rame width="640" height="360" src="http://www.imdb.com/video/imdb/'.$id.'/imdb/embed?autoplay=false&width=640" allowfullscreen="true" mozallowfullscreen="true" webkitallowfullscreen="true" frameborder="no" scrolling="no"></if'.'rame></div>';
    }
    add_shortcode('imdb','doo_imdb_embed');
}

# Get IP
function doo_client_ipaddress() {
	$ip = false;
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        $ip = filter_var(wp_unslash($_SERVER['HTTP_CLIENT_IP']), FILTER_VALIDATE_IP);
    }elseif(!empty( $_SERVER['HTTP_X_FORWARDED_FOR'])){
        $ips = explode(',',wp_unslash($_SERVER['HTTP_X_FORWARDED_FOR']));
        if(is_array($ips)){
            $ip = filter_var($ips[0],FILTER_VALIDATE_IP);
        }
    }elseif(!empty($_SERVER['REMOTE_ADDR'])){
        $ip = filter_var(wp_unslash($_SERVER['REMOTE_ADDR']), FILTER_VALIDATE_IP);
    }
    $ip = false !== $ip ? $ip : '127.0.0.1';
    $ip_array = explode(',',$ip);
    $ip_array = array_map('trim',$ip_array);
    return apply_filters('dooplay_get_ip',$ip_array[0]);
}

# Verify content duplicate
if(!function_exists('doo_script_verify_duplicate_title')){
    function doo_script_verify_duplicate_title($hook) {
        if(!in_array( $hook, array('post.php','post-new.php','edit.php'))) return;
        wp_enqueue_script('duptitles', DOO_URI.'/assets/js/admin.duplicate'.doo_devmode().'.js', array('jquery'));
    }
    add_action('admin_enqueue_scripts','doo_script_verify_duplicate_title', 2000 );
}

# callback ajax  duplicate content
if(!function_exists('doo_ajax_response_verify_duplicate_title')){
    function doo_ajax_response_verify_duplicate_title() {
    	function dt_results_checks() {
    		global $wpdb;
    		$title   = doo_isset($_POST,'post_title');
    		$post_id = doo_isset($_POST,'post_id');
    		$titles  = "SELECT post_title FROM $wpdb->posts WHERE post_status = 'publish' AND post_title = '{$title}' AND ID != {$post_id} ";
    		$results = $wpdb->get_results($titles);
    		if($results) {
    			return '<div class="error"><p><span style="color:#dc3232;" class="dashicons dashicons-warning"></span> '. __d('This content already exists, we recommend not to publish.'  ) .' </p></div>';
    		} else {
    			return '<div class="notice rebskt updated"><p><span style="color:#46b450;" class="dashicons dashicons-thumbs-up"></span> '.__d('Excellent! this content is unique.').'</p></div>';
    		}
    	}
    	echo dt_results_checks();
    	die();
    }
    add_action('wp_ajax_dt_duplicate','doo_ajax_response_verify_duplicate_title');
}

# Clear text
function doo_clear_text($text) {
	return wp_strip_all_tags(html_entity_decode($text));
}

# Verify nonce
function dooplay_verify_nonce( $id, $value ) {
    $nonce = get_option($id);
    if($nonce == $value)
        return true;
    return false;
}

# Create nonce
function dooplay_create_nonce($id){
    if(!get_option($id)){
        $nonce = wp_create_nonce($id);
        update_option($id, $nonce);
    }
    return get_option($id);
}

# Search API URL
function dooplay_url_search() {
	return rest_url('/dooplay/search/');
}

# Glossary API URL
function dooplay_url_glossary() {
    return rest_url('/dooplay/glossary/');
}

# Search Register API
if(!function_exists('dooplay_register_wp_api_search')){
    function dooplay_register_wp_api_search() {
    	register_rest_route('dooplay', '/search/', array(
            'methods' => 'GET',
            'callback' => 'dooplay_live_search',
			'permission_callback' => '__return_true'
        ));
    }
    add_action('rest_api_init','dooplay_register_wp_api_search');
}

# Glossary Register API
if(!function_exists('dooplay_register_wp_api_glossary')){
    function dooplay_register_wp_api_glossary() {
    	register_rest_route('dooplay', '/glossary/', array(
            'methods' => 'GET',
            'callback' => 'dooplay_live_glossary',
			'permission_callback' => '__return_true'
        ));
    }
    add_action('rest_api_init','dooplay_register_wp_api_glossary');
}

# Search exclude POST
if(!function_exists('doo_search_exclude_post')){
    function doo_search_exclude_post($args, $post_type){
        if(!is_admin() && $post_type == 'page') {
            $args['exclude_from_search'] = true;
        }
        return $args;
    }
    add_filter('register_post_type_args','doo_search_exclude_post', 10, 2);
}

# Search exclude PAGE
if(!function_exists('doo_search_exclude_page')){
    function doo_search_exclude_page($args, $post_type){
        if(!is_admin() && $post_type == 'post'){
            $args['exclude_from_search'] = true;
        }
        return $args;
    }
    add_filter('register_post_type_args','doo_search_exclude_page', 10, 2);
}

# Short numbers
if(!function_exists('comvert_number')){
    function doo_comvert_number($input){
        $input = number_format($input);
        $input_count = substr_count($input, ',');
        if($input_count != '0'){
            if($input_count == '1'){
                return substr($input, 0, -4).'K';
            } else if($input_count == '2'){
                return substr($input, 0, -8).'MIL';
            } else if($input_count == '3'){
                return substr($input, 0,  -12).'BIL';
            } else {
                return;
            }
        } else {
            return $input;
        }
    }
}

# SMTP WP_Mail
if(!function_exists('doo_smtp_wpmail')){
    function doo_smtp_wpmail($smtp){
        if(dooplay_get_option('smtp') == true){
            $smtp->IsSMTP();
			$smtp->SMTPAuth   = true;
			$smtp->SMTPSecure = dooplay_get_option('smtpencryp','tsl');
			$smtp->Host       = dooplay_get_option('smtpserver','smtp.gmail.com');
			$smtp->Port       = dooplay_get_option('smtpport','587');
			$smtp->Username   = dooplay_get_option('smtpusername');
			$smtp->Password   = dooplay_get_option('smtppassword');
			$smtp->From       = dooplay_get_option('smtpfromemail');
			$smtp->FromName   = dooplay_get_option('smtpfromname');
            $smtp->SetFrom( $smtp->From, $smtp->FromName );
        }
    }
    add_action('phpmailer_init', 'doo_smtp_wpmail', 999);
}

# Body Website Data
function doo_siteinfo(){
	$website = array(
		'timeout' => 60,
		'body'    => array(
			'user_agent'    => isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : false,
			'ip_address'    => doo_client_ipaddress(),
			'codestar'      => doo_codeframework('framework'),
			'site_url'      => get_option('siteurl'),
			'theme_name'    => get_option('stylesheet'),
			'theme_version' => DOO_VERSION,
			'dbase_version' => DOO_VERSION_DB
		),
		'sslverify' => true
	);
	// The Return
	return $website;
}

# Collections items
function doo_collections_items($user_id = null, $type = null, $count = null, $metakey = null, $template ) {
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $args = array(
      'paged'          => $paged,
      'numberposts'    => -1,
      'orderby'        => 'date',
      'order'          => 'DESC',
      'post_type'      => $type,
      'posts_per_page' => $count,
      'meta_query' => array (
             array (
               'key'     => $metakey,
               'value'   => 'u'.$user_id. 'r',
               'compare' => 'LIKE'
            )
        )
    );
    $sep = '';
    $list_query = new WP_Query( $args );
    if($list_query->have_posts()):
        while($list_query->have_posts()):
            $list_query->the_post();
            get_template_part('inc/parts/simple_item_'. $template);
        endwhile;
    else :
        echo '<div class="no_fav">'.__d('No content available on your list.').'</div>';
    endif;
    wp_reset_postdata();
}

# Links Account
function doo_links_account($user_id, $count) {
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $args = array(
      'paged'          => $paged,
      'orderby'        => 'date',
      'order'          => 'DESC',
      'post_type'      => 'dt_links',
      'posts_per_page' => $count,
      'post_status'    => array('pending', 'publish', 'trash'),
      'author'         => $user_id,
      );
    $list_query = new WP_Query( $args );
    if ( $list_query->have_posts() ) :
        while($list_query->have_posts()):
            $list_query->the_post();
            get_template_part('inc/parts/item_links');
        endwhile;
    else :
        echo '<tr><td colspan="8">'.__d('No content').'</td></tr>';
    endif;
    wp_reset_postdata();
}

# Links profile
function doo_links_profile($user_id, $count) {
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $args = array(
      'paged'          => $paged,
      'orderby'        => 'date',
      'order'          => 'DESC',
      'post_type'      => 'dt_links',
      'posts_per_page' => $count,
      'post_status'    => array('pending', 'publish', 'trash'),
      'author'         => $user_id,
      );
    $list_query = new WP_Query( $args );
    if ( $list_query->have_posts() ) : while ( $list_query->have_posts() ) : $list_query->the_post();
         get_template_part('inc/parts/item_links_profile');
    endwhile;
    else :
    echo '<tr><td colspan="7">'.__d('No content').'</td></tr>';
    endif; wp_reset_postdata();
}

# Pending Links Account
function doo_links_pending($count) {
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $args = array(
      'paged'          => $paged,
      'orderby'        => 'date',
      'order'          => 'DESC',
      'post_type'      => 'dt_links',
      'posts_per_page' => $count,
      'post_status'    => array('pending'),
      );
    $list_query = new WP_Query( $args );
    if($list_query->have_posts()) : while($list_query->have_posts()) : $list_query->the_post();
         get_template_part('inc/parts/item_links_admin');
    endwhile;
    else :
    echo '<tr><td colspan="6">'.__d('No content').'</td></tr>';
    endif; wp_reset_postdata();
}

# Jetpack compatibilidad
if(!function_exists( 'doo_jetpack_compatibilidad_publicize' ) ) {
    function doo_jetpack_compatibilidad_publicize() {
        add_post_type_support('movies', 'publicize');
        add_post_type_support('tvshows', 'publicize');
        add_post_type_support('seasons', 'publicize');
        add_post_type_support('episodes', 'publicize');
    }
    add_action('init','doo_jetpack_compatibilidad_publicize');
}

# Form login
function doo_login_form(){
    $redirect = ( is_ssl() ? 'https://' : 'http://').$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    $register = doo_compose_pagelink('pageaccount'). '?action=sign-in';
    $action = esc_url( site_url('wp-login.php', 'login_post') );
    $lostpassword = esc_url( site_url('wp-login.php?action=lostpassword', 'login_post') );
    $form = '
    <div class="login_box">
        <div class="box">
            <a id="c_loginbox"><i class="fas fa-times"></i></a>
            <h3>'. __d('Login to your account').'</h3>
            <form method="post" action="'.$action.'">
                <fieldset class="user"><input type="text" name="log" placeholder="'.__d('Username').'"></fieldset>
                <fieldset class="password"><input type="password" name="pwd" placeholder="'.__d('Password').'"></fieldset>
                <label><input name="rememberme" type="checkbox" id="rememberme" value="forever"> '.__d('Remember Me').'</label>
                <fieldset class="submit"><input type="submit" value="'.__d('Log in').'"></fieldset>
                <a class="register" href="'.$register.'">'.__d('Register a new account').'</a>
                <label><a class="pteks" href="'.$lostpassword.'">'.__d('Lost your password?').'</a></label>
                <input type="hidden" name="redirect_to" value="'. $redirect .'">
            </form>
        </div>
    </div>';
    // The View
    echo $form;
}

# GET  Rand Images
function doo_rand_images($data, $size, $type = false, $return = false) {
    $img = $data;
    $val = explode("\n", $img);
    $passer = array();
    $count = 0;
    foreach( $val as $value ){
        if(!empty($value)){
            if(substr($value, 0, 1) == "/"){
                $passer[] = 'https://image.tmdb.org/t/p/'.$size . $value;
            } else {
                $passer[] = $value;
            }
            $count++;
        }
    }
    if( $type != false ) {
        $nuevo = rand( 0, $count );
        if( isset( $passer[$nuevo] ) ) {
            if( $return != false ){
                $sctc = isset( $passer[$nuevo] ) ? $passer[$nuevo] : null;
                return $sctc;
            }else{
                $sctc = isset( $passer[$nuevo] ) ? $passer[$nuevo] : null;
                echo $sctc;
            }

        } else {
            if( $return != false ) {
                $gctc = isset( $passer[0] ) ? $passer[0] : null;
                return $gctc;
            }else{
                $gctc = isset( $passer[0] ) ? $passer[0] : null;
                echo $gctc;
            }
        }
    } else {
        if( $return != false ) {
            return $passer[0];
        } else {
            echo $passer[0];
        }
    }
}

# Get TV Show Permalink
function doo_get_tvpermalink($ids) {
    $query = new WP_Query(array('post_type'=>'tvshows','meta_query'=>array(array('key'=>'ids','compare'=>'==','value'=>$ids))));
    if(!empty($query->posts)) {
        foreach($query->posts as $post){
            return $post->ID;
            break;
        }
    }
}

# Get post_links Status
function doo_here_links($post_id) {
    $query = new WP_Query(array('post_type'=>'dt_links','post_parent'=>$post_id));
    if(!empty($query->posts)){
        return true;
    }else{
        return false;
    }
}

# Count links
function doo_here_type_links($post_id, $type) {
    $query = new WP_Query(array('post_type'=>'dt_links','post_parent'=>$post_id,'meta_query'=>array(array('key'=>'_dool_type','compare'=>'=','value'=>$type))));
    if(!empty($query->posts)){
        return true;
    }else{
        return false;
    }
}

# define Gdrive Source
function doo_define_gdrive($source){
    if(filter_var($source, FILTER_VALIDATE_URL)) {
        $tmp1   = explode("file/d/",$source);
		$tmp2   = explode("/", doo_isset($tmp1,1));
		$source = doo_isset($tmp2,0);
    }
    return $source;
}

# Remove ver parameter
if(!function_exists('doo_remove_ver_par')){
    function doo_remove_ver_par($remove){
        if(strpos($remove,'?ver=')){
            $remove = remove_query_arg('ver',$remove);
        }
        return $remove;
    }
    if(doo_is_true('permits','rvrp') == true){
        add_filter('style_loader_src','doo_remove_ver_par', 9999 );
        add_filter('script_loader_src','doo_remove_ver_par', 9999 );
    }
}

# Breadcrumb
function doo_breadcrumb($post_id = false, $post_type = false, $post_type_name = false, $class = false) {
	if($post_id AND $post_type AND $post_type_name){
	   $out = '<div class="dt-breadcrumb '.$class.'"><ol itemscope itemtype="http://schema.org/BreadcrumbList">';
	   $out .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
	   $out .= '<a itemprop="item" href="'.home_url().'"><span itemprop="name">'.__d('Home').'</span></a>';
	   $out .= '<span class="fas fa-long-arrow-alt-right" itemprop="position" content="1"></span></li>';
	   $out .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
	   $out .= '<a itemprop="item" href="'.get_post_type_archive_link($post_type).'"><span itemprop="name">'.$post_type_name.'</span></a>';
	   $out .= '<span class="fas fa-long-arrow-alt-right" itemprop="position" content="2"></span></li>';
	   $out .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
	   $out .= '<a itemprop="item" href="'.get_the_permalink($post_id).'"><span itemprop="name">'.get_the_title($post_id).'</span></a>';
	   $out .= '<span itemprop="position" content="3"></span></li>';
	   $out .= '</ol></div>';
	   echo $out;
   }
}

# Glossary
function doo_glossary($type = 'all') {
    if(doo_is_true('permits','slgl') == true) {
        $out = '<div class="letter_home"><div class="fixresp"><ul class="glossary">';
        $out .= '<li><a class="lglossary" data-type="'.$type.'" data-glossary="09">#</a></li>';
        for ($l="a";$l!="aa";$l++){
            $out .= '<li><a class="lglossary" data-type="'.$type.'" data-glossary="'.__d($l).'">'. strtoupper(__d($l)). '</a></li>';
        }
        $out .= '</ul></div><div class="items_glossary"></div></div>';
        echo $out;
    }
}

# TOP IMDb Item
function doo_topimdb_item($num,$post_id){
	$title_pt  = get_the_title($post_id);
	$permalink = get_the_permalink($post_id);
	$marating  = get_post_meta($post_id,'imdbRating', true);
	$image_url = dbmovies_get_poster($post_id,'dt_poster_b','dt_poster','w92');
	$out = "<div class='top-imdb-item' id='top-{$post_id}'>";
	$out .= "<div class='image'><div class='poster'><a href='{$permalink}'><img src='{$image_url}' alt='{$title_pt}'></a></div></div>";
	$out .= "<div class='puesto'>{$num}</div>";
	$out .= "<div class='rating'>{$marating}</div>";
	$out .= "<div class='title'><a href='{$permalink}'>{$title_pt}</a></div>";
	$out .= "</div>";
	echo $out;
}

# Glossary
function doo_multiexplode($delimiters, $string){
    $ready  = str_replace($delimiters, $delimiters[0], $string);
    $launch = explode($delimiters[0], $ready);
    return  $launch;
}

# Compose Image
function doo_compose_image_option($key = false, $size = 'url'){
	$image = dooplay_get_option($key);
    if($image){
        return doo_isset($image,$size);
    }
}

#compose Page link
function doo_compose_pagelink($key = false){
    if($page = dooplay_get_option($key)){
        return get_permalink($page);
    }
}

# Compose Ad Desktop or Mobile
function doo_compose_ad($id){
    $add = get_option($id);
    $adm = get_option($id.'_mobile');
    if(wp_is_mobile() && $adm){
        return stripslashes($adm);
    }else{
        return stripslashes($add);
    }
}

# Main required ( Important )
require get_parent_theme_file_path('/inc/core/doothemes/init.php');
# Codestar Framework
require get_parent_theme_file_path('/inc/core/codestar/classes/setup.class.php');
require get_parent_theme_file_path('/inc/doo_options.php');
# Main requires
require get_parent_theme_file_path('/inc/doo_scripts.php');
require get_parent_theme_file_path('/inc/doo_views.php');
require get_parent_theme_file_path('/inc/doo_cache.php');
require get_parent_theme_file_path('/inc/doo_player.php');
require get_parent_theme_file_path('/inc/doo_links.php');
require get_parent_theme_file_path('/inc/doo_comments.php');
require get_parent_theme_file_path('/inc/doo_collection.php');
require get_parent_theme_file_path('/inc/doo_customizer.php');
require get_parent_theme_file_path('/inc/doo_minify.php');
require get_parent_theme_file_path('/inc/doo_ajax.php');
require get_parent_theme_file_path('/inc/doo_notices.php');
require get_parent_theme_file_path('/inc/doo_metafields.php');
require get_parent_theme_file_path('/inc/doo_metadata.php');
require get_parent_theme_file_path('/inc/doo_database.php');
require get_parent_theme_file_path('/inc/doo_ads.php');
require get_parent_theme_file_path('/inc/doo_auth.php');
require get_parent_theme_file_path('/inc/doo_lazyload.php');
# Google Drive
require get_parent_theme_file_path('/inc/gdrive/class.gdrive.php');
# More functions
require get_parent_theme_file_path('/inc/includes/rating/init.php');
require get_parent_theme_file_path('/inc/includes/metabox.php');
require get_parent_theme_file_path('/inc/includes/slugs.php');
require get_parent_theme_file_path('/inc/widgets/widgets.php');

#Bescraper Auto embed
require get_parent_theme_file_path('/inc/doo_bescraper.php');
