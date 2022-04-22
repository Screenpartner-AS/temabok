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

//
//send order-txt to warehouse sftp after add new order in woocommerce
//
add_action( 'woocommerce_checkout_update_order_meta', 'new_order_bokasin', 1, 1 );
function new_order_bokasin( $order_id ) {
	if ( ! $order_id ) return;

	// Get ssh info from site settings
	$warehouse_ssh_server = get_field('warehouse_ssh_server', 'option');
	$warehouse_ssh_user = get_field('warehouse_ssh_user', 'option');
	$warehouse_ssh_password = get_field('warehouse_ssh_password', 'option');

	// Don't run function if these are not specified
	if (!$warehouse_ssh_server || !$warehouse_ssh_user || !$warehouse_ssh_password) {
		return;
	}

	// Getting an instance of WC_Order object
	$order = wc_get_order( $order_id );

	// Create custom order file
	// Open/Create file
	$upload_dir = get_template_directory();
	$orderFile = fopen($upload_dir . '/order_data.txt', "w") or die("Unable to open file!");

	// Header fields
	// Get order data
	$data = $order->get_data();

	// get total weight
	$order_items  = $order->get_items();
	$total_qty    = 0;
	$total_weight = 0;
	foreach ( $order_items as $item_id => $product_item ) {
		$product         =  $product_item->get_product();
		$product_weight  = $product->get_weight();
		$quantity        = $product_item->get_quantity();
		$total_qty      += $quantity;
		$total_weight   += floatval( $product_weight * $quantity );
	}

	// Add values to header variables
	$FN1_RecType_FN1_OrderNo = 'FN1'.$data['id'];
	$FN1_DelCustNo = $data['customer_id'];
	$FN1_DelName = $data['shipping']['first_name'] . ' ' . $data['shipping']['last_name'];
	$FN1_DelAdd1 = $data['shipping']['address_1'];
	$FN1_DelAdd2 = $data['shipping']['address_2'];
	$FN1_DelZipCode = $data['shipping']['postcode'];
	$FN1_DelPostalOffice = $data['shipping']['city'];
	$FN1_DelCountryCode = $data['shipping']['state'];
	$FN1_DelCountry = $data['shipping']['country'];
	$FN1_DelExtRef = $data['customer_id'];
	$FN1_DelCustEmail = $data['billing']['email'];
	$FN1_DelCustMobil = $data['billing']['phone'];
	$FN1_TotalWeight = '';
	$FN1_ShopID = '8999907';
	$FN1_DeliveryMode = $order_data_a; //find shipping method
	$FN1_ClubID = 'NORA';
	$FN1_CustType = "0";
	$blank = "\n"; //new string

	// Header fields and custom spaces
	$orderHeaderLine =
		$FN1_RecType_FN1_OrderNo.str_repeat(' ', 23 - mb_strlen($FN1_RecType_FN1_OrderNo)).
		$FN1_DelCustNo.str_repeat(' ', 20 - mb_strlen($FN1_DelCustNo)).
		$FN1_DelName.str_repeat(' ', 50 - mb_strlen($FN1_DelName)).
		$FN1_DelAdd1.str_repeat(' ', 50 - mb_strlen($FN1_DelAdd1)).
		$FN1_DelAdd2.str_repeat(' ', 50 - mb_strlen($FN1_DelAdd2)).
		$FN1_DelZipCode.str_repeat(' ', 10 - mb_strlen($FN1_DelZipCode)).
		$FN1_DelPostalOffice.str_repeat(' ', 50 - mb_strlen($FN1_DelPostalOffice)).
		$FN1_DelCountry.
		$FN1_DelCountryCode.str_repeat(' ', 25 - mb_strlen($FN1_DelCountryCode)).
		$FN1_DelExtRef.str_repeat(' ', 50 - mb_strlen($FN1_DelExtRef)).
		$FN1_DelCustEmail.str_repeat(' ', 100 - mb_strlen($FN1_DelCustEmail)).
		$FN1_DelCustMobil.str_repeat(' ', 12 - mb_strlen($FN1_DelCustMobil)).
		$FN1_TotalWeight.str_repeat(' ', 12 - mb_strlen($FN1_TotalWeight)).
		$FN1_ShopID.str_repeat(' ', 20 - mb_strlen($FN1_ShopID)).
		str_repeat(' ', 48). //FN1_PickupPoint 48 chars
		$FN1_DeliveryMode.str_repeat(' ', 12 - mb_strlen($FN1_DeliveryMode)).
		$FN1_ClubID.str_repeat(' ', 10 - mb_strlen($FN1_ClubID)).
		$FN1_CustType.str_repeat(' ', 1 - mb_strlen($FN1_ClubID)).
		$blank
	;

	// Write headers to file
	fwrite($orderFile, $orderHeaderLine);

	// Add product item lines
	foreach ($order_items as $order_item) {

		// add values to line variables
		$FN2_OrderNo = 'FN2'.$data['id'];
		$FN2_ArticleNo = $order_item['item_product_id'];
		$FN2_ItemNumber = $order_item['item_sku'];
		$FN2_ItemName = $order_item['item_name'];
		$FN2_DelNumber = $order_item['item_quantity'];
		$FN2_LineNumber = ''; //$order_item['item_id'];
		$FN2_PickableItem = '1'; //find
		$FN2_ItemOwner = '93278';
		$FN2_Price = ''; //$order_item['item_price'];
		$FN2_LineRef = ''; //$order_item['item_product_id'];
		$isbn = get_field( 'isbn', $FN2_ArticleNo );

		// Write lines to file with custom spaces
		fwrite($orderFile,  $FN2_OrderNo.str_repeat(' ', 23 - mb_strlen($FN2_OrderNo)));
		fwrite($orderFile,  $FN2_ArticleNo.str_repeat(' ', 8 - mb_strlen($FN2_ArticleNo)));
		fwrite($orderFile,  $isbn.str_repeat(' ', 21 - mb_strlen($isbn)));
		fwrite($orderFile,  $FN2_ItemName.str_repeat(' ', 80 - mb_strlen($FN2_ItemName)));
		fwrite($orderFile,  $FN2_DelNumber.str_repeat(' ', 9 - mb_strlen($FN2_DelNumber)));
		fwrite($orderFile,  $FN2_LineNumber.str_repeat(' ', 3 - mb_strlen($FN2_LineNumber)));
		fwrite($orderFile,  $FN2_PickableItem.str_repeat(' ', 1 - mb_strlen($FN2_PickableItem)));
		fwrite($orderFile,  $FN2_ItemOwner.str_repeat(' ', 6 - mb_strlen($FN2_ItemOwner)));
		fwrite($orderFile,  $FN2_Price.str_repeat(' ', 8 - mb_strlen($FN2_Price)));
		fwrite($orderFile,  $FN2_LineRef.str_repeat(' ', 8 - mb_strlen($FN2_LineRef)));
		//fwrite($orderFile,  'isbn:'.$isbn);

		fwrite($orderFile,  $blank);
	}

	// Close file
	fclose($orderFile);

	//Upload custom order file on remote sftp
	include($upload_dir . '/phpseclib/Net/SFTP.php');
	include($upload_dir . '/phpseclib/Crypt/RC4.php');
	include($upload_dir . '/phpseclib/Crypt/Rijndael.php');
	include($upload_dir . '/phpseclib/Crypt/Twofish.php');
	include($upload_dir . '/phpseclib/Crypt/Blowfish.php');
	include($upload_dir . '/phpseclib/Crypt/TripleDES.php');
	include($upload_dir . '/phpseclib/Crypt/Random.php');
	include($upload_dir . '/phpseclib/Crypt/Hash.php');
	include($upload_dir . '/phpseclib/Math/BigInteger.php');

	foreach ($order->get_items() as $order_item){
		$item = wc_get_product($order_item->get_product_id());
		if (!$item->is_virtual()) {

			$ssh = new Net_SFTP($warehouse_ssh_server);
			if (!$ssh->login($warehouse_ssh_user, $warehouse_ssh_password)) {
					exit('Login Failed');
			}

			$dateStamp = date('Y.m.d');
			$fileISO = $upload_dir . '/order_data.txt';
			$file = mb_convert_encoding($fileISO, "UTF-8");

			$ssh->put('/Inn/Ordre/'.'N8999907.Orage.'.$dateStamp.'.'.'FN2'.$data['id'].'.txt', $file, NET_SFTP_LOCAL_FILE);

		}
	}

}

