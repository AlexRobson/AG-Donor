<?php
/**
 * The 404 pages template
 *
 * @package WordPress
 * @subpackage YourTheme
 */

get_header(); ?>
<section id="primary">
  <div id="content" role="main">
  <div class="content_in">
              
  <!-- start content -->            
  <article id="post-0" class="post error404 not-found">
    <header class="entry-header">
      <h1 class="entry-title"><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'yourtheme' ); ?></h1>
    </header>

    <div class="entry-content">
      <p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for.', 'yourtheme' ); ?></p>
    </div>
  </article>
  <!-- end of content -->
</div>
</div>
</section>

<?php /*?><?php get_sidebar(); ?><?php */?>

<?php get_footer(); ?>