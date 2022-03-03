<?php
/********************
* SELLING POINTS
********************/

// Lag objektet
?>

<?php if( have_rows('selling_point') ): ?>

  <div class="selling-points">
    <div class="wrap cf">

      <?php while ( have_rows('selling_point') ) : the_row(); ?>

        <?php
        // BANNER SLIDE VARIABLER
        $selling_point_title = get_sub_field('selling_point_title');
        $selling_point_text = get_sub_field('selling_point_text');
        $selling_point_icon = get_sub_field('selling_point_icon');
        $selling_point_icon_size = get_sub_field('selling_point_icon_size');
        ?>


        <div class="selling-point simplereveal size-<?php echo $selling_point_icon_size; ?>">
          <?php if ($selling_point_icon) { ?>
            <img src="<?php echo $selling_point_icon['url']; ?>" alt="<?php echo $selling_point_icon['alt']; ?>">
          <?php } ?>

          <?php if ($selling_point_title) { ?>
            <h3><?php echo $selling_point_title; ?></h3>
          <?php } ?>

          <?php if ($selling_point_text) { ?>
            <?php echo $selling_point_text; ?>
          <?php } ?>
        </div>


      <?php endwhile; ?>

    </div>
  </div>

<?php endif; ?>
