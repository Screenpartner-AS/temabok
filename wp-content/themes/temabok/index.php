<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="cf">

						<main id="main" class="m-all cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

							<div class="archive-header">
								<div class="wrap cf">
									<h1 class="page-title archive-title"><?php echo __('Articles', 'screenpartner'); ?></h1>

									<?php
									$count = 0;
									$classes = '';
									?>
									<?php echo facetwp_display( 'facet', 'artikkelsok' ); ?>
									<?php echo facetwp_display( 'facet', 'artikkelkategorier' ); ?>
								</div>
							</div>

							<div class="wrap filters-toggle cf">
								<a href="#" class=""><img src="<?php echo get_template_directory_uri(); ?>/library/images/filters-white.svg" alt="Settings Icon"><?php echo __('Filters', 'screenpartner'); ?></a>
							</div>

							<div class="wrap cf">
								<div class="grid-skin facetwp-template facet-archive articles-wrapper">

									<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

										<?php
										$featured_image_url = get_featured_image_url($post->ID, 'large');
										if ($count == 6) {
											$count = 0;
										}
										$count++;
										?>

										<article id="post-<?php the_ID(); ?>" <?php post_class( 'news-article article-' . $count . '  m-1of2 mt-1of2 t-1of3 d-1of4 with-padding' ); ?>>
											<div class="news-content-wrapper">

							          <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
													<div class="thumb">
														<?php if ($featured_image_url) { ?>
						                  <?php echo the_post_thumbnail($post->ID, 'large'); ?>
						                <?php } else { ?>
						                  <img src="<?php echo get_template_directory_uri(); ?>/library/images/fi.png" alt="Featured Image Placeholder">
						                <?php } ?>

														<?php echo sp_get_content_type_tags($post->ID); ?>
														<?php echo sp_article_reading_progress($post->ID); ?>
													</div>

							            <div class="news-content">
							              <h2 class="entry-title news-title"><?php the_title(); ?></h2>
														<?php echo list_post_categories($post->ID); ?>
														<?php the_favorites_button($post->ID, get_current_blog_id()); ?>
							            </div>
							          </a>

											</div>
						        </article>

									<?php endwhile; ?>

									<?php else : ?>

										<article id="post-not-found" class="hentry cf">
												<header class="article-header">
													<h1><?php _e( 'No articles found!', 'screenpartner' ); ?></h1>
											</header>
												<section class="entry-content">
													<p><?php _e( 'No content were found with these search terms. Try double checking things.', 'screenpartner' ); ?></p>
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
