<?php
/*
Theme Designed By: Meysam Hosseinkhani
Email: Meysam98@Gmail.com
Demo Website: Dinakala.I-design.ir
Author Website: i-design.ir
*/

//  Exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
    exit;

require_once DI_DIR . '/includes/single-product-func.php';
require_once DI_DIR . '/includes/woo/prod-hover-btns.php';
require_once DI_DIR . '/includes/woo/archive-swatches.php';
require_once DI_DIR . '/includes/woo/dina-order-tracking.php';
require_once DI_DIR . '/includes/woo/dina-accessories.php';

if ( dina_opt( 'redirect_wpadmin_woo' ) )
    require_once DI_DIR . '/includes/woo/redirect-wp-login.php';

if ( dina_opt( 'mini_cart_quantity' ) )
    require_once DI_DIR . '/includes/woo/mini-cart-quantity.php';

if ( ! dina_opt( 'remove_myacc_hooks' ) )
    require_once DI_DIR . '/includes/woo/udash.php';

if ( dina_opt( 'ajax_add' ) && get_option( 'woocommerce_enable_ajax_add_to_cart' ) === 'yes' && get_option( 'woocommerce_cart_redirect_after_add' ) === 'no' )
    require_once DI_DIR . '/includes/woo/ajax-add.php';

if ( dina_opt( 'stock_order' ) )
    require_once DI_DIR . '/includes/woo/order-class.php';

if ( dina_opt( 'replace_attr_symbol' ) )
    require_once DI_DIR . '/includes/woo/dina-product-attr.php';

if ( dina_opt( 'order_tracking_code' ) )
    require_once DI_DIR . '/includes/woo/tracking-code.php';

// Grant access to new file for pre customers
if ( dina_opt( 'grant_download_access' ) )
    require_once DI_DIR . '/includes/woo/dina-grant-access.php';

// Woo External Products Open New Tab
if ( dina_opt( 'external_new_tab' ) )
    require_once DI_DIR . '/includes/woo/external.php';

if ( dina_opt( 'search_by_sku' ) )
    require_once DI_DIR . '/includes/woo/sku-search.php';

if ( dina_opt( 'national_code_field' ) )
    require_once DI_DIR . '/includes/woo/national-code.php';
    
// Change number or products per row
add_filter( 'loop_shop_columns', 'dina_loop_columns', 999 );
if ( ! function_exists( 'dina_loop_columns' ) ) {
    function dina_loop_columns() {
        $prods =  dina_opt( 'product_col' );
        return $prods;
    }
}

if ( dina_opt( 'remove_mini_cart_btn' ) )
    remove_action( 'woocommerce_widget_shopping_cart_buttons', 'woocommerce_widget_shopping_cart_button_view_cart', 10 );

// Change number of products that are displayed per page (shop page)
add_filter( 'loop_shop_per_page', 'dina_product_per_page', 20 );
function dina_product_per_page( $cols ) {
    $cols =  dina_opt( 'product_num' );
    return $cols;
}

// Check product is free
function dina_woo_free( $id ) {
    $product = wc_get_product( $id );
    if ( '' === $product->get_price() || 0 == $product->get_price() && defined( 'SOMDN_PATH' ) ) {
        return true;
    } else {
        return false;
    }
}

// Free Price for free products
add_filter( 'woocommerce_get_price_html', 'dina_free_zero_empty', 100, 2 );
function dina_free_zero_empty( $price, $product ) {

    // get product comingsoon status
    $coming = get_post_meta( $product->get_id(), 'dina_coming', true );

    // check variable product min and max prices is equal or not
    $variable_equal = false;

    if ( $product->is_type( 'variable' ) ) {
        $min_var_regular_price = $product->get_variation_regular_price( 'min', true );
        $min_var_sale_price = $product->get_variation_sale_price( 'min', true );
        $max_var_regular_price = $product->get_variation_regular_price( 'max', true );
        $max_var_sale_price = $product->get_variation_sale_price( 'max', true );
        if ( ( $min_var_regular_price == $max_var_regular_price && $max_var_regular_price == 0 ) || ( $min_var_sale_price == $max_var_sale_price && $max_var_sale_price == 0 ) || ( $min_var_regular_price === $max_var_regular_price && $max_var_regular_price === '' ) || ( $min_var_sale_price === $max_var_sale_price && $max_var_sale_price === '' ) ) {
            $variable_equal = true;
        }
    }

    // check if catalog mode is true then remove add to cart
    if ( dina_opt( 'product_catalog_mode' ) ) {
        if ( $product->is_type( 'simple' ) ) {
            remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
        }
    }
    
    if ( dina_opt( 'product_catalog_mode' ) && dina_opt( 'product_catalog_price_mode' ) ) {

        $price = '';
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);

    } elseif ( show_login_price() ) {

        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);

        if ( is_singular( 'product' ) ) {
            if (function_exists( 'digits_version' ) &&  dina_opt( 'digits_mode' ) ) {
                $digits_mode = ( dina_opt( 'digits_page' ) ? 'digitsbtn digitlink' : 'digitsbtn digitpopup' );
                $price       = '<span class="woocommerce-Price-amount amount '. $digits_mode .'">'. __( 'Login to see prices', 'dina-kala' ) .'</span>';
            } else {
                $login_link  = ( dina_opt( 'ch_login_link' ) ? 'href="'.  dina_opt( 'login_link' ) .'"' : 'rel="nofollow" href="javascript:void(0)" onclick="openLogin()"' );
                $price       = '<a title="'. __( 'Login Or Register', 'dina-kala' ) .'" class="login-price-link" '. $login_link .'>';
                $price      .= '<span class="woocommerce-Price-amount amount">'. __( 'Login to see prices', 'dina-kala' ) .'</span>';
                $price      .= '</a>';
            }
        } else {
            $price = '<span class="woocommerce-Price-amount amount">'. __( 'Login to see prices', 'dina-kala' ) .'</span>';
        }

    } elseif ( $coming ) {

        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
        $coming_text = get_post_meta( $product->get_id(), 'dina_coming_text', true );
        $coming_text = ! empty( $coming_text ) ? $coming_text : dina_opt( 'coming_soon_text' );
        $price = '<span class="woocommerce-Price-amount amount dina-coming-price">'. $coming_text .'</span>';

    } elseif ( is_a( $product, 'WC_Product_Variation' ) && dina_is_call( $product->get_id() ) ) {
        
        $price = dina_free_call_text( $product->get_id() );

        if ( is_singular( 'product' ) && ! empty ( dina_opt( 'zero_call_link' ) ) ) {
            $price = '<a class="call-pro-link" href="'.  dina_opt( 'zero_call_link' ) .'" title="'. dina_opt( 'zero_call_text' ) .'" target="_blank" rel="nofollow">' . $price;
            $price = $price .'</a>';
        }
        
    } elseif ( ( $product->is_type( 'variable' ) && $variable_equal === true ) && dina_is_call( $product->get_id() ) ) {
        
        $price = dina_free_call_text( $product->get_id() );

        if ( is_singular( 'product' ) && ! empty ( dina_opt( 'zero_call_link' ) ) ) {
            $price = '<a class="call-pro-link" href="'.  dina_opt( 'zero_call_link' ) .'" title="'. dina_opt( 'zero_call_text' ) .'" target="_blank" rel="nofollow">' . $price;
            $price = $price .'</a>';
        }
        
    } elseif ( ! $product->is_type( 'variable' ) && dina_is_call( $product->get_id() ) ) {

        $price = dina_free_call_text( $product->get_id() );

        if ( is_singular( 'product' ) && ! empty ( dina_opt( 'zero_call_link' ) ) ) {
            $price = '<a class="call-pro-link" href="'.  dina_opt( 'zero_call_link' ) .'" title="'. dina_opt( 'zero_call_text' ) .'" target="_blank" rel="nofollow">' . $price;
            $price = $price .'</a>';
        }

    } elseif ( ( $product->is_type( 'variable' ) && $variable_equal === true ) &&  dina_opt( 'show_free_price' ) && ( '' === $product->get_price() || 0 == $product->get_price() ) ) {
        
        $price = dina_free_call_text( $product->get_id() );
        
    } elseif ( ! $product->is_type( 'variable' ) && dina_opt( 'show_free_price' ) && ( '' === $product->get_price() || 0 == $product->get_price() ) ) {

        $price = dina_free_call_text( $product->get_id() );

    }

    if ( ! $product->is_in_stock() && ! dina_opt( 'show_price_out' ) ) {
        $price = '';
    }

    return $price;
}

// Price settings for wooCommerce variable products
add_filter( 'woocommerce_variable_price_html', 'dina_variable_product_price', 10, 2 );
function dina_variable_product_price( $price, $product ) {

    if ( ( is_admin() && ! wp_doing_ajax() ) || ! dina_opt( 'remove_price_range' ) )
        return $price;

    $type = dina_opt( 'show_max_price' ) ? 'max' : 'min';

    // Show default variable price
    if ( dina_opt( 'show_def_price' ) ) {
        $variation_id = dina_get_default_variation_id( $product->get_id() );
        if ( ! $variation_id )
            $variation_id = dina_variable_min_max_id( $product->get_id(), $type );
    // Show min or max varible price
    } else {
        $variation_id = dina_variable_min_max_id( $product->get_id(), $type );
    }

    if ( ! $variation_id ) {
        if ( dina_opt( 'show_zero_call' ) && dina_opt( 'show_free_price' ) ) {
            $price = '<span class="woocommerce-Price-amount amount dina-free-price">'. dina_opt( 'zero_call_text' ) .'</span>';
            if ( is_singular( 'product' ) && ! empty ( dina_opt( 'zero_call_link' ) ) ) {
                $price = '<a class="call-pro-link" href="'.  dina_opt( 'zero_call_link' ) .'" title="'. dina_opt( 'zero_call_text' ) .'" target="_blank" rel="nofollow">' . $price;
                $price = $price .'</a>';
            }
        } elseif ( dina_opt( 'show_free_price' ) ) {
            $price = '<span class="woocommerce-Price-amount amount dina-free-price">'. dina_opt( 'free_price_text' ) .'</span>';
        }
        return $price;
    }
    
    $variation     = wc_get_product( $variation_id );
    $regular_price = $variation->get_regular_price();
    $sale_price    = ! empty ( $regular_price ) ? $variation->get_sale_price() : '';

    if ( ! empty( $sale_price ) && ! ( $regular_price == $sale_price ) && $variation->is_on_sale() )
        $price = wc_format_sale_price( wc_price( $regular_price ), wc_price( $sale_price ) );
    else
        $price = wc_price( $regular_price );

    if ( dina_opt( 'display_from_to' ) && ! dina_opt( 'show_def_price' ) )
        $price = dina_opt( 'show_max_price' ) ? dina_opt( 'price_upto_text' ) .' '. $price : dina_opt( 'price_from_text' ) .' '. $price;

    return $price;
}

add_filter( 'woocommerce_is_purchasable', 'dina_remove_atc_button', 10, 2 );
// Hide the Add Too Cart button on products page when price is set to 0
function dina_remove_atc_button( $is_purchasable, $product ) {
    if ( $product->is_type( 'variation' ) ) {
        $product_price = $product->get_price();
        if ( dina_opt( 'show_zero_call' ) && '0' === $product_price ) {
            return false;
        }
    }
    return $is_purchasable;
}

