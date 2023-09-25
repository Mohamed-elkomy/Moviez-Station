<div class="wrap dbmovies-settings">
    <nav class="dbmvs-menu">
        <ul id="dbmvs-nav-settings" class="items">
            <li id="settab-general" data-tab="general" class="nav-tab nav-tab-active"><?php _d('General'); ?></li>
            <li id="settab-titles" data-tab="titles" class="nav-tab"><?php _d('Titles and Content'); ?></li>
            <li id="settab-updater" data-tab="updater" class="nav-tab"><?php _d('Meta Updater'); ?></li>
            <li id="settab-requests" data-tab="requests" class="nav-tab"><?php _d('Requests'); ?></li>
            <li id="settab-advanced" data-tab="advanced" class="nav-tab"><?php _d('Advanced'); ?></li>
            <li id="settab-stats" data-tab="stats" class="nav-tab"><?php _d('Stats'); ?></li>
        </ul>
    </nav>
    <?php if(empty($this->get_option('dbmovies'))){ ?>
    <div class="notice notice-info is-dismissible">
        <p><?php _d('Register on our platform to obtain an API key'); ?> <a href="<?php echo DBMOVIES_DBMVAPI; ?>" target="_blank"><strong><?php _d('Click here'); ?></strong></a></p>
        <button type="button" class="notice-dismiss">
            <span class="screen-reader-text"></span>
        </button>
    </div>
    <?php } ?>
    <?php if(empty($this->get_option('themoviedb'))){ ?>
    <div class="notice notice-info is-dismissible">
        <p><?php _d('Get API Key (v3 auth) for Themoviedb'); ?> <a href="https://www.themoviedb.org/settings/api" target="_blank"><strong><?php _d('Click here'); ?></strong></a></p>
        <button type="button" class="notice-dismiss">
            <span class="screen-reader-text"></span>
        </button>
    </div>
    <?php } ?>
    <form id="dbmovies-settings">
        <div id="dbmv-setting-general" class="tab-content on">
            <?php require_once get_parent_theme_file_path('/inc/core/dbmvs/tpl/form_setting_general.php'); ?>
        </div>
        <div id="dbmv-setting-titles" class="tab-content">
            <?php require_once get_parent_theme_file_path('/inc/core/dbmvs/tpl/form_setting_titles.php'); ?>
        </div>
        <div id="dbmv-setting-updater" class="tab-content">
            <?php require_once get_parent_theme_file_path('/inc/core/dbmvs/tpl/form_setting_updater.php'); ?>
        </div>
        <div id="dbmv-setting-requests" class="tab-content">
            <?php require_once get_parent_theme_file_path('/inc/core/dbmvs/tpl/form_setting_requests.php'); ?>
        </div>
        <div id="dbmv-setting-advanced" class="tab-content">
            <?php require_once get_parent_theme_file_path('/inc/core/dbmvs/tpl/form_setting_advanced.php'); ?>
        </div>
        <div id="dbmv-setting-stats" class="tab-content">
            <?php require_once get_parent_theme_file_path('/inc/core/dbmvs/tpl/form_setting_statistics.php'); ?>
        </div>
        <hr>
        <p>
            <input type="hidden" name="action" value="dbmovies_savesetting">
            <input type="hidden" name="cnonce" value="<?php echo wp_create_nonce('dbmovies-save-settings'); ?>">
            <input type="submit" class="button button-primary" value="<?php _d('Save Changes'); ?>" id="dbmvsbtn-savesettings">
            <a href="<?php echo get_admin_url(get_current_blog_id(),'admin-ajax.php?action=dbmovies_clean_cache'); ?>" class="button button-secundary"><?php _d('Delete cache'); ?></a>
            <span id="dbmvsssrespnc"></span>
        </p>
    </form>
</div>
