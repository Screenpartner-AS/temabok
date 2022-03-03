<?php
/********************
* ARTICLE CATEGORIES
********************/
if (is_single()) {
  $ac_title = __('Read from category', 'screenpartner');
} else {
  $ac_title = get_sub_field('article_categories_section_title');
}
?>

<div class="article-categories-section cf">
  <div class="wrap cf">

    <?php if ($ac_title) { ?>
      <h2 class="module-title"><?php echo $ac_title; ?></h2>
    <?php } ?>

    <div class="category-buttons">
      <?php echo sp_list_all_categories(); ?>
    </div>

  </div>
</div>
