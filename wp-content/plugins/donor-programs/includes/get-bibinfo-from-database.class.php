<?php


/*
// Add An
CREATE TABLE `wp_donor_bibdata` (
 `entries_id` int(11) NOT NULL AUTO_INCREMENT,
 `paper_id` int(11) NOT NULL,
 `lower` decimal(10,0) NOT NULL,
 `ES` decimal(10,0) NOT NULL,
 `upper` decimal(10,0) NOT NULL,
 `outcome` int(11) NOT NULL,
 `program` int(11) NOT NULL,
 `author` varchar(500) DEFAULT NULL,
 `year` int(11) NOT NULL,
 `title` varchar(500) DEFAULT NULL,
 `journal` varchar(500) DEFAULT NULL,
 `units` varchar(50) DEFAULT NULL,
 PRIMARY KEY (`entries_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1
 */



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
//        print_r($bibindexarray);
        $bibref_columnid = "entries_id";
        $bibtable_name = "bibdata";
        if ($bibindexarray=="*"){
            $where_clause =''; 
        }
        elseif(!isset($bibindexarray)){
//            return null;
        }

        else{
            $bibstring = implode(',',$bibindexarray);
            # For each bibindex array get the appropriate row in the bibindex table
            $where_clause = "WHERE
                            ".$this->table_prefix.$bibtable_name."."."paper_id IN ($bibstring)";
        }

		$from = "author, author as name, title, journal, year, entries_id, paper_id, lower, ES, ES AS mean, upper, outcome, program, unit"; 

		$sql = $wpdb->prepare("SELECT ".$from." "." FROM ".$this->table_prefix.$bibtable_name ." " .$where_clause);
//		print_r(preg_replace("/\s+/"," ",$sql." ".$where_clause));
		$result = $wpdb->get_results( $sql, ARRAY_A);

		if (!result) {
            echo 'No bibligraphic data found: ' . mysql_error();
            return false;
		}
//        print_r($sql);
		return $result?$result:null;

	}
	
	public function get_paper_data($bibindexarray) {
    # This function returns the values of each paper indexed in bibindexarray the appropriate values for construction in the meta-analysis study
        // Constuct an array like 'data' 
//        print_r($bibindexarray);
        $result = null;
        if(isset($bibindexarray)){
            $bibstring = implode(',',$bibindexarray);	
//            print_r($bibstring);
                    if( $bibindexarray ){
                            global $wpdb;

            $select = "entries_id, lower, ES, upper, unit"; 
            $from = $this->table_prefix."bibdata";
            $where=$this->table_prefix."bibdata.paper_id IN ($bibstring)";
                            $sql = $wpdb->prepare("SELECT " .$select." FROM ".$from." WHERE ".$where);
                            $result = $wpdb->get_results($sql, ARRAY_A);

//            print_r($sql);
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
                $result[$i]['mean'] = $result[$i]['ES'];
            }
            unset($item);

    //        echo "<pre>";print_r($result);echo "</pre>";
            return $result?$result:null;


            }
        }
        else{
            return null;
        };

    }

    public function admin_bib_update($data,$method){

        reset($data);
        global $wpdb;
		for($i=0; $i<count($data); $i++){
            $bibdata = current($data);
//            print_r(mysql_real_escape_string($bibdata['author']));
            
            if ($method=='save'){
				$sql = $wpdb->prepare( "INSERT ".$this->table_prefix."bibdata 
									SET 
										lower='".$bibdata['lower']."', 
										ES='".$bibdata['ES']."', 
										upper='".$bibdata['upper']."', 
										unit='".$bibdata['units']."', 
										author='".mysql_real_escape_string($bibdata['author'])."', 
										title='".mysql_real_escape_string($bibdata['title'])."', 
										journal='".$bibdata['journal']."', 
										outcome='".$bibdata['outcome']."', 
										program='".$bibdata['program']."', 
                                            year='".$bibdata['publicationyear']."',
                                        paper_id='".$bibdata['paperid']."'
                                        ;" );

                $resp = $wpdb->query( $sql );
//                echo preg_replace("/\s+/", " ", $sql);
            };

            if ($method=='Remove'){
                $resp = $this->remove_bibitem($bibdata['entries_id'],$wpdb);
            }


 //           echo $resp;
            return $resp;
        }; 

    }

	private function remove_bibitem( $id = null, $wpdb =  null ){
		if($id && $wpdb){
			$sql = $wpdb->prepare("DELETE FROM ".$this->table_prefix."bibdata WHERE entries_id='".$id."'");
			$resp = $wpdb->query( $sql );
			return ($resp)?true:false;
		}
		else{
			return false;
		}
    }

    public function get_paper_bibdata($bibindexarray){
    
        global $wpdb;	
//        print_r($bibindexarray);
        $bibref_columnid = "paper_id";
        $bibtable_name = "bibdata";
        if ($bibindexarray=="*"){
            $where_clause =''; 
        }
        else{
            $bibstring = implode(',',$bibindexarray);
            # For each bibindex array get the appropriate row in the bibindex table
            $where_clause = "WHERE
                            ".$this->table_prefix.$bibtable_name.".".$bibref_columnid." IN ($bibstring)";
        }

		$from = "author, year"; 

		$sql = $wpdb->prepare("SELECT ".$from." "." FROM ".$this->table_prefix.$bibtable_name ." " .$where_clause);

//		print_r(preg_replace("/\s+/"," ",$sql." ".$where_clause));
		$result = $wpdb->get_results( $sql, ARRAY_A);
 

		if (!result) {
            echo 'No bibligraphic data found: ' . mysql_error();
            return false;
		}
//        print_r($sql);
		return $result?$result:null;



    }

}
?>



