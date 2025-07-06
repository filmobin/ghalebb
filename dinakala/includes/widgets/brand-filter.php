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
   class dina_brand_filter_widget extends WP_Widget {
   
      function __construct()
      {
      
         parent::__construct(
         
         // Base ID of your widget
         'dina_brand_filter_widget',
         
         // Widget name will appear in UI
         __( 'Brand filter (Dinakala)', 'dina-kala' ),
         
         // Widget description
         array( 'description' => __( 'Product brand filter', 'dina-kala' ), )
         
         );
      
      }

      public function display_brands( $parent_id = 0, $product_brand = array(), $show_brand_logo = false, $result_brands )
      {
         // Get all the brands (parents and subcategories) according to the brands related to the products
         $all_brands = get_terms( array(
            'taxonomy'   => dina_opt( 'product_brand_taxonomy' ),
            'hide_empty' => false,
            'include'    => $result_brands,
         ) );
  
         if ( ! empty( $all_brands ) && ! is_wp_error( $all_brands ) ) {
            // An array to store the displayed brands
            $displayed_brands = array();
   
            // First loop: Display parent brands
            foreach ( $all_brands as $brand ) {
               if ( $brand->parent == $parent_id ) {
                     // Display the parent brand as a link with the logo image (if any)
                     $is_active = in_array( $brand->term_id, $product_brand ) ? ' is-active' : '';
                     echo '<li class="dina-filter-item'. $is_active .'">';
                     echo '<a rel="nofollow" href="'. esc_attr( $this->get_link( $brand->term_id ) ) .'">';
                     
                     if ( $show_brand_logo ) {
                        $brand_logo = get_term_meta( $brand->term_id, 'dina_brand_logo', true );
                        if ( $brand_logo ) {
                           echo '<img src="'. esc_url( $brand_logo ) .'" alt="'. esc_attr( $brand->name ) .'" title="'. esc_attr( $brand->name ) .'" class="filter-brand-logo">';
                        }
                     }
   
                     echo esc_html( $brand->name ) .'</a>';
                     echo '</li>';
                     $displayed_brands[] = $brand->term_id;
   
                     // The second loop: Display subcategory brands (if any)
                     $child_brands = get_terms( array(
                        'taxonomy'   => dina_opt( 'product_brand_taxonomy' ),
                        'hide_empty' => false,
                        'parent'     => $brand->term_id,
                        'include'    => $result_brands,
                     ) );
   
                     if ( ! empty( $child_brands ) && ! is_wp_error( $child_brands ) ) {
                        echo '<ul>';
                        foreach ( $child_brands as $child ) {
                           $is_active = in_array( $child->term_id, $product_brand ) ? ' is-active' : '';
                           echo '<li class="dina-filter-item child-brand'. $is_active .'">';
                           echo '<a rel="nofollow" href="'. esc_attr( $this->get_link( $child->term_id ) ) .'">';
   
                           if ( $show_brand_logo ) {
                                 $child_logo = get_term_meta( $child->term_id, 'dina_brand_logo', true );
                                 if ($child_logo) {
                                    echo ' <img src="'. esc_url( $child_logo ) .'" alt="'. esc_attr( $child->name ) .'" title="'. esc_attr( $child->name ) .'" class="filter-brand-logo">';
                                 }
                           }
   
                           echo esc_html( $child->name ) .'</a>';
                           echo '</li>';
                           $displayed_brands[] = $child->term_id;
                        }
                        echo '</ul>';
                     }
               }
            }
   
            // Check for brands that are not displayed as subcategories
            foreach ( $all_brands as $brand ) {
               if ( ! in_array( $brand->term_id, $displayed_brands ) && $brand->parent != $parent_id ) {
                     $is_active = in_array( $brand->term_id, $product_brand ) ? ' is-active' : '';
                     echo '<li class="dina-filter-item'. $is_active .'">';
                     echo '<a rel="nofollow" href="'. esc_attr( $this->get_link( $brand->term_id ) ) .'">';
   
                     if ($show_brand_logo) {
                        $brand_logo = get_term_meta( $brand->term_id, 'dina_brand_logo', true);
                        if ($brand_logo) {
                           echo ' <img src="'. esc_url( $brand_logo ) .'" alt="'. esc_attr( $brand->name ) .'" title="'. esc_attr( $brand->name ) .'" class="filter-brand-logo">';
                        }
                     }
   
                     echo esc_html($brand->name) .'</a>';
                     echo '</li>';
               }
            }
         }
      }

      //Creating widget front-end 
      public function widget( $args, $instance ) {
         if ( ( is_shop() || is_product_taxonomy() ) ) {
             $current_products = $this->current_products_query();
 
             if ( ! empty( $current_products ) && ! is_tax( dina_opt( 'product_brand_taxonomy' ) ) && ! is_product() ) {
                 $result_brands           = $this->get_products_brands( $current_products );
                 $title                   = apply_filters( 'widget_title', $instance['title'] );
                 $show_brand_logo         = isset( $instance['show_brand_logo'] ) ? $instance['show_brand_logo'] : '';
                 $show_brand_hierarchical = isset( $instance['show_brand_hierarchical'] ) && $instance['show_brand_hierarchical'] ? ' dina-brand-hierarchical' : '';
                 
                 echo $args['before_widget'];
 
                 if ( ! empty( $title ) )
                     echo $args['before_title'] . $title . $args['after_title'];
 
                 $product_brand = isset( $_GET['product_brand'] ) ? explode( ',', $_GET['product_brand'] ) : array();
                 
                 if ( ! empty( $result_brands ) && ! is_wp_error( $result_brands ) ) {
                     echo '<ul class="dina-brand-filter'. $show_brand_hierarchical .'">';
                     $this->display_brands( 0, $product_brand, $show_brand_logo, $result_brands );
                     echo '</ul>';
                 } else {
                     _e( 'No brand found!', 'dina-kala' );
                 }
 
                 echo $args['after_widget'];
             }
         }
     }
   
      // Widget Backend
      public function form( $instance ) {
      
         $title                   = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : __( 'Brand filter', 'dina-kala' );
         $show_brand_logo         = isset( $instance['show_brand_logo'] ) ? $instance['show_brand_logo'] : '';
         $show_brand_hierarchical = isset( $instance['show_brand_hierarchical'] ) ? $instance['show_brand_hierarchical'] : '';
         
         // Widget admin form
         ?>
         <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'dina-kala' ); ?></label>
            <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
         </p>

         <p>
            <label for="<?php echo $this->get_field_id( 'show_brand_logo' ); ?>">
            <input type="checkbox" id="<?php echo $this->get_field_id( 'show_brand_logo' ); ?>" value="true" name="<?php echo $this->get_field_name( 'show_brand_logo' ); ?>" <?php checked( $show_brand_logo, 'true' ); ?> />
            <?php _e( 'Show brand logo', 'dina-kala' ) ?>
            </label>
         </p>

         <p>
            <label for="<?php echo $this->get_field_id( 'show_brand_hierarchical' ); ?>">
            <input type="checkbox" id="<?php echo $this->get_field_id( 'show_brand_hierarchical' ); ?>" value="true" name="<?php echo $this->get_field_name( 'show_brand_hierarchical' ); ?>" <?php checked( $show_brand_hierarchical, 'true' ); ?> />
            <?php _e( 'Show brand hierarchical', 'dina-kala' ) ?>
            </label>
         </p>

      <?php
      }
   
      // Updating widget replacing old instances with new
      public function update( $new_instance, $old_instance ) {
      
         $instance = array();
         
         $instance['title']                   = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
         $instance['show_brand_logo']         = sanitize_text_field( $new_instance['show_brand_logo'] );
         $instance['show_brand_hierarchical'] = sanitize_text_field( $new_instance['show_brand_hierarchical'] );
         
         return $instance;
      
      }

      private function get_link( $brand_id ) {
         $base_link             = dina_shop_page_link( true );
         $link                  = remove_query_arg( 'product_brand', $base_link );
         $current_product_brand = isset( $_GET['product_brand'] ) ? explode( ',', $_GET['product_brand'] ) : array();
         $option_is_set         = in_array( $brand_id, $current_product_brand );

         if ( ! in_array( $brand_id, $current_product_brand ) ) {
            $current_product_brand[] = $brand_id;
         }
         
         foreach ( $current_product_brand as $key => $value ) {
            if ( $option_is_set && $value == $brand_id ) {
               unset( $current_product_brand[ $key ] );
            }
         }

         if ( $current_product_brand ) {
            asort( $current_product_brand );
            $link = add_query_arg( 'product_brand', implode( ',', $current_product_brand ), $link );
         }

         $link = str_replace( '%2C', ',', $link );
         return $link;
      }

      private function current_products_query() {
         
         $args = array(
            'posts_per_page' => -1,
            'post_type'      => 'product',
            'fields'         => 'ids',
            'tax_query'      => array(
               array(
                  'taxonomy' => dina_opt( 'product_brand_taxonomy' ),
                  'operator' => 'EXISTS',
               )
            )
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

      private function get_products_brands( $product_ids ) {
         
         $brand_taxonomy = dina_opt( 'product_brand_taxonomy' );
         $product_ids = implode( ',', array_map( 'intval', $product_ids ) );
   
         global $wpdb;
   
         $brand_ids = $wpdb->get_col(
            "SELECT DISTINCT t.term_id
            FROM {$wpdb->prefix}terms AS t
            INNER JOIN {$wpdb->prefix}term_taxonomy AS tt
            ON t.term_id = tt.term_id
            INNER JOIN {$wpdb->prefix}term_relationships AS tr
            ON tr.term_taxonomy_id = tt.term_taxonomy_id
            WHERE tt.taxonomy = '$brand_taxonomy'
            AND tr.object_id IN ( $product_ids)
         "
         );
   
         return ( $brand_ids ) ? $brand_ids : false;
      }
   
   }
   
   // Register and load the widget
   function dina_brand_filter_load_widget() {
      register_widget( 'dina_brand_filter_widget' );
   }
   add_action( 'widgets_init', 'dina_brand_filter_load_widget' );   