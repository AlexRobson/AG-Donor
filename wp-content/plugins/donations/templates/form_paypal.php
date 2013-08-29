<div class="paypal-form">
	<form action="<?php echo $paypal_url; ?>/cgi-bin/webscr" method="post">
		<input type="hidden" name="cmd" value="_donations" />
		<input type="hidden" name="business" value="<?echo $merchant_id; ?>" />
		<input type="hidden" name="custom" value="custom parameter" />

		<!--input type="hidden" name="hosted_button_id" value="<?php //echo $paypal_button_id ?>" /-->
		<input type="hidden" name="bn" value="AidGrade_Donate_WPS_US" />

		<input type="hidden" name="item_name" value="Donation via Paypal" />
		<input type="hidden" name="on0" value="Reference" />
		<input type="hidden" name="os0" maxlength="60" id="inqp_reference" value="<?php echo $reference; ?>" />
		<input type="hidden" name="no_shipping" value="0" />
		<input type="hidden" name="no_note" value="1" />

		<!--input type="hidden" name="notify_url" value="<?php echo $cancel_url; ?>" /-->
		<input type="hidden" name="return" value="<?php echo $cancel_url; ?>" />
		<input type="hidden" name="rm" value="2" />
		<input type="hidden" name="cbt" value="Go back to the website" />
		<input type="hidden" name="cancel_return" value="<?php echo $cancel_url; ?>" />

		<input type="text" name="amount" value="10" />


		<input type="image" src="<?php echo $paypal_url; ?>/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!" />
		<img alt="" border="0" src="<?php echo $paypal_url; ?>/en_US/i/scr/pixel.gif" width="1" height="1" />
	</form>
</div>