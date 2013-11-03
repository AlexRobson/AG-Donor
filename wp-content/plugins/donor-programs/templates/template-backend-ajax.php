
<?php 
function donorprog_admin_display_intepretation($csv,$db_obj,$rids){

?> 

                <div style="clear: both; margin-top:10px;"></div>
                <div class="relation-entry-detail">
                <form id="form-donor-import" method="post">
                    <div class="left-form">
                        <label>Programme (ID)</label>
                        <input type="text" name="relations[program_id]" style="background-color:#eeeeee;" value=<?php echo $db_obj->custom_get_program_id(($csv['program']))?> />
                    </div>
                    <div class="left-form">
                        <label>Outcome (ID)</label>
                        <input type="text" name="relations[outcome_id]" style="background-color:#eeeeee;" value=<?php echo $db_obj->custom_get_outcome_id(($csv['outcome']))?> />
                    </div>
                    <div class="set-of-values" style="clear: both;">
                        <div class="left-form">
                            <label>Lower</label>
                            <input type="text" name="relations[outcome_values][position][lower]" value=<?php print_r($csv['lower'])?> />
                        </div>
                        <div class="left-form">
                            <label>Mean</label>
                            <input type="text" name="relations[outcome_values][position][mean]" value="<?php print($csv['mean'])?>" />
                        </div>
                        <div class="left-form">
                            <label>Upper</label>
                            <input type="text" name="relations[outcome_values][position][upper]" value="<?php print($csv['upper'])?>" />
                        </div>
                        <div class="left-form">
                            <label>Unit</label>
                            <input type="text" name="relations[outcome_values][position][unit]" value="<?php print($csv['units'])?>" />
                        </div>
                        <div style="clear: both;"></div>
                        <div class="left-form">
                            <label>Randomized_filter</label>
                            <input type="text" name="relations[outcome_values][position][randomized_filter]" value="<?php print($csv['randomized'])?>" />
                        </div>
                        <div class="left-form">
                            <label>Blinded_filter</label>
                            <input type="text" name="relations[outcome_values][position][blinded_filter]" value="<?php print($csv['blinded'])?>" />
                        </div>
                        <div class="left-form">
                            <label>Effects</label>
                            <input type="text" name="relations[outcome_values][position][effects]" value="<?php print($csv['effects'])?>" />
                        </div>
                        <div class="left-form">
                            <label>Rflag</label>
                            <input type="text" name="relations[outcome_values][position][rflag]" value="<?php print($csv['Rflag'])?>" />
                            <?php //echo get_select(array( 0 => array( 'id' => 'program-in-select', 'name' => 'Examine a program' ), 1 => array( 'id' => 'outcome-in-select', 'name' => 'Compare programs by outcome' ), 2 => array( 'id' => 'both', 'name' => 'Both' ) ), 'position', null, 'relations[outcome_values]', 'rflag', 'Select an option'); ?>
                        </div>
                        <div style="clear:both;"></div>
                        <div class="left-form">
                            <label>Number_of_studies</label>
                            <input type="text" name="relations[outcome_values][position][number_of_studies]" value="<?php print(count(explode(";",$csv['papernumbers'])))?>" />
                        </div>
<!--                        <div class="left-form">
                            <label>Bibligraphic Data</label>
                            <input type="text" name="relations[outcome_values][position][bibdata]" value="<?php echo ($csv['bibdata']);?>" />
                        </div>
-->
                        <div class="left-form">
                            <label>Weights</label>
                            <input type="text" name="relations[outcome_values][position][weights]" value="<?php echo ($csv['weights']);?>" />
                        </div>
                        <div class="left-form">
                            <label>Bibligraphic indices</label>
                            <input type="text" name="relations[outcome_values][position][bibref]" value="<?php echo $csv['papernumbers'];?>" />
                        </div>

                        <div style="clear:both;"></div>
                    </div>

                    <div class="left-form tab-5-interpret-options">
                        <label>Save Options</label>
                        <select>
                        <option  value="0">New relationship</option>
                        <?php foreach ($rids as $rid): ?>
                        <option value="<?php echo $rid['id']; ?>"><?php echo $rid['id']; ?></option>
                        <?php endforeach; ?>
                        </select>
                        <div class="input-to-save-import left-form relations-update-form" style="clear: both;">
                            <input value="Save" type="submit" class="button-primary" name="SaveRelations" />
                        </div>
                    </div>
                </form>

                        <div class="input-status left-form">
                            <input class="button-primary" value="Status: On database" id="status" style="display:none" disabled/>
                        </div>
                </div>
                <div style="clear: both; margin-bottom:10px;"></div>


<?php 
}// End function
?>


<?php

