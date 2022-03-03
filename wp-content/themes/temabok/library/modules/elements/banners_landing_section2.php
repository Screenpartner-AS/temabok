<?php
    $valuebackground = '';
    $colorwhite = get_sub_field('color_text');
    if (get_sub_field('background_imagen')) {
        $valuebackground = 'url('.get_sub_field('background_imagen').')';
    } else {
        $valuebackground = get_sub_field('background_color');
    }
    $orientacion = get_sub_field('orientation');
    $class = 'secondSection';
    $if_full_height = get_sub_field('if_full_height');
    if ($if_full_height) {
        $class = 'fullCoverSection';
        ?>
        <style>.fullCoverSection{background-size: cover !important;background-position: center !important;}</style>
        <?php
    }
?>

<section class="section <?php echo $class;?>" id="secondSection"  style="background:<?php echo $valuebackground; ?>">
    <div class="sectionHeight">
        <div class="anotherContainer">
            <div class="myFlex">
                <?php 
                    if ($orientacion == 'image-left') {
                        ?>                        
                        <div class="contentImg">
                            <img src="<?php echo get_sub_field('imagen_second'); ?>">
                        </div>
                        <div class="contentText">
                            <div class="content" style="color:<?php echo $colorwhite; ?>">
                                <?php
                                    echo get_sub_field('text_right');
                                ?>	
                            </div>					
                        </div>
                        <?php
                    } else {
                        ?>    
                        <div class="contentText">
                            <div class="content" style="color:<?php echo $colorwhite; ?>">
                                <?php
                                    echo get_sub_field('text_right');
                                ?>	
                            </div>					
                        </div>                    
                        <div class="contentImg">
                            <?php
                                if (get_sub_field('video')) {
                                    ?>
                                <video id="player" class="js-player" playsinline controls data-poster="<?php echo get_sub_field('imagen_second'); ?>">
                                    <source src="<?php echo get_sub_field('video'); ?>" type="video/mp4" />
                                </video>
                                <script>
                                    const player = new Plyr(document.querySelector('.js-player'));
                                </script>
                                    <?php
                                } else {
                                    ?>
                                <img src="<?php echo get_sub_field('imagen_second'); ?>">
                                    <?php
                                }
                            ?>                            
                        </div>
                        <?php
                    }
                ?>
            </div>
        </div>
    </div>
</section>