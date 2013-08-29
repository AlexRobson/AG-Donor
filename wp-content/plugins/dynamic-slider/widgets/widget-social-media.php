<?php
/*
 * Get Alerts for Upcoming Webinars.
 */
 
class WidgetSocial extends WP_Widget{

	/**
	 * Constructor
	 */
	function WidgetSocial() {		
		$widget_ops = array( 'description' => __('Use this widget to add social media buttons in your home.') );
		$control_ops = array( 'width' => 400, 'height' => 200 );
		parent::WP_Widget( 'social_cms', __('InQ Social Media Buttons'), $widget_ops, $control_ops );
	}

	function widget($args,$instance) {
		extract($args);
	?>

		<?php echo $before_widget; ?>
		<div class="textwidget">
			<div class="follow-us">  
			<h2><?php echo $instance['title'] ?></h2>
	
			<?php $opt = json_decode(get_option('inq-social')); ?>
	
      <ul>
        <?php if($opt->facebook != "") { ?>
					<li><a class="facebook-chicklet" href="<?php echo $opt->facebook ?>" title="Follow Us on Facebook" target="_blank">Facebook</a></li>
				<?php } ?>
				<?php if($opt->twitter != "") { ?>
					<li><a class="twitter-chicklet" href="<?php echo $opt->twitter ?>" title="Follow Us on Twitter" target="_blank">Twitter</a></li>
				<?php } ?>
				<?php if($opt->youtube != "") { ?>
					<li><a class="youtube-chicklet" href="<?php echo $opt->youtube ?>" title="Follow Us on Youtube" target="_blank">YouTube</a></li>
				<?php } ?>
				<?php if($opt->rss != "") { ?>
					<li><a class="rss-chicklet" href="<?php echo $opt->rss ?>" title="Follow Us on RSS" target="_blank">RSS</a></li>
				<?php } ?>
				<?php if($opt->custom1 != "") { ?>
					<li><a class="country-chicklet" href="<?php echo $opt->custom1 ?>" target="_blank" title="-">Custom 1</a></li>
				<?php } ?>
				<?php if($opt->custom2 != "") { ?>
					<li><a class="country-chicklet" href="<?php echo $opt->custom2 ?>" target="_blank" title="-">Custom 2</a></li>
				<?php } ?>
      </ul>
			</div>
		</div>
		<?php echo $after_widget; ?>
<?php
	}

	function form($instance) {
?>
		<p>Social Media buttons:</p>	
    <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title'); ?></label> 
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="title" value="<?php echo stripslashes($instance['title']) ?>"/>
<?php
	}

	function update($new_instance, $old_instance) {		
		foreach($_POST as $index=>$value) {
			$instance[$index]=stripslashes($_POST[$index]);
		}
		return $instance;
	}
}

add_action('widgets_init', create_function('', 'return register_widget("WidgetSocial");'));