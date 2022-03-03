<?php
// Fields
$post_id = $remote_post->id;
$title = $remote_post->title->rendered;
$media_id = $remote_post->featured_media;
$thumbnail = sp_get_media_image($media_id, 'large');
$link = get_site_url() . '/publikasjoner/publikasjon?id=' . $post_id;
?>

<article id="post-<?php echo $post_id; ?>" class="api-publication publication-listing m-1of2 t-1of4 d-1of4 with-padding-x-large cf" role="article">
  <div class="thumb-wrap">
    <a href="<?php echo $link; ?>" title="<?php echo $title; ?>">
      <img src="<?php echo $thumbnail; ?>" alt="<?php echo $title; ?>">
    </a>
  </div>
</article>
