<?php

class inq_donations_admin extends inq_donations {

	var $default_settings;
	var $settings_format = array();
	var $admin_pages = array(
		'donations' => 'sbt-settings',
		//'plugin-settings' => 'sbt-settings',
		);

	function __construct() {
		$root_page = 'donations/';
		$this->_get_settings();

		$this->default_settings = array(
			'authnet_cancel_page' => 'donate',
			'authnet_sucess_page' => 'donate/result',
			'authnet_failure_page' => 'donate/result',
			'authnet_ccinfo_page' => 'donate/cc-info-validation',
			'authnet_api_login_id' => '',
			'authnet_transaction_key' => '',
			'authnet_url' => 'https://test.authorize.net/gateway/transact.dll', // sandbox
			'authnet_md5_setting' => '1231351203611',

			/*'paypal_merchant_id' => '', // inQbation test seller account
			'paypal_url' => 'https://www.sandbox.paypal.com',
			'paypal_cancel_page' => 'donate',
			'paypal_success_page' => 'donate',*/
		);

		$this->settings_format = array(
			'authnet_cancel_page' => array('label'=>'Cancel page for Authorize.Net donations', 'type'=>'text', 'width'=>60, 'help'=>'When using SIM, the user can cancel the process, this is the page the user is returned', 'path'=>1),
			'authnet_sucess_page' => array('label'=>'Success page for Authorize.Net donations', 'type'=>'text', 'width'=>60, 'help'=>'Thank you page after a donation', 'path'=>1),
			'authnet_failure_page' => array('label'=>'Failure page for Authorize.Net donations', 'type'=>'text', 'width'=>60, 'help'=>'Final page the user is redirected after a donation fails', 'path'=>1),
			'authnet_ccinfo_page' => array('label'=>'CC info form page for Authorize.Net donations', 'type'=>'text', 'width'=>60, 'help'=>'', 'path'=>1),
			'authnet_api_login_id' => array('label'=>'Authorize.Net API Login ID', 'type'=>'text', 'width'=>60, 'help'=>''),
			'authnet_transaction_key' => array('label'=>'Authorize.Net API Transaction key', 'type'=>'text', 'width'=>60, 'help'=>''),
			'authnet_url' => array('label'=>'Authorize.Net API URL', 'type'=>'text', 'width'=>60, 'help'=>'By default it points to the sandbox, you will have to change it to https://authorize.net/gateway/transact.dll when going live'),
			'authnet_md5_setting' => array('label'=>'Authorize.Net MD5 Setting', 'type'=>'text', 'width'=>40, 'help'=>'Seed to generate sevearl security values, it can be changed periodically to increase security, however it MUST be changed on the Authorize.net account too'),

			/*'paypal_merchant_id' => array('label'=>'Paypal Merchant ID', 'type'=>'text', 'width'=>60, 'help'=>'This is sent with the donations form data'),
			'paypal_url' => array('label'=>'Paypal Gateway URL', 'type'=>'text', 'width'=>60, 'help'=>'By default it points to the sandbox, you will have to change it to https://www.paypal.com when going live'),
			'paypal_cancel_page' => array('label'=>'Cancel page for Paypal donations', 'type'=>'text', 'width'=>60, 'help'=>'', 'path'=>1),
			'paypal_success_page' => array('label'=>'Success page for Paypal donations', 'type'=>'text', 'width'=>60, 'help'=>'', 'path'=>1),*/
		);
		$this->settings = array_unique($this->settings);

		$this->settings = ($this->settings)?array_merge($this->default_settings, $this->settings):$this->default_settings;

		//register_activation_hook(__FILE__, array($this, 'activate'));
		add_action('admin_menu', array(&$this, 'admin_menu'));
		add_action('admin_init', array(&$this, 'parse_request')); // to handle some submits... since they need to redirect

	}

	function admin_menu() {
		add_options_page('Donations Options','Donations options','manage_options','donations_options',array($this, 'settings_page'));
	}


	function settings_page() {
		global $wpdb;

		// process some request that applies only to this page
		if (!empty($_GET['do'])) {
			extract($_GET);
		}

		if (isset($_POST['save_options']) && isset($_POST['action']) && $_POST['action'] == 'save') {
			foreach($this->settings as $key=>$item) {
				$this->settings[$key] = $_POST[$this->settings_name][$key];
			}
			if (update_option($this->settings_name, $this->settings)) {
				$message = 'Options were saved successfully';
			} else {
				$message = 'Options were NOT save, please try again';
			}

		}

		include_once('templates/settings_page.php');

	}

		function parse_request() {
		$do = "";
		// process some request that applies only to this page
		if (!empty($_GET['do'])) {
			extract($_GET);
		}

		switch($do) {

			case 'delete_listing':
				$this->delete_business($_GET['bid']);
				break;

			default:
				if (!empty($_POST) && ($_POST['from'] == 'create_listing')) {
					$sbt_db = new DirectoryDB();
					//echo "<pre>"; print_r($_POST); echo "</pre>"; exit;
					$save_result = $sbt_db->add_business($_POST, 'backend');
					if ($save_result) {
						wp_redirect(admin_url('admin.php?page='.$this->admin_pages['directory'].'&add_result=success'));
						//$message = array("updated", "Business listing updated successfully!");
					}
				}
				break;

		}


	}

	/**
	 * Support function to trim the blog path from a path
	 **/
	function filter_path($full_path) {
		$base_path = get_bloginfo('url').'/';
		if ( strpos($full_path, $base_path) !== false ) {
			$output = str_replace($base_path, '', $full_path);
			return $output;
		}
		return $full_path;
	}




} // End Class


?>