<?php
namespace Elementor;

class Dina_Columnar_Brand_Slider extends Widget_Base {

	public function get_name() {
		return 'dina-columnar-brand-slider';
	}
	
	public function get_title() {
		return __( 'Columnar brand slider (Dinakala)', 'dina-kala' );
	}
	
	public function get_icon() {
		return 'fal fa-line-columns';
	}

	public function get_help_url() {
		return 'https://i-design.ir/docs/dinakala/?p=3112';
	}
	
	public function get_categories() {
		return [ 'dina-kala' ];
	}

	public function get_style_depends() {
		return [ 'dina-column' ];
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
				'placeholder' => __( 'Enter your title', 'dina-kala' ),
				'default'     => __( 'Brands', 'dina-kala' ),
			]
		);

		$this->add_control(
			'icon',
			[
				'label'   => __( 'Icon', 'dina-kala' ),
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

		//Start Brands Section 
		$this->start_controls_section(
			'section_brands',
			[
				'label' => __( 'Brands', 'dina-kala' ),
			]
		);

		$this->add_control(
			'product_brand',
			[
				'label'       => __( 'Brands', 'dina-kala' ),
				'type'        => 'dina_autocomplete',
				'search'      => 'dina_get_taxonomies_by_query',
				'render'      => 'dina_get_taxonomies_title_by_id',
				'taxonomy'    => dina_opt( 'product_brand_taxonomy' ),
				'multiple'    => true,
				'label_block' => true,
			]
		);

		$this->add_control(
			'orderby',
			[
				'label'   => __( 'Order by', 'dina-kala' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => array(
					''           => '',
					'id'         => __( 'ID', 'dina-kala' ),
					'date'       => __( 'Date', 'dina-kala' ),
					'title'      => __( 'Title', 'dina-kala' ),
					'menu_order' => __( 'Menu order', 'dina-kala' ),
					'modified'   => __( 'Last modified date', 'dina-kala' ),
				),
			]
		);

		$this->add_control(
			'order',
			[
				'label'   => __( 'Sort order', 'dina-kala' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => array(
					''     => __( 'Inherit', 'dina-kala' ),
					'DESC' => __( 'Descending', 'dina-kala' ),
					'ASC'  => __( 'Ascending', 'dina-kala' ),
				),
			]
		);

		$this->add_control(
			'hide_empty',
			[
				'label'        => __( 'Hide empty brands', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'brand_total_count',
			[
				'label' => __( 'Brands total count', 'dina-kala' ),
				'type'  => Controls_Manager::NUMBER,
				'min'   => 1,
				'step'  => 1,
			]
		);

		$this->add_control(
			'row_count',
			[
				'label'   => __( 'Slider rows count', 'dina-kala' ),
				'type'    => Controls_Manager::NUMBER,
				'min'     => 1,
				'max'     => 10,
				'step'    => 1,
				'default' => 2,
			]
		);

		$this->add_responsive_control(
			'columns_count',
			[
				'label'              => esc_html__( 'Columns count', 'dina-kala' ),
				'type'               => Controls_Manager::NUMBER,
				'min'                => 2,
				'max'                => 10,
				'default'            => 6,
				'tablet_default'     => 3,
				'mobile_default'     => 2,
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'show_product_count',
			[
				'label'        => __( 'Show products count', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->end_controls_section();
		//End Brands Section

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
				'default' => 'sttwo',
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
			'brand_loop',
			[
				'label'        => __( 'Brand loop', 'dina-kala' ),
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
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'white_border_brand',
			[
				'label'        => __( 'White border brand', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_control(
			'show_brand_number',
			[
				'label'        => __( 'Show brand number', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'inherit_number_color',
			[
				'label'        => __( 'Inheriting the brand number color from template color', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition' => [
					'show_brand_number' => 'yes',
				],
			]
		);

		$this->add_control(
			'brand_number_color',
			[
				'label'     => __( 'Brand number color', 'dina-kala' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#17A2B8',
				'selectors' => [
					'{{WRAPPER}} .dina-column-number' => 'color: {{VALUE}}',
				],
				'condition' => [
					'inherit_number_color' => '',
				],
			]
		);

		$this->end_controls_section();
		//End Style Section
		
	}
	
	protected function render() {

		$settings = $this->get_settings_for_display();
		$navtype  = 'default' === $settings['arrows_style'] ? dina_opt( 'prod_navs' ) : $settings['arrows_style'];

		$block_classes  = '';
		$block_classes .= ( empty( $settings['title'] ) && $navtype == 'stone' ? ' nav-type-one' : '' ); 
		$block_classes .= ( $navtype == 'sttwo' ? ' nav-type-two' : '' );
		$block_classes .= ( 'yes' === $settings['white_title'] ? ' white-title' : '' );
		$block_classes .= ( isset( $settings['dark_title'] ) && 'yes' === $settings['dark_title'] ? ' dark-title' : '' );
		$block_classes .= ( 'yes' === $settings['white_box'] ? ' white-box' : '' );
		$block_classes .= ( 'yes' === $settings['hide_desk_title'] ? ' hide-desk-title' : '' );
		$block_classes .= ( 'yes' === $settings['hide_desk_title'] && $navtype == 'stone' ? ' hide-desk-title-one' : '' );
		?>
		
		<div class="product-block dina-brand-column dina-columnar-slider<?php echo $block_classes; ?>">

		<?php

		$order             = $settings['order'];
		$orderby           = $settings['orderby'];
		$product_brand     = $settings['product_brand'];
		$brand_total_count = $settings['brand_total_count'];
		$row_count         = (int)$settings['row_count'];
		$hide_empty        = 'yes' === $settings['hide_empty'];

		$args = array (
			'taxonomy'   => dina_opt( 'product_brand_taxonomy' ),
			'order'      => $order,
			'hide_empty' => $hide_empty,
			'include'    => $product_brand,
			'number'     => $brand_total_count
		);

		if ( $settings['orderby'] ) {
			$args['orderby'] = $orderby;
		}
		
		$terms = get_terms( $args );

		if ( ! empty( $terms ) ) {

		if ( ! empty( $settings['title'] ) ) { ?>
			<div class="block-title<?php if ( $settings['remove_underline'] ) echo ' block-title-not-line'; if ( 'yes' === $settings['middle_title'] ) echo ' dina-center-title'; ?>">
				<?php echo ! isset ( $settings['title_tag'] ) ? '<h2 class="block-title-con">' : '<' . $settings['title_tag'] . ' class="block-title-con">'; ?>
					<?php if ( ! empty( $settings['custom_icon']['url'] ) ) { ?>
						<img src="<?php echo $settings['custom_icon']['url']; ?>" width="32" height="32" alt="<?php echo $settings['title']; ?>" class="cust-icon">
					<?php } elseif ( ! empty( $settings['icon'] ) ) { ?>
						<i class="fal fa-<?php echo $settings['icon']; ?>" aria-hidden="true"></i>
					<?php } ?>
					<?php echo $settings['title']; ?>
				<?php echo ! isset ( $settings['title_tag'] ) ? '</h2>' : '</' . $settings['title_tag'] . '>'; ?>
			</div>
		<?php } ?>

		<?php
			$carousel_options  = '';
			$carousel_options .= 'yes' === $settings['show_arrows'] ? ' data-itemnavs="true"' : ' data-itemnavs="false"'; 
			$carousel_options .= 'yes' === $settings['brand_loop'] ? ' data-itemloop="true"' : ' data-itemloop="false"'; 
			$carousel_options .= 'yes' === $settings['auto_play'] ? ' data-itemplay="true" data-itemtime="'. $settings['time'] .'"' : ' data-itemplay="false"'; 
			$carousel_options .= 'yes' === $settings['pause_over'] ? ' data-itemover="true"' : ' data-itemover="false"'; 
			$carousel_options .= ! empty ( $settings['columns_count'] ) ? ' data-itemscount="'. $settings['columns_count'] .'"' : ' data-itemscount="5"';
			$carousel_options .= ! empty ( $settings['slide_by'] ) ? ' data-item-slideby="'. $settings['slide_by'] .'"' : ' data-item-slideby="1"';
			$carousel_options .= ' data-dir="'. dina_rtl() .'"';

			$item_classes  = 'dina-column-item';
			$item_classes .= 'yes' === $settings['white_border_brand'] ? ' dina-item-white-border shadow-box' : '';
		?>

		<div class="owl-carousel" data-mcol="1" <?php echo $carousel_options; ?>>
			
			<?php
			$count = 1;
			echo '<div class="item">';
			foreach ( $terms as $term ) {
				$term_link = get_term_link( $term, dina_opt( 'product_brand_taxonomy' ) );
				$thumbnail_id = get_term_meta ( $term->term_id, 'thumbnail_id', true );
				if ( ! empty( $thumbnail_id ) ) {
					$brand_attr = wp_get_attachment_image_src( $thumbnail_id, 'thumbnail' );
					$width    = ( isset( $brand_attr[1] ) ? ' width="' . $brand_attr[1] . '"' : '' );
					$height   = ( isset( $brand_attr[2] ) ? ' height="' . $brand_attr[2] . '"' : '' );
					if ( isset ( $brand_attr[0] ) ) {
						$brand_logo = $brand_attr[0];
					}
				} else {
					$brand_logo = '';
				}
				?>
				<div class="<?php echo $item_classes ?>">

					<div class="dina-column-img">
						<a href="<?php echo $term_link; ?>" title="<?php echo $term->name; ?>" target="<?php echo dina_link_target(); ?>">
							<?php if ( ! empty ( $brand_logo ) ) { ?>
								<img src="<?php echo $brand_logo; ?>" alt="<?php echo $term->name; ?>"<?php echo $width . $height; ?>>
							<?php } else { ?>
								<img src="<?php echo esc_url( get_template_directory_uri() ) . '/images/mthumb.png'; ?>" alt="<?php echo $term->name; ?>" width="150" height="150">
							<?php } ?>
						</a>
					</div>

					<?php if ( $settings['show_brand_number'] === 'yes' ) { ?>
					<div class="dina-column-number">
						<?php 
						echo $count;
						?>
					</div>
					<?php } ?>

					<div class="dina-column-title<?php if ( 'yes' === $settings['show_product_count'] ) echo ' dina-column-title-two' ?>">

						<p>
							<a href="<?php echo $term_link; ?>" title="<?php echo $term->name; ?>" target="<?php echo dina_link_target(); ?>">
								<?php echo $term->name; ?>
							</a>
						</p>

						<?php if ( 'yes' === $settings['show_product_count'] ) { ?>
							<p class="dina-column-product-count">
							<?php
								$term_count = '';
								echo sprintf( _n( '%s product', '%s products', $term_count, 'dina-kala' ), $term->count );
							?>
							</p>
						<?php } ?>

					</div>

				</div>

				<?php
				if ( $count == $brand_total_count || $count == count( $terms ) ) {
					echo '</div>';
				} elseif ( $count % $row_count == 0 ) {
					echo '</div><div class="item">';
				}
				
				$count++;

			} ?>
        </div>
		<?php 
		}
		?>
        </div>
        <?php
	}
}