//
// schedule event to update csv from warehouse to proper format
//
if ( ! wp_next_scheduled( 'createCSVfromLastFile_hook' ) ) {
	wp_schedule_event( strtotime('12:11:00'), 'hourly', 'createCSVfromLastFile_hook' );
}

add_action( 'createCSVfromLastFile_hook', 'createCSVfromLastFile' );
function createCSVfromLastFile() {

	// Get ssh info from site settings
	$warehouse_ssh_server = get_field('warehouse_ssh_server', 'option');
	$warehouse_ssh_user = get_field('warehouse_ssh_user', 'option');
	$warehouse_ssh_password = get_field('warehouse_ssh_password', 'option');
	$temabok_ssh_server = get_field('temabok_ssh_server', 'option');
	$temabok_ssh_user = get_field('temabok_ssh_user', 'option');
	$temabok_ssh_password = get_field('temabok_ssh_password', 'option');

	//add phpseclib lib
	$upload_dir = get_template_directory();

	include($upload_dir . '/phpseclib/Net/SFTP.php');
	include($upload_dir . '/phpseclib/Crypt/RC4.php');
	include($upload_dir . '/phpseclib/Crypt/Rijndael.php');
	include($upload_dir . '/phpseclib/Crypt/Twofish.php');
	include($upload_dir . '/phpseclib/Crypt/Blowfish.php');
	include($upload_dir . '/phpseclib/Crypt/TripleDES.php');
	include($upload_dir . '/phpseclib/Crypt/Random.php');
	include($upload_dir . '/phpseclib/Crypt/Hash.php');
	include($upload_dir . '/phpseclib/Math/BigInteger.php');


	//connect to sftp
	$ssh = new Net_SFTP($warehouse_ssh_server);
	if (!$ssh->login($warehouse_ssh_user, $warehouse_ssh_password)) {
		exit('Login Failed');
	}

	//get last file filename
	$files = $ssh->rawlist('/Ut/Lager/');

	// filter out folders
	$files_only_callback = function($a) { return ($a["type"] == NET_SFTP_TYPE_REGULAR); };
	$files = array_filter($files, $files_only_callback);

	// sort by timestamp
	usort($files, function($a, $b) { return $b["mtime"] - $a["mtime"]; });

	// pick the latest file
	$latest = $files[0]["filename"];

	//copy csv to readable name format
	$fileCsvIn = $ssh->get('/Ut/Lager/'. $latest );

	//add csv headers
	$headersCsv = '"shop_id";"sku";"isbn";"weight";"title";"";"date";"";"description";"currency";"price";"stock"';

	//concatinate csv and headers
	$fileISO = $headersCsv . PHP_EOL . $fileCsvIn;

	$fileCsv = utf8_encode($fileISO);

	//connect to bokasin sftp
	$ssh_bokasin = new Net_SFTP($temabok_ssh_server);
	if (!$ssh_bokasin->login($temabok_ssh_user, $temabok_ssh_password)) {
		exit('Login Failed');
	}

	//upload readable file
	$ssh_bokasin->put('/home/bokasin/public_html/wp-content/lager/Orage_Nettbutikk_Lager_Headers.csv', $fileCsv);
}

