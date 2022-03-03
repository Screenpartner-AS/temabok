<?php
/********************
* EDUCATION FILTERS
********************/
$edufilters_title = get_sub_field('education_filters_section_title');
$display_search = get_sub_field('display_search');
?>

<div class="education-filters-section cf">
  <div class="wrap cf">

    <?php if ($edufilters_title) { ?>
      <h2 class="module-title center"><?php echo $edufilters_title; ?></h2>
    <?php } ?>

    <?php if ($display_search) { ?>
      <form role="search" method="get" class="facetwp-facet facetwp-facet-education_search facetwp-type-search education-filters-search-form" action="<?php echo esc_url( get_post_type_archive_link( 'education' ) ); ?>">
        <span class="facetwp-search-wrap">
          <input name="fwp_education_search" type="text" class="facetwp-search" value="" placeholder="Søk etter undervisning">
          <button class="education-filters-submit"><img src="<?php echo get_template_directory_uri(); ?>/library/images/search-icon-white.svg" alt="Search Icon"></button>
        </span>
      </form>
    <?php } ?>

    <div class="category-buttons">
      <?php echo sp_list_all_terms_with_facetwp_urls('student_subject'); ?>
    </div>

  </div>
</div>
