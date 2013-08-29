./donor-programs/                                                                                   0000775 0001750 0000041 00000000000 12174446364 013437  5                                                                                                    ustar   alex                            www-data                                                                                                                                                                                                               ./donor-programs/templates/                                                                         0000775 0001750 0000041 00000000000 12174333130 015417  5                                                                                                    ustar   alex                            www-data                                                                                                                                                                                                               ./donor-programs/templates/template-front-end-meta-analysis.php                                     0000775 0001750 0000041 00000022663 12174331131 024415  0                                                                                                    ustar   alex                            www-data                                                                                                                                                                                                               <?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
	/*if(isset($_POST['meta-analysis'])){
		?><pre><?php print_r( $_POST['meta-analysis'] ); ?></pre><?php
	}*/
?>

<?php if( $list_of_programs ): ?>
<div class="metaanalyses donors metaanalysis-program">
	<div class="top-part" style="height: 201px;">
			<form id="meta-analysis-form" method="post">
            
            <div class="group">
				<div class="step-one">
					<p class="title">Select Program</p>
					<?php if( $help1 ): ?>
					<a href="javascript:;" class="question" title="<?php print_r($help1); ?>"></a>
					<?php endif; ?>
					<div class="fun-area">
						<div class="wpsc_variation_forms">
							<?php get_select( $list_of_programs, 0, 0, 'meta-analysis', 'program', 'Select a Program' ); ?>
							<div class="list-box">
								<div class="list-val">Select Program</div>
								<div class="wrap-list">
									<ul class="select-list">
										<?php for( $i=0; $i<count($list_of_programs); $i++ ): ?>
										<li rel="<?php echo $list_of_programs[$i]['id']; ?>"><?php echo $list_of_programs[$i]['name']; ?></li>
										<?php endfor; ?>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="step-two">
					<p class="title">Select Outcome</p>
					<?php if( $help2 ): ?>
					<a href="javascript:;" class="question" title="<?php print_r($help2); ?>"></a>
					<?php endif; ?>
					<div class="fun-area">
						<div class="wpsc_variation_forms">
							<select name="meta-analysis[0][outcome_id]" class="select-for-outcome">
								<option value="0">Select Outcome</option>
							</select>
							<div class="list-box">
								<div class="list-val exp non-selectable">Select Outcome</div>
							</div>
						</div>
					</div>
				</div>
                </div>
                <div class="group">
				<div class="step-three">
					<p class="title">Choose Filters / Effects</p>
					<div class="fun-area-analysis">
						<div class="wpsc_variation_forms-analysis">
							<p class="title">What was the method used?</p>
							<?php if( $help3 ): ?>
							<a href="javascript:;" class="question" title="<?php print_r($help3); ?>"></a>
							<?php endif; ?>
							<ul>
								<li><input id="meta-radio-1" type="radio" name="meta-analysis[0][method]" value="1" />
                                <label for="meta-radio-1">Randomized</label></li>
								<li><input id="meta-radio-2" type="radio" name="meta-analysis[0][method]" value="0" />
                                <label for="meta-radio-2">Not Randomized</label></li>
								<li><input id="meta-radio-3" type="radio" name="meta-analysis[0][method]" value="2" checked="checked" />
                                <label for="meta-radio-3">Either</label></li>
							</ul>
						</div>
						<div class="wpsc_variation_forms-analysis">
							<p class="title">Was the study blinded?</p>
							<?php if( $help4 ): ?>
							<a href="javascript:;" class="question" title="<?php print_r($help4); ?>"></a>
							<?php endif; ?>
							<ul>
								<li><input id="meta-radio-4" type="radio" name="meta-analysis[0][blinded]" value="1" />
                                <label for="meta-radio-4">Blinded</label></li>
								<li><input id="meta-radio-5" type="radio" name="meta-analysis[0][blinded]" value="0" />
                                <label for="meta-radio-5">Not Blinded</label></li>
								<li><input id="meta-radio-6" type="radio" name="meta-analysis[0][blinded]" value="2" checked="checked" />
                                <label for="meta-radio-6">Either</label></li>
							</ul>
						</div>
						<div class="wpsc_variation_forms-analysis">
							<p class="title">Fixed or random effects?</p>
							<?php if( $help5 ): ?>
							<a href="javascript:;" class="question" title="<?php print_r($help5); ?>"></a>
							<?php endif; ?>
							<ul>
								<li><input id="meta-radio-7" type="radio" name="meta-analysis[0][effect]" value="0" checked="checked" />
                                <label for="meta-radio-7">Fixed effects</label></li>
								<li><input id="meta-radio-8" type="radio" name="meta-analysis[0][effect]" value="1" />
                                <label for="meta-radio-8">Random effects</label></li>
							</ul>
						</div>
					</div>
				</div>
                </div>
                
                <div class="group info">
                	<input type="submit" value="Submit" />
               
					<div class="total-studies"></div>
                </div>
				
			</form>
		</div>
			
		<div class="mid-part">
			<div class="result">
				<div class="result-in">
					<!-- RESULTS -->
				</div>	
			</div>
		</div>
	</div>
	<script type="text/javascript">
	//<!--
		jQuery(document).ready(function(){
//			jQuery("#meta-analysis-form select, #meta-analysis-form input").on("change", function(){

			jQuery(document).on("change", "#meta-analysis-form select, #meta-analysis-form input", function(){
				if(jQuery(this).attr('class') == 'select-for-program' && jQuery(this).val() != 0){

					loadselectoutcome( jQuery(this) );
				}
				else if(jQuery(this).attr('class') == 'select-for-program' && jQuery(this).val() == 0){
					jQuery(".step-two .fun-area .wpsc_variation_forms").html('<select name="meta-analysis[0][outcome_id]" class="select-for-outcome"><option value="0">Select an Outcome</option></select>');
				}
				jQuery("#meta-analysis-form div.total-studies").html('');
			});
			
			jQuery("#meta-analysis-form").submit(function(){
				$form_selection = get_form_selection().split('-');
				if( $form_selection.length < 5 || $form_selection[0] == 0 || $form_selection[1] == 0 ){
					jQuery(".mid-part div.result div.result-in").html('<div class="meta-app-error-message" style="margin: 20px 0px; text-align: center;"><h3 style="float: left; margin: 20px 0; width: 100%;"><strong>Required fields are incomplete. Please select an option for each field and click the Submit button.</strong></h3></div>').parent().show();
					return false;
				}
				else{
					jQuery.post('<?php echo(admin_url('admin-ajax.php')); ?>', {action:'my_special_action',method:'meta-app',selection:get_form_selection()},
						function(answer){
							ajax_studies_by_criteria( get_form_selection() );
							jQuery(".mid-part div.result div.result-in").html(answer).parent().show();
							return true;
						}
					);
					return false;
				}
			});
			
//			jQuery("#meta-analysis-form select, #meta-analysis-form input").on("change", function(){
//			jQuery(document).on("change", "#meta-analysis-form select, #meta-analysis-form input", function(){

//			jQuery(".step-one .list-box .list-val").on('click', function(){
			jQuery(document).on('click', ".step-one .list-box .list-val",  function(){

				jQuery(this).addClass('exp').next().addClass('active').show();
				jQuery(this).bind("clickoutside", function(event){
				  jQuery(this).removeClass('exp').next().removeClass('active').hide();
				});
			});

//			jQuery(".step-one .list-box ul.select-list li").on('click', function(){
			jQuery(document).on('click',".step-one .list-box ul.select-list li", function(){
				if( jQuery('.step-one .list-val').html() != jQuery(this).html() ){
					jQuery('.step-one .list-val').html(jQuery(this).html());
					jQuery('#meta-analysis-form select.select-for-program').val(jQuery(this).attr('rel')).change();
				}
				jQuery(this).closest('div.active').removeClass('active').hide().prev().removeClass('exp');
			});
			
//			jQuery(".step-two .list-box .list-val").on('click', function(){
			jQuery(document).on('click',".step-two .list-box .list-val", function(){
				jQuery(this).addClass('exp').next().addClass('active').show();
				jQuery(this).bind("clickoutside", function(event){
				  jQuery(this).removeClass('exp').next().removeClass('active').hide();
				});
			});

//			jQuery(".step-two .list-box ul.select-list li").on('click', function(){
			jQuery(document).on('click',".step-two .list-box ul.select-list li", function(){
				if( jQuery('.step-two .list-val').html() != jQuery(this).html() ){
					jQuery('.step-two .list-val').html(jQuery(this).html());
					jQuery('#meta-analysis-form select.select-for-outcome').val(jQuery(this).attr('rel')).change();
				}
				jQuery(this).closest('div.active').removeClass('active').hide().prev().removeClass('exp');
			});
			
			jQuery('div.step-one a, div.step-two a, div.step-three a').powerTip({placement: 'n'});
		});
		
		function get_form_selection(){
			var formselection = '';
			jQuery("#meta-analysis-form select, #meta-analysis-form input:checked").each(function(){
				formselection += (jQuery(this).val()+'-');
			});
			return formselection.substr(0,formselection.length-1);
		}
		
		function loadselectoutcome( elem ){
			jQuery.post('<?php echo(admin_url('admin-ajax.php')); ?>', {action:'my_special_action',selection:elem.val(),method:'loadselectoutcome'},
				function(answer){
					jQuery(".step-two .fun-area .wpsc_variation_forms").html(answer);
					//alert(answer);
					return true;
			});
		}
		
		function ajax_studies_by_criteria( formselection ){
			jQuery.post('<?php echo(admin_url('admin-ajax.php')); ?>', {action:'my_special_action',selection:formselection,method:'studiesbycriteria'},
				function(answer){
					jQuery("#meta-analysis-form div.total-studies").html(answer);
					return answer.substr(0, 1);
			});
		}
	//-->
	</script>
<?php endif; ?>
                                                                             ./donor-programs/templates/template-front-end-results.php                                           0000775 0001750 0001750 00000016557 12174322654 022574  0                                                                                                    ustar   alex                            alex                                                                                                                                                                                                                   <?php

/*
 * 
 * AID Grade, Nov - Dec, 2012.
 * - Show results data in the scale.
 * - This template is used by "compare programs by outcome", "Examine a program" and "Meta Analysis Application"
 * - This template is always showed by an Ajax call.
 */

?>




<?php if( !$data ): ?>
<h3 style="text-align: center;">0 studies have been found. Please change your criteria and submit your search again.</h3>
<style type="text/css"> .result{ margin-bottom: 0px !important; } </style>
<?php else: ?>
<p class="title-outcome"><?php echo ($template=='outcome')?'Programs':'Outcome'; ?></p>
<p class="title-effects">Effects</p>
<?php 
	$lowest = array();
	$highest = array();
	$adjust_tool_tip_value_units = array();
	for( $i=0; $i<count($data); $i++ ):
		
		/*if(str_replace(' ', '-', strtolower(trim($data[$i]['unit']))) == 'percentage-points' && abs($data[$i]['lower']) >= 1 && abs($data[$i]['upper']) >= 1 ){
				$data[$i]['lower'] = round($data[$i]['lower']/100, 2);
				$data[$i]['upper'] = round($data[$i]['upper']/100, 2);
				$adjust_tool_tip_value_units[$i] = $data[$i]['mean'];
				$data[$i]['mean'] = round($data[$i]['mean']/100, 2);
		}
		else{*/
			$adjust_tool_tip_value_units[$i] = $data[$i]['mean'];
		/*}*/
		
		$lowest[] = $data[$i]['lower'];
		$highest[] = $data[$i]['upper'];
	endfor;
	$lowest = min($lowest);
	$highest = max($highest);
		
	$apply_zoom = 1;
	$continue = true;
	for( $i=0.5; $i<3; $i+=0.5 ){
		if( ( ( $lowest>=-1*$i && $lowest<= 0 ) || ( $lowest <= 1*$i && $lowest >=0 ) ) && ( ( $highest>=-1*$i && $highest<= 0 ) || ( $highest <= 1*$i && $highest >=0 ) ) ){
			switch ( $i ){
				case 0.5:
					if( abs($lowest) <= 0.1 && abs($highest) <= 0.1 )
						$apply_zoom*=30;
					else
						$apply_zoom*=15;
					break;
				case 1:
					$apply_zoom*=6;
					break;
				case 1.5:
					$apply_zoom*=4;
					break;
				case 2:
					$apply_zoom*=3;
					break;
				case 2.5:
					$apply_zoom*=2;
					break;
				default :
					$apply_zoom*=1;
					break;
			}
			break;
		}
	}
	?>
	<?php	
	for( $i=0; $i<count($data); $i++ ):
	if( $data[$i]['lower'] < $data[$i]['upper'] && $data[$i]['lower']<=$data[$i]['mean'] && $data[$i]['upper']>=$data[$i]['mean'] ):
		
		$limit_off_left = false;
		if( $data[$i]['lower']<-5 ){
			$data[$i]['lower'] = -5;
			$limit_off_left = true;
		}
		$limit_off_right = false;
		if( $data[$i]['upper']>5 ){
			$data[$i]['upper'] = 5;
			$limit_off_right = true;
		}
//		$data[$i]['lower'] = $data[$i]['lower']<-5?-5:$data[$i]['lower'];
//		$data[$i]['upper'] = $data[$i]['upper']>5?5:$data[$i]['upper'];

		$lower = ceil(round($data[$i]['lower'], 2)/0.02)*$apply_zoom;
		$upper = ceil(round($data[$i]['upper'], 2)/0.02)*$apply_zoom;
		$mean = ceil(round($data[$i]['mean'], 2)/0.02)*$apply_zoom;

		$margin_left = abs($lower - $mean)-12;
		$slice_width = abs($upper-$lower);
		$slice_margin_left = $lower+291;
		
		//print_r( $adjust_tool_tip_value_units ); exit;
?>
<div class="result-info<?php echo ($i+1==count($data))?' last':''; ?>">
	<div class=nameblock" style="float:left">
		<p class="name" style="margin: 0; float:none"><?php echo $data[$i]['name']; ?></p>

		<!-- Included bibliography data, if included -->
		<div class=".bibsparse">
			<!-- BIBLIGRAPHY -->
		</div>

		<?php   // include 'template-front-end-results-bibinfo.php' ?>
		<?php if (array_key_exists('bibindex',$data)){echo populate_bibup($bibdata);} ?>
	</div>
<?php if( $apply_zoom == 1 && false ): ?>
	<div id="scale-zoom" style="float: left; font-family: 'Pompiere',Arial,Helvetica,sans-serif; position: absolute; right: 0; top: 3px;">
		Scale Zoom&nbsp;<span class="0">(x1)</span>&nbsp;
		<?php if( $slice_width + $slice_margin_left < 600 && $slice_margin_left > 12 ): ?>
		<a href="#" class="zoom-add" style="font-size: 20px;">+</a>&nbsp/&nbsp<a href="#" class="zoom-deduct" style="font-size: 20px;">-</a>
		<?php endif; ?>
	</div>
	<?php endif; ?>
	<div class="slice" style="margin: 30px 0 0 <?php echo $slice_margin_left; ?>px; width: <?php echo $slice_width; ?>px;">
		<p class="left-count">
			<?php if( $limit_off_left ): ?>
			<img src="<?php bloginfo('url'); ?>/wp-content/themes/aidgrade/images/arrow-left.png" style="height: 8px; width: 13px; position: absolute; left: -16px; top: 5px;" />
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php else: ?>
			<?php echo $data[$i]['lower']; ?>
			<?php endif; ?>
		</p>
		<p class="slice-count" style="margin: 0px 0px 0px <?php echo $margin_left; ?>px;">
			<?php echo mouse_over_mean_text( $adjust_tool_tip_value_units[$i], $data[$i]['name'], $data[$i]['unit'], $template, $selection_name, $data[$i]['bibref'] ); ?>
			<?php if($data[$i]['lower']<$data[$i]['mean'] && $data[$i]['upper']>$data[$i]['mean']): ?>
				<?php echo $data[$i]['mean']; ?>
			<?php endif; ?>
		</p>
		<p class="right-count">
			<?php if( $limit_off_right ): ?>
			<img src="<?php bloginfo('url'); ?>/wp-content/themes/aidgrade/images/arrow-right.png" style="height: 8px; width: 13px; position: absolute; right: -16px; top: 5px;" />
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php else: ?>
			<?php echo $data[$i]['upper']; ?>
			<?php endif; ?>
		</p>
	</div>

	

	<?php if( $template == 'outcome' && $data[$i]['link_donate'] ): ?>
	<a href="<?php echo $data[$i]['link_donate']; ?>" target="_blank" class="donate-button">DONATE</a>
	<?php endif; ?>

</div>





<?php
		endif;
	endfor;
?>
<div class="null-top"></div>
<div class="null-bottom"></div>
<?php if( $template == 'programs' && $data[$i-1]['link_donate'] ): ?>
	<a href="<?php echo $data[$i-1]['link_donate']; ?>" target="_blank" class="donate-program-button">DONATE TO THIS PROGRAM</a>
<?php else: ?>
	<style type="text/css"> .result{ margin-bottom: 0px !important; } </style>