// Change several of the breadcrumb defaults
add_filter( 'woocommerce_breadcrumb_defaults', 'dina_woocommerce_breadcrumbs' );
function dina_woocommerce_breadcrumbs() {
    if ( dina_opt( 'change_home_text' ) ) {
        $home_text =  dina_opt( 'home_text' );
    } else {
        $home_text = _x( 'Home', 'breadcrumb', 'dina-kala' );
    }
    $bread_mobile = ( dina_opt( 'show_bread_mobile' ) ? '' : ' mobile-hidden' );
    return array(
            'delimiter'   => '',
            'wrap_before' => '<div class="row bread-row'.$bread_mobile.'"><nav class="col-12 shadow-box breadcrumbs dina-breadcrumb" itemprop="breadcrumb">',
            'wrap_after'  => '</nav></div>',
            'before'      => '',
            'after'       => '',
            'home'        => $home_text,
        );
}

// Show cart contents / total Ajax
add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );
function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	ob_start();
	?>
	<i class="dina-cart-amount">
    <?php echo $woocommerce->cart->cart_contents_count; ?></i>
	<?php
	$fragments['.dina-cart-amount'] = ob_get_clean();
	return $fragments;
}

// Total Sales of woocommerce products
function di_woo_get_total_sales() {
    $order_status = str_replace( 'wc-', '', dina_opt( 'info_bar_sales_status' ) );
    $total_orders = wc_orders_count( $order_status );
    return $total_orders;
}

// Woo Dis price
function disw_price ( $id) {
    $product = wc_get_product( $id );

    if ( $product->is_type( 'grouped' ) ) {
        return;
    } elseif ( $product->is_type( 'variable' ) ) {
        $children_ids = $product->get_children();
        foreach ( $children_ids as $children_id ) {
            $product    = wc_get_product( $children_id );
            $sale_price = $product->get_sale_price();
            if ( ! empty( $sale_price ) ) {
                $regular_price = $product->get_regular_price();
                $r_price = $regular_price;
                $s_price = $sale_price;
            }
        }
    } else {
        $r_price = $product->get_regular_price();
        $s_price = $product->get_sale_price();
    }

    if ( $r_price == 0 || empty ( $r_price ) ) 
        return;
    
    $d_price = (int)$r_price - (int)$s_price;
    $t_price = round( ( $d_price / $r_price ) * 100 );

    return $t_price;
}

// Dina Dis price
add_action( 'dina_after_shop_loop_item_img', 'dina_dis_price' );
function dina_dis_price () {

    global $product;

    if ( !  dina_opt( 'display_discount' ) || ! $product->is_in_stock() || ! $product->is_on_sale() )
        return;

    if ( disw_price( $product->get_id() ) == 100)
        return;

    if ( $product->is_type( 'variable' ) ) {
        $s_price = $product->get_variation_sale_price( 'min' );
    } else {
        $s_price = $product->get_sale_price();
    }

    if ( ! empty( $s_price ) && disw_price ( $product->get_id() ) != 0 ) {

        if ( dina_opt( 'display_spec' ) ) {
            $t_price ='<span class="product-dis product-dis-spec">'. __( 'Sale!', 'dina-kala' ) .'</span>';
        } elseif ( is_rtl() ) {
            $t_price ='<span class="product-dis">٪'. disw_price ( $product->get_id() ) .'</span>';
        } else {
            $t_price ='<span class="product-dis">'. disw_price ( $product->get_id() ) .'%</span>';
        }
        echo $t_price;

    }
}

// dina_woo_show_page_title
add_filter( 'woocommerce_show_page_title', 'dina_woo_show_page_title' );
function dina_woo_show_page_title() {
    return false;
}

// dina_woo_add_product_class
add_filter( 'post_class', 'dina_woo_add_product_class' );
function dina_woo_add_product_class( $classes ) {
    global $product;
    if ( is_single() && 'product' == get_post_type() ) {
        
        $pside = get_post_meta( get_the_ID(), 'dina_pside', true );
        $content_sticky = ( dina_opt( 'side_sticky' ) ? ' content-sticky' : '' );
        
        if ( $pside == 'wside' ) { 
            $classes[] .= 'col-12';
        } elseif ( ! empty( $pside ) ) {
            $classes[] .= 'col-lg-9 col-12 dina-full-tablet' . $content_sticky;
        } elseif ( dina_opt( 'product_side' ) > 0 ) {
            $classes[] .= 'col-lg-9 col-12 dina-full-tablet' . $content_sticky;
        } else {
            $classes[] .= 'col-12';
        }

        $classes[] .= ( ! $product->is_type( 'variable' ) && dina_is_call( $product->get_id() ) ? 'call-pro' : '' );
        $classes[] .= ( dina_opt( 'prod_tab_style' ) == 'sttwo' ? 'product-tab-style-two' : 'product-tab-style-one' );
        $classes[] .= ( ! dina_opt( 'show_more_desktop' ) ? 'product-content-short-mobile' : '' );
        $classes[] .= ( dina_opt( 'display_review_count' )  ? 'dina-star-rating-count' : '' );
        $classes[] .= ( is_rtl()  ? 'product-rtl' : 'product-ltr' );
        $classes[] .= ( dina_opt( 'out_stock_black' ) && ( ! $product->is_in_stock() ) ? 'outofstock-black' : '' );
        $classes[] .= ( dina_opt( 'show_prod_meta_sum' ) ? 'dina-product-meta-sum' : '' );
        $classes[] .= ( ! dina_opt( 'product_tab_fixed' ) ? 'product-tab-not-fixed' : '' );
        $classes[] .= ( dina_opt( 'product_page_style' ) == 'stone'  ? 'product-page-style-one' : 'product-page-style-two' );
        $classes[] .= ( dina_opt( 'product_tab_scroll' ) ? 'product-tab-scroll-two' : 'product-tab-scroll-one' );
        $classes[] .= ( class_exists( 'Cipg_Slider' )  ? 'dina-wpgs-gallery' : 'dina-woo-gallery' );
        $classes[] .= ( get_post_meta( $product->get_id(), 'dina_coming', true )  ? 'product-coming' : '' );
        $classes[] .= ( dina_opt( 'product_catalog_mode' ) ? 'dina-catalog-mode' : '' );
        $classes[] .= ( dina_opt( 'product_catalog_mode' ) &&  dina_opt( 'product_catalog_price_mode' ) ? 'dina-catalog-price-mode' : '' );
        $classes[] .= ( show_login_price() ? 'dina-login-price' : '' );
    }
    return $classes;
}

// dina_woo_before_main_content
add_action( 'woocommerce_before_main_content', 'dina_woo_before_main_content', 21 );
function dina_woo_before_main_content() {

    if ( dina_opt( 'show_sub_cats' ) && is_product_category() ) {
        dina_show_sub_cats();
    }

    if ( dina_opt( 'show_head_banner' ) && ! is_checkout() && ! is_cart() ) {
         dina_header_banner(); 
        } 

        dina_archive_header_banner(); 

    if ( ! is_singular( 'product' ) ) {
        $side = ( dina_opt( 'product_archive_side' ) == 2 ? ' right-side' : '' ); ?> 
        <div class="row prod-row<?php echo $side ?>">
    <?php } else {

    $pside = get_post_meta( get_the_ID(), 'dina_pside', true );

    if ( $pside == 'rside' ) { 
        $side = ' right-side';
    } elseif ( $pside == 'lside' ) {
        $side = '';
    } elseif ( dina_opt( 'product_side' ) == 2 ) {
        $side = ' right-side';
    } else {
        $side = '';
    } ?>

    <div class="row prod-row<?php echo $side ?>">
    <?php }
}

// dina_woo_after_main_content
add_action( 'woocommerce_after_main_content', 'dina_woo_after_main_content' );
function dina_woo_after_main_content() { ?>
    </div>    
<?php }

// dina_woo_before_shop_loop
add_action( 'woocommerce_before_shop_loop', 'dina_woo_before_shop_loop',16);
function dina_woo_before_shop_loop() { 
    $classes = 'dina-product-archive-con';
    $classes .= ( dina_opt( 'side_sticky' ) ? ' content-sticky' : '' );
    $classes .= ( dina_opt( 'ajax_prod' ) ? ' ajax-prod' : '' );
    $classes .= ( dina_opt( 'ajax_prod' ) &&  dina_opt( 'ajax_prod_auto' )  ? ' ajax-prod-auto' : '' );
    $classes .= ( dina_opt( 'product_archive_side' ) == 0 ? ' col-12' : ' col-lg-9 col-12 dina-full-tablet' );
    $classes .= ( dina_opt( 'mobile_single_row' ) ? ' dina-mtable-style' : '' );
    $ajax_prod_auto = ( dina_opt( 'ajax_prod' ) &&  dina_opt( 'ajax_prod_auto' )  ? ' data-auto-ajax-load="100"' : ' data-auto-ajax-load="false"' );
    $ajax_prod_history = ( dina_opt( 'ajax_prod' ) &&  dina_opt( 'ajax_prod_history' )  ? ' data-ajax-prod-history="push"' : ' data-ajax-prod-history="false"' );
    ?>
    <div class="<?php echo $classes ?>"<?php echo $ajax_prod_auto . $ajax_prod_history; ?>>
<?php
}

// dina_woo_after_shop_loop
add_action( 'woocommerce_after_shop_loop', 'dina_woo_after_shop_loop',15);
function dina_woo_after_shop_loop() { ?>
    </div>    
<?php }

// Dina Category Slider
if ( dina_opt( 'cat_slider_top' ) ) {
    add_action( 'woocommerce_before_main_content', 'dina_category_slider', 20 );
} else {
    add_action( 'woocommerce_before_shop_loop', 'dina_category_slider', 17 );
}
function dina_category_slider() {

    global $wp_query;

    if ( dina_opt( 'show_cat_slider_first' ) && $wp_query->get( 'paged' ) > 1 )
        return;
        
    if ( is_woocommerce() && is_archive() && dina_opt( 'cat_slider_show' ) ) {

        $term_id  = get_queried_object_id();

        $cat_slide_fields = get_term_meta( $term_id, 'dina_cat_slide_fields', true );
        
        if ( ! empty( $cat_slide_fields ) ) {

            $slider_prameters  = '';
            $slider_prameters .= dina_opt( 'cat_slider_show_arrows' ) ? ' data-itemnavs="true"' : ' data-itemnavs="false"';
            $slider_prameters .= dina_opt( 'cat_slider_show_dots' ) ? ' data-itemdots="true"' : ' data-itemdots="false"';
            $slider_prameters .= dina_opt( 'cat_slider_auto_play' ) ? ' data-itemplay="true" data-itemtime="'.  dina_opt( 'cat_slider_time' ) .'"' : ' data-itemplay="false"';
            $slider_prameters .= dina_opt( 'cat_slider_pause_over' ) ? ' data-itemover="true"' : ' data-itemover="false"';
            $slider_prameters .= ' data-dir="'. dina_rtl() .'"';
            
            ?>

            <!-- start slider -->
            <div class="dina-slider dina-category-slider shadow-box">
                <div class="slider-con owl-carousel" <?php echo $slider_prameters; ?>>
                    <?php
                    foreach ( (array) $cat_slide_fields as $key => $cat_slide_field ) { 
                        if ( ! empty ( $cat_slide_field['dina_cat_slide_image'] ) ) {
                    ?>
                        <div class="item">
                            <?php if ( ! empty( $cat_slide_field['dina_cat_slide_link'] ) ) {
                                    $target   = isset( $cat_slide_field['dina_cat_slide_link_target'] ) ? ' target="_blank"' : '';
                                    $nofollow = isset( $cat_slide_field['dina_cat_slide_link_follow'] ) ? ' rel="nofollow"' : '';
                            ?>
                                <a href="<?php echo $cat_slide_field['dina_cat_slide_link']; ?>" title="<?php echo $cat_slide_field['dina_cat_slide_title']; ?>"<?php echo $target . $nofollow; ?>>
                            <?php }
                            $image_id         = attachment_url_to_postid( esc_url( $cat_slide_field['dina_cat_slide_image'] ) );
                            $image_attributes = wp_get_attachment_image_src( $image_id, 'full' );
                            $width            = ( isset( $image_attributes[1] ) ? ' width="' . $image_attributes[1] . '"' : '' );
                            $height           = ( isset( $image_attributes[2] ) ? ' height="' . $image_attributes[2] . '"' : '' );
                            ?>
                                <img loading="eager" src="<?php echo $cat_slide_field['dina_cat_slide_image']; ?>" alt="<?php echo $cat_slide_field['dina_cat_slide_title']; ?>"<?php echo $width . $height; ?> class="slider-img skip-lazy no-lazyload">
                            <?php if ( ! empty( $cat_slide_field['dina_cat_slide_link'] ) ) { ?>
                                </a>
                            <?php } ?>
                        </div>
                    <?php
                        }
                    }
                    ?>
                </div>

                <?php if ( dina_opt( 'cat_slider_show_title' ) ) { ?>
                    <ul class="slider-title">
                        <?php
                        foreach ( (array) $cat_slide_fields as $key => $cat_slide_field ) { ?>
                        <li class="col">
                            <span class="slide-title"><?php echo $cat_slide_field['dina_cat_slide_title']; ?></span>
                        </li>
                        <?php
                        } ?>
                    </ul>
                <?php } ?>
            </div>
            <!-- end slider -->
       <?php 
        }
    }
}

