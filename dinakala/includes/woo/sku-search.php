<?php
add_filter( 'posts_search', 'dina_product_search_by_sku', 9999, 2 );
function dina_product_search_by_sku( $search, $wp_query ) {
   global $wpdb;
   if ( ! is_search() || ! isset( $wp_query->query_vars['s'] ) || ( ! is_array( $wp_query->query_vars['post_type'] ) && $wp_query->query_vars['post_type'] !== "product" ) || ( is_array( $wp_query->query_vars['post_type'] ) && ! in_array( "product", $wp_query->query_vars['post_type'] ) ) ) return $search; 
   $product_id = wc_get_product_id_by_sku( $wp_query->query_vars['s'] );
   if ( ! $product_id ) return $search;
   $product = wc_get_product( $product_id );
   if ( $product->is_type( 'variation' ) ) {
      $product_id = $product->get_parent_id();
   }
   $search = str_replace( 'AND (((', "AND (({$wpdb->posts}.ID IN (" . $product_id . ")) OR ((", $search );  
   return $search;   
}