<?php
/*
** USER READS
*/

function article_ajax_functionality() {
  // adding scripts file in the footer
  wp_register_script( 'article-js', get_stylesheet_directory_uri() . '/library/js/article.js', array( 'jquery' ), '', true );
  wp_register_script( 'user-reads-functions-js', get_stylesheet_directory_uri() . '/library/js/user-reads-functions.js', array( 'jquery' ), '', true );

  wp_enqueue_script( 'user-reads-functions-js' );

  // Finally enqueue our script
  if (is_singular('post')) {
    wp_enqueue_script( 'article-js' );
  }

  global $post;
  // Localize Our Script so we can use 'ajaxurl'
  wp_localize_script( 'article-js', 'ajax_object', array(
    'ajaxurl' => admin_url( 'admin-ajax.php' ),
    'post_id' => $post->ID
  ));

  // Localize Our Script so we can use 'ajaxurl'
  wp_localize_script( 'user-reads-functions-js', 'ajax_object', array(
    'ajaxurl' => admin_url( 'admin-ajax.php' )
  ));
}
add_action( 'wp_enqueue_scripts', 'article_ajax_functionality', 9999 );

/*********************
UPDATE USER READS
*********************/

function sp_update_article_progress() {
  // Ensure we have the data we need to continue
  if( ! is_user_logged_in() ) {
    exit;
  }

  if ( isset($_POST) ) {
    global $post;

    $post_id = intval($_POST['post_id']);
    $user_id = get_current_user_id();

    $article_percent_progress = round(intval($_POST['read']), 2);

    $sp_user_reads_array_old = get_user_meta($user_id, 'sp_user_reads', false);
    $sp_user_reads_array_new = get_user_meta($user_id, 'sp_user_reads', false)[0];

    $sp_user_reads_array_new[$post_id] = $article_percent_progress;

    update_user_meta( $user_id, 'sp_user_reads', $sp_user_reads_array_new );

    // var_dump($sp_user_reads_array_old);
    // var_dump($sp_user_reads_array_new);
  }

  wp_die();
}
add_action( 'wp_ajax_nopriv_sp_update_article_progress', 'sp_update_article_progress' );
add_action( 'wp_ajax_sp_update_article_progress', 'sp_update_article_progress' );

/*********************
DELETE USER READS
*********************/

function sp_delete_recent_user_reads() {
  // Ensure we have the data we need to continue
  if( ! is_user_logged_in() ) {
    exit;
  }

  if ( isset($_POST) ) {
    $user_id = get_current_user_id();
    $sp_user_reads_array = get_user_meta($user_id, 'sp_user_reads', true);

    if ( ! delete_user_meta($user_id, 'sp_user_reads') ) {
      echo '<p class="message">' . __('There was an error when trying to delete your Recent Reads log.', 'screenpartner') . '</p>';
    }
  }

  wp_die();
}
add_action( 'wp_ajax_nopriv_sp_delete_recent_user_reads', 'sp_delete_recent_user_reads' );
add_action( 'wp_ajax_sp_delete_recent_user_reads', 'sp_delete_recent_user_reads' );

/*********************
USER READ FUNCTIONS
*********************/

function sp_get_user_reads_array() {
  if ( !is_user_logged_in() ) {
    return;
  }

  if (!empty(get_user_meta(get_current_user_id(), 'sp_user_reads', false)[0])) {
    return get_user_meta(get_current_user_id(), 'sp_user_reads', false)[0];
  } else {
    return array();
  }
}

function sp_get_user_reads_ids() {
  if ( !is_user_logged_in() ) {
    return;
  }

  $user_reads_array = sp_get_user_reads_array();

  if ( !empty($user_reads_array) ) {
    return array_keys($user_reads_array);
  } else {
    return array();
  }
}

// Display Delete user reads button
function sp_the_delete_user_reads_button() {
  $user_reads = sp_get_user_reads_ids();

  if (!$user_reads) {
    return;
  }

  echo '<button class="btn btn-purple delete-user-reads">' . __('Reset user reads', 'screenpartner') . '</button>';
}

/*********************
SP ARTICLE READING PROGRESS
*********************/

