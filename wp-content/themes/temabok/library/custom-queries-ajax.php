<?php
/*
** CUSTOM QUERIES AJAX
*/

function sp_custom_queries_ajax() {
  // adding scripts file in the footer
  wp_register_script( 'custom-queries-ajax-js', get_stylesheet_directory_uri() . '/library/js/custom-queries-ajax.js', array( 'jquery' ), '', true );
  wp_enqueue_script( 'custom-queries-ajax-js' );

  // Localize Our Script so we can use 'ajaxurl'
  wp_localize_script( 'custom-queries-ajax-js', 'ajaxpagination', array(
    'ajaxurl' => admin_url( 'admin-ajax.php' )
  ));
}
add_action( 'wp_enqueue_scripts', 'sp_custom_queries_ajax', 9999 );

function more_favorites_ajax(){
  $favorites = get_user_favorites();

  $offset = $_POST["favorites_offset"];
  $ppp = $_POST["favorites_ppp"];
  header("Content-Type: text/html");

	$args = array(
    'post_type' => array('post'),
    'offset' => $offset,
    'posts_per_page' => $ppp,
		'post_status' => array('publish'),
		'order' => 'DESC',
		'orderby' => 'none',
		'ignore_sticky_posts' => true,
		'post__in' => $favorites
	);

  $loop = new WP_Query($args);
  while ($loop->have_posts()) { $loop->the_post();
    get_template_part( 'template-parts/content', 'single-archive' );
  }

  exit;
}

add_action('wp_ajax_nopriv_more_favorites_ajax', 'more_favorites_ajax');
add_action('wp_ajax_more_favorites_ajax', 'more_favorites_ajax');

function more_user_reads_ajax(){
  $user_reads = sp_get_user_reads_ids();

  $offset = $_POST["user_reads_offset"];
  $ppp = $_POST["user_reads_ppp"];
  header("Content-Type: text/html");

	$args = array(
    'post_type' => array('post'),
    'offset' => $offset,
    'posts_per_page' => $ppp,
		'post_status' => array('publish'),
		'order' => 'DESC',
		'orderby' => 'none',
		'ignore_sticky_posts' => true,
		'post__in' => $user_reads
	);

  $loop = new WP_Query($args);
  while ($loop->have_posts()) { $loop->the_post();
    get_template_part( 'template-parts/content', 'single-archive' );
  }

  exit;
}

add_action('wp_ajax_nopriv_more_user_reads_ajax', 'more_user_reads_ajax');
add_action('wp_ajax_more_user_reads_ajax', 'more_user_reads_ajax');

?>
