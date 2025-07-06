<?php
/*
Theme Designed By: Meysam Hosseinkhani
Email: Meysam98@Gmail.com
Author Website: i-design.ir
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
    exit;

// Creating the widget
   
class Dina_Fnews_widget extends WP_Widget {
   
    function __construct() {

        parent::__construct(
        
        //Base ID of your widget
        'dina-fnews_widget',
            
        //Widget name will appear in UI
        __( 'Feedburner newsletter (DinaKala)', 'dina-kala' ),
        
            
        //Widget description
        array( 'description' => __( 'Subscribe to the feedburner newsletter', 'dina-kala' ), )
        
        );

    }
   
    // Creating widget front-end
   
    // This is where the action happens
    public function widget( $args, $instance ) {


        $title = isset( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'] ) : '';

        //before and after widget arguments are defined by themes
        echo $args['before_widget'];

        if ( ! empty( $title) )
            echo $args['before_title'] . $title . $args['after_title'];

        $feed_url = isset( $instance['feed_url'] ) ? $instance['feed_url'] : '';
        $feed_msg = isset( $instance['feed_url'] ) ? $instance['feed_url'] : '';

        // This is where you run the code and display the output
        ?>

        <div class="fnews">
            <i class="fal fa-envelope-open-text news-icon" aria-hidden="true"></i>
            <div class="news-text">
                <?php echo $feed_msg; ?>
            </div>

            <form action="https://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open( 'https://feedburner.google.com/fb/a/mailverify?uri=<?php echo $feed_url; ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520' );return true" class="form-inline feed-form">
                <div class="input-group news-form">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fal fa-envelope" aria-hidden="true"></i>
                        </span>
                    </div>
                    <input name="email" id="feedemail" type="text" class="form-control news-input" aria-label="<?php _e( 'Email', 'dina-kala' ); ?>" required placeholder="<?php _e( 'Enter your email ...', 'dina-kala' ); ?>" autocomplete="email">
                    <input type="hidden" value="<?php echo $feed_url ?>" name="uri"/>
                    <input type="hidden" name="loc" value="en_US"/>
                    <div class="input-group-append">
                        <button class="btn btn-primary btn-news" type="submit" aria-label="<?php _e( 'Register', 'dina-kala' ); ?>">
                            <?php _e( 'Register', 'dina-kala' ); ?>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <?php

        echo $args['after_widget'];

    }
   
    
   
   //Widget Backend
   public function form( $instance ) {
   
        $title    = isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : __( 'Subscribe to newsletter', 'dina-kala' );
        $feed_url = isset( $instance[ 'feed_url' ] ) ? $instance[ 'feed_url' ] : '';
        $feed_msg = isset( $instance[ 'feed_msg' ] ) ? $instance[ 'feed_msg' ] : '';
    
        //Widget admin form
        ?>
        <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' , 'dina-kala' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /><br /><br />
        <label for="<?php echo $this->get_field_id( 'feed_url' ); ?>"><?php _e( 'The name of the feedburner: (your username without http://feeds.feedburner.com/)', 'dina-kala' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'feed_url' ); ?>" name="<?php echo $this->get_field_name( 'feed_url' ); ?>" type="text" value="<?php
        if ( ! empty( $feed_url) ) {
        echo esc_attr( $feed_url);} ?>" /><br /><br />
        <label for="<?php echo $this->get_field_id( 'feed_msg' ); ?>"><?php _e( 'Message', 'dina-kala' ); ?></label>
        <textarea class="widefat" id="<?php echo $this->get_field_id( 'feed_msg' ); ?>" name="<?php echo $this->get_field_name( 'feed_msg' ); ?>" cols="20" rows="3"><?php if ( ! empty( $feed_msg ) ) { echo esc_attr( $feed_msg); } ?></textarea>
        </p>
    <?php
    }
   
    //Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {

        $instance             = array();
        $instance['title']    = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['feed_url'] = ( ! empty( $new_instance['feed_url'] ) ) ? strip_tags( $new_instance['feed_url'] ) : '';
        $instance['feed_msg'] = ( ! empty( $new_instance['feed_msg'] ) ) ? strip_tags( $new_instance['feed_msg'] ) : '';

        return $instance;

    }

} 
//Class wpb_widget ends here
   
//Register and load the widget
add_action( 'widgets_init', 'dina_fnews_load_widget' ); 
function dina_fnews_load_widget() {
    register_widget( 'Dina_Fnews_widget' );
}  