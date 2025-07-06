<?php
namespace Elementor;

class Slider extends Widget_Base {
	
	public function get_name() {
		return 'slider';
	}
	
	public function get_title() {
		return __( 'Slider (Dinakala)', 'dina-kala' );
	}
	
	public function get_icon() {
		return 'fal fa-images';
	}

	public function get_help_url() {
		return 'https://i-design.ir/docs/dinakala/?p=1037';
	}
	
	public function get_categories() {
		return [ 'dina-kala' ];
	}
	
	protected function register_controls() {

		//Start Sliders Section 
		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Sliders', 'dina-kala' ),
			]
		);
		
		$slider = new Repeater();

		$slider->add_control(
			'slide_title', [
				'label'       => __( 'Slide title', 'dina-kala' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$slider->add_control(
			'slide_link',
			[
				'label'         => __( 'Slide link', 'dina-kala' ),
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
        
        $slider->add_control(
			'slide_image',
			[
				'label'   => __( 'Choose Image', 'dina-kala' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$slider->add_control(
			'slide_date',
			[
				'label'        => __( 'Scheduling the slide show', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$slider->add_control(
			'slide_date_start',
			[
				'label'          => __( 'Start time', 'dina-kala' ),
				'type'           => Controls_Manager::DATE_TIME,
				'picker_options' => [
					'enableTime' => false,
				],
				'condition' => [
					'slide_date' => 'yes',
				],
			]
		);

		$slider->add_control(
			'slide_date_end',
			[
				'label'          => __( 'End time', 'dina-kala' ),
				'type'           => Controls_Manager::DATE_TIME,
				'picker_options' => [
					'enableTime' => false,
				],
				'condition' => [
					'slide_date' => 'yes',
				],
			]
		);

		$this->add_control(
			'slides',
			[
				'label'   => __( 'Sliders', 'dina-kala' ),
				'type'    => Controls_Manager::REPEATER,
				'fields'  => $slider->get_controls(),
				'default' => [
					[
						'slide_title' => __( 'Slide title', 'dina-kala' ),
						'slide_link'  => __( 'https://your-link.com', 'dina-kala' ),
					],
				],
				'title_field' => '{{{ slide_title }}}',
			]
		);

		$this->end_controls_section();
		//End Sliders Section 

		//Start Navigation Section
		$this->start_controls_section(
			'navigation_section',
			[
				'label' => __( 'Navigation settings', 'dina-kala' ),
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
			'show_dots',
			[
				'label'        => __( 'Show navigation\'s dots', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'show_titles',
			[
				'label'        => __( 'Show slide titles instead of navigation points', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
				'condition'    => [
					'show_dots' => 'yes',
				],
			]
		);

		$this->add_control(
			'show_titles_mobile',
			[
				'label'        => __( 'Show the title of the slides on mobile', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
				'condition'    => [
					'show_titles' => 'yes',
				],
			]
		);

		$this->add_control(
			'inherit_dots_color',
			[
				'label'        => __( 'Inherit the color of the navigation dots from the template color', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition' => [
					'show_titles' => '',
					'show_dots'   => 'yes'
				],
			]
		);

		$this->add_control(
			'dots_color',
			[
				'label'     => __( 'Navigation dots color', 'dina-kala' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#17A2B8',
				'selectors' => [
					'{{WRAPPER}} .slider-con .owl-dots .owl-dot span'        => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .slider-con .owl-dots .owl-dot.active span' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .slider-con .owl-dots .owl-dot:hover span'  => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'inherit_dots_color' => '',
					'show_titles'        => '',
					'show_dots'          => 'yes'
				],
			]
		);

		$this->add_control(
			'inherit_color',
			[
				'label'        => __( 'Inherit the color of the titles from the theme settings', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition' => [
					'show_titles' => 'yes',
				],
			]
		);

		$this->add_control(
			'slider_tab_color',
			[
				'label'     => __( 'Slider titles color', 'dina-kala' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(96,125,139,0.9)',
				'selectors' => [
					'{{WRAPPER}} .slider-title li' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'inherit_color' => '',
					'show_titles' => 'yes'
				],
			]
		);

		$this->add_control(
			'slider_tab_color_active',
			[
				'label'     => __( 'Active slider titles color', 'dina-kala' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(69,90,100,0.9)',
				'selectors' => [
					'{{WRAPPER}} .slider-title li.active' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .slider-title li'        => 'border-left-color: {{VALUE}};',
					'{{WRAPPER}} .slider-title li.active::after' => 'border-bottom-color: {{VALUE}};',
				],
				'condition' => [
					'inherit_color' => '',
					'show_titles' => 'yes'
				],
			]
		);

		$this->end_controls_section();
		//End Navigation Section

		//Start Animation Section
		$this->start_controls_section(
			'animation_section',
			[
				'label' => __( 'Animation settings', 'dina-kala' ),
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
				'default'      => 'yes',
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

		$this->end_controls_section();
		//End Animation Section

	}
	
	protected function render() {

        $settings = $this->get_settings_for_display();
        
		?>
		<?php if ( $settings['slides'] ) {
			
			$sliders = array();

			foreach ( $settings['slides'] as $item ) {

				if ( $item['slide_date'] === 'yes' ) {

					$timezone = get_option( 'timezone_string' );
					date_default_timezone_set( $timezone);

					$currentDate = date( 'Y-m-d' );
					$currentDate = date( 'Y-m-d', strtotime( $currentDate ) );

					$dateBegin = date( 'Y-m-d', strtotime( $item['slide_date_start'] ) );
					$dateEnd   = date( 'Y-m-d', strtotime( $item['slide_date_end'] ) );
						
					if ( ( $currentDate >= $dateBegin ) && ( $currentDate <= $dateEnd ) ) {
						$sliders[] = $item;
					}

				} else {
					$sliders[] = $item;
				}

			}

			?>

			<!-- start slider -->
			<div class="dina-slider shadow-box<?php if ( 'yes' === $settings['show_titles_mobile'] ) echo ' slider-title-mobile'; ?>">

				<?php
					$slider_options  = '';
					$slider_options .= 'yes' === $settings['show_arrows'] ? ' data-itemnavs="true"' : ' data-itemnavs="false"'; 
					$slider_options .= 'yes' === $settings['show_dots'] ? ' data-itemdots="true"' : ' data-itemdots="false"';
					$slider_options .= 'yes' === $settings['auto_play'] ? ' data-itemplay="true" data-itemtime="'. $settings['time'] .'"' : ' data-itemplay="false"'; 
					$slider_options .= 'yes' === $settings['pause_over'] ? ' data-itemover="true"' : ' data-itemover="false"'; 
					$slider_options .= ' data-dir="'. dina_rtl() .'"';
				?>

				<div class="slider-con owl-carousel" <?php echo $slider_options; ?>>
					<?php foreach ( $sliders as $item ) {

						$target = ! empty ( $item['slide_link']['is_external'] ) ? ' target="_blank"' : '';
						$nofollow = ! empty ( $item['slide_link']['nofollow'] ) ? ' rel="nofollow"' : ''; ?>

						<div class="item">
							
							<?php if ( ! empty( $item['slide_link']['url'] ) ) { ?>
								<a href="<?php echo $item['slide_link']['url']; ?>" title="<?php echo $item['slide_title']; ?>"<?php echo $target . $nofollow; ?>>
							<?php }
								$image_attributes = wp_get_attachment_image_src( $item['slide_image']['id'], 'full' );
								$width            = ( isset( $image_attributes[1] ) ? ' width="' . $image_attributes[1] . '"' : '' );
								$height           = ( isset( $image_attributes[2] ) ? ' height="' . $image_attributes[2] . '"' : '' );
							?>
									<img loading="eager" src="<?php echo $item['slide_image']['url']; ?>" alt="<?php echo $item['slide_title']; ?>"<?php echo $width . $height; ?> class="slider-img skip-lazy no-lazyload">
							<?php if ( ! empty( $item['slide_link']['url'] ) ) { ?>
								</a>
							<?php } ?>
						</div>

					<?php } ?>
				</div>

				<?php if ( 'yes' === $settings['show_titles'] ) { ?>
					<ul class="slider-title">
						<?php foreach ( $sliders as $item ) { ?>
						<li class="col">
							<span class="slide-title"><?php echo $item['slide_title']; ?></span>
						</li>
						<?php } ?>
					</ul>
				<?php } ?>

			</div>
			<!-- end slider -->

        <?php
		}

	}


}