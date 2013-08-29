<?php
/**
 * Template Name: Donate
 *
 * @package WordPress
 * @subpackage YourTheme
 * @since yoursite.com 1.0
 */

get_header(); ?>

<div id="content">
	<div class="content_in">
		<?php if (isset($_POST)):
			if (isset($_POST['x_response_code'])): // From Authorize.Net ?>
		<div class="donate-message">
			The Transactions result is <?php echo $_POST['x_response_code']; ?>
			<pre><?php //print_r($_POST); ?></pre>
		</div>
			<?php endif; ?>
		<?php endif; ?>

		<div class="donate">

			<div class="form-area">
				<div class="form-area-in">
					<!-- Authorize.Net Integration for Donations -->
					<?php if (function_exists('donations_init')) {
						$authnet_obj = donations_init();
						// print basic data form
						$authnet_obj->print_basicdata_form();
					}
					?>
				</div>
			</div>

			<div class="top">

				<h2>DONATE</h2>

				<div class="block">
					<h3>SUPPORT US</h3>
					<div class="choose" id="support-us-options">
                        <div class="check">
							<p>General</p>
						</div>
						<div class="check">
							<p>Research</p>
						</div>
						<div class="check">
							<p>Dissemination</p>
						</div>
					</div>
					<p class="text">Help bring more data out and support<br/>efficient impact evaluations of<br/>innovative programs.</p>
				</div>

				<div class="block">
					<h3 class="sup">support&nbsp;others</h3>
					<p class="right_text">Looking to support <br/>specific aid programs? <br/>Use our <br/><a href="http://localhost/open/wordpress/aidgrade.org/html/portfolio-builder">Portfolio builder</a></p>
				</div>

			</div>

			<div class="center">
				<h4>The work has only just begun. We need your support.</h4>

				<div class="donation">

					<h3>Select your donation:</h3>

					<div class="prices">
						<div class="price"><a href="#donation-5000-up" name="donation-5000-up" class="donate-value">$5,000</a><span class="don-active"></span></div>
						<div class="price"><a href="#donation-1000-up" name="donation-1000-up" class="donate-value">$1,000</a><span class="don-active"></span></div>
						<div class="price"><a href="#donation-500-up" name="donation-500-up" class="donate-value">$500</a><span class="don-active"></span></div>
						<div class="price"><a href="#donation-100-up" name="donation-100-up" class="donate-value">$100</a><span class="don-active"></span></div>
						<div class="price"><a href="#donation-other-up" name="donation-other-up" class="donate-value">OTHER</a><span class="don-active"></span></div>
						<div class="left-l"></div>
						<div class="right-l"></div>
					</div>

				</div>

				<!--div id="innovative-programs-area" class="programs-area">
					<h3>Innovative Programs Initiative</h3>
					<p>Not every development program has had the chance to be evaluated. Sometimes, small, new and innovative programs can be the best ones,
and we want to pay extra attention to them to ensure they do not get left behind.<br/>
To that end, we are highlighting several promising programs. By donating to them, you will also help fund an evaluation of their work
and will receive a copy of the results.</p>
					<h4>PROGRAMS</h4>
					<?php query_posts('cat=6&order=ASC'); ?>
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						<div class="program">
							<h3 class="program-name"><?php the_title(); ?></h3>
							<div class="program-info">
								<?php the_excerpt(); ?>
							</div>
							<a class="select-program" href="#programs-donation" onclick="javascript: select_program(<?php the_ID(); ?>);">Select</a>
							<a class="learn-more" href="<?php the_permalink(); ?>">Learn more</a>
						</div>
					<?php endwhile; endif; ?>
					<?php wp_reset_query(); ?>
				</div>

				<div class="clear-donation"></div>

				<div id="programs-donation" class="donation">

					<h3>Select your donation:</h3>

					<div class="prices">
						<div class="price"><a href="javascript:void(0);">$5,000</a><span class="don-active"></span></div>
						<div class="price"><a href="javascript:void(0);">$1,000</a><span class="don-active"></span></div>
						<div class="price"><a href="javascript:void(0);">$500</a><span class="don-active"></span></div>
						<div class="price"><a href="javascript:void(0);">$100</a><span class="don-active"></span></div>
						<div class="price"><a href="javascript:void(0);">OTHER</a><span class="don-active"></span></div>
						<div class="left-l"></div>
						<div class="right-l"></div>
					</div>
				</div-->
			</div>
        </div>
    </div>
</div>

<?php get_footer(); ?>