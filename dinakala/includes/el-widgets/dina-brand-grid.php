<?php
namespace Elementor;

class Dina_Brands_Grid extends Widget_Base {
	
	public function get_name() {
		return 'dina-brands-grid';
	}
	
	public function get_title() {
		return __( 'Brands Grid (Dinakala)', 'dina-kala' );
	}
	
	public function get_icon() {
		return 'fal fa-th';
	}

	public function get_help_url() {
		return 'https://i-design.ir/docs/dinakala/?p=1036';
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
				'label'        => __( 'Show title in the middle', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => 'yes',
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
				'label'        => __( 'Hide Empty Brands', 'dina-kala' ),
				'description'  => __( 'Empty brands (no product) are not displayed', 'dina-kala' ),
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
			'image_size',
			[
				'label'   => __( 'Image size', 'dina-kala' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'thumbnail',
				'options' => array(
					'thumbnail'             => __( '150*150', 'dina-kala' ),
					'woocommerce_thumbnail' => __( '300*300', 'dina-kala' ),
					'woocommerce_single'    => __( '600*600', 'dina-kala' ),
					'full'                  => __( 'Full size', 'dina-kala' ),
				),
			]
		);

		$this->add_control(
			'show_title',
			[
				'label'        => __( 'Show brand title', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
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
			'row_style',
			[
				'label'        => __( 'Row style', 'dina-kala' ),
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

		$this->add_control(
			'white_border',
			[
				'label'        => __( 'White border activation', 'dina-kala' ),
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

		$product_brand     = $settings['product_brand'];
		$brand_total_count = $settings['brand_total_count'];
		$image_size        = $settings['image_size'];

		$args = array (
			'taxonomy'   => dina_opt( 'product_brand_taxonomy' ),
			'order'      => $settings['order'],
			'hide_empty' => 'yes' === $settings['hide_empty'],
			'include'    => $product_brand,
			'number'     => $brand_total_count
		);

		if ( $settings['orderby'] ) {
			$args['orderby'] = $settings['orderby'];
		}
		
		$terms = get_terms( $args );

		?>
		
		<?php
		if ( ! empty( $terms ) ) {

			$block_classes  = 'dina-cats-grid';
			$block_classes .= 'yes' === $settings['white_title'] ? ' white-title' : '';
			$block_classes .= 'yes' === $settings['white_box'] ? ' white-box' : '';
			$block_classes .= 'yes' === $settings['middle_title'] ? ' dina-middle-title' : ' dina-right-title';
			$block_classes .= 'yes' === $settings['dis_bw'] ? ' dis-bw' : '';
			$block_classes .= isset( $settings['dark_title'] ) && 'yes' === $settings['dark_title'] ? ' dark-title' : '';
			$title_class    = 'yes' === $settings['remove_underline'] ? 'block-title-con block-title-not-line' : 'block-title-con';
		?>
			<div class="<?php echo $block_classes ?>">
				
				<?php if ( ! empty ( $settings['title'] ) ) { ?>
					<?php echo ! isset ( $settings['title_tag'] ) ? '<h2 class="'. $title_class .'">' : '<' . $settings['title_tag'] . ' class="'. $title_class .'">'; ?>
						<?php if ( ! empty ( $settings['custom_icon']['url'] ) ) { ?>
							<img src="<?php echo $settings['custom_icon']['url']; ?>" width="32" height="32" alt="<?php echo $settings['title']; ?>" class="cust-icon">
						<?php } else { ?>
							<i class="fal fa-<?php echo $settings['icon']; ?>" aria-hidden="true"></i>
						<?php } ?>
						<?php echo $settings['title']; ?>
					<?php echo ! isset ( $settings['title_tag'] ) ? '</h2>' : '</' . $settings['title_tag'] . '>'; ?>
				<?php } ?>

				<div class="row">

					<?php foreach ( $terms as $term ) {

						$term_link = get_term_link( $term, dina_opt( 'product_brand_taxonomy' ) );
						$brand_logo = get_term_meta( $term->term_id, 'dina_brand_logo', true );

						$item_cols = 'dina-term-cat-con';
						
						switch ( $settings['columns_count'] ) {
							case 2:
								$item_cols .= ' col-lg-6';
								break;
							case 3:
								$item_cols .= ' col-lg-4';
								break;
							case 4:
								$item_cols .= ' col-lg-3';
								break;
							case 5:
								$item_cols .= ' col col-p-5';
								break;
							case 6:
								$item_cols .= ' col-lg-2';
								break;
							case 7:
								$item_cols .= ' col col-p-7';
								break;
							case 8:
								$item_cols .= ' col col-p-8';
								break;
							case 9:
								$item_cols .= ' col col-p-9';
								break;
							case 10:
								$item_cols .= ' col col-p-10';
								break;
							default:
								$item_cols .= ' col col-md-2';
						}

						switch ( $settings['columns_count_tablet'] ) {
							case 2:
								$item_cols .= ' col-md-6';
								break;
							case 3:
								$item_cols .= ' col-md-4';
								break;
							case 4:
								$item_cols .= ' col-md-3';
								break;
							case 5:
								$item_cols .= ' col-t-5';
								break;
							case 6:
								$item_cols .= ' col-md-2';
								break;
							case 7:
								$item_cols .= ' col-t-7';
								break;
							case 8:
								$item_cols .= ' col-t-8';
								break;
							case 9:
								$item_cols .= ' col-t-9';
								break;
							case 10:
								$item_cols .= ' col-t-10';
								break;
							default:
								$item_cols .= ' col-md-4';
						}

						switch ( $settings['columns_count_mobile'] ) {
							case 2:
								$item_cols .= ' col-6';
								break;
							case 3:
								$item_cols .= ' col-4';
								break;
							case 4:
								$item_cols .= ' col-3';
								break;
							case 5:
								$item_cols .= ' col-m-5';
								break;
							case 6:
								$item_cols .= ' col-2';
								break;
							case 7:
								$item_cols .= ' col-m-7';
								break;
							case 8:
								$item_cols .= ' col-m-8';
								break;
							case 9:
								$item_cols .= ' col-m-9';
								break;
							case 10:
								$item_cols .= ' col-m-10';
								break;
							default:
								$item_cols .= ' col-6';
						}

						$item_classes = 'dina-term-cat';
						$item_classes .= 'yes' === $settings['white_border'] ? ' shadow-box' : '';
						$item_classes .= 'yes' === $settings['row_style'] ? ' dina-term-row' : '';
					?>

					<div class="<?php echo $item_cols; ?>">

						<div class="<?php echo $item_classes; ?>">

							<a href="<?php echo $term_link; ?>" title="<?php echo $term->name; ?>">
							<?php if ( ! empty ( $brand_logo ) ) {
								$thumbnail_id = attachment_url_to_postid( esc_url( $brand_logo ) );
								$brand_attr   = wp_get_attachment_image_src( $thumbnail_id, $image_size );
								$width        = ( isset( $brand_attr[1] ) ? ' width="' . $brand_attr[1] . '"' : '' );
								$height       = ( isset( $brand_attr[2] ) ? ' height="' . $brand_attr[2] . '"' : '' );
							?>
								<img src="<?php echo $brand_logo; ?>" alt="<?php echo $term->name; ?>"<?php echo $width . $height; ?>>
							<?php } else { ?>
								<img src="<?php echo esc_url( get_template_directory_uri() ) . '/images/mthumb.png'; ?>" alt="<?php echo $term->name; ?>" width="150" height="150">
							<?php } ?>
							</a>

							<?php if ( 'yes' === $settings['show_title'] || 'yes' === $settings['show_product_count'] ) { ?>
								<div class="dina-term-desc">
							<?php } ?>

								<?php if ( 'yes' === $settings['show_title'] ) { ?>
									<a href="<?php echo $term_link; ?>" title="<?php echo $term->name; ?>">
										<span class="dina-term-name">
										<?php echo $term->name; ?>
										</span>
									</a>
								<?php } ?>

								<?php if ( 'yes' === $settings['show_product_count'] ) { ?>
									<span class="dina-term-count">
									<?php
									$count = '';
									$term_count = sprintf( _n( '%s product', '%s products', $count, 'dina-kala' ), $term->count );
									echo $term_count; ?>
									</span>
								<?php } ?>

							<?php if ( 'yes' === $settings['show_title'] || 'yes' === $settings['show_product_count'] ) { ?>
								</div>
							<?php } ?>

						</div>
						
					</div>

					<?php } ?>
				</div>
			</div>
        <?php
		}
	}
}