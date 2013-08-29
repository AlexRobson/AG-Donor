<?php
/**
 * The Footer widget areas.
 *
 * @package WordPress
 * @subpackage YourTheme
 * @since yoursite.com 1.0
 */
?>

<?php if ( is_active_sidebar( 'sidebar-footer' ) ) : ?>

<!-- start sidebar footer-->
<aside id="sidebar-footer">
  <?php dynamic_sidebar( 'sidebar-footer' ); ?>  
</aside>
<!-- end of sidebar footer -->	

<?php endif; ?>