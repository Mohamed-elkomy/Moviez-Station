<?php
/**
 * @since 2.5.0
 * @version 2.0
 */
CSF::createSection(DOO_OPTIONS,
    array(
        'title'  => __d('SEO'),
        'name'   => 'seo',
        'icon'   => 'fa fa-line-chart',
        'fields' => array(
            array(
                'id'    => 'seo',
                'type'  => 'switcher',
                'title' => __d('SEO Features'),
                'label' => __d('Basic SEO')
            ),
            array(
                'type'       => 'notice',
                'style'      => 'info',
                'content'    => __d('Uncheck this to disable SEO features in the theme, highly recommended if you use any other SEO plugin, that way the themes SEO features won\'t conflict with the plugin'),
                'dependency' => array('seo','==', true)
            ),
            array(
                'id'         => 'seoname',
                'type'       => 'text',
                'title'      => __d('Alternative name'),
                'dependency' => array('seo','==', true)
            ),
            array(
                'id'         => 'seokeywords',
                'type'       => 'text',
                'title'      => __d('Main keywords'),
                'subtitle'       => __d('add main keywords for site info'),
                'dependency' => array('seo','==', true)
            ),
            array(
                'id'         => 'seodescription',
                'type'       => 'textarea',
                'title'      => __d('Meta description'),
                'dependency' => array('seo','==', true)
            ),
            array(
                'type'    => 'heading',
                'content' => __d('Site verification'),
                'dependency' => array('seo','==', true)
            ),
            array(
                'id'         => 'seogooglev',
                'type'       => 'text',
                'title'      => __d('Google Search Console'),
                'after'       => '<p><a href="https://www.google.com/webmasters/verification/" target="_blank">'.__d('Settings here').'</a></p>',
                'dependency' => array('seo','==', true)
            ),
            array(
                'id'         => 'seobingv',
                'type'       => 'text',
                'title'      => __d('Bing Webmaster Tools'),
                'after'       => '<p><a href="https://www.bing.com/toolbox/webmaster/" target="_blank">'.__d('Settings here').'</a></p>',
                'dependency' => array('seo','==', true)
            ),
            array(
                'id'         => 'seoyandexv',
                'type'       => 'text',
                'title'      => __d('Yandex Webmaster Tools'),
                'after'       => '<p><a href="https://yandex.com/support/webmaster/service/rights.xml#how-to" target="_blank">'.__d('Settings here').'</a></p>',
                'dependency' => array('seo','==', true)
            )
        )
    )
);

/**
 * @since 3.4.0
 * @version 2.0
 */
CSF::createSection(DOO_OPTIONS,
    array(
        'title' => __d('Advertising'),
        'name' => 'ads',
        'icon' => 'fa fa-usd',
        'fields' => array(
            array(
              'type'    => 'content',
              'content' => '<p><a href="'.admin_url('themes.php?page=dooplay-ad').'"><strong>'.__d('Manage integration codes and ads').'</strong></a></p>',
            )
        )
    )
);

/**
 * @since 3.4.0
 * @version 2.0
 */
CSF::createSection(DOO_OPTIONS,
    array(
        'title' => __d('Backup'),
        'name' => 'backup',
        'icon' => 'fa fa-database',
        'fields' => array(
            array(
              'type' => 'backup'
            )
        )
    )
);
