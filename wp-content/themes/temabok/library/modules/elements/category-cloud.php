<?php
/********************
* CATEGORY CLOUD
********************/

$cat_cloud = 'cat-cloud';
?>

<div class="category-cloud cf">

  <div class="full-width-wrap">
    <ul class="category-cloud-list">
      <?php
      $categories = get_categories(array(
        'number' => 9,
      ));

      foreach($categories as $category) {
        $cat_color = get_field('category_color', $category);
        ?>
        <li>
          <a style="color: #fff; background-color: <?php echo $cat_color; ?>;" href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>?fwp_artikkelkategorier=<?php echo $category->slug; ?>"><?php echo $category->name; ?></a>
        </li>
        <?php
      }
      ?>
    </ul>
  </div>

</div>

<script type="text/javascript">
jQuery(document).ready(function($) {
  $('.category-cloud-list').flickity({
    cellAlign: 'left',
    contain: true,
    imagesLoaded: true,
    prevNextButtons: false,
    pageDots: false,
    autoPlay: true,
    autoplaySpeed: 5000,
    wrapAround: false,
    slidesToScroll: 2,
    variableWidth: true
  });
});
</script>
