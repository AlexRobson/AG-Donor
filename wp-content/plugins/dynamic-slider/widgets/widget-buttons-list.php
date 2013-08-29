<?php
/*
 * Get Alerts for Upcoming Webinars.
 */
class WidgetButtons extends WP_Widget{

	/**
	 * Constructor
	 */
	function WidgetButtons(){
		
		$widget_ops = array( 'description' => __('A list of buttons.') );
		$control_ops = array( 'width' => 400, 'height' => 200 );
		parent::WP_Widget( 'image_cms', __('Buttons List'), $widget_ops, $control_ops );
	

	}

	function widget($args,$instance){
		extract($args);
		?>

		<?php echo $before_widget; ?>
			<div class="textwidget">
        <ul>
<?php 
$total_buttons = 4;
for($i=1; $i<=$total_buttons; $i++): 
?>
	<li><a class="banner-<?php echo $i ?>" href="<?php echo $instance['link-'.$i] ?>" title="<?php echo strip_tags($instance['text-'.$i]) ?>"><?php echo $instance['text-'.$i] ?></a></li>
<?php endfor; ?>
        </ul>
			</div>
		<?php echo $after_widget; ?>
<?php
	}

	function form($instance){
	$total_buttons = 4;
		?>
        <p>
<?php for($i=1; $i<=$total_buttons; $i++): ?>
          <label for="<?php echo $this->get_field_id('text-'.$i); ?>"><?php _e('Text '.$i.':'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('text-'.$i); ?>" name="text-<?php echo $i ?>" value="<?php echo stripslashes($instance['text-'.$i]) ?>"/>

          <label for="<?php echo $this->get_field_id('link-'.$i); ?>"><?php _e('Link '.$i.':'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('link-'.$i); ?>" name="link-<?php echo $i ?>" value="<?php echo stripslashes($instance['link-'.$i]) ?>"/>
<?php endfor; ?>
              
        </p>	

   	
		<?php
	}

	function update($new_instance, $old_instance) {		
		foreach($_POST as $index=>$value){
			$instance[$index]=stripslashes($_POST[$index]);
		}
		return $instance;
	}
}

add_action('widgets_init', create_function('', 'return register_widget("WidgetButtons");'));
