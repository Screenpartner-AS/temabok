<?php
/************************
WOOCOMMERCE FUNCTIONALITY
************************/

/******************
WOOCOMMERCE SUPPORT
******************/
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}


/*********************************
Change Woocommerce css breakpoints
from max width: 768px to 767px
*********************************/
add_filter('woocommerce_style_smallscreen_breakpoint','woo_custom_breakpoint');
function woo_custom_breakpoint($px) {
	$px = '767px';
	return $px;
}

/*********************************
Change Woocommerce products per column
*********************************/
// add_filter('loop_shop_columns', 'loop_columns');
// if (!function_exists('loop_columns')) {
// 	function loop_columns() {
// 		return 3; // 3 products per row
// 	}
// }


/*********************************
ADD HEADING FOR CHECKOUT PAYMENT SECTION
*********************************/
add_action('woocommerce_review_order_before_payment', 'sp_payment_heading');
function sp_payment_heading() {
	echo '<h3 id="payment_options_heading">' . __('Payment Options', 'screenpartner') . '</h3>';
}

/***************************
WOOCOMMERCE CONTENT WRAPPERS
***************************/
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
add_action('woocommerce_before_main_content', 'my_theme_wrapper_wrap_start', 15);
add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);
add_action('woocommerce_after_main_content', 'my_theme_wrapper_wrap_end', 15);

function my_theme_wrapper_start() {
	echo '<section id="content" class="cf">';
}

function my_theme_wrapper_wrap_start() {
	if (is_shop()) {
		echo '<div class="big-wrap cf">';
	} else {
		echo '<div class="wrap cf">';
	}
}

function my_theme_wrapper_end() {
	echo '</section>';
}

function my_theme_wrapper_wrap_end() {
	echo '</div>';
}

/************************
WOOCOMMERCE IMAGE WRAPPER
************************/
add_action( 'woocommerce_before_shop_loop_item_title', 'image_wrapper_start', 5);
add_action( 'woocommerce_before_shop_loop_item_title', 'image_wrapper_end', 15);

function image_wrapper_start() {
	echo '<div class="wc-thumb-wrap">';
}

function image_wrapper_end() {
	echo '</div>';
}

/************************
WOOCOMMERCE Conten Wrapper
************************/
add_action( 'woocommerce_shop_loop_item_title', 'single_product_content_wrapper_start', 5);
add_action( 'woocommerce_after_shop_loop_item_title', 'single_product_content_wrapper_end', 20);

function single_product_content_wrapper_start() {
	echo '<div class="wc-content-wrap">';
}

function single_product_content_wrapper_end() {
	echo '</div>';
}



/**********************************
WOOCOMMERCE ARCHIVE FILTERS WRAPPER
**********************************/
add_action( 'woocommerce_before_shop_loop', 'archive_filters_start', 15);
add_action( 'woocommerce_before_shop_loop', 'archive_filters_end', 35);

function archive_filters_start() {
	echo '<div class="archive-filters-wrapper cf">';
}

function archive_filters_end() {
	echo '</div>';
}


/**********************************
WOOCOMMERCE CART WRAPPER
**********************************/
add_action( 'woocommerce_before_cart', 'cart_wrapper_start');
add_action( 'woocommerce_after_cart', 'cart_wrapper_end');

function cart_wrapper_start() {
	echo '<div class="sp-cart-wrapper cf">';
}

function cart_wrapper_end() {
	echo '</div>';
}


/**********************************
SHOW REGULAR PRICE IN ADDITION TO
SALE PRICE IN CART
**********************************/
add_filter( 'woocommerce_cart_item_price', 'sp_show_nonsale_price', 10, 2 );
function sp_show_nonsale_price( $newprice, $product ) {
	$_product = $product['data'];
	$saleprice = $_product->sale_price;

	if ( $saleprice > 0 ) {
		$newprice = '';
		$newprice .= '<del><small style="color:#c9c9c9;">';
		$newprice .= wc_price( $_product->regular_price );
		$newprice .= '</small></del> <strong>';
		$newprice .= wc_price( $_product->sale_price );
		$newprice .= '</strong>';

		return $newprice;
	} else {
		$newprice = wc_price( $_product->price );
		return $newprice;
	}
}


