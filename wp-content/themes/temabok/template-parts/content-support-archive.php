<?php
// Content Support
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'support-article with-padding' ); ?>>
	<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
		<h3 class="entry-title support-title"><?php the_title(); ?></h3>
		<!-- <div class="sp-support-terms">
			<?php // echo list_post_terms($post->ID, 'support_category', 'sp-support-term'); ?>
		</div> -->
	</a>
</article>
