<?php 
wp_enqueue_style('select2-css', get_stylesheet_directory_uri() . '/library/select2/4/select2.min.css', false);
wp_enqueue_script('select2-js', get_template_directory_uri() . '/library/select2/4/select2.full.min.js', array ( 'jquery' ), 1.1, true);
wp_enqueue_style('searc-articles-css', get_stylesheet_directory_uri() . '/library/css/search-articles.css?v=0.18', false);
?>
<?php

$btn_filter_img = get_template_directory_uri()."/library/images/education-article/filter.svg";
$btn_filter_text = "Filter";
$btn_filter_class = "";

if ((! empty( $_GET['fwp_grade'] )) || !(empty($_GET['fwp_subject'])) || !(empty($_GET['fwp_core']))
	|| !(empty($_GET['fwp_dicipline'])) || !(empty($_GET['fwp_goal'])) || !(empty($_GET['fwp_source'])) || !(empty($_GET['fwp_lang'])) ){
    $btn_filter_img = get_template_directory_uri()."/library/images/education-article/filter_white.svg";
    $btn_filter_text = "Endre filter";
    $btn_filter_class = "active";
}
$term_current_lang = get_term_by('slug', pll_current_language(), 'language');
$current_lang = $term_current_lang->term_id;

$parm_filter_lang = $current_lang;
if (!(empty($_GET['fwp_lang']))){ $parm_filter_lang = $_GET['fwp_lang']; }
?>
<?php 
if (empty($_GET['fwp_ids'])){
?>
	<div class="row-parameters">
		<div class="col-box">
			<button class="btn-filter <?php echo $btn_filter_class; ?>" onclick="filter_show(true);">
				<img src="<?php echo $btn_filter_img; ?>"><span><?php echo $btn_filter_text; ?></span>
			</button>
		</div>
		<div class="col-box">
			<?php echo facetwp_display( 'facet', 'education_search' ); ?>
		</div>
	</div>
<?php 
}
?>

