<?php
/**
 * @since 2.5.0
 * @version 2.0
 */
CSF::createSection(DOO_OPTIONS,
    array(
        'title'  => __d('Main Slider'),
        'parent' => 'homepage',
        'icon'   => 'fa fa-minus',
        'fields' => array(
            array(
                'id'      => 'autocontentslider',
                'type'    => 'switcher',
                'title'   => __d('Get content automatically'),
                'default' => true,
            ),
            array(
                'id'       => 'sliderpostypes',
                'type'     => 'select',
                'title'    => __d('Post Types'),
                'subtitle' => __d('Select the type of content you want to display'),
                'default' => 'all',
                'options' => array(
                    'all'     => __d('Movies and TV Shows'),
                    'movies'  => __d('Only Movies'),
                    'tvshows' => __d('Only TV Shows')
                ),
                'dependency' => array('autocontentslider', '==', true)
            ),
            array(
                'id'      => 'slideritems',
                'type'    => 'text',
                'title'   => __d('Items number'),
                'subtitle'    => __d('Number of items to show'),
                'default' => '10',
                'attributes' => array(
                    'type' => 'number',
                    'style' => 'width:100px'
                ),
                'dependency' => array('autocontentslider', '==', true)
            ),
            array(
                'id'      => 'slidermodorderby',
                'type'    => 'select',
                'title'   => __d('Order by'),
                'subtitle'    => __d('Order items for this module'),
                'default' => 'date',
                'options' => array(
                    'date'     => __d('Post date'),
                    'title'    => __d('Post title'),
                    'modified' => __d('Last modified'),
                    'rand'     => __d('Random entry')
                ),
                'dependency' => array('autocontentslider', '==', true)
            ),
            array(
                'id'    => 'slidermodorder',
                'type'  => 'radio',
                'title' => __d('Order'),
                'options' => array(
                    'DESC' => __d('Descending'),
                    'ASC'  => __d('Ascending')
                ),
                'dependency' => array('autocontentslider|slidermodorderby','==|!=','true|rand'),
                'default' => 'DESC'
            ),
            array(
                'type'    => 'notice',
                'style'   => 'info',
                'content' => __d('To show content in the Slider you must add manually using only the ID numbers of each publication you want to show.'),
                'dependency' => array('autocontentslider','!=', true)
            ),
            array(
                'id'      => 'sliderpostids',
                'type'    => 'textarea',
                'title'    => __d('Posts ID'),
                'subtitle' => __d('Use the numeric IDs of the posts.'),
                'attributes' => array(
                    'placeholder' => '335,887,996,1085',
                    'rows' => '3'
                ),
                'after' => '<p>'.__d('Numeric IDs must be separated by a comma, use only numeric IDs of content that are established as Movies or TV Shows.').'</p>',
                'dependency' => array('autocontentslider','!=', true)
            ),
            array(
                'id'    => 'sliderautoplaycontrol',
                'type'  => 'checkbox',
                'title' => __d('Autoplay slider control'),
                'subtitle'  => __d('Check to enable auto-play slider.'),
                'options' => array(
                    'autopms' => __d('Autoplay Slider'),
                    'autopsm' => __d('Autoplay Slider Movies'),
                    'autopst' => __d('Autoplay Slider TV Shows')
                )
            ),
            array(
                'id'    => 'sliderspeed',
                'type'  => 'select',
                'title' => __d('Speed Slider'),
                'subtitle'  => __d('Select speed slider in secons'),
                'options' => array(
                    '4000' => __d('4 seconds'),
                    '3500' => __d('3.5 seconds'),
                    '3000' => __d('3 seconds'),
                    '2500' => __d('2.5 seconds'),
                    '2000' => __d('2 seconds'),
                    '1500' => __d('1.5 seconds'),
                    '1000' => __d('1 second'),
                    '500'  => __d('0.5 seconds')
                )
            )
        )
    )
);
