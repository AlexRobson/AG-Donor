<?php

function cms_slider($w=null, $h=null, $sec=null, $styles = null) {

	global $config;
  $inq_config = json_decode(get_option('inq-config'));
  
	if(!$sec) $sec = 7;
  $msec = 1000 * $sec;
  
	$sliders = json_decode(get_option('gov-home'));
  $path_tim = plugins_url( 'includes/timthumb.php' , dirname(__FILE__) );
     
	$width = !empty($inq_config->width)?$inq_config->width:500;
  $height = !empty($inq_config->height)?$inq_config->height:400;

  if(!empty($inq_config->pager_thumb_width))
		$pager_img_opts .= "&w=$inq_config->pager_thumb_width";
      
  if(!empty($inq_config->pager_thumb_height))
		$pager_img_opts .= "&h=$inq_config->pager_thumb_height";
      
  $pager_img_opts .= '&a=tl';	
?>

<div id="home-slider">
    
    <div id="navigate">
        <a href="" id="linkprev"></a>
        <span id="spanprev"></span>
        <a href="" id="linknext"></a>
        <span id="spannext"></span>
    </div>
    
	<div id="slider">
	
	<?php
  //if(!empty($sliders)):
	if( sizeof($sliders) >= 2):
		
		//Remove a slider without image.
		for($i=0; $i < sizeof($sliders); $i++ ):
			if($sliders[$i]->image == ""):
				unset($sliders[$i]);
			endif;
		endfor;
		$position_slide = 1;
		foreach ($sliders as $key => &$slider): 
			
			if($slider->link != ""):
				$prot = strstr($slider->link,'http://');
				if($prot == false):
					$slider->link = "http://".$slider->link;
				endif;
			endif;
			
			$slider = (array) $slider; ?>
			
		<div class="slide item<?php echo ($key+1); ?><?php echo ($slider['type']=='html')? ' slide-html':'' ?>">
	  
	  <?php	  
	  $img_opts = "";
	  $crop = '';	  
	  
	  if($inq_config->crop=='no') :
	    $size = $slider['size'];
	  
	    if($size->width >= $size->height){
	      if(!empty($width)){
					if($size->height<= $height)
						$img_opts .= "&w=$width";
					else
						$img_opts .= "&amp;h=$height";
	      }
	    } else {
	      
	      if(!empty($height)) {
					if($size->width <= $width){
						$img_opts .= "&amp;h=$height";
					} else {
						if($size->height<= $height)
							$img_opts .= "&amp;w=$width";
						else
							$img_opts .= "&amp;h=$height";
					}
	      }
	    }
	  else :
	    $crop = 'tl';
	    if(!empty($width))
				$img_opts .= "&amp;w=$width";
	    
	    if(!empty($height))
				$img_opts .= "&amp;h=$height";	    
	  endif;

	  $img_opts .= '&amp;a=tl';
	  
	  $attributes = '';
	 // $attributes .= empty($inq_config->width)?'':"width= \"{$inq_config->width}\"";
	  $attributes .= empty($inq_config->height)?'':"height= \"{$inq_config->height}\"";
		?>
		
	  <?php if($slider['type'] == 'html'): ?>
	    
			<div class="slide-info">
				<?php if($slider['title']): ?>
					<strong><?php echo $slider['title']; ?></strong>
				<?php endif; ?>  
				<?php echo $slider['html']; ?>  
	    </div>
	  
		<?php else: ?>
			
	    <div class="img_container">
            <div class="img_box">
                <div class="slide slide<?php echo $position_slide; ?>">
				<?php if($inq_config->crop == 1):?>
					<!--a href="<?php echo $slider['link']; ?>" title="Read more <?php echo strip_tags($slider['title']); ?>" target="_blank"-->
                    <img class="item<?php echo ($key+1); ?>" src="<?php echo $path_tim."?src=".$slider['image'].$img_opts.$crop; ?>" alt="<?php echo $slider['alt']?$slider['alt']:$slider['title']; ?>"  title="<?php echo $slider['title']; ?>"/>
                    <!--/a-->
				<?php else: ?>
					<!--a href="<?php echo $slider['link']; ?>" title="Read more <?php echo strip_tags($slider['title']); ?>" target="_blank"-->
                    <img class="item<?php echo ($key+1); ?>" src="<?php echo $path_tim."?src=".$slider['image'].$img_opts; ?>" alt="<?php echo $slider['alt']?$slider['alt']:$slider['title']; ?>"  title="<?php echo $slider['title']; ?>"/>
                    <!--/a-->
				<?php endif; ?>
                <div class="text">
                    <?php if($slider['title']): ?>
                    <h3><?php echo $slider['title']; ?></h3>
                    <?php endif; ?>
                    
                    <?php if($slider['text']): ?>
                    <p><?php echo substr($slider['text'],0,160); ?></p>
                    <?php endif; ?>
                    
                    <?php if(isset($slider['link']) && trim($slider['link']) != ""): ?>
                    <a href="<?php echo $slider['link']; ?>" title="Read more <?php echo strip_tags($slider['title']); ?>"<?php echo ($inq_config->newtab=='on')?' target="_blank" ':' '; ?>><?php echo $slider['text2']?$slider['text2']:'Read More'; ?></a>
                    <?php endif; ?>
                </div>
            </div>
            <span class="img-full" style="display:none"><?php echo $slider['image'] ?></span>
            </div>
      </div>

      <!--<div class="back-slide">&nbsp;</div>-->

	  <?php endif; ?>
	  </div>
        <?php $position_slide++; ?>
		<?php endforeach; ?>
        
	<?php else: ?>
	 <?php echo "DynamicSlider by default the slider has two images or slides. Please insert two or more images in the slider!".sizeof($sliders); ?>
	<?php endif; ?>
	</div>
    <div id="imgthumb_box"></div>
<?php if( sizeof($sliders) >= 2): ?>
<script type="text/javascript">
$ = jQuery;
jQuery(function($){
		
	$('.slide-html').hover(function(){
			$('#slider').cycle('pause');
		},function(){	
	});
	
	<?php if($inq_config->pager=='thumbnails'): ?>
		$images = []
		$("#slider div.slide div.slide-image span.img-full").each(function(){
			$images.push($(this).html());
		});
		
		$('#nav-slider a').each(function(k,v){
	
			$(this).html($('<img>').attr('src','<?php echo $path_tim; ?>?src='+$images[k]+'<?php echo $pager_img_opts?>'));
		});	
	<?php endif; ?>

	<?php if($inq_config->pager == 'numbers'): ?>
		$('#nav-slider a').addClass('numbers');		
	<?php endif; ?>	
	
	//Size home slider
	$('#home-slider').css('height',<?php echo $inq_config->height; ?>);	
	$('#home-slider').css('width',<?php echo $inq_config->width+300; ?>);	
	
	$('.slide-image').css('height',<?php echo $inq_config->height; ?>);	
	$('.slide-image').css('width',<?php echo $inq_config->width; ?>);
	
	<?php if($inq_config->height != ''): ?>		
		$('.slide-info').css('height',<?php echo $inq_config->height; ?>);	
	<?php endif; ?>
});
    
$('#slider').cycle({
  fx:     'scrollHorz',//'<?php echo !empty($inq_config->transition)?$inq_config->transition:'fade' ?>',
  onPagerEvent: function(){
		$('#slider').cycle('resume');
  },
  activePagerClass: 'active',
  pagerAnchorBuilder: function(index, DOMelement){
    var link_text = jQuery(DOMelement).find("h3").eq(0).text();
    return '<span><a href="#">'+link_text+'</a></span>';
    },
  timeout: <?php echo !empty($inq_config->time)? $inq_config->time * 1000 : $msec;
	echo ($inq_config->pager!='none')?",\npager:  '#imgthumb_box'":'';
 ?>,
    prev: '#linkprev',
    next: '#linknext',
});
</script>
<?php endif; ?> <!-- end if( sizeof($sliders) > 2): Line 145 -->

<?php
if(isset($styles)) $inq_config->styles = $styles;
?>


</div> <!-- end home-slider -->


<?php
} //cms_slider

