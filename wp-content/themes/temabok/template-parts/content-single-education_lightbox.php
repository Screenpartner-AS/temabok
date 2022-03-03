<?php
// Content Single Education Lightbox
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article" itemscope itemprop="blogPost" itemtype="http://schema.org/BlogPosting">

  <?php load_template(TEMPLATEPATH . '/library/modules/elements/featured-image.php'); ?>

  <header class="article-header entry-header <?php echo $headerclass; ?>">
    <h1 class="entry-title single-title" itemprop="headline" rel="bookmark"><?php the_title(); ?></h1>
  </header> <?php // end article header ?>

  <section class="entry-content cf" itemprop="articleBody">
    <?php the_content(); ?>
  </section> <?php // end article section ?>

</article> <?php // end article ?>
