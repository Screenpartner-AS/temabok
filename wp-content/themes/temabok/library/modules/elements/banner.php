<?php
/********************
* BANNER
********************/

// Lag bannerobjektet
// $banner defineres i library/modules/page/builder.php
$banner_id = $banner->ID;
$display_conditions = get_sub_field('display_conditions');

// Lag bannerobjektet
$single_banner = get_field('velg_banner');

if ($single_banner) {
  $banner_id = $single_banner->ID;
}

// ACF felter
$type_banner = get_field('type_banner', $banner_id);
$banner_size = get_field('banner_size', $banner_id);

if ($type_banner == 'automatic') {

  // AUTOMATIC Banner Slides
  // BANNER SLIDE SETTINGS
  $global_transition_time = 5;
  $global_slide_classes = 'ken_burns';
  $global_slide_overlay = "#000000";
  $global_slide_overlay_opacity = '0.3';

  $post_type = get_field('banner_content_type', $banner_id);
  $number = get_field('number_of_slides', $banner_id);

  // Arguments for query
  $args_banner_query = array(
  	'post_type' => $post_type,
  	'post_status' => array('publish'),
  	'posts_per_page' => $number,
  	'order' => 'DESC',
  	'orderby' => 'date'
  );

  // Only display main articles from education post type
  if ($post_type[0] == 'education') {
    $args_banner_query['meta_key'] = 'main_article';
    $args_banner_query['meta_value'] = '1';
  }

  $banner_query = new WP_Query( $args_banner_query );

  if ( $banner_query->have_posts() ) { ?>
    <div class="banner banner-size-<?php echo $banner_size; ?> simplereveal">
      <?php while ( $banner_query->have_posts() ) {
    		$banner_query->the_post(); ?>

        <?php
        // BANNER SLIDE VARIABLER
        $global_slide_title = get_the_title();
        $global_slide_button_text = __('Read this article', 'screenpartner');
        $global_slide_button_url = get_the_permalink();
        if ($post->post_type == 'education') {
          $global_slide_text = get_field('education_article_settings', get_the_ID())['short_description'];
        } else {
          $global_slide_text = custom_excerpt(15, '', get_the_ID());
        }
        $global_featured_image_url = get_featured_image_url( get_the_ID(), 'sp-thumb-big' );
        $global_slide_image = $global_featured_image_url;
        ?>

        <article class="banner-slide <?php echo $global_slide_classes; ?>">
          <?php if (!empty($global_slide_overlay)) { ?>
            <div class="banner-overlay" style="background: <?php echo $global_slide_overlay; ?>; opacity: <?php echo $global_slide_overlay_opacity; ?>"></div>
          <?php } ?>

          <div class="banner-image" style="background-image: url(<?php echo $global_slide_image; ?>); transition-duration: <?php echo $global_transition_time; ?>s;"></div>

          <div class="banner-content cf">
            <?php if ($global_slide_title) { ?>
              <h2 class="banner-title"><?php echo $global_slide_title; ?></h2>
            <?php } ?>

            <?php if ($global_slide_text) { ?>
              <div class="slide-text">
                <p><?php echo $global_slide_text; ?></p>

                <?php if ($global_slide_button_text || $global_slide_button_url) { ?>
                  <a class="btn-purple" href="<?php echo $global_slide_button_url; ?>" title="<?php echo $global_slide_button_text; ?>"><?php echo $global_slide_button_text; ?></a>
                <?php } ?>
              </div>
            <?php } ?>
          </div>
        </article>

    	<?php } ?>
    </div>
  <?php }

  wp_reset_postdata();
  ?>

<?php } else { ?>

  <?php // MANUAL Banner Slides ?>
  <?php if( have_rows('banner_slide', $banner_id) ): ?>

    <div class="banner banner-size-<?php echo $banner_size; ?> simplereveal">

      <?php while ( have_rows('banner_slide', $banner_id) ) : the_row(); ?>

        <?php
        // BANNER SLIDE VARIABLER
        $slide_title = get_sub_field('slide_title');
        $slide_button_text = get_sub_field('slide_button_text');
        $slide_button_url = get_sub_field('slide_button_url');
        $slide_text = get_sub_field('slide_text');
        $slide_image = get_sub_field('slide_image');

        // BANNER SLIDE OVERLAY
        $slide_overlay = get_sub_field('background_overlay');
        $slide_overlay_opacity = get_sub_field('background_overlay_opacity') / 100;

        // BANNER SLIDE SETTINGS
        $transition_time = get_sub_field('animation_time');
        $slide_classes = '';

        $slide_animation = get_sub_field('slide_animation');
        if ($slide_animation) {
          $slide_classes = $slide_classes . ' ' . $slide_animation;
        }
        ?>


        <article class="banner-slide <?php echo $slide_classes; ?>">
          <?php if (!empty($slide_overlay)) { ?>
            <div class="banner-overlay" style="background: <?php echo $slide_overlay; ?>; opacity: <?php echo $slide_overlay_opacity; ?>"></div>
          <?php } ?>

          <div class="banner-image" style="background-image: url(<?php echo $slide_image['sizes']['sp-thumb-big']; ?>); transition-duration: <?php echo $transition_time; ?>s;"></div>

          <div class="banner-content cf">
            <?php if ($slide_title) { ?>
              <h2 class="banner-title"><?php echo $slide_title; ?></h2>
            <?php } ?>

            <?php if ($slide_text) { ?>
              <div class="slide-text">
                <?php echo $slide_text; ?>

                <?php if ($slide_button_text || $slide_button_url) { ?>
                  <a class="btn-purple" href="<?php echo $slide_button_url; ?>" title="<?php echo $slide_button_text; ?>"><?php echo $slide_button_text; ?></a>
                <?php } ?>
              </div>
            <?php } ?>
          </div>
        </article>


      <?php endwhile; ?>

    </div>

  <?php endif; ?>

<?php } ?>
