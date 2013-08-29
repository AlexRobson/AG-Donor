<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 */

get_header(); ?>

<div id="content">
    <div class="content_in">
        <div class="breadcrumbs" style="margin-bottom: 20px;">
        <?php if(function_exists('bcn_display'))
        {
            bcn_display();
        }?>
        </div>
        <div class="left-content">
            
            <h1 class="page-title">Blog</h1>
            
            <?php query_posts( array( 'cat'=> '-7,-4,-6,-8' ) ); ?>

            <?php if ( have_posts() ) : ?>
            
            <?php /* Start the Loop */ ?>
            <?php while ( have_posts() ) : the_post(); ?>
            
                <?php get_template_part( 'content', get_post_format() ); ?>

            <?php endwhile; ?>

            <?php else : ?>

            <article id="post-0" class="post no-results not-found">
                <header class="entry-header">
                    <h2 class="entry-title"><?php _e( 'Nothing Found', 'twentyeleven' ); ?></h2>
                </header><!-- .entry-header -->

                <div class="entry-content">
                    <p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'twentyeleven' ); ?></p>
                    <?php //get_search_form(); ?>
                </div><!-- .entry-content -->
            </article><!-- #post-0 -->

            <?php endif; ?>
        </div>
        
        <div class="right-content">
            <?php get_sidebar(); ?>
        </div>
        <?php wp_pagenavi(); ?>
    </div>
</div><!-- #content -->
    

<?php get_footer(); ?>