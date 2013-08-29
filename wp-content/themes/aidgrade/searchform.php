<?php
/**
 * Search Form template
 *
 * @package WordPress
 * @subpackage YourTheme
 * @since yoursite.com 1.0
 */
?>

<!-- start form -->
<div class="search_area">
<form id="searchform" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">			
  <fieldset>
    <div class="form-line">
      <input type="text" class="field" name="s" id="s" placeholder="<?php esc_attr_e( 'Search', 'yourtheme' ); ?>" />
    </div>					
  </fieldset>				
  <div class="submit-line">
    <input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'yourtheme' ); ?>" />
  </div>
</form>
</div>
<!-- end of form -->
