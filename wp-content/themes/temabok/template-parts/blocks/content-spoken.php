<?php
/**
 * Block Name: Spoken
 *
 * This is the template that displays the spoken block.
 */

$spoken_id = get_field('choose_article');

// create id attribute for specific styling
$id = 'spoken-article-' . $block['id'];

// create align class ("alignwide") from block setting ("wide")
$align_class = $block['align'] ? 'align' . $block['align'] : '';
?>

<section id="<?php echo $id; ?>" class="byggemodul spoken-article <?php echo $align_class; ?>">
  <?php
  $lydfil = get_field('lydfil', $spoken_id);

  $audio_attr = array(
    'src'      => $lydfil['url']
  );
  ?>

  <?php
  $featured_image_url = get_featured_image_url($spoken_id, 'sp-thumb-600'); ?>

  <?php if ($featured_image_url) { ?>
    <img src="<?php echo $featured_image_url; ?>" alt="Print Friendly version of featured image" class="spoken-fi">
  <?php } ?>

  <div class="spoken-innhold">
    <img class="spoken-ikon" src="<?php echo get_template_directory_uri(); ?>/library/images/listen.svg" alt="Listen">
    <?php echo wp_audio_shortcode( $audio_attr ); ?>
  </div>
</section>

<style type="text/css">
	#<?php echo $id; ?> {

	}
</style>
