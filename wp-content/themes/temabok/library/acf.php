<?php
/*
This file handles the ACF functionality
*/

/*********************
ACF OPTIONS PAGE
*********************/
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'SP Theme Options',
		'menu_title'	=> 'Theme Options',
		'menu_slug' 	=> 'sp-theme-options',
		'capability'	=> 'manage_options',
		'redirect'		=> false
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Single Post Settings',
		'menu_title'	=> 'Single Post Settings',
		'parent_slug'	=> 'sp-theme-options',
		'capability'	=> 'manage_options'
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Log in Page',
		'menu_title'	=> 'Log in Page',
		'parent_slug'	=> 'sp-theme-options',
		'capability'	=> 'manage_options'
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Article Archives',
		'menu_title'	=> 'Article Archives',
		'parent_slug'	=> 'sp-theme-options',
		'capability'	=> 'manage_options'
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Skolerom Dashboard',
		'menu_title'	=> 'Skolerom Dashboard',
		'parent_slug'	=> 'sp-theme-options',
		'capability'	=> 'manage_options'
	));
}

// INIT BLOCKS
add_action('acf/init', 'sp_acf_init');
function sp_acf_init() {

	if( function_exists('acf_register_block') ) {

		// TITTELSEKSJON
		acf_register_block(array(
			'name'				=> 'spoken',
			'title'				=> __('Spoken', 'screenpartner'),
			'description'		=> __('Embed a spoken article widget.', 'screenpartner'),
			'render_callback'	=> 'sp_acf_block_render_callback',
			'category'			=> 'widgets',
			'icon'				=> 'playlist-audio',
			'keywords'			=> array( 'sound', 'spoken', 'lyd', 'lydartikkel', 'article', 'post', 'screenpartner' ),
		));

		// TITTELSEKSJON
		acf_register_block(array(
			'name'				=> 'cover',
			'title'				=> __('Cover', 'screenpartner'),
			'description'		=> __('Create a cover section.', 'screenpartner'),
			'render_callback'	=> 'sp_acf_block_render_callback',
			'category'			=> 'widgets',
			'icon'				=> 'welcome-view-site',
			'keywords'			=> array( 'image', 'dekke', 'bilde', 'cover', 'banner', 'screenpartner' ),
		));
	}
}

// RENDER
function sp_acf_block_render_callback( $block ) {

	// convert name ("acf/spoken") into path friendly slug ("spoken")
	$slug = str_replace('acf/', '', $block['name']);

	// include a template part from within the "/template-parts/blocks" folder
	if( file_exists(STYLESHEETPATH . "/template-parts/blocks/content-{$slug}.php") ) {
		include( STYLESHEETPATH . "/template-parts/blocks/content-{$slug}.php" );
	}
}


// ADDING ACF FIELDS TO REST API
function create_ACF_meta_in_REST() {
  $postypes_to_exclude = ['banners','submission'];
  $extra_postypes_to_include = ['publication', 'post'];
  $post_types = array_diff(get_post_types(["_builtin" => false], 'names'), $postypes_to_exclude);

  array_push($post_types, $extra_postypes_to_include);

  foreach ($post_types as $post_type) {
		register_rest_field( $post_type, 'ACF', [
			  'get_callback'    => 'expose_ACF_fields',
			  'schema'          => null,
			]
		);
  }
}

function expose_ACF_fields( $object ) {
  $ID = $object['id'];
  return get_fields($ID);
}

add_action( 'rest_api_init', 'create_ACF_meta_in_REST' );


add_filter('acf/fields/post_object/query/key=field_5ed794eef7e1d', 'sp_acf_only_display_main_articles', 10, 3);
add_filter('acf/fields/post_object/query/key=field_5ed794eef7e20', 'sp_acf_only_display_main_articles', 10, 3);
function sp_acf_only_display_main_articles( $args, $field, $post_id ) {
	$args['meta_key'] = 'main_article';
	$args['meta_value'] = '1';

	return $args;
}

add_filter('acf/fields/post_object/result', 'my_acf_fields_post_object_result', 10, 4);
function my_acf_fields_post_object_result( $text, $post, $field, $post_id ) {
	if (get_post_type($post) == 'education') {
		$terms = get_the_terms( $post, 'student_level' );
		if (!empty($terms)) {
			$output = join(', ', wp_list_pluck($terms, 'name'));

			$text .= ' (' . $output . ')';
		}
	}

  return $text;
}


/* Inspect ACF field in admin to get correct key name */
add_filter('acf/load_field/key=field_5f8ec5bf5a025', 'sp_load_field_assets');
function sp_load_field_assets( $field ) {
  wp_enqueue_script('education-archive-js');
  return $field;
}

?>
