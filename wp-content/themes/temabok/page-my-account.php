<?php
/*
 Template Name: My account
 *
*/
$form_ids = get_field('map_ninja_forms', 'option');
?>

<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="cf">

						<main id="main" class="cf" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

								<?php if (is_user_logged_in()) { ?>

									<div class="wrap">
										<div class="grid-skin-large">
											<div class="with-padding-large m-all t-all d-all entry-content">

												<?php echo sp_my_account_navigation(); ?>

												<div id="account-tabs">
													<ul class="nav">
														<li><a href="#favoritter" class="current">Mine favoritter</a></li>
											      <li><a href="#sist-leste">Siste leste artikler</a></li>
											      <li><a href="#profile">Rediger profil</a></li>
											      <li><a href="#settings">Handlinger</a></li>
													</ul>

													<div class="list-wrap">
														<ul class="tab-content" id="favoritter">
									          	<li><?php sp_get_recent_user_favorites(); ?></li>
									          </ul>

									          <ul class="tab-content hide" id="sist-leste">
									          	<li><?php sp_get_recent_user_reads(); ?></li>
									          </ul>

									          <ul class="tab-content hide" id="profile">
									          	<li class="entry-content">
																<?php $user = wp_get_current_user(); ?>
																<?php if (in_array('teacher', (array) $user->roles) || in_array('student', (array) $user->roles)) { ?>
																	<?php echo do_shortcode('[ninja_form id=' . $form_ids["edit_profile_feide"] . ']'); ?>
																<?php } else { ?>
																	<?php echo do_shortcode('[ninja_form id=' . $form_ids["edit_profile"] . ']'); ?>
																<?php } ?>
															</li>
									          </ul>

									          <ul class="tab-content hide" id="settings">
									          	<li class="entry-content">
																<p><?php sp_the_delete_user_reads_button(); ?></p>
																<p><?php the_clear_favorites_button(get_current_blog_id()); ?></p>
																<p><a class="btn-purple" href="<?php echo wp_logout_url( get_site_url() ); ?>"><?php echo __('Logout', 'screenpartner'); ?></a></p>
															</li>
									          </ul>
													</div>
												</div>

											</div>
										</div>
									</div>

								<?php } else { ?>

									<?php load_template(TEMPLATEPATH . '/library/modules/layout-sections/log-in-forms.php'); ?>

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
