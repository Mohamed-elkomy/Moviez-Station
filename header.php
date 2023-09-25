<?php
/*
* -------------------------------------------------------------------------------------
* @author: Doothemes
* @author URI: https://doothemes.com/
* @aopyright: (c) 2021 Doothemes. All rights reserved
* -------------------------------------------------------------------------------------
*
* @since 2.5.0
*
*/

// Options
$hcod = get_option('_dooplay_header_code');
$regi = doo_is_true('permits','eusr');
$acpg = doo_compose_pagelink('pageaccount');
$fvic = doo_compose_image_option('favicon');
$logo = doo_compose_image_option('headlogo');
$toic = doo_compose_image_option('touchlogo');
$logg = is_user_logged_in();
$bnme = get_option('blogname');
$styl = dooplay_get_option('style');
$colr = dooplay_get_option('maincolor');
$colr = ($colr) ? $colr : '#408bea';
$ilgo = ($styl == 'default') ? 'dooplay_logo_dark' : 'dooplay_logo_white';
$logo = ($logo) ? "<img src='{$logo}' alt='{$bnme}'/>" : "<img src='".DOO_URI."/assets/img/brand/{$ilgo}.svg' alt='{$bnme}'/>";
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>" />
<?php if($toic) echo "<link rel='apple-touch-icon' href='{$toic}'/>\n"; ?>
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="mobile-web-app-capable" content="yes">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<?php dooplay_meta_theme_color($styl); ?>
<?php if($fvic) echo "<link rel='shortcut icon' href='{$fvic}' type='image/x-icon' />\n"; ?>
<?php get_template_part('inc/doo_seo'); ?>
<?php if(is_single()) { doo_facebook_image("w780", $post->ID); } ?>
<?php wp_head(); ?>
<?php echo stripslashes($hcod); ?>
</head>
<body <?php body_class(); ?>>
<?php if(is_single() && is_user_logged_in()) { ?>
<div class="dtloadpage">
	<div class="dtloadbox">
		<span><i class="icons-spinner9 loading"></i> <?php _d('Generating data..'); ?></span>
		<p><?php _d('Please wait, not close this page to complete the upload'); ?></p>
	</div>
</div>
<?php } ?>
<div id="dt_contenedor">
<header id="header" class="main">
	<div class="hbox">
		<div class="fix-hidden">
			<div class="logo">
				<a href="<?php echo esc_url(home_url()); ?>"><?php echo $logo; ?></a>
			</div>
			<div class="head-main-nav">
				<?php wp_nav_menu(array('theme_location'=>'header','menu_class'=>'main-header','menu_id'=>'main_header','fallback_cb'=>false)); ?>
			</div>
			<div class="headitems <?php if($regi OR $logg) { echo 'register_active'; } ?>">
				<div id="advc-menu" class="search">
					<form method="get" id="searchform" action="<?php echo esc_url(home_url()); ?>">
						<input type="text" placeholder="<?php _d('Search...'); ?>" name="s" id="s" value="<?php echo get_search_query(); ?>" autocomplete="off">
						<button class="search-button" type="submit"><span class="fas fa-search"></span></button>
					</form>
				</div>
				<!-- end search -->
				<?php if($logg) { ?>
				<div class="dtuser">
					<div class="gravatar">
	                    <div class="image">
	                        <a href="<?php echo $acpg; ?>"><?php doo_email_avatar_header(); ?></a>
	                        <?php if (current_user_can('administrator')) { $total = doo_total_count('dt_links','pending'); if($total >= 1) { ?><span><?php echo $total; ?></span><?php } } ?>
	                    </div>
						<a href="#" id="dooplay_signout"><?php _d('Sign out'); ?></a>
					</div>
				</div>
	            <?php } else { if($regi == true) { ?>
				<div class="dtuser">
					<a href="#" class="clicklogin">
						<i class="fas fa-user-circle"></i>
					</a>
				</div>
				<?php } } ?>
				<!-- end dt_user -->
			</div>
		</div>
		<div class="live-search <?php echo (is_rtl()) ? 'rtl' : 'ltr'; ?>"></div>
	</div>
</header>
<div class="fixheadresp">
	<header class="responsive">
		<div class="nav"><a class="aresp nav-resp"></a></div>
		<div class="search"><a class="aresp search-resp"></a></div>
		<div class="logo">
            <a href="<?php echo esc_url( home_url() ); ?>/"><?php echo $logo; ?></a>
        </div>
	</header>
	<div class="search_responsive">
		<form method="get" id="form-search-resp" class="form-resp-ab" action="<?php echo esc_url(home_url()); ?>">
			<input type="text" placeholder="<?php _d('Search...'); ?>" name="s" id="ms" value="<?php echo get_search_query(); ?>" autocomplete="off">
			<button type="submit" class="search-button"><span class="fas fa-search"></span></button>
		</form>
		<div class="live-search"></div>
	</div>
	<div id="arch-menu" class="menuresp">
		<div class="menu">
			<?php if($logg) { ?>
			<div class="user">
				<div class="gravatar">
					<a href="<?php echo $acpg; ?>">
					<?php doo_email_avatar_header(); ?>
					<span><?php _d('My account'); ?></span>
					</a>
				</div>
				<div class="logout">
					<a href="#" id="dooplay_signout"><?php _d('Sign out'); ?></a>
				</div>
			</div>
        <?php } elseif( $regi == true) { ?>
			<div class="user">
				<a class="ctgs clicklogin"><?php _d('Login'); ?></a>
				<a class="ctgs" href="<?php echo $acpg .'?action=sign-in'; ?>"><?php _d('Sign Up'); ?></a>
			</div>
        <?php } ?>
			<?php wp_nav_menu( array('theme_location'=>'header','menu_class'=>'resp','menu_id'=>'main_header','fallback_cb'=>false)); ?>
		</div>
	</div>
</div>
<div id="contenedor">
<?php if(!$logg) DooAuth::LoginForm(); ?>
