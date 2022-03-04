<?php
/* Welcome to Bones :)
This is the core Bones file where most of the
main functions & features reside. If you have
any custom functions, it's best to put them
in the functions.php file.

Developed by: Eddie Machado
URL: http://themble.com/bones/

	- head cleanup (remove rsd, uri links, junk css, ect)
	- enqueueing scripts & styles
	- theme support functions
	- custom menu output & fallbacks
	- related post function
	- page-navi function
	- removing <p> from around images
	- customizing the post excerpt

*/

/*********************
WP_HEAD GOODNESS
Clean up head
 *********************/

function bones_head_cleanup() {
	// category feeds
	// remove_action( 'wp_head', 'feed_links_extra', 3 );
	// post and comment feeds
	// remove_action( 'wp_head', 'feed_links', 2 );
	// EditURI link
	remove_action('wp_head', 'rsd_link');
	// windows live writer
	remove_action('wp_head', 'wlwmanifest_link');
	// previous link
	remove_action('wp_head', 'parent_post_rel_link', 10, 0);
	// start link
	remove_action('wp_head', 'start_post_rel_link', 10, 0);
	// links for adjacent posts
	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
	// WP version
	remove_action('wp_head', 'wp_generator');
	// remove WP version from css
	add_filter('style_loader_src', 'bones_remove_wp_ver_css_js', 9999);
	// remove Wp version from scripts
	add_filter('script_loader_src', 'bones_remove_wp_ver_css_js', 9999);
} /* end bones head cleanup */

// A better title
// http://www.deluxeblogtips.com/2012/03/better-title-meta-tag.html
function rw_title($title, $sep, $seplocation) {
	global $page, $paged;

	// Don't affect in feeds.
	if (is_feed()) return $title;

	// Add the blog's name
	if ('right' == $seplocation) {
		$title .= get_bloginfo('name');
	}
	else {
		$title = get_bloginfo('name') . $title;
	}

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo('description', 'display');

	if ($site_description && (is_home() || is_front_page())) {
		$title .= " {$sep} {$site_description}";
	}

	// Add a page number if necessary:
	if ($paged >= 2 || $page >= 2) {
		$title .= " {$sep} " . sprintf(__('Page %s', 'dbt') , max($paged, $page));
	}

	return $title;
} // end better title
// remove WP version from RSS
function bones_rss_version() {
	return '';
}

// remove WP version from scripts
function bones_remove_wp_ver_css_js($src) {
	if (strpos($src, 'ver=')) $src = remove_query_arg('ver', $src);
	return $src;
}

// remove injected CSS for recent comments widget
function bones_remove_wp_widget_recent_comments_style() {
	if (has_filter('wp_head', 'wp_widget_recent_comments_style')) {
		remove_filter('wp_head', 'wp_widget_recent_comments_style');
	}
}

// remove injected CSS from recent comments widget
function bones_remove_recent_comments_style() {
	global $wp_widget_factory;
	if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
		remove_action('wp_head', array(
			$wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
			'recent_comments_style'
		));
	}
}

// remove injected CSS from gallery
function bones_gallery_style($css) {
	return preg_replace("!<style type='text/css'>(.*?)</style>!s", '', $css);
}

/*********************
SCRIPTS & ENQUEUEING
 *********************/

