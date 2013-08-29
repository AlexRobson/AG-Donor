jQuery(function() {

	// code extracted from the script.js file specific for the donations pages
	// controls support us widget selection
	jQuery('#support-us-options .check p:first').addClass('checked');
	jQuery('#support-us').val('General');

	jQuery('#support-us-options .check p').click(function() {
		/*jQuery('#support-us-options .check p').each(function(){
			jQuery(this).removeClass('checked')
		});*/
		jQuery('#support-us-options .check p').removeClass('checked');
		jQuery(this).addClass('checked');

		var text = jQuery(this).text();
		jQuery('#support-us').val(text);

		jQuery('.program a.select-program').removeClass('active');
		jQuery('#selected-programs').val('');
	});

	// controls amount to donate selection
	jQuery('.price').click(function() {

		jQuery('.price').removeClass('checked');
		jQuery(this).addClass('checked');
		jQuery('div.form-area').show();
		jQuery('div.form-area').insertAfter('div.prices .checked span.don-active');

		var donation_val = '';
		if (jQuery(this).find('a.donate-value').text() != 'OTHER') {
			donation_val = jQuery(this).find('a.donate-value').text().replace(',', '').substr(1); // format $x,xxx
			jQuery('#donation-amount-container').hide();
			jQuery('#donation-amount').attr('value', donation_val);
		} else {
			jQuery('#donation-amount').attr('value', donation_val);
			jQuery('#donation-amount-container').show();
		}
	});

	jQuery('.price').click(function () {
		var textprice = jQuery(this).find('a').text();
			jQuery('p.selected-sum input').val('');
		jQuery('p.selected-sum input').val(textprice);
	});

	// controls optional selection of billing address same as mailing address
	jQuery('p.billing-adress input').val('Yes');
	jQuery('.checkboxes-area').on('click', 'span', function () {
		var text = jQuery(this).text();
		jQuery('p.billing-adress input').val(text);
	});

	// controls program selection
	jQuery('.program a.select-program').click(function() {
		/*jQuery('.program a.select-program').each(function(){
			jQuery(this).removeClass('active')
		});*/
		jQuery('#support-us-options .check p').removeClass('checked');
		jQuery('#support-us').val('');

		jQuery('.program a.select-program').removeClass('active');
		jQuery(this).addClass('active');
	});

	// controls country selection
	jQuery('#donations-country').change(function() {
		var country = jQuery(this).val();
		switch(country) {
			case 'CA':
				jQuery('#donations-zip-code').attr('placeholder', 'Postal Code');
				jQuery('#donations-zip-code').bind('change', donations_get_location);
				break;
			case 'US':
				jQuery('#donations-zip-code').attr('placeholder', 'ZIP Code');
				jQuery('#donations-zip-code').bind('change', donations_get_location);
				break;
			default:
				jQuery('#donations-zip-code').attr('placeholder', 'ZIP Code');
				jQuery('#donations-zip-code').unbind('change');
		}
		// cleans up state and city fields
		jQuery('#donations-zip-code').val('');
		jQuery('#donations-state').val('');
		jQuery('#donations-city').val('');
	});

	// binds donations_get_location to the zip-code field, since US is selected by default
	jQuery('#donations-zip-code').bind('change', donations_get_location);

	// binds donations_set_expdate to the new select fields
	jQuery('#donations-form span.x_exp_date').on('change', 'select', donations_set_expdate);
});

function select_program(program_id) {
	jQuery('#selected-programs').val(program_id);
}

function donations_set_expdate() {
	jQuery('#donation-exp').val(jQuery('#donation-exp-month').val()+'/'+jQuery('#donation-exp-year').val());
}

function donations_get_location() {
	var country_code = jQuery('#donations-country').val();
	var zipcode_str = jQuery('#donations-zip-code').val();

	if (country_code == 'CA') { // base search on the first 3 characters in the field
		zipcode_str = zipcode_str.substr(0,3);
	}

	jQuery.post( DonAjax.ajaxurl, {
		action : 'donations_get_location',
		country : country_code,
		zip_code: zipcode_str
	},
	function( response ) {
		if (response) {
			jQuery('#donations-state').val(response.state);
			jQuery('#donations-city').val(response.city);
		}
	}, 'json');
}