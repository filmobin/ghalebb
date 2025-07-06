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

class DinaLogoSlider extends WP_Widget {

	public function __construct() {
		$widget_ops = array(
			'classname'   => 'dina_logo_slider',
			'description' => __( 'Logo Slider (DinaKala)', 'dina-kala' )
		);
		parent::__construct( 'dina-logo-list', __( 'Logo Slider (DinaKala)', 'dina-kala' ), $widget_ops );
		$this->alt_option_name = 'dina-logo-list';
	}

	function widget( $args, $instance) {
        extract( $args );
			$title      = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Logo Slider', 'dina-kala' ) : $instance['title'], $instance, $this->id_base);
			$logo_one   = isset( $instance['logo_one'] ) ? $instance['logo_one'] : '';
			$logo_two   = isset( $instance['logo_two'] ) ? $instance['logo_two'] : '';
			$logo_three = isset( $instance['logo_three'] ) ? $instance['logo_three'] : '';
			$logo_four  = isset( $instance['logo_four'] ) ? $instance['logo_four'] : '';
			$auto_play  = isset( $instance['auto_play'] ) && $instance['auto_play'] == 'auto-play' ? ' data-itemplay="true"' : ' data-itemplay="false"';
            echo $before_widget;
   			// Widget title
   			echo $before_title;
   			echo $instance["title"];
   			echo $after_title;
   		?>

		 <div class="dina-logo-list owl-carousel"<?php echo $auto_play; ?>>
		 	<?php if ( $logo_one != '' ) { echo '<div class="item">'. $logo_one .'</div>'; } ?>
            <?php if ( $logo_two != '' ) { echo '<div class="item">'. $logo_two .'</div>'; } ?>
            <?php if ( $logo_three != '' ) { echo '<div class="item">'. $logo_three .'</div>'; } ?>
            <?php if ( $logo_four != '' ) { echo '<div class="item">'. $logo_four .'</div>'; } ?>
		</div>

<?php   echo $after_widget;
  	}

    public function update( $new_instance, $old_instance ) {
		$instance               = $old_instance;
		$instance['title']      = sanitize_text_field( $new_instance['title'] );
		$instance['logo_one']   = $new_instance['logo_one'];
		$instance['logo_two']   = $new_instance['logo_two'];
		$instance['logo_three'] = $new_instance['logo_three'];
		$instance['logo_four']  = $new_instance['logo_four'];
		$instance['auto_play']  = sanitize_text_field( $new_instance['auto_play'] );
		return $instance;
    }

   	public function form( $instance ) {

		$title      = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$logo_one   = isset( $instance['logo_one'] ) ? $instance['logo_one'] : '';
		$logo_two   = isset( $instance['logo_two'] ) ? $instance['logo_two'] : '';
		$logo_three = isset( $instance['logo_three'] ) ? $instance['logo_three'] : '';
		$logo_four  = isset( $instance['logo_four'] ) ? $instance['logo_four'] : '';
		$auto_play  = isset( $instance['auto_play'] ) ? $instance['auto_play'] : '';
    ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'auto_play' ); ?>">
			<input type="checkbox" id="<?php echo $this->get_field_id( 'auto_play' ); ?>" value="auto-play" name="<?php echo $this->get_field_name( 'auto_play' ); ?>" <?php checked( $auto_play, 'auto-play' ); ?> />
			<?php _e( 'Automatic slider movement', 'dina-kala' ) ?>
			</label>
		</p>

		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'dina-kala' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>

		<p><label for="<?php echo $this->get_field_id( 'logo_one' ); ?>"><?php _e( 'First logo', 'dina-kala' ); ?></label>
			<textarea class="widefat code" rows="5" cols="20" id="<?php echo $this->get_field_id( 'logo_one' ); ?>" name="<?php echo $this->get_field_name( 'logo_one' ); ?>"><?php echo $logo_one; ?></textarea>
		</p>

		<p><label for="<?php echo $this->get_field_id( 'logo_two' ); ?>"><?php _e( 'Second logo', 'dina-kala' ); ?></label>
			<textarea class="widefat code" rows="5" cols="20" id="<?php echo $this->get_field_id( 'logo_two' ); ?>" name="<?php echo $this->get_field_name( 'logo_two' ); ?>"><?php echo $logo_two; ?></textarea>
		</p>

		<p><label for="<?php echo $this->get_field_id( 'logo_three' ); ?>"><?php _e( 'Third logo', 'dina-kala' ); ?></label>
			<textarea class="widefat code" rows="5" cols="20" id="<?php echo $this->get_field_id( 'logo_three' ); ?>" name="<?php echo $this->get_field_name( 'logo_three' ); ?>"><?php echo $logo_three; ?></textarea>
		</p>
		
		<p><label for="<?php echo $this->get_field_id( 'logo_four' ); ?>"><?php _e( 'Fourth logo', 'dina-kala' ); ?></label>
			<textarea class="widefat code" rows="5" cols="20" id="<?php echo $this->get_field_id( 'logo_four' ); ?>" name="<?php echo $this->get_field_name( 'logo_four' ); ?>"><?php echo $logo_four; ?></textarea>
		</p>
	<?php
    }
}
   // register LOGO SLIDER Widget
   add_action( 'widgets_init', function() {return register_widget("DinaLogoSlider");});