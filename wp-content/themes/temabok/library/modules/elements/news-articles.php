<?php
/********************
* NEWS ARTICLES
********************/
$nr_of_articles = get_sub_field('how_many_articles_to_display');
$featured_article = get_sub_field('featured_article');
$skip_articles = get_sub_field('skip_articles');
$choose_grid = get_sub_field('choose_articles_grid');
$inverted_colors = get_sub_field('inverted_colors');
$specific_articles = get_sub_field('choose_specific_articles');
$sort_articles_by = get_sub_field('sort_articles_by');
$articles_from_category = get_sub_field('articles_from_category');

if ($sort_articles_by == 'date') {
  $query_sort = 'date';
} elseif ($sort_articles_by == 'name') {
  $query_sort = 'name';
} elseif ($sort_articles_by == 'rand') {
  $query_sort = 'rand';
} else {
  $query_sort = 'date';
}

if ($inverted_colors) {
  $inverted_class = 'inverted-colors';
} else {
  $inverted_class = 'normal-colors';
}

?>

<div class="news-articles cf <?php echo $inverted_class; ?>">

  <div class="wrap cf">

    <div class="grid-skin">

      <?php if ($featured_article) { ?>

        <?php
        $fa_id = $featured_article->ID;
        $fa_featured_image_url = get_featured_image_url($fa_id, 'sp-thumb-big');
        ?>

        <article class="featured-article news-article m-all t-all d-all with-padding">
          <div class="news-content-wrapper">

            <a href="<?php the_permalink($fa_id); ?>" title="<?php the_title_attribute(array('post'=>$fa_id)); ?>">
              <div class="thumb">
                <?php if ($fa_featured_image_url) { ?>
                  <img src="<?php echo $fa_featured_image_url; ?>" alt="<?php echo get_the_title($fa_id); ?>">
                <?php } else { ?>
                  <img src="<?php echo get_template_directory_uri(); ?>/library/images/fi.png" alt="Featured Image Placeholder">
                <?php } ?>

                <?php echo sp_get_content_type_tags($featured_article->ID); ?>
                <?php echo sp_article_reading_progress($featured_article->ID); ?>
              </div>

              <div class="news-content">
                <h3 class="news-title"><?php echo get_the_title($fa_id); ?></h3>
                <p class="news-desc"><?php echo custom_excerpt(22, '...', $fa_id); ?></p>
                <?php echo list_post_categories($fa_id); ?>
                <?php echo do_shortcode('[favorite_button post_id="' . $fa_id . '" site_id="' . get_current_blog_id() . '"]'); ?>
              </div>
            </a>

          </div>
        </article>

      <?php } ?>

      <?php
      // WP_Query arguments
      $args = array(
      	'post_type'              => array( 'post' ),
      	'post_status'            => array( 'publish' ),
      	'posts_per_page'         => $nr_of_articles,
      	'order'                  => 'DESC',
      	'orderby'                => $query_sort,
        'post__not_in'           => array($fa_id),
        'offset'                 => $skip_articles
      );

      if ($articles_from_category) {
        $args['cat'] = $articles_from_category;
      }

      if ($specific_articles) {
        $only_these_articles = array();
        foreach ($specific_articles as $specific) {
          $only_these_articles[] = $specific->ID;
        }

        $args = array(
          'post_type'              => array( 'post' ),
        	'post_status'            => array( 'publish' ),
          'post__in' => $only_these_articles,
          'order'                  => 'DESC',
          'orderby'                => $query_sort
        );
      }

      // The Query
      $latest_posts = new WP_Query( $args );
      $count = 0;
      $grid_classes = '';

      echo '<pre style="display: none;">';
      print_r($args);
      echo '</pre>';

      // The Loop
      if ( $latest_posts->have_posts() ) {
      	while ( $latest_posts->have_posts() ) {
      		$latest_posts->the_post();

          $featured_image_url = get_featured_image_url($post->ID, 'sp-thumb-large');
          $count++;

          if ($choose_grid == 'onethreethree') {
            $grid_classes = 'mt-1of2 t-1of3 d-1of3';
          } elseif ($choose_grid == 'onetwothree') {
            if (($count == 1) || ($count == 2) || ($count == 6) || ($count == 7)) {
              $grid_classes = 'mt-1of2 t-1of2 d-1of2';
            } else {
              $grid_classes = 'mt-1of2 t-1of3 d-1of3';
            }
          } elseif ($choose_grid == 'onetwotwo') {
            $grid_classes = 'mt-1of2 t-1of2 d-1of2';
          } elseif ($choose_grid == 'onethreetwo') {
            if (($count == 1) || ($count == 2) || ($count == 3) || ($count == 6) || ($count == 7) || ($count == 8)) {
              $grid_classes = 'mt-1of2 t-1of3 d-1of3';
            } else {
              $grid_classes = 'mt-1of2 t-1of2 d-1of2';
            }
          } elseif ($choose_grid == 'one_twosmallonelarge') {
            if (($count == 1) || ($count == 2) || ($count == 5) || ($count == 6) || ($count == 7) || ($count == 8) || ($count == 11) || ($count == 12)) {
              $grid_classes = 'mt-1of2 t-1of4 d-1of4';
            } else {
              $grid_classes = 'mt-1of2 t-1of2 d-1of2';
            }
          } elseif ($choose_grid == 'one_onesmallonelarge') {
            if (($count == 1) || ($count == 4) || ($count == 5) || ($count == 8)) {
              $grid_classes = 'mt-1of2 t-1of3 d-1of3';
            } else {
              $grid_classes = 'mt-1of2 t-2of3 d-2of3';
            }
          } elseif ($choose_grid == 'onefourtwo') {
            if (($count == 1) || ($count == 2) || ($count == 3) || ($count == 4)) {
              $grid_classes = 'mt-1of2 t-1of4 d-1of4';
            } else {
              $grid_classes = 'mt-1of2 t-1of2 d-1of2';
            }
          }
          ?>

          <article class="news-article m-1of2 <?php echo $grid_classes; ?> with-padding">
            <div class="news-content-wrapper">

              <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                <div class="thumb">
                  <?php if ($featured_image_url) { ?>
                    <?php echo the_post_thumbnail($post->ID, 'sp-thumb-large'); ?>
                  <?php } else { ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/library/images/fi.png" alt="Featured Image Placeholder">
                  <?php } ?>

                  <?php echo sp_get_content_type_tags($post->ID); ?>
                  <?php echo sp_article_reading_progress($post->ID); ?>
                </div>

                <div class="news-content">
                  <h3 class="news-title"><?php the_title(); ?></h3>
                  <?php echo list_post_categories($post->ID); ?>
                  <?php echo do_shortcode('[favorite_button post_id="' . $post->ID . '" site_id="' . get_current_blog_id() . '"]'); ?>
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
