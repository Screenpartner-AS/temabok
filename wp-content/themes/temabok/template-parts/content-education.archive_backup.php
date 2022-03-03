<?php
// Content Archive Education
$disciplin_terms = get_the_terms($post->ID, 'student_disciplin');
$grade_terms = get_the_terms($post->ID, 'student_grade');
$subject_terms = get_the_terms($post->ID, 'student_subject');
$education_settings = get_field('education_article_settings');
$short_description = $education_settings['short_description'];
$core_elements = $education_settings['core_elements'];
$core_elements_text = $education_settings['core_elements_text_box'];
$benchmarks = $education_settings['benchmarks'];
$benchmarks_text = $education_settings['benchmarks_text_box'];
?>
<article id="post-<?php the_ID(); ?>" data-education-id="<?php the_ID(); ?>" <?php post_class( 'education-listing m-1of2 t-1of3 d-1of4 with-padding-large cf' ); ?> role="article">

  <div class="education-content-wrapper">
    <!-- <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">

    </a> -->
    <div class="thumb">
      <?php if (has_post_thumbnail($post->ID)) { ?>
        <?php the_post_thumbnail('large'); ?>
      <?php } else { ?>
        <img src="<?php echo get_template_directory_uri(); ?>/library/images/fi.png" alt="Featured Image Placeholder">
      <?php } ?>
    </div>

    <div class="education-content">
      <h3 class="entry-title education-title"><?php the_title(); ?></h3>
    </div>
  </div>

  <aside class="education-listing-content" data-education-id="<?php the_ID(); ?>">
    <div class="education-listing-aside-info cf">
      <?php if (!empty($short_description)) { ?>
        <p class="short-desc"><?php echo $short_description; ?></p>
      <?php } ?>

      <?php if (!empty($disciplin_terms) || (!empty($benchmarks)) || (!empty($grade_terms))) { ?>
        <div class="sp-terms-container">
      <?php } ?>

      <div class="sp-term-section">
        <h4><?php echo __('Interdisciplinary Subjects', 'screenpartner'); ?></h4>
        <?php echo list_post_terms($post->ID, 'student_disciplin', 'sp-term-list'); ?>

        <?php if ( have_rows('education_article_settings') ): ?>
          <?php while ( have_rows('education_article_settings') ) : the_row();  ?>

            <?php if ($core_elements_text) { ?>
              <h4>Kjerneelementer</h4>
              <?php echo $core_elements_text; ?>
            <?php } else { ?>
              <?php if (have_rows('core_elements')) { ?>
                <h4>Kjerneelementer</h4>

                <?php while( have_rows('core_elements') ) : the_row(); ?>
                  <?php $core_element = get_sub_field('core_element'); ?>
                  <p class="text"><?php echo $core_element; ?></p>
                <?php endwhile; ?>
              <?php } ?>
            <?php } ?>

          <?php endwhile; ?>
        <?php endif; ?>

        <?php if (!empty($subject_terms)) { ?>
          <h4>Fag</h4>
          <?php echo list_post_terms($post->ID, 'student_subject', 'sp-term-list'); ?>
        <?php } ?>
      </div>

      <?php if ( have_rows('education_article_settings') ): ?>
        <?php while ( have_rows('education_article_settings') ) : the_row();  ?>
          <div class="sp-term-section benchmarks">
              <h4>Kompetansem책l</h4>
              <?php if (!empty($grade_terms)) { ?>
                <?php echo list_post_terms($post->ID, 'student_grade'); ?>
              <?php } ?>

              <?php if ($benchmarks_text) { ?>
                <?php echo $benchmarks_text; ?>
              <?php } else { ?>
                <?php if( have_rows('benchmarks') ) : ?>
                  <?php while( have_rows('benchmarks') ) : the_row(); ?>
                    <?php $benchmark = get_sub_field('benchmark'); ?>
                    <p class="text"><?php echo $benchmark; ?></p>
                  <?php endwhile; ?>
                <?php endif; ?>
              <?php } ?>
          </div>
        <?php endwhile; ?>
      <?php endif; ?>

      <?php if (!empty($disciplin_terms) || (!empty($benchmarks)) || (!empty($grade_terms))) { ?>
        </div><!-- end .sp-terms-container -->
      <?php } ?>
    </div>
    
    <?php sp_display_read_level_buttons($post->ID); ?>

    <a href="#" class="close-btn">
      <img src="<?php echo get_template_directory_uri(); ?>/library/images/close-icon-white.svg" alt="<?php echo __('Lukk artikkelvisning', 'screenpartner'); ?>" title="<?php echo __('Lukk artikkelvisning', 'screenpartner'); ?>">
    </a>
  </aside>

</article>
