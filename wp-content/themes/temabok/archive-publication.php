<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="cf">

						<main id="main" class="cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

							<div class="archive-header">
								<div class="wrap cf">
									<h1 class="page-title archive-title"><?php echo __('Theme Books', 'screenpartner'); ?></h1>

									<?php
									$count = 0;
									$classes = '';
									?>
									<?php echo facetwp_display( 'facet', 'publications_search' ); ?>
									<?php echo facetwp_display( 'facet', 'publication_categories' ); ?>
								</div>
							</div>

							<div class="wrap filters-toggle cf">
								<a href="#" class=""><img src="<?php echo get_template_directory_uri(); ?>/library/images/filters-white.svg" alt="Settings Icon"><?php echo __('Filters', 'screenpartner'); ?></a>
							</div>

							<div class="wrap cf">
								<div class="grid-skin-x-large publications-wrap facetwp-template facet-archive articles-wrapper">

									<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

										<article id="post-<?php the_ID(); ?>" <?php post_class( 'publication-listing m-1of2 t-1of4 d-1of4 with-padding-x-large cf' ); ?> role="article">

											<div class="thumb-wrap">
												<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
													<?php the_post_thumbnail('large'); ?>
												</a>
											</div>

										</article>

									<?php endwhile; ?>

									<?php else : ?>

										<article id="post-not-found" class="hentry cf">
											<header class="article-header">
												<h1><?php _e( 'Oops, Post Not Found!', 'screenpartner' ); ?></h1>
											</header>
											<section class="entry-content">
												<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'screenpartner' ); ?></p>
											</section>
										</article>

									<?php endif; ?>

								</div>

								<?php echo do_shortcode('[facetwp facet="last_flere"]'); ?>

							</div>

						</main>

				</div>

			</div>

<?php get_footer(); ?>