/**********************************
DISPLAY TOTAL SAVINGS IN CART
**********************************/
function sp_display_total_savings_in_cart() {
	global $woocommerce;

	// Get cart contents
	$cart_subtotal = $woocommerce->cart->cart_contents;

	// Set discount & regular variable to 0 so it is available outside the loop
	$discount_total = 0;
	$regular_total = 0;

	// Loop through the cart contents to get the product IDs
	foreach ($woocommerce->cart->cart_contents as $product_data) {

		// Check if the product in the basket is a variation
		// if it is set the variation ID for product content
		// else get the simple product ID
		if ($product_data['variation_id'] > 0) {
			$product = wc_get_product( $product_data['variation_id'] );
		} else {
			$product = wc_get_product( $product_data['product_id'] );
		}

		// Now we have the data we need calculate the discount price minus the sale price from the regular and times it by its quantity, and add it to the discount total
		// Added "if" to only run this when there is a discount @ RMelogli_LEnev_12May2016
		if ( !empty($product->sale_price) ) {
			$discount = ($product->regular_price - $product->sale_price) * $product_data['quantity'];
			$discount_total += $discount;
			$regular_price = $product->regular_price * $product_data['quantity'];
			$regular_total += $regular_price;
		}
	}

	// Display our discount on the frontend as a formatted number and get the woocommerce base currency
	// Added "if" to only display this when there is a discount @ RMelogli_LEnev_12May2016
	// Added also coupon amount @ RMelogli_24May2016

	if ( $discount_total > 0 ) {
		echo '<tr class="cart-discount">
		<th>'. __( 'You Saved', 'screenpartner' ) .'</th>
		<td data-title=" '. __( 'You Saved', 'screenpartner' ) .' ">'
		. wc_price($discount_total + $woocommerce->cart->discount_cart) . ' (' . __('Price with no discount: ', 'screenpartner') . wc_price($regular_total) . ')</td>
		</tr>';
	}
}

// Hook our values to the Basket and Checkout pages
add_action( 'woocommerce_cart_totals_after_order_total', 'sp_display_total_savings_in_cart');
add_action( 'woocommerce_review_order_after_order_total', 'sp_display_total_savings_in_cart');


/**************************************
REMOVE DEFAULT WOOCOMMERCE COUNTER,
ADD CUSTOM WPFACET PRODUCT LOOP COUNTER
**************************************/
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20);


/*********************************************
WRAP ARCHIVE HEADER IN DIV
*********************************************/
add_action('woocommerce_before_main_content', 'sp_wrap_in_archive_header_start', 40);
function sp_wrap_in_archive_header_start() {
	echo '<div class="archive-header">';
}

add_action('woocommerce_before_shop_loop', 'sp_wrap_in_archive_header_end', 45);
function sp_wrap_in_archive_header_end() {
	echo '</div>';
}

/*********************************************
MOVE SIDEBAR
*********************************************/
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar');
add_action( 'woocommerce_before_shop_loop', 'woocommerce_get_sidebar', 70 );

/*********************************************
WRAP ARCHIVE HEADER IN DIV
*********************************************/

add_action('woocommerce_before_shop_loop', 'sp_product_wrap_start', 50);
function sp_product_wrap_start() {
	echo '<div class="sp-product-container">';
}

add_action('woocommerce_after_shop_loop', 'sp_product_wrap_end', 20);
function sp_product_wrap_end() {
	echo '</div>';
}

/************************************
REMOVING WOOCOMMERCE PAGINATION
************************************/
remove_action('woocommerce_after_shop_loop', 'woocommerce_pagination', 10);

function sp_show_more_button() {
	echo '<button class="btn-orange fwp-load-more">' . __("Show more", "screenpartner") . '</button>';
}
add_action('woocommerce_after_shop_loop', 'sp_show_more_button', 25);


/*************************************
WOOCOMMERCE MINI CART BUTTON IN HEADER
*************************************/
function bokasin_header_cart_btn() {
	$button_markup = '';
	$cart_link = wc_get_cart_url();
	$number_of_products = WC()->cart->cart_contents_count;
	$cart_subtotal = WC()->cart->subtotal;
	$cart_icon = get_template_directory_uri() . '/library/images/cart.svg';

	if ($number_of_products == 0) {
		$button_markup = '<li class="btn-cart mini_cart_button inactive"><a href="#"></a></li>';
	} else {
		$button_markup = '<li class="btn-cart mini_cart_button"><a href="' . $cart_link . '">';
		$button_markup .= '<img src="' . $cart_icon . '"><span>' . $number_of_products . '</span>';
		$button_markup .= '</a></li>';
	}
	return $button_markup;
}


