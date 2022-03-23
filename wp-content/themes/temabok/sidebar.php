				<div id="sidebar" class="sidebar cf" role="complementary">

					<?php if ( is_active_sidebar( 'sidebar_main' ) ) : ?>

						<button class="close-sidebar"><?php echo __('Close filters', 'screenpartner'); ?></button>

						<?php dynamic_sidebar( 'sidebar_main' ); ?>

					<?php else : ?>

						<?php
							/*
							 * This content shows up if there are no widgets defined in the backend.
							*/
						?>

						<div class="no-widgets">
							<p><?php _e( 'This is a widget ready area. Add some and they will appear here.', 'screenpartner' );  ?></p>
						</div>

					<?php endif; ?>

				</div>