// Dina Shop Page Slider
add_action( 'woocommerce_before_shop_loop', 'dina_shop_page_slider', 17 );
function dina_shop_page_slider() {

    if ( is_search() )
        return;

    global $wp_query;

    if ( dina_opt( 'show_cat_slider_first' ) && $wp_query->get( 'paged' ) > 1 )
        return;

    if ( is_shop() && dina_opt( 'shop_slider_show' ) ) {

        $shop_page_id = get_option( 'woocommerce_shop_page_id' );

        $shop_slide_fields = get_post_meta( $shop_page_id, 'dina_shop_slide_fields', true );
        
        if ( ! empty( $shop_slide_fields ) ) {

            $slider_prameters = '';
            $slider_prameters .=  dina_opt( 'cat_slider_show_arrows' ) ? ' data-itemnavs="true"' : ' data-itemnavs="false"';
            $slider_prameters .=  dina_opt( 'cat_slider_show_dots' ) ? ' data-itemdots="true"' : ' data-itemdots="false"';
            $slider_prameters .=  dina_opt( 'cat_slider_auto_play' ) ? ' data-itemplay="true" data-itemtime="'.  dina_opt( 'cat_slider_time' ) .'"' : ' data-itemplay="false"';
            $slider_prameters .=  dina_opt( 'cat_slider_pause_over' ) ? ' data-itemover="true"' : ' data-itemover="false"';
            $slider_prameters .= ' data-dir="'. dina_rtl() .'"';
            
            ?>

            <!-- start slider -->
            <div class="dina-slider dina-category-slider shadow-box">
                <div class="slider-con owl-carousel" <?php echo $slider_prameters; ?>>
                    <?php
                    foreach ( (array) $shop_slide_fields as $key => $shop_slide_field ) { 
                        if ( ! empty ( $shop_slide_field['dina_shop_slide_image'] ) ) {
                    ?>
                        <div class="item">
                            <?php if ( ! empty( $shop_slide_field['dina_shop_slide_link'] ) ) {
                                $target   = isset ( $shop_slide_field['dina_shop_slide_link_target'] ) ? ' target="_blank"' : '';
                                $nofollow = isset ( $shop_slide_field['dina_shop_slide_link_follow'] ) ? ' rel="nofollow"' : '';
                            ?>
                                <a href="<?php echo $shop_slide_field['dina_shop_slide_link']; ?>" title="<?php echo $shop_slide_field['dina_shop_slide_title']; ?>"<?php echo $target . $nofollow; ?>>
                            <?php }
                            $image_id         = attachment_url_to_postid( esc_url( $shop_slide_field['dina_shop_slide_image'] ) );
                            $image_attributes = wp_get_attachment_image_src( $image_id, 'full' );
                            $width            = ( isset( $image_attributes[1] ) ? ' width="' . $image_attributes[1] . '"' : '' );
                            $height           = ( isset( $image_attributes[2] ) ? ' height="' . $image_attributes[2] . '"' : '' );
                            ?>
                                <img loading="eager" src="<?php echo $shop_slide_field['dina_shop_slide_image']; ?>" alt="<?php echo $shop_slide_field['dina_shop_slide_title']; ?>"<?php echo $width . $height; ?> class="slider-img">
                            <?php if ( ! empty( $shop_slide_field['dina_shop_slide_link'] ) ) { ?>
                                </a>
                            <?php } ?>
                        </div>
                    <?php
                        }
                    }
                    ?>
                </div>

                <?php if ( dina_opt( 'cat_slider_show_title' ) ) { ?>
                    <ul class="slider-title">
                        <?php
                        foreach ( (array) $shop_slide_fields as $key => $shop_slide_field ) { ?>
                        <li class="col">
                            <span class="slide-title"><?php echo $shop_slide_field['dina_shop_slide_title']; ?></span>
                        </li>
                        <?php
                        } ?>
                    </ul>
                <?php } ?>
            </div>
            <!-- end slider -->
       <?php 
        }
    }
}

// dina_woo_before_order_con
add_action( 'woocommerce_before_shop_loop', 'dina_woo_before_order_con',19);
function dina_woo_before_order_con() { 
    
    if ( dina_opt( 'remove_product_order' ) )
        return;

    $show_filter = (dina_check_side() == 2 &&  dina_opt( 'show_filter' ) ? ' show-filter' : '' ); ?>

    <div class="col-12 shadow-box woocommerce-ordering-con<?php echo $show_filter; ?>">

    <i class="fal fa-sort-amount-up-alt sort-icon" aria-hidden="true"></i>

    <ul class="dina-order-products">
        <?php
        
        if ( isset( $_GET['orderby'] ) ) {
            $orderby = $_GET['orderby'];
        } elseif ( is_search() ) {
            $orderby = 'relevance';
        } else {
            $orderby = get_option( 'woocommerce_default_catalog_orderby' );
        }
        ?>

        <?php if ( is_search() ) { ?>
        <li class="order-item order-relevance<?php echo ( $orderby == 'relevance' ? ' is-active' : '' ); ?>">
            <a rel="nofollow" href="<?php echo dina_order_get_link( 'relevance' ); ?>">
                <?php _e( 'Relevance' , 'dina-kala' ); ?>
            </a>
        </li>

        <?php } elseif ( $orderby == 'menu_order' || $orderby == '' ) { ?>
        <li class="order-item order-menu-order<?php echo ( $orderby == 'menu_order' || $orderby == '' ? ' is-active' : '' ); ?>">
            <a rel="nofollow" href="<?php echo dina_order_get_link( 'menu_order' ); ?>">
                <?php _e( 'Default' , 'dina-kala' ); ?>
            </a>
        </li>
        <?php } ?>

        <li class="order-item order-rating<?php echo ( $orderby == 'rating' ? ' is-active' : '' ); ?>">
            <a rel="nofollow" href="<?php echo dina_order_get_link( 'rating' ); ?>">
                <?php _e( 'Rating' , 'dina-kala' ); ?>
            </a>
        </li>

        <li class="order-item order-popularity<?php echo ( $orderby == 'popularity' ? ' is-active' : '' ); ?>">
            <a rel="nofollow" href="<?php echo dina_order_get_link( 'popularity' ); ?>">
                <?php _e( 'Popularity' , 'dina-kala' ); ?>
            </a>
        </li>

        <li class="order-item order-date<?php echo ( $orderby == 'date' ? ' is-active' : '' ); ?>">
            <a rel="nofollow" href="<?php echo dina_order_get_link( 'date' ); ?>">
                <?php _e( 'Latest' , 'dina-kala' ); ?>
            </a>
        </li>

        <li class="order-item order-price<?php echo ( $orderby == 'price' ? ' is-active' : '' ); ?>">
            <a rel="nofollow" href="<?php echo dina_order_get_link( 'price' ); ?>">
                <?php _e( 'Low Price' , 'dina-kala' ); ?>
            </a>
        </li>

        <li class="order-item order-price-desc<?php echo ( $orderby == 'price-desc' ? ' is-active' : '' ); ?>">
            <a rel="nofollow" href="<?php echo dina_order_get_link( 'price-desc' ); ?>">
                <?php _e( 'High Price' , 'dina-kala' ); ?>
            </a>
        </li>
    </ul>
<?php }

// dina_order_get_link
function dina_order_get_link( $order_type ) {
    $base_link            = dina_shop_page_link( true );
    $link                 = remove_query_arg( 'orderby', $base_link );

    if ( $order_type != 'menu_order' ) {
        $link = add_query_arg( 'orderby', $order_type, $link );
        $link = str_replace( '%2C', ',', $link );
    }

    return $link;
}

// dina_woo_after_order
add_action( 'woocommerce_before_shop_loop', 'dina_woo_after_order',35);
function dina_woo_after_order() { 
    if ( dina_opt( 'remove_product_order' ) )
        return;
    if ( dina_check_side() == 2 &&  dina_opt( 'show_filter' ) ) { ?>
        <span class="show-filter-btn open-side" onclick="openSide()">
            <span aria-hidden="true" class="fal fa-filter" title="<?php _e( 'Show filters', 'dina-kala' ); ?>"></span>
            <span><?php _e( 'Show filters', 'dina-kala' ); ?></span>
        </span>
    <?php } ?>
    </div>
<?php
}

// Remove product sorting from archive pages 
if ( dina_opt( 'remove_product_order' ) ) {
    remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
    remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
}

// Show Product Category Description
remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description' );
remove_action( 'woocommerce_archive_description', 'woocommerce_product_archive_description' );
if ( dina_opt( 'show_on_top_cat' ) ) {
    add_action( 'woocommerce_before_shop_loop', 'dina_archive_description', 18);
    add_action( 'woocommerce_after_shop_loop', 'dina_second_archive_description',14);
    add_action( 'dina_before_no_products_found', 'dina_archive_description', 18);
    add_action( 'dina_after_no_products_found', 'dina_second_archive_description',14);
} else {
    add_action( 'woocommerce_after_shop_loop', 'dina_archive_description',14);
    add_action( 'woocommerce_before_shop_loop', 'dina_second_archive_description', 18);
    add_action( 'dina_after_no_products_found', 'dina_archive_description',14);
    add_action( 'dina_before_no_products_found', 'dina_second_archive_description', 18);
}

