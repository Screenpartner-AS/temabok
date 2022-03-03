<?php
// Content Publication - Single
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article" itemscope itemprop="blogPost" itemtype="http://schema.org/BlogPosting">

	<header class="article-header entry-header cf">
		<?php load_template(TEMPLATEPATH . '/library/modules/elements/breadcrumbs.php'); ?>
		<h1 class="entry-title single-title" itemprop="headline" rel="bookmark"><?php the_title(); ?></h1>
	</header> <?php // end article header ?>

	<section class="entry-content cf" itemprop="articleBody">
		<?php
		$pdf_file         = get_field( 'pdf_file' );

		echo do_shortcode('[real3dflipbook pdf="' . $pdf_file['url'] . '"]');
		?>
	</section> <?php // end article section ?>

</article> <?php // end article ?>
