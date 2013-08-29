/**
 * @author ikaudenko
 */

function customSelect(newelem){
		/* CUSTOM SELECT START */
		if(newelem){
			var $_select = {
				custom 	 : jQuery("select#"+newelem),
				parDiv	 : jQuery("select#"+newelem).parent("p"),
				ul		 : jQuery("<ul class='select-list' />"),
				wrapul	 : jQuery("<div class='wrap-list' />"),
				ulblk	 : jQuery("<div class='list-box' />"),
				boxval	 : jQuery("<div class='list-val' />")
			}
		}else{
			var $_select = {
				custom 	 : jQuery("select.custom-select"),
				parDiv	 : jQuery("select.custom-select").parent("p"),
				ul		 : jQuery("<ul class='select-list' />"),
				wrapul	 : jQuery("<div class='wrap-list' />"),
				ulblk	 : jQuery("<div class='list-box' />"),
				boxval	 : jQuery("<div class='list-val' />")
			}	
		}
		
		$_select.custom.css({ display: "none" });
		
		/* add list with items on the page, wrap all selec list's to the div */
		$_select.parDiv.append($_select.ul);
		var ullist = $_select.parDiv.find("ul.select-list"),
			options;
		ullist.wrap($_select.ulblk);
		var listbox = $_select.parDiv.find(".list-box");
		listbox.prepend($_select.boxval);
		ullist.wrap($_select.wrapul);
		var boxval = $_select.parDiv.find(".list-val"),
			wrapul = $_select.parDiv.find(".wrap-list");
			
		for(var i=0; i<=$_select.custom.length-1; i++){
			//jQuery($_select.custom[i]).attr('id', 'select'+(i+1));

			options = jQuery($_select.custom[i]).find("option");
	
			for(var j=0; j<=options.length-1; j++){
				if(jQuery(options[j]).attr("selected")) { 
					jQuery(ullist[i]).append('<li class="selected" rel="'+(j+1)+'">'+jQuery(options[j]).text()+'</li>');
					jQuery(boxval[i]).text(jQuery(options[j]).text());
				}else{
					jQuery(ullist[i]).append('<li rel="'+(j+1)+'">'+jQuery(options[j]).text()+'</li>');
				}
			}
			
		}
		
		/* boxval clik event */
		boxval.click(function(){	
			var elem = jQuery(this),
				child = elem.next(wrapul);
			if(!child.hasClass("active")){
				wrapul.slideUp(100).removeClass("active");
				child.addClass("active");
				child.slideDown(200);
			}else{
				child.removeClass("active");
				child.slideUp(200);
			}
			
		});
		


		
		listbox.find("li").click(function(){
			var elem	= jQuery(this),
				current	= elem.attr("rel"),
				parDiv	= elem.parent().parent(),
				newval	= parDiv.prev(boxval),
				parselect = parDiv.parent(listbox).prev("select"),
				opts	= parselect.find("option");	
			if(!elem.hasClass("selected")){
				parDiv.find("li").removeAttr("class");
				elem.addClass("selected");
				newval.text(elem.text());
				parselect.removeAttr("selected")
				jQuery(opts[current-1]).attr("selected", "selected");
				parDiv.removeClass("active");
				parDiv.slideUp(200);
			}
			jQuery('ul.select-list li:last').addClass('last');
			jQuery('ul.select-list li:first').addClass('first');
			//jQuery('ul.select-list').find('li:first').before('<li class="arrow-select"></li>');
		});

		/* CUSTOM SELECT END */
	}

 jQuery(document).ready(function(){	
	
	customSelect();
	
	jQuery('ul.select-list li:last').addClass('last');
	jQuery('ul.select-list li:first').addClass('first');

	jQuery('.list-val').click(function() {
			jQuery(this).addClass('exp');
	});
	jQuery('.select-list li').click(function() {
			jQuery('.list-val').removeClass('exp');
			setTimeout(function() {
				jQuery('.des-step-one').show();
				jQuery('.checkboxes-area').show();
			}, 500);
	});
	jQuery('.select-list li.first').click(function() {
			jQuery('.list-val').removeClass('exp');
			setTimeout(function() {
				jQuery('.des-step-one').show();
				jQuery('.checkboxes-area').show();
			}, 500);
	});
	 
	 
	 
 });