// Dina second product category archive description
function dina_second_archive_description() {

    global $wp_query;

    if ( dina_opt( 'show_first_text_cat' ) && $wp_query->get( 'paged' ) > 1 )
        return;

    if ( is_woocommerce() && is_product_taxonomy() ) {
        $term_id              = get_queried_object_id();
        $dina_second_cat_desc = get_term_meta( $term_id, 'dina_second_cat_desc', true );

        if ( ! empty( $dina_second_cat_desc ) ) {

            $cat_full = ( ! dina_opt( 'show_full_text_cat' ) ? ' class="cat-text dina-more-less" data-more="'. __( 'Show More', 'dina-kala' ) .'" data-less="'. __( 'Show Less', 'dina-kala' ) .'"' : '' );

            echo '<div class="shadow-box cat-desc cat-desc-second col-12">
            <div'. $cat_full .'>
            <div class="dina-more-less-content">
            '. dina_wpautop_content( $dina_second_cat_desc ) .'
            </div>
            </div>
            </div>';
        }
    }
}

// remove woocommerce_breadcrumb
if ( ! dina_opt( 'show_bread' ) ) {
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
} else {
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
    add_action( 'woocommerce_before_main_content', 'dina_breadcrumb', 20, 0); 
}

// dina_woo_pagination
add_action( 'woocommerce_after_shop_loop', 'dina_woo_pagination', 10 );
function dina_woo_pagination() {
    
    global $wp_query;

    if ( $wp_query->max_num_pages <= 1 ) return;

    $current_page = max( 1, get_query_var( 'paged' ) );

    $pagination_links = paginate_links( array(
        'base'      => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
        'format'    => '',
        'current'   => $current_page,
        'total'     => $wp_query->max_num_pages,
        'type'      => 'array',
        'end_size'  => 3,
        'mid_size'  => 3,
        'prev_text' => __( '<i class="fal fa-chevron-right" aria-hidden="true" title="Next"></i>', 'dina-kala' ),
        'next_text' => __( '<i class="fal fa-chevron-left" aria-hidden="true" title="Prev"></i>', 'dina-kala' ),
    ));

    if ( is_array( $pagination_links ) ) {
        echo '<nav class="woocommerce-pagination"><ul class="page-numbers">';

        foreach ( $pagination_links as $link ) {
            $class = '';

            if ( strpos( $link, 'prev' ) !== false ) {
                $link = str_replace('<a', '<a rel="prev"', $link );
                $class = 'prev';
            } elseif ( strpos( $link, 'next' ) !== false ) {
                $link = str_replace( '<a', '<a rel="next"', $link );
                $class = 'next';
            } elseif ( strpos( $link, 'current' ) !== false ) {
                $class = 'active';
            }

            echo '<li class="page-item">'. $link .'</li>';
        }

        echo '</ul></nav>';
    }
}


// dina_cart_item_name
add_filter( 'woocommerce_cart_item_name', 'dina_cart_item_name', 10, 3 );
function dina_cart_item_name( $item_name,  $cart_item,  $cart_item_key ) {
    return '<span class="side-cart-name">'.$item_name.'</span>';
}

// dina_no_products_found
remove_action( 'woocommerce_no_products_found', 'wc_no_products_found' );
add_action( 'woocommerce_no_products_found', 'dina_no_products_found', 10);
function dina_no_products_found() {
    $content_sticky = ( dina_opt( 'side_sticky' ) ? ' content-sticky' : '' );
    $col = ( dina_opt( 'product_archive_side' ) == 0 ? 'col-12' : 'col-lg-9 col-12 dina-full-tablet' . $content_sticky );
    ?>
    <div class="<?php echo $col; ?>">
    <?php do_action( 'dina_before_no_products_found' ); ?>
     <div class="alert alert-warning" role="alert">
         <strong><span class="fal fa-bell fa-lg" aria-hidden="true">
         </span> <?php _e( 'No products found!', 'dina-kala' ) ?></strong>
      </div>
    <?php do_action( 'dina_after_no_products_found' ); ?>
    </div>
<?php }

// Remove Compare button product archive pages
if (defined( 'WCCM_VERISON' ) ) {
    remove_action( 'woocommerce_before_shop_loop', 'wccm_register_add_compare_button_hook' );
    remove_action( 'woocommerce_single_product_summary', 'wccm_add_single_product_compare_buttton', 35 );
    remove_action( 'woocommerce_before_shop_loop', 'wccm_render_catalog_compare_info' );
    remove_action( 'wp_enqueue_scripts', 'wccm_enqueue_catalog_scripts' );
    remove_action( 'widgets_init', 'wccm_widgets_init' );
}

// Ajax Load More
if ( dina_opt( 'ajax_prod' ) ) {
    add_action( 'woocommerce_after_shop_loop', 'dina_product_load_more', 11);
}
function dina_product_load_more() { ?>
    <div class="col-12 load-more">
        <div class="page-load-status">
            <p class="infinite-scroll-request"><i class="fal fa-spinner-third fa-spin" aria-hidden="true"></i></p>
        </div>
        <span id="load-more-button" class="load-more-button btn btn-outline-dina"><?php _e( 'Load More Products', 'dina-kala' ) ?></span>
    </div>
<?php }

// Option to remove product sku
if ( ! dina_opt( 'show_prod_sku' ) ) {
    add_filter( 'wc_product_sku_enabled', 'dina_remove_product_page_skus' );
}
function dina_remove_product_page_skus( $enabled ) {
    if ( ! is_admin() && is_product() )
        return false;

    return $enabled;
}

// Remove download item from woo menu
if ( dina_opt( 'remove_download' ) ) {
    add_filter( 'woocommerce_account_menu_items', 'remove_my_account_download_items' );
}
function remove_my_account_download_items( $items ) {
    unset( $items['downloads'] );
    return $items;
}

// remove or change reset variations text
if ( dina_opt( 'remove_clear_option' ) ) {
    add_filter( 'woocommerce_reset_variations_link', '__return_empty_string' );
} else {
    add_action( 'woocommerce_reset_variations_link' , 'dina_change_clear_text', 15 );
}
function dina_change_clear_text() {


   $reset_var_text = ( dina_opt( 'ch_reset_var_text' ) ?  dina_opt( 'reset_var_text' ) : __( 'Clear options', 'dina-kala' ) );
   echo '<a class="reset_variations" rel="nofollow" href="#">' . $reset_var_text . '</a>';
}

// dina_product_price
add_action( 'dina_after_shop_loop_item_title', 'dina_product_price' );
function dina_product_price() {
    global $product;

    if ( dina_opt( 'product_catalog_mode' ) &&  dina_opt( 'product_catalog_price_mode' ) )
        return;
    ?>
    <div class="product-price">
        <?php
            if ( $product->is_in_stock() || ( dina_opt( 'show_price_out' ) && dina_opt( 'show_price_out_archive' ) ) || show_login_price() ) {
                echo $product->get_price_html();
            } else {
                echo dina_outofstock_text();
            }
        ?>
    </div>
    <?php
}

// Ajax add to cart on archives
if ( dina_opt( 'show_hover_btns' ) ) {
    add_action( 'dina_after_shop_loop_item', 'dina_add_to_cart' );
}
function dina_add_to_cart( $archive_count = false ) {

    global $product;

    if ( dina_opt( 'product_catalog_mode' ) ) 
        return;

    $coming = get_post_meta( $product->get_id(), 'dina_coming', true );

    if ( $product->is_type( 'grouped' ) || dina_opt( 'disable_archive_ajax_add' ) || show_login_price() || ! $product->is_purchasable() || ! $product->is_in_stock() || $coming || ( ! $product->is_type( 'variable' ) && dina_is_call( $product->get_id() ) ) ) { ?>
        <a href="<?php the_permalink(); ?>" class="btn btn-success btn-buy<?php if ( dina_opt( 'show_hover_btns_fixed' ) ) { echo ' btn-buy-fixed'; } if ( dina_opt( 'hover_btns_fixed_mobile' ) ) { echo ' btn-buy-fixed-mobile'; } ?> button" rel="nofollow" target="<?php echo dina_link_target(); ?>">
            <i class="fal fa-eye" aria-hidden="true"></i>
            <?php _e( 'View Product', 'dina-kala' ); ?>
	    </a>
    <?php
    } elseif ( ( dina_opt( 'show_count_archive' ) || $archive_count == true ) && ( get_option( 'woocommerce_enable_ajax_add_to_cart' ) === 'yes' ) && ( $product->is_type( 'simple' ) && ! $product->is_sold_individually() ) ) {
        dina_archive_add_cart();
    } elseif ( get_option( 'woocommerce_enable_ajax_add_to_cart' ) === 'yes' ) {

        echo apply_filters(
            'woocommerce_loop_add_to_cart_link', //  WPCS: XSS ok.
            sprintf(
                '<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
                esc_url( $product->add_to_cart_url() ),
                esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
                esc_attr( implode( ' ', array_filter( array(
                    'btn', 'btn-success', 'btn-buy', 'button', 'product_type_' . $product->get_type(),
                    $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
                     dina_opt( 'show_hover_btns_fixed' ) ? ' btn-buy-fixed' : '',
                     dina_opt( 'hover_btns_fixed_mobile' ) ? ' btn-buy-fixed-mobile' : '',
                    $product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '',
                ) ) ) ),
                wc_implode_html_attributes( array(
                    'data-product_id'  => $product->get_id(),
                    'data-product_sku' => $product->get_sku(),
                    'aria-label'       => $product->add_to_cart_description(),
                    'rel'              => 'nofollow',
                ) ),
                esc_html( $product->add_to_cart_text() )
            ),
            $product
        );

    } else { ?>
        <a href="<?php the_permalink(); ?>" class="btn btn-success btn-buy<?php if ( dina_opt( 'show_hover_btns_fixed' ) ) { echo ' btn-buy-fixed'; } if ( dina_opt( 'hover_btns_fixed_mobile' ) ) { echo ' btn-buy-fixed-mobile'; } ?> button" rel="nofollow" target="<?php echo dina_link_target(); ?>">
            <i class="fal fa-cart-plus" aria-hidden="true"></i>
            <?php _e( 'View And Buy', 'dina-kala' ); ?>
	    </a>
    <?php
    }
}

// dina_mini_product_classes
function dina_mini_product_classes( $class = '', $post_id = null ) {
    //  Separates classes with a single space, collates classes for post DIV.
    echo 'class="' . esc_attr( implode( ' ', dina_mini_product_class( $class, $post_id ) ) ) . '"';
}

