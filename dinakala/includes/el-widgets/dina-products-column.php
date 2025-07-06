<?php
namespace Elementor;

class Dina_Columnar_Products_Slider extends Widget_Base {

	public function get_name() {
		return 'dina-columnar-products-slider';
	}
	
	public function get_title() {
		return __( 'Columnar products slider (Dinakala)', 'dina-kala' );
	}
	
	public function get_icon() {
		return 'fal fa-line-columns';
	}

	public function get_help_url() {
		return 'https://i-design.ir/docs/dinakala/?p=3068';
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

		//Start Products Section
		$this->start_controls_section(
			'section_products',
			[
				'label' => __( 'Product settings', 'dina-kala' ),
			]
		);

		$this->add_control(
			'prod_sort',
			[
				'label'   => __( 'Product sorting', 'dina-kala' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'latest',
				'options' => [
					'latest'          => __( 'Latest products', 'dina-kala' ),
					'latest-updated'  => __( 'Latest updated products', 'dina-kala' ),
					'random'          => __( 'Random products', 'dina-kala' ),
					'viewed'          => __( 'Most viewed products', 'dina-kala' ),
					'saled'           => __( 'Best selling products', 'dina-kala' ),
					'price-desc'      => __( 'Price (Descending)', 'dina-kala' ),
					'price-asc'       => __( 'Price (Ascending)', 'dina-kala' ),
					'coming_soon'     => __( 'Coming soon products', 'dina-kala' ),
					'discounted'      => __( 'Discounted products', 'dina-kala' ),
					'rand_discounted' => __( 'Random discounted products', 'dina-kala' ),
					'special'         => __( 'Special products', 'dina-kala' ),
					'rand_special'    => __( 'Random special products', 'dina-kala' ),
					'menu_order'      => __( 'By title (Menu Order)', 'dina-kala' ),
				],
			]
		);

		$this->add_control(
			'prod_filter',
			[
				'label'   => __( 'Product filtering', 'dina-kala' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'category',
				'options' => dina_product_filter_options(),
			]
		);

		$this->add_control(
			'product_cat',
			[
				'label'       => __( 'Product category', 'dina-kala' ),
				'type'        => 'dina_autocomplete',
				'search'      => 'dina_get_taxonomies_by_query',
				'render'      => 'dina_get_taxonomies_title_by_id',
				'taxonomy'    => 'product_cat',
				'multiple'    => true,
				'label_block' => true,
				'condition'   => [
					'prod_filter' => 'category',
				],
			]
		);

		if ( ! dina_opt( 'elementor_tag_id_name' ) ) {
			$this->add_control(
				'product_tag',
				[
					'label'       => __( 'Product tag', 'dina-kala' ),
					'type'        => 'dina_autocomplete',
					'search'      => 'dina_get_taxonomies_by_query',
					'render'      => 'dina_get_taxonomies_title_by_id',
					'taxonomy'    => 'product_tag',
					'multiple'    => true,
					'label_block' => true,
					'condition'   => [
						'prod_filter' => 'tag',
					],
				]
			);
		} else {
			$this->add_control(
				'product_tag',
				[
					'label'       => __( 'Product tag', 'dina-kala' ),
					'description' => __( 'If you have defined the product filter on the tag, enter the desired tags in this box (separate the IDs with a "," sign, for example 145,12,6)', 'dina-kala' ),
					'label_block' => true,
					'type'        => Controls_Manager::TEXT,
					'placeholder' => __( 'Tag(s) ID', 'dina-kala' ),
					'condition'   => [
						'prod_filter' => 'tag',
					],
				]
			);
		}

		if ( dina_opt( 'product_brand' ) ) {
			$this->add_control(
				'product_brand',
				[
					'label'       => __( 'Product brand', 'dina-kala' ),
					'type'        => 'dina_autocomplete',
					'search'      => 'dina_get_taxonomies_by_query',
					'render'      => 'dina_get_taxonomies_title_by_id',
					'taxonomy'    => dina_opt( 'product_brand_taxonomy' ),
					'multiple'    => true,
					'label_block' => true,
					'condition'   => [
						'prod_filter' => 'brand',
					],
				]
			);
		}

		$this->add_control(
			'product_ids',
			[
				'label'       => __( 'Product ID', 'dina-kala' ),
				'description' => __( 'If you have defined the product filter on the product ID, enter the desired ID(s) in this box (separate the IDs with a "," sign, for example 145,12,6)', 'dina-kala' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Product(s) ID', 'dina-kala' ),
				'condition'   => [
					'prod_filter' => 'product-ids',
				],
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
			'hide_no_prod',
			[
				'label'        => __( 'Hide the block if there is no product', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_control(
			'show_price',
			[
				'label'        => __( 'Show product price', 'dina-kala' ),
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
				'default' => 24,
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
				'default' => 3,
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
				'default' => 4,
			]
		);

		$this->add_control(
			'view_all',
			[
				'label'        => __( 'Display view all button (If category or tag selected)', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_control(
			'view_all_link',
			[
				'label'         => __( 'View all button custom link', 'dina-kala' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'dina-kala' ),
				'show_external' => true,
				'default'       => [
						'url'         => '',
						'is_external' => true,
						'nofollow'    => false,
				],
				'condition' => [
					'view_all' => 'yes',
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
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'white_border_product',
			[
				'label'        => __( 'White border product', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_control(
			'show_product_number',
			[
				'label'        => __( 'Show product number', 'dina-kala' ),
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
				'label'        => __( 'Inheriting the product number color from template color', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition' => [
					'show_product_number' => 'yes',
				],
			]
		);

		$this->add_control(
			'product_number_color',
			[
				'label'     => __( 'Product number color', 'dina-kala' ),
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
		
		<div class="product-block dina-products-column dina-columnar-slider<?php echo $block_classes; ?>">

		<?php

		$prod_sort     = $settings['prod_sort'];
		$prod_filter   = $settings['prod_filter'];
		$product_cat   = $settings['product_cat'];
		$product_tag   = $settings['product_tag'];
		$row_count     = $settings['row_count'];
		$product_brand = dina_opt( 'product_brand' ) ? $settings['product_brand'] : '';

		$view_all_link = '';

		$tax_query = array();
		array_push( $tax_query, array( 'relation' => 'AND' ) );			
		array_push( $tax_query, array(
			'taxonomy' => 'product_visibility',
			'field'    => 'name',
			'terms'    => 'exclude-from-catalog',
			'operator' => 'NOT IN',
		) );

		switch ( $prod_sort) {
			case 'latest':
				$args = array(
				'posts_per_page' => $settings['ptotalcount'],
				'post_type'      => 'product',
				'post_status'    => 'publish',
				'order'          => 'DESC'  );
				break;
			case 'latest-updated':
				$args = array(
				'posts_per_page'      => $settings['ptotalcount'],
				'post_type'           => 'product',
				'post_status'         => 'publish',
				'orderby'             => 'modified',
				'ignore_sticky_posts' => '1',
				'order'               => 'DESC'  );
				break;
			case 'menu_order':
				$args = array(
				'posts_per_page' => $settings['ptotalcount'],
				'post_type'      => 'product',
				'post_status'    => 'publish',
				'orderby'        => 'menu_order title',
				'order'          => 'ASC'  );
				break;
			case 'saled':
				$args = array(
					'posts_per_page' => $settings['ptotalcount'],
					'post_type'      => 'product',
					'post_status'    => 'publish',
					'meta_key'       => 'total_sales',
					'orderby'        => 'meta_value_num',
					'order'          => 'DESC'
				);
				break;
			case 'discounted':
				$args = array(
					'posts_per_page' => $settings['ptotalcount'],
					'post_status'    => 'publish',
					'order'          => 'DESC',
					'post_type'      => 'product',
					'post__in'       => array_merge( array( 0 ), wc_get_product_ids_on_sale() )
				);
				break;
			case 'coming_soon':
				$args = array(
					'posts_per_page' => $settings['ptotalcount'],
					'post_type'      => 'product',
					'post_status'    => 'publish',
					'meta_key'       => 'dina_coming',
					'meta_value'     => 'on',
					'order'          => 'DESC'
				);
				break;
			case 'rand_discounted':
				$args = array(
					'posts_per_page' => $settings['ptotalcount'],
					'post_status'    => 'publish',
					'orderby'        => 'rand',
					'post_type'      => 'product',
					'post__in'       => array_merge( array( 0 ), wc_get_product_ids_on_sale() )
				);
				break;
			case 'viewed':
				$args = array(
					'posts_per_page' => $settings['ptotalcount'],
					'post_type'      => 'product',
					'post_status'    => 'publish',
					'meta_key'       => dina_opt( 'views_meta_key' ),
					'orderby'        => 'meta_value_num',
					'order'          => 'DESC'
				);
				break;
			case 'price-desc':
				$args = array(
					'posts_per_page' => $settings['ptotalcount'],
					'post_type'      => 'product',
					'post_status'    => 'publish',
					'orderby'        => 'meta_value_num',
					'meta_key'       => '_price',
					'order'          => 'DESC'
				);
				break;
			case 'price-asc':
				$args = array(
					'posts_per_page' => $settings['ptotalcount'],
					'post_type'      => 'product',
					'post_status'    => 'publish',
					'orderby'        => 'meta_value_num',
					'meta_key'       => '_price',
					'order'          => 'ASC'
				);
				break;
			case 'random':
				$args = array(
				'posts_per_page' => $settings['ptotalcount'],
				'post_type'      => 'product',
				'post_status'    => 'publish',
				'orderby'        => 'rand'
				);
				break;
			case 'special':
				$args = array (
					'posts_per_page' => $settings['ptotalcount'],
					'post_type'      => 'product',
					'post_status'    => 'publish',
					'order'          => 'DESC',
				);
				array_push( $tax_query, array(
					'taxonomy' => 'product_visibility',
					'field'    => 'name',
					'terms'    => 'featured',
				) );
				break;
			case 'rand_special':
				$args = array (
					'posts_per_page' => $settings['ptotalcount'],
					'post_type'      => 'product',
					'post_status'    => 'publish',
					'orderby'        => 'rand',
				);
				array_push( $tax_query, array(
					'taxonomy' => 'product_visibility',
					'field'    => 'name',
					'terms'    => 'featured',
				) );
				break;
			default:
			$args = array(
				'posts_per_page' => $settings['ptotalcount'],
				'post_type'      => 'product',
				'post_status'    => 'publish',
				'order'          => 'DESC'
			);
		}

		if ( $prod_filter ) {

			if ( $prod_filter == 'category' && ! empty( $product_cat ) ) {

				array_push( $tax_query, array(
					'taxonomy' => 'product_cat',
					'field'    => 'term_id',
					'terms'    => $product_cat
				) );

				$view_all_link = dina_get_term_links( 'product_cat', $product_cat );

			} elseif ( $prod_filter == 'tag' && ! empty( $product_tag ) ) {

				array_push( $tax_query, array(
					'taxonomy' => 'product_tag',
					'field'    => 'term_id',
					'terms'    => $product_tag
				) );

				$view_all_link = dina_get_term_links( 'product_tag', $product_tag );

			} elseif ( $prod_filter == 'brand' && ! empty( $product_brand ) ) {
				
				array_push( $tax_query, array(
					'taxonomy' => dina_opt( 'product_brand_taxonomy' ),
					'field'    => 'term_id',
					'terms'    => $product_brand
				) );

				$view_all_link = dina_get_term_links( dina_opt( 'product_brand_taxonomy' ), $product_brand );

			} elseif ( $settings['prod_filter'] == 'product-ids' && ! empty( $settings['product_ids'] ) ) {
				$args['post__in'] = explode( ',', $settings['product_ids'] );
			}
		}

		if ( 'yes' === $settings['out_prod'] ) {
			$args['meta_query'] = array(
				'relation' => 'AND',
				array(
					'key'     => '_stock_status',
					'value'   => 'outofstock',
					'compare' => 'NOT IN'
				)
			);
		}

		$args['tax_query'] = $tax_query;

		$args[] = array(
			'no_found_rows'          => true,
			'update_post_term_cache' => false
		);


		$productsquery = new \WP_Query( $args );

		if ( $productsquery->have_posts() ) {

		if ( ! empty( $settings['title'] ) ) { ?>
			<div class="block-title<?php if ( $settings['remove_underline'] ) echo ' block-title-not-line'; if ( 'yes' === $settings['middle_title'] ) echo ' dina-center-title'; ?>">
				<?php echo ! isset ( $settings['title_tag'] ) ? '<h2 class="block-title-con">' : '<' . $settings['title_tag'] . ' class="block-title-con">'; ?>
					<?php if ( ! empty( $settings['custom_icon']['url'] ) ) { ?>
						<img src="<?php echo $settings['custom_icon']['url']; ?>" width="32" height="32" alt="<?php echo $settings['title']; ?>" class="cust-icon">
					<?php } elseif ( ! empty( $settings['product_icon'] ) ) { ?>
						<i class="fal fa-<?php echo $settings['product_icon']; ?>" aria-hidden="true"></i>
					<?php } ?>
					<?php echo $settings['title']; ?>
				<?php echo ! isset ( $settings['title_tag'] ) ? '</h2>' : '</' . $settings['title_tag'] . '>'; ?>

				<?php
				if ( ! empty ( $settings['view_all_link']['url'] ) ) {
					$target = ! empty ( $settings['view_all_link']['is_external'] ) ? ' target="_blank"' : '';
					$nofollow = ! empty ( $settings['view_all_link']['nofollow'] ) ? ' rel="nofollow"' : '';
					$view_all_link = $settings['view_all_link']['url'];
				?>
					<a href="<?php echo $view_all_link; ?>" class="pview-all"<?php echo $target . $nofollow; ?>>
						<?php _e( 'View All' , 'dina-kala' ); ?>
						<i class="fal fa-chevron-left" aria-hidden="true"></i>
					</a>
				<?php } elseif ( 'yes' === $settings['view_all'] && $view_all_link != '' ) { ?>
					<a href="<?php echo $view_all_link; ?>" class="pview-all">
						<?php _e( 'View All' , 'dina-kala' ); ?>
						<i class="fal fa-chevron-left" aria-hidden="true"></i>
					</a>
				<?php } ?>
			</div>
		<?php } ?>

		<?php
			$carousel_options  = '';
			$carousel_options .= 'yes' === $settings['show_arrows'] ? ' data-itemnavs="true"' : ' data-itemnavs="false"'; 
			$carousel_options .= 'yes' === $settings['prod_loop'] ? ' data-itemloop="true"' : ' data-itemloop="false"'; 
			$carousel_options .= 'yes' === $settings['auto_play'] ? ' data-itemplay="true" data-itemtime="'. $settings['time'] .'"' : ' data-itemplay="false"'; 
			$carousel_options .= 'yes' === $settings['pause_over'] ? ' data-itemover="true"' : ' data-itemover="false"'; 
			$carousel_options .= ! empty ( $settings['pcount'] ) ? ' data-itemscount="'. $settings['pcount'] .'"' : ' data-itemscount="5"';
			$carousel_options .= ! empty ( $settings['slide_by'] ) ? ' data-item-slideby="'. $settings['slide_by'] .'"' : ' data-item-slideby="1"';
			$carousel_options .= ' data-dir="'. dina_rtl() .'"';

			$item_classes  = 'dina-column-item';
			$item_classes .= 'yes' === $settings['white_border_product'] ? ' dina-item-white-border shadow-box' : '';
		?>

		<div class="owl-carousel" data-mcol="1" <?php echo $carousel_options; ?>>
			
			<?php
			$count = 1;
			echo '<div class="item">';
			while ( $productsquery->have_posts() ) : $productsquery->the_post(); ?>
				<?php
				global $product;
				?>
				<div class="<?php echo $item_classes ?>">

					<div class="dina-column-img">
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" target="<?php echo dina_link_target(); ?>">
							<?php 
							if ( has_post_thumbnail() ) {
								the_post_thumbnail( 'thumbnail', [ 'loading' => 'eager'] );            
							} else {
								prod_default_thumb();
							}
							?>
						</a>
					</div>

					<?php if ( $settings['show_product_number'] === 'yes' ) { ?>
					<div class="dina-column-number">
						<?php 
						echo $count;
						?>
					</div>
					<?php } ?>

					<div class="dina-column-title<?php if ( 'yes' === $settings['show_price'] ) echo ' dina-column-title-two' ?>">

						<p>
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" target="<?php echo dina_link_target(); ?>">
								<?php the_title(); ?>
							</a>
						</p>

						<?php do_action( 'dina_products_column_after_title' ) ?>

						<?php if ( 'yes' === $settings['show_price'] ) { ?>
							<p class="dina-column-price">
							<?php
							if ( $product->is_in_stock() ) {
								echo $product->get_price_html();
							} else { ?>
								<span class="nstock">
									<?php echo dina_outofstock_text(); ?>
								</span>
							<?php } ?>
							</p>
						<?php } ?>

					</div>

				</div>

				<?php
				if ( $count == $settings['ptotalcount'] || $count == $productsquery->found_posts ) {
					echo '</div>';
				} elseif ( $count % $row_count == 0 ){
					echo '</div><div class="item">';
				}
				
				$count++;

			endwhile; ?>
        </div>
		<?php 
		} else {
			$no_prod_class = ( 'yes' === $settings['hide_no_prod'] ? ' not-dina-hide-section' : '' );
			echo '<div class="col-12 not-msg'. $no_prod_class .'">'.__( 'No product with the desired conditions was found.', 'dina-kala' ).'</div>';
		}

		wp_reset_postdata();
		?>

        </div>
		
        <?php
	}
}