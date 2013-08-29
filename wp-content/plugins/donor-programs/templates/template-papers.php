
	<div class="spacer"></div>
	<div class="bibliography">
                <p class="bibligraphy" style="clear:both">              
                <div class="bibentrydetail">
	
		<p id="biblistheader" style="font-weight: bold;font-size: 18px;">
		Contributing Papers
		</p> 
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
