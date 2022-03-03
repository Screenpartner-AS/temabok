<section class="section firstSection" id="firstSection" style="background:<?php echo get_sub_field('background_first'); ?>">
	<div class="sectionHeight">
		<div class="anotherContainer">
			<div class="myFlex">
				<div class="contentText">
					<div class="content MyContentText" id="MyContentText">
						<div class="myContent">
							<?php
								echo get_sub_field('text_left');
							?>	
						</div>
					</div>
					<div class="buttons">
						<?php
							$btn_text = strtoupper(get_sub_field('btn_feide_text'));
							$show_img = (false !== strpos( $btn_text, 'FEIDE' ));
						?>
						<a href="<?php echo get_sub_field('btn_feide'); ?>" class="btnFeide" style="<?php echo (($show_img) ? '' : 'display:inherit; text-align: center;') ?>">
							<?php 
								if ($show_img) {
							?>
								<img src="<?php echo get_template_directory_uri();?>/library/images/login-btn-icon.aa60f9f3.svg">
							<?php } ?>
							<?php echo get_sub_field('btn_feide_text'); ?>
						</a>
						<?php if(get_sub_field('btn_login')) {?>
						<a href="<?php echo get_sub_field('btn_login'); ?>" class="btnLoginNotFeide">
							<?php echo get_sub_field('btn_login_text'); ?>
						</a>
						<?php } ?>
					</div>					
				</div>
				<div class="contentImg">
					<!-- if slider -->
					<?php
						if (get_sub_field('imagen_is_slider')){
							?>
							<div class="sectionCarouselMain">
								<div class="carouselMain">
									<?php
										$slider = get_sub_field('slider_home');
										if ($slider) {
											foreach ($slider as $slide) {
									?>
									<div class="slideMain" data='<?php echo $slide['text'];?>' background_color="<?php echo $slide['background_color'];?>" background_img="<?php echo $slide['background_img'];?>" links="<?php echo $slide['link'];?>" link_text="<?php echo $slide['link_text'];?>">
										<?php
											if ($slide['video']) {
												?>
										<video src="<?php echo $slide['video'];?>" poster="<?php echo $slide['image'];?>" controls></video>
												<?php
											} else {
												?>
										<img src="<?php echo $slide['image'];?>">
												<?php
											}
										?>
									</div>
									<?php
											}
										}
									?>
								</div>
							</div>
							<script type="text/javascript">
								jQuery(document).ready(function($) {
									<?php
										$btn_text = strtoupper(get_sub_field('btn_feide_text'));
										$show_img = (false !== strpos( $btn_text, 'FEIDE' ));
									?>
									let initialBackground = "<?php echo get_sub_field('background_first'); ?>";	
									let initTemplateButtons = '<a href="<?php echo get_sub_field('btn_feide'); ?>" class="btnFeide" style="<?php echo (($show_img) ? '' : 'display:inherit; text-align: center;') ?>"><?php if ($show_img) { ?><img src="<?php echo get_template_directory_uri();?>/library/images/login-btn-icon.aa60f9f3.svg"><?php } ?><?php echo get_sub_field('btn_feide_text'); ?></a><?php if(get_sub_field('btn_login')) {?><a href="<?php echo get_sub_field('btn_login'); ?>" class="btnLoginNotFeide"><?php echo get_sub_field('btn_login_text'); ?></a><?php } ?>';
								    var $carouselHome = $('.carouselMain').flickity({
								      cellAlign: 'left',
								      contain: true,
								      imagesLoaded: true,
								      prevNextButtons: false,
								      pageDots: true,
								      autoPlay: true,
								      wrapAround: true,
									  autoPlay: 5000 
								    });
									$carouselHome.on( 'change.flickity', function( event, index ) {
									  	let text = $carouselHome.find('.slideMain').eq(index).attr('data');
										let background_color = $carouselHome.find('.slideMain').eq(index).attr('background_color');
										let background_img = $carouselHome.find('.slideMain').eq(index).attr('background_img');										
										let links = $carouselHome.find('.slideMain').eq(index).attr('links');	
										let link_text = $carouselHome.find('.slideMain').eq(index).attr('link_text');	
											
										$carouselHome.closest('.anotherContainer').find('.MyContentText').addClass('chargeText');
										if (background_img.length > 1) {											
											$carouselHome.closest('.firstSection').attr('style','background-image:url('+background_img +')');
										} else {
											if (background_color.length > 1) {
												$carouselHome.closest('.firstSection').attr('style','background:'+background_color);
											} else {							
												$carouselHome.closest('.firstSection').attr('style','background:'+initialBackground);
											}
										}
										if (links.length > 0){
											let templateLinks = '<a href="'+links+'" style="justify-content:center" class="btnFeide">'+link_text+'</a>';
											$carouselHome.closest('.firstSection').find('.buttons').html('');
											$carouselHome.closest('.firstSection').find('.buttons').html(templateLinks);
										} else {
											$carouselHome.closest('.firstSection').find('.buttons').html('');
											$carouselHome.closest('.firstSection').find('.buttons').html(initTemplateButtons);											
										}
									  	setTimeout(function(){
											$carouselHome.closest('.anotherContainer').find('.MyContentText').find('.myContent').html(text);
									  	},300);
									  	setTimeout(function(){
											$carouselHome.closest('.anotherContainer').find('.MyContentText').removeClass('chargeText');
									  	},500);
									});
								});
							</script>
							<?php
						} else {
							?>
						<img src="<?php echo get_sub_field('imagen_first'); ?>">
							<?php
						}
					?>					
				</div>
			</div>
		</div>
	</div>
</section>
