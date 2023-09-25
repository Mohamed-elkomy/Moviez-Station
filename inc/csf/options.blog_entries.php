<?php
/**
 * @since 2.5.0
 * @version 2.0
 */
CSF::createSection(DOO_OPTIONS,
    array(
        'title'  => __d('Blog entries'),
        'parent' => 'homepage',
        'icon'   => 'fa fa-minus',
        'fields' => array(
            array(
                'id'      => 'blogtitle',
                'type'    => 'text',
                'title'   => __d('Module Title'),
                'default' => __d('Last entries'),
                'subtitle'    => __d('Add title to show')
            ),
            array(
                'id'      => 'blogitems',
                'type'    => 'text',
                'title'   => __d('Items number'),
                'subtitle'    => __d('Number of items to show'),
                'default' => '5',
                'attributes' => array(
                    'type' => 'number',
                    'style' => 'width:100px'
                )
            ),
            array(
                'id'      => 'blogwords',
                'type'    => 'text',
                'title'   => __d('Number of words'),
                'subtitle'    => __d('Number of words for describing the entry'),
                'default' => '180',
                'attributes' => array(
                    'type' => 'number',
                    'style' => 'width:100px'
                )
            )
        )
    )
);
