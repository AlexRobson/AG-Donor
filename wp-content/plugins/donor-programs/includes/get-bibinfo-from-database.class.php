<?php


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
	
		# Funtion to get key data from table.
		# Input: An array of integers indexing the papers
		# Output: An Array containing bibligraphic variables; author, title, etc.
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
    # This function returns the values of each paper indexed in bibindexarray the appropriate values for construction in the meta-analysis study
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


        # Use random numbers to create weights
                        $weights = array();
        for ($i=0; $i <=count($result); $i++) {
            $weights[$i]=rand();
        }
        $weights = array_map(
            function($val, $factor) { return ($val / $factor); },
            $weights,
            array_fill(0,count($weights), array_sum($weights))
        );

    

		foreach($result as $i=>$item){
            $result[$i]['name'] = '';
            $result[$i]['weight']=$weights[$i];
		}
        unset($item);

//        echo "<pre>";print_r($result);echo "</pre>";
		return $result?$result:null;


                }



	}



}


?>
