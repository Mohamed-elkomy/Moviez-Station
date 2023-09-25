<?php
/*
* -------------------------------------------------------------------------------------
* @author: Doothemes
* @author URI: https://doothemes.com/
* @copyright: (c) 2021 Doothemes. All rights reserved
* -------------------------------------------------------------------------------------
*
* @since 2.5.0
*
*/

class DT_Widget_mreleases extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'doothemes_widget', 'description' => __d('Full list release year') );
		$control_ops = array('width' => 300, 'height' => 350, 'id_base' => 'dtw_mreleases');
		parent::__construct('dtw_mreleases', __d('DooPlay - Release year list'), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		$scroll = $instance[ 'dt_scroll' ] ? 'scrolling' : 'falsescroll';
		// Widget
		echo '<div class="dt_mainmeta">';
		echo '<nav class="releases">';
		echo '<h2>'. $title .'</h2>';
		echo '<ul class="releases '.$scroll.'">';
		doo_release_years();
		echo '</ul>';
		echo '</nav>';
		echo '</div>';
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		//Strip tags from title and name to remove HTML
		$instance['title']     = strip_tags(doo_isset($new_instance,'title'));
		$instance['dt_scroll'] = strip_tags(doo_isset($new_instance,'dt_scroll', false));
		return $instance;
	}

	function form( $instance ) {
		//Set up some default widget settings.
		$defaults = array('title' => __d('Release year'), 'dt_scroll' => 'scrolling');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _d('Title:'); ?></label>
			<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance[ 'dt_scroll' ], 'on'); ?> id="<?php echo $this->get_field_id('dt_scroll'); ?>" name="<?php echo $this->get_field_name('dt_scroll'); ?>" />
			<label for="<?php echo $this->get_field_id('dt_scroll'); ?>"> <?php _d('Enable scrolling'); ?></label>
		</p>
	<?php
	}

}