<?php endif; ?>


	
<script type="text/javascript">
//<!--
	jQuery(document).ready(function(){		
		jQuery('span.tooltip a').powerTip({placement: 'n'});
		var $zoom_value = 10;
		var $max = false;
		jQuery("#scale-zoom a").click(function(e){
			e.preventDefault();
			$current_link = jQuery(this);
			$lower=jQuery(this).parent().parent().find('.left-count').html();
			$mean=jQuery(this).parent().parent().find('.slice-count a').attr('class');
			$upper=jQuery(this).parent().parent().find('.right-count').html();
			var $zoom = parseInt($current_link.parent().find('span').attr('class'))*10;

			$continue = false;
			if($current_link.attr('class') == 'zoom-add'){
				if(!$max){
					$zoom+=$zoom_value;
					$continue = true;
				}
			}
			else{
				if($zoom>10){
					$zoom-=$zoom_value;
					$continue = true;
				}
				else if($zoom==10){
					$zoom = 1;
					$continue = true;
				}
			}
			if($continue){
				jQuery.post('<?php echo(admin_url('admin-ajax.php')); ?>', {action:'my_special_action',method:'scale_function',lower:$lower,mean:$mean,upper:$upper,zoom:$zoom},
					function(answer){
						$resp = answer.split(',');
						if(parseInt($resp[1])+parseInt($resp[2]) < 600 && parseInt($resp[2])>12){
							$current_link.parent().find('span').html('(x'+(parseInt($zoom*0.1)+1)+')');
							$current_link.parent().find('span').attr('class', (parseInt($zoom*0.1)));
							$current_link.parent().parent().find('.slice').css('width', $resp[1]+'px').css('margin-left', $resp[2]+'px');
							$current_link.parent().parent().find('.slice-count').css('margin-left', $resp[0]+'px');
							if($zoom==1){
								$zoom = 0;
							}
							$max = false;
						}
						else{
							$max = true;
						}
						return true;
					});
			}
			return false;
		});
	});



	
//-->
</script>

<?php endif; ?>



                                                                                                                                                 ./donor-programs/templates/template-backend-wp.php                                                  0000775 0001750 0000041 00000045653 12162574630 022005  0                                                                                                    ustar   alex                            www-data                                                                                                                                                                                                               <?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<style type="text/css">
	.widefat td {
		padding: 7px !important;
	}
	.left-form {
		float: left;
		display: block;
		margin-right: 7px;
	}
	.remove {
		margin-top: 25px;
		margin-left: 15px;
	}
	.remove a {
		color: #D54E21;
	}
	.remove a:hover {
		color: #21759B;	
	}
	table.fixed {
		margin-bottom: 10px;
	}
	table select {
    width: 95%;
	}
	.red {
		background-color: #f7ecec;
	}
</style>
    
    
    <div class="wrap" id="div-inqtools">
	
	<div class="header-inqbation">
		<h2><a href="http://www.inqbation.com/" title="inQbation - Digital Marketing Agency" target="_blank">Digital Marketing Agency</a></h2>
	</div>
    <div class="content-about-1">
		<div id="icon-inqbation" class="icon32"></div><h2><?php _e('Donor Program Settings') ?></h2>
	</div>
		
		<div id="notifications">
		<div class="updated-inq" style="display: none;">
			<p><strong>Chages saved succcessfully.</strong></p>
		</div>
	</div>
		
	<div id="tabs">
	<ul>
        <li><a href="#tabs-1">Programs</a></li>
        <li><a href="#tabs-2">Outcome</a></li>
        <li><a href="#tabs-3">Relations</a></li>
		<li><a href="#tabs-4">Settings</a></li>
    </ul>
	<div id="tabs-1">
		<form id="form-inq-donor-programs" method="post">
		<?php if( $programs ): ?>
        <table class="wp-list-table widefat fixed" cellspacing="0" border="0">
			<thead>
				<tr>
                <th>Programs</th>
                </tr>
            </thead>
            <tbody>
<?php for($i=0; $i<count($programs);$i++){ ?>
				<tr>
               	  <td>
					<input value="<?php echo $programs[$i]['id']; ?>" name="program[<?php echo $i; ?>][id]" type="hidden" />
					<input type="checkbox" name="program[<?php echo $i; ?>][remove]" style="display: none;" />
					 
                  <div class="left-form">
                     <label for="row<?php echo $i; ?>">Program Name:</label>
					 <input type="text" id="row<?php echo $i; ?>" value="<?php echo $programs[$i]['name']; ?>" name="program[<?php echo $i; ?>][name]" size="60" />
                  </div>
                  <div class="left-form">
					  <label for="row<?php echo $i; ?>">Donation Link:</label>
					  <input type="text" id="row<?php echo $i; ?>" value="<?php echo $programs[$i]['link_donate']; ?>" name="program[<?php echo $i; ?>][link_donate]" />
				  </div>
                  <div class="left-form remove">
					<a href="#" class="remove-link" onclick="var proceed=confirm('Are you sure that you want to remove this program?');if(proceed){jQuery(this).parent().parent().find('input[type=checkbox]').trigger('click'); jQuery(this).closest('form').submit();} return false;">Remove</a>
				  </div>
                  </td>
				</tr>
                
                
                 
				<?php
		} ?></tbody>
                </table>
			<?php endif; ?>
				<table class="wp-list-table widefat fixed" cellspacing="0" border="0">
                <thead>
                <tr>
               <th>+ Add a New program</th>
                    
                </tr>
                </thead>
                </tbody>
                <tr>
                <td class="add-new-program">
					<div class="left-form">
						<label for="row<?php echo $i; ?>">Program Name:</label>
						<input type="text" id="row<?php echo $i; ?>" value="" name="program[<?php echo $i; ?>][name]" size="60" />
					</div>
					<div class="left-form">
						<label for="row<?php echo $i; ?>">Donation Link:</label>
						<input type="text" id="row<?php echo $i; ?>" value="" name="program[<?php echo $i; ?>][link_donate]"  />
					</div>
			
            		</td>
                </tr>
            </tbody>
        </table>
        <input value="Save" type="submit" class="button-primary" name="SavePrograms" />
		</form>
		<script type="text/javascript">
		//<!--
			jQuery(document).ready(function(){
				jQuery("#form-inq-donor-programs input").change(function(){
					jQuery(this).closest('td').find('input').addClass('save');
					return true;
				});
				jQuery("#form-inq-donor-programs").submit(function(){
					jQuery(this).find('input:not(input.save)').attr('name', '');
					return true;
				});
			});
		//-->
		</script>
	</div>
   

	<div id="tabs-2">
		<form id="form-inq-donor-outcome" method="post">
		<?php if( $outcome ): ?>
        <table class="wp-list-table widefat fixed" cellspacing="0" border="0">
			<thead>
				<tr>
                	<th>Outcome</th>
                </tr>
            </thead>
            <tbody>
            	
		<?php for($i=0; $i<count($outcome);$i++){ ?>
				<tr>
                	<td>
					<input value="<?php echo $outcome[$i]['id']; ?>" name="outcome[<?php echo $i; ?>][id]" type="hidden" />
					<input type="checkbox" name="outcome[<?php echo $i; ?>][remove]" style="display: none;" />
					<div class="left-form">
						<label for="row<?php echo $i; ?>">Outcome Name:</label>
						<input type="text" id="row<?php echo $i; ?>" value="<?php echo $outcome[$i]['name']; ?>" name="outcome[<?php echo $i; ?>][name]" size="50" />
					</div>
                    <div class="left-form remove">
					<a href="#" class="remove-link" onclick="var proceed=confirm('Are you sure that you want to remove this outcome?');if(proceed){jQuery(this).parent().parent().find('input[type=checkbox]').trigger('click'); jQuery(this).closest('form').submit();} return false;">Remove</a>
                    </div>
				</td>
				</tr>
				
				<?php
		} ?></tbody>
		</table>
		<?php endif; ?>
				<table class="wp-list-table widefat fixed" cellspacing="0" border="0">
                <thead>
                <tr>
                    <th>+ Add a New Outcome</th>
                    
                </tr>
                </thead>
                <tbody>
                <tr>
                <td class="add-new-outcome">
					<div class="left-form">
						<label for="outcome-row<?php echo $i; ?>">Outcome Name:</label>
						<input type="text" id="row<?php echo $i; ?>" value="" name="outcome[<?php echo $i; ?>][name]" size="50" />
					</div>
        		</td>
            </tr>
            </tbody>
        </table> 
        <input value="Save" type="submit" class="button-primary" name="SaveOutcome" />
        </form>
        <script type="text/javascript">
		//<!--
			jQuery(document).ready(function(){
				jQuery("#form-inq-donor-outcome input").change(function(){
					jQuery(this).closest('td').find('input').addClass('save');
					return true;
				});
				jQuery("#form-inq-donor-outcome").submit(function(){
					jQuery(this).find('input:not(input.save)').attr('name', '');
					return true;
				});
			});
		//-->
		</script>
	</div>
		
	<div id="tabs-3">
		<form id="form-inq-donor-relations" method="post">
			<?php if( $relations ): ?>
			<table class="wp-list-table widefat fixed" cellspacing="0" border="0">
			<thead>
				<tr>
                	<th>Relations</th>
                </tr>
            </thead>
            <tbody>
				<tr>
					<td><!-- working on filters --></td>
				</tr>
				<?php for( $i=0; $i<count($relations); $i++ ): 
						$outcome_values = $db_obj->admin_get_outcome_values($relations[$i]['id']);
					?>
				<tr>
                	<td class="<?php echo 'filter-'.$relations[$i]['program_id'].'-'.$relations[$i]['outcome_id']; ?><?php echo ((!$relations[$i]['program_id'] || !$relations[$i]['outcome_id'])?' red':''); ?>">
						<input id="input-outcome-values-id" value="<?php echo $relations[$i]['id']; ?>" name="relations[<?php echo $i; ?>][id]" type="hidden" />
						<input type="checkbox" name="relations[<?php echo $i; ?>][remove]" style="display: none;" />
						<div class="left-form">
							<label for="row<?php echo $i; ?>">Program:</label>
							<?php get_select( $programs, $i, $relations[$i]['program_id'], 'relations', 'program' ); ?>
						</div>
						<div class="left-form">
							<label for="row<?php echo $i; ?>">Outcome:</label>
							<?php get_select( $outcome, $i, $relations[$i]['outcome_id'], 'relations', 'outcome' ); ?>
						</div>
						<div class="left-form remove">
							<a href="#" class="add-values">+ Add Values</a>
						</div>
						<div class="left-form remove">
							<a href="#" class="remove-link" onclick="var proceed=confirm('Are you sure that you want to remove this relation and its values?');if(proceed){jQuery(this).parent().parent().find('input[type=checkbox]').trigger('click'); jQuery(this).closest('form').submit();} return false;">Remove relation</a>
						</div>
						<?php
						for( $j=0; $j<count($outcome_values); $j++  ){ ?>
						<div class="set-of-values" style="clear: both;">
							<input type="checkbox" name="relations[<?php echo $i; ?>][outcome_values][<?php echo $j; ?>][remove]" style="display: none;" />
							<?php
							foreach ( $outcome_values[$j] as $key_ov => $value_ov ){
								if( $key_ov == 'id' || $key_ov == 'relation_id' ){
								?>
								<input value="<?php echo $value_ov; ?>" name="relations[<?php echo $i; ?>][outcome_values][<?php echo $j; ?>][<?php echo $key_ov; ?>]" type="hidden" />
								<?php 
								}
								else{ 
									if( $key_ov == 'randomized_filter' ){ ?>
								<div style="clear: both;"></div>
								<?php
									}
									if( $key_ov == 'rflag' ){ ?>
								<div class="left-form">
									<label for="row<?php echo $i; ?>"><?php echo ucfirst($key_ov); ?></label>
									<?php //echo get_select(array( 0 => array( 'id' => 'program-in-select', 'name' => 'Examine a program' ), 1 => array( 'id' => 'outcome-in-select', 'name' => 'Compare programs by outcome' ), 2 => array( 'id' => 'both', 'name' => 'Both' ) ), $j, $value_ov, 'relations['.$i.'][outcome_values]', 'rflag', 'Select an option'); ?>
									<input type="text" value="<?php echo ($value_ov=='both')?1:0; ?>" name="relations[<?php echo $i; ?>][outcome_values][<?php echo $j; ?>][<?php echo $key_ov; ?>]" />
								</div>
								<?php }else{ ?>
								<div class="left-form">
									<label for="row<?php echo $i; ?>"><?php echo ucfirst($key_ov); ?></label>
									<input type="text" value="<?php echo $value_ov; ?>" name="relations[<?php echo $i; ?>][outcome_values][<?php echo $j; ?>][<?php echo $key_ov; ?>]" />
								</div>
							<?php
									}
								}
							} ?>
							<div class="left-form remove">
								<a href="#" class="remove-link" onclick="var proceed=confirm('Are you sure that you want to remove those values?');if(proceed){jQuery(this).parent().parent().find('input[type=checkbox]').trigger('click'); jQuery(this).closest('form').submit();} return false;">Remove values</a>
							</div>
						</div><?php
						}
						?>
						<div class="input-to-save left-form" style="clear: both; margin-top:20px;">
							<input value="Save" type="submit" class="button-primary" name="SaveRelations" />
						</div>
					</td>
				</tr>
                
				<?php endfor; ?>
                </tbody>
			</table>
			<?php endif; ?>
				<table class="wp-list-table widefat fixed" cellspacing="0" border="0">
                <thead>
                <tr>
                    <th>+ Add a New Relation</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                <td class="add-new-relation">
					<div class="left-form">
						<label for="row<?php echo $i; ?>">Program:</label>
						<?php get_select( $programs, $i, '', 'relations', 'program' ); ?>
					</div>
					<div class="left-form">
						<label for="row<?php echo $i; ?>">Outcome:</label>
						<?php get_select( $outcome, $i, '', 'relations', 'outcome' ); ?>
					</div>
					<div class="left-form">
						<label>&nbsp;</label>
						<input value="Save new" type="submit" class="button-primary" name="SaveRelations" />
					</div>
            </td>
            </tr>
            </tbody>
        </table> 
        <input value="Save all" type="submit" class="button-primary" name="SaveRelations" />
		</form>
		<div id="fileds-to-add-new-value" style="display: none;">
			<div class="set-of-values" style="clear: both;">
				<div class="left-form">
					<label>Lower</label>
					<input type="text" name="relations[relation-id][outcome_values][position][lower]" value="" />
				</div>
				<div class="left-form">
					<label>Mean</label>
					<input type="text" name="relations[relation-id][outcome_values][position][mean]" value="" />
				</div>
				<div class="left-form">
					<label>Upper</label>
					<input type="text" name="relations[relation-id][outcome_values][position][upper]" value="" />
				</div>
				<div class="left-form">
					<label>Unit</label>
					<input type="text" name="relations[relation-id][outcome_values][position][unit]" value="" />
				</div>
				<div style="clear: both;"></div>
				<div class="left-form">
					<label>Randomized_filter</label>
					<input type="text" name="relations[relation-id][outcome_values][position][randomized_filter]" value="" />
				</div>
				<div class="left-form">
					<label>Blinded_filter</label>
					<input type="text" name="relations[relation-id][outcome_values][position][blinded_filter]" value="" />
				</div>
				<div class="left-form">
					<label>Effects</label>
					<input type="text" name="relations[relation-id][outcome_values][position][effects]" value="" />
				</div>
				<div class="left-form">
					<label>Rflag</label>
					<input type="text" name="relations[relation-id][outcome_values][position][rflag]" value="" />
					<?php //echo get_select(array( 0 => array( 'id' => 'program-in-select', 'name' => 'Examine a program' ), 1 => array( 'id' => 'outcome-in-select', 'name' => 'Compare programs by outcome' ), 2 => array( 'id' => 'both', 'name' => 'Both' ) ), 'position', null, 'relations[relation-id][outcome_values]', 'rflag', 'Select an option'); ?>
				</div>
				<div class="left-form">
					<label>Number_of_studies</label>
					<input type="text" name="relations[relation-id][outcome_values][position][number_of_studies]" value="" />
				</div>
			</div>
		</div>
		<script type="text/javascript">
		//<!--
			jQuery(document).ready(function(){
				jQuery("#tabs-3 a.add-values").live("click", function(){
					$relation_id = jQuery(this).parent().parent().find('input[type=hidden]').attr('name').match(/(\d+)/)[0];
					$position_in_array = jQuery(this).parent().parent().find('div.set-of-values').length;
					$new_fileds = jQuery("#fileds-to-add-new-value").clone();
					$save_per_files = jQuery(this).closest('td').find(".input-to-save").clone();
					$new_fileds.find('input, select').each(function(){
						jQuery(this).attr('name', jQuery(this).attr('name').replace('position', $position_in_array)).attr('name');
						jQuery(this).attr('name', jQuery(this).attr('name').replace('relation-id', $relation_id)).attr('name');
					});
					jQuery(this).closest('td').find('div.input-to-save').remove();
					jQuery(this).closest('td').append($new_fileds.html());
					jQuery(this).closest('td').append($save_per_files);
					return false;
				});
				
				/* ** */
				jQuery("#form-inq-donor-relations div.left-form:nth-child(3) select, #form-inq-donor-relations div.left-form:nth-child(4) select").change(function(){
					jQuery(this).closest('td').find('div.left-form:nth-child(3) select, div.left-form:nth-child(4) select').addClass('save');
					jQuery(this).closest('td').find('input[type=hidden]:first-child').addClass('save');
					return true;
				});
				jQuery("#form-inq-donor-relations td.add-new-relation select").change(function(){
					jQuery(this).closest('td').find('select').addClass('save');
					return true;
				});
				jQuery("#form-inq-donor-relations input[type=checkbox]").change(function(){
					jQuery(this).closest('td').find('input[type=hidden]:first-child').addClass('save');
					jQuery(this).closest('td').find('input[type=checkbox]:nth-child(2)').addClass('save');
					return true;
				});
				
				jQuery("#form-inq-donor-relations div.set-of-values input, #form-inq-donor-relations div.set-of-values select").live("change", function(){
					jQuery(this).closest('td').find('input[type=hidden]:first-child').addClass('save');
					jQuery(this).closest('td').find('div.left-form:nth-child(3) select, div.left-form:nth-child(4) select').addClass('save');
					jQuery(this).parent().parent().find('input[type=hidden]').addClass('save');
					jQuery(this).parent().parent().find('input').addClass('save');
					jQuery(this).parent().parent().find('select').addClass('save');
					return true;
				});
				
				jQuery("#form-inq-donor-relations").submit(function(){
					jQuery(this).find('input:not(input.save)').attr('name', '');
					jQuery(this).find('select:not(select.save)').attr('name', '');
					return true;
				});
			});
		//-->
		</script>
	</div>
		
		<div id="tabs-4">
			<form id="form-inq-donor-settings" method="post">
			<table class="wp-list-table widefat fixed" cellspacing="0" border="0">
			<thead>
				<tr>
                	<th>General Settings</th>
                </tr>
            </thead>
            <tbody>
				<tr>
					<td>
						<div class="left-form">
							<label>Help for Examine a program</label>
							<textarea id="settings-hfeap" name="settings[hfeap]" cols="100" rows="2"><?php echo $settings['hfeap']; ?></textarea>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div class="left-form">
							<label>Help for Compare outcome by programs</label>
							<textarea id="settings-hfeap" name="settings[hfcobp]" cols="100" rows="2"><?php echo $settings['hfcobp']; ?></textarea>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div class="left-form">
							<label>Select Program:</label>
							<textarea id="settings-hfeap" name="settings[hfma][0]" cols="100" rows="2"><?php echo $settings['hfma'][0]; ?></textarea>
						</div>
						<div class="left-form">
							<label>Select Outcome:</label>
							<textarea id="settings-hfeap" name="settings[hfma][1]" cols="100" rows="2"><?php echo $settings['hfma'][1]; ?></textarea>
						</div>
						<div class="left-form">
							<label>What was the method used?</label>
							<textarea id="settings-hfeap" name="settings[hfma][2]" cols="100" rows="2"><?php echo $settings['hfma'][2]; ?></textarea>
						</div>
						<div class="left-form">
							<label>Was the study blinded?</label>
							<textarea id="settings-hfeap" name="settings[hfma][3]" cols="100" rows="2"><?php echo $settings['hfma'][3]; ?></textarea>
						</div>
						<div class="left-form">
							<label>Fixed or random effects?</label>
							<textarea id="settings-hfeap" name="settings[hfma][4]" cols="100" rows="2"><?php echo $settings['hfma'][4]; ?></textarea>
						</div>
					</td>
				</tr>
			</tbody>
			</table>
			<input value="Save" type="submit" class="button-primary" name="SaveSettings" />
			</form>
		</div>
	</div>
	<script type="text/javascript">
	//<!--
		jQuery(document).ready(function(){
			<?php if( isset($_POST['program']) || isset($_POST['outcome']) || isset($_POST['relations']) ): ?>
			jQuery("#notifications .updated-inq").show();
			<?php endif; ?>
			jQuery("#tabs").tabs();
			<?php if( isset($_POST['outcome']) ): ?>
			jQuery("#tabs ul li:nth-child(2) a").trigger('click');
			<?php elseif( isset($_POST['relations']) ): ?>
			jQuery("#tabs ul li:nth-child(3) a").trigger('click');
			<?php elseif( isset($_POST['settings']) ): ?>
			jQuery("#tabs ul li:nth-child(4) a").trigger('click');
			<?php endif; ?>
		});
	//-->
	</script>                                                                                     ./donor-programs/templates/template-front-end.php                                                   0000775 0001750 0000041 00000004156 12174327512 021655  0                                                                                                    ustar   alex                            www-data                                                                                                                                                                                                               <?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
	<?php if( count($list_of_selection) ): ?>
	<div class="metaanalyses donors">
		<div class="top-part">
			<div class="step-one">
				<p class="title"><?php echo $labels['label_title']; ?></p>
				<?php if( $help ): ?>
				<a href="javascript:;" class="question" title="<?php print_r($help); ?>"></a>
				<?php endif; ?>
				<div class="fun-area">
					<div class="wpsc_variation_forms">
						<div class="list-box">
							<div class="list-val"><?php echo $labels['select_default']; ?></div>
							<div class="wrap-list">
								<ul class="select-list">
									<?php for( $i=0; $i<count($list_of_selection); $i++ ): ?>
									<li rel="<?php echo $list_of_selection[$i]['id']; ?>"><?php echo $list_of_selection[$i]['name']; ?></li>
									<?php endfor; ?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
			
		<div class="mid-part">
			<div class="result">
				<div class="result-in">
					<!-- RESULTS -->
				</div>	
			</div>
		</div>

		

	</div>
	<script type="text/javascript">
	//<!--
		jQuery(document).ready(function(){
			jQuery(".list-box .list-val").click(function(){
				jQuery(this).addClass('exp').next().addClass('active').show();
				jQuery(this).bind( "clickoutside", function(event){
				jQuery(this).removeClass('exp').next().removeClass('active').hide();
				});
			});

			jQuery(".list-box ul.select-list li").click(function(){
				if( jQuery('.list-val').html() != jQuery(this).html() ){
					jQuery('.list-val').html(jQuery(this).html());

					jQuery.post('<?php echo(admin_url('admin-ajax.php')); ?>', {action:'my_special_action',selection:'<?php echo strtolower($labels['column_title']); ?>',selectionid:jQuery(this).attr('rel')},
					function(answer){
						jQuery(".mid-part div.result div.result-in").html(answer).parent().show('slow');
						return true;
					});
				}
				jQuery(this).closest('div.active').removeClass('active').hide().prev().removeClass('exp');
			});
			
			jQuery('div.step-one a').powerTip({placement: 'n'});
		});
	//-->
	</script>
	<?php endif; ?>
                                                                                                                                                                                                                                                                                                                                                                                                                  ./donor-programs/templates/template-front-end-populate-bibinfo.php                                  0000775 0001750 0001750 00000005356 12174331071 024316  0                                                                                                    ustar   alex                            alex                                                                                                                                                                                                                   
