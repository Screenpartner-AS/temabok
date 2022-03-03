<?php
// Content Single Education
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article" itemscope itemprop="blogPost" itemtype="http://schema.org/BlogPosting">

  <?php load_template(TEMPLATEPATH . '/library/modules/page/education-sections.php'); ?>

  <section class="entry-content cf">
    <?php // sp_delelenker($post->ID); ?>
  </section> <?php // end article section ?>

  <div class="article-meta">
    <meta itemprop="mainEntityOfPage" content="<?php echo get_the_permalink($post->ID); ?>">
    <meta itemprop="dateModified" content="<?php echo get_the_modified_date('Y-m-d'); ?>">
    <div itemprop="author" itemscope itemtype="http://schema.org/Person">
      <meta itemprop="name" content="<?php echo get_the_author(); ?>">
    </div>
    <div itemprop="publisher" itemscope itemtype="http://schema.org/Organization">
      <meta itemprop="name" content="Temabok">
      <span itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
        <meta itemprop="image" content="<?php echo get_template_directory_uri(); ?>/library/images/bokasin_logo_med_ikon.svg">
        <meta itemprop="url" content="<?php echo get_site_url(); ?>">
        <meta itemprop="width" content="190">
        <meta itemprop="height" content="35">
      </span>
    </div>
  </div>

</article> <?php // end article ?>
