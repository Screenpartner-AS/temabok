<?php
/* Bones Custom Post Types
*/

// Flush rewrite rules for custom post types
add_action( 'after_switch_theme', 'bones_flush_rewrite_rules' );

// Flush your rewrite rules
function bones_flush_rewrite_rules() {
	flush_rewrite_rules();
}

if ( ! function_exists('banners') ) {
	function banners() {

		$labels = array(
			'name'                  => _x( 'Banners', 'Post Type General Name', 'screenpartner' ),
			'singular_name'         => _x( 'Banner', 'Post Type Singular Name', 'screenpartner' ),
			'menu_name'             => __( 'Banners', 'screenpartner' ),
			'name_admin_bar'        => __( 'Banner', 'screenpartner' ),
			'archives'              => __( 'Banner Archive', 'screenpartner' ),
			'attributes'            => __( 'Banner Attributtes', 'screenpartner' ),
			'parent_item_colon'     => __( 'Parent Banner', 'screenpartner' ),
			'all_items'             => __( 'All Banners', 'screenpartner' ),
			'add_new_item'          => __( 'Add Banner', 'screenpartner' ),
			'add_new'               => __( 'Add New', 'screenpartner' ),
			'new_item'              => __( 'New Banner', 'screenpartner' ),
			'edit_item'             => __( 'Edit banner', 'screenpartner' ),
			'update_item'           => __( 'Update banner', 'screenpartner' ),
			'view_item'             => __( 'View banner', 'screenpartner' ),
			'view_items'            => __( 'View Banners', 'screenpartner' ),
			'search_items'          => __( 'Search banner', 'screenpartner' ),
			'not_found'             => __( 'Not found', 'screenpartner' ),
			'not_found_in_trash'    => __( 'Not found in trash', 'screenpartner' ),
			'featured_image'        => __( 'Banner Image', 'screenpartner' ),
			'set_featured_image'    => __( 'Choose Banner Image', 'screenpartner' ),
			'remove_featured_image' => __( 'Remove Banner Image', 'screenpartner' ),
			'use_featured_image'    => __( 'Use as Banner Image', 'screenpartner' ),
			'insert_into_item'      => __( 'Insert into banner', 'screenpartner' ),
			'uploaded_to_this_item' => __( 'Uploaded to this banner', 'screenpartner' ),
			'items_list'            => __( 'Banner list', 'screenpartner' ),
			'items_list_navigation' => __( 'Banner list navigation', 'screenpartner' ),
			'filter_items_list'     => __( 'Filter Banner list navigation', 'screenpartner' ),
		);
		$args = array(
			'label'                 => __( 'Banner', 'screenpartner' ),
			'description'           => __( 'Banners are created and edited here.', 'screenpartner' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'revisions', ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 25,
			'menu_icon'             => 'dashicons-images-alt2',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => true,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
		);
		register_post_type( 'banners', $args );

	}
	add_action( 'init', 'banners', 0 );
}


// Register Custom Post Type Publication
// Post Type Key: publication
if ( ! function_exists('publication') ) {
	function publication() {
		$labels = array(
			'name' => __( 'Publications', 'Post Type General Name', 'screenpartner' ),
			'singular_name' => __( 'Publication', 'Post Type Singular Name', 'screenpartner' ),
			'menu_name' => __( 'Publications', 'screenpartner' ),
			'name_admin_bar' => __( 'Publication', 'screenpartner' ),
			'archives' => __( 'Publication Archives', 'screenpartner' ),
			'attributes' => __( 'Publication Attributes', 'screenpartner' ),
			'parent_item_colon' => __( 'Parent Publication:', 'screenpartner' ),
			'all_items' => __( 'All Publications', 'screenpartner' ),
			'add_new_item' => __( 'Add New Publication', 'screenpartner' ),
			'add_new' => __( 'Add New', 'screenpartner' ),
			'new_item' => __( 'New Publication', 'screenpartner' ),
			'edit_item' => __( 'Edit Publication', 'screenpartner' ),
			'update_item' => __( 'Update Publication', 'screenpartner' ),
			'view_item' => __( 'View Publication', 'screenpartner' ),
			'view_items' => __( 'View Publications', 'screenpartner' ),
			'search_items' => __( 'Search Publication', 'screenpartner' ),
			'not_found' => __( 'Not found', 'screenpartner' ),
			'not_found_in_trash' => __( 'Not found in Trash', 'screenpartner' ),
			'featured_image' => __( 'Featured Image', 'screenpartner' ),
			'set_featured_image' => __( 'Set featured image', 'screenpartner' ),
			'remove_featured_image' => __( 'Remove featured image', 'screenpartner' ),
			'use_featured_image' => __( 'Use as featured image', 'screenpartner' ),
			'insert_into_item' => __( 'Insert into Publication', 'screenpartner' ),
			'uploaded_to_this_item' => __( 'Uploaded to this Publication', 'screenpartner' ),
			'items_list' => __( 'Publications list', 'screenpartner' ),
			'items_list_navigation' => __( 'Publications list navigation', 'screenpartner' ),
			'filter_items_list' => __( 'Filter Publications list', 'screenpartner' ),
		);
		$args = array(
			'label' => __( 'Publication', 'screenpartner' ),
			'description' => __( 'Issuu publications are added here.', 'screenpartner' ),
			'labels' => $labels,
			'menu_icon' => 'dashicons-media-document',
			'supports' => array('title', 'thumbnail', 'revisions', ),
			'taxonomies' => array(),
			'public' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'menu_position' => 20,
			'show_in_admin_bar' => true,
			'show_in_nav_menus' => true,
			'can_export' => true,
			'has_archive' => true,
			'hierarchical' => false,
			'exclude_from_search' => false,
			'show_in_rest' => true,
			'publicly_queryable' => true,
			'capability_type' => 'post',
		);
		register_post_type( 'publication', $args );

	}
	add_action( 'init', 'publication', 0 );
}


if ( ! function_exists( 'publication_category' ) ) {
	function publication_category() {

		$labels = array(
			'name'                       => _x( 'Publication Categories', 'Taxonomy General Name', 'screenpartner' ),
			'singular_name'              => _x( 'Publication Category', 'Taxonomy Singular Name', 'screenpartner' ),
			'menu_name'                  => __( 'Publication Categories', 'screenpartner' ),
			'all_items'                  => __( 'All Publication Categories', 'screenpartner' ),
			'parent_item'                => __( 'Parent Publication Category', 'screenpartner' ),
			'parent_item_colon'          => __( 'Parent Publication Category:', 'screenpartner' ),
			'new_item_name'              => __( 'New Publication Category Name', 'screenpartner' ),
			'add_new_item'               => __( 'Add New Publication Category', 'screenpartner' ),
			'edit_item'                  => __( 'Edit Publication Category', 'screenpartner' ),
			'update_item'                => __( 'Update Publication Category', 'screenpartner' ),
			'view_item'                  => __( 'View Publication Category', 'screenpartner' ),
			'separate_items_with_commas' => __( 'Separate publication categories with commas', 'screenpartner' ),
			'add_or_remove_items'        => __( 'Add or remove publication categories', 'screenpartner' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'screenpartner' ),
			'popular_items'              => __( 'Popular Publication Categories', 'screenpartner' ),
			'search_items'               => __( 'Search Publication Category', 'screenpartner' ),
			'not_found'                  => __( 'Not Found', 'screenpartner' ),
			'no_terms'                   => __( 'No publication categories', 'screenpartner' ),
			'items_list'                 => __( 'Publication Category list', 'screenpartner' ),
			'items_list_navigation'      => __( 'Publication category list navigation', 'screenpartner' ),
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_in_rest' 							 => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
		);
		register_taxonomy( 'publication_category', array( 'publication' ), $args );

	}
	add_action( 'init', 'publication_category', 0 );
}

// Register Taxonomy Content Type
if ( ! function_exists( 'create_contenttype_tax' ) ) {
	function create_contenttype_tax() {

		$labels = array(
			'name'              => _x( 'Content Types', 'taxonomy general name', 'screenpartner' ),
			'singular_name'     => _x( 'Content Type', 'taxonomy singular name', 'screenpartner' ),
			'search_items'      => __( 'Search Content Types', 'screenpartner' ),
			'all_items'         => __( 'All Content Types', 'screenpartner' ),
			'parent_item'       => __( 'Parent Content Type', 'screenpartner' ),
			'parent_item_colon' => __( 'Parent Content Type:', 'screenpartner' ),
			'edit_item'         => __( 'Edit Content Type', 'screenpartner' ),
			'update_item'       => __( 'Update Content Type', 'screenpartner' ),
			'add_new_item'      => __( 'Add New Content Type', 'screenpartner' ),
			'new_item_name'     => __( 'New Content Type Name', 'screenpartner' ),
			'menu_name'         => __( 'Content Type', 'screenpartner' ),
		);
		$args = array(
			'labels' => $labels,
			'description' => __( 'Post Content Types are specified here.', 'screenpartner' ),
			'hierarchical' => true,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'show_in_nav_menus' => true,
			'show_tagcloud' => true,
			'show_in_quick_edit' => true,
			'show_admin_column' => true,
			'show_in_rest' => true,
			'rewrite' => false,
		);
		register_taxonomy( 'contenttype', array('post'), $args );

	}
	add_action( 'init', 'create_contenttype_tax' );
}

if ( ! function_exists('create_spoken_articles_cpt') ) {
	// Register Custom Post Type Podcast
	// Post Type Key: podcast
	function create_spoken_articles_cpt() {

		$labels = array(
			'name' => __( 'Spoken Articles', 'Post Type General Name', 'screenpartner' ),
			'singular_name' => __( 'Spoken Article', 'Post Type Singular Name', 'screenpartner' ),
			'menu_name' => __( 'Spoken Articles', 'screenpartner' ),
			'name_admin_bar' => __( 'Spoken Articles', 'screenpartner' ),
			'archives' => __( 'Spoken Articles archive', 'screenpartner' ),
			'attributes' => __( 'Spoken Article attributes', 'screenpartner' ),
			'parent_item_colon' => __( 'Spoken Article parent:', 'screenpartner' ),
			'all_items' => __( 'All Spoken Articles', 'screenpartner' ),
			'add_new_item' => __( 'Add New Spoken Article', 'screenpartner' ),
			'add_new' => __( 'Add New', 'screenpartner' ),
			'new_item' => __( 'New Spoken Article', 'screenpartner' ),
			'edit_item' => __( 'Edit Spoken Article', 'screenpartner' ),
			'update_item' => __( 'Update Spoken Article', 'screenpartner' ),
			'view_item' => __( 'View Spoken Article', 'screenpartner' ),
			'view_items' => __( 'View Spoken Articles', 'screenpartner' ),
			'search_items' => __( 'Search Spoken Articles', 'screenpartner' ),
			'not_found' => __( 'No Spoken Articles found', 'screenpartner' ),
			'not_found_in_trash' => __( 'No Spoken Articles found in trash', 'screenpartner' ),
			'featured_image' => __( 'Featured Image', 'screenpartner' ),
			'set_featured_image' => __( 'Choose Featured Image', 'screenpartner' ),
			'remove_featured_image' => __( 'Remove featured image', 'screenpartner' ),
			'use_featured_image' => __( 'Use as featured image', 'screenpartner' ),
			'insert_into_item' => __( 'Insert in Spoken Article', 'screenpartner' ),
			'uploaded_to_this_item' => __( 'Uploaded to this spoken article', 'screenpartner' ),
			'items_list' => __( 'Spoken articles list', 'screenpartner' ),
			'items_list_navigation' => __( 'Navigate spoken articles as list', 'screenpartner' ),
			'filter_items_list' => __( 'Filter Spoken Articles list', 'screenpartner' ),
		);
		$rewrite = array(
			'slug'                  => get_option( 'sp_spoken_base' ),
			'with_front'            => false,
		);
		$args = array(
			'label' => __( 'Spoken Article', 'screenpartner' ),
			'description' => __( 'Bokasins spoken articles', 'screenpartner' ),
			'labels' => $labels,
			'menu_icon' => 'dashicons-format-audio',
			'supports' => array('title', 'editor', 'thumbnail', 'revisions', ),
			'taxonomies' => array('spoken_category'),
			'public' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'menu_position' => 25,
			'show_in_admin_bar' => true,
			'show_in_nav_menus' => true,
			'can_export' => true,
			'has_archive' => true,
			'hierarchical' => false,
			'exclude_from_search' => false,
			'show_in_rest' => true,
			'publicly_queryable' => true,
			'capability_type' => 'post',
			'rewrite' => $rewrite
		);
		register_post_type( 'spoken', $args );

	}
	add_action( 'init', 'create_spoken_articles_cpt', 0 );
}


if ( ! function_exists( 'spoken_category' ) ) {
	function spoken_category() {

		$labels = array(
			'name'                       => _x( 'Spoken Article Categories', 'Taxonomy General Name', 'screenpartner' ),
			'singular_name'              => _x( 'Spoken Article Category', 'Taxonomy Singular Name', 'screenpartner' ),
			'menu_name'                  => __( 'Spoken Article Categories', 'screenpartner' ),
			'all_items'                  => __( 'All Spoken Article Categories', 'screenpartner' ),
			'parent_item'                => __( 'Parent Spoken Article Category', 'screenpartner' ),
			'parent_item_colon'          => __( 'Parent Spoken Article Category:', 'screenpartner' ),
			'new_item_name'              => __( 'New Spoken Article Category Name', 'screenpartner' ),
			'add_new_item'               => __( 'Add New Spoken Article Category', 'screenpartner' ),
			'edit_item'                  => __( 'Edit Spoken Article Category', 'screenpartner' ),
			'update_item'                => __( 'Update Spoken Article Category', 'screenpartner' ),
			'view_item'                  => __( 'View Spoken Article Category', 'screenpartner' ),
			'separate_items_with_commas' => __( 'Separate Spoken Article categories with commas', 'screenpartner' ),
			'add_or_remove_items'        => __( 'Add or remove Spoken Article categories', 'screenpartner' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'screenpartner' ),
			'popular_items'              => __( 'Popular Spoken Article Categories', 'screenpartner' ),
			'search_items'               => __( 'Search Spoken Article Category', 'screenpartner' ),
			'not_found'                  => __( 'Not Found', 'screenpartner' ),
			'no_terms'                   => __( 'No publication categories', 'screenpartner' ),
			'items_list'                 => __( 'Spoken Article Category list', 'screenpartner' ),
			'items_list_navigation'      => __( 'Spoken Article category list navigation', 'screenpartner' ),
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
			'show_in_rest' 							 => true,
		);
		register_taxonomy( 'spoken_category', array( 'spoken' ), $args );

	}
	add_action( 'init', 'spoken_category', 0 );
}

?>
