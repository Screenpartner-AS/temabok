<?php
/* SUPPORT BREADCRUMBS */
$ref = $_SERVER['HTTP_REFERER'];
$back_text = __('Back to overview', 'screenpartner');
$prev_url = get_post_type_archive_link('support');
if (isset($_SERVER['HTTP_REFERER'])) {
  if (strpos($ref, $prev_url) === 0) {
    $prev_url = $ref;
  }
}
?>

<div class="support-breadcrumbs">
  <a class="btn-purple" href="<?php echo esc_attr($prev_url); ?>"><?php echo $back_text; ?></a>
</div>
