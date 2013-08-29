<?php
/**
 * The Footer template
 *
 * @package WordPress
 * @subpackage YourTheme
 * @since yoursite.com 1.0
 */
?>

  <!-- start footer -->
  <div id="footer">	
		<?php dynamic_sidebar( 'copyright' ) ?>	
        
        <!--div id="brand"><a target="_blank" title="Washington DC web developer" href="http://www.inqbation.com">DC Web Developer</a> : <a target="_blank" title="inQbation web developer" href="http://www.inqbation.com">inQbation</a></div-->
  </div>
  <!-- end of footer -->

<?php wp_footer(); ?>

</body>
</html>