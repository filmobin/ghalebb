<?php
namespace Elementor;

class Our_Service_Box extends Widget_Base {
	
	public function get_name() {
		return 'our-service-box';
	}
	
	public function get_title() {
		return __( 'Our Service Box (Dinakala)', 'dina-kala' );
	}
	
	public function get_icon() {
		return 'fal fa-th-large';
	}

	public function get_help_url() {
		return 'https://i-design.ir/docs/dinakala/?p=1009';
	}
	
	public function get_categories() {
		return [ 'dina-kala' ];
	}
	
	protected function register_controls() {

		//General settings section
		$this->start_controls_section(
			'general_section',
			[
				'label' => __( 'General settings', 'dina-kala' ),
			]
		);
		
		$this->add_control(
			'icon_top',
			[
				'label'        => __( 'Show icon at the top', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_control(
			'trasparent_bg',
			[
				'label'        => __( 'Transparent background', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_control(
			'merged_box',
			[
				'label'        => __( 'Show boxes in an integrated way', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->end_controls_section();
		//End General settings section

		//First service settings
		$this->start_controls_section(
			'first_service_section',
			[
				'label' => __( 'First service settings', 'dina-kala' ),
			]
		);

		$this->add_control(
			'title_one',
			[
				'label'       => __( 'Title', 'dina-kala' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter your title', 'dina-kala' ),
				'default'     => __( 'Price Guarantee', 'dina-kala' ),
			]
		);

		$this->add_control(
			'subtitle_one',
			[
				'label'       => __( 'Subtitle', 'dina-kala' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter your subtitle', 'dina-kala' ),
				'default'     => __( 'Best market price', 'dina-kala' ),
			]
		);
		
		$this->add_control(
			'link_one',
			[
				'label'         => __( 'Link', 'dina-kala' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'dina-kala' ),
				'show_external' => true,
				'default'       => [
					'url'         => '',
					'is_external' => true,
					'nofollow'    => false,
				],
			]
        );
		
		$this->add_control(
			'icon_one',
			[
				'label'   => __( 'Icon', 'dina-kala' ),
				'type'    => Controls_Manager::SELECT2,
				'options' => dina_elfa_icons(),
				'default' => 'credit-card'
			]
		);

		$this->add_control(
			'inherit_color_one',
			[
				'label'        => __( 'Inherit the color from the template color', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'color_one',
			[
				'label'     => __( 'Color', 'dina-kala' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'selectors' => [
					'{{WRAPPER}} .dina-ser-col-one i' => 'color: {{VALUE}}',
				],
				'condition' => [
					'inherit_color_one' => '',
				],
			]
		);

		$this->add_control(
			'custom_icon_one',
			[
				'label' => __( 'Or custom icon (Suitable size: 64px by 64px)', 'dina-kala' ),
				'type'  => Controls_Manager::MEDIA,
			]
		);

		$this->end_controls_section();
		//First service settings
        
		//Second service settings
		$this->start_controls_section(
			'second_service_section',
			[
				'label' => __( 'Second service settings', 'dina-kala' ),
			]
		);

        $this->add_control(
			'title_two',
			[
				'label'       => __( 'Title', 'dina-kala' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter your title', 'dina-kala' ),
				'default'     => __( 'Excellent support', 'dina-kala' ),
			]
		);

		$this->add_control(
			'subtitle_two',
			[
				'label'       => __( 'Subtitle', 'dina-kala' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter your subtitle', 'dina-kala' ),
				'default'     => __( '24 hours, 7 days a week', 'dina-kala' ),
			]
		);
		
		$this->add_control(
			'link_two',
			[
				'label'         => __( 'Link', 'dina-kala' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'dina-kala' ),
				'show_external' => true,
				'default'       => [
					'url'         => '',
					'is_external' => true,
					'nofollow'    => false,
				],
			]
        );
		
		$this->add_control(
			'icon_two',
			[
				'label'   => __( 'Icon', 'dina-kala' ),
				'type'    => Controls_Manager::SELECT2,
				'options' => dina_elfa_icons(),
				'default' => 'headset'
			]
		);

		$this->add_control(
			'inherit_color_two',
			[
				'label'        => __( 'Inherit the color from the template color', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'color_two',
			[
				'label'     => __( 'Color', 'dina-kala' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'selectors' => [
					'{{WRAPPER}} .dina-ser-col-two i' => 'color: {{VALUE}}',
				],
				'condition' => [
					'inherit_color_two' => '',
				],
			]
		);

		$this->add_control(
			'custom_icon_two',
			[
				'label' => __( 'Or custom icon (Suitable size: 64px by 64px)', 'dina-kala' ),
				'type'  => Controls_Manager::MEDIA,
			]
		);

		$this->end_controls_section();
		//Second service settings
        
		//Third service settings
		$this->start_controls_section(
			'third_service_section',
			[
				'label' => __( 'Third service settings', 'dina-kala' ),
			]
		);

        $this->add_control(
			'title_three',
			[
				'label'       => __( 'Title', 'dina-kala' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter your title', 'dina-kala' ),
				'default'     => __( 'Refund', 'dina-kala' ),
			]
		);

		$this->add_control(
			'subtitle_three',
			[
				'label'       => __( 'Subtitle', 'dina-kala' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter your subtitle', 'dina-kala' ),
				'default'     => __( 'If not satisfied', 'dina-kala' ),
			]
		);
		
		$this->add_control(
			'link_three',
			[
				'label'         => __( 'Link', 'dina-kala' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'dina-kala' ),
				'show_external' => true,
				'default'       => [
					'url'         => '',
					'is_external' => true,
					'nofollow'    => false,
				],
			]
        );
        
		$this->add_control(
			'icon_three',
			[
				'label'   => __( 'Icon', 'dina-kala' ),
				'type'    => Controls_Manager::SELECT2,
				'options' => dina_elfa_icons(),
				'default' => 'history'
			]
		);

		$this->add_control(
			'inherit_color_three',
			[
				'label'        => __( 'Inherit the color from the template color', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'color_three',
			[
				'label'     => __( 'Color', 'dina-kala' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'selectors' => [
					'{{WRAPPER}} .dina-ser-col-three i' => 'color: {{VALUE}}',
				],
				'condition' => [
					'inherit_color_three' => '',
				],
			]
		);

		$this->add_control(
			'custom_icon_three',
			[
				'label' => __( 'Or custom icon (Suitable size: 64px by 64px)', 'dina-kala' ),
				'type'  => Controls_Manager::MEDIA,
			]
		);

		$this->end_controls_section();
		//Third service settings
        
		//Fourth service settings
		$this->start_controls_section(
			'fourth_service_settings',
			[
				'label' => __( 'Fourth service settings', 'dina-kala' ),
			]
		);

        $this->add_control(
			'title_four',
			[
				'label'       => __( 'Title', 'dina-kala' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter your title', 'dina-kala' ),
				'default'     => __( 'Originality goods', 'dina-kala' ),
			]
		);

		$this->add_control(
			'subtitle_four',
			[
				'label'       => __( 'Subtitle', 'dina-kala' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter your subtitle', 'dina-kala' ),
				'default'     => __( 'From Top Brands', 'dina-kala' ),
			]
		);
		
		$this->add_control(
			'link_four',
			[
				'label'         => __( 'Link', 'dina-kala' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'dina-kala' ),
				'show_external' => true,
				'default'       => [
					'url'         => '',
					'is_external' => true,
					'nofollow'    => false,
				],
			]
        );
		
		$this->add_control(
			'icon_four',
			[
				'label'   => __( 'Icon', 'dina-kala' ),
				'type'    => Controls_Manager::SELECT2,
				'options' => dina_elfa_icons(),
				'default' => 'certificate'
			]
		);

		$this->add_control(
			'inherit_color_four',
			[
				'label'        => __( 'Inherit the color from the template color', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'color_four',
			[
				'label'     => __( 'Color', 'dina-kala' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'selectors' => [
					'{{WRAPPER}} .dina-ser-col-four i' => 'color: {{VALUE}}',
				],
				'condition' => [
					'inherit_color_four' => '',
				],
			]
		);

		$this->add_control(
			'custom_icon_four',
			[
				'label' => __( 'Or custom icon (Suitable size: 64px by 64px)', 'dina-kala' ),
				'type'  => Controls_Manager::MEDIA,
			]
		);

		$this->end_controls_section();
		//Fourth service settings

		//Fifth service settings
		$this->start_controls_section(
			'fifth_service_settings',
			[
				'label' => __( 'Fifth service settings', 'dina-kala' ),
			]
		);
        
        $this->add_control(
			'title_five',
			[
				'label'       => __( 'Title', 'dina-kala' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter your title', 'dina-kala' ),
				'default'     => __( 'Fast delivery', 'dina-kala' ),
			]
		);

		$this->add_control(
			'subtitle_five',
			[
				'label'       => __( 'Subtitle', 'dina-kala' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter your subtitle', 'dina-kala' ),
				'default'     => __( 'The least time possible', 'dina-kala' ),
			]
		);
		
		$this->add_control(
			'link_five',
			[
				'label'         => __( 'Link', 'dina-kala' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'dina-kala' ),
				'show_external' => true,
				'default'       => [
					'url'         => '',
					'is_external' => true,
					'nofollow'    => false,
				],
			]
        );

		$this->add_control(
			'icon_five',
			[
				'label'   => __( 'Icon', 'dina-kala' ),
				'type'    => Controls_Manager::SELECT2,
				'options' => dina_elfa_icons(),
				'default' => 'shipping-fast'
			]
		);

		$this->add_control(
			'inherit_color_five',
			[
				'label'        => __( 'Inherit the color from the template color', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'color_five',
			[
				'label'     => __( 'Color', 'dina-kala' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'selectors' => [
					'{{WRAPPER}} .dina-ser-col-five i' => 'color: {{VALUE}}',
				],
				'condition' => [
					'inherit_color_five' => '',
				],
			]
		);
		
		$this->add_control(
			'custom_icon_five',
			[
				'label' => __( 'Or custom icon (Suitable size: 64px by 64px)', 'dina-kala' ),
				'type'  => Controls_Manager::MEDIA,
			]
		);

		$this->end_controls_section();
		//Fifth service settings

	}
	
	protected function render() {

        $settings    = $this->get_settings_for_display();
		$classes     = 'row services';
		$classes    .= $settings['icon_top'] == 'yes' ? ' dina-ser-icon-top' : ' dina-ser-icon-side';
		$classes    .= $settings['trasparent_bg'] == 'yes' ? ' dina-ser-trasparent-bg' : ' dina-ser-white-bg';
		$classes    .= $settings['merged_box'] == 'yes' ? ' dina-ser-merged shadow-box' : '';
		$shadow_box  = $settings['trasparent_bg'] == 'yes' ? '' : ' shadow-box';
		?>
		<!-- Services -->
            <div class="<?php echo $classes ?>">

				<?php
				for ( $i = 1; $i <= 5; $i++ ) {
					switch ( $i ) {
						case 1:
						  	$number = 'one';
						  	break;
						case 2:
							$number = 'two';
						  	break;
						case 3:
						  	$number = 'three';
						  	break;
						case 4:
							$number = 'four';
							break;
						case 5:
							$number = 'five';
							break;
						default:
							$number = 'one';
					  }
				?>

					<?php if ( ! empty( $settings['title_' . $number ] ) ) { ?>
						<div class="col<?php echo ' dina-ser-col-' . $number; ?>">
							<div class="service<?php echo $shadow_box ?>">
								<?php
								if ( ! empty( $settings['link_' . $number ]['url'] ) ) {
									$target = ! empty ( $settings['link_' . $number ]['is_external'] ) ? ' target="_blank"' : '';
									$nofollow = ! empty ( $settings['link_' . $number ]['nofollow'] ) ? ' rel="nofollow"' : ''; 
								?>
									<a href="<?php echo $settings['link_' . $number ]['url']; ?>" title="<?php echo $settings['title_' . $number ]; ?>"<?php echo $target . $nofollow; ?>>
								<?php } ?>
									<div class="col-lg-3 col-12 service-icon">
										<?php if ( ! empty( $settings['custom_icon_' . $number ]['url'] ) ) { ?>
											<img src="<?php echo $settings['custom_icon_' . $number ]['url']; ?>" width="64" height="64" alt="<?php echo $settings['title_' . $number ]; ?>" class="ser-cust-icon">
										<?php } else { ?>
											<i class="fal fa-<?php echo $settings['icon_' . $number ]; ?>" aria-hidden="true"></i>
										<?php } ?>
									</div>
									<div class="col-lg-9 col-12 service-det">
										<span class="service-title"><?php echo $settings['title_' . $number ]; ?></span>
										<span class="service-desc d-none d-lg-block"><?php echo $settings['subtitle_' . $number ]; ?></span>
									</div>
								<?php if ( ! empty( $settings['link_' . $number ]['url'] ) ) { ?>
									</a>
								<?php } ?>
							</div>
						</div>
					<?php }
				} ?>

            </div>
        <!-- Services --> <?php

	}

}