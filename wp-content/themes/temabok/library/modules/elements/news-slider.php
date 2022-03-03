<?php
/********************
* NEWS SLIDER
********************/
$section_title = get_sub_field('section_title');
$number_of_articles = get_sub_field('number_of_articles');
$category = get_sub_field('article_category');
?>

<div class="news-slider wrap cf">

  <?php if ($section_title) { ?>
    <h2 class="module-title"><?php echo $section_title; ?></h2>
  <?php } ?>

  <?php
  $args = array(
    'post_type'              => array( 'post' ),
    'posts_per_page'         => $number_of_articles,
    'category_name'          => $category->slug
  );

  $query = new WP_Query( $args );

  if ( $query->have_posts() ) { ?>

    <div class="news-slider-wrapper">
      <ul class="news-slider-carousel">

      	<?php while ( $query->have_posts() ) {
      		$query->the_post(); ?>

          <?php $featured_image_url = get_featured_image_url($post->ID, 'sp-thumb-600'); ?>

          <article id="post-<?php the_ID(); ?>" <?php post_class( 'slider-news-article' ); ?>>
            <div class="news-content-wrapper">

              <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                <div class="thumb">
                  <?php if ($featured_image_url) { ?>
                    <?php echo the_post_thumbnail($post->ID, 'sp-thumb-600'); ?>
                  <?php } else { ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/library/images/fi.png" alt="Featured Image Placeholder">
                  <?php } ?>

                  <?php echo sp_get_content_type_tags($post->ID); ?>
                  <?php echo sp_article_reading_progress($post->ID); ?>
                </div>

                <div class="news-content">
                  <h2 class="entry-title news-title"><?php the_title(); ?></h2>
                  <?php echo list_post_categories($post->ID); ?>
                </div>
              </a>

            </div>
          </article>

      	<?php } ?>

      </ul>
    </div>

  <?php } else {
  	_e( 'Sorry, no products matched your criteria.', 'screenpartner' );
  }

  // Restore original Post Data
  wp_reset_postdata(); ?>

  <script type="text/javascript">
  jQuery(document).ready(function($) {
    $('.news-slider-carousel').flickity({
      cellAlign: 'left',
      contain: true,
      imagesLoaded: true,
      prevNextButtons: false,
      pageDots: false,
      autoPlay: true,
      wrapAround: true
    });
  });
  </script>

</div>
