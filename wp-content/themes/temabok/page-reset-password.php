<?php
/*
 Template Name: Reset password
 *
*/
?>

<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="cf">

						<main id="main" class="cf" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

								<?php if (is_user_logged_in()) { ?>

									du er allerede logget inn

								<?php } else { ?>

									<div class="reset-password-column cf">
										<?php echo do_shortcode('[reset_password]'); ?>
									</div>

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