// dina_mini_product_classes
function dina_mini_product_class( $class = '', $post_id = null ) {
    $post = get_post( $post_id );
    global $product;

    if ( ! is_object( $product ) ) 
        return;
 
    $classes = array();
 
    if ( $class ) {
        if ( ! is_array( $class ) ) {
            $class = preg_split( '#\s+#', $class );
        }
        $classes = array_map( 'esc_attr', $class );
    } else {
        //  Ensure that we always coerce class to being an array.
        $class = array();
    }

    $classes[] = "woocommerce shadow-box ". dina_opt( 'prod_hover' )." mini-product ". 'product-'.$product->get_id();
    $classes[] = ( '' === $product->get_price() || 0 == $product->get_price() ? 'zero-prod' : '' );
    $classes[] = ( $product->is_in_stock() ? '' : 'prod-out-stock' );
    $classes[] = ( dina_opt( 'out_stock_black' ) && ( ! $product->is_in_stock() ) ? 'prod-out-stock-black' : '' );
    $classes[] = ( $product->is_type( 'variable' ) ? 'prod-variable' : '' );
    $classes[] = ( !  dina_opt( 'remove_price_range' ) ? 'prod-remove-range' : '' );
    $classes[] = ( get_post_meta( $product->get_id(), 'dina_coming', true ) ? 'prod-coming' : '' );
    $classes[] = ( show_login_price() ? 'dina-login-price' : '' );
    $classes[] = ( dina_opt( 'show_hover_btns_fixed' ) ? 'prod-add-btn-fixed' : '' );
    $classes[] = ( dina_opt( 'hover_btns_fixed_mobile' ) ? 'prod-add-btn-fixed-mobile' : '' );
    $classes[] = ( dina_opt( 'quick_btns_fix_mobile' ) ? 'quick-btns-fix-mobile' : '' );
    $classes[] = ( ! empty ( dina_opt( 'quick_btns_location' ) ) ? dina_opt( 'quick_btns_location' ) : 'quick-btns-left' );
    $classes[] = ( ! empty ( dina_opt( 'product_label_location' ) ) ? dina_opt( 'product_label_location' ) : 'product-label-right' );
    $classes[] = ( ! empty ( dina_opt( 'product_discount_location' ) ) ? dina_opt( 'product_discount_location' ) : 'product-discount-left' );
    $classes[] = ( dina_opt( 'product_catalog_mode' ) ? 'dina-catalog-mode' : '' );
    $classes[] = ( dina_opt( 'product_catalog_mode' ) &&  dina_opt( 'product_catalog_price_mode' ) ? 'dina-catalog-price-mode' : '' );
    

    if ( dina_opt( 'show_swatches_archive' ) ) 
        $classes[] = ! empty( dina_opt( 'swatches_archive_location' ) ) ? dina_opt( 'swatches_archive_location' ) : 'swatches-bottom-image';

    if ( dina_opt( 'show_sec_img' ) ) {
        $attachment_ids = $product->get_gallery_image_ids();
        if ( is_array( $attachment_ids ) && ! empty( $attachment_ids ) ) {
            $classes[] = 'hover-image';
        }
    }
 
    if ( ! $post ) {
        return $classes;
    }
 
    $classes = array_map( 'esc_attr', $classes );
 
    $classes = apply_filters( 'dina_mini_product_classes', $classes, $class, $post->ID );
 
    return array_unique( $classes );
}

// Remove Select2 for WooCommerce
add_action( 'wp_enqueue_scripts', 'wc_disable_select2', 100);
function wc_disable_select2() {
    if ( class_exists( 'woocommerce' ) ) {
        if ( is_woocommerce() && is_archive() )
        {
            wp_dequeue_style( 'select2' );
            wp_deregister_style( 'select2' );
    
            //  WooCommerce 3.2.1.x and below
            wp_dequeue_script( 'select2' );
            wp_deregister_script( 'select2' );
    
            //  WooCommerce 3.2.1+
            wp_dequeue_script( 'selectWoo' );
            wp_deregister_script( 'selectWoo' );
        }
    } 
}

// Dina_product_rating
add_action( 'dina_hover_center_item', 'dina_product_rating', 10 );
function dina_product_rating() {

    global $product;
    
    if ( ! wc_review_ratings_enabled() || !  dina_opt( 'show_star_rating' ) ) {
        return;
    }

    $rating_count = $product->get_rating_count();
    $review_count = $product->get_review_count();
    $average      = $product->get_average_rating();

    if ( $rating_count > 0 ) {
        echo '<div class="woocommerce-product-rating">';
        echo wc_get_rating_html( $average, $rating_count );
        echo '</div>';
    }
}

add_action( 'dina_after_shop_loop_item', 'dina_hover_center' );
function dina_hover_center() {
    ?>
    <div class="dina-hover-center">
        <?php do_action( 'dina_hover_center_item' ); ?>
    </div>
    <?php
}

// Dina_check_product_purchasable
function dina_check_product_purchasable() {
    global $product;
    $coming = get_post_meta( get_the_id(), 'dina_coming', true );
    if ( $product -> is_type( 'external' ) ) {
        return true;
    } elseif ( ! $product->is_purchasable() || ! $product->is_in_stock() || $coming || dina_is_call( $product->get_id() ) ) { 
        return false;
    } else {
        return true;
    }
}

// Get product deeper category
function dina_get_prod_deep_cats( $product_id ) {
    $prod_deep_cat = '';

    $primary_cat_id = class_exists( 'WPSEO_Options' ) ? get_post_meta( $product_id, '_yoast_wpseo_primary_product_cat', true ) : get_post_meta( $product_id, 'rank_math_primary_product_cat', true );
    
    if ( ! empty ( $primary_cat_id ) && dina_opt( 'show_by_main_cat' ) ) {
        return $primary_cat_id;
    } else {
        //  get all product cats for the current post
        $categories = get_the_terms( $product_id, 'product_cat' ); 

        //  wrapper to hide any errors from top level categories or products without category
        if ( $categories ) : 
            //  loop through each cat
            $cats = array();
            foreach( $categories as $category ) :
            //  get the children (if any) of the current cat
            $children = get_categories( array ( 'taxonomy' => 'product_cat', 'parent' => $category->term_id ) );

            if ( count( $children ) == 0 ) {
                //  if no children, then echo the category name.
                $cats[] = $category->term_id;
            }
            endforeach;
        endif;

        return $cats;
    }
}

// Remove password strength check.
add_action( 'wp_print_scripts', 'dina_remove_password_strength', 10 );
function dina_remove_password_strength() {
    wp_dequeue_script( 'wc-password-strength-meter' );
}

// Add archive title to woocommerce archive pages
if ( dina_opt( 'show_archive_title' ) ) {
    add_action( 'woocommerce_before_shop_loop', 'dina_woo_archive_title',17);
}

function dina_woo_archive_title() {


   $show_archive_mobile = ( dina_opt( 'show_archive_title_mobile' ) ? '' : ' mobile-hidden' );
   if ( is_woocommerce() && is_archive() ) {
       echo '<div class="row archive-title-con'. $show_archive_mobile .'"><div class="col-12 shadow-box"><h1>';
           woocommerce_page_title();
       echo '</h1></div></div>';
   }
}

// Poduct archive hover
if ( dina_opt( 'quick_btns_location' ) == 'quick-btns-center' ) {
    add_action( 'dina_hover_center_item', 'dina_prod_hover', 5 );
} else {
    add_action( 'dina_after_shop_loop_item', 'dina_prod_hover' );
}
function dina_prod_hover() {

    if ( is_plugin_active( 'elementor/elementor.php' ) ) {
        if ( ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) || ( \Elementor\Plugin::$instance->preview->is_preview_mode() ) ) {
            return;
        }
    }
    
    global $product;

    switch ( dina_opt( 'quick_btns_location' ) ) {
        case 'quick-btns-left':
            $placement = 'right';
            break;
        case 'quick-btns-right':
            $placement = 'left';
            break;
        case 'quick-btns-center':
            $placement = 'top';
            break;
        default:
            $placement = 'right';
    }
    ?>

    <span class="prod-hover-btns">

        <?php if ( dina_opt( 'show_quick_view' ) ) { ?>
            <span data-dina-product-id="<?php echo $product->get_id(); ?>" data-toggle="tooltip" data-placement="<?php echo $placement; ?>" class="quick-view-btn prod-hover-btn btn btn-light" title="<?php _e( 'Quick View', 'dina-kala' ); ?>">
                <i class="fal fa-eye" aria-hidden="true"></i>
            </span>
        <?php } ?>

        <?php if ( dina_opt( 'like_prod_archive' ) ) {
            if ( class_exists( 'YITH_WCWL' ) ) { ?>
                <span data-toggle="tooltip" data-placement="<?php echo $placement; ?>" class="like-prod-btn dina-yith-wcwl prod-hover-btn btn btn-light" title="<?php _e( 'Add to Wishlist', 'dina-kala' ); ?>">
                    <?php echo preg_replace("/<img[^>]+\>/i", " ", do_shortcode( '[yith_wcwl_add_to_wishlist]' ) ); ?>
                </span>
            <?php }
        } ?>
        
        <?php if ( dina_opt( 'compare_prod_archive' ) ) { 
            if ( class_exists( 'YITH_Woocompare' ) ) { ?>
            <div class="dina-compare-button prod-hover-btn btn btn-light" data-toggle="tooltip" data-placement="<?php echo $placement; ?>" title="<?php _e( 'Compare Product', 'dina-kala' ); ?>">
                <?php echo do_shortcode( '[yith_compare_button]' ); ?>
            </div>
        <?php } elseif ( defined( 'WCCM_VERISON' ) ) { ?>
            <?php 
            if ( in_array( $product->get_id(), wccm_get_compare_list() ) ) {
                $compare_title= __( 'Remove From Compare', 'dina-kala' );
                $compare_class = " in-compare";
            } else {
                $compare_title= __( 'Compare Product', 'dina-kala' );
                $compare_class = "";
            }
            ?>
            <span data-dina-compare-id="<?php echo $product->get_id(); ?>" data-toggle="tooltip" data-placement="<?php echo $placement; ?>" class="compare-ajax-btn prod-hover-btn btn btn-light<?php echo $compare_class; ?>" title="<?php echo $compare_title; ?>">
                <i class="fal fa-random" aria-hidden="true"></i>
            </span>
        <?php }
        } ?>

    </span>
<?php }

// WooCommerce Show Product Image at Checkout Page
add_filter( 'woocommerce_cart_item_name', 'dina_product_image_on_checkout', 10, 3 );
function dina_product_image_on_checkout( $name, $cart_item, $cart_item_key ) {
    /* Return if not checkout page */
    if ( ! is_checkout() ) {
        return $name;
    }
    /* Get product object */
    $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
    /* Get product thumbnail */
    $thumbnail = $_product->get_image( 'thumbnail' );
    $image = '<div class="dina-ch-product-image">'
                . $thumbnail .
            '</div>'; 
    /* Prepend image to name and return it */
    return $image . $name;
}

// Dina before cart
add_action( 'woocommerce_before_cart', 'dina_before_cart' );
function dina_before_cart() {
    echo '<div class="dina-cart-content-wrapper row">';
}

// Dina after cart
add_action( 'woocommerce_after_cart', 'dina_after_cart' );
function dina_after_cart() {  
    echo '</div>';
}

// Dina empty cart
add_action( 'woocommerce_cart_is_empty', 'dina_empty_cart' );
function dina_empty_cart() { ?>
    <div class="dina-empty-cart">
        <i class="fal fa-shopping-cart empty-cart-icon" aria-hidden="true"></i>
        <div class="dina-empty-cart-text">
            <?php _e( 'Before proceed to checkout you must add some products to your shopping cart.', 'dina-kala' ); ?>
            <br>
            <?php _e( 'You will find a lot of interesting products on our "Shop" page.', 'dina-kala' ); ?>
        </div>
    </div>
<?php }

// Change Cross Sell Display Place
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display', 10 );
add_action( 'woocommerce_before_cart_collaterals', 'woocommerce_cross_sell_display', 10 );

