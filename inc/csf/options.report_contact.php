<?php
/**
 * @since 2.5.0
 * @version 1.0
 */
CSF::createSection(DOO_OPTIONS,
    array(
        'title'  => __d('Report and contact'),
        'parent' => 'settings',
        'icon'   => 'fa fa-minus',
        'fields' => array(
            array(
                'id'       => 'report_form',
                'type'     => 'switcher',
                'title'    => __d('Reports Form'),
                'subtitle' => __d('Enable report form'),
                'default'  => true
            ),
            array(
                'id'      => 'contact_form',
                'type'    => 'switcher',
                'title'   => __d('Contact Form'),
                'subtitle'   => __d('Enable contact form'),
                'default' => true
            ),
            array(
                'id'      => 'contact_email',
                'type'    => 'text',
                'title'   => __d('Email'),
                'subtitle' => __d('Assign an email address if you want to be notified'),
                'default' => get_option('admin_email')
            ),
            array(
                'type'    => 'subheading',
                'content' => __d('Email notifications')
            ),
            array(
                'id'       => 'report_notify_email',
                'type'     => 'switcher',
                'title'    => __d('Reports'),
                'subtitle' => __d('Notify new reports by email'),
                'default'  => true
            ),
            array(
                'id'      => 'contact_notify_email',
                'type'    => 'switcher',
                'title'   => __d('Contact'),
                'subtitle'   => __d('Notify new contact messages by email'),
                'default' => true
            ),
            array(
                'type'    => 'subheading',
                'content' => __d('Firewall')
            ),
            array(
                'type'  => 'submessage',
                'style' => 'info',
                'content' => __d('We recommend not enabling more than 10 unread records per IP address, consider that this function could be used maliciously and could compromise the good status of your website.')
            ),
            array(
                'id'      => 'reports_numbers_by_ip',
                'type'    => 'slider',
                'title'   => __d('Report limit'),
                'subtitle'=> __d('Set limit of unread reports by IP address'),
                'min'     => 1,
                'max'     => 200,
                'step'    => 1,
                'default' => 10,
                'unit'    => 'Posts'
            ),
            array(
                'type'    => 'notice',
                'style'   => 'warning',
                'content' => __d('Caution, you have enabled more than 50 unread records per IP address.'),
                'dependency' => array('reports_numbers_by_ip', '>=', '50')
            ),
            array(
                'id'      => 'contact_numbers_by_ip',
                'type'    => 'slider',
                'title'   => __d('Contact messages limit'),
                'subtitle'=> __d('Set limit of unread contact messages by IP address'),
                'min'     => 1,
                'max'     => 200,
                'step'    => 1,
                'default' => 10,
                'unit'    => 'Posts'
            ),
            array(
                'type'    => 'notice',
                'style'   => 'warning',
                'content' => __d('Caution, you have enabled more than 50 unread records per IP address.'),
                'dependency' => array('contact_numbers_by_ip', '>=', '50')
            ),
            array(
                'id'     => 'whitelist',
                'type'   => 'repeater',
                'title'  => __d('Whitelist'),
                'subtitle' => __d('Create a safe list of IP addresses that can send reports without limits'),
                'fields' => array(
                    array(
                        'id'   => 'ip',
                        'type' => 'text',
                        'placeholder' => __d('IP adress')
                    ),
                )
            ),
            array(
                'id'     => 'blacklist',
                'type'   => 'repeater',
                'title'  => __d('Blacklist'),
                'subtitle' => __d('Block the sending of reports and contact messages'),
                'fields' => array(
                    array(
                        'id'   => 'ip',
                        'type' => 'text',
                        'placeholder' => __d('IP adress')
                    ),
                )
            ),
        )
    )
);
