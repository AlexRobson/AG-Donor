<?php
/*
 * Get Alerts for Upcoming Webinars.
 */
class WidgetImageText extends WP_Widget{

	/**
	 * Constructor
	 */
	function WidgetImageText(){
		
		$widget_ops = array( 'description' => __('Use this widget if you want to add set an image with a link and a text') );
		$control_ops = array( 'width' => 400, 'height' => 200 );
		parent::WP_Widget( 'image_cms', __('Custom Image with Text'), $widget_ops, $control_ops );
	

	}

	function widget($args,$instance){
		extract($args);
		?>

		<?php echo $before_widget; ?>
			<div class="textwidget">
				<?php 
				$link_before='';
				$link_after='';
										
				if(!empty($instance['link'])):
						$link_before='<a href="'.$instance['link'].'" target="'.$instance['open'].'">';
						$link_after='</a>'; 
				endif;
				?>
				<?php echo $link_before; ?>
				<img src="<?php echo $instance['image']; ?>" title="<?php echo $instance['title']; ?>" alt="<?php echo $instance['alt']; ?>"/>
				<?php echo $link_after; ?>
			</div>
		<?php echo $after_widget; ?>
		
<?php 



?>
<?php
	}

	function form($instance){
		?>
		<?php if(!empty($instance['image'])): ?>
		<img src="<?php echo stripslashes($instance['image']) ?>" width="220"/>
		<?php endif; ?>
        <p>
          <label for="<?php echo $this->get_field_id('image'); ?>"><?php _e('Image:'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('image'); ?>" name="image" value="<?php echo stripslashes($instance['image']) ?>"/>
          
          <label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('Link:'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('link'); ?>" name="link" value="<?php echo stripslashes($instance['link']) ?>"/>
          
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title(Optional):'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="title" value="<?php echo stripslashes($instance['title']) ?>"/>
          
          <label for="<?php echo $this->get_field_id('alt'); ?>"><?php _e('Description (Optional):'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('alt'); ?>" name="alt" value="<?php echo stripslashes($instance['alt']) ?>"/>          
                    
          <label for="<?php echo $this->get_field_id('open'); ?>"><?php _e('Open link at:'); ?></label> 
          <select id="<?php echo $this->get_field_id('open'); ?>" name="open" value="<?php echo stripslashes($instance['open']) ?>">
          	
          	<?php 
          	$selected='';
          	if($instance['open'] == '_blank') $selected='selected=selected'; 
          	?>
          	<option value="_blank" <?php echo $selected; ?>>New Page</option>
          	<?php 
          	$selected='';
          	if($instance['open'] == '_self') $selected='selected=selected'; 
          	?>          	
          	<option value="_self"  <?php echo $selected; ?>>Self Page</option>
          </select>                    
        </p>	

          <label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Text:'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="text" value="<?php echo stripslashes($instance['text']) ?>"/>    	
		<?php
	}

	function update($new_instance, $old_instance) {		
		foreach($_POST as $index=>$value){
			$instance[$index]=stripslashes($_POST[$index]);
		}
		return $instance;
	}
}

add_action('widgets_init', create_function('', 'return register_widget("WidgetImageText");'));
