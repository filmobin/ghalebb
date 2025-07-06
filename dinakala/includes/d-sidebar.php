<?php
/*
Theme Designed By: Meysam Hosseinkhani
Email: Meysam98@Gmail.com
Author Website: i-design.ir
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
    exit;

// If Dynamic Sidebar Exists
if ( function_exists( 'register_sidebar' ) ) {

    $tag          = ! empty( dina_opt( 'widgets_title_tag' ) ) ? dina_opt( 'widgets_title_tag' ) : 'h3';
    $before_title = '<div class="wid-title"><' . $tag . '>';
    $after_title  = '</' . $tag . '></div>';

    register_sidebar(array(
        'name'          => __( 'Products and product archive sidebar', 'dina-kala' ),
        'id'            => 'shop-sidebar',
        'description'   => __( 'Products and product archive sidebar', 'dina-kala' ),
        'before_widget' => '<div id="%1$s" class="shadow-box wid-content %2$s">',
        'before_title'  => $before_title,
        'after_title'   => $after_title,
        'after_widget'  => '</div>'
    ) );

    if ( dina_opt( 'product_page_side' ) ) {
        register_sidebar(array(
        'name'          => __( 'Products sidebar', 'dina-kala' ),
        'id'            => 'product-sidebar',
        'description'   => __( 'Products sidebar', 'dina-kala' ),
        'before_widget' => '<div id="%1$s" class="shadow-box wid-content %2$s">',
        'before_title'  => $before_title,
        'after_title'   => $after_title,
        'after_widget'  => '</div>'
        ) );
    }

    if ( dina_opt( 'shop_page_side' ) ) {
        register_sidebar(array(
        'name'          => __( 'Shop Page sidebar', 'dina-kala' ),
        'id'            => 'shop-page-sidebar',
        'description'   => __( 'Shop page sidebar', 'dina-kala' ),
        'before_widget' => '<div id="%1$s" class="shadow-box wid-content %2$s">',
        'before_title'  => $before_title,
        'after_title'   => $after_title,
        'after_widget'  => '</div>'
        ) );
    }

    register_sidebar(array(
        'name'          => __( 'Site sidebar', 'dina-kala' ),
        'id'            => 'site-sidebar',
        'description'   => __( 'Site sidebar', 'dina-kala' ),
        'before_widget' => '<div id="%1$s" class="shadow-box wid-content %2$s">',
        'before_title'  => $before_title,
        'after_title'   => $after_title,
        'after_widget'  => '</div>'
    ) );

    $footer_widgets = (int)dina_opt( 'footer_widgets' );
    $tag            = ! empty( dina_opt( 'footer_widgets_title_tag' ) ) ? dina_opt( 'footer_widgets_title_tag' ) : 'h3';
    $before_title   = '<' . dina_opt( 'footer_widgets_title_tag' ) . ' class="fwidget-title">';
    $after_title    = '</' . dina_opt( 'footer_widgets_title_tag' ) . '>';
    for ( $x = 1; $x <= $footer_widgets; $x++) {
        register_sidebar(array(
            'name'          => __( 'Footer ', 'dina-kala' ).$x,
            'id'            => 'footer-'. $x,
            'description'   => __( 'Footer Widget ', 'dina-kala' ).$x,
            'before_widget' => '<div id="%1$s" class="%2$s">',
            'before_title'  => $before_title,
            'after_title'   => $after_title,
            'after_widget'  => '</div>'
        ) );
    }
}   