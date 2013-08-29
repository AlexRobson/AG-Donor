<?php
/**
 * Template Name: Volunteer
 *
 * @package WordPress
 * @subpackage YourTheme
 * @since yoursite.com 1.0
 */

get_header(); ?>
<div id="content">	
	<div class="content_in">		
		<div class="volunteer">
				
					<h2>Volunteer<span>Help make aid more effective!</span></h2>
					<div class="block">	
						<div class="block_in">
						
							<h3>BENEFITS</h3>
							
							<div class="info_vol">
								<h4>By volunteering with AidGrade, you can:</h4>
								<ul>
									<li><font size="3">Help improve aid</font></li>
									<li><font size="3">Learn how to do research</font></li>
									<li><font size="3">Gain relevant work experience for jobs or research experience for graduate school</font></li>
									<li><font size="3">Have fun</font></li>
									<li><font size="3">Explore something new</font></li>
								</ul>
							</div>
							
							<div class="info_vol">
								<h4>How you can help:</h4>
								<ul>
									<li><font size="3"><a href="#datacorps">Join our Data Corps</a></font></li>
									<li><font size="3"><a href="#partner">Partner with us</a></font></li>
									<li><font size="3"><a href="#campuschapter">Start a campus chapter</a></font></li>
									<li><font size="3">AidGrade is always looking for people to fill a variety of roles. <a href="#contact">Contact us</a> with your background if you want to do something different.</font></li>
								</ul>
							</div>
							
						</div>
						<p class="rate">Our average volunteer rated their experience as 6.5 / 7
<br> 
<font size="4">where 1 = "poor" and 7 = "excellent".</font>
</p>
					</div>
		
		</div>	

		<div class="formers-comments">
			<h3>COMMENTS FROM FORMER VOLUNTEERS</h3>
			<p><span class="left-rnd-p"></span>&ldquo; I have learned a great deal about both the subjects I researched and the process of reviewing and analyzing the studies... invaluable!&rdquo; <span class="right-rnd-p"></span></p><br/>
			<p><span class="left-rnd-p"></span>&ldquo; I feel I have been given ownership over my work and am excited about seeing it be used!&rdquo; <span class="right-rnd-p"></span></p><br/>
			<p><span class="left-rnd-p"></span>&ldquo; I have learned loads!&rdquo; <span class="right-rnd-p"></span></p><br/>
			<p><span class="left-rnd-p"></span>&ldquo; I was granted a lot of individual control over my project, which allowed for deeper engagement.&rdquo; <span class="right-rnd-p"></span></p><br/>
			<p><span class="left-rnd-p"></span>&ldquo; Overall, an excellent experience. Thank you!&rdquo; <span class="right-rnd-p"></span></p>
		</div>
		
		<div class="form-area-block">
			<?php /*query_posts('p=433'); ?>
			<?php while ( have_posts() ) : the_post(); ?>
					<?php the_content(); ?>
			<?php endwhile; ?>
			<?php wp_reset_query();*/ ?>
            <div id="datacorps" class="left-info">
                <h4>Join our Data Corps!</h4>
                <p>Care about data? Interested in advancing knowledge of what works in development?</p>
                <p>Data Corps members identify rigorous studies of the effects of development programs and read through selected papers to extract useful data.</p>
                <p>Sign up here by filling out the following form.</p>
            </div>
            <div class="right-info"><?php echo do_shortcode('[contact-form-7 id="429" title="Data Corps"]'); ?></div>
		</div>

		<div class="form-area-block">
			<?php /*query_posts('p=171'); ?>
			<?php while ( have_posts() ) : the_post(); ?>
					<?php the_content(); ?>
			<?php endwhile; ?>
			<?php wp_reset_query();*/ ?>
            <div id="partner" class="left-info">
                <h4>Partner with us</h4>
                <p>Are you a researcher at an academic or research institution? 
                Become a partner &minus; you will hear all our latest news and be 
                invited to collaborate on research projects.</p>
            </div>
            <div class="right-info"><?php echo do_shortcode('[contact-form-7 id="173" title="BECOME A PARTNER"]'); ?></div>
		</div>
		
		<div class="form-area-block">
			<?php /*query_posts('p=167'); ?>
			<?php while ( have_posts() ) : the_post(); ?>
					<?php the_content(); ?>
			<?php endwhile; ?>
			<?php wp_reset_query();*/ ?>
            <div id="contact" class="left-info">
                <h4>Contact US</h4>
                <p>We would love to hear from you!</p>
            </div>
            <div class="right-info"><?php echo do_shortcode('[contact-form-7 id="169" title="Contact us"]'); ?></div>
		</div>
		
		<div class="form-area-block">
			<?php /*query_posts('p=156'); ?>
			<?php while ( have_posts() ) : the_post(); ?>
					<?php the_content(); ?>
			<?php endwhile; ?>
			<?php wp_reset_query();*/ ?>
            <div id="campuschapter" class="left-info">
                <h4>Start a campus chapter!</h4>
                <p>As a campus chapter, you can:</p>
                <ul>
                    <li>Assist with research</li>
                    <li>Promote evidence-based aid</li>
                    <li>Have fun!</li>
                </ul>
                <p>If you are interested in forming a campus chapter of AidGrade at your university, please get in touch using the form below. We will also notify you if a campus chapter is being formed at your university or if others are interested in forming one.</p>
            </div>
            <div class="right-info"><?php echo do_shortcode('[contact-form-7 id="158" title="Get started"]'); ?></div>
		</div>
  </div>
</div>

<?php get_footer(); ?>