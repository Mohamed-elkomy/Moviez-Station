<?php
/**
 * @since 2.5.0
 * @version 2.0
 */
CSF::createSection(DOO_OPTIONS,
    array(
        'title'  => __d('Links Module'),
        'parent' => 'settings',
        'icon'   => 'fa fa-minus',
        'fields' => array(
            array(
                'id'    => 'linkslanguages',
                'type'  => 'text',
                'title' => __d('Set languages'),
                'subtitle'  => __d('Add comma separated values'),
                'attributes' => array(
                    'placeholder' => 'English, Spanish, Russian, Italian, Portuguese, Turkish, Bulgarian, Chinese'
                )
            ),
            array(
                'id'    => 'linksquality',
                'type'  => 'text',
                'title' => __d('Set resolutions quality'),
                'subtitle'  => __d('Add comma separated values'),
                'attributes' => array(
                    'placeholder' => '4k 2160p, HD 1440p, HD 1080p, HD 720p, SD 480p, SD 360p, SD 240p'
                )
            ),
            array(
                'id'    => 'linksfrontpublishers',
                'type'  => 'checkbox',
                'title' => __d('Front-End Links publishers'),
                'subtitle'  => __d('Check the user roles that can be published from Front-end'),
                'options' => array(
                    'adm' => __d('Administrator'),
                    'edt' => __d('Editor'),
                    'atr' => __d('Author'),
                    'ctr' => __d('Contributor'),
                    'sbr' => __d('Subscriber')
                ),
                'default' => array('adm','edt','atr','ctr','sbr')
            ),
            array(
                'id'    => 'linkspublishers',
                'type'  => 'checkbox',
                'title' => __d('Auto Publish'),
                'subtitle'  => __d('Mark the roles of users who can post links without being moderated'),
                'options' => array(
                    'adm' => __d('Administrator'),
                    'edt' => __d('Editor'),
                    'atr' => __d('Author'),
                    'ctr' => __d('Contributor'),
                    'sbr' => __d('Subscriber')
                ),
                'default' => array('adm','edt','atr','ctr')
            ),
            array(
                'id'    => 'linksrowshow',
                'type'  => 'checkbox',
                'title' => __d('Show in list'),
                'subtitle'  => __d('Select the items that you want to show in the links table'),
                'options' => array(
                    'qua' => __d('Quality'),
                    'lan' => __d('Language'),
                    'siz' => __d('Size'),
                    'cli' => __d('Clicks'),
                    'add' => __d('Added'),
                    'use' => __d('User')
                ),
                'default' => array('qua','lan','siz','cli','add','use')
            ),
            array(
                'id'    => 'linkshoweditor',
                'type'  => 'checkbox',
                'title' => __d('Links Editor'),
                'label' => __d('Show link editor, if the main entry has not yet been published')
            ),
            array(
                'type'    => 'notice',
                'style'   => 'info',
                'content' => __d('This is not a secure method of adding links, there is a very high probability of data loss.'),
                'dependency' => array('linkshoweditor', '==', true)
            ),
            array(
                'type'    => 'subheading',
                'content' => __d('Redirection page')
            ),
            array(
                'id'    => 'linktimewait',
                'type'  => 'text',
                'title' => __d('Timeout'),
                'subtitle'  => __d('Timeout in seconds before redirecting the page automatically'),
                'default' => '30',
                'attributes' => array(
                    'style' => 'width:100px',
                    'type' => 'number'
                )
            ),
            array(
                'id'    => 'linkoutputtype',
                'type'  => 'radio',
                'title' => __d('Type Output'),
                'subtitle'  => __d('Select an output type upon completion of the wait time'),
                'options' => array(
                    'btn' => __d('Clicking on a button'),
                    'clo' => __d('Redirecting the page automatically')
                ),
                'default' => 'btn',
                'dependency' => array('linktimewait', '>', '0')
            ),
            array(
                'id'    => 'linkbtntext',
                'type'  => 'text',
                'title' => __d('Button text'),
                'subtitle'  => __d('Customize the button'),
                'default' => __d('Continue'),
                'dependency' => array('linkoutputtype|linktimewait', '==|>', 'btn|0')
            ),
            array(
                'id'    => 'linkbtntextunder',
                'type'  => 'text',
                'title' => __d('Text under button'),
                'default' => __d('Click on the button to continue'),
                'dependency' => array('linkoutputtype|linktimewait', '==|>', 'btn|0')
            ),
            array(
                'id' => 'linkbtncolor',
                'type' => 'color',
                'title' => __d('Main color'),
                'subtitle' => __d('Select a color for customize redirection page'),
                'default' => '#1e73be',
                'dependency' => array('linkoutputtype|linktimewait', '==|>', 'btn|0')
            ),
            array(
                'type'    => 'subheading',
                'content' => __d('Shorteners')
            ),
            array(
                'type' => 'content',
                'content' => '
                    <h3>'.__d('To obtain the link, use the <code>{{url}}</code> tag').'</h3>
                    <p>'.__d('To invalidate this function do not add any shortener').'</p>
                '
            ),
            array(
                'id'   => 'shorteners',
                'type' => 'group',
                'button_title'    => __d('Add new shortener'),
                'accordion_title' => __d('Add new shortener'),
                'fields' => array(
                    array(
                        'id'    => 'short',
                        'type'  => 'text',
                        'attributes' => array(
                            'placeholder' => 'http://short.link/any_parameter/{url}'
                        )
                    )
                )
            )
        )
    )
);
