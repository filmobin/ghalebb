<?php

// Check the validity of an Iranian national code
function dina_check_national_code( $code ) {
    // Check if the input code is a 10-digit number
    if ( ! preg_match( '/^[0-9]{10}$/', $code ) ) {
        return false;
    }

    // Check for repetitive patterns like "0000000000"
    for ( $i = 0; $i < 10; $i++ ) {
        if ( preg_match('/^'.$i.'{10}$/', $code ) ) {
            return false;
        }
    }

    // Calculate the sum based on the algorithm
    for ( $i = 0, $sum = 0; $i < 9; $i++ ) {
        $sum += ( ( 10 - $i ) * intval( substr($code, $i, 1 ) ) );
    }

    // Validate the code using modulus operation
    $ret    = $sum % 11;
    $parity = intval( substr( $code, 9, 1 ) );

    if ( ( $ret < 2 && $ret == $parity ) || ( $ret >= 2 && $ret == 11 - $parity ) ) {
        return true;
    }

    return false;
}

//Add custom national code field to WooCommerce payment page
add_filter( 'woocommerce_checkout_fields' , 'dina_checkout_national_code_field' );
function dina_checkout_national_code_field( $fields ) {
    $required = dina_opt( 'optional_national_code_field' ) ? false : true;
    $fields['billing']['billing_national_code'] = array(
        'label'       => __('National code', 'dina-kala' ),
        'required'    => $required,
        'class'       => array( 'form-row','form-row-wide','woocommerce-additional-fields__field-wrapper' ),
        'clear'       => true,
        'priority'    => 25,
    );
    return $fields;
}

// Validate custom national code field during checkout process
add_action( 'woocommerce_checkout_process', 'dina_validate_custom_national_code_field' );
function dina_validate_custom_national_code_field()
{
    $national_code = isset( $_POST['billing_national_code'] ) ? sanitize_text_field( $_POST['billing_national_code'] ) : '';

    if ( ! empty( $national_code ) && ! dina_check_national_code( $national_code ) ) {
        wc_add_notice( __( 'The entered national code is not valid.', 'dina-kala' ), 'error' );
    }
}

// Save custom national code field in the order meta
add_action( 'woocommerce_checkout_update_order_meta', 'dina_save_custom_national_code_field' );
function dina_save_custom_national_code_field( $order_id )
{
    if ( ! empty( $_POST['billing_national_code'] ) ) {
        $order = wc_get_order($order_id);
        $order->update_meta_data( 'billing_national_code', sanitize_text_field( $_POST['billing_national_code'] ) );
        $order->save();
    }
}

// Add national code field to billing fields section in order details in admin
add_filter( 'woocommerce_admin_billing_fields', 'dina_add_national_code_to_admin_order_billing_fields' );
function dina_add_national_code_to_admin_order_billing_fields( $fields )
{
    $order = wc_get_order( get_the_ID() );

    if ( ! $order )
        return;

    $fields['national_code'] = array(
        'label' => __( 'National code', 'dina-kala' ),
        'show'  => true,
        'value' => $order->get_meta( 'billing_national_code' ),
    );
    return $fields;
}

// Save national code field in the order meta from admin order edit page.
add_action( 'woocommerce_process_shop_order_meta', 'dina_save_custom_national_code_field_admin' );
function dina_save_custom_national_code_field_admin( $order_id )
{
    if ( ! empty( $_POST['_billing_national_code'] ) ) {
        $order = wc_get_order($order_id);
        $order->update_meta_data( 'billing_national_code', sanitize_text_field( $_POST['_billing_national_code'] ) );
        $order->save();
    }
}