// loading modernizr and jquery, and reply script
function bones_scripts_and_styles() {

	global $wp_styles; // call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way


	if (!is_admin()) {

		// modernizr (without media query polyfill)
		wp_register_script('bones-modernizr', get_stylesheet_directory_uri() . '/library/js/libs/modernizr.custom.min.js', array() , '2.5.3', false);

		// register main stylesheet
		wp_register_style('bones-stylesheet', get_stylesheet_directory_uri() . '/library/css/style.css?v1.3.7', array() , '0.0.1', 'all');

		// ie-only stylesheet
		//wp_register_style('bones-ie-only', get_stylesheet_directory_uri() . '/library/css/ie.css', array(), '');
		// flickity stylesheet
		wp_register_style('flickity-style', get_stylesheet_directory_uri() . '/bower_components/flickity/dist/flickity.min.css', array() , '');

		// okaynav stylesheet
		wp_register_style('okaynav-style', get_stylesheet_directory_uri() . '/bower_components/okaynav/dist/css/okayNav.min.css', array() , '');

		// okaynav stylesheet
		wp_register_style('simplelightbox-style', get_stylesheet_directory_uri() . '/bower_components/simplelightbox/dist/simplelightbox.css', array() , '');

		// font-awesome stylesheet
		wp_register_style('font-awesome-style', get_stylesheet_directory_uri() . '/bower_components/font-awesome/css/font-awesome.min.css', array() , '');

		// font-awesome stylesheet
		wp_register_style('education-fonts', 'https://fonts.googleapis.com/css?family=Lora:400,700|Merriweather+Sans:400,700|Merriweather:400,700|Open+Sans:400,700&display=swap', array() , '');

		// comment reply script for threaded comments
		if (is_singular() and comments_open() and (get_option('thread_comments') == 1)) {
			wp_enqueue_script('comment-reply');
		}

		//adding scripts file in the footer
		wp_register_script('smoothscroll-polyfill-js', get_stylesheet_directory_uri() . '/bower_components/smoothscroll/src/smoothscroll.js', array(
			'jquery'
		) , '', false);

		//adding scripts file in the footer
		//wp_register_script( 'greedynav-js', get_stylesheet_directory_uri() . '/library/js/libs/greedynav.js', array( 'jquery' ), '', false );
		//adding scripts file in the footer
		wp_register_script('flickity-js', get_stylesheet_directory_uri() . '/bower_components/flickity/dist/flickity.pkgd.min.js', array(
			'jquery'
		) , '', true);

		//adding scripts file in the footer
		wp_register_script('reveal-js', get_stylesheet_directory_uri() . '/bower_components/scrollreveal/dist/scrollreveal.min.js', array(
			'jquery'
		) , '', true);

		//adding scripts file in the footer
		wp_register_script('simplelightbox-js', get_stylesheet_directory_uri() . '/bower_components/simplelightbox/dist/simple-lightbox.min.js', array(
			'jquery'
		) , '', true);

		//adding scripts file in the footer
		wp_register_script('parallax-js', get_stylesheet_directory_uri() . '/library/js/libs/parallax.js-2.0.0/dist/jquery.parallax.js', array(
			'jquery'
		) , '', true);

		//adding scripts file in the footer
		wp_register_script('simpleparallax-js', get_stylesheet_directory_uri() . '/bower_components/simpleParallax/dist/simpleParallax.js', array(
			'jquery'
		) , '', true);

		//adding scripts file in the footer
		wp_register_script('hammer-js', 'https://dl.dropboxusercontent.com/s/zkhrhwpagv1cxqg/jquery.hammer.js', array(
			'jquery'
		) , '', true);

		//adding scripts file in the footer
		wp_register_script('overview-post-js', get_stylesheet_directory_uri() . '/library/js/overview-post.js', array(
			'jquery'
		) , '', true);

		//adding scripts file in the footer
		wp_register_script('bones-js', get_stylesheet_directory_uri() . '/library/js/scripts.js', array(
			'jquery'
		) , '', true);

		//adding scripts file in the footer
		wp_register_script('archive-bones-js', get_stylesheet_directory_uri() . '/library/js/archive-scripts.js', array(
			'jquery'
		) , '', true);

		//adding scripts file in the footer
		wp_register_script('page-builder-js', get_stylesheet_directory_uri() . '/library/js/builder.js', array(
			'jquery'
		) , '', true);

		// enqueue styles and scripts
		wp_enqueue_script('bones-modernizr');
		wp_enqueue_style('flickity-style');
		wp_enqueue_style('simplelightbox-style');
		wp_enqueue_style('bones-stylesheet');
		wp_enqueue_style('font-awesome-style');
		wp_enqueue_style('comp-header-style', get_template_directory_uri() . '/library/css/header.css?v3');
		//wp_enqueue_style('bones-ie-only');
		//$wp_styles->add_data('bones-ie-only', 'conditional', 'lt IE 9'); // add conditional wrapper around ie stylesheet
		/*
		I recommend using a plugin to call jQuery
		using the google cdn. That way it stays cached
		and your site will load faster.
		*/

		wp_enqueue_script('jquery');
		wp_enqueue_script('hammer-js');
		wp_enqueue_script('simpleparallax-js');
		wp_enqueue_script('flickity-js');
		//wp_enqueue_script( 'greedynav-js' );
		wp_enqueue_script('simplelightbox-js');
		wp_enqueue_script('bones-js');

		if (is_archive() || (!is_front_page() && is_home())) {
			wp_enqueue_script('archive-bones-js');
		}

		if (is_page_template('page-builder.php')) {
			wp_enqueue_script('reveal-js');
			wp_enqueue_script('page-builder-js');
		}

		if (is_page_template('single-overview-post.php')) {
			wp_enqueue_script('overview-post-js');
		}
	}
}

function bones_load_gutenberg_assets() {
	wp_enqueue_style('bones-gutenberg', get_stylesheet_directory_uri() . '/library/css/gutenberg.css', false);
}

/*********************
THEME SUPPORT
*********************/

// Adding WP 3+ Functions & Theme Support
function bones_theme_support() {

	// wp thumbnails (sizes handled in functions.php)
	add_theme_support('post-thumbnails');

	// default thumb size
	set_post_thumbnail_size(125, 125, true);

	update_option('image_default_size', 'full');

	// customizer logo
	add_theme_support('custom-logo');

	// rss thingy
	add_theme_support('automatic-feed-links');

	// wp menus
	add_theme_support('menus');

	// registering wp3+ menus
	register_nav_menus(array(
		'main-nav' => __('The Main Menu', 'screenpartner') , // main nav in header
		'landing-nav' => __('Landing Menu', 'screenpartner')
	));

	// Enable support for HTML5 markup.
	add_theme_support('html5', array(
		'comment-list',
		'search-form',
		'comment-form'
	));

	add_theme_support('title-tag');
} /* end bones theme support */

/*********************
START SESSIONS
*********************/

if (!session_id()) {
	session_start();
}

/*********************
PAGE NAVI
 *********************/

