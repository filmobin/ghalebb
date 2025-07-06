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
   class dina_onsale_stock_widget extends WP_Widget {
   
      function __construct() {
      
         parent::__construct(
         
         // Base ID of your widget
         'dina_onsale_stock_widget',
         
         // Widget name will appear in UI
         __( 'Stock status (Dinakala)', 'dina-kala' ),
         
         // Widget description
         array( 'description' => __( 'Filter stock and on-sale products', 'dina-kala' ), )
         
         );
      
      }
   
      function get_link( $status ) {
         $base_link            = dina_shop_page_link( true );
         $link                 = remove_query_arg( 'stock_status', $base_link );
         $current_stock_status = isset( $_GET['stock_status'] ) ? explode( ',', $_GET['stock_status'] ) : array();
         $option_is_set        = in_array( $status, $current_stock_status );

         if ( ! in_array( $status, $current_stock_status ) ) {
            $current_stock_status[] = $status;
         }
         
         foreach ( $current_stock_status as $key => $value ) {
            if ( $option_is_set && $value === $status ) {
               unset( $current_stock_status[ $key ] );
            }
         }

         if ( $current_stock_status ) {
            asort( $current_stock_status );
            $link = add_query_arg( 'stock_status', implode( ',', $current_stock_status ), $link );
         }
         
         $link = str_replace( '%2C', ',', $link );
         return $link;
      }
   
      // Creating widget front-end   
      public function widget( $args, $instance ) {

         if ( is_shop() || is_product_taxonomy() ) {
      
            $title = apply_filters( 'widget_title', $instance['title'] );
            $show_instock = isset( $instance['show_instock'] ) ? $instance['show_instock'] : '';
            $show_onsale  = isset( $instance['show_onsale'] ) ? $instance['show_onsale'] : '';
            $show_nocall  = isset( $instance['show_nocall'] ) ? $instance['show_nocall'] : '';
         
            // before and after widget arguments are defined by themes
            echo $args['before_widget'];
         
            if ( ! empty( $title ) )
               echo $args['before_title'] . $title . $args['after_title'];

            // This is where you run the code and display the output
            $current_stock_status = isset( $_GET['stock_status'] ) ? explode( ',', $_GET['stock_status'] ) : array();
         ?>
         
            <ul class="dina-sale-stock-filter">

               <?php if ( $show_onsale ) { ?>
               <?php $this->get_link( 'onsale' ); ?>
               <li class="dina-filter-item dina-filter-onsale<?php echo in_array( 'onsale', $current_stock_status ) ? ' is-active' : ''; ?>">
                  <a rel="nofollow" href="<?php echo esc_attr( $this->get_link( 'onsale' ) ); ?>">
                     <?php _e( 'On sale' , 'dina-kala' ); ?>
                  </a>
               </li>
               <?php } ?>
               
               <?php if ( $show_instock ) { ?>
               <?php $this->get_link( 'instock' ); ?>
               <li class="dina-filter-item dina-filter-instock<?php echo in_array( 'instock', $current_stock_status ) ? ' is-active' : ''; ?>">
                  <a rel="nofollow" href="<?php echo esc_attr( $this->get_link( 'instock' ) ); ?>">
                     <?php _e( 'In Stock' , 'dina-kala' ); ?>
                  </a>
               </li>
               <?php } ?>

               <?php if ( $show_nocall ) { ?>
               <?php $this->get_link( 'nocall' ); ?>
               <li class="dina-filter-item dina-filter-nocall<?php echo in_array( 'nocall', $current_stock_status ) ? ' is-active' : ''; ?>">
                  <a rel="nofollow" href="<?php echo esc_attr( $this->get_link( 'nocall' ) ); ?>">
                     <?php _e( 'Only products with prices' , 'dina-kala' ); ?>
                  </a>
               </li>
               <?php } ?>

            </ul>
         
         <?php
            echo $args['after_widget'];
         }

      }
   
   
      // Widget Backend
      public function form( $instance ) {
      
         $title        = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : __( 'Stock status', 'dina-kala' );
         $show_onsale  = isset( $instance['show_onsale'] ) ? $instance['show_onsale'] : '';
         $show_instock = isset( $instance['show_instock'] ) ? $instance['show_instock'] : '';
         $show_nocall  = isset( $instance['show_nocall'] ) ? $instance['show_nocall'] : '';
         
         // Widget admin form
         ?>
         <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'dina-kala' ); ?></label>
            <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
         </p>

         <p>
            <label for="<?php echo $this->get_field_id( 'show_onsale' ); ?>">
            <input type="checkbox" id="<?php echo $this->get_field_id( 'show_onsale' ); ?>" value="true" name="<?php echo $this->get_field_name( 'show_onsale' ); ?>" <?php checked( $show_onsale, 'true' ); ?> />
            <?php _e( 'Show On sale filter', 'dina-kala' ) ?>
            </label>
         </p>

         <p>
            <label for="<?php echo $this->get_field_id( 'show_instock' ); ?>">
            <input type="checkbox" id="<?php echo $this->get_field_id( 'show_instock' ); ?>" value="true" name="<?php echo $this->get_field_name( 'show_instock' ); ?>" <?php checked( $show_instock, 'true' ); ?> />
            <?php _e( 'Show In Stock filter', 'dina-kala' ) ?>
            </label>
         </p>

         <p>
            <label for="<?php echo $this->get_field_id( 'show_nocall' ); ?>">
            <input type="checkbox" id="<?php echo $this->get_field_id( 'show_nocall' ); ?>" value="true" name="<?php echo $this->get_field_name( 'show_nocall' ); ?>" <?php checked( $show_nocall, 'true' ); ?> />
            <?php _e( 'Show products filter without price (Soon and call)', 'dina-kala' ) ?>
            </label>
         </p>

      <?php
      }
   
      // Updating widget replacing old instances with new
      public function update( $new_instance, $old_instance ) {
      
         $instance = array();
         
         $instance['title']        = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
         $instance['show_onsale']  = sanitize_text_field( $new_instance['show_onsale'] );
         $instance['show_instock'] = sanitize_text_field( $new_instance['show_instock'] );
         $instance['show_nocall']  = sanitize_text_field( $new_instance['show_nocall'] );
         
         return $instance;
      
      }
   
   }
   
   // Register and load the widget
   function dina_onsale_stock_load_widget() {
      register_widget( 'dina_onsale_stock_widget' );
   }
   add_action( 'widgets_init', 'dina_onsale_stock_load_widget' );   