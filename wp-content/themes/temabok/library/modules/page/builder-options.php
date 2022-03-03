<?php
/********************
* PAGE BUILDER
********************/
?>

<?php if( have_rows('builder', 'option') ): ?>

  <div class="builder cf">

    <?php while ( have_rows('builder', 'option') ) : the_row(); ?>

      <?php // VELG BANNER ?>
      <?php if( get_row_layout() == 'banner' ): ?>

        <div class="full-screen-banner cf">

          <?php $banner = get_sub_field('choose_banner'); ?>
          <?php // logic is located in library/modules/elements/banner.php ?>
          <?php include(TEMPLATEPATH . '/library/modules/elements/banner.php'); ?>

        </div>

      <?php elseif( get_row_layout() == 'regular_content' ): ?>


        <?php // logic is located in library/modules/elements/selling-points.php ?>
        <?php include(TEMPLATEPATH . '/library/modules/elements/regular-content.php'); ?>


      <?php elseif( get_row_layout() == 'selling_points' ): ?>


        <?php // logic is located in library/modules/elements/selling-points.php ?>
        <?php include(TEMPLATEPATH . '/library/modules/elements/selling-points.php'); ?>


      <?php elseif( get_row_layout() == 'news_articles' ): ?>


        <?php // logic is located in library/modules/elements/news-articles.php ?>
        <?php include(TEMPLATEPATH . '/library/modules/elements/news-articles.php'); ?>


      <?php elseif( get_row_layout() == 'image_content_section' ): ?>


        <?php // logic is located in library/modules/elements/image-section.php ?>
        <?php include(TEMPLATEPATH . '/library/modules/elements/image-section.php'); ?>


      <?php elseif( get_row_layout() == 'products_slider' ): ?>


        <?php // logic is located in library/modules/elements/products-slider.php ?>
        <?php include(TEMPLATEPATH . '/library/modules/elements/products-slider.php'); ?>

      <?php elseif( get_row_layout() == 'logo_section' ): ?>


        <?php // logic is located in library/modules/elements/logo-section.php ?>
        <?php include(TEMPLATEPATH . '/library/modules/elements/logo-section.php'); ?>


      <?php elseif( get_row_layout() == 'article_categories_section' ): ?>


        <?php // logic is located in library/modules/elements/logo-section.php ?>
        <?php include(TEMPLATEPATH . '/library/modules/elements/article-categories-section.php'); ?>


      <?php elseif( get_row_layout() == 'news_article_slider' ): ?>


        <?php // logic is located in library/modules/elements/logo-section.php ?>
        <?php include(TEMPLATEPATH . '/library/modules/elements/news-slider.php'); ?>


      <?php elseif( get_row_layout() == 'registration_form' ): ?>


        <?php // logic is located in library/modules/elements/logo-section.php ?>
        <?php include(TEMPLATEPATH . '/library/modules/elements/registration-form.php'); ?>


      <?php elseif( get_row_layout() == 'email_collection_module' ): ?>


        <?php // logic is located in library/modules/elements/logo-section.php ?>
        <?php include(TEMPLATEPATH . '/library/modules/elements/collect-email.php'); ?>


      <?php endif; ?>
    <?php endwhile; ?>

  </div><!-- END .sidebygger -->

<?php endif; ?>
