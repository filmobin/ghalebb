<?php
//dina_before_product_title
add_action( 'woocommerce_single_product_summary', 'dina_before_product_title', 4);
function dina_before_product_title() {
	echo '<div class="ptitle-con">';
    if ( dina_opt( 'product_brand' ) && dina_opt( 'brand_before_title' ) ) {
        dina_brand_logo();
    }
}

//dina_after_product_title
add_action( 'woocommerce_single_product_summary', 'dina_after_product_title', 10); 
function dina_after_product_title() {
	echo '</div>';
}

//Add Product Sub-title
add_action( 'woocommerce_single_product_summary', 'dina_product_sub_title', 9); 
function dina_product_sub_title() {
    $undertitle = get_post_meta( get_the_ID(), 'dina_under_title', true );
    $tag        = ! empty( dina_opt( 'sub_title_tag' ) ) ? dina_opt( 'sub_title_tag' ) : 'div';
    $output     = '<' . $tag . ' class="psub_title">'. $undertitle .'</' . $tag . '>';
	echo $output;
}

//Dina_woo_before_single_product_summary
add_action( 'woocommerce_before_single_product_summary', 'dina_woo_before_single_product_summary' );
function dina_woo_before_single_product_summary() { ?>
    <div class="shadow-box product-con col-12">
        <?php echo dina_woo_sale_flash(); ?>
        <ul class="prod-opts">
            <?php 
            $tpos = ( is_rtl() ? 'left' : 'right' );
            $rvideo = esc_html( get_post_meta( get_the_ID(), 'dina_rvideo', true ) );
            $aparat = esc_html( get_post_meta( get_the_ID(), 'dina_aparat', true ) );
            $raudio = esc_html( get_post_meta( get_the_ID(), 'dina_raudio', true ) );
            if ( ! empty ( $rvideo ) || ! empty( $aparat ) && is_singular( 'product' ) ) { ?>
            <li class="dina-video-play" data-toggle="modal" data-target="#reviewModal">
                <span data-toggle="tooltip" data-placement="<?php echo $tpos; ?>" title="<?php _e( 'Product video', 'dina-kala' ); ?>">
                    <i aria-hidden="true" class="fal fa-play"></i>
                </span>
            </li>
            <?php } ?>

            <?php if ( ! empty( $raudio ) && is_singular( 'product' ) ) { ?>
            <li class="dina-audio-play" data-toggle="modal" data-target="#audio_reviewModal">
                <span data-toggle="tooltip" data-placement="<?php echo $tpos; ?>" title="<?php _e( 'Product audio review', 'dina-kala' ); ?>">
                    <i aria-hidden="true" class="fal fa-volume-up"></i>
                </span>
            </li>
            <?php } ?>

            <?php if ( dina_opt( 'like_prod' ) ) {
                 if ( class_exists( 'YITH_WCWL' ) ) { ?>
                <li class="dina-yith-wcwl-prod">
                    <span data-toggle="tooltip" data-placement="<?php echo $tpos; ?>" title="<?php _e( 'Add to Wishlist', 'dina-kala' ); ?>">
                        <?php echo preg_replace("/<img[^>]+\>/i", " ", do_shortcode( '[yith_wcwl_add_to_wishlist]' ) ); ?>
                    </span>
                </li>
            <?php } } ?>

            <?php if ( dina_opt( 'compare_prod' ) ) { ?>
            <?php if ( class_exists( 'YITH_Woocompare' ) ) { ?>
                <li class="dina-compare-button-prod">
                    <span data-toggle="tooltip" data-placement="<?php echo $tpos; ?>" title="<?php _e( 'Compare Product', 'dina-kala' ); ?>">
                        <?php echo do_shortcode( '[yith_compare_button]' ); ?>
                    </span>
                </li>
            <?php } elseif ( defined( 'WCCM_VERISON' ) ) { ?>
                <li class="dina-wccm">
                    <?php 
                    $product_id = get_the_ID();
                    if ( in_array( $product_id, wccm_get_compare_list() ) ) {
                        $compare_title= __( 'Remove From Compare', 'dina-kala' );
                        $compare_class = " in-compare";
                    } else {
                        $compare_title= __( 'Compare Product', 'dina-kala' );
                        $compare_class = "";
                    }
                    ?>
                    <span data-dina-compare-id="<?php echo $product_id; ?>" class="compare-ajax-btn<?php echo $compare_class; ?>" data-toggle="tooltip" data-placement="<?php echo $tpos; ?>" title="<?php echo $compare_title; ?>">
                        <i class="fal fa-random" aria-hidden="true"></i>
                    </span>
                </li>
            <?php } } ?>

            <?php if ( dina_opt( 'share_prod' ) ) { ?>
            <li data-toggle="modal" data-target="#shareModal">
                <span data-toggle="tooltip" data-placement="<?php echo $tpos; ?>" title="<?php _e( 'Share', 'dina-kala' ); ?>">
                <i aria-hidden="true" class="fal fa-share-alt"></i>
                </span>
            </li>
            <?php } ?>

            <?php if ( dina_opt( 'price_chart' ) && function_exists( 'FTPRICECH' ) ) { ?>
            <li class="dina-price-chart-btn" data-toggle="modal" data-target="#priceChartModal">
                <span data-toggle="tooltip" data-placement="<?php echo $tpos; ?>" title="<?php _e( 'Price chart', 'dina-kala' ); ?>">
                <i aria-hidden="true" class="fal fa-line-chart"></i>
                </span>
            </li>
            <?php } ?>

            <li class="dina-gallery-trigger">
                <span data-toggle="tooltip" data-placement="<?php echo $tpos; ?>" title="<?php _e( 'Zoom in', 'dina-kala' ); ?>">
                <i aria-hidden="true" class="fal fa-search-plus fa-flip-horizontal"></i>
                </span>
            </li>
        </ul>
<?php } 

//Dina_woo_after_single_product_summary
add_action( 'woocommerce_after_single_product_summary', 'dina_woo_after_single_product_summary' );
function dina_woo_after_single_product_summary() {
    setPostViews(get_the_ID() );
    echo '</div>';
}

//Sale Flash
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
//add_action( 'woocommerce_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
//add_filter( 'woocommerce_sale_flash', 'dina_woo_sale_flash' );
function dina_woo_sale_flash() {
    global $post;
    global $product;

    $in_stock = $product->is_in_stock();
    $on_sale = $product->is_on_sale();

    if ( ! dina_opt( 'display_discount' ) || ! $in_stock || ! $on_sale )
        return;

    if ( disw_price( $post->ID ) == 100 )
        return;
    
    if ( $product->is_type( 'grouped' ) ) 
        return;
    
    if ( $in_stock && $on_sale ) {   
        $sale_flash = '<div class="dina-woo-flash-con">';
        if ( dina_opt( 'display_spec' ) ) {
             $sale_flash .= '<span class="onsale dina-special">'. __( 'Special!', 'dina-kala' ) .'</span>';
        } elseif ( is_rtl() ) {
             $sale_flash .= '<span class="onsale">٪'. disw_price( $post->ID ).' ' . __( 'Discount', 'dina-kala' ) .'</span>';
        } else {
             $sale_flash .= '<span class="onsale">'. disw_price( $post->ID ).'% ' . __( 'Discount', 'dina-kala' ) .'</span>';
        }
        $sale_flash .= '</div>';

        return $sale_flash;
    }
}

//dina_customizing_simple_products Page
add_action( 'woocommerce_before_single_product', 'dina_customizing_simple_products' );
function dina_customizing_simple_products() {
    global $product;
    $in_stock = $product->is_in_stock();
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
    if ( dina_opt( 'product_page_style' ) == 'stone' ) {
        add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 11); 
    }
    if ( $in_stock || dina_opt( 'show_price_out' ) ) {
        add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 27);
    }
}

//dina_add_prod_info
if ( dina_opt( 'show_add_prod_info' ) ) {
    add_action( 'woocommerce_single_product_summary', 'dina_add_prod_info',32);
}
function dina_add_prod_info() {
   $prod_info_text = dina_output_content( 'dina_prod_info_text', get_the_ID() );
   $product_cats = wp_get_object_terms( get_the_ID(), 'product_cat', array( 'fields' => 'ids' ) );
   $cat_prod_info_text = '';
   foreach ( $product_cats as $cat ) {
        if ( ! empty ( get_term_meta( $cat, 'dina_category_product_info_text', true ) ) ) {
            $cat_prod_info_text = get_term_meta( $cat, 'dina_category_product_info_text', true );
        }
   }

   if ( $prod_info_text != '' ) {
        echo '<div class="add_prod_info">'. $prod_info_text .'</div>';
   } elseif ( $cat_prod_info_text != '' ) {
        echo '<div class="add_prod_info">'. dina_wpautop_content( $cat_prod_info_text ) .'</div>';
   } elseif ( dina_opt( 'add_prod_info_title' ) != '' || dina_opt( 'add_prod_info_text' ) != '' ) {
        echo '<div class="add_prod_info">';
        if ( dina_opt( 'add_prod_info_title' ) != '' ) {
            echo '<strong>'.dina_opt( 'add_prod_info_title' ).'</strong>';
        }
        if ( dina_opt( 'add_prod_info_text' ) != '' ) {
            echo dina_wpautop_content( dina_opt( 'add_prod_info_text' ) );
        }
        echo '</div>';
   }
}

