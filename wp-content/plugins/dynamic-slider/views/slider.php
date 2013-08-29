<?php
	$url_page = $_SERVER["REQUEST_URI"];
	$url_page = explode('/wp-admin',$url_page);
	$url_page = "http://".$_SERVER['HTTP_HOST'].$url_page[0];
?>

<script type="text/javascript">
<!--
	jQuery(document).ready(function(){
	
		jQuery('.img-input').change(function(){
			url_site = location.href;
			array_url = url_site.split('/wp-',1);
			imgurl_pw = array_url[0] + "/wp-content/plugins/dynamic-slider/includes/timthumb.php?src=" + jQuery(this).val() + "&w=380&h=160&q=100";
			jQuery('#img-preview-'+jQuery(this).attr('related')).attr('src',imgurl_pw);
			//jQuery('#img-preview-'+jQuery(this).attr('related')).attr('width',"250");
		});

		jQuery("img").error(function () {
		  jQuery(this).unbind("error").attr("src", "<?php echo $url_page?>/wp-content/plugins/dynamic-slider/img/no-photo.jpg");		
		});
	});
  
	$ = jQuery;
  jQuery(function($){
	
		button_clicked = '';
		
		jQuery('.upload_image').click(function() {		
		  button_clicked = $(this).attr('upload_to');
		  tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true&amp;post_id=1');
		});

		window.send_to_editor = function(html) {		
      imgurl = jQuery('img', html).attr('src');
	    imgAlt = jQuery('img', html).attr('alt');
	    imgTitle = jQuery('img', html).attr('title');
      jQuery('#img-input-' + button_clicked).val(imgurl);
	    jQuery('#img-alt-' + button_clicked).val(imgAlt);

	    if(jQuery('#img-title-' + button_clicked).val().length==0)
				jQuery('#img-title-' + button_clicked).val(imgTitle);
	    
	    jQuery('#img-input-' + button_clicked).trigger('change');
      tb_remove();
    };
	
		jQuery('.remove-slide').click(function(){
		
			var el = $(this).parent().parent().parent().parent().parent();
			//console.log(el);
			jconfirm('<br/>You are about to delete this slide. Are you sure?',function(){
				el.remove();
				$('#gov-home-form').submit();
				$('#dialog-alert').dialog( "close" );
			});			
			return false;
		});
	});
-->
</script>


