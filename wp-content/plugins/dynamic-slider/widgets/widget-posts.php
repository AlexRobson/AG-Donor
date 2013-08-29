<?php

class RcptWidget extends WP_Widget {

	var $_order_options = array (
		'none' => 'No order',
		'rand' => 'Random order',
		'id' => 'Order by ID',
		'author' => 'Order by author',
		'title' => 'Order by title',
		'date' => 'Order by creation date',
		'modified' => 'Order by last modified date',
	);

	var $_order_directions = array (
		'ASC' => 'Ascending',
		'DESC' => 'Descending',
	);

	function RcptWidget () {
		$widget_ops = array('classname' => 'widget_rcpt', 'description' => __('Shows the most recent posts from a selected custom post type', 'rcpt'));
		parent::WP_Widget('rcpt', 'inQ Recent Posts', $widget_ops);
	}

	function form($instance) {
		$title = esc_attr($instance['title']);
		$post_type = esc_attr($instance['post_type']);
		$limit = esc_attr($instance['limit']);
		$show_thumbs = esc_attr($instance['show_thumbs']);
		$show_dates = esc_attr($instance['show_dates']);
		$class = esc_attr($instance['class']);
		$order_by = esc_attr($instance['order_by']);
		$order_dir = esc_attr($instance['order_dir']);

		// Set defaults
		// ...

		// Get post types
		$post_types = get_post_types(array('public'=>true), 'names');

		$html = '<p>';
		$html .= '<label for="' . $this->get_field_id('title') . '">' . __('Title:', 'rcpt') . '</label>';
		$html .= '<input type="text" name="' . $this->get_field_name('title') . '" id="' . $this->get_field_id('title') . '" class="widefat" value="' . $title . '"/>';
		$html .= '</p>';

		$html .= '<p>';
		$html .= '<label for="' . $this->get_field_id('post_type') . '">' . __('Post type:', 'rcpt') . '</label>';
		$html .= '<select name="' . $this->get_field_name('post_type') . '" id="' . $this->get_field_id('post_type') . '">';
		foreach ($post_types as $pt) {
			$html .= '<option value="' . $pt . '" ' . (($pt == $post_type) ? 'selected="selected"' : '') . '>' . $pt . '</option>';
		}
		$html .= '</select>';
		$html .= '</p>';

		$html .= '<p>';
		$html .= '<label for="' . $this->get_field_id('limit') . '">' . __('Limit:', 'rcpt') . '</label>';
		$html .= '<select name="' . $this->get_field_name('limit') . '" id="' . $this->get_field_id('limit') . '">';
		for ($i=1; $i<21; $i++) {
			$html .= '<option value="' . $i . '" ' . (($i == $limit) ? 'selected="selected"' : '') . '>' . $i . '</option>';
		}
		$html .= '</select>';
		$html .= '</p>';

		$html .= '<p>';
		$html .= '<label for="' . $this->get_field_id('show_thumbs') . '">' . __('Show featured thumbnails <small>(if available)</small>:', 'rcpt') . '</label> ';
		$html .= '<input type="checkbox" name="' . $this->get_field_name('show_thumbs') . '" id="' . $this->get_field_id('show_thumbs') . '" value="1" ' . ($show_thumbs ? 'checked="checked"' : '') . '/>';
		$html .= '</p>';
/*
		$html .= '<p>';
		$html .= '<label for="' . $this->get_field_id('show_dates') . '">' . __('Show post dates:', 'rcpt') . '</label> ';
		$html .= '<input type="checkbox" name="' . $this->get_field_name('show_dates') . '" id="' . $this->get_field_id('show_dates') . '" value="1" ' . ($show_dates ? 'checked="checked"' : '') . '/>';
		$html .= '</p>';

		$html .= '<p>';
		$html .= '<label for="' . $this->get_field_id('class') . '">' . __('Additional CSS class(es) <small>(optional)</small>:', 'rcpt') . '</label>';
		$html .= '<input type="text" name="' . $this->get_field_name('class') . '" id="' . $this->get_field_id('class') . '" class="widefat" value="' . $class . '"/>';
		$html .= '<div><small>' . __('One or more space separated valid CSS class names that will be applied to the generated list', 'rcpt') . '</small></div>';
		$html .= '</p>';
*/
		$html .= '<p>';
		$html .= '<label for="' . $this->get_field_id('order_by') . '">' . __('Order by:', 'rcpt') . '</label>';
		$html .= '<select name="' . $this->get_field_name('order_by') . '" id="' . $this->get_field_id('order_by') . '">';
		foreach ($this->_order_options as $key=>$label) {
			$html .= '<option value="' . $key . '" ' . (($key == $order_by) ? 'selected="selected"' : '') . '>' . __($label, 'rcpt') . '</option>';
		}
		$html .= '</select>';
		$html .= '</p>';

		$html .= '<p>';
		$html .= '<label for="' . $this->get_field_id('order_dir') . '">' . __('Order direction:', 'rcpt') . '</label>';
		$html .= '<select name="' . $this->get_field_name('order_dir') . '" id="' . $this->get_field_id('order_dir') . '">';
		foreach ($this->_order_directions as $key=>$label) {
			$html .= '<option value="' . $key . '" ' . (($key == $order_dir) ? 'selected="selected"' : '') . '>' . __($label, 'rcpt') . '</option>';
		}
		$html .= '</select>';
		$html .= '</p>';

		echo $html;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['post_type'] = strip_tags($new_instance['post_type']);
		$instance['limit'] = strip_tags($new_instance['limit']);
		$instance['show_thumbs'] = strip_tags($new_instance['show_thumbs']);
		$instance['show_dates'] = strip_tags($new_instance['show_dates']);
		$instance['class'] = strip_tags($new_instance['class']);
		$instance['order_by'] = strip_tags($new_instance['order_by']);
		$instance['order_dir'] = strip_tags($new_instance['order_dir']);

		return $instance;
	}

	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$post_type = $instance['post_type'];
		$limit = (int)$instance['limit'];
		$show_thumbs = (int)$instance['show_thumbs'];
		$show_dates = (int)$instance['show_dates'];
		$class = $instance['class'];
		$class = $class ? " {$class}" : '';