// Ajaxifies bokasin_header_cart_btn()
add_filter('woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');
function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	ob_start();

	echo bokasin_header_cart_btn();

	$fragments['li.mini_cart_button'] = ob_get_clean();
	return $fragments;
}

/************************************
REPLACING WOOCOMMERCE BREADCRUMBS
WITH YOAST BREADCRUMBS
************************************/
add_action( 'init', 'sp_remove_wc_breadcrumbs' );
function sp_remove_wc_breadcrumbs() {
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
}

add_action('woocommerce_before_main_content', 'woo_custom_use_navxt_breadcrumbs', 20);
function woo_custom_use_navxt_breadcrumbs() {
	if ( function_exists('bcn_display') ) {
		echo '<div id="breadcrumbs">';
		bcn_display();
		echo '</div>';
	}
}

/************************************
REDIRECT USER TO PUBLICATIONS
AFTER LOG IN
************************************/
// add_filter('woocommerce_login_redirect', 'wc_login_redirect');
// function wc_login_redirect( $redirect_to ) {
//   $redirect_to = get_post_type_archive_link('publication');
//   return $redirect_to;
// }


/****************************************
CHANGE ADD TO CART TEXT ON SINGLE PRODUCT
****************************************/
add_filter( 'woocommerce_product_single_add_to_cart_text', 'woo_custom_cart_button_text' );    // 2.1 +
function woo_custom_cart_button_text() {
	global $product;

	if ( $product->is_type( 'variable-subscription' ) || $product->is_type( 'subscription' )) {
		return __( 'Subscribe', 'screenpartner' );
	} else {
		return __( 'Buy Paper Edition', 'screenpartner' );
	}
}


/************************************
REMOVING RATING
ON PRODUCT ARCHIVE PAGES
************************************/
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);




/************************************
REMOVING WOOCOMMERCE SIDEBAR
************************************/
// remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar');


/************************************
REMOVING SINGLE PRODUCT META
************************************/
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);


/*********************************************
REMOVING SINGLE PRODUCT DESCRIPTION &
REMOVING SINGLE PRODUCT ADDITIONAL INFORMATION
*********************************************/
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);


/*********************************************
ADDING FILTERS BUTTON ON WOOCOMMERCE ARCHIVE
*********************************************/

add_action('woocommerce_before_shop_loop', 'sp_filters_toggle', 40);
function sp_filters_toggle() {
	echo '<div class="wrap filters-toggle cf">';
	echo '<a href="#" class=""><img src="' . get_template_directory_uri() . '/library/images/filters-white.svg" alt="Settings Icon">' . __("Filters", "screenpartner") . '</a>';
	echo '</div>';
}


/************************************
ALTERING ADDITIONAL ORDER INFORMATION FIELDS
************************************/
add_action('wp', 'sp_load_gift_field_with_opc_use');
function sp_load_gift_field_with_opc_use() {
	function remove_order_notes( $fields ) {
		unset($fields['order']['order_comments']);
		return $fields;
	}

	// Our hooked in function - $fields is passed via the filter!
	function sp_override_checkout_notes_fields( $fields ) {
		$fields['order']['order_comments']['placeholder'] = __('Fill in gift recipients name and address here', 'screenpartner');
		$fields['order']['order_comments']['label'] = __('Gift this product?', 'screenpartner');
		return $fields;
	}

	if (! is_admin() && is_page_template('page-campaign.php')) {
		// Order Notes Title and field - Additional Information
		add_filter( 'woocommerce_checkout_fields' , 'sp_override_checkout_notes_fields' );
	} else {
		// removes Order Notes Title - Additional Information
		add_filter( 'woocommerce_enable_order_notes_field', '__return_false' );
		// remove Order Notes Field
		add_filter( 'woocommerce_checkout_fields' , 'remove_order_notes' );
	}
}