//Add Product Extra
if ( dina_opt( 'product_page_style' ) == 'stone' ) {
    add_action( 'woocommerce_single_product_summary', 'dina_product_extra', 25); 
} elseif ( dina_opt( 'product_page_style' ) == 'sttwo' ) {
    add_action( 'woocommerce_single_product_summary', 'dina_product_extra', 36); 
}
function dina_product_extra() { 

    if ( dina_opt( 'product_page_style' ) == 'stone' )
        echo '<div class="product-extra-con">';

    if ( dina_opt( 'product_brand' ) && dina_opt( 'brand_before_meta' ) && dina_opt( 'product_page_style' ) == 'stone' ) {
        dina_brand_logo();        
    }

    if ( dina_opt( 'show_extra' ) ) { ?>
    <div class="product_extra<?php if ( ! dina_opt( 'show_extra_mobile' ) ) { echo ' mobile-hidden'; } ?>">
        <ul>
            <?php if ( dina_opt( 'show_extra_one' ) ) { ?>
            <li>
                <?php if ( ! empty( dina_opt( 'extra_one_link' ) ) ) { ?>
                    <a href="<?php echo dina_opt( 'extra_one_link' ); ?>" title="<?php echo dina_opt( 'extra_one_title' ); ?>">
                <?php } ?>
                        <?php if ( ! empty( dina_to_https( dina_opt( 'extra_one_img', 'url' ) ) ) ) { ?>
                            <img src="<?php echo dina_to_https( dina_opt( 'extra_one_img', 'url' ) ); ?>" width="64" height="64" alt="<?php echo dina_opt( 'extra_one_title' ); ?>" class="ser-cust-icon">
                        <?php } else { ?>
                            <i class="<?php echo dina_opt( 'extra_one_icon' ); ?>" aria-hidden="true"></i>
                        <?php } ?>
                        <span><?php echo dina_opt( 'extra_one_title' ); ?></span>
                <?php if ( ! empty( dina_opt( 'extra_one_link' ) ) ) { ?>
                    </a>
                <?php } ?>
            </li>
            <?php } ?>

            <?php if ( dina_opt( 'show_extra_two' ) ) { ?>
            <li>
                <?php if ( ! empty( dina_opt( 'extra_two_link' ) ) ) { ?>
                    <a href="<?php echo dina_opt( 'extra_two_link' ); ?>" title="<?php echo dina_opt( 'extra_two_title' ); ?>">
                <?php } ?>
                        <?php if ( ! empty( dina_to_https( dina_opt( 'extra_two_img', 'url' ) ) ) ) { ?>
                            <img src="<?php echo dina_to_https( dina_opt( 'extra_two_img', 'url' ) ); ?>" width="64" height="64" alt="<?php echo dina_opt( 'extra_two_title' ); ?>" class="ser-cust-icon">
                        <?php } else { ?>
                            <i class="<?php echo dina_opt( 'extra_two_icon' ); ?>" aria-hidden="true"></i>
                        <?php } ?>
                        <span><?php echo dina_opt( 'extra_two_title' ); ?></span>
                <?php if ( ! empty( dina_opt( 'extra_two_link' ) ) ) { ?>
                    </a>
                <?php } ?>
            </li>
            <?php } ?>

            <?php if ( dina_opt( 'show_extra_three' ) ) { ?>
            <li>
                <?php if ( ! empty( dina_opt( 'extra_three_link' ) ) ) { ?>
                    <a href="<?php echo dina_opt( 'extra_three_link' ); ?>" title="<?php echo dina_opt( 'extra_three_title' ); ?>">
                <?php } ?>
                    <?php if ( ! empty( dina_to_https( dina_opt( 'extra_three_img', 'url' ) ) ) ) { ?>
                            <img src="<?php echo dina_to_https( dina_opt( 'extra_three_img', 'url' ) ); ?>" width="64" height="64" alt="<?php echo dina_opt( 'extra_three_title' ); ?>" class="ser-cust-icon">
                        <?php } else { ?>
                            <i class="<?php echo dina_opt( 'extra_three_icon' ); ?>" aria-hidden="true"></i>
                        <?php } ?>
                    <span><?php echo dina_opt( 'extra_three_title' ); ?></span>
                <?php if ( ! empty( dina_opt( 'extra_three_link' ) ) ) { ?>
                    </a>
                <?php } ?>
            </li>
            <?php } ?>

            <?php if ( dina_opt( 'show_extra_four' ) ) { ?>
            <li>
                <?php if ( ! empty( dina_opt( 'extra_four_link' ) ) ) { ?>
                    <a href="<?php echo dina_opt( 'extra_four_link' ); ?>" title="<?php echo dina_opt( 'extra_four_title' ); ?>">
                <?php } ?>
                        <?php if ( ! empty( dina_to_https( dina_opt( 'extra_four_img', 'url' ) ) ) ) { ?>
                            <img src="<?php echo dina_to_https( dina_opt( 'extra_four_img', 'url' ) ); ?>" width="64" height="64" alt="<?php echo dina_opt( 'extra_four_title' ); ?>" class="ser-cust-icon">
                        <?php } else { ?>
                            <i class="<?php echo dina_opt( 'extra_four_icon' ); ?>" aria-hidden="true"></i>
                        <?php } ?>
                        <span><?php echo dina_opt( 'extra_four_title' ); ?></span>
                <?php if ( ! empty( dina_opt( 'extra_four_link' ) ) ) { ?>
                    </a>
                <?php } ?>
            </li>
            <?php } ?>

            <?php if ( dina_opt( 'show_extra_five' ) ) { ?>
            <li>
                <?php if ( ! empty( dina_opt( 'extra_five_link' ) ) ) { ?>
                    <a href="<?php echo dina_opt( 'extra_five_link' ); ?>" title="<?php echo dina_opt( 'extra_five_title' ); ?>">
                <?php } ?>
                        <?php if ( ! empty( dina_to_https( dina_opt( 'extra_five_img', 'url' ) ) ) ) { ?>
                            <img src="<?php echo dina_to_https( dina_opt( 'extra_five_img', 'url' ) ); ?>" width="64" height="64" alt="<?php echo dina_opt( 'extra_five_title' ); ?>" class="ser-cust-icon">
                        <?php } else { ?>
                            <i class="<?php echo dina_opt( 'extra_five_icon' ); ?>" aria-hidden="true"></i>
                        <?php } ?>
                        <span><?php echo dina_opt( 'extra_five_title' ); ?></span>
                <?php if ( ! empty( dina_opt( 'extra_five_link' ) ) ) { ?>
                    </a>
                <?php } ?>
            </li>
            <?php } ?>
        </ul>
    </div>
<?php }
    if ( dina_opt( 'product_page_style' ) == 'stone' )
        echo '</div>';
}

//Show tags in bottom
if ( dina_opt( 'show_prod_tags' ) && dina_opt( 'show_prod_tags_down' ) ) {
    add_action( 'woocommerce_single_product_summary', 'dina_show_tags_bottom', 37); 
}
function dina_show_tags_bottom() {
    global $product;
    echo wc_get_product_tag_list( $product->get_id(), ' ', '<div class="product-tags">
    <span class="fal fa-tags" aria-hidden="true"></span>' . _n( 'Tag:', 'Tags:', count( $product->get_tag_ids() ), 'dina-kala' ) . ' ', '</div>' );
}

//Product Video Modal
add_action( 'wp_footer', 'dina_video_modal' );
function dina_video_modal() { 
    $rvideo = esc_html(get_post_meta( get_the_ID(), 'dina_rvideo', true ) );
    $aparat = esc_html(get_post_meta( get_the_ID(), 'dina_aparat', true ) );
    if ( ! empty( $rvideo ) || ! empty( $aparat ) && is_singular( 'product' ) ) {
    ?>
    <!-- The Video Review Modal -->
    <div class="modal fade<?php if ( ! empty( $rvideo ) ) { echo ' vmodal'; } else { echo ' amodal'; } ?>" id="reviewModal">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
            <!-- Video Review Modal Header -->
            <div class="modal-header">
                <div class="modal-title"><i class="fal fa-play" aria-hidden="true"></i><?php the_title(); ?></div>
                <button type="button" class="close" data-dismiss="modal">
                    <i class="fal fa-times" aria-hidden="true"></i>
                </button>
            </div>
            <!-- Video Review Modal body -->
            <div class="modal-body">
                <?php 
                if ( ! empty( $rvideo ) ) {
                    echo '<video controls><source src="'.$rvideo.'" id="rVideo"></video>';
                } else {
                    echo '<div id="15305363563383534"><script type="text/JavaScript" src="https://www.aparat.com/embed/'.$aparat.'?data[rnddiv]=15305363563383534&data[responsive]=yes"></script></div>';
                } ?>
            </div>

            </div>
        </div>
    </div>
    <!-- The Video Review Modal -->
<?php } }

//Product Audio Modal
add_action( 'wp_footer', 'dina_audio_modal' );
function dina_audio_modal() {
    $raudio = esc_html(get_post_meta( get_the_ID(), 'dina_raudio', true ) );
    if ( ! empty( $raudio ) ) {
    ?>
    <!-- The Audio Review Modal -->
    <div class="modal fade<?php if ( ! empty( $raudio ) ) { echo ' aumodal'; } ?>" id="audio_reviewModal">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
            <!-- Audio Review Modal Header -->
            <div class="modal-header">
                <div class="modal-title"><i class="fal fa-volume-up" aria-hidden="true"></i><?php the_title(); ?></div>
                <button type="button" class="close" data-dismiss="modal">
                    <i class="fal fa-times" aria-hidden="true"></i>
                </button>
            </div>
            <!-- Audio Review Modal body -->
            <div class="modal-body">
                <?php 
                if ( ! empty( $raudio ) ) {
                    echo do_shortcode( '[audio src="'. $raudio .'"]' );
                } ?>
            </div>

            </div>
        </div>
    </div>
    <!-- The Audio Review Modal -->
<?php }
}

//Product Price Chart
if ( function_exists( 'FTPRICECH' ) ) {
add_action( 'wp_footer', 'dina_price_chart_modal' );
}
function dina_price_chart_modal() { 
    if ( ! dina_opt( 'price_chart' ) && ! is_singular( 'product' ) )
        return;
    ?>
    <!-- The Price Chart Modal -->
    <div class="modal fade" id="priceChartModal">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <!-- Price Chart Modal Header -->
                <div class="modal-header">
                    <div class="modal-title"><i class="fal fa-line-chart" aria-hidden="true"></i><?php the_title(); ?></div>
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="fal fa-times" aria-hidden="true"></i>
                    </button>
                </div>
                <!-- Price Chart Modal body -->
                <div class="modal-body">
                    <?php echo do_shortcode( '[ft_pricechart]' ); ?>
                </div>
            </div>
        </div>
    </div>
    <!-- The Price Chart Modal -->
<?php }

//dina_woo_product_features
add_action( 'woocommerce_single_product_summary', 'dina_woo_product_features', 24 );
function dina_woo_product_features() {
    global $post;

    if ( ! is_object( $post) ) 
        return;
            
    echo '<div class="product-features">';

        do_action( 'dina_before_product_features' );

        if ( dina_opt( 'replace_features_tab' ) ) {
            echo dina_get_product_attributes( get_the_ID() );
        } elseif ( dina_opt( 'replace_content_features' ) && ! empty( $post->post_content ) ) {
            the_content();
        } elseif ( dina_opt( 'replace_features' ) && ! empty( $post->post_excerpt ) ) {
            the_excerpt();
        } else {
            dina_product_features( get_the_ID() );
        }

        do_action( 'dina_after_product_features' );

   echo '</div>';
}

//dina_before_price
add_action( 'woocommerce_single_product_summary', 'dina_before_price', 26);
function dina_before_price() {
    global $product;
    
    $variable_class = '';

    if ( dina_opt( 'remove_dub_price_range' ) && $product->is_type( 'variable' ) ) {
        $min_var_reg_price  = $product->get_variation_regular_price( 'min', true );
        $min_var_sale_price = $product->get_variation_sale_price( 'min', true );
        $max_var_reg_price  = $product->get_variation_regular_price( 'max', true );
        $max_var_sale_price = $product->get_variation_sale_price( 'max', true );
        if ( ! show_login_price() && ( ! ( $min_var_reg_price == $max_var_reg_price ) || ! ( $min_var_sale_price == $max_var_sale_price ) ) ) {
            $variable_class = ' variable-price';
        }
    }

    echo '<div class="price-con'. $variable_class .'">';

    do_action ( 'dina_before_price_con' );

    if ( dina_opt( 'product_brand' ) && dina_opt( 'brand_before_meta' ) && dina_opt( 'product_page_style' ) == 'sttwo' ) {
        dina_brand_logo();
    }

    if ( dina_opt( 'product_page_style' ) == 'sttwo' ) {
        woocommerce_template_single_meta();
        do_action( 'dina_after_single_meta' );
    }

    $coming = get_post_meta( $product->get_id(), 'dina_coming', true );

    if ( ! $coming ) {
        dina_single_product_offer_counter();
    }
}

//dina_after_price
add_action( 'woocommerce_single_product_summary', 'dina_after_price', 31);
function dina_after_price() {
    global $product;

    if ( $product->is_type( 'simple' ) && ( '' === $product->get_price() ) && ! $product->is_in_stock() ) {
        echo '<p class="stock out-of-stock">'. dina_outofstock_text() .'</p>';
    }

    if ( dina_opt( 'add_prod_btn_location' ) == 'location2' ) {
        dina_add_product_btn();
    }

    do_action( 'dina_after_add_prod_btn' );

    if ( class_exists( 'WooWallet' ) && 'on' === woo_wallet()->settings_api->get_option( 'is_enable_cashback_reward_program', '_wallet_settings_credit', 'on' )) {
        dina_display_cashback();
    }

    do_action ( 'dina_after_price_con' );
    
    echo '</div>';
}

//dina single product offer counter
function dina_single_product_offer_counter() {
    global $product;

    if ( dina_opt( 'product_catalog_mode' ) && dina_opt( 'product_catalog_price_mode' ) )
        return;

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
        $date = get_post_meta( $product->get_id(), '_sale_price_dates_to', true );
    }

    if ( ! empty( $date ) && ( $product->is_purchasable() || $product -> is_type( 'external' ) ) && $product->is_in_stock() && ! show_login_price() ) {
        $date += 24*60*60;
        $sale_price_date = ( $date ) ? date( 'Y/m/d', $date ) : '';
        $date_diff = ( $date ) ? date( 'Y-m-d', $date ) : '';
        $now = time(); // or your date as well
        $your_date = strtotime( $date_diff);
        $diff = $your_date - $now;
        $datediff = round( $diff / (60 * 60 * 24) );
        if ( $product->is_on_sale() ) { ?>

            <div class="counter-con">

                <?php
                $counter_class = dina_opt( 'product_counter_style' ) != 'sale-count-text' ? 'salecount sale-count-not-text '. dina_opt( 'product_counter_style' ) : 'prodcounter ' . dina_opt( 'product_counter_style' ); 
                ?>

                <div class="<?= $counter_class ?>"
                 data-datediff="<?= $datediff; ?>"
                 <?php if ( dina_opt( 'product_counter_style' ) != 'sale-count-text' ) { ?>
                 data-seconds="<?php _e( 'Seconds' , 'dina-kala' ); ?>" data-minutes="<?php _e( 'Minutes' , 'dina-kala' ); ?>" data-hours="<?php _e( 'Hours' , 'dina-kala' ); ?>" data-days="<?php _e( 'Days' , 'dina-kala' ); ?>" data-weeks="<?php _e( 'Weeks' , 'dina-kala' ); ?>"
                 <?php } ?>
                 data-format="<?= dina_opt( 'product_counter_format' ); ?>"
                 data-countdown="<?= $sale_price_date; ?>"
                 data-dir="<?php dina_dir() ?>">
                </div>
            </div>

        <?php } 
    }
}

