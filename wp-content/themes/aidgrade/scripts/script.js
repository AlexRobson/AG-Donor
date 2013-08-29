jQuery(document).ready(function() {
	/* Remove action from items with children in the main menu */
	jQuery(".no-action").click(function(){
		return false;
	});
	
	/* Adjustments for the login form */
	if( jQuery('#loginform').length > 0 ){
		//source: http://line25.com/tutorials/create-a-custom-wordpress-login-without-plugins
		jQuery('#loginform input[type="text"]').attr('placeholder', 'Username');
		jQuery('#loginform input[type="password"]').attr('placeholder', 'Password');

		jQuery('#loginform label[for="user_login"]').contents().filter(function() {
			return this.nodeType === 3;
		}).remove();
		jQuery('#loginform label[for="user_pass"]').contents().filter(function() {
			return this.nodeType === 3;
		}).remove();
		
		if( jQuery("#header .sidebarlogin_otherlinks").length > 0 ){
			$link =  jQuery("#header .sidebarlogin_otherlinks a");
			jQuery("#loginform").append('<a class="link-to-forgot-pass" rel="nofollow" href="'+$link.attr('href').replace('register','lostpassword')+'">Forgot your password?</a>');
			$link.remove();
		}
	}
	/* ** */
	
	/* Adjustments for the registration form */
	if( jQuery("#registerform").length > 0 ){
		var $counter = 1;
		var $base_url = jQuery("#header .logo a").attr('href');
		jQuery("#registerform").prepend("<h3><strong>Create an account</strong></h3>");
		jQuery("#registerform").append('<p class="terms-and-conditions">By clicking the sign up button above, you agree to our <a href="'+$base_url+'terms-and-conditions">terms</a>. We will protect your privacy.</p><p class="required" style="float: left; width: 100%; margin-top: 10px;"><strong>*</strong> Indicates required fields.</p>');
		jQuery('#registerform input[type="text"], #registerform input[type="password"]').each(function(){
			if( jQuery(this).prev().text().split(' ')[0] == 'First' || jQuery(this).prev().text().split(' ')[0] == 'Last' )
				jQuery(this).attr('placeholder', jQuery(this).prev().text().replace(':','')).parent();
			else
				jQuery(this).attr('placeholder', jQuery(this).prev().text().replace(':','')).addClass('wpcf7-validates-as-required');
			jQuery(this).attr('tabindex', $counter);
			jQuery(this).prev().text(' ');
			$counter++;
		});
		jQuery("#registerform #wp-submit").attr('value', 'Sign Up');
		jQuery("a.sign-up").addClass('active');
	}
	/* ** */
	
	if( jQuery("#header .sign-in-popup").length > 0 ){
		jQuery("#header .sign-in-popup a").each(function(){
			//alert();
			switch(jQuery(this).text()){
				case 'Dashboard':
					break;
				case 'Logout':
					jQuery(this).text('Sign Out');
					break;
				case 'Profile':
					jQuery(this).parent().prev().find('a').attr('href', jQuery(this).attr('href')).text('My Information');
					jQuery(this).attr('href', jQuery('#header .logo a').attr('href')+'my-donations').text('My Donations');
					break;
			}
		});
	}
	
	if( jQuery("#theme-my-login").length > 0 ){
		if( jQuery("#theme-my-login #loginform").length > 0 || jQuery("#theme-my-login #your-profile").length > 0 || jQuery("#theme-my-login #lostpasswordform").length ){
			jQuery("#theme-my-login").next().hide();
			jQuery("#theme-my-login").next().next().hide();
		}
	}
	
  jQuery('.right-content ul li:last, .right-content ul li:last,.compare ul.right-links li:last, .compare ul.right-links-app li:last').addClass('last');
	jQuery('.right-content ul li ul li a').click(function() {
		jQuery('.right-content ul li ul li a').each(function(){
			jQuery(this).removeClass('active')
		})
			jQuery(this).addClass('active');
	});

	jQuery('#menu-main_menu li').each(function() {
	if(jQuery(this).find('ul').length == 1){
		jQuery(this).find('ul li:first').before('<li class="arrow-sub"></li>')
	}
	});

	if(jQuery('#header .menu ul li:last')) {
		jQuery('#header .menu ul li.current-menu-item a').addClass('active');
	}

	jQuery('.search_area .form-line input.field').focus(function(){
		jQuery('.search_area').removeClass('blur');
		jQuery('.search_area').addClass('focus');
	});

	jQuery('.search_area .form-line input.field').blur(function(){
		jQuery('.search_area').removeClass('focus');
		jQuery('.search_area').addClass('blur');
	});
	jQuery('.wpcf7-form input, .wpcf7-form textarea').blur(function(){
		jQuery(this).addClass('blur');
	});

	jQuery('body').click(function(){
		jQuery('.search_area').css('border-color', '#e0e0e0');
		jQuery('.search-popup, .sign-in-popup').hide();
		jQuery('.sign-in').removeClass('checked');
	});

	jQuery('.checkboxes-area span:first').addClass('checked');
	jQuery('.checkboxes-area span').click(function() {
		jQuery('.checkboxes-area span').each(function(){
			jQuery(this).removeClass('checked')
		})
		jQuery(this).addClass('checked');
	});

	jQuery('.fun-area span.eff').click(function() {
		jQuery('.fun-area span.eff').each(function(){
			jQuery(this).removeClass('checked')
		})
			jQuery(this).addClass('checked');
		jQuery('.loading').hide();
    jQuery('.result').show();
		jQuery('.des-step-three').show();
	});

	jQuery('.form-area, input.field, .search-popup, .icon-search, .sign-in, .sign-in-popup').click(function(e){
		e.stopPropagation();
	});

	jQuery('a.choose-effects').click(function () {
		var n = parseInt(jQuery('.left-checkboxes ul li input:checked, .middle-checkboxes ul li input:checked, .right-checkboxes ul li input:checked').size());
		var count = parseInt(jQuery('.fun-area p span.count-checkbox').text());
		if(count == 0) count+1;
		jQuery('.fun-area p span.count-checkbox').text(+n);
		jQuery('.checkboxes-area').hide();
    jQuery('.loading').show();
		jQuery('.des-step-three').hide();
  });

	jQuery('.icon-search').click(function () {
    jQuery('.search-popup').show();
		jQuery('.sign-in-popup').hide();
		jQuery('.sign-in').removeClass('checked');
  });

	jQuery('.sign-in').click(function () {
		jQuery(this).addClass('checked');
    jQuery('.sign-in-popup').show();
		jQuery('.search-popup').hide();
  });

	jQuery('ul.sidebarlogin_otherlinks li a').text('Forgot your password?');

});

/* HTML5 Placeholder jQuery Fix - resource: http://bavotasan.com/2011/html5-placeholder-jquery-fix/ */
jQuery(function() {
	var input = document.createElement("input");
    if(('placeholder' in input)==false) { 
		jQuery('[placeholder]').focus(function() {
			var i = jQuery(this);
			if(i.val() == i.attr('placeholder')) {
				i.val('').removeClass('placeholder');
				if(i.hasClass('password')) {
					i.removeClass('password');
					this.type='password';
				}			
			}
		}).blur(function() {
			var i = jQuery(this);	
			if(i.val() == '' || i.val() == i.attr('placeholder')) {
				if(this.type=='password') {
					i.addClass('password');
					this.type='text';
				}
				i.addClass('placeholder').val(i.attr('placeholder'));
			}
		}).blur().parents('form').submit(function() {
			jQuery(this).find('[placeholder]').each(function() {
				var i = jQuery(this);
				if(i.val() == i.attr('placeholder'))
					i.val('');
			})
		});
	}
});