<?php
//if( array_key_exists('bibindex',$data)): 
       	$bibdb_obj = new getbibinfofromdatabase();
        $bibindexarray = $data['bibindex'];;
	$bibdata = $bibdb_obj->get_bibdata($bibindexarray);


function populate_bibup($bibdata){
	?>
	<div class="bibliography-up" style="padding: 0 0 10px 0;">
	<!-- Output bibligraphic data -->
	<p id="bibtoggle" class="title-effects"style="clear:right;float:right"><a href="javascript:;" class="question"></a> Show/hide studies </p>
	<?php foreach($bibdata as $bibitem):?>	            
		<p class="bibentry" <?php echo 'id=bib'.$bibitem['entries_id'] ?>>        
		<i><?php echo $bibitem['cite_key'] ?></i>
		</p>
	<?php endforeach; ?>			
	</div>
	<?php
}

function populate_bibdetails($bibdb_obj, $bibindexarray, $bibdata){
	?><div class="spacer"></div><?php
	$data = $bibdb_obj->get_paper_data($bibindexarray);
	$template =  'programs';
	$selection_name = '';

	foreach($data as $i=>$item){
        	$data[$i]['name'] = $bibdata[$i]['cite_key'];
                }


	?>
	<div class="spacer"></div>
	<div class="bibentrydetail"></div>
	<div class="spacer"></div>
	<?php

	include 'template-front-end-results.php';
}	
?>





	<div class="bibligraphy">
                <p class="bibligraphy" style="clear:both">              
 
                <div class="biblist">
		<?php foreach($bibdata as $bibitem): ?>
	        <div class="bibentrylong"  <?php echo 'id=bib'.$bibitem['entries_id'] ?> style="clear:both; display:none"> 
			<p class="author">
			<?php echo $bibitem['author']; echo " (".$bibitem['year'].")";?>
			</p>
			<p class="title">
			<?php echo $bibitem['title'] ?>	
			</p>
      		</div>    
		<?php endforeach; ?>
		</div>
	</div>

<?php// endif; ?> 

<!--	<p id="getmore" class="title-effects"style="clear:right;float:right"><a href="javascript:;" class="question"></a> Show more! </p>
-->




<script type="text/javascript">
jQuery(document).ready(function() {
	jQuery('#getmore').click(function() {
		jQuery('.bibdetailsfurther').toggle();
	});

});

</script>

<script type="text/javascript">
	function ajax_studies_by_paper(){
		};
</script>




<script type="text/javascript">
jQuery(document).ready(function() {
	jQuery('#bibtoggle').click(function() {
		jQuery('.bibentrydetail').toggle();
	});
});
</script>


<script type="text/javascript">
jQuery('.bibentry').mouseover(function() {
jQuery('.bibentrydetail').html(jQuery('.bibentrylong#'+this.id).html());	
});

</script>

<!--
<div class="bibtest" style="display:none; background:white">
	<p class="bibentry" style="clear:both">
		<p class="author">
                <?php //echo $bibitem['author']; echo " (".$bibitem['year'].")";?>
                </p>
                <p class="title">
                <?php //echo $bibitem['title'] ?>
                </p>
	</p>
</div>
-->

                                                                                                                                                                                                                                                                                  ./donor-programs/templates/template-front-end-results-bibinfo.php                                   0000775 0001750 0000041 00000004766 12174313151 024763  0                                                                                                    ustar   alex                            www-data                                                                                                                                                                                                               <?php
if( array_key_exists('bibindex',$data)): 
       	$bibdb_obj = new getbibinfofromdatabase();
        $bibindexarray = $data['bibindex'];;
	$bibdata = $bibdb_obj->get_bibdata($bibindexarray);

?>

	<div class="bibliography-up" style="padding: 0 0 10px 0;">
	<!-- Output bibligraphic data -->
	<p id="bibtoggle" class="title-effects"style="clear:right;float:right"><a href="javascript:;" class="question"></a> Show/hide studies </p>
	<?php foreach($bibdata as $bibitem):?>	            
		<p class="bibentry" <?php echo 'id=bib'.$bibitem['entries_id'] ?>>        
		<i><?php echo $bibitem['cite_key'] ?></i>
		</p>
	<?php endforeach; ?>			
	</div>

	<div class="bibligraphy">
                <p class="bibligraphy" style="clear:both">              
 
                <div class="biblist">
		<?php foreach($bibdata as $bibitem): ?>
	        <div class="bibentrylong"  <?php echo 'id=bib'.$bibitem['entries_id'] ?> style="clear:both; display:none"> 
			<p class="author">
			<?php echo $bibitem['author']; echo " (".$bibitem['year'].")";?>
			</p>
			<p class="title">
			<?php echo $bibitem['title'] ?>	
			</p>
      		</div>    
		<?php endforeach; ?>
		</div>
	</div>

<?php endif; ?> 

<!--	<p id="getmore" class="title-effects"style="clear:right;float:right"><a href="javascript:;" class="question"></a> Show more! </p>
-->




<script type="text/javascript">
jQuery(document).ready(function() {
	jQuery('#getmore').click(function() {
		jQuery('.bibdetailsfurther').toggle();
	});

});

</script>


<script type="text/javascript">
jQuery(document).ready(function() {
	jQuery('#bibtoggle').click(function() {
		jQuery('.bibentrydetail').toggle();
	});
});
</script>


<script type="text/javascript">
jQuery('.bibentry').mouseover(function() {
jQuery('.bibentrydetail').html(jQuery('.bibentrylong#'+this.id).html());	
});

</script>


<div class="bibtest" style="display:none; background:white">
	<p class="bibentry" style="clear:both">
		<p class="author">
                <?php echo $bibitem['author']; echo " (".$bibitem['year'].")";?>
                </p>
                <p class="title">
                <?php echo $bibitem['title'] ?>
                </p>
	</p>
</div>


<?php


//echo get_results( $bibdb_obj->get_paper_data($bibindexarray), 'programs','');

?>

<!--
<div class="bibligraphy">
                <p class="bibligraphy" style="clear:both">              
 
                <p id="bibtoggle" class="title-effects"style="clear:both"> Click to hide studies </p>   
                <div class="biblist">
		

		</div>
</div>
-->

          ./donor-programs/includes/                                                                          0000775 0001750 0000041 00000000000 12174327102 015231  5                                                                                                    ustar   alex                            www-data                                                                                                                                                                                                               ./donor-programs/includes/get-bibinfo-from-database.class.php                                       0000775 0001750 0000041 00000003443 12174327102 023745  0                                                                                                    ustar   alex                            www-data                                                                                                                                                                                                               <?php


class getbibinfofromdatabase{
        private $plugin_suffix = "donor_";
        private $table_prefix = null;

        public function __construct() {
		global $wpdb;
                $this->table_prefix = $wpdb->prefix.$this->plugin_suffix;

        }
	
	public function get_table_prefix(){
                return $this->table_prefix;
        }
 