<div class="wrap" id="div-inqtools">
	
	<div class="header-inqbation">
	<h2><a href="http://www.inqbation.com/">Digital Marketing Agency</a></h2>
	</div>
	
	<div class="content-about-1 ">
	<div id="icon-inqbation" class="icon32"></div><h2><?php _e('DynamicSlider') ?></h2>
	</div>
	
	<div id="notifications"></div>

	<p>DynamicSlider is a tool used to manage the home slider, it is customizable, simple, and fast. Here you must enter information for each image of the slider, by default the slider has two images or slides. When you complete the information and upload the images, you can add additional images (if required). You also have the option to change the order of the slides or delete any of them.</p>
	

	<form method="post" id="gov-home-form">
	
		<?php wp_nonce_field('update-options'); ?>
		<div id="sortable" class="slider-form">
	
		<?php for($i=0; $i<$count; $i++):?>

			<?php $item[$i] = (array)$item[$i]; ?>
		
		<table class="wp-list-table widefat fixed" cellspacing="0" border="0">
		<thead class="slide-cursor">
		<tr>
			<th>
				<div class="order-icon"></div>
				Slide <span class="slide-number"><?php echo $i+1; ?></span></th>
			<th align="right">
				
				<div class="div-remove-slide">
					<a href="#" class="remove-slide">Delete</a>
				</div>
				
			</th>
		</tr>
		</thead>
		<tbody>
		<tr>
			<td>
				
				<div class="slide-form" id="slide-<?php echo $i ?>">

				<div>
					<label>Title:</label>
					<input id="img-title-<?php echo $i; ?>" type="text" name="gov-home[<?php echo $i; ?>][title]" value="<?php echo getData($i,'title',$item); ?>" />
				</div>
				
				<div class="html-option">
					<label>Subtitle:</label>
					<input type="text" name="gov-home[<?php echo $i; ?>][text2]" value="<?php echo getData($i,'text2',$item); ?>" />
				</div>
				
				<div class="image-option">
					<label>Description:</label>
					<textarea name="gov-home[<?php echo $i; ?>][text]" rows="5"><?php echo getData($i,'text',$item); ?></textarea>
				</div>
				
				<div class="image-option">
					<label>Link:</label>
					<input type="text" name="gov-home[<?php echo $i; ?>][link]" value="<?php echo getData($i,'link',$item); ?>">
				</div>

				<!--<div style="display:none" class="html-option">
					<label>HTML content:</label>
					<textarea name="gov-home[<?php echo $i; ?>][html]"><?php echo getData($i,'html',$item); ?></textarea>
				</div>-->

				<div class="order-container">
					<label>Order:</label>
					<input type="text" class="text-tiny order-input" name="gov-home[<?php echo $i; ?>][order]" value="<?php if (getData($i,'order',$item) == "") echo $i; else echo getData($i,'order',$item); ?>">
				</div>
			
			</td>
			<td>
				<div class="div-slide-image" align="center">
					<?php if(getData($i,'image',$item)!=''):?>
						<img src="<?php echo $url_page.'/wp-content/plugins/dynamic-slider/includes/timthumb.php?src='.getData($i,'image',$item).'&amp;w=380&amp;h=160&amp;q=100' ?>" align="middle" id="img-preview-<?php echo $i; ?>" alt="img-preview-<?php echo $i; ?>" />
					<?php else: ?>
						<img src="<?php echo $url_page.'/wp-content/plugins/dynamic-slider/img/no-photo.gif'?>" id="img-preview-<?php echo $i; ?>" alt="no-photo" />
					<?php endif; ?>
				</div>
				
				<div class="image-option">
					<label>Image:</label>
					<input id="img-input-<?php echo $i; ?>" type="text" class="img-input" name="gov-home[<?php echo $i; ?>][image]"  value="<?php echo getData($i,'image',$item); ?>" related="<?php echo $i; ?>" />
					<input type="button" class="button upload_image" value="Select Image" upload_to="<?php echo $i; ?>"/>
				</div>

				<div class="image-option">
					<label>Alternate text:</label>
					<input id="img-alt-<?php echo $i; ?>" type="text" name="gov-home[<?php echo $i; ?>][alt]" value="<?php echo getData($i,'alt',$item); ?>">
				</div>

			</td>
		</tr>
		</tbody>
		</table>
		
		
	
		<?php endfor; ?>
		</div>
		
		<input type="submit" value="Save" class="button-primary" />
		<input type="hidden" id="action-home-slider" name="action" value="updategov" />
		<input type="button" value="Add Slide" class="button" onclick="addslidechange(<?php echo $count_total; ?>);" />
		<input type="hidden" id="add-slide" name="add-slide" value="" />

	</form>
	
	<div id="inqbation-brand-link">
  <a href="http://www.inqbation.com" title="DC Web Designer" target="_blank">DC Web Designer</a><span class="footer-inqbation">&nbsp;:&nbsp;</span><a href="http://www.inqbation.com" title="inQbation creative web designer" target="_blank">inQbation</a>
</div>

</div>

<script type="text/javascript">
$ = jQuery;

function addslidechange($ct) {
	if($ct <= 2 ) {
		alert("Please, first save two (2) Image and thumbnail for create a new slide.");
	} else {
		$("#add-slide").val("addslide");		
		$('#gov-home-form').submit();
	}
}	

jQuery(function($) {
	$('#action-home-slider').click(function() {
		$("#add-slide").val("");	
	});
	
	$( "#sortable" ).sortable({
		placeholder: "ui-state-highlight",
		handle: 'thead.slide-cursor',
		update: function(){
			$('input.order-input').each(function(k,v){
				$(this).val(k);
			});
			$('slide-number').each(function(k,v){
				$(this).html(k+1);
			});				
		}
	});
	$( "#sortable" ).disableSelection();

	$('input,textarea').bind('mousedown.ui-disableSelection selectstart.ui-disableSelection', function(event) {
			event.stopImmediatePropagation();
	});	
	
	if($(".updated-inq").length != 0) {
		$(".updated-inq").appendTo("#notifications");		
		setTimeout(function(){  
			jQuery(".updated-inq").fadeOut(1600,"linear");
		},10000);  
	}
	if($(".error-inq").length != 0) {
		$(".error-inq").appendTo("#notifications");		
	}	
});

function jconfirm(text,func,textButton){
	var $confirmTextButton='Yes';
	if(textButton!=undefined)
		$confirmTextButton=textButton;
		
	func = typeof(func) != undefined ? func : function(){ alert('not defined');};
		 
	$('#dialog-alert').html(text);
	$('#dialog-alert').dialog({
		resizable: true,
       width :400,
       modal: true,
			buttons: [
			{
				text: $confirmTextButton,
				click: function(){
					func();
				}
			},
			{
				text: 'Cancel',
				click: function() {
					$( this ).dialog( "close" );
				}
			}
		]
	});	
}
	
</script>

<div id="dialog-alert" style="display: none" title="System Notification">
</div>