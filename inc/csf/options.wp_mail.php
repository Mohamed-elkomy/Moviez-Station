<?php
/**
 * @since 2.5.0
 * @version 2.0
 */
CSF::createSection(DOO_OPTIONS,
    array(
        'title'  => __d('WP Mail'),
        'parent' => 'settings',
        'icon'   => 'fa fa-minus',
        'fields' => array(
            array(
                'type'    => 'subheading',
                'content' => __d('Welcome message')
            ),
            array(
                'id'      => 'welcomesjt',
                'type'    => 'text',
                'title'   => __d('Subject'),
                'default' => __d('Welcome to {sitename}')
            ),
            array(
                'id'      => 'welcomemsg',
                'type'    => 'textarea',
                'title'   => __d('Message'),
                'default' => __d('Hello {username}, Thank you for registering at {sitename}'),
                'after'   => '<p><strong>Tags:</strong> <code>{sitename}</code> <code>{siteurl}</code> <code>{username}</code> <code>{password}</code> <code>{email}</code> <code>{first_name}</code> <code>{last_name}</code></p>',
            ),
            array(
                'type'    => 'subheading',
                'content' => __d('SMTP Settings')
            ),
            array(
                'id'      => 'smtp',
                'type'    => 'switcher',
                'title'   => __d('Enable SMTP'),
                'label'   => __d('Configure an SMTP server for WordPress to send verified emails'),
                'default' => false
            ),
            array(
                'id'      => 'smtpserver',
                'type'    => 'text',
                'title'   => __d('SMTP Server'),
                'default' => 'smtp.gmail.com',
                'dependency' => array('smtp', '==', 'true')
            ),
            array(
                'id'      => 'smtpport',
                'type'    => 'number',
                'title'   => __d('SMTP Port'),
                'default' => '587',
                'attributes' => array(
                    'style' => 'width:100px'
                ),
                'dependency' => array('smtp', '==', 'true')
            ),
            array(
                'id'    => 'smtpencryp',
                'type'  => 'radio',
                'title' => __d('Type of Encryption'),
                'options' => array(
                    'plain' => __d('Plain text'),
                    'ssl'   => __d('SSL'),
                    'tsl'   => __d('TSL')
                ),
                'default'    => 'tsl',
                'dependency' => array('smtp', '==', 'true')
            ),
            array(
                'id'      => 'smtpfromname',
                'type'    => 'text',
                'title'   => __d('From Name'),
                'dependency' => array('smtp', '==', 'true')
            ),
            array(
                'id'      => 'smtpfromemail',
                'type'    => 'text',
                'title'   => __d('From Email Address'),
                'dependency' => array('smtp', '==', 'true')
            ),
            array(
                'type'    => 'subheading',
                'content' => __d('SMTP Authentication'),
                'dependency' => array('smtp', '==', 'true')
            ),
            array(
                'id'    => 'smtpusername',
                'type'  => 'text',
                'title' => __d('Username'),
                'dependency' => array('smtp', '==', 'true')
            ),
            array(
                'id'    => 'smtppassword',
                'type'  => 'text',
                'title' => __d('Password'),
                'attributes' => array('type' => 'password'),
                'dependency' => array('smtp', '==', 'true')
            )
        )
    )
);
