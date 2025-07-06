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
class Dina_Logo_Namad_widget extends WP_Widget {

   public function __construct() {
      $widget_ops = array( 'classname' => 'logo-namad_widget', 'description' => __( 'Logo display (DinaKala)', 'dina-kala' ) );
      parent::__construct( 'logo-namad', __( 'Logo display (DinaKala)', 'dina-kala' ), $widget_ops);
      $this->alt_option_name = 'dina-logo-namad_widget';
   }

   public function widget( $args, $instance ) {
      
      ob_start();
      extract( $args );

      $title      = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Site logos', 'dina-kala' ) : $instance['title'], $instance, $this->id_base);
      $logo_one   = isset( $instance['logo_one'] ) ? $instance['logo_one'] : '';
      $logo_two   = isset( $instance['logo_two'] ) ? $instance['logo_two'] : '';
      $logo_three = isset( $instance['logo_three'] ) ? $instance['logo_three'] : '';

      echo $before_widget;

      // Widget title
      echo $before_title;
      echo $instance["title"];
      echo $after_title;
         
         echo '<div class="row namad-row">';

         if ( $logo_one != '' ) { echo '<div class="col namad-con">'. $logo_one .'</div>'; }
         if ( $logo_two != '' ) { echo '<div class="col namad-con">'. $logo_two .'</div>'; }
         if ( $logo_three != '' ) { echo '<div class="col namad-con">'. $logo_three .'</div>'; }
        
      echo '</div>';
         
      echo $after_widget;

      $content = ob_get_clean();

      echo $content; // WPCS: XSS ok.
      
   }

   public function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      $instance['title']      = sanitize_text_field( $new_instance['title'] );
      $instance['logo_one']   = $new_instance['logo_one'];
      $instance['logo_two']   = $new_instance['logo_two'];
      $instance['logo_three'] = $new_instance['logo_three'];
      return $instance;
   }

   public function form( $instance ) {
      $title        = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
      $logo_one     = isset( $instance['logo_one'] ) ? $instance['logo_one'] : '';
      $logo_two     = isset( $instance['logo_two'] ) ? $instance['logo_two'] : '';
      $logo_three   = isset( $instance['logo_three'] ) ? $instance['logo_three'] : '';
   ?>

      <p>
         <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'dina-kala' ); ?></label>
         <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
      </p>

      <p>
         <label for="<?php echo $this->get_field_id( 'logo_one' ); ?>"><?php _e( 'First logo', 'dina-kala' ); ?></label>
         <textarea class="widefat code" rows="5" cols="20" id="<?php echo $this->get_field_id( 'logo_one' ); ?>" name="<?php echo $this->get_field_name( 'logo_one' ); ?>"><?php echo $logo_one; ?></textarea>
      </p>

      <p>
         <label for="<?php echo $this->get_field_id( 'logo_two' ); ?>"><?php _e( 'Second logo', 'dina-kala' ); ?></label>
         <textarea class="widefat code" rows="5" cols="20" id="<?php echo $this->get_field_id( 'logo_two' ); ?>" name="<?php echo $this->get_field_name( 'logo_two' ); ?>"><?php echo $logo_two; ?></textarea>
      </p>

      <p>
         <label for="<?php echo $this->get_field_id( 'logo_three' ); ?>"><?php _e( 'Third logo', 'dina-kala' ); ?></label>
         <textarea class="widefat code" rows="5" cols="20" id="<?php echo $this->get_field_id( 'logo_three' ); ?>" name="<?php echo $this->get_field_name( 'logo_three' ); ?>"><?php echo $logo_three; ?></textarea>
      </p>
   <?php
   }
}

//register Logo Namad Widget
function dina_logo_namad_widget() {
   return register_widget( "Dina_Logo_Namad_widget" );
}
add_action( 'widgets_init', 'dina_logo_namad_widget' );