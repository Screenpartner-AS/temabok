<?php
/********************
* BOX GRID
********************/
$section_title = get_sub_field('section_title');
$box_counter = 0;
?>

<div class="box-grid" id="row-<?php echo $row_counter; ?>">
  <div class="wrap">

    <?php if ($section_title) { ?>
      <h2 class="simplereveal"><?php echo $section_title; ?></h2>
    <?php } ?>

    <?php if( have_rows('boxes') ): ?>

      <div class="boxes-container">

        <?php while ( have_rows('boxes') ) : the_row(); ?>

          <?php
          // Box fields
          $box_title = get_sub_field('title');
          $box_content = get_sub_field('content');
          $btn_title = get_sub_field('button_title');
          $btn_url = get_sub_field('button_url');

          // Box settings
          $number_box = get_sub_field('number_box');
          $box_bg_color = get_sub_field('box_background_color');
          $box_text_color = get_sub_field('box_text_color');
          $accent_bg_color = get_sub_field('accent_background_color');
          $accent_text_color = get_sub_field('accent_text_color');

          $box_counter++;
          ?>

          <article class="sp-box simplereveal" id="sp-box-<?php echo $box_counter; ?>">

            <?php // Number ?>
            <?php if ($number_box) { ?>
              <span class="sp-box-number"><?php echo $box_counter; ?></span>
            <?php } ?>

            <?php // Box content ?>
            <div class="sp-box-perspective">
              <div class="sp-box-content">
                <?php if ($box_title) { ?>
                  <h3><?php echo $box_title; ?></h3>
                <?php } ?>

                <?php if ($box_content) { ?>
                  <?php echo $box_content; ?>
                <?php } ?>

                <?php if ($btn_title && $btn_url) { ?>
                  <p class="btn-line"><a href="<?php echo $btn_url; ?>" class="btn-purple"><?php echo $btn_title; ?></a></p>
                <?php } ?>
              </div>
            </div>

          </article>

          <style>
            #sp-box-<?php echo $box_counter; ?> .sp-box-content {
              <?php if ($box_bg_color) { ?>
                background: <?php echo $box_bg_color; ?>;
              <?php } ?>
              <?php if ($box_bg_color) { ?>
                color: <?php echo $box_text_color; ?>;
              <?php } ?>
            }

            #sp-box-<?php echo $box_counter; ?> .sp-box-number,
            #sp-box-<?php echo $box_counter; ?> .btn-purple {
              <?php if ($accent_bg_color) { ?>
                background: <?php echo $accent_bg_color; ?>;
              <?php } ?>
              <?php if ($accent_text_color) { ?>
                color: <?php echo $accent_text_color; ?>;
              <?php } ?>
            }
          </style>

        <?php endwhile; ?>

      </div>

    <?php endif; ?>
  </div>
</div>
