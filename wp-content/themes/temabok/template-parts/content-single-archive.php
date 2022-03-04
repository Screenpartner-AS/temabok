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
					<?php if ($featured_image_url) { ?>
						<?php echo the_post_thumbnail($post_id, 'sp-thumb-large'); ?>
					<?php } else { ?>
						<img src="<?php echo get_template_directory_uri(); ?>/library/images/fi.png" alt="Featured Image Placeholder">
					<?php } ?>

					<?php echo sp_get_content_type_tags($post_id); ?>
					<?php echo sp_article_reading_progress($post_id); ?>
				</div>
      <?php } else { ?>
        <div class="thumb">
          <img src="<?php echo get_template_directory_uri(); ?>/library/images/fi.png" alt="Featured Image Placeholder">
					<?php echo sp_get_content_type_tags($post_id); ?>
          <?php echo sp_article_reading_progress($post_id); ?>
        </div>
      <?php } ?>

			<div class="news-content">
				<h3 class="news-title"><?php the_title(); ?></h3>
				<?php echo list_post_categories($post_id); ?>
				<?php echo do_shortcode('[favorite_button post_id="' . $post_id . '"]'); ?>
			</div>
    </a>

  </div>
</article>
