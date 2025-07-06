<?php 

/**
 * Register new endpoint to use inside My Account page.
 *
 * @see https://developer.wordpress.org/reference/functions/add_rewrite_endpoint/
 */
function dina_tracking_endpoints() {
	add_rewrite_endpoint( 'order-tracking', EP_ROOT | EP_PAGES );
}

add_action( 'init', 'dina_tracking_endpoints' );

/**
 * Add new query var.
 *
 * @param array $vars
 * @return array
 */
function dina_tracking_query_vars( $vars ) {
	$vars[] = 'order-tracking';

	return $vars;
}

add_filter( 'query_vars', 'dina_tracking_query_vars', 0 );

/**
 * Flush rewrite rules on theme activation.
 */
function dina_tracking_flush_rewrite_rules() {
	add_rewrite_endpoint( 'order-tracking', EP_ROOT | EP_PAGES );
	flush_rewrite_rules();
}

add_action( 'after_switch_theme', 'dina_tracking_flush_rewrite_rules' );

/**
 * Insert the new endpoint into the My Account menu.
 *
 * @param array $items
 * @return array
 */
function dina_tracking_my_account_menu_items( $items ) {
	// Remove the logout menu item.
	$logout = $items['customer-logout'];
	unset( $items['customer-logout'] );

	// Insert your custom endpoint.
	$items['order-tracking'] = __( 'Order Tracking', 'dina-kala' );

	// Insert back the logout item.
	$items['customer-logout'] = $logout;

	return $items;
}

add_filter( 'woocommerce_account_menu_items', 'dina_tracking_my_account_menu_items' );

/**
 * Endpoint HTML content.
 */
function dina_tracking_endpoint_content() {
	echo do_shortcode( '[woocommerce_order_tracking]' );
}

add_action( 'woocommerce_account_order-tracking_endpoint', 'dina_tracking_endpoint_content' );

/*
 * Change endpoint title.
 *
 * @param string $title
 * @return string
 */
function dina_tracking_endpoint_title( $title ) {
	global $wp_query;

	$is_endpoint = isset( $wp_query->query_vars['order-tracking'] );

	if ( $is_endpoint && ! is_admin() && is_main_query() && in_the_loop() && is_account_page() ) {
		// New page title.
		$title = __( 'Order Tracking', 'dina-kala' );

		remove_filter( 'the_title', 'dina_tracking_endpoint_title' );
	}

	return $title;
}

add_filter( 'the_title', 'dina_tracking_endpoint_title' );