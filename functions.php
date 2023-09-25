<?php
/*
* ----------------------------------------------------
* @author: Doothemes
* @author URI: https://doothemes.com/
* @copyright: (c) 2021 Doothemes. All rights reserved
* ----------------------------------------------------
* @since 2.5.5
*/

# Theme options
define('DOO_THEME_DOWNLOAD_MOD', true);
define('DOO_THEME_PLAYER_MOD',   true);
define('DOO_THEME_DBMOVIES',     true);
define('DOO_THEME_USER_MOD',     true);
define('DOO_THEME_VIEWS_COUNT',  true);
define('DOO_THEME_RELATED',      true);
define('DOO_THEME_SOCIAL_SHARE', true);
define('DOO_THEME_CACHE',        true);
define('DOO_THEME_PLAYERSERNAM', true);
define('DOO_THEME_JSCOMPRESS',   true);
define('DOO_THEME_TOTAL_POSTC',  true);
define('DOO_THEME_LAZYLOAD',     false);
# Repository data
define('DOO_COM','Doothemes');
define('DOO_VERSION','2.5.5');
define('Bes_VERSION','2.5.5'); // Bescraper version for wp_update only 23/06/2021
define('DOO_VERSION_DB','2.8');
define('DOO_ITEM_ID','154');
define('DOO_PHP_REQUIRE','7.1');
define('DOO_THEME','Dooplay');
define('DOO_THEME_SLUG','dooplay');
define('DOO_SERVER','https://cdn.bescraper.cf/api');
define('DOO_GICO','https://s2.googleusercontent.com/s2/favicons?domain=');

# Configure Here date format #
define('DOO_TIME','M. d, Y');  // More Info >>> https://www.php.net/manual/function.date.php
##############################

# Define Rating data
define('DOO_MAIN_RATING','_starstruck_avg');
define('DOO_MAIN_VOTOS','_starstruck_total');
# Define Options key
define('DOO_OPTIONS','_dooplay_options');
define('DOO_CUSTOMIZE', '_dooplay_customize');
# Define template directory
define('DOO_URI',get_template_directory_uri());
define('DOO_DIR',get_template_directory());

# Translations
load_theme_textdomain('dooplay', DOO_DIR.'/lang/');

# Load Application
require get_parent_theme_file_path('/inc/doo_init.php');

/* Custom functions
========================================================
*/

	// Here your code
