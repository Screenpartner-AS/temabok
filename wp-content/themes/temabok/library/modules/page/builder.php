<?php
/********************
* PAGE BUILDER
********************/
?>

<?php if( have_rows('builder') ): ?>

  <div class="builder cf">

    <?php $row_counter = 0; ?>

    <?php while ( have_rows('builder') ) : the_row(); ?>

      <?php $row_counter++; ?>

      <?php // VELG BANNER ?>
      <?php if( get_row_layout() == 'banner' ): ?>

        <div class="full-screen-banner cf">

          <?php $banner = get_sub_field('choose_banner'); ?>
          <?php // logic is located in library/modules/elements/banner.php ?>
          <?php include(TEMPLATEPATH . '/library/modules/elements/banner.php'); ?>

        </div>

      <?php elseif( get_row_layout() == 'regular_content' ): ?>


        <?php // logic is located in library/modules/elements/regular-content.php ?>
        <?php include(TEMPLATEPATH . '/library/modules/elements/regular-content.php'); ?>


      <?php elseif( get_row_layout() == 'selling_points' ): ?>


        <?php // logic is located in library/modules/elements/selling-points.php ?>
        <?php include(TEMPLATEPATH . '/library/modules/elements/selling-points.php'); ?>


      <?php elseif( get_row_layout() == 'news_articles' ): ?>


        <?php // logic is located in library/modules/elements/news-articles.php ?>
        <?php include(TEMPLATEPATH . '/library/modules/elements/news-articles.php'); ?>


      <?php elseif( get_row_layout() == 'education_articles' ): ?>


        <?php // logic is located in library/modules/elements/education-articles.php ?>
        <?php include(TEMPLATEPATH . '/library/modules/elements/education-articles.php'); ?>


      <?php elseif( get_row_layout() == 'personalized_news_article_slider' ): ?>


        <?php // logic is located in library/modules/elements/personalized-news-article-slider.php ?>
        <?php include(TEMPLATEPATH . '/library/modules/elements/personalized-news-article-slider.php'); ?>


      <?php elseif( get_row_layout() == 'featured_news_article' ): ?>


        <?php // logic is located in library/modules/elements/featured-news-articles.php ?>
        <?php include(TEMPLATEPATH . '/library/modules/elements/featured-news-article.php'); ?>


      <?php elseif( get_row_layout() == 'image_content_section' ): ?>


        <?php // logic is located in library/modules/elements/image-section.php ?>
        <?php include(TEMPLATEPATH . '/library/modules/elements/image-section.php'); ?>


      <?php elseif( get_row_layout() == 'image' ): ?>


        <?php // logic is located in library/modules/elements/image.php ?>
        <?php include(TEMPLATEPATH . '/library/modules/elements/image.php'); ?>


      <?php elseif( get_row_layout() == 'box_grid' ): ?>


        <?php // logic is located in library/modules/elements/box-grid.php ?>
        <?php include(TEMPLATEPATH . '/library/modules/elements/box-grid.php'); ?>


      <?php elseif( get_row_layout() == 'grid' ): ?>


        <?php // logic is located in library/modules/elements/grid.php ?>
        <?php include(TEMPLATEPATH . '/library/modules/elements/grid.php'); ?>


      <?php elseif( get_row_layout() == 'offer' ): ?>


        <?php // logic is located in library/modules/elements/offer.php ?>
        <?php include(TEMPLATEPATH . '/library/modules/elements/offer.php'); ?>


      <?php elseif( get_row_layout() == 'article_categories_section' ): ?>


        <?php // logic is located in library/modules/elements/article-categories-section.php ?>
        <?php include(TEMPLATEPATH . '/library/modules/elements/article-categories-section.php'); ?>


      <?php elseif( get_row_layout() == 'education_filters' ): ?>


        <?php // logic is located in library/modules/elements/education-filters.php ?>
        <?php include(TEMPLATEPATH . '/library/modules/elements/education-filters.php'); ?>


      <?php elseif( get_row_layout() == 'education_query' ): ?>


        <?php // logic is located in library/modules/elements/education-query.php ?>
        <?php include(TEMPLATEPATH . '/library/modules/elements/education-query.php'); ?>


      <?php elseif( get_row_layout() == 'news_article_slider' ): ?>


        <?php // logic is located in library/modules/elements/news-slider.php ?>
        <?php include(TEMPLATEPATH . '/library/modules/elements/news-slider.php'); ?>


      <?php elseif( get_row_layout() == 'registration_form' ): ?>


        <?php // logic is located in library/modules/elements/registration-form.php ?>
        <?php include(TEMPLATEPATH . '/library/modules/elements/registration-form.php'); ?>


      <?php elseif( get_row_layout() == 'email_collection_module' ): ?>


        <?php // logic is located in library/modules/elements/collect-email.php ?>
        <?php include(TEMPLATEPATH . '/library/modules/elements/collect-email.php'); ?>


      <?php elseif( get_row_layout() == 'list_of_publications' ): ?>


        <?php // logic is located in library/modules/elements/publications-grid.php ?>
        <?php include(TEMPLATEPATH . '/library/modules/elements/publications-grid.php'); ?>


      <?php elseif( get_row_layout() == 'category_cloud' ): ?>


        <?php // logic is located in library/modules/elements/category-cloud.php ?>
        <?php include(TEMPLATEPATH . '/library/modules/elements/category-cloud.php'); ?>


      <?php elseif( get_row_layout() == 'recent_releases' ): ?>


        <?php // logic is located in library/modules/elements/recent-releases.php ?>
        <?php include(TEMPLATEPATH . '/library/modules/elements/recent-releases.php'); ?>


      <?php elseif( get_row_layout() == 'news_articles_and_archive' ): ?>


        <?php // logic is located in library/modules/elements/news-articles-and-archive.php ?>
        <?php include(TEMPLATEPATH . '/library/modules/elements/news-articles-and-archive.php'); ?>

      <?php elseif( get_row_layout() == 'banners_landing' ): ?>


      <?php // logic is located in library/modules/elements/banners_landing.php ?>
      <?php include(TEMPLATEPATH . '/library/modules/elements/banners_landing.php'); ?>

      <?php elseif( get_row_layout() == 'banners_landing_section2' ): ?>

      <?php // logic is located in library/modules/elements/banners_landing.php ?>
      <?php include(TEMPLATEPATH . '/library/modules/elements/banners_landing_section2.php'); ?>

      <?php elseif( get_row_layout() == 'banner_landing_section3' ): ?>

      <?php // logic is located in library/modules/elements/banners_landing.php ?>
      <?php include(TEMPLATEPATH . '/library/modules/elements/banners_landing_section3.php'); ?>

      <?php endif; ?>
    <?php endwhile; ?>

  </div><!-- END .sidebygger -->

<?php endif; ?>
