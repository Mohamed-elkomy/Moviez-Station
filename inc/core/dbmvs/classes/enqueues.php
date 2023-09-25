<?php
/*
* ----------------------------------------------------
* @author: Doothemes
* @author URI: https://doothemes.com/
* @copyright: (c) 2021 Doothemes. All rights reserved
* ----------------------------------------------------
* @since 2.5.0
*/


class DDbmoviesEnqueues extends DDbmoviesHelpers{

    /**
     * @since 2.5.0
     * @version 1.0
     */
    public function __construct(){
        add_action('admin_enqueue_scripts', array(&$this,'Enqueues'));
    }

    /**
     * @since 2.5.0
     * @version 3.1
     */
    public function Enqueues(){
        $parameters = array(
            'formcot' => dooplay_get_option('contact_form') ? true : false,
            'formrpt' => dooplay_get_option('report_form') ? true : false,
            'dapikey' => $this->get_option('dbmovies'),
            'tapikey' => $this->get_option('themoviedb',DBMOVIES_TMDBKEY),
            'apilang' => $this->get_option('language','en-US'),
            'extimer' => $this->get_option('delaytime','500'),
            'rscroll' => $this->get_option('autoscrollresults','200'),
            'inscrll' => $this->get_option('autoscroll'),
            'safemod' => $this->get_option('safemode'),
            'titmovi' => $this->get_option('titlemovies'),
            'tittvsh' => $this->get_option('titletvshows'),
            'titseas' => $this->get_option('titleseasons'),
            'titepis' => $this->get_option('titlepisodes'),
            'noposti' => $this->get_option('nospostimp'),
            'pupload' => $this->get_option('upload'),
            'upmethd' => $this->get_option('updatermethod'),
            'csectin' => $this->Disset($_GET,'section'),
            'gerepis' => $this->Disset($_GET,'generate_episodes'),
            'upstats' => get_option('__dbmvs_cronmeta_status','paused'),
            'uppaged' => get_option('__dbmvs_cronmeta_paged','1'),
            'uptotal' => get_option('__dbmvs_cronmeta_total','0'),
            'uppages' => get_option('__dbmvs_cronmeta_pages'),
            'ajaxurl' => admin_url('admin-ajax.php','relative'),
            'dapiurl' => esc_url(DBMOVIES_DBMVAPI),
            'tapiurl' => esc_url(DBMOVIES_TMDBAPI),
            'prsseng' => __d('Processing..'),
            'nointrn' => __d('There is no Internet connection'),
            'dbmverr' => __d('Our services are out of line, please try again later'),
            'tmdberr' => __d('The title does not exist or resources are not available at this time'),
            'misskey' => __d('You have not added an API key for Dbmovies'),
            'loading' => __d('Loading..'),
            'loadmor' => __d('Load More'),
            'import'  => __d('Import'),
            'save'    => __d('Save'),
            'savech'  => __d('Save Changes'),
            'saving'  => __d('Saving..'),
            'uerror'  => __d('Unknown error'),
            'nerror'  => __d('Connection error'),
            'aerror'  => __d('Api key invalid or blocked'),
            'nocrdt'  => __d('There are not enough credits to continue'),
            'complt'  => __d('Process Completed'),
            'welcom'  => __d('Welcome, the service has started successfully'),
            'cllogs'  => __d('Log cleaned'),
            'imprted' => __d('Imported'),
            'updated' => __d('Updated'),
            'editxt'  => __d('Edit'),
            'nocont'  => __d('No content available'),
            'timest'  => array(
                'second'  => __d('Second'),
                'seconds' => __d('Seconds'),
                'minute'  => __d('Minute'),
                'minutes' => __d('Minutes'),
                'hour'    => __d('Hour'),
                'hours'   => __d('Hours'),
                'day'     => __d('Day'),
                'days'    => __d('Days'),
                'week'    => __d('Week'),
                'weeks'   => __d('Weeks'),
                'month'   => __d('Month'),
                'months'  => __d('Months'),
                'year'    => __d('Year'),
                'years'   => __d('Years')
            )
        );
        // All Scripts
        wp_enqueue_style('dbmovies-app', DBMOVIES_URI.'/assets/dbmovies'.$this->Minify().'.css', array(), DBMOVIES_VERSION);
        wp_enqueue_script('dbmovies-app', DBMOVIES_URI.'/assets/dbmovies'.$this->Minify().'.js', array('jquery'), DBMOVIES_VERSION);
        wp_localize_script('dbmovies-app', 'dbmovies', $parameters);
    }

    /**
     * @since 2.5.0
     * @version 1.0
     */
    private function Minify(){
        return (WP_DEBUG && defined('WP_DOOTHEMES_DEV')) ? '' : '.min';
    }

}

new DDbmoviesEnqueues;
