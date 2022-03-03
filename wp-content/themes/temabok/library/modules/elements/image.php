<?php
/********************
* IMAGE SECTION
********************/
$image = get_sub_field('image');
$image_effect = get_sub_field('image_effect');
$image_size = get_sub_field('image_size');
?>

<div class="just-an-image" id="row-<?php echo $row_counter; ?>">
  <img class="size-<?php echo $image_size; ?> effect-<?php echo $image_effect; ?>" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
</div>
