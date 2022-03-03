<?php
/********************
* LOG IN FORM
********************/
$title = get_sub_field('title');
$sub_title = get_sub_field('sub_title');
$form_ids = get_field('map_ninja_forms', 'option');
?>

<div class="log-in-wrap">
  <div class="log-in-wrap-text entry-content">
    <?php if ($title) { ?>
      <h1><?php echo $title; ?></h1>
    <?php } ?>

    <?php if ($sub_title) { ?>
      <p><strong><?php echo $sub_title; ?></strong></p>
    <?php } ?>

    <div class="login-flex-container">
      <div class="entry-content login-column">
        <h3><?php echo __('Log in', 'screenpartner'); ?></h3>
        <?php echo do_shortcode('[ninja_form id=' . $form_ids["log_in"] . ']'); // LOG IN FORM ?>
        <p class="text-small"><?php printf( __( '<a href="%s" title="Forgot password">Forgot password</a>', 'screenpartner' ), wp_lostpassword_url( get_bloginfo('url') ) ); ?></p>
        <p><?php printf( __( 'Or <a href="%s" title="Register">register</a> your user', 'screenpartner' ), get_site_url() . '/registrer-bruker' ); ?></p>
      </div>

      <div class="entry-content login-column hva-er-skolerom">
        <h3>Hva er skolerom?</h3>
        <p>Ønsker din skole mer og bedre undervisningsmateriell, til en lavere pris?</p>
        <p class="btn-line"><a href="<?php echo get_site_url(); ?>/om-skolerom/" class="btn-blue">Les mer</a></p>
      </div>
    </div>
  </div>

  <div class="footer-icons margin-top">
    <div class="footer-icon">
      <img src="<?php echo get_template_directory_uri(); ?>/library/images/read.svg" alt="Read">
      <h3><?php echo __('Read', 'screenpartner'); ?></h3>
    </div>

    <div class="footer-icon">
      <img src="<?php echo get_template_directory_uri(); ?>/library/images/listen.svg" alt="Listen">
      <h3><?php echo __('Listen', 'screenpartner'); ?></h3>
    </div>

    <div class="footer-icon">
      <img src="<?php echo get_template_directory_uri(); ?>/library/images/learn.svg" alt="Learn">
      <h3><?php echo __('Learn', 'screenpartner'); ?></h3>
    </div>
  </div>

  <h2 class="footer-title"><?php echo __('Knowledge that entertains – entertainment that educates', 'screenpartner'); ?></h2>
</div>
