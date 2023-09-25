<?php

$json = array(
    'url'       => admin_url('admin-ajax.php', 'relative'),
    'wait'      => __d('please wait...'),
    'error'     => __d('Unknown error'),
    'loading'   => __d('Loading...'),
    'recaptcha' => dooplay_get_option('gcaptchasitekeyv3')
);

$json = json_encode( $json );

?>    <div class="text_ft"><?php bloginfo('name'); ?> &copy; <?php echo date('Y'); ?></div>
	</div>
</div>
<script type='text/javascript'>
    var Auth = <?php echo $json; ?>;
</script>
<script type='text/javascript' src='<?php echo DOO_URI.'/assets/js/front.auth'.doo_devmode().'.js'; ?>'></script>
</body>
</html>