function inq_excerpt($limit) {
	$excerpt = explode(' ', get_the_excerpt(), $limit);
  
	if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  } 
    $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
    return $excerpt;
}

function inq_content($limit) {
  $content = explode(' ', get_the_content(), $limit);
  
	if (count($content)>=$limit) {
    array_pop($content);
    $content = implode(" ",$content).'...';
  } else {
    $content = implode(" ",$content);
  } 
    
	$content = preg_replace('/\[.+\]/','', $content);
	$content = apply_filters('the_content', $content); 
  $content = str_replace(']]>', ']]&gt;', $content);
  return $content;
}

function inq_thumb($width,$height,$align=null) {
	$path_tim =  plugins_url( 'includes/timthumb.php' , dirname(__FILE__) );

	$thumbURL = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), '' );

	$img_opts = "";
	if(!empty($width))
		$img_opts .= "&w=$width";
	if(!empty($height))
		$img_opts .= "&h=$height";
	if(!empty($align))
		$img_opts .= "&a=$align";

	$thumb = $path_tim."?src=".$thumbURL[0].$img_opts;  
	return $thumb;
}

function inq_thumb_url($url,$width,$height,$align=null){
	$path_tim =  plugins_url( 'includes/timthumb.php' , dirname(__FILE__) );

	$thumbURL = array($url);

	$img_opts = "";
		if(!empty($width))
	$img_opts .= "&w=$width";
		if(!empty($height))
	$img_opts .= "&h=$height";
		if(!empty($align))
	$img_opts .= "&a=$align";

	$thumb = $path_tim."?src=".$thumbURL[0].$img_opts;  
	return $thumb;
}