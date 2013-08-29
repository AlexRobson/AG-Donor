<?php
/*
 * Get Alerts for Upcoming Webinars.
 */
class WidgetHTML extends WP_Widget{

	/**
	 * Constructor
	 */
	function WidgetHTML(){
		
		$widget_ops = array( 'description' => __('Use this widget if you want to add custom html code. inQbation Labs') );
		$control_ops = array( 'width' => 430, 'height' => 400 );
		parent::WP_Widget( 'html_cms', __('Custom HTML'), $widget_ops, $control_ops );
				
		//parent::WP_Widget(false, $name='Custom HTML');

	}

	function widget($args,$instance){
		?>

		<div id="<?php echo $args['widget_id']; ?>">
			<div class="textwidget">
				<?php echo $instance['html']; ?>
			</div>

		</div>
		<?php
	}

	function form($instance){
		?>
        <p>
          <label for="<?php echo $this->get_field_id('html'); ?>"><?php _e('HTML:'); ?></label> 
          <textarea class="widefat" id="<?php echo $this->get_field_id('html'); ?>" name="html" ><?php echo stripslashes($instance['html']) ?></textarea>
        </p>		
		<?php
	}

	function update($new_instance, $old_instance) {
		$instance['html'] = stripslashes($_POST['html']);
		return $instance;
	}
}

add_action('widgets_init', create_function('', 'return register_widget("WidgetHTML");'));