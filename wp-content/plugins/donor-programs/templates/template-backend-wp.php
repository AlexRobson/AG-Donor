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
    
    div.hidebuttons a.selected {
        background: black;
        color: white;
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
                <a href="javascript:;" class="button" id="toggletab7">Bulk Ops</a>
                </p>
                <p class="button-description"></p>
    </div> 


	<div id="tabs-1" class="tabitem">
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
   

	<div id="tabs-2" class="tabitem">
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
		
	<div id="tabs-3" class="tabitem">
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
		
		<div id="tabs-4" class="tabitem">
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

		
		<div id="tabs-5" class="tabitem">
		
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
program,outcome,numberofpapers,lower,mean,upper,units,weights,papernumbers,randomized,blinded,effects,Rflag
Conditional Cash Transfers,attendance rates,4,0.021808978,0.033003364,0.044197753,percentage points,"9.036,0,0.348,90.615","9;17;19;49",0,0,FE,0
Conditional Cash Transfers,attendance rates,4,0.01197708,0.09363696,0.17529684,percentage points,"41.646,0.024,13.162,45.168",9;17;19;49,0,0,RE,0
Conditional Cash Transfers,attendance rates,4,0.021808978,0.033003364,0.044197753,percentage points,"9.036,0,0.348,90.615",9;17;19;49,0,2,FE,0
Conditional Cash Transfers,attendance rates,4,0.01197708,0.09363696,0.17529684,percentage points,"41.646,0.024,13.162,45.168",9;17;19;49,0,2,RE,0
</textarea>
<label>String list of outcomes (string-sensitive, case-insensitive) </label>
                                <textarea><?php $loutcome = $db_obj->admin_get_outcome();
                        for ($i=0;$i<count($loutcome);$i++){
                            echo $loutcome[$i]['name'];
                            echo ", "; 
                        }
                        ?>
        </textarea>

<label>String list of programs (string-sensitive, case-insensitive) </label>
                                <textarea><?php $lprogram = $db_obj->admin_get_programs();
                        for ($i=0;$i<count($lprogram);$i++){
                            echo $lprogram[$i]['name'];
                            echo ", "; 
                        }
                        ?>
        </textarea>
                           </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="left-form">
                            <label>Alternatively, upload a CSV</label>
                            <input type="file" name="CSVupload" id="CSVfile" />  
                            <button type="submit" name="CSVupload" id="CSVupload">Upload</button>  
                        </div>
                        </td>
                    </tr>                     
                </tbody>
                </table>	
            <div class="help">
                <p>
                    <!-- HELP -->
                    To upload data, you must paste in CSV formated data into the box below. You may copy the example text above to test this. 

This data is of the format as in the help box above. If your CSV data has different heading orders, the upload will still work.

Upon clicking submit, the CSV will be parsed into output below. Each row corresponds to an individual relation, with associated parameters.
You may save each relation individually, or click Save All to create each relation. Edits to each relation will be saved as-is.

Depending upon your display settings, other relations already on the database are stored. The option to show these in tandem with the uploaded relationships
are for two reasons. The first is for basic error checking: does the interpreted relationship program/outcome pairing make sense with the other data already present. 
The second reason is so that previous relationships can be overwritten, and thus next to the save options you may save either as a new relationship, or as 
the relationship ID of a relationship already on the database. 

There are three different display options. The first is 'no display' that does not display the other relationships, and only displays the interpreted relationships.
The second is 'first line', that just displays the interpreted program/outcome pairing for the first line. This is for use with uploads all of the same program/outcome pairings.
The final line displays the relationships already known for each line in the CSV. 

                </p>	
            </div>	
            <TEXTAREA name='tallbox' id="donorimport" rows=8 cols=10></TEXTAREA>
            <label> Display options</label>
            <select id="donorimport-display">
                <option value="0">Display None</option>
                <option value="1">Display First Line</option>
                <option value="all">Display All</option>
            </select>    
            <input type="submit" name="CSVtext" id="CSVsave">	
                <a href=javascript:;"" value="SaveAll" class="button-primary" name="SaveAllh" id="tab-5-applyall" style="margin: 0 auto; display:none"/>Apply all</a>
                <a href=javascript:;"" value="Refresh" class="button" name="Refresh" id="tab-5-refresh" style="float:right;"/>Refresh</a>
                <a href=javascript:;"" value="Display" class="button" name="Refresh" id="tab-5-display" style="float:right;"/>Display</a> 
                <a href=javascript:;"" value="Flush" class="button" name="Flush" id="tab-5-flush" style="float:right;"/>Flush</a>
        </form>
            <div id="AJAXstatus"></div>
            <div style="clear:both"></div>


<div id="success" style="display:none" class="updated-inq"></div>


<div id="detect-fields" style="display:none"></div>

     </div> 
</div>

		
		<div id="tabs-6" class="tabitem">
		
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
intervention,outcomename,lower,ES,upper,units,author,publicationyear,title,journal,volume,paperid
Conditional Cash Transfers,Attendance rate,0.0114,0.08,0.1486,percentage points,Baird et al.,2011,Cash or Condition? Evidence from a Cash Transfer Experiment,Working Paper,126,9
                                </textarea>   
                         </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="left-form">
                            <label>Alternatively, upload a CSV</label>
            <input type="file" name="CSVupload" id="CSVfile" />  
            <button type="submit" id="CSVupload">Upload</button>  
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
<div id="functions" style="text-align:center">
            <input type="submit" name="bibdisplaye" id="CSVsave" value="Interpret" style="float:left;">	

                <a href=javascript:;"" value="SaveAll" class="button-primary" name="SaveAllh" id="tab-6-applyall" style="margin: 0 auto; display:none"/>Apply all</a>
                <a href=javascript:;"" value="Refresh" class="button" name="Refresh" id="tab-6-refresh" style="float:right;"/>Display</a>
</div>
        </form>
            <div style="clear:both"></div>

        <div id="tabs-6-results" style="display:none"></div>

        </div> 



</div>


        <div id="tabs-7" class="tabitem">


</div>
		























<script type="text/javascript">
jQuery(document).ready(function(){
    
                // Parse relations
    jQuery('#form-inq-donor-import').submit(function(){
        console.log('Relations form subbmited'); 
        jQuery('#detect-fields').html('<img src="../wp-content/plugins/donor-programs/templates/images/ajax-loader.gif" style="margin:auto">').show();
        $uploadtype = jQuery(this).find("input[type='submit'].formclicked").attr('name');
        console.log($uploadtype);
        switch($uploadtype) {
            case 'CSVtext':
                var data = jQuery(this).children('#donorimport').val();
                var method = jQuery(this).children('#donorimport-display').val();
                jQuery.post('<?php echo(admin_url('admin-ajax.php')); ?>', {action:'donoradmin_action',data:data, method:method},
                function(answer){
                    jQuery('#detect-fields').html(answer).show();
                    jQuery('#tab-5-applyall').show();
                        return true;
                        
                    }
                );
                break;
            case 'CSVupload':
                jQuery(this).children('#donorimport').val('');
                jQuery(this).children('#detect-fields').html('');
                break;
        } 
        jQuery(this).find('.formclicked').removeClass('formclicked');
        return false;
    });

                // Display relations
                //
                jQuery(document).on('click','#tab-5-display', function(event){
                    jQuery('#toggletab3').click();
                });
                                
                // Save relations
                jQuery(document).on('submit','#form-donor-import' ,function(){
                    $data = jQuery(this).serialize();
                    var selector = jQuery(this);
                    jQuery('#AJAXstatus').html('<img src="../wp-content/plugins/donor-programs/templates/images/ajax-loader.gif" style="margin:auto">').show();
                    $method = jQuery(this).find(".formclicked").attr('value');
                    jQuery.post('<?php echo(admin_url('admin-ajax.php')); ?>', {action:'donoradmin_update',relations:$data, method:'create'},
                        function(answer){
                            if(jQuery.isNumeric(answer)){
                                if(answer>0) { 
 //                                   jQuery(selector).find('#relationid').show().attr('value',answer);
                                    jQuery(selector).siblings('.input-status').children('#status').attr('value',$method + 'd' + ':' + answer).show().css('border-color','green').attr('style','background-color:green!important');
                                    jQuery(selector).children('.tab-5-interpret-options').remove();
                                    jQuery(selector).find(".formclicked").removeClass('.formclicked');
                                    jQuery('#tabs-3').html('<p> You have changed, or attempted to change, the stored relations. You should refresh </p>');
                                }
                                else {
                                    jQuery(selector).find(".formclicked").removeClass('.formclicked');
                                    console.log(answer);
                                    jQuery(selector).siblings('.input-status').children('#status').attr('value','ERROR').show().css('border-color','red').attr('style','background-color:red!important');
                                } 
                            }
                            
                            else {

                                    jQuery(selector).children('.tab-5-interpret-options').remove();
                                    jQuery(selector).find(".formclicked").removeClass('.formclicked');
                                    console.log(answer);
                                    jQuery(selector).siblings('.input-status').children('#status').attr('value','ERROR').show().css('border-color','red').attr('style','background-color:red!important');
                            }
                            return true;
                        }
                    );
                    jQuery('#AJAXstatus').html(''); 
                    return false;
                }); 

                // Save Relation values
                function save_outcome_values(data){                        
                    jQuery.post('<?php echo(admin_url('admin-ajax.php')); ?>', {action:'donoradmin_update',relations:data, method:'create'},
                        function(answer){
                            return answer;
                        });
                };
                
                // Remove relations
                jQuery(document).on('submit','#form-donor-relation' ,function(){
                    $data = jQuery(this).serialize();
                    jQuery.post('<?php echo(admin_url('admin-ajax.php')); ?>', {action:'donoradmin_update',relations:$data, method:'remove'},
                        function(answer){
                            if(answer == 1) {
                                alert(answer);

                            }
                            else {
                                alert(answer);

                            }
                            return true;
                        }
                    );
                    return false;
                }); 

                // Interpret bibligraphyy
                jQuery(document).on('submit','#form-inq-bib-import' ,function(){
                    data = encodeURIComponent(jQuery(this).children('#bibimport').val());
                    jQuery.post('<?php echo(admin_url('admin-ajax.php')); ?>', {action:'donoradmin_bib',data:data, method:'interpret'},
                        function(answer){
                            jQuery('#tabs-6-results').html(answer).show();
                            jQuery('#form-bib-import>.input-to-remove-import').each(function() { jQuery(this).remove(); });
                            jQuery('#tab-6-applyall').show();
                            return true;
                        }
                    );
                    return false;
                }); 
                
                // Save/Remove bibliography
                jQuery(document).on('submit','#form-bib-import' ,function(event){
                    $data = jQuery(this).serialize();
                    var selector = jQuery(this);
                    $method = jQuery(this).find(".formclicked").attr('value');
                    jQuery.post('<?php echo(admin_url('admin-ajax.php')); ?>', {action:'donoradmin_bib_update',data:$data, method:$method},
                        function(answer){
                            if(answer == 1) {
                                jQuery(selector).siblings('.input-status').children('#status').attr('value',$method + 'd').show().css('border-color','green').attr('style','background-color:green!important');
                                jQuery(selector).children('.input-to-save-import').remove();
                                jQuery(selector).find(".formclicked").removeClass('.formclicked');
                            }
                            else {
//                                console.log('The error in the mySQL call is:'); 
//                                console.log(answer); 
                                jQuery(selector).siblings('.input-status').children('#status').attr('value','Error').show().css('border-color','red').attr('style','background-color:red!important');
                                jQuery(selector).find(".formclicked").removeClass('.formclicked');
                            }
                            // Remove the clicked class
                            return true;
                        }
                    );
                    return false;
                }); 



                // Refresh code

                jQuery('#tab-5-refresh').on('click',function(){
                    jQuery('#detect-fields').html('<img src="../wp-content/plugins/donor-programs/templates/images/ajax-loader.gif" style="margin:auto">');
                    jQuery('#success').html('');
                    jQuery('#form-inq-donor-import').trigger('submit');
                });

                jQuery('#tab-6-refresh').on('click',function(){
                    jQuery.post('<?php echo(admin_url('admin-ajax.php')); ?>', {action:'donoradmin_bib', method:'display'},
                        function(answer){
                            jQuery('#tabs-6-results').html(answer).show();
                            jQuery('#form-bib-import>.input-to-save-import').each(function() { jQuery(this).remove(); });
                            jQuery('.input-status>#status').each(function() { jQuery(this).show(); });
                            return true;
                        }
                    );
                    return false;
                });

                // Apply all code
                jQuery(document).on('click','#tab-5-applyall', function(event){
                       if (confirm('This will save all interpreted data, or remove ALL data from the database.')){
                           jQuery('.relations-update-form').each( function() { jQuery(this).children("input[type='submit']").click(); } ); 
                       };
                });

                jQuery(document).on('click','#tab-6-applyall', function(event){
                       if (confirm('This will save all interpreted data, or remove ALL data from the database.')){
                           jQuery('.bib-update-form').each( function() { jQuery(this).children("input[type='submit']").click(); } ); 
                       };
                });
                jQuery(document).on('click',"input[type='submit']", function(event){
                        jQuery(this).addClass('formclicked');
                });

                // Flush DB

                jQuery(document).on('click','#tab-5-flush', function(event){
                    if (confirm('This will wipe the relations database table. Do not continue unless you are certain appropriate backups exist')){

                    jQuery.post('<?php echo(admin_url('admin-ajax.php')); ?>', {action:'donoradmin_delete', method:'purge'},
                        function(answer){
                            alert('Database purge responded with: ' + answer);
                        }
                    );
                    };
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
                jQuery('.tabitem').each(function() { jQuery(this).hide();} );
                jQuery('.hidebuttons a.button').each(function() { jQuery(this).removeClass('selected');} );
                jQuery(this).addClass('selected')
               jQuery('#tabs-1').toggle();
            });
            jQuery('#toggletab2').click(function() {

                jQuery('.tabitem').each(function() { jQuery(this).hide();} );
                jQuery('.hidebuttons a.button').each(function() { jQuery(this).removeClass('selected');} );
                jQuery(this).addClass('selected')
               jQuery('#tabs-2').toggle();
            });
            jQuery('#toggletab3').click(function() {
                jQuery('.tabitem').each(function() { jQuery(this).hide();} );
                jQuery('.hidebuttons a.button').each(function() { jQuery(this).removeClass('selected');} );
                jQuery(this).addClass('selected')
               jQuery('#tabs-3').toggle();
            });
            jQuery('#toggletab4').click(function() {
                jQuery('.tabitem').each(function() { jQuery(this).hide();} );
                jQuery('.hidebuttons a.button').each(function() { jQuery(this).removeClass('selected');} );
                jQuery(this).addClass('selected')
               jQuery('#tabs-4').toggle();
            });
            jQuery('#toggletab5').click(function() {
                jQuery('.tabitem').each(function() { jQuery(this).hide();} );
                jQuery('.hidebuttons a.button').each(function() { jQuery(this).removeClass('selected');} );
                jQuery(this).addClass('selected')
               jQuery('#tabs-5').toggle();
            });
            jQuery('#toggletab6').click(function() {
                jQuery('.tabitem').each(function() { jQuery(this).hide();} );
                jQuery('.hidebuttons a.button').each(function() { jQuery(this).removeClass('selected');} );
                jQuery(this).addClass('selected')
               jQuery('#tabs-6').toggle();
            });
});
</script>

<!-- END OF MY EDITS -->













	<script type="text/javascript">
	//<!--
		jQuery(document).load(function(){
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
