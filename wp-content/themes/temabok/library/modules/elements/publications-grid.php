<?php
/********************
* PUBLICATIONS GRID
********************/

$bokasins = get_sub_field('choose_publications');
$bokasins_description = get_sub_field('publications_description');


if ($bokasins) { ?>

  <?php
  $count_list = 0;
  $count_issuu = 0;
  ?>

  <div class="publications-grid cf">
    <div class="wrap cf">

      <div class="publications-description cf">
        <?php echo $bokasins_description; ?>
      </div>

      <div class="grid-skin-x-large cf">

        <div class="bokasin-examples with-padding-x-large m-all t-1of3 d-1of3">

          <?php foreach ($bokasins as $bok) { ?>
            <?php
            $count_list++;
            $classes = '';

            if ($count_list == 1) {
              $classes = 'active';
            }
            ?>

            <a class="bokasin-example-listing bokasinex-link <?php echo $classes; ?>" href="#" title="<?php echo get_the_title($bok->ID); ?>" data-count="<?php echo $count_list; ?>">

              <div class="thumb-wrap">
                <img src="<?php echo get_featured_image_url($bok->ID, 'large'); ?>" alt="<?php echo get_the_title($bok->ID); ?>">
              </div>

              <h3><?php echo get_the_title($bok->ID); ?></h3>

            </a>

          <?php } ?>

        </div>

        <div class="issuu-example with-padding-x-large m-all t-2of3 d-2of3">

          <?php foreach ($bokasins as $bok) { ?>
            <?php
            $count_issuu++;
            $classes = '';

            if ($count_issuu == 1) {
              $classes = 'active';
            }

            $publication_file = get_field('publication_url', $bok->ID);
            ?>

            <div class="bokasin-issuu-<?php echo $count_issuu; ?> the-issuu <?php echo $classes; ?>">
              <?php echo wp_oembed_get($publication_file); ?>
            </div>

          <?php } ?>

        </div>

      </div>
    </div>
  </div>

  <script type="text/javascript">
  jQuery(document).ready(function($) {
    $('.bokasinex-link').on('click', function(e) {
      e.preventDefault();

      var count = $(this).data('count');
      var issuu = '.bokasin-issuu-' + count;

      $('.bokasinex-link').removeClass('active');
      $(this).addClass('active');

      $('.the-issuu').removeClass('active');
      $(issuu).addClass('active');

    });
  });
  </script>

<?php } ?>
