<?php
/*
Author: Michael Wilhelmsen

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images,
sidebars, comments, etc.
*/

// LOAD BONES CORE (if you remove this, the theme will break)
require_once( 'library/bones.php' );

// LOAD WOOCOMMERCE FUNCTIONS
require_once( 'library/woocommerce.php' );

// LOAD FACETWP FUNCTIONS
require_once( 'library/facet-functions.php' );

// LOAD GUTENBERG FUNCTIONALITY
require_once( 'library/gutenberg.php' );

// LOAD ACF FUNCTIONALITY
require_once( 'library/acf.php' );

// LOAD USER ARTICLE READS (AJAX FUNCTIONALITY)
require_once( 'library/user-reads.php' );

// LOAD USER ARTICLE READS (AJAX FUNCTIONALITY)
require_once( 'library/custom-queries-ajax.php' );

// CUSTOMIZE THE WORDPRESS ADMIN (on by default)
require_once( 'library/admin.php' );

/*********************
LAUNCH BONES
Let's get everything up and running.
*********************/

function bones_ahoy() {

	// Allow editor style.
	add_editor_style( get_stylesheet_directory_uri() . '/library/css/editor-style.css' );

	// let's get language support going, if you need it
	load_theme_textdomain( 'screenpartner', get_template_directory() . '/library/translation' );

	// USE THIS TEMPLATE TO CREATE CUSTOM POST TYPES EASILY
	require_once( 'library/custom-post-type.php' );

	// launching operation cleanup
	add_action( 'init', 'bones_head_cleanup' );
	// A better title
	add_filter( 'wp_title', 'rw_title', 10, 3 );
	// remove WP version from RSS
	add_filter( 'the_generator', 'bones_rss_version' );
	// remove pesky injected css for recent comments widget
	add_filter( 'wp_head', 'bones_remove_wp_widget_recent_comments_style', 1 );
	// clean up comment styles in the head
	add_action( 'wp_head', 'bones_remove_recent_comments_style', 1 );
	// clean up gallery output in wp
	add_filter( 'gallery_style', 'bones_gallery_style' );

	// enqueue base scripts and styles
	add_action( 'wp_enqueue_scripts', 'bones_scripts_and_styles', 999 );

	// enqueue backend styles for Gutenberg
	add_action( 'enqueue_block_editor_assets', 'bones_load_gutenberg_assets' );

	// ie conditional wrapper

	// launching this stuff after theme setup
	bones_theme_support();

	// adding sidebars to Wordpress (these are created in functions.php)
	add_action( 'widgets_init', 'bones_register_sidebars' );

	// cleaning up random code around images
	add_filter( 'the_content', 'bones_filter_ptags_on_images' );
	// cleaning up excerpt
	add_filter( 'excerpt_more', 'bones_excerpt_more' );

} /* end bones ahoy */

// let's get this party started
add_action( 'after_setup_theme', 'bones_ahoy' );


/************* OEMBED SIZE OPTIONS *************/

if ( ! isset( $content_width ) ) {
	$content_width = 680;
}

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'sp-thumb-600', 640, 240, false );
add_image_size( 'sp-thumb-large', 990, 9999, false );
add_image_size( 'sp-thumb-big', 1280, 9999, false );
add_image_size( 'sp-thumb-small', 400, 400, true );

add_filter( 'image_size_names_choose', 'bones_custom_image_sizes' );

function bones_custom_image_sizes( $sizes ) {
	return array_merge( $sizes, array(
		'sp-thumb-600' => __('640px by 240px'),
		'sp-thumb-large' => __('990px by xxx'),
		'sp-thumb-big' => __('1280px by xxx'),
		'sp-thumb-small' => __('400px by 400px'),
	));
}

/*
The bones_custom_image_sizes() above adds the ability to use
the dropdown menu to select the new images sizes you have just
created from within the media manager.
*/

/************* THEME CUSTOMIZE *********************/

function bones_theme_customizer($wp_customize) {
	// $wp_customize calls go here.
	$wp_customize->remove_section('colors');
	$wp_customize->remove_section('background_image');
}

add_action( 'customize_register', 'bones_theme_customizer' );

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function bones_register_sidebars() {
	register_sidebar(array(
		'id' => 'sidebar_main',
		'name' => __( 'Main Sidebar', 'screenpartner' ),
		'description' => __( 'The primary sidebar.', 'screenpartner' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));
	register_sidebar(array(
		'id' => 'sidebar_footer',
		'name' => __( 'Footer Widgets', 'screenpartner' ),
		'description' => __( 'The footer widgets go here.', 'screenpartner' ),
		'before_widget' => '<div id="%1$s" class="widget with-padding-large m-all t-1of3 d-1of3 %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));
}


/************* COMMENT LAYOUT *********************/

// Comment Layout
function bones_comments( $comment, $args, $depth ) {
	 $GLOBALS['comment'] = $comment; ?>
	<div id="comment-<?php comment_ID(); ?>" <?php comment_class('cf'); ?>>
		<article  class="cf">
			<header class="comment-author vcard">
				<?php
				/*
					this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
					echo get_avatar($comment,$size='32',$default='<path_to_url>' );
				*/
				?>
				<?php // custom gravatar call ?>
				<?php
					// create variable
					$bgauthemail = get_comment_author_email();
				?>
				<img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5( $bgauthemail ); ?>?s=40" class="load-gravatar avatar avatar-48 photo" height="40" width="40" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
				<?php // end custom gravatar call ?>
				<?php printf(__( '<cite class="fn">%1$s</cite> %2$s', 'screenpartner' ), get_comment_author_link(), edit_comment_link(__( '(Edit)', 'screenpartner' ),'  ','') ) ?>
				<time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__( 'F jS, Y', 'screenpartner' )); ?> </a></time>

			</header>
			<?php if ($comment->comment_approved == '0') : ?>
				<div class="alert alert-info">
					<p><?php _e( 'Your comment is awaiting moderation.', 'screenpartner' ) ?></p>
				</div>
			<?php endif; ?>
			<section class="comment_content cf">
				<?php comment_text() ?>
			</section>
			<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		</article>
	<?php // </li> is added by WordPress automatically ?>
<?php
} // don't remove this bracket!
/* **************************************************** */
/* DON'T DELETE THIS CLOSING TAG */ ?>