		$order_by = $instance['order_by'];
		$order_by = in_array($order_by, array_keys($this->_order_options)) ? $order_by : 'none';
		$order_dir = $instance['order_dir'];
		$order_dir = in_array($order_dir, array_keys($this->_order_directions)) ? $order_dir : 'ASC';

		$query = new WP_Query(array(
			'showposts' => $limit,
			'nopaging' => 0,
			'post_status' => 'publish',
			'post_type' => $post_type,
			'orderby' => $order_by,
			'order' => $order_dir,
			'caller_get_posts' => 1
		));

		if ($query->have_posts()) {
			echo $before_widget;
			if ($title) echo $before_title . $title . $after_title;
?>

            <ul>	
                <?php
                    while( $query->have_posts() ) : $query->the_post(); ?>
                <li>

					<?php
if ($show_thumbs) {
					if ( has_post_thumbnail()) :
					?><a href="<?php the_permalink(); ?>"><img src="<?php  echo inq_thumb(279,84,'tl') ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" /></a><?php
					endif;
}
					?>
                    <h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
                    <span><?php echo get_the_date() ?> | <?php the_author() ?></span>
					<?php $content = get_the_content();
					
					?>
                    <p><?php echo inq_excerpt(50) ?></p>
                    <a href="<?php the_permalink(); ?>" title="View more" class="view-more">View more</a>

                </li>
                <?php endwhile; ?>	
            </ul>	
<?php

			echo $after_widget;
		}
	}
}


// Init widget
add_action('widgets_init', create_function('', "register_widget('RcptWidget');"));


