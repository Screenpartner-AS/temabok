<?php
/********************
* FACETWP QUERY
********************/

use SebastianBergmann\Environment\Console;

$number_of_posts = get_sub_field('number_of_posts') ?: 8;
$orderby = get_sub_field('order_by') ?: 'date';
$bottom_button = get_sub_field('bottom_button') ?: 'view-all';
$section_title = get_sub_field('section_title') ?: __('Find school articles', 'screenpartner');
?>

<section class="facetwp-query cf">
  <div class="archive-header">
    <div class="wrap cf">
      <h2 class="page-title archive-title"><?php echo $section_title; ?></h2>

      <!---->
      <?php 
        $is_home = true;
        include('article-filter.php'); 
      ?>
			<!---->

    </div>
  </div>

  <div class="wrap cf">
    <div class="articles-loading hide">
        <img src="<?php echo get_template_directory_uri(); ?>/library/images/waiting_grid1.gif" />
    </div>
    <div class="grid-skin-large education-wrap facetwp-template facet-archive articles-wrapper">

      <?php
      //GREP FILTERS
      

      // Custom WP query facetwp_query
      $args_facetwp_query = array(
      	'post_type' => array('education'),
      	'post_status' => array('publish'),
      	'posts_per_page' => $number_of_posts,
      	'order' => 'DESC',
      	'orderby' => $orderby,
        'lang' => '',
        'facetwp' => true
      );

      add_filter('facetwp_query_args', 'sp_change_facetwp_query_for_educational_articles_home', 1000, 2 );
      add_filter('posts_distinct', 'sp_change_distinct_for_educational_articles_home', 1000, 3);
      add_filter('posts_join', 'sp_change_join_for_educational_articles_home', 1000, 4 );
      add_filter('posts_where', 'sp_change_where_for_educational_articles_home', 1000, 5 );
      add_filter('pre_get_posts', 'sp_change_sort_order_for_educational_articles_home', 1000, 6 );

      $facetwp_query = new WP_Query( $args_facetwp_query );

      remove_filter('facetwp_query_args', 'sp_change_facetwp_query_for_educational_articles_home' );
      remove_filter('posts_distinct', 'sp_change_distinct_for_educational_articles_home' );
      remove_filter('posts_join', 'sp_change_join_for_educational_articles_home' );
      remove_filter('posts_where', 'sp_change_where_for_educational_articles_home' );
      remove_filter('pre_get_posts', 'sp_change_sort_order_for_educational_articles_home' );

      function sp_change_facetwp_query_for_educational_articles_home( $query_args, $class ) {
        $query_args['lang'] = '';
        return $query_args;
      }
      function sp_change_distinct_for_educational_articles_home() {
        return "DISTINCT";
      }
      function sp_change_join_for_educational_articles_home ( $join ) {
        global $wpdb;
        $join .= " Inner Join wp_2_grep_post_relations gpr On $wpdb->posts.ID = gpr.post_id ";
        $join .= " Inner Join vw_grep_all_rule_grade ggr On gpr.goal_relation_id = ggr.goal_relation_id ";
        return $join;
      }
      function sp_change_where_for_educational_articles_home( $where = '' ) {
        //GREP FILTERS
        $sepArr = ",";
        $lang_ids = ValidateStringOnlyNumber($_GET['fwp_lang'], $sepArr);
    
        if (empty( $lang_ids )) {
          $term_current_lang = get_term_by('slug', pll_current_language(), 'language');
          $lang_ids = $term_current_lang->term_id;
        }
    
        $where .= " AND ggr.lang_id In ($lang_ids)";

        //Not include source hidden
        global $wpdb;
        $where .= " AND not gpr.post_id In (Select distinct t1_tr.object_id
        From $wpdb->termmeta t1_tm
          Inner Join $wpdb->term_taxonomy t1_tt On t1_tm.term_id = t1_tt.term_id
          Inner Join $wpdb->term_relationships t1_tr On t1_tt.term_taxonomy_id = t1_tr.term_taxonomy_id
        where 
          t1_tm.meta_key = 'hdEASFHideSourceInMAArchive' 
          And t1_tm.meta_value = '1') ";
        //
        
        //GREP FILTERS
        $grade_id = ValidateStringOnlyNumber($_GET['fwp_grade'], $sepArr);
        $subject_ids = ValidateStringOnlyNumber($_GET['fwp_subject'], $sepArr);
        $core_ids = ValidateStringOnlyNumber($_GET['fwp_core'], $sepArr);
        $dicipline_ids = ValidateStringOnlyNumber($_GET['fwp_dicipline'], $sepArr);
        $goal_ids = ValidateStringOnlyNumber($_GET['fwp_goal'], $sepArr);
        $source_ids = ValidateStringOnlyNumber($_GET['fwp_source'], $sepArr);
    
        if ( (!empty( $grade_id )) || (!empty( $subject_ids )) || (!empty( $core_ids )) 
              || (!empty( $dicipline_ids )) || (!empty( $goal_ids )) || (!empty( $source_ids )))
        {
          $sql_query = "SELECT distinct
                          gpr.post_id
                        From vw_grep_all_rule_grade gr
                          Inner Join wp_2_grep_elements e_goal On gr.goal_id = e_goal.element_id And e_goal.element_type = 1
                            Left Join wp_2_grep_elements_relation er_main_topic On gr.goal_relation_id = er_main_topic.goal_relation_id
                              Left Join wp_2_grep_elements e_maint_topic On er_main_topic.element_id = e_maint_topic.element_id And e_maint_topic.element_type = 3
                            Left Join wp_2_grep_elements_relation er_core_element On gr.goal_relation_id = er_core_element.goal_relation_id
                              Left Join wp_2_grep_elements e_core_element On er_core_element.element_id = e_core_element.element_id And e_core_element.element_type = 2 
                          Inner Join wp_2_grep_post_relations gpr On gr.goal_relation_id = gpr.goal_relation_id  ";
          
          if (!empty( $source_ids )) {
            $sql_query = $sql_query . " 
              Left JOIN wp_2_term_relationships tr_source ON gpr.post_id = tr_source.object_id
              Left Join wp_2_term_taxonomy tt_source ON tt_source.term_taxonomy_id = tr_source.term_taxonomy_id and tt_source.taxonomy = 'student_source'
              Left Join wp_2_grep_elements_group e_source On tt_source.term_id = e_source.child_id and e_source.group_type = 3 ";
          }

          $sql_query = $sql_query . "  Where gr.lang_id In ($lang_ids) ";
    
          if (!empty( $grade_id )){
            $sql_query = $sql_query . " And gr.grade_id In ($grade_id) ";
          }
    
          $sql_query = $sql_query . " group by gpr.post_id Having 1 = 1 ";
    
          if (!empty( $subject_ids )){
            $param_subject_list = explode(",", $subject_ids);
            foreach ($param_subject_list as $item) {
                $sql_query = $sql_query . " And Sum(Case When gr.subject_id = ".$item." Then 1 Else 0 End) > 0 ";
            }
          }
    
          if (!empty( $core_ids )){
            $param_core_list = explode(",", $core_ids);
            foreach ($param_core_list as $item) {
                $sql_query = $sql_query . " And Sum(Case When e_core_element.element_id = ".$item." Then 1 Else 0 End) > 0 ";
            }
          }
    
          if (!empty( $dicipline_ids )){
            $param_dicipline_list = explode(",", $dicipline_ids);
            foreach ($param_dicipline_list as $item) {
                $sql_query = $sql_query . " And Sum(Case When e_maint_topic.element_id = ".$item." Then 1 Else 0 End) > 0 ";
            }
          }
    
          if (!empty( $goal_ids )){
            $param_goal_list = explode(",", $goal_ids);
            foreach ($param_goal_list as $item) {
                $sql_query = $sql_query . " And Sum(Case When gr.goal_id = ".$item." Then 1 Else 0 End) > 0 ";
            }
          }
    
          if (!empty( $source_ids )){
            $param_source_list = explode(",", $source_ids);
            foreach ($param_source_list as $item) {
                $sql_query = $sql_query . " And Sum(Case When e_source.group_id = ".$item." Then 1 Else 0 End) > 0 ";
            }
          }
      
          $query_content_raw = $wpdb->get_results($sql_query);
    
          ////
          $post_id_grep_filter = [];
    
          if (count($query_content_raw) > 0) {
            foreach ($query_content_raw as $item) {
                array_push($post_id_grep_filter, $item->post_id);
            }
          }else { 
            array_push($post_id_grep_filter, 0);
          }
    
          $where .= " AND gpr.post_id In (".implode(', ',$post_id_grep_filter).")";
        }
        //END - GREP FILTERS

        return $where;
      }
      function sp_change_sort_order_for_educational_articles_home( $query ) {
          $query->set( 'lang', '' );
      }

      if ( $facetwp_query->have_posts() ) {
      	while ( $facetwp_query->have_posts() ) {
      		$facetwp_query->the_post();
          get_template_part('template-parts/content-education', 'archive');
      	}
      }

      wp_reset_postdata();
      ?>

    </div>

    <?php if ($bottom_button == 'load-more') {
      echo do_shortcode('[facetwp facet="last_flere"]');
    } else if ($bottom_button == 'view-all') {
      echo '<p class="aligncenter"><a href="' . get_post_type_archive_link('education') . '" class="btn-black" title="' . __('View all', 'screenpartner') . '">' . __('View all', 'screenpartner') . '</a></p>';
    } ?>

  </div>
</section>
