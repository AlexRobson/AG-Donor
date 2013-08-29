<form method='post' action="<?php echo $form_action; ?>">
	<input type='hidden' name="x_login" value="<?php echo $api_login_id?>" />
	<input type='hidden' name="x_fp_hash" value="<?php echo $fingerprint?>" />
	<input type='text' name="x_amount" value="<?php echo $amount?>" />
	<input type='hidden' name="x_fp_timestamp" value="<?php echo $fp_timestamp?>" />
	<input type='hidden' name="x_fp_sequence" value="<?php echo $fp_sequence?>" />
	<input type='hidden' name="x_version" value="3.1" />
	<input type='hidden' name="x_show_form" value="payment_form" />
	<input type='hidden' name="x_test_request" value="false" />
	<input type='hidden' name="x_method" value="cc" />
	<input type='hidden' name="x_description" value="Donation via Authorize.Net" />
	<input type='hidden' name="x_cancel_url" value="<?php echo $cancel_url; ?>" />
	<input type='hidden' name="x_receipt_link_method" value="post" />
	<input type='hidden' name="x_receipt_link_url" value="<?php echo $cancel_url; ?>" />
	<input type='hidden' name="x_receipt_link_text" value="Go back to the website" />

	<!--input type='hidden' name="x_relay_response" value="true" />
	<input type='hidden' name="x_relay_url" value="<?php echo $cancel_url; ?>" />
	<input type='hidden' name="x_receipt_link_text" value="Go back to the website" /-->

	<input type='submit' value="Click here for the secure payment form">
</form>