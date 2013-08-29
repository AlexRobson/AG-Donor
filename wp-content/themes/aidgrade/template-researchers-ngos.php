<?php
/**
 * Template Name: Researchers - NGOs
 *
 * @package WordPress
 * @subpackage YourTheme
 * @since yoursite.com 1.0
 */

get_header(); ?>

<section class="content researchers ngos">  
	<div id="content">	
		<div class="content_in">
		
		<?php if( !isset($_GET['action']) && !$_GET['action'] == 'register' ): ?>
			<h1 class="entry-title page-title"><?php the_title(); ?></h1>
		<?php endif; ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'page' ); ?>

		<?php endwhile; // end of the loop. ?>

		</div>
	</div>
</section>

<?php get_footer(); ?>
