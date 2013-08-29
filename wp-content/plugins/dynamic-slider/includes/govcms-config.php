<?php

function slider_config(){
	global $config;
	
	if(isset($_POST['action']) && $_POST['action'] == 'updateconfig') {

		if(!empty($_POST['inq-config'])) {

			$options = $_POST['inq-config'];
		
			foreach($options as $ix =>&$option){
				$option = stripslashes($option);
			}
			
			$_POST['inq-config'] = json_encode($options);
			
			update_option('inq-config',$_POST['inq-config']);
			
			if(!$_POST['add-slide'] && $_POST['add-slide'] == '') {
				echo '<div class="updated-inq">' . "\n"
					. '<p><strong>Chages saved succcessfully.</strong></p>' . "\n"
				. '</div>' . "\n";
			}
		//echo $_POST['gov-home'];
		
		} else {
			echo '<div class="error-inq">' . "\n"
					. '<p><strong>An error was found. Please try again.</strong></p>' . "\n"
				. '</div>' . "\n";
		}
	}

	$item=array();

	if($_POST['inq-config']){
		$opt=$_POST['inq-config'];
	} else {
		$opt=get_option('inq-config');
	}

	if($opt){
		$inq_config=json_decode($opt);
	}

	include( $config->path .'/views/home.php');
}

function slider_index(){	
	global $config;
	
	function slider_cmp($a, $b) {
    if ($a['order'] == $b['order']) {
        return 0;
    }
    return ($a['order'] < $b['order']) ? -1 : 1;
	}
	
	if(isset($_POST['action']) && $_POST['action'] == 'updategov') {

		if(!empty($_POST['gov-home'])) {

				$sliders=$_POST['gov-home'];
				$elements=array();
				foreach($sliders as $slider){
					$slider = (array)$slider;
					if($slider['image']!='' or $slider['text']!='' or $slider['link']!='' or $slider['title']!='' or $slider['html']!=''){
						$slider['text'] = stripslashes($slider['text']);
						$slider['text2'] = stripslashes($slider['text2']);
						$slider['title'] = stripslashes($slider['title']);
						$slider['alt'] = stripslashes($slider['alt']);
						$slider['img-title'] = stripslashes($slider['img-title']);
						$slider['html'] = stripslashes($slider['html']);
						$size = getimagesize($slider['image'] );
						$slider['size']=array(
							'width'=>$size[0],
							'height'=>$size[1]
								      );
						$elements[]=$slider;
					}
				}

			usort($elements, "slider_cmp");

			$_POST['gov-home']=json_encode($elements);

			update_option('gov-home',$_POST['gov-home']);

			if(isset($_POST['add-slide']) && $_POST['add-slide'] == '') {
				echo '<div class="updated-inq">' . "\n"
					. '<p><strong>Chages saved succcessfully.</strong></p>' . "\n"
				. '</div>' . "\n";
			}

		} else {
			echo '<div class="error-inq">' . "\n"
					. '<p><strong>An error was found. Please try again.</strong></p>' . "\n"
				. '</div>' . "\n";
		}
	}

	$item=array();
	
	if($_POST['gov-home']){
		$opt=$_POST['gov-home'];
	} else {
		$opt=get_option('gov-home');
	}

	if($opt){
		$gov_home=json_decode($opt);

		foreach($gov_home as $index=>$element){
			$item[$index]=$element;
		}
	}

	/*echo "<pre>";
	print_r($item);
	echo "</pre>";*/
	
	function getVal($i,$item){
		if(!empty($item[$i])){
			return $item[$i];
		}else{
			return '';
		}
	}

	function getData($i,$field,$item){
		
		if(!empty($item[$i])){
			return stripslashes($item[$i][$field]);
			
		} else {
			//return $i;
			return '';
		}
	}
	
	//Prepare Slider	
	$count = count($item);
	
	if(isset($_POST['add-slide']) && $_POST['add-slide'] == 'addslide') {
		$count = $count + 1;
	}		
	
	if($count < 2) {
		//echo count($item);
		$count_total = count($item);
		$count = 2;
	}
	//else $count = $count + 1;

	$inq_config=json_decode(get_option('inq-config'));
	include($config->path .'/views/slider.php');		
}

//Insert the installation page
function slider_install() {
	global $config;
	include($config->path .'/views/installation.php');	
}

//Insert the about page
function inq_about() {
	global $config;
	include($config->path .'/views/about.php');	
}
?>