<?php
/********************
* IMAGE CONTENT SECTION
********************/
$title = get_sub_field('image_content_title');
$button_text = get_sub_field('image_content_button_text');
$button_url = get_sub_field('image_content_button_url');
$text_content = get_sub_field('image_content_text');
$bg_image = get_sub_field('image_content_background_image');
?>

<div class="image-section" style="background-image: url(<?php echo $bg_image['url']; ?>);">
  <div class="wrap cf">
    <h2><?php echo $title; ?></h2>

    <div class="image-section-text">
      <?php if ($text_content) {
        echo $text_content;
      } ?>

      <?php if ($button_url || $button_text) { ?>
        <a class="btn-purple" href="<?php echo $button_url; ?>" title="<?php echo $button_text; ?>"><?php echo $button_text; ?></a>
      <?php } ?>
    </div>
  </div>
</div>
