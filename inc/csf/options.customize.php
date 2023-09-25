<?php
// Define defaults colors
switch(dooplay_get_option('style','default')) {
    case 'dark':
        $mcolor = '#408BEA';
        $bcolor = '#464e5a';
    break;
    case 'fusion':
        $mcolor = '#408BEA';
        $bcolor = '#9facc1';
    break;
    case 'default':
        $mcolor = '#408BEA';
        $bcolor = '#F5F7FA';
    break;
}

/**
 * @since 2.5.0
 * @version 2.0
 */
CSF::createSection(DOO_OPTIONS,
    array(
        'title'  => __d('Customize'),
        'parent' => 'settings',
        'icon'   => 'fa fa-minus',
        'fields' => array(
            array(
                'id'    => 'style',
                'type'  => 'image_select',
                'title' => __d('Color Scheme'),
                'subtitle'  => __d('Select the default color scheme'),
                'options'  => array(
                    'default' => DOO_URI.'/assets/img/style-default.png',
                    'fusion'  => DOO_URI.'/assets/img/style-fusion.png',
                    'dark'    => DOO_URI.'/assets/img/style-dark.png'
                ),
                'default'  => 'default',
            ),
            array(
                'id'      => 'max_width',
                'type'    => 'slider',
                'title'   => __d('Max width'),
                'subtitle'=> __d('Set max width of the page'),
                'min'     => 1200,
                'max'     => 1500,
                'step'    => 10,
                'unit'    => 'px',
                'default' => 1200,
            ),
            array(
                'id'      => 'dynamicbg',
                'type'    => 'switcher',
                'title'   => __d('Single background'),
                'subtitle'    => __d('Check whether to activate or deactivate'),
                'label'   => __d('Enable dynamic background'),
                'default' => false
            ),
            array(
                'id'    => 'font',
                'type'  => 'select',
                'title' => __d('Font family'),
                'subtitle'  => __d('Select font-family by Google Fonts'),
                'attributes' => array(
                    'style' => 'max-width:250px'
                ),
                'options'  => array(
                    'Roboto'          => 'Roboto',
                    'Open+Sans'       => 'Open Sans',
                    'Raleway'         => 'Raleway',
                    'Source+Sans+Pro' => 'Source Sans Pro',
                    'Noto+Sans'       => 'Noto Sans',
                    'Quicksand'       => 'Quicksand',
                    'Questrial'       => 'Questrial',
                    'Rubik'           => 'Rubik',
                    'Archivo+Narrow'  => 'Archivo Narrow',
                    'Work+Sans'       => 'Work Sans',
                    'Signika'         => 'Signika',
                    'Nunito+Sans'     => 'Nunito Sans',
                    'Alegreya+Sans'   => 'Alegreya Sans',
                    'BenchNine'       => 'BenchNine',
                    'Yantramanav'     => 'Yantramanav',
                    'Pontano Sans'    => 'Pontano Sans',
                    'Gudea'           => 'Gudea',
                    'Cabin+Condensed' => 'Cabin Condensed',
                    'Khand'           => 'Khand',
                    'Ruda'            => 'Ruda'
                ),
                'default'  => 'Roboto'
            ),
            array(
                'id'      => 'maincolor',
                'type'    => 'color',
                'title'   => __d('Primary color'),
                'subtitle'    => __d('Choose a color'),
                'default' => $mcolor
            ),
            array(
                'id'      => 'bgcolor',
                'type'    => 'color',
                'title'   => __d('Background container'),
                'subtitle'    => __d('Choose a color'),
                'default' => $bcolor
            ),
            array(
                'id'      => 'featucolor',
                'type'    => 'color',
                'title'   => __d('Featured marker'),
                'subtitle'    => __d('Choose a color'),
                'default' => '#00be08'
            ),
            array(
                'type'    => 'subheading',
                'content' => __d('Fusion alternative colors'),
                'dependency' => array('style', '==', 'fusion')
            ),
            array(
                'id'      => 'fbgcolor',
                'type'    => 'color',
                'title'   => __d('Background header bar'),
                'subtitle'    => __d('Choose a color'),
                'default' => '#000000',
                'dependency' => array('style', '==', 'fusion')
            ),
            array(
                'id'      => 'facolor',
                'type'    => 'color',
                'title'   => __d('Header link color'),
                'subtitle'    => __d('Choose a color'),
                'default' => '#ffffff',
                'dependency' => array('style', '==', 'fusion')
            ),
            array(
                'id'      => 'fhcolor',
                'type'    => 'color',
                'title'   => __d('Header link hover color'),
                'subtitle'    => __d('Choose a color'),
                'default' => '#408bea',
                'dependency' => array('style', '==', 'fusion')
            ),
            array(
                'type' => 'subheading',
                'content' => __d('Poster Play icon')
            ),
            array(
                'id'      => 'play_icon',
                'type'    => 'image_select',
                'title'   => __d('Hover Play Icon'),
                'options' => array(
                    'play1' => DOO_URI.'/assets/img/play1.png',
                    'play2' => DOO_URI.'/assets/img/play2.png',
                    'play3' => DOO_URI.'/assets/img/play3.png',
                    'play4' => DOO_URI.'/assets/img/play4.png',
                ),
                'default'   => 'play1'
            ),
            array(
                'type' => 'subheading',
                'content' => __d('Sidebar position')
            ),
            array(
                'id' => 'sidebar_position_home',
                'type' => 'radio',
                'title' => __d('Home page'),
                'default' => 'right',
                'options' => array(
                    'right' => __d('Right'),
                    'left'  => __d('Left')
                )
            ),
            array(
                'id' => 'sidebar_position_archives',
                'type' => 'radio',
                'title' => __d('Archives'),
                'default' => 'right',
                'options' => array(
                    'right' => __d('Right'),
                    'left'  => __d('Left')
                )
            ),
            array(
                'id' => 'sidebar_position_single',
                'type' => 'radio',
                'title' => __d('Single Post'),
                'default' => 'right',
                'options' => array(
                    'right' => __d('Right'),
                    'left'  => __d('Left')
                )
            ),
            array(
                'type'    => 'subheading',
                'content' => __d('Homepage')
            ),
            array(
                'id'    => 'homefullwidth',
                'type'  => 'switcher',
                'title' => __d('Full width'),
                'label' => __d('Enable full width only in homepage')
            ),
            array(
                'type'    => 'notice',
                'style'   => 'info',
                'content' => __d('<strong>NOTE:</strong> Drag and drop the modules in the order you want them')
            ),
            array(
                'id'    => 'homepage',
                'type'  => 'sorter',
                'default' => array(
                    'enabled' => array(
                        'slider'        => __d('Slider'),
                        'featured-post' => __d('Featured titles'),
                        'movies'        => __d('Movies'),
                        'ads'           => __d('Advertising'),
                        'tvshows'       => __d('TV Shows'),
                        'seasons'       => __d('TV Show > Season'),
                        'episodes'      => __d('TV Show > Episode'),
                        'top-imdb'      => __d('TOP IMDb'),
                        'blog'          => __d('Blog entries')
                    ),
                    'disabled' => array(
                        'widgethome'     => __d('Genres Widget'),
                        'slider-movies'  => __d('Slider Movies'),
                        'slider-tvshows' => __d('Slider TV Shows')
                    ),
                ),
                'enabled_title'  => __d('Modules enabled'),
                'disabled_title' => __d('Modules disabled'),
            ),
            array(
                'type'    => 'subheading',
                'content' => __d('Customize logos')
            ),
            array(
                'id'    => 'headlogo',
                'type'  => 'media',
                'title' => __d('Logo header'),
                'subtitle'  => __d('Upload your logo using the Upload Button')
            ),
            array(
                'id'    => 'favicon',
                'type'  => 'media',
                'title' => __d('Favicon'),
                'subtitle'  => __d('Upload a 16 x 16 px image that will represent your website\'s favicon')
            ),
            array(
                'id'    => 'touchlogo',
                'type'  => 'media',
                'title' => __d('Touch icon APP'),
                'subtitle'  => __d('Upload a 152 x 152 px image that will represent your Web APP')
            ),
            array(
                'id'    => 'adminloginlogo',
                'type'  => 'media',
                'title' => __d('Login / Register / WP-Admin'),
                'subtitle'  => __d('Upload your logo using the Upload Button')
            ),
            array(
                'type'    => 'subheading',
                'content' => __d('Footer settings')
            ),
            array(
                'id'      => 'footer',
                'type'    => 'radio',
                'title'   => __d('Footer'),
                'default' => 'simple',
                'options' => array(
                    'simple'   => __d('Simple'),
                    'complete' => __d('Complete')
                )
            ),
            array(
                'id'    => 'footercopyright',
                'type'  => 'text',
                'title' => __d('Footer copyright'),
                'subtitle'  => __d('Modify or remove copyright text')
            ),
            array(
                'id'    => 'logofooter',
                'type'  => 'media',
                'title' => __d('Logo footer'),
                'dependency' => array('footer', '==', 'complete')
            ),
            array(
                'id'    => 'footertext',
                'type'  => 'textarea',
                'title' => __d('Footer text'),
                'subtitle'  => __d('Text under footer logo'),
                'dependency' => array('footer', '==', 'complete')
            ),
            array(
                'id'    => 'footerc1',
                'type'  => 'text',
                'title' => __d('Title column 1'),
                'subtitle'  => __d('Footer menu'),
                'dependency' => array('footer', '==', 'complete')
            ),
            array(
                'id'    => 'footerc2',
                'type'  => 'text',
                'title' => __d('Title column 2'),
                'subtitle'  => __d('Footer menu'),
                'dependency' => array('footer', '==', 'complete')
            ),
            array(
                'id'    => 'footerc3',
                'type'  => 'text',
                'title' => __d('Title column 3'),
                'subtitle'  => __d('Footer menu'),
                'dependency' => array('footer', '==', 'complete')
            ),
            array(
                'type'    => 'subheading',
                'content' => __d('Custom CSS')
            ),
            array(
                'id'   => 'css',
                'type' => 'code_editor',
                'settings' => array(
                    'theme'  => 'mbo',
                    'mode'   => 'css',
                ),
                'after' => '<p>'.__d('Add only CSS code').'</p>'
            )
        )
    )
);
