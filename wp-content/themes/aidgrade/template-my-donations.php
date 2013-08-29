<?php
/**
 * Template name: My Donations
 */

if ( is_user_logged_in() ):

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
			
			<?php 
				global $current_user;
				$current_user = wp_get_current_user();
				global $wpdb;
				$sql = $wpdb->prepare("SELECT * from ".$wpdb->prefix."donations WHERE user_id='".$current_user->ID."' AND donation_status = 'Approved' ORDER BY donation_id DESC;");
				$results = $wpdb->get_results($sql, ARRAY_A);
			?>
			<?php if($results): ?>
			<div id="tabs">
			<table>
				<thead>
					<tr>
						<th>Donation Purpose</th>
						<th align="right">Amount</th>
						<th align="center">Date of Donation</th>
					</tr>
				</thead>
				<tbody>
			<?php for( $j=0; $j<count($results); $j++ ): ?>
				<tr>
					<td><?php echo $results[$j]['program_supported']; ?></td>
					<td align="right">$ <?php echo $results[$j]['amount']; ?></td>
					<td align="center">
					<?php  echo date('m/d/Y', strtotime($results[$j]['donation_finished'])); ?>
					</td>
				</tr>
			<?php endfor; ?>
				</tbody>
			</table>
			</div>
			<?php else: ?>
			<h2>No donation records found</h2>
			<?php endif; ?>

		</div>
	</div>
</section>


<?php get_footer(); ?>
<?php else: ?>
<?php header( 'Location: '.get_bloginfo('url') ) ; ?>
<?php endif; ?>