<?php

/*
 * 
 * AID Grade, Nov - Dec, 2012.
 * - Show results data in the scale.
 * This template is used in the meta-analysis page only
 *      It is based on the template-front-end-results.php template
 *      The additions include template handling of bibligraphy data
 *      This means modifcation to include weights and meta-analysis summary
 * - This template is always showed by an Ajax call.
 */

?>




<?php if( !$data ): ?>
<h3 style="text-align: center;">0 studies have been found. Please change your criteria and submit your search again.</h3>
<style type="text/css"> .result{ margin-bottom: 0px !important; } </style>
<?php else: ?>
<p class="title-outcome"><?php echo ($template=='outcome')?'Programs':'Outcome'; ?></p>
<p class="title-effects">Effects</p>
<?php 
	$lowest = array();
	$highest = array();
	$adjust_tool_tip_value_units = array();
	for( $i=0; $i<count($data); $i++ ):
		
		/*if(str_replace(' ', '-', strtolower(trim($data[$i]['unit']))) == 'percentage-points' && abs($data[$i]['lower']) >= 1 && abs($data[$i]['upper']) >= 1 ){
				$data[$i]['lower'] = round($data[$i]['lower']/100, 2);
				$data[$i]['upper'] = round($data[$i]['upper']/100, 2);
				$adjust_tool_tip_value_units[$i] = $data[$i]['mean'];
				$data[$i]['mean'] = round($data[$i]['mean']/100, 2);
		}
		else{*/
			$adjust_tool_tip_value_units[$i] = $data[$i]['mean'];
		/*}*/
		
		$lowest[] = $data[$i]['lower'];
		$highest[] = $data[$i]['upper'];
	endfor;
	$lowest = min($lowest);
	$highest = max($highest);
		
	$apply_zoom = 1;
	$continue = true;
	for( $i=0.5; $i<3; $i+=0.5 ){
		if( ( ( $lowest>=-1*$i && $lowest<= 0 ) || ( $lowest <= 1*$i && $lowest >=0 ) ) && ( ( $highest>=-1*$i && $highest<= 0 ) || ( $highest <= 1*$i && $highest >=0 ) ) ){
			switch ( $i ){
				case 0.5:
					if( abs($lowest) <= 0.1 && abs($highest) <= 0.1 )
						$apply_zoom*=30;
					else
						$apply_zoom*=15;
					break;
				case 1:
					$apply_zoom*=6;
					break;
				case 1.5:
					$apply_zoom*=4;
					break;
				case 2:
					$apply_zoom*=3;
					break;
				case 2.5:
					$apply_zoom*=2;
					break;
				default :
					$apply_zoom*=1;
					break;
			}
			break;
        }
	}
	?>
	<?php	
	for( $i=0; $i<count($data); $i++ ):
	if( $data[$i]['lower'] < $data[$i]['upper'] && $data[$i]['lower']<=$data[$i]['mean'] && $data[$i]['upper']>=$data[$i]['mean'] ):
		
		$limit_off_left = false;
		if( $data[$i]['lower']<-5 ){
			$data[$i]['lower'] = -5;
			$limit_off_left = true;
		}
		$limit_off_right = false;
		if( $data[$i]['upper']>5 ){
			$data[$i]['upper'] = 5;
			$limit_off_right = true;
		}
//		$data[$i]['lower'] = $data[$i]['lower']<-5?-5:$data[$i]['lower'];
//		$data[$i]['upper'] = $data[$i]['upper']>5?5:$data[$i]['upper'];

		$lower = ceil(round($data[$i]['lower'], 2)/0.02)*$apply_zoom;
		$upper = ceil(round($data[$i]['upper'], 2)/0.02)*$apply_zoom;
		$mean = ceil(round($data[$i]['mean'], 2)/0.02)*$apply_zoom;

		$margin_left = abs($lower - $mean)-12;
		$slice_width = abs($upper-$lower);
		$slice_margin_left = $lower+291;
		
		//print_r( $adjust_tool_tip_value_units ); exit;
?>
<div class="result-info<?php echo ($i==0)?' meta':(($i+1==count($data))?' last paper':' paper'); ?>">
	<div class=nameblock" style="float:left">
        <p class="name" style="margin: 0; float:none"><?php echo $data[$i]['name']; ?>
<?php if ($i==0): ?>
    </p>
    <div class="metabutton">
                <p class="meta-buttons" style=height:16px;">
                <a href="javascript:;" class="button" id="togglestudy" >&nbsp</a> 
                <a href="javascript:;" class="button" id="togglepapers">&nbsp</a> 
                <a href="javascript:;" class="button" id="downloaddata">&nbsp</a>
                </p>
                <p class="button-description"></p>
    </div> 
