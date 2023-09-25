<?php if(!defined('ABSPATH')) die;
/**
 * DooPlay Options for Codestar Framework
 * @author Doothemes and Dbmovies Team
 * @since 2.5.0
 * @version 2.1
 */

/**
 * @since 2.5.0
 * @version 2.0
 */
CSF::createOptions(DOO_OPTIONS,
    array(
        'framework_title'    => 'dooplay <small>Options</small>',
        'menu_title'         => sprintf( __d('%s options'), DOO_THEME),
        'menu_slug'          => 'dooplay',
        'menu_type'          => 'submenu',
        'menu_parent'        => 'themes.php',
        'theme'              => 'light',
        'ajax_save'          => true,
        'show_reset_all'     => false,
        'show_reset_section' => false,
        'show_footer'        => true,
        'footer_after'       => '',
        'footer_text'        => '<p><a href="https://bit.ly/2PEvFuN" target="_blank" class="button button-primary button-small">Get info</a> &nbsp&nbspStay up-to-date with the latest information on <strong>COVID-19</strong>, available on the WHO website and through your health authorities.</p>',
        'footer_credit'      => 'Thank you for creating with <a href="https://bit.ly/3dITGbU" target="_blank"><strong>Doothemes</strong></a> and DooPlay v'.DOO_VERSION,
    )
);

// All DooPlay Options for CSF
require_once get_parent_theme_file_path('/inc/csf/options.main_settings.php');
require_once get_parent_theme_file_path('/inc/csf/options.customize.php');
//require_once get_parent_theme_file_path('/inc/csf/options.cookies.php');
require_once get_parent_theme_file_path('/inc/csf/options.comments.php');
require_once get_parent_theme_file_path('/inc/csf/options.links_module.php');
require_once get_parent_theme_file_path('/inc/csf/options.video_player.php');
require_once get_parent_theme_file_path('/inc/csf/options.wp_mail.php');
require_once get_parent_theme_file_path('/inc/csf/options.report_contact.php');
require_once get_parent_theme_file_path('/inc/csf/options.featured_titles.php');
require_once get_parent_theme_file_path('/inc/csf/options.blog_entries.php');
require_once get_parent_theme_file_path('/inc/csf/options.main_slider.php');
require_once get_parent_theme_file_path('/inc/csf/options.top_imdb.php');
require_once get_parent_theme_file_path('/inc/csf/options.module_movies.php');
require_once get_parent_theme_file_path('/inc/csf/options.module_tvshows.php');
require_once get_parent_theme_file_path('/inc/csf/options.module_seasons.php');
require_once get_parent_theme_file_path('/inc/csf/options.module_episodes.php');
require_once get_parent_theme_file_path('/inc/csf/options.more.php');
