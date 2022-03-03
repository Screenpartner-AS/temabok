<?php
/* FEATURED IMAGE */

$headerclass = '';
$featured_image_check = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
$featured_image_url = get_featured_image_url($post->ID, 'full');
?>

<?php if ($featured_image_check) { ?>
  <div itemprop="image" itemscope itemtype="http://schema.org/ImageObject">
    <?php the_post_thumbnail('sp-thumb-large', array( 'itemprop' => 'url' )); ?>
    <?php $imagesize = getimagesize(get_featured_image_url($post->ID, 'sp-thumb-large')); ?>
    <meta itemprop="width" content="<?php echo $imagesize[0]; ?>">
    <meta itemprop="height" content="<?php echo $imagesize[1]; ?>">
  </div>
<?php } else {
  $headerclass = 'uten-fi';
} ?>
