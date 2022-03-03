<?php
/********************
* NEWS ARTICLES
********************/
?>

<div class="news-articles extra-news cf">

  <div class="wrap cf">

    <div class="grid-skin">

      <?php
      // WP_Query arguments
      $args = array(
      	'post_type'              => array( 'post' ),
      	'post_status'            => array( 'publish' ),
      	'posts_per_page'         => 36,
      	'order'                  => 'DESC',
      	'orderby'                => 'rand',
        'post__not_in'           => array($post->ID)
      );

      // The Query
      $latest_posts = new WP_Query( $args );
      $count = 0;
      $grid_classes = '';

      // The Loop
      if ( $latest_posts->have_posts() ) {
      	while ( $latest_posts->have_posts() ) {
      		$latest_posts->the_post();

          $featured_image_url = get_featured_image_url($post->ID, 'sp-thumb-large');
          if ($count == 6) {
            $count = 0;
          }
          $count++;
          ?>

          <article class="news-article m-1of2 mt-1of2 t-1of3 d-1of4 with-padding article-<?php echo $count; ?>">
            <div class="news-content-wrapper">

              <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                <div class="thumb">
                  <?php if ($featured_image_url) { ?>
                    <?php echo the_post_thumbnail($post->ID, 'large'); ?>
                  <?php } else { ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/library/images/fi.png" alt="Featured Image Placeholder">
                  <?php } ?>

                  <?php echo sp_get_content_type_tags($post->ID); ?>
                </div>

                <div class="news-content">
                  <h3 class="news-title"><?php the_title(); ?></h3>
                  <?php echo list_post_categories($post->ID); ?>
                </div>
              </a>

            </div>
          </article>

          <?php
      	}
      } else {
      	// no posts found
      }

      // Restore original Post Data
      wp_reset_postdata();
      ?>

    </div>

  </div>
</div>
