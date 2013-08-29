<?php
/*
	Plugin Name: inQbation Donations
	Plugin URI: http://www.inqbation.com/
	Description: Donations plugin handles donations via Authorize.Net with DPM (Direct Post Method)
	Version: 1.0
	Author: lufeceba
	Author URI: http://www.inqbation.com
	License: GPL
*/

/**
 *  Copyright 2012  inQbation  (email : info@inqbation.com)
	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 2 of the License, or
	(at your option) any later version.
	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.
	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

require_once 'anet_php_sdk/AuthorizeNet.php'; // Include the SDK you downloaded in Step 2
//			'authnet_api_login_id' => '2C6ET9whn', // inQbation test account
//			'authnet_transaction_key' => '768DFDc78a6eB5bz', // inQbation test account

class inq_donations {

	var $plugin_url;
	var $plugin_path;
	var $settings;
	var $settings_name = "donations_settings";
	var $response_codes = array(
		'1' => 'Approved',
		'2' => 'Declined',
		'3' => 'Error',
		'4' => 'Held',
	);

	/**
	 * @var boolean $test_mode
	 * This variable MUST be set to false when going to production, to create right
	 * redirections to https served pages, and to avoid the CC info form from being
	 * shown using HTTP
	 */
	var $test_mode = false;

	function _get_settings() {
		$my_wp_plugin_url = (empty($_SERVER['HTTPS'])) ? WP_PLUGIN_URL : str_replace("http://", "https://", WP_PLUGIN_URL);
		$this->plugin_url = $my_wp_plugin_url.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__));
		$this->plugin_path = WP_PLUGIN_DIR.'/'.$this->plugin_dirname.'/';
		$this->settings = get_option($this->settings_name);
	}

	// testing Authorize.Net
	function __construct() {

		$this->_get_settings();

		$this->include_js();
		//$this->include_css();

		//add_action('wp', array(&$this, 'check_access'));
		add_action('parse_request', array(&$this, 'parse_request'));
		//add_shortcode('donations_show_form', array(&$this, 'print_form'));
	}

	/**
	 * Second step of the integration with Payment Gateways.
	 * With Authorize DPM, this form must be served using HTTPS for security
	 * @param type $gateway
	 * @param type $amount
	 */
	function print_cc_form($tx_hash="", $prefill=0, $gateway='authnet') {

		if ($gateway != 'authnet') { // If Paypal
			// paypal form
			$paypal_url = $this->settings['paypal_url'];
			$merchant_id = $this->settings['paypal_merchant_id'];

			include('templates/form_paypal.php');
		} else { // Authorize.net, for this project we are using DPM
			// check protocol
			if ($this->test_mode == false) {
				if (!$_SERVER['HTTPS']) {
					echo "For security reasons, this form can not be served using the HTTP insecure protocol";
					return false;
				}
			}

			// we require the tx_id to get the transaction data and to create
			// the fingerprint
			if (!$tx_hash) {
				echo "Invalid request!";
				return false;
			}

			$tx_data = $this->get_transaction(array('field'=>'tx_hash', 'field_value'=>$tx_hash));
			if (!$tx_data) {
				echo "Invalid Transaction";
				return false;
			}

			$form_action = $this->settings['authnet_url'];
			//$cancel_url = get_bloginfo('url') .'/'. $this->settings['authnet_cancel_page'];
			$fp_timestamp = time();
			$fp_sequence = "123" . time(); // Enter an invoice or other unique number.

			$amount = $tx_data['amount'];
			$api_login_id = $this->settings['authnet_api_login_id'];
			//$transaction_key = $this->settings['authnet_transaction_key'];
			$relay_url = get_bloginfo('url') .'/'. $this->settings['authnet_ccinfo_page'];
			//$relay_url = str_replace('https://', 'http://', get_bloginfo('url')) .'/'. $this->settings['authnet_ccinfo_page'];

			$fingerprint = AuthorizeNetSIM_Form::getFingerprint($api_login_id, $this->settings['authnet_transaction_key'], $amount, $fp_sequence, $fp_timestamp);

			//$md5_setting = $this->settings['md5_setting'];
			$sim = new AuthorizeNetSIM_Form(
				array(
					'x_email'        => $tx_data['email_address'],
					'x_amount'        => $amount,
					'x_fp_sequence'   => $fp_sequence,
					'x_fp_hash'       => $fingerprint,
					'x_fp_timestamp'  => $fp_timestamp,
					'x_relay_response'=> "TRUE",
					'x_relay_url'     => $relay_url,
					'x_login'         => $api_login_id,
					//'x_trans_id' => $tx_data['tx_id'],
					'x_country' => $tx_data['country'],
					'x_po_num' => $tx_data['tx_id'],
					'x_description' => 'Donation to support '.$tx_data['program_supported'], // to change according to the support
				)
			);
			$hidden_fields = $sim->getHiddenFieldString();
			//$post_url = ($this->test_mode ? self::SANDBOX_URL : self::LIVE_URL);

			// when prefill enabled
			$first_name = $tx_data['first_name'];
			$last_name = $tx_data['last_name'];
			$address = ($prefill?$tx_data['address_line1']:"");
			$city = ($prefill?$tx_data['city']:"");
			$state = ($prefill?$tx_data['state']:"");
			$zip_code = ($prefill?$tx_data['zip_code']:"");

			include('templates/form_authorize_ccinfo.php');
			// since we are using DPM as the integration
			//echo AuthorizeNetDPM::getCreditCardForm($amount, $fp_sequence, $relay_url, $api_login_id, $transaction_key, true, false);
		}

	}

	/**
	 * Shows the basic form, that users fill out to enter basic information, i.e.
	 * mailing information
	 * @param int $userid - if the user is logged in some values will be prefilled
	 * automatically
	 */
	function print_basicdata_form() {

		$user_first_name = '';
		$user_last_name = '';
		$user_email = '';
		$mailing_country = '';
		$mailing_zip_code = '';
		$mailing_state = '';
		$mailing_city = '';
		$mailing_address = '';
		$mailing_phone_number = '';

		if (is_user_logged_in()) {

			$user = get_userdata(get_current_user_id());
			$user_first_name = $user->first_name;
			$user_last_name = $user->last_name;
			$user_email = $user->user_email;

			$params = array(
				'field' =>  'user_id',
				'field_value' => $user->ID,
				'limit' => 1,
				'sort_by' => 'donation_started DESC',
				'donation_status' => 'Approved',
			);
			$user_mailing_info = $this->get_user_donations($params);

			if ($user_mailing_info) {
				$mailing_country = $user_mailing_info[0]['country'];
				$mailing_zip_code = $user_mailing_info[0]['zip_code'];
				$mailing_state = $user_mailing_info[0]['state'];
				$mailing_city = $user_mailing_info[0]['city'];
				$mailing_address = $user_mailing_info[0]['address_line1'];
				$mailing_phone_number = $user_mailing_info[0]['phone_number'];
			}
		}

		$countries = $this->get_countries(array('type'=>'select'));
		include('templates/form_basicdata.php');
	}

	function parse_request() {
		global $wpdb;

//		$wpdb->show_errors(); // for debugging

		// Received after basic data form and Authnet response
		if (!empty($_POST)) {

			// Receiving basic data form
			if (isset($_POST['form_name']) && $_POST['form_name'] == 'donations') {

				if ( !wp_verify_nonce($_POST['_wpnonce'], 'start_donation')) {
					//wp_redirect(get_bloginfo('url') .'/'. $this->settings['authnet_donate_page']);
					die('invalid request!');
				}

				// check if supporting us or programs
				// based on support_us and selected_programs keep a XOR relationship
				if (!empty($_POST['support_us'])) {
					$supported_str = " AidGrade: {$_POST['support_us']}";
				} else {
					$supported_str = " Program: ".get_the_title($_POST['selected_programs']);
				}

				$user = get_current_user_id();
				$tx_id = 'D'.date('ymdHis').'U'.$user.'R'.rand(0,5);
				$fields = array(
					'user_id' => $user,
					'amount' => $_POST['donation_amount'],
					'first_name' => $_POST['first_name'],
					'last_name' => $_POST['last_name'],
					'email_address' => $_POST['email_address'],
					'country' => $_POST['country'],
					'state' => $_POST['state'],
					'city' => $_POST['city'],
					'address_line1' => $_POST['address'],
					'zip_code' => $_POST['zip_code'],
					'phone_number' => $_POST['phone_number'],
					'donation_started' => date('Y-m-d H:i:s'),
					'program_supported' => $supported_str,
					'tx_id' => $tx_id,
					'tx_hash' => md5('123'.$tx_id),
					// tx_id value is changed when receiving response from Auth.net
				);
				$formats = array('%d', '%d', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s');
				$wpdb->insert($wpdb->prefix.'donations', $fields, $formats);

				if ($wpdb->insert_id) { // success
					// redirect to the donate payment page
					$base_url = get_bloginfo('url');
					if ($this->test_mode == false) {
						$base_url = str_replace('http://', 'https://', $base_url);
					}
					$prefilled_data = ($_POST['billing_address'] == 'Yes'?1:0);

					wp_redirect($base_url .'/'. $this->settings['authnet_ccinfo_page'] .'?tx='. $fields['tx_hash'] .'&pf='. $prefilled_data);
					exit;

				} else { // failure
					exit('save failed: '.$wpdb->print_error());
				}
			}

			// Response from Authorize.net
			$response = new AuthorizeNetSIM($this->settings['authnet_api_login_id'], $this->settings['authnet_md5_setting']);
			if ($response->isAuthorizeNet()) {
				if ($response->approved) { // Authorize.net approved it
					$fields = array(
						'tx_id' => $response->transaction_id,
						'tx_hash' => '', // local security measure to protect transactions data
						'donation_status' => 'Approved',
						'auth_code' => $response->authorization_code,
						'donation_finished' => date('Y-m-d H:i:s'),
					);
					$fields_format = array('%s', '%s', '%s', '%s', '%s');
					$redirect_url = get_bloginfo('url') .'/'. $this->settings['authnet_sucess_page'] . '?response_code=1&transaction_id=' . $response->transaction_id;
				} else { // error processing the transaction
					$fields = array(
						'tx_id' => $response->trans_id,
						'tx_hash' => '', // local security measure to protect transactions data
						'donation_status' => $this->response_codes[$response->response_code],
						'donation_finished' => date('Y-m-d H:i:s'),
						'response_code' => $response->response_code,
						'response_reason_text' => $response->response_reason_text,
					);
					$fields_format = array('%s', '%s', '%s', '%s', '%s', '%s');
					// Redirect to error page.
					$redirect_url = get_bloginfo('url') .'/'. $this->settings['authnet_failure_page'] . '?response_code='.$response->response_code . '&response_reason_text=' . urlencode($response->response_reason_text);
				}

				// update record and redirecting
				$result = $wpdb->update( $wpdb->prefix .'donations', $fields,
						array( 'tx_id' => $response->po_num ), // while
						$fields_format,	array('%s')	);

				// Send the Javascript back to AuthorizeNet, which will redirect user back to your site.
				echo AuthorizeNetDPM::getRelayResponseSnippet($redirect_url);
				die();
			} /*else { // temporarily
				echo "Error -- not AuthorizeNet. Check your MD5 Setting.";
				echo $response->generateHash();
				echo '<pre>'. print_r($response, true) .'</pre>';
			}*/
		}  // end if not empyt $_POST

	}


	/**
	* Inserts the JS script to handle some events
	**/
	function include_js() {
		wp_enqueue_script('donations_js', $this->plugin_url.'js/donations.js', array('jquery'));
		// for AJAX calls
		wp_localize_script('donations_js', 'DonAjax', array('ajaxurl' => admin_url( 'admin-ajax.php' )));
	}

	function include_css() {
		wp_enqueue_style('donations_css', $this->plugin_url.'css/donations_style.css');
	}


	/**
	 * Gets the countries in the DB
	 *
	 * @global type $wp - object to perform the queries
	 * @param array $params
	 * @return mixed - false when failure, array when success
	 */
	function get_countries($params=array()) {
		global $wpdb;

		$sql = "SELECT * FROM {$wpdb->prefix}donations_countries ORDER BY name;";
		$result = $wpdb->get_results($sql, ARRAY_A);

		if (isset($params['type']) && $params['type'] == 'select') {
			$tmp_arr = array();
			foreach ($result as $item) {
				$tmp_arr[$item['iso_2']] = $item['name'];
			}
			return($tmp_arr);
		}
		return($result);
	}

	/**
	 * Gets the location state/province and city based usually on the zip/postal
	 * code and the country code
	 * @global obj $wpdb
	 * @param array $params
	 * @return mixed  - boolean if fails, array if success
	 */
	function get_location($params=array()) {
		global $wpdb;

		$sql_where = " WHERE {$params['field']} LIKE '{$params['field_value']}'";
		if ($params['country'])
			$sql_where .= " AND country_code = '{$params['country']}'";

		$sql = "SELECT * FROM {$wpdb->prefix}donations_location_codes". $sql_where;

		$result = $wpdb->get_row($sql, ARRAY_A);

		return $result;
		//return $sql;
	}

	/**
	 * Retrieves a transaction data using an arbitraty field
	 * @global obj $wpdb
	 * @param array $params
	 * @return mixed - boolean false if fails, array if success
	 */
	function get_transaction($params=array()) {
		global $wpdb;

		$sql_where = " WHERE {$params['field']} = '{$params['field_value']}'";
		$sql = "SELECT * FROM {$wpdb->prefix}donations". $sql_where;

		$result = $wpdb->get_row($sql, ARRAY_A);

		return $result;
		//return $sql;
	}

	function get_user_donations($params) {
		global $wpdb;

		$sql_where = " WHERE {$params['field']} = '{$params['field_value']}'";
		$sql_limit = $sql_order = '';
		if (isset($params['donation_status']))
			$sql_where .= " AND donation_status = '{$params['donation_status']}'";

		if (isset($params['limit']))
			$sql_limit = " LIMIT {$params['limit']}";

		if (isset($params['sort_by']))
			$sql_order = " ORDER BY {$params['sort_by']}";

		$sql = "SELECT * FROM {$wpdb->prefix}donations". $sql_where . $sql_order . $sql_limit;

		$result = $wpdb->get_results($sql, ARRAY_A);

		return $result;
		//return $sql;
	}

}


function donations_init() {
	$result = new inq_donations();
	return $result;
}

if (is_admin()) {
	include_once('admin/admin.php');
	$donations_admin &= new inq_donations_admin();
}

/**
 * Receives the AJAX call to get the location and returns the state and city
 * applies only for US zip codes and CA postal codes
 * @return void - prints JSON format string
 */
function donations_get_location() {
	$donation_obj = new inq_donations();

	$params = array(
		'field' => 'code',
		'field_value' => $_POST['zip_code'],
		'country' => $_POST['country'],
	);

	$location = $donation_obj->get_location($params);
	if ($location) {
		$result = array('state'=>$location['state_abbreviation'], 'city'=>$location['city']);
	} else {
		$result = array('result' => false);
	}
	header( "Content-Type: application/json" );
	echo json_encode($result);
	exit;
}

/** registering general action **/
add_action('init', 'donations_init');

/** Actions for managing AJAX requests **/
add_action('wp_ajax_donations_get_location', 'donations_get_location');
add_action('wp_ajax_nopriv_donations_get_location', 'donations_get_location');

?>