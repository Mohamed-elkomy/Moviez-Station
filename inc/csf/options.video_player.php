<?php
/**
 * @since 2.5.0
 * @version 2.0
 */
CSF::createSection(DOO_OPTIONS,
    array(
        'title'  => __d('Video Player'),
        'parent' => 'settings',
        'icon'   => 'fa fa-minus',
        'fields' => array(
			####################################################################
			//Edit by bescraper
			array(
                'id'      => 'auto_embed',
                'type'    => 'switcher',
                'title'   => __d('Auto embed'),
                'label'   => __d('Auto embed player by bescraper.cf'),
                'default' => true
            ),
            array(
                'id' => 'auto_embed_method',
                'type' => 'checkbox',
                'title' => __d('Auto embed post'),
                'subtitle' => __d('Auto fetching embed servers for'),
                'default' => 'admin_ajax',
                'options' => array(
                    'besmv' => __d('Auto-embed for movies'),
                    'bestv' => __d('Auto-embed for Tv Shows'),
                    'besli' => __d('Add auto download links for movies'),
                    'besmr' => __d('Keep old links'),
                    'bes2e' => __d('Add 2embed.ru server'),
                ),
                'dependency' => array('auto_embed', '==', true)
            ),	
            array(
                'id'    => 'besidoma',
                'type'  => 'select',
                'title' => __d('Flag Language	'),
                'subtitle'  => __d('Select Flag Language'),
                'attributes' => array(
                    'style' => 'max-width:250px'
                ),
                'options'  => array(
                    ''      => '-------',
					'cn'	=> 'Chinese',
					'dk'	=> 'Denmark',
					'nl'	=> 'Dutch',
					'en'	=> 'English',
					'gb'	=> 'English British',
					'egt'	=> 'Egypt',
					'fr'	=> 'French',
					'de'	=> 'German',
					'id'	=> 'Indonesian',
					'in'	=> 'Hindi',
					'it'	=> 'Italian',
					'jp'	=> 'Japanese',
					'kr'	=> 'Korean',
					'ph'	=> 'Philippines',
					'pt'	=> 'Portuguese Portugal',
					'br'	=> 'Portuguese Brazil',
					'pl'	=> 'Polish',
					'td'	=> 'Romanian',
					'sco'	=> 'Scotland',
					'es'	=> 'Spanish Spain',
					'mx'	=> 'Spanish Mexico',
					'ar'	=> 'Spanish Argentina',
					'pe'	=> 'Spanish Peru',
					'cl'	=> 'Spanish Chile',
					'co'	=> 'Spanish Colombia',
					'se'	=> 'Sweden',
					'tr'	=> 'Turkish',
					'ru'	=> 'Rusian',
					'vn'	=> 'Vietnam'
                ),
                'default'  => '',				
            ),			
			####################################################################	
            array(
                'id'      => 'playajax',
                'type'    => 'switcher',
                'title'   => __d('Ajax Mode'),
                'default' => true,
                'label'   => __d('This function delivers data safely and agile with WP-JSON')
            ),
            array(
                'id' => 'playajaxmethod',
                'type' => 'radio',
                'title' => __d('Delivery method'),
                'subtitle' => __d('Select the most convenient delivery method for your website.'),
                'default' => 'admin_ajax',
                'options' => array(
                    'admin_ajax' => '<code><strong>admin-ajax</strong></code> '.__d('This method is safe but not very agile'),
                    'wp_json'    => '<code><strong>wp-json</strong></code> '.__d('This method is simplified and very agile.')
                ),
                'dependency' => array('playajax', '==', true)
            ),
            array(
                'type'    => 'notice',
                'style'   => 'info',
                'content' => __d('If you have important traffic it would be advisable not to activate this function, if it is activated we recommend deactivating the Auto Load'),
                'dependency' => array('playajax|playajaxmethod','==|==','true|admin_ajax')
            ),
            array(
                'type'    => 'notice',
                'style'   => 'info',
                'content' => __d('The selected delivery method is unsafe but very agile, if you have significant traffic we recommend disabling automatic loading'),
                'dependency' => array('playajax|playajaxmethod','==|==','true|wp_json')
            ),
            array(
                'id'    => 'playautoload',
                'type'  => 'switcher',
                'title' => __d('Auto Load'),
                'label' => __d('Load the first element of video player with the page'),
                'dependency' => array('playajax', '==', true)
            ),
            array(
                'type'    => 'notice',
                'style'   => 'info',
                'content' => __d('The first element of the player will be loaded between 0 and 4 seconds after completing the total load of the page'),
                'dependency' => array('playajax|playautoload', '==|==', 'true|true')
            ),
            array(
                'id'    => 'playwait',
                'type'  => 'text',
                'title' => __d('Timeout'),
                'subtitle'  => __d('Time to wait in seconds before displaying Video Player'),
                'default' => '10',
                'attributes' => array(
                    'style' => 'width:100px',
                    'type' => 'number'
                ),
                'dependency' => array('playajax', '==', true)
            ),
            array(
                'id'    => 'playauto',
                'type'  => 'checkbox',
                'title' => __d('Auto Play'),
                'subtitle'  => __d('Check if you want the videos to play automatically'),
                'options' => array(
                    'ytb' => __d('Auto-play YouTube videos'),
                    'jwp' => __d('Auto-play JWPlayer videos')
                )
            ),
            array(
                'id'    => 'playsize',
                'type'  => 'radio',
                'title' => __d('Player size'),
                'subtitle'  => __d('Select a specific size for video player'),
                'options' => array(
                    'regular' => __d('Regular size'),
                    'bigger'  => __d('Bigger size'),
                ),
                'default' => 'regular'
            ),
            array(
                'id'       => 'playsource',
                'type'     => 'checkbox',
                'title'    => __d('Video Sources'),
                'subtitle' => __d('Uncheck to hide the source'),
                'label'    => __d('Show the domain or source of the video'),
                'default'  => true
            ),
            array(
                'id'       => 'playsourcescrolling',
                'type'     => 'checkbox',
                'title'    => __d('Video Sources Scrolling'),
                'subtitle' => __d('Scrolling by default is disabled from mobile devices'),
                'label'    => __d('Enable scrolling of video sources'),
                'default'  => true
            ),
            array(
                'type'       => 'subheading',
                'content'    => __d('Video Player')
            ),
            array(
                'id'      => 'jwpage',
                'type'    => 'select',
                'title'   => __d('Page jwplayer'),
                'subtitle'    => __d('Select page to display player'),
                'options' => 'pages'
            ),
            array(
                'id'    => 'player',
                'type'  => 'radio',
                'title' => __d('Player'),
                'options' => array(
                    'jwp8' => __d('JW Player 8'),
                    'jwp7' => __d('JW Player 7'),
                    'plyr' => __d('Plyr.io')
                ),
                'default' => 'plyr'
            ),
            array(
                'id'      => 'playercolor',
                'type'    => 'color',
                'title'   => __d('Main color'),
                'subtitle'    => __d('Choose a color'),
                'default' => '#0b7ef4'
            ),
            array(
                'id'      => 'jwkey',
                'type'    => 'text',
                'title'   => __d('License Key'),
                'subtitle'    => __d('JW Player 7 (Self-Hosted)'),
                'default' => 'IMtAJf5X9E17C1gol8B45QJL5vWOCxYUDyznpA==',
                'dependency' => array('player', '==', 'jwp7')
            ),
            array(
                'id'      => 'jw8key',
                'type'    => 'text',
                'title'   => __d('License Key'),
                'subtitle'    => __d('JW Player 8 (Self-Hosted)'),
                'default' => '64HPbvSQorQcd52B8XFuhMtEoitbvY/EXJmMBfKcXZQU2Rnn',
                'dependency' => array('player', '==', 'jwp8')
            ),
            array(
                'id'      => 'jwabout',
                'type'    => 'text',
                'title'   => __d('About text'),
                'subtitle'    => __d('JW Player About text in right click'),
                'default' => 'Powered by JW Player',
                'dependency' => array('player', '!=', 'plyr')
            ),
            array(
                'id'    => 'jwlogo',
                'type'  => 'media',
                'title' => __d('Logo player'),
                'subtitle'  => __d('Upload your logo using the Upload Button or insert image URL'),
                'dependency' => array('player', '!=', 'plyr')
            ),
            array(
                'id'    => 'jwposition',
                'type'  => 'select',
                'title' => __d('Logo position'),
                'subtitle'  => __d('Select a postion for logo player'),
                'options' => array(
                    'top-left'     => __d('Top left'),
                    'top-right'    => __d('Top right'),
                    'bottom-left'  => __d('Bottom left'),
                    'bottom-right' => __d('Bottom right')
                ),
                'dependency' => array('player', '!=', 'plyr')
            ),
            array(
                'type'    => 'subheading',
                'content' => __d('Fake Player')
            ),
            array(
                'type'    => 'notice',
                'style'   => 'warning',
                'content' => __d('This module does not work if Auto-Load is activated'),
                'dependency' => array('playautoload|fakeplayer', '==|==', 'true|true')
            ),
            array(
                'id'         => 'fakeplayer',
                'type'       => 'switcher',
                'title'      => __d('Enable'),
                'label'      => __d('Enable Fake Player')
            ),
            array(
                'id'         => 'fakebackdrop',
                'type'       => 'text',
                'title'      => __d('Backdrop URL'),
                'subtitle'      => __d('Show background image by default if the system did not find an image in the content'),
                'dependency' => array('fakeplayer', '==', 'true'),
                'attributes' => array(
                    'placeholder' => 'https://'
                )
            ),
            array(
                'id'       => 'fakeoptions',
                'type'     => 'checkbox',
                'title'    => __d('Show in Fake Player'),
                'options'  => array(
                    'pla' => __d('Play button'),
                    'ads' => __d('Notify what is an ad'),
                    'qua' => __d('HD Quality')
                ),
                'default'  => array('pla','ads','qua'),
                'dependency' => array('fakeplayer', '==', 'true')
            ),
            array(
                'type'       => 'content',
                'content'    => '<h2>'.__d('Advertising links for fake player').'</h2>',
                'dependency' => array('fakeplayer', '==', 'true')
            ),
            array(
                'type'       => 'content',
                'content'    => '<p>'.__d('Add as many ad links as you wish, these are displayed randomly in the Fake Player').'</p>',
                'dependency' => array('fakeplayer', '==', 'true')
            ),
            array(
                'id'              => 'fakeplayerlinks',
                'type'            => 'group',
                'button_title'    => __d('Add link'),
                'accordion_title' => __d('Add new link'),
                'dependency' => array('fakeplayer', '==', 'true'),
                'fields' => array(
                    array(
                        'id'   => 'link',
                        'type' => 'text',
                        'attributes' => array(
                            'placeholder' => 'http://'
                        )
                    )
                )
            )
        )
    )
);
