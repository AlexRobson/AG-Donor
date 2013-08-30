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
<?php echo display_metaresults_with_papers($bibdb_obj, $bibindexarray, $bibdata,$data,$template,$selection_name); ?>
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

function display_metaresults_with_papers($bibdb_obj, $bibindexarray, $bibdata,$metastudydata,$template,$selection_name){

    # Construct the data to represent the individual studies comprising the requested meta-analysis
    # Variables include lower, mean, upper, weighting etc.
    $single_studies = $bibdb_obj->get_paper_data($bibindexarray);
//    $metastudydata[0]['weight']=1; 
	foreach($single_studies as $i=>$item){
        	$single_studies[$i]['name'] = $bibdata[$i]['author'];
    }
    array_unshift($single_studies,$metastudydata[0]);
    
  //  print "<pre>"; print_r($single_studies); print "</pre>";
    $data = $single_studies;
    
    include 'template-front-end-forestplot.php';
}

function display_papers($bibdata){

?>
    <div class="bibliography" style="display:none">

	<div class="spacer"></div>
                <p class="bibligraphy" style="clear:both">              
                <div class="bibentrydetail">
	
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
                    <?php echo $bibitem['title'] ?>
                    </li>    
                    </p>
      		</div>    
        <?php endforeach; ?>
        </ol>



	</div>

    

<?php 
}

?>

