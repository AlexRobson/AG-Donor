<?php
	$url_page = $_SERVER["REQUEST_URI"];
	$url_page = explode('/wp-admin',$url_page);
	$url_page = "http://".$_SERVER['HTTP_HOST'].$url_page[0];
?>

<div class="wrap" id="div-inqtools">
	
	<div class="header-inqbation">
	<h2><a href="http://www.inqbation.com/">Digital Marketing Agency</a></h2>
	</div>
	
	<div class="content-about-1">
		<div id="icon-inqbation" class="icon32"></div><h2><?php _e('DynamicSlider Settings') ?></h2>
	</div>
	
	<div id="notifications"></div>
			
	<form method="post" id="gov-home-form">
	<?php wp_nonce_field('update-options'); ?>

	<table cellpadding="0" colspan="0">		
	<tr>	
	
	<td width="50%">	
	
	<h3>Slider Configuration</h3>
	<table class="form-table">
	<tbody>
		<tr>
			<th>Transition time:</th>
			<td><?php echo Html::input(array('value'=>isset($inq_config->time)?$inq_config->time:7,'name'=>'inq-config[time]','class'=>'small-text'));?> seconds</td>
		</tr>	
		<tr>
			<th>Transition type:</th>
			<td><?php echo Html::select(Config::get_slider_effects(),array("id"=>"trasition",'name'=>'inq-config[transition]'),$inq_config->transition); ?></td>
		</tr>	
		<tr>
			<th>Show navigation with:</th>
			<td><?php echo Html::select(array('thumbnails','numbers','none'),array('name'=>'inq-config[pager]'),$inq_config->pager); ?></td>
		</tr>
		<tr>
			<th>Styles:</th>
			<td><?php echo Html::select(array('default','custom'),array('name'=>'inq-config[styles]'),$inq_config->styles);?>
			<span class="description">To view the saved changes for the styles need to refresh the page by clicking the Reload button.</span></td>
		</tr>
        <tr>
			<th>Open link in a new tab:</th>
			<td><input class="" name="inq-config[newtab]" type="checkbox"<?php echo ($inq_config->newtab=='on')?' checked="checked"':''; ?> /></td>
		</tr>
	</tbody>
	</table>
	
	</td>
	
	<td valign="top">
	<h3>Image Configuration</h3>
	<table class="form-table">
	<tbody>
		<tr>
			<th>Full size images:</th>
			<td>Width <?php echo Html::input(array('value'=>isset($inq_config->width)?$inq_config->width:640,'name'=>'inq-config[width]','class'=>'small-text'));?> Height <?php echo Html::input(array('value'=>isset($inq_config->height)?$inq_config->height:400,'name'=>'inq-config[height]','class'=>'small-text'));?></td>
		</tr>	
		<tr>
			<th>Crop images:</th>
			<td><?php echo Html::select(array('yes','no'),array('name'=>'inq-config[crop]'),$inq_config->crop);?>
			<span class="description">Crop images refers to the removal of the outer parts of an image to improve framing, accentuate subject matter or change aspect ratio.</span></td>
		</tr>	
		<tr>
			<th>Thumbnails size:</th>
			<td>Width <?php echo Html::input(array('value'=>isset($inq_config->pager_thumb_width)?$inq_config->pager_thumb_width:100,'name'=>'inq-config[pager_thumb_width]','class'=>'small-text'));?> Height <?php echo Html::input(array('value'=>isset($inq_config->pager_thumb_height)?$inq_config->pager_thumb_height:53,'name'=>'inq-config[pager_thumb_height]','class'=>'small-text'));?></td>
		</tr>
	</tbody>
	</table>
	
	</td>
	</tr>
	<tr>
			<td colspan="2">	
				<p class="button-controls">
				<?php echo Html::input(array('type'=>'submit','value'=>'Save Changes','class'=>'button-primary'));?>
				<input type="hidden" name="action" value="updateconfig" />		
				</p>
			</td>	
		</tr>	
	</table>				

	<table class="wp-list-table widefat fixed" cellspacing="0" border="0">
	<thead><tr><th>Preview DinamicSlider</th><th><?php echo Html::input(array('type'=>'button','value'=>'Reload','class'=>'button btn-rpreview','id'=>'bt_reload'));?></th></tr></thead>
	<tbody>
		<tr>
			<td colspan="2"><?php cms_slider(935,297); ?></td>
		</tr>
	<tbody>
	</table>
	
	</form>

	<div id="inqbation-brand-link">
  <a href="http://www.inqbation.com" title="DC Web Designer" target="_blank">DC Web Designer</a><span class="footer-inqbation">&nbsp;:&nbsp;</span><a href="http://www.inqbation.com" title="inQbation creative web designer" target="_blank">inQbation</a>
</div>

</div>

<script type="text/javascript">
jQuery(function($){
	jQuery("#bt_reload").click(function() {
    location.reload();	
  });

	if(jQuery(".updated-inq").length != 0) {
		jQuery(".updated-inq").appendTo("#notifications");
				
		setTimeout(function(){  
			jQuery(".updated-inq").fadeOut(1600,"linear");
		},10000);  
	}
	
	if(jQuery(".error-inq").length != 0) {
		jQuery(".error-inq").appendTo("#notifications");		
	}
 	
});
</script>