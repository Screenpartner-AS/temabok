<?php
/**
 * Block Name: Cover
 *
 * This is the template that displays the banner block.
 */

// FIELDS HERE
$image = get_field('image');
$text = get_field('text');
$min_height = get_field('min_height');
$fixed = get_field('fixed');
$dim_bg = get_field('background_opacity');
$bg_color = get_field('background_color');
$text_color = get_field('text_color');

// create id attribute for specific styling
$id = 'sp-cover-' . $block['id'];

// create align class ("alignwide") from block setting ("wide")
$align_class = $block['align'] ? 'align' . $block['align'] : '';
?>

<section id="<?php echo $id; ?>" class="byggemodul sp-cover has-background-dim <?php echo $align_class; ?>" style="background-image: url(<?php echo $image['url']; ?>);">
  <?php if ($text) { ?>
    <p class="sp-cover-tittel"><?php echo $text; ?></p>
  <?php } ?>
</section>

<style type="text/css">
  #<?php echo $id; ?> {
    min-height: <?php echo $min_height; ?>px;
  }

  <?php if ($fixed) { ?>
    #<?php echo $id; ?> {
      background-attachment: fixed;
    }
  <?php } ?>

  <?php if ($dim_bg > 0) { ?>
    #<?php echo $id; ?>.has-background-dim:before {
      opacity: <?php echo $dim_bg; ?>;
    }
  <?php } ?>

  <?php if ($bg_color) { ?>
    #<?php echo $id; ?>.has-background-dim:before {
      background-color: <?php echo $bg_color; ?>;
    }
  <?php } ?>

  <?php if ($text_color) { ?>
    #<?php echo $id; ?> .sp-cover-tittel {
      color: <?php echo $text_color; ?>;
    }
  <?php } ?>
</style>
