<?php
/********************
* OFFER
********************/
// Box fields
$box_title = get_sub_field('box_title');
$box_aside = get_sub_field('extra_information');
$btn_title = get_sub_field('button_title');
$btn_url = get_sub_field('button_url');

// Box settings
$box_bg_color = get_sub_field('box_background_color');
$box_text_color = get_sub_field('box_text_color');
$accent_bg_color = get_sub_field('accent_background_color');
$accent_text_color = get_sub_field('accent_text_color');
?>

<div class="offer-box-section" id="row-<?php echo $row_counter; ?>">
  <div class="wrap">

    <?php if( have_rows('offers') ): ?>

      <div class="offer-box simplereveal">

        <?php if ($box_title) { ?>
          <h3><?php echo $box_title; ?></h3>
        <?php } ?>

        <div class="sp-offers-main-content">

          <table class="sp-offers">
            <tbody>
              <?php while ( have_rows('offers') ) : the_row(); ?>

                <tr class="leftreveal">

                  <?php
                  $line_title = get_sub_field('title');
                  $orig_price = get_sub_field('original_price');
                  $sale_price = get_sub_field('sale_price');

                  $box_counter++;
                  ?>

                  <td class="sp-product"><?php echo $line_title; ?></td>
                  <td class="sp-price original-price">kr. <strong><?php echo $orig_price; ?></strong>,-</td>
                  <td class="sp-price sale-price">kr. <strong><?php echo $sale_price; ?></strong>,-</td>

                </tr>

              <?php endwhile; ?>
            </tbody>
          </table>

          <?php if ($box_aside) { ?>
            <div class="aside-info simplereveal">
              <?php echo $box_aside; ?>
            </div>
          <?php } ?>

        </div>

        <?php if ($btn_title && $btn_url) { ?>
          <p class="btn-line simplereveal"><a href="<?php echo $btn_url; ?>" class="btn-purple"><?php echo $btn_title; ?></a></p>
        <?php } ?>

      </div>

      <style>
        #row-<?php echo $row_counter; ?> .offer-box {
          <?php if ($box_bg_color) { ?>
            background: <?php echo $box_bg_color; ?>;
          <?php } ?>
          <?php if ($box_bg_color) { ?>
            color: <?php echo $box_text_color; ?>;
          <?php } ?>
          <?php if ($accent_bg_color) { ?>
            border-color: <?php echo $accent_bg_color; ?>;
          <?php } ?>
        }

        #row-<?php echo $row_counter; ?> .offer-box .btn-purple {
          <?php if ($accent_bg_color) { ?>
            background: <?php echo $accent_bg_color; ?>;
          <?php } ?>
          <?php if ($accent_text_color) { ?>
            color: <?php echo $accent_text_color; ?>;
          <?php } ?>
        }
      </style>

    <?php endif; ?>
  </div>
</div>