//Add WooCommerce Product Pros & Cons before the_content
if ( dina_opt( 'show_pros_top' ) ) {
    add_action( 'dina_before_product_description', 'dina_before_woo_content_pros_cons', 12 );
} else {
    add_action( 'dina_after_product_description', 'dina_before_woo_content_pros_cons', 10 );
}

function dina_before_woo_content_pros_cons() {
    
    $cons_pros = get_post_meta( get_the_ID(), 'dina_cons_pros', true );

    if ( is_product() && $cons_pros ) {

        $product_pros = get_post_meta( get_the_ID(), 'dina_product_pros', true );
        $product_cons = get_post_meta( get_the_ID(), 'dina_product_cons', true );

        $content = '';

        //Product Pros
        if ( ! empty( $product_pros ) ) {
           $content .= '<div class="product-pros">';
           $content .= '<strong>'. __( 'Product Pros:', 'dina-kala' ) .'</strong>';
               $content .= '<ul>';
                    foreach ( (array) $product_pros as $key => $pros ) {
                        $ptitle = '';
                        if ( isset( $pros['ptitle'] ) ) {
                            $ptitle = esc_html( $pros['ptitle'] );
                        }
                        if ( ! empty( $ptitle ) ) {
                            $content .= '<li>'. $ptitle .'</li>';
                        }
                    }
           $content .= '</ul></div>';
        } 

        //Product Cons
        if ( ! empty( $product_cons ) ) {
           $content .= '<div class="product-cons">';
           $content .= '<strong>'. __( 'Product Cons:', 'dina-kala' ) .'</strong>';
               $content .= '<ul>';
                    foreach ( (array) $product_cons as $key => $cons ) {
                        $ctitle = '';
                        if ( isset( $cons['ctitle'] ) ) {
                            $ctitle = esc_html( $cons['ctitle'] );
                        }
                        if ( ! empty( $ctitle) ) {
                            $content .= '<li>'. $ctitle .'</li>';
                        }
                    }
           $content .= '</ul></div>';
        }
        
        echo $content;
    }
}

//Add WooCommerce the_excerpt before description
add_action( 'dina_before_product_description', 'dina_excerpt_before_content', 11 );
function dina_excerpt_before_content() {
    global $post;
    if ( ! is_object( $post ) ) 
        return;
    if ( is_product() && ! empty( $post->post_excerpt ) && ! dina_opt( 'replace_features' ) && dina_opt( 'show_prod_excerpt' ) ) {
        $excerpt = '<blockquote class="prod-excerpt blockquote">';
        if ( dina_opt( 'show_prod_excerpt_icon' ) ) {
            $excerpt .= '<i class="fal fa-pen-alt" aria-hidden="true"></i>';
        }
        $excerpt .= do_shortcode( $post->post_excerpt);
        $excerpt .= '</blockquote>';
        
        echo $excerpt;
    }
}

//Product DL-BOX
if ( dina_opt( 'dl_box_product' ) ) {
    add_action( 'dina_after_product_description', 'dina_product_dl_box', 12 );
}
function dina_product_dl_box() {
    global $post;
    if ( !is_object( $post ) ) 
        return;

    $show_dlbox = get_post_meta( get_the_ID(), 'dina_show_dlbox', true );

    if ( is_product() && $show_dlbox ) {
        $dl_box = dina_dl_box( get_the_ID() );
        echo $dl_box;
    }
}

//Add Show More Button To WooCommerce Products
if ( dina_opt( 'show_more' ) ) {
    add_action( 'dina_before_product_description', 'dina_before_content_show_more', 9 );
    add_action( 'dina_after_product_description', 'dina_after_content_show_more', 13 );
}

function dina_before_content_show_more() {
    if ( ! is_product() )
        return;
    
    $beforecontent = '<div class="post-sh dina-more-less" data-more="'.__( 'Show More', 'dina-kala' ).'" data-less="'.__( 'Show Less', 'dina-kala' ).'"><div class="dina-more-less-content">';
    echo $beforecontent;
    
}

function dina_after_content_show_more() {
    if ( ! is_product() )
        return;
    
    $afterecontent = '</div></div>';  
    echo $afterecontent;
}

//Remove tabs heading
if ( ! dina_opt( 'product_tab_scroll' ) ) {
    add_filter( 'woocommerce_product_additional_information_heading','dina_return_empty' );
    add_filter( 'woocommerce_product_description_heading','dina_return_empty' );
}
function dina_return_empty() {
    return '';
}

//Change additional information tab title
add_filter( 'woocommerce_product_tabs', 'dina_rename_tabs', 98 );
function dina_rename_tabs( $tabs ) {
    global $product;
    if ( $product->has_attributes() || $product->has_dimensions() || $product->has_weight() ) {
        $tabs['additional_information']['title'] = __( 'Product Features', 'dina-kala' );
    }
    // Additional information tab - shows attributes.
    if ( $product && ( !$product->has_attributes() && dina_opt( 'remove_dimensions' ) ) ) {
        unset( $tabs['additional_information'] );
    }
    return $tabs;
}

// woocommerce_product_additional_information_heading
add_filter( 'woocommerce_product_additional_information_heading', function() {
    if ( dina_opt( 'product_tab_scroll' ) ) {
        return __( 'Product Features', 'dina-kala' );
    } else {
        return;
    }
} );

//Hides the product’s weight and dimension in the single product page.
if ( dina_opt( 'remove_dimensions' ) ) {
    add_filter( 'wc_product_enable_dimensions_display', '__return_false' );
}

//remove product's attr link
function filter_woocommerce_attribute_value( $value ) { 
    return preg_replace( '#<a.*?>([^>]*)</a>#i', '$1', $value );
}
if ( dina_opt( 'remove_attr_link' ) ) {
    add_filter( 'woocommerce_attribute', 'filter_woocommerce_attribute_value', 99 );
}

//Get dinakala theme product features
function dina_product_features( $id ) {
    $features = get_post_meta( $id, 'dina_product_features', true );

    if ( ! empty( $features) ) {

        if ( dina_opt( 'show_prodf_title' ) && ! empty( dina_opt( 'prodf_title' ) ) ) { 
            echo '<strong class="dina-features-title">'. dina_opt( 'prodf_title' ) .'</strong>';
        }

        if ( dina_opt( 'show_features_limited' ) && count( $features ) > (int)dina_opt( 'features_limited_line' ) )
            echo '<div class="dina-features-limited" data-limit="'. dina_opt( 'features_limited_line' ) .'">';

        echo '<ul class="dina-features-ul">';
            foreach ( (array) $features as $key => $feature ) {
                $ftitle = $fdesc = '';
                if ( isset( $feature['ftitle'] ) ) {
                    $ftitle = esc_html( $feature['ftitle'] );
                }
                if ( isset( $feature['fdesc'] ) ) {
                    $fdesc = esc_html( $feature['fdesc'] );
                }
                if ( isset( $feature['ficon'] ) && $feature['ficon'] != 'none' && ! empty( $feature['ficon'] ) ) {
                    $ficon = '<i class="fal fa-' . esc_html( $feature['ficon'] ) . '"></i>';
                    $li_class = ' class="fwicon"';
                } else {
                    $ficon = '';
                    $li_class = '';
                }
                if ( ! empty( $ftitle) || ! empty( $fdesc) ) {
                    echo '<li' . $li_class . '>';
                        echo $ficon;

                        if ( ! empty( $ftitle) && ! empty( $fdesc ) ) {
                            echo '<span class="ftitle">'.$ftitle.':</span>';
                        } elseif ( ! empty( $ftitle) ) {
                            echo '<span class="ftitle dina-wrap">'.$ftitle.'</span>';
                        }

                        if ( ! empty( $fdesc ) && ( $fdesc != '.' ) ) {
                            echo '<span class="fdesc">'.$fdesc.'</span>';
                        }
                    echo '</li>';
                }
            }    
        echo '</ul>';

        if ( dina_opt( 'show_features_limited' ) && count( $features ) > (int)dina_opt( 'features_limited_line' ) )
            echo '<span class="dina-showmore-features" data-more="'. __( 'Show more', 'dina-kala' ) .'" data-less="'. __( 'Show less', 'dina-kala' ) .'">'. __( 'Show more', 'dina-kala' ) .'</span></div>';
    }
}

