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
class DT_Widget_mgenres extends WP_Widget {

	public function __construct() {
		$widget_ops = array('classname' => 'doothemes_widget', 'description' => __d('Full list of genres') );
		$control_ops = array('width' => 300, 'height' => 350, 'id_base' => 'dtw_mgenres');
		parent::__construct('dtw_mgenres', __d('DooPlay - Genres list'), $widget_ops, $control_ops );
	}

	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		$scroll = $instance[ 'dt_scroll' ] ? 'scrolling' : 'falsescroll';
		// Widget
		echo '<div class="dt_mainmeta">';
		echo '<nav class="genres">';
		echo '<h2 class="widget-title">'. $title .'</h2>';
		echo '<ul class="genres '.$scroll.'">';
		doo_li_genres();
		echo '</ul>';
		echo '</nav>';
		echo '</div>';
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		//Strip tags from title and name to remove HTML
		$instance['title']     = strip_tags(doo_isset($new_instance,'title'));
		$instance['dt_scroll'] = strip_tags(doo_isset($new_instance,'dt_scroll'));
		return $instance;
	}

	public function form($instance){
		//Set up some default widget settings.
		$defaults = array('title' => __d('Genres'), 'dt_scroll' => 'scrolling');
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
