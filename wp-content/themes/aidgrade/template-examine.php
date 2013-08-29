<?php
/**
 * Template name: Examine program
 */

get_header(); ?>

<section class="content">  
	<div id="content">	
		<div class="content_in">
		
		<?php if( !isset($_GET['action']) && !$_GET['action'] == 'register' ): ?>
			<h1 class="entry-title page-title"><?php the_title(); ?></h1>
		<?php endif; ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'page' ); ?>

			<?php /*?><?php comments_template( '', true ); ?><?php */?>

		<?php endwhile; // end of the loop. ?>
			<?php echo do_shortcode('[donor-programs selection="programs"]'); ?>
		</div>
	</div>
</section>


<?php get_footer(); ?>