var fixed = false;
var $la = jQuery.noConflict();
$la(document).ready(function() {
	if($la("#socialdiscussions_open_div").val()){
		var to_open=$la("#socialdiscussions_open_div").val();
		to_open = "#"+to_open;
		$la(window).bind('load', function() {
			  var to_do=  $la(to_open).parents("form").find(".social_discussions_header_edit").trigger("click");
		});
	}
	$la(".social_discussions_header_link").live("click", function() {
		var elem_this = $la(this);
		var elem_input = $la(this).find("input:first");
		var elem_parent_div = elem_this.parents('div:first');
		$la(".social_discussions_header_hide").each(function() {
			if($la(this).attr("id") != elem_this.attr("id")) {
				if($la(this).is(":visible")) {
					$la(this).hide();
					// $la(this).parents(".postbox:first").find(".social_discussions_header_content:first").hide();
					$la(this).parents(".postbox:first").find(".social_discussions_header_edit:first").show();
				}
			}
		});
		elem_parent_div.find('a').each(function(){
			if($la(this).find("input:first").val() == elem_input.val()) {
				$la(this).hide();
			} else {
				$la(this).show();
			}
		});
		var elem_parent = elem_this.parents(".postbox:first");
		var social_discussions_header_content = elem_parent.find(".social_discussions_header_content:first");
        social_discussions_header_content.toggle();
	});
	$la("#laecho-html-icon-display-inline").live("change", function(){
		var display_inline = $la(this);
		if(display_inline.val() == 1) {
			$la(".laecho-html-icon-margin-block").each(function(){
				$la(this).hide();
			});
		} else {
			$la(".laecho-html-icon-margin-block").each(function(){
				$la(this).show();
			});
		}
	});
	$la('input[name="social_buttons_select_style"]').each(function(){
		if($la(this).is(':checked')){
			var selected_id = $la(this).attr("id");
			$la("#"+selected_id+"_options").show();
			$la("."+selected_id+"_show_confirm").show();
		}
		
	});
	$la('input[name="social_buttons_select_style"]').bind("click", (function () {
		var selected_id = $la(this).attr("id");
		$la(".laecho_buttons_style_options").each(function() {
			$la(this).fadeOut();		
		});
		$la("#"+selected_id+"_options").fadeIn();
		
	}));
	
	if($la("#laecho_networkpub_added").length > 0) {
		if($la("#laecho_networkpub_added").val() > 0) {
			$la(window).bind('load', function() {
				$la("#social_discussions_header_link_networkpub").trigger("click");
			});
		}
	}
	if(window.location.hash) {
		if(window.location.hash == "#networkpub") {
			$la("#laecho_networkpub_added").parents(".laecho_postbox").find(".social_discussions_header_edit").trigger("click");
		}
	}
	//Make the color appear and change
	$la("input[class=laecho_fs_color_play]").each(function(){
		$la(this).change(function(){
			var naming=($la(this).attr("id"));
			var color=$la(this).val();
			//Adds #
			if(color.match(/#/g)){
			} else {
				var patt1=/(\d\w+|^[a-f]\w+|^[A-F]\w+)/g;
				var len=String(color.match(patt1)).length;
				var demo2=color.match(patt1)
				if(len>2 && demo2!=null && len<8){
					color = ('#'+String(color.match(patt1)));
				}
			}
			$la("#"+naming+"_span").css("background",color);
			$la(this).val(color);
		});
	});
	$la("#laecho-html-title-color").change(function(){
		var naming=($la(this).attr("id"));
		var color=$la(this).val();
		//Adds #
		if(color.match(/#/g)){
		} else {
			var patt1=/(\d\w+|^[a-f]\w+|^[A-F]\w+)/g;
			var len=String(color.match(patt1)).length;
			var demo2=color.match(patt1)
			if(len>2 && demo2!=null && len<8){
				color = ('#'+String(color.match(patt1)));
			}
		}
		//$la("#"+naming+"_span").css("background",color);
		$la(this).val(color);
	});
	$la(".lanetworkpubre").live("click", function() {
		var this_form = $(this).parents("form:first");
		$("#laechonw_networkpub_key").val($(this).find("input:first").val());
		this_form.submit();
		return false;
	});
});
function social_discussions_msg_fade(laecho_ajax_msg) {
	setTimeout(function(){
		laecho_ajax_msg.fadeOut()
	}, 5000);
}