/************************************
MAKE ONE PAGE CHECKOUT WORK WITH
PAGE BUILDER TEMPLATES
************************************/
add_action('wp', 'load_opc_on_page_builder_template');
function load_opc_on_page_builder_template() {
	if (! is_admin()) {
		if (is_page(9012) || is_page(24132) || is_page_template('page-campaign.php')) {
			class SG_OPC_Mods {
				private static $modified_opc_properties = false;
				public static function init() {
					add_action( 'wp_enqueue_scripts', array( __CLASS__, 'always_load_opc' ), 5 );
					add_filter( 'is_wcopc_checkout', '__return_true' );
				}
				public static function always_load_opc() {
					global $post;
					if ( class_exists( 'PP_One_Page_Checkout' ) && false === PP_One_Page_Checkout::$add_scripts ) {
						PP_One_Page_Checkout::$add_scripts       = true;
						PP_One_Page_Checkout::$shortcode_page_id = $post->ID;
						PP_One_Page_Checkout::enqueue_scripts();
						self::$modified_opc_properties = true;
					}
				}
			}
			SG_OPC_Mods::init();
		}
	}
}


/************************************
CHANGE PLACE ORDER BUTTON TEXT
************************************/
add_filter( 'woocommerce_order_button_text', 'sp_custom_order_button_text' );

function sp_custom_order_button_text() {
	if (is_page(9012) || is_page(24132) || is_page_template('page-campaign.php')) {
		return __( 'Subscribe', 'woocommerce' );
	} else {
		return __( 'Complete Order', 'woocommerce');
	}
}


/************************************
ADDING BOKASIN SUBSCRIPTION
AUTOMATICALLY TO CART ON VISIT
************************************/

// add item to cart on visit
add_action( 'template_redirect', 'add_product_to_cart' );
function add_product_to_cart() {
	if ( ! is_admin() ) {

		$the_product = '';

		if (is_page(9012) || is_page(24132)) {
			if (ICL_LANGUAGE_CODE == 'nb') {
				$the_product = 9021;
			// } elseif (ICL_LANGUAGE_CODE == 'sv') {
			//   $the_product = 24138;
			} else {
				$the_product = 9021;
			}
		} elseif (is_page_template('page-campaign.php')) {
			// Kampanjeprodukt
			$the_product = 19152;
		}

		// IF IS PAGE BOKASINKAMPANJE / BLI MEDLEM
		if (is_page(9012) || is_page(24132) || is_page_template('page-campaign.php')) {
			// get all active memberships for a user;
			// returns an array of active user membership objects
			$user_id = get_current_user_id();
			$active_memberships = wc_memberships_get_user_memberships( $user_id );

			if ( empty( $active_memberships ) ) {
				$product_id = $the_product; // Product ID to auto-add
				$variation_id = 0; // Set to 0 if no variation
			} else {
				$get_membership = $active_memberships[0]->plan->slug;
			}

			// If user is already member
			if ($get_membership == 'bokasin-abonnement') {
				return;
			} else {
				$product_id = $the_product; // Product ID to auto-add
				$variation_id = 0; // Set to 0 if no variation
			}

			if ( empty( $product_id ) ) {
				return;
			}
			// Get WC Cart
			$cart = WC()->cart;

			// Get WC Cart items
			$cart_items = $cart->get_cart();
			// Check if product is already in cart
			if ( 0 < count( $cart_items ) ) {
				foreach ( $cart_items as $cart_item_key => $values ) {
					$_product = $values['data'];
					// Product is already in cart, bail
					if ( $_product->id == $product_id ) {
						return;
					}
				}
			}
			// Add product to cart
			$cart->add_to_cart( $product_id, 1, $variation_id );
			// Calculate totals
			$cart->calculate_totals();

			// Save cart to session
			$cart->set_session();

			// Maybe set cart cookies
			$cart->maybe_set_cart_cookies();

		} else {

			// REMOVE BOKASINABONNEMENT IF NOT ON THOSE PAGES
			// Get WC Cart
			$cart = WC()->cart;

			// Get WC Cart items
			$cart_items = $cart->get_cart();

			// Check if product is already in cart
			if ( 0 < count( $cart_items ) ) {
				foreach ( $cart_items as $cart_item_key => $values ) {
					$_product = $values['data'];
					// Product is already in cart, bail
					if ( $_product->id == 9021 || $_product->id == 19152) {

						// Get it's unique ID within the Cart
						$prod_unique_id = WC()->cart->generate_cart_id( $the_product );
						// Remove it from the cart by un-setting it
						unset( WC()->cart->cart_contents[$prod_unique_id] );

						// Calculate totals
						$cart->calculate_totals();

						// Save cart to session
						$cart->set_session();

						// Maybe set cart cookies
						$cart->maybe_set_cart_cookies();

					}
				}
			}
		}

	}
}