<?php else: ?>
        (<?php echo $bibdata[$i]['year']?>)</p>
<?php endif; ?>
        <p class="weight" style="margin: 0; float:none">Weighting: <?php echo sprintf('%0.2f',100*$data[$i]['weight']); ?>%</p>
	</div>
<?php if( $apply_zoom == 1 && false ): ?>
	<div id="scale-zoom" style="float: left; font-family: 'Pompiere',Arial,Helvetica,sans-serif; position: absolute; right: 0; top: 3px;">
		Scale Zoom&nbsp;<span class="0">(x1)</span>&nbsp;
		<?php if( $slice_width + $slice_margin_left < 600 && $slice_margin_left > 12 ): ?>
		<a href="#" class="zoom-add" style="font-size: 20px;">+</a>&nbsp/&nbsp<a href="#" class="zoom-deduct" style="font-size: 20px;">-</a>
		<?php endif; ?>
	</div>
	<?php endif; ?>
	<div class="slice" style="margin: 30px 0 0 <?php echo $slice_margin_left; ?>px; width: <?php echo $slice_width; ?>px;">
		<p class="left-count">
			<?php if( $limit_off_left ): ?>
			<img src="<?php bloginfo('url'); ?>/wp-content/themes/aidgrade/images/arrow-left.png" style="height: 8px; width: 13px; position: absolute; left: -16px; top: 5px;" />
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php else: ?>
			<?php echo $data[$i]['lower']; ?>
			<?php endif; ?>
        </p>

            <p class="slice-count" style="margin: 0px 0px 0px <?php echo $margin_left; ?>px; background-position: <?php echo 12.5*(1-sqrt($data[$i]['weight']));?>px <?php echo 12.5*(1-sqrt($data[$i]['weight']));?>px; background-size: <?php echo 25*sqrt(($data[$i]['weight']));?>px <?php echo 25*sqrt(($data[$i]['weight']));?>px;">
			<?php echo mouse_over_mean_text( $adjust_tool_tip_value_units[$i], $data[$i]['name'], $data[$i]['unit'], $template, $selection_name, $data[$i]['bibref'] ); ?>
			<?php if($data[$i]['lower']<$data[$i]['mean'] && $data[$i]['upper']>$data[$i]['mean']): ?>
				<?php echo $data[$i]['mean']; ?>
			<?php endif; ?>
		</p>
		<p class="right-count">
			<?php if( $limit_off_right ): ?>
			<img src="<?php bloginfo('url'); ?>/wp-content/themes/aidgrade/images/arrow-right.png" style="height: 8px; width: 13px; position: absolute; right: -16px; top: 5px;" />
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php else: ?>
			<?php echo $data[$i]['upper']; ?>
			<?php endif; ?>
		</p>
	</div>

	

	<?php if( $template == 'outcome' && $data[$i]['link_donate'] ): ?>
	<a href="<?php echo $data[$i]['link_donate']; ?>" target="_blank" class="donate-button">DONATE</a>
	<?php endif; ?>

</div>





<?php
        endif;
    if ($i==0) { echo "<div class='spacer'></div>"; }
	endfor;
?>
<div class="null-top"></div>
<div class="null-bottom"></div>
<?php if( $template == 'programs' && $data[$i-1]['link_donate'] ): ?>
	<a href="<?php echo $data[$i-1]['link_donate']; ?>" target="_blank" class="donate-program-button">DONATE TO THIS PROGRAM</a>
<?php else: ?>
	<style type="text/css"> .result{ margin-bottom: 0px !important; } </style>
<?php endif; ?>


	
<script type="text/javascript">
//<!--
	jQuery(document).ready(function(){		
		jQuery('span.tooltip a').powerTip({placement: 'n'});
		var $zoom_value = 10;
		var $max = false;
		jQuery("#scale-zoom a").click(function(e){
			e.preventDefault();
			$current_link = jQuery(this);
			$lower=jQuery(this).parent().parent().find('.left-count').html();
			$mean=jQuery(this).parent().parent().find('.slice-count a').attr('class');
			$upper=jQuery(this).parent().parent().find('.right-count').html();
			var $zoom = parseInt($current_link.parent().find('span').attr('class'))*10;

			$continue = false;
			if($current_link.attr('class') == 'zoom-add'){
				if(!$max){
					$zoom+=$zoom_value;
					$continue = true;
				}
			}
			else{
				if($zoom>10){
					$zoom-=$zoom_value;
					$continue = true;
				}
				else if($zoom==10){
					$zoom = 1;
					$continue = true;
				}
			}
			if($continue){
				jQuery.post('<?php echo(admin_url('admin-ajax.php')); ?>', {action:'my_special_action',method:'scale_function',lower:$lower,mean:$mean,upper:$upper,zoom:$zoom},
					function(answer){
						$resp = answer.split(',');
						if(parseInt($resp[1])+parseInt($resp[2]) < 600 && parseInt($resp[2])>12){
							$current_link.parent().find('span').html('(x'+(parseInt($zoom*0.1)+1)+')');
							$current_link.parent().find('span').attr('class', (parseInt($zoom*0.1)));
							$current_link.parent().parent().find('.slice').css('width', $resp[1]+'px').css('margin-left', $resp[2]+'px');
							$current_link.parent().parent().find('.slice-count').css('margin-left', $resp[0]+'px');
							if($zoom==1){
								$zoom = 0;
							}
							$max = false;
						}
						else{
							$max = true;
						}
						return true;
					});
			}
			return false;
		});
	});



	
