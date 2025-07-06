<?php
namespace Elementor;

class Dina_Ads_Image extends Widget_Base {
	
	public function get_name() {
		return 'ads-image';
	}
	
	public function get_title() {
		return __( 'Advertising banner (Dinakala)', 'dina-kala' );
	}
	
	public function get_icon() {
		return 'fal fa-image';
	}

	public function get_help_url() {
		return 'https://i-design.ir/docs/dinakala/?p=1026';
	}
	
	public function get_categories() {
		return [ 'dina-kala' ];
	}
	
	protected function register_controls() {

		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Advertising banner (Dinakala)', 'dina-kala' ),
			]
		);
		
		$this->add_control(
			'img_title',
			[
				'label'       => __( 'Image title', 'dina-kala' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter image title', 'dina-kala' ),
				'default'     => __( '#', 'dina-kala' ),
			]
        );
        
        $this->add_control(
			'img_link',
			[
				'label'         => __( 'Image link', 'dina-kala' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'dina-kala' ),
				'show_external' => true,
				'default'       => [
					'url'         => '#',
					'is_external' => true,
					'nofollow'    => false,
				],
			]
        );

		$this->add_control(
			'hover_effect',
			[
				'label'   => __( 'Image hover effect', 'dina-kala' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'dina-brightness',
				'options' => [
					'none'            => __( 'None', 'dina-kala' ),
					'dina-brightness' => __( 'Brightness', 'dina-kala' ),
					'dina-zoomin'     => __( 'Zoom In', 'dina-kala' ),
					'dina-rotate'     => __( 'Rotate', 'dina-kala' ),
					'dina-blur'       => __( 'Blur', 'dina-kala' ),
					'dina-gray'       => __( 'Gray Scale', 'dina-kala' ),
					'dina-opacity'    => __( 'Opacity', 'dina-kala' ),
					'dina-flash'      => __( 'Flashing', 'dina-kala' ),
					'dina-shine'      => __( 'Shine', 'dina-kala' ),
					'dina-circle'     => __( 'Circle', 'dina-kala' )
				],
			]
		);

		$this->add_control(
			'circle_style',
			[
				'label'        => __( 'Circle style', 'dina-kala' ),
				'description'  => __( 'Suitable for square and circle images (not suitable for rectangular images)', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_control(
			'hover_title',
			[
				'label'        => __( 'Show image title on mouse hover', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_control(
			'fixed_title',
			[
				'label'        => __( 'Display the title of the image in a fixed way', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_control(
			'inherit_title_bg_color',
			[
				'label'        => __( 'Inheriting title background color from template color', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'conditions'   => [
					'relation' => 'or',
					'terms'    => [
						[
							'name'     => 'fixed_title',
							'operator' => '===',
							'value'    => 'yes',
						],
						[
							'name'     => 'hover_title',
							'operator' => '===',
							'value'    => 'yes',
						],
					],
				],
			]
		);

		$this->add_control(
			'title_border_color',
			[
				'label'     => __( 'Title background color', 'dina-kala' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#17A2B8',
				'selectors' => [
					'{{WRAPPER}} .bnr-hover-title' => 'background: {{VALUE}}',
				],
				'condition' => [
					'inherit_title_bg_color' => '',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => __( 'Title color', 'dina-kala' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .bnr-hover-title span'    => 'color: {{VALUE}}',
					'{{WRAPPER}} .bnr-hover-title::before' => 'border-color: {{VALUE}}',
				],
			]
		);
        
        $this->add_control(
			'image',
			[
				'label'   => __( 'Choose Image', 'dina-kala' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
        
		$this->end_controls_section();
	}
	
	protected function render() {
		$settings     = $this->get_settings_for_display();
		$target       = ! empty ( $settings['img_link']['is_external'] ) ? ' target="_blank"' : '';
		$nofollow     = ! empty ( $settings['img_link']['nofollow'] ) ? ' rel="nofollow"' : '';
		$hover_title  = $settings['hover_title'];
		$fixed_title  = $settings['fixed_title'];
		$img_title    = $settings['img_title'];
		$classes      = 'bnr-image shadow-box ';
		$classes     .= $settings['hover_effect'];
		$classes     .= $settings['circle_style'] == 'yes' ? ' dina-circle-style' : '';
		$classes     .= $fixed_title == 'yes' ? ' dina-fixed-title' : '';
	?>
        <div class="<?php echo $classes ?>">
			<?php if ( ! empty ( $settings['img_link']['url'] ) ) { ?>
            	<a href="<?php echo $settings['img_link']['url']; ?>" title="<?php echo $settings['img_title']; ?>"<?php echo $target . $nofollow; ?>>
			<?php } ?>

				<?php if ( $hover_title === 'yes' || $fixed_title === 'yes' ) { ?>
					<span class="bnr-hover-title">
						<span>
							<?php echo $img_title; ?>
						</span>
					</span>
				<?php } ?>

				<?php 
				$image_attributes = wp_get_attachment_metadata( $settings['image']['id'] );
				$width = ( isset( $image_attributes['width'] ) ? ' width="' . $image_attributes['width'] . '"' : '' );
				$height = ( isset( $image_attributes['height'] ) ? ' height="' . $image_attributes['height'] . '"' : '' );
				 ?>
                <img src="<?php echo $settings['image']['url']; ?>" alt="<?php echo $img_title; ?>"<?php echo $width . $height; ?>>
				
			<?php if ( ! empty ( $settings['img_link']['url'] ) ) { ?>
            	</a>
			<?php } ?>
        </div>
        <?php
	}
}