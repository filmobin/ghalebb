<?php
namespace Elementor;

class Text_Box extends Widget_Base {
	
	public function get_name() {
		return 'text-box';
	}
	
	public function get_title() {
		return __( 'Text Box (Dinakala)', 'dina-kala' );
	}
	
	public function get_icon() {
		return 'fal fa-text';
	}

	public function get_help_url() {
		return 'https://i-design.ir/docs/dinakala/?p=1045';
	}
	
	public function get_categories() {
		return [ 'dina-kala' ];
	}
	
	protected function register_controls() {

		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Text Box (Dinakala)', 'dina-kala' ),
			]
		); 

		$this->add_control(
			'text_box',
			[
				'label'       => __( 'Text', 'dina-kala' ),
				'type'        => \Elementor\Controls_Manager::WYSIWYG,
				'placeholder' => __( 'Type your text here', 'dina-kala' ),
			]
		);
        
		$this->end_controls_section();
	}
	
	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
        <div class="shadow-box text-box">
            <div class="text-box-area"><?php echo $settings['text_box']; ?></div>
        </div>
         <?php
	}
}