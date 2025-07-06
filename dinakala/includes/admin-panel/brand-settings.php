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

//Start Products brand SECTION 
Redux::setSection( $opt_name, array(
    'title'      => __( 'Products brand', 'dina-kala' ),
    'id'         => 'product_br',
    'desc'       => __( "Products brand's settings (In case of error 404, re-save permalinks once.)", 'dina-kala' ),
    'icon'       => 'fal fa-tag',
    'fields'     => array(
        array( 
            'id'       => 'brand_docs',
            'type'     => 'raw',
            'content'  => dina_admin_info( '', 'https://i-design.ir/docs/dinakala/?p=2212', 'info' )
        ),
        array(
            'id'       => 'product_brand',
            'type'     => 'switch',
            'title'    => __( 'Activate the product brand feature', 'dina-kala' ),
            'default'  => true,
        ),
        array(
            'id'       => 'product_brand_slug',
            'type'     => 'text',
            'title'    => __( 'Product brand slug', 'dina-kala' ),
            'subtitle'  => __( 'After save settings, go to wordpress permalink setting and click save.', 'dina-kala' ),   
            'default'  => 'brand',
            'required' => array( 'product_brand', '=', true ),
        ),
        array(
            'id'       => 'product_brand_taxonomy',
            'type'     => 'text',
            'title'    => __( 'Product brand taxonomy', 'dina-kala' ),
            'subtitle' => __( 'After save settings, go to wordpress permalink setting and click save. With this section, you can change the taxonomy of the brand that is stored in the database, note that by changing this section, the brands you have already created will not be displayed, this section is used to be compatible with other brands of templates and plugins.', 'dina-kala' ),
            'default'  => 'brand',
            'required' => array( 'product_brand', '=', true ),
        ),
        array(
            'id'       => 'show_product_brand',
            'type'     => 'switch',
            'title'    => __( 'Show product brand', 'dina-kala' ),
            'subtitle' => __( 'Show product brand section in product page', 'dina-kala' ),
            'default'  => true,
            'required' => array( 'product_brand', '=', true ),
        ),
        array(
            'id'       => 'add_brand_schema',
            'type'     => 'switch',
            'title'    => __( 'Add brand schema', 'dina-kala' ),
            'subtitle' => __( 'Add brand schema to product schema', 'dina-kala' ),
            'default'  => true,
            'required' => array( 'product_brand', '=', true ),
        ),
        array(
            'id'       => 'show_product_brand_tab',
            'type'     => 'switch',
            'title'    => __( 'Show product brand tab', 'dina-kala' ),
            'subtitle' => __( 'Show product brand tab in product page', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'product_brand', '=', true ),
        ),
        array(
            'id'       => 'product_brand_tab_title',
            'type'     => 'text',
            'title'    => __( 'Product brand tab title', 'dina-kala' ),  
            'default'  => __( 'Product brand', 'dina-kala' ),
            'required' => array( 'show_product_brand_tab', '=', true ),
        ),
        array(
            'id'       => 'brand_before_title',
            'type'     => 'switch',
            'title'    => __( 'Display the brand logo above the product title', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'product_brand', '=', true ),
        ),
        array(
            'id'       => 'brand_before_meta',
            'type'     => 'switch',
            'title'    => __( 'Display brand logo before product metas', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'product_brand', '=', true ),
        ),
        array(
            'id'       => 'remove_brand_logo_link',
            'type'     => 'switch',
            'title'    => __( 'Remove the brand logo link', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'product_brand', '=', true ),
        ),
    ),
) );