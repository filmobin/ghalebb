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
    'title'      => __( 'Popup settings', 'dina-kala' ),
    'id'         => 'popup_setting',
    'icon'       => 'fal fa-window',
    'fields'     => array(
        array( 
            'id'       => 'popup_setting_docs',
            'type'     => 'raw',
            'content'  => dina_admin_info( '', 'https://i-design.ir/docs/dinakala/?p=2215', 'info' )
        ),
        array(
            'id'       => 'enable_site_popup',
            'type'     => 'switch',
            'title'    => __( 'Enable popup window', 'dina-kala' ),
            'subtitle' => __( 'By activating this option, you can display a pop-up window after loading the site.','dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'site_popup_home',
            'type'     => 'switch',
            'title'    => __( 'Pop-up display only on home page', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'enable_site_popup', '=', true ),
        ),
        array(
            'id'       => 'site_popup_close_any',
            'type'     => 'switch',
            'title'    => __( 'Close the popup by clicking anywhere on the page', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'enable_site_popup', '=', true ),
        ),
        array(
            'id'       => 'site_popup_one_time',
            'type'     => 'switch',
            'title'    => __( 'Do not re-display the pop-up', 'dina-kala' ),
            'subtitle'  => __( 'Not displaying pop-ups on subsequent user visits after closing the window','dina-kala' ),
            'default'  => true,
            'required' => array( 'enable_site_popup', '=', true ),
        ),
        array(
            'id'       => 'site_popup_reshown',
            'type'     => 'text',
            'validate' => 'numeric',
            'title'    => __( 'Show again after a few days', 'dina-kala' ),
            'subtitle' => __( 'After this time, the pop-up will be displayed again, enter 0 to not display.', 'dina-kala' ),
            'default'  => 0,
            'required' => array( 'site_popup_one_time', '=', true ),
        ),
        array(
            'id'       => 'site_popup_size',
            'type'     => 'select',
            'title'    => __( 'Pop-up size', 'dina-kala' ),
            'options'  => array(
                'modal-sm' => __( 'Small', 'dina-kala' ),
                'modal-md' =>  __( 'Default', 'dina-kala' ),
                'modal-lg' =>  __( 'Larg', 'dina-kala' ),
            ),
            'default'  => 'modal-lg',
            'required' => array( 'enable_site_popup', '=', true ),
        ),
        array(
            'id'       => 'site_popup_title',
            'type'     => 'text',
            'title'    => __( 'Popup title', 'dina-kala' ),
            'default'  => __( 'Title', 'dina-kala' ),                
            'required' => array( 'enable_site_popup', '=', true ),
        ),

        array(
            'id'       => 'site-popup-content-section-start',
            'type'     => 'section',
            'title'    => __( 'Popup content settings', 'dina-kala' ),
            'indent'   => true,
            'required' => array( 'enable_site_popup', '=', true ),
        ),
        array(
            'id'      => 'site_popup_content_text',
            'type'    => 'editor',
            'title'   => __( 'Popup content text', 'dina-kala' ),
            'default' => __( '<p> This text can be changed through the template settings section.<br />
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Printers and texts, but also newspapers and magdinaes in columns and rows as needed and for the current state of technology required and a variety of applications with the aim of improving practical tools. Sixty-three percent of books in the past, present and future require a lot of knowledge from the community and professionals to create more knowledge with software for computer designers, especially creative designers and leading culture in the Persian language. In this case, it can be hoped that all the difficulties in presenting solutions and difficult typing conditions will end and the required time, including typing the main achievements and answering the continuous questions of the existing world of design, will be basically used.</p>', 'dina-kala' ),
            'args'    => array(
                'wpautop'       => true,
                'media_buttons' => true,
                'textarea_rows' => 5,
                'teeny'         => false,
                'quicktags'     => true,
            ),
        ),
        array(
            'id'     => 'site-popup-content-section-end',
            'type'   => 'section',
            'indent' => false,
        ),

        array(
            'id'       => 'site-popup-image-section-start',
            'type'     => 'section',
            'title'    => __( 'Popup image settings', 'dina-kala' ),
            'indent'   => true,
            'required' => array( 'enable_site_popup', '=', true ),
        ),
        array(
            'id'      => 'show_site_popup_image',
            'type'    => 'switch',
            'title'   => __( 'Show popup image' , 'dina-kala' ),
            'default' => false,
        ),
        array(
            'id'       => 'site_popup_image',
            'type'     => 'media',
            'url'      => true,
            'readonly' => false,
            'title'    => __( 'Popup image', 'dina-kala' ),
            'compiler' => 'true',
            'desc'     => __( 'Upload your popup image from this section.', 'dina-kala' ),
            'required' => array( 'show_site_popup_image', '=', true ),
        ),
        array(
            'id'       => 'site_popup_image_link',
            'type'     => 'text',
            'title'    => __( 'Image link' , 'dina-kala' ),
            'required' => array( 'show_site_popup_image', '=', true ),
        ),
        array(
            'id'       => 'open_site_popup_image_link_new_tab',
            'type'     => 'switch',
            'title'    => __( 'Open the link in a new tab' , 'dina-kala' ),
            'default'  => false,
            'required' => array( 'show_site_popup_image', '=', true ),
        ),
        array(
            'id'       => 'site_popup_image_pos',
            'type'     => 'image_select',
            'title'    => __( 'Popup image position', 'dina-kala' ),
            'options'  => array(
                'top' => array(
                    'alt' => __( 'Top', 'dina-kala' ),
                    'img' => RE_URI . 'assets/img/t-image.png'
                ),
                'right' => array(
                    'alt' => __( 'Right', 'dina-kala' ),
                    'img' => RE_URI . 'assets/img/r-image.png'
                ),
                'left' => array(
                    'alt' => __( 'Left', 'dina-kala' ),
                    'img' => RE_URI . 'assets/img/l-image.png'
                ),
                'full-image' => array(
                    'alt' => __( 'Image only', 'dina-kala' ),
                    'img' => RE_URI . 'assets/img/f-image.png'
                ),
            ),
            'default'  => 'top',
            'required' => array( 'show_site_popup_image', '=', true ),
        ),

        array(
            'id' => 'site-popup-button-section-start',
            'type' => 'section',
            'title'    => __( 'Popup button settings', 'dina-kala' ),
            'indent' => true,
            'required' => array( 'enable_site_popup', '=', true ),
        ),
        array(
            'id'       => 'show_site_popup_button',
            'type'     => 'switch',
            'title'    => __( 'Show popup button' , 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'site_popup_button_title',
            'type'     => 'text',
            'title'    => __( 'Button title' , 'dina-kala' ),
            'default'  => __( 'Title' , 'dina-kala' ),
            'required' => array( 'show_site_popup_button', '=', true ),
        ),
        array(
            'id'       => 'site_popup_button_link',
            'type'     => 'text',
            'title'    => __( 'Button link' , 'dina-kala' ),
            'default'  => '#',
            'required' => array( 'show_site_popup_button', '=', true ),
        ),
        array(
            'id'       => 'open_site_popup_link_new_tab',
            'type'     => 'switch',
            'title'    => __( 'Open the link in a new tab' , 'dina-kala' ),
            'default'  => false,
            'required' => array( 'show_site_popup_button', '=', true ),
        ),
        array(
            'id'       => 'site_popup_button_icon',
            'type'     => 'select',
            'select2'  => array( 'containerCssClass' => 'fal' ),
            'title'    => __( 'Icon', 'dina-kala' ),
            'class'    => ' dina-font-icon',
            'default'  => 'fal fa-shopping-cart',
            'options'  => $alliconArray,
            'required' => array( 'show_site_popup_button', '=', true ),
        ),
        array(
            'id'      => 'site_popup_button_color',
            'type'    => 'select',
            'title'   => __( 'Color', 'dina-kala' ),
            'options' => array(
                'btn-info'    => __( 'Blue', 'dina-kala' ),
                'btn-warning' => __( 'Yellow', 'dina-kala' ),
                'btn-success' => __( 'Green', 'dina-kala' ),
                'btn-danger'  => __( 'Red', 'dina-kala' )
            ),
            'default'  => 'btn-success',
            'required' => array( 'show_site_popup_button', '=', true ),
        ),        
        array(
            'id'     => 'site-popup-button-section-end',
            'type'   => 'section',
            'indent' => false,
        ),

    ),
) );