// Numeric Page Navi (built into the theme by default)
function bones_page_navi() {
	global $wp_query;
	$bignum = 999999999;
	if ($wp_query->max_num_pages <= 1) return;
	echo '<nav class="pagination">';
	echo paginate_links(array(
		'base' => str_replace($bignum, '%#%', esc_url(get_pagenum_link($bignum))) ,
		'format' => '',
		'current' => max(1, get_query_var('paged')) ,
		'total' => $wp_query->max_num_pages,
		'prev_text' => '&larr;',
		'next_text' => '&rarr;',
		'type' => 'list',
		'end_size' => 3,
		'mid_size' => 3
	));
	echo '</nav>';
} /* end page navi */

/*********************
RANDOM CLEANUP ITEMS
 *********************/

// remove the p from around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
function bones_filter_ptags_on_images($content) {
	return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

// This removes the annoying [�K] to a Read More link
function bones_excerpt_more($more) {
	global $post;
	// edit here if you like
	return '...  <a class="excerpt-read-more" href="' . get_permalink($post->ID) . '" title="' . __('Read ', 'screenpartner') . esc_attr(get_the_title($post->ID)) . '">' . __('Read more &raquo;', 'screenpartner') . '</a>';
}

// Wrap embeds like Youtube and Vimeo in
// surrounding div for easier style possibilities
function wrap_embed_with_div($html, $url, $attr) {
	return '<div class="video-container">' . $html . '</div>';
}
add_filter('embed_oembed_html', 'wrap_embed_with_div', 10, 3);

if (!current_user_can('manage_options')) {
	add_filter('show_admin_bar', '__return_false');
}

/*******************************
THEME DEVELOPMENT FUNCTIONALITY
 *******************************/

function get_featured_image_url($id, $size = "full") {
	global $post;

	$fi_src = wp_get_attachment_image_src(get_post_thumbnail_id($id) , $size);
	$fi_url = $fi_src[0];

	return $fi_url;
}

// Button shortcode
// Customize to client
function sp_button_shortcode($atts) {
	extract(shortcode_atts(array(
		'title' => 'Title',
		'url' => '',
		'color' => ''
	) , $atts));
	return '<a class="btn ' . $color . ' btn-' . $color . '" href="' . $url . '">' . $title . '</a>';
}
add_shortcode('btn', 'sp_button_shortcode');

// Check if post is a $type custom post type,
// inside or outside of the loop.
// Ex: if ( is_post_type( 'book' ) ) {}
function is_post_type($type) {
	global $wp_query;
	if ($type == get_post_type($wp_query
		->post
		->ID)) return true;
	return false;
}

// Custom excerpt that strips all content but text.
// Customizable word length, ending phrase and "read more" link.
function custom_excerpt($num_words = 45, $ending = '...', $post_id = null) {
	global $post;

	// Truncate post content
	$current_post = $post_id ? get_post($post_id) : $post;
	$excerpt = $current_post->post_excerpt;

	if ($excerpt == '') {
		// If excerpt is empty use content,
		$excerpt = strip_shortcodes($current_post->post_content);
	}
	else {
		// If excerpt has content use excerpt
		$excerpt = strip_shortcodes($excerpt);
	}
	$excerpt = wp_trim_words($excerpt, $num_words, $ending);
	$excerpt = trim($excerpt);

	// Read more link (COMMENT OUT THIS AND $more_link IF NOT LINKABLE)
	// $excerpt .= '<a class="readmore-custom" href="' . get_permalink( $post ) . '" title="' . get_the_title( $post ) . '">' . $more_link . '</a>';
	return $excerpt;
}

function sp_show_first_gutenberg_blocks_or_excerpt($total_blocks = 8) {
	global $post;
	$output = '';

	if (has_blocks($post->post_content)) {
		$blocks = parse_blocks($post->post_content);

		$count = 0;

		foreach ($blocks as $block) {
			if ($total_blocks <= $count) {
				break;
			}

			if ($block['blockName'] === 'core/cover') {
				$output .= render_block($block);
			}
			elseif ($block['blockName'] === 'core/paragraph') {
				$output .= '<p>' . wp_trim_words($block['innerHTML'], 55, '...') . '</p>';
			}
			elseif ($block['blockName'] === 'core-embed/youtube') {
				$output .= '<p>' . wp_oembed_get($block['attrs']['url']) . '</p>';
			}
			elseif ($block['blockName'] === 'core/shortcode') {
				$count--;
			}
			else {
				// $output .= print_r($block);
				$output .= render_block($block);
			}

			$count++;
		}
	}
	else {
		$output = custom_excerpt(55, '...', $post->ID);
	}

	return $output;
}

function sp_list_all_categories() {
	$cats = get_categories();
	$html = '';
	$fwp_slug = __('?fwp_artikkelkategorier=', 'screenpartner');
	$article_url = get_post_type_archive_link('post');

	if (!$cats) {
		return;
	}

	foreach ($cats as $cat) {
		$full_url = $article_url . $fwp_slug . $cat->slug;

		if ($cat->slug != 'ukategorisert') {
			$html .= '<a class="cat" rel="category" href="' . $full_url . '" title="' . __('View all articles in category', 'screenpartner') . ' ' . $cat->name . '">';
			$html .= $cat->name;
			$html .= '</a>';
		}
	}

	return $html;
}

function sp_list_all_terms_with_facetwp_urls($taxonomy) {
	$terms = get_terms($taxonomy);

	if (!$terms) {
		return;
	}

	$html = '';
	$count = 0;

	$fwp_slug = __('?fwp_' . $taxonomy . '=', 'screenpartner');
	$article_url = get_post_type_archive_link('education');

	foreach ($terms as $term) {
		$full_url = $article_url . $fwp_slug . $term->slug;

		if ($term->slug != 'ukategorisert') {
			$html .= '<a class="cat" rel="category" href="' . $full_url . '" title="' . __('View all articles in category', 'screenpartner') . ' ' . $term->name . '">';
			$html .= $term->name;
			$html .= '</a>';
		}
	}

	return $html;
}

function list_post_categories($post_id) {
	$post_cats = wp_get_post_categories($post_id);

	$html = '';
	$count = 0;
	$all_cats = count($post_cats);

	if ($post_cats) {
		$html = '<div class="article-categories">';
		foreach ($post_cats as $kat) {
			$count++;
			$category = get_category($kat);
			// $cat_color = get_field('category_color', $category);
			$cat_color = '#000000';
			$html .= '<p itemprop="keywords" class="cat ' . $category->slug . '" style="background-color: ' . $cat_color . ';">' . get_cat_name($kat) . '</p>';
		}
		$html .= '</div>';
	}

	return $html;
}

function list_post_terms($post_id, $taxonomy, $class = 'sp-term', $color = '') {
	$terms = wp_get_post_terms($post_id, $taxonomy, array(
		'orderby' => 'term_order'
	));

	$html = '';
	$count = 0;

	if (!$terms) {
		return;
	}

	foreach ($terms as $term) {
		$count++;
		$html .= '<p itemprop="keywords" style="background-color: ' . $color . ';" class="' . $class . ' ' . $term->slug . '">' . $term->name . '</p>';
	}

	return $html;
}

function getBitly($url) {
	$bitly = file_get_contents("http://api.bit.ly/v3/shorten?login=michaelw90&apiKey=R_b8c95eb0689147258c7b266ad2979d80&longUrl=$url%2F&format=txt");
	return $bitly;
}

// DELELENKER
function sp_delelenker($post_id) {
	$title = str_replace(' ', '%20', get_the_title($post_id));
	$emailURL = $title . '&amp;body=' . $title . '%0D%0A' . get_the_permalink();
?>
	<div class="delelenker">
	<p class="byline entry-meta vcard">
	<?php $date_format = __('F j, Y', 'screenpartner'); ?>
	<?php printf(__('Posted', 'screenpartner') . ' %1$s ',
	/* the time the post was published */
	'<time class="updated entry-time" datetime="' . get_the_time('Y-m-d') . '" itemprop="datePublished">' . get_the_time($date_format) . '</time>'); ?>
	</p>
	<a class="facebook" target="_blank" href="http://www.facebook.com/sharer.php?u=<?php the_permalink($post_id); ?>&amp;t=<?php echo $title; ?>" title="Share on Facebook."><i class="fa fa-facebook"></i></a>
	<a class="twitter" target="_blank" href="http://twitter.com/home/?status=<?php echo $title; ?>%20-%20<?php $bitly = getBitly(get_permalink($post_id));
	echo $bitly; ?>" title="Tweet this!"><i class="fa fa-twitter"></i></a>
	<a class="linkedin" target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&amp;title=<?php echo $title; ?>&amp;url=<?php the_permalink($post_id); ?>" title="Share on LinkedIn"><i class="fa fa-linkedin"></i></a>
	<a class="email" href="mailto:?subject=<?php echo $emailURL; ?>" target="_blank" title="Share with email"><i class="fa fa-envelope"></i></a>

	<?php the_favorites_button($post_id); ?>
	</div>
<?php
}

/*********************************
LOGIN / REGISTER BUTTONS IN HEADER
*********************************/
function bokasin_login_buttons() {
	$login_bar = '';
	$my_account_url = get_permalink(get_option('woocommerce_myaccount_page_id'));
	$logout_url = wp_logout_url(get_permalink());
	$register_link = get_site_url() . __('/register', 'screenpartner');
	$user_id = get_current_user_id();
	$gravatar = get_avatar($user_id, 96);
	$gravatar_markup = '';

	if (is_account_page()) {
		$my_account_class = 'current-menu-item';
	}
	else {
		$my_account_class = '';
	}

	if ($gravatar) {
		$gravatar_markup = "<span>" . $gravatar . "</span>";
	}

	if (is_user_logged_in()) {
		$login_bar .= '<li class="logout-link my-account-link ' . $my_account_class . '"><a href="' . $my_account_url . '" title="' . __('My account', 'screenpartner') . '">' . $gravatar_markup . __('My account', 'screenpartner') . '</a></li>';
		// $login_bar .= '<li class="logout-link"><a href="' . $logout_url . '" title="' . __('Log out', 'screenpartner') . '">' . __('Log out', 'screenpartner') . '</a></li>';

	}
	else {
		$login_bar .= '<li class="login-link"><a href="' . $my_account_url . '" title="' . __('Log in', 'screenpartner') . '">' . __('Log in', 'screenpartner') . '</a></li>';
		$login_bar .= '<li class="register-link"><a href="' . $register_link . '" title="' . __('Sign up', 'screenpartner') . '">' . __('Sign up', 'screenpartner') . '</a></li>';
	}

	return $login_bar;
}

/*********************************
WPML HEADER LANGUAGE SWITCHER
*********************************/

function bokasin_wpml_language_switcher() {
	$login_bar = '';

	$languages = icl_get_languages('skip_missing=0&orderby=code');
	if (!empty($languages)) {
		foreach ($languages as $l) {
			$login_bar .= '<li class="menu-item flag">';
			if (!$l['active']) {
				$login_bar .= '<a href="' . $l['url'] . '">';
			}
			else {
				$login_bar .= '<span>';
			}

			$login_bar .= '<img src="' . $l['country_flag_url'] . '" alt="' . $l['language_code'] . '" />';

			if (!$l['active']) {
				$login_bar .= '</a>';
			}
			else {
				$login_bar .= '</span>';
			}
		}
	}

	return $login_bar;
}

/************************************
APPEND STATIC LINKS TO MAIN NAV MENU
 ************************************/
add_filter('wp_nav_menu_items', 'sp_append_extra_btns_main_nav', 10, 2);
function sp_append_extra_btns_main_nav($menu_items, $args) {
	if ($args->theme_location == 'main-nav') {
		if (ICL_LANGUAGE_CODE == 'nb' || ICL_LANGUAGE_CODE == 'sv') {
			$menu_items .= bokasin_login_buttons();
		}
		$menu_items .= bokasin_header_cart_btn();
		$menu_items .= bokasin_wpml_language_switcher();
	}
	return $menu_items;
}

/*********************
RELATED POSTS FUNCTION
 *********************/

function get_max_related_posts($taxonomy_1 = 'post_tag', $taxonomy_2 = 'category', $total_posts = 6) {
	// First, make sure we are on a single page, if not, bail
	if (!is_single()) return false;

	// Sanitize and vaidate our incoming data
	if ('post_tag' !== $taxonomy_1) {
		$taxonomy_1 = filter_var($taxonomy_1, FILTER_SANITIZE_STRING);
		if (!taxonomy_exists($taxonomy_1)) return false;
	}

	if ('category' !== $taxonomy_2) {
		$taxonomy_2 = filter_var($taxonomy_2, FILTER_SANITIZE_STRING);
		if (!taxonomy_exists($taxonomy_2)) return false;
	}

	if (4 !== $total_posts) {
		$total_posts = filter_var($total_posts, FILTER_VALIDATE_INT);
		if (!$total_posts) return false;
	}

	// Everything checks out and is sanitized, lets get the current post
	$current_post = sanitize_post($GLOBALS['wp_the_query']->get_queried_object());

	// Lets get the first taxonomy's terms belonging to the post
	$terms_1 = get_the_terms($current_post, $taxonomy_1);

	// Set a varaible to hold the post count from first query
	$count = 0;
	// Set a variable to hold the results from query 1
	$q_1 = [];

	// Make sure we have terms
	if ($terms_1) {
		// Lets get the term ID's
		$term_1_ids = wp_list_pluck($terms_1, 'term_id');

		// Lets build the query to get related posts
		$args_1 = ['post_type' => $current_post->post_type, 'post__not_in' => [$current_post->ID], 'posts_per_page' => $total_posts, 'fields' => 'ids', 'tax_query' => [['taxonomy' => $taxonomy_1, 'terms' => $term_1_ids, 'include_children' => false]], ];
		$q_1 = get_posts($args_1);
		// Count the total amount of posts
		$q_1_count = count($q_1);

		// Update our counter
		$count = $q_1_count;
	}

	// We will now run the second query if $count is less than $total_posts
	if ($count < $total_posts) {
		$terms_2 = get_the_terms($current_post, $taxonomy_2);
		// Make sure we have terms
		if ($terms_2) {
			// Lets get the term ID's
			$term_2_ids = wp_list_pluck($terms_2, 'term_id');

			// Calculate the amount of post to get
			$diff = $total_posts - $count;

			// Create an array of post ID's to exclude
			if ($q_1) {
				$exclude = array_merge([$current_post->ID], $q_1);
			}
			else {
				$exclude = [$current_post->ID];
			}

			$args_2 = ['post_type' => $current_post->post_type, 'post__not_in' => $exclude, 'posts_per_page' => $diff, 'fields' => 'ids', 'tax_query' => [['taxonomy' => $taxonomy_2, 'terms' => $term_2_ids, 'include_children' => false]], ];
			$q_2 = get_posts($args_2);

			if ($q_2) {
				// Merge the two results into one array of ID's
				$q_1 = array_merge($q_1, $q_2);
			}
		}
	}

	// Make sure we have an array of ID's
	if (!$q_1) return false;

	// Run our last query, and output the results
	$final_args = ['ignore_sticky_posts' => 1, 'post_type' => $current_post->post_type, 'posts_per_page' => count($q_1) , 'post__in' => $q_1, 'order' => 'ASC', 'orderby' => 'post__in',
	// 'suppress_filters'    => true,
	'no_found_rows' => true];
	$final_query = new WP_Query($final_args);

	return $final_query;
}

function sp_related_posts() {
	global $post;
	$related = get_max_related_posts();
	$post_list = '';
	if ($related) {
		while ($related->have_posts()) {
			$related->the_post();

			$post_list .= '<div class="news-article m-1of2 mt-1of2 t-1of3 d-1of3 with-padding cf">';
			$post_list .= '<div class="news-content-wrapper">';
			$post_list .= '<a href="' . get_permalink($post->ID) . '" title="' . $post->post_title . '">';
			if (get_featured_image_url($post->ID)) {
				$post_list .= '<div class="thumb" style="background-image: url(' . get_featured_image_url($post->ID, 'sp-thumb-large') . ');"></div>';
			}
			else {
				$post_list .= '<div class="thumb" style="background-image: url(' . get_template_directory_uri() . '/library/images/fi.png);"></div>';
			}
			$post_list .= '<div class="news-content">';
			$post_list .= '<h4 class="news-title">' . $post->post_title . '</h4>';
			$post_list .= list_post_categories($post->ID);
			$post_list .= do_shortcode('[favorite_button post_id="' . $post->ID . '" site_id="' . get_current_blog_id() . '"]');
			$post_list .= '</div>';
			$post_list .= '</a>';
			$post_list .= '</div>';

			$post_list .= '</div>';
		}
		wp_reset_postdata();
	}

	$takeapeak = __('Related articles', 'screenpartner');

	return sprintf('
	<div class="related-news cf">
	<h3>' . $takeapeak . '</h3>
	<div class="related-news-articles grid-skin">%s</div>
	</div> <!-- .relaterte-innlegg -->
	', $post_list);
}

add_filter('avatar_defaults', 'sp_new_gravatar');
function sp_new_gravatar($avatar_defaults) {
	$myavatar = get_template_directory_uri() . '/library/images/user.png';
	$avatar_defaults[$myavatar] = "Simple Icon";

	return $avatar_defaults;
}

/*********************
READ RELATED BOKASIN
 *********************/

function read_related_publication() {
	global $post;
	$related_publication = get_field('related_publication', $post->ID);

	if (!$related_publication) {
		return;
	}

	$pub_id = $related_publication->ID;
?>

	<aside class="read-related-publication">
	<p><?php echo __('Article from:', 'screenpartner') . ' ' . $related_publication->post_title; ?></p>
	<p><small><?php echo __('Read the entire publication here', 'screenpartner'); ?></small></p>

	<a href="<?php the_permalink($pub_id); ?>">
	<img class="publication-image" src="<?php echo get_featured_image_url($pub_id); ?>" alt="<?php echo $related_publication->post_title; ?>">
	</a>
	</aside>

	<?php
}

/*********************
USER FUNCTIONS
 *********************/

function sp_hello_user_shortcode() {
	if (!is_user_logged_in()) {
		return false;
	}
	else {
		$user = wp_get_current_user();
		//$my_account_url = get_permalink(get_option('woocommerce_myaccount_page_id'));
		$my_account_url = 'https://app.skolerom.no/';
		$output = '<div class="welcome-message cf">';
		$output .= __('Welcome back', 'screenpartner') . ' <strong>' . $user->display_name . '</strong>!';
		$output .= '<br>';
		$output .= __('What would you like to read?', 'screenpartner');
		$output .= '</div>';

		return $output;
	}
}
add_shortcode('hello_user', 'sp_hello_user_shortcode');

/*********************
SP FLOW TAG
 *********************/

function sp_flow_tag($post_id) {
	$page_template = get_page_template_slug($post_id);

	if ($page_template) {
		$output = '<span class="flow-tag">' . __('Flow article', 'screenpartner') . '</span>';
	}
	else {
		$output = '';
	}

	return $output;
}

/*********************
SP CONTENT TYPE TAG
 *********************/

function sp_get_content_type_tags($post_id) {
	$term_list = wp_get_post_terms($post_id, 'contenttype', array(
		"fields" => "all"
	));

	$html = '';

	if ($term_list) {

		$html .= '<div class="content-types">';

		foreach ($term_list as $term) {

			$term_id = get_term($term->term_id);
			$icon = get_field('content_type_icon', $term_id);

			if ($icon) {
				$html .= '<img class="content-type" src="' . $icon['url'] . '" alt="Vis artikkel" title="Vis artikkel">';
			}
		}

		$html .= '</div>';
	}

	return $html;
}

/*********************
SPOKEN ARTICLE MODULE SHORTCODE
 *********************/

function sp_spoken_article($atts) {
	ob_start();

	// define attributes and their defaults
	extract(shortcode_atts(array(
		'slug' => 'slug',
	) , $atts));

	$query = new WP_Query(array(
		'post_type' => 'spoken',
		'posts_per_page' => 1,
		'name' => $slug
	));

	if ($query->have_posts()) { ?>
	<div class="spoken-article cf">

	<?php while ($query->have_posts()):
			$query->the_post(); ?>

	<?php
			$id = get_the_ID();
			$lydfil = get_field('lydfil', $id);

			$audio_attr = array(
				'src' => $lydfil['url']
			);
?>

	<?php
			$featured_image_url = get_featured_image_url($id, 'sp-thumb-600'); ?>

	<?php if ($featured_image_url) { ?>
	<img src="<?php echo $featured_image_url; ?>" alt="Print Friendly version of featured image" class="spoken-fi">
	<?php
			} ?>

	<div class="spoken-innhold">
	<img class="spoken-ikon" src="<?php echo get_template_directory_uri(); ?>/library/images/listen.svg" alt="Listen">
	<?php echo wp_audio_shortcode($audio_attr); ?>
	</div>


	<?php
		endwhile;
		wp_reset_postdata(); ?>

	</div>

	<?php $myvariable = ob_get_clean();
		return $myvariable;
	}
}
add_shortcode('spoken_article', 'sp_spoken_article');

// DISABLE ADMIN default WordPress new user notification emails
if (!function_exists('wp_new_user_notification')) {
	function wp_new_user_notification($user_id, $deprecated = null, $notify = '') {

		global $wpdb, $wp_hasher;
		$user = get_userdata($user_id);

		// The blogname option is escaped with esc_html on the way into the database in sanitize_option
		// we want to reverse this for the plain text arena of emails.
		$blogname = wp_specialchars_decode(get_option('blogname') , ENT_QUOTES);

		// Generate something random for a password reset key.
		$key = wp_generate_password(20, false);

		/** This action is documented in wp-login.php */
		do_action('retrieve_password_key', $user->user_login, $key);

		// Now insert the key, hashed, into the DB.
		if (empty($wp_hasher)) {
			$wp_hasher = new PasswordHash(8, true);
		}
		$hashed = time() . ':' . $wp_hasher->HashPassword($key);
		$wpdb->update($wpdb->users, array(
			'user_activation_key' => $hashed
		) , array(
			'user_login' => $user->user_login
		));

		$switched_locale = switch_to_locale(get_user_locale($user));

		$message = sprintf(__('Username: %s') , $user->user_login) . "\r\n\r\n";
		$message .= __('To set your password, visit the following address:') . "\r\n\r\n";
		$message .= '<' . network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user->user_login) , 'login') . ">\r\n\r\n";

		$message .= wp_login_url() . "\r\n";

		wp_mail($user->user_email, sprintf(__('[%s] Your username and password info') , $blogname) , $message);
	}
}

