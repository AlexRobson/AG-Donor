<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage YourTheme
 * @since yoursite.com 1.0
 */

get_header(); ?>
  
<section class="content">    
            
<div id="content">	
	<div class="content_in">  
    <div class="breadcrumbs" style="margin-bottom: 20px;">
    <?php if(function_exists('bcn_display'))
    {
        bcn_display();
    }?>
    </div>
    <?php the_post(); ?>
    
    <!--h1 class="page-title">
      <?php //the_title(); ?>
    </h1-->
    
    <?php get_template_part( 'content', 'single' ); ?>
    
    <?php comments_template( '', true ); ?>
  </div>
</div>

</section>


<?php get_footer(); ?>