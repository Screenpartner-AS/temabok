<?php
/********************
* NEWS ARTICLES
********************/
$regular_content = get_sub_field('regular_content');
$bg_color_dark = get_sub_field('regular_content_bg_color');
$bg_color_light = get_sub_field('regular_content_bg_color_light');
?>

<div class="regular-content simplereveal cf" id="row-<?php echo $row_counter; ?>">
  <div class="wrap cf">

    <?php echo $regular_content; ?>

  </div>
</div>

<style media="screen">
  <?php if ($bg_color_dark) { ?>
    body.darkendown .regular-content#row-<?php echo $row_counter; ?> {
      background-color: <?php echo $bg_color_dark; ?>;
    }
  <?php } ?>

  <?php if ($bg_color_light) { ?>
    body.lightenup .regular-content#row-<?php echo $row_counter; ?> {
      background-color: <?php echo $bg_color_light; ?>;
    }
  <?php } ?>
</style>
