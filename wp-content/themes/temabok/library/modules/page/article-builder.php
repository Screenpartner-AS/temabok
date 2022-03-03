<?php
/********************
* PAGE BUILDER
********************/
?>

<?php if( have_rows('sections') ): ?>

  <div class="builder article-builder cf">

    <?php while ( have_rows('sections') ) : the_row(); ?>

      <?php if( get_row_layout() == 'article_regular_content' ): ?>


        <?php // logic is located in library/modules/elements/selling-points.php ?>
        <?php include(TEMPLATEPATH . '/library/modules/article-modules/regular-content.php'); ?>

      <?php elseif( get_row_layout() == 'article_title_section' ): ?>


        <?php // logic is located in library/modules/elements/selling-points.php ?>
        <?php include(TEMPLATEPATH . '/library/modules/article-modules/title-section.php'); ?>


      <?php elseif( get_row_layout() == 'article_content_with_bg' ): ?>


        <?php // logic is located in library/modules/elements/selling-points.php ?>
        <?php include(TEMPLATEPATH . '/library/modules/article-modules/content-with-background.php'); ?>


      <?php elseif( get_row_layout() == 'article_images' ): ?>


        <?php // logic is located in library/modules/elements/selling-points.php ?>
        <?php include(TEMPLATEPATH . '/library/modules/article-modules/article-images.php'); ?>


      <?php endif; ?>
    <?php endwhile; ?>

  </div><!-- END .sidebygger -->

<?php endif; ?>
