<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
	<?php if( count($list_of_selection) ): ?>
	<div class="metaanalyses donors">
		<div class="top-part">
			<div class="step-one">
				<p class="title"><?php echo $labels['label_title']; ?></p>
				<?php if( $help ): ?>
				<a href="javascript:;" class="question" title="<?php print_r($help); ?>"></a>
				<?php endif; ?>
				<div class="fun-area">
					<div class="wpsc_variation_forms">
						<div class="list-box">
							<div class="list-val"><?php echo $labels['select_default']; ?></div>
							<div class="wrap-list">
								<ul class="select-list">
									<?php for( $i=0; $i<count($list_of_selection); $i++ ): ?>
									<li rel="<?php echo $list_of_selection[$i]['id']; ?>"><?php echo $list_of_selection[$i]['name']; ?></li>
									<?php endfor; ?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
			
		<div class="mid-part">
			<div class="result">
				<div class="result-in">
					<!-- RESULTS -->
				</div>	
			</div>
		</div>

		

	</div>
	<script type="text/javascript">
	//<!--
		jQuery(document).ready(function(){
			jQuery(".list-box .list-val").click(function(){
				jQuery(this).addClass('exp').next().addClass('active').show();
				jQuery(this).bind( "clickoutside", function(event){
				jQuery(this).removeClass('exp').next().removeClass('active').hide();
				});
			});

			jQuery(".list-box ul.select-list li").click(function(){
				if( jQuery('.list-val').html() != jQuery(this).html() ){
					jQuery('.list-val').html(jQuery(this).html());

					jQuery.post('<?php echo(admin_url('admin-ajax.php')); ?>', {action:'my_special_action',selection:'<?php echo strtolower($labels['column_title']); ?>',selectionid:jQuery(this).attr('rel')},
					function(answer){
						jQuery(".mid-part div.result div.result-in").html(answer).parent().show('slow');
						return true;
					});
				}
				jQuery(this).closest('div.active').removeClass('active').hide().prev().removeClass('exp');
			});
			
			jQuery('div.step-one a').powerTip({placement: 'n'});
		});
	//-->
	</script>
	<?php endif; ?>
