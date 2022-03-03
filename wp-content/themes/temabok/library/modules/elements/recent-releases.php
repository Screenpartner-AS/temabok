<?php
/********************
* RECENT RELEASES
********************/
$section_title = get_sub_field('section_title');
$number_of_publications = get_sub_field('number_of_publications') ?: 8;
$category = get_sub_field('publication_category');
$slider_or_grid = get_sub_field('slider_or_grid') ?: 'slider';
?>

<div class="recent-releases cf">
	<div class="wrap">

		<?php if ($section_title) { ?>
			<h2 class="module-title"><?php echo $section_title; ?></h2>
		<?php } ?>

		<?php
		$args = array(
			'post_type' => array( 'publication' ),
			'posts_per_page' => $number_of_publications,
			'post_status' => 'publish',
		);

		if ($category) {
			$args['tax_query'] = array(
				array(
					'taxonomy'  => 'publication_category',
					'field'     => 'term_id',
					'terms'     => $category,
				)
			);
		}

		$query = new WP_Query( $args );

		if ( $query->have_posts() ) { ?>

			<div class="recent-releases-<?php echo $slider_or_grid; ?> grid-skin">

				<?php while ( $query->have_posts() ) {
					$query->the_post(); ?>

					<?php $featured_image_url = get_featured_image_url($post->ID, 'sp-thumb-600'); ?>

					<article class="recent-release m-1of2 mt-1of3 t-1of4 d-1of5 with-padding">
						<a class="wc-thumb-wrap" href="<?php echo get_permalink($post->ID); ?>" title="<?php the_title_attribute($post->ID); ?>">
							<?php if ($featured_image_url) { ?>
								<?php echo the_post_thumbnail($post->ID, 'sp-thumb-600'); ?>
							<?php } else { ?>
								<img src="<?php echo get_template_directory_uri(); ?>/library/images/fi.png" alt="Featured Image Placeholder">
							<?php } ?>
						</a>
					</article>

				<?php } ?>

			</div>

		<?php } else {
			_e( 'Sorry, no products matched your criteria.', 'screenpartner' );
		}

		// Restore original Post Data
		wp_reset_postdata(); ?>

		<script type="text/javascript">
		jQuery(document).ready(function($) {
			$('.recent-releases-slider').flickity({
				cellAlign: 'left',
				contain: true,
				imagesLoaded: true,
				prevNextButtons: false,
				pageDots: false,
				autoPlay: true,
				wrapAround: true
			});
		});
		</script>

	</div>
</div>
