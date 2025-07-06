<?php
/**
 * JS for AJAX Add to Cart handling
 */
function dina_product_page_ajax_add_to_cart_js() {
	global $post;
	if ( ! is_object( $post) ) 
        return;
	
    if ( is_singular( 'product' ) ) {
		$_product = wc_get_product( $post->ID );
    	if ( $_product->is_type( 'external' ) ) {
			return;
		}
		wp_enqueue_script( 'dina-add-cart-ajax' );
    }
}
add_action( 'wp_footer', 'dina_product_page_ajax_add_to_cart_js', 10 );

/**
 * Add to cart handler.
 */
function dina_ajax_add_to_cart_handler() {
	WC_Form_Handler::add_to_cart_action();
	WC_AJAX::get_refreshed_fragments();
}
add_action( 'wc_ajax_dina_add_to_cart', 'dina_ajax_add_to_cart_handler' );
add_action( 'wc_ajax_nopriv_dina_add_to_cart', 'dina_ajax_add_to_cart_handler' );

// Remove WC Core add to cart handler to prevent double-add
remove_action( 'wp_loaded', array( 'WC_Form_Handler', 'add_to_cart_action' ), 20 );

/**
 * Add fragments for notices.
 */
function dina_ajax_add_to_cart_add_fragments( $fragments ) {
	$all_notices  = WC()->session->get( 'wc_notices', array() );
	$notice_types = apply_filters( 'woocommerce_notice_types', array( 'error', 'success', 'notice' ) );

	ob_start();
	foreach ( $notice_types as $notice_type ) {
		if ( wc_notice_count( $notice_type ) > 0 ) {
			wc_get_template( "notices/{$notice_type}.php", array(
				'notices' => array_filter( $all_notices[ $notice_type ] ),
			) );
		}
	}
	$fragments['notices_html'] = ob_get_clean();

	wc_clear_notices();

	return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'dina_ajax_add_to_cart_add_fragments' );