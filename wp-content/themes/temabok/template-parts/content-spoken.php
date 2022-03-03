<?php
// Content Spoken - Single
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article" itemscope itemprop="blogPost" itemtype="http://schema.org/BlogPosting">

  <?php $hide_title = get_field('hide_title'); ?>
  <?php if (!$hide_title) { ?>
    <?php load_template(TEMPLATEPATH . '/library/modules/elements/featured-image.php'); ?>

    <header class="article-header entry-header cf">
      <?php load_template(TEMPLATEPATH . '/library/modules/elements/breadcrumbs.php'); ?>
      <h1 class="entry-title single-title" itemprop="headline" rel="bookmark"><?php the_title(); ?></h1>
    </header> <?php // end article header ?>
  <?php } ?>

  <section class="entry-content cf" itemprop="articleBody">

    <div class="spoken-article cf">
      <?php
      $lydfil = get_field('lydfil');
      $spotify = get_field('link_til_spotify');
      $itunes = get_field('link_til_itunes');

      $audio_attr = array(
        'src' => $lydfil['url'],
        'preload' => 'metadata'
      );
      ?>

      <?php
      $featured_image_check = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
      $featured_image_url = get_featured_image_url(get_the_ID(), 'sp-thumb-720'); ?>

      <?php if ($featured_image_check) { ?>
        <img src="<?php echo $featured_image_url; ?>" alt="Print Friendly version of featured image" class="spoken-fi">
      <?php } ?>

      <div class="spoken-innhold">
        <img class="spoken-ikon" src="<?php echo get_template_directory_uri(); ?>/library/images/listen.svg" alt="Listen">
        <?php echo wp_audio_shortcode( $audio_attr ); ?>
      </div>
    </div>

    <?php the_content(); ?>

  </section> <?php // end article section ?>

</article> <?php // end article ?>