// This is used in archive to indicate how much of an article is read
function sp_article_reading_progress($post_id) {
  if ( !is_user_logged_in() ) {
    return;
  }

  $html = '';
  $user_reads_array = sp_get_user_reads_array();

  if (!empty($user_reads_array)) {
    if (array_key_exists($post_id, $user_reads_array)) {
      $progress = intval($user_reads_array[$post_id]);

    	$html = '<div class="article-progress"><span style="width: ' . $progress . '%;"></span></div>';
    }
  }

  return $html;
}

// This is used in header for single post
function sp_get_user_article_progress($post_id) {
  if ( !is_user_logged_in() ) {
    return;
  }

  $user_reads_array = sp_get_user_reads_array();

  if ( ! empty( $user_reads_array ) ) {
    if ( array_key_exists( $post_id, $user_reads_array ) ) {
      $progress = intval( $user_reads_array[$post_id] );

    	return $progress;
    } else {
      return;
    }
  }
}

function sp_jump_back_in($post_id) {
  if ( !is_user_logged_in() ) {
    return;
  }

  $html = '';

  $user_reads_array = sp_get_user_reads_array();

  if ( ! empty($user_reads_array) ) {
    if ( array_key_exists( $post_id, $user_reads_array ) ) {
      $progress = intval( $user_reads_array[$post_id] );

    	$html = '<aside href="#" data-progress="' . $progress . '" class="jump-back-in">';
    	$html .= '<div class="wrap cf">';
    	$html .= '<a href="#" class="scroll-to-read">Les videre</a>';
    	$html .= '<a href="#" class="close-notification"><img src="' . get_template_directory_uri() . '/library/images/close-icon.svg" alt="Close Icon" /></a>';
      $html .= '</div>';
    	$html .= '</aside>';

    } else {
      $html = '';
    }
  }

  return $html;
}

/*********************
SP RECENT USER READS GRID
*********************/

function sp_get_recent_user_reads() {
  $user_reads = sp_get_user_reads_ids();

  if (!$user_reads) {
    return;
  }

  $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

  $ppp = 8;

	$args = array(
    'post_type' => array('post'),
    'paged' => $paged,
    'posts_per_page' => $ppp,
		'post_status' => array('publish'),
    'post__in' => array_reverse($user_reads),
		'orderby' => 'post__in',
    'order' => 'DESC',
		'ignore_sticky_posts' => true
	);

	$loop = new WP_Query( $args );
	$post_count = $loop->found_posts;

	if( $loop->have_posts() ) {
		?>
		<div class="user-reads-list recent-user-reads my-account-posts">
			<div class="grid-skin articles-wrapper facet-archive facetwp-template">
				<?php
				while( $loop->have_posts() ) {
			    	$loop->the_post();
						get_template_part( 'template-parts/content', 'single-archive' );
				}
				?>
			</div>
		</div>
		<?php

    if ($loop->max_num_pages > 1) {
      echo '<div id="load-more-user-reads" class="load-more-line"><a class="btn-purple" href="#!">' . __('Load more', 'screenpartner') . '</a></div>';
    }
  }

  wp_reset_postdata();
}


/*********************
SP RELATED USER READS
*********************/

// Return a random read article's ID
function sp_get_random_user_read_id() {
  $user_reads = sp_get_user_reads_ids();

  if (!$user_reads) {
    return;
  }

  $random_key = array_rand($user_reads, 1);
  $random_article = $user_reads[$random_key];

  return $random_article;
}

// Return a new WP_Query object with articles
// related to a post ID
function sp_get_related_user_read_articles( $post_id, $related_count, $args = array() ) {
	$terms = get_the_terms( $post_id, 'category' );

	if ( empty( $terms ) ) $terms = array();

	$term_list = wp_list_pluck( $terms, 'slug' );

  $args = array(
    'post_type'              => array( 'post' ),
    'posts_per_page'         => $related_count,
    'post__not_in'           => array( $post_id ),
    'orderby'                => 'rand',
    'tax_query'              => array(
      array(
        'taxonomy'           => 'category',
        'field'              => 'slug',
        'terms'              => $term_list
      )
    )
  );

	return new WP_Query( $args );
}


?>
