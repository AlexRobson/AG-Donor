<div id="donations-form" class="">
	<form method='post' id="payment-form" class="wpcf7-form" action="<?php echo $form_action; ?>">
		<?php echo $hidden_fields; ?>
		<input type="hidden" value="" id="donation-exp" name="x_exp_date">

		<h4>Billing info</h4>
        <p>
            <img width="175" height="26" title="Credit Cards Logos" alt="Creadir Card Logos" src="<?php bloginfo('template_directory'); ?>/images/credit_card_logos_visa_mc_disc_amex2.gif" />
        </p>
        
		<p>
            <span class="wpcf7-form-control-wrap x_card_num">
                <input type="text" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required blur required creditcard" value="" placeholder="Credit Card Number" id="donation-cardnum" name="x_card_num">
            </span>
        </p>
        
		<p>
            <span class="wpcf7-form-control-wrap x_exp_date">
                <select class="wpcf7-form-control billing-date wpcf7-validates-as-required blur required" id="donation-exp-month" name="expdate_month">
                    <option value="">Exp. Month</option>
                    <option value="01">Jan.</option>
                    <option value="02">Feb.</option>
                    <option value="03">Mar.</option>
                    <option value="04">Apr.</option>
                    <option value="05">May.</option>
                    <option value="06">Jun.</option>
                    <option value="07">Jul.</option>
                    <option value="08">Aug.</option>
                    <option value="09">Sep.</option>
                    <option value="10">Oct.</option>
                    <option value="11">Nov.</option>
                    <option value="12">Dec.</option>
                </select>
                <select class="wpcf7-form-control billing-date wpcf7-validates-as-required blur required" id="donation-exp-year" name="expdate_year">
                    <option value="">Exp. Year</option>
                <?php
                    $i = date('Y');
                    $limit = $i + 10;
                    while ($i <= $limit): ?>
                    <option val="<?php echo $i; ?>"><?php echo $i++; ?></option>
                <?php endwhile; ?>
                </select>
			</span>
        </p>
        
		<p>
            <span class="wpcf7-form-control-wrap x_card_code">
                <input type="text" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required blur required digits" value="" placeholder="CCV" id="donation-ccv" name="x_card_code">
            </span>
        </p>

		<p><span class="wpcf7-form-control-wrap x_first_name">
			<input type="text" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required blur required text" value="<?php echo $first_name; ?>" placeholder="First Name" id="donation-firstname" name="x_first_name"></span></p>

		<p><span class="wpcf7-form-control-wrap x_last_name">
			<input type="text" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required blur required text" value="<?php echo $last_name; ?>" placeholder="Last Name" id="donation-lastname" name="x_last_name"></span></p>
        
        <p><span class="wpcf7-form-control-wrap x_zip">
			<input type="text" size="40" class="wpcf7-form-control wpcf7-text blur <?php echo ($tx_data['country']=='US'||$tx_data['country']=='CA')?' wpcf7-validates-as-required required postalcode':''; ?>" value="<?php echo $zip_code; ?>" placeholder="Zip Code" id="donation-zipcode" name="x_zip"></span></p>
        
        <p><span class="wpcf7-form-control-wrap x_state">
			<input type="text" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required blur required text" value="<?php echo $state; ?>" placeholder="State" id="donation-state" name="x_state"></span></p>
        
        <p><span class="wpcf7-form-control-wrap x_city">
			<input type="text" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required blur required text" value="<?php echo $city; ?>" placeholder="City" id="donation-city" name="x_city"></span></p>

		<p><span class="wpcf7-form-control-wrap x_address">
			<input type="text" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required blur required" value="<?php echo $address; ?>" placeholder="Address" id="donation-address" name="x_address"></span></p>

		<p><input type="submit" class="wpcf7-form-control  wpcf7-submit" value="SUBMIT"></p>
	</form>
</div>
<script type="text/javascript">
//<!--
    jQuery(document).ready(function(){
        jQuery.validator.addMethod("lettersonly", function(value, element) {
            return this.optional(element) || /^[a-z]+$/i.test(value);
        }, "Letters only please");
        
        jQuery.validator.addMethod("phonenumber", function(value, element) {
            return this.optional(element) || /^\([0-9]{3}\)\s?[0-9]{3}(-|\s)?[0-9]{4}$|^[0-9]{3}-?[0-9]{3}-?[0-9]{4}$/i.test(value);
        }, "Phone number please");
        
        jQuery.validator.addMethod("postalcode", function(postalcode, element) {
            return this.optional(element) || postalcode.match(/(^\d{5}(-\d{4})?$)|(^[ABCEGHJKLMNPRSTVXYabceghjklmnpstvxy]{1}\d{1}[A-Za-z]{1} ?\d{1}[A-Za-z]{1}\d{1})$/);
        }, "Please specify a valid postal/zip code");
        
        jQuery("#donations-form #payment-form").validate();
    });
//-->
</script>