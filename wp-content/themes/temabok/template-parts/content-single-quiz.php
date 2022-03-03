<?php
// Content Quiz - Single

$rel_article = get_field('related_article', $post->ID);
if ($rel_article) {
  $featured_image_url = get_featured_image_url($rel_article->ID, 'sp-thumb-large');
} else {
  $featured_image_url = '';
}

if (isset($_GET['quiz_answer'])) {
  $quiz_answer = $_GET['quiz_answer'];
} else {
  $quiz_answer = '';
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('quiz-single cf'); ?> role="article" itemscope itemprop="blogPost" itemtype="http://schema.org/BlogPosting">
  <?php if (!empty($featured_image_url)) { ?>
    <div itemprop="image" itemscope itemtype="http://schema.org/ImageObject">
      <img class="attachment-sp-thumb-large" src="<?php echo $featured_image_url; ?>" alt="">
      <?php $imagesize = getimagesize(get_featured_image_url($rel_article->ID, 'sp-thumb-large')); ?>
      <meta itemprop="width" content="<?php echo $imagesize[0]; ?>">
      <meta itemprop="height" content="<?php echo $imagesize[1]; ?>">
    </div>
  <?php } ?>

  <header class="article-header entry-header">
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

  <section class="entry-content cf" itemprop="articleBody">
    <?php if ( current_user_can( 'view_quiz' ) ) {
      do_action('sp_before_quiz_content');
      
      the_content(); ?>

      <p class="message">Denne quizzen er basert på artikkelen: <a href="<?php echo get_permalink($rel_article->ID); ?>"><?php echo get_the_title($rel_article->ID); ?></a></p>

      <?php if ( empty( $quiz_answer ) ) {
        sp_get_single_quiz_form();
      } else { ?>
        <p class="message error">Takk for ditt svar. Din besvarelse har blitt lagret her: <a href="<?php echo get_permalink($quiz_answer); ?>">Besvarelse: <?php echo get_the_title($quiz_answer); ?></a></p>
      <?php }
    } else { ?>
      <p class="message error">Du har ikke tilgang til denne quizen.</p>
    <?php } ?>

    <?php if ( current_user_can( 'edit_quiz' ) ) { ?>
      <p><a class="btn" href="<?php echo sp_get_edit_quiz_url($post->ID); ?>"><?php echo __('Edit Quiz', 'screenpartner'); ?></a></p>
    <?php } ?>

    <?php sp_delelenker($post->ID); ?>
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
