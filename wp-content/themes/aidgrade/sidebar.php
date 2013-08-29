<?php
/**
 * The Sidebar containing the widget area.
 *
 * @package WordPress
 * @subpackage YourTheme
 */
?>

<!-- start sidebar -->
<aside id="sidebar">

  <?php if ( ! dynamic_sidebar( 'sidebar-main' ) ) : ?>
  <?php endif; // end sidebar widget area ?>
  
</aside>
<!-- end of sidebar -->		
