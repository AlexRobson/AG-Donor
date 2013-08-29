<?php
/**
 * Template name: Sign Up
 */

get_header(); ?>

<section class="content">    
            
<div id="content">	
	<div class="content_in">
    
    <?php the_post(); ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<?php if ( 'post' == get_post_type() ) : ?>
			<div class="entry-meta">
				<?php twentyeleven_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->

		
		
		<div class="entry-content">
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentyeleven' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'twentyeleven' ) . '</span>', 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->

		<footer class="entry-meta">
			<?php $show_sep = false; ?>
			<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'twentyeleven' ) );
				if ( $categories_list ):
			?>
			<span class="cat-links">
				<?php printf( __( '<span class="%1$s">Posted in</span> %2$s', 'twentyeleven' ), 'entry-utility-prep entry-utility-prep-cat-links', $categories_list );
				$show_sep = true; ?>
			</span>
			<?php endif; // End if categories ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'twentyeleven' ) );
				if ( $tags_list ):
				if ( $show_sep ) : ?>
			<span class="sep"> | </span>
				<?php endif; // End if $show_sep ?>
			<span class="tag-links">
				<?php printf( __( '<span class="%1$s">Tagged</span> %2$s', 'twentyeleven' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list );
				$show_sep = true; ?>
			</span>
			<?php endif; // End if $tags_list ?>
			<?php endif; // End if 'post' == get_post_type() ?>

			<?php edit_post_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- #entry-meta -->
		</article><!-- #post-<?php the_ID(); ?> -->
  </div>
</div>

</section>


<?php get_footer(); ?>