/**
 * Add a custom action to order actions select box on edit order page
 * Only added for paid orders that haven't fired this action yet
 *
 * @param array $actions order actions array to display
 * @return array - updated actions
 */
function sp_wc_add_order_meta_box_action( $actions ) {
	global $theorder;

	// bail if the order has been paid for or this action has been run
	if ( get_post_meta( $theorder->id, '_wc_order_sent_to_central', true ) ) {
		return $actions;
	}

	// add "send order" custom action
	$actions['wc_send_to_central_order_action'] = __( 'Send Order to Central', 'screenpartner' );
	return $actions;
}
add_action( 'woocommerce_order_actions', 'sp_wc_add_order_meta_box_action' );


/**
 * Add an order note when custom action is clicked
 * Add a flag on the order to show it's been run
 *
 * @param \WC_Order $order
 */
function sp_wc_process_order_meta_box_action( $order ) {

	// add the order note
	$message = sprintf( __( 'Order sent to central by %s.', 'screenpartner' ), wp_get_current_user()->display_name );
	$order->add_order_note( $message );

	new_order_bokasin( $order->id );

	// add the flag so this action won't be shown again
	update_post_meta( $order->id, '_wc_order_sent_to_central', 'yes' );
}
add_action( 'woocommerce_order_action_wc_send_to_central_order_action', 'sp_wc_process_order_meta_box_action' );



/* DON'T DELETE THIS CLOSING TAG */ ?>