// Dina Product Label
if ( dina_opt( 'product_label_archive' ) ) {
    add_action( 'dina_after_shop_loop_item_img', 'dina_product_label' );
}
if ( dina_opt( 'product_label_single' ) ) {
    add_action( 'dina_before_product_gallery', 'dina_product_label' );
}
function dina_product_label() {

    if ( ! dina_opt( 'show_product_label' ) )
        return;

    global $product;

    $id            = $product->get_id();
    $plabel        = get_post_meta( $id, 'dina_plabel', true );
    $plabel_color  = get_post_meta( $id, 'dina_plabel_color', true );
    $product_label = '';

    if ( ! empty( $plabel ) ) {

        $hide_label     = ( is_single() && ! dina_opt( 'product_label_single_mobile' ) ? ' hide-label-mobile' : '' );
        $hide_label    .= ( ( is_archive() || is_home() ) && ! dina_opt( 'product_label_archive_mobile' ) ? ' hide-label-mobile' : '' );
        $product_label .= '<span class="product-label product-label-'. $plabel_color . $hide_label .'">'. $plabel .'</span>';

    }
    
    echo $product_label;

}

// Show price to logged in users
function show_login_price() {
    if ( ! is_user_logged_in() &&  dina_opt( 'show_login_price' ) ) 
        return true;
}

// Show Product Category Sub Category
function dina_show_sub_cats() {

    $term_id  = get_queried_object_id();
    $taxonomy = 'product_cat';
    
    //  Get subcategories of the current category
    $terms = get_terms([
        'taxonomy'   => $taxonomy,
        'hide_empty' => true,
        'parent'     => get_queried_object_id()
    ]);

    if ( empty( $terms ) ) 
        return;

    $mobile_cats = ( !  dina_opt( 'show_sub_cats_mobile' ) ? ' dina-hide-cats-mobile' : '' );

    $output = '<div class="row dina-sub-cat-row'. $mobile_cats .'">
               <div class="col-12 shadow-box dina-sub-cats">
               <div class="dina-subcat-list-title">'. __( 'Subcategories' , 'dina-kala' ) .'</div>';
    $output .= '<ul class="dina-subcat-list owl-carousel" data-itemscount="'. dina_opt( 'show_sub_cats_col' ) .'" data-itemscount-tablet="5" data-itemscount-mobile="3" data-dir="'. dina_rtl() .'">';
    
    //  Loop through product subcategories WP_Term Objects
    foreach ( $terms as $term ) {
        $term_link        = get_term_link( $term, $taxonomy );
        $thumbnail_id     = get_term_meta ( $term->term_id, 'thumbnail_id', true );
        $image_attributes = wp_get_attachment_image_src( $thumbnail_id, dina_opt( 'sub_cats_image_size' ) );
        $cat_img          = ( ! empty( $image_attributes[0] ) ? $image_attributes[0] : esc_url( get_template_directory_uri() ) . '/images/mthumb.png' );

        $output .= '<li class="dina-cat-thumb item '.  dina_opt( 'prod_hover' ) .'">
                            <a class="dina-cat-link" href="'. $term_link .'" title="'. $term->name .'">';
        
        if ( dina_opt( 'show_sub_cats_image' ) ) {
            $output .=  '<div class="dina-cat-img-con">
                            <img loading="eager" width="150" height="150" src="'. $cat_img .'" class="dina-cat-img" alt="'. $term->name .'">
                        </div>';
        }

        if ( dina_opt( 'show_sub_cats_title' ) ) {
            $output .=  '<span class="dina-cat-title">'. $term->name .'</span>';
        }
        
        $output .= '</a></li>';
    }

    $output . '</ul>';

    $output .= '</div></div>';

    echo $output;
}

remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close' );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' ); 

if ( ! function_exists( 'dina_widget_get_current_page_url' ) ) {
	function dina_widget_get_current_page_url( $link ) {
		if ( isset( $_GET['stock_status'] ) ) {
			$link = add_query_arg( 'stock_status', wc_clean( $_GET['stock_status'] ), $link );
		}

        if ( isset( $_GET['product_brand'] ) ) {
			$link = add_query_arg( 'product_brand', wc_clean( $_GET['product_brand'] ), $link );
		}

        if ( isset( $_GET['dprod_cat'] ) ) {
			$link = add_query_arg( 'dprod_cat', wc_clean( $_GET['dprod_cat'] ), $link );
		}

		return $link;
	}

	add_filter( 'woocommerce_widget_get_current_page_url', 'dina_widget_get_current_page_url' );
}

// Dina Get base shop page link
if ( ! function_exists( 'dina_shop_page_link' ) ) {
	function dina_shop_page_link( $keep_query = false, $taxonomy = '' ) {
		//  Base Link decided by current page
		$link = '';
        
		if ( class_exists( 'Automattic\Jetpack\Constants' ) && Automattic\Jetpack\Constants::is_defined( 'SHOP_IS_ON_FRONT' ) ) {
			$link = home_url();
		} elseif ( is_post_type_archive( 'product' ) || is_page( wc_get_page_id( 'shop' ) ) || is_shop() ) {
			$link = get_permalink( wc_get_page_id( 'shop' ) );
		} elseif ( is_product_category() ) {
			$link = get_term_link( get_query_var( 'product_cat' ), 'product_cat' );
		} elseif ( is_product_tag() ) {
			$link = get_term_link( get_query_var( 'product_tag' ), 'product_tag' );
		} elseif ( get_queried_object() ) {
			$queried_object = get_queried_object();

			if ( property_exists( $queried_object, 'taxonomy' ) ) {
				$link = get_term_link( $queried_object->slug, $queried_object->taxonomy );
			}
		}

		if ( $keep_query ) {

			//  Min/Max
			if ( isset( $_GET['min_price'] ) ) {
				$link = add_query_arg( 'min_price', wc_clean( $_GET['min_price'] ), $link );
			}

			if ( isset( $_GET['max_price'] ) ) {
				$link = add_query_arg( 'max_price', wc_clean( $_GET['max_price'] ), $link );
			}

			//  Orderby
			if ( isset( $_GET['orderby'] ) ) {
				$link = add_query_arg( 'orderby', wc_clean( $_GET['orderby'] ), $link );
			}

			if ( isset( $_GET['stock_status'] ) ) {
				$link = add_query_arg( 'stock_status', wc_clean( $_GET['stock_status'] ), $link );
			}

            if ( isset( $_GET['product_brand'] ) ) {
				$link = add_query_arg( 'product_brand', wc_clean( $_GET['product_brand'] ), $link );
			}

            if ( isset( $_GET['dprod_cat'] ) ) {
				$link = add_query_arg( 'dprod_cat', wc_clean( $_GET['dprod_cat'] ), $link );
			}

			if ( isset( $_GET['per_row'] ) ) {
				$link = add_query_arg( 'per_row', wc_clean( $_GET['per_row'] ), $link );
			}

			if ( isset( $_GET['per_page'] ) ) {
				$link = add_query_arg( 'per_page', wc_clean( $_GET['per_page'] ), $link );
			}

			if ( isset( $_GET['shop_view'] ) ) {
				$link = add_query_arg( 'shop_view', wc_clean( $_GET['shop_view'] ), $link );
			}

			if ( isset( $_GET['shortcode'] ) ) {
				$link = add_query_arg( 'shortcode', wc_clean( $_GET['shortcode'] ), $link );
			}

			/**
			 * Search Arg.
			 * To support quote characters, first they are decoded from &quot; entities, then URL encoded.
			 */
			if ( get_search_query() ) {
				$link = add_query_arg( 's', rawurlencode( wp_specialchars_decode( get_search_query() ) ), $link );
			}

			//  Post Type Arg
			if ( isset( $_GET['post_type'] ) ) {
				$link = add_query_arg( 'post_type', wc_clean( wp_unslash( $_GET['post_type'] ) ), $link );

				//  Prevent post type and page id when pretty permalinks are disabled.
				if ( is_shop() ) {
					$link = remove_query_arg( 'page_id', $link );
				}
			}

			//  Min Rating Arg
			if ( isset( $_GET['min_rating'] ) ) {
				$link = add_query_arg( 'min_rating', wc_clean( $_GET['min_rating'] ), $link );
			}

			//  All current filters
			if ( $_chosen_attributes = WC_Query::get_layered_nav_chosen_attributes() ) {
				foreach ( $_chosen_attributes as $name => $data ) {
					if ( $name === $taxonomy ) {
						continue;
					}
					$filter_name = sanitize_title( str_replace( 'pa_', '', $name ) );
					if ( ! empty( $data['terms'] ) ) {
						$link = add_query_arg( 'filter_' . $filter_name, implode( ',', $data['terms'] ), $link );
					}
					if ( 'or' == $data['query_type'] ) {
						$link = add_query_arg( 'query_type_' . $filter_name, 'or', $link );
					}
				}
			}
		}

		$link = apply_filters( 'dina_shop_page_link', $link, $keep_query, $taxonomy );

		if ( is_string( $link ) ) {
			return $link;
		} else {
			return '';
		}
	}
}

// Dina shop filter query
add_action( 'woocommerce_product_query', 'dina_shop_filter_query' );
if ( ! function_exists( 'dina_shop_filter_query' ) ) {
    function dina_shop_filter_query( $q ) {
    if ( ( ( is_woocommerce() && is_archive() ) || is_shop() ) ) {
    
        $current_stock_status = isset( $_GET['stock_status'] ) ? explode( ',', $_GET['stock_status'] ) : array();
        $product_brand        = isset( $_GET['product_brand'] ) ? explode( ',', $_GET['product_brand'] ) : array();
            
            if ( in_array( 'onsale', $current_stock_status ) ) {
                $product_ids_on_sale = wc_get_product_ids_on_sale();
                $q->set( 'post__in', $product_ids_on_sale );
            }

            if ( in_array( 'instock', $current_stock_status ) ) {
                $query_array = array(
                    'relation' => 'AND',
                    array(
                        'key' => '_stock_status',
                        'value' => 'instock',
                        'compare' => '=',
                    )
                );
                $q->set( 'meta_query', $query_array );
            }

            if ( in_array( 'nocall', $current_stock_status ) ) {
                $query_array = array(
                    'relation' => 'AND',
                    array(
                        'key'     => '_price',
                        'value'   => 0,
                        'type'    => 'numeric',
                        'compare' => '>'
                    ),
                    array(
                        'key'     => 'dina_coming',
                        'value'   => 'on',
                        'compare' => 'NOT EXISTS',
                    ),
                    array(
                        'key'     => '_stock_status',
                        'value'   => 'instock',
                        'compare' => '=',
                    )
                );
                $q->set( 'meta_query', $query_array );
            }

            if ( ! empty( $product_brand ) ) {
                $tax_query = array(
                    'relation' => 'AND',
                    array(
                        'taxonomy' => dina_opt( 'product_brand_taxonomy' ),
                        'field'    => 'term_id',
                        'terms'    => $product_brand,
                    )
                );
                $q->set( 'tax_query', $tax_query );
            }
        }
    }
}

// Set template of Cart & Checkout pages
if ( dina_opt( 'show_checkout_steps' ) ) {
    add_filter( 'page_template', 'dina_cart_checkout_page_template' );
}
function dina_cart_checkout_page_template( $page_template ) {
    if ( is_cart() || is_checkout() ) {
        $page_template = DI_DIR . '/tpls/cart.php';
    }
    return $page_template;
}