<!---->
<div id="dvFilterPanel" class="FiltersModal <?php if ($is_home) echo "home"; ?>" style="display:none">
    <div class="FiltersModal__header">
		<h5>FILTER</h5>
       	<button onclick="filter_reset()"><img src="<?php echo get_template_directory_uri(); ?>/library/images/education-article/reset.svg"><span>Tilbakestill filter</span></button>
    </div>
    <div class="FiltersModal__body">
		<div class="FiltersModal__body__item">
            <div class="itemFilter">
                <div class="itemFilter__left">
                    <img src="<?php echo get_template_directory_uri(); ?>/library/images/education-article/lang.svg">
                </div>
                <div class="itemFilter__right">
                    <h3>Språk</h3>
                    <div class="languageItems flexFilter">
					<?php
						// $list_arr_subjects = get_terms('language', array('orderby' => 'term_order', 'hide_empty' => false,));
						$list_arr_subjects = $wpdb->get_results("SELECT distinct w2_t.term_id, w2_t.name
																		From wp_2_term_taxonomy w2_tt 
																			Inner Join wp_2_terms w2_t On w2_t.term_id = w2_tt.term_id
																			Inner Join wp_2_grep_goals_relation ggr On ggr.lang_id = w2_t.term_id
																			Inner Join wp_2_grep_post_relations gpr On ggr.goal_relation_id = gpr.goal_relation_id
																		where w2_tt.taxonomy = 'language'
																		Order By w2_t.term_order;");

						$lang_param_array = explode (",", $parm_filter_lang);

						foreach ($list_arr_subjects as $term) {
							$class_active = "";
							if (in_array($term->term_id, $lang_param_array)) $class_active = "active";
							if ($current_lang == $term->term_id) $class_active .= " jq-current-lang";
							?>
							<button value="<?php echo $term->term_id; ?>" class="itemFlexFilter jq-filter-lang <?php echo $class_active; ?>"><?php echo $term->name; ?></button>
							<?php
						}
					?>
					</div>
                </div>
            </div>
        </div>
        <div class="FiltersModal__body__item">
            <div class="itemFilter">
                <div class="itemFilter__left">
                    <img src="<?php echo get_template_directory_uri(); ?>/library/images/education-article/grade.svg">
                </div>
                <div class="itemFilter__right">
                    <h3><?php echo __('Grades', 'screenpartner'); ?></h3>
                    <div class="gradesItems flexFilter"><img src="<?php echo get_template_directory_uri(); ?>/library/images/waiting_grid1.gif"  /></div>
                </div>
            </div>
        </div>
		<div id="dvGradeSubOption" class="FiltersModal__body__item" style="display:none;">
            <div class="itemFilter">
                <div class="itemFilter__left" style="margin-left:20px;">&nbsp;</div>
                <div class="itemFilter__right">
                    <div class="gradeSubOptionItems flexFilter">
					</div>
                </div>
            </div>
        </div>
        <div class="FiltersModal__body__item">
            <div class="itemFilter">
                <div class="itemFilter__left">
                    <img src="<?php echo get_template_directory_uri(); ?>/library/images/education-article/subject.svg">
                </div>
                <div class="itemFilter__right">
                    <h3><?php echo __('Subjects', 'screenpartner'); ?></h3>
                    <div class="subjectsItems flexFilter"><img src="<?php echo get_template_directory_uri(); ?>/library/images/waiting_grid1.gif"  /></div>
                </div>
            </div>
        </div>
        <div class="FiltersModal__body__item">
            <div class="itemFilter">
                <div class="itemFilter__left">
                    <img src="<?php echo get_template_directory_uri(); ?>/library/images/education-article/core.svg">
                </div>
                <div class="itemFilter__right">
                    <h3>Kjerneelementer</h3>
                    <div class="coreElementItems flexFilter"><img src="<?php echo get_template_directory_uri(); ?>/library/images/waiting_grid1.gif"  /></div>
                </div>
            </div>
        </div>
        <div class="FiltersModal__body__item">
            <div class="itemFilter">
                <div class="itemFilter__left">
                    <img src="<?php echo get_template_directory_uri(); ?>/library/images/education-article/dicipline.svg">
                </div>
                <div class="itemFilter__right">
                    <h3>Tverrfaglig tema</h3>
                    <div class="diciplineItems flexFilter"><img src="<?php echo get_template_directory_uri(); ?>/library/images/waiting_grid1.gif"  /></div>
                </div>
            </div>
        </div>
        <div class="FiltersModal__body__item">
            <div class="itemFilter">
                <div class="itemFilter__left">
                    <img src="<?php echo get_template_directory_uri(); ?>/library/images/education-article/goal.svg">
                </div>
                <div class="itemFilter__right">
                    <h3>Kompetansemål</h3>
                    <div class="goalsItems flexFilter"><img src="<?php echo get_template_directory_uri(); ?>/library/images/waiting_grid1.gif"  /></div>
                </div>
            </div>
        </div>
        <div id="dvFilterSource" class="FiltersModal__body__item" style="display:none;">
            <div class="itemFilter">
                <div class="itemFilter__left">
                    <img src="<?php echo get_template_directory_uri(); ?>/library/images/education-article/source.svg">
                </div>
                <div class="itemFilter__right">
					<h3>Kilde</h3>
                    <div class="sourceItems flexFilter"><img src="<?php echo get_template_directory_uri(); ?>/library/images/waiting_grid1.gif"  /></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="filtersModalBackground hide"></div>
<!---->
<script language = "javascript" type = "text/javascript">
	var current_lang = '<?php echo $current_lang; ?>';
	var filter_panel_arr = [];
	var filter_lang = ['<?php echo str_replace(",", "','", $parm_filter_lang); ?>'], filter_grade = [], filter_subject = [], filter_core = [];
	var filter_dicipline = [], filter_goals = [], filter_source = [], filter_ids = [];
	var data_grep_json = {};
	var exist_filter = false;
	var grade_parent_id = "";
	var grade_child_name = "";
	var timeOutFilter;

	jQuery(document).ready(function($) {
		$(document).on('facetwp-refresh', function() { 
			clearTimeout(timeOutFilter);

			$(".facetwp-facet-education_search").addClass("is-loading");
			$(".facetwp-icon").addClass("f-loading");
			$(".articles-loading").removeClass("hide");

			//FWP.is_reset = true;

			FWP.facets['grade'] = filter_grade;
			FWP.facets['subject'] = filter_subject;
			FWP.facets['core'] = filter_core;
			FWP.facets['dicipline'] = filter_dicipline;
			FWP.facets['goal'] = filter_goals;
			FWP.facets['lang'] = filter_lang;
			FWP.facets['source'] = filter_source;
			FWP.facets['ids'] = filter_ids;
		});

		$(document).on('facetwp-loaded', function() { 
			//$(".btn-filter").show();
			$(".facetwp-facet-education_search").removeClass("is-loading");
			$(".facetwp-icon").removeClass("f-loading");
			$(".articles-loading").addClass("hide");

			$("#dvArticlesShowMore").css("display", ($("#spArticlesShowMore").text() == "1") ? "" : "none");
		});

		$(".FiltersModal").addClass("trans");

		$(document).on('click',function(event) {
			if (!$(event.target).closest(".FiltersModal").length 
				&& !$(event.target).closest(".btn-filter").length) {
				if ($(".FiltersModal").hasClass("open")){ 
					if (!$(event.target).closest(".select2-selection__choice__remove").length){
						filter_show(true);
					}
				}
			}
		});

		$("#dvFilterPanel").css("display","");

		$( ".jq-filter-lang" ).on( "click", function(event, refresh) {
			if ($(this).hasClass("active")){ 
				if (filter_lang.length == 1) {return;}
			} else{
				$( ".jq-filter-lang" ).removeClass("active");
				$(this).addClass("active"); 
			}

			filter_lang = [];
			var lang_id = $(this).val();
			filter_lang.push(lang_id);

			set_lang_click(false);
		});

		var queryString = document.location.search;
		exist_filter = (queryString);

		set_lang_click(true);
	});
	function set_lang_click(first_load){
		jQuery(document).ready(function($) {
			if (!first_load) {
				window.stop();
				var imgWaiting = '<img src="<?php echo get_template_directory_uri(); ?>/library/images/waiting_grid1.gif"  />';
				$(".gradesItems").empty();
				$(".gradesItems").append(imgWaiting);
				$(".gradeSubOptionItems").empty();
				$("#dvGradeSubOption").css("display", "none");
				$(".subjectsItems").empty();
				$(".subjectsItems").append(imgWaiting);
				$(".coreElementItems").empty();
				$(".coreElementItems").append(imgWaiting);
				$(".diciplineItems").empty();
				$(".diciplineItems").append(imgWaiting);
				$(".goalsItems").empty();
				$(".goalsItems").append(imgWaiting);
				$(".sourceItems").empty();
				$(".sourceItems").append(imgWaiting);
				
				filter_articles();
			}
			
			var data_found_gred = data_grep_json[get_data_grep_name()];

			if (typeof data_found_gred != 'undefined'){
				set_data_grep_panel(data_found_gred, first_load);
			} else {
				$.ajax({
					url: '<?php echo get_rest_url( null, 'filterarticlepanel/v1/get/?hs=1&lc='.$current_lang ) ?>&lang=' + filter_lang.join(),
					method: 'GET',
					dataType: 'json',
					contentType: 'application/json; charset=utf-8',
					success: function (dataSubjectFound) { set_data_grep_panel(dataSubjectFound, first_load); } 
				});
			}
		});
	}
	function set_parm_after_change_lang(first_load){
		jQuery(document).ready(function($) {
			let continueReviewFilters = true;
			setTimeout(function(){
				var queryString = document.location.search;
				var urlParams = new URLSearchParams(queryString);

				if (first_load){
					if ( queryString && queryString.indexOf( 'fwp_ids' ) !== -1 ) {
						var list_id = decodeURI(urlParams.get('fwp_ids')).split(",");
						$.each( list_id, function( i, paramId ) {
							filter_ids.push(paramId);
						});
					}
				}

				if ( queryString && queryString.indexOf( 'fwp_grade' ) !== -1 ) {
					var list_grades = decodeURI(urlParams.get('fwp_grade')).split(",");
					var grade_arr = filter_panel_arr["grade_filter"];
					if (list_grades.length == 1) {
						const grade_id = list_grades[0];
						var item_grade = grade_arr.find(o => o.grade_id === grade_id);
						if ( typeof item_grade == 'undefined' ){
							continueReviewFilters = false;
							filter_grade = [];
							call_all_get_filter();
							filter_articles(100);
						} else {
							if (item_grade["grade_parent"] != null){ // is child
								if (grade_parent_id == "") { grade_parent_id = item_grade["grade_parent"][0]; }
								if (grade_child_name == "") { grade_child_name = item_grade["name_sub"].split(":")[0]; }

								click_in_elements_objs($,".jq-filter-grade", grade_parent_id, 0);
								click_in_elements_objs($,".jq-gradesub", grade_child_name, 500);
							} else {
								click_in_elements_objs($,".jq-filter-grade", grade_id, 0);
							}
						}
					} else {
						var grade_arr = filter_panel_arr["grade_filter"];
						var item_grade = grade_arr.find(o => o.grade_id === grade_parent_id && o.grade_parent == null);

						if ( typeof item_grade == 'undefined' && grade_parent_id != "" ){
							continueReviewFilters = false;
							filter_grade = [];
							call_all_get_filter();
							filter_articles(100);
						} else {
							$.each( list_grades, function( i, paramGrade ) {
								var item_grade_find = grade_arr.find(o => o.grade_id === paramGrade && o.grade_parent != null);
								if ( typeof item_grade_find != 'undefined' ){
									if (grade_parent_id == "") { grade_parent_id = item_grade_find["grade_parent"][0]; }
									if (grade_child_name == "") { grade_child_name = item_grade_find["name_sub"].split(":")[0]; }

									click_in_elements_objs($,".jq-filter-grade", grade_parent_id, 0);
									click_in_elements_objs($,".jq-gradesub", grade_child_name, 500);
									return false;
								}
							});
						}
					}
				}

				setTimeout(function(){
					if (continueReviewFilters && queryString && queryString.indexOf( 'fwp_subject' ) !== -1) {
						var all_subject_exists = true;
						var list_subjects = decodeURI(urlParams.get('fwp_subject')).split(",");
						var subject_arr = filter_panel_arr["subject_filter"];
						filter_subject_new = [];

						$.each( list_subjects, function( i, paramSubject ) {
							var item_subject_find = subject_arr.find(o => o.subject_id === paramSubject);
							if ( typeof item_subject_find != 'undefined' ){
								filter_subject_new.push(paramSubject);
							} else { all_subject_exists = false; }
						});

						if (first_load){
							$.each( filter_subject_new, function( i, paramSubject ) {
								$.each( $(".jq-filter-subject"), function( i, item ) {
									if ($(item).val() == paramSubject){
										$(item).trigger( "click", [ false ] );
										return false;
									}
								});
							});
						}

						if (!all_subject_exists){
							continueReviewFilters = false;
							filter_subject = filter_subject_new;
							filter_articles(100); 
						}
					}

					setTimeout(function(){
						if (first_load) {
							//core elements
							if ( queryString && queryString.indexOf( 'fwp_core' ) !== -1 ) {
								var list_core = decodeURI(urlParams.get('fwp_core')).split(",");
								$.each( list_core, function( i, paramCore ) {
									var data = { "id": paramCore, "text": "", "refresh_search": false };
									var obj = { params: { data: data } };
									select_core_element(obj, true);
								});

								$('.jq-core-elements').val(list_core);
								$('.jq-core-elements').trigger('change');
							}
							//end - core elements
						}

						setTimeout(function(){
							if (continueReviewFilters && queryString && queryString.indexOf( 'fwp_dicipline' ) !== -1) {
								let allDisciplineExists = true;
								var list_dicipline = decodeURI(urlParams.get('fwp_dicipline')).split(",");
								var discipline_arr = filter_panel_arr["multidisciplinay_filter"];
								filter_discipline_new = [];

								$.each( list_dicipline, function( i, paramDiscipline ) {
									var item_discipline_find = discipline_arr.find(o => o.main_topic_id === paramDiscipline);
									if ( typeof item_discipline_find != 'undefined' ){
										filter_discipline_new.push(paramDiscipline);
									} else { allDisciplineExists = false; }
								});


								if (first_load) {
									//dicipline
									$.each( filter_discipline_new, function( i, paramDicipline ) {
										$.each( $(".jq-filter-dicipline"), function( i, item ) {
											if ($(item).val() == paramDicipline){
												$(item).trigger( "click", [ false ] );
												return false;
											}
										});
									});
									//end - dicipline
								}

								if (!allDisciplineExists){ 
									filter_dicipline = filter_discipline_new;
									filter_articles(100); 
								}
							}

							setTimeout(function(){
								if (first_load) {
									//goals
									if ( queryString && queryString.indexOf( 'fwp_goal' ) !== -1 ) {
										var list_goals = decodeURI(urlParams.get('fwp_goal')).split(",");
										$.each( list_goals, function( i, paramGoal ) {
											var data = { "id": paramGoal, "text": "", "refresh_search": false };
											var obj = { params: { data: data } };
											select_goal(obj, true);
										});

										$('.jq-goals').val(list_goals);
										$('.jq-goals').trigger('change');
									}
									//end - goals
								}
								setTimeout(function(){
									if (continueReviewFilters && queryString && queryString.indexOf( 'fwp_source' ) !== -1) {
										let allSourceExists = true;
										var list_source = decodeURI(urlParams.get('fwp_source')).split(",");
										var source_arr = filter_panel_arr["source_filter"];
										filter_source_new = [];

										$.each( list_source, function( i, paramSource ) {
											var item_source_find = source_arr.find(o => o.term_id === paramSource);
											if ( typeof item_source_find != 'undefined' ){
												filter_source_new.push(paramSource);
											} else { allSourceExists = false; }
										});

										if (first_load) {
											//source
											$.each( filter_source_new, function( i, paramSource ) {
												$.each( $(".jq-filter-source"), function( i, item ) {
													if ($(item).val() == paramSource){
														$(item).trigger( "click", [ false ] );
														return false;
													}
												});
											});
											//end - source
										}

										if (!allSourceExists){ 
											filter_source = filter_source_new;
											filter_articles(100); 
										}
									}
								}, 300);
							}, 300);
						}, 300);
					}, 300);
				}, 300);
			}, 300);
		});
	}
	function call_all_get_filter() {
		get_parameters_subject();
		get_parameters_core_elements();
		get_parameters_dicipline();
		get_parameters_goals();
		get_parameters_source();
	}
	function click_in_elements_objs($, collectionClassName, valueFind, timerCount){
		setTimeout(function(){ 
			$.each( $(collectionClassName), function( i, item ) {
				if ($(item).val() == valueFind){
					$(item).trigger( "click", [ false ] );
					return false;
				}
			});
		}, timerCount);
	}
	function get_data_grep_name(){
		var key = filter_lang.sort().join();
		return key.replace(/ /g, '_');
	}
	function find_element_data_grep($, name_filter, itemFind, typeFilter) {
		var item_return;

		$.each( data_grep_json, function( i, itemPanelGrepArr ) {
			var item_filter_arr = itemPanelGrepArr[name_filter];
			var item_arr;
			if (typeFilter == 1) item_arr = item_filter_arr.find(o => o.goal_id === itemFind);
			if (typeFilter == 2) item_arr = item_filter_arr.find(o => o.core_element_id === itemFind);

			if ( typeof item_arr != 'undefined' ){
				item_return = item_arr;
				return false;
			}
		});

		return item_return;
	}
	function set_data_grep_panel(dataSubjectFound, first_load){
		jQuery(document).ready(function($) {
			var key = filter_lang.join();
			data_grep_json[get_data_grep_name()] = dataSubjectFound;

			filter_panel_arr = dataSubjectFound;

			//
			var source_arr = filter_panel_arr["source_filter"];
			if (typeof source_arr != 'undefined' && source_arr != null){
				if (source_arr.length > 0){ $("#dvFilterSource").css("display", "")};
			}

			var grade_arr = filter_panel_arr["grade_filter"];
			if (typeof grade_arr != 'undefined'){
				var grade_html = "";

				$.each( grade_arr, function( i, item ) {
					if (item["grade_parent"] == null){
						grade_html = grade_html + '<button value="'+item["grade_id"]+'" class="itemFlexFilter jq-filter-grade">'+item['description']+'</button>';
					}
				});

				$(".gradesItems").empty();
				$(".gradesItems").append(grade_html);

				set_grade_click();

				call_all_get_filter();
				
				set_parm_after_change_lang(first_load);

				highLightGradeSubject();
			}

			exist_filter = false;
		});
	}
	function set_grade_click(){
		jQuery(document).ready(function($) {
			$( ".jq-filter-grade" ).unbind( "click" );
			$( ".jq-filter-grade" ).on( "click", function(event, refresh) {
				if ($(this).hasClass("active")){ 
					$(this).removeClass("active"); 
				}else{ 
					$( ".jq-filter-grade" ).removeClass("active");
					$(this).addClass("active");
				}

				//all clean
				if (!$(this).hasClass("jq-gradesub")){
					$("#dvGradeSubOption").css("display", "none");
				}
				
				$(".subjectsItems").empty();
				$(".coreElementItems").empty();
				$(".diciplineItems").empty();
				$(".goalsItems").empty();
				$(".sourceItems").empty();

				filter_grade = [];
				//

				var grade_id = $(this).val();

				if ($(this).hasClass("active")){ 
					if ($(this).hasClass("jq-gradesub")){
						grade_child_name = $(this).val();
						get_group_grade(grade_id);
					}else{
						grade_parent_id = grade_id;
						get_child_grade(grade_id, true, true);
					}
				}
				//

				call_all_get_filter();

				highLightGradeSubject();

				if (typeof refresh == 'undefined'){ filter_articles();}
			});

		});
	}
	function get_group_grade(name_group){
		jQuery(document).ready(function($) {
			var grade_arr = filter_panel_arr["grade_filter"];
			$.each( grade_arr, function( i, item ) {
				var list_grades_allow_arr = item["grade_parent"];
				if (list_grades_allow_arr != null){
					if (list_grades_allow_arr.includes(grade_parent_id)){

						var grade_sub_name = item["name_sub"];
						var grade_sub_name_lst = grade_sub_name.split(":");

						if (grade_sub_name_lst.includes(name_group)){
							filter_grade.push(item["grade_id"]);
						}
					}
				}
			});
		});
	}
	function get_lst_child_grade(grade_id_parent, $){
		var lst_childs = [];

		var grade_arr = filter_panel_arr["grade_filter"];
		$.each( grade_arr, function( i, item ) {
			if (item["grade_parent"] != null){
				var list_grades_allow_arr = item["grade_parent"];
				if (list_grades_allow_arr.includes(grade_id_parent)){
					lst_childs.push(item["grade_id"]);
				}
			}
		});

		return lst_childs;
	}
	function get_child_grade(grade_id_parent, addGradeParent, addGradeParam){
		jQuery(document).ready(function($) {
			if (addGradeParent) filter_grade.push(grade_id_parent);
			var lst_childs = [];

			var grade_arr = filter_panel_arr["grade_filter"];
			$.each( grade_arr, function( i, item ) {
				if (item["grade_parent"] != null){
					var list_grades_allow_arr = item["grade_parent"];
					if (list_grades_allow_arr.includes(grade_id_parent)){
						if (addGradeParam) filter_grade.push(item["grade_id"]);

						var grade_sub_name = item["name_sub"];
						var grade_sub_name_lst = grade_sub_name.split(":");

						$.each( grade_sub_name_lst, function( i, igrade_sub_name ) {
							if (!lst_childs.includes(igrade_sub_name)){
								lst_childs.push(igrade_sub_name);
							}
						});
					}
				}
			});

			if (lst_childs.length > 0){
				var grade_html = "";
				$.each( lst_childs, function( i, item ) {
					grade_html = grade_html + '<button value="'+item+'" class="itemFlexFilter jq-filter-grade jq-gradesub">'+item+'</button>';
				});

				$("#dvGradeSubOption").css("display", "");

				$(".gradeSubOptionItems").empty();
				$(".gradeSubOptionItems").append(grade_html);

				set_grade_click();
			}
		});
	}
	function filter_clean($){
		$( ".jq-filter-lang" ).removeClass("active");
		$( ".jq-current-lang" ).addClass("active");
		$( ".jq-filter-grade" ).removeClass("active");

		$("#dvGradeSubOption").css("display", "none");
		$(".gradeSubOptionItems").empty();
		$( ".facetwp-search" ).val("");

		call_all_get_filter();

		filter_lang = []; filter_lang.push(current_lang);
		filter_grade = []; filter_subject = []; 
		filter_core = []; filter_dicipline = [];
		filter_goals = []; filter_source = []; filter_ids = [];
	}

	//
	function get_parameters_subject(){
		jQuery(document).ready(function($) {
			var subject_arr = filter_panel_arr["subject_filter"];

			if (typeof subject_arr != 'undefined'){
				var subject_html = "";

				var filter_subject_selected = filter_subject;
				
				filter_subject = [];

				$.each( subject_arr, function( i, item ) {
					var list_grades_allow_arr = item["grade_ids"];
					var add_subject = (filter_grade.length == 0);

					if (!add_subject)
					{
						//add_subject = list_grades_allow_arr.includes(filter_grade[0]);
						$.each( filter_grade, function( i, i_grade ) {
							add_subject = list_grades_allow_arr.includes(i_grade);
							if (add_subject) return false;
						});
					}

					if (add_subject){
						var is_active = "";

						if (filter_subject_selected.includes(item['subject_id'])){ 
							is_active = "active";
							filter_subject.push(item['subject_id']);
						}

						subject_html = subject_html + '<button value="'+item["subject_id"]+'"  class="itemFlexFilter jq-filter-subject '+is_active+'">'+item['description']+'</button>';
					}
				});

				$(".subjectsItems").empty();
				$(".subjectsItems").append(subject_html);

				$( ".jq-filter-subject" ).on( "click", function(event, refresh) {
					if ($(this).hasClass("active")){ $(this).removeClass("active"); }else{ $(this).addClass("active"); }
					
					//all clean
					$(".coreElementItems").empty();
					$(".diciplineItems").empty();
					$(".goalsItems").empty();
					$(".sourceItems").empty();
					
					var subject_id = $(this).val();
					if (filter_subject.includes(subject_id)){ filter_subject.splice(filter_subject.indexOf(subject_id), 1); }else{ filter_subject.push(subject_id); }
					//

					get_parameters_core_elements();
					get_parameters_dicipline();
					get_parameters_goals();
					get_parameters_source();

					highLightGradeSubject();

					if (typeof refresh == 'undefined'){ filter_articles();}
				});
			}
		});
	}
	//
	function get_parameters_core_elements(){
		jQuery(document).ready(function($) {
			var core_element_arr = filter_panel_arr["core_elements_filter"];

			if (typeof core_element_arr != 'undefined'){
				//filter_core = [];
				var core_elment_html = '<select class="js-core-multiple jq-core-elements" multiple="multiple">';
				var current_lst_cores = [];
				$.each( core_element_arr, function( i, item ) {
					if (get_validate_insert_option($, item, 2)){
						core_elment_html = core_elment_html + '<option value="'+item["core_element_id"]+'">'+item["description"]+'</option>';
						current_lst_cores.push(item["core_element_id"]);
					}
				});

				//Add before selected
				if (filter_core.length > 0){
					$.each( filter_core, function( i, item ) {
						if (!current_lst_cores.includes(item)){
							//var item_core_arr = core_element_arr.find(o => o.core_element_id === item);
							var item_core_arr = find_element_data_grep($, "core_elements_filter", item, 2);
							if ( typeof item_core_arr != 'undefined' ){
								core_elment_html = core_elment_html + '<option value="'+item_core_arr["core_element_id"]+'" class="jq-delete-item">'+item_core_arr["description"]+'</option>';
							}
						}
					});
				}
				//

				core_elment_html = core_elment_html + '</select>';

				$(".coreElementItems").empty();
				$(".coreElementItems").append(core_elment_html);

				set_combo_core_element();

				if (filter_core.length > 0){
					$('.jq-core-elements').val(filter_core);
					$('.jq-core-elements').trigger('change');
				}
			}
		});
	}
	function set_combo_core_element(){
		jQuery(document).ready(function($) {
			$(".jq-core-elements").select2({
				placeholder: "Kjerneelementer",
				language: {
					"noResults": function(){
						return "Ingen treff";
					}
				}
			});
			
			$(".jq-core-elements").on('select2:select', function (e) { select_core_element(e, true); }).on('select2:unselect', function (e) { select_core_element(e, false); });
		});
	}
	function select_core_element(obj, addItem){
		jQuery(document).ready(function($) {
			var data = obj.params.data;

			if (filter_core.includes(data.id)){ filter_core.splice(filter_core.indexOf(data.id), 1); }else{ filter_core.push(data.id); }

			get_parameters_dicipline();
			get_parameters_goals();
			get_parameters_source();
			
			//
			highLightGradeSubject();
			//

			if (!addItem){
				var objCombo = $('.jq-core-elements option[value="'+data.id+'"]');
				if (objCombo.hasClass("jq-delete-item")){
					objCombo.detach();
					//set_combo_core_element();
				}
			}

			if (typeof data.refresh_search == 'undefined'){ filter_articles();}
		});
	}
	//
	function get_parameters_dicipline(){
		jQuery(document).ready(function($) {
			var dicipline_arr = filter_panel_arr["multidisciplinay_filter"];

			if (typeof dicipline_arr != 'undefined'){
				//filter_dicipline = [];
				var dicipline_html = "";
				var current_lst_dicipline = [];
				$.each( dicipline_arr, function( i, item ) {
					if (get_validate_insert_option($, item, 3)){
						dicipline_html = dicipline_html + '<button value="'+item['main_topic_id']+'" class="itemFlexFilter jq-filter-dicipline">'+item['description']+'</button>';
						current_lst_dicipline.push(item['main_topic_id']);
					}
				});

				//Add before selected
				if (filter_dicipline.length > 0){
					$.each( filter_dicipline, function( i, item ) {
						if (!current_lst_dicipline.includes(item)){
							var item_dicipline_arr = dicipline_arr.find(o => o.main_topic_id === item);
							if ( typeof item_dicipline_arr != 'undefined' ){
								dicipline_html = dicipline_html + '<button value="'+item_dicipline_arr['main_topic_id']+'" class="itemFlexFilter jq-filter-dicipline jq-delete-item">'+item_dicipline_arr['description']+'</button>';
							}
						}
					});
				}
				//

				$(".diciplineItems").empty();
				$(".diciplineItems").append(dicipline_html);

				if (filter_dicipline.length > 0){
					$.each( $(".diciplineItems").find("button"), function( i, item ) {
						if (filter_dicipline.includes($(item).val())){
							$(item).addClass("active");
						}
					});
				}

				$( ".jq-filter-dicipline" ).on( "click", function(event, refresh) {
					if ($(this).hasClass("active")){ 
						$(this).removeClass("active"); 

						if ($(this).hasClass("jq-delete-item")){
							$(this).remove();
							filter_show(true);
						}
					}else{ 
						$(this).addClass("active"); 
					}

					//all clean
					var dicipline_id = $(this).val();
					if (filter_dicipline.includes(dicipline_id)){ filter_dicipline.splice(filter_dicipline.indexOf(dicipline_id), 1); }else{ filter_dicipline.push(dicipline_id); }
					//

					get_parameters_goals();
					get_parameters_source();

					highLightGradeSubject();

					if (typeof refresh == 'undefined'){ filter_articles();} 
				});
			}
		});
	}
	//
	function get_parameters_goals(){
		jQuery(document).ready(function($) {
			var goals_arr = filter_panel_arr["goals_filter"];

			if (typeof goals_arr != 'undefined'){
				//filter_goals = [];
				var goals_html = '<select class="js-goal-multiple jq-goals" multiple="multiple">';
				var current_lst_goals = [];
				if (goals_arr != null) {
					$.each( goals_arr.sort((a, b) => (a.description.toUpperCase() > b.description.toUpperCase()) ? 1 : -1), function( i, item ) {
						if (get_validate_insert_option($, item, 1)){
							goals_html = goals_html + '<option value="'+item["goal_id"]+'">'+item["description"]+'</option>';
							current_lst_goals.push(item["goal_id"]);
						}
					});

				}
			
				//Add before selected
				if (filter_goals.length > 0){
					$.each( filter_goals, function( i, item ) {
						if (!current_lst_goals.includes(item)){
							//var item_goal_arr = goals_arr.find(o => o.goal_id === item);
							var item_goal_arr = find_element_data_grep($, "goals_filter", item, 1);
							if ( typeof item_goal_arr != 'undefined' ){
								goals_html = goals_html + '<option value="'+item_goal_arr["goal_id"]+'" class="jq-delete-item">'+item_goal_arr["description"]+'</option>';
							}
						}
					});
				}
				//

				goals_html = goals_html + '</select>';

				$(".goalsItems").empty();
				$(".goalsItems").append(goals_html);

				set_combo_goal();
				
				if (filter_goals.length > 0){
					$('.jq-goals').val(filter_goals);
					$('.jq-goals').trigger('change');
				}
			}
		});
	}
	function set_combo_goal(){
		jQuery(document).ready(function($) {
			$(".jq-goals").select2({
				placeholder: "Kompetansemål",
				language: {
					"noResults": function(){
						return "Ingen treff";
					}
				}
			});
			
			$(".jq-goals").on('select2:select', function (e) { select_goal(e, true); }).on('select2:unselect', function (e) { select_goal(e, false); });
		});
	}
	function select_goal(obj, addItem){
		jQuery(document).ready(function($) {
			var data = obj.params.data;

			get_parameters_source();

			if (filter_goals.includes(data.id)){ filter_goals.splice(filter_goals.indexOf(data.id), 1); }else{ filter_goals.push(data.id); }

			highLightGradeSubject();

			if (!addItem){
				var objCombo = $('.jq-goals option[value="'+data.id+'"]');
				if (objCombo.hasClass("jq-delete-item")){
					objCombo.detach();
					//set_combo_goal();
				}
			}else{$(".select2-search__field").focus();}
			
			if (typeof data.refresh_search == 'undefined'){ filter_articles();}
		});
	}
	//
	function get_parameters_source(){
		jQuery(document).ready(function($) {
			var source_arr = filter_panel_arr["source_filter"];

			if (typeof source_arr != 'undefined'){
				//filter_source = [];
				var source_html = "";
				var current_lst_source = [];
				$.each( source_arr, function( i, item ) {
					if (get_validate_insert_option($, item, 4)){
						source_html = source_html + '<button value="'+item['term_id']+'" class="itemFlexFilter jq-filter-source">'+item['description']+'</button>';
						current_lst_source.push(item['term_id']);
					}
				});

				//Add before selected
				if (filter_source.length > 0){
					$.each( filter_source, function( i, item ) {
						if (!current_lst_source.includes(item)){
							var item_source_arr = source_arr.find(o => o.term_id === item);
							if ( typeof item_source_arr != 'undefined' ){
								source_html = source_html + '<button value="'+item_source_arr['term_id']+'" class="itemFlexFilter jq-filter-source jq-delete-item">'+item_source_arr['description']+'</button>';
							}
						}
					});
				}

				$(".sourceItems").empty();
				$(".sourceItems").append(source_html);

				if (filter_source.length > 0){
					$.each( $(".sourceItems").find("button"), function( i, item ) {
						if (filter_source.includes($(item).val())){
							$(item).addClass("active");
						}
					});
				}

				$( ".jq-filter-source" ).on( "click", function(event, refresh) {
					if ($(this).hasClass("active")){ 
						$(this).removeClass("active"); 

						if ($(this).hasClass("jq-delete-item")){
							$(this).remove();
							filter_show(true);
						}
					}else{ 
						$(this).addClass("active"); 
					}

					//all clean
					var source_id = $(this).val();
					if (filter_source.includes(source_id)){ filter_source.splice(filter_source.indexOf(source_id), 1); }else{ filter_source.push(source_id); }
					//

					highLightGradeSubject();

					if (typeof refresh == 'undefined'){ filter_articles();}
				});
			}
		});
	}
	function get_validate_insert_option($, item, type){
		var exist_filter_grade = (filter_grade.length > 0);
		var exist_filter_subject = (filter_subject.length > 0);
		var exist_filter_core = (filter_core.length > 0);
		var exist_filter_dicipline = (filter_dicipline.length > 0);
		var exist_filter_goal = (filter_goals.length > 0);

		//Grades
		var lst_found_grade = [];
		if (exist_filter_grade){
			$.each( filter_grade, function( i, i_grade ) {
				var item_grade_arr = item["grade_ids"].find(o => o.grade_id === i_grade);
				if ( typeof item_grade_arr != 'undefined' ) lst_found_grade.push(item_grade_arr);
			});
		}else{
			lst_found_grade = item["grade_ids"];
		}
		//

		//Subject
		var lst_found_subject = [];
		if (exist_filter_subject){
			$.each( lst_found_grade, function( i, item_grade_arr ) {
				if (type == 2){
					var list_subjects_allow_arr = item_grade_arr["subject_ids"];
					$.each( filter_subject, function( i, i_subject ) {
						if (list_subjects_allow_arr.includes(i_subject)){
							lst_found_subject.push(item_grade_arr);
							return false;
						}
					});
				}else{
					$.each( filter_subject, function( i, i_subject ) {
						var item_subject_arr = item_grade_arr["subject_ids"].find(o => o.subject_id === i_subject);
						if ( typeof item_subject_arr != 'undefined' ){
							lst_found_subject.push(item_grade_arr);
							return false;
						}
						if (lst_found_subject.length > 0) return false;
					});
				}
				if (lst_found_subject.length > 0) return false;
			});
		}else{
			lst_found_subject = lst_found_grade;
		}
		//

		if (type == 2) return (lst_found_subject.length > 0);
		//

		//Core
		var lst_found_core = [];
		if (exist_filter_core){
			$.each( lst_found_subject, function( i, item_grade_arr ) {
				$.each( item_grade_arr["subject_ids"], function( i, item_subject_arr ) {
					if (type == 3){
						var list_core_allow_arr = item_subject_arr["core_element_ids"];
						$.each( filter_core, function( i, i_core ) {
							if (list_core_allow_arr.includes(i_core)){
								lst_found_core.push(item_grade_arr);
								return false;
							}
						});
					}else{
						$.each( filter_core, function( i, i_core ) {
							var item_core_arr = item_subject_arr["core_element_ids"].find(o => o.core_element_id === i_core);
							if ( typeof item_core_arr != 'undefined' ){
								lst_found_core.push(item_grade_arr);
								return false;
							}
							if (lst_found_core.length > 0) return false;
						});
						if (lst_found_core.length > 0) return false;
					}
				});
				if (lst_found_core.length > 0) return false;
			});
		}else{
			lst_found_core = lst_found_subject;
		}
		//

		if (type == 3) return (lst_found_core.length > 0);
		//

		//Main Topic
		var lst_found_dicipline = [];
		if (exist_filter_dicipline){
			$.each( lst_found_core, function( i, item_grade_arr ) {
				$.each( item_grade_arr["subject_ids"], function( i, item_subject_arr ) {
					$.each( item_subject_arr["core_element_ids"], function( i, item_core_arr ) {
						if (type == 1){
							var list_maintopic_allow_arr = item_core_arr["main_topic_ids"];
							$.each( filter_dicipline, function( i, i_disipline ) {
								if (list_maintopic_allow_arr.includes(i_disipline)){
									lst_found_dicipline.push(item_grade_arr);
								}
							});
						}else{
							$.each( filter_dicipline, function( i, i_disipline ) {
								var item_dicipline_arr = item_core_arr["main_topic_ids"].find(o => o.main_topic_id === i_disipline);
								if ( typeof item_dicipline_arr != 'undefined' ){
									lst_found_dicipline.push(item_grade_arr);
									return false;
								}
							});
							if (lst_found_dicipline.length > 0) return false;
						}
					});
					if (lst_found_dicipline.length > 0) return false;
				});
				if (lst_found_dicipline.length > 0) return false;
			});
		}else{
			lst_found_dicipline = lst_found_core;
		}
		//

		if (type == 1) return (lst_found_dicipline.length > 0);

		//Goals
		var lst_found_goal = [];
		if (exist_filter_goal){
			$.each( lst_found_dicipline, function( i, item_grade_arr ) {
				$.each( item_grade_arr["subject_ids"], function( i, item_subject_arr ) {
					$.each( item_subject_arr["core_element_ids"], function( i, item_core_arr ) {
						$.each( item_core_arr["main_topic_ids"], function( i, item_dicipline_arr ) {
							var list_goal_allow_arr = item_dicipline_arr["goal_ids"];
							$.each( filter_goals, function( i, i_goal ) {
								if (list_goal_allow_arr.includes(i_goal)){
									lst_found_goal.push(item_grade_arr);
									return false;
								}
							});
							if (lst_found_goal.length > 0) return false;
						});
						if (lst_found_goal.length > 0) return false;
					});
					if (lst_found_goal.length > 0) return false;
				});
				if (lst_found_goal.length > 0) return false;
			});
		}else{
			lst_found_goal = lst_found_dicipline;
		}
		//

		return (lst_found_goal.length > 0);
	}
	function cleanHihtLightGradeSubject($){
		$.each( $(".gradesItems").find("button"), function( i, item ) {
			$(item).removeClass("downlight").removeClass("highlight");
		});

		$.each( $(".subjectsItems").find("button"), function( i, item ) {
			$(item).removeClass("downlight").removeClass("highlight");
		});
	}
	function highLightGradeSubject(){
		jQuery(document).ready(function($) {
			var exist_filter_grade = (filter_grade.length > 0);
			var exist_filter_subject = (filter_subject.length > 0);

			cleanHihtLightGradeSubject($);

			if (!exist_filter_grade && !exist_filter_subject)
			{
				var lst_response = GetGradeSubjectIdsBy($);
				var lst_grade_highlight = lst_response[0];
				if (lst_grade_highlight.length > 0)
				{
					var grade_arr = filter_panel_arr["grade_filter"];

					$.each( $(".gradesItems").find("button"), function( i, item ) {
						if (lst_grade_highlight.includes($(item).val())){
							//$(item).addClass("highlight");
						}else{
							//Validate is has children
							var lst_childs = get_lst_child_grade($(item).val(), $);
							var setDownlight = true;

							$.each( lst_grade_highlight, function( ix, item_gh ) {
								if (lst_childs.includes(item_gh)){
									setDownlight = false;
									return false;
								}
							});

							if (setDownlight) $(item).addClass("downlight");
						}
					});
				}
				var lst_subject_highlight = lst_response[1];
				if (lst_subject_highlight.length > 0)
				{
					$.each( $(".subjectsItems").find("button"), function( i, item ) {
						if (lst_subject_highlight.includes($(item).val())){
							//$(item).addClass("highlight");
						}else{
							$(item).addClass("downlight");
						}
					});
				}
			}
		});
	}
	function GetGradeSubjectIdsBy($){
		var exist_filter_core = (filter_core.length > 0);
		var exist_filter_dicipline = (filter_dicipline.length > 0);
		var exist_filter_goal = (filter_goals.length > 0);
		var exist_filter_source = (filter_source.length > 0);

		var lst_response = [];
		var lst_grade_highlight = [];
		var lst_subject_highlight = [];

		if (exist_filter_core){
			$.each( filter_core, function( i, i_core ) {
				var item_core_arr = filter_panel_arr["core_elements_filter"].find(o => o.core_element_id === i_core);
				if ( typeof item_core_arr != 'undefined' ){
					$.each( item_core_arr["grade_ids"], function( i, i_grade ) {
						//Grade
						if (!lst_grade_highlight.includes(i_grade["grade_id"])){
							lst_grade_highlight.push(i_grade["grade_id"]);
						}
						//Subject
						$.each( i_grade["subject_ids"], function( i, i_subject ) {
							if (!lst_subject_highlight.includes(i_subject)){
								lst_subject_highlight.push(i_subject);
							}
						});
					});
				}
			});
		}

		if (exist_filter_dicipline){
			$.each( filter_dicipline, function( i, i_disipline ) {
				var item_dicipline_arr = filter_panel_arr["multidisciplinay_filter"].find(o => o.main_topic_id === i_disipline);
				if ( typeof item_dicipline_arr != 'undefined' ){
					$.each( item_dicipline_arr["grade_ids"], function( i, i_grade ) {
						//Grade
						if (!lst_grade_highlight.includes(i_grade["grade_id"])){
							lst_grade_highlight.push(i_grade["grade_id"]);
						}
						//Subject
						$.each( i_grade["subject_ids"], function( i, i_subject ) {
							if (!lst_subject_highlight.includes(i_subject["subject_id"])){
								lst_subject_highlight.push(i_subject["subject_id"]);
							}
						});
					});
				}
			});
		}

		if (exist_filter_goal){
			$.each( filter_goals, function( i, i_goal ) {
				var item_goal_arr = filter_panel_arr["goals_filter"].find(o => o.goal_id === i_goal);
				if ( typeof item_goal_arr != 'undefined' ){
					$.each( item_goal_arr["grade_ids"], function( i, i_grade ) {
						//Grade
						if (!lst_grade_highlight.includes(i_grade["grade_id"])){
							lst_grade_highlight.push(i_grade["grade_id"]);
						}

						//Subject
						$.each( i_grade["subject_ids"], function( i, i_subject ) {
							if (!lst_subject_highlight.includes(i_subject["subject_id"])){
								lst_subject_highlight.push(i_subject["subject_id"]);
							}
						});
					});
				}
			});
		}

		if (exist_filter_source){
			$.each( filter_source, function( i, i_source ) {
				var item_source_arr = filter_panel_arr["source_filter"].find(o => o.term_id === i_source);
				if ( typeof item_source_arr != 'undefined' ){
					$.each( item_source_arr["grade_ids"], function( i, i_grade ) {
						//Grade
						if (!lst_grade_highlight.includes(i_grade["grade_id"])){
							lst_grade_highlight.push(i_grade["grade_id"]);
						}

						//Subject
						$.each( i_grade["subject_ids"], function( i, i_subject ) {
							if (!lst_subject_highlight.includes(i_subject["subject_id"])){
								lst_subject_highlight.push(i_subject["subject_id"]);
							}
						});
					});
				}
			});
		}

		lst_response.push(lst_grade_highlight);
		lst_response.push(lst_subject_highlight);

		return lst_response;
	}
	function filter_show(close_panel){
		jQuery(document).ready(function($) {
			if ($(".FiltersModal").hasClass("open")){
				$(".FiltersModal").removeClass("open");
				$(".filtersModalBackground").addClass("hide");

				if (existFilters()){
					$(".btn-filter").addClass("active");
					$(".btn-filter span").text("Endre filter");
					$(".btn-filter img").attr("src", "<?php echo get_template_directory_uri(); ?>/library/images/education-article/filter_white.svg");
				}else{
					$(".btn-filter").removeClass("active");
					$(".btn-filter img").attr("src", "<?php echo get_template_directory_uri(); ?>/library/images/education-article/filter.svg");
					$(".btn-filter span").text("Filter");
				}
			}else{
				$(".FiltersModal").addClass("open");
				$(".filtersModalBackground").removeClass("hide");

				$(".btn-filter").addClass("active");
				$(".btn-filter img").attr("src", "<?php echo get_template_directory_uri(); ?>/library/images/education-article/filter_white.svg");
				$(".btn-filter span").text("Bruk filter");
			}
		});
	}
	function existFilters(){
		if (exist_filter){
			return true;
		}

		var countFilters = filter_grade.length + filter_subject.length + filter_dicipline.length + filter_source.length + filter_core.length + filter_goals.length;
		
		return (countFilters > 0);
	}
	function filter_reset(){
		jQuery(document).ready(function($) {
			filter_clean($);
			cleanHihtLightGradeSubject($);
			set_lang_click(false);

			FWP.reset();

			<?php if (!$is_home){?>
            $("html, body").animate({ scrollTop: 0 }, "slow");
            <?php } ?>
		});
	}
	function filter_articles(timeSearchWait){
		window.stop();
		clearTimeout(timeOutFilter);
		
		if (typeof timeSearchWait == 'undefined') { timeSearchWait = 800;}

		timeOutFilter = setTimeout(function(){
			jQuery(document).ready(function($) {
				clearTimeout(timeOutFilter);

				//FWP.is_reset = true;
				/*
				FWP.facets['grade'] = filter_grade;
				FWP.facets['subject'] = filter_subject;
				FWP.facets['core'] = filter_core;
				FWP.facets['dicipline'] = filter_dicipline;
				FWP.facets['goal'] = filter_goals;
				FWP.facets['source'] = filter_source;
				*/
				FWP.refresh();

				<?php if (!$is_home){?>
				$("html, body").animate({ scrollTop: 0 }, "slow");
				<?php } ?>

				//filter_show(false);
			});

		}, timeSearchWait);
	}
	</script>