	public function get_bibdata($bibindexarray){
		global $wpdb;	
		$bibref_columnid = "entries_id";
		$bibstring = implode(',',$bibindexarray);	

		# For each bibindex array get the appropriate row in the bibindex table
		$where_clause = "WHERE
					    ".$this->table_prefix."program_bibinfo.entries_id IN ($bibstring)";

		$from = "author, title, journal, cite_key, year, entries_id"; 

		$sql = $wpdb->prepare("SELECT ".$from." "." 

					FROM ".$this->table_prefix."program_bibinfo");
//		print_r($sql." ".$where_clause);
		$result = $wpdb->get_results( $sql." ".$where_clause, ARRAY_A);
 

		if (!result) {
			echo 'No bibligraphic data found: ' . mysql_error();
			exit;
		}
		
//		print_r($result);
		return $result?$result:null;

	}
	
	public function get_paper_data($bibindexarray) {

	// Constuct an array like 'data' 
		$result = null;
		$bibstring = implode(',',$bibindexarray);	
                if( $bibindexarray ){
                        global $wpdb;

		$select = "id, lower, mean, upper, unit"; 
		$from = $this->table_prefix."outcome_values";
		$where=$this->table_prefix."outcome_values.id IN ($bibstring)";
                        $sql = $wpdb->prepare("SELECT " .$select." FROM ".$from." WHERE ".$where);
                        $result = $wpdb->get_results($sql, ARRAY_A);

		foreach($result as $i=>$item){
			$result[$i]['name'] = md5(uniqid(rand(), true))
;

		}
		unset($item);
		return $result?$result:null;


                }



	}



}


?>
                                                                                                                                                                                                                             ./donor-programs/includes/get-info-from-database.class.php                                          0000775 0001750 0000041 00000043414 12174037003 023270  0                                                                                                    ustar   alex                            www-data                                                                                                                                                                                                               <?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class getinfofromdatabase{
	private $plugin_sufix = "donor_";
	private $table_prefix = null;

	public function __construct() {
		global $wpdb;
		$this->table_prefix = $wpdb->prefix.$this->plugin_sufix;
	}
	
	public function get_table_prefix(){
		return $this->table_prefix;
	}
	
	public function get_programs($all = true, $is_meta_app =  false){
		global $wpdb;
		if(!$all){
			if( $is_meta_app ){
				$where_clause = "WHERE 1=1";
			}
			else{
				$where_clause = "WHERE
								".$this->table_prefix."outcome_values.rflag =  'program-in-select' OR
								".$this->table_prefix."outcome_values.rflag =  'both'";
			}
			$sql = $wpdb->prepare("SELECT
								".$this->table_prefix."programs.id,
								".$this->table_prefix."programs.name
							FROM
								".$this->table_prefix."programs
								Inner Join ".$this->table_prefix."relations ON ".$this->table_prefix."relations.program_id = ".$this->table_prefix."programs.id
								Inner Join ".$this->table_prefix."outcome_values ON ".$this->table_prefix."relations.id = ".$this->table_prefix."outcome_values.relation_id
							".$where_clause."
							GROUP BY
								".$this->table_prefix."programs.id
							ORDER BY
								".$this->table_prefix."programs.name ASC;");
		}
		else{
			$sql = $wpdb->prepare("SELECT
								".$this->table_prefix."programs.id,
								".$this->table_prefix."programs.name
							FROM
								".$this->table_prefix."programs
							ORDER BY
								".$this->table_prefix."programs.name ASC;");
		}
		$result = $wpdb->get_results( $sql, ARRAY_A );
		
		return $result?$result:null;
	}
	
	public function get_outcome_by_program( $program_id = null ){
		$result = null;
		if( $program_id ){
			global $wpdb;
			$sql = $wpdb->prepare("SELECT
									".$this->table_prefix."outcomes.id,
									".$this->table_prefix."outcomes.name
								FROM
									".$this->table_prefix."outcomes
									Inner Join ".$this->table_prefix."relations ON ".$this->table_prefix."relations.outcome_id = ".$this->table_prefix."outcomes.id
									Inner Join ".$this->table_prefix."programs ON ".$this->table_prefix."programs.id = ".$this->table_prefix."relations.program_id
								WHERE
									".$this->table_prefix."programs.id = '".$program_id."'
								GROUP BY
									".$this->table_prefix."outcomes.id
								ORDER BY
									".$this->table_prefix."outcomes.name ASC;");
			//print_r($sql);exit;
			$result = $wpdb->get_results( $sql, ARRAY_A );
		}
		return $result;
	}
	
	public function get_results_by_outcome( $id = null ){
		if( $id ){
			global $wpdb;
			$sql = $wpdb->prepare("SELECT
								".$this->table_prefix."outcomes.name,
								".$this->table_prefix."outcome_values.`lower`,
								".$this->table_prefix."outcome_values.mean,
								".$this->table_prefix."outcome_values.`upper`,
								".$this->table_prefix."outcome_values.unit,
								".$this->table_prefix."outcome_values.bibref,
								".$this->table_prefix."programs.name,
								".$this->table_prefix."programs.link_donate
							FROM
								".$this->table_prefix."outcomes
								Inner Join ".$this->table_prefix."relations ON ".$this->table_prefix."relations.outcome_id = ".$this->table_prefix."outcomes.id
								Inner Join ".$this->table_prefix."outcome_values ON ".$this->table_prefix."outcome_values.relation_id = ".$this->table_prefix."relations.id
								Inner Join ".$this->table_prefix."programs ON ".$this->table_prefix."relations.program_id = ".$this->table_prefix."programs.id
							WHERE
								".$this->table_prefix."outcomes.id = '".$id."' AND 
								( ".$this->table_prefix."outcome_values.rflag = 'outcome-in-select' OR ".$this->table_prefix."outcome_values.rflag = 'both' )
							ORDER BY
								".$this->table_prefix."programs.name ASC;");
			$result = $wpdb->get_results( $sql, ARRAY_A );
			return $result?$result:null;
		}
		else
			return null;
	}
	
	public function get_results_by_program( $id = null ){
		if( $id ){
			global $wpdb;
			$sql = $wpdb->prepare("SELECT
							".$this->table_prefix."outcomes.name,
							".$this->table_prefix."outcome_values.`lower`,
							".$this->table_prefix."outcome_values.mean,
							".$this->table_prefix."outcome_values.`upper`,
							".$this->table_prefix."outcome_values.unit,
							".$this->table_prefix."programs.name AS pname,
							".$this->table_prefix."programs.link_donate,
							".$this->table_prefix."outcome_values.bibref
						FROM
							".$this->table_prefix."outcomes
							Inner Join ".$this->table_prefix."relations ON ".$this->table_prefix."relations.outcome_id = ".$this->table_prefix."outcomes.id
							Inner Join ".$this->table_prefix."outcome_values ON ".$this->table_prefix."outcome_values.relation_id = ".$this->table_prefix."relations.id
							Inner Join ".$this->table_prefix."programs ON ".$this->table_prefix."programs.id = ".$this->table_prefix."relations.program_id
						WHERE
							".$this->table_prefix."programs.id = '".$id."' AND
							( ".$this->table_prefix."outcome_values.rflag = 'program-in-select' OR ".$this->table_prefix."outcome_values.rflag = 'both' )
						ORDER BY
							".$this->table_prefix."outcomes.name;");
			$result = $wpdb->get_results( $sql, ARRAY_A );
			//print_r($sql); Print the mySQL query
			return $result?$result:null;
		}
		else
			return null;
	}
	
	function get_data_for_select( $key = null ){
		$result = null;
		if($key){
			global $wpdb;
			$sql = $wpdb->prepare("SELECT
									".$this->table_prefix."outcomes.id,
									".$this->table_prefix."outcomes.name
								FROM	
									".$this->table_prefix."outcomes
									Inner Join ".$this->table_prefix."relations ON ".$this->table_prefix."outcomes.id = ".$this->table_prefix."relations.outcome_id
									Inner Join ".$this->table_prefix."outcome_values ON ".$this->table_prefix."relations.id = ".$this->table_prefix."outcome_values.relation_id
								WHERE
									".$this->table_prefix."outcome_values.rflag = '".$key."-in-select' OR ".$this->table_prefix."outcome_values.rflag = 'both'
								GROUP BY
									".$this->table_prefix."outcomes.id
								ORDER BY
									".$this->table_prefix."outcomes.name ASC");
			$result = $wpdb->get_results( $sql, ARRAY_A );
		}
		return $result?$result:null;
	}
	
	function get_name_by_id( $id = null, $table_name = '' ){
		if( $id && $table_name ){
			global $wpdb;
			$sql = $wpdb->prepare("SELECT ".$this->table_prefix."".$table_name.".name FROM ".$this->table_prefix."".$table_name." WHERE ".$this->table_prefix."".$table_name.".id = '".$id."';");
			return $wpdb->get_var($sql);
		}
		else
			return false;
	}
	
	function get_total_studies_by_criteria( $selection = array() ){
		global $wpdb;
		$clause_where = "";
		foreach ($selection as $key => $selected){
			if( $selected >= 0 ){
				$clause_where .= " AND ".$this->table_prefix."".$key." = '".$selected."'";
			}
		}
		if($clause_where){
			$clause_where = "WHERE 1=1".$clause_where;
		}
		else{
			$clause_where = "WHERE 1=0";
		}
		
		$sql = $wpdb->prepare("SELECT
							SUM(".$this->table_prefix."outcome_values.number_of_studies) as total
						FROM
							".$this->table_prefix."outcomes
							Inner Join ".$this->table_prefix."relations ON ".$this->table_prefix."relations.outcome_id = ".$this->table_prefix."outcomes.id
							Inner Join ".$this->table_prefix."outcome_values ON ".$this->table_prefix."outcome_values.relation_id = ".$this->table_prefix."relations.id
							Inner Join ".$this->table_prefix."programs ON ".$this->table_prefix."programs.id = ".$this->table_prefix."relations.program_id
						 ".$clause_where."
						 LIMIT 1;");
		//return $sql;
		return $wpdb->get_var($sql);
	}
	
	function get_results_meta_analysis( $selection = array() ){
		$result = null;
		if( $selection ){
			global $wpdb;
			$sql = $wpdb->prepare("SELECT 
								".$this->table_prefix."outcomes.name,
								".$this->table_prefix."outcome_values.`lower`,
								".$this->table_prefix."outcome_values.mean,
								".$this->table_prefix."outcome_values.`upper`,
								".$this->table_prefix."outcome_values.unit,
								".$this->table_prefix."programs.link_donate,
								".$this->table_prefix."programs.name AS prog_name
							FROM 
								".$this->table_prefix."outcomes 
								Inner Join ".$this->table_prefix."relations ON ".$this->table_prefix."relations.outcome_id = ".$this->table_prefix."outcomes.id 
								Inner Join ".$this->table_prefix."outcome_values ON ".$this->table_prefix."outcome_values.relation_id = ".$this->table_prefix."relations.id 
								Inner Join ".$this->table_prefix."programs ON ".$this->table_prefix."programs.id = ".$this->table_prefix."relations.program_id 
							WHERE 
								".$this->table_prefix."relations.program_id = '".$selection['program_id']."' AND 
								".$this->table_prefix."relations.outcome_id = '".$selection['outcome_id']."' AND 
								".$this->table_prefix."outcome_values.randomized_filter = '".$selection['method']."' AND 
								".$this->table_prefix."outcome_values.blinded_filter = '".$selection['blinded']."' AND 
								".$this->table_prefix."outcome_values.effects = '".$selection['effect']."'
							LIMIT 1;");
			$result = $wpdb->get_results($sql, ARRAY_A);
		}

		// Generate a random number to use as the bibref
		$numbers = range(1,200);
		shuffle($numbers);
		$numstudies = 5;
		$result['bibindex'] = array_slice($numbers,0,$numstudies);
		include 'get-bibinfo-from-database.class.php';

		return $result;
	}

	
	function admin_get_programs(){
		global $wpdb;
		$sql = $wpdb->prepare("SELECT
								*
							FROM
								".$this->table_prefix."programs 
							ORDER BY
								".$this->table_prefix."programs.id ASC;");
		return $wpdb->get_results( $sql, ARRAY_A );
	}
	
	function save_programs( $data = null ){
		if( $data ){
			global $wpdb;
			reset($data);
			for( $i=0; $i<count($data); $i++ ){
				$programs[$i] = current($data);
				if( isset($programs[$i]['remove']) && $programs[$i]['remove'] == 'on' ){
					$this->remove_program( $programs[$i]['id'], $wpdb );
				}
				elseif( isset($programs[$i]['id']) ){
					$sql = $wpdb->prepare( "UPDATE ".$this->table_prefix."programs SET name='".$programs[$i]['name']."', link_donate='".$programs[$i]['link_donate']."' WHERE id='".$programs[$i]['id']."';" );
					$resp = $wpdb->query( $sql );
				}
				elseif( trim($programs[$i]['name']) ){
					$sql = $wpdb->prepare( "INSERT INTO " . $this->table_prefix . "programs VALUES ( '', '".$programs[$i]['name']."', '".$programs[$i]['link_donate']."' );" );
					$resp = $wpdb->query( $sql );
				}
				next($data);
			}
		}
	}
	
	private function remove_program( $id = null, $wpdb =  null ){
		if($id && $wpdb){
			$sql = $wpdb->prepare("DELETE FROM ".$this->table_prefix."programs WHERE id='".$id."';");
			$resp = $wpdb->query( $sql );
			$resp2 = false;
			$resp3 = false;
			if( $resp ){
				$sql = $wpdb->prepare("UPDATE ".$this->table_prefix."outcomes SET program_id='0' WHERE program_id='".$id."';");
				$resp2 = $wpdb->query( $sql );
				if( $resp2 ){
					$sql = $wpdb->prepare("UPDATE ".$this->table_prefix."relations SET program_id='0' WHERE program_id='".$id."';");
					$resp3 = $wpdb->query( $sql );
				}
			}
			return ($resp&&$resp2&&$resp3)?true:false;
		}
		else{
			return false;
		}
	}
	
	function admin_get_outcome(){
		global $wpdb;
		$sql = $wpdb->prepare("
							SELECT
								*
							FROM
								".$this->table_prefix."outcomes
							ORDER BY
								".$this->table_prefix."outcomes.id ASC;");
		return $wpdb->get_results( $sql, ARRAY_A );
	}
	
	function save_outcome( $data = null ){
		if( $data ){
			global $wpdb;
			reset($data);
			for( $i=0; $i<count($data); $i++ ){
				$outcome[$i] = current($data);
				if( isset($outcome[$i]['remove']) && $outcome[$i]['remove'] == 'on' ){
					$this->remove_outcome( $outcome[$i]['id'], $wpdb );
				}
				elseif( isset($outcome[$i]['id']) ){
					$sql = $wpdb->prepare( "UPDATE ".$this->table_prefix."outcomes SET name='".trim($outcome[$i]['name'])."' WHERE id='".$outcome[$i]['id']."';" );
					$resp = $wpdb->query( $sql );
				}
				elseif( trim($outcome[$i]['name']) ){
					$sql = $wpdb->prepare( "INSERT INTO " . $this->table_prefix . "outcomes VALUES ( '', '".trim($outcome[$i]['name'])."' );" );
					$resp = $wpdb->query( $sql );
				}
				next($data);
			}
			$outcome = null;
		}
	}
	
	private function remove_outcome( $id = null, $wpdb =  null ){
		if($id && $wpdb){
			$sql = $wpdb->prepare("DELETE FROM ".$this->table_prefix."outcomes WHERE id='".$id."'");
			$resp = $wpdb->query( $sql );
			return ($resp)?true:false;
		}
		else{
			return false;
		}
	}
	
	function admin_get_outcome_values( $relation_id = null ){
		global $wpdb;
		$sql = $wpdb->prepare("SELECT
						".$this->table_prefix."outcome_values.id,
						".$this->table_prefix."outcome_values.relation_id,
						".$this->table_prefix."outcome_values.`lower`,
						".$this->table_prefix."outcome_values.mean,
						".$this->table_prefix."outcome_values.`upper`,
						".$this->table_prefix."outcome_values.unit,
						".$this->table_prefix."outcome_values.randomized_filter,
						".$this->table_prefix."outcome_values.blinded_filter,
						".$this->table_prefix."outcome_values.effects,
						".$this->table_prefix."outcome_values.rflag,
						".$this->table_prefix."outcome_values.number_of_studies
					FROM
						".$this->table_prefix."outcome_values
						Inner Join ".$this->table_prefix."relations ON ".$this->table_prefix."outcome_values.relation_id = ".$this->table_prefix."relations.id
					WHERE
						".$this->table_prefix."relations.id = '".$relation_id."';");
		$resp = $wpdb->get_results( $sql, ARRAY_A );
		$resp = $outcome_id?$resp[0]:$resp;
		return $resp;
	}
	
	
	private function save_outcome_values( $data = null, $relation_id = null, $wpdb = null ){
		reset($data);
		for($i=0; $i<count($data); $i++){
			$outcome_values[$i] = current($data);
			if( isset($outcome_values[$i]['remove']) && $outcome_values[$i]['remove'] == 'on' ){
				$this->remove_outcome_values($outcome_values[$i]['id'], null, $wpdb);
			}
			if( isset($outcome_values[$i]['id']) && isset($outcome_values[$i]['relation_id']) ){
				$sql = $wpdb->prepare( "UPDATE ".$this->table_prefix."outcome_values 
									SET 
										lower='".trim($outcome_values[$i]['lower'])."', 
										mean='".$outcome_values[$i]['mean']."', 
										upper='".$outcome_values[$i]['upper']."', 
										unit='".$outcome_values[$i]['unit']."', 
										randomized_filter='".$outcome_values[$i]['randomized_filter']."', 
										blinded_filter='".$outcome_values[$i]['blinded_filter']."', 
										effects='".$outcome_values[$i]['effects']."', 
										rflag='".(($outcome_values[$i]['rflag']==1)?'both':0)."',
										number_of_studies='".$outcome_values[$i]['number_of_studies']."'
									WHERE id='".$outcome_values[$i]['id']."' AND relation_id='".$relation_id."';" );
				$resp = $wpdb->query( $sql );
			}
			else if( $relation_id ){
				$sql = $wpdb->prepare( "INSERT INTO ".$this->table_prefix."outcome_values 
									VALUES ( 
											'', 
											'".$relation_id."', 
											'".trim($outcome_values[$i]['lower'])."', 
											'".$outcome_values[$i]['mean']."', 
											'".$outcome_values[$i]['upper']."', 
											'".$outcome_values[$i]['unit']."',
											'".$outcome_values[$i]['randomized_filter']."',
											'".$outcome_values[$i]['blinded_filter']."',
											'".$outcome_values[$i]['effects']."',
											'".(($outcome_values[$i]['rflag']==1)?'both':0)."',
											'".$outcome_values[$i]['number_of_studies']."'
									);");
				$resp = $wpdb->query( $sql );
			}
			next($data);
		}
		return $resp;
	}
	
	private function remove_outcome_values( $id = null, $relation_id = null, $wpdb =  null ){
		if($relation_id && $wpdb){
			$sql = $wpdb->prepare("DELETE FROM ".$this->table_prefix."outcome_values WHERE relation_id='".$relation_id."'");
			$resp = $wpdb->query( $sql );
			return $resp?true:false;
		}
		else if( $id && $wpdb ){
			$sql = $wpdb->prepare("DELETE FROM ".$this->table_prefix."outcome_values WHERE id='".$id."'");
			$resp = $wpdb->query( $sql );
			return $resp?true:false;
		}
		else{
			return false;
		}
	}
	
	function admin_get_relations(){
		global $wpdb ;
		$sql = $wpdb->prepare("SELECT
								".$this->table_prefix."relations.id,
								".$this->table_prefix."relations.program_id,
								".$this->table_prefix."relations.outcome_id
							FROM
								".$this->table_prefix."relations
							ORDER BY
								".$this->table_prefix."relations.id ASC;");
		
		$resp = $wpdb->get_results( $sql, ARRAY_A );
		return $resp;
	}
	
	function admin_save_relations( $data = null ){
		if($data){
			global $wpdb;
			reset($data);
			for( $i=0; $i<count($data); $i++ ){
				$relations[$i] = current($data);
				//echo '<pre>';print_r( $relations[$i] );echo '</pre>';
				if( isset($relations[$i]['remove']) && $relations[$i]['remove'] == 'on' ){
					$this->admin_remove_relation( $relations[$i]['id'], $wpdb );
				}
				elseif( isset($relations[$i]['id']) ){
					$sql = $wpdb->prepare( "UPDATE ".$this->table_prefix."relations SET program_id='".$relations[$i]['program_id']."', outcome_id='".$relations[$i]['outcome_id']."' WHERE id='".$relations[$i]['id']."';" );
					$resp = $wpdb->query( $sql );
					if( isset( $relations[$i]['outcome_values'] ) ){
						$this->save_outcome_values( $relations[$i]['outcome_values'], $relations[$i]['id'], $wpdb );
					}
				}
				else{
					if( $relations[$i]['program_id'] && $relations[$i]['outcome_id'] ){
						$sql = $wpdb->prepare( "INSERT INTO " . $this->table_prefix . "relations VALUES ( '', '".$relations[$i]['program_id']."', '".$relations[$i]['outcome_id']."' );" );
						$resp = $wpdb->query( $sql );
					}
				}
				next($data);
			}
		}
	}
	
	private function admin_remove_relation( $id, $wpdb ){
		if($id && $wpdb){
			$sql = $wpdb->prepare("DELETE FROM ".$this->table_prefix."relations WHERE id='".$id."'");
			$resp1 = $wpdb->query( $sql );
			$resp2 = false;
			if($resp1){
				$resp2 = $this->remove_outcome_values(null, $id, $wpdb);
			}
			return ($resp&&$resp2)?true:false;
		}
		else{
			return false;
		}
	}
}
?>
                                                                                                                                                                                                                                                    ./donor-programs/db/                                                                                0000775 0001750 0000041 00000000000 12162574630 014017  5                                                                                                    ustar   alex                            www-data                                                                                                                                                                                                               ./donor-programs/db/wp_donor_programs_plugin.sql                                                    0000775 0001750 0000041 00000105305 12162574630 021666  0                                                                                                    ustar   alex                            www-data                                                                                                                                                                                                               -- MySQL dump 10.13  Distrib 5.1.63, for debian-linux-gnu (i486)
--
-- Host: internal-db.s157042.gridserver.com    Database: db157042_aidgradewp
-- ------------------------------------------------------
-- Server version	5.1.55-rel12.6

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `wp_donor_programs`
--

DROP TABLE IF EXISTS `wp_donor_programs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_donor_programs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `link_donate` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_donor_programs`
--

LOCK TABLES `wp_donor_programs` WRITE;
/*!40000 ALTER TABLE `wp_donor_programs` DISABLE KEYS */;
INSERT INTO `wp_donor_programs` VALUES (2,'bed nets','http://localhost/open/wordpress/aidgrade.org/html/donate'),(3,'conditional cash transfers','http://localhost/open/wordpress/aidgrade.org/html/donate'),(4,'deworming','http://localhost/open/wordpress/aidgrade.org/html/donate'),(5,'microfinance','http://localhost/open/wordpress/aidgrade.org/html/donate'),(6,'safe water storage','http://localhost/open/wordpress/aidgrade.org/html/donate'),(7,'school meals','http://localhost/open/wordpress/aidgrade.org/html/donate'),(8,'unconditional cash transfers','http://localhost/open/wordpress/aidgrade.org/html/donate'),(9,'water treatment','http://localhost/open/wordpress/aidgrade.org/html/donate'),(10,'improved stoves','http://localhost/open/wordpress/aidgrade.org/html/donate'),(11,'scholarships','http://localhost/open/wordpress/aidgrade.org/html/donate');
/*!40000 ALTER TABLE `wp_donor_programs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_donor_outcomes`
--

DROP TABLE IF EXISTS `wp_donor_outcomes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_donor_outcomes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_donor_outcomes`
--

LOCK TABLES `wp_donor_outcomes` WRITE;
/*!40000 ALTER TABLE `wp_donor_outcomes` DISABLE KEYS */;
INSERT INTO `wp_donor_outcomes` VALUES (2,'assets'),(3,'attendance rates'),(4,'birthweight'),(5,'consumption'),(6,'diarrhea incidence'),(7,'diarrhea prevalence'),(8,'dysentery'),(9,'enrollment rates'),(10,'height'),(11,'height-for-age'),(12,'hemoglobin'),(13,'labor force participation'),(14,'labor hours'),(15,'malaria'),(16,'malformations'),(17,'mid-upper arm circumference'),(18,'mortality'),(19,'neonatal deaths'),(20,'pregnancy'),(21,'probability of opening business'),(22,'profits'),(23,'retention rates'),(24,'savings'),(25,'skilled attendant at delivery'),(26,'stillbirths'),(27,'test scores'),(28,'unpaid work'),(29,'weight'),(30,'weight-for-age'),(31,'weight-for-height'),(32,'cough'),(33,'chest pain'),(34,'difficulty breathing'),(35,'excessive nasal secretion');
/*!40000 ALTER TABLE `wp_donor_outcomes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_donor_relations`
--

DROP TABLE IF EXISTS `wp_donor_relations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_donor_relations` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `program_id` int(11) NOT NULL,
  `outcome_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=527 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_donor_relations`
--

LOCK TABLES `wp_donor_relations` WRITE;
/*!40000 ALTER TABLE `wp_donor_relations` DISABLE KEYS */;
INSERT INTO `wp_donor_relations` VALUES (3,2,15),(6,2,15),(7,2,15),(8,2,15),(9,2,18),(10,2,18),(11,2,18),(12,2,18),(13,2,18),(14,2,18),(15,2,18),(16,2,18),(17,3,3),(18,3,3),(19,3,3),(20,3,3),(21,3,3),(22,3,3),(23,3,3),(24,3,3),(33,3,9),(34,3,9),(35,3,9),(36,3,9),(37,3,9),(38,3,9),(39,3,9),(40,3,9),(523,4,3),(42,3,13),(43,3,13),(44,3,13),(45,3,13),(46,3,13),(47,3,13),(48,3,13),(49,3,14),(50,3,14),(51,3,14),(52,3,14),(53,3,14),(54,3,14),(55,3,14),(56,3,14),(57,3,20),(58,3,20),(59,3,20),(60,3,20),(61,3,20),(62,3,20),(63,3,20),(64,3,23),(65,3,23),(66,3,23),(67,3,23),(68,3,23),(69,3,23),(70,3,23),(71,3,23),(72,3,23),(73,3,23),(74,3,25),(75,3,25),(76,3,25),(77,3,25),(78,3,25),(80,3,25),(81,3,27),(82,3,27),(83,3,27),(84,3,27),(85,3,27),(86,3,27),(87,3,27),(88,3,27),(89,3,27),(90,3,28),(91,3,28),(92,3,28),(93,3,28),(94,3,28),(95,3,28),(96,3,28),(522,3,28),(98,4,3),(99,4,3),(100,4,3),(101,4,3),(102,4,3),(103,4,3),(104,4,3),(105,4,3),(106,4,3),(107,4,3),(108,4,3),(109,4,4),(110,4,4),(111,4,4),(112,5,22),(113,5,22),(114,4,4),(118,4,4),(119,4,4),(117,4,4),(120,5,22),(121,5,24),(122,5,24),(123,5,24),(124,4,4),(125,5,24),(126,4,4),(127,4,4),(128,5,24),(129,5,24),(130,5,24),(131,4,4),(132,4,4),(133,4,4),(134,5,24),(135,5,24),(136,4,10),(137,5,24),(138,4,10),(139,5,24),(140,4,10),(141,5,24),(143,4,10),(144,4,10),(145,4,10),(146,4,10),(147,6,6),(148,4,10),(149,6,6),(150,6,6),(151,6,6),(152,6,6),(153,4,10),(154,6,6),(155,4,10),(156,6,6),(157,4,10),(158,4,10),(159,6,6),(160,4,11),(161,7,9),(162,4,11),(163,7,9),(164,4,11),(165,4,11),(166,7,9),(167,4,11),(169,4,11),(171,4,11),(173,4,11),(177,7,10),(178,7,10),(179,4,11),(180,7,10),(181,4,11),(182,4,11),(183,7,10),(184,4,11),(185,7,10),(186,4,12),(187,4,12),(188,4,11),(189,4,12),(190,4,12),(191,4,12),(192,4,12),(193,4,12),(194,4,12),(195,4,12),(196,4,12),(197,4,12),(198,4,16),(199,4,16),(200,4,16),(201,4,16),(214,4,17),(215,4,17),(216,4,17),(217,4,17),(219,4,17),(220,4,17),(218,4,17),(222,4,17),(223,4,17),(224,4,17),(225,4,17),(221,4,17),(226,4,19),(227,4,19),(228,4,19),(229,4,19),(230,4,26),(231,4,26),(232,4,26),(233,4,26),(234,4,27),(235,4,27),(236,4,27),(237,4,27),(238,4,27),(239,4,27),(240,4,27),(241,4,27),(242,4,29),(243,4,29),(244,4,29),(245,4,29),(246,4,29),(247,4,29),(248,4,29),(249,4,29),(250,4,29),(252,4,29),(253,4,29),(254,4,29),(255,4,30),(256,4,30),(257,4,30),(258,4,30),(259,4,30),(260,4,30),(261,4,30),(262,4,30),(263,4,30),(264,4,30),(265,4,30),(266,4,30),(271,4,31),(272,4,31),(273,4,31),(270,4,31),(274,4,31),(275,4,31),(276,4,31),(277,4,31),(278,4,31),(279,4,31),(280,4,31),(281,4,31),(282,5,2),(283,5,2),(284,5,2),(285,5,2),(286,5,2),(287,5,2),(288,5,2),(289,5,2),(290,5,2),(291,5,2),(292,5,2),(293,5,2),(306,5,21),(307,5,21),(308,5,21),(309,5,21),(310,5,21),(311,5,21),(312,5,21),(313,5,21),(314,7,10),(315,7,10),(316,7,10),(317,7,10),(318,7,10),(319,7,10),(320,7,10),(321,8,11),(322,7,11),(323,7,11),(324,7,11),(325,7,11),(326,7,11),(327,7,11),(328,7,11),(329,7,11),(330,7,11),(331,7,11),(332,7,11),(333,7,12),(334,7,12),(335,7,12),(336,7,12),(337,7,12),(338,7,12),(339,7,12),(340,7,12),(341,7,12),(342,7,12),(343,7,12),(344,7,12),(345,7,27),(346,7,27),(347,7,27),(348,7,27),(349,7,27),(350,7,27),(351,7,27),(352,7,27),(353,7,27),(354,7,27),(355,7,27),(356,7,27),(357,7,29),(358,7,29),(359,7,29),(360,7,29),(361,7,29),(362,7,29),(363,7,29),(364,7,29),(365,7,29),(366,7,29),(367,7,29),(368,7,30),(369,7,30),(370,7,30),(371,7,30),(372,7,30),(373,7,30),(374,7,30),(375,7,30),(376,7,30),(377,7,30),(378,7,30),(379,7,30),(520,3,25),(521,3,25),(382,7,31),(383,7,31),(384,7,31),(385,7,31),(386,7,31),(387,7,31),(388,7,31),(389,7,31),(390,7,31),(391,7,31),(392,8,9),(393,8,9),(394,8,9),(395,8,9),(396,8,9),(397,8,9),(398,8,9),(401,8,27),(400,8,27),(402,8,27),(403,8,27),(404,8,27),(405,8,27),(406,8,27),(407,8,27),(408,9,6),(409,9,6),(410,9,6),(411,9,6),(412,9,6),(413,9,6),(442,9,7),(415,9,6),(441,9,7),(440,9,7),(436,9,7),(437,9,7),(420,9,6),(435,9,7),(438,9,7),(439,9,7),(424,9,8),(425,9,8),(426,9,8),(427,9,8),(428,9,8),(429,9,8),(430,9,8),(431,9,8),(443,10,33),(444,10,33),(445,10,33),(446,10,33),(447,10,33),(448,10,33),(449,10,33),(450,10,33),(451,10,32),(452,10,32),(453,10,32),(454,10,32),(455,10,32),(456,10,32),(457,10,32),(458,10,32),(459,10,34),(460,10,34),(461,10,34),(462,10,34),(463,10,34),(464,10,34),(465,10,34),(466,10,34),(467,10,35),(468,10,35),(469,10,35),(470,10,35),(471,10,35),(472,10,35),(473,10,35),(474,10,35),(475,11,3),(476,11,3),(477,11,3),(478,11,3),(479,11,3),(480,11,3),(481,11,3),(482,11,3),(483,11,3),(484,11,3),(485,11,3),(486,11,3),(487,11,9),(488,11,9),(489,11,9),(490,11,9),(491,11,9),(492,11,9),(493,11,9),(494,11,9),(495,11,9),(496,11,9),(497,11,9),(498,11,9),(500,11,27),(501,11,27),(502,11,27),(503,11,27),(504,11,27),(505,11,27),(506,11,27),(507,11,27),(508,11,27),(509,11,27),(510,11,27),(511,11,27),(512,7,9),(513,7,9),(514,7,9),(515,7,9),(516,7,9),(517,7,9),(518,7,9),(526,5,5),(524,7,9),(525,8,9);
/*!40000 ALTER TABLE `wp_donor_relations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wp_donor_outcome_values`
--

DROP TABLE IF EXISTS `wp_donor_outcome_values`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_donor_outcome_values` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `relation_id` int(11) NOT NULL,
  `lower` float DEFAULT '0',
  `mean` float DEFAULT '1',
  `upper` float DEFAULT '2',
  `unit` varchar(255) DEFAULT NULL,
  `randomized_filter` tinyint(4) NOT NULL DEFAULT '0',
  `blinded_filter` tinyint(4) NOT NULL DEFAULT '0',
  `effects` tinyint(4) NOT NULL DEFAULT '0',
  `rflag` varchar(55) DEFAULT NULL,
  `number_of_studies` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=552 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wp_donor_outcome_values`
--

LOCK TABLES `wp_donor_outcome_values` WRITE;
/*!40000 ALTER TABLE `wp_donor_outcome_values` DISABLE KEYS */;
INSERT INTO `wp_donor_outcome_values` VALUES (2,3,0.42,0.59,0.84,'(risk ratio)',0,2,0,'0',7),(3,6,0.62,0.7,0.78,'(risk ratio)',0,2,1,'0',7),(4,7,0.42,0.59,0.84,'(risk ratio) ',2,2,0,'0',7),(5,8,0.62,0.7,0.78,'(risk ratio) ',2,2,1,'both',7),(511,9,0.76,0.81,0.87,'(rate ratio) ',1,0,0,'0',4),(512,10,0.76,0.81,0.87,'(rate ratio) ',1,0,1,'0',4),(518,16,0.76,0.81,0.87,'(rate ratio) ',2,2,0,'0',4),(517,15,0.76,0.81,0.87,'(rate ratio) ',2,0,1,'0',4),(516,14,0.76,0.81,0.87,'(rate ratio) ',2,0,0,'0',4),(515,13,0.76,0.81,0.87,'(rate ratio) ',1,2,1,'0',4),(514,12,0.76,0.81,0.87,'(rate ratio) ',1,2,0,'0',4),(513,11,0.76,0.81,0.87,'(rate ratio) ',1,0,1,'0',4),(14,17,-1.2,6.18,13.56,'percentage points ',0,0,0,'0',3),(15,18,2.09,3.21,4.33,'percentage points ',0,0,1,'0',3),(16,19,-1.2,6.18,13.56,'percentage points ',0,2,0,'0',3),(17,20,2.09,3.21,4.33,'percentage points ',0,2,1,'0',3),(18,21,-1.2,6.18,13.56,'percentage points ',2,0,0,'0',3),(19,22,2.09,3.21,4.33,'percentage points ',2,0,1,'0',3),(20,23,-1.2,6.18,13.56,'percentage points ',2,2,0,'0',3),(21,24,2.09,3.21,4.33,'percentage points ',2,2,1,'both',3),(30,33,1.51,3.67,5.83,'percentage points ',0,0,0,'0',7),(31,34,1.1,1.52,1.94,'percentage points ',0,0,1,'0',7),(32,35,1.51,3.67,5.83,'percentage points ',0,2,0,'0',7),(33,36,1.1,1.52,1.94,'percentage points ',0,2,1,'0',7),(34,37,1.51,3.67,5.83,'percentage points ',2,0,0,'0',7),(35,38,1.1,1.52,1.94,'percentage points ',2,0,1,'0',7),(36,39,1.51,3.67,5.83,'percentage points ',2,2,0,'0',7),(37,40,1.1,1.52,1.94,'percentage points ',2,2,1,'both',7),(39,42,-7.83,-4.81,-1.78,'percentage points ',0,0,0,'0',5),(40,43,-5.67,-4.43,-3.2,'percentage points ',0,0,1,'0',5),(41,44,-7.83,-4.81,-1.78,'percentage points ',0,2,0,'0',5),(42,45,-5.67,-4.43,-3.2,'percentage points ',0,2,1,'0',5),(43,46,-7.83,-4.81,-1.78,'percentage points ',2,0,0,'0',5),(44,47,-7.83,-4.81,-1.78,'percentage points ',2,2,0,'0',5),(45,48,-5.67,-4.43,-3.2,'percentage points ',2,2,1,'both',5),(46,49,-4.86,-3.55,-2.23,'hours ',0,0,0,'0',2),(47,50,-4.7,-3.51,-2.32,'hours',0,0,1,'0',2),(48,51,-4.86,-3.55,-2.23,'hours ',0,2,0,'0',2),(49,52,-4.7,-3.51,-2.32,'hours ',0,2,1,'0',2),(50,53,-4.86,-3.55,-2.23,'hours ',2,0,0,'0',2),(51,54,-4.7,-3.51,-2.32,'hours ',2,0,1,'0',2),(52,55,-4.86,-3.55,-2.23,'hours ',2,2,0,'0',2),(53,56,-4.7,-3.51,-2.32,'hours ',2,2,1,'both',2),(54,57,-2.48,-0.88,0.71,'percentage points ',0,0,0,'0',3),(55,58,-2.48,-0.88,0.71,'percentage points ',0,0,1,'0',3),(56,59,-2.48,-0.88,0.71,'percentage points ',0,2,0,'0',3),(57,60,-2.48,-0.88,0.71,'percentage points ',0,2,1,'0',3),(58,61,-2.48,-0.88,0.71,'percentage points ',2,0,0,'0',3),(59,62,-2.48,-0.88,0.71,'percentage points ',2,0,1,'0',3),(60,63,-2.48,-0.88,0.71,'percentage points ',2,2,1,'both',3),(61,64,-2.73,-1.05,0.64,'percentage points ',0,0,0,'0',4),(62,65,-0.22,0.19,0.6,'percentage points ',0,0,1,'0',4),(63,66,-2.73,-1.05,0.64,'percentage points ',0,2,0,'0',4),(64,67,-0.22,0.19,0.6,'percentage points ',0,2,1,'0',4),(65,68,-2.73,-1.05,0.64,'percentage points ',2,0,0,'0',4),(66,69,-0.22,0.19,0.6,'percentage points ',2,0,1,'0',4),(67,70,-2.73,-1.05,0.64,'percentage points ',2,2,0,'0',4),(68,71,-0.22,0.19,0.6,'percentage points ',2,2,1,'both',4),(69,72,0,0.13,0.26,'percentage points ',0,0,0,'0',2),(70,73,0,0.13,0.26,'percentage points ',0,0,1,'0',2),(71,74,0.28,13.05,25.82,'percentage points ',0,0,0,'0',2),(72,75,0.28,13.05,25.82,'percentage points ',0,0,1,'0',2),(73,76,0.28,13.05,25.82,'percentage points ',0,2,0,'0',2),(74,77,0.28,13.05,25.82,'percentage points ',0,2,1,'0',2),(75,78,0.28,13.05,25.82,'percentage points ',2,0,0,'0',2),(77,80,0.28,13.05,25.82,'percentage points ',2,0,1,'0',2),(78,81,-0.12,-0.02,0.07,'standard deviations ',0,0,0,'0',2),(79,82,-0.07,-0.07,-0.06,'standard deviations ',0,0,1,'0',2),(80,83,-0.12,-0.02,0.07,'standard deviations ',0,2,0,'0',2),(81,84,-0.07,-0.07,-0.06,'standard deviations ',0,2,1,'0',2),(82,85,-0.12,-0.02,0.07,'standard deviations ',2,0,0,'0',2),(83,86,-0.07,-0.07,-0.06,'standard deviations ',2,0,1,'0',2),(84,87,-0.12,-0.02,0.07,'standard deviations ',2,2,0,'0',2),(85,88,-0.07,-0.07,-0.06,'standard deviations ',2,2,1,'both',2),(86,89,1.51,8.6,15.69,'percentage points ',0,0,0,'0',1),(87,90,1.51,8.6,15.69,'percentage points ',0,0,0,'0',1),(88,91,1.51,8.6,15.69,'percentage points ',0,0,1,'0',1),(89,92,1.51,8.6,15.69,'percentage points ',0,2,0,'0',1),(90,93,1.51,8.6,15.69,'percentage points ',0,2,1,'0',1),(91,94,1.51,8.6,15.69,'percentage points ',2,0,0,'0',1),(92,95,1.51,8.6,15.69,'percentage points ',2,0,1,'0',1),(93,96,1.51,8.6,15.69,'percentage points ',2,2,1,'both',1),(547,521,0.28,13.05,25.82,'percentage points ',2,2,1,'both',2),(95,98,-2.35,4.9,12.15,'percentage points ',1,0,0,'0',1),(96,99,-2.35,4.9,12.15,'percentage points ',1,0,1,'0',1),(97,100,-30.55,-11.1,8.35,'percentage points ',1,1,0,'0',1),(98,101,-30.55,-11.1,8.35,'percentage points ',1,1,1,'0',1),(99,102,-15.25,-0.45,14.34,'percentage points ',1,2,0,'0',2),(100,103,-3.85,2.95,9.74,'percentage points ',1,2,1,'0',2),(101,104,-2.35,4.9,12.15,'percentage points ',2,0,0,'0',1),(102,105,-2.35,4.9,12.15,'percentage points ',2,0,1,'0',1),(103,106,-30.55,-11.1,8.35,'percentage points ',2,1,0,'0',1),(104,107,-30.55,-11.1,8.35,'percentage points ',2,1,1,'0',1),(105,108,-15.25,-0.45,14.34,'percentage points ',2,2,0,'0',2),(106,109,-0.08,0,0.07,'kg ',1,1,0,'0',2),(107,110,-0.08,0,0.07,'kg ',1,1,1,'0',2),(108,111,-0.1,0.02,0.15,'current US$ (in 1000s) ',1,0,1,'0',3),(109,112,-0.26,0.4,1.07,'current US$ ($1,000s) ',1,2,0,'0',3),(110,113,-0.1,0.02,0.15,'current US$ (in 1000s) ',1,2,1,'0',3),(111,114,-0.08,0,0.07,'kg ',1,2,0,'0',2),(113,117,-0.26,0.4,1.07,'current US$ ($1,000s) ',2,0,0,'0',3),(114,118,-0.1,0.02,0.15,'current US$ (in 1000s) ',2,0,1,'0',3),(115,116,-0.08,0,0.07,'kg ',1,2,1,'0',2),(116,119,-0.26,0.4,1.07,'current US$ ($1,000s) ',2,2,0,'0',3),(117,120,-0.1,0.02,0.15,'current US$ (in 1000s) ',2,2,1,'both',3),(118,121,0,0.12,0.25,'current US$ ($1,000s) ',0,0,0,'0',1),(119,122,0,0.12,0.25,'current US$ (in 1000s) ',0,0,1,'0',1),(120,123,0,0.12,0.25,'current US$ ($1,000s) ',0,2,0,'0',1),(121,124,-0.08,0,0.07,'kg ',1,1,0,'0',2),(122,125,0,0.12,0.25,'current US$ (in 1000s) ',0,2,1,'0',1),(123,126,-0.08,0,0.07,'kg ',2,1,0,'0',2),(124,127,-0.08,0,0.07,'kg ',2,1,1,'0',2),(125,128,-0.01,0,0.01,'current US$ ($1,000s) ',1,0,0,'0',2),(126,129,-0.01,0,0.01,'current US$ (in 1000s) ',1,0,1,'0',2),(127,131,-0.08,0,0.07,'kg ',2,2,0,'0',2),(128,132,-0.08,0,0.07,'kg ',2,2,1,'both',2),(129,130,-0.01,0,0.01,'current US$ ($1,000s) ',1,2,0,'0',2),(130,133,-0.4,0.75,1.9,'cm ',1,0,0,'0',4),(131,134,-0.01,0,0.01,'current US$ (in 1000s) ',1,2,1,'0',2),(132,135,-0.03,0.02,0.06,'current US$ ($1,000s) ',2,0,0,'0',3),(133,136,-0.4,0.75,1.9,'cm ',1,0,0,'0',4),(134,137,-0.01,0,0.02,'current US$ (in 1000s) ',2,0,1,'0',3),(135,138,1.52,1.58,1.63,'cm ',1,0,1,'0',4),(136,139,-0.03,0.02,0.06,'current US$ ($1,000s) ',2,2,0,'0',3),(137,140,-0.21,0,0.2,'cm ',1,1,0,'0',3),(138,141,-0.01,0,0.02,'current US$ (in 1000s) ',2,2,1,'both',3),(139,143,-0.15,-0.05,0.05,'cm ',1,1,1,'0',3),(140,144,-0.45,0.44,1.33,'cm ',1,2,0,'0',7),(141,145,1.16,1.21,1.26,'cm ',1,2,1,'0',7),(142,146,-0.4,0.75,1.9,'cm ',2,0,0,'0',4),(522,151,0.58,0.62,0.66,'(rate ratio) ',1,2,1,'0',2),(144,148,1.52,1.58,1.63,'cm ',2,0,1,'0',4),(526,159,0.58,0.62,0.66,'(rate ratio) ',2,2,1,'both',2),(525,156,0.45,0.66,0.99,'(rate ratio) ',2,2,0,'0',2),(524,154,0.58,0.62,0.66,'(rate ratio) ',2,0,1,'0',2),(148,153,-0.21,0,0.2,'cm ',2,1,0,'0',3),(523,152,0.45,0.66,0.99,'(rate ratio) ',2,0,0,'0',2),(519,147,0.45,0.66,0.99,'(rate ratio) ',1,0,0,'0',2),(151,155,-0.15,-0.05,0.05,'cm ',2,1,1,'0',3),(152,157,-0.45,0.44,1.33,'cm ',2,2,0,'0',7),(521,150,0.45,0.66,0.99,'(rate ratio) ',1,2,0,'0',2),(154,158,1.16,1.21,1.26,'cm ',2,2,1,'both',7),(520,149,0.58,0.62,0.66,'(rate ratio) ',1,0,1,'0',2),(156,160,-0.31,0.07,0.45,'z-score ',1,0,0,'0',3),(157,161,0.01,0.04,0.07,'percentage points ',1,0,0,'0',2),(158,162,0.03,0.19,0.35,'z-score ',1,0,1,'0',3),(159,164,-0.38,0.68,1.74,'z-score ',1,1,0,'0',5),(160,163,0.01,0.04,0.07,'percentage points ',1,0,1,'0',2),(161,163,0.01,0.04,0.07,'percentage points ',1,0,1,'0',2),(163,165,0.2,0.29,0.39,'z-score ',1,1,1,'0',5),(164,166,0.66,3.61,6.55,'percentage points ',1,0,0,'0',2),(165,167,-0.25,0.44,1.14,'z-score ',1,2,0,'0',8),(167,169,0.19,0.27,0.35,'z-score ',1,2,1,'0',8),(168,171,-0.31,0.07,0.45,'z-score ',2,0,0,'0',3),(174,177,0.04,0.17,0.3,'cm ',1,0,0,'0',1),(177,178,0.04,0.17,0.3,'cm ',1,0,1,'0',1),(176,173,0.03,0.19,0.35,'z-score ',2,0,1,'0',3),(178,179,-0.38,0.68,1.74,'z-score ',2,1,0,'0',5),(179,180,-0.22,0.06,0.34,'cm ',1,1,0,'0',2),(180,181,0.2,0.29,0.39,'z-score ',2,1,1,'0',5),(181,182,-0.25,0.44,1.14,'z-score ',2,2,0,'0',8),(182,183,-0.05,0.11,0.27,'cm ',1,1,1,'0',2),(185,184,0.19,0.27,0.35,'z-score ',2,2,1,'both',8),(186,185,0.04,0.14,0.25,'cm ',1,2,0,'0',3),(187,186,-0.13,0.24,0.61,'g/dL ',1,0,0,'0',2),(188,187,-0.13,0.24,0.61,'g/dL ',1,0,1,'0',2),(189,188,-0.32,-0.1,0.12,'g/dL ',1,1,0,'0',3),(190,189,-0.07,0,0.07,'g/dL ',1,1,1,'0',3),(191,190,-0.23,-0.04,0.15,'g/dL ',1,2,0,'0',5),(192,191,-0.06,0.01,0.08,'g/dL ',1,2,1,'0',0),(193,192,-0.13,0.24,0.61,'g/dL ',2,0,0,'0',2),(194,193,-0.13,0.24,0.61,'g/dL ',2,0,1,'0',2),(195,194,-0.32,-0.1,0.12,'g/dL ',2,1,0,'0',3),(196,195,-0.07,0,0.07,'g/dL ',2,1,1,'0',3),(197,196,-0.23,-0.04,0.15,'g/dL ',2,2,0,'0',5),(198,197,-0.06,0.01,0.08,'g/dL ',2,2,1,'both',5),(199,198,0.79,1.05,1.38,'(risk ratio) ',0,2,0,'0',2),(200,199,0.79,1.05,1.38,'(risk ratio) ',0,2,1,'0',2),(201,200,0.79,1.05,1.38,'(risk ratio) ',2,2,0,'0',2),(202,201,0.79,1.05,1.38,'(risk ratio) ',2,2,1,'both',2),(215,214,-0.14,0.23,0.6,'cm ',1,0,0,'0',1),(216,215,-0.14,0.23,0.6,'cm ',1,0,1,'0',1),(217,216,-0.49,0.83,2.16,'cm ',1,1,0,'0',3),(218,217,0.34,0.45,0.56,'cm ',1,1,1,'0',3),(219,218,-0.37,0.68,1.74,'cm ',1,2,0,'0',4),(220,219,0.33,0.43,0.53,'cm ',1,2,1,'0',4),(221,220,-0.14,0.23,0.6,'cm ',2,0,0,'0',1),(222,221,-0.14,0.23,0.6,'cm ',2,0,1,'0',1),(223,222,-0.49,0.83,2.16,'cm ',2,1,0,'0',3),(224,223,0.34,0.45,0.56,'cm ',2,1,1,'0',3),(225,224,-0.37,0.68,1.74,'cm ',2,2,0,'0',4),(226,225,0.33,0.43,0.53,'cm ',2,2,1,'both',4),(227,226,0.48,0.81,1.39,'(risk ratio) ',0,2,0,'0',2),(228,227,0.48,0.81,1.39,'(risk ratio) ',0,2,1,'0',2),(229,228,0.48,0.81,1.39,'(risk ratio) ',2,2,0,'0',2),(230,229,0.48,0.81,1.39,'(risk ratio) ',2,2,1,'both',2),(231,230,0.92,1.6,2.8,'(risk ratio) ',0,2,0,'0',2),(232,231,0.92,1.6,2.8,'(risk ratio) ',0,2,1,'0',2),(233,232,0.92,1.6,2.8,'(risk ratio) ',2,2,0,'0',2),(234,233,0.92,1.6,2.8,'(risk ratio) ',2,2,1,'both',2),(235,234,-0.11,0.04,1.44,'standard deviations ',1,1,0,'0',2),(236,235,0.02,0.07,0.12,'standard deviations ',1,1,1,'0',2),(237,236,-0.11,0.04,0.18,'standard deviations ',1,2,0,'0',2),(238,236,0,0,0,'',0,0,0,'0',0),(239,237,0.02,0.07,0.12,'standard deviations ',1,2,1,'0',2),(240,238,-0.11,0.04,0.18,'standard deviations ',2,1,0,'0',2),(241,239,0.02,0.07,0.12,'standard deviations ',2,1,1,'0',2),(242,240,-0.11,0.04,0.18,'standard deviations ',2,2,0,'0',2),(243,241,0.02,0.07,0.12,'standard deviations ',2,2,1,'both',2),(244,242,-0.37,0.53,1.44,'kg ',1,0,0,'0',4),(245,243,1.15,1.21,1.27,'kg ',1,0,1,'0',4),(246,244,-0.11,-0.03,0.05,'kg ',1,1,0,'0',3),(247,245,-0.11,-0.03,0.05,'kg ',1,1,1,'0',3),(248,246,-0.39,0.3,1,'kg ',1,2,0,'0',7),(249,247,0.7,0.74,0.79,'kg ',1,2,1,'0',7),(250,248,-0.37,0.53,1.44,'kg ',2,0,0,'0',4),(251,249,1.15,1.21,1.27,'kg ',2,0,1,'0',4),(252,250,-0.11,-0.03,0.05,'kg ',2,1,0,'0',3),(253,252,-0.11,-0.03,0.05,'kg ',2,1,1,'0',3),(254,253,-0.39,0.3,1,'kg ',2,2,0,'0',7),(255,254,0.7,0.74,0.79,'kg ',2,2,1,'both',7),(256,255,0.13,0.29,0.44,'z-score ',1,0,0,'0',3),(257,256,0.13,0.29,0.44,'z-score ',1,0,1,'0',3),(258,257,-0.52,0.74,2,'z-score ',1,1,0,'0',3),(259,258,0.45,0.57,0.69,'z-score ',1,1,1,'0',3),(260,259,-0.08,0.51,1.1,'z-score ',1,2,0,'0',6),(261,260,0.37,0.47,0.56,'z-score ',1,2,1,'0',6),(262,261,0.13,0.29,0.44,'z-score ',2,0,0,'0',3),(263,262,0.13,0.29,0.44,'z-score ',2,0,1,'0',3),(264,263,-0.52,0.74,2,'z-score ',2,1,0,'0',3),(265,264,0.45,0.57,0.69,'z-score ',2,1,1,'0',3),(266,265,-0.08,0.51,1.1,'z-score ',2,2,0,'0',6),(267,266,0.37,0.47,0.56,'z-score ',2,2,1,'both',6),(271,270,0.1,0.36,0.62,'z-score ',1,0,0,'0',2),(272,271,0.1,0.36,0.62,'z-score ',1,0,1,'0',2),(273,272,-0.25,0.09,0.42,'z-score ',1,1,0,'0',3),(274,273,-0.06,0.06,0.17,'z-score ',1,1,1,'0',3),(275,274,-0.07,0.18,0.43,'z-score ',1,2,0,'0',5),(276,275,0,0.1,0.21,'z-score ',1,2,1,'0',5),(277,276,0.1,0.36,0.62,'z-score ',2,0,0,'0',2),(278,277,0.1,0.36,0.62,'z-score ',2,0,1,'0',2),(279,278,-0.25,0.09,0.42,'z-score ',2,1,0,'0',3),(280,279,-0.06,0.06,0.17,'z-score ',2,1,1,'0',3),(281,280,-0.07,0.18,0.43,'z-score ',2,2,0,'0',5),(282,281,0,0.1,0.21,'z-score ',2,2,1,'both',5),(283,282,-0.29,0.15,0.59,'current US$ ($1,000s) ',0,0,0,'0',1),(284,283,-0.29,0.15,0.59,'current US$ (in 1000s) ',0,0,1,'0',1),(285,284,-0.29,0.15,0.59,'current US$ ($1,000s) ',0,2,0,'0',1),(286,285,-0.29,0.15,0.59,'current US$ (in 1000s) ',0,2,1,'0',1),(287,286,-0.47,-0.07,0.33,'current US$ ($1,000s) ',1,0,0,'0',2),(288,287,-0.47,-0.07,0.33,'current US$ (in 1000s) ',1,0,1,'0',2),(289,288,-0.47,-0.07,0.33,'current US$ ($1,000s) ',1,2,0,'0',2),(290,289,-0.47,-0.07,0.33,'current US$ (in 1000s) ',1,2,1,'0',2),(291,290,-0.27,0.03,0.32,'current US$ ($1,000s) ',2,0,0,'0',3),(292,291,-0.27,0.03,0.32,'current US$ (in 1000s) ',2,0,1,'0',3),(293,292,-0.27,0.03,0.32,'current US$ ($1,000s) ',2,2,0,'0',3),(294,293,-0.27,0.03,0.32,'current US$ (in 1000s) ',2,2,1,'both',3),(307,306,-0.21,4.64,9.49,'percentage points ',1,0,0,'0',2),(308,307,-0.21,4.64,9.49,'percentage points ',1,0,1,'0',2),(309,308,-0.21,4.64,9.49,'percentage points ',1,2,0,'0',2),(310,309,-0.21,4.64,9.49,'percentage points ',1,2,1,'0',2),(311,310,-0.21,4.64,9.49,'percentage points ',2,0,0,'0',2),(312,311,-0.21,4.64,9.49,'percentage points ',2,0,1,'0',2),(313,312,-0.21,4.64,9.49,'percentage points ',2,2,0,'0',2),(314,313,-0.21,4.64,9.49,'percentage points ',2,2,1,'both',2),(315,314,0.04,0.14,0.24,'cm ',1,2,1,'0',3),(316,315,0.04,0.17,0.3,'cm ',2,0,0,'0',1),(317,316,0.04,0.17,0.3,'cm ',2,0,1,'0',1),(318,317,-0.22,0.06,0.34,'cm ',2,1,0,'0',2),(319,318,-0.05,0.11,0.27,'cm ',2,1,1,'0',2),(320,319,0.04,0.14,0.25,'cm ',2,2,0,'0',3),(321,320,0.04,0.14,0.24,'cm ',2,2,1,'both',3),(322,321,-0.06,0.01,0.09,'z-score',1,0,0,'0',4),(323,322,-0.06,0.01,0.09,'z-score ',1,0,1,'0',4),(324,323,-0.21,0.01,0.22,'z-score ',1,1,0,'0',2),(325,324,-0.21,0.01,0.22,'z-score ',1,1,1,'0',2),(326,325,-0.06,0.01,0.08,'z-score ',1,2,0,'0',6),(327,326,-0.06,0.01,0.08,'z-score ',1,1,1,'0',6),(328,327,-0.06,0.01,0.09,'z-score ',2,0,0,'0',4),(329,328,-0.06,0.01,0.09,'z-score ',2,0,1,'0',4),(330,329,-0.21,0.01,0.22,'z-score ',2,1,0,'0',2),(331,330,-0.21,0.01,0.22,'z-score ',2,1,1,'0',2),(332,331,-0.06,0.01,0.08,'z-score ',2,2,0,'0',6),(333,332,-0.06,0.01,0.08,'z-score ',2,2,1,'both',6),(334,333,-3.36,3.5,10.36,'g/dL ',1,0,0,'0',2),(335,334,0.12,0.2,0.29,'g/dL ',1,0,1,'0',2),(336,335,0.07,0.31,0.55,'g/dL ',1,1,0,'0',2),(337,336,0.07,0.31,0.55,'g/dL ',1,1,1,'0',2),(338,337,-0.31,1.9,4.11,'g/dL ',1,2,0,'0',4),(339,338,0.14,0.22,0.29,'g/dL ',1,2,1,'0',4),(340,339,-3.36,3.5,10.36,'g/dL ',2,0,0,'0',2),(341,340,0.12,0.2,0.29,'g/dL ',2,0,1,'0',2),(342,341,0.07,0.31,0.55,'g/dL ',2,1,0,'0',2),(343,342,0.07,0.31,0.55,'g/dL ',2,1,1,'0',2),(344,343,-0.31,1.9,4.11,'g/dL ',2,2,0,'0',4),(345,344,0.14,0.22,0.29,'g/dL ',2,2,1,'both',4),(346,345,-0.22,0.95,2.12,'standard deviations ',1,0,0,'0',6),(347,346,0.36,0.36,0.45,'standard deviations ',1,0,1,'0',6),(348,347,-0.08,0.04,0.15,'standard deviations ',1,1,0,'0',1),(349,348,-0.08,0.04,0.15,'standard deviations ',1,1,1,'0',1),(350,349,-0.16,0.82,1.8,'standard deviations ',1,2,0,'0',7),(351,350,0.31,0.35,0.4,'standard deviations ',1,2,1,'0',7),(352,351,-0.22,0.95,2.12,'standard deviations ',2,0,0,'0',6),(353,352,0.36,0.45,0.45,'standard deviations ',2,0,1,'0',6),(354,353,-0.08,0.04,0.15,'standard deviations ',2,1,0,'0',1),(355,354,-0.08,0.04,0.15,'standard deviations ',2,1,1,'0',1),(356,355,-0.16,0.82,1.8,'standard deviations ',2,2,0,'0',7),(357,356,0.31,0.35,0.4,'standard deviations ',2,2,1,'both',7),(358,357,0.08,0.21,0.34,'kg ',1,0,0,'0',1),(359,358,0.08,0.21,0.34,'kg ',1,0,1,'0',1),(360,359,-0.11,0.06,0.22,'kg ',1,1,0,'0',2),(361,360,-0.11,0.06,0.22,'kg ',1,1,1,'0',2),(362,361,0.04,0.15,0.26,'kg ',1,2,0,'0',3),(363,362,0.08,0.21,0.34,'kg ',2,0,0,'0',1),(364,363,0.08,0.21,0.34,'kg ',2,0,1,'0',1),(365,364,-0.11,0.06,0.22,'kg ',2,1,0,'0',2),(366,365,-0.11,0.06,0.22,'kg ',2,1,1,'0',2),(367,366,0.04,0.15,0.26,'kg ',2,0,0,'0',3),(368,367,0.05,0.15,0.26,'kg ',2,2,1,'both',3),(369,368,-0.04,0.12,0.28,'z-score ',1,0,0,'0',4),(370,369,0.01,0.08,0.16,'z-score ',1,0,1,'0',4),(371,370,-0.1,0.12,0.33,'z-score ',1,1,0,'0',2),(372,371,-0.1,0.12,0.33,'z-score ',1,1,1,'0',2),(373,372,0.01,0.09,0.17,'z-score ',1,2,0,'0',6),(374,373,0.02,0.09,0.16,'z-score ',1,2,1,'0',6),(375,374,-0.04,0.12,0.28,'z-score ',2,0,0,'0',4),(376,375,0.01,0.08,0.16,'z-score ',2,0,1,'0',4),(377,376,-0.1,0.12,0.33,'z-score ',2,1,0,'0',2),(378,377,-0.1,0.12,0.33,'2 ',2,1,1,'0',2),(379,378,0.01,0.09,0.17,'z-score ',2,2,0,'0',6),(380,379,0.02,0.09,0.16,'z-score ',2,2,1,'both',6),(546,520,0.28,13.05,25.82,'percentage points ',2,2,0,'0',2),(383,382,-0.05,0.16,0.38,'z-score ',1,1,0,'0',2),(384,383,-0.05,0.16,0.38,'z-score ',1,1,1,'0',2),(385,384,0.02,0.1,0.17,'z-score ',1,2,0,'0',4),(386,385,0.02,0.1,0.17,'z-score ',1,2,1,'0',4),(387,386,0.01,0.09,0.17,'z-score ',2,0,0,'0',2),(388,387,0.01,0.09,0.17,'z-score ',2,0,1,'0',2),(389,388,-0.05,0.16,0.38,'z-score ',2,1,0,'0',2),(390,389,-0.05,0.16,0.38,'z-score ',2,1,1,'0',2),(391,390,0.02,0.1,0.1,'z-score ',2,2,0,'0',4),(392,391,0.02,0.1,0.17,'z-score ',2,2,1,'both',4),(393,392,0.32,6.55,12.78,'percentage points ',1,0,0,'0',3),(394,393,1.68,4.6,7.53,'percentage points ',1,0,1,'0',3),(395,394,0.32,6.55,12.78,'percentage points ',1,2,0,'0',3),(396,395,1.68,4.6,7.53,'percentage points ',1,2,1,'0',3),(397,396,0.32,6.55,12.78,'percentage points ',2,0,0,'0',3),(398,397,1.68,1.68,7.53,'percentage points ',2,0,1,'0',3),(399,398,0.32,6.55,12.78,'percentage points ',2,2,0,'0',3),(402,401,0.01,0.07,0.14,'standard deviations ',1,0,0,'0',2),(401,400,0.01,0.07,0.14,'standard deviations ',1,0,1,'0',2),(403,402,0.01,0.07,0.14,'standard deviations ',1,2,0,'0',2),(404,403,0.01,0.07,0.14,'standard deviations ',1,2,1,'0',2),(405,404,0.01,0.07,0.14,'standard deviations ',2,0,0,'0',2),(406,405,0.01,0.07,0.14,'standard deviations ',2,0,1,'0',2),(407,406,0.01,0.07,0.14,'standard deviations ',2,2,0,'0',2),(408,407,0.01,0.07,0.14,'standard deviations ',2,2,1,'both',2),(534,420,0.41,0.47,0.55,'(rate ratio) ',2,2,1,'both',2),(533,415,0.14,0.34,0.81,'(rate ratio) ',2,2,0,'0',2),(532,413,0.41,0.47,0.55,'(rate ratio) ',2,0,1,'0',2),(531,412,0.14,0.34,0.81,'(rate ratio) ',2,0,0,'0',2),(530,411,0.41,0.47,0.55,'(rate ratio) ',1,2,1,'0',2),(440,441,0.21,0.46,1.01,'(rate ratio) ',2,2,0,'0',3),(529,410,0.14,0.34,0.81,'(rate ratio) ',1,2,0,'0',2),(439,440,0.66,0.71,0.77,'(rate ratio) ',2,0,1,'0',3),(438,439,0.21,0.46,1.01,'(rate ratio) ',2,0,0,'0',3),(436,437,0.21,0.46,1.01,'(rate ratio) ',1,2,0,'0',3),(437,438,0.66,0.71,0.77,'(rate ratio) ',1,2,1,'0',3),(527,408,0.14,0.34,0.81,'(rate ratio) ',1,0,0,'0',2),(536,436,0.66,0.71,0.77,'(rate ratio) ',1,0,1,'0',3),(535,435,0.21,0.46,1.01,'(rate ratio) ',1,0,0,'0',3),(528,409,0.41,0.47,0.55,'(rate ratio) ',1,0,1,'0',2),(427,425,0.34,0.48,0.67,'(rate ratio) ',1,0,1,'0',3),(428,426,0.23,0.43,0.8,'(rate ratio) ',1,2,0,'0',3),(429,427,0.34,0.48,0.67,'(rate ratio) ',1,2,1,'0',3),(430,428,0.23,0.43,0.8,'(rate ratio) ',2,0,0,'0',3),(431,429,0.34,0.48,0.67,'(rate ratio) ',2,0,1,'0',3),(432,430,0.23,0.43,0.8,'(rate ratio) ',2,2,0,'0',3),(433,431,0.34,0.48,0.67,'(rate ratio) ',2,2,1,'both',3),(441,442,0.66,0.71,0.77,'(rate ratio) ',2,2,1,'both',3),(442,443,0.38,0.52,0.7,'(risk ratio) ',1,0,0,'0',2),(443,444,0.35,0.51,0.73,'(risk ratio) ',1,0,1,'0',2),(444,445,0.38,0.52,0.7,'(risk ratio) ',1,2,0,'0',2),(445,446,0.35,0.51,0.73,'(risk ratio) ',1,2,1,'0',2),(446,447,0.38,0.52,0.7,'(risk ratio) ',2,0,0,'0',2),(447,448,0.35,0.51,0.73,'(risk ratio) ',2,0,1,'0',2),(448,449,0.38,0.52,0.7,'(risk ratio) ',2,2,0,'0',2),(449,450,0.35,0.51,0.73,'(risk ratio) ',2,2,1,'both',2),(450,451,0.58,0.7,0.84,'(risk ratio) ',1,0,0,'0',2),(451,452,0.57,0.69,0.85,'(risk ratio) ',1,0,1,'0',2),(452,453,0.58,0.7,0.84,'(risk ratio) ',1,2,0,'0',2),(453,454,0.57,0.69,0.85,'(risk ratio) ',1,2,1,'0',2),(454,455,0.58,0.7,0.84,'(risk ratio) ',2,0,0,'0',2),(455,456,0.57,0.69,0.85,'(risk ratio) ',2,0,1,'0',2),(456,457,0.58,0.7,0.84,'(risk ratio) ',2,2,0,'0',2),(457,458,0.57,0.69,0.85,'(risk ratio) ',2,2,1,'both',2),(458,459,0.34,0.48,0.67,'(risk ratio) ',1,0,0,'0',2),(459,460,0.34,0.48,0.67,'(risk ratio) ',1,0,1,'0',2),(460,461,0.343951,0.479797,0.669298,'(risk ratio) ',1,2,0,'0',2),(461,462,0.34,0.48,0.67,'(risk ratio) ',1,2,1,'0',2),(462,463,0.34,0.48,0.67,'(risk ratio) ',2,0,0,'0',2),(463,464,0.34,0.48,0.67,'(risk ratio) ',2,0,1,'0',2),(464,465,0.34,0.48,0.67,'(risk ratio) ',2,2,0,'0',2),(465,466,0.34,0.48,0.67,'(risk ratio) ',2,2,1,'both',2),(466,467,0.53,0.65,0.8,'(risk ratio) ',1,0,0,'0',2),(467,468,0.53,0.65,0.8,'(risk ratio) ',1,0,1,'0',2),(468,469,0.53,0.65,0.8,'(risk ratio) ',1,2,0,'0',2),(469,470,0.53,0.65,0.8,'(risk ratio) ',1,2,1,'0',2),(470,471,0.53,0.65,0.8,'(risk ratio) ',2,0,0,'0',2),(471,472,0.53,0.65,0.8,'(risk ratio) ',2,0,1,'0',2),(472,473,0.53,0.65,0.8,'(risk ratio) ',2,2,0,'0',2),(473,474,0.53,0.65,0.8,'(risk ratio) ',2,2,1,'both',2),(474,475,0.37,1.31,2.25,'percentage points ',0,0,0,'0',1),(475,476,0.37,1.31,2.25,'percentage points ',0,0,1,'0',1),(476,477,0.37,1.31,2.25,'percentage points ',0,2,0,'0',1),(477,478,0.37,1.31,2.25,'percentage points ',0,2,1,'0',1),(478,479,-1.97,0.81,3.59,'percentage points ',1,0,0,'0',1),(479,480,-1.97,0.81,3.59,'percentage points ',1,0,1,'0',1),(480,481,-1.97,0.81,3.59,'percentage points ',1,2,0,'0',1),(481,482,-1.97,0.81,3.59,'percentage points ',1,2,1,'0',1),(482,483,0.36,1.26,2.15,'percentage points ',2,0,0,'0',2),(483,484,0.36,1.26,2.15,'percentage points ',2,0,1,'0',2),(484,485,0.36,1.26,2.15,'percentage points ',2,2,0,'0',2),(485,486,0.36,1.26,2.15,'percentage points ',2,2,1,'both',2),(486,487,-6.23,0.63,7.49,'percentage points ',0,0,0,'0',1),(487,488,-6.23,0.63,7.49,'percentage points ',0,0,1,'0',1),(488,489,-6.23,0.63,7.49,'percentage points ',0,2,0,'0',1),(489,490,-6.23,0.63,7.49,'percentage points ',0,2,1,'0',1),(490,491,-0.19,0.63,1.44,'percentage points ',1,0,0,'0',1),(491,492,-0.19,0.63,1.44,'percentage points ',1,0,1,'0',1),(492,493,-0.19,0.63,1.44,'percentage points ',1,2,0,'0',1),(493,494,-0.19,0.63,1.44,'percentage points ',1,2,1,'0',1),(494,495,-0.18,0.63,1.44,'percentage points ',2,0,0,'0',2),(495,496,-0.18,0.63,1.44,'percentage points ',2,0,1,'0',2),(496,497,-0.18,0.63,1.44,'percentage points ',2,2,0,'0',2),(497,498,-0.18,0.63,1.44,'percentage points ',2,2,1,'both',2),(499,500,-0.11,0.03,0.17,'standard deviations ',0,0,0,'0',1),(500,501,-0.11,0.03,0.17,'standard deviations ',0,0,1,'0',1),(501,502,-0.11,0.03,0.17,'standard deviations ',0,2,0,'0',1),(502,503,-0.11,0.03,0.17,'standard deviations ',0,2,1,'0',1),(503,504,-0.02,0.2,0.41,'standard deviations ',1,0,0,'0',1),(504,505,-0.02,0.2,0.41,'standard deviations ',1,0,1,'0',1),(505,506,-0.02,0.2,0.41,'standard deviations ',1,2,0,'0',1),(506,507,-0.02,0.2,0.41,'standard deviations ',1,2,1,'0',1),(507,508,-0.04,0.08,0.19,'standard deviations ',2,0,0,'0',2),(508,509,-0.07,0.09,0.25,'standard deviations ',2,0,1,'0',2),(509,510,-0.04,0.08,0.19,'standard deviations ',2,2,0,'0',2),(510,511,-0.07,0.09,0.25,'standard deviations ',2,2,1,'both',2),(537,424,0.23,0.43,0.8,'(rate ratio) ',1,0,0,'0',3),(538,512,0.66,3.61,6.55,'percentage points ',1,0,0,'0',2),(539,513,0.66,3.61,6.55,'percentage points ',1,0,0,'0',2),(540,514,0.66,3.61,6.55,'percentage points ',1,2,0,'0',2),(541,515,0.66,3.61,6.55,'percentage points ',1,2,1,'0',2),(542,516,0.66,3.61,6.55,'percentage points ',2,0,0,'0',2),(543,517,0.66,3.61,6.55,'percentage points ',2,0,1,'0',2),(544,518,0.66,3.61,6.55,'percentage points ',2,2,0,'0',2),(548,522,1.51,8.6,15.69,'percentage points ',2,2,0,'0',1),(549,523,-3.85,2.95,9.74,'percentage points ',2,2,1,'both',2),(550,524,0.66,3.61,6.55,'percentage points ',2,2,1,'both',2),(551,525,1.68,4.6,7.53,'percentage points ',2,2,1,'both',3);
/*!40000 ALTER TABLE `wp_donor_outcome_values` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-12-17 11:51:25
                                                                                                                                                                                                                                                                                                                           ./donor-programs/donor_programs.php                                                                 0000755 0001750 0000041 00000026257 12174330621 017204  0                                                                                                    ustar   alex                            www-data                                                                                                                                                                                                               <?php
/*
	Plugin Name: AID Grade - Donor Programs
	Plugin URL: http://www.inqbation.com/
	Description: AID Grade Donor Programs
	Version: 1.0 Beta
	Author: jucachap
	Author URI: http://www.inqbation.com/
	License: GPL
*/

/**
 *  Copyright 2010  inQbation  (email : juan.chaparro@inqbation.com)
	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 2 of the License, or
	(at your option) any later version.
	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.
	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */


DEFINE("DEFAULT_VIEW", "programs");

add_action( 'admin_menu', 'boj_header_image_create_menu' );
function boj_header_image_create_menu(){
    add_options_page('Donor programs', 'Donor Programs Settings', 'manage_options', __FILE__, 'boj_admin_donor_programs');
}

function boj_admin_donor_programs(){
	
	include 'includes/get-info-from-database.class.php';
	$db_obj = new getinfofromdatabase();
	/*?><pre><?php print_r($_POST); ?></pre><?php exit*/
	if( isset($_POST['program']) ){
		$db_obj->save_programs($_POST['program']);
	}
	elseif( isset($_POST['outcome']) ){
		$db_obj->save_outcome($_POST['outcome']);
	}
	elseif( isset($_POST['relations']) ){
		$db_obj->admin_save_relations($_POST['relations']);
	}
	elseif( isset($_POST['settings']) ){
		if( get_option( 'help-donor-programs' ) ){
			update_option( 'help-donor-programs', $_POST['settings'] );
		}
		else{
			add_option( 'help-donor-programs', $_POST['settings'] );
		}
		/*$db_obj->admin_save_relations($_POST['relations']);*/
		//exit;
	}
	
	$programs = $db_obj->admin_get_programs();
	$outcome = $db_obj->admin_get_outcome();
	$relations = $db_obj->admin_get_relations();
	$settings = get_option( 'help-donor-programs' );
	
	include_once 'templates/template-backend-wp.php';
}

function get_select( $set_of_values = array(), $position = 0, $selected = 0, $name = '', $name_of_set_id = '', $label_for_first = '' ){
	if( $name && $name_of_set_id ):
	?>
	<select class="<?php echo "select-for-".str_replace(' ', '-', strtolower($name_of_set_id)); ?>" name="<?php echo $name; ?>[<?php echo $position; ?>][<?php echo $name_of_set_id; ?>_id]">
		<?php if($label_for_first): ?>
		<option value="0"><?php echo $label_for_first; ?></option>
		<?php else: ?>
		<option value="0">Select a <?php echo $name_of_set_id; ?></option>
		<?php endif; ?>
	<?php if($set_of_values){
		for($i=0; $i<count($set_of_values);$i++){
			?><option value="<?php echo $set_of_values[$i]['id']; ?>"<?php echo $set_of_values[$i]['id']==$selected?" selected=\"selected\"":""; ?>><?php echo $set_of_values[$i]['name']; ?></option><?php
		}
	}
	?>
	</select><?php
	else:
		echo '<span class="error">Error generating the tag select!</span>';
	endif;
}

/*********** FRONT END ***********/

add_shortcode("donor-programs", "donor_programs_handler");
function donor_programs_handler( $incomingfrompost ) {
	$incomingfrompost=shortcode_atts(array(
		"selection" => DEFAULT_VIEW
	), $incomingfrompost);
	$labels = array();
	switch ($incomingfrompost['selection']){
		case 'outcomes':
			$labels['label_title'] = 'Pick an outcome';
			$labels['select_default'] = 'Select Outcome';
			$labels['column_title'] = 'Outcome';
			break;
		case 'programs':
			$labels['label_title'] = 'Pick a program';
			$labels['select_default'] = 'Select Program';
			$labels['column_title'] = 'Programs';
			break;
		default:
			$labels['label_title'] = 'Pick an item';
			$labels['select_default'] = 'Select Item';
			$labels['column_title'] = 'Items';
			break;
	}
	$output = get_info_front_end( $labels );
	return $output;
}

/*
 * Ajax call for the front-end to generate the results.
 */

//add_action: registeres a hook to a particular wordpress action. 

add_action('wp_ajax_my_special_action', 'donorprog_process_ajax_call');
add_action('wp_ajax_nopriv_my_special_action', 'donorprog_process_ajax_call');
function donorprog_process_ajax_call(){
	include 'includes/get-info-from-database.class.php';
	$db_obj = new getinfofromdatabase();
	if( isset($_POST['selection']) && $_POST['selection'] == 'programs' ){
		echo get_results( $db_obj->get_results_by_program( $_POST['selectionid'] ), 'programs', $db_obj->get_name_by_id( $_POST['selectionid'], 'programs' ) );
	}
	elseif( isset($_POST['selection']) && $_POST['selection'] == 'outcome' ){
		echo get_results( $db_obj->get_results_by_outcome( $_POST['selectionid'] ), 'outcome', $db_obj->get_name_by_id( $_POST['selectionid'], 'outcomes' ) );
	}
	elseif( isset($_POST['method']) && $_POST['method'] == 'studiesbycriteria' ){
		$selection = explode('-', $_POST['selection']);
//		print_r("selection: \n");
//		print_r($selection);
		$data = array(
					'relations.program_id' => (isset($selection[0])&&$selection[0]>0)?$selection[0]:-1,
					'relations.outcome_id' => (isset($selection[1])&&$selection[1]>0&&(isset($selection[0])&&$selection[0]>0))?$selection[1]:-1, 
					'outcome_values.randomized_filter' => isset($selection[2])?$selection[2]:-1,
					'outcome_values.blinded_filter' => isset($selection[3])?$selection[3]:-1,
					'outcome_values.effects' => isset($selection[4])?$selection[4]:-1
		);
//		print_r($data);		
		$result = $db_obj->get_total_studies_by_criteria( $data );
		//print_r($result);
		if($result && $result == 1)
			echo !$result?0:$result." study matches your criteria";
		elseif ($result && $result > 1)
			echo !$result?0:$result." studies match your criteria";
		else
			echo "0 studies match your criteria";
	}
    elseif( isset($_POST['method']) && $_POST['method'] == 'loadselectoutcome' ) {
		$list_of_outcome = $db_obj->get_outcome_by_program($_POST['selection']);
		get_select( $list_of_outcome, 0, 0, 'meta-analysis', 'outcome', 'Select an Outcome' ); ?>
		<div class="list-box">
			<div class="list-val">Select Outcome</div>
			<div class="wrap-list">
				<ul class="select-list">
					<?php for( $i=0; $i<count($list_of_outcome); $i++ ): ?>
					<?php 
						if( $i==0 && $i < count($list_of_outcome)-1 )
							$classes = ' class="first"'; 
						else if( $i == count($list_of_outcome)-1 )
							$classes = ' class="last"';
						else
							$classes = '';
					?>
					<li rel="<?php echo $list_of_outcome[$i]['id']; ?>"<?php echo $classes; ?>><?php echo $list_of_outcome[$i]['name']; ?></li>
					<?php endfor; ?>
				</ul>
			</div>
		</div><?php
	}
	elseif( isset($_POST['method']) && $_POST['method'] == 'meta-app' ){
		$set_values = explode('-', $_POST['selection']);
		$set_values = array( 'program_id' => $set_values[0], 'outcome_id' => $set_values[1], 'method' => $set_values[2], 'blinded' => $set_values[3], 'effect' => $set_values[4] );
		//echo '<pre>'; print_r($set_values); echo '</pre>';
		get_results_with_bibinfo( $db_obj->get_results_meta_analysis($set_values), 'programs', $db_obj->get_name_by_id( $set_values['program_id'], 'programs' ));
	}
	elseif( isset($_POST['method']) && $_POST['method'] == 'scale_function' ){
		math_scale_zoom($_POST, true);
	}
	else{
		echo 'NO DATA';
	}
	die();
}


function get_results_with_bibinfo( $data = array(), $template = null, $selection_name = ''){
	include 'templates/template-front-end-populate-bibinfo.php';
	include 'templates/template-front-end-results.php';
	echo populate_bibdetails($bibdb_obj, $bibindexarray, $bibdata);
	
}

function get_results( $data = array(), $template = null, $selection_name = ''){
	include 'templates/template-front-end-results.php';
}


function get_info_front_end( $labels = null ){
	include 'includes/get-info-from-database.class.php';
//	include 'includes/get-bibinfo-from-database.class.php';
	$db_obj = new getinfofromdatabase();
	if( isset($labels['column_title']) && $labels['column_title'] == 'Outcome' ){
		$list_of_selection = $db_obj->get_data_for_select('outcome');
		$help = get_option( 'help-donor-programs' );
		$help = $help?$help['hfcobp']:false;
	}
	elseif( $labels['column_title'] == 'Programs' ){
		$list_of_selection = $db_obj->get_programs(false);
		$help = get_option( 'help-donor-programs' );
		$help = $help?$help['hfeap']:false;
	}
		
	
	/* Print the results */
	include_once 'templates/template-front-end.php';
}

/* FRONT END - META ANALYSIS */
function get_meta_analysis(){
	include 'includes/get-info-from-database.class.php';

	include 'includes/get-bibinfo-from-database.class.php';

	$db_obj = new getinfofromdatabase();
	$list_of_programs = $db_obj->get_programs(false, true);
	
//	$bibdb_obj = new getbibinfofromdatabase();
//	$bibindexarray = array(1);
//	$bibdata = $bibdb_obj->get_bibdata($bibindexarray);


	$help = get_option( 'help-donor-programs' );
	$help1 = $help?$help['hfma'][0]:false;
	$help2 = $help?$help['hfma'][1]:false;
	$help3 = $help?$help['hfma'][2]:false;
	$help4 = $help?$help['hfma'][3]:false;
	$help5 = $help?$help['hfma'][4]:false;
/*	
	/*?><pre><?php print_r( $help2 ); ?></pre><?php exit;
	?><pre><?php print_r( $list_of_outcome ); ?></pre><?php*/

	/* Print the results */
	include_once 'templates/template-front-end-meta-analysis.php';
}

function math_scale_zoom( $data = array(), $ajax_call = false ){
	$lower = ceil(round($data['lower'], 2)/0.02)*$data['zoom'];
	$upper = ceil(round($data['upper'], 2)/0.02)*$data['zoom'];
	$mean = ceil(round($data['mean'], 2)/0.02)*$data['zoom'];

	$margin_left = abs($lower - $mean)-12;
	$slice_width = abs($upper-$lower);
	$slice_margin_left = $lower+291;
	
	if( $ajax_call )
		echo $margin_left.','.$slice_width.','.$slice_margin_left;
	else
		return array( $margin_left, $slice_width, $slice_margin_left  );
}

function mouse_over_mean_text( $mean = null, $name = null, $unit = null, $template = null, $selection_name = null, $bibref = null ){ 
	//$result = '<span class="tooltip">mean: '.$mean.' name: '.$name.' unit: '.$unit.' template: '.$template.' selection name: '.$selection_name;
	$result = '<span class="tooltip">';
	if($mean != null && $name && $unit && $template && $selection_name){
		if( str_replace(' ', '-', strtolower(trim($unit))) == '(rate-ratio)' || str_replace(' ', '-', strtolower(trim($unit))) == '(risk-ratio)' ){
			$result .= '<a class="'.$mean.'" title="'.(($template=='programs')?ucfirst($selection_name):ucfirst($name)).' '.(($mean>1)?"increased":"decreased").' '.(($template=='programs')?strtolower($name):strtolower($selection_name)).' by '.$mean.' '.$unit.'">&nbsp;</a>';
		}
		/*elseif( str_replace(' ', '-', strtolower(trim($unit))) == 'percentage-points' || str_replace(' ', '-', strtolower(trim($unit))) == '%' ){
			$result .= '<a class="'.$mean.'" title="'.(($template=='programs')?ucfirst($selection_name):ucfirst($name)).' '.(($mean>0)?"increased":"decreased").' '.(($template=='programs')?strtolower($name):strtolower($selection_name)).' by '.abs($mean).' '.$unit.'">&nbsp;</a>';
		}*/
		else{
			$result .= '<a class="'.$mean.'" title="'.(($template=='programs')?ucfirst($selection_name):ucfirst($name)).' programs '.(($mean<=0)?"decreased":"increased").' '.(($template=='programs')?strtolower($name):strtolower($selection_name)).' by '.$mean.' '.$unit.'">&nbsp; </a>';
		}
	}
	return $result.'</span>';
}
?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 