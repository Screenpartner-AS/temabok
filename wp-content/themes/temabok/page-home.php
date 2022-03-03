<?php
/*
 Template Name: Homepage
 *
*/
?>

<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="cf">

						<main id="main" class="cf" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

								<?php if (sp_is_logged_in_filter_active()) { ?>

									<?php if (is_user_logged_in()) { ?>

										<?php load_template(TEMPLATEPATH . '/library/modules/page/builder.php'); ?>

									<?php } else { ?>

										<?php // load_template(TEMPLATEPATH . '/library/modules/layout-sections/simple-log-in-wrap.php'); ?>
										<?php load_template(TEMPLATEPATH . '/library/modules/page/builder-log-in.php'); ?>

									<?php } ?>

								<?php } else { ?>

									<?php load_template(TEMPLATEPATH . '/library/modules/page/builder.php'); ?>

								<?php } ?>

							<?php endwhile; else : ?>

								<article id="post-not-found" class="hentry cf">
									<header class="article-header">
										<h1><?php _e( 'Oops, Post Not Found!', 'screenpartner' ); ?></h1>
									</header>
									<section class="entry-content">
										<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'screenpartner' ); ?></p>
									</section>
								</article>

							<?php endif; ?>

						</main>

				</div>

			</div>


<?php get_footer(); ?>
