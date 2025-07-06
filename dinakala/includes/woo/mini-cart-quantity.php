<?php

//dina_mini_cart_scripts
add_action( 'wp_enqueue_scripts', 'dina_mini_cart_scripts' );
function dina_mini_cart_scripts() {
    wp_enqueue_script( 'dina-mini-cart-ajax', DI_URI . '/js/mini-cart.js', array('jquery'), DI_VER, true );
    wp_localize_script( 'dina-mini-cart-ajax', 'dina_mini_cart_ajax_object', array(
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'nonce'    => wp_create_nonce( 'dina-mini-cart-nonce' ),
        ) 
    );
}

//dina_mini_qty_update
add_action( 'wp_ajax_dina_mini_qty_update', 'dina_mini_qty_update' );
add_action( 'wp_ajax_nopriv_dina_mini_qty_update', 'dina_mini_qty_update' );
function dina_mini_qty_update() {
    $key    = sanitize_text_field( $_POST['key'] );
    $number = intval( sanitize_text_field( $_POST['number'] ) );

    $cart = [
        'count'      => 0,
        'total'      => 0,
        'item_price' => 0,
        'item_count' => 0,
    ];

    if ( $key && $number > 0 && wp_verify_nonce( $_POST['security'], 'dina-mini-cart-nonce' ) ) {
        WC()->cart->set_quantity( $key, $number );
        $items              = WC()->cart->get_cart();
        $cart               = [];
        $cart['count']      = WC()->cart->cart_contents_count;
        $cart['total']      = WC()->cart->get_cart_total();
        $cart['item_price'] = wc_price( $items[$key]['line_total'] );
        $cart['item_count'] = $number . ' &times;';
    }

    echo json_encode( $cart );
    wp_die();
}