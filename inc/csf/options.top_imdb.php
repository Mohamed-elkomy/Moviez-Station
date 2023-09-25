<?php
/**
 * @since 2.5.0
 * @version 2.0
 */
CSF::createSection(DOO_OPTIONS,
    array(
        'title'  => __d('TOP IMDb'),
        'parent' => 'homepage',
        'icon'   => 'fa fa-minus',
        'fields' => array(
            array(
                'id'      => 'topimdbtitle',
                'type'    => 'text',
                'title'   => __d('Module Title'),
                'default' => __d('TOP IMDb'),
                'subtitle'    => __d('Add title to show')
            ),
            array(
                'id'    => 'topimdblayout',
                'type'  => 'radio',
                'title' => __d('Select Layout'),
                'subtitle'  => __d('Select the type of module to display'),
                'options' => array(
                    'movtv' => __d('Movies and TV Shows'),
                    'movie' => __d('Only Movies'),
                    'tvsho' => __d('Only TV Shows')
                ),
                'default' => 'movtv',
            ),
            array(
                'id'      => 'topimdbrangt',
                'type'    => 'text',
                'title'   => __d('Last months'),
                'subtitle'    => __d('Verify content in the following time range in months'),
                'default' => '12',
                'attributes' => array(
                    'type' => 'number',
                    'style' => 'width:100px'
                )
            ),
            array(
                'id'      => 'topimdbminvt',
                'type'    => 'text',
                'title'   => __d('Minimum votes'),
                'subtitle'    => __d('Set the minimum number of votes so that the content appears in the list'),
                'default' => '100',
                'attributes' => array(
                    'type' => 'number',
                    'style' => 'width:100px'
                )
            ),
            array(
                'id'      => 'topimdbitems',
                'type'    => 'text',
                'title'   => __d('Items number'),
                'subtitle'    => __d('Number of items to show'),
                'default' => '10',
                'attributes' => array(
                    'type' => 'number',
                    'style' => 'width:100px'
                )
            )
        )
    )
);
