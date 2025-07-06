<?php
namespace Elementor;

class Dina_Recently_Viewed_Products extends Widget_Base {

	public function get_name() {
		return 'dina-recently-viewed-products';
	}
	
	public function get_title() {
		return __( 'Recently viewed products (Dinakala)', 'dina-kala' );
	}
	
	public function get_icon() {
		return 'fal fa-eye';
	}

	public function get_help_url() {
		return 'https://i-design.ir/docs/dinakala/?p=1019';
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
			'title',
			[
				'label'       => __( 'Title', 'dina-kala' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Recently viewed products', 'dina-kala' ),
			]
		);

		$this->add_control(
			'product_icon',
			[
				'label'   => __( 'Icon', 'dina-kala' ),
				'type'    => Controls_Manager::SELECT2,
				'options' => dina_elfa_icons(),
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
			'hide_desk_title',
			[
				'label'        => __( 'Hide title in desktop mode', 'dina-kala' ),
				'description'  => __( 'Suitable for the case where you consider an image containing a title for the block', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
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
					'{{WRAPPER}} .block-title' => 'border-bottom-color: {{VALUE}}',
				],
				'condition' => [
					'inherit_color' => '',
				],
			]
		);

		$this->end_controls_section();
		//End Title Section

		//Start Products Section
		$this->start_controls_section(
			'section_products',
			[
				'label' => __( 'Product settings', 'dina-kala' ),
			]
		);

		$this->add_control(
			'out_prod',
			[
				'label'        => __( 'Show in stock products', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);


		$this->add_control(
			'ptotalcount',
			[
				'label'   => __( 'Product total count', 'dina-kala' ),
				'type'    => Controls_Manager::NUMBER,
				'min'     => 1,
				'max'     => 200,
				'step'    => 1,
				'default' => 8,
			]
		);

		$this->add_control(
			'pcount',
			[
				'label'   => __( 'Slider columns count', 'dina-kala' ),
				'type'    => Controls_Manager::NUMBER,
				'min'     => 1,
				'max'     => 6,
				'step'    => 1,
				'default' => 5,
			]
		);

		$this->add_control(
			'pcount_mobile',
			[
				'label'   => __( 'Number of mobile columns', 'dina-kala' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => __( 'Default', 'dina-kala' ),
					'1'       => __( 'One column', 'dina-kala' ),
					'2'       => __( 'Two columns', 'dina-kala' ),
				],
			]
		);

		$this->end_controls_section();
		//End Products Section

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
				'label'        => __( 'Show Arrows', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'arrows_style',
			[
				'label'   => __( 'Arrows display style', 'dina-kala' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => __( 'Default', 'dina-kala' ),
					'stone'   => __( 'Style one', 'dina-kala' ),
					'sttwo'   => __( 'Style two', 'dina-kala' ),
				],
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
			'prod_loop',
			[
				'label'        => __( 'Product loop', 'dina-kala' ),
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

		$this->end_controls_section();
		//End Style Section
		
	}
	
	protected function render() {
		$settings = $this->get_settings_for_display();

		$viewed_ids = ! empty( $_COOKIE['dina_recently_viewed'] ) ? (array) explode( '|', wp_unslash( $_COOKIE['dina_recently_viewed'] ) ) : array();
		$viewed_ids = array_reverse( array_filter( array_map( 'absint', $viewed_ids ) ) );

		if ( empty( $viewed_ids ) ) {
			echo '<div class="not-dina-recently-viewed"></div>';
			return;
		}
        
        $args = array(
			'posts_per_page' => 16,
			'no_found_rows'  => 1,
			'post_status'    => 'publish',
			'post_type'      => 'product',
			'post__in'       => $viewed_ids,
			'orderby'        => 'post__in',
		);

        $viewed_products = new \WP_Query( $args );

		if ( $viewed_products->have_posts() ) {

			$navtype  = 'default' === $settings['arrows_style'] ? dina_opt( 'prod_navs' ) : $settings['arrows_style'];

			$block_classes  = '';
			$block_classes .= ( empty( $settings['title'] ) && $navtype == 'stone' ? ' nav-type-one' : '' ); 
			$block_classes .= ( $navtype == 'sttwo' ? ' nav-type-two' : '' );
			$block_classes .= ( 'yes' === $settings['white_title'] ? ' white-title' : '' );
			$block_classes .= ( isset( $settings['dark_title'] ) && 'yes' === $settings['dark_title'] ? ' dark-title' : '' );
			$block_classes .= ( 'yes' === $settings['white_box'] ? ' white-box' : '' );
			$block_classes .= ( 'yes' === $settings['hide_desk_title'] ? ' hide-desk-title' : '' );
			$block_classes .= ( 'yes' === $settings['hide_desk_title'] && $navtype == 'stone' ? ' hide-desk-title-one' : '' ); ?>
		
			<div class="product-block dina-recently-viewed<?php echo $block_classes; ?>">

				<?php if ( ! empty( $settings['title'] ) ) { ?>
					<div class="block-title<?php if ( $settings['remove_underline'] ) echo ' block-title-not-line' ?>">
						<?php echo ! isset ( $settings['title_tag'] ) ? '<h2 class="block-title-con">' : '<' . $settings['title_tag'] . ' class="block-title-con">'; ?>
							<?php if ( ! empty( $settings['custom_icon']['url'] ) ) { ?>
								<img src="<?php echo $settings['custom_icon']['url']; ?>" width="32" height="32" alt="<?php echo $settings['title']; ?>" class="cust-icon">
							<?php } else { ?>
								<i class="fal fa-<?php echo $settings['product_icon']; ?>" aria-hidden="true"></i>
							<?php } ?>
							<?php echo $settings['title']; ?>
						<?php echo ! isset ( $settings['title_tag'] ) ? '</h2>' : '</' . $settings['title_tag'] . '>'; ?>
					</div>
				<?php } ?>
			
				<?php
					if ( $settings['pcount_mobile'] == 'default' ) {
						$mobile_col = dina_opt( 'mobile_single_col' ) ? ' data-mcol="1"' : ' data-mcol="2"';
					} else {
						$mobile_col = ' data-mcol="'. $settings['pcount_mobile'] .'"';
					}
					$carousel_options  = '';
					$carousel_options .= $mobile_col;
					$carousel_options .= 'yes' === $settings['show_arrows'] ? ' data-itemnavs="true"' : ' data-itemnavs="false"'; 
					$carousel_options .= 'yes' === $settings['prod_loop'] ? ' data-itemloop="true"' : ' data-itemloop="false"'; 
					$carousel_options .= 'yes' === $settings['auto_play'] ? ' data-itemplay="true" data-itemtime="'. $settings['time'] .'"' : ' data-itemplay="false"'; 
					$carousel_options .= 'yes' === $settings['pause_over'] ? ' data-itemover="true"' : ' data-itemover="false"'; 
					$carousel_options .= ! empty ( $settings['pcount'] ) ? ' data-itemscount="'. $settings['pcount'] .'"' : ' data-itemscount="5"';
					$carousel_options .= ! empty ( $settings['slide_by'] ) ? ' data-item-slideby="'. $settings['slide_by'] .'"' : ' data-item-slideby="1"';
					$carousel_options .= ' data-dir="'. dina_rtl() .'"';
				?>

				<div class="owl-carousel" <?php echo $carousel_options; ?>>
				<?php
					while ( $viewed_products->have_posts() ) : $viewed_products->the_post(); ?>
					<div class="item">
						<?php get_template_part( 'includes/content-product' ); ?>
					</div>
					<?php endwhile; ?>
				</div>

			</div>

        <?php
		}
		
		wp_reset_postdata();
	}
}