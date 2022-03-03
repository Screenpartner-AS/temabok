<?php
// Content Single
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article" itemscope itemprop="blogPost" itemtype="http://schema.org/BlogPosting">

  <?php $hide_title = get_field('hide_title'); ?>
  <?php if (!$hide_title) { ?>
    <?php load_template(TEMPLATEPATH . '/library/modules/elements/featured-image.php'); ?>

    <header class="article-header entry-header <?php echo $headerclass; ?>">
      <?php load_template(TEMPLATEPATH . '/library/modules/elements/breadcrumbs.php'); ?>

      <h1 class="entry-title single-title" itemprop="headline" rel="bookmark"><?php the_title(); ?></h1>
      <p class="byline entry-meta vcard">
        <?php $date_format = __('F j, Y', 'screenpartner'); ?>
        <?php printf( __( 'Posted', 'screenpartner' ).' %1$s ',
           /* the time the post was published */
           '<time class="updated entry-time" datetime="' . get_the_time('Y-m-d') . '" itemprop="datePublished">' . get_the_time($date_format) . '</time>'
        ); ?>
      </p>
    </header> <?php // end article header ?>
  <?php } ?>

  <section class="entry-content cf" itemprop="articleBody">
    <?php echo sp_show_first_gutenberg_blocks_or_excerpt(10); ?>
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