//Dina get product attributes
function dina_get_product_attributes( $id, $attr_count = null ) {

    $product = wc_get_product( $id );

	$product_attributes = array();

	// Add product attributes to list.
	$attributes = array_filter( $product->get_attributes(), 'wc_attributes_array_filter_visible' );

    $count = ! empty ( (int)$attr_count ) ? $attr_count : (int)dina_opt( 'features_tab_count' );

    $i = 0;

	foreach ( $attributes as $attribute ) {

        if ( $i == $count )
            break;

		$values = array();

		if ( $attribute->is_taxonomy() ) {
			$attribute_taxonomy = $attribute->get_taxonomy_object();
			$attribute_values   = wc_get_product_terms( $product->get_id(), $attribute->get_name(), array( 'fields' => 'all' ) );

			foreach ( $attribute_values as $attribute_value ) {
				$value_name = esc_html( $attribute_value->name );

				$values[] = $value_name;
			}
		} else {
			$values = $attribute->get_options();

			foreach ( $values as &$value ) {
				$value = make_clickable( esc_html( $value ) );
			}
		}

		$product_attributes[ 'attribute_' . sanitize_title_with_dashes( $attribute->get_name() ) ] = array(
			'label' => wc_attribute_label( $attribute->get_name() ),
			'value' => apply_filters( 'woocommerce_attribute', wptexturize( implode( ', ', $values ) ), $attribute, $values ),
		);

        $i++;
	}

	/**
	 * Hook: woocommerce_display_product_attributes.
	 * $product_attributes Array of atributes to display; label, value.
	 *  $product Showing attributes for this product.
    */
	$product_attributes = apply_filters( 'woocommerce_display_product_attributes', $product_attributes, $product );

	if ( ! $product_attributes ) {
        return;
    }

    if ( dina_opt( 'show_prodf_title' ) && ! empty( dina_opt( 'prodf_title' ) ) ) {
        echo '<strong class="dina-features-title">'.dina_opt( 'prodf_title' ).'</strong>';
    }

    if ( dina_opt( 'show_features_limited' ) && count( $product_attributes ) > (int)dina_opt( 'features_limited_line' ) )
        echo '<div class="dina-features-limited" data-limit="'. dina_opt( 'features_limited_line' ) .'">';
    ?>
    <ul class="dina-features-ul">
	<?php foreach ( $product_attributes as $product_attribute_key => $product_attribute ) : ?>
        <li>
            <span class="ftitle dina-attr-item-<?php echo esc_attr( $product_attribute_key ); ?>"><?php echo wp_kses_post( $product_attribute['label'] ); ?>:</span>
            <span class="fdesc"><?php echo wp_kses_post( $product_attribute['value'] ); ?></span>
        </li>
	<?php endforeach; ?>
    </ul>
    <?php
    if ( dina_opt( 'show_features_limited' ) && count( $product_attributes ) > (int)dina_opt( 'features_limited_line' ) )
        echo '<span class="dina-showmore-features" data-more="'. __( 'Show more', 'dina-kala' ) .'" data-less="'. __( 'Show less', 'dina-kala' ) .'">'. __( 'Show more', 'dina-kala' ) .'</span></div>';
}

//dina_product_update_date
if ( dina_opt( 'show_prod_up_date' ) ) {
    add_action( 'woocommerce_product_meta_end', 'dina_product_update_date', 13 );
}

function dina_product_update_date() {
    global $product;
    ?>
    <span class="update_date_wrapper"><?php _e( 'Date Updated:', 'dina-kala' ) ?>
        <span class="product-update-date"><?php echo dina_get_modified_date();  ?></span>
    </span>
    <?php
}

//dina_product_views_count
if ( dina_opt( 'show_prod_views' ) ) {
    add_action( 'woocommerce_product_meta_end', 'dina_product_views_count', 13);
}

function dina_product_views_count() {
    global $product;
    ?>
    <span class="views_count_wrapper"><?php _e( 'Views:', 'dina-kala' ) ?>
        <span class="product-views-count"><?php echo getPostViews( $product->get_id() ); ?> <?php _e( 'View', 'dina-kala' ) ?></span>
    </span>
    <?php
}

//Dina related product's
function dina_related_product() {
    global $product;
    if ( dina_opt( 'show_related_p' ) ) { 
        
            if ( dina_opt( 'related_p_by' ) == 'product_cat' && dina_opt( 'show_by_last_cat' ) ) {
                $related_taxterms = dina_get_prod_deep_cats( get_the_ID() );
            } elseif ( ( dina_opt( 'related_p_by' ) == 'cat_and_brand' ) || ( dina_opt( 'related_p_by' ) == 'cat_or_brand' ) ) {
                $related_taxterms = wp_get_object_terms( get_the_ID(), 'product_cat', array( 'fields' => 'ids' ) );
                $related_taxterms_two = wp_get_object_terms( get_the_ID(), dina_opt( 'product_brand_taxonomy' ), array( 'fields' => 'ids' ) );
            } else {
                $related_taxterms = wp_get_object_terms( get_the_ID(), dina_opt( 'related_p_by' ), array( 'fields' => 'ids' ) );
            }

            $args = array(
                'post_type'      => 'product',
                'post_status'    => 'publish',
                'posts_per_page' => dina_opt( 'related_p_count' ),
                'orderby'        => 'rand',
                'post__not_in'   => array ( get_the_ID() ),
            );

            $tax_query = array();

            if ( dina_opt( 'related_p_by' ) == 'cat_and_brand' ) {

                array_push( $tax_query, array(
                    'relation' => 'AND',
                        array(
                            'taxonomy' => 'product_cat',
                            'field'    => 'id',
                            'terms'    => $related_taxterms,
                        ),
                        array(
                            'taxonomy' => dina_opt( 'product_brand_taxonomy' ),
                            'field'    => 'id',
                            'terms'    => $related_taxterms_two,
                        ),
                ) );


            } elseif ( dina_opt( 'related_p_by' ) == 'cat_or_brand' ) {

                 array_push( $tax_query, array(
                    'relation' => 'OR',
                        array(
                            'taxonomy' => 'product_cat',
                            'field'    => 'id',
                            'terms'    => $related_taxterms,
                        ),
                        array(
                            'taxonomy' => dina_opt( 'product_brand_taxonomy' ),
                            'field'    => 'id',
                            'terms'    => $related_taxterms_two,
                        ),
                ) );

            } else {

                array_push( $tax_query, array(
                    'taxonomy' => dina_opt( 'related_p_by' ),
                    'field'    => 'id',
                    'terms'    => $related_taxterms
                ) );

            }

            if ( dina_opt( 'show_out_prod' ) ) {

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

            $related_items = new WP_Query( $args ); ?>
			<?php
             if ( $related_items->have_posts() ) {
				 ?>
			<div class="product-block<?php if ( dina_opt( 'prod_navs' ) == 'sttwo' ) { ?> nav-type-two<?php } ?> related dina-related-product block<?php if ( !$product->is_in_stock() && dina_opt( 'show_related_p_top' ) ) { echo ' related-not'; } ?>">
                <div class="block-title">
                    <span class="block-title-con">
                        <i class="fal fa-shopping-bag" aria-hidden="true"></i>
                        <?php echo dina_opt( 'related_p_title' ); ?>
                    </span>
                </div>

                <?php
                    $carousel_options  = '';
                    $carousel_options .= dina_opt( 'mobile_single_col' ) ? ' data-mcol="1"' : ' data-mcol="2"'; 
                    $carousel_options .= dina_opt( 'show_arrows' ) ? ' data-itemnavs="true"' : ' data-itemnavs="false"'; 
                    $carousel_options .= dina_opt( 'prod_loop' ) ? ' data-itemloop="true"' : ' data-itemloop="false"'; 
                    $carousel_options .= dina_opt( 'auto_play' ) ? ' data-itemplay="true"' : ' data-itemplay="false"'; 
                    $carousel_options .= ! empty ( dina_opt( 'pcount' ) ) ? ' data-itemscount="'. dina_opt( 'pcount' ) .'"' : ' data-itemscount="5"';
                    $carousel_options .= ' data-dir="'. dina_rtl() .'"';
                ?>

                <div class="owl-carousel" <?php echo $carousel_options; ?>>
                    <?php
                    while ( $related_items->have_posts() ) : $related_items->the_post(); ?>
                    <div class="item">
                        <?php get_template_part( 'includes/content-product' ); ?>
                    </div>
                    <?php endwhile; ?>
                </div>
            </div>
    <?php }
    } 
    wp_reset_postdata();
}

//Delete default related product and add theme's related product
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
add_action( 'woocommerce_before_single_product', 'dina_related_place', 5 );

//Dina related product's place
function dina_related_place() {
    
    global $product;

    if ( ! $product->is_in_stock() && dina_opt( 'show_related_p_top' ) ) {
        add_action( 'woocommerce_before_single_product_summary', 'dina_related_product', 5 );
    } elseif ( dina_opt( 'show_related_top_desc' ) ) {
        add_action( 'woocommerce_after_single_product_summary', 'dina_related_product', 5 );
    } else {
        add_action( 'woocommerce_after_single_product_summary', 'dina_related_product', 20 );
    }

    if ( ! $product->is_in_stock() && dina_opt( 'show_up_sells_out_top' ) ) {
        remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
        add_action( 'woocommerce_before_single_product_summary', 'woocommerce_upsell_display', 6 );
    } elseif ( dina_opt( 'show_up_sells_top_desc' ) ) {
        remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
        add_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 6 );
    }
}




//Remove Yith Wishlist Button
if ( ! function_exists( 'yith_wcwl_selectively_hide_add_to_wishlist' ) ) {
	function yith_wcwl_selectively_hide_add_to_wishlist( $show ) {
		
		global $product;

		$show = false;

		return $show;
	}

	add_filter( 'yith_wcwl_show_add_to_wishlist', 'yith_wcwl_selectively_hide_add_to_wishlist' );
}

function dina_remove_yith_compare_btn() {
    update_option( 'yith_woocompare_compare_button_in_product_page', 'no' );
    update_option( 'yith_woocompare_compare_button_in_products_list', 'no' );
}
add_action( 'init','dina_remove_yith_compare_btn' );

