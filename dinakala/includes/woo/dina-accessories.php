<?php

//dina_product_accessories_admin_tab
add_filter( 'woocommerce_product_data_tabs', 'dina_product_accessories_admin_tab', 10, 1 );
function dina_product_accessories_admin_tab( $default_tabs ) {
    $default_tabs['dina_product_accessories'] = array(
        'label'    => esc_html__( 'Accessories (Dinakala)', 'dina-kala' ),
        'target'   => 'dina_product_accessories_admin_tab_data',
        'priority' => 60,
        'class'    => array()
    );
    return $default_tabs;
}

//dina_product_accessories_admin_tab_data
//\fe7f0b55ea269f297164af3d1fb::b309067cca8b018352f07f07bf83fabb();
add_action( 'woocommerce_product_data_panels', 'dina_product_accessories_admin_tab_data' );
function dina_product_accessories_admin_tab_data() {
    global $post;
    ?>
    <div id="dina_product_accessories_admin_tab_data" class="panel woocommerce_options_panel hidden">
        <div class="options_group">
            <div class="inline notice woocommerce-message" style="">
                <img class="info-icon" src="<?= DI_URI . '/images/info.svg' ?>">
                <p>
                    <?php _e( 'You can configure the settings of how to display product accessories from "Dashboard > Appearance > Theme Settings > Product Settings > Product Page > Product Accessories Settings".', 'dina-kala' ) ?>
                </p>
            </div>
            <p class="form-field">
                <label for="dina_accessories_ids"><?php esc_html_e( 'Product accessories', 'dina-kala' ); ?></label>
                <select class="wc-product-search" multiple="multiple" style="width: 50%;" id="dina_accessories_ids" name="dina_accessories_ids[]" data-placeholder="<?php esc_attr_e( 'Search for a product&hellip;', 'dina-kala' ); ?>" data-action="woocommerce_json_search_products_and_variations" data-exclude="<?php echo intval( $post->ID ); ?>">
                    <?php                
                    $product_ids = get_post_meta( intval( $post->ID ), 'dina_accessories_ids', true );
                    if ( ! empty ( $product_ids ) ) {
                        foreach ( $product_ids as $product_id ) {
                            $product = wc_get_product( $product_id );
                            if ( is_object( $product ) ) {
                                echo '<option value="' . esc_attr( $product_id ) . '"' . selected( true, true, false ) . '>' . esc_html( wp_strip_all_tags( $product->get_formatted_name() ) ) . '</option>';
                            }
                        }
                    }
                    ?>
                </select> 
                <?php echo wc_help_tip( __( 'You can choose product accessories from this section.', 'dina-kala' ) ); // WPCS: XSS ok. ?>
            </p>
        </div>
    </div>
    <?php
}

//dina_product_accessories_save
add_action( 'woocommerce_admin_process_product_object', 'dina_product_accessories_save', 10, 1 );
function dina_product_accessories_save( $product ){
    if( isset( $_POST['dina_accessories_ids'] ) ) {
        $product->update_meta_data( 'dina_accessories_ids', $_POST['dina_accessories_ids'] );
    } else {
        $product->update_meta_data( 'dina_accessories_ids', '' );
    }
}

//product_accessories_location
if ( dina_opt( 'product_accessories_location' ) == 'above-description' ) {
    add_action( 'woocommerce_after_single_product_summary', 'dina_product_accessories_display', 5 );
} else {
    add_filter( 'woocommerce_product_tabs', 'dina_product_accessories_tab' );
}

//dina_product_accessories_tab
function dina_product_accessories_tab( $tab ) {

    if ( dina_opt( 'product_accessories_style' ) == 'checkbox' )
        return $tab;
    
    $product_accessories = get_post_meta( get_the_ID(), 'dina_accessories_ids', true );

    if ( empty ( $product_accessories ) )
        return;

    $tab_title = dina_opt( 'product_accessories_title' );
    $tab_icon  = dina_opt( 'product_accessories_icon' );
    
    $tab_title = '<i class="dina-tab-icon '. $tab_icon .'"></i> '. $tab_title;

    $tab['dina_product_accessories'] = array(
        'title'    => $tab_title,
        'priority' => 20,
        'callback' => 'dina_product_accessories_display'
    );

    return $tab;
}