// Dina Checkout Steps
add_action( 'dina_before_cart_check', 'dina_checkout_steps', 10 );
if ( ! function_exists( 'dina_checkout_steps' ) ) {
	function dina_checkout_steps() {
		?>

        <div class="dina-checkout-steps shadow-box">
            <div class="row d-flex justify-content-center">
                <div class="progressbar-con col-12">
                    <ul id="progressbar" class="text-center">
                        <li class="active step dina-step-cart"></li>
                        <li class="<?php echo ( is_checkout() ) ? 'active ' : ''; ?>step dina-step-checkout"></li>
                        <li class="<?php echo ( is_checkout() && is_order_received_page() ) ? 'active ' : ''; ?>step dina-step-complete"></li>
                    </ul>
                </div>
            </div>
            <div class="row justify-content-between">
                <div class="col d-flex justify-content-center">
                    <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php _e( 'Shopping cart', 'dina-kala' ); ?>">
                        <?php _e( '1. Shopping cart', 'dina-kala' ); ?>
                    </a>
                </div>
                <div class="col d-flex justify-content-center">
                    <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" title="<?php _e( 'Checkout', 'dina-kala' ); ?>">
                        <?php _e( '2. Checkout', 'dina-kala' ); ?>
                    </a>
                </div>
                <div class="col d-flex justify-content-center">
                    <?php _e( '3. Order complete', 'dina-kala' ); ?>
                </div>
            </div>
        </div>
    

		<?php
	}
}

// Dina track product views.
add_action( 'template_redirect', 'dina_track_product_view', 20 );
if ( ! function_exists( 'dina_track_product_view' ) ) {
    function dina_track_product_view() {
        if ( ! is_singular( 'product' ) ) {
            return;
        }

        global $post;

        if ( empty( $_COOKIE['dina_recently_viewed'] ) ) {
            $viewed_products = array();
        } else {
            $viewed_products = wp_parse_id_list( (array) explode( '|', wp_unslash( $_COOKIE['dina_recently_viewed'] ) ) );
        }

        //  Unset if already in viewed products list.
        $keys = array_flip( $viewed_products );

        if ( isset( $keys[ $post->ID ] ) ) {
            unset( $viewed_products[ $keys[ $post->ID ] ] );
        }

        $viewed_products[] = $post->ID;

        if ( count( $viewed_products ) > 15 ) {
            array_shift( $viewed_products );
        }

        //  Store for session only.
        wc_setcookie( 'dina_recently_viewed', implode( '|', $viewed_products ) );
    }
}

// dina_scheduled_sale_products
function dina_scheduled_sale_products( $no_of_items=10,$app_ver='' ) {

    global $wpdb, $woocommerce;

    $productdata = array();

    $qur = "SELECT posts.ID, posts.post_parent
    FROM $wpdb->posts posts
    INNER JOIN $wpdb->postmeta ON (posts.ID = $wpdb->postmeta.post_id)
    INNER JOIN $wpdb->postmeta AS mt1 ON (posts.ID = mt1.post_id)
    INNER JOIN $wpdb->postmeta AS mt2 ON (posts.ID = mt2.post_id)
    WHERE
        posts.post_status = 'publish'
        AND  (mt1.meta_key = '_sale_price_dates_to' AND mt1.meta_value >= ".time().")
        AND (mt2.meta_key = '_sale_price_dates_from' AND mt2.meta_value <= ".time().")
        GROUP BY posts.ID
        ORDER BY rand()";

    $product_ids_raw = $wpdb->get_results( $qur );

    $product_ids_on_sale = array();


    foreach ( $product_ids_raw as $product_raw )
    {
        if ( ! empty( $product_raw->post_parent))
        {
            $product_ids_on_sale[] = $product_raw->post_parent;
        }
        else
        {
            $product_ids_on_sale[] = $product_raw->ID;
        }
    }
    $product_ids_on_sale = array_unique( $product_ids_on_sale);

    return $product_ids_on_sale;
}

// dina_archive_add_cart
function dina_archive_add_cart() {
    global $product;

    if ( ! $product->is_purchasable() ) {
        return;
    }

    if ( $product->is_in_stock() ) {  ?>
    
	<div class="dina-add-cart-archive<?php echo  dina_opt( 'show_hover_btns_fixed' ) ? ' btn-buy-fixed' : ''; echo  dina_opt( 'hover_btns_fixed_mobile' ) ? ' btn-buy-fixed-mobile' : ''; ?>">

		<?php
		woocommerce_quantity_input(
			array(
				'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
				'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
				'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), //  WPCS: CSRF ok, input var ok.
			)
		);

        echo apply_filters(
            'woocommerce_loop_add_to_cart_link', //  WPCS: XSS ok.
            sprintf(
                '<a href="%s" data-quantity="%s" class="%s" %s><span>%s</span></a>',
                esc_url( $product->add_to_cart_url() ),
                esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
                esc_attr( implode( ' ', array_filter( array(
                    'btn', 'btn-success', 'btn-buy', 'button', 'product_type_' . $product->get_type(),
                    $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
                    $product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '',
                ) ) ) ),
                wc_implode_html_attributes( array(
                    'data-product_id'  => $product->get_id(),
                    'data-product_sku' => $product->get_sku(),
                    'aria-label'       => $product->add_to_cart_description(),
                    'rel'              => 'nofollow',
                ) ),
                esc_html( $product->add_to_cart_text() )
            ),
            $product
        );
        ?>

	</div>

<?php }
}

// remove brand name from breadcrumb
add_filter( 'woocommerce_get_breadcrumb', 'dina_remove_shop_crumb', 20, 2);
function dina_remove_shop_crumb( $crumbs, $breadcrumb)
{
    $new_crumbs = array();
    foreach ( $crumbs as $key => $crumb) {
        if ( $crumb[0] !== 'برند' && $crumb[0] !== 'brand' ) {
            $new_crumbs[] = $crumb;
        }
    }
    return $new_crumbs;
}

// dina_cross_sells_product_no
add_filter( 'woocommerce_cross_sells_total', 'dina_cross_sells_product_no' );
function dina_cross_sells_product_no( $columns ) {
    return dina_opt( 'cross_sells_count' );
}

// woocommerce_is_sold_individually
if ( dina_opt( 'product_sold_individually' ) ) {
    add_filter( 'woocommerce_is_sold_individually', '__return_true' );
}

// Group Downloadable products by product ID
function dina_group_downloadable_products( array $downloads ) {

    if ( dina_opt( 'remove_myacc_hooks' ) )
        return $downloads;

    $unique_downloads = [];

    foreach ( $downloads as $download ) {
        $list = [
            'download_url' => $download['download_url'],
            'file_name'    => $download['file']['name']
        ];

        if ( array_key_exists( $download['product_id'], $unique_downloads ) ) {
            $unique_downloads[ $download['product_id'] ]['list'][] = $list;
            continue;
        }

        $data = $download;
        $data['list'] = [ $list ];
        $unique_downloads[ $download['product_id'] ] = $data;
    }

    return $unique_downloads;
}
if ( dina_opt( 'woo_ac_downloads' ) ) {
    add_filter( 'woocommerce_customer_get_downloadable_products', 'dina_group_downloadable_products' );
}

// dina_remove_extra_field_physical
add_filter( 'woocommerce_checkout_fields', 'dina_remove_extra_field_physical' );
function dina_remove_extra_field_physical( $fields ) {
    if ( ! dina_opt( 'remove_extra_fields' ) )
        return $fields;
    $only_virtual = true;
    foreach( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
        //  Check if there are non-virtual products
        if ( ! $cart_item['data']->is_virtual() ) $only_virtual = false;
    }
    if ( $only_virtual ) {
        unset($fields['billing']['billing_company']);
        unset($fields['billing']['billing_address_1']);
        unset($fields['billing']['billing_address_2']);
        unset($fields['billing']['billing_city']);
        unset($fields['billing']['billing_postcode']);
        unset($fields['billing']['billing_country']);
        unset($fields['billing']['billing_state']);
        add_filter( 'woocommerce_enable_order_notes_field', '__return_false' );
    }
    return $fields;
}

// dina remaining to Free Shipping
add_action( 'woocommerce_before_cart', 'dina_free_shipping_cart_msg' );
function dina_free_shipping_cart_msg() {
    
    if ( ! dina_opt( 'free_shipping_msg' ) || ! dina_opt( 'free_shipping_msg_cart' ) )
        return false;

    $min_amount = dina_opt( 'free_shipping_amount' );
    $current    = WC()->cart->get_cart_contents_total();

    if ( $current < $min_amount ) {
        $added_text = sprintf( __( 'Add %s to cart and get free shipping!', 'dina-kala' ), wc_price( $min_amount - $current ) );
        $return_to  = wc_get_page_permalink( 'shop' );
        $notice     = sprintf( '<a href="%s" class="button wc-forward">%s</a> %s', esc_url( $return_to ), __( 'Continue Shopping', 'dina-kala' ), $added_text );
        wc_print_notice( $notice, 'notice' );
    } elseif ( esc_attr( dina_opt( 'shipping_is_free_msg' ) ) && $current >= $min_amount ) {
        $notice = __( 'Shipping cost for this order is free!', 'dina-kala' );
        wc_print_notice( $notice, 'success' );
    }

}

add_action( 'woocommerce_before_mini_cart_contents', 'dina_free_shipping_mini_cart_msg' );
function dina_free_shipping_mini_cart_msg() {

    if ( ! dina_opt( 'free_shipping_msg' ) || ! dina_opt( 'free_shipping_msg_mini_cart' ) )
        return false;

    $min_amount = dinafa_digits( dina_opt( 'free_shipping_amount' ) );
    $current    = WC()->cart->get_cart_contents_total();

    if ( $current < $min_amount ) {
        $added_text = sprintf( __( 'Add %s to cart and get free shipping!', 'dina-kala' ), wc_price( $min_amount - $current ) );
        ?>

        <div class="dina-mini-cart-msg-con">
            <div class="alert <?php echo esc_attr( dina_opt( 'free_shipping_mini_cart_color' ) ); ?> dina-mini-cart-msg">
                <?php echo $added_text; ?>
                <?php if ( dina_opt( 'free_shipping_mini_cart_progress' ) ) { ?>
                <div class="dina-mini-cart-progress progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated <?php echo esc_attr( dina_opt( 'free_shipping_mini_cart_progress_color' ) ); ?>" role="progressbar" style="width: <?php echo esc_attr( dina_perc_of_num( $current, $min_amount, false ) ); ?>%" aria-valuenow="<?php echo esc_attr( $current ); ?>" aria-valuemin="0" aria-valuemax="<?php echo esc_attr( $min_amount ); ?>"></div>
                </div>
                <?php } ?>
            </div>
        </div>

        <?php
    } elseif ( dina_opt( 'shipping_is_free_msg' ) && $current >= $min_amount ) {
        $notice = __( 'Shipping cost for this order is free!', 'dina-kala' );
        ?>
        <div class="dina-mini-cart-msg-con">
            <div class="alert alert-success dina-mini-cart-msg">
                <i class="fal fa-shipping-fast"></i>
                <?php echo esc_html( $notice ); ?>
            </div>
        </div>
        <?php
    }
}

// Hide shipping rates when free shipping is available.
add_filter( 'woocommerce_package_rates', 'dina_hide_shipping_when_free_is_available', 100 );
function dina_hide_shipping_when_free_is_available( $rates ) {

    if ( ! dina_opt( 'show_only_free_shipping' ) )
        return $rates;

	$free = array();
	foreach ( $rates as $rate_id => $rate ) {
		if ( 'free_shipping' === $rate->method_id ) {
			$free[ $rate_id ] = $rate;
			break;
		}
	}
	return ! empty( $free ) ? $free : $rates;
}