//Add product's meta
add_action( 'woocommerce_product_meta_end', 'dina_product_metas', 12 );
function dina_product_metas() {
    global $post;

    if ( ! is_object( $post ) ) 
        return;

    //Public Product Metas
    for ( $num = 1; $num < 6; $num++ ) {

        $meta_number = di_dig2word( $num );

        if ( dina_opt( 'show_public_product_meta_'. $meta_number ) ) {

            if ( dina_opt( 'public_product_meta_'. $meta_number .'_purchasable' ) && ! dina_check_product_purchasable()  )
                continue;

            if ( dina_opt( 'meta_'. $meta_number .'_in_cats' ) && ! has_term( dina_opt( 'meta_'. $meta_number .'_cats' ), 'product_cat' ) )
                continue;

            $public_meta_value = dina_opt( 'public_product_meta_'. $meta_number .'_value' );

            if ( dina_opt( 'public_product_meta_'. $meta_number .'_per_product' ) ) {
                $per_product_value = get_post_meta( get_the_ID(), 'dina_public_meta_value_'. $meta_number, true );
                if ( ! empty ( $per_product_value ) )
                    $public_meta_value = $per_product_value;
            }

            if ( ! empty( $public_meta_value ) ) {

                $public_meta_title = dina_opt( 'public_product_meta_'. $meta_number .'_title' );
                $public_meta_icon = '<i class="dina_meta_icon fal fa-' . esc_html( dina_opt( 'public_product_meta_'. $meta_number .'_icon' ) ) . '"></i>';

                $public_meta_link = dina_opt( 'public_product_meta_'. $meta_number .'_link' );

                if ( dina_opt( 'public_product_meta_'. $meta_number .'_per_product' ) ) {
                    $per_product_link = get_post_meta( get_the_ID(), 'dina_public_meta_link_'. $meta_number, true );
                    if ( ! empty ( $per_product_link ) )
                        $public_meta_link = $per_product_link;
                }

                echo '<span class="meta_wrapper public-meta-'. $meta_number .'">';
                        echo $public_meta_icon;
                        echo ( ! empty ( $public_meta_title ) ? $public_meta_title . ': ' : '' );
                        if ( ! empty ( $public_meta_value ) ) {
                            
                            if ( ! empty ( $public_meta_link ) ) {
                                echo '<a class="dina-meta-link" href="'. $public_meta_link .'">';
                            }

                            echo '<span class="dina-meta-value">'. do_shortcode( $public_meta_value ) .'</span>';
                            
                            if ( ! empty( $public_meta_link ) ) {
                                echo '</a>';
                            }
                        }
                echo '</span>';
            }

        }

    }

    $product_metas = get_post_meta( get_the_ID(), 'dina_pmeta_fields', true );
    if ( ! empty( $product_metas) ) {
        $count = 1; 
        foreach ( (array) $product_metas as $key => $product_meta ) {

            $pmeta_name = $pmeta_value = $pmeta_link = $pmeta_icon = '';

            if ( isset( $product_meta['dina_pmeta_name'] ) ) {
                $pmeta_name = esc_html( $product_meta['dina_pmeta_name'] );
            }

            if ( isset( $product_meta['dina_pmeta_value'] ) ) {
                $pmeta_value = esc_html( $product_meta['dina_pmeta_value'] );
            }

            if ( isset( $product_meta['dina_pmeta_link'] ) ) {
                $pmeta_link = esc_html( $product_meta['dina_pmeta_link'] );
            }

            if ( isset( $product_meta['dina_pmeta_icon'] ) && $product_meta['dina_pmeta_icon'] != 'none' && ! empty( $product_meta['dina_pmeta_icon'] ) ) {
                $pmeta_icon = '<i class="dina_meta_icon fal fa-' . esc_html( $product_meta['dina_pmeta_icon'] ) . '"></i>';
            } else {
                $pmeta_icon = '';
            }

            if ( ! empty( $pmeta_name) ) {
                echo '<span class="meta_wrapper meta-'. $count .'">';
                    echo $pmeta_icon;
                    echo ( ! empty ( $pmeta_name ) ? $pmeta_name . ': ' : '' );
                    if ( ! empty( $pmeta_value ) ) {
                        
                        if ( ! empty( $pmeta_link ) ) {
                            echo '<a class="dina-meta-link" href="'. $pmeta_link .'">';
                        }

                        echo '<span class="dina-meta-value">'. do_shortcode( $pmeta_value ) .'</span>';
                        
                        if ( ! empty( $pmeta_link ) ) {
                            echo '</a>';
                        }
                    }
                echo '</span>';
            }

            $count++;

        }    
    }
}

//dina_custom_product_tab_one
if ( dina_opt( 'custom_product_tab_one' ) ) 
    add_filter( 'woocommerce_product_tabs', 'dina_custom_product_tab_one' );
function dina_custom_product_tab_one( $tab ) {
    
    $tab_title = get_post_meta( get_the_ID(), 'dina_tab_title', true );

    if ( empty( $tab_title ) )
        return $tab;
    
    $tab_icon = get_post_meta( get_the_ID(), 'dina_tab_icon', true );

    if ( ! empty( $tab_icon ) && $tab_icon != 'none' )
        $tab_title = '<i class="dina-tab-icon fal fa-'. $tab_icon .'"></i> '. $tab_title;

    $tab['dina_custom_tab_one'] = array(
        'title'     => $tab_title,
        'priority'  => 20,
        'callback'  => 'dina_custom_product_tab_content_one'
    );

    return $tab;
}
    
function dina_custom_product_tab_content_one() {

    $tab_content = '';

    if ( dina_opt( 'product_tab_scroll' ) ) {
        $tab_title    = get_post_meta( get_the_ID(), 'dina_tab_title', true );
        $tab_content .= product_tab_title( $tab_title );
    }

    $tab_content .= '<div class="dina-custom-product-tab-content">'. dina_output_content( 'dina_tab_content', get_the_ID() ) .'</div>';

    echo $tab_content;
}

//dina_custom_product_tab_two
if ( dina_opt( 'custom_product_tab_two' ) ) {
    add_filter( 'woocommerce_product_tabs', 'dina_custom_product_tab_two' );
}
function dina_custom_product_tab_two( $tab ) {
    
    $tab_title = get_post_meta( get_the_ID(), 'dina_tab_title_two', true );

    if ( empty( $tab_title ) )
        return $tab;
    
    $tab_icon = get_post_meta( get_the_ID(), 'dina_tab_icon_two', true );

    if ( ! empty( $tab_icon ) && $tab_icon != 'none' )
        $tab_title = '<i class="dina-tab-icon fal fa-'. $tab_icon .'"></i> '. $tab_title;

    $tab['dina_custom_tab_two'] = array(
        'title'     => $tab_title,
        'priority'  => 20,
        'callback'  => 'dina_custom_product_tab_content_two'
    );

    return $tab;
}

function dina_custom_product_tab_content_two() {

    $tab_content = '';

    if ( dina_opt( 'product_tab_scroll' ) ) {
        $tab_title    = get_post_meta( get_the_ID(), 'dina_tab_title_two', true );
        $tab_content .= product_tab_title( $tab_title );
    }
    $tab_content .= '<div class="dina-custom-product-tab-content">'. dina_output_content( 'dina_tab_content_two', get_the_ID() ) .'</div>';

    echo $tab_content;
}

//dina_custom_product_tab_three
if ( dina_opt( 'custom_product_tab_three' ) ) {
    add_filter( 'woocommerce_product_tabs', 'dina_custom_product_tab_three' );
}
function dina_custom_product_tab_three( $tab ) {
    
    $tab_title = get_post_meta( get_the_ID(), 'dina_tab_title_three', true );

    if ( empty( $tab_title ) )
        return $tab;
    
    $tab_icon = get_post_meta( get_the_ID(), 'dina_tab_icon_three', true );

    if ( ! empty( $tab_icon ) && $tab_icon != 'none' )
        $tab_title = '<i class="dina-tab-icon fal fa-'. $tab_icon .'"></i> '. $tab_title;

    $tab['dina_custom_tab_three'] = array(
        'title'     => $tab_title,
        'priority'  => 20,
        'callback'  => 'dina_custom_product_tab_content_three'
    );

    return $tab;
}

function dina_custom_product_tab_content_three() {

    $tab_content = '';

    if ( dina_opt( 'product_tab_scroll' ) ) {
        $tab_title    = get_post_meta( get_the_ID(), 'dina_tab_title_three', true );
        $tab_content .= product_tab_title( $tab_title );
    }
    $tab_content .= '<div class="dina-custom-product-tab-content">'. dina_output_content( 'dina_tab_content_three', get_the_ID() ) .'</div>';

    echo $tab_content;
}

//dina_add_prod_tab_one
if ( dina_opt( 'show_add_prod_tab_one' ) ) {
    add_filter( 'woocommerce_product_tabs', 'dina_add_prod_tab_one' );
}
function dina_add_prod_tab_one( $tab ) {

    if ( dina_opt( 'tab_one_in_cats' ) && ! empty ( dina_opt( 'add_prod_tab_one_cats' ) ) && ! has_term( dina_opt( 'add_prod_tab_one_cats' ), 'product_cat' ) )
        return $tab;

    $tab_title = dina_opt( 'add_prod_tab_one_title' );

    if ( empty( $tab_title ) )
        return $tab;
    
    $tab_icon = dina_opt( 'add_prod_tab_one_icon' );

    if ( ! empty( $tab_icon ) && $tab_icon != 'none' )
        $tab_title = '<i class="dina-tab-icon '. $tab_icon .'"></i> '. $tab_title;

    $tab['dina_add_prod_tab_one'] = array(
        'title'     => $tab_title,
        'priority'  => 20,
        'callback'  => 'dina_add_prod_tab_one_content'
    );

    return $tab;
}
    
function dina_add_prod_tab_one_content() {

    $tab_content = '';

    if ( dina_opt( 'product_tab_scroll' ) ) {
        $tab_content .= product_tab_title( dina_opt( 'add_prod_tab_one_title' ) );
    }
    $tab_content .= '<div class="dina-custom-product-tab-content">'. do_shortcode( dina_opt( 'add_prod_tab_one_content' ) ) .'</div>';

    echo $tab_content;
}

//dina_add_prod_tab_two
if ( dina_opt( 'show_add_prod_tab_two' ) ) {
    add_filter( 'woocommerce_product_tabs', 'dina_add_prod_tab_two' );
}
function dina_add_prod_tab_two( $tab ) {

    if ( dina_opt( 'tab_two_in_cats' ) && ! empty ( dina_opt( 'add_prod_tab_two_cats' ) ) && ! has_term( dina_opt( 'add_prod_tab_two_cats' ), 'product_cat' ) )
        return $tab;

    $tab_title = dina_opt( 'add_prod_tab_two_title' );

    if ( empty( $tab_title ) )
        return $tab;
    
    $tab_icon = dina_opt( 'add_prod_tab_two_icon' );

    if ( ! empty( $tab_icon ) && $tab_icon != 'none' )
        $tab_title = '<i class="dina-tab-icon '. $tab_icon .'"></i> '. $tab_title;

    $tab['dina_add_prod_tab_two'] = array(
        'title'     => $tab_title,
        'priority'  => 20,
        'callback'  => 'dina_add_prod_tab_two_content'
    );

    return $tab;
}
    
function dina_add_prod_tab_two_content() {

    $tab_content = '';

    if ( dina_opt( 'product_tab_scroll' ) ) {
        $tab_content .= product_tab_title( dina_opt( 'add_prod_tab_two_title' ) );
    }
    $tab_content .= '<div class="dina-custom-product-tab-content">'. do_shortcode( dina_opt( 'add_prod_tab_two_content' ) ) .'</div>';

    echo $tab_content;
}

//dina_add_prod_tab_three
if ( dina_opt( 'show_add_prod_tab_three' ) ) {
    add_filter( 'woocommerce_product_tabs', 'dina_add_prod_tab_three' );
}
function dina_add_prod_tab_three( $tab ) {

    if ( dina_opt( 'tab_three_in_cats' ) && ! empty ( dina_opt( 'add_prod_tab_three_cats' ) ) && ! has_term( dina_opt( 'add_prod_tab_three_cats' ), 'product_cat' ) )
        return $tab;

    $tab_title = dina_opt( 'add_prod_tab_three_title' );

    if ( empty( $tab_title ) )
        return $tab;
    
    $tab_icon = dina_opt( 'add_prod_tab_three_icon' );

    if ( ! empty( $tab_icon ) && $tab_icon != 'none' )
        $tab_title = '<i class="dina-tab-icon '. $tab_icon .'"></i> '. $tab_title;

    $tab['dina_add_prod_tab_three'] = array(
        'title'     => $tab_title,
        'priority'  => 20,
        'callback'  => 'dina_add_prod_tab_three_content'
    );

    return $tab;
}
    
function dina_add_prod_tab_three_content() {

    $tab_content = '';

    if ( dina_opt( 'product_tab_scroll' ) ) {
        $tab_content .= product_tab_title( dina_opt( 'add_prod_tab_three_title' ) );
    }
    $tab_content .= '<div class="dina-custom-product-tab-content">'. do_shortcode( dina_opt( 'add_prod_tab_three_content' ) ) .'</div>';

    echo $tab_content;
}