/*********************
CUSTOMIZE POST TYPE SLUG
FOR PUBLICATION
 *********************/

add_action('load-options-permalink.php', 'sp_load_permalinks');
function sp_load_permalinks() {
	if (isset($_POST['sp_publications_base'])) {
		update_option('sp_publications_base', sanitize_title_with_dashes($_POST['sp_publications_base']));
	}

	if (isset($_POST['sp_spoken_base'])) {
		update_option('sp_spoken_base', sanitize_title_with_dashes($_POST['sp_spoken_base']));
	}

	if (isset($_POST['sp_education_base'])) {
		update_option('sp_education_base', sanitize_title_with_dashes($_POST['sp_education_base']));
	}

	if (isset($_POST['sp_support_base'])) {
		update_option('sp_support_base', sanitize_title_with_dashes($_POST['sp_support_base']));
	}

	// Add settings fields to the permalink page
	add_settings_field('sp_publications_base', __('Publications Base') , 'sp_field_publications_permalink_callback', 'permalink', 'optional');
	add_settings_field('sp_spoken_base', __('Spoken Base') , 'sp_field_spoken_permalink_callback', 'permalink', 'optional');
	add_settings_field('sp_education_base', __('Education Base') , 'sp_field_education_permalink_callback', 'permalink', 'optional');
	add_settings_field('sp_support_base', __('Support Base') , 'sp_field_support_permalink_callback', 'permalink', 'optional');
}

