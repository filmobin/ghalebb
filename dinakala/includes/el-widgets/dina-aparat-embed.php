<?php
namespace Elementor;

class Dina_Aparat_Embed extends Widget_Base {
	
	public function get_name() {
		return 'aparat-embed';
	}
	
	public function get_title() {
		return __( 'Aparat embed (Dinakala)', 'dina-kala' );
	}
	
	public function get_icon() {
		return 'dico ico-aparat';
	}

	public function get_help_url() {
		return 'https://i-design.ir/docs/dinakala/?p=2026';
	}
	
	public function get_categories() {
		return [ 'dina-kala' ];
	}
	
	protected function register_controls() {

		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Aparat embed (Dinakala)', 'dina-kala' ),
			]
		);

		$this->add_control(
			'video_title',
			[
				'label'       => __( 'Video title', 'dina-kala' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
			]
        );

		$this->add_control(
			'video_id',
			[
				'label'       => __( 'Video ID', 'dina-kala' ),
				'description' => __( 'Enter only id of the video (example: 4pN2B)<br>https://www.aparat.com/v/4pN2B', 'dina-kala' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
			]
        );

		$this->end_controls_section();
	}
	
	protected function render() {
		$settings    = $this->get_settings_for_display();
		$video_id    = $settings['video_id'];
		$video_title = ! empty ( $settings['video_title'] ) ? $settings['video_title'] : get_the_title( get_the_ID() );

		echo '<div class="dina-el-aparat">';
		if ( ! empty ( $video_id ) ) {
			echo '<div class="h_iframe-aparat_embed_frame"><span style="display: block;padding-top: 57%"></span><iframe src="https://www.aparat.com/video/video/embed/videohash/'. $video_id .'/vt/frame" title="'. $video_title .'" allowFullScreen="true" webkitallowfullscreen="true" mozallowfullscreen="true"></iframe></div>';
		} else {
			_e( 'Enter the video ID', 'dina-kala' );
			echo '<i class="dico ico-aparat"></i>';
		}
		echo '</div>';
	}
}