//dina_add_prod_tab_four
if ( dina_opt( 'show_add_prod_tab_four' ) ) {
    add_filter( 'woocommerce_product_tabs', 'dina_add_prod_tab_four' );
}
function dina_add_prod_tab_four( $tab ) {

    if ( dina_opt( 'tab_four_in_cats' ) && ! empty ( dina_opt( 'add_prod_tab_four_cats' ) ) && ! has_term( dina_opt( 'add_prod_tab_four_cats' ), 'product_cat' ) )
        return $tab;

    $tab_title = dina_opt( 'add_prod_tab_four_title' );

    if ( empty( $tab_title ) )
        return $tab;
    
    $tab_icon = dina_opt( 'add_prod_tab_four_icon' );

    if ( ! empty( $tab_icon ) && $tab_icon != 'none' )
        $tab_title = '<i class="dina-tab-icon '. $tab_icon .'"></i> '. $tab_title;

    $tab['dina_add_prod_tab_four'] = array(
        'title'     => $tab_title,
        'priority'  => 20,
        'callback'  => 'dina_add_prod_tab_four_content'
    );

    return $tab;
}

function dina_add_prod_tab_four_content() {

    $tab_content = '';

    if ( dina_opt( 'product_tab_scroll' ) ) {
        $tab_content .= product_tab_title( dina_opt( 'add_prod_tab_four_title' ) );
    }
    $tab_content .= '<div class="dina-custom-product-tab-content">'. do_shortcode( dina_opt( 'add_prod_tab_four_content' ) ) .'</div>';

    echo $tab_content;
}

if ( ! function_exists( 'dina_mobile_sticky_add' ) ) {
    function dina_mobile_sticky_add() {
        global $product;
        $hide_mbar = dina_opt( 'hide_mobile_bar' ) ? ' hide-mbar' : '';
        ?>
        <div class="dina-mobile-sticky-add<?php echo $hide_mbar; ?>">
            <?php if ( dina_opt( 'show_mobile_sticky_add_title' ) ) { ?>
                <div class="dina-mobile-sticky-title col-12">
                    <?php the_title(); ?>
                </div>
            <?php } ?>
            <?php if ( dina_opt( 'show_mobile_sticky_add_price' ) ) { ?>
                <div class="dina-mobile-sticky-price col-12">
                    <?php woocommerce_template_single_price(); ?>
                </div>
            <?php } ?>
            <?php if ( $product->is_type( 'simple' ) )  { ?>
                <?php woocommerce_simple_add_to_cart(); ?>
            <?php } elseif ( $product->is_type( 'variable' ) ) { ?>
                <span class="single_add_to_cart_button button alt go-to-add">
                    <?php _e( 'Select options' , 'dina-kala' ); ?>
                </span>
            <?php } elseif ( $product->is_type( 'external' ) ) { ?>
                <?php woocommerce_external_add_to_cart(); ?>
            <?php } ?>
        </div>
        <?php
    }
}

//Use SKU as gtin8 in structured data
if ( dina_opt( 'site_schema' ) ) {
    add_filter( 'woocommerce_structured_data_product','dina_add_gtin8',10,2);
}
function dina_add_gtin8( $markup, $product ) {
    $markup['gtin8'] = str_replace( '-', '',$markup['sku']);
    return $markup;
}

//Dina related product's posts
if ( dina_opt( 'show_related_product_posts' ) ) {
    add_action( 'woocommerce_after_single_product_summary', 'dina_related_product_posts', 21 );
}
function dina_related_product_posts() {
    global $product;

    $related_taxterms = wp_get_object_terms( $product->get_id(), 'product_tag', array( 'fields' => 'names' ) );

    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => dina_opt( 'related_product_posts_count' ),
        'orderby' => 'rand',
        //'fields'                    => 'ids',
        'no_found_rows'             => true,
        'update_post_term_cache'    => false,
        'tax_query' => array(
            array(
                'taxonomy' => 'post_tag',
                'field' => 'name',
                'terms' => $related_taxterms
            )
        ),
        'post__not_in' => array ( get_the_ID() ),
    );
    $related_items = new WP_Query( $args ); ?>

    <?php if ( $related_items->have_posts() ) { ?>
        <div class="post-block<?php if ( dina_opt( 'prod_navs' ) == 'sttwo' ) { ?> nav-type-two<?php } ?> related block related-con">
            <div class="block-title">
                <span class="block-title-con">
                    <i class="fal fa-file-invoice" aria-hidden="true"></i>
                    <?php echo dina_opt( 'related_product_posts_title' ); ?>
                </span>
            </div>

            <?php
                $carousel_options = '';
                $carousel_options .= dina_opt( 'mobile_single_col' ) ? ' data-mcol="1"' : ' data-mcol="2"'; 
                $carousel_options .= dina_opt( 'show_product_posts_arrows' ) ? ' data-itemnavs="true"' : ' data-itemnavs="false"'; 
                $carousel_options .= dina_opt( 'product_posts_loop' ) ? ' data-itemloop="true"' : ' data-itemloop="false"'; 
                $carousel_options .= dina_opt( 'auto_product_posts_play' ) ? ' data-itemplay="true"' : ' data-itemplay="false"'; 
                //$carousel_options .= 'yes' === $settings['pause_over'] ? ' data-itemover="true"' : ' data-itemover="false"'; 
                $carousel_options .= ! empty ( dina_opt( 'product_posts_count' ) ) ? ' data-itemscount="'. dina_opt( 'product_posts_count' ) .'"' : ' data-itemscount="5"';
                //$carousel_options .= ! empty ( $settings['slide_by'] ) ? ' data-item-slideby="'. $settings['slide_by'] .'"' : ' data-item-slideby="1"';
                $carousel_options .= ' data-dir="'. dina_rtl() .'"';
            ?>

            <div class="owl-carousel" <?php echo $carousel_options; ?>>
                <?php while ( $related_items->have_posts() ) : $related_items->the_post(); ?>
                    <div class="item">
                        <?php get_template_part( 'includes/content-post' ); ?>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    <?php }
    wp_reset_postdata();
}

//Remove WooWallet Cashback
add_filter( 'woo_wallet_product_cashback_html', '__return_false' );

//Display Dina cashback amount in product
function dina_display_cashback() {
    $product = wc_get_product( get_the_ID() );

    if ( ! $product ) {
        return;
    }

    if ( $product->has_child() ) {
        $product = wc_get_product( current( $product->get_children() ) );
    }

    $cashback_amount = 0;

    if ( 'product' === woo_wallet()->settings_api->get_option( 'cashback_rule', '_wallet_settings_credit', 'cart' ) ) {
        $cashback_amount = woo_wallet()->cashback->get_product_cashback_amount( $product );
    } elseif ( 'product_cat' === woo_wallet()->settings_api->get_option( 'cashback_rule', '_wallet_settings_credit', 'cart' ) ) {
        $cashback_amount = woo_wallet()->cashback->get_product_category_wise_cashback_amount( $product );
    }

    $cashback_amount = apply_filters( 'woo_wallet_product_cashback_amount', $cashback_amount, get_the_ID() );

    if ( $cashback_amount ) {
        $cashback_html = '<span class="on-woo-wallet-cashback">' . wc_price( $cashback_amount, woo_wallet_wc_price_args() ) . __( ' Cashback', 'dina-kala' ) . '</span>';
    } else {
        $cashback_html = '<span class="on-woo-wallet-cashback" style="display:none;"></span>';
    }

    echo apply_filters( 'dina_woo_wallet_product_cashback_html', $cashback_html, get_the_ID() );
}

//dina_add_product_btn
if ( dina_opt( 'add_prod_btn_location' ) == 'location1' ) {
    add_action( 'dina_after_product_features', 'dina_add_product_btn', 10 );
}
function dina_add_product_btn() {

    if ( ! dina_opt( 'show_add_prod_btn' ) )
        return;

    if ( dina_opt( 'add_prod_btn_in_cats' ) && ! empty ( dina_opt( 'add_prod_btn_cats' ) ) && ! has_term( dina_opt( 'add_prod_btn_cats' ), 'product_cat' ) )
        return;

    if ( dina_opt( 'add_prod_btn_not_cats' ) && ! empty ( dina_opt( 'add_prod_btn_ncats' ) ) && has_term( dina_opt( 'add_prod_btn_ncats' ), 'product_cat' ) )
        return;

    global $post;
    
    $product = wc_get_product( $post->id );

    if ( dina_check_product_purchasable() || dina_opt( 'show_add_prod_call' ) ) {

        if ( dina_opt( 'show_add_prod_popup' ) ) {

            //check button title per product
            $add_btn_meta_title  = get_post_meta( get_the_ID(), 'dina_add_prod_btn_title', true );
 
            //check button title per product category
            $product_cats = wp_get_object_terms( get_the_ID(), 'product_cat', array( 'fields' => 'ids' ) );
            $add_prod_cat_btn_title = '';
 
            foreach ( $product_cats as $cat ) {
                if ( ! empty ( get_term_meta( $cat, 'dina_add_prod_cat_btn_title', true ) ) ) {
                    $add_prod_cat_btn_title = get_term_meta( $cat, 'dina_add_prod_cat_btn_title', true );
                }
            }
 
            if ( dina_opt( 'add_per_prod_popup' ) && $add_btn_meta_title != '' ) {
                $add_prod_btn_title = $add_btn_meta_title;
            } elseif ( $add_prod_cat_btn_title != '' && dina_opt( 'add_cat_prod_popup' ) ) {
                $add_prod_btn_title = $add_prod_cat_btn_title;
            } else {
                $add_prod_btn_title = dina_opt( 'add_prod_btn_title' );
            }

            if ( ! empty( $add_prod_btn_title ) ) {

                if ( dina_opt( 'add_prod_btn_location' ) == 'location2' ) {
                    echo '<div class="add-prod-btn-con add-prod-btn-first">';
                }
            ?>
                <button class="btn <?php echo dina_opt( 'add_prod_btn_color' ); ?> <?php echo dina_opt( 'add_prod_btn_size' ); ?> add-prod-btn add-btn-first add-prod-btn-popup" data-toggle="modal" data-target="#addbtnModal">
                    <i aria-hidden="true" class="<?php echo dina_opt( 'add_prod_btn_icon' ); ?>"></i>
                    <?php echo $add_prod_btn_title; ?>
                </button>
            <?php

                if ( dina_opt( 'add_prod_btn_location' ) == 'location2' ) {
                    echo '</div>';
                }
            }
        } else {

            //check title and link per product
            $add_btn_meta_title  = get_post_meta( get_the_ID(), 'dina_add_prod_per_btn_title', true );
            $add_btn_meta_link   = get_post_meta( get_the_ID(), 'dina_add_prod_per_btn_link', true );
            $add_btn_meta_target = get_post_meta( get_the_ID(), 'dina_add_prod_per_btn_target', true );

            //check title and link per product category
            $product_cats = wp_get_object_terms( get_the_ID(), 'product_cat', array( 'fields' => 'ids' ) );
            $add_prod_cat_btn_title = '';
            $add_prod_cat_btn_link = '';

            foreach ( $product_cats as $cat ) {
                if ( ! empty ( get_term_meta( $cat, 'dina_add_prod_cat_btn_title', true ) ) ) {
                    $add_prod_cat_btn_title = get_term_meta( $cat, 'dina_add_prod_cat_btn_title', true );
                }
                if ( ! empty ( get_term_meta( $cat, 'dina_add_prod_cat_btn_link', true ) ) ) {
                    $add_prod_cat_btn_link = get_term_meta( $cat, 'dina_add_prod_cat_btn_link', true );
                }
            }

            if ( dina_opt( 'add_per_prod_link' ) && $add_btn_meta_title != '' ) {
                $add_prod_btn_title = $add_btn_meta_title;
                $add_prod_btn_link = $add_btn_meta_link;
            } elseif ( $add_prod_cat_btn_title != '' ) {
                $add_prod_btn_title = $add_prod_cat_btn_title;
                $add_prod_btn_link = $add_prod_cat_btn_link;
            } else {
                $add_prod_btn_title = dina_opt( 'add_prod_btn_title' );
                $add_prod_btn_link = dina_opt( 'add_prod_btn_link' );
            }

            //Link target
            if ( dina_opt( 'add_per_prod_link' ) && $add_btn_meta_target != 'none' ) {
                $add_btn_link_target = $add_btn_meta_target;
            } else {
                $add_btn_link_target = dina_opt( 'add_prod_btn_link_target' );
            }

            $add_prod_btn_nofollow = ( dina_opt( 'add_prod_btn_link_nofollow' ) ? ' rel="nofollow"' : '' );

            if ( ! empty ( $add_prod_btn_title ) ) {
                if ( dina_opt( 'add_prod_btn_location' ) == 'location2' ) {
                    echo '<div class="add-prod-btn-con add-prod-btn-first">';
                }
            ?>

                <a class="btn <?php echo dina_opt( 'add_prod_btn_color' ); ?> <?php echo dina_opt( 'add_prod_btn_size' ); ?> add-prod-btn" href="<?php echo do_shortcode( $add_prod_btn_link ); ?>"<?php echo $add_prod_btn_nofollow; ?> target="<?php echo $add_btn_link_target; ?>" title="<?php echo $add_prod_btn_title; ?>">
                    <i aria-hidden="true" class="<?php echo dina_opt( 'add_prod_btn_icon' ); ?>"></i>
                    <?php echo $add_prod_btn_title; ?>
                </a>

        <?php
                if ( dina_opt( 'add_prod_btn_location' ) == 'location2' ) {
                    echo '</div>';
                }
            }
        }
    }
}