function sp_field_publications_permalink_callback() {
	$value = get_option('sp_publications_base');
	echo '<input type="text" value="' . esc_attr($value) . '" name="sp_publications_base" id="sp_publications_base" class="regular-text" />';
}

function sp_field_spoken_permalink_callback() {
	$value = get_option('sp_spoken_base');
	echo '<input type="text" value="' . esc_attr($value) . '" name="sp_spoken_base" id="sp_spoken_base" class="regular-text" />';
}

function sp_field_education_permalink_callback() {
	$value = get_option('sp_education_base');
	echo '<input type="text" value="' . esc_attr($value) . '" name="sp_education_base" id="sp_education_base" class="regular-text" />';
}

function sp_field_support_permalink_callback() {
	$value = get_option('sp_support_base');
	echo '<input type="text" value="' . esc_attr($value) . '" name="sp_support_base" id="sp_support_base" class="regular-text" />';
}

//add_action('pre_get_posts', 'sp_alter_main_blog_query');
function sp_alter_main_blog_query($query) {
	//gets the global query var object
	global $wp_query;

	if (is_admin() || !$query->is_main_query() || !is_home()) {
		return;
	}

	// Get Sort By option from ACF Options Page
	$sort_by = get_field('archive_sort_by', 'option');

	$popular_meta_query = array(
		'relation' => 'OR',
		array(
			'key' => 'simplefavorites_count',
			'compare' => 'EXISTS'
		) ,
		array(
			'key' => 'simplefavorites_count',
			'compare' => 'NOT EXISTS'
		)
	);

	if ($sort_by == 'random') {
		$query->set('orderby', 'rand');
	}
	elseif ($sort_by == 'recent') {
		$query->set('orderby', 'date');
	}
	elseif ($sort_by == 'popularity') {
		//$query->set('orderby', 'meta_value_num');
		//$query->set('meta_key', 'simplefavorites_count');
		$query->set('orderby', 'meta_key');
		$query->set('order', 'ASC');
		$query->set('meta_query', $popular_meta_query);
	}
	else {
		$query->set('orderby', 'date');
	}

	//we remove the actions hooked on the '__after_loop' (post navigation)
	remove_all_actions('__after_loop');
}

