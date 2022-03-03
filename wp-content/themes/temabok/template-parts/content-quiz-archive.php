<?php
// Content Quiz - Archive

$post_id = $post->ID;

$featured_image_url = get_featured_image_url($post_id, 'large');
$rel_article = get_field('related_article', $post_id);
if ($rel_article) {
  $featured_image_url = get_featured_image_url($rel_article->ID, 'large');
} else {
  $featured_image_url = '';
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'quiz-article m-1of2 mt-1of2 t-1of3 d-1of4 with-padding' ); ?>>
  <div class="quiz-wrapper">

    <?php if (!empty($featured_image_url)) { ?>
      <div class="thumb">
        <img src="<?php echo $featured_image_url; ?>" alt="">
      </div>
    <?php } ?>

    <div class="quiz-content">
      <h3 class="entry-title quiz-title"><?php echo get_the_title($post_id); ?></h3>
      <?php if ( current_user_can('edit_quiz') && (get_current_user_id() == $post->post_author) ) { ?>
        <div class="quiz-actions">
          <p><a href="<?php echo sp_get_edit_quiz_url($post_id); ?>"><?php echo __('Edit Quiz', 'screenpartner'); ?></a></p>
          <p><a href="<?php echo sp_get_quiz_results_url($post_id); ?>"><?php echo __('View Results', 'screenpartner'); ?></a></p>
        </div>
      <?php } ?>
      <p><a class="btn-purple" href="<?php echo get_permalink($post_id); ?>" title="Ta oppgaven: <?php echo get_the_title($post_id); ?>">Besvar oppgave</a></p>
    </div>

  </div>
</article>
