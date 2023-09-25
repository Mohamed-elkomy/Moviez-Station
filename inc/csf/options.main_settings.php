<?php
/**
 * @since 2.5.0
 * @version 2.0
 */
CSF::createSection(DOO_OPTIONS,
    array(
        'id'    => 'settings',
        'icon'  => 'fa fa-cog',
        'title' => __d('Settings')
    )
);

/**
 * @since 2.5.0
 * @version 2.0
 */
CSF::createSection(DOO_OPTIONS,
    array(
        'title'  => __d('Main settings'),
        'parent' => 'settings',
        'icon'   => 'fa fa-minus',
        'fields' => array(
            array(
                'id'      => 'online',
                'type'    => 'switcher',
                'title'   => __d('Site Online'),
                'label'   => __d('Keep this field activated'),
                'default' => true
            ),
            array(
                'type'       => 'notice',
                'style'      => 'warning',
                'content'    => __d('Currently your website is in <strong>offline mode</strong>'),
                'dependency' => array('online', '!=', true)
            ),
            array(
                'id'      => 'offlinemessage',
                'type'    => 'textarea',
                'title'   => __d('Offline Message'),
                'default' => __d('We are in maintenance, please try it later'),
                'attributes' => array(
                    'placeholder' => __d('Offline mode message here'),
                    'rows'        => 3,
                ),
                'dependency' => array('online', '!=', true)
            ),
            array(
                'id'      => 'classic_editor',
                'type'    => 'switcher',
                'title'   => __d('Classic Editor'),
                'label'   => __d('Enable classic editor in content editors')
            ),
            array(
                'type'       => 'notice',
                'style'      => 'info',
                'content'    => __d('WordPress Gutenberg editor has been disabled'),
                'dependency' => array('classic_editor', '==', true)
            ),
            array(
                'id'    => 'ganalytics',
                'type'  => 'text',
                'title' => __d('Google Analytics'),
                'subtitle'  => __d('Insert tracking code to use this function'),
                'attributes' => array(
                    'placeholder' => 'UA-45182606-12',
                    'style' => 'width:200px'
                )
            ),
            array(
                'id'      => 'iperpage',
                'type'    => 'text',
                'title'   => __d('Items per page'),
                'subtitle'    => __d('Archive pages show at most'),
                'default' => '30',
                'attributes' => array(
                    'style' => 'width:100px',
                    'type' => 'number'
                )
            ),
            array(
                'id'      => 'bperpage',
                'type'    => 'text',
                'title'   => __d('Post per page in blog'),
                'subtitle'    => __d('Archive pages show at most'),
                'default' => '10',
                'attributes' => array(
                    'style' => 'width:100px',
                    'type' => 'number'
                )
            ),
            array(
                'id'      => 'itopimdb',
                'type'    => 'text',
                'title'   => __d('TOP IMDb items'),
                'subtitle'    => __d('Select the number of items to the page TOP IMDb'),
                'default' => '50',
                'attributes' => array(
                    'style' => 'width:100px',
                    'type' => 'number'
                )
            ),
            array(
                'id'    => 'pagrange',
                'type'  => 'text',
                'title' => __d('Pagination Range'),
                'subtitle'  => __d('Set a range of items to display in the paginator'),
                'default' => '2',
                'attributes' => array(
                    'style' => 'width:100px',
                    'type' => 'number',
                    'max' => 4,
                    'min' => 1
                )
            ),
            array(
                'id'    => 'permits',
                'type'  => 'checkbox',
                'title' => __d('General'),
                'subtitle'  => __d('Check whether to activate or deactivate'),
                'options' => array(
                    'eusr' => __d('User register enable'),
                    'enls' => __d('Live search enable'),
                    'esst' => __d('Show similar titles enable'),
                    'demj' => __d('Emoji disable'),
                    'mhtm' => __d('Minify HTML'),
                    'slgl' => __d('Show Letters glossary')
                ),
                'default' => array('enls','esst','demj','mhtm','slgl')
            ),
            array(
                'id' => 'view_count_mode',
                'type' => 'radio',
                'title' => __d('View count'),
                'subtitle' => __d('Methods for counting views in content'),
                'default' => 'regular',
                'options' => array(
                    'regular' => __d('Regular'),
                    'ajax'    => __d('Ajax'),
                    'none'    => __d('Disable view counting')
                )
            ),
            array(
                'type'       => 'notice',
                'style'      => 'info',
                'content'    => __d('Regular view count may consume resources from your server in a moderate way, consider disabling it if your server has limited processes.'),
                'dependency' => array('view_count_mode', '==', 'regular')
            ),
            array(
                'type'       => 'notice',
                'style'      => 'warning',
                'content'    => __d('View count by Ajax consumes resources from your server on each user visit, if your server has limited processes we recommend disabling this function.'),
                'dependency' => array('view_count_mode', '==', 'ajax')
            ),
            array(
                'type' => 'subheading',
                'content' => __d('Google reCAPTCHA v3')
            ),
            array(
                'id'      => 'gcaptchasitekeyv3',
                'type'    => 'text',
                'title'   => __d('Site key')
            ),
            array(
                'id'      => 'gcaptchasecretv3',
                'type'    => 'text',
                'title'   => __d('Secret key')
            ),
            array(
                'type' => 'content',
                'content' => '<a href="https://www.google.com/recaptcha/admin" target="_blank">'.__d('Get Google reCAPTCHA').'</a>'
            ),
            array(
                'type' => 'subheading',
                'content' => __d('Pages for DooPlay')
            ),
            array(
                'id'      => 'pageaccount',
                'type'    => 'select',
                'title'   => __d('Account'),
                'subtitle'    => __d('Set User Account page'),
                'options' => 'pages'
            ),
            array(
                'id'      => 'pagetrending',
                'type'    => 'select',
                'title'   => __d('Trending'),
                'subtitle'    => __d('Set page to show trend content'),
                'options' => 'pages'
            ),
            array(
                'id'      => 'pageratings',
                'type'    => 'select',
                'title'   => __d('Ratings'),
                'subtitle'    => __d('Set page to show content rated by users'),
                'options' => 'pages'
            ),
            array(
                'id'      => 'pagecontact',
                'type'    => 'select',
                'title'   => __d('Contact'),
                'subtitle'    => __d('Set page to display the contact form'),
                'options' => 'pages'
            ),
            array(
                'id'      => 'pagetopimdb',
                'type'    => 'select',
                'title'   => __d('Top IMDb'),
                'subtitle'    => __d('Set page to show the best qualified content in IMDb'),
                'options' => 'pages'
            ),
            array(
                'id'      => 'pageblog',
                'type'    => 'select',
                'title'   => __d('Blog entries'),
                'subtitle'    => __d('Set page to show the entries in blog'),
                'options' => 'pages'
            ),
            array(
                'type' => 'subheading',
                'content' => __d('Database cache')
            ),
            array(
                'id'      => 'cachescheduler',
                'type'    => 'radio',
                'title'   => __d('Scheduler'),
                'subtitle'    => __d('Cache cleaning'),
                'before'   => '<p>'.__d('It is important to clean expired cache at least once a day').'</p>',
                'default' => 'daily',
                'options' => array(
                    'daily'      => __d('Daily'),
                    'twicedaily' => __d('Twice daily'),
                    'hourly'     => __d('Hourly')
                ),
            ),
            array(
                'type'    => 'notice',
                'style'   => 'info',
                'content' => __d('Storing cache as long as possible can be a very good idea'),
                'dependency' => array('cachetime', '<=', 43200)
            ),
            array(
                'id'      => 'cachetime',
                'type'    => 'text',
                'title'   => __d('Cache Timeout'),
                'subtitle'    => __d('Set the time in seconds'),
                'default' => '86400',
                'before'   => '<p>'.__d('We recommend storing this cache for at least 86400 seconds').'</p>',
                'attributes' => array(
                    'style' => 'width:100px',
                    'type' => 'number'
                )
            )
        )
    )
);
