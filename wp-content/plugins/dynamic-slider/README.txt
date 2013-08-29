http://www.inqbation.com/clients/inqbation/resources/others-modes-of-use.html
=================================================================
INFORMATION ABOUT THE PLUGIN
=================================================================

Name: InQbation Tools v 0.2
Tags: 
Requires at least: 3.3
Tested up to: 3.3.1
Stable tag: 1.5.5

InQTools is used to manage the home slider and the options for 
social media.

=================================================================
DESCRIPTION
=================================================================

Plugin used to manage the home slider. It allows setting the
general configuration, add/edit/delete slides and changing the
order of the slides.

Adds a widget to show posts of any section. Adds a widget for
banners.

=================================================================
INSTALATION
=================================================================

This plugin uses timthumb library for images resizing.
http://code.google.com/p/timthumb/

TO get it working change permissions to 775 to the folder cache
inside includes folder.

-----------------------------------------------------------------
CODE FOR HOME SLIDER
-----------------------------------------------------------------

For include to the code, insert the next code:

<div id="home-slider" class="grid_24">
	<?php cms_slider(935,297); ?>
</div>

-----------------------------------------------------------------
CODE FOR SOCIAL MEDIA BUTTOMS
-----------------------------------------------------------------

For include to the page should be active the widget InQ Social 
Media Buttons and insert in a content area where you need that 
appears and save the changes.


=================================================================
STYLES
=================================================================

-----------------------------------------------------------------
FOR HOME SLIDER
-----------------------------------------------------------------

#home-slider{
	background: transparent url(images/background-slider.gif) 0 0;
	float: left;
	height: 335px;
	width: 973px;
	position: relative;
  	top: -7px;
  	left: -11px;
}

.slide{
  	margin: 18px 0px 0px 19px;
  	width: 935px;
  	height: 297px;
  	background-color: #203f6c;
}

.slide-info{
  	background-color: transparent;
  	height: 159px;
  	padding: 20px 0;
  	position: absolute;
  	right: 12px;
  	text-align: center;
  	top: 15px;
 	width: 333px;
  	z-index: 40;
}
.slide-image{
  	height: 297px;
}
#slider{
	height: 335px;
}
#slider h2{
  font-size: 30px;
  font-family: 'Oswald', Arial, Helvetica, sans-serif;
  margin-bottom: 15px;
  color: #fff;
  border-bottom: none;
  text-transform: uppercase;
  line-height: 36px;
  padding: 0px;
  max-height: 108px;
  overflow: hidden;
}
#slider p{
	margin-bottom: 15px;
	color: #FFF;
  height: 39px;
  font-size: 18px;
  overflow: hidden;
  line-height: 18px;
}

/* View more */
#slider a.view {
  padding: 5px 20px 5px 20px;
  text-align: center;
  display: inline-block;
  background: #2185dc url(images/submit-button.gif) repeat-x 0 -60px;
  text-transform: uppercase;
  color: #fff;
  width: 83px;
  height: 20px;
  font-family: 'Oswald', Arial, Helvetica, sans-serif;
  border-radius: 5px;
  -moz-border-radius: 5px;
  -webkit-border-radius: 5px;
}
#slider a.view:hover{
    background: transparent url(images/submit-button.gif) repeat-x 0 0px;
    color: #fff;
    text-decoration: none;
}

/* Nav Slider */
#nav-slider {
    background: transparent url(images/background-navslider.png) repeat-y right top;
    right: 20px;
    line-height: 25px;
    position: absolute;
    bottom: 20px;
    z-index: 50;
    width: auto;
    height: 71px;
    padding: 9px 5px 0px 27px;
    overflow: hidden;
}
#nav-slider a {
    border: 1px solid #FFFFFF;
    display: block;
    float: left;
    height: 50px;
    margin: 3px 5px 0 0;
    padding: 0;
    width: 61px;
    background-color: #385377;
}
#nav-slider a:hover{
    border-color: #203f6c;
}

#nav-slider a.activeSlide{
    border-width: 3px;
    margin-top: 0px;
}
#nav-slider a.activeSlide:hover{
    border-color: #fff;
}
.back-slide {
    background: transparent url(images/home-slider-overlay-gradient.png) repeat-y top right;
    height: 297px;
    position: absolute;
    right: 0px;
    top: 0px;
    width: 600px;
    z-index: 30;
}

----------------------------------------------------------------------------
POSSIBLE STYLES FOR FOLLOW US
----------------------------------------------------------------------------

.facebook-chicklet,
.twitter-chicklet,
.youtube-chicklet,
.email-chicklet,
.country-chicklet,
.rss-chicklet{
    background-image: url(images/elements.jpg);
    text-indent: -999px;
    overflow: hidden;
    margin-left: 15px;
}
.follow-us ul li:first-child a{
    margin-left: 0px;
}

.facebook-chicklet{background-position: 0 0;}
.twitter-chicklet{background-position: -50px 0;}
.youtube-chicklet{background-position: -100px 0;}
.email-chicklet{background-position: -150px 0;}
.rss-chicklet{background-position: -200px 0;}
.country-chicklet{background-position: -350px 0;}

.facebook-chicklet:hover{background-position: 0 -32px;}
.twitter-chicklet:hover{background-position: -50px -32px;}
.youtube-chicklet:hover{background-position: -100px -32px;}
.email-chicklet:hover{background-position: -150px -32px;}
.rss-chicklet:hover{background-position: -200px -32px;}
.country-chicklet:hover{background-position: -350px -32px;}