<?php
namespace Elementor;

class Dina_User_Buttons extends Widget_Base {

    
	public function get_name() {
		return 'dina-user-buttons';
	}
	
	public function get_title() {
		return __( 'User Buttons (Dinakala)', 'dina-kala' );
	}
	
	public function get_icon() {
		return 'fal fa-user';
	}

	public function get_help_url() {
		return 'https://i-design.ir/docs/dinakala/?p=1051';
	}
	
	public function get_categories() {
		return [ 'dina-kala-header' ];
	}
	
	protected function register_controls() {

		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'User Buttons (Dinakala)', 'dina-kala' ),
			]
		);

		$this->add_control(
			'user_btn_style',
			[
				'label'        => __( 'User buttons text style', 'dina-kala' ),
				'description'  => __( 'Show user buttons (login and register) in text style', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);
		
		$this->add_control(
			'digits_mode',
			[
				'label'        => __( 'Compatibility with Digits plugin', 'dina-kala' ),
				'description'  => __( 'If you have a Digit plugin installed, the login and registration button will be connected to this plugin', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'digits_page',
			[
				'label' => __( 'Link to Digits page instead of pop-up mode', 'dina-kala' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'dina-kala' ),
				'label_off' => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default' => '',
				'condition' => [
                    'digits_mode' => 'yes',
                ],
			]
		);
        
		$this->end_controls_section();
	}
	
	protected function render() {

        $settings = $this->get_settings_for_display();

		$user_btn_style  = $settings['user_btn_style'] === 'yes' ? true : false;
		$digits_mode     = $settings['digits_mode'] === 'yes' ? true : false;
		$digits_page     = $settings['digits_page'] === 'yes' ? true : false;
		
		if ( ! is_user_logged_in() ) { ?>

			<div class="di-el-user-btn">
				<?php
				if ( function_exists( 'digits_version' ) && $digits_mode ) {
					$digits_link  = $digits_page ? ' digitlink' : ' digitpopup';
					$button_class = $user_btn_style ? 'register-link digitsbtn' . $digits_link : 'btn btn-success btn-register digitsbtn' . $digits_link ; ?>
						<span title="<?php _e( 'Login Or Register', 'dina-kala' ); ?>" class="<?php echo $button_class; ?>">
							<i aria-hidden="true" class="fal fa-user"></i>
							<span><?php _e( 'Login | Register', 'dina-kala' ); ?></span>
						</span>
				<?php
				} else {
					$button_link = dina_opt( 'ch_login_link' ) ? 'href="'. dina_opt( 'login_link' ) .'"' : 'href="#" onclick="openLogin()"';
					$button_class = $user_btn_style ? 'register-link merge-btn' : 'btn btn-success btn-register merge-btn'; ?>
					<a title="<?php _e( 'Login Or Register', 'dina-kala' ); ?>" <?php echo $button_link; ?> class="<?php echo $button_class ?>">
						<i aria-hidden="true" class="fal fa-user"></i>
						<span><?php _e( 'Login | Register', 'dina-kala' ); ?></span>
					</a>
				<?php } ?>
			</div>

		<?php } else {
		$user = wp_get_current_user(); ?>

		<div class="dropdown user-drop di-el-user-drop">
			
			<button class="dropdown-toggle user-menu" type="button">
			<?php if ( class_exists( 'WooCommerce' ) ) { ?>
				<a href="<?php echo esc_url( dina_myaccount_link() ); ?>" title="<?php _e( 'Dashboard', 'dina-kala' ); ?>">
			<?php } ?>
				<?php echo get_avatar( get_current_user_id() , 32, '', $user->display_name ); ?>
				<span class="user-name">
					<?php echo $user->display_name; ?>
					<?php if ( ! empty ( dina_get_wallet() ) ) {       
						echo '<span class="wallet">  | '. dina_get_wallet() .'</span>';
					} ?>
				</span>
				<span class="fal fa-chevron-down user-chevron-down" aria-hidden="true"></span>
			<?php if ( class_exists( 'WooCommerce' ) ) { ?>
				</a>
			<?php } ?>
			</button>

			<?php if ( dina_opt( 'replace_user_menu' ) && has_nav_menu( 'user_menu' ) ) { ?>
				<?php
					wp_nav_menu( array(
						'menu'              => 'user_menu',
						'theme_location'    => 'user_menu',
						'menu_class'        => 'dropdown-menu user-menu mu-menu col-12',
						'depth'             => 1,
						'container'         => ''
						)
					);
				?>
			<?php } elseif ( class_exists( 'WooCommerce' ) ) { ?>
				<ul class="dropdown-menu user-menu mu-menu col-12">
					<?php get_template_part( 'includes/umenu' ); ?>
				</ul>
			<?php } ?>
		</div>
			
		<?php
		} 
	}
}