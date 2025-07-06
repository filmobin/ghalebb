<?php
namespace Elementor;

class Dina_Mobile_User_Buttons extends Widget_Base {

    
	public function get_name() {
		return 'dina-mobile-user-buttons';
	}
	
	public function get_title() {
		return __( 'Mobile user buttons (Dinakala)', 'dina-kala' );
	}
	
	public function get_icon() {
		return 'fal fa-user';
	}

	public function get_help_url() {
		return 'https://i-design.ir/docs/dinakala/?p=1059';
	}
	
	public function get_categories() {
		return [ 'dina-kala-header' ];
	}
	
	protected function register_controls() {

		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Mobile user buttons (Dinakala)', 'dina-kala' ),
			]
		);
		
		$this->add_control(
			'mobile_user_btn_style',
			[
				'label'        => __( 'Text style of user buttons in mobile mode', 'dina-kala' ),
				'description'  => __( 'Show user buttons (login and register) in text style in mobile mode', 'dina-kala' ),
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

		$mobile_user_btn_style  = $settings['mobile_user_btn_style'] === 'yes' ? true : false;
		$digits_mode            = $settings['digits_mode'] === 'yes' ? true : false;
		$digits_page            = $settings['digits_page'] === 'yes' ? true : false;
        
		?>
		
		<div class="di-el-mobile-btns mobile-btns<?php if ( $mobile_user_btn_style ) { echo ' mobile-text-style'; } ?>">	
			<?php if ( ! is_user_logged_in() ) { ?>
				<?php
				if ( function_exists( 'digits_version' ) && $digits_mode ) {
					$digits_link = ( $digits_page ? 'digitlink' : 'digitpopup' ); ?>
					<span title="<?php _e( 'Login Or Register', 'dina-kala' ); ?>" class="btn btn-light mlogin mergedbtn digitsbtn <?php echo $digits_link; ?>">
						<i aria-hidden="true" data-title="<?php _e( 'Login', 'dina-kala' ); ?>" class="fal fa-user"></i>
							<span class="login-separator">|</span>
						<i aria-hidden="true" data-title="<?php _e( 'Register', 'dina-kala' ); ?>" class="fal fa-user-plus"></i>
					</span>
				<?php } else { ?>
					<a title="<?php _e( 'Login', 'dina-kala' ); ?>" <?php if ( dina_opt( 'ch_login_link' ) ) { echo 'href="'. dina_opt( 'login_link' ) .'"'; } else { echo 'href="#" onclick="openLogin()"';} ?> class="btn btn-light mlogin mergedbtn">
						<i aria-hidden="true" data-title="<?php _e( 'Login', 'dina-kala' ); ?>" class="fal fa-user"></i>
							<span class="login-separator">|</span>
						<i aria-hidden="true" data-title="<?php _e( 'Register', 'dina-kala' ); ?>" class="fal fa-user-plus"></i>
					</a>
				<?php }
			} else { ?>
				<a title="<?php _e( 'User Menu', 'dina-kala' ); ?>" class="btn btn-light musermenu" onclick="openUmenu()">
					<i aria-hidden="true" data-title="<?php _e( 'User Menu', 'dina-kala' ); ?>" class="fal fa-user"></i>
				</a>
			<?php } ?>
		</div>

		<?php
	}
}