/*********************************
APPENDING READ ISSUE ONLINE BUTTON
TO SINGLE PRODUCTS
*********************************/
add_action('woocommerce_single_product_summary', 'sp_read_online_button', 25);
function sp_read_online_button() {
	global $post;
	$online_pub = get_field('link_with_online_publication', $post->ID);
	$release_date = get_field('online_publication_release_date', $post->ID);
	$icon = get_template_directory_uri() . '/library/images/eye.svg';
	$btn = '';
	$register_link = get_site_url() . __('/register', 'screenpartner');

	// Only display if these conditions are met:
	// user is logged in
	// publication exists
	$publication_link = get_permalink($online_pub->ID);

	if ($online_pub) {
		if (is_user_logged_in()) {
			$btn = '<a class="btn-green read-online" href="' . $publication_link . '" title="Read online">' . __('Read Online', 'screenpartner') . '</a>';
		} else {
			$btn = '<a class="btn-green read-online" href="' . $register_link . '" title="Read online">' . __('Join to save', 'screenpartner') . '</a>';
		}
	}

	if ($release_date && (!$online_pub)) {
		$dateformatstring = "M";
		$unixtimestamp = strtotime($release_date);
		$month = date_i18n($dateformatstring, $unixtimestamp);

		$btn = '<button disabled class="btn-green btn-disabled">' . sprintf( __('Read online in %s', 'screenpartner'), $month) . '</button>';
	}

	echo $btn;
}

/************************************
BUY RELATED BOKASIN FUNCTION
This should only be used
on single publications
************************************/

function sp_get_equivalent_product() {
	global $post;
	$slug = $post->post_title;
	$product_obj = get_page_by_title($slug, OBJECT, 'product');

	if ( !$product_obj ) {
		return;
	}

	$id = $product_obj->ID;
	echo '<a class="btn-green buy-equivalent" href="' . get_permalink($id) . '" title="' . __('Buy Paper Edition', 'screenpartner') . '">' . __('Buy Paper Edition', 'screenpartner') . '</a>';
}


/************************************
DISPLAY RELATED ARTICLES
************************************/

// Related Articles
add_action('woocommerce_after_single_product_summary', 'sp_display_related_articles', 30);
function sp_display_related_articles() {
	$related_articles_args = array(
		'post_type'	=> 'post',
		'posts_per_page' => -1,
		'meta_query' => array(
			array(
				'key' => 'related_product',
				'value' => get_the_ID(),
				'compare' => 'LIKE'
			)
		)
	);

	$count = 0;
	$query = new WP_Query( $related_articles_args );

	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();

			if ($count == 6) {
				$count = 0;
			}
			$count++;

			$post_id = get_the_ID();

			$post_list .= '<div class="news-article article-' . $count . ' m-all mt-1of2 t-1of3 d-1of4 with-padding cf">';
			$post_list .= '<div class="news-content-wrapper">';
			$post_list .= '<a href="' . get_permalink($post->ID) . '" title="' . $post->post_title . '">';
			if (get_featured_image_url($post->ID)) {
				$post_list .= '<div class="thumb" style="background-image: url(' . get_featured_image_url($post->ID, 'sp-thumb-large') . ');"></div>';
			} else {
				$post_list .= '<div class="thumb" style="background-image: url(' . get_template_directory_uri() . '/library/images/fi.png);"></div>';
			}
			$post_list .= '<div class="news-content">';
			$post_list .= '<h4 class="news-title">' . get_the_title($post->ID) . '</h4>';
			$post_list .= list_post_categories($post_id);
			$post_list .= '</div>';
			$post_list .= '</a>';
			$post_list .= '</div>';

			$post_list .= '</div>';

		}

		$takeapeak = __('Articles from this Bokasin', 'screenpartner');
		echo sprintf('
			<div class="related-news cf">
				<h2>' . $takeapeak . '</h2>
				<div class="related-news-articles grid-skin">%s</div>
			</div> <!-- .relaterte-innlegg -->
		', $post_list );
	}
	wp_reset_postdata();
}

/************************************
DISPLAY BANNER ON PRODUCTS ARCHIVE
WHEN NOT LOGGED IN
************************************/

add_action('woocommerce_before_main_content','sp_display_banner_to_logged_out_user', 13);
function sp_display_banner_to_logged_out_user() {
	if (is_shop() && !is_user_logged_in()) {
		include(TEMPLATEPATH . '/library/modules/elements/banner.php');
	}
}


