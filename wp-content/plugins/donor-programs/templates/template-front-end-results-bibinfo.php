<?php
if( array_key_exists('bibindex',$data)): 
       	$bibdb_obj = new getbibinfofromdatabase();
        $bibindexarray = $data['bibindex'];;
	$bibdata = $bibdb_obj->get_bibdata($bibindexarray);

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

	<div class="bibligraphy">
                <p class="bibligraphy" style="clear:both">              
 
                <div class="biblist">
		<?php foreach($bibdata as $bibitem): ?>
	        <div class="bibentrylong"  <?php echo 'id=bib'.$bibitem['entries_id'] ?> style="clear:both; display:inline"> 
			<p class="author">
			<?php echo $bibitem['author']; echo " (".$bibitem['year'].")";?>
			</p>
			<p class="title">
			<?php echo $bibitem['title'] ?>	
			</p>
      		</div>    
		<?php endforeach; ?>
		</div>
	</div>

<?php endif; ?> 

<!--	<p id="getmore" class="title-effects"style="clear:right;float:right"><a href="javascript:;" class="question"></a> Show more! </p>
-->




<script type="text/javascript">
jQuery(document).ready(function() {
	jQuery('#getmore').click(function() {
		jQuery('.bibdetailsfurther').toggle();
	});

});

</script>


<script type="text/javascript">
jQuery(document).ready(function() {
	jQuery('#bibtoggle').click(function() {
		jQuery('.bibentrydetail').toggle();
	});
});
</script>


<script type="text/javascript">
jQuery('.bibentry').mouseover(function() {
jQuery('.bibentrydetail').html(jQuery('.bibentrylong#'+this.id).html());	
});

</script>


<div class="bibtest" style="display:none; background:white">
	<p class="bibentry" style="clear:both">
		<p class="author">
                <?php echo $bibitem['author']; echo " (".$bibitem['year'].")";?>
                </p>
                <p class="title">
                <?php echo $bibitem['title'] ?>
                </p>
	</p>
</div>


<?php


//echo get_results( $bibdb_obj->get_paper_data($bibindexarray), 'programs','');

?>

<!--
<div class="bibligraphy">
                <p class="bibligraphy" style="clear:both">              
 
                <p id="bibtoggle" class="title-effects"style="clear:both"> Click to hide studies </p>   
                <div class="biblist">
		

		</div>
</div>
-->

