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
    'title'      => __( 'Page Settings', 'dina-kala' ),
    'id'         => 'page_setting',
    'icon'       => 'fal fa-file',
    'fields'     => array(
        array( 
            'id'       => 'page_setting_docs',
            'type'     => 'raw',
            'content'  => dina_admin_info( '', 'https://i-design.ir/docs/dinakala/?p=2214', 'info' )
        ),
        array(
            'id'       => 'page_side',
            'type'     => 'image_select',
            'title'    => __( 'Pages Sidebar', 'dina-kala' ),
            'subtitle' => __( 'Specify the location of the pages sidebar, this feature is also customizable for each page.', 'dina-kala' ),
            'options'  => array(
                '0' => array(
                    'alt' => __( 'No sidebar', 'dina-kala' ),
                    'img' => RE_URI . 'assets/img/1c.png'
                ),
                '1' => array(
                    'alt' => __( 'Left alignment', 'dina-kala' ),
                    'img' => RE_URI . 'assets/img/2cl.png'
                ),
                '2' => array(
                    'alt' => __( 'Right alignment', 'dina-kala' ),
                    'img' => RE_URI . 'assets/img/2cr.png'
                )
            ),
            'default'  => '1'
        ),
        array(
            'id'       => 'show_page_thumb',
            'type'     => 'switch',
            'title'    => __( 'Show Page Thumbnail', 'dina-kala' ),
            'subtitle' => __( 'Show page Thumbnail in top of page content', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'hide_page_title',
            'type'     => 'switch',
            'title'    => __( 'Hide page title', 'dina-kala' ),
            'subtitle' => __( 'Hide page title in top of page content', 'dina-kala' ),
            'default'  => false,
        ),
    ),
) );