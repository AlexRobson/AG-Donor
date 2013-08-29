<?php
/**
 * The Archive template
 *
 * @package WordPress
 * @subpackage YourTheme
 * @since yoursite.com 1.0
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
        <?php
            global $wp_query;
            $args = array_merge( $wp_query->query,  array( 'cat'=> '-7,-4,-6,-8' ) );
            query_posts( $args );
        ?>
        <?php if ( have_posts() ) : ?>
            <h1 class="page-title">
                <?php if ( is_day() ) : ?>
                  <?php printf( __( 'Daily Archives: %s', 'yourtheme' ), '<span>' . get_the_date() . '</span>' ); ?>
                <?php elseif ( is_month() ) : ?>
                  <?php printf( __( 'Monthly Archives: %s', 'yourtheme' ), '<span>' . get_the_date( 'F Y' ) . '</span>' ); ?>
                <?php elseif ( is_year() ) : ?>
                  <?php printf( __( 'Yearly Archives: %s', 'yourtheme' ), '<span>' . get_the_date( 'Y' ) . '</span>' ); ?>
                <?php else : ?>
                  <?php _e( 'Blog Archives', 'yourtheme' ); ?>
                <?php endif; ?>
            </h1>
            <?php
                $category_description = category_description();
                if ( ! empty( $category_description ) )
                  echo apply_filters( 'category_archive_meta', '<div class="category-archive-meta">' . $category_description . '</div>' );
            ?>

            <?php /* Start the Loop */ ?>
            <?php while ( have_posts() ) : the_post(); ?>

            <?php get_template_part( 'content', get_post_format() );  ?>

            <?php endwhile; ?>

        <?php else : ?>
    
            <!-- start content -->
            <article id="post-0" class="post no-results not-found">
              <header class="entry-header">
                <h1 class="entry-title"><?php _e( 'Nothing Found', 'yourtheme' ); ?></h1>
              </header><!-- .entry-header -->
        
              <div class="entry-content">
                <p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'yourtheme' ); ?></p>
                <?php //get_search_form(); ?>
              </div>
            </article>
            <!-- end of content -->
        <?php endif; ?>

        </div>
        <div class="right-content">
            <?php get_sidebar(); ?>
        </div>
        <?php wp_pagenavi(); ?>
    </div>
</div><!-- #content -->

<?php get_footer(); ?>
