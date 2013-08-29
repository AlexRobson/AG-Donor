<?php
/**
 * Functions and definitions
 * @package WordPress
 * @subpackage yourtheme
 * @since yoursite.com 1.0
 */

add_action( 'after_setup_theme', 'yourtheme_setup' );

if ( ! function_exists( 'yourtheme_setup' ) ):

function yourtheme_setup() {
	// Grab yoursite.com's Ephemera widget.
	//require( dirname( __FILE__ ) . '/inc/widgets.php' );

	// Add default posts and comments RSS feed links to <head>.
	add_theme_support( 'automatic-feed-links' );

	// This theme uses Featured Images (also known as post thumbnails) for per-post/per-page Custom Header images
	add_theme_support( 'post-thumbnails' );

	//If you don't want to allow changing the header text color, remove next line:
	define('NO_HEADER_TEXT', true );

	// By leaving empty, we allow for random image rotation.
	define( 'HEADER_IMAGE', false );
	define( 'HEADER_IMAGE_WIDTH', false );
	define( 'HEADER_IMAGE_HEIGHT', false );

	// We want them to be the size of the header image that we just defined
	// Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
	set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );

	// Add yoursite.com's custom image sizes
	add_image_size( 'small-feature', 500, 300 ); // Used for featured posts if a large-feature doesn't exist

}
endif; // yourtheme_setup

/**
 * Sets the post excerpt length to 40 words.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 */
function yourtheme_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'yourtheme_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 */
function yourtheme_continue_reading_link() {
	return ' <a href="'. esc_url( get_permalink() ) . '">' . __( '', 'yourtheme' ) . '</a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and yourtheme_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 */
function yourtheme_auto_excerpt_more( $more ) {
	return ' &hellip;' . yourtheme_continue_reading_link();
}
add_filter( 'excerpt_more', 'yourtheme_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 */
function yourtheme_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= yourtheme_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'yourtheme_custom_excerpt_more' );

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function yourtheme_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'yourtheme_page_menu_args' );

/**
 * Register our sidebars and widgetized areas. Also register the default Epherma widget.
 *
 * @since yoursite.com 1.0
 */
function yourtheme_widgets_init() {

	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'yourtheme' ),
		'id' => 'sidebar-main',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Social Networks', 'yourtheme' ),
		'id' => 'networks',
		'description' => __( 'The bottom sidebar for the Template', 'yourtheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer copyright', 'yourtheme' ),
		'id' => 'copyright',
		'description' => __( 'An optional widget area for your site footer', 'yourtheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer logo', 'yourtheme' ),
		'id' => 'logos',
		'description' => __( 'An optional widget area for your site footer', 'yourtheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Sign up', 'yourtheme' ),
		'id' => 'signup',
		'description' => __( 'An optional widget area for your site footer', 'yourtheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

}
add_action( 'widgets_init', 'yourtheme_widgets_init' );

/**
 * Display navigation to next/previous pages when applicable
 */
function yourtheme_content_nav( $nav_id ) {
	global $wp_query;

	if ( $wp_query->max_num_pages > 1 ) : ?>
    <!-- start navigation -->
		<nav id="<?php echo $nav_id; ?>">
			<h3 class="assistive-text"><?php _e( 'Post navigation', 'yourtheme' ); ?></h3>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'yourtheme' ) ); ?></div>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'yourtheme' ) ); ?></div>
		</nav>
	<?php endif;
}

/**
 * Return the URL for the first link found in the post content.
 *
 * @since yoursite.com 1.0
 * @return string|bool URL or false when no link is present.
 */
function yourtheme_url_grabber() {
	if ( ! preg_match( '/<a\s[^>]*?href=[\'"](.+?)[\'"]/is', get_the_content(), $matches ) )
		return false;

	return esc_url_raw( $matches[1] );
}


if ( ! function_exists( 'yourtheme_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own yourtheme_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since yoursite.com 1.0
 */
function yourtheme_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'yourtheme' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'yourtheme' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php
						$avatar_size = 68;
						if ( '0' != $comment->comment_parent )
							$avatar_size = 39;

						echo get_avatar( $comment, $avatar_size );

						printf( __( '%1$s on %2$s <span class="says">said:</span>', 'yourtheme' ),
							sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
							sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								sprintf( __( '%1$s at %2$s', 'yourtheme' ), get_comment_date(), get_comment_time() )
							)
						);
					?>

					<?php edit_comment_link( __( 'Edit', 'yourtheme' ), '<span class="edit-link">', '</span>' ); ?>
				</div>

				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'yourtheme' ); ?></em>
					<br />
				<?php endif; ?>

			</footer>

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'yourtheme' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for yourtheme_comment()

if ( ! function_exists( 'yourtheme_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 * Create your own yourtheme_posted_on to override in a child theme
 *
 * @since yoursite.com 1.0
 */
function yourtheme_posted_on() {
	printf( __( '<span class="sep">Posted on </span><a href="%1$s" title="%2$s"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="by-author"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'yourtheme' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		sprintf( esc_attr__( 'View all posts by %s', 'yourtheme' ), get_the_author() ),
		esc_html( get_the_author() )
	);
}
endif;

/**
 * Adds two classes to the array of body classes.
 * The first is if the site has only had one author with published posts.
 * The second is if a singular post being displayed
 *
 * @since yoursite.com 1.0
 */
function yourtheme_body_classes( $classes ) {

	if ( ! is_multi_author() ) {
		$classes[] = 'single-author';
	}

	if ( is_singular() && ! is_home() && ! is_page_template( 'showcase.php' ) && ! is_page_template( 'sidebar-page.php' ) )
		$classes[] = 'singular';

	return $classes;
}
add_filter( 'body_class', 'yourtheme_body_classes' );

add_post_type_support( 'page', 'excerpt' ); // Enable excerpts for pages.



if ( ! function_exists( 'twentyeleven_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 * Create your own twentyeleven_posted_on to override in a child theme
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_posted_on() {
	printf( __( '<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="by-author"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'twentyeleven' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'twentyeleven' ), get_the_author() ) ),
		get_the_author()
	);
}
endif;

/* Disable WordPress Admin Bar for all users but admins. */
if (!current_user_can('administrator')):
  show_admin_bar(false);
endif;

function load_jquery() {
	// only use this method is we're not in wp-admin
	if (!is_admin()) {

		// deregister the original version of jQuery
		wp_deregister_script('jquery');

		// discover the correct protocol to use
		$protocol = 'http:';
		if ($_SERVER['HTTPS'] == 'on') {
			$protocol = 'https:';
		}

		// register the Google CDN version
		wp_register_script('jquery', $protocol . '//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js', false);

		// add it back into the queue
		wp_enqueue_script('jquery');
	}
}

//add_action('template_redirect', 'load_jquery');
add_action('wp_print_scripts', 'load_jquery');