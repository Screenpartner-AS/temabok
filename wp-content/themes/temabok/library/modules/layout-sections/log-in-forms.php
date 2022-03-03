<?php

/********************
 * LOG IN FORMS
 ********************/
$form_ids = get_field('map_ninja_forms', 'option');
?>
<div class="login-columns cf">
  <div class="grid-skin-large">
    <!-- <div class="with-padding-large m-all t-1of2 d-1of2 entry-content login-column">
        <h3><?php echo __('Log in with Feide', 'screenpartner'); ?></h3>
        <a class="btn-white btn-with-icon" href="https://bibliotek.screenpartner.no/wp-login.php?action=wp-saml-auth">
          <span><?php echo __('Sign in with', 'screenpartner'); ?></span>
          <img src="<?php echo get_template_directory_uri(); ?>/library/images/horizontal_feide_logo-2.svg" alt="Feide logo">
        </a>
      </div> -->
    <div class="login-wrapper">
      <div class="with-padding-large m-all t-1of2 d-1of2 entry-content login-column">
        <!--<h3><?php echo __('Log in with', 'screenpartner'); ?> <?php echo bloginfo('name'); ?></h3>-->
        <h3>Logg inn på Skolerom.no</h3>
        <?php do_action('feide_login')  ?>
        <h4>Log inn med brukernavn</h4>
        <?php echo do_shortcode('[ninja_form id=' . $form_ids["log_in"] . ']'); ?>
        <p class="text-small"><?php printf(__('<a href="%s" title="Forgot password">Forgot password</a>', 'screenpartner'), wp_lostpassword_url(get_bloginfo('url'))); ?></p>
        <!-- <p><?php printf(__('Or <a href="%s" title="Register">register</a> your user', 'screenpartner'), get_site_url() . '/registrer-bruker'); ?></p> -->
      </div>
      <div class="picture-column">
      </div>
    </div>
  </div>
</div>
<script>jQuery('.login-columns h5').html('ELLER');</script>
