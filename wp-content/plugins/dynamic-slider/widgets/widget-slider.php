<?php
/*
 * Get Alerts for Upcoming Webinars.
 */
class WidgetSlider extends WP_Widget{

	/**
	 * Constructor
	 */
	function WidgetSlider(){
		
		$widget_ops = array( 'description' => __('Use this widget if you want to add set an image with a link') );
		//$control_ops = array( 'width' => 400, 'height' => 200 );
		parent::WP_Widget( 'slider_cms', __('Images Slider'), $widget_ops, $control_ops );
	}

	function widget($args,$instance){
		extract($args);
		?>

		<?php echo $before_widget; ?>
		<?php cms_slider(); ?>
		<?php echo $after_widget; ?>
<?php
	}
	function form($instance){
		?>

		<p>The home slider will be shown here.</p>
        <p>
          <label for="<?php echo $this->get_field_id('slider'); ?>"><?php _e('Select Slider:'); ?></label> 
          <select id="<?php echo $this->get_field_id('slider'); ?>" name="open" value="<?php echo stripslashes($instance['slider']) ?>">   	
          	<option value="_self">DynamicSlider</option>
          </select>                    
        </p>		
		<?php
	}
//http://www.inqbation.com/project/img/inqbation-logo.jpg
	function update($new_instance, $old_instance) {
		/*$instance['image'] = stripslashes($_POST['image']);
		$instance['link'] = stripslashes($_POST['link']);
		$instance['open'] = stripslashes($_POST['open']);*/
		
		foreach($_POST as $index=>$value){
			$instance[$index]=stripslashes($_POST[$index]);
		}
		return $instance;
	}
}

add_action('widgets_init', create_function('', 'return register_widget("WidgetSlider");'));

//$var=unserialize( );