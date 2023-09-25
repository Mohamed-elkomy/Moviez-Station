<div id="dbmovies-dbmvs-application" class="dbmovies-app">
    <!-- Header data -->
    <header class="dbmvsapp">
        <!-- Type content Selector -->
        <nav class="left" id="dbmovies-types">
            <ul>
                <li><h3 id="dbmvs-logo-status"><a href="<?php echo DBMOVIES_DBMVAPI; ?>" target="_blank">DBMVS</a> <small><?php echo DBMOVIES_VERSION; ?></small></h3></li>
                <li><a id="dbmvstabapp-movie" href="#" class="dbmvs-tab-content button button-primary" data-type="movie"><?php _d('Movies'); ?></a></li>
                <li><a id="dbmvstabapp-tv" href="#" class="dbmvs-tab-content button" data-type="tv"><?php _d('Shows'); ?></a></li>
            </ul>
            <div class="dbmvs-cloud">
                <a class="dbdata consultor" href="#"><strong><?php _d('Credits'); ?>:</strong> <span id="dbmvs-credits">0</span></a>
                <a class="dbdata consultor" href="#"><strong><?php _d('Used'); ?>:</strong> <span id="dbmvs-credits-used">0</span></a>
                <a class="dbdata consultor" href="#"><strong><?php _d('Requests'); ?>:</strong> <span id="dbmvs-requests">0</span></a>
                <a class="dbdata consultor" href="#"><strong><?php _d('Auto embed'); ?>:</strong> <span id="dbmvs-autoembed">0</span></a>
            </div>
        </nav>

        <!-- Api Settings and responser-->
        <nav class="right" id="dbmovies-settings">
            <ul>
                <li class="title"><?php _d('Meta Updater'); ?></li>
                <li id="meta-updater-process">
                    <div class="proccess-bar"><div class="into"></div></div>
                    <span class="percentage"></span>
                    <span class="spinner is-active"></span>
                </li>
                <li id="meta-updater-controls">
                    <a href="#" id="dbmvs-finish-metaupdater"class="button button-secundary button-small metaupdater-control" data-control="finish"><?php _d('Finish'); ?></a>
                    <a href="#" class="button button-primary button-small metaupdater-control" data-control="continue"><?php _d('Continue'); ?></a>
                </li>
                <li id="meta-updater-pause">
                    <a href="#" class="button button-secundary button-small metaupdater-control" data-control="pause"><i class="dashicons dashicons-controls-pause"></i></a>
                </li>
                <li id="meta-updater-run">
                    <a href="#" id="dbmvs-metaupdater" class="button button-primary button-small" data-control="updater"><?php _d('Start'); ?></a>
                </li>
            </ul>
        </nav>
        <input id="dbmvs-metaupdater-nonce" type="hidden" value="<?php echo wp_create_nonce('dbmvs-metaupdater-nonce'); ?>">
        <input id="dbmvs-metaupdater-status" type="hidden" value="progress">
    </header>
    <!-- Forms -->
    <div id="dbmvs-forms-response" class="forms">
        <!-- Filter content for Year -->
        <form id="dbmovies-form-filter">
            <fieldset>
                <a class="button button-large dbmovies-log-collapse" href="#"><?php _d('Expand'); ?></a>
            </fieldset>
            <fieldset>
                <input type="number" id="dbmvs-year" min="1900" max="<?php echo date('Y')+1; ?>" name="year" value="<?php echo rand('2000', date('Y')); ?>" placeholder="<?php _d('Year'); ?>">
            </fieldset>
            <fieldset>
                <input type="number" id="dbmvs-page" min="1" name="page" value="1" placeholder="<?php _d('Page'); ?>">
            </fieldset>
            <fieldset>
                <select id="dbmvs-popularity" name="popu">
                    <option value="popularity.desc"><?php _d('Popularity desc'); ?></option>
                    <option value="popularity.asc"><?php _d('Popularity asc'); ?></option>
                </select>
            </fieldset>
            <fieldset id="genres-box-movie" class="genres on">
                <select id="dbmvs-movies-genres" name="genres-movie">
                    <?php echo $this->GenresMovies(); ?>
                </select>
            </fieldset>
            <fieldset id="genres-box-tv" class="genres">
                <select id="dbmvs-tvshows-genres" name="genres-tv">
                    <?php echo $this->GenresTVShows(); ?>
                </select>
            </fieldset>
            <fieldset>
                <input type="submit" id="dbmvs-btn-filter" class="button button-large" value="<?php _d('Discover'); ?>">
                <input type="hidden" value="dbmovies_app_filter" name="action">
                <input type="hidden" id="dbmvs-filter-type" name="type" value="movie">
            </fieldset>
            <fieldset id="bulk-importer-click">
                <a href="#" id="bulk-importer" class="button button-primary button-large"><?php _d('Bulk import'); ?></a>
            </fieldset>
        </form>
        <!-- Search content for string -->
        <form id="dbmovies-form-search" class="right">
            <fieldset>
                <input type="text" id="dbmvs-search-term" name="searchterm" placeholder="<?php _d('Search..'); ?>">
            </fieldset>
            <fieldset>
                <input type="submit" id="dbmvs-btn-search" class="button button-large" value="<?php _d('Search'); ?>">
                <input type="hidden" id="dbmvs-search-page" name="searchpage" value="1">
                <input type="hidden" id="dbmvs-search-type" name="searchtype" value="movie">
                <input type="hidden" value="dbmovies_app_search" name="action">
            </fieldset>
        </form>
    </div>
    <!-- Progress Bar -->
    <div class="dbmvs-progress-bar">
        <div class="progressing"></div>
    </div>
    <!-- Response Log -->
    <div class="dbmovies-logs" style="display:none">
        <div id="dbmovies-logs-box" class="box">
            <ul>
                <i id="dbmvs-log-indicator"></i>
            </ul>
        </div>
        <div class="hidder">
            <a id="dbmovies-cleanlog" href="#"><?php _d('Clean'); ?></a>
        </div>
    </div>
    <!-- Json Response -->
    <div class="wrapp">
        <div class="content">
            <input type="hidden" id="current-year">
            <input type="hidden" id="current-page">
            <input type="hidden" id="dtotal-items">
            <!-- Response results data -->
            <div id="dbmovies-response-data"class="data_results">
                <section>
                    <?php echo sprintf(__d('About %s results (%s seconds)'),'<span id="dbmvs-total-results">0</span>','<span id="time-execution-seconds">0</span>'); ?>
                </section>
                <section class="right">
                    <?php echo sprintf(__d('Loaded pages %s'),'<span id="dbmvs-current-page">0</span>'); ?>
                </section>
            </div>
            <!-- Load results items -->
            <div id="dbmovies-response-box" class="items">
                <i id="response-dbmovies"></i>
            </div>
            <!-- Paginator -->
            <div class="paginator">
                <div id="dbmovies-loadmore-spinner"></div>
                <a href="#" id="dbmovies-loadmore" class="button button-primary dbmvsloadmore"><?php _d('Load More'); ?></a>
            </div>
            <!-- Dbmvs Global stats -->
            <div id="dbmvs_global_stats" class="dbmvstats fadein">
                <div class="box">
                    <section data-dbmvs="total_credits">
                        <span id="dbmvs_total_credits" class="number">0</span>
                        <span class="text"><?php _d('Globals credits'); ?></span>
                    </section>
                    <section data-dbmvs="total_requests">
                        <span id="dbmvs_total_requests" class="number">0</span>
                        <span class="text"><?php _d('Delivered queries'); ?></span>
                    </section>
                    <section data-dbmvs="total_caching">
                        <span id="dbmvs_total_caching" class="number">0</span>
                        <span class="text"><?php _d('Queries stored'); ?></span>
                    </section>
                    <section data-dbmvs="total_sites">
                        <span id="dbmvs_total_sites" class="number">0</span>
                        <span class="text"><?php _d('Sites actives'); ?></span>
                    </section>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Go Top -->
<a id="dbmovies-back-top" href="#" class="button button-secundary"><i class="dashicons dashicons-arrow-up-alt2"></i></a>