/************************************
REPLACING SHOP ADD TO CART BUTTON
WITH BUTTON THAT REDIRECTS TO PRODUCT
************************************/
function replace_add_to_cart() {
	global $product;

	if (! $product->is_purchasable()) {
		return;
	}

	echo '<span class="btn-orange buy-product-link">' . __('Buy Paper Edition', 'screenpartner') . '</span>';
}

remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
add_action('woocommerce_after_shop_loop_item_title', 'replace_add_to_cart', 15);


/************************************
FAKE USER WITH SUBSCRIPTION
************************************/
function sp_get_user_or_fake_user() {
	$user_id_placeholder = get_current_user_id();
	if ($user_id) {
		$user_id = $user_id_placeholder;
	} else {
		$user_id = 9;
	}

	return $user_id;
}


/************************************
NEW FORMAT ON
WOOCOMMERCE PRODUCT PRIZE
Adding to woocommerce archive loop &
Adding to woocommerce single product
************************************/
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
add_action('woocommerce_after_shop_loop_item_title', 'sp_change_price_format', 10);
add_action('woocommerce_single_product_summary', 'sp_change_price_format', 10);

function sp_change_price_format() {
	global $woocommerce, $product;
	$price_html = '';

	// DO SOMETHING HERE
	$user_id = sp_get_user_or_fake_user();
	$memberships_args = array(
		'status' => array( 'active' ),
	);
	$active_membership = wc_memberships_get_user_active_memberships( $user_id, $memberships_args );
	$member_discount = wc_memberships_get_member_product_discount($active_membership[0], $product);

	// DO SOMETHING HERE
	if( $product->is_type( 'simple' ) ) {
		$faux_sale_percent = 40;

		$original_price = $product->get_regular_price();
		$sale_price = $product->get_sale_price();

		if (is_user_logged_in()) {
			$original_price = $original_price;
			$sale_price = $sale_price;
		}

		if (empty($sale_price)) {
			// Cut price by $faux_sale_percent
			$sale_price = $original_price - (($original_price / 100) * $faux_sale_percent);
		}

		$original_price = round($original_price);
		$sale_price = round($sale_price);

		// New price markup
		if ($original_price > 0) {
			$price_html .= '<span class="price">';

			$price_html .= '<span class="woocommerce-Price-amount regular-price">';
			if (is_user_logged_in() && (!empty(wc_memberships_product_has_member_discount($product->get_id())))) {
				$price_html .= '<del>';
			}
			//$price_html .= __('Ord. price:', 'screenpartner');
			$price_html .= '<span class="the-price">';
			$price_html .= '<span class="woocommerce-Price-currencySymbol">' . get_woocommerce_currency_symbol() . '</span>';
			$price_html .= ' ' . $original_price . ',-';
			$price_html .= '</span>';
			if (is_user_logged_in() && (!empty(wc_memberships_product_has_member_discount($product->get_id())))) {
				$price_html .= '</del>';
			}
			$price_html .= '</span>';

			if (!empty(wc_memberships_product_has_member_discount($product->get_id()))) {
				$price_html .= '<span class="woocommerce-Price-amount amount">';
				$price_html .= __('Member price:', 'screenpartner');
				$price_html .= '<span class="the-price">';
				$price_html .= '<span class="woocommerce-Price-currencySymbol">' . get_woocommerce_currency_symbol() . '</span>';
				$price_html .= ' ' . $sale_price . ',-';
				$price_html .= '</span>';
				$price_html .= '</span>';
			}

			$price_html .= '</span>';
		}

		echo $price_html;
	} else {
		echo $product->get_price_html();
	}
}



/************************************
ADDING NEW PAGE / ENDPOINT ON THE
MY ACCOUNT PAGE
Adding my favorites / Read later page
************************************/



/************************************
AUTO COMPLETE VIRTUAL ORDERS
************************************/