//dina_add_product_btn
add_action( 'dina_after_product_features', function() {
    for ( $num = 2; $num < 6; $num++ ) {
        $btn_num = di_num2word( $num );
        if ( dina_opt( $btn_num .'_show_add_prod_btn' ) && dina_opt( $btn_num . '_add_prod_btn_location' ) == 'location1' ) {
            dina_add_product_btns( $btn_num );
        }
    }
}, 10);

add_action( 'dina_after_add_prod_btn', function() {
    for ( $num = 2; $num < 6; $num++ ) {
        $btn_num = di_num2word( $num );
        if ( dina_opt( $btn_num .'_show_add_prod_btn' ) && dina_opt( $btn_num . '_add_prod_btn_location' ) == 'location2' ) {
            dina_add_product_btns( $btn_num );
        }
    }
});

function dina_add_product_btns( $num ) {

    if ( dina_opt( $num .'_add_prod_btn_in_cats' ) && ! empty ( dina_opt( $num .'_add_prod_btn_cats' ) ) && ! has_term( dina_opt( $num .'_add_prod_btn_cats' ), 'product_cat' ) )
        return;

    if ( dina_opt( $num .'_add_prod_btn_not_cats' ) && ! empty ( dina_opt( $num .'_add_prod_btn_ncats' ) ) && has_term( dina_opt( $num .'_add_prod_btn_ncats' ), 'product_cat' ) )
        return;

    if ( dina_check_product_purchasable() || dina_opt( $num .'_show_add_prod_call' ) ) {

        if ( dina_opt( $num .'_show_add_prod_popup' ) ) {

            //check button title per product
            $add_btn_meta_title  = get_post_meta( get_the_ID(), 'dina_'. $num .'_add_prod_btn_title', true );
 
            //check button title per product category
            $product_cats = wp_get_object_terms( get_the_ID(), 'product_cat', array( 'fields' => 'ids' ) );
            $add_prod_cat_btn_title = '';
 
            foreach ( $product_cats as $cat ) {
                if ( ! empty ( get_term_meta( $cat, 'dina_'. $num .'_add_prod_cat_btn_title', true ) ) ) {
                    $add_prod_cat_btn_title = get_term_meta( $cat, 'dina_'. $num .'_add_prod_cat_btn_title', true );
                }
            }
 
            if ( dina_opt( $num .'_add_per_prod_popup' ) && $add_btn_meta_title != '' ) {
                $add_prod_btn_title = $add_btn_meta_title;
            } elseif ( $add_prod_cat_btn_title != '' && dina_opt( $num .'_add_cat_prod_popup' ) ) {
                $add_prod_btn_title = $add_prod_cat_btn_title;
            } else {
                $add_prod_btn_title = dina_opt( $num .'_add_prod_btn_title' );
            }

            if ( ! empty( $add_prod_btn_title ) ) {

                if ( dina_opt( $num .'_add_prod_btn_location' ) == 'location2' ) {
                    echo '<div class="add-prod-btn-con add-prod-btn-'. $num .'">';
                }
            ?>
                <button class="btn <?php echo dina_opt( $num .'_add_prod_btn_color' ); ?> <?php echo dina_opt( $num .'_add_prod_btn_size' ); ?> add-prod-btn add-btn-<?= $num ?> add-prod-btn-popup" data-toggle="modal" data-target="#<?= $num ?>_addbtnModal">
                    <i aria-hidden="true" class="<?php echo dina_opt( $num .'_add_prod_btn_icon' ); ?>"></i>
                    <?php echo $add_prod_btn_title; ?>
                </button>
            <?php

                if ( dina_opt( $num .'_add_prod_btn_location' ) == 'location2' ) {
                    echo '</div>';
                }
            }
        } else {

            //check title and link per product
            $add_btn_meta_title  = get_post_meta( get_the_ID(), 'dina_'. $num .'_add_prod_per_btn_title', true );
            $add_btn_meta_link   = get_post_meta( get_the_ID(), 'dina_'. $num .'_add_prod_per_btn_link', true );
            $add_btn_meta_target = get_post_meta( get_the_ID(), 'dina_'. $num .'_add_prod_per_btn_target', true );

            //check title and link per product category
            $product_cats = wp_get_object_terms( get_the_ID(), 'product_cat', array( 'fields' => 'ids' ) );
            $add_prod_cat_btn_title = '';
            $add_prod_cat_btn_link = '';

            foreach ( $product_cats as $cat ) {
                if ( ! empty ( get_term_meta( $cat, 'dina_'. $num .'_add_prod_cat_btn_title', true ) ) ) {
                    $add_prod_cat_btn_title = get_term_meta( $cat, 'dina_'. $num .'_add_prod_cat_btn_title', true );
                }
                if ( ! empty ( get_term_meta( $cat, 'dina_'. $num .'_add_prod_cat_btn_link', true ) ) ) {
                    $add_prod_cat_btn_link = get_term_meta( $cat, 'dina_'. $num .'_add_prod_cat_btn_link', true );
                }
            }

            if ( dina_opt( $num .'_add_per_prod_link' ) && $add_btn_meta_title != '' ) {
                $add_prod_btn_title = $add_btn_meta_title;
                $add_prod_btn_link = $add_btn_meta_link;
            } elseif ( $add_prod_cat_btn_title != '' ) {
                $add_prod_btn_title = $add_prod_cat_btn_title;
                $add_prod_btn_link = $add_prod_cat_btn_link;
            } else {
                $add_prod_btn_title = dina_opt( $num .'_add_prod_btn_title' );
                $add_prod_btn_link = dina_opt( $num .'_add_prod_btn_link' );
            }

            //Link target
            if ( dina_opt( $num .'_add_per_prod_link' ) && $add_btn_meta_target != 'none' ) {
                $add_btn_link_target = $add_btn_meta_target;
            } else {
                $add_btn_link_target = dina_opt( $num .'_add_prod_btn_link_target' );
            }

            $add_prod_btn_nofollow = ( dina_opt( $num .'_add_prod_btn_link_nofollow' ) ? ' rel="nofollow"' : '' );

            if ( ! empty ( $add_prod_btn_title ) ) {
                if ( dina_opt( $num .'_add_prod_btn_location' ) == 'location2' ) {
                    echo '<div class="add-prod-btn-con add-prod-btn-'. $num .'">';
                }
            ?>

            <a class="btn <?php echo dina_opt( $num .'_add_prod_btn_color' ); ?> <?php echo dina_opt( $num .'_add_prod_btn_size' ); ?> add-prod-btn" href="<?php echo do_shortcode( $add_prod_btn_link ); ?>"<?php echo $add_prod_btn_nofollow; ?> target="<?php echo $add_btn_link_target; ?>" title="<?php echo $add_prod_btn_title; ?>">
                <i aria-hidden="true" class="<?php echo dina_opt( $num .'_add_prod_btn_icon' ); ?>"></i>
                <?php echo $add_prod_btn_title; ?>
            </a>

        <?php
                if ( dina_opt( $num .'_add_prod_btn_location' ) == 'location2' ) {
                    echo '</div>';
                }
            }
        }
    }
}

//dina_add_sms_subscriptions
add_action( 'dina_after_product_features', 'dina_add_sms_subscriptions', 12 );
function dina_add_sms_subscriptions() {
    
    if ( defined( 'PWSMS_VERSION' ) && function_exists( 'pwsms_shortcode' ) ) {
        $enable_notification = PWSMS()->get_option( 'enable_notif_sms_main' );
    
        if ( $enable_notification ) {
            echo do_shortcode( '[woo_ps_sms]' );
        }
    
    } else {
        return;
    }
}

//dina_add_video_thumbnail_class
if ( dina_opt( 'show_video_thumbnail' ) ) {
    add_filter( 'post_class', 'dina_add_video_thumbnail_class' );
}
function dina_add_video_thumbnail_class( $classes ) {
    if ( is_singular( 'product' ) ) {
        $rvideo = get_post_meta( get_the_ID(), 'dina_rvideo', true );
        $aparat = get_post_meta( get_the_ID(), 'dina_aparat', true );
        $raudio = get_post_meta( get_the_ID(), 'dina_raudio', true );
        $classes[] .= ( ! empty ( $aparat ) || ! empty ( $rvideo ) ? 'dina-video-thumbnail' : '' );
        $classes[] .= ( empty ( $aparat ) && empty ( $rvideo ) && ! empty ( $raudio ) ? 'dina-video-thumbnail dina-audio-thumbnail' : '' );
        $classes[] .= dina_opt( 'video_thumbnail_color' ) ? 'dina-video-thumbnail-color' : '' ;
    }
    return $classes;
}

//dina_video_thumbnail_js_codes
if ( dina_opt( 'show_video_thumbnail' ) ) {
    add_action( 'wp_footer', 'dina_video_thumbnail_codes', 101 );
}
function dina_video_thumbnail_codes() { 
    if ( is_singular( 'product' ) ) {
        $rvideo = get_post_meta( get_the_ID(), 'dina_rvideo', true );
        $aparat = get_post_meta( get_the_ID(), 'dina_aparat', true );
        $raudio = get_post_meta( get_the_ID(), 'dina_raudio', true );
        if ( ! empty ( $aparat ) || ! empty ( $rvideo ) ) { ?>
            <script>
            jQuery(document).ready(function(e) {
                e( ".dina-video-thumbnail .woocommerce-product-gallery__wrapper .woocommerce-product-gallery__image:first-of-type" ).bind( "click", function() {
                    e( '#reviewModal' ).modal( 'show' );
                });
            })
            </script>
<?php
        } elseif ( ! empty ( $raudio ) ) { ?>
            <script>
            jQuery(document).ready(function(e) {
                e( ".dina-video-thumbnail .woocommerce-product-gallery__wrapper .woocommerce-product-gallery__image:first-of-type" ).bind( "click", function() {
                    e( '#audio_reviewModal' ).modal( 'show' );
                });
            })
            </script>
        <?php
        }
    }
}