//-->
</script>

<script type="text/javascript">

        jQuery(document).ready(function(){
           jQuery('.result-info').mouseenter(function() {
                jQuery(this).find('.weight').addClass('selected');
            });
            jQuery('.result-info').mouseleave(function() {
                jQuery(this).find('.weight').removeClass('selected');
            });
            jQuery('#togglestudy').mouseenter(function() {
               jQuery('.button-description').html('Toggle Studies').addClass('selected');
            });
            jQuery('#togglestudy').click(function() {
                jQuery('.result-info.paper').toggle();
            });
            jQuery('#togglepapers').click(function() {
                jQuery('.bibliography').toggle();
            });
            jQuery('#downloaddata').click(function() {
                // Add action
            });
            jQuery('#togglepapers').mouseenter(function() {
               jQuery('.button-description').html('Toggle Papers').addClass('selected');
            });
            jQuery('#downloaddata').mouseenter(function() {
               jQuery('.button-description').html('Download Data').addClass('selected');
            });
            jQuery('#togglestudy, #togglepapers, #downloaddata').mouseleave(function() {
               jQuery('.button-description').html('').removeClass('selected');
            });
            

        });


</script>




<!--
<script type="text/javascript">
        // Make changes to CSS styling to reflect weighting
        jQuery(document).ready(){
            jQuery('result-in').each(function(index){




</script>
-->



<?php endif; ?>


<style type="text/css">
.result-info.paper p.name {text-indent: 10px; font-size:14px; padding: 30px 0px 15px 0px;}
.result-info.meta p.name  {padding: 20px 0px 15px 0px}
.result-info.last {padding: 0px 0px 25px 0px; background: url(../wp-content/themes/aidgrade/images/bg_outcome.jpg) bottom left repeat-x;}

.result-info p.button-description {text-indent: 20px; font-size: 12px; padding: 10px 0px 10px 0px; color:#f5f5f5; height: 12px; background: url(../wp-content/themes/aidgrade/images/bg_effects.jpg) top right repeat-y;}
.result-info p.weight {text-indent: 20px; font-size: 12px; padding: 10px 0px 10px 0px; color:#f5f5f5; background: url(../wp-content/themes/aidgrade/images/bg_effects.jpg) top right repeat-y; }
.result-info p.weight.selected {color:#bababa} 


p.button-description.selected {color:#bababa} 

.download-data-button {
background: url(../wp-content/themes/aidgrade/images/bg-donor-button.png) 0px 0px repeat-x;
position: absolute;
bottom: -50px;
left: 395px;
border: 1px solid #dadada;
padding: 8px 13px;
color: #3d3d3d;
font-family: 'Open Sans', Arial, Helvetica, sans-serif;
font-size: 13px;
-webkit-border-radius: 20px;
-moz-border-radius: 20px;
-ms-border-radius: 20px;
-o-border-radius: 20px;
border-radius: 20px;
}

.meta-buttons {
    height:16px;
    padding-top: 10px:
    padding-bottom: 10px;
background: url(../wp-content/themes/aidgrade/images/bg_effects.jpg) top right repeat-y;

}

.meta-buttons .button {
width: 19px;
height: 19px;
margin-left: 20px;
background: url(../wp-content/themes/aidgrade/images/icon_question.png) no-repeat;
background-size: 25px 25px;
display:inline-block;
}
#togglestudy {

background: url(../wp-content/plugins/donor-programs/templates/images/Zoom.png) no-repeat;
}

#togglepapers {

background: url(../wp-content/plugins/donor-programs/templates/images/Document.png) no-repeat;
}


#downloaddata {

background: url(../wp-content/plugins/donor-programs/templates/images/Download.png) no-repeat;
}
#biblistheader {
font-family: 'Open Sans', Arial, Helvetica, sans-serif;
font-weight: bold;
font-size: 18px;
color: #3e3e3e;
}
.author .title {
font-family: 'Open Sans', Arial, Helvetica, sans-serif;
}
.title {
color: #3e3e3e;
}
.result {

}

</style>
