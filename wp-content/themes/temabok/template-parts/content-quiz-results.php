<?php
// Content Quiz Results

$uri = $_SERVER['REQUEST_URI']; # Get the the post_id from the url
$post_id = substr( $uri, strpos( $uri, "=" ) + 1 );

$rel_article = get_field('related_article', $post_id);
if ($rel_article) {
  $featured_image_url = get_featured_image_url($rel_article->ID, 'sp-thumb-large');
} else {
  $featured_image_url = '';
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('quiz-results-post cf'); ?> role="article" itemscope itemprop="blogPost" itemtype="http://schema.org/BlogPosting">
  <?php if (!empty($featured_image_url)) { ?>
    <div itemprop="image" itemscope itemtype="http://schema.org/ImageObject">
      <img class="attachment-sp-thumb-large" src="<?php echo $featured_image_url; ?>" alt="">
      <?php $imagesize = getimagesize(get_featured_image_url($rel_article->ID, 'sp-thumb-large')); ?>
      <meta itemprop="width" content="<?php echo $imagesize[0]; ?>">
      <meta itemprop="height" content="<?php echo $imagesize[1]; ?>">
    </div>
  <?php } ?>

  <header class="article-header entry-header">
    <?php load_template(TEMPLATEPATH . '/library/modules/elements/breadcrumbs.php'); ?>
    <h1 class="entry-title single-title" itemprop="headline" rel="bookmark"><?php the_title(); ?></h1>
  </header> <?php // end article header ?>

  <section class="entry-content" itemprop="articleBody">
    <?php if ( current_user_can( 'edit_quiz' ) ) { ?>

      <p class="message"><?php echo __('Following quiz results are from the quiz:', 'screenpartner'); ?>
        <a href="<?php echo get_permalink($post_id); ?>"><?php echo get_the_title($post_id); ?></a>
      </p>

      <?php
      // WP_Query arguments
      $args = array(
      	'post_type' => array( 'quiz_answers' ),
        'meta_query' => array(
					array(
						'key' => 'related_quiz',
						'value' => $post_id,
						'compare' => 'LIKE'
					)
				)
      );

      // The Query
      $answers_query = new WP_Query( $args );

      // The Loop
      if ( $answers_query->have_posts() ) {
        ?>

        <div class="quiz-results">

          <?php
        	while ( $answers_query->have_posts() ) {
        		$answers_query->the_post();

            $answers_id = get_the_ID();
            $name = get_field('name', $answers_id);
            ?>

            <div class="quiz-result">

              <header class="quiz-taker">
                <p class="quiz-taker-name"><?php echo $name; ?></p>
                <a class="quiz-taker-toggle" href="#">
                  <img src="<?php echo get_template_directory_uri(); ?>/library/images/zoom-white.svg" alt="Arrow Down Icon">
                </a>
              </header>

              <div class="quiz-result-content">

                <?php
                $count_q = 0;
            		if( have_rows('questions_and_answers') ):
            	    while ( have_rows('questions_and_answers') ) : the_row();
            			$count_q++;
            			$question = get_sub_field('question');
                  $answers = get_sub_field('answers');
                  $answer_text = get_sub_field('answer_text');
            			?>

            			<?php if ($question) { ?>
                    <h4 class="question"><?php echo $question; ?></h4>
                  <?php } ?>

                    <?php if( have_rows('answers') ): ?>

                      <div class="answers">

                        <?php while ( have_rows('answers') ) : the_row(); ?>

                          <?php
                          $answer = get_sub_field('answer');
                          $correct = get_sub_field('correct');
                          $chosen = get_sub_field('chosen');

                          $a_classes = '';
                          if ($correct) {
                            $a_classes .= ' correct';
                          }

                          if ($chosen) {
                            $a_classes .= ' chosen';
                          }
                          ?>

                          <p class="answer <?php echo $a_classes; ?>"><?php echo $answer; ?></p>

                        <?php endwhile; ?>

                      </div>

                    <?php endif; ?>

                  <?php if ($answer_text) { ?>
                    <div class="answer-text">
                      <?php echo $answer_text; ?>
                    </div>
                  <?php } ?>

            			<?php
            	    endwhile;
            		endif;
            		?>

              </div>

            </div>

            <?php
        	}
          ?>

        </div><!-- end .quiz-results -->

        <?php
      } else {
      	// no posts found
      }

      // Restore original Post Data
      wp_reset_postdata();

    } else { ?>
      <p class="message error">Du har ikke tilgang til denne quizen.</p>
    <?php } ?>
  </section> <?php // end article section ?>

</article> <?php // end article ?>
