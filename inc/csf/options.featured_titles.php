<?php
/**
 * @since 2.5.0
 * @version 2.0
 */
CSF::createSection(DOO_OPTIONS,
    array(
        'id'    => 'homepage',
        'icon'  => 'fa fa-th-large',
        'title' => __d('Homepage Modules')
    )
);

/**
 * @since 3.4.0
 * @version 2.0
 */
CSF::createSection(DOO_OPTIONS,
    array(
        'title'  => __d('Featured titles'),
        'parent' => 'homepage',
        'icon'   => 'fa fa-minus',
        'fields' => array(
            array(
                'id'      => 'featuredtitle',
                'type'    => 'text',
                'title'   => __d('Module Title'),
                'default' => __d('Featured titles'),
                'subtitle'    => __d('Add title to show')
            ),
            array(
                'id'      => 'featureditems',
                'type'    => 'text',
                'title'   => __d('Items number'),
                'subtitle' => __d('Number of items to show'),
                'default' => '8',
                'attributes' => array(
                    'type' => 'number',
                    'style' => 'width:100px'
                )
            ),
            array(
                'id'    => 'featuredcontrol',
                'type'  => 'checkbox',
                'title' => __d('Module control'),
                'subtitle'  => __d('Check to enable option.'),
                'options' => array(
                    'slider' => __d('Activate Slider'),
                    'autopl' => __d('Auto play Slider')
                ),
                'default'=> array('slider')
            ),
            array(
                'id'      => 'featuredmodorderby',
                'type'    => 'select',
                'title'   => __d('Order by'),
                'subtitle'    => __d('Order items for this module'),
                'default' => 'modified',
                'options' => array(
                    'date'     => __d('Post date'),
                    'title'    => __d('Post title'),
                    'modified' => __d('Last modified'),
                    'rand'     => __d('Random entry'),
                )
            ),
            array(
                'id'    => 'featuredmodorder',
                'type'  => 'radio',
                'title' => __d('Order'),
                'options' => array(
                    'DESC' => __d('Descending'),
                    'ASC'  => __d('Ascending')
                ),
                'dependency' => array('featuredmodorderby','!=','rand'),
                'default' => 'DESC'
            )
        )
    )
);
