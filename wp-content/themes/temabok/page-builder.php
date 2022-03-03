<?php
/*
 Template Name: Page Builder
 *
*/
?>

<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="cf">

						<main id="main" class="cf" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

								<?php load_template(TEMPLATEPATH . '/library/modules/page/builder.php'); ?>

							<?php endwhile; else : ?>

								<article id="post-not-found" class="hentry cf">
										<header class="article-header">
											<h1><?php _e( 'Oops, Post Not Found!', 'screenpartner' ); ?></h1>
									</header>
										<section class="entry-content">
											<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'screenpartner' ); ?></p>
									</section>
									<footer class="article-footer">
											<p><?php _e( 'This is the error message in the page-custom.php template.', 'screenpartner' ); ?></p>
									</footer>
								</article>

							<?php endif; ?>

						</main>

				</div>

			</div>


<?php get_footer(); ?>
