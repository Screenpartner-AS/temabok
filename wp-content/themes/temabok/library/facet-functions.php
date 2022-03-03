<?php
/************************
FACETWP FUNCTIONALITY
************************/

// FACETWP
add_filter( 'facetwp_is_main_query', function( $is_main_query, $query ) {
  if ( isset( $query->query_vars['facetwp'] ) ) {
    $is_main_query = (bool) $query->query_vars['facetwp'];
  }
  return $is_main_query;
}, 10, 2 );
