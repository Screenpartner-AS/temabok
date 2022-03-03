<?php
/********************
* NEXT & PREVIOUS LINKS
********************/
?>

<nav role="navigation" class="nextprevious-nav cf">

  <?php
  $prev = get_adjacent_post(false, '', true);
  $next = get_adjacent_post(false, '', false);
  ?>

  <?php if ($prev) { ?>
    <a class="nav-item previous" href="<?php echo get_the_permalink($prev->ID); ?>">
      <p><?php echo __('<i class="fa fa-angle-left" aria-hidden="true"></i> Previous post', 'screenpartner'); ?></p>
      <h3><?php echo $prev->post_title; ?></h3>
    </a>
  <?php } ?>

  <?php if ($next) { ?>
    <a class="nav-item next" href="<?php echo get_the_permalink($next->ID); ?>">
      <p><?php echo __('Next post <i class="fa fa-angle-right" aria-hidden="true"></i>', 'screenpartner'); ?></p>
      <h3><?php echo $next->post_title; ?></h3>
    </a>
  <?php } ?>

</nav>
