<?php
/**
  * @package WordPress
 * @subpackage YourTheme
 * @since yoursite.com 1.0
 */
?>

<!DOCTYPE html>
<!--[if IE 6]><html id="ie6" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 7]><html id="ie7" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8]><html id="ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!--><html <?php language_attributes(); ?>><!--<![endif]-->
<head>
	<title>
  <?php
    global $page, $paged;
    wp_title( '|', true, 'right' );
    // Add the blog name.
    bloginfo( 'name' );
    // Add the blog description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) )
      echo " | $site_description";
    // Add a page number if necessary:
    if ( $paged >= 2 || $page >= 2 )
      echo ' | ' . sprintf( __( 'Page %s', 'yourtheme' ), max( $paged, $page ) );
	?>
  </title>	
  <meta charset="<?php bloginfo( 'charset' ); ?>" />
	<!-- <meta name="viewport" content="width=device-width" /> use if required -->	
  <link rel="profile" href="http://gmpg.org/xfn/11" />
  <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/css/slider.css" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/css/jquery.powertip.css" />

	<!--[if IE 8]> 
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/css/ie8.css" />
	<![endif]-->
	<!--[if IE 7]> 
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/css/ie7.css" />
	<![endif]-->
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
  <?php    
    if ( is_singular() && get_option( 'thread_comments' ) )
      wp_enqueue_script( 'comment-reply' );
    wp_head();
  ?>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/scripts/script.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/scripts/slider.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/scripts/jik-cselect.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/scripts/checkbox.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/scripts/jquery.powertip.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/scripts/jquery.ba-outside-events.js"></script>
	
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/scripts/jquery.validate.js"></script>
	<script type="text/javascript">
		jQuery(function() {
			jQuery('#north, #north1, #north2, #north3').powerTip({placement: 'n'});
		});
	</script>
	<script type="text/javascript">
  
    </script>
	<!--[if lt IE 9]>
	<script type="text/javascript" src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/scripts/PIE.js"></script> 
	<script type="text/javascript">
		jQuery(document).ready(function() { 
			if (window.PIE) { 
				jQuery('.header_in, .login_area p a, .menu ul li a, .search_area, #imgthumb_box a, #img_container, .block_in h3, .top .block h3, .wpcf7-form, input.wpcf7-submit, .right-content ul li.current-menu-item a, #header .menu ul ul.sub-menu li, #loginform, .metaanalyses, .checkboxes-area-in, .result, #powerTip, .sign-in-popup, a.create-acc').each(function(){
					PIE.attach(this);
				});
			}
		});
	</script>
	<![endif]-->
</head>
<body <?php body_class(); ?>>

  <!-- start header -->	
	<div id="header">
			<div class="header_in">
			
				<div class="logo">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
						<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>
					</a>        
				</div>
				
				<div class="menu">
					<?php wp_nav_menu('menu=main_menu'); ?>
					<span class="arrow-sub"></span>
				</div>
				
				<div class="right_part">
					<div class="popup-sign-in">
						<?php if(!is_user_logged_in()): ?>
						
						<a class="sign-in" href="javascript: void(0);">Sign In</a>
						<span class="or-text-separator">&nbsp;or&nbsp;</span>
						<a class="sign-up" href="<?php echo get_bloginfo('url'); ?>/login?action=register">Sign Up</a>
						<div class="sign-in-popup">
							<?php dynamic_sidebar( 'signup' ) ?>
							<div class="line"></div>
							<a class="create-acc" href="<?php echo get_bloginfo('url'); ?>/login?action=register">Don't have an account? Create one.</a>
						</div>
						<?php else: ?>
						<a class="sign-in" href="javascript: void(0);">My Account</a>
						<div class="sign-in-popup">
							<?php dynamic_sidebar( 'signup' ) ?>
						</div>
						<?php endif; ?>
					</div>
					
					<div class="popup-search">
						<div class="search_area">
							<form id="searchform" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">			
								<fieldset>
									<div class="form-line">
										<input type="text" class="field" name="s" id="s" placeholder="<?php esc_attr_e( 'Search', 'yourtheme' ); ?>" />
									</div>
								</fieldset>				
								<div class="submit-line">
									<input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'yourtheme' ); ?>" />
								</div>
							</form>
						</div>
					</div>
					
					<div class="networks">
						<?php dynamic_sidebar( 'networks' ) ?>
					</div>
					
				</div>
			</div>
  </div>
  <!-- end of header -->     