/*********************
MY ACCOUNT
 *********************/

function sp_my_account_navigation() {
	if (!is_user_logged_in()) {
		return false;
	}
	else {
		$user = wp_get_current_user();

		$output = '<div class="welcome-message cf">';
		$output .= '<h3>' . __('Welcome back', 'screenpartner') . ' ' . $user->user_firstname . '!</h3>';
		$output .= '</div>';

		return $output;
	}
}

/*********************
FAVORITES
 *********************/

function sp_get_recent_user_favorites() {
	$favorites = get_user_favorites();

	if (!$favorites) {
		return;
	}

	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

	$args = array(
		'post_type' => array(
			'post'
		) ,
		'paged' => $paged,
		'posts_per_page' => 8,
		'post_status' => array(
			'publish'
		) ,
		'order' => 'DESC',
		'orderby' => 'none',
		'ignore_sticky_posts' => true,
		'post__in' => $favorites
	);

	$loop = new WP_Query($args);
	$post_count = $loop->found_posts;

	if ($loop->have_posts()) {
?>
	<div class="favorites-list recent-favorites my-account-posts">
	<div class="grid-skin articles-wrapper facet-archive facetwp-template">
	<?php
		while ($loop->have_posts()) {
			$loop->the_post();
			get_template_part('template-parts/content', 'single-archive');
		}
?>
	</div>
	</div>
<?php
		echo '<div id="load-more-favorites" class="load-more-line"><a class="btn-purple" href="#!">' . __('Load more', 'screenpartner') . '</a></div>';
	}

	wp_reset_postdata();
}

