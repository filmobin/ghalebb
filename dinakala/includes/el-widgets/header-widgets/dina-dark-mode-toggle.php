<?php
namespace Elementor;

class Dina_Dark_Mode_Toggle extends Widget_Base {

    
	public function get_name() {
		return 'dina-dark-mode-toggle';
	}
	
	public function get_title() {
		return __( 'Dark mode toggle (Dinakala)', 'dina-kala' );
	}
	
	public function get_icon() {
		return 'fal fa-moon';
	}

	public function get_help_url() {
		return 'https://i-design.ir/docs/dinakala/?p=1069';
	}
	
	public function get_categories() {
		return [ 'dina-kala-header' ];
	}
	
	protected function register_controls() {

		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Dark mode toggle (Dinakala)', 'dina-kala' ),
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
				'default' => 'yes',
			]
		);
        
		$this->end_controls_section();
	}
	
	protected function render() {

        $settings = $this->get_settings_for_display();

        $show_hover_title = $settings['show_hover_title'] === 'yes' ? true : false;

		?>
		<div class="btn-di-toggle di-el-btn-di-toggle">
			<i aria-hidden="true" class="di-toggle-icon fal fa-moon" <?php if ( $show_hover_title ) { ?>data-toggle="tooltip" data-placement="top" title="<?php _e( 'Dark mode', 'dina-kala' ); ?>"<?php } ?>></i>
			<i aria-hidden="true" class="di-toggle-icon fal fa-sun" <?php if ( $show_hover_title ) { ?>data-toggle="tooltip" data-placement="top" title="<?php _e( 'Light mode', 'dina-kala' ); ?>"<?php } ?>></i>
		</div>
        <?php
	}
}