function donorprog_admin_display_recorded_outcomes($csv,$id, $propr){

?>
                    <div class="outcome">
                        <form id="form-donor-relation" method="post">
                        <div class="left-form">
                                <label>Relation ID</label>
                                <input type="text" name="relations-id" style="background-color:#eeeeee;" readonly value=<?php print_r($id)?> />
                        </div>

                        <div class="left-form">
                            <label>Programme (ID)</label>
                            <input type="hidden" name="relations[program_id]" style="background-color:#eeeeee;" value=<?php echo $propr['program_id'] ?> />
                        </div>
                        <div class="left-form">
                            <label>Outcome (ID)</label>
                            <input type="hidden" name="relations[outcome_id]" style="background-color:#eeeeee;" value=<?php echo $propr['outcome_id']?> />
                        </div>


                        <div class="set-of-values" style="clear: both;">
                            <div class="left-form">
                                <label>Lower</label>
                                <input type="text" name="relations[outcome_values][position][lower]" value=<?php print_r($csv[0]['lower'])?> />
                            </div>
                            <div class="left-form">
                                <label>Mean</label>
                                <input type="text" name="relations[outcome_values][position][mean]" value="<?php print($csv[0]['mean'])?>" />
                            </div>
                            <div class="left-form">
                                <label>Upper</label>
                                <input type="text" name="relations[outcome_values][position][upper]" value="<?php print($csv[0]['upper'])?>" />
                            </div>
                            <div class="left-form">
                                <label>Unit</label>
                                <input type="text" name="relations[outcome_values][position][unit]" value="<?php print($csv[0]['unit'])?>" />
                            </div>
                            <div style="clear: both;"></div>
                            <div class="left-form">
                                <label>Randomized_filter</label>
                                <input type="text" name="relations[outcome_values][position][randomized_filter]" value="<?php print($csv[0]['randomized_filter'])?>" />
                            </div>
                            <div class="left-form">
                                <label>Blinded_filter</label>
                                <input type="text" name="relations[outcome_values][position][blinded_filter]" value="<?php print($csv[0]['blinded_filter'])?>" />
                            </div>
                            <div class="left-form">
                                <label>Effects</label>
                                <input type="text" name="relations[outcome_values][position][effects]" value="<?php print($csv[0]['effects'])?>" />
                            </div>
                            <div class="left-form">
                                <label>Rflag</label>
                                <input type="text" name="relations[outcome_values][position][rflag]" value="<?php print($csv[0]['rflag'])?>" />
                                <?php //echo get_select(array( 0 => array( 'id' => 'program-in-select', 'name' => 'Examine a program' ), 1 => array( 'id' => 'outcome-in-select', 'name' => 'Compare programs by outcome' ), 2 => array( 'id' => 'both', 'name' => 'Both' ) ), 'position', null, 'relations[relation-id][outcome_values]', 'rflag', 'Select an option'); ?>
                            </div>
                            <div class="left-form">
                                <label>Number_of_studies</label>
                                <input type="text" name="relations[outcome_values][position][number_of_studies]" value="<?php print(count(explode(";",$csv[0]['papernumbers'])))?>" />
                            </div>
                            <div class="left-form">
                                <label>Bibligraphic indices</label>
                                <input type="text" name="relations[outcome_values][position][bibref]" value="<?php print($csv[0]['bibref'])?>" />
                            </div>
                            <div class="input-to-remove-import left-form relations-update-form" style="clear: both;">
                            <input value="Remove" type="submit" class="button-primary" name="RemoveRelations" />
                            </div>




                        </div>
                        </form>

                        <div class="input-status left-form">
                            <input class="button-primary" value="Status: On database" id="status" style="display:none" disabled/>
                        </div>


                    </div>

                            <div style="clear: both; margin-bottom:10px;"></div>
<?php 
}

function display_equivalent_header($line,$i){



?>
			<table class="wp-list-table widefat fixed" cellspacing="0" border="0">
			<thead>
				<tr>
                <th>Equivalent Relationships Between <?php echo ($line['program'])?> and <?php echo ($line['outcome'])?> (Line <?php echo $i+1; ?>)  </th>
              	</tr>
			
            </thead>
			<tbody>
            </tbody>
            </table>
<?php 
}

function display_interpretation_header(){

?>
			<table class="wp-list-table widefat fixed" cellspacing="0" border="0">
			<thead>
				<tr>
                	<th>Interpretation</th>
              	</tr>
			
            </thead>
			<tbody>
            </tbody>
            </table>
<?php 
}


function donorprog_admin_display_bibliography($bibdata){

?> 

	<div class="spacer"></div>
                <p class="bibligraphy" style="clear:both">              
                <div class="bibentrydetail">
    <?php if(count($bibdata)>0):?>	
        <?php foreach($bibdata as $bibitem): ?>
            <div class="bibentrylong"  <?php echo 'id=bib'.$bibitem['entries_id'] ?> style="clear:both; display:inline">
                    <form id="form-bib-import" method="post">
                    <?php foreach($bibitem as $key=>$value):
                            $value = htmlentities($value);
                            ?>
                            <div class="left-form">
                            <label><?php echo $key; ?></label>
                                <input type="text" name="bibliography[<?php echo $key;?>]" value="<?php echo $value; ?>" />
                            </div>
                    <?php endforeach; ?>
                            <div style="clear: both; margin-bottom:10px;"></div>
                        <div class="input-to-save-import bib-update-form left-form">
                            <input value="Save" type="submit" class="button-primary" name="SaveBibdata" />
                        </div>
                            <div class="input-to-remove-import bib-update-form left-form">
                            <input value="Remove" type="submit" class="button-primary" name="RemoveBibdata" />
                        </div>
                    </form>
                        <div class="input-status left-form">
                            <input class="button-primary" value="Status: On database" id="status" style="display:none" disabled/>
                        </div>
                    
            </div>  
        <div style="clear: both; margin-bottom:10px;"></div>
        <?php endforeach; ?>
        <?php else: ?>
            <p> No data found </p>
        <?php endif; ?>



<?php   


    




}



?>
