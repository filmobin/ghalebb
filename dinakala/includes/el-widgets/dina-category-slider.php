<?php
namespace Elementor;

class Category_Slider extends Widget_Base {
	
	public function get_name() {
		return 'category-slider';
	}
	
	public function get_title() {
		return __( 'Category slider (Dinakala)', 'dina-kala' );
	}
	
	public function get_icon() {
		return 'fal fa-sitemap';
	}

	public function get_help_url() {
		return 'https://i-design.ir/docs/dinakala/?p=1033';
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
				'default'     => __( 'Categories', 'dina-kala' ),
			]
		);

		$this->add_control(
			'slider_icon',
			[
				'label'   => __( 'Slider icon', 'dina-kala' ),
				'type'    => Controls_Manager::SELECT2,
				'options' => dina_elfa_icons(),
				'default' => 'sitemap'
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

		//Start Categories Section 
		$this->start_controls_section(
			'section_categories',
			[
				'label' => __( 'Categories', 'dina-kala' ),
			]
		);

		$this->add_control(
			'product_cat',
			[
				'label'       => __( 'Categories', 'dina-kala' ),
				'type'        => 'dina_autocomplete',
				'search'      => 'dina_get_taxonomies_by_query',
				'render'      => 'dina_get_taxonomies_title_by_id',
				'taxonomy'    => 'product_cat',
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
				'label'        => __( 'Hide empty categories', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'cat_total_count',
			[
				'label' => __( 'Categories total count', 'dina-kala' ),
				'type'  => Controls_Manager::NUMBER,
				'min'   => 1,
				'step'  => 1,
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
				'label'        => __( 'Show category title', 'dina-kala' ),
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
		//End Categories Section

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
			'cat_loop',
			[
				'label'        => __( 'Category loop', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_responsive_control(
			'cat_count',
			[
				'label'              => esc_html__( 'Slider columns count', 'dina-kala' ),
				'type'               => Controls_Manager::NUMBER,
				'min'                => 1,
				'max'                => 8,
				'default'            => 6,
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

		$settings        = $this->get_settings_for_display();
		$product_cat     = $settings['product_cat'];
		$cat_total_count = $settings['cat_total_count'];
		$image_size      = $settings['image_size'];

		$args = array (
			'taxonomy'   => 'product_cat',
			'order'      => $settings['order'],
			'hide_empty' => 'yes' === $settings['hide_empty'],
			'include'    => $product_cat,
			'number'     => $cat_total_count
		);

		if ( $settings['orderby'] ) {
			$args['orderby'] = $settings['orderby'];
		}
		
		$terms = get_terms( $args );
		?>
		
		<?php
		if ( ! empty( $terms ) ) {

			$block_classes  = 'dina-logos';
			$block_classes .= 'yes' === $settings['white_title'] ? ' white-title' : '';
			$block_classes .= 'yes' === $settings['white_box'] ? ' white-box' : '';
			$block_classes .= 'yes' === $settings['dis_bw'] ? ' dis-bw' : '';
			$block_classes .= isset( $settings['dark_title'] ) && 'yes' === $settings['dark_title'] ? ' dark-title' : '';
			$block_classes .= 'yes' === $settings['middle_title'] ? ' dina-middle-title' : '';
			$title_class    = 'yes' === $settings['remove_underline'] ? 'block-title-con block-title-not-line' : 'block-title-con';
		?>
			<div class="<?php echo $block_classes ?>">
				
				<?php
				if ( ! empty ( $settings['slider_title'] ) ) {
					echo ! isset ( $settings['title_tag'] ) ? '<h2 class="'. $title_class .'">' : '<' . $settings['title_tag'] . ' class="'. $title_class .'">';
						if ( ! empty ( $settings['custom_icon']['url'] ) ) { ?>
							<img src="<?php echo $settings['custom_icon']['url']; ?>" width="32" height="32" alt="<?php echo $settings['slider_title']; ?>" class="cust-icon">
						<?php } else { ?>
							<i class="fal fa-<?php echo $settings['slider_icon']; ?>" aria-hidden="true"></i>
						<?php }
						echo $settings['slider_title'];
					echo ! isset ( $settings['title_tag'] ) ? '</h2>' : '</' . $settings['title_tag'] . '>';
				}

					$carousel_options  = '';
					$carousel_options .= 'yes' === $settings['show_arrows'] ? ' data-itemnavs="true"' : ' data-itemnavs="false"';
					$carousel_options .= 'yes' === $settings['cat_loop'] ? ' data-itemloop="true"' : ' data-itemloop="false"';
					$carousel_options .= 'yes' === $settings['auto_play'] ? ' data-itemplay="true" data-itemtime="'. $settings['time'] .'"' : ' data-itemplay="false"';
					$carousel_options .= 'yes' === $settings['pause_over'] ? ' data-itemover="true"' : ' data-itemover="false"';
					$carousel_options .= 'yes' === $settings['show_dots'] ? ' data-itemdots="true"' : ' data-itemdots="false"';
					$carousel_options .= ! empty ( $settings['cat_count'] ) ? ' data-itemscount="'. $settings['cat_count'] .'"' : ' data-itemscount="6"';
					$carousel_options .= isset ( $settings['cat_count_tablet'] ) ? ' data-itemscount-tablet="'. $settings['cat_count_tablet'] .'"' : ' data-itemscount-tablet="3"';
					$carousel_options .= isset ( $settings['cat_count_mobile'] ) ? ' data-itemscount-mobile="'. $settings['cat_count_mobile'] .'"' : ' data-itemscount-mobile="2"';
					$carousel_options .= ! empty ( $settings['slide_by'] ) ? ' data-item-slideby="'. $settings['slide_by'] .'"' : ' data-item-slideby="1"';
					$carousel_options .= ' data-dir="'. dina_rtl() .'"';
				?>

				<div class="owl-carousel logo-slider dina-category-logo-slider"<?php echo $carousel_options; ?>>

					<?php foreach ( $terms as $term ) {
						$term_link = get_term_link( $term, 'product_cat' );
						$thumbnail_id = get_term_meta ( $term->term_id, 'thumbnail_id', true );
						if ( ! empty( $thumbnail_id ) ) {
							$cat_attr = wp_get_attachment_image_src( $thumbnail_id, $image_size );
							$width    = ( isset( $cat_attr[1] ) ? ' width="' . $cat_attr[1] . '"' : '' );
							$height   = ( isset( $cat_attr[2] ) ? ' height="' . $cat_attr[2] . '"' : '' );
							if ( isset ( $cat_attr[0] ) ) {
								$cat_logo = $cat_attr[0];
							}
						} else {
							$cat_logo = '';
						}
						
						$item_classes = 'dina-term-cat';
						$item_classes .= 'yes' === $settings['white_border'] ? ' shadow-box' : '';
						$item_classes .= 'yes' === $settings['row_style'] ? ' dina-term-row' : '';
					?>

					<div class="item dina-term-cat-con">
					
						<div class="<?php echo $item_classes; ?>">

							<a href="<?php echo $term_link; ?>" title="<?php echo $term->name; ?>">
							<?php if ( ! empty ( $cat_logo ) ) { ?>
								<img src="<?php echo $cat_logo; ?>" alt="<?php echo $term->name; ?>"<?php echo $width . $height; ?>>
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