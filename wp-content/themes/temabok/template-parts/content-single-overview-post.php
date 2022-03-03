<?php
// Content Single Overview Post
// ACF Field Group (Overview Post)
$title = get_field('title');
$subtitle = get_field('subtitle');
$bg_video = get_field('background_video');
$intro_video = get_field('intro_video');
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article" itemscope itemprop="blogPost" itemtype="http://schema.org/BlogPosting">

  <section class="post-overview-section">

    <?php if ($bg_video) { ?>
      <?php
      // Separate Files
      $bg_mp4 = $bg_video['mp4'];
      $bg_webm = $bg_video['webm'];
      $bg_flv = $bg_video['flv'];
      $bg_poster = $bg_video['poster'];
      ?>

      <div class="fullscreen-bg">
        <video loop muted autoplay poster="<?php echo $bg_poster; ?>" class="fullscreen-bg__video">
          <?php if ($bg_mp4) { ?>
            <source src="<?php echo $bg_mp4; ?>" type="video/mp4">
          <?php } ?>
          <?php if ($bg_webm) { ?>
            <source src="<?php echo $bg_webm; ?>" type="video/webm">
          <?php } ?>
          <?php if ($bg_flv) { ?>
            <source src="<?php echo $bg_flv; ?>" type="video/flv">
          <?php } ?>
        </video>
      </div>

    <?php } ?>

    <?php if ($title && $subtitle) { ?>

      <header class="overview-header hidden-on-tile-popup">
        <div class="title-block-glow">
          <h1><?php echo $title; ?></h1>
          <h2><?php echo $subtitle; ?></h2>
        </div>
      </header>

    <?php } ?>

    <?php if ($intro_video) { ?>

      <?php
      // Get the Video Fields
      $intro_mp4 = $intro_video['mp4'];
      $intro_webm  = $intro_video['webm'];
      $intro_flv = $intro_video['flv'];
      $intro_poster  = $intro_video['poster'];

      // Build the  Shortcode
      $attr =  array(
      'mp4'      => $intro_mp4,
      'webm'     => $intro_webm,
      'flv'      => $intro_flv,
      'poster'   => $intro_poster,
      'preload'  => 'auto',
      ''
      );

      // Display the Shortcode
      echo '<div class="overview-video hidden-on-tile-popup">';
      echo wp_video_shortcode(  $attr );
      echo '</div>';
      ?>

    <?php } ?>

    <?php
    // Init popups
    $popups = array();
    $count_tile = 0;
    ?>

    <?php if ( have_rows('netflix_carousel') ): ?>

      <div class="tile-popup">
        <div class="flex-columns">
          <div class="column-left">
            <img class="tile-popup-image" src="" alt="Tile Image">
          </div>

          <div class="column-right">
            <p class="tile-popup-tematittel">Tematittel</p>
            <h2 class="tile-popup-tittel">Tittel</h2>
            <div class="tile-popup-utdrag">Tekst til popup</div>
            <a class="tile-popup-lenke btn-purple" href="#">Les mer</a>

            <a href="#" class="close-tile-popup"><img src="<?php echo get_template_directory_uri(); ?>/library/images/close-icon-white.svg" alt="Close Icon"></a>
          </div>
        </div>
      </div>

      <div class="netflix-row">

        <?php while ( have_rows('netflix_carousel') ) : the_row(); ?>

          <?php
          // acf sub fields
          $tile_bilde = get_sub_field('bilde');
          $tile_tittel = get_sub_field('tittel');
          $tile_popup = get_sub_field('innholdsboks');

          $count_tile++;

          if ($tile_popup) {
            $popups['tile_' . $count_tile]['tematittel'] = $tile_popup['tematittel'];
            $popups['tile_' . $count_tile]['tittel'] = $tile_popup['tittel'];
            $popups['tile_' . $count_tile]['relatert_artikkel'] = get_the_permalink($tile_popup['relatert_artikkel']);
            $popups['tile_' . $count_tile]['utdragstekst'] = $tile_popup['utdragstekst'];
            $popups['tile_' . $count_tile]['bilde'] = $tile_popup['boksbilde'];
          }
          ?>

          <div class="netflix-tile" data-popup-title="tile_<?php echo $count_tile; ?>">
            <?php if ($tile_bilde) { ?>
              <img class="netflix-tile-img" src="<?php echo $tile_bilde['url']; ?>" alt="<?php echo $tile_bilde['alt']; ?>">
            <?php } ?>

            <?php if ($tile_tittel) { ?>
              <h3 class="netflix-tile-title"><?php echo $tile_tittel; ?></h3>
            <?php } ?>
          </div>

        <?php endwhile; ?>

      </div>

    <?php endif; ?>

    <script>
      var tiles = <?php echo json_encode($popups); ?>;
    </script>

  </section>

  <section class="entry-content cf" itemprop="articleBody">
    <?php // the_content(); ?>
    <?php // sp_delelenker($post->ID); ?>
  </section> <?php // end article section ?>

  <div class="article-meta">
    <meta itemprop="mainEntityOfPage" content="<?php echo get_the_permalink($post->ID); ?>">
    <meta itemprop="dateModified" content="<?php echo get_the_modified_date('Y-m-d'); ?>">
    <div itemprop="author" itemscope itemtype="http://schema.org/Person">
      <meta itemprop="name" content="<?php echo get_the_author(); ?>">
    </div>
    <div itemprop="publisher" itemscope itemtype="http://schema.org/Organization">
      <meta itemprop="name" content="Bokasin">
      <span itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
        <meta itemprop="image" content="<?php echo get_template_directory_uri(); ?>/library/images/bokasin_logo_med_ikon.svg">
        <meta itemprop="url" content="<?php echo get_site_url(); ?>">
        <meta itemprop="width" content="190">
        <meta itemprop="height" content="35">
      </span>
    </div>
  </div>

</article> <?php // end article ?>
