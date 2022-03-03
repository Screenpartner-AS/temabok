<?php
/********************
* LOG IN WRAP
********************/
$form_ids = get_field('map_ninja_forms', 'option');
?>

<div class="wrap log-in-wrap">
  <div class="log-in-wrap-text entry-content">
    <h1><?php echo __('Thousands of articles!', 'screenpartner'); ?></h1>
    <p><strong><?php echo __('Read and listen whenever you want.', 'screenpartner'); ?></strong></p>
    <div class="entry-content login-column">
      <h3><?php echo __('Log in', 'screenpartner'); ?></h3>
      <?php echo do_shortcode('[ninja_form id=' . $form_ids["log_in"] . ']'); ?>
      <p><?php printf( __( 'Or <a href="%s" title="Register">register</a> your user', 'screenpartner' ), wp_registration_url() ); ?></p>
    </div>
  </div>
</div>
