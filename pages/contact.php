<?php
/*
Template Name: DT - Contact page
*/
get_header(); global $current_user; ?>
<div class="contact">
	<div class="wrapper">
		<h1><?php _d('Contact Form'); ?></h1>
		<p class="descrip"><?php _d('Have something to notify our support team, please do not hesitate to use this form.'); ?></p>
	</div>
	<div class="wrapper">
		<?php if(dooplay_get_option('contact_form') == true) { ?>
		<form id="dooplay-contact-form" class="contactame">
            <?php if(!is_user_logged_in()){ ?>
                <fieldset class="nine">
    				<label><?php _d('Name'); ?></label>
    				<input id="contact-name" type="text" name="name" required>
    			</fieldset>
    			<fieldset class="nine fix">
    				<label><?php _d('Email'); ?></label>
    				<input id="contact-email" type="text" name="email" required>
    			</fieldset>
            <?php } else { ?>
                <fieldset class="nine">
    				<label><?php _d('Name'); ?></label>
    				<input id="contact-name" type="text" name="name" value="<?php echo $current_user->display_name; ?>" required>
    			</fieldset>
    			<fieldset class="nine fix">
    				<label><?php _d('Email'); ?></label>
    				<input id="contact-email" type="text" name="email" value="<?php echo $current_user->user_email; ?>" required>
    			</fieldset>
            <?php } ?>
			<fieldset>
				<label><?php _d('Subject'); ?></label>
				<p><?php _d('How can we help?'); ?></p>
				<input id="contact-subject" type="text" name="subject" required>
			</fieldset>
			<fieldset>
				<label><?php _d('Your message'); ?></label>
				<p><?php _d('The more descriptive you can be the better we can help.'); ?></p>
				<textarea id="contact-message" name="message" rows="5" cols="" required></textarea>
			</fieldset>
			<fieldset>
				<label><?php _d('Link Reference (optional)'); ?></label>
				<input id="contact-link" type="text" name="link">
			</fieldset>
			<fieldset id="contact-response-message"></fieldset>
			<fieldset>
				<input id="contact-submit-button" type="submit" value="<?php _d('Send message'); ?>">
			</fieldset>
            <div id="dooplay-reCAPTCHA-response"></div>
			<input type="hidden" name="action" value="dbmovies_inboxes_form">
			<input type="hidden" name="type" value="contact">
		</form>
		<?php } else { ?>
		<fieldset id="contact-response-message">
			<div class="notice error animation-3"><?php _d('Contact form disabled'); ?></div>
		</fieldset>
		<?php } ?>
	</div>
</div>
<?php get_footer(); ?>
