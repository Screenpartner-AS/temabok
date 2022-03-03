		<footer class="footer" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">
			<div id="inner-footer" class="wrap cf">
				<div class="footer-icons">
					<div class="footer-icon">
						<img src="<?php echo get_template_directory_uri(); ?>/library/images/read.svg" alt="Read">
						<h3><?php echo __('Read', 'screenpartner'); ?></h3>
					</div>
					<div class="footer-icon">
						<img src="<?php echo get_template_directory_uri(); ?>/library/images/listen.svg" alt="Listen">
						<h3><?php echo __('Listen', 'screenpartner'); ?></h3>
					</div>
					<div class="footer-icon">
						<img src="<?php echo get_template_directory_uri(); ?>/library/images/learn.svg" alt="Learn">
						<h3><?php echo __('Learn', 'screenpartner'); ?></h3>
					</div>
				</div>
				<?php if ( is_active_sidebar( 'sidebar_footer' ) ) : ?>
					<div class="grid-skin-large">
						<h2 class="footer-title"><?php echo __('Knowledge that entertains – entertainment that educates', 'screenpartner'); ?></h2>
						<?php dynamic_sidebar( 'sidebar_footer' ); ?>
					</div>
					<style type="text/css">
						.grid-skin-large .widget_custom_html ul {display: flex;justify-content: center;}
						.grid-skin-large .widget_custom_html li img { width: 22px;}
						.grid-skin-large .widget_custom_html li {display: block;margin: 0px 5px;}
					</style>
				<?php else : ?>
					<div class="no-widgets">
						<p><?php _e( 'This is a widget ready area. Add some and they will appear here.', 'screenpartner' );  ?></p>
					</div>
				<?php endif; ?>
			</div>
			<div class="source-org copyright">
				<p class="wrap cf">
					&copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?>.
				</p>
			</div>
		</footer>
		<?php load_template(TEMPLATEPATH . '/library/modules/elements/nav-mobile.php'); ?>
	</div>
	<?php // all js scripts are loaded in library/bones.php ?>
	<?php wp_footer(); ?>
</body>
</html> <!-- end of site. what a ride! -->
