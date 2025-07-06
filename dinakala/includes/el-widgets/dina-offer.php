<?php
namespace Elementor;

class Dina_Woo_Offer extends Widget_Base {

	public function get_name() {
		return 'dina-woo-offer';
	}
	
	public function get_title() {
		return __( 'Momentary offer (Dinakala)', 'dina-kala' );
	}
	
	public function get_icon() {
		return 'fal fa-badge-percent';
	}

	public function get_help_url() {
		return 'https://i-design.ir/docs/dinakala/?p=1038';
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
				'placeholder' => __( 'Instant Offer', 'dina-kala' ),
				'default'     => __( 'Instant Offer', 'dina-kala' ),
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
			'inherit_color',
			[
				'label'        => __( 'Inherit the progress bar color from the template color', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'progress_bar_color',
			[
				'label'     => __( 'Progress bar color', 'dina-kala' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#dc3545',
				'selectors' => [
					'{{WRAPPER}} .offer-block .slide-progress' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'inherit_color' => '',
				],
			]
		);

		$this->add_control(
			'border_color',
			[
				'label'     => __( 'Border color', 'dina-kala' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(239, 83, 80, 0.3)',
				'selectors' => [
					'{{WRAPPER}} .offer-block' => 'border-color: {{VALUE}}',
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
			'product_cat',
			[
				'label'       => __( 'Product category', 'dina-kala' ),
				'type'        => 'dina_autocomplete',
				'search'      => 'dina_get_taxonomies_by_query',
				'render'      => 'dina_get_taxonomies_title_by_id',
				'taxonomy'    => 'product_cat',
				'multiple'    => true,
				'label_block' => true,
			]
		);

		$this->add_control(
			'hide_no_prod',
			[
				'label'        => __( 'Hide the block if there is no product', 'dina-kala' ),
				'description'  => __( 'suitable for when the product discount expires', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_control(
			'show_dis',
			[
				'label'        => __( 'Only show discounted products', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => 'yes',
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
				'default' => 5,
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
			'time',
			[
				'label'   => __( 'Auto play speed(ms)', 'dina-kala' ),
				'type'    => Controls_Manager::NUMBER,
				'min'     => 1000,
				'max'     => 20000,
				'step'    => 1000,
				'default' => 5000,
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
        $settings          = $this->get_settings_for_display();
		$discount_location = ( ! empty ( dina_opt( 'product_discount_location' ) ) ? dina_opt( 'product_discount_location' ) : ' product-discount-left' );
		$label_location    = ( ! empty ( dina_opt( 'product_label_location' ) ) ? dina_opt( 'product_label_location' ) : ' product-label-right' );
	?>
        <div class="offer-block shadow-box <?php echo $discount_location . ' ' . $label_location; ?>">
			<div class="block-title">
				<?php echo ! isset ( $settings['title_tag'] ) ? '<h2 class="block-title-con">' : '<' . $settings['title_tag'] . ' class="block-title-con">'; ?>
					<?php echo $settings['title']; ?>
				<?php echo ! isset ( $settings['title_tag'] ) ? '</h2>' : '</' . $settings['title_tag'] . '>'; ?>
				<div class="slide-progress"></div>
			</div>

		<?php

			$product_cat = $settings['product_cat'];

			$args = array(
					'posts_per_page'         => $settings['ptotalcount'],
					'post_type'              => 'product',
					'post_status'            => 'publish',
					'orderby'                => 'rand',
					'no_found_rows'          => true,
					'update_post_term_cache' => false );

			if ( 'yes' === $settings['show_dis'] ) {
				$args['post__in'] = array_merge( array( 0 ), wc_get_product_ids_on_sale() );
			}

			$tax_query = array();
			
			array_push( $tax_query, array( 'relation' => 'AND' ) );			
			array_push( $tax_query, array(
				'taxonomy' => 'product_visibility',
				'field'    => 'name',
				'terms'    => 'exclude-from-catalog',
				'operator' => 'NOT IN',
			) );

			if ( ! empty( $product_cat) ) {
				array_push( $tax_query, array(
					'taxonomy' => 'product_cat',
					'field'    => 'term_id',
					'terms'    => $product_cat
				) );
			}

			$args['meta_query'] = array(
				'relation' => 'AND',
				array(
					'key'     => '_stock_status',
					'value'   => 'outofstock',
					'compare' => 'NOT IN'
				)
			);

			$args['tax_query'] = $tax_query;

			$offerquery = new \WP_Query( $args );
		?>
		
		<?php if ( $offerquery->have_posts() ) { ?>

		<?php
			$slider_options  = '';
			$slider_options .= ' data-itemplay="true" data-itemtime="'. $settings['time'] .'"'; 
			$slider_options .= 'yes' === $settings['pause_over'] ? ' data-itemover="true"' : ' data-itemover="false"'; 
			$slider_options .= ' data-dir="'. dina_rtl() .'"';
		?>

		<div class="owl-carousel" <?php echo $slider_options; ?>>
        <?php while ( $offerquery->have_posts() ) : $offerquery->the_post();
		global $product; ?>
			<div class="item">
				<div class="mini-product">
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="product-link" target="<?php echo dina_link_target(); ?>">
						<?php if ( has_post_thumbnail() ) {
							the_post_thumbnail( 'woocommerce_thumbnail', ['class' => 'skip-lazy no-lazyload', 'loading' => 'eager'] );
						} else { 
							prod_default_thumb();
						} ?>
						<?php if ( $product->is_on_sale() ) { ?>
						<?php echo dina_dis_price(); ?>
						<?php } ?>
						<?php echo dina_product_label(); ?>
						<span class="product-title">
							<?php the_title(); ?>
						</span>

						<?php 
						if ( dina_opt( 'product_catalog_mode' ) && dina_opt( 'product_catalog_price_mode' ) ) {
							//Show Nothing
						} else { ?>
						<span class="product-price">
							<span class="price-con product-not-on-sale">
							<?php if ( $product->is_in_stock() || dina_opt( 'show_price_out' ) || show_login_price() ) { ?>
								<?php echo $product->get_price_html(); ?>
							<?php } else { ?>
								<?php echo dina_outofstock_text(); ?>
							<?php } ?>
							</span>
						</span>
						<?php } ?>
					</a>
				</div>
			</div>
        <?php endwhile; ?>
        </div>

		<?php 
		} else {		
			$no_prod_class = ( 'yes' === $settings['hide_no_prod'] ? ' not-dina-hide-section' : '' );
			echo '<div class="col-12 not-msg'. $no_prod_class .'">'. __( 'No product with the desired conditions was found.', 'dina-kala' ).'</div>';
		}
		wp_reset_postdata();
		?>
        </div>
        <?php
	}
}