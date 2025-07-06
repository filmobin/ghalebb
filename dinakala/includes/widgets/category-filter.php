<?php
/*
Theme Designed By: Meysam Hosseinkhani
Email: Meysam98@Gmail.com
Author Website: i-design.ir
*/
   // Exit if accessed directly
   if ( ! defined( 'ABSPATH' ) ) {
      exit;
   }

   // Creating the widget
   class dina_category_filter_widget extends WP_Widget {
   
      function __construct() {
      
         parent::__construct(
         
         // Base ID of your widget
         'dina_category_filter_widget',
         
         // Widget name will appear in UI
         __( 'Products Category filter (Dinakala)', 'dina-kala' ),
         
         // Widget description
         array( 'description' => __( 'Product category filter', 'dina-kala' ), )
         
         );
      
      }
   
      //Creating widget front-end   
      public function widget( $args, $instance ) {

         if ( ( is_shop() || is_product_taxonomy() ) ) {

            $current_products = $this->current_products_query();

            if ( ! empty( $current_products ) && ! is_product() ) {

            $result_cats = $this->get_products_categories( $current_products );
            $title       = apply_filters( 'widget_title', $instance['title'] );
         
            // before and after widget arguments are defined by themes
            echo $args['before_widget'];
         
            if ( ! empty( $title ) )
               echo $args['before_title'] . $title . $args['after_title'];

            // This is where you run the code and display the output
            $product_cat = isset( $_GET['dprod_cat'] ) ? explode( ',', $_GET['dprod_cat'] ) : array();
            $prod_cat    = array();
            $cats        = get_terms("product_cat");

            if ( ! empty( $result_cats ) && ! is_wp_error( $result_cats ) ) { 
               
            ?>
            
            <ul class="dina-category-filter">

               <?php
               
               foreach ( $result_cats as $cat ) {
                  $cat = get_term( $cat );             
                  ?>
                     <li class="dina-category-item<?php echo in_array( $cat->term_id, $product_cat ) ? ' is-active' : ''; ?>">
                        <a rel="nofollow" href="<?php echo esc_attr( $this->get_link( $cat->term_id ) ); ?>">
                        <?php 
                           echo $cat->name; 
                        ?>
                        </a>
                     </li>
               <?php } ?>

            </ul>
            <?php } else {
               _e( 'No category found!', 'dina-kala' );
            } ?>
         <?php
            echo $args['after_widget'];
         }
         }

      }
   
      // Widget Backend
      public function form( $instance ) {
      
         $title        = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : __( 'Category filter', 'dina-kala' );
         
         // Widget admin form
         ?>
         <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'dina-kala' ); ?></label>
            <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
         </p>

      <?php
      }
   
      // Updating widget replacing old instances with new
      public function update( $new_instance, $old_instance ) {
      
         $instance = array();
         
         $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
         
         return $instance;
      
      }

      private function get_link( $cat_id ) {
         $base_link           = dina_shop_page_link( true );
         $link                = remove_query_arg( 'dprod_cat', $base_link );
         $current_product_cat = isset( $_GET['dprod_cat'] ) ? explode( ',', $_GET['dprod_cat'] ) : array();
         $option_is_set       = in_array( $cat_id, $current_product_cat );

         if ( ! in_array( $cat_id, $current_product_cat ) ) {
            $current_product_cat[] = $cat_id;
         }
         
         foreach ( $current_product_cat as $key => $value ) {
            if ( $option_is_set && $value == $cat_id ) {
               unset( $current_product_cat[ $key ] );
            }
         }

         if ( $current_product_cat ) {
            asort( $current_product_cat );
            $link = add_query_arg( 'dprod_cat', implode( ',', $current_product_cat ), $link );
         }

         $link = str_replace( '%2C', ',', $link );
         return $link;
      }

      private function current_products_query() {
         $args = array(
            'posts_per_page' => -1,
            'post_type'      => 'product',
            'tax_query'      => array(
               array(
                  'taxonomy' => 'product_cat',
                  'operator' => 'EXISTS',
               ),
            ),
            'fields'         => 'ids',
         );
   
         $cat = get_queried_object();
         if ( is_a( $cat, 'WP_Term' ) ) {
            $cat_id              = $cat->term_id;
            $cat_id_array        = get_term_children( $cat_id, $cat->taxonomy );
            $cat_id_array[]      = $cat_id;
            $args['tax_query'][] = array(
               'taxonomy' => $cat->taxonomy,
               'field'    => 'term_id',
               'terms'    => $cat_id_array,
            );
         }
   
         if ( get_option( 'woocommerce_hide_out_of_stock_items' ) === 'yes' ) {
            $args['meta_query'] = array(
               array(
                  'key'     => '_stock_status',
                  'value'   => 'outofstock',
                  'compare' => 'NOT IN',
               ),
            );
         }
   
         $wp_query = new WP_Query( $args );
         wp_reset_postdata();
   
         return $wp_query->posts;
      }

      private function get_products_categories( $product_ids ) {
         $product_ids = implode( ',', array_map( 'intval', $product_ids ) );
   
         global $wpdb;
   
         $cat_ids = $wpdb->get_col(
            "SELECT DISTINCT t.term_id
            FROM {$wpdb->prefix}terms AS t
            INNER JOIN {$wpdb->prefix}term_taxonomy AS tt
            ON t.term_id = tt.term_id
            INNER JOIN {$wpdb->prefix}term_relationships AS tr
            ON tr.term_taxonomy_id = tt.term_taxonomy_id
            WHERE tt.taxonomy = 'product_cat'
            AND tr.object_id IN ( $product_ids)
         "
         );
   
         return ( $cat_ids ) ? $cat_ids : false;
      }
   
   }
   
   // Register and load the widget
   function dina_category_filter_load_widget() {
      register_widget( 'dina_category_filter_widget' );
   }
   add_action( 'widgets_init', 'dina_category_filter_load_widget' );   