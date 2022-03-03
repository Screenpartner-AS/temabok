<?php if (current_user_can('edit_quiz')) {
	acf_form_head();
	wp_deregister_style( 'wp-admin' );
} ?>

<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap cf">

					<main id="main" class="cf" role="main" itemscope itemtype="http://schema.org/Blog">

						<input id="article-post-id" type="hidden" value="<?php echo get_the_ID(); ?>">

						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<?php if (sp_is_logged_in_filter_active()) { ?>

								<?php if (is_user_logged_in()) { ?>

									<?php if ( current_user_can('read', get_the_ID()) ) { ?>

										<?php get_template_part('template-parts/content', 'single'); ?>
										<?php echo sp_jump_back_in($post->ID); ?>

									<?php } else { ?>

										<?php get_template_part('template-parts/content', 'single-hidden'); ?>
										<p class="message error"><?php echo __('Your user is no longer able to read this content. Your 30 day trial has expired.', 'screenpartner'); ?></p>
										<?php load_template(TEMPLATEPATH . '/library/modules/layout-sections/simple-log-in-wrap.php'); ?>

									<?php } ?>

								<?php } else { ?>

									<?php get_template_part('template-parts/content', 'single-hidden'); ?>
									<p class="message error"><?php echo __('Please log in to continue reading this article.', 'screenpartner'); ?></p>
									<?php load_template(TEMPLATEPATH . '/library/modules/layout-sections/simple-log-in-wrap.php'); ?>

								<?php } ?>

							<?php } else { ?>

								<?php get_template_part('template-parts/content', 'single'); ?>
								<?php echo sp_jump_back_in($post->ID); ?>

							<?php } ?>

							<?php // sp_display_create_quiz(); ?>

						<?php endwhile; ?>

						<?php else : ?>

							<article id="post-not-found" class="hentry cf">
								<header class="article-header">
									<h1><?php _e( 'Oops, Post Not Found!', 'screenpartner' ); ?></h1>
								</header>
								<section class="entry-content">
									<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'screenpartner' ); ?></p>
								</section>
								<footer class="article-footer">
										<p><?php _e( 'This is the error message in the single.php template.', 'screenpartner' ); ?></p>
								</footer>
							</article>

						<?php endif; ?>

					</main>

					<?php // get_sidebar(); ?>

				</div>

				<div id="bottom-content" class="wrap cf">
					<?php echo sp_related_posts(6); ?>
				</div>

				<?php load_template(TEMPLATEPATH . '/library/modules/page/builder-options.php'); ?>

			</div>

<?php get_footer(); ?>
