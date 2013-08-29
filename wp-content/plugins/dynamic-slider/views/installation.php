<?php
	$url_page = $_SERVER["REQUEST_URI"];
	$url_page = explode('/wp-admin',$url_page);
	$url_page = "http://".$_SERVER['HTTP_HOST'].$url_page[0];
?>

<div class="wrap">

	<div class="header-inqbation">
	<h2><a href="http://www.inqbation.com/">Digital Marketing Agency</a></h2>
	</div>
	
	<div class="content-about-1">
		<div id="icon-inqbation" class="icon32"></div><h2>Installation</h2>
	</div>

	<div class="content-about-2">
		<div class="box-text-inqbation box-text-inqbation-install">
			<ol>
				<li>Upload the dynamic-slider folder to the /wp-content/plugins/ directory.</li>
				<li>Go to the 'Plugins' page of your WordPress administration area and activate the DynamicSlider plugin.</li>
				<li>Create your slider by clicking on "DynamicSlider" located in the left sidebar (wordpress menu) configure its options by clicking on "Settings".</li>
				<li>Open the appropriate file for your theme (typically header.php or PHP file with homepage configuration), this can be done through your favorite text editor. Place the following code <code>cms_slider();</code> where you want the DynamicSlider to appear.</li>
			</ol>   	
			
		</div>
	</div>
	<div id="inqbation-brand-link">
		<a href="http://www.inqbation.com" title="DC Web Designer" target="_blank">DC Web Designer</a><span class="footer-inqbation">&nbsp;:&nbsp;</span><a href="http://www.inqbation.com" title="inQbation creative web designer" target="_blank">inQbation</a>
	</div>
</div>