//Product page messages one
if ( dina_opt( 'show_product_page_message_one' ) )
    add_action( dina_opt( 'product_page_message_one_location' ), 'dina_product_page_message_one' );
function dina_product_page_message_one() {
    global $post;

    if ( ! is_object( $post ) ) 
        return;

    if ( dina_opt( 'product_page_message_one_purchasable' ) && ! dina_check_product_purchasable()  )
        return;

    if ( dina_opt( 'product_page_message_one_in_cats' ) && ! empty ( dina_opt( 'product_page_message_one_cats' ) ) && ! has_term( dina_opt( 'product_page_message_one_cats' ), 'product_cat' ) )
        return;

    $msg_product_page = dina_opt( 'product_page_message_one_per_product' ) ? get_post_meta( get_the_ID(), 'dina_product_message_content_one', true ) : '';
    $message_content  = ! empty ( $msg_product_page ) ? $msg_product_page : dina_opt( 'product_page_message_one_content' );

    if ( empty ( $message_content ) )
        return;

    $message  = '<div class="dina-product-massage dina-product-massage-one alert '. dina_opt( 'product_page_message_one_color' ) .'">';

    if ( ! empty( dina_opt( 'product_page_message_one_icon' ) ) )
        $message .= '<i class="'. dina_opt( 'product_page_message_one_icon' ) .'"></i>';

    $message .= dina_wpautop_content( $message_content );

    $message .= '</div>';

    echo $message;
}

//Product page messages two
if ( dina_opt( 'show_product_page_message_two' ) )
    add_action( dina_opt( 'product_page_message_two_location' ), 'dina_product_page_message_two' );
function dina_product_page_message_two() {
    global $post;

    if ( ! is_object( $post ) ) 
        return;

    if ( dina_opt( 'product_page_message_two_purchasable' ) && ! dina_check_product_purchasable()  )
        return;

    if ( dina_opt( 'product_page_message_two_in_cats' ) && ! empty ( dina_opt( 'product_page_message_two_cats' ) ) && ! has_term( dina_opt( 'product_page_message_two_cats' ), 'product_cat' ) )
        return;

    $msg_product_page = dina_opt( 'product_page_message_two_per_product' ) ? get_post_meta( get_the_ID(), 'dina_product_message_content_two', true ) : '';
    $message_content  = ! empty ( $msg_product_page ) ? $msg_product_page : dina_opt( 'product_page_message_two_content' );

    if ( empty ( $message_content ) )
        return;

    $message  = '<div class="dina-product-massage dina-product-massage-one alert '. dina_opt( 'product_page_message_two_color' ) .'">';

    if ( ! empty( dina_opt( 'product_page_message_two_icon' ) ) )
        $message .= '<i class="'. dina_opt( 'product_page_message_two_icon' ) .'"></i>';

    $message .= dina_wpautop_content( $message_content );

    $message .= '</div>';

    echo $message;
}

//Product page messages three
if ( dina_opt( 'show_product_page_message_three' ) )
    add_action( dina_opt( 'product_page_message_three_location' ), 'dina_product_page_message_three' );
function dina_product_page_message_three() {
    global $post;

    if ( ! is_object( $post ) ) 
        return;

    if ( dina_opt( 'product_page_message_three_purchasable' ) && ! dina_check_product_purchasable()  )
        return;

    if ( dina_opt( 'product_page_message_three_in_cats' ) && ! empty ( dina_opt( 'product_page_message_three_cats' ) ) && ! has_term( dina_opt( 'product_page_message_three_cats' ), 'product_cat' ) )
        return;

    $msg_product_page = dina_opt( 'product_page_message_three_per_product' ) ? get_post_meta( get_the_ID(), 'dina_product_message_content_three', true ) : '';
    $message_content  = ! empty ( $msg_product_page ) ? $msg_product_page : dina_opt( 'product_page_message_three_content' );

    if ( empty ( $message_content ) )
        return;

    $message  = '<div class="dina-product-massage dina-product-massage-one alert '. dina_opt( 'product_page_message_three_color' ) .'">';

    if ( ! empty( dina_opt( 'product_page_message_three_icon' ) ) )
        $message .= '<i class="'. dina_opt( 'product_page_message_three_icon' ) .'"></i>';

    $message .= dina_wpautop_content( $message_content );

    $message .= '</div>';

    echo $message;
}

//Product page messages four
if ( dina_opt( 'show_product_page_message_four' ) )
    add_action( dina_opt( 'product_page_message_four_location' ), 'dina_product_page_message_four' );
function dina_product_page_message_four() {
    global $post;

    if ( ! is_object( $post ) ) 
        return;

    if ( dina_opt( 'product_page_message_four_purchasable' ) && ! dina_check_product_purchasable()  )
        return;

    if ( dina_opt( 'product_page_message_four_in_cats' ) && ! empty ( dina_opt( 'product_page_message_four_cats' ) ) && ! has_term( dina_opt( 'product_page_message_four_cats' ), 'product_cat' ) )
        return;

    $msg_product_page = dina_opt( 'product_page_message_four_per_product' ) ? get_post_meta( get_the_ID(), 'dina_product_message_content_four', true ) : '';
    $message_content  = ! empty ( $msg_product_page ) ? $msg_product_page : dina_opt( 'product_page_message_four_content' );

    if ( empty ( $message_content ) )
        return;

    $message  = '<div class="dina-product-massage dina-product-massage-one alert '. dina_opt( 'product_page_message_four_color' ) .'">';

    if ( ! empty( dina_opt( 'product_page_message_four_icon' ) ) )
        $message .= '<i class="'. dina_opt( 'product_page_message_four_icon' ) .'"></i>';

    $message .= dina_wpautop_content( $message_content );

    $message .= '</div>';

    echo $message;
}

//product_tab_title
function product_tab_title( $title ) {

    $tag = ! empty ( dina_opt( 'product_tab_scroll_tag' ) ) ? dina_opt( 'product_tab_scroll_tag' ) : 'h2';

    $tag = '<'. $tag . ' class="product-tab-scroll-head">'. $title .'</'. $tag .'>';
   
    return $tag;
}

//dina_product_faq_tab
if ( dina_opt( 'show_faq_product_tab' ) && ! dina_opt( 'faq_product_tab_end' ) ) {
    add_filter( 'woocommerce_product_tabs', 'dina_product_faq_tab' );
}
function dina_product_faq_tab( $tab ) {
    
    $show_faq  = get_post_meta( get_the_ID(), 'dina_show_faq', true );
    $tab_title = dina_opt( 'faq_product_tab_title' );
    $tab_icon  = dina_opt( 'faq_product_tab_icon' );
    $faqs      = get_post_meta( get_the_ID(), 'dina_faqs', true );

    if( ! $show_faq || empty( $faqs ) )
        return $tab;
    
    $tab_title = '<i class="dina-tab-icon fal fa-'. $tab_icon .'"></i> '. $tab_title;

    $tab['dina_product_faq_tab'] = array(
        'title'     => $tab_title,
        'priority'  => 20,
        'callback'  => 'dina_product_faq_tab_content'
    );

    return $tab;
}
    
function dina_product_faq_tab_content() {

    $faqs = get_post_meta( get_the_ID(), 'dina_faqs', true );

    if ( dina_opt( 'product_tab_scroll' ) ) {
        echo product_tab_title( dina_opt( 'faq_product_tab_title' ) );
    }

    $faqnumber = 1;

    echo '<div id="accordion" class="dina-faq-accordion">';
        foreach ( (array) $faqs as $key => $faq ) {
            ?>
                <div class="card">
                    <div class="card-header" id="heading<?php echo $faqnumber; ?>">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse<?php echo $faqnumber; ?>" aria-expanded="false" aria-controls="collapse<?php echo $faqnumber; ?>">
                                <?php echo $faq['dina_faq_question'] ?>
                            </button>
                        </h5>
                    </div>

                    <div id="collapse<?php echo $faqnumber; ?>" class="collapse" aria-labelledby="heading<?php echo $faqnumber; ?>" data-parent="#accordion" style="">
                        <div class="card-body dina-accordion-body">
                <?php
                echo $faq['dina_faq_answer'];
            ?>
                        </div>
                    </div>
                </div>
            <?php
            $faqnumber++;
        }
    echo '</div>';
}

// dina_product_faq
if ( dina_opt( 'show_faq_product_tab' ) && dina_opt( 'faq_product_tab_end' ) ) {
    add_action( 'dina_after_product_description', 'dina_product_faq', 12 );
}
function dina_product_faq() {

    global $product;

    $show_faq = get_post_meta( $product->get_id(), 'dina_show_faq', true );
    $title    = dina_opt( 'faq_product_tab_title' );
    $icon     = dina_opt( 'faq_product_tab_icon' );
    $faqs     = get_post_meta( $product->get_id(), 'dina_faqs', true );

    if( ! $show_faq || empty( $faqs ) )
        return;
    
    $title = '<div class="dina-entry-faq-title"><i class="fal fa-'. $icon .'"></i> '. $title .'</div>';

    $faqnumber = 1;

    echo $title;

    echo '<div id="accordion" class="dina-faq-accordion">';
        foreach ( (array) $faqs as $key => $faq ) {
            ?>
                <div class="card">
                    <div class="card-header" id="heading<?php echo $faqnumber; ?>">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse<?php echo $faqnumber; ?>" aria-expanded="false" aria-controls="collapse<?php echo $faqnumber; ?>">
                                <?php echo $faq['dina_faq_question'] ?>
                            </button>
                        </h5>
                    </div>

                    <div id="collapse<?php echo $faqnumber; ?>" class="collapse" aria-labelledby="heading<?php echo $faqnumber; ?>" data-parent="#accordion" style="">
                        <div class="card-body dina-accordion-body">
                <?php
                echo $faq['dina_faq_answer'];
            ?>
                        </div>
                    </div>
                </div>
            <?php
            $faqnumber++;
        }
    echo '</div>';
}

// dina_faq_to_product_schema
add_filter( 'woocommerce_structured_data_product', 'dina_faq_to_product_schema', 10, 2 );
function dina_faq_to_product_schema( $markup, $product ) {

    if ( ! dina_opt( 'faq_product_schema' ) )
        return $markup;

    $faqs = get_post_meta( $product->get_id(), 'dina_faqs', true );

    if ( ! empty( $faqs ) && is_array( $faqs ) ) {

        $faq_items = array();

        foreach ( $faqs as $faq ) {
            if ( ! empty( $faq['dina_faq_question'] ) && ! empty( $faq['dina_faq_answer'] ) ) {
                $faq_items[] = array(
                    "@type"          => "Question",
                    "name"           => sanitize_text_field( $faq['dina_faq_question'] ),
                    "acceptedAnswer" => array(
                        "@type" => "Answer",
                        "text"  => sanitize_text_field( $faq['dina_faq_answer'] )
                    )
                );
            }
        }

        if ( ! empty( $faq_items ) ) {
            $markup['@graph'][] = array(
                "@context"   => "https://schema.org",
                "@type"      => "FAQPage",
                "mainEntity" => $faq_items
            );
        }
    }

    return $markup;
}