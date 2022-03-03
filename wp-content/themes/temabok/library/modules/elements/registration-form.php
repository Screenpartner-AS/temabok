<?php
/********************
* REGISTER FORM
********************/
$form_ids = get_field('map_ninja_forms', 'option');
?>

<div class="log-in-wrap">
  <div class="log-in-wrap-text entry-content">
    <h1>Digitalt innhold - fra ditt lokale bibliotek</h1>
    <p>Les og lytt når du vil</p>

    <div class="entry-content login-column">
      <?php if (!is_user_logged_in()) { ?>
        <h3><?php echo __('Register user', 'screenpartner'); ?></h3>
        <?php echo do_shortcode('[ninja_form id=' . $form_ids["register_user"] . ']'); // LOG IN FORM ?>
      <?php } else { ?>
        <p><?php echo __("You're already registered!", 'screenpartner'); ?></p>
      <?php } ?>
    </div>
  </div>
</div>