function custom_woocommerce_auto_complete_virtual_orders( $order_id ) {
	// if there is no order id, exit
	if ( ! $order_id ) {
		return;
	}

	// get the order and its exit
	$order = wc_get_order( $order_id );
	$items = $order->get_items();

	// if there are no items, exit
	if ( 0 >= count( $items ) ) {
		return;
	}

	// go through each item
	foreach ( $items as $item ) {
		// if it is a variation
		if ( '0' != $item['variation_id'] ) {
			// make a product based upon variation
			$product = new WC_Product( $item['variation_id'] );
		} else {
			// else make a product off of the product id
			$product = new WC_Product( $item['product_id'] );
		}
		// if the product isn't virtual, exit
		if ( ! $product->is_virtual() ) {
			return;
		}
	}

	/*
	 * If we made it this far, then all of our items are virual
	 * We set the order to completed.
	 */
	$order->update_status( 'completed' );
}

add_action( 'woocommerce_thankyou', 'custom_woocommerce_auto_complete_virtual_orders' );


/************************************
ADDING THUMBNAIL TO PACKING LIST
************************************/

/**
 * Filter the document table headers to add a product thumbnail header
 *
 * @param array $table_headers Table column headers
 * @return array The updated table column headers
 */
function sv_wc_pip_document_table_headers_product_thumbnail( $table_headers ) {
	$thumbnail_header = array( 'product_thumbnail' => 'Thumbnail' );
	// add product thumnail column as the first column
	return array_merge( $thumbnail_header, $table_headers );
}
add_filter( 'wc_pip_document_table_headers', 'sv_wc_pip_document_table_headers_product_thumbnail' );

/**
 * Filter the document table row cells to add product thumbnail column data
 *
 * @param string $table_row_cells The table row cells.
 * @param string $type WC_PIP_Document type
 * @param string $item_id Item id
 * @param array $item Item data
 * @param \WC_Product $product Product object
 * @return array The filtered table row cells.
 */
function sv_wc_pip_document_table_row_cells_product_thumbnail( $table_row_cells, $document_type, $item_id, $item, $product ) {
	// get the product's or variation's thumbnail 'shop_thumbnail' size; we will use CSS to set the width
	$thumbnail_content = array( 'product_thumbnail' => $product->get_image() );
	// add product thumnail column as the first column
	return array_merge( $thumbnail_content, $table_row_cells );
}
add_filter( 'wc_pip_document_table_row_cells', 'sv_wc_pip_document_table_row_cells_product_thumbnail', 10, 5 );
/**
 * Add custom CSS to set the thumbnail's width
 */
function sv_wc_pip_styles_product_thumbnail() {
	echo 'td.product_thumbnail img {
		width: 75px;
		height: auto;
	}';
}
add_action( 'wc_pip_styles', 'sv_wc_pip_styles_product_thumbnail' );


// Set Product Type Class
add_filter( 'body_class', 'sp_set_product_type_class' );
function sp_set_product_type_class( $classes ) {
	if ( is_product() && get_field('landing_page_template') ) {
		$classes[] = 'sp-product-type-' . get_field('landing_page_template');
	}

	return $classes;
}


function sp_add_opc_to_landing_page() {
	if ( get_field( 'landing_page_template' ) == 'landing_page' ) {
		global $product;
		echo do_shortcode('[woocommerce_one_page_checkout]');
	}
}
add_action('woocommerce_after_single_product_summary', 'sp_add_opc_to_landing_page', 8);

function sp_add_logo_to_landing_page() {
	if ( get_field('landing_page_template') == 'landing_page' && get_field( 'landing_page_logo' ) ) {
		$logo = get_field('landing_page_logo');
		echo '<img class="sp-landing-page-logo" src="' . $logo['url'] . '" alt="' . $logo['alt'] . '" />';
	}
}
add_action('woocommerce_before_single_product', 'sp_add_logo_to_landing_page', 3);

add_action('template_redirect', 'sp_add_product_to_cart_on_product_id_load');
function sp_add_product_to_cart_on_product_id_load() {
	if ( ! is_admin() ) {
		global $post;

		if ( get_field( 'landing_page_template', $post->ID ) == 'landing_page' ) {
			$product_id = $post->ID; //replace with your own product id
			$found = false;
			//check if product already in cart
			if ( sizeof( WC()->cart->get_cart() ) > 0 ) {
				foreach ( WC()->cart->get_cart() as $cart_item_key => $values ) {
					$_product = $values['data'];
					if ( $_product->get_id() == $product_id )
						$found = true;
				}
				// if product not found, add it
				if ( ! $found )
					WC()->cart->add_to_cart( $product_id );
			} else {
				// if no products in cart, add it
				WC()->cart->add_to_cart( $product_id );
			}
		}
	}
}
