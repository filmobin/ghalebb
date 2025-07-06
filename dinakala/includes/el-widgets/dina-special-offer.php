<?php
namespace Elementor;

class Special_Offer extends Widget_Base {
	
	public function get_name() {
		return 'special-offer';
	}
	
	public function get_title() {
		return __( 'Special offer (Dinakala)', 'dina-kala' );
	}
	
	public function get_icon() {
		return 'fal fa-star';
	}

    public function get_help_url() {
		return 'https://i-design.ir/docs/dinakala/?p=1025';
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
                'default'     => __( 'Special offer', 'dina-kala' ),
			]
		);

		$this->add_control(
			'site_name',
			[
                'label'       => __( 'Site name', 'dina-kala' ),
                'label_block' => true,
                'type'        => Controls_Manager::TEXT,
                'placeholder' => __( 'Enter your site name', 'dina-kala' ),
                'default'     => __( 'Sample', 'dina-kala' ),
			]
        );

        $this->add_control(
			'show_title_mobile',
			[
				'label'        => __( 'Show the title in mobile mode', 'dina-kala' ),
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
				'label'        => __( 'Inheriting the site title color from the template color', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'site_title_color',
			[
				'label'     => __( 'Color', 'dina-kala' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#17A2B8',
				'selectors' => [
					'{{WRAPPER}} .sp-stitle .sp-red' => 'color: {{VALUE}}',
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
				'default'      => '',
			]
        );

        $this->add_control(
			'show_dis_timed',
			[
				'label'        => __( 'Only products with timed discounts will be displayed', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
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
				'default' => 5,
			]
		);

        $this->add_control(
			'out_stock',
			[
                'label'       => __( 'Text finished product in stock', 'dina-kala' ),
                'label_block' => true,
                'type'        => Controls_Manager::TEXT,
                'placeholder' => __( 'Out of stock!', 'dina-kala' ),
                'default'     => __( 'Out of stock!', 'dina-kala' ),
			]
        );

        $this->add_control(
			'out_icon',
			[
				'label'        => __( 'Show out of stock icon', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

        $this->add_control(
			'rand_prod',
			[
				'label'        => __( 'Select products randomly', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => '',
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
			'sale_count_style',
			[
				'label'   => __( 'Discount countdown style', 'dina-kala' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'sale-count-outline',
				'options' => [
                    'sale-count-black'   => __( 'Black', 'dina-kala' ),
                    'sale-count-white'   => __( 'White', 'dina-kala' ),
                    'sale-count-gray'    => __( 'Gray', 'dina-kala' ),
                    'sale-count-outline' => __( 'Outline', 'dina-kala' ),
				],
			]
		);

        $this->add_control(
			'sale_count_format',
			[
				'label'   => __( 'Discount countdown format', 'dina-kala' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'wdhm',
				'options' => [
                    'wdhm' => __( 'Week: Day: Hour: Minute: Second', 'dina-kala' ),
                    'dhm'  => __( 'Day: Hour: Minute: Second', 'dina-kala' ),
				],
			]
		);

        $this->add_control(
			'sale_count_circle',
			[
				'label'        => __( 'Circle style', 'dina-kala' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'dina-kala' ),
				'label_off'    => __( 'Off', 'dina-kala' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
        );
        
		$this->end_controls_section();
        //End Style Section
        
	}
	
	protected function render() {
        
        $settings = $this->get_settings_for_display();
        $mobile_title = 'yes' === $settings['show_title_mobile'] ? ' special-mobile-title' : '';
        ?>
        
        <div class="row shadow-box special-box<?php echo $mobile_title ?>">

            <?php 

                $args = array(
                    'posts_per_page' => $settings['ptotalcount'],
                    'post_type'      => 'product',
                    'post_status'    => 'publish',
                    'meta_key'       => 'dina_special',
                    'meta_value'     => 'on',
                    'order'          => 'DESC'
                );

                if ( 'yes' === $settings['show_dis_timed'] ) {
                    $args['post__in'] = array_merge( array( 0 ), dina_scheduled_sale_products() );
                } elseif ( 'yes' === $settings['show_dis'] ) {
                    $args['post__in'] = array_merge( array( 0 ), wc_get_product_ids_on_sale() );
                }

                if ( 'yes' === $settings['rand_prod'] ) {
                    $args['orderby'] = 'rand';
                }

                $tax_query = array();
				array_push( $tax_query, array( 'relation' => 'AND' ) );			
				array_push( $tax_query, array(
					'taxonomy' => 'product_visibility',
					'field'    => 'name',
					'terms'    => 'exclude-from-catalog',
					'operator' => 'NOT IN',
				) );

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

                $specialpost = new \WP_Query( $args );

            if ( $specialpost->have_posts() ) { ?>

                <?php
                    $slider_options  = '';
                    $slider_options .= 'yes' === $settings['auto_play'] ? ' data-itemplay="true" data-itemtime="'. $settings['time'] .'"' : ' data-itemplay="false"'; 
                    $slider_options .= 'yes' === $settings['pause_over'] ? ' data-itemover="true"' : ' data-itemover="false"'; 
                    $slider_options .= ' data-dir="'. dina_rtl() .'"';
                ?>

                <div class="col-lg-8 col-12 owl-carousel special-slider" <?php echo $slider_options; ?>>
                    <?php while ( $specialpost->have_posts() ) : $specialpost->the_post();
                    $product = wc_get_product( get_the_ID() );
                    $coming = get_post_meta( $product->get_id(), 'dina_coming', true );
                    ?>
                    
                    <div class="col-12 item">
                        <?php if ( ! $product->is_in_stock() ) { ?>
                        <div class="pnot-in-stock">
                            <span class="not-stock-text">
                                <?php if ( 'yes' === $settings['out_icon'] ) { ?>
                                    <i class="fal fa-frown" aria-hidden="true"></i>
                                <?php } ?>
                                <?php echo $settings['out_stock']; ?>
                            </span>
                        </div>
                        <?php } ?>
                        <?php if ( ! $product->is_in_stock() ) { ?>
                            <div class="pblur">
                        <?php } ?>
                                <?php if ( $product->is_on_sale() && dina_opt( 'display_discount' ) ) { ?>
                                <span class="sp-discount<?php if ( dina_opt( 'display_spec' ) ) { echo ' sp-discount-sepcial';  }?>">
                                    <span>
                                        <?php if ( dina_opt( 'display_spec' ) ) { ?>
                                            <?php _e( 'Special!', 'dina-kala' ); ?>
                                        <?php } elseif ( is_rtl() ) { ?>
                                            ٪<?php echo disw_price( get_the_ID() ) ?> <?php _e( 'Discount', 'dina-kala' ); ?>
                                        <?php } else { ?>
                                            <?php echo disw_price( get_the_ID() ) ?>% <?php _e( 'Discount', 'dina-kala' ); ?>
                                        <?php } ?>
                                    </span>
                                </span>
                                <?php } ?>
                                <div class="col-md-4 col-12 special-img">

                                    <?php do_action( 'dina_before_special_offer_img' ); ?>

                                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                    <?php if ( has_post_thumbnail() ) {
                                        the_post_thumbnail( 'woocommerce_thumbnail', ['class' => 'skip-lazy no-lazyload', 'loading' => 'eager'] );
                                    } else {
                                        prod_default_thumb();
                                    } ?>
                                    </a>

                                    <?php do_action( 'dina_after_special_offer_img' ); ?>

                                </div>
                                <div class="col-md-8 col-12 special-text">
                                    <div class="sp-stitle">
                                        <?php echo $settings['title']; ?> <span class="sp-red"><?php echo $settings['site_name']; ?></span>
                                    </div>
                                    <div class="col-12 sp-title">
                                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                            <i class="fal fa-chevron-left" aria-hidden="true"></i>
                                            <?php the_title(); ?>
                                        </a>
                                    </div>

                                    <?php do_action( 'dina_after_sptitle' ); ?>
                                    
                                    <?php 
                                    if ( dina_opt( 'product_catalog_mode' ) && dina_opt( 'product_catalog_price_mode' ) ) {
                                        //Show Nothing
                                    } else { ?>
                                    <div class="col-12 sp-price">
                                            <?php if ( $product->is_in_stock() || dina_opt( 'show_price_out' ) || show_login_price() ) {
                                                echo $product->get_price_html();
                                            } else {
                                                echo dina_outofstock_text();
                                            } ?>
                                    </div>
                                    
                                    <?php 
                                        if ( $product -> is_type( 'variable' ) ) {
                                            $children_ids = $product->get_children();
                                            $date = '';
                                            foreach ( $children_ids as $children_id ) {
                                                if ( ! empty( $date ) )
                                                    break;
                                                $child_date = get_post_meta( $children_id, '_sale_price_dates_to', true );
                                                if ( ! empty( $child_date ) ) {
                                                    $date = $child_date;
                                                }
                                            }
                                        } else {
                                            $date = get_post_meta( get_the_ID(), '_sale_price_dates_to', true );
                                        }

                                        if ( ! $coming && ! empty( $date ) && ( $product->is_purchasable() || $product -> is_type( 'external' ) ) && $product->is_in_stock() && ! show_login_price() ) {
                                            $date += 24*60*60;
                                            $sale_price_date = ( $date ) ? date( 'Y/m/d', $date ) : '';
                                            $date_diff = ( $date ) ? date( 'Y-m-d', $date ) : '';
                                            $now = time(); // or your date as well
                                            $your_date = strtotime( $date_diff );
                                            $diff = $your_date - $now;
                                            $datediff = round( $diff / ( 60 * 60 * 24 ) ); ?>
                                            <?php if ( $product->is_on_sale() && ! show_login_price() ) { ?>
                                                <div class="col-12">
                                                    <div class="salecount <?php echo $settings['sale_count_style']; echo ! $settings['sale_count_circle'] ? ' sale-not-circle' : ''; ?>" data-format="<?php echo $settings['sale_count_format']; ?>" data-datediff="<?php echo $datediff; ?>" data-countdown="<?php echo $sale_price_date; ?>" data-dir="<?php dina_dir() ?>" data-seconds="<?php _e( 'Seconds' , 'dina-kala' ); ?>" data-minutes="<?php _e( 'Minutes' , 'dina-kala' ); ?>" data-hours="<?php _e( 'Hours' , 'dina-kala' ); ?>" data-days="<?php _e( 'Days' , 'dina-kala' ); ?>" data-weeks="<?php _e( 'Weeks' , 'dina-kala' ); ?>"></div>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                    <?php do_action( 'dina_before_special_offer_button' ) ?>
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="btn btn-outline-dina sp-btn">
                                    <?php if ( dina_opt( 'product_catalog_mode' ) ) { ?>
                                        <i class="fal fa-eye" aria-hidden="true"></i>
                                        <?php _e( 'View Product', 'dina-kala' ); ?>
                                    <?php } elseif ( ! dina_opt( 'product_catalog_mode' ) && show_login_price() || ! $product->is_purchasable() || ! $product->is_in_stock() || $coming || ( ! $product->is_type( 'variable' ) && dina_is_call( $product->get_id() ) ) ) { ?>
                                        <i class="fal fa-eye" aria-hidden="true"></i>
                                        <?php _e( 'View Product', 'dina-kala' ); ?>
                                    <?php } else { ?>
                                        <i class="fal fa-cart-plus" aria-hidden="true"></i>
                                        <?php _e( 'Buy Product', 'dina-kala' ); ?>
                                    <?php } ?>
                                    </a>
                                    <?php do_action( 'dina_after_special_offer_button' ) ?>
                                </div>
                        <?php if ( ! $product->is_in_stock() ) { ?>
                            </div>
                        <?php } ?>
                    </div>
                    <?php endwhile; ?>
                </div>

                <div class="col-lg-4 d-none d-lg-block special-title">
                    <ul class="slider-nav">
                        <?php while ( $specialpost->have_posts() ) : $specialpost->the_post(); ?>
                        <li>
                            <?php the_title(); ?>
                        </li>
                        <?php endwhile; ?>
                    </ul>
                </div>

            <?php } else {
                $no_prod_class = ( 'yes' === $settings['hide_no_prod'] ? ' not-dina-hide-section' : '' );
                echo '<div class="col-12 not-msg'. $no_prod_class .'">'. __( 'No product with the desired conditions was found.', 'dina-kala' ) .'</div>';
            } ?>
        </div>
    <?php

	}

}