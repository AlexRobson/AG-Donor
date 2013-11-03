<?php

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
								<li><input id="meta-radio-7" type="radio" name="meta-analysis[0][effect]" value="0" />
                                <label for="meta-radio-7">Fixed effects</label></li>
								<li><input id="meta-radio-8" type="radio" name="meta-analysis[0][effect]" value="1" checked="checked"/>
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
                <div class="result-with-bib">
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
					jQuery(".mid-part div.result div.result-with-bib").html('<div class="meta-app-error-message" style="margin: 20px 0px; text-align: center;"><h3 style="float: left; margin: 20px 0; width: 100%;"><strong>Required fields are incomplete. Please select an option for each field and click the Submit button.</strong></h3></div>').parent().show();
					return false;
				}
				else{
					jQuery.post('<?php echo(admin_url('admin-ajax.php')); ?>', {action:'my_special_action',method:'meta-app',selection:get_form_selection()},
						function(answer){
							ajax_studies_by_criteria( get_form_selection() );
							jQuery(".mid-part div.result div.result-with-bib").html(answer).parent().show();
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
