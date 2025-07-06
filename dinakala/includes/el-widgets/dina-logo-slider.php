<?php
namespace Elementor;

class Logo_Slider extends Widget_Base {
	
	public function get_name() {
		return 'logo-slider';
	}
	
	public function get_title() {
		return __( 'Logo slider (Dinakala)', 'dina-kala' );
	}
	
	public function get_icon() {
		return 'fal fa-forward';
	}

	public function get_help_url() {
		return 'https://i-design.ir/docs/dinakala/?p=1027';
	}
	
	public function get_categories() {
		return [ 'dina-kala' ];
	}
	
	protected function register_controls() {

		//Start Title Section 
		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Title settings', 'dina-kala' ),
			]
		);

		$this->add_control(
			'slider_title',
			[
				'label'       => __( 'Slider title', 'dina-kala' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter your title', 'dina-kala' ),
				'default'     => __( 'Logo slider', 'dina-kala' ),
			]
		);

		$this->add_control(
			'slider_icon',
			[
				'label'   => __( 'Slider icon', 'dina-kala' ),
				'type'    => Controls_Manager::SELECT2,
				'options' => dina_elfa_icons(),
				'default' => 'gem'
			]
		);

		$this->add_control(
			'custom_icon',
			[
				'label' => __( 'Or custom icon (Suitable size: 32px by 32px)', 'dina-kala' ),
				'type'  => Controls_Manager::MEDIA,
			]
		);

		$this->add_control(
			'middle_title',
			[
				'label' 	   => __( 'Show title in the middle', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'	   => 'yes',
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label'   => __( 'Block title tag', 'dina-kala' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h2',
				'options' => [
					'div' => __( 'div', 'dina-kala' ),
					'h1'  => __( 'h1', 'dina-kala' ),
					'h2'  => __( 'h2', 'dina-kala' ),
					'h3'  => __( 'h3', 'dina-kala' ),
					'h4'  => __( 'h4', 'dina-kala' ),
				],
			]
		);

		$this->add_control(
			'white_title',
			[
				'label'        => __( 'White title (Suitable for background mode)', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		if ( dina_opt( 'dina_dark_mode' ) ) {
			$this->add_control(
				'dark_title',
				[
					'label'        => __( 'Dark title (Suitable for dark mode and white background)', 'dina-kala' ),
					'type'         => Controls_Manager::SWITCHER,
					'label_on'     => __( 'On', 'dina-kala' ),
					'label_off'    => __( 'Off', 'dina-kala' ),
					'return_value' => 'yes',
					'default'      => '',
				]
			);
		}

		$this->add_control(
			'remove_underline',
			[
				'label'        => __( 'Remove the title underline', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_control(
			'inherit_color',
			[
				'label'        => __( 'Inheriting title border color from template color', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition' => [
					'remove_underline' => '',
				],
			]
		);

		$this->add_control(
			'title_border_color',
			[
				'label'     => __( 'Title border color', 'dina-kala' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#17A2B8',
				'selectors' => [
					'{{WRAPPER}} .block-title-con' => 'border-bottom-color: {{VALUE}}',
				],
				'condition' => [
					'inherit_color' => '',
				],
			]
		);

		$this->end_controls_section();
		//End Title Section

		//Start Logos Section 
		$this->start_controls_section(
			'section_logos',
			[
				'label' => __( 'Logos', 'dina-kala' ),
			]
		);

		$logos = new Repeater();

		$logos->add_control(
			'logo_title', [
				'label'       => __( 'Logo title', 'dina-kala' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$logos->add_control(
			'logo_link',
			[
				'label'         => __( 'Logo link', 'dina-kala' ),
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
        
        $logos->add_control(
			'logo_image',
			[
				'label'   => __( 'Choose logo', 'dina-kala' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'logos',
			[
				'label'   => __( 'Logos', 'dina-kala' ),
				'type'    => Controls_Manager::REPEATER,
				'fields'  => $logos->get_controls(),
				'default' => [
					[
						'logo_title' => __( 'Logo title', 'dina-kala' ),
						'logo_link'  => __( 'https://your-link.com', 'dina-kala' ),
					],
				],
				'title_field' => '{{{ logo_title }}}',
			]
		);

		$this->end_controls_section();
		//End Logos Section

		//Start Animation Section
		$this->start_controls_section(
			'animation_section',
			[
				'label' => __( 'Animation settings', 'dina-kala' ),
			]
		);

		$this->add_control(
			'show_arrows',
			[
				'label'        => __( 'Show arrows', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'auto_play',
			[
				'label'        => __( 'Auto play', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_control(
			'time',
			[
				'label'     => __( 'Auto play speed(ms)', 'dina-kala' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 1000,
				'max'       => 20000,
				'step'      => 1000,
				'default'   => 8000,
				'condition' => [
                    'auto_play' => 'yes',
                ],
			]
		);

		$this->add_control(
			'pause_over',
			[
				'label'        => __( 'Pause slider on mouse over', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_control(
			'slide_by',
			[
				'label'   => __( 'Items displayed when scrolling', 'dina-kala' ),
				'type'    => Controls_Manager::NUMBER,
				'min'     => 1,
				'max'     => 40,
				'step'    => 1,
				'default' => 1,
			]
		);

		$this->add_control(
			'logo_loop',
			[
				'label'        => __( 'Logo loop', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_responsive_control(
			'lcount',
			[
				'label'              => esc_html__( 'Logo columns count', 'dina-kala' ),
				'type'               => Controls_Manager::NUMBER,
				'min'                => 1,
				'max'                => 8,
				'default'            => 5,
				'tablet_default'     => 3,
				'mobile_default'     => 2,
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'show_dots',
			[
				'label'        => __( 'Show navigation\'s dots', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->end_controls_section();
		//End Animation Section

        //Start Style Section
		$this->start_controls_section(
			'style_section',
			[
				'label' => __( 'Style settings', 'dina-kala' ),
			]
		);

		$this->add_control(
			'white_box',
			[
				'label'        => __( 'White box style', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_control(
			'dis_bw',
			[
				'label'        => __( 'Disable black & white style', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->end_controls_section();
		//End Style Section

	}
	
	protected function render() {

		$settings       = $this->get_settings_for_display();
		$block_classes  = 'dina-logos';
		$block_classes .= ( 'yes' === $settings['white_title'] ? ' white-title' : '' );
		$block_classes .= ( 'yes' === $settings['white_box'] ? ' white-box' : '' );
		$block_classes .= ( 'yes' === $settings['dis_bw'] ? ' dis-bw' : '' );
		$block_classes .= ( isset( $settings['dark_title'] ) && 'yes' === $settings['dark_title'] ? ' dark-title' : '' );
		$block_classes .= 'yes' === $settings['middle_title'] ? ' dina-middle-title' : ' dina-right-title';
		$title_class    = 'yes' === $settings['remove_underline'] ? 'block-title-con block-title-not-line' : 'block-title-con';
		?>

        <div class="<?php echo $block_classes ?>">
            <?php if ( ! empty( $settings['slider_title'] ) ) { ?>
				<?php echo ! isset ( $settings['title_tag'] ) ? '<h2 class="'. $title_class .'">' : '<' . $settings['title_tag'] . ' class="'. $title_class .'">'; ?>
					<?php if ( ! empty( $settings['custom_icon']['url'] ) ) { ?>
						<img src="<?php echo $settings['custom_icon']['url']; ?>" width="32" height="32" alt="<?php echo $settings['slider_title']; ?>" class="cust-icon">
					<?php } else { ?>
						<i class="fal fa-<?php echo $settings['slider_icon']; ?>" aria-hidden="true"></i>
					<?php } ?>
					<?php echo $settings['slider_title']; ?>
				<?php echo ! isset ( $settings['title_tag'] ) ? '</h2>' : '</' . $settings['title_tag'] . '>'; ?>
			<?php } ?>

			<?php
				$carousel_options  = ''; 
				$carousel_options .= 'yes' === $settings['show_arrows'] ? ' data-itemnavs="true"' : ' data-itemnavs="false"'; 
				$carousel_options .= 'yes' === $settings['logo_loop'] ? ' data-itemloop="true"' : ' data-itemloop="false"'; 
				$carousel_options .= 'yes' === $settings['auto_play'] ? ' data-itemplay="true" data-itemtime="'. $settings['time'] .'"' : ' data-itemplay="false"'; 
				$carousel_options .= 'yes' === $settings['pause_over'] ? ' data-itemover="true"' : ' data-itemover="false"'; 
				$carousel_options .= 'yes' === $settings['show_dots'] ? ' data-itemdots="true"' : ' data-itemdots="false"';
				$carousel_options .= ! empty ( $settings['lcount'] ) ? ' data-itemscount="'. $settings['lcount'] .'"' : ' data-itemscount="5"';
				$carousel_options .= isset ( $settings['lcount_tablet'] ) ? ' data-itemscount-tablet="'. $settings['lcount_tablet'] .'"' : ' data-itemscount-tablet="3"';
				$carousel_options .= isset ( $settings['lcount_mobile'] ) ? ' data-itemscount-mobile="'. $settings['lcount_mobile'] .'"' : ' data-itemscount-mobile="2"';
				$carousel_options .= ! empty ( $settings['slide_by'] ) ? ' data-item-slideby="'. $settings['slide_by'] .'"' : ' data-item-slideby="1"';
				$carousel_options .= ' data-dir="'. dina_rtl() .'"';
			?>

            <div class="owl-carousel logo-slider" <?php echo $carousel_options; ?>>
                <?php foreach ( $settings['logos'] as $item ) { ?>
                <div class="item">
				<?php if ( ! empty( $item['logo_link']['url'] ) ) {
					$target = ! empty ( $settings['logo_link']['is_external'] ) ? ' target="_blank"' : '';
					$nofollow = ! empty ( $settings['logo_link']['nofollow'] ) ? ' rel="nofollow"' : '';
				?>
					<a href="<?php echo $item['logo_link']['url']; ?>" title="<?php echo $item['logo_title']; ?>"<?php echo $target . $nofollow; ?>>
				<?php }
				$image_attributes = wp_get_attachment_image_src( $item['logo_image']['id'], 'full' );
				$width            = ( isset( $image_attributes[1] ) ? ' width="' . $image_attributes[1] . '"' : '' );
				$height           = ( isset( $image_attributes[2] ) ? ' height="' . $image_attributes[2] . '"' : '' );
				?>
						<img loading="eager" src="<?php echo $item['logo_image']['url']; ?>" alt="<?php echo $item['logo_title']; ?>"<?php echo $width . $height; ?> data-no-lazy="1" class="skip-lazy no-lazyload">
				<?php if ( ! empty( $item['logo_link']['url'] ) ) { ?>
					</a>
				<?php } ?>
                </div>
                <?php } ?>
            </div>
        </div>
         <?php
	}
}