<?php
namespace Elementor;

class Dina_Woo_Products_Table extends Widget_Base {

	public function get_name() {
		return 'dina-woo-products-table';
	}
	
	public function get_title() {
		return __( 'Products Table (Dinakala)', 'dina-kala' );
	}
	
	public function get_icon() {
		return 'fal fa-table';
	}

	public function get_help_url() {
		return 'https://i-design.ir/docs/dinakala/?p=3066';
	}
	
	public function get_categories() {
		return [ 'dina-kala' ];
	}

	public function get_script_depends() {
		return [ 'dina-table-loadmore' ];
	}

	public function get_style_depends() {
		return [ 'dina-table-loadmore' ];
	}

	public function get_product_attributes_array() {

		$attributes = [];

		foreach ( wc_get_attribute_taxonomies() as $attribute ) {
			$attributes[ $attribute->attribute_name ] = esc_html( $attribute->attribute_label );
		}

		return $attributes;
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
			'table_icon',
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
					'h5'  => __( 'h5', 'dina-kala' ),
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
			'ptotalcount',
			[
				'label'   => __( 'Product total count', 'dina-kala' ),
				'type'    => Controls_Manager::NUMBER,
				'min'     => 1,
				'max'     => 200,
				'step'    => 1,
				'default' => 10,
			]
		);

		$this->end_controls_section();
		//End Products Section

		//Start Table Section
		$this->start_controls_section(
			'table_section',
			[
				'label' => __( 'Table settings', 'dina-kala' ),
			]
		);

		$this->add_control(
			'ajax_loadmore',
			[
				'label'        => __( 'Enable loading more products in Ajax (if there are more products)', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_control(
			'show_thumb',
			[
				'label'        => __( 'Show product thumbnail', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'show_sku',
			[
				'label'        => __( 'Show product SKU', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_control(
			'show_title',
			[
				'label'        => __( 'Show product title', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => 'yes',
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
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'show_desc',
			[
				'label'        => __( 'Show product description', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'show_attr',
			[
				'label'        => __( 'Show product attributes', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_control(
			'product_attr',
			[
				'label'       => __( 'Product attributes', 'dina-kala' ),
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'options'     => $this->get_product_attributes_array(),
				'condition'   => [
                    'show_attr' => 'yes',
                ],
			]
		);

		$this->add_control(
			'show_rating',
			[
				'label'        => __( 'Show product rating', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_control(
			'show_quick_view',
			[
				'label'        => __( 'Show quick view button', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_control(
			'show_add_cart',
			[
				'label'        => __( 'Show add to cart button', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->end_controls_section();
		//End Table Section

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

		$block_classes  = 'woocommerce dina-products-table';
		$block_classes .= ( 'yes' === $settings['white_title'] ? ' white-title' : '' );
		$block_classes .= ( isset( $settings['dark_title'] ) && 'yes' === $settings['dark_title'] ? ' dark-title' : '' );
		$block_classes .= ( 'yes' === $settings['white_box'] ? ' white-box' : '' );
		$block_classes .= ( 'yes' === $settings['middle_title'] ? ' dina-table-middle-title' : ' dina-table-right-title' );
		?>

        <div id="dina-product-table-<?php echo $this->get_id() ?>" class="<?php echo $block_classes; ?>">
		
		<?php

		$prod_sort     = $settings['prod_sort'];
		$per_page      = $settings['ptotalcount'];
		$prod_filter   = $settings['prod_filter'];
		$product_cat   = $settings['product_cat'];
		$product_tag   = $settings['product_tag'];
		$product_attrs = $settings['product_attr'];
		$product_brand = dina_opt( 'product_brand' ) ? $settings['product_brand'] : '';

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
				'posts_per_page' => $per_page,
				'post_type'      => 'product',
				'post_status'    => 'publish',
				'order'          => 'DESC'  );
				break;
			case 'latest-updated':
				$args = array(
				'posts_per_page'      => $per_page,
				'post_type'           => 'product',
				'post_status'         => 'publish',
				'orderby'             => 'modified',
				'ignore_sticky_posts' => '1',
				'order'               => 'DESC'  );
				break;
			case 'menu_order':
				$args = array(
				'posts_per_page' => $per_page,
				'post_type'      => 'product',
				'post_status'    => 'publish',
				'orderby'        => 'menu_order title',
				'order'          => 'ASC'  );
				break;
			case 'saled':
				$args = array(
					'posts_per_page' => $per_page,
					'post_type'      => 'product',
					'post_status'    => 'publish',
					'meta_key'       => 'total_sales',
					'orderby'        => 'meta_value_num',
					'order'          => 'DESC'
				);
				break;
			case 'discounted':
				$args = array(
					'posts_per_page' => $per_page,
					'post_status'    => 'publish',
					'order'          => 'DESC',
					'post_type'      => 'product',
					'post__in'       => array_merge( array( 0 ), wc_get_product_ids_on_sale() )
				);
				break;
			case 'coming_soon':
				$args = array(
					'posts_per_page' => $per_page,
					'post_type'      => 'product',
					'post_status'    => 'publish',
					'meta_key'       => 'dina_coming',
					'meta_value'     => 'on',
					'order'          => 'DESC'
				);
				break;
			case 'rand_discounted':
				$args = array(
					'posts_per_page' => $per_page,
					'post_status'    => 'publish',
					'orderby'        => 'rand',
					'post_type'      => 'product',
					'post__in'       => array_merge( array( 0 ), wc_get_product_ids_on_sale() )
				);
				break;
			case 'viewed':
				$args = array(
					'posts_per_page' => $per_page,
					'post_type'      => 'product',
					'post_status'    => 'publish',
					'meta_key'       => dina_opt( 'views_meta_key' ),
					'orderby'        => 'meta_value_num',
					'order'          => 'DESC'
				);
				break;
			case 'price-desc':
				$args = array(
					'posts_per_page' => $per_page,
					'post_type'      => 'product',
					'post_status'    => 'publish',
					'orderby'        => 'meta_value_num',
					'meta_key'       => '_price',
					'order'          => 'DESC'
				);
				break;
			case 'price-asc':
				$args = array(
					'posts_per_page' => $per_page,
					'post_type'      => 'product',
					'post_status'    => 'publish',
					'orderby'        => 'meta_value_num',
					'meta_key'       => '_price',
					'order'          => 'ASC'
				);
				break;
			case 'random':
				$args = array(
				'posts_per_page' => $per_page,
				'post_type'      => 'product',
				'post_status'    => 'publish',
				'orderby'        => 'rand'
				);
				break;
			case 'special':
				$args = array (
					'posts_per_page' => $per_page,
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
					'posts_per_page' => $per_page,
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
				'posts_per_page' => $per_page,
				'post_type'      => 'product',
				'post_status'    => 'publish',
				'order'          => 'DESC'
			);
		}

		$prod_term = '';
		if ( $prod_filter ) {

			if ( $prod_filter == 'category' && ! empty( $product_cat ) ) {

				array_push( $tax_query, array(
					'taxonomy' => 'product_cat',
					'field'    => 'term_id',
					'terms'    => $product_cat
				) );

				$prod_term     = implode( ',', $product_cat );
				$view_all_link = dina_get_term_links( 'product_cat', $product_cat );

			} elseif ( $prod_filter == 'tag' && ! empty( $product_tag ) ) {

				array_push( $tax_query, array(
					'taxonomy' => 'product_tag',
					'field'    => 'term_id',
					'terms'    => $product_tag
				) );

				$prod_term     = implode( ',', $product_tag );
				$view_all_link = dina_get_term_links( 'product_tag', $product_tag );

			} elseif ( $prod_filter == 'brand' && ! empty( $product_brand ) ) {
				
				array_push( $tax_query, array(
					'taxonomy' => dina_opt( 'product_brand_taxonomy' ),
					'field'    => 'term_id',
					'terms'    => $product_brand
				) );

				$prod_term     = implode( ',', $product_brand );
				$view_all_link = dina_get_term_links( dina_opt( 'product_brand_taxonomy' ), $product_brand );

			} elseif ( $prod_filter == 'product-ids' && ! empty( $settings['product_ids'] ) ) {
				$prod_term        = $settings['product_ids'];
				$args['post__in'] = explode( ',', $settings['product_ids'] );
			}
		}

		$out_stock = 'yes' === $settings['out_prod'] ? 'yes' : 'no';
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
		?>
		
		<?php if ( $productsquery->have_posts() ) {

			$table_args = array(
				'show_thumb'      => $settings['show_thumb'],
				'show_sku'        => $settings['show_sku'],
				'show_title'      => $settings['show_title'],
				'show_price'      => $settings['show_price'],
				'show_desc'       => $settings['show_desc'],
				'show_attr'       => $settings['show_attr'],
				'show_rating'     => $settings['show_rating'],
				'show_add_cart'   => $settings['show_add_cart'],
				'show_quick_view' => $settings['show_quick_view']
			);

			if ( ! empty( $settings['title'] ) ) {
				echo ! isset ( $settings['title_tag'] ) ? '<div class="dina-products-table-title">' : '<' . $settings['title_tag'] . ' class="dina-products-table-title">';
					if ( ! empty( $settings['custom_icon']['url'] ) ) { ?>
						<img src="<?php echo $settings['custom_icon']['url']; ?>" width="32" height="32" alt="<?php echo $settings['title']; ?>" class="cust-icon">
					<?php } else { ?>
						<i class="fal fa-<?php echo $settings['table_icon']; ?>" aria-hidden="true"></i>
					<?php }
					echo $settings['title'];  
				echo ! isset ( $settings['title_tag'] ) ? '</div>' : '</' . $settings['title_tag'] . '>';
			}
			
			?>
			<div class="dina-products-table-con">
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<?php if ( $table_args['show_thumb'] ) { ?>
							<th class="dina-align-center"><?php _e( 'Image', 'dina-kala' ) ?></th>
							<?php } ?>

							<?php if ( $table_args['show_sku'] ) { ?>
							<th class="dina-align-center"><?php _e( 'SKU', 'dina-kala' ) ?></th>
							<?php } ?>

							<?php if ( $table_args['show_title'] ) {  ?>
							<th><?php _e( 'Title', 'dina-kala' ) ?></th>
							<?php } ?>

							<?php if ( $table_args['show_price'] && ! dina_opt( 'product_catalog_price_mode' ) ) {  ?>
							<th class="dina-align-center"><?php _e( 'Price', 'dina-kala' ) ?></th>
							<?php } ?>

							<?php if ( $table_args['show_desc'] ) {  ?>
							<th><?php _e( 'Description', 'dina-kala' ) ?></th>
							<?php } ?>

							<?php if ( $table_args['show_attr'] && ! empty( $product_attrs ) ) {
								foreach ( $product_attrs as $product_attr ) { 
									$table_args['product_attrs'] = $product_attrs; ?>
								<th class="dina-align-center"><?php echo wc_attribute_label( 'pa_'. $product_attr ) ?></th>
							<?php }
							} ?>

							<?php if ( $table_args['show_rating'] ) {  ?>
							<th class="dina-align-center"><?php echo _x( 'Rating', 'Dina Product Table', 'dina-kala' ) ?></th>
							<?php } ?>

							<?php if ( $table_args['show_quick_view'] ) {  ?>
							<th class="dina-align-center"><?php _e( 'Quick view', 'dina-kala' ) ?></th>
							<?php } ?>

							<?php if ( $table_args['show_add_cart'] && ! dina_opt( 'product_catalog_mode' ) ) {  ?>
							<th class="dina-align-center"><?php _e( 'Add to cart', 'dina-kala' ) ?></th>
							<?php } ?>
						</tr>
					</thead>

					<tbody class="dina-products-table-tbody">

					<?php
					while ( $productsquery->have_posts() ) : $productsquery->the_post();
					
						global $product;
						get_template_part( 'template-parts/table-row', '', $table_args );

					endwhile;

				echo '</tbody>
				</table>
			</div>';

		} else {		
			$no_prod_class = ( 'yes' === $settings['hide_no_prod'] ? ' not-dina-hide-section' : '' );
			echo '<div class="col-12 not-msg'. $no_prod_class .'">'.__( 'No product with the desired conditions was found.', 'dina-kala' ).'</div>';
		}
		
		wp_reset_postdata();
		
		if ( 'yes' === $settings['ajax_loadmore'] && $productsquery->max_num_pages > 1 ) {

			$max_page   = $productsquery->max_num_pages;
			$current    = get_query_var( 'paged' ) ? get_query_var('paged') : 1;
			$dina_vars = array(
				'prod_sort' => $prod_sort,
				'perpage'   => $per_page,
				'filter'    => $prod_filter,
				'term'      => $prod_term,
				'stock'     => $out_stock
			);

			echo '<div class="dina-table-loadmore btn btn-outline-dina" data-table="'. htmlspecialchars( json_encode( $table_args ), ENT_QUOTES, 'UTF-8' ) .'" data-vars="'. htmlspecialchars( json_encode( $dina_vars ), ENT_QUOTES, 'UTF-8' ) .'" data-current="'. $current .'" data-max-page="'. $max_page .'">
			<i class="fal fa-shopping-bag" aria-hidden="true"></i>
			'. __( 'Load More Products', 'dina-kala' ) .'</div>';
		}
				
		?>

        </div>
        <?php

	}

}