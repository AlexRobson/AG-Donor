<?php

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
                                ".$this->table_prefix."programs.name AS prog_name,
                                ".$this->table_prefix."outcome_values.relation_id
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
        $result[0]['bibindex'] = array_slice($numbers,0,$numstudies);
        $result[0]['bibindex'] = null;
		include 'get-bibinfo-from-database.class.php';
        //        $db_bibobj = new getbibinfofromdatabase;
        $sql = $wpdb->prepare("SELECT 
                            bibref
                            FROM
                            ".$this->table_prefix."outcome_values
                            WHERE relation_id = '".$result[0]['relation_id']."'
                            ;");
        //        echo $sql;

        $bibindex = $wpdb->get_results($sql, ARRAY_A); 
        $result[0]['bibindex'] = explode(';',$bibindex[0]['bibref']);
//        print_r($result);
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
                        ".$this->table_prefix."outcome_values.number_of_studies,
						".$this->table_prefix."outcome_values.bibref
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

//				echo '<pre>';print_r($data);echo '</pre>';
		for($i=0; $i<count($data); $i++){
			$outcome_values[$i] = current($data);
			if( isset($outcome_values[$i]['remove']) && $outcome_values[$i]['remove'] == 'on' ){
				$this->remove_outcome_values($outcome_values[$i]['id'], null, $wpdb);
			}
			if( isset($outcome_values[$i]['id']) && isset($outcome_values[$i]['relation_id']) ){
				$sql = $wpdb->prepare( "INSERT ".$this->table_prefix."outcome_values 
									SET 
										lower='".trim($outcome_values[$i]['lower'])."', 
										mean='".$outcome_values[$i]['mean']."', 
										upper='".$outcome_values[$i]['upper']."', 
										unit='".$outcome_values[$i]['unit']."', 
										randomized_filter='".$outcome_values[$i]['randomized_filter']."', 
										blinded_filter='".$outcome_values[$i]['blinded_filter']."', 
										effects='".$outcome_values[$i]['effects']."', 
										rflag='".(($outcome_values[$i]['rflag']==1)?'both':0)."',
										number_of_studies='".$outcome_values[$i]['number_of_studies']."',
										bibref='".(isset($outcome_values[$i]['bibref'])? $outcome_values[$i]['bibref']:"NULL")."'
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
											'".$outcome_values[$i]['number_of_studies']."',
    										'".(isset($outcome_values[$i]['bibref'])? $outcome_values[$i]['bibref']:"NULL")."'
									);");
				$resp = $wpdb->query( $sql );
            }

//				 echo preg_replace('/(\s)+/', ' ',$sql); exit;
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
           // 			echo '<pre>';print_r( $data );echo '</pre>';
//            echo count($data);
			global $wpdb;
			reset($data);
			for( $i=0; $i<count($data); $i++ ){
				$relations[$i] = current($data);
//				echo '<pre>';print_r( $relations[$i] );echo '</pre>';
				if( isset($relations[$i]['remove']) && $relations[$i]['remove'] == 'on' ){
					$this->admin_remove_relation( $relations[$i]['id'], $wpdb );
				}
                elseif( isset($relations[$i]['id']) ){
					$sql = $wpdb->prepare( "UPDATE ".$this->table_prefix."relations SET program_id='".$relations[$i]['program_id']."', outcome_id='".$relations[$i]['outcome_id']."' WHERE id='".$relations[$i]['id']."';" );
					$resp = $wpdb->query( $sql );
					if( isset( $relations[$i]['outcome_values'] ) ){
						$resp2 = $this->save_outcome_values( $relations[$i]['outcome_values'], $relations[$i]['id'], $wpdb );
                    };
				}
				else{
					if( $relations[$i]['program_id'] && $relations[$i]['outcome_id'] ){
						$sql = $wpdb->prepare( "INSERT INTO " . $this->table_prefix . "relations VALUES ( '', '".$relations[$i]['program_id']."', '".$relations[$i]['outcome_id']."' );" );
                        $resp = $wpdb->query( $sql );
                        // Next line has been added
//                        return $resp;
                        return mysql_insert_id();
//                        exit;
					}
				}
               // 			print_r($sql);
//                exit;
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

	function custom_get_program_id($name){
		global $wpdb;
		$sql = "SELECT id FROM ".$this->table_prefix."programs WHERE name='".$name."'";
		$resp = $wpdb->get_results($sql,ARRAY_A);
//		print_r($resp);
//		echo $sql;	
        return (empty($resp)	? 'not found':$resp[0]['id']);
	}

	function custom_get_outcome_id($name){
		global $wpdb;
		$sql = "SELECT id FROM ".$this->table_prefix."outcomes WHERE name='".$name."'";
		$resp = $wpdb->get_results($sql,ARRAY_A);
//		print_r($resp);
//		echo $sql;	
        return (empty($resp)	? 'not found':$resp[0]['id']);
    }

    function custom_get_relations($id){
        global $wpdb;
        // From the relations table, lookup those with the ID <x>
        if (isset($id['program_id']) && isset($id['outcome_id'])){
            $where_clause = " WHERE (
                ".$this->table_prefix."relations.program_id=".$id['program_id']. " AND 
                ".$this->table_prefix."relations.outcome_id=".$id['outcome_id']. ")";
                $sql = $wpdb->prepare(
                                " SELECT
                                    ".$this->table_prefix."relations.id,
                                    ".$this->table_prefix."relations.program_id,
                                    ".$this->table_prefix."relations.outcome_id
                                FROM
                                    ".$this->table_prefix."relations 
                                ".$where_clause."
                                ORDER BY
                                    ".$this->table_prefix."relations.id ASC;");
                $resp = $wpdb->get_results( $sql, ARRAY_A );
                return $resp;
        }
        else {
            die('IDs not found');
        }
    }

    



}
?>
