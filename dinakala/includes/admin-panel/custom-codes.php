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
    'title'      => __( 'Custom Codes', 'dina-kala' ),
    'id'         => 'menu_example',
    'desc'       => __( 'Custom Codes Settings', 'dina-kala' ),
    'icon'       => 'fal fa-code',
    'fields'     => array(
        array( 
            'id'       => 'custom_codes_docs',
            'type'     => 'raw',
            'content'  => dina_admin_info( '', 'https://i-design.ir/docs/dinakala/?p=2217', 'info' )
        ),
        array(
            'id'       => 'custom_css',
            'type'     => 'ace_editor',
            'title'    => __( 'Custom style sheet', 'dina-kala' ),
            'subtitle' => __( 'Add your custom stylesheets quickly to the template.', 'dina-kala' ),
            'mode'     => 'css',
            'theme'    => 'chrome'
        ),
        array(
            'id'       => 'header_codes',
            'type'     => 'ace_editor',
            'title'    => __( 'Header script', 'dina-kala' ),
            'subtitle' => __( 'Enter the codes you need to add to the header section of the template (like meta tags) here.', 'dina-kala' ),
            'mode'     => 'javascript',
            'theme'    => 'chrome'
        ),
        array(
            'id'       => 'footer_codes',
            'type'     => 'ace_editor',
            'title'    => __( 'Footer script', 'dina-kala' ),
            'subtitle' => __( 'Add the codes you need to add to the footer template (like Google Analytics) here.', 'dina-kala' ),
            'mode'     => 'javascript',
            'theme'    => 'chrome'
        ),
    ),
) );