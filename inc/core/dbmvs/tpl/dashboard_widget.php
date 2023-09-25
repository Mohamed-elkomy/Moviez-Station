<div class="navigation">
    <ul>
        <li id="doodashcont-reported-click" class="dooplay-dashaboard-navigation" data-id="reported"><?php _d('Reports'); ?> <span id="response-count-report-unread-span">(0)</span></li>
        <li id="doodashcont-inbox-click" class="dooplay-dashaboard-navigation" data-id="inbox"><?php _d('Contact'); ?> <span id="response-count-contact-unread-span">(0)</span></li>
        <li class="dooplay-dashaboard-navigation" data-id="more"><?php _d('More'); ?></li>
    </ul>
</div>
<div class="box-content">
    <input id="dbmovies-inboxes-nonce" type="hidden" value="<?php echo wp_create_nonce('dbmovies-inboxes-nonce'); ?>">

    <div id="doodashcont-reported" class="dashcont">
        <header>
            <span class="title"><?php _d('Reported content'); ?></span>
            <div class="right">
                <span id="response-count-report-unread" class="count unread">0</span>
                <span id="response-count-report-total" class="count total">0</span>
            </div>
        </header>
        <div id="response-inboxes-report" class="items">
            <div class="onload"></div>
            <div class="hidden">{{REPORTS_TEMPLATE}}</div>
        </div>
        <div id="inboxes-paginator-report" class="paginator hidden">
            <button id="inboxes-btn-loadmore-report" href="#" class="button button-primary button-small inboxes-loadmore" data-type="report"><?php _d('Load more'); ?></button>
            <input id="inboxes-input-report" type="hidden" value="">
        </div>
    </div>

    <div id="doodashcont-inbox" class="dashcont">
        <header>
            <span class="title"><?php _d('Contact messages'); ?></span>
            <div class="right">
                <span id="response-count-contact-unread" class="count unread">0</span>
                <span id="response-count-contact-total" class="count total">0</span>
            </div>
        </header>
        <div id="response-inboxes-contact" class="items">
            <div class="onload"></div>
            <div class="hidden">{{CONTACT_TEMPLATE}}</div>
        </div>
        <div id="inboxes-paginator-contact" class="paginator hidden">
            <button id="inboxes-btn-loadmore-contact" href="#" class="button button-primary button-small inboxes-loadmore" data-type="contact"><?php _d('Load more'); ?></button>
            <input id="inboxes-input-contact" type="hidden" value="">
        </div>
    </div>

    <div id="doodashcont-more" class="dashcont">
        <header>
            <span class="title"><?php _d('Delete all messages'); ?></span>
            <p>
                <a href="<?php echo admin_url("admin-ajax.php?action=dbmovies_inboxes_cleaner&type=dooplay_report&nonce=".$nonce); ?>" class="button button-small" onclick="return confirm('<?php _d('Do you really want to continue?'); ?>')"><?php _d('Reports'); ?></a>
                - <?php _d('or'); ?> -
                <a href="<?php echo admin_url("admin-ajax.php?action=dbmovies_inboxes_cleaner&type=dooplay_contact&nonce=".$nonce); ?>" class="button button-small" onclick="return confirm('<?php _d('Do you really want to continue?'); ?>')"><?php _d('Contact'); ?></a>
            </p>
        </header>
        <header>
            <span class="title"><?php _d('Quick access'); ?></span>
        </header>
        <ul class="listing">
            <li><a href="<?php echo admin_url("admin.php?page=dbmvs"); ?>"><?php _d('Dbmovies importer'); ?></a></li>
            <li><a href="<?php echo admin_url("admin.php?page=dbmvs-settings"); ?>"><?php _d('Dbmovies settings'); ?></a></li>
            <li><a href="<?php echo admin_url("themes.php?page=dooplay"); ?>"><?php _d('Theme options'); ?></a></li>
            <li><a href="<?php echo admin_url("themes.php?page=dooplay-license"); ?>"><?php _d('Theme license'); ?></a></li>
            <li><a href="<?php echo admin_url("tools.php?page=dooplay-database"); ?>"><?php _d('Database tool'); ?></a></li>
            <li><a href="<?php echo admin_url("options-permalink.php#dooplay-permalinks"); ?>"><?php _d('Permalinks'); ?></a></li>
            <li><a href="<?php echo admin_url("themes.php?page=dooplay-ad"); ?>"><?php _d('Ad code manager'); ?></a></li>
        </ul>
        <header>
            <span class="title"><?php _d('Support'); ?></span>
        </header>
        <ul class="listing">
            <li><a href="https://bit.ly/doothemes-forums" target="_blank"><?php _d('Support Forums'); ?></a></li>
            <li><a href="https://bit.ly/dooplay-docs" target="_blank"><?php _d('Extended documentation'); ?></a></li>
            <li><a href="https://bit.ly/dooplay-changelog" target="_blank"><?php _d('Changelog'); ?></a></li>
            <li><a href="https://bit.ly/doothemes-telegram" target="_blank"><?php _d('Telegram Group'); ?></a></li>
        </ul>
    </div>
</div>
