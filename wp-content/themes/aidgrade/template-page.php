<?php
/**
 * Template Name: Page with menu
 *
 * @package WordPress
 * @subpackage YourTheme
 * @since yoursite.com 1.0
 */

get_header(); ?>

<div id="content">	
	<div class="content_in">
		
		<div class="left-content">
    
    <?php the_post(); ?>
    
    <h1 class="page-title">
      <?php the_title(); ?>
    </h1>
    
    <?php get_template_part( 'content', 'page' ); ?>
		
		</div>
		
		<div class="right-content">
			<?php wp_nav_menu('menu=page_menu'); ?>
		</div>
		
  </div>
</div>

<?php get_footer(); ?>
