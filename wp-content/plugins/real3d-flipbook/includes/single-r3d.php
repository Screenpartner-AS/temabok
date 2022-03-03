<?php 

get_header();
$post_id = get_the_ID();
$id = get_post_meta($post_id, 'flipbook_id', true);
$post_title = get_post_meta($post_id, 'book_title', true);
if(!$post_title) 
	$post_title = get_the_title();
$author = get_post_meta($post_id, 'book_author', true);
$summary = get_post_meta($post_id, 'book_summary', true);
$format = get_post_meta($post_id, 'book_format', true);
$pages = get_post_meta($post_id, 'book_pages', true);
$notation = get_post_meta($post_id, 'book_notation', true);
$publisher = get_post_meta($post_id, 'book_publisher', true);
$date = get_post_meta($post_id, 'book_date', true);
$isbn = get_post_meta($post_id, 'book_isbn', true);
$language = get_post_meta($post_id, 'book_language', true);
$thumb = get_the_post_thumbnail($post_id);
echo do_shortcode('[real3dflipbook id="'.$id.'" mode="lightbox" thumb="" class="r3dfb"]').'
	<main>
		<div class="container">
			<div class="row mb--60">
				<div class="col-lg-5 mb--30">
					<div id="book-image">'.$thumb.'</div>
				</div>
				<div class="col-lg-7">
					<div class="product-details-info">
						<div id="book-author" class="tag-block"><p><b>Par </b>'.$author.'</p></div>
						<div id="book-title"><h3 class="product-title">'.$post_title.'</h3></div>
						<br/>
						<ul class="list-unstyled">
							<li><b> Editeur:</b> <span>'.$publisher.'</span></li>
							<li><b> Date de publication: </b> <span>'.$date.'</span></li>
							<li><b> Langue: </b><span>'.$language.'</span></li>
							<b>ISBN: </b><span>'.$isbn.'</span>
						</ul>
						<article class="product-details-article">
								<h4 class="sr-only">Product Summery</h4>
								<p>'.$summary.'</p>
							</article>

						<p style="font-size: 13px;">


						 <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-card-text" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
						  <path fill-rule="evenodd" d="M14.5 3h-13a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"></path>
						  <path fill-rule="evenodd" d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"></path>
						</svg><span>&nbsp;'.$format.' (format)</span> 


						 &nbsp;&nbsp;&nbsp;<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-book-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
						  <path d="M15.261 13.666c.345.14.739-.105.739-.477V2.5a.472.472 0 0 0-.277-.437c-1.126-.503-5.42-2.19-7.723.129C5.696-.125 1.403 1.56.277 2.063A.472.472 0 0 0 0 2.502V13.19c0 .372.394.618.739.477C2.738 12.852 6.125 12.113 8 14c1.875-1.887 5.262-1.148 7.261-.334z"></path>
						</svg>&nbsp;<span>'.$pages.' (pages)</span>


						&nbsp;&nbsp;&nbsp;<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-clipboard" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
						  <path fill-rule="evenodd" d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"></path>
						  <path fill-rule="evenodd" d="M9.5 1h-3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z"></path>
						</svg>&nbsp;<span>'.$notation.' (notation)</span>

						</p>



						<button type="button" style="background-color:#27ae61;" class="btn btn-success r3dfb">Commencer la lecture</button>
					</div>
				</div>
			</div>
		</div>
	</main>
	';
wp_enqueue_style("r3d-single-css");

get_footer();






