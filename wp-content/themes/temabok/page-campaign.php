<?php
/*
 Template Name: Campaign
 *
*/
?>

<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="cf">

						<main id="main" class="cf" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

								<article id="post-<?php the_ID(); ?>" <?php post_class( 'campaign-article cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

									<?php
									$bg_image = get_field('campaign_background_image');
									$form_title = get_field('campaign_form_title');
									$form_sub_title = get_field('campaign_form_sub_title');
									$description_image = get_field('campaign_description_image');
									$campaign_description = get_field('campaign_description');
									?>

									<?php if ($bg_image) { ?>
										<div class="campaign-background-image" style="background-image: url('<?php echo $bg_image['url']; ?>'); ?>"></div>
									<?php } ?>

									<div class="campaign-wrapper cf">
										<div class="left-column campaign-member-form">

											<a class="campaign-logo" href="<?php echo get_site_url(); ?>" rel="home" itemprop="url">
												<img src="<?php echo get_template_directory_uri() . '/library/images/bokasin_logo_med_ikon.svg'; ?>" class="custom-logo" alt="Bokasin – Spennende temabøker" itemprop="logo">
											</a>

											<?php if ($form_title) { ?>
												<h2><?php echo $form_title; ?></h2>
											<?php } ?>

											<?php if ($form_sub_title) { ?>
												<?php echo $form_sub_title; ?>
											<?php } ?>

											<img class="arrow-down" src="<?php echo get_template_directory_uri(); ?>/library/images/arrow-down.svg" alt="Arrow down">

											<?php the_content(); ?>
										</div>

										<div class="right-column campaign-description">
											<?php if ($description_image) { ?>
												<img src="<?php echo $description_image['sizes']['large']; ?>" alt="<?php echo $description_image['alt']; ?>">
											<?php } ?>

											<?php if ($campaign_description) { ?>
												<div class="campaign-text">
													<?php echo $campaign_description; ?>
												</div>
											<?php } ?>
										</div>
									</div>

								</article>

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
