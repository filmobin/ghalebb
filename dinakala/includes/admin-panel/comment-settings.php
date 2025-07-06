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
    'title'      => __( 'Comment Settings', 'dina-kala' ),
    'id'         => 'comment_settings',
    'desc'       => __( "Settings related to the form of views and reviews of products", 'dina-kala' ),
    'icon'       => 'fal fa-comments',
    'fields'     => array(
        array( 
            'id'       => 'comments_docs',
            'type'     => 'raw',
            'content'  => dina_admin_info( '', 'https://i-design.ir/docs/dinakala/?p=3441', 'info' )
        ),
        // comments-section-start
        array(
            'id'     => 'comments-section-start',
            'type'   => 'section',
            'title'  => __( 'Comments settings', 'dina-kala' ),
            'indent' => true,
        ),
        array(
            'id'      => 'comment_remove_url',
            'type'    => 'switch',
            'title'   => __( 'Remove the website field from the comment form', 'dina-kala' ),
            'default' => false,
        ),
        array(
            'id'       => 'comment_remove_email',
            'type'     => 'switch',
            'title'    => __( 'Remove the email field from the comment form', 'dina-kala' ),
            'subtitle' => __( 'After disabling email field, disable "Comment author must fill out name and email" from settings > discussion', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'      => 'comment_remove_cookie',
            'type'    => 'switch',
            'title'   => __( 'Remove the cookie save field from the comment form', 'dina-kala' ),
            'default' => false,
        ),
        array(
            'id'      => 'comment_add_phone',
            'type'    => 'switch',
            'title'   => __( 'Adding a phone number field to the comment form', 'dina-kala' ),
            'default' => false,
        ),
        array(
            'id'       => 'comment_phone_logged',
            'type'     => 'switch',
            'title'    => __( 'Display the phone field to logged in users', 'dina-kala' ),
            'subtitle' => __( 'By activating this option, the phone field will be displayed to logged in users in addition to guest users', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'comment_add_phone', '=', true ),
        ),
        array(
            'id'       => 'comment_phone_req',
            'type'     => 'switch',
            'title'    => __( 'The phone field is required', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'comment_add_phone', '=', true ),
        ),
        array(
            'id'     => 'commnets-section-end',
            'type'   => 'section',
            'indent' => false,
        ),
        //commnets-section-end
        
        array(
            'id'     => 'comments-pros-cons-section-start',
            'type'   => 'section',
            'title'  => __( 'Product review settings', 'dina-kala' ),
            'indent' => true,
        ),
        array(
            'id'       => 'comment_pros_cons',
            'type'     => 'switch',
            'title'    => __( 'Activation of the positive and negative points of the product in the product comments', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'comment_pros_cons_logged',
            'type'     => 'switch',
            'title'    => __( 'Activation only for logged in users', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'comment_pros_cons', '=', true ),
        ),
        array(
            'id'       => 'comment_pros_cons_buyers',
            'type'     => 'switch',
            'title'    => __( 'Activation only for product buyers', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'comment_pros_cons', '=', true ),
        ),
        array(
            'id'     => 'commnets-pros-cons-section-end',
            'type'   => 'section',
            'indent' => false,
        ),
    ),
) );