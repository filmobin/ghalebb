<?php
namespace Elementor;

class Dina_Mobile_Menu_Btn extends Widget_Base {

    
	public function get_name() {
		return 'dina-mobile-menu-btn';
	}
	
	public function get_title() {
		return __( 'Mobile menu button (Dinakala)', 'dina-kala' );
	}
	
	public function get_icon() {
		return 'fal fa-bars';
	}

	public function get_help_url() {
		return 'https://i-design.ir/docs/dinakala/?p=1060';
	}
	
	public function get_categories() {
		return [ 'dina-kala-header' ];
	}
	
	protected function register_controls() {

		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Mobile menu button (Dinakala)', 'dina-kala' ),
			]
		);
		
		$this->add_control(
			'show_hover_title',
			[
				'label' => __( 'Show title when hovering mouse', 'dina-kala' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'dina-kala' ),
				'label_off' => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$this->add_control(
			'mobile_menu_text_style',
			[
				'label'        => __( 'Mobile menu button text style', 'dina-kala' ),
				'description'  => __( 'Show mobile menu button in text style', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_control(
			'mobile_menu_text',
			[
				'label' => __( 'Button text', 'dina-kala' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Menu', 'dina-kala' ),
				'condition' => [
					'mobile_menu_text_style' => 'yes',
				],
			]
		);
        
		$this->end_controls_section();
	}
	
	protected function render() {

        $settings = $this->get_settings_for_display();

        $show_hover_title = $settings['show_hover_title'] === 'yes' ? true : false;
		$mobile_menu_text_style  = $settings['mobile_menu_text_style'] === 'yes' ? true : false;
        $mobile_menu_text = $settings['mobile_menu_text'];
	?>
		<span class="btn btn-light di-el-btn-mobile-menu<?php if ( $mobile_menu_text_style ) { echo ' menu-btn-text-style'; } ?>" onclick="openNav()"<?php if ( $show_hover_title ) { ?> data-toggle="tooltip" data-placement="top" title="<?php _e( 'Menu', 'dina-kala' ); ?>"<?php } ?>>
			<i aria-hidden="true" data-title="<?php echo $mobile_menu_text; ?>" class="fal fa-bars"></i>
		</span>
	<?php
	}
}