<?php
/********************
* FEATURED NEWS ARTICLE
********************/
$featured_article = get_sub_field('featured_article');
?>

<div class="featured-news-article cf">

  <div class="wrap cf">

    <div class="grid-skin cf">

      <?php
      $fa_id = $featured_article->ID;
      $fa_featured_image_url = get_featured_image_url($fa_id, 'sp-thumb-big');
      ?>

      <article class="new-featured-article featured-article news-article m-all t-all d-all with-padding">
        <div class="news-content-wrapper">

          <a href="<?php the_permalink($fa_id); ?>" title="<?php the_title_attribute(array('post'=>$fa_id)); ?>">
            <?php if ($fa_featured_image_url) { ?>
              <div class="thumb">
                <img src="<?php echo $fa_featured_image_url; ?>" alt="<?php echo get_the_title($fa_id); ?>">
                <?php echo sp_article_reading_progress($fa_id); ?>
                <?php echo sp_get_content_type_tags($fa_id); ?>
              </div>
            <?php } else { ?>
              <div class="thumb">
                <img src="<?php echo get_template_directory_uri(); ?>/library/images/fi.png" alt="Featured Image Placeholder">
                <?php echo sp_article_reading_progress($fa_id); ?>
                <?php echo sp_get_content_type_tags($fa_id); ?>
              </div>
            <?php } ?>

            <div class="news-content">
              <h2 class="news-title"><?php echo get_the_title($fa_id); ?></h2>
              <p class="news-desc"><?php echo custom_excerpt(28, '...', $fa_id); ?></p>

              <div class="extra-news-options">
                <div class="news-icon">
    							<img src="<?php echo get_template_directory_uri(); ?>/library/images/read.svg" alt="Read">
    							<p><?php echo __('Read', 'screenpartner'); ?></p>
    						</div>

    						<div class="news-icon">
    							<img src="<?php echo get_template_directory_uri(); ?>/library/images/listen.svg" alt="Listen">
    							<p><?php echo __('Listen', 'screenpartner'); ?></p>
    						</div>

                <?php echo do_shortcode('[favorite_button post_id="' . $fa_id . '"]'); ?>
              </div>
            </div>
          </a>

        </div>
      </article>

    </div>

  </div>
</div>
