<?php
// Content Archive Education
$disciplin_terms = get_the_terms($post->ID, 'student_disciplin');
$grade_terms = get_the_terms($post->ID, 'student_grade');
$subject_terms = get_the_terms($post->ID, 'student_subject');
$education_settings = get_field('education_article_settings');
$short_description = $education_settings['short_description'];
$core_elements = $education_settings['core_elements'];
$core_elements_text = $education_settings['core_elements_text_box'];
$benchmarks = $education_settings['benchmarks'];
$benchmarks_text = $education_settings['benchmarks_text_box'];
?>
<article id="post-<?php the_ID(); ?>" data-education-id="<?php the_ID(); ?>" <?php post_class( 'education-listing m-1of2 t-1of3 d-1of4 with-padding-large cf' ); ?> role="article">

  <a href="javascript:void(0)" class="education-content-wrapper">
    <!-- <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">

    </a> -->
    <div class="thumb">
      <?php if (has_post_thumbnail($post->ID)) { ?>
        <?php the_post_thumbnail('large'); ?>
      <?php } else { ?>
        <img src="<?php echo get_template_directory_uri(); ?>/library/images/fi.png" alt="Featured Image Placeholder">
      <?php } ?>
    </div>

    <div class="education-content">
      <h3 class="entry-title education-title"><?php the_title(); ?></h3>
    </div>
  </a>

  <aside class="education-listing-content" data-education-id="<?php the_ID(); ?>">
    <div class="education-listing-aside-info cf">
      <?php if (!empty($short_description)) { ?>
        <p class="short-desc"><?php echo $short_description; ?></p>
      <?php } ?>
      <div class="education-flex-items">
        <div class="educatiuon-read">
          <h2 style="display: none;">
          <i>
            <svg width="25px" height="16px" viewBox="0 0 25 16" version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink">
              <title>Group</title>
              <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                  <g id="Article-dropdown-information" transform="translate(-313.000000, -441.000000)" stroke="#0B2541" stroke-width="1.5">
                      <g id="Dropdown-info" transform="translate(278.000000, 320.000000)">
                          <g id="Group-2" transform="translate(34.000000, 117.000000)">
                              <g id="Group" transform="translate(2.000000, 5.000000)">
                                  <path d="M11.4984666,0.00125147824 C7.37783851,-0.0692700618 3.11614198,2.85218844 0.436864796,5.84416848 C-0.145621599,6.50022907 -0.145621599,7.49665125 0.436864796,8.15271184 C3.05787461,11.0814299 7.30730432,14.0702987 11.4984666,13.9987401 C15.689629,14.0702987 19.9400809,11.0814299 22.5631352,8.15271184 C23.1456216,7.49665125 23.1456216,6.50022907 22.5631352,5.84416848 C19.8807913,2.85218844 15.6190948,-0.0692700618 11.4984666,0.00125147824 Z" id="Path"></path>
                                  <path d="M15,7.00106674 C14.9994104,9.21006675 13.2082887,11.0003926 10.9992887,11 C8.79028873,10.9996073 6.9998037,9.20864469 7,6.99964461 C7.0001963,4.79064453 8.79099962,3 11,3 C12.0611372,2.99971695 13.078879,3.42119981 13.8291166,4.17163743 C14.5793541,4.92207506 15.0005656,5.93992928 15,7.00106674 L15,7.00106674 Z" id="Path"></path>
                              </g>
                          </g>
                      </g>
                  </g>
              </g>
            </svg>
          </i>  
          <?php echo _e('Lese'); ?></h2>          
          <?php sp_display_read_level_buttons($post->ID); ?>
        </div>
        <?php
          $articleRelated = get_post_meta($post->ID, 'related_articles');
          $parmLang = ValidateStringOnlyNumber($_GET["fwp_lang"], ",");
          if (!empty($parmLang)) $parmLang = "fwp_lang=$parmLang&";
          if ($articleRelated[0]) {
            ?>
              <div class="education-related">
                <!--Related articles-->
                <h2>Relatert innhold</h2>
                <ul>
                  <li><a href="<?php echo get_post_type_archive_link('education')."?".$parmLang."fwp_ids=". urldecode(implode(",", $articleRelated[0])); ?>" target="_blank">Artikler</a></li>
                </ul>
              </div>
            <?php
          }
        ?>
      </div>
      <div class="education-hidden-items">
        <div class="education-info">
          <?php if (!empty($grade_terms)) { ?>
            <!-- <div class="education-info__items grades_info">
              <h4><i>
              <svg width="30" height="31" viewBox="0 0 30 31" fill="none" xmlns="https://www.w3.org/2000/svg">
              <path d="M14.96 15.7627C13.855 13.1127 11.3075 11.349 8.4375 11.2502C4.635 11.2202 1.4125 14.0402 0.9375 17.8127" stroke="#0B2541" stroke-width="1.875" stroke-linecap="round" stroke-linejoin="round"/>
              <path fill-rule="evenodd" clip-rule="evenodd" d="M8.4375 0.936523C10.7675 0.936523 12.6562 2.82527 12.6562 5.15527C12.6562 7.48527 10.7675 9.37402 8.4375 9.37402C6.1075 9.37402 4.21875 7.48527 4.21875 5.15527C4.21875 2.82527 6.1075 0.936523 8.4375 0.936523Z" stroke="#0B2541" stroke-width="1.875" stroke-linecap="round" stroke-linejoin="round"/>
              <path fill-rule="evenodd" clip-rule="evenodd" d="M20.625 0.936523C22.4375 0.936523 23.9062 2.40527 23.9062 4.21777C23.9062 6.03027 22.4375 7.49902 20.625 7.49902C18.8125 7.49902 17.3438 6.03027 17.3438 4.21777C17.3438 2.40527 18.8125 0.936523 20.625 0.936523Z" stroke="#0B2541" stroke-width="1.875" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M25.5 11.2497C23.945 8.55973 20.5038 7.64098 17.815 9.19598C17.2813 9.50473 16.8013 9.89973 16.395 10.3635" stroke="#0B2541" stroke-width="1.875" stroke-linecap="round" stroke-linejoin="round"/>
              <path fill-rule="evenodd" clip-rule="evenodd" d="M20.625 17.8838L12.1875 21.3588L20.625 24.4463L29.0625 21.3588L20.625 17.8838Z" stroke="#0B2541" stroke-width="1.875" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M12.1875 21.3311V26.0461" stroke="#0B2541" stroke-width="1.875" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M15.9375 22.7314V26.6252C15.935 27.0102 16.1688 27.3564 16.5263 27.5002L20.2763 29.0002C20.5 29.0889 20.7488 29.0889 20.9725 29.0002L24.7225 27.5002C25.08 27.3577 25.3138 27.0102 25.3125 26.6252V22.7314" stroke="#0B2541" stroke-width="1.875" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
              </i>Klassetrinn</h4>
              <div class="education-self">
                <?php echo list_post_terms($post->ID, 'student_grade'); ?>
              </div>
            </div> -->
          <?php } ?>
          <?php if (!empty($subject_terms)) { ?>
            <div class="education-info__items subjects_info">
              <h4>
                <i>
                  <svg width="29" height="29" viewBox="0 0 29 29" fill="none" xmlns="https://www.w3.org/2000/svg">
                  <path d="M4.625 0.325195H13.2238C13.7213 0.325195 14.1975 0.522695 14.5487 0.873945L27.125 13.4502" stroke="#0B2541" stroke-width="1.875" stroke-linecap="round" stroke-linejoin="round"/>
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M10.4113 4.0752H2.75C1.715 4.0752 0.875 4.9152 0.875 5.9502V13.6102C0.875 14.1077 1.0725 14.5852 1.42375 14.9364L13.6112 27.1239C14.3437 27.8564 15.53 27.8564 16.2625 27.1252C16.2625 27.1252 16.2625 27.1252 16.2638 27.1239L23.9237 19.4627C24.6562 18.7302 24.6562 17.5439 23.9237 16.8114L11.7362 4.6252C11.385 4.27395 10.9088 4.0752 10.4113 4.0752Z" stroke="#0B2541" stroke-width="1.875" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M6.5 9.23145C6.24125 9.23145 6.03125 9.44145 6.03125 9.7002C6.03125 9.95895 6.24125 10.1689 6.5 10.1689C6.75875 10.1689 6.96875 9.95895 6.96875 9.7002C6.97 9.44145 6.76125 9.2327 6.5025 9.23145C6.50125 9.23145 6.50125 9.23145 6.5 9.23145V9.23145" stroke="#0B2541" stroke-width="1.875" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                </i>
                Fag</h4>
                <div class="education-self">
                    <?php echo list_post_terms($post->ID, 'student_subject', 'sp-term-list'); ?>
                </div>
            </div>
          <?php } ?>
          <?php if ( have_rows('education_article_settings') ): ?>
            <?php while ( have_rows('education_article_settings') ) : the_row();  ?>            
            <div class="education-info__items subjects_info">
              <?php if ($core_elements_text) { ?>
                <h4>
                  <i>
                    <svg width="34px" height="33px" viewBox="0 0 34 33" version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink">
                        <title>Core</title>
                        <g id="Teaching-Path---V3" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                            <g id="New-Teaching-Path---Create-(add-articles)---Filters-opened" transform="translate(-56.000000, -441.000000)" stroke="#0B2541" stroke-width="1.8">
                                <g id="Velg-oppgaver" transform="translate(-1.000000, 77.000000)">
                                    <g id="Sub-Menu" transform="translate(57.000000, 34.000000)">
                                        <g id="Core" transform="translate(2.094144, 331.745181)">
                                            <path d="M12.7629987,14.9061587 C12.7629987,16.089626 13.7223886,17.0490158 14.9058559,17.0490158 C16.0893232,17.0490158 17.048713,16.089626 17.048713,14.9061587 C17.048713,13.7226913 16.0893232,12.7633015 14.9058559,12.7633015 C13.7223886,12.7633015 12.7629987,13.7226913 12.7629987,14.9061587 Z" id="Path"></path>
                                            <path d="M-0.709466334,14.9155337 C-0.709466334,17.9358409 6.28608445,20.3842837 14.9155337,20.3842837 C23.5449829,20.3842837 30.5405337,17.9358409 30.5405337,14.9155337 C30.5405337,11.8952264 23.5449829,9.44678367 14.9155337,9.44678367 C6.28608445,9.44678367 -0.709466334,11.8952264 -0.709466334,14.9155337 Z" id="Path" transform="translate(14.915534, 14.915534) rotate(-45.000000) translate(-14.915534, -14.915534) "></path>
                                            <path d="M9.44678367,14.9155337 C9.44678367,23.5449829 11.8952264,30.5405337 14.9155337,30.5405337 C17.9358409,30.5405337 20.3842837,23.5449829 20.3842837,14.9155337 C20.3842837,6.28608445 17.9358409,-0.709466334 14.9155337,-0.709466334 C11.8952264,-0.709466334 9.44678367,6.28608445 9.44678367,14.9155337 Z" id="Path" transform="translate(14.915534, 14.915534) rotate(-45.000000) translate(-14.915534, -14.915534) "></path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </svg>
                  </i>Kjerneelementer</h4>
                <?php echo $core_elements_text; ?>
              <?php } else { ?>
                <?php if (have_rows('core_elements')) { ?>
                  <h4><i>
                    <svg width="34px" height="33px" viewBox="0 0 34 33" version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink">
                        <title>Core</title>
                        <g id="Teaching-Path---V3" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                            <g id="New-Teaching-Path---Create-(add-articles)---Filters-opened" transform="translate(-56.000000, -441.000000)" stroke="#0B2541" stroke-width="1.8">
                                <g id="Velg-oppgaver" transform="translate(-1.000000, 77.000000)">
                                    <g id="Sub-Menu" transform="translate(57.000000, 34.000000)">
                                        <g id="Core" transform="translate(2.094144, 331.745181)">
                                            <path d="M12.7629987,14.9061587 C12.7629987,16.089626 13.7223886,17.0490158 14.9058559,17.0490158 C16.0893232,17.0490158 17.048713,16.089626 17.048713,14.9061587 C17.048713,13.7226913 16.0893232,12.7633015 14.9058559,12.7633015 C13.7223886,12.7633015 12.7629987,13.7226913 12.7629987,14.9061587 Z" id="Path"></path>
                                            <path d="M-0.709466334,14.9155337 C-0.709466334,17.9358409 6.28608445,20.3842837 14.9155337,20.3842837 C23.5449829,20.3842837 30.5405337,17.9358409 30.5405337,14.9155337 C30.5405337,11.8952264 23.5449829,9.44678367 14.9155337,9.44678367 C6.28608445,9.44678367 -0.709466334,11.8952264 -0.709466334,14.9155337 Z" id="Path" transform="translate(14.915534, 14.915534) rotate(-45.000000) translate(-14.915534, -14.915534) "></path>
                                            <path d="M9.44678367,14.9155337 C9.44678367,23.5449829 11.8952264,30.5405337 14.9155337,30.5405337 C17.9358409,30.5405337 20.3842837,23.5449829 20.3842837,14.9155337 C20.3842837,6.28608445 17.9358409,-0.709466334 14.9155337,-0.709466334 C11.8952264,-0.709466334 9.44678367,6.28608445 9.44678367,14.9155337 Z" id="Path" transform="translate(14.915534, 14.915534) rotate(-45.000000) translate(-14.915534, -14.915534) "></path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </svg>
                  </i>Kjerneelementer</h4>

                  <?php while( have_rows('core_elements') ) : the_row(); ?>
                    <?php $core_element = get_sub_field('core_element'); ?>
                    <p class="text"><?php echo $core_element; ?></p>
                  <?php endwhile; ?>
                <?php } ?>
              <?php } ?>
            </div>      
            <?php endwhile; ?>
          <?php endif; ?>
          <?php if (!empty($disciplin_terms)) { ?>
            <div class="education-info__items subjects_info">
              <h4>
                <i>
                    <svg width="32px" height="32px" viewBox="0 0 32 32" version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink">
                      <title>Cogs</title>
                      <g id="Teaching-Path---V3" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                          <g id="New-Teaching-Path---Create-(add-articles)---Filters-opened" transform="translate(-57.000000, -551.000000)" stroke="#0B2541" stroke-width="1.8">
                              <g id="Velg-oppgaver" transform="translate(-1.000000, 77.000000)">
                                  <g id="Sub-Menu" transform="translate(57.000000, 34.000000)">
                                      <g id="Cogs" transform="translate(2.000000, 441.000000)">
                                          <path d="M8.57081205,11.795825 C8.89625819,12.1551924 9.35847332,12.3601937 9.84329089,12.3601937 C10.3281085,12.3601937 10.7903236,12.1551924 11.1157697,11.795825 L11.9387137,10.8770249 C12.4249035,10.3393549 13.1967242,10.1656465 13.8663693,10.4431806 C14.5360143,10.7207148 14.958702,11.3894867 14.9220499,12.1134674 L14.8603619,13.3394093 C14.8330583,13.8245324 15.0138579,14.2982883 15.3574187,14.641865 C15.7009794,14.9854418 16.1747132,15.1662499 16.6598137,15.138945 L17.8856984,15.0772541 C18.6101193,15.0396013 19.2797003,15.4623869 19.5571706,16.1326521 C19.834641,16.8029172 19.659822,17.5752925 19.1207707,18.0607294 L18.2098885,18.8837118 C17.8497877,19.2087448 17.644257,19.6711406 17.644257,20.15625 C17.644257,20.6413594 17.8497877,21.1037552 18.2098885,21.4287882 L19.1207707,22.2517706 C19.659822,22.7372075 19.834641,23.5095828 19.5571706,24.1798479 C19.2797003,24.8501131 18.6101193,25.2728987 17.8856984,25.2352459 L16.6598137,25.173555 C16.1752846,25.1483614 15.7028031,25.3298504 15.3597265,25.672943 C15.01665,26.0160355 14.8351694,26.4885391 14.8603619,26.9730907 L14.9220499,28.1990326 C14.958702,28.9230133 14.5360143,29.5917852 13.8663693,29.8693194 C13.1967242,30.1468535 12.4249035,29.9731451 11.9387137,29.4354751 L11.1157697,28.516675 C10.7903236,28.1573076 10.3281085,27.9523063 9.84329089,27.9523063 C9.35847332,27.9523063 8.89625819,28.1573076 8.57081205,28.516675 L7.74786802,29.4354751 C7.26167828,29.9731451 6.48985754,30.1468535 5.82021249,29.8693194 C5.15056744,29.5917852 4.72787979,28.9230133 4.76453187,28.1990326 L4.82621986,26.9730907 C4.85057676,26.4887669 4.66882678,26.0167585 4.32594127,25.673857 C3.98305576,25.3309555 3.51106933,25.149197 3.02676809,25.173555 L1.80088338,25.2352459 C1.07693647,25.2718997 0.408195717,24.8491923 0.130674539,24.179516 C-0.146846638,23.5098398 0.0268536833,22.737983 0.564498574,22.2517706 L1.47669331,21.4287882 C1.83604394,21.1033269 2.0410356,20.6410902 2.0410356,20.15625 C2.0410356,19.6714098 1.83604394,19.2091731 1.47669331,18.8837118 L0.564498574,18.0607294 C0.0268536833,17.574517 -0.146846638,16.8026602 0.130674539,16.132984 C0.408195717,15.4633077 1.07693647,15.0406003 1.80088338,15.0772541 L3.02676809,15.138945 C3.51129714,15.1641386 3.98377866,14.9826496 4.32685522,14.639557 C4.66993179,14.2964645 4.85141236,13.8239609 4.82621986,13.3394093 L4.76453187,12.1134674 C4.72787979,11.3894867 5.15056744,10.7207148 5.82021249,10.4431806 C6.48985754,10.1656465 7.26167828,10.3393549 7.74786802,10.8770249 L8.57081205,11.795825 Z" id="Path"></path>
                                          <path d="M7.5,20.15625 C7.5,21.4506674 8.54933262,22.5 9.84375,22.5 C11.1381674,22.5 12.1875,21.4506674 12.1875,20.15625 C12.1875,18.8618326 11.1381674,17.8125 9.84375,17.8125 C8.54933262,17.8125 7.5,18.8618326 7.5,20.15625 L7.5,20.15625 Z" id="Path"></path>
                                          <path d="M23.90625,5.7421875 C23.7120874,5.7421875 23.5546875,5.89958739 23.5546875,6.09375 C23.5546875,6.28791261 23.7120874,6.4453125 23.90625,6.4453125 C24.1004126,6.4453125 24.2578125,6.28791261 24.2578125,6.09375 C24.2578125,5.89958739 24.1004126,5.7421875 23.90625,5.7421875 L23.90625,5.7421875" id="Path"></path>
                                          <path d="M27.2839363,1.43212891 C27.6502744,1.28950499 28.0662824,1.37689742 28.3442621,1.65487567 C28.6222417,1.93285391 28.7096346,2.34885988 28.56701,2.7151961 L27.9063129,4.41450031 C27.7494173,4.8171648 27.8719182,5.2750698 28.2089122,5.54560794 L29.6294108,6.68728667 C29.9357102,6.93323415 30.0678325,7.33687912 29.9662426,7.71633685 C29.8646528,8.09579457 29.548528,8.37943431 29.1603159,8.43944639 L27.3592558,8.71825913 C26.9321256,8.78357073 26.5967353,9.11842444 26.5307417,9.54544766 L26.2519276,11.3478201 C26.1919152,11.7360302 25.908274,12.0521534 25.5288144,12.1537428 C25.1493548,12.2553322 24.7457078,12.1232105 24.4997591,11.8169126 L23.3580746,10.3964212 C23.0873913,10.0596976 22.6299586,9.9367899 22.2269613,10.092502 L20.5276486,10.7531958 C20.1613105,10.8958197 19.7453025,10.8084272 19.4673228,10.530449 C19.1893432,10.2524708 19.1019503,9.83646479 19.244575,9.47012857 L19.905272,7.77082436 C20.0621676,7.36815987 19.9396667,6.91025487 19.6026728,6.63971673 L18.1821742,5.49671661 C17.8764642,5.25096806 17.7447272,4.84787108 17.8463089,4.46901594 C17.9478907,4.0901608 18.2636217,3.80704143 18.651269,3.74719967 L20.4523291,3.46838692 C20.8794661,3.40212664 21.2145826,3.06701181 21.2808432,2.63987701 L21.5596573,0.840147351 C21.6190386,0.451849273 21.9024383,0.135419345 22.2818701,0.0337607747 C22.6613019,-0.0678977955 23.0649429,0.0644579912 23.3105044,0.371054818 L24.4535103,1.79154629 C24.7242925,2.12816614 25.1819327,2.25059497 25.5846236,2.09414401 L27.2839363,1.43212891 Z" id="Path"></path>
                                      </g>
                                  </g>
                              </g>
                          </g>
                      </g>
                  </svg>
                </i>
                <?php echo __('Interdisciplinary Subjects', 'screenpartner'); ?></h4>
                <div class="education-self">
                <?php echo list_post_terms($post->ID, 'student_disciplin', 'sp-term-list'); ?>
                </div>
            </div>
          <?php } ?>        
        </div>
        
        <div class="educations-info-goals">
          <h4>
            <i><svg width="27px" height="30px" viewBox="0 0 27 30" version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink">
              <title>Target</title>
              <g id="Teaching-Path---V3" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                  <g id="New-Teaching-Path---Create-(add-articles)---Filters-opened" transform="translate(-57.000000, -868.000000)" stroke="#0B2541" stroke-width="1.8">
                      <g id="Velg-oppgaver" transform="translate(-1.000000, 77.000000)">
                          <g id="Sub-Menu" transform="translate(57.000000, 34.000000)">
                              <g id="Target" transform="translate(2.000000, 758.000000)">
                                  <line x1="11.6071429" y1="13.3928571" x2="16.9642857" y2="8.03571429" id="Path"></line>
                                  <polygon id="Path" points="16.9642857 8.03571429 17.6217743 3.69490061 21.3814977 0 21.962588 3.03741203 25 3.61850228 21.3050994 7.37822571"></polygon>
                                  <path d="M23.7075533,10.7649357 C25.0522339,15.8625221 22.9281786,21.2425467 18.4639238,24.0465369 C13.9996691,26.8505271 8.23122239,26.4277685 4.22342974,23.0028779 C0.215637089,19.5779873 -1.10142393,13.9457698 0.972017241,9.09869112 C3.04545841,4.25161243 8.02822388,1.31452102 13.2729097,1.84792932" id="Path"></path>
                                  <path d="M18.5658301,12.781234 C19.2076436,15.3692619 18.136969,18.0794912 15.8997289,19.5300119 C13.6624889,20.9805326 10.7514341,20.8518686 8.65087281,19.2096239 C6.5503115,17.5673792 5.72289085,14.773257 6.59050169,12.2519433 C7.45811253,9.73062965 9.82966416,8.03744197 12.4959338,8.03571429" id="Path"></path>
                                  <line x1="6.13839286" y1="24.1071429" x2="5.46875" y2="27.6785714" id="Path"></line>
                                  <line x1="18.8616071" y1="24.1071429" x2="19.53125" y2="27.6785714" id="Path"></line>
                              </g>
                          </g>
                      </g>
                  </g>
              </g>
          </svg></i>Kompetansemål
          </h4>
          <div class="goalsOverly">
          <?php
            global $wpdb;
            $goals_content_raw = $wpdb->get_results("SELECT t_grade.name As grade_name, t_subject.name As subject_name, e_goals.element_desc From wp_2_grep_post_relations gpr
                  Inner Join wp_2_grep_goals_relation ggr On gpr.goal_relation_id = ggr.goal_relation_id
                  Inner Join wp_2_terms t_grade On ggr.grade_id = t_grade.term_id
                  Inner Join wp_2_terms t_subject On ggr.subject_id = t_subject.term_id
                  Inner Join wp_2_grep_elements e_goals On ggr.goal_id = e_goals.element_id And e_goals.element_type = 1
                Where gpr.post_id = $post->ID
                Order By t_grade.term_order, t_subject.name;");

            foreach ($goals_content_raw as $item) {
              ?>
              <div class="goalsInfo">
                <div class="goalsInfo__item">
                  <a href="javascript:void(0)" class="grade"><?php echo $item->grade_name; ?></a>
                  <div class="subject"><?php echo $item->subject_name; ?></div>
                  <div class="goal"><ul><li><?php echo $item->element_desc; ?></li></ul></div>
                </div>
              </div>
              <?php
            }
          ?>
          </div>
        </div>
        <?php if (!empty($disciplin_terms) || (!empty($benchmarks)) || (!empty($grade_terms))) { ?>
          <div class="sp-terms-container" style="display:none">
        <?php } ?>

        <div class="sp-term-section" style="display:none">
          <h4><?php echo __('Interdisciplinary Subjects', 'screenpartner'); ?></h4>
          <?php echo list_post_terms($post->ID, 'student_disciplin', 'sp-term-list'); ?>

          <?php if ( have_rows('education_article_settings') ): ?>
            <?php while ( have_rows('education_article_settings') ) : the_row();  ?>

              <?php if ($core_elements_text) { ?>
                <h4>Kjerneelementer</h4>
                <?php echo $core_elements_text; ?>
              <?php } else { ?>
                <?php if (have_rows('core_elements')) { ?>
                  <h4>Kjerneelementer</h4>

                  <?php while( have_rows('core_elements') ) : the_row(); ?>
                    <?php $core_element = get_sub_field('core_element'); ?>
                    <p class="text"><?php echo $core_element; ?></p>
                  <?php endwhile; ?>
                <?php } ?>
              <?php } ?>

            <?php endwhile; ?>
          <?php endif; ?>

          <?php if (!empty($subject_terms)) { ?>
            <h4>Fag</h4>
            <?php echo list_post_terms($post->ID, 'student_subject', 'sp-term-list'); ?>
          <?php } ?>
        </div>

        <?php if ( have_rows('education_article_settings') ): ?>
          <?php while ( have_rows('education_article_settings') ) : the_row();  ?>
            <div class="sp-term-section benchmarks">
                <h4>Kompetansemål</h4>
                <?php if (!empty($grade_terms)) { ?>
                  <?php echo list_post_terms($post->ID, 'student_grade'); ?>
                <?php } ?>

                <?php if ($benchmarks_text) { ?>
                  <?php echo $benchmarks_text; ?>
                <?php } else { ?>
                  <?php if( have_rows('benchmarks') ) : ?>
                    <?php while( have_rows('benchmarks') ) : the_row(); ?>
                      <?php $benchmark = get_sub_field('benchmark'); ?>
                      <p class="text"><?php echo $benchmark; ?></p>
                    <?php endwhile; ?>
                  <?php endif; ?>
                <?php } ?>
            </div>
          <?php endwhile; ?>
        <?php endif; ?>

        <?php if (!empty($disciplin_terms) || (!empty($benchmarks)) || (!empty($grade_terms))) { ?>
          </div><!-- end .sp-terms-container -->
        <?php } ?>
      </div>
    </div>
    

    <a href="javascript:void(0)" class="close-btn">
      <img src="<?php echo get_template_directory_uri(); ?>/library/images/close-icon-white.svg" alt="<?php echo __('Lukk artikkelvisning', 'screenpartner'); ?>" title="<?php echo __('Lukk artikkelvisning', 'screenpartner'); ?>">
    </a>
  </aside>

</article>
