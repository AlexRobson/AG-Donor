<?php
/**
 * Template Name: Meta-Analysis
 *
 * @package WordPress
 * @subpackage YourTheme
 * @since yoursite.com 1.0
 */

get_header(); ?>

<div id="content">	
	<div class="content_in">		
		<div class="compare">
		
			<?php the_post(); ?>
			<div class="top">
				<h1 class="page-title-app"><?php the_title(); ?></h1>
				<ul class="right-links-app">
					<li><a href="#">What is a Meta-Analysis</a></li>
					<li><a href="#">How to do a Meta-Analysis</a></li>
				</ul>
			</div>
			<div class="metaanalyses">
			
				<div class="top-part">
					<div class="step-one">
						<p class="title">Pick a program</p>
						<a class="question" href="#"></a>
						<div class="fun-area">
							
							<div class="wpsc_variation_forms">
								<p>
								<select class="custom-select">
									<option value="0" selected="selected">Pick a program</option>
									<option value="1">SCHOOL MEALS</option>
									<option value="2">Conditional cash transfers</option>
									<option value="3">deworming</option>
									<option value="4">IMPROVED stoves</option>
									<option value="5">Insecticide-treated bed nets</option>
									<option value="6">Microfinance</option>
									<option value="7">Scholarships</option>
									<option value="8">Unconditional cash transfers</option>
									<option value="9">School meals</option>
									<option value="10">Water treatment</option>
								</select>
								</p>
							</div>
							<div class="des-step-one"></div>
							
						</div>
					</div>
					<div class="step-two">
						<p class="title">Select your filters</p>
						<a class="question" href="#"></a>
						<div class="fun-area">
							<p><span class="count-checkbox">0</span>Studies selected under these filters<span class="state"></span></p>
						</div>
					</div>
					<div class="step-three">
						<p class="title">Choose fixed or random effects</p>
						<a class="question" href="#"></a>
						<div class="fun-area">
							<span class="fixed-effect eff" href="#">Fixed</span>
							<span class="random-effect eff" href="#">Random</span>
							<div class="des-step-three"></div>
						</div>
					</div>
				</div>
				
				<div class="mid-part">
				
				<!-- Step 2 Content -->
					<div class="checkboxes-area">
						<div class="arrow-top"></div>
						<div class="checkboxes-area-in">
						
							<div class="left-checkboxes">
							
								<ul>
									<li><h3>Method  used:</h3></li>
									<li><input type="checkbox" class="styled" /><label>Randomized controlled trial</label>
										<ul>
											<li><input type="checkbox" id="sample-input"  class="styled" /><label for="sample-input">Randomized by cluster</label></li>
											<li><input type="checkbox" id="sample-input1" class="styled" /><label for="sample-input1">Not randomized by cluster</label></li>
											<li><input type="checkbox" id="sample-input2" class="styled" /><label for="sample-input2">Any</label></li>
										</ul>
									</li>
									<li><input type="checkbox" id="sample-input3" class="styled" /><label for="sample-input3">Differences-in-differences</label></li>
									<li><input type="checkbox" id="sample-input4" class="styled" /><label for="sample-input4">Regression discontinuity</label></li>
									<li><input type="checkbox" id="sample-input5" class="styled" /><label for="sample-input5">Matching</label></li>
									<li><input type="checkbox" id="sample-inpu6" class="styled" /><label for="sample-input6">Any</label></li>
								</ul>
								
								<ul>
									<li><h3>Geographic location:</h3></li>
									<li><input type="radio" id="sample-input7" name="radio" class="styled" /><label for="sample-input7">Africa</label></li>
									<li><input type="radio" id="sample-input8" name="radio" class="styled" /><label for="sample-input8">East Asia</label></li>
									<li><input type="radio" id="sample-input9" name="radio" class="styled" /><label for="sample-input9">Latin America</label></li>
									<li><input type="radio" id="sample-input10" name="radio" class="styled" /><label for="sample-input10">Middle East / North Africa</label></li>
									<li><input type="radio" id="sample-input11" name="radio" class="styled" /><label for="sample-input11">South Asia</label></li>
									<li><input type="radio" id="sample-input12" name="radio" class="styled" /><label for="sample-input12">Other</label></li>
									<li><input type="radio" id="sample-input13" name="radio" class="styled" /><label for="sample-input13">Any</label></li>
								</ul>
								
							</div>
							
							<div class="middle-checkboxes">
							
								<ul>
									<li><h3>Was the study blinded?</h3></li>
									<li><input type="checkbox" id="sample-input14" class="styled" /><label for="sample-input14">Double blind</label></li>
									<li><input type="checkbox" id="sample-input15" class="styled" /><label for="sample-input15">Single blind</label></li>
									<li><input type="checkbox" id="sample-input16" class="styled" /><label for="sample-input16">Not specified, presumed not blind</label></li>
									<li><input type="checkbox" id="sample-input17" class="styled" /><label for="sample-input17">Any</label></li>
								</ul>
								
								<ul>
									<li><h3>Type of school meal provided?</h3></li>
									<li><input type="checkbox" id="sample-input18" class="styled" /><label for="sample-input18">Iron-fortified</label></li>
									<li><input type="checkbox" id="sample-input19" class="styled" /><label for="sample-input19">Containing protein</label></li>
									<li><input type="checkbox" id="sample-input20" class="styled" /><label for="sample-input20">Containing micronutrients</label></li>
									<li><input type="checkbox" id="sample-input21" class="styled" /><label for="sample-input21">Any</label></li>
								</ul>
						
							</div>
							
							<div class="right-checkboxes">
							
								<ul>
									<li><h3>Type of school meal provided?</h3></li>
									<li><input type="checkbox" id="sample-input22" class="styled" /><label for="sample-input22">Iron-fortified</label></li>
									<li><input type="checkbox" id="sample-input23" class="styled" /><label for="sample-input23">Containing protein</label></li>
									<li><input type="checkbox" id="sample-input24" class="styled" /><label for="sample-input24">Containing micronutrients</label></li>
									<li><input type="checkbox" id="sample-input25" class="styled" /><label for="sample-input25">Any</label></li>
								</ul>
								
								<ul>
									<li><h3>Method  used:</h3></li>
									<li><input type="checkbox" id="sample-input26" class="styled" /><label for="sample-input26">Randomized controlled trial</label>
										<ul>
											<li><input type="checkbox" id="sample-input27" class="styled" /><label for="sample-input27">Randomized by cluster</label></li>
											<li><input type="checkbox" id="sample-input28" class="styled" /><label for="sample-input28">Not randomized by cluster</label></li>
											<li><input type="checkbox" id="sample-input29" class="styled" /><label for="sample-input29">Any</label></li>
										</ul>
									</li>
									<li><input type="checkbox" id="sample-input30" class="styled" /><label for="sample-input30">Differences-in-differences</label></li>
									<li><input type="checkbox" id="sample-input31" class="styled" /><label for="sample-input31">Regression discontinuity</label></li>
									<li><input type="checkbox" id="sample-input32" class="styled" /><label for="sample-input32">Matching</label></li>
									<li><input type="checkbox" id="sample-input33" class="styled" /><label for="sample-input33">Any</label></li>
								</ul>
						
							</div>
							
							<a class="choose-effects" href="#">Choose fixed or random effects</a>
							
						</div>
					</div>
					<!-- End Step 2 Content -->
					
					<!-- Step 3 Content -->
					<div class="result">
						<div class="result-in">
						
							<p class="title-outcome">Outcome</p>
							<p class="title-effects">Effects</p>
							
							<div class="result-info">
								<p class="name">Test Scores</p>
								<div style="margin: 30px 0 0 200px; width: 354px;" class="slice">
									<p class="left-count"><span></span>-3</p>
									<p style="margin: 0 0 0 10px;" class="slice-count">
										<span class="tooltip">
											<input type="text" id="north" title="School meals programs increased years of school by 1.5 years" />
										</span>
										-2
									</p>
									<p class="right-count">4</p>
								</div>
							</div>
							
							<div class="result-info">
								<p class="name">Years of School</p>
								<div style="margin: 30px 0 0 100px;" class="slice">
									<p class="left-count">-3</p>
									<p style="margin: 0 0 0 200px;" class="slice-count">
										<span class="tooltip">
											<input type="text" id="north1" title="School meals programs increased years of school by 0.5 years" />
										</span>
										1
									</p>
									<p class="right-count">4</p>
								</div>
							</div>
							
							<div class="result-info">
								<p class="name">Height</p>
								<div style="margin: 30px 0 0 200px; width: 354px;" class="slice">
									<p class="left-count">-3</p>
									<p style="margin: 0 0 0 10px;" class="slice-count">
										<span class="tooltip">
											<input type="text" id="north" title="School meals programs increased years of school by 1.5 years" />
										</span>
										-2
									</p>
									<p class="right-count">4</p>
								</div>
							</div>
							
							<div class="result-info last">
								<p class="name">Weight</p>
								<div style="margin: 30px 0 0 100px;" class="slice">
									<p class="left-count">-3</p>
									<p style="margin: 0 0 0 200px;" class="slice-count">
										<span class="tooltip">
											<input type="text" id="north" title="School increased years of school by 1.5 years" />
										</span>
										1
									</p>
									<p class="right-count">4</p>
								</div>
							</div>
							
							<div class="null-top"></div>
							<div class="null-bottom"></div>
							
						</div>
					</div>
					<!-- End Step 3 Content -->
					
					<div class="loading"></div>
					
				</div>
				
			</div>
			
		</div>
  </div>
</div>

<?php get_footer(); ?>
