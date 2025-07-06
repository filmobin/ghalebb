<?php 
/*
Theme Designed By: Meysam Hosseinkhani
Email: Meysam98@Gmail.com
Demo Website: Amniat98.com
Author Website: i-design.ir
*/
   //Views
   function getPostViews( $postID ) {

      $count_key = dina_opt( 'views_meta_key' );
      $count = get_post_meta( $postID, $count_key, true);

      if ( $count=='' ) {
      delete_post_meta( $postID, $count_key);
      add_post_meta( $postID, $count_key, '0' );

      return 0;
      }

      return number_format( $count);
   }
    
   // function to count views.
   function setPostViews( $postID ) {
      
      
      $user = wp_get_current_user();

      if ( ( in_array( 'author', (array) $user->roles ) || in_array( 'administrator', (array) $user->roles ) || in_array( 'editor', (array) $user->roles ) || in_array( 'contributor', (array) $user->roles ) || in_array( 'shop_manager', (array) $user->roles ) ) && dina_opt( 'not_count_admin_views' ) )
         return;

      $count_key = dina_opt( 'views_meta_key' );
      $count = get_post_meta( $postID, $count_key, true );

      if ( $count == '' ) {

         $count = 0;
         delete_post_meta( $postID, $count_key );
         add_post_meta( $postID, $count_key, '0' );

      } else {

         $count++;
         update_post_meta( $postID, $count_key, $count );

      }
   }
   
   ?>