//dina_product_accessories_display
function dina_product_accessories_display() {

    if ( dina_opt( 'product_accessories_style' ) == 'checkbox' )
        return;
	
    global $product;

    // Get the product accessories meta
    if ( dina_opt( 'product_accessories_upsell' ) ) {
        $product_accessories = $product->get_upsell_ids();
    } else {
        $product_accessories = get_post_meta( $product->get_id(), 'dina_accessories_ids', true );
    }

    if ( empty ( $product_accessories ) )
        return;

    $product_sort = dina_opt( 'product_accessories_rand' ) ? 'rand' : 'date';

    $args = array(
        'post_type'           => array( 'product', 'product_variation' ),
		'posts_per_page'      => -1,
        'no_found_rows'       => 1,
        'orderby'             => $product_sort,
        'post__in'            => $product_accessories,
        'post__not_in'        => array( get_the_ID() ),
        'meta_query'          => array(
            'relation' => 'AND',
            array(
                'key'     => '_stock_status',
                'value'   => 'outofstock',
                'compare' => 'NOT IN'
            )
        )
    );

    $products = new WP_Query($args);

    if ( $products->have_posts() ) :

        if ( dina_opt( 'product_accessories_style' ) == 'table' ) {

            wp_enqueue_style( 'dina-table-loadmore' );
    ?>
        <div class="woocommerce dina-products-table dina-table-middle-title dina-accessories-table">
            
            <?php
            if ( ! empty ( dina_opt( 'product_accessories_title' ) ) ) {
                echo '<div class="dina-products-table-title">';
                    echo '<i class="'. dina_opt( 'product_accessories_icon' ) .'" aria-hidden="true"></i>';  
                    echo dina_opt( 'product_accessories_title' );
                echo '</div>';
            }
            ?>

            <div class="dina-products-table-con">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <?php if ( dina_opt( 'product_accessories_thumb' ) ) { ?>
                            <th class="dina-align-center"><?php _e( 'Image', 'dina-kala' ) ?></th>
                            <?php } ?>

                            <th><?php _e( 'Title', 'dina-kala' ) ?></th>

                            <?php if ( ! dina_opt( 'product_catalog_price_mode' ) ) {  ?>
                            <th class="dina-align-center"><?php _e( 'Price', 'dina-kala' ) ?></th>
                            <?php } ?>

                            <?php if ( dina_opt( 'product_accessories_quick' ) ) {  ?>
                            <th class="dina-align-center"><?php _e( 'Quick view', 'dina-kala' ) ?></th>
                            <?php } ?>

                            <?php if ( ! dina_opt( 'product_catalog_mode' ) ) {  ?>
                            <th class="dina-align-center"><?php _e( 'Add to cart', 'dina-kala' ) ?></th>
                            <?php } ?>
                        </tr>
                    </thead>

                    <tbody class="dina-products-table-tbody">

                    <?php
                    while ( $products->have_posts() ) : $products->the_post();
                        $product = wc_get_product( get_the_ID() );
                        if ( is_object( $product ) ) { ?>
                            <tr class="dina-product-table-item <?php echo dina_price_status( get_the_ID() ) ?>">

                            <?php if ( dina_opt( 'product_accessories_thumb' ) ) { ?>
                            <td class="dina-align-center">
                                <a href="<?php the_permalink(); ?>" target="<?php echo dina_link_target(); ?>" title="<?php the_title_attribute(); ?>">
                                <?php 
                                    if ( has_post_thumbnail() ) {
                                        the_post_thumbnail( 'thumbnail' );          
                                    } else {
                                        prod_default_thumb();
                                    }
                                ?>
                                </a>
                            </td>
                            <?php } ?>

                            <td>
                                <div class="dina-product-table-title">
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" target="<?php echo dina_link_target(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </div>
                            </td>

                            <?php if ( ! dina_opt( 'product_catalog_price_mode' ) ) { ?>
                            <td class="dina-align-center">
                                <div class="dina-product-table-price">
                                    <?php
                                    if ( $product->is_in_stock() ) { ?>
                                        <p class="<?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) ); ?>"><?php echo $product->get_price_html(); ?></p>
                                    <?php
                                    } else { ?>
                                        <span class="nstock">
                                            <?php echo dina_outofstock_text(); ?>
                                        </span>
                                    <?php } ?>
                                </div>
                            </td>
                            <?php } ?>

                            <?php if ( dina_opt( 'product_accessories_quick' ) ) { ?>
                            <td class="dina-align-center">
                                <div class="dina-product-table-quick-view">
                                    <span class="btn btn-outline-info dina-ptqv-btn quick-view-btn" data-toggle="tooltip" data-placement="top" title="<?php _e( 'Quick View', 'dina-kala' ); ?>" data-dina-product-id="<?php echo get_the_ID(); ?>">
                                        <i class="fal fa-eye" aria-hidden="true"></i>
                                    </span>
                                </div>
                            </td>
                            <?php } ?>

                            <?php if ( ! dina_opt( 'product_catalog_mode' ) ) { ?>
                            <td class="dina-align-center">
                                <div class="dina-product-table-add-cart mini-product">
                                <?php dina_add_to_cart( true ) ?>
                                </div>
                            </td>
                            <?php } ?>

                            </tr>
                        <?php
                        }
                    endwhile;
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php
        } else {
    ?>
    <div class="product-block<?php if ( dina_opt( 'prod_navs' ) == 'sttwo' ) { ?> nav-type-two<?php } ?> related dina-related-product dina-related-accessories block">
        <div class="block-title">
            <span class="block-title-con">
                <i class="<?php echo dina_opt( 'product_accessories_icon' ) ?>" aria-hidden="true"></i>
                <?php echo dina_opt( 'product_accessories_title' ) ?>
            </span>
        </div>

        <?php
            $carousel_options  = '';
            $carousel_options .= dina_opt( 'mobile_single_col' ) ? ' data-mcol="1"' : ' data-mcol="2"'; 
            $carousel_options .= dina_opt( 'accessories_show_arrows' ) ? ' data-itemnavs="true"' : ' data-itemnavs="false"'; 
            $carousel_options .= dina_opt( 'accessories_prod_loop' ) ? ' data-itemloop="true"' : ' data-itemloop="false"'; 
            $carousel_options .= dina_opt( 'accessories_auto_play' ) ? ' data-itemplay="true"' : ' data-itemplay="false"';
            $carousel_options .= ! empty ( dina_opt( 'accessories_pcount' ) ) ? ' data-itemscount="'. dina_opt( 'accessories_pcount' ) .'"' : ' data-itemscount="5"';
            $carousel_options .= ' data-dir="'. dina_rtl() .'"';
        ?>

        <div class="owl-carousel" <?php echo $carousel_options; ?>>
            <?php
            while ( $products->have_posts() ) : $products->the_post(); ?>
            <div class="item">
                <?php get_template_part( 'includes/content-product' ); ?>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
    <?php
        }
    endif;
    wp_reset_postdata();
}

// Add action to display accessories on the product page
if ( dina_opt( 'checkbox_accessories_location' ) == 'dina_before_price_con' && dina_opt( 'product_page_style' ) == 'sttwo' ) {
    $accessories_location = 'dina_after_single_meta';
} else {
    $accessories_location = dina_opt( 'checkbox_accessories_location' );
}

add_action( $accessories_location, 'dina_checkbox_product_accessories' );
function dina_checkbox_product_accessories() {
    
    if ( ! is_product() || ( dina_opt( 'product_accessories_style' ) != 'checkbox' ) )
        return;
    
    global $product;

    // Get the product accessories meta
    if ( dina_opt( 'product_accessories_upsell' ) ) {
        $product_accessories = $product->get_upsell_ids();
    } else {
        $product_accessories = get_post_meta( $product->get_id(), 'dina_accessories_ids', true );
    }

    if ( empty ( $product_accessories ) )
        return;

    $product_sort = dina_opt( 'product_accessories_rand' ) ? 'rand' : 'date';

    $args = array(
        'post_type'           => array( 'product', 'product_variation' ),
        'no_found_rows'       => 1,
		'posts_per_page'      => -1,
        'orderby'             => $product_sort,
        'post__in'            => $product_accessories,
        'post__not_in'        => array( get_the_ID() ),
        'meta_query'          => array(
            'relation' => 'AND',
            array(
                'key'     => '_stock_status',
                'value'   => 'outofstock',
                'compare' => 'NOT IN'
            )
        )
    );

    $accessories = new WP_Query($args);

    if ( $accessories->have_posts() ) :

        $icon = ! empty ( dina_opt( 'product_accessories_icon' ) ) ? '<i class="'. dina_opt( 'product_accessories_icon' ) .'" aria-hidden="true"></i>' : '';

        echo '<fieldset class="dina-product-accessories">';
        echo '<legend>'. $icon . dina_opt( 'product_accessories_title' ) .'</legend>';
        echo '<ul>';

        while ( $accessories->have_posts() ) : $accessories->the_post();
            $accessory = wc_get_product( get_the_ID() );
            if ( is_object( $product ) ) {
                if ( function_exists( 'wcmmq_get_product_limits' ) ) {
                    $product_limits = wcmmq_get_product_limits( get_the_ID() );
                    $min_quantity   = $product_limits['min_qty'];
                } else {
                    $min_quantity = $accessory->get_min_purchase_quantity();
                }
                
                echo '<li>';
                echo '<input type="checkbox" id="accessory-'. esc_attr( get_the_ID() ) .'" class="dina-accessory-checkbox" value="'. esc_attr( get_the_ID() ) .'" data-min-quantity="' . esc_attr( $min_quantity ) . '" />';
                echo '<label for="accessory-'. esc_attr( get_the_ID() ) .'">'. esc_html( get_the_title() );
                if ( dina_opt( 'checkbox_accessories_link' ) ) {
                    echo ' (<a href="'. esc_url( get_the_permalink() ) .'" target="_blank" title="'. esc_html( get_the_title() ) .'" class="dina-accessory-checkbox-link">'. __( 'View product', 'dina-kala' ) .'</a>)';
                }
                echo ' - '. wc_price( $accessory->get_price() );
                echo '</label>';
                echo '</li>';
            }
        endwhile;

        echo '</ul>';
        echo '</fieldset>';
    
    endif;
    wp_reset_postdata();
}

// Enqueue custom script and style for accessories
add_action('wp_enqueue_scripts', 'dina_enqueue_accessory_scripts');
function dina_enqueue_accessory_scripts() {

    if ( ! is_product() || ( dina_opt( 'product_accessories_style' ) != 'checkbox' ) )
        return;

        wp_enqueue_script('dina-accessory-script', get_template_directory_uri() . '/js/dina-accessory.js', array('jquery'), null, true);

        // Enqueue WooCommerce cart fragments script
        wp_enqueue_script('wc-cart-fragments');

        // Localize script to pass AJAX URL
        wp_localize_script('dina-accessory-script', 'dina_accessory_params', array(
            'ajax_url' => admin_url('admin-ajax.php')
        ));
}

// AJAX handler to remove product from cart
add_action('wp_ajax_dina_remove_from_cart', 'dina_remove_from_cart');
add_action('wp_ajax_nopriv_dina_remove_from_cart', 'dina_remove_from_cart');
function dina_remove_from_cart() {
    $product_id = intval($_POST['productid']);
    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
        if ($cart_item['product_id'] == $product_id) {
            WC()->cart->remove_cart_item($cart_item_key);
            break;
        }
    }
    wp_send_json_success();
}