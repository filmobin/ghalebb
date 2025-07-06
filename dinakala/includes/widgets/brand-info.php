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
class dina_brand_info extends WP_Widget {

   function __construct() {
   
      parent::__construct(
      
      // Base ID of your widget
      'dina_brand_info',
      
      // Widget name will appear in UI
      __( 'Brand information (Dinakala)', 'dina-kala' ),
      
      // Widget description
      array( 'description' => __( 'Show brand information on brand page, this widget is only displayed on brand archive pages', 'dina-kala' ), )
      
      );
   
   }

   // Creating widget front-end   
   public function widget( $args, $instance ) {

      if ( ! is_tax( dina_opt( 'product_brand_taxonomy' ) ) )
         return;
   
         $title             = apply_filters( 'widget_title', $instance['title'] );
         $show_brand_logo   = isset( $instance['show_brand_logo'] ) ? $instance['show_brand_logo'] : '';
         $show_brand_title  = isset( $instance['show_brand_title'] ) ? $instance['show_brand_title'] : '';
         $brand_id          = get_queried_object()->term_id;
         $brand_name        = get_queried_object()->name;
      
         // before and after widget arguments are defined by themes
         echo $args['before_widget'];
      
         if ( ! empty( $title ) )
            echo $args['before_title'] . $title . $args['after_title'];

         if ( ! empty( $brand_id ) && $show_brand_logo ) {
            $brand_logo = get_term_meta( $brand_id, 'dina_brand_logo', true );
            if ( ! empty( $brand_logo ) )
               echo '<img src="'. $brand_logo . '" alt="'. $brand_name .'" title="'. $brand_name .'" class="brand-logo">';
         }
         
         if ( ! empty( $brand_id ) && $show_brand_title ) {
            echo '<strong class="dina-brand-name">'. $brand_name .'</strong>';
            echo '<div class="dina-brand-info">'. __( 'Registered products with this brand', 'dina-kala' ) .'</div>';
         }

         // This is where you run the code and display the output
      ?>
      
      <?php
         echo $args['after_widget'];

   }

   // Widget Backend
   public function form( $instance ) {
   
      $title             = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : __( 'Brand information', 'dina-kala' );
      $show_brand_logo   = isset( $instance['show_brand_logo'] ) ? $instance['show_brand_logo'] : '';
      $show_brand_title  = isset( $instance['show_brand_title'] ) ? $instance['show_brand_title'] : '';
      
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
         <label for="<?php echo $this->get_field_id( 'show_brand_title' ); ?>">
         <input type="checkbox" id="<?php echo $this->get_field_id( 'show_brand_title' ); ?>" value="true" name="<?php echo $this->get_field_name( 'show_brand_title' ); ?>" <?php checked( $show_brand_title, 'true' ); ?> />
         <?php _e( 'Show brand title', 'dina-kala' ) ?>
         </label>
      </p>

   <?php
   }

   // Updating widget replacing old instances with new
   public function update( $new_instance, $old_instance ) {
   
      $instance = array();
      
      $instance['title']              = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
      $instance['show_brand_logo']    = sanitize_text_field( $new_instance['show_brand_logo'] );
      $instance['show_brand_title']   = sanitize_text_field( $new_instance['show_brand_title'] );
      
      return $instance;
   
   }

}
   
// Register and load the widget
function dina_brand_info_load_widget() {
   register_widget( 'dina_brand_info' );
}
add_action( 'widgets_init', 'dina_brand_info_load_widget' );   