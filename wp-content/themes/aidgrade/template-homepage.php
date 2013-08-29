<?php
/**
 * Template name: Home Page
 */

get_header(); ?>

<div id="content">	
	<div class="content_in">
		<?php cms_slider(475,1000); ?>
		
		<div class="logos">
			<?php dynamic_sidebar( 'logos' ) ?>
		</div>
	</div>
</div>

<script type="text/javascript">
//<!--
	jQuery(document).ready(function(){
		jQuery("#home-slider").width(1000);
		jQuery("#home-slider").height(485);
	});
//-->
</script>

<?php get_footer(); ?>