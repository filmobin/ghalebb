<?php
namespace Elementor;

class Dina_Woo_Products_Grid extends Widget_Base {

	public function get_name() {
		return 'dina-woo-products-grid';
	}
	
	public function get_title() {
		return __( 'Products Grid (Dinakala)', 'dina-kala' );
	}
	
	public function get_icon() {
		return 'fal fa-th';
	}

	public function get_help_url() {
		return 'https://i-design.ir/docs/dinakala/?p=1021';
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

		$this->add_control(
			'pcount',
			[
				'label'   => __( 'Product columns count', 'dina-kala' ),
				'type'    => Controls_Manager::NUMBER,
				'min'     => 2,
				'max'     => 5,
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
				'condition'     => [
					'view_all' => 'yes',
				],
			]
        );

		$this->end_controls_section();
		//End Products Section

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

		$block_classes  = '';
		$block_classes .= ( 'yes' === $settings['white_title'] ? ' white-title' : '' );
		$block_classes .= ( isset( $settings['dark_title'] ) && 'yes' === $settings['dark_title'] ? ' dark-title' : '' );
		$block_classes .= ( 'yes' === $settings['white_box'] ? ' white-box' : '' );
		$block_classes .= 'yes' === $settings['middle_title'] ? ' dina-middle-title' : ' dina-right-title';
		?>
        <div class="product-block-grid<?php echo $block_classes; ?>">
		
		<?php

		$prod_sort     = $settings['prod_sort'];
		$prod_filter   = $settings['prod_filter'];
		$product_cat   = $settings['product_cat'];
		$product_tag   = $settings['product_tag'];
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
		$title_class   = 'yes' === $settings['remove_underline'] ? 'block-title-con block-title-not-line' : 'block-title-con';
		?>
		
		<?php if ( $productsquery->have_posts() ) { ?>
		<?php if ( ! empty( $settings['title'] ) ) { ?>
			<?php echo ! isset ( $settings['title_tag'] ) ? '<h2 class="'. $title_class .'">' : '<' . $settings['title_tag'] . ' class="'. $title_class .'">'; ?>
				<?php if ( ! empty( $settings['custom_icon']['url'] ) ) { ?>
					<img src="<?php echo $settings['custom_icon']['url']; ?>" width="32" height="32" alt="<?php echo $settings['title']; ?>" class="cust-icon">
				<?php } else { ?>
					<i class="fal fa-<?php echo $settings['product_icon']; ?>" aria-hidden="true"></i>
				<?php } ?>
				<?php echo $settings['title']; ?>
			<?php echo ! isset ( $settings['title_tag'] ) ? '</h2>' : '</' . $settings['title_tag'] . '>'; ?>
		<?php } ?>
		<div class="row">
		<?php 
			if ( $settings['pcount'] == 2 ) {
				$pclasses = 'col-6';
			} elseif ( $settings['pcount'] == 3 ) {
				$pclasses = 'col-md-4 col-6';
			} elseif ( $settings['pcount'] == 4 ) {
				$pclasses = 'col-md-3 col-6';
			} elseif ( $settings['pcount'] == 5 ) {
				$pclasses = 'col-p-5 col-md-3 col-6';
			} 
			
			if ( ( dina_opt( 'mobile_single_col' ) && $settings['pcount_mobile'] == 'default' ) || ( $settings['pcount_mobile'] == '1' ) ) {
				$pclasses .= ' mobile-single-col';
			}
		?>
		<?php while ( $productsquery->have_posts() ) : $productsquery->the_post(); ?>
			<?php global $product; ?>
			<div class="<?php echo $pclasses; ?> mini-product-con type-product"> 
				<?php get_template_part( 'includes/content-product' ); ?>
			</div>
		<?php endwhile; ?>
		</div>
		<?php if ( ! empty ( $settings['view_all_link']['url'] ) ) {
			$target = ! empty ( $settings['view_all_link']['is_external'] ) ? ' target="_blank"' : '';
			$nofollow = ! empty ( $settings['view_all_link']['nofollow'] ) ? ' rel="nofollow"' : '';
			$view_all_link = $settings['view_all_link']['url'];
		?>
			<a href="<?php echo $view_all_link; ?>" class="btn btn-outline-dina pgview-all"<?php echo $target . $nofollow; ?>>
				<?php _e( 'View All Products' , 'dina-kala' ); ?>
				<i class="fal fa-chevron-left" aria-hidden="true"></i>
			</a>
		<?php } elseif ( 'yes' === $settings['view_all'] && $view_all_link != '' ) { ?>
			<a href="<?php echo $view_all_link; ?>" class="btn btn-outline-dina pgview-all">
				<?php _e( 'View All Products' , 'dina-kala' ); ?>
				<i class="fal fa-chevron-left" aria-hidden="true"></i>
			</a>
		<?php } ?>
		<?php 
		} else {		
			$no_prod_class = ( 'yes' === $settings['hide_no_prod'] ? ' not-dina-hide-section' : '' );
			echo '<div class="col-12 not-msg'. $no_prod_class .'">'.__( 'No product with the desired conditions was found.', 'dina-kala' ).'</div>';}
		
		wp_reset_postdata();
		?>
        </div>
        <?php

	}

}