<?php
// Content Single

$post_id = get_the_ID();
$featured_image_url = get_featured_image_url($post_id, 'sp-thumb-600');
?>

<article id="post-<?php echo $post_id; ?>" <?php post_class( 'news-article m-1of2 mt-1of2 t-1of2 d-1of4 with-padding' ); ?>>
  <div class="news-content-wrapper">

    <a href="<?php echo get_the_permalink($post_id); ?>">
      <?php if ($featured_image_url) { ?>
        <div class="thumb">
          <img src="<?php echo $featured_image_url; ?>" alt="<?php echo get_the_title($favorite_id); ?>">
          <?php echo sp_flow_tag($post_id); ?>
          <?php echo sp_article_reading_progress($post_id); ?>
        </div>
      <?php } else { ?>
        <div class="thumb">
          <img src="<?php echo get_template_directory_uri(); ?>/library/images/fi.png" alt="Featured Image Placeholder">
          <?php echo sp_article_reading_progress($post_id); ?>
        </div>
      <?php } ?>

      <div class="news-content">
        <?php echo do_shortcode('[favorite_button post_id="' . $post_id . '" site_id="' . get_current_blog_id() . '"]'); ?>
        <h2 class="entry-title news-title"><?php echo get_the_title($post_id); ?></h2>
        <?php echo list_post_categories($post_id); ?>
      </div>
    </a>

  </div>
</article>
