<?php
/********************
* COLLECT EMAIL
********************/
$email_list = get_sub_field('email_list');
?>

<div id="get-notified" class="sign-up-email cf">
  <div class="wrap cf">

    <?php echo do_shortcode('[ninja_form id=' . $email_list . ']'); ?>

  </div>
</div>