/*********************
REDIRECT AFTER
RESET PASSWORD
*********************/

function sp_lost_password_redirect() {
	// Check if have submitted
	$confirm = (isset($_GET['action']) && $_GET['action'] == 'resetpass');

	if ($confirm) {
		wp_redirect(home_url());
		exit;
	}
}
add_action('login_headerurl', 'sp_lost_password_redirect');

/*********************
LOGGED IN FILTER / FUNCTIONALITY
*********************/

function sp_is_logged_in_filter_active() {
	$logged_in = get_field('logged_in_filter', 'option');

	return $logged_in;
}

/*********************
EXPIRE USERS AFTER 30 DAYS
 *********************/
// Adding Expired User Role
add_role('expired', __('Expired', 'screenpartner') , array(
	'read' => false
));

add_action('wp', function () {
	if (!wp_next_scheduled('sp_check_for_expired_users')) {
		wp_schedule_event(time() , 'daily', 'sp_check_for_expired_users');
	}
});

function sp_check_for_expired_users() {
	$args = array(
		'role' => 'Subscriber',
		'date_query' => array(
			array(
				'after' => '30 days ago',
			)
		)
	);

	$users = new WP_User_Query($args);

	if (!empty($users->get_results())) {
		foreach ($users->get_results() as $u) {
			// Debug
			// echo '<p>' . $u->display_name . ' expired</p>';
			$u->set_role('expired');
		}
	}
}

