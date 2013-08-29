<?php
/**
 * Plugin Name: DynamicSlider
 * Plugin URL: 	http://www.inqbation.com
 * Description:	DynamicSlider allow Wordpress designers and developers to integrate a administrated 
 *							functionalities like Images sliders.
 * Version: 		0.4
 * Author: 			inQbation Labs / Andres Gonzalez
 * Author URI: 	http://www.inqbation.com
 * License: 		A "Slug" license name e.g. GPL2
 **/

//include(dirname (__FILE__) .'/widgets/widget-html.php');
//include(dirname (__FILE__) .'/widgets/widget-image-link.php');
//include(dirname (__FILE__) .'/widgets/widget-image-link-text.php');
//include(dirname (__FILE__) .'/widgets/widget-buttons-list.php');
//include(dirname (__FILE__) .'/widgets/widget-social-media.php');
//include(dirname (__FILE__) .'/widgets/widget-posts.php');

//include(dirname (__FILE__) .'/widgets/widget-slider.php');

include(dirname (__FILE__) .'/includes/functions.php');
include(dirname (__FILE__) .'/includes/govcms-config.php');
if (!class_exists('Html'))
include(dirname (__FILE__) .'/includes/class.html.php');
include(dirname (__FILE__) .'/includes/class.config.php');

wp_enqueue_style('dynamic-slider-defaultdefault', '/wp-content/plugins/'.dirname(plugin_basename(__FILE__)).'/css/dynamic-slider-styles.css');

/*wp_enqueue_script('jquery');
wp_deregister_script('jquery-ui');
wp_register_script('jquery-ui', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js');
wp_enqueue_script('jquery-ui');*/
wp_enqueue_script('js_cycle', '/wp-content/plugins/'.dirname(plugin_basename(__FILE__)).'/includes/js/jquery.cycle.js', array('jquery'));

if(is_admin()) {
    wp_enqueue_script('jquery-ui-core');
    wp_enqueue_script('jquery-ui-sortable');
	wp_enqueue_script('js_validate', '/wp-content/plugins/'.dirname(plugin_basename(__FILE__)).'/includes/js/jquery.validate.min.js');
	wp_enqueue_script('js_validate_additional', '/wp-content/plugins/'.dirname(plugin_basename(__FILE__)).'/includes/js/jquery.validate.additional-methods.min.js');
}

// JavaScript for image load
wp_enqueue_script('media-upload');
wp_enqueue_script('thickbox');
wp_enqueue_style('thickbox');

if(is_admin()) {
	wp_enqueue_style('jquery-ui', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/base/jquery-ui.css');
}

$inq_config = json_decode(get_option('inq-config'));

if($inq_config->styles != 'custom'){
	wp_enqueue_style('slider-default', '/wp-content/plugins/'.dirname(plugin_basename(__FILE__)).'/css/slider-default.css');
} else {
	wp_enqueue_style('slider-default', '/wp-content/plugins/'.dirname(plugin_basename(__FILE__)).'/css/slider-custom.css');
}

global $config;
$config = new stdClass;
$config->path = dirname (__FILE__);

global $url_page;
$url_page = $_SERVER["REQUEST_URI"];
$url_page = explode('/wp-admin',$url_page);
$url_page = "http://".$_SERVER['HTTP_HOST'].$url_page[0];
	
class DynamicSlider {
	
	function gov_add_pages() {
		global $config;
		DynamicSlider::config();
		global $url_page;
		add_menu_page('DynamicSlider', 'DynamicSlider', 1, 'slider-index', 'slider_index', $url_page.'/wp-content/plugins/'.dirname(plugin_basename(__FILE__)).'/img/inq-icon.png', 28, 'DynamicSlider');
		add_submenu_page('slider-index', 'Settings | DynamicSlider', 'Settings', 1, 'slider-config', 'slider_config');
		add_submenu_page('slider-index', 'Installation | DynamicSlider', 'Installation', 1, 'slider-install', 'slider_install');
		add_submenu_page('slider-index', 'About | DynamicSlider', 'About', 1, 'inq-about', 'inq_about');
	}
	
	function config() {
		global $config;
		$config = new stdClass;
		$config->path = dirname (__FILE__);
	}
}

add_action('admin_menu', array('DynamicSlider','gov_add_pages'));