add_filter( 'woocommerce_available_payment_gateways', 'dina_conditional_cod_payment', 20, 1 );
function dina_conditional_cod_payment( $available_gateways ) {

    if( is_admin() || ! dina_opt( 'cod_payment_condition' ) ) 
        return $available_gateways;

    $condition  = dina_opt( 'cod_payment_amount' );
    $amount_min = (int)dina_opt( 'cod_amount_min' );
    $amount_max = (int)dina_opt( 'cod_amount_max' );
    $subtotal   = WC()->cart->get_cart_contents_total();

    if ( ( $condition == 'min' && $subtotal >= $amount_min ) || ( $condition == 'max' && $subtotal <= $amount_max ) || ( $condition == 'min-max' && ( $subtotal >= $amount_min && $subtotal <= $amount_max ) ) ) {
        return $available_gateways;
    } else {
        unset( $available_gateways['cod'] );
    }

    return $available_gateways;
}

// Trim zeros in price decimals
if ( dina_opt( 'price_trim_zeros' ) ) {
    add_filter( 'woocommerce_price_trim_zeros', '__return_true' );
}

// dina_zero_call_text
function dina_free_call_text( $product_id ) {
    $price = dina_is_call( $product_id ) ? dina_opt( 'zero_call_text' ) : dina_opt( 'free_price_text' );
    $price = '<span class="woocommerce-Price-amount amount dina-free-price">'. $price .'</span>';
    return $price;
}

// dina_zero_call_text
function dina_outofstock_text() {
    $text = ! empty( dina_opt( 'outofstock_text' ) ) ? dina_opt( 'outofstock_text' ) : __( 'Out of stock', 'dina-kala' );
    return $text;
}

// dina_change_outofstock text
add_filter( 'woocommerce_get_availability_text', 'dina_change_outofstock', 10, 2 );
function dina_change_outofstock ( $text, $product) {
    if ( ! $product->is_in_stock() ) {
        $text = ! empty( dina_opt( 'outofstock_text' ) ) ? dina_opt( 'outofstock_text' ) : __( 'Out of stock', 'dina-kala' );
    }
    return $text;
}

// dina_override_checkout_fields
add_filter( 'woocommerce_checkout_fields' , 'dina_override_checkout_fields', 9999, 1 );
function dina_override_checkout_fields( $fields ) {

    if ( dina_opt( 'remove_note_field'))
        add_filter( 'woocommerce_enable_order_notes_field', '__return_false' );

    if ( dina_opt( 'optional_email_field' ) )
        $fields['billing']['billing_email']['required'] = false;

    if ( dina_opt( 'remove_email_field' ) ) {
        $fields['billing']['billing_email']['required'] = false;
        unset( $fields['billing']['billing_email'] );
    }

    if ( dina_opt( 'optional_postal_code_field' ) ) {
        unset( $fields['billing']['billing_postcode']['validate'] );
        unset( $fields['shipping']['shipping_postcode']['validate'] );
        $fields['billing']['billing_postcode']['required'] = false;
        $fields['shipping']['shipping_postcode']['required'] = false;
    }

    if ( dina_opt( 'remove_postal_code_field' ) ) {
        $fields['billing']['billing_postcode']['required'] = false;
        $fields['shipping']['shipping_postcode']['required'] = false;
        unset( $fields['billing']['billing_postcode']['validate'] );
        unset( $fields['shipping']['shipping_postcode']['validate'] );
        unset( $fields['billing']['billing_postcode'] );
        unset( $fields['shipping']['shipping_postcode'] );
    }

    if ( dina_opt( 'optional_phone_field' ) ) {
        $fields['billing']['billing_phone']['required'] = false;
        unset( $fields['billing']['billing_phone']['validate'] );
    }

    if ( dina_opt( 'remove_phone_field' ) ) {
        $fields['billing']['billing_phone']['required'] = false;
        unset( $fields['billing']['billing_phone']['validate'] );
        unset( $fields['billing']['billing_phone'] );
    }

    if ( dina_opt( 'remove_address_two') ) {
        unset ( $fields['billing']['billing_address_2'] );
        unset ( $fields['shipping']['shipping_address_2'] );
    }

    if ( dina_opt( 'remove_company') ) {
        unset ( $fields['billing']['billing_company'] );
        unset ( $fields['shipping']['billing_company'] );
    }

    return $fields;
}

// dina_override_address_fields
add_filter( 'woocommerce_default_address_fields' , 'dina_override_address_fields', 999, 1 );
function dina_override_address_fields( $fields ) {

    if ( dina_opt( 'change_address_label') )
        $fields['address_1']['label'] = dina_opt( 'address_label' );

    if ( dina_opt( 'optional_postal_code_field' ) || dina_opt( 'remove_postal_code_field' ) )
        $fields['postcode']['required'] = false;

    if ( ! dina_opt( 'override_address_fields') )
        return $fields;
    
	$persian_sort = array( 1 => 'country', 'state', 'city', 'address_1', 'address_2', 'postcode' );
	
	foreach( $fields as $key => $field ) {
		
		if( ! in_array( $key, $persian_sort ) ) {
			$fields[ $key ][ 'persian_sort' ] = 0;
		} else {
			$fields[ $key ][ 'persian_sort' ] = array_search( $key, $persian_sort );
		}
		
	}
		
	uasort( $fields, function( $val1, $val2 ) use( $persian_sort ) {
		
		if( $val1[ 'persian_sort' ] == 0 || $val2[ 'persian_sort' ] == 0 ) {
			return 0;
		}
		
		return $val1[ 'persian_sort' ] > $val2[ 'persian_sort' ] ? 1 : -1;
	} );
	
	$i = 10;
	
	foreach( $fields as $key => $field ) {
		$fields[ $key ][ 'priority' ] = $i;
		$i += 10;
	}
	
	return $fields;
}

// dina_validate_billing_phone
add_action( 'woocommerce_after_checkout_validation', 'dina_validate_billing_phone', 10, 2 );
function dina_validate_billing_phone( $fields, $errors ) {
    if ( dina_opt( 'validate_phone_field' ) ) {
        $phone = isset( $_POST['billing_phone'] ) ? trim( $_POST['billing_phone'] ) : '';
        if ( ! preg_match( '/^09\d{9}$/', $phone ) ) {
            $errors->add( 'validation', __( 'Please enter a valid mobile number. The number must be 11 digits and start with 09.', 'dina-kala' ) );
        }
    }
}

// dina_woocommerce_date_format
add_filter( 'woocommerce_date_format', 'dina_woocommerce_date_format', 10, 2 );
function dina_woocommerce_date_format() {
   return 'j F Y';
}

// Dina Product Price Status
function dina_price_status( $id ) {
    $product = wc_get_product( $id );
    $coming = get_post_meta( $product->get_id(), 'dina_coming', true );
    if ( $coming ) {
        return 'dina-coming-product';
    } elseif ( ! $product->is_in_stock() ) {
        return 'dina-out-of-stock-product';
    } elseif ( '' === $product->get_price() || 0 == $product->get_price() ) {
        return 'dina-free-product';
    } else {
        return;
    }
}

// dina_custom_placeholder_img
add_filter( 'woocommerce_placeholder_img_src','dina_custom_placeholder_img' );
function dina_custom_placeholder_img( $src ) {
    $src = dina_to_https( dina_opt( 'prod_default_thumb', 'url' ) );
    return $src;
}

// Add classes for filter widgets
add_filter( 'dynamic_sidebar_params', 'dina_add_filter_widget_classes' );
function dina_add_filter_widget_classes( $params ) {

    $widgets = array( 
        'dina_brand_filter_widget'  => 'widget_dina_brand_filter_widget',
        'dina_onsale_stock_widget'  => 'widget_dina_onsale_stock_widget',
        'woocommerce_price_filter'  => 'widget_price_filter',
        'woocommerce_layered_nav'   => 'woocommerce-widget-layered-nav',
        'woocommerce_rating_filter' => 'widget_rating_filter'
    );

    foreach ( $widgets as $key => $value ) {
        if ( str_contains( $params[0]['widget_id'], $key) ) {
            $params[0] = array_replace( $params[0], array( 'before_widget' => str_replace( $value, $value . ' dina-filter-widget' , $params[0]['before_widget'] ) ) );
        }
    }

    return $params;
}

// dina_cart_amount
function dina_cart_amount() {
    return is_object( WC()->cart ) ? WC()->cart->get_cart_contents_count() : '0';
}

// if the user is not logged in, return him to login before checkout
add_action( 'template_redirect', 'dina_redirect_checkout_login' );
function dina_redirect_checkout_login() {
    if ( ! dina_opt( 'redirect_checkout_login' ) )
        return;

    if ( ! is_user_logged_in() && is_checkout() ) {
        if ( dina_opt( 'digits_mode' ) && function_exists( 'digits_version' ) ) {
            $url = wc_get_checkout_url() . '/?login=true&back=home';
        } elseif ( dina_opt( 'ch_login_link' ) ) {
            $url = dina_opt( 'login_link' );
        } else {
            $url = add_query_arg(
                'redirect_to',
                urlencode( wc_get_checkout_url() ),
                wc_get_page_permalink( 'myaccount' )
            );
        }
        wp_safe_redirect( $url );
        exit;
    }
}

// Check Product Call Mode
function dina_is_call( $product_id ) {

    $is_call_mode = false;
    $product      = wc_get_product( $product_id );

    if ( $product->is_type( 'simple' ) || is_a( $product, 'WC_Product_Variation' ) ) {
        $call_mode = get_post_meta( $product_id, 'dina_call_mode', true );
        if ( ( dina_opt( 'show_zero_call' ) && ( '' === $product->get_price() || 0 == $product->get_price() ) ) || $call_mode )
            $is_call_mode = true;
    } 
    
    return $is_call_mode;
}

// dina_variable_min_max_id
function dina_variable_min_max_id( $product_id, $type = 'min' ) {

    $product = wc_get_product( $product_id );

    if ( $product && $product->is_type( 'variable' ) ) {
        $available_variations = $product->get_available_variations();
        $price                = null;
        $price_variation_id   = null;

        foreach ( $available_variations as $variation ) {
            $variation_obj = wc_get_product( $variation['variation_id'] );

            if ( ( $variation_obj->is_in_stock() && $variation_obj->get_regular_price() != '' && $variation_obj->get_regular_price() != 0 ) || dina_opt( 'show_price_out' ) ) {

                $variation_price = $variation_obj->get_sale_price() ? $variation_obj->get_sale_price() : $variation_obj->get_regular_price();

                if ( is_null( $price ) || 
                    ( $type === 'min' && $variation_price < $price ) || 
                    ( $type === 'max' && $variation_price > $price ) ) {
                    $price = $variation_price;
                    $price_variation_id = $variation_obj->get_id();
                }
            }
        }

        return $price_variation_id;
    }

    return null;
}

// dina_get_default_variation_id
function dina_get_default_variation_id( $product_id ) {

    $product = wc_get_product( $product_id );
    
    if ( $product && $product->is_type( 'variable' ) ) {

        $default_attributes   = $product->get_default_attributes();
        $available_variations = $product->get_available_variations();
        
        foreach ( $available_variations as $variation ) {
            $match = true;
            foreach ( $default_attributes as $attribute => $value ) {

                if ( $variation['attributes']['attribute_' . $attribute] != $value ) {
                    $match = false;
                    break;
                }
            }

            if ( $match ) {
                $variation_product = wc_get_product( $variation['variation_id'] );
                if ( $variation_product->is_in_stock() && ! empty( $variation_product->get_regular_price() ) ) {
                    return $variation['variation_id'];
                }
            }
        }
    }
    
    return false;
}