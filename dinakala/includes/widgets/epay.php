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
class epay_widget extends WP_Widget {
   
   function __construct() {
   
      parent::__construct(
      
      // Base ID of your widget
      'epay_widget',
      
      // Widget name will appear in UI
      __( 'Online Payment (Dinakala)', 'dina-kala' ),
      
      
      
      // Widget description
      array( 'description' => __( 'Accelerated Banks Logo Display', 'dina-kala' ), )
      
      );
   
   }
   
   // Creating widget front-end
   
   // This is where the action happens
   public function widget( $args, $instance ) {
   
      $title = isset( $instance[ 'title' ] ) ? apply_filters( 'widget_title', $instance['title'] ) : '';
      
      // before and after widget arguments are defined by themes
      echo $args['before_widget'];
      
      if ( ! empty( $title ) )
         echo $args['before_title'] . $title . $args['after_title'];
      
   
      // This is where you run the code and display the output
      echo 
      '<ul class="b-ul">
         <li class="b-img b1"></li>
         <li class="b-img b2"></li>
         <li class="b-img b3"></li>
         <li class="b-img b4"></li>
         <li class="b-img b5"></li>
         <li class="b-img b6"></li>
         <li class="b-img b7"></li>
         <li class="b-img b8"></li>
         <li class="b-img b9"></li>
         <li class="b-img b10"></li>
         <li class="b-img b11"></li>
         <li class="b-img b12"></li>
         <li class="b-img b13"></li>
         <li class="b-img b14"></li>
         <li class="b-img b15"></li>
         <li class="b-img b16"></li>
      </ul>';
   
      echo $args['after_widget'];
   
   }
   
    
   
   // Widget Backend
   public function form( $instance ) {

      $title = isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : __( 'Online Payment', 'dina-kala' );
      
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
   
      $instance          = array();
      $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
      
      return $instance;
   
   }
   
   } // Class wpb_widget ends here
   
    
   
   // Register and load the widget
   function epay_load_widget() {
      register_widget( 'epay_widget' );
   }
   
   add_action( 'widgets_init', 'epay_load_widget' );   