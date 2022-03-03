<?php
/********************
* GRID
********************/
$grid_settings = get_sub_field('grid_settings');
$grid_classes = $grid_settings['mobile'] . ' ' . $grid_settings['mobile_large'] . ' ' . $grid_settings['tablet'] . ' ' . $grid_settings['desktop'];
?>

<?php if( have_rows('grid_column') ): ?>

  <div class="sp-grid">
    <div class="wrap cf">

      <div class="grid-skin-large">

        <?php while ( have_rows('grid_column') ) : the_row(); ?>

          <?php
          $content = get_sub_field('content');
          ?>

          <div class="grid-column simplereveal entry-content with-padding-large <?php echo $grid_classes; ?>">
            <?php echo $content; ?>
          </div>

        <?php endwhile; ?>

      </div>

    </div>
  </div>

<?php endif; ?>
