<?php
/*
* -------------------------------------------------------------------------------------
* @author: Doothemes
* @author URI: https://doothemes.com/
* @aopyright: (c) 2021 Doothemes. All rights reserved
* -------------------------------------------------------------------------------------
*
* @since 2.5.0
*
*/

$ads = doo_compose_ad('_dooplay_adhome');
echo ($ads) ? '<div class="module_home_ads">'.$ads.'</div>' : false;
