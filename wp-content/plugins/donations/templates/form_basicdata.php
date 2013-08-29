<div id="donations-form" class="">
	<form class="wpcf7-form" method="post" action="<?php echo $_SERVER['REQUEST_URL']; ?>" onsubmit="ie_recover_placeholder(); return true;">
		<div style="display: none;">
			<?php wp_nonce_field('start_donation'); ?>
			<input type="hidden" name="form_name" value="donations" />
		</div>

		<h4>Mailing Address!</h4>
		<p id="donation-amount-container"><span class="wpcf7-form-control-wrap donation-amount">
			<input type="text" size="40" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email blur required" value="" placeholder="Amount" id="donation-amount" name="donation_amount"></span>
        </p>
		<p><span class="wpcf7-form-control-wrap email-address">
				<input type="text" size="40" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email blur required email" value="<?php echo $user_email; ?>" placeholder="Email Address" name="email_address"></span></p>
		<p><span class="wpcf7-form-control-wrap first-name">
				<input type="text" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required required text" value="<?php echo $user_first_name; ?>" placeholder="First Name" name="first_name"></span></p>
		<p> <span class="wpcf7-form-control-wrap last-name">
				<input type="text" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required required text" value="<?php echo $user_last_name; ?>" placeholder="Last Name" name="last_name"></span> </p>
		<p> <span class="wpcf7-form-control-wrap country">
				<!--input type="text" size="40" class="wpcf7-form-control wpcf7-text" value="" placeholder="Country" name="country"></span-->
				<select class="wpcf7-form-control wpcf7-select required" placeholder="Country" id="donations-country" name="country">
				<?php
					$selected_country = ($mailing_country?$mailing_country:'US');
					foreach($countries as $key=>$val):
						$selected = '';
						if ($key == $selected_country)
							$selected = ' selected="selected"';
					?>
					<option value="<?php echo $key; ?>"<?php echo $selected; ?>><?php echo $val; ?></option>
				<?php endforeach; ?>
				</select>
            </span>
		</p>
		<p> <span class="wpcf7-form-control-wrap zipcode">
				<input id="donations-zip-code" type="text" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required required postalcode" value="<?php echo $mailing_zip_code; ?>" placeholder="ZIP Code" name="zip_code"></span> </p>
		<p> <span class="wpcf7-form-control-wrap state">
				<input id="donations-state" type="text" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required required text" value="<?php echo $mailing_state; ?>" placeholder="State" name="state"></span> </p>
		<p> <span class="wpcf7-form-control-wrap city">
				<input id="donations-city" type="text" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required required text" value="<?php echo $mailing_city; ?>" placeholder="City" name="city"></span> </p>
		<p> <span class="wpcf7-form-control-wrap street1 wpcf7-validates-as-required">
				<input type="text" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required required" value="<?php echo $mailing_address; ?>" placeholder="Address" name="address"></span> </p>
		<p> <span class="wpcf7-form-control-wrap phone">
				<input type="text" size="40" class="wpcf7-form-control wpcf7-text phonenumber" value="<?php echo $mailing_phone_number; ?>" placeholder="Phone number" name="phone_number"></span> </p>
		<p class="checkboxes-area">Is your billing address the same?<br><br>
			<span class="checked">Yes</span><span>No</span>
		</p>
		<p class="billing-adress"> <span class="wpcf7-form-control-wrap billing-adress">
				<input id="billing-address" type="text" size="10" class="wpcf7-form-control wpcf7-text" value="Yes" placeholder="billing-address" name="billing_address"></span> </p>
		<p class="support-us"> <span class="wpcf7-form-control-wrap support-us">
				<input id="support-us" type="text" size="40" class="wpcf7-form-control wpcf7-text" value="" placeholder="support-us" name="support_us"></span> </p>
		<p class="selected-programs"> <span class="wpcf7-form-control-wrap selected-programs">
				<input id="selected-programs" type="text" size="40" class="wpcf7-form-control wpcf7-text" value="" placeholder="selected-programs" name="selected_programs"></span> </p>
		<p><input type="submit" class="wpcf7-form-control  wpcf7-submit" value="NEXT">
			</p>
        <p class="terms-and-conditions">
            You will be redirected to a secure site to complete this transaction. By submitting this form, you agree to our <a target="_blank" href="http://localhost/open/wordpress/aidgrade.org/html/terms-and-conditions" title="Terms and conditions">terms</a>. We will protect your privacy.
        </p>
        <p class="required"><strong>*</strong> Indicates required fields.</p>
        
		<div class="wpcf7-response-output wpcf7-display-none"></div>
	</form>
</div>
<script type="text/javascript">
//<!--
    jQuery(document).ready(function(){
        check_country_value();
        jQuery("#donations-country").change(function(e){
            e.preventDefault();
            check_country_value();
            if(jQuery.browser.msie)
                ie_recover_placeholder()
        });
        
        jQuery.validator.addMethod("lettersonly", function(value, element) {
            return this.optional(element) || /^[a-z]+$/i.test(value);
        }, "Letters only please");
        
        jQuery.validator.addMethod("phonenumber", function(value, element) {
            return this.optional(element) || /^\([0-9]{3}\)\s?[0-9]{3}(-|\s)?[0-9]{4}$|^[0-9]{3}-?[0-9]{3}-?[0-9]{4}$/i.test(value);
        }, "Phone number please");
        
        jQuery.validator.addMethod("postalcode", function(postalcode, element) {
            return this.optional(element) || postalcode.match(/(^\d{5}(-\d{4})?$)|(^[ABCEGHJKLMNPRSTVXYabceghjklmnpstvxy]{1}\d{1}[A-Za-z]{1} ?\d{1}[A-Za-z]{1}\d{1})$/);
        }, "Please specify a valid postal/zip code");
        
        jQuery("#donations-form .wpcf7-form").validate();
    });
    
    function check_country_value(){
        if(jQuery("#donations-country").val() == 'US' || jQuery("#donations-country").val() == 'CA' ){
            jQuery("#donations-zip-code").addClass('wpcf7-validates-as-required required postalcode');
        }
        else{
            jQuery("#donations-zip-code").removeClass('wpcf7-validates-as-required required postalcode');
        }
    }
    
    function ie_recover_placeholder(){
        jQuery("#donations-form form input:not([type=hidden])").each(function(){
            if(jQuery(this).attr('placeholder')!=undefined){
                jQuery(this).focus();
            }
        });
        jQuery("#donations-country").focus();
    }
    
//-->
</script>