<?php
/********************
* NEWS ARTICLES
********************/
$nr_of_articles = get_sub_field('number_of_articles');
$choose_grid = get_sub_field('choose_articles_grid');
$specific_articles = get_sub_field('choose_articles');
$title = get_sub_field('title');
?>

<div class="news-articles news-articles-and-archive cf">

  <div class="archive-header">
    <div class="wrap cf">
      <h1 class="page-title archive-title"><?php echo $title; ?></h1>

      <?php
      $count = 0;
      $classes = '';
      ?>
      <?php echo facetwp_display( 'facet', 'artikkelsok' ); ?>
      <?php echo facetwp_display( 'facet', 'artikkelkategorier' ); ?>
    </div>
  </div>

  <div class="wrap filters-toggle cf">
    <a href="#" class=""><img src="<?php echo get_template_directory_uri(); ?>/library/images/filters-white.svg" alt="Settings Icon"><?php echo __('Filters', 'screenpartner'); ?></a>
  </div>

  <div class="wrap cf">

    <div class="facetwp-template facet-archive articles-wrapper grid-skin">

      <?php
      // WP_Query arguments
      $args = array(
      	'post_type'              => array( 'post' ),
      	'post_status'            => array( 'publish' ),
      	'posts_per_page'         => $nr_of_articles,
      	'order'                  => 'DESC',
      	'orderby'                => 'rand',
        'facetwp'                => true
      );

      if ($specific_articles) {
        $only_these_articles = array();
        foreach ($specific_articles as $specific) {
          $only_these_articles[] = $specific->ID;
        }

        $args['post__in'] = $only_these_articles;
        $args['orderby'] = 'post__in';
      }

      if ( isset( $_GET['fwp_artikkelsok'] ) || isset( $_GET['fwp_artikkelkategorier'] ) ) {
        unset($args['post__in']);
      }

      // The Query
      $latest_posts = new WP_Query( $args );
      $count = 0;

      $grid_classes = 'mt-1of2 t-1of3 d-1of3';

      $page_number = isset($_GET["fwp_load_more"]);

      // The Loop
      if ($latest_posts->have_posts()) : while ($latest_posts->have_posts()) : $latest_posts->the_post();

        $featured_image_url = get_featured_image_url($post->ID, 'sp-thumb-large');
        $fa_featured_image_url = get_featured_image_url($post->ID, 'sp-thumb-big');
        $count++;
        ?>

        <?php if ($count == 1 && !$page_number) { ?>

          <article class="featured-article news-article m-all t-all d-all with-padding">
            <div class="news-content-wrapper">

              <a href="<?php the_permalink($post->ID); ?>" title="<?php the_title_attribute(array('post'=>$post->ID)); ?>">
                <div class="thumb">
                  <?php if ($fa_featured_image_url) { ?>
                    <img src="<?php echo $fa_featured_image_url; ?>" alt="<?php echo get_the_title($post->ID); ?>">
                  <?php } else { ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/library/images/fi.png" alt="Featured Image Placeholder">
                  <?php } ?>

                  <?php echo sp_get_content_type_tags($post->ID); ?>
                  <?php echo sp_article_reading_progress($post->ID); ?>
                </div>

                <div class="news-content">
                  <h3 class="news-title"><?php echo get_the_title($post->ID); ?></h3>
                  <p class="news-desc"><?php echo custom_excerpt(22, '...', $post->ID); ?></p>
                  <?php echo list_post_categories($post->ID); ?>
                  <?php echo do_shortcode('[favorite_button post_id="' . $post->ID . '" site_id="' . get_current_blog_id() . '"]'); ?>
                </div>
              </a>

            </div>
          </article>

        <?php } else { ?>

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

        <?php } ?>

      <?php endwhile; ?>

      <?php else : ?>

        <article id="post-not-found" class="hentry cf">
            <header class="article-header">
              <h1><?php _e( 'No articles found!', 'screenpartner' ); ?></h1>
          </header>
            <section class="entry-content">
              <p><?php _e( 'No content were found with these search terms. Try double checking things.', 'screenpartner' ); ?></p>
          </section>
        </article>

      <?php endif; ?>

    </div>

    <?php echo do_shortcode('[facetwp facet="last_flere"]'); ?>

    <?php wp_reset_postdata(); ?>

  </div>
</div>
