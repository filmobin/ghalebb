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

//Start Dokan Settings SECTION
if ( class_exists( 'WeDevs_Dokan' ) ) { 
    Redux::setSection( $opt_name, array(
        'title'  => __( 'Dokan Settings', 'dina-kala' ),
        'id'     => 'dokan_setting',
        'desc'   => __( "Dokan plugin settings (Multivendor Plugin)", 'dina-kala' ),
        'icon'   => 'fal fa-users',
        'fields' => array(
            array( 
                'id'       => 'dokan_docs',
                'type'     => 'raw',
                'content'  => dina_admin_info( '', 'https://i-design.ir/docs/dinakala/?p=2211', 'info' )
            ),
            array(
                'id'      => 'show_product_vendor',
                'type'    => 'switch',
                'title'   => __( 'Show product vendor name in product page', 'dina-kala' ),
                'default' => false,
            ),
            array(
                'id'      => 'show_product_vendor_archive',
                'type'    => 'switch',
                'title'   => __( 'Show product vendor name in product archive page', 'dina-kala' ),
                'default' => false,
            ),
            array(
                'id'      => 'hide_dokan_shipping',
                'type'    => 'switch',
                'title'   => __( 'Remove dokan shipping tab in product page', 'dina-kala' ),
                'default' => false,
            ),
            array(
                'id'      => 'hide_dokan_seller_info',
                'type'    => 'switch',
                'title'   => __( 'Remove dokan seller info tab in product page', 'dina-kala' ),
                'default' => false,
            ),
        ),
    ) );
    }