<?php
/*
Theme Designed By: Meysam Hosseinkhani
Email: Meysam98@Gmail.com
Author Website: i-design.ir
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
    exit;

    // register widget
   add_action( 'widgets_init', 'Dina_banner_image_widget' );
   function Dina_banner_image_widget() {
       register_widget( 'Dina_banner_image' );
   }
     
   // add admin scripts
   add_action( 'admin_enqueue_scripts', 'Dina_banner_image_script' );
   function Dina_banner_image_script() {
       wp_enqueue_media();
       wp_enqueue_script( 'ads_script', get_template_directory_uri() . '/js/upload-media.js', false, '1.0', true);
   } 
   
   // widget class
   class Dina_banner_image extends WP_Widget {
       public function __construct() {
            $widget_ops = array(
                    'classname'   => 'Dina_banner_image',
                    'description' => __( 'Display image in sidebar', 'dina-kala' )
                );

            parent::__construct( 'banner-image', __( 'Display image (DinaKala)', 'dina-kala' ), $widget_ops);
            $this->alt_option_name = 'Dina_banner_image';
       }
   
       function widget( $args, $instance) {
           extract( $args);
            // widget content  
            $hover_effect = isset( $instance['hover_effect'] ) ? $instance['hover_effect'] : '';
            $hover_title  = isset( $instance['hover_title'] ) ? $instance['hover_title'] : '';
         ?>
        <div class="bnr-image shadow-box <?php echo $hover_effect; ?>">
            <a aria-label="<?php echo $instance['text']; ?>" href="<?php echo esc_url( $instance['image_link'] ); ?>" target="<?php echo $instance['link_target']; ?>">

            <?php if ( $hover_title === 'show-title' ) { ?>
                <span class="bnr-hover-title">
                    <span>
                        <?php echo $instance['text']; ?>
                    </span>
                </span>
            <?php } ?>

            <?php 
				$image_id     = attachment_url_to_postid( esc_url( $instance['image_uri'] ) );
				$banner_image = wp_get_attachment_image_src( $image_id, 'full' );
				$width        = ( isset( $banner_image[1] ) ? ' width="' . $banner_image[1] . '"' : '' );
				$height       = ( isset( $banner_image[2] ) ? ' height="' . $banner_image[2] . '"' : '' );
            ?>
                <img alt="<?php echo $instance['text']; ?>" title="<?php echo $instance['text']; ?>" src="<?php echo esc_url( dina_to_https ( $instance['image_uri'] ) ); ?>"<?php echo $width . $height; ?> />
            </a>
        </div>

        <?php }

        function update( $new_instance, $old_instance) {
        
            $instance = $old_instance;
        
            $instance['text']         = strip_tags( $new_instance['text'] );
            $instance['image_uri']    = strip_tags( $new_instance['image_uri'] );
            $instance['image_link']   = strip_tags( $new_instance['image_link'] );
            $instance['hover_effect'] = strip_tags( $new_instance['hover_effect'] );
            $instance['hover_title']  = isset( $new_instance['hover_title'] ) ? sanitize_text_field( $new_instance['hover_title'] ) : '';
            $instance['link_target']  = strip_tags( $new_instance['link_target'] );

            return $instance;
        
        }

        function form( $instance) { 
            $hover_title = isset( $instance['hover_title'] ) ? $instance['hover_title'] : '';
            ?>
            <p>
            <label for="<?php echo $this->get_field_id( 'text' ); ?>">
                <?php _e( 'Title', 'dina-kala' ) ?>
            </label>

            <br />

            <input type="text" name="<?php echo $this->get_field_name( 'text' ); ?>" id="<?php echo $this->get_field_id( 'text' ); ?>" value="<?php if ( ! empty( $instance['text'] ) ) { echo $instance['text'];} ?>" class="widefat" />
            </p>

            <p>
                <label for="<?php echo $this->get_field_id( 'image_link' ); ?>">
                    <?php _e( 'Image Link', 'dina-kala' ) ?>
                </label>

                <br />

                <input type="text" name="<?php echo $this->get_field_name( 'image_link' ); ?>" id="<?php echo $this->get_field_id( 'image_link' ); ?>" value="<?php if ( ! empty( $instance['image_link'] ) ) { echo $instance['image_link']; } ?>" class="widefat" />
            </p>

            <p>
                <?php $hover_effect = ( ! empty( $instance['hover_effect'] ) ? $instance['hover_effect'] : 'none' ); ?>

                <label for="<?php echo $this->get_field_id( 'hover_effect' ); ?>">
                    <?php _e( 'Image hover effect', 'dina-kala' ) ?>
                </label>

                <br />

                <select class="widefat" name="<?php echo $this->get_field_name( 'hover_effect' ); ?>" id="<?php echo $this->get_field_id( 'hover_effect' ); ?>">
                    <option value="none" <?php selected( $hover_effect, 'none' ); ?>>
                        <?php _e( 'None', 'dina-kala' ) ?>
                    </option>
                    <option value="dina-brightness" <?php selected( $hover_effect, 'dina-brightness' ); ?>>
                        <?php _e( 'Brightness', 'dina-kala' ) ?>
                    </option>
                    <option value="dina-zoomin" <?php selected( $hover_effect, 'dina-zoomin' ); ?>>
                        <?php _e( 'Zoom In', 'dina-kala' ) ?>
                    </option>
                    <option value="dina-blur" <?php selected( $hover_effect, 'dina-rotate' ); ?>>
                        <?php _e( 'Rotate', 'dina-kala' ) ?>
                    </option>
                    <option value="dina-blur" <?php selected( $hover_effect, 'dina-blur' ); ?>>
                        <?php _e( 'Blur', 'dina-kala' ) ?>
                    </option>
                    <option value="dina-gray" <?php selected( $hover_effect, 'dina-gray' ); ?>>
                        <?php _e( 'Gray Scale', 'dina-kala' ) ?>
                    </option>
                    <option value="dina-opacity" <?php selected( $hover_effect, 'dina-opacity' ); ?>>
                        <?php _e( 'Opacity', 'dina-kala' ) ?>
                    </option>
                    <option value="dina-flash" <?php selected( $hover_effect, 'dina-flash' ); ?>>
                        <?php _e( 'Flashing', 'dina-kala' ) ?>
                    </option>
                    <option value="dina-shine" <?php selected( $hover_effect, 'dina-shine' ); ?>>
                        <?php _e( 'Shine', 'dina-kala' ) ?>
                    </option>
                    <option value="dina-circle" <?php selected( $hover_effect, 'dina-circle' ); ?>>
                        <?php _e( 'Circle', 'dina-kala' ) ?>
                    </option>
                </select>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id( 'hover_title' ); ?>">
                <input type="checkbox" id="<?php echo $this->get_field_id( 'hover_title' ); ?>" value="show-title" name="<?php echo $this->get_field_name( 'hover_title' ); ?>" <?php checked( $hover_title, 'show-title' ); ?> />
                <?php _e( 'Show image title on mouse hover', 'dina-kala' ) ?>
                </label>
            </p>

            <p>
                <?php $link_target = ( ! empty( $instance['link_target'] ) ? $instance['link_target'] : '' ); ?>

                <label for="<?php echo $this->get_field_id( 'link_target' ); ?>">
                    <?php _e( 'Target', 'dina-kala' ) ?>
                </label>

                <br />

                <select class="widefat" name="<?php echo $this->get_field_name( 'link_target' ); ?>" id="<?php echo $this->get_field_id( 'link_target' ); ?>">
                    <option value="_blank" <?php selected( $link_target, '_blank' ); ?>><?php _e( 'New window', 'dina-kala' ) ?></option>
                    <option value="_self" <?php selected( $link_target, '_self' ); ?>><?php _e( 'Same Window', 'dina-kala' ) ?></option>
                </select>
            </p>

            <p>
            <label for="<?php echo $this->get_field_id( 'image_uri' ); ?>"><?php _e( 'Image', 'dina-kala' ) ?></label><br />

            <?php
                if ( ! empty( $instance['image_uri'] ) ) {
                    echo '<img class="custom_media_image" src="' . $instance['image_uri'] . '" style="margin:0;padding:0;max-width:100px;float:left;display:inline-block" /><br />';
                }
            ?>

            <input type="text" class="widefat custom_media_url" name="<?php echo $this->get_field_name( 'image_uri' ); ?>" id="<?php echo $this->get_field_id( 'image_uri' ); ?>" value="<?php 
            if ( ! empty( $instance['image_uri'] ) ) {
            echo $instance['image_uri']; } ?>" style="margin-top:5px;">
            <input type="button" class="button button-primary custom_media_button" id="custom_media_button" name="<?php echo $this->get_field_name( 'image_uri' ); ?>" value="<?php _e( 'Upload Image', 'dina-kala' ) ?>" style="margin-top:5px;" />
            </p>

        <?php
        }
   
   }      