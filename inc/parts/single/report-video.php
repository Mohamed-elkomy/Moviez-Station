<!-- Report Content -->
<?php if(dooplay_get_option('report_form') == true) { ?>
<div id="moda-report-video-error" class="report_modal hidde">
    <div class="box animation-3">
        <div class="form">
            <h3 id="report-title"><span><?php _d('What\'s happening?'); ?></span> <a class="close-modal-report"><i class="fas fa-times"></i></a></h3>
            <div id="report-response-message"></div>
            <div class="dooplay-report-form">
                <form id="dooplay-report-form">
                    <fieldset>
                        <label>
                            <input class="report-video-checkbox" type="checkbox" name="problem[]" autocomplete="off" value="labeling">
                            <span class="title"><?php _d('Labeling problem'); ?></span>
                            <span class="text"><?php _d('Wrong title or summary, or episode out of order'); ?></span>
                        </label>
                        <label>
                            <input class="report-video-checkbox" type="checkbox" name="problem[]" autocomplete="off" value="video">
                            <span class="title"><?php _d('Video Problem'); ?></span>
                            <span class="text"><?php _d('Blurry, cuts out, or looks strange in some way'); ?></span>
                        </label>
                        <label>
                            <input class="report-video-checkbox" type="checkbox" name="problem[]" autocomplete="off" value="audio">
                            <span class="title"><?php _d('Sound Problem'); ?></span>
                            <span class="text"><?php _d('Hard to hear, not matched with video, or missing in some parts'); ?></span>
                        </label>
                        <label>
                            <input class="report-video-checkbox" type="checkbox" name="problem[]" autocomplete="off" value="caption">
                            <span class="title"><?php _d('Subtitles or captions problem'); ?></span>
                            <span class="text"><?php _d('Missing, hard to read, not matched with sound, misspellings, or poor translations'); ?></span>
                        </label>
                        <label>
                            <input class="report-video-checkbox" type="checkbox" name="problem[]" autocomplete="off" value="buffering">
                            <span class="title"><?php _d('Buffering or connection problem'); ?></span>
                            <span class="text"><?php _d('Frequent rebuffering, playback won\'t start, or other problem'); ?></span>
                        </label>
                    </fieldset>
                    <fieldset id="report-video-message-field">
                        <textarea name="message" rows="3" placeholder="<?php _d("What is the problem? Please explain.."); ?>"></textarea>
                    </fieldset>
                    <fieldset id="report-video-email-field">
                        <input type="email" name="email" placeholder="<?php _d('Email address'); ?>">
                    </fieldset>
                    <fieldset id="report-video-button-field">
                        <input id="report-submit-button" type="submit" value="<?php _d('Send report'); ?>">
                        <input type="hidden" name="action" value="dbmovies_inboxes_form">
            			<input type="hidden" name="type" value="report">
                        <input type="hidden" name="postid" value="<?php the_id(); ?>">
                        <input type="hidden" name ="nonce" value="<?php echo dooplay_create_nonce('dooplay_report_nonce'); ?>">
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
<?php } ?>
