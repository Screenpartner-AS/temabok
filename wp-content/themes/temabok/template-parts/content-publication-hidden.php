<?php
// Content Publication - Single
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article" itemscope itemprop="blogPost" itemtype="http://schema.org/BlogPosting">

  <header class="article-header entry-header cf">
    <?php load_template(TEMPLATEPATH . '/library/modules/elements/breadcrumbs.php'); ?>
    <h1 class="entry-title single-title" itemprop="headline" rel="bookmark"><?php the_title(); ?></h1>
  </header> <?php // end article header ?>

</article> <?php // end article ?>
