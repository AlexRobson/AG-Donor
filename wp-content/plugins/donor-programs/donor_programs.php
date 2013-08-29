<?php
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
    elseif( isset($_POST['method']) && $_POST['method'] == 'bibliography' ){
        echo display_papers($bibdata);
    }
	else{
		echo 'NO DATA!';
	}
	die();
}

function get_bibliography( $data = array(), $template = null, $selection_name = ''){

    $bibdb_obj = new getbibinfofromdatabase();
    $bibindexarray = $data[0]['bibindex'];;
    $bibdata = $bibdb_obj->get_bibdata($bibindexarray);

	include 'templates/template-front-end-populate-bibinfo.php';


    echo display_papers($bibdata);
}

function get_results_with_bibinfo( $data = array(), $template = null, $selection_name = ''){
   
    $bibdb_obj = new getbibinfofromdatabase();
    $bibindexarray = $data[0]['bibindex'];;
    $bibdata = $bibdb_obj->get_bibdata($bibindexarray);

	include 'templates/template-front-end-populate-bibinfo.php';
//	echo display_metaresults_with_papers($bibdb_obj, $bibindexarray, $bibdata,$data);
//    echo display_papers($bibdata);
	
}

function get_results( $data = array(), $template = null, $selection_name = ''){
	include 'templates/template-front-end-results.php';
}


function get_info_front_end( $labels = null ){
	include 'includes/get-info-from-database.class.php';
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


add_action('wp_ajax_donoradmin_action', 'donorprog_admin_ajax_call');
add_action('wp_ajax_nopriv_donoradmin_action', 'donorprog_admin_ajax_call');
function donorprog_admin_ajax_call(){

	include 'includes/get-info-from-database.class.php';
	$db_obj = new getinfofromdatabase();
    include 'templates/template-backend-ajax.php'; 

    if( isset($_POST['data']) ){        
        $csv = array_map("str_getcsv", explode("\n", $_POST['data']));
//        echo "<pre>"; print_r($csv); echo "</pre>";
    	$keys = array_shift($csv);
        foreach($csv as $i=>$row) {
        	$csv[$i] = array_combine($keys,$row);
            };   
//        echo "<pre>"; print_r($keys); echo "</pre>";
    };

    echo display_interpretation_header();

    foreach ($csv as $i=>$line) {
        $id['program_id'] = $db_obj->custom_get_program_id($line['program']); 
        $id['outcome_id'] = $db_obj->custom_get_outcome_id($line['outcome']);  
        $rids = $db_obj->custom_get_relations($id);
        echo  donorprog_admin_display_intepretation($csv[$i],$db_obj,$rids);
        // For each relatiion ID, get the stored outcome values
    };
            
    (isset($_POST['method']))? 'continue':die();
    reset($rids);
    for ($i=0; $i<( ($_POST['method']=='all') ? count($csv):$_POST['method'] )    ; $i++) {
        $line = $csv[$i];
        $id['program_id'] = $db_obj->custom_get_program_id($line['program']); 
        $id['outcome_id'] = $db_obj->custom_get_outcome_id($line['outcome']);  
        $rids = $db_obj->custom_get_relations($id);

        echo display_equivalent_header($line,$i); 
        echo '<div class="outcome_array">';
        foreach ($rids as $j=>$rid){
            echo donorprog_admin_display_recorded_outcomes($db_obj->admin_get_outcome_values($rid['id']), $rid['id'],$id );
        //    if ($j==3){ break; };
        };
        echo '</div>';

    };

    die();
}

add_action('wp_ajax_donoradmin_update', 'donorprog_admin_ajax_call_update');
function donorprog_admin_ajax_call_update(){
	
	include 'includes/get-info-from-database.class.php';
    $db_obj = new getinfofromdatabase();
    $relations = str_replace('position','0',$_POST['relations']);  
    parse_str(urldecode($relations),$relations);


	$relations['relations']['relation_id'] = 'relation_id';//count($db_obj->admin_get_relations());
    if( isset($_POST['relations']) ){
        if ($_POST['method']=='create'){
//        echo '<pre>';print_r( $relations );echo '</pre>'; exit;
        $new_id = $db_obj->admin_save_relations($relations);
        $relations['relations']['id'] = $new_id;
        $db_obj->admin_save_relations($relations);
        echo $new_id;
 //       return $new_id;
        }
        elseif ($_POST['method']=='remove'){
            $relations['relations']['remove'] = 'on';
           $relations['relations']['id'] = $relations['relations-id']; 

        echo '<pre>';print_r( $relations );echo '</pre>'; exit;
        $db_obj->admin_save_relations($relations);
        echo $relations['relations']['id'];
        }
    };

die(); // Prevent the trailing zero from appearing    
}

?>
