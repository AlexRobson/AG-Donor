<?php

/*
 *  This file produces all the results relevant to displaying
 *  bibligraphy information. 
 *
 *
 *
 */





?>
<div class="result-in" style="position:relative";>
<?php echo display_metaresults_with_papers($bibdb_obj, $bibdata,$data,$template,$selection_name); ?>
</div>
<div class="papers">
<?php echo display_papers($bibdata); ?>
</div>

<?php
function populate_bibup($bibdata){

    // Obsolete code

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

function display_metaresults_with_papers($bibdb_obj, $single_studies,$metastudydata,$template,$selection_name){
    if(isset($single_studies)){
    # Construct the data to represent the individual studies comprising the requested meta-analysis
        # Variables include lower, mean, upper, weighting etc.
        
        if(!empty($single_studies)){
        array_unshift($single_studies,$metastudydata[0]);
        $data = $single_studies;
        $weights = explode(',',$metastudydata[0]['weights']);
//        var_dump($weights);
        array_unshift($weights,100);
        foreach ($data as $i=>$datum){
            $data[$i]['lower'] =  roundsf($datum['lower'],2);
            $data[$i]['upper'] =  roundsf($datum['upper'],2);
            $data[$i]['mean'] =  roundsf($datum['mean'],2);
            $data[$i]['weight'] = $weights[$i]/100;
        }
        unset($i);
//        echo "<pre>"; print_r($data[count($data)-1]); echo "</pre>";


        include 'template-front-end-forestplot.php';
        }
        else{
            $data = $metastudydata; 

            $data[0]['name'] = $data[0]['name']." (Missing studies)";
        include 'template-front-end-results.php';
        }
    }
    else{
        $data = $metastudydata; 
        $data[0]['name'] = $data[0]['name']." (Missing studies)";
        include 'template-front-end-results.php';
    };
}

function display_papers($bibdata){
?>
    <div class="bibliography" style="display:none">

	<div class="spacer"></div>
                <p class="bibligraphy" style="clear:both">              
                <div class="bibentrydetail">
	
<?php if(isset($bibdata)){ ?>
		<p id="biblistheader">
		Contributing Papers
        </p>
        <ol> 
		<?php foreach($bibdata as $bibitem): ?>
            <div class="bibentrylong"  <?php echo 'id=bib'.$bibitem['entries_id'] ?> style="clear:both; display:inline"> 
                    <li>
                    <p class="author">
                    <?php echo $bibitem['author']; echo " (".$bibitem['year'].")";?>
                    </p>
                    <p class="title">
                    "<?php echo $bibitem['title'] ?>",
                    </p>
                    <p class="title">
                    <?php echo $bibitem['journal'] ?>
                    </p>
                    </li>    
      		</div>    
        <?php endforeach; ?>
        </ol>
<?php } ?>


	</div>

    

<?php 
}

?>

