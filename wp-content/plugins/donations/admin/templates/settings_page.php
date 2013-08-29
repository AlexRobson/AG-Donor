	<div class="wrap">
	    <?php screen_icon('plugins'); ?>
        <h2>Donations Options Page</h2>

		<?php if ($message): ?>
		<div class="message">
			<?php echo $message; ?>
		</div>
		<?php endif; ?>


		<form name="frm_sbt_settings" method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">

			<table class="form-table">
			<?php foreach ($this->settings as $key=>$item): ?>
			<tr>
				<th scope="row" valign="top"><label><?php echo $this->settings_format[$key]['label']; ?></label></th>
				<td>
					<?php if ( $this->settings_format[$key]['mime'] == 'image' && $item != ''): ?>
					<p><img src="<?php echo stripslashes($item); ?>" alt="<?php echo $this->settings_format[$key]['label']; ?>" /></p>
					<?php endif; ?>

					<?php
					switch($this->settings_format[$key]['type']):
						case 'memo': // textarea  // $this->settings_format[$key]['']
					?>
					<textarea cols="<?php echo ($this->settings_format[$key]['width']?$this->settings_format[$key]['width']:50) ?>" rows="4" name="<?php echo $this->settings_name; ?>[<?php echo $key;?>]" id="iss_setting_<?php echo $key;?>"><?php if ( $item != "") { echo stripslashes($item); } ?></textarea>
					<?php
						break;

						case 'multitext': // the value is an array
					?>

					<input size="<?php echo ($this->settings_format[$key]['width']?$this->settings_format[$key]['width']:60) ?>" name="<?php echo $this->settings_name; ?>[<?php echo $key;?>]" id="iss_setting_<?php echo $key;?>" value="<?php echo $this->parts_implode($item); ?>" type="text" />

					<?php
						break;

						case 'fixed': // the value is an array
					?>

					<input size="<?php echo ($this->settings_format[$key]['width']?$this->settings_format[$key]['width']:60) ?>" name="<?php echo $this->settings_name; ?>[<?php echo $key;?>]" id="iss_setting_<?php echo $key;?>" value="<?php echo $this->parts_implode($item); ?>" type="text" readonly="readonly" />

					<?php
						break;

						case 'checkbox':
							/*?><pre><?php print_r($this->settings); ?></pre><pre><?php print_r($item); ?></pre><?php*/
					?>
					<input name="checkbox_<?php echo $key;?>" id="checkbox_<?php echo $key;?>" type="checkbox" <?php echo $item?'checked="checked"':''; ?> />
					<input name="<?php echo $this->settings_name; ?>[<?php echo $key;?>]" id="iss_setting_<?php echo $key;?>" type="hidden" value="<?php echo $item?1:0; ?>" />
					<script type="text/javascript">
					//<!--
						jQuery(document).ready(function(){
							jQuery("#checkbox_<?php echo $key;?>").click(function(){
								if(jQuery("#checkbox_<?php echo $key;?>").is(":checked"))
									jQuery("#iss_setting_<?php echo $key;?>").val(1);
								else
									jQuery("#iss_setting_<?php echo $key;?>").val(0);
							});
						});
					//-->
					</script>
					<?php
						break;

						default:
							if ($this->settings_format[$key]['path'])
								echo get_bloginfo('url') .'/';
					?>
					<input size="<?php echo ($this->settings_format[$key]['width']?$this->settings_format[$key]['width']:60) ?>" name="<?php echo $this->settings_name; ?>[<?php echo $key;?>]" id="iss_setting_<?php echo $key;?>" value="<?php if ( $item != "") { echo ($this->settings_format[$key]['path']?$this->filter_path($item):stripslashes($item)); } ?>" type="text" />

					<?php
						break;
					endswitch;
					?>

					<?php if ($this->settings_format[$key]['help'] || $this->settings_format[$key]['type'] == 'fixed'): ?>
					<p><small><?php echo $this->settings_format[$key]['help']; ?> <?php if ($this->settings_format[$key]['type'] == 'fixed'): ?>(This field is readonly)<?php endif; ?></small></p>
					<?php endif; ?>
				</td>
			</tr>
			<?php endforeach; ?>
			</table>


			<p>&nbsp;</p>

			<!-- Submit changes -->
			<p class="submit">
			<input name="save_options" class="button-primary" type="submit" value="Save changes" />
			<input type="hidden" name="action" value="save" />
			</p>

		</form>