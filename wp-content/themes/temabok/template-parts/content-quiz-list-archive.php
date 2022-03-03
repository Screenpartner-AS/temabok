<?php
// Content Quiz - Archive

$post_id = $post->ID;

$featured_image_url = get_featured_image_url($post_id, 'thumbnail');
$rel_article = get_field('related_article', $post_id);
if ($rel_article) {
  $featured_image_url = get_featured_image_url($rel_article->ID, 'thumbnail');
} else {
  $featured_image_url = '';
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'quiz-article-list-view' ); ?>>

    <?php if (!empty($featured_image_url)) { ?>
      <div class="thumb">
        <img src="<?php echo $featured_image_url; ?>" alt="">
      </div>
    <?php } else { ?>
      <div class="thumb">
        <img src="<?php echo get_template_directory_uri(); ?>/library/images/placeholder.jpg" alt="Placeholder">
      </div>
    <?php } ?>

    <h3 class="entry-title quiz-title"><?php echo get_the_title($post_id); ?></h3>
    <?php if ( current_user_can('edit_quiz') && (get_current_user_id() == $post->post_author) ) { ?>
      <div class="actions">
        <p><a href="<?php echo sp_get_edit_quiz_url($post_id); ?>"><?php echo __('Edit Quiz', 'screenpartner'); ?></a></p>
        <p><a href="<?php echo sp_get_quiz_results_url($post_id); ?>"><?php echo __('View Results', 'screenpartner'); ?></a></p>
        <p><a class="btn-purple" href="<?php echo get_permalink($post_id); ?>" title="Ta oppgaven: <?php echo get_the_title($post_id); ?>">Besvar oppgave</a></p>
      </div>
    <?php } ?>

</article>
