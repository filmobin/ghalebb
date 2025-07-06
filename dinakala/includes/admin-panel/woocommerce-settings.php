<?php
/*
Theme Designed By: Meysam Hosseinkhani
Email: Meysam98@Gmail.com
Demo Website: Dinakala.I-design.ir
Author Website: i-design.ir
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
    exit;

Redux::setSection( $opt_name, array(
    'title'  => __( 'Woocommerce Settings', 'dina-kala' ),
    'id'     => 'menu_woo',
    'icon'   => 'fab fa-wordpress-simple',
    'fields' => array(
        array( 
            'id'       => 'woocommerce_settings_docs',
            'type'     => 'raw',
            'content'  => dina_admin_info( '', 'https://i-design.ir/docs/dinakala/?p=2209', 'info' )
        ),
        array(
            'id'       => 'remove_product_order',
            'type'     => 'switch',
            'title'    => __( 'Remove product sorting', 'dina-kala' ),
            'subtitle' => __( 'Remove product sorting from archive pages', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'product_sold_individually',
            'type'     => 'switch',
            'title'    => __( 'Removing the product quantity', 'dina-kala' ),
            'subtitle' => __( 'Removing the product quantity from WooCommerce products', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'mini_cart_quantity',
            'type'     => 'switch',
            'title'    => __( 'Ability to choose the number of products in the side shopping cart', 'dina-kala' ),
            'default'  => true,
        ),
        array(
            'id'       => 'remove_mini_cart_btn',
            'type'     => 'switch',
            'title'    => __( 'Removing the view cart button from the side cart', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'grant_download_access',
            'type'     => 'switch',
            'title'    => __( 'Grant download permissions for past WooCommerce orders', 'dina-kala' ),
            'subtitle' => __( 'By activating this option, permission to download new files added to the product will be granted to previous orders.', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'      => 'external_new_tab',
            'type'    => 'switch',
            'title'   => __( 'Opening the external/affiliate product link in a new tab', 'dina-kala' ),
            'default' => false,
        ),
        
        array(
            'id'       => 'remove_cart_fragments',
            'type'     => 'switch',
            'title'    => __( 'Remove cart fragments script', 'dina-kala' ),
            'subtitle' => __( 'Removing this script from the main page will increase the loading speed of your site, but if you use the cache plugin, removing this script will cause the shopping cart content to not be updated automatically when the page is loaded.', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'order_tracking_code',
            'type'     => 'switch',
            'title'    => __( 'Order tracking code', 'dina-kala' ),
            'subtitle' => __( 'Ability to insert the tracking code on the order management page and display it on the user panel', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'order_tracking_code_title',
            'type'     => 'text',
            'title'    => __( 'Tracking code title', 'dina-kala' ),
            'default'  => __( 'Tracking code', 'dina-kala' ),
            'required' => array( 'order_tracking_code', '=', true ),
        ),
        array(
            'id'       => 'order_tracking_code_icon',
            'type'     => 'select',
            'select2'  => array( 'containerCssClass' => 'fa' ),
            'title'    => __( 'Tracking code icon', 'dina-kala' ),
            'class'    => ' dina-font-icon',
            'default'  => 'fal fa-truck',
            'options'  => $alliconArray,
            'required' => array( 'order_tracking_code', '=', true ),
        ),

          //checkout-settings-start
        array(
            'id'     => 'checkout-settings-start',
            'type'   => 'section',
            'title'  => __( 'Checkout settings', 'dina-kala' ),
            'indent' => true,
        ),
        array(
            'id'      => 'redirect_checkout_login',
            'type'    => 'switch',
            'title'   => __( 'Show the login page instead of the payment page to guest users (non-members).' , 'dina-kala' ),
            'default' => false,
        ),
        array(
            'id'      => 'show_checkout_steps',
            'type'    => 'switch',
            'title'   => __( 'Display payment steps on shopping cart and checkout pages' , 'dina-kala' ),
            'default' => true,
        ),
        array(
            'id'       => 'override_address_fields',
            'type'     => 'switch',
            'title'    => __( 'Moving the state and city fields', 'dina-kala' ),
            'subtitle' => __( 'By activating this option, the state and city fields will be moved on the checkout page. If you use other plugins to edit the fields of the checkout page, activating this option may cause interference.', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'remove_extra_fields',
            'type'     => 'switch',
            'title'    => __( 'Remove extra fields', 'dina-kala' ),
            'subtitle' => __( 'Remove extra fields from products that do not have physical shipping', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'national_code_field',
            'type'     => 'switch',
            'title'    => __( 'Add the national code field', 'dina-kala' ),
            'subtitle' => __( 'Adding the national code field to the checkout page', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'optional_national_code_field',
            'type'     => 'switch',
            'title'    => __( 'Making the national code optional', 'dina-kala' ),
            'subtitle' => __( 'By activating this option, the national code becomes optional in the checkout form.', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'national_code_field', '=', true ),
        ),
        array(
            'id'       => 'remove_email_field',
            'type'     => 'switch',
            'title'    => __( 'Disabling the email field', 'dina-kala' ),
            'subtitle' => __( 'By activating this option, the email field will be removed from the checkout form. Be sure to check the correctness of the payment process after activating this option.', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'optional_email_field',
            'type'     => 'switch',
            'title'    => __( 'Making the email field optional', 'dina-kala' ),
            'subtitle' => __( 'By activating this option, the email field becomes optional in the checkout form. Be sure to check the correctness of the payment process after activating this option.', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'remove_postal_code_field',
            'type'     => 'switch',
            'title'    => __( 'Disabling the postcode/ZIP field', 'dina-kala' ),
            'subtitle' => __( 'By activating this option, the postcode/ZIP field will be removed from the checkout form. Be sure to check the correctness of the payment process after activating this option.', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'optional_postal_code_field',
            'type'     => 'switch',
            'title'    => __( 'Making the postal code field optional', 'dina-kala' ),
            'subtitle' => __( 'By activating this option, the postcode/ZIP field becomes optional in the checkout form. Be sure to check the correctness of the payment process after activating this option.', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'remove_phone_field',
            'type'     => 'switch',
            'title'    => __( 'Disabling the phone field', 'dina-kala' ),
            'subtitle' => __( 'By activating this option, the phone field will be removed from the checkout form. Be sure to check the correctness of the payment process after activating this option.', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'optional_phone_field',
            'type'     => 'switch',
            'title'    => __( 'Making the phone field optional', 'dina-kala' ),
            'subtitle' => __( 'By activating this option, the phone field becomes optional in the checkout form. Be sure to check the correctness of the payment process after activating this option.', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'validate_phone_field',
            'type'     => 'switch',
            'title'    => __( 'Phone field validation', 'dina-kala' ),
            'subtitle' => __( 'By activating this option, it is checked whether the phone number is 11 digits long and starts with 09.', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'remove_address_two',
            'type'     => 'switch',
            'title'    => __( 'Disabling the second address field', 'dina-kala' ),
            'subtitle' => __( 'By activating this option, the second address field will be removed from the checkout form. Be sure to check the correctness of the payment process after activating this option.', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'change_address_label',
            'type'     => 'switch',
            'title'    => __( 'Change the label of the address field', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'address_label',
            'type'     => 'text',
            'title'    => __( 'Address field label', 'dina-kala' ),
            'default'  => __( 'Street address', 'dina-kala' ),
            'required' => array( 'change_address_label', '=', true ),
        ),
        array(
            'id'       => 'remove_company',
            'type'     => 'switch',
            'title'    => __( 'Disabling the company field', 'dina-kala' ),
            'subtitle' => __( 'By activating this option, the company field will be removed from the checkout form. Be sure to check the correctness of the payment process after activating this option.', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'remove_note_field',
            'type'     => 'switch',
            'title'    => __( 'Disabling the order notes field', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'     => 'checkout-settings-end',
            'type'   => 'section',
            'indent' => false,
        ),

        //free-shipping-start
        array(
            'id'       => 'free-shipping-start',
            'type'     => 'section',
            'title'    => __( 'Free shipping settings', 'dina-kala' ),
            'subtitle' => __( 'Displaying changes in this section requires changes in the shopping cart content', 'dina-kala' ),
            'indent'   => true,
        ),
        array(
            'id'       => 'free_shipping_msg',
            'type'     => 'switch',
            'title'    => __( 'Show free shipping message', 'dina-kala' ),
            'subtitle' => __( 'If you have a method for free shipping on a certain amount of the order, you can display a message about the amount remaining until free shipping', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'shipping_is_free_msg',
            'type'     => 'switch',
            'title'    => __( 'Notify user when shipping is free', 'dina-kala' ),
            'default'  => true,
            'required' => array( 'free_shipping_msg', '=', true ),
        ),
        array(
            'id'       => 'free_shipping_amount',
            'type'     => 'text',
            'title'    => __( 'Free shipping threshold', 'dina-kala' ),
            'subtitle' => __( 'The amount in which shipping is free, without monetary units and decimals and...', 'dina-kala' ),
            'required' => array( 'free_shipping_msg', '=', true ),
        ),
        array(
            'id'       => 'free_shipping_msg_cart',
            'type'     => 'switch',
            'title'    => __( 'Show free shipping message in cart page', 'dina-kala' ),
            'default'  => true,
            'required' => array( 'free_shipping_msg', '=', true ),
        ),
        array(
            'id'       => 'free_shipping_msg_mini_cart',
            'type'     => 'switch',
            'title'    => __( 'Show free shipping message in mini-cart', 'dina-kala' ),
            'default'  => true,
            'required' => array( 'free_shipping_msg', '=', true ),
        ),
        array(
            'id'      => 'free_shipping_mini_cart_color',
            'type'    => 'select',
            'title'   => __( 'Message color', 'dina-kala' ),
            'options' => array(
                'alert-info'    => __( 'Blue', 'dina-kala' ),
                'alert-warning' => __( 'Yellow', 'dina-kala' ),
                'alert-success' => __( 'Green', 'dina-kala' ),
                'alert-danger'  => __( 'Red', 'dina-kala' )
            ),
            'default'  => 'alert-info',
            'required' => array( 'free_shipping_msg_mini_cart', '=', true ),
        ),
        array(
            'id'       => 'free_shipping_mini_cart_progress',
            'type'     => 'switch',
            'title'    => __( 'Display progress bar of remaining amount', 'dina-kala' ),
            'default'  => true,
            'required' => array( 'free_shipping_msg_mini_cart', '=', true ),
        ),
        array(
            'id'      => 'free_shipping_mini_cart_progress_color',
            'type'    => 'select',
            'title'   => __( 'Progress bar color', 'dina-kala' ),
            'options' => array(
                'bg-info'    => __( 'Blue', 'dina-kala' ),
                'bg-warning' => __( 'Yellow', 'dina-kala' ),
                'bg-success' => __( 'Green', 'dina-kala' ),
                'bg-danger'  => __( 'Red', 'dina-kala' )
            ),
            'default'  => 'bg-info',
            'required' => array( 'free_shipping_mini_cart_progress', '=', true ),
        ),
        array(
            'id'      => 'show_only_free_shipping',
            'type'    => 'switch',
            'title'   => __( 'Hide other shipping methods when free shipping is enabled', 'dina-kala' ),
            'default' => false,
        ),
        array(
            'id'     => 'free-shipping-end',
            'type'   => 'section',
            'indent' => false,
        ),

        //cod-payment-start
        array(
            'id'       => 'cod-payment-start',
            'type'     => 'section',
            'title'    => __( 'Cash on delivery settings', 'dina-kala' ),
            'subtitle' => __( 'Displaying changes in this section requires changes in the shopping cart content', 'dina-kala' ),
            'indent'   => true,
        ),
        array(
            'id'       => 'cod_payment_condition',
            'type'     => 'switch',
            'title'    => __( 'Show cash on delivery purchase method in a certain amount', 'dina-kala' ),
            'subtitle' => __( 'If you have a method for cash on delivery, you can display this method in a certain amount of the shopping cart.', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'cod_payment_amount',
            'type'     => 'select',
            'title'    => __( 'Cart amount condition', 'dina-kala' ),
            'options'  => array(
                'min'      => __( 'From the minimum amount', 'dina-kala' ),
                'max'      => __( 'Up to the maximum amount', 'dina-kala' ),
                'min-max'  => __( 'From minimum to maximum amount', 'dina-kala' ),
            ),
            'default'  => 'min',
            'required' => array( 'cod_payment_condition', '=', true ),
        ),
        array(
            'id'       => 'cod_amount_min',
            'type'     => 'text',
            'title'    => __( 'Minimum shopping cart amount', 'dina-kala' ),
            'subtitle' => __( 'The minimum amount in which cash on delivery is active, without monetary units and decimals and...', 'dina-kala' ),
            'required' => array( 'cod_payment_amount', '=', array( 'min', 'min-max' ) ),
        ),
        array(
            'id'       => 'cod_amount_max',
            'type'     => 'text',
            'title'    => __( 'Maximum shopping cart amount', 'dina-kala' ),
            'subtitle' => __( 'The Maximum amount in which cash on delivery is active, without monetary units and decimals and...', 'dina-kala' ),
            'required' => array( 'cod_payment_amount', '=', array( 'max', 'min-max' ) ),
        ),
        array(
            'id'     => 'cod-payment-end',
            'type'   => 'section',
            'indent' => false,
        ),
    ),
) );