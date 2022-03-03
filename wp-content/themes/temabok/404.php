<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap cf">

					<main id="main" class="m-all t-all d-all cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

						<article id="post-not-found" class="hentry cf">

							<header class="article-header">

								<h1><?php _e( 'Article Not Found', 'screenpartner' ); ?></h1>

							</header>

							<section class="entry-content">

								<p><?php _e( 'We can\'t find the content you were looking for!', 'screenpartner' ); ?></p>

								<p><a href="<?php echo get_site_url(); ?>" class="btn-purple"><?php _e('Go home', 'screenpartner'); ?></a></p>

							</section>

						</article>

					</main>

				</div>

			</div>

<?php get_footer(); ?>