function sp_auto_redirect_external_after_logout() {
	wp_redirect(get_site_url());
	exit();
}
add_action('wp_logout', 'sp_auto_redirect_external_after_logout');

// Only display Norwegian publications in frontend
//add_filter('pre_get_posts', 'sp_only_display_norwegian_publications');
function sp_only_display_norwegian_publications($query) {
	// Don't do this in admin
	if (is_admin()) {
		return $query;
	}

	if ($query->is_post_type_archive('publication') && $query->is_main_query()) {
		$query->set('tax_query', array(
			'relation' => 'OR',
			array(
				'taxonomy' => 'publication_language',
				'field' => 'slug',
				'terms' => array(
					'norsk'
				) ,
				'operator' => 'IN'
			)
		));
	}

	return $query;
}

add_filter('wp_insert_attachment_data', 'check_manager_status', 10, 2);
add_post_type_support('education', 'excerpt');

function check_manager_status($data, $postarr) {
	if ((strpos($_SERVER['HTTP_HOST'], 'skolerom.no') == false) || strpos($_SERVER['HTTP_HOST'], 'ms2.computools.org') == false) {
		return $data;
	}

	$ch = curl_init(get_site_url() . ':84/api/resource/status');
	curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	$response = curl_exec($ch);

	$result = json_decode($response);
	if ($result->success == "success") {
		return $data;
	}
	else {
		return null;
	}
}
?>
