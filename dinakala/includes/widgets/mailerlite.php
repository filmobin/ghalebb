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
   
   class Dina_MailerLite_widget extends WP_Widget {
   
    
   
   function __construct() {
   
   parent::__construct(
   
   // Base ID of your widget
   
   'dina-mailerlite_widget',
   
    
   
   // Widget name will appear in UI
   
   __( 'MailerLite newsletter (DinaKala)', 'dina-kala' ),
   
    
   
   // Widget description
   
   array( 'description' => __( 'Subscribe to the MailerLite newsletter', 'dina-kala' ), )
   
   );
   
   }
   
   // Creating widget front-end
   
   // This is where the action happens
   
   public function widget( $args, $instance ) {
   
   $title = apply_filters( 'widget_title', $instance['title'] );
   
   // before and after widget arguments are defined by themes
   
   echo $args['before_widget'];
   
   if ( ! empty( $title ) )
        echo $args['before_title'] . $title . $args['after_title'];

   $feed_url = $instance['feed_url'];
   $feed_msg = $instance['feed_msg'];
   
   // This is where you run the code and display the output
   ?>

   <div class="fnews">
        <i class="fal fa-envelope-open-text news-icon" aria-hidden="true"></i>
        <div class="news-text">
            <?php echo $feed_msg; ?>
        </div>
        <div id="mlb2-3594898" class="ml-form-embedContainer ml-subscribe-form ml-subscribe-form-3594898">
            <form class="form-inline feed-form ml-block-form" action="https://static.mailerlite.com/webforms/submit/k8h2a1" data-code="k8h2a1" method="post" target="_blank">
                <div class="ml-form-formContent">
                    <div class="input-group news-form ml-field-group ml-field-email ml-validate-email ml-validate-required">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fal fa-envelope" aria-hidden="true"></i>
                            </span>
                        </div>
                        <input aria-label="email" aria-required="true" type="email" class="form-control news-input" data-inputmask="" name="fields[email]" placeholder="ایمیل خود را وارد نمایید ..." autocomplete="email" required>
                        <div class="input-group-append ml-form-embedSubmit">
                            <button type="submit" class="btn btn-primary btn-news primary">
                                <?php _e( 'Register', 'dina-kala' ); ?>
                            </button>
                            <button disabled="disabled" style="display:none" type="button" class="btn btn-primary loading">
                                <div class="ml-form-embedSubmitLoad"></div>
                                <span class="sr-only">
                                    <?php _e( 'Loading...', 'dina-kala' ); ?>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="ml-submit" value="1"></p>
                <input type="hidden" name="anticsrf" value="true">
            </form>

            <div class="ml-form-successBody row-success" style="display:none">
                <div class="ml-form-successContent">
                    <i class="fal fa-check-circle" aria-hidden="true"></i>
                    <?php _e( 'Your email was successfully registered', 'dinakala' ); ?>
                </div>
            </div>

        </div>
            <script>
                function ml_webform_success_3594898() {
                    var r=ml_jQuery||jQuery;r(".ml-subscribe-form-3594898 .row-success").show(),
                    r(".ml-subscribe-form-3594898 .row-form").hide()
                }
            </script>
            <img src="https://track.mailerlite.com/webforms/o/3594898/k8h2a1?v1629371066" width="1" height="1" style="max-width:1px;max-height:1px;visibility:hidden;padding:0;margin:0;display:block" alt="." border="0"><br>
            <script src="https://static.mailerlite.com/js/w/webforms.min.js?v0c75f831c56857441820dcec3163967c" type="text/javascript"></script>
   </div>

   <?php
   echo $args['after_widget'];
   
   }
   
    
   
   // Widget Backend
   
   public function form( $instance ) {
   
    $title    = isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : __( 'Subscribe to newsletter', 'dina-kala' );
    $feed_url = isset( $instance[ 'feed_url' ] ) ? $instance[ 'feed_url' ] : '';
    $feed_msg = isset( $instance[ 'feed_msg' ] ) ? $instance[ 'feed_msg' ] : '';
   
   // Widget admin form
   
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
   
   // Updating widget replacing old instances with new
   
   public function update( $new_instance, $old_instance ) {
   
   $instance             = array();
   $instance['title']    = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
   $instance['feed_url'] = ( ! empty( $new_instance['feed_url'] ) ) ? strip_tags( $new_instance['feed_url'] ) : '';
   $instance['feed_msg'] = ( ! empty( $new_instance['feed_msg'] ) ) ? strip_tags( $new_instance['feed_msg'] ) : '';
   
   return $instance;
   
   }
   
   } // Class wpb_widget ends here
   
    
   
   // Register and load the widget
   
   function dina_mailerlite_load_widget() {
   
   register_widget( 'Dina_MailerLite_widget' );
   
   }
   
   add_action( 'widgets_init', 'dina_mailerlite_load_widget' );   