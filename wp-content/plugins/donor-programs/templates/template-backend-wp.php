<?php

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
<!--
	<ul>
        <li><a href="#tabs-1">Programs</a></li>
        <li><a href="#tabs-2">Outcome</a></li>
        <li><a href="#tabs-3">Relations</a></li>
	<li><a href="#tabs-4">Settings</a></li>
	<li><a href="#tabs-5">Import/Export CSV</a></li>
    </ul>
-->

    <div class="hidebuttons">
                <p class="meta-buttons" style=height:16px;">
                <a href="javascript:;" class="button" id="toggletab1" >Programs</a> 
                <a href="javascript:;" class="button" id="toggletab2">Outcomes</a> 
                <a href="javascript:;" class="button" id="toggletab3">Relations</a>
                <a href="javascript:;" class="button" id="toggletab4">Settings</a>
                <a href="javascript:;" class="button" id="toggletab5">Import Relations</a>
                <a href="javascript:;" class="button" id="toggletab6">Import Bibliography</a>
                <a href="javascript:;" class="button" id="toggletab7">Aliases</a>
                </p>
                <p class="button-description"></p>
    </div> 


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
				<div class="left-form">
					<label>Bibligraphic indices</label>
					<input type="text" name="relations[relation-id][outcome_values][position][bibref]" value="" />
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

		<!-- EXPORT/INPORT CONTROLLER START OF MY EDITS -->

		
		<div id="tabs-5">
		
        <form id="form-inq-donor-import" method="post">
                <table class="wp-list-table widefat fixed" cellspacing="0" border="0">
                <thead>
                    <tr>
                        <th>Import data from CSV</th>
                    </tr>
                
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="left-form">
                                <label>Help for submitting CSV: Example text (copy and paste in)</label>
                                <textarea id="helpsubmitcsv" name="helpsubmitCSV" cols="200" rows="4">
program,outcome,upper,mean,lower,units,randomized,blinded,effects,Rflag,numberofstudies,papernumbers
testprogramme,testoutcome,0.24,0.14,0.04,cm,1,2,1,0,3,1;2;4
testprogramme,testoutcome,0.13,0.17,1.4,mm,1,2,1,0,3,3;7;11</textarea>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="left-form">
                            <label>Alternatively, upload a CSV</label>
                        </div>
                        </td>
                    </tr>                     
                </tbody>
                </table>	
            <div class="help">
                <p>
                    <!-- HELP -->
                    Some help text
                </p>	
            </div>	
            <TEXTAREA name='tallbox' id="donorimport" rows=8 cols=10></TEXTAREA>
            <label> Display options</label>
            <select id="donorimport-display">
                <option value="1">Display First Line</option>
                <option value="0">Display None</option>
                <option value="all">Display All</option>
            </select>    
            <input type="submit" name="CSVsave" id="CSVsave">	
                <a href=javascript:;"" value="Refresh" class="button" name="Refresh" id="tab-5-refresh" style="float:right;"/>Refresh</a>
        </form>
            <div style="clear:both"></div>


<div id="success" style="display:none" class="updated-inq"></div>


<div id="detect-fields" style="display:none"></div>

     </div> 
</div>













		
		<div id="tabs-6">
		
        <form id="form-inq-bib-import" method="post">
                <table class="wp-list-table widefat fixed" cellspacing="0" border="0">
                <thead>
                    <tr>
                        <th>Import data from CSV</th>
                    </tr>
                
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="left-form" style="width:100%;">
                                <label>Help for submitting CSV: Example text (copy and paste in)</label>
                                <textarea id="helpsubmitcsv" name="helpsubmitCSV" rows="4" disabled style="background:#dddddd; width:100%;" >
paperid,reference,lower,ES,upper,outcomename,intervention
1,"Alam, Baez and Del Carpio (2011). ""Does Cash for School Influence Young Women's Behavior in the Longer Term? Evidence from Pakistan"", IZA Discussion Papers.",-0.043428,-0.0154,0.012628,Labor force participation (percentage points),CCTs
2,"Baez and Camacho (2011). ""Assessing the Long-term Effects of Conditional Cash Transfers on Human Capital Evidence from Colombia"", Policy Research Working Papers.",-0.07464,-0.057,-0.03936,Test scores (standard deviations),CCTs
                                </textarea>   
                         </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="left-form">
                            <label>Alternatively, upload a CSV</label>
                        </div>
                        </td>
                    </tr>                     
                </tbody>
                </table>	
            <div class="help">
                <p>
                    <!-- HELP -->
                </p>	




            </div>	
            <TEXTAREA name='tallbox' id="bibimport" rows=8 cols=10></TEXTAREA>
            <input type="submit" name="bibdisplaye" id="CSVsave" value="Display">	

                <a href=javascript:;"" value="Refresh" class="button" name="Refresh" id="tab-6-refresh" style="float:right;"/>Display</a>
        </form>
            <div style="clear:both"></div>

        <div id="tabs-6-results" style="display:none"></div>

        </div> 



</div>


        <div id="tabs-7">



</div>
		























<script type="text/javascript">
jQuery(document).ready(function(){

                jQuery('#form-inq-donor-import').submit(function(){
                    jQuery('#detect-fields').html('<img src="../wp-content/plugins/donor-programs/templates/images/ajax-loader.gif" style="margin:auto">').show();
                    var data = jQuery(this).children('#donorimport').val();
                    var method = jQuery(this).children('#donorimport-display').val();
                    // Parse these data ia an AJAX call
                jQuery.post('<?php echo(admin_url('admin-ajax.php')); ?>', {action:'donoradmin_action',data:data, method:method},
                    function(answer){
                            jQuery('#detect-fields').html(answer).show();
                            return true;
                            
                        }
                        );
                        return false;
                });


    // JQuery for the donorprog_admin_display_bibligraphy

                jQuery(document).on('submit','#form-inq-bib-import' ,function(){
                    // Parse these data ia an AJAX call
//                    jQuery('#tabs-6-results').html('<img src="../wp-content/plugins/donor-programs/templates/images/ajax-loader.gif" style="margin:auto">').show();
                    data = encodeURIComponent(jQuery(this).children('#bibimport').val());
//                    console.log(data);
                    // Data needs to be placed into an array 
                    jQuery.post('<?php echo(admin_url('admin-ajax.php')); ?>', {action:'donoradmin_bib',data:data, method:'interpret'},
                        function(answer){
                            jQuery('#tabs-6-results').html(answer).show();
                            jQuery('#form-bib-import>.input-to-remove-import').each(function() { jQuery(this).hide(); });
                            return true;
                        }
                    );
                    return false;
                }); 
                // JQuery remove code:
                // This should be before the delegation/


                jQuery(document).on('click',"input[type='submit']", function(event){
//                        console.log('Click event triggered on submit DO');
                        jQuery(this).addClass('bibclicked');
                });


// JQUERY SAVE CODE:
    // Add in the jQUery for the donorprog_admin_display_interpretation
                jQuery(document).on('submit','#form-donor-import' ,function(){
                    // Parse these data ia an AJAX call
                    $data = jQuery(this).serialize();
                    // Data needs to be placed into an array 
 $method = jQuery(this).children(':submit')                   
//                    alert(data);
                    jQuery.post('<?php echo(admin_url('admin-ajax.php')); ?>', {action:'donoradmin_update',relations:$data, method:'create'},
                        function(answer){
                            jQuery('#success').html('<p> A new relation created with ID ' + answer +  '. To view it click Refresh </p>').show();
                            return true;
                        }
                    );
                    return false;
                }); 

    // Add in the jQUery for the admin_bib_updaten
                jQuery(document).on('submit','#form-bib-import' ,function(event){
                    // Parse these data ia an AJAX call
                    $data = jQuery(this).serialize();
                    var selector = jQuery(this);
//                    console.log('First');
                    //                    console.log(selector)
                    //
                    //
                   // Add in jQuery for adding class 'clicked' for clicked submit
                    //                    console.log(jQuery(this).find(".bibclicked").attr('value'));
                    $method = jQuery(this).find(".bibclicked").attr('value');
                    jQuery.post('<?php echo(admin_url('admin-ajax.php')); ?>', {action:'donoradmin_bib_update',data:$data, method:$method},
                        function(answer){
                            if(answer == 1) {
                                //console.log(selector);
                                //                                jQuery(selector).find('#status').attr('value','Saved!').show();
                                jQuery(selector).siblings('.input-status').children('#status').attr('value',$method + 'd').show().css('border-color','green').attr('style','background-color:green!important');
                                jQuery(selector).children('.input-to-save-import').hide();
                            }
                            else {
                                console.log('The error in the mySQL call is:'); 
                                console.log(answer); 
                                jQuery(selector).siblings('.input-status').children('#status').attr('value','Error').show().css('border-color','red').attr('style','background-color:red!important');
                                //                          console.log(selector); 
//                                jQuery(selector).find('#status').attr('value','Error!').show();
                            }
                            // Remove the clicked class
                            
                            return true;
                        }
                    );
//                    $method = jQuery(this).find('.bibclicked').removeClass('.bibclicked');
                    return false;
                }); 

                // 
                

            
// JQUERY REMOVE CODE
    // Add in the jQUery for the donorprog_admin_display_recorded_outcomesn
                jQuery(document).on('submit','#form-donor-relation' ,function(){
                    // Parse these data ia an AJAX call
                    $data = jQuery(this).serialize();
                    // Data needs to be placed into an array 
                    
                    jQuery.post('<?php echo(admin_url('admin-ajax.php')); ?>', {action:'donoradmin_update',relations:$data, method:'remove'},
                        function(answer){
                            jQuery('#success').html('<p> The relation with ID ' + answer + ' has been removed. </p>').show();
                            return true;
                        }
                    );
                    return false;
                }); 


            // JQUERY Update code
                jQuery('#tab-5-refresh').on('click',function(){
                    jQuery('#detect-fields').html('<img src="../wp-content/plugins/donor-programs/templates/images/ajax-loader.gif" style="margin:auto">');
                    jQuery('#success').html('');
                    jQuery('#form-inq-donor-import').trigger('submit');
                });

                jQuery('#tab-6-refresh').on('click',function(){
                    
                    jQuery('#detect-fields').html('<img src="../wp-content/plugins/donor-programs/templates/images/ajax-loader.gif" style="margin:auto">').show();
                    jQuery.post('<?php echo(admin_url('admin-ajax.php')); ?>', {action:'donoradmin_bib', method:'display'},
                        function(answer){
                            jQuery('#tabs-6-results').html(answer).show();
                            jQuery('#form-bib-import>.input-to-save-import').each(function() { jQuery(this).hide(); });
                            jQuery('.input-status>#status').each(function() { jQuery(this).show(); });
                            return true;
                        }
                    );
                    return false;
                });
  
});                

</script>

<script type="text/javascript">

jQuery(document).ready(function(){


            jQuery('#tabs-1').hide();   
            jQuery('#tabs-2').hide();   
            jQuery('#tabs-3').hide();   
            jQuery('#tabs-4').hide();   
            jQuery('#tabs-5').hide();   

            jQuery('#tabs-6').hide();   


            jQuery('#toggletab1').click(function() {
               jQuery('#tabs-1').toggle();
            });
            jQuery('#toggletab2').click(function() {
               jQuery('#tabs-2').toggle();
            });
            jQuery('#toggletab3').click(function() {
               jQuery('#tabs-3').toggle();
            });
            jQuery('#toggletab4').click(function() {
               jQuery('#tabs-4').toggle();
            });
            jQuery('#toggletab5').click(function() {
               jQuery('#tabs-5').toggle();
            });
            jQuery('#toggletab6').click(function() {
               jQuery('#tabs-6').toggle();
            });
});
</script>

<!-- END OF MY EDITS -->













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
	</script>
