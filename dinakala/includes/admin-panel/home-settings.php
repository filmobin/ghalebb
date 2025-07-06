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
    'title'            => __( 'Home Settings', 'dina-kala' ),
    'id'               => 'menu_home',
    'desc'             => __( 'Home page settings', 'dina-kala' ),
    'icon'             => 'fal fa-home'
) );

Redux::setSection( $opt_name, array(
    'title'            => __( 'Site logo', 'dina-kala' ),
    'icon'             => 'fal fa-yin-yang',
    'id'               => 'sitelogo',
    'subsection'       => true,
    'desc'             => __( 'Site Logo Settings', 'dina-kala' ),
    'fields'           => array(
        array( 
            'id'       => 'site_logo_docs',
            'type'     => 'raw',
            'content'  => dina_admin_info( '', 'https://i-design.ir/docs/dinakala/?p=2179', 'info' )
        ),
        array(
            'id'       => 'site_logo',
            'type'     => 'media',
            'url'      => true,
            'readonly' => false,
            'title'    => __( 'Your logo', 'dina-kala' ),
            'compiler' => 'true',
            'desc'     => __( 'Upload your site logo from this section.', 'dina-kala' ),
            'subtitle' => __( 'Appropriate size: 160 pixel(w) in 57 pixel(h)', 'dina-kala' ),
            'default'  => array( 'url' => get_template_directory_uri()."/images/logo.png" ),
        ),
        array(
            'id'       => 'site_logo_retina',
            'type'     => 'media',
            'url'      => true,
            'readonly' => false,
            'title'    => __( 'Retina logo', 'dina-kala' ),
            'compiler' => 'true',
            'desc'     => __( 'Upload a site logo in a two-dimensional size to the current logo', 'dina-kala' ),
            'subtitle' => __( 'Appropriate size: 320 pixel(w) in 114 pixel(h)', 'dina-kala' ),
            'default'  => array( 'url' => get_template_directory_uri()."/images/logo2x.png" ),
        ),
        array(
            'id'       => 'site_favicon',
            'type'     => 'media',
            'url'      => true,
            'readonly' => false,
            'title'    => __( 'Favicon', 'dina-kala' ),
            'compiler' => 'true',
            'mode'      => false, 
            'desc'     => __( 'Upload your site icons. This icon is displayed in some browsers next to your site URL.', 'dina-kala' ),
            'default'  => array( 'url' => get_template_directory_uri()."/images/favicon.png" ),
        ),
        array(
            'id'       => 'login_logo_switch',
            'type'     => 'switch',
            'title'    => __( 'Change the WordPress login page logo', 'dina-kala' ),
            'subtitle' => __( 'Enabling this option will change the WordPress logo on the login page of the logo you selected in the Retina logo section.', 'dina-kala' ),
            'default'  => true
        ),
        array(
            'id'       => 'change_logo_link',
            'type'     => 'switch',
            'title'    => __( 'Change logo link', 'dina-kala' ),
            'subtitle' => __( 'With this option, you can change the default link of the logo that is connected to the main page of your site', 'dina-kala' ),
            'default'  => false
        ),
        array(
            'id'       => 'logo_link',
            'type'     => 'text',
            'title'    => __( 'Logo link', 'dina-kala' ),
            'default'  => '#',
            'required' => array( 'change_logo_link', '=', true ),
        ),
    )
) );

Redux::setSection( $opt_name, array(
    'title'            => __( 'Font settings', 'dina-kala' ),
    'icon'             => 'fal fa-font',
    'id'               => 'theme-font',
    'subsection'       => true,
    'desc'             => __( 'Template font settings', 'dina-kala' ),
    'fields'           => array(
        array( 
            'id'       => 'theme_font_docs',
            'type'     => 'raw',
            'content'  => dina_admin_info( '', 'https://i-design.ir/docs/dinakala/?p=2181', 'info' )
        ),
        array(
            'id'            => 'content_font_size',
            'type'          => 'slider',
            'title'         => __( 'Content font size (products, posts and pages)', 'dina-kala' ),
            'default'       => 14,
            'min'           => 12,
            'step'          => 1,
            'max'           => 30,
            'display_value' => 'label'
        ),

        array(
            'id'       => 'theme_font',
            'type'     => 'select',
            'title'    => __( 'Template font', 'dina-kala' ),
            'subtitle' => __( 'Select the template font', 'dina-kala' ),
            'options'  => array(
                'dana'     =>  __( 'Dana', 'dina-kala' ),
                'sans'     =>  __( 'Iran Sans', 'dina-kala' ),
                'yekan'    =>  __( 'Iran Yekan', 'dina-kala' ),
                'dana-fa'  =>  __( 'Dana (farsi digits)', 'dina-kala' ),
                'sans-fa'  =>  __( 'Iran Sans (farsi digits)', 'dina-kala' ),
                'yekan-fa' =>  __( 'Iran Yekan (farsi digits)', 'dina-kala' ),
            ),
            'default'  => 'dana',
            'required' => array( 'custom_font', '=', false ),
        ),

        array(
            'id'       => 'change_dashboard_font',
            'type'     => 'switch',
            'title'    => __( 'Changing the dashboard font', 'dina-kala' ),
            'default'  => false
        ),

        array(
            'id'       => 'custom_font',
            'type'     => 'switch',
            'title'    => __( 'Use custom fonts', 'dina-kala' ),
            'subtitle' => __( 'With this option you can use your own custom fonts.', 'dina-kala' ),
            'default'  => false
        ),

        //Custom Font Normal
        array(
            'id'       => 'normal-font-section-start',
            'type'     => 'section',
            'title'    => __( 'Normal weight upload', 'dina-kala' ),
            'indent'   => true,
            'required' => array( 'custom_font', '=', true ),
        ),
        array(
            'id'             => 'theme_font_woff2',
            'type'           => 'media',
            'title'          => __( 'WOFF2 font', 'dina-kala' ),
            'url'            => true,
            'readonly'       => false,
            'library_filter' => array( 'woff2' ),
            'mode'           => false,
            'preview'        => false,
            'default'        => '',
            'required'       => array( 'custom_font', '=', true ),
        ),
        array(
            'id'             => 'theme_font_woff',
            'type'           => 'media', 
            'title'          => __( 'WOFF font', 'dina-kala' ),
            'url'            => true,
            'readonly'       => false,
            'library_filter' => array( 'woff' ),
            'mode'           => false,
            'preview'        => false,
            'default'        => '',
            'required'       => array( 'custom_font', '=', true ),
        ),
        array(
            'id'             => 'theme_font_ttf',
            'type'           => 'media',
            'title'          => __( 'TTF font', 'dina-kala' ),
            'url'            => true,
            'readonly'       => false,
            'library_filter' => array( 'ttf' ),
            'mode'           => false,
            'preview'        => false,
            'default'        => '',
            'required'       => array( 'custom_font', '=', true ),
        ),
        array(
            'id'             => 'theme_font_eot',
            'type'           => 'media',
            'title'          => __( 'EOT font', 'dina-kala' ),
            'url'            => true,
            'readonly'       => false,
            'library_filter' => array( 'eot' ),
            'mode'           => false,
            'preview'        => false,
            'default'        => '',
            'required'       => array( 'custom_font', '=', true ),
        ),
        array(
            'id'             => 'theme_font_svg',
            'type'           => 'media',
            'title'          => __( 'SVG font', 'dina-kala' ),
            'url'            => true,
            'readonly'       => false,
            'library_filter' => array( 'svg' ),
            'mode'           => false,
            'preview'        => false,
            'default'        => '',
            'required'       => array( 'custom_font', '=', true ),
        ),
        array(
            'id'     => 'normal-font-section-end',
            'type'   => 'section',
            'indent' => false,
        ),

        //Custom Font Bold
        array(
            'id'       => 'bold-font-section-start',
            'type'     => 'section',
            'title'    => __( 'Bold weight upload', 'dina-kala' ),
            'indent'   => true,
            'required' => array( 'custom_font', '=', true ),
        ),
        array(
            'id'       => 'custom_bold_font',
            'type'     => 'switch',
            'title'    => __( 'Bold weight upload', 'dina-kala' ),
            'subtitle' => __( 'By activating this option, you can upload the bold font weight.', 'dina-kala' ),
            'default'  => false
        ),
        array(
            'id'             => 'theme_font_bold_woff2',
            'type'           => 'media',
            'title'          => __( 'WOFF2 font', 'dina-kala' ),
            'url'            => true,
            'readonly'       => false,
            'library_filter' => array( 'woff2' ),
            'mode'           => false,
            'preview'        => false,
            'default'        => '',
            'required'       => array( 'custom_bold_font', '=', true ),
        ),
        array(
            'id'             => 'theme_font_bold_woff',
            'type'           => 'media',
            'title'          => __( 'WOFF font', 'dina-kala' ),
            'url'            => true,
            'readonly'       => false,
            'library_filter' => array( 'woff' ),
            'mode'           => false,
            'preview'        => false,
            'default'        => '',
            'required'       => array( 'custom_bold_font', '=', true ),
        ),
        array(
            'id'             => 'theme_font_bold_ttf',
            'type'           => 'media',
            'title'          => __( 'TTF font', 'dina-kala' ),
            'url'            => true,
            'readonly'       => false,
            'library_filter' => array( 'ttf' ),
            'mode'           => false,
            'preview'        => false,
            'default'        => '',
            'required'       => array( 'custom_bold_font', '=', true ),
        ),
        array(
            'id'             => 'theme_font_bold_eot',
            'type'           => 'media',
            'title'          => __( 'EOT font', 'dina-kala' ),
            'url'            => true,
            'readonly'       => false,
            'library_filter' => array( 'eot' ),
            'mode'           => false,
            'preview'        => false,
            'default'        => '',
            'required'       => array( 'custom_bold_font', '=', true ),
        ),
        array(
            'id'             => 'theme_font_bold_svg',
            'type'           => 'media',
            'title'          => __( 'SVG font', 'dina-kala' ),
            'url'            => true,
            'readonly'       => false,
            'library_filter' => array( 'svg' ),
            'mode'           => false,
            'preview'        => false,
            'default'        => '',
            'required'       => array( 'custom_bold_font', '=', true ),
        ),
        array(
            'id'     => 'bold-font-section-end',
            'type'   => 'section',
            'indent' => false,
        ),

        //Custom Font Farsi Digits
        array(
            'id'       => 'farsi-digits-section-start',
            'type'     => 'section',
            'title'    => __( 'Farsi Digits Version upload', 'dina-kala' ),
            'indent'   => true,
            'required' => array( 'custom_font', '=', true ),
        ),
        array(
            'id'       => 'custom_farsi_font',
            'type'     => 'switch',
            'title'    => __( 'Farsi Digits Version upload', 'dina-kala' ),
            'subtitle' => __( 'By activating this option, you can upload the farsi digits version, this version is used in some parts of the template to display Persian numbers.', 'dina-kala' ),
            'default'  => false
        ),
        array(
            'id'             => 'theme_font_farsi_woff2',
            'type'           => 'media',
            'title'          => __( 'WOFF2 font', 'dina-kala' ),
            'url'            => true,
            'readonly'       => false,
            'library_filter' => array( 'woff2' ),
            'mode'           => false,
            'preview'        => false,
            'default'        => '',
            'required'       => array( 'custom_farsi_font', '=', true ),
        ),
        array(
            'id'             => 'theme_font_farsi_woff',
            'type'           => 'media',
            'title'          => __( 'WOFF font', 'dina-kala' ),
            'url'            => true,
            'readonly'       => false,
            'library_filter' => array( 'woff' ),
            'mode'           => false,
            'preview'        => false,
            'default'        => '',
            'required'       => array( 'custom_farsi_font', '=', true ),
        ),
        array(
            'id'             => 'theme_font_farsi_ttf',
            'type'           => 'media',
            'title'          => __( 'TTF font', 'dina-kala' ),
            'url'            => true,
            'readonly'       => false,
            'library_filter' => array( 'ttf' ),
            'mode'           => false,
            'preview'        => false,
            'default'        => '',
            'required'       => array( 'custom_farsi_font', '=', true ),
        ),
        array(
            'id'             => 'theme_font_farsi_eot',
            'type'           => 'media',
            'title'          => __( 'EOT font', 'dina-kala' ),
            'url'            => true,
            'readonly'       => false,
            'library_filter' => array( 'eot' ),
            'mode'           => false,
            'preview'        => false,
            'default'        => '',
            'required'       => array( 'custom_farsi_font', '=', true ),
        ),
        array(
            'id'             => 'theme_font_farsi_svg',
            'type'           => 'media',
            'title'          => __( 'SVG font', 'dina-kala' ),
            'url'            => true,
            'readonly'       => false,
            'library_filter' => array( 'svg' ),
            'mode'           => false,
            'preview'        => false,
            'default'        => '',
            'required'       => array( 'custom_farsi_font', '=', true ),
        ),
        array(
            'id'     => 'farsi-digits-section-end',
            'type'   => 'section',
            'indent' => false,
        ),

        //Font size settings for heading tags
        array(
            'id'       => 'heading-tags-section-start',
            'type'     => 'section',
            'title'    => __( 'Font size settings for heading tags', 'dina-kala' ),
            'subtitle' => __( 'In the content of products, pages and posts (in pixel)', 'dina-kala' ),
            'indent'   => true,
        ),
        array(
            'id'            => 'h1_font_size',
            'type'          => 'slider',
            'title'         => __( 'H1 Tag font size', 'dina-kala' ),
            'default'       => 28,
            'min'           => 12,
            'step'          => 1,
            'max'           => 50,
            'display_value' => 'label'
        ),
        array(
            'id'            => 'h2_font_size',
            'type'          => 'slider',
            'title'         => __( 'H2 Tag font size', 'dina-kala' ),
            'default'       => 21,
            'min'           => 12,
            'step'          => 1,
            'max'           => 50,
            'display_value' => 'label'
        ),
        array(
            'id'            => 'h3_font_size',
            'type'          => 'slider',
            'title'         => __( 'H3 Tag font size', 'dina-kala' ),
            'default'       => 17,
            'min'           => 12,
            'step'          => 1,
            'max'           => 50,
            'display_value' => 'label'
        ),
        array(
            'id'            => 'h4_font_size',
            'type'          => 'slider',
            'title'         => __( 'H4 Tag font size', 'dina-kala' ),
            'default'       => 16,
            'min'           => 12,
            'step'          => 1,
            'max'           => 50,
            'display_value' => 'label'
        ),
        array(
            'id'            => 'h5_font_size',
            'type'          => 'slider',
            'title'         => __( 'H5 Tag font size', 'dina-kala' ),
            'default'       => 14,
            'min'           => 12,
            'step'          => 1,
            'max'           => 50,
            'display_value' => 'label'
        ),
        array(
            'id'            => 'h6_font_size',
            'type'          => 'slider',
            'title'         => __( 'H6 Tag font size', 'dina-kala' ),
            'default'       => 14,
            'min'           => 12,
            'step'          => 1,
            'max'           => 50,
            'display_value' => 'label'
        ),
        array(
            'id'     => 'heading-tags-section-end',
            'type'   => 'section',
            'indent' => false,
        ),

    )
) );

Redux::setSection( $opt_name, array(
    'title'      => __( 'Template style', 'dina-kala' ),
    'icon'       => 'fal fa-palette',
    'id'         => 'theme-style',
    'subsection' => true,
    'desc'       => __( 'Customize and change the color and style of the template', 'dina-kala' ),
    'fields'     => array(
        array( 
            'id'       => 'theme_style_docs',
            'type'     => 'raw',
            'content'  => dina_admin_info( '', 'https://i-design.ir/docs/dinakala/?p=2183', 'info' )
        ),
        array(
            'id'       => 'prod_navs',
            'type'     => 'select',
            'title'    => __( 'Products carousel navigation style', 'dina-kala' ),
            'options'  => array(
                'stone' => __( 'Style 1', 'dina-kala' ),
                'sttwo' =>  __( 'Style 2', 'dina-kala' ),
            ),
            'default'  => 'stone',
        ),
        array(
            'id'       => 'prod_hover',
            'type'     => 'select',
            'title'    => __( 'Products and posts hover effect', 'dina-kala' ),
            'options'  => array(
                'prblur' => __( 'Blur', 'dina-kala' ),
                'przoom' =>  __( 'Zoom in', 'dina-kala' ),
                'prsimple' =>  __( 'Simple', 'dina-kala' ),
            ),
            'default'  => 'prblur',
        ),
        array(
            'id'       => 'full_width_style',
            'type'     => 'switch',
            'title'    => __( 'Full width mode', 'dina-kala' ),
            'subtitle' => __( 'In full width mode, page content is displayed as full screen.', 'dina-kala' ),
            'default'  => false
        ),
        array(
            'id'       => 'rounded_corners',
            'type'     => 'switch',
            'title'    => __( 'Rounded Corners', 'dina-kala' ),
            'subtitle' => __( 'Round corners for different parts of the site.', 'dina-kala' ),
            'default'  => true
        ),
        array(
            'id'            => 'input_border_radius',
            'type'          => 'slider',
            'title'         => __( 'Roundness around buttons and fields (pixel)', 'dina-kala' ),
            'subtitle'      => __( 'With this option, you can specify the degree of roundness around the buttons and data entry fields', 'dina-kala' ),
            "default"       => 22,
            "min"           => 0,
            "step"          => 1,
            "max"           => 30,
            'display_value' => 'label',
            'required'      => array( 'rounded_corners', '=', true ),
        ),
        array(
            'id'       => 'show_sec_img',
            'type'     => 'switch',
            'title'    => __( 'Show the second product image', 'dina-kala' ),
            'subtitle' => __( 'Display the second product image when hovering', 'dina-kala' ),
            'default'  => false
        ),
        array(
            'id'       => 'dis_mobile_color',
            'type'     => 'switch',
            'title'    => __( 'Disable mobile browser address bar color', 'dina-kala' ),
            'default'  => false
        ),
        array(
            'id'       => 'ch_mobile_color',
            'type'     => 'switch',
            'title'    => __( 'Change mobile browser address bar color', 'dina-kala' ),
            'subtitle' => __( 'By default the color of this bar is received from the default color of the theme', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'dis_mobile_color', '!=', true ),
        ),
        array(
            'id'          => 'mobile_bar_color',
            'type'        => 'color',
            'title'       => __( 'Mobile browser address bar color', 'dina-kala' ),
            'default'     => '#17A2B8',
            'validate'    => 'color',
            'transparent' => false,
            'required'    => array( 'ch_mobile_color', '=', true ),
        ),

        array(
            'id'       => 'ch_scroll_bar',
            'type'     => 'switch',
            'title'    => __( 'Change the scrollbar color', 'dina-kala' ),
            'subtitle' => __( 'Changing the color of the scroll bar of the site according to the template color', 'dina-kala' ),
            'default'  => false,
        ),
            
        array(
            'id'          => 'custom_color',
            'type'        => 'color',
            'title'       => __( 'Template color', 'dina-kala' ),
            'subtitle'    => __( 'Choose the color scheme for the template, this color will be displayed as the main theme of the site in most sections, such as the menu and widgets.', 'dina-kala' ),
            'default'     => '#17A2B8',
            'validate'    => 'color',
            'transparent' => false,
        ),

        array(
            'id'          => 'slider_tab_color',
            'type'        => 'color',
            'title'       => __( 'Slider title color', 'dina-kala' ),
            'default'     => '#607d8b',
            'validate'    => 'color',
            'transparent' => false,
        ),

        array(
            'id'          => 'slider_tab_color_active',
            'type'        => 'color',
            'title'       => __( 'Active slider title color', 'dina-kala' ),
            'default'     => '#455a64',
            'validate'    => 'color',
            'transparent' => false,
        ),

        array(
            'id'          => 'price_color',
            'type'        => 'color',
            'title'       => __( 'Price color', 'dina-kala' ),
            'subtitle'    => __( 'Choose the color for the prices.', 'dina-kala' ),
            'default'     => '#39b156',
            'validate'    => 'color',
            'transparent' => false,
        ),
        
        array(
            'id'      => 'change_coming_price_color',
            'type'    => 'switch',
            'title'   => __( 'Color change free prices, call and soon', 'dina-kala' ),
            'default' => false
        ),

        array(
            'id'          => 'free_price_color',
            'type'        => 'color',
            'title'       => __( 'Free or call prices color', 'dina-kala' ),
            'subtitle'    => __( 'Choose the color for the free or call prices', 'dina-kala' ),
            'default'     => '#39b156',
            'validate'    => 'color',
            'transparent' => false,
            'required'    => array( 'change_coming_price_color', '=', true ),
        ),

        array(
            'id'          => 'coming_price_color',
            'type'        => 'color',
            'title'       => __( 'Comingsoon color', 'dina-kala' ),
            'subtitle'    => __( 'Choose the color for the Comingsoon prices', 'dina-kala' ),
            'default'     => '#39b156',
            'validate'    => 'color',
            'transparent' => false,
            'required'    => array( 'change_coming_price_color', '=', true ),
        ),

        array(
            'id'            => 'price_font_size',
            'type'          => 'slider',
            'title'         => __( 'Product price font size on product page (pixel)', 'dina-kala' ),
            "default"       => 19,
            "min"           => 12,
            "step"          => 1,
            "max"           => 30,
            'display_value' => 'label'
        ),

        array(
            'id'          => 'dis_color',
            'type'        => 'color',
            'title'       => __( 'Discount badge color', 'dina-kala' ),
            'subtitle'    => __( 'Choose the color for the Discount badge.', 'dina-kala' ),
            'default'     => '#ef5350',
            'validate'    => 'color',
            'transparent' => false,
        ),

        array(
            'id'          => 'dis_text_color',
            'type'        => 'color',
            'title'       => __( 'Discount badge text color', 'dina-kala' ),
            'subtitle'    => __( 'Choose the color for the Discount badge text.', 'dina-kala' ),
            'default'     => '#ffffff',
            'validate'    => 'color',
            'transparent' => false,
        ),

        array(
            'id'     => 'read-view-section-start',
            'type'   => 'section',
            'title'  => __( 'Read more and View product (Add to cart) buttons in archive pages', 'dina-kala' ),
            'indent' => true,
        ),
        array(
            'id'       => 'show_hover_btns',
            'type'     => 'switch',
            'title'    => __( 'Show read more and view product buttons', 'dina-kala' ),
            'default'  => true
        ),
        array(
            'id'       => 'hide_read_more',
            'type'     => 'switch',
            'title'    => __( 'Remove the read more button from the posts', 'dina-kala' ),
            'default'  => false
        ),
        array(
            'id'       => 'show_hover_btns_fixed',
            'type'     => 'switch',
            'title'    => __( 'Display buttons fixed', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'show_hover_btns', '=', true ),
        ),
        array(
            'id'       => 'hover_btns_fixed_mobile',
            'type'     => 'switch',
            'title'    => __( 'Buttons fixed only in mobile mode', 'dina-kala' ),
            'default'  => false,
            'required' => array( 
                array( 'show_hover_btns', '=', true ), 
                array( 'show_hover_btns_fixed', '!=', true ) 
            )
        ),
        array(
            'id'          => 'read_product_color',
            'type'        => 'color',
            'title'       => __( 'Read more and View product buttons color', 'dina-kala' ),
            'default'     => '#28A745',
            'validate'    => 'color',
            'transparent' => false,
            'required'    => array( 'show_hover_btns', '=', true ),
        ),
        array(
            'id'          => 'read_product_text_color',
            'type'        => 'color',
            'title'       => __( 'Read more and View product buttons text color', 'dina-kala' ),
            'default'     => '#ffffff',
            'validate'    => 'color',
            'transparent' => false,
            'required'    => array( 'show_hover_btns', '=', true ),
        ),
        array(
            'id'          => 'read_product_hover_color',
            'type'        => 'color',
            'title'       => __( 'Read more and View product buttons hover and click color', 'dina-kala' ),
            'default'     => '#1E7E34',
            'validate'    => 'color',
            'transparent' => false,
            'required'    => array( 'show_hover_btns', '=', true ),
        ),
        array(
            'id'          => 'read_product_hover_text_color',
            'type'        => 'color',
            'title'       => __( 'Read more and View product buttons hover and click text color', 'dina-kala' ),
            'default'     => '#ffffff',
            'validate'    => 'color',
            'transparent' => false,
            'required'    => array( 'show_hover_btns', '=', true ),
        ),
        array(
            'id'     => 'read-view-section-end',
            'type'   => 'section',
            'indent' => false,
        ),
       
       array(
            'id'     => 'add-btn-section-start',
            'type'   => 'section',
            'title'  => __( 'Add to cart button in product page', 'dina-kala' ),
            'indent' => true,
        ),
       array(
            'id'          => 'add_btn_color',
            'type'        => 'color',
            'title'       => __( 'Add to cart button color', 'dina-kala' ),
            'default'     => '#28A745',
            'validate'    => 'color',
            'transparent' => false,
        ),
        array(
            'id'          => 'add_btn_text_color',
            'type'        => 'color',
            'title'       => __( 'Add to cart button text color', 'dina-kala' ),
            'default'     => '#ffffff',
            'validate'    => 'color',
            'transparent' => false,
        ),
        array(
            'id'     => 'add-btn-section-end',
            'type'   => 'section',
            'indent' => false,
       ),

       //login btn color
       array(
            'id'     => 'login-btn-section-start',
            'type'   => 'section',
            'title'  => __( 'Login button in header', 'dina-kala' ),
            'indent' => true,
        ),
        array(
            'id'          => 'login_btn_color',
            'type'        => 'color',
            'title'       => __( 'Login button color', 'dina-kala' ),
            'default'     => '#ffffff',
            'validate'    => 'color',
            'transparent' => false,
        ),
        array(
            'id'          => 'login_btn_text_color',
            'type'        => 'color',
            'title'       => __( 'Login button text color', 'dina-kala' ),
            'default'     => '#28a745',
            'validate'    => 'color',
            'transparent' => false,
        ),
        array(
            'id'          => 'login_btn_hover_color',
            'type'        => 'color',
            'title'       => __( 'Login button hover and click color', 'dina-kala' ),
            'default'     => '#28a745',
            'validate'    => 'color',
            'transparent' => false,
        ),
        array(
            'id'          => 'login_btn_hover_text_color',
            'type'        => 'color',
            'title'       => __( 'Login button hover and click text color', 'dina-kala' ),
            'default'     => '#ffffff',
            'validate'    => 'color',
            'transparent' => false,
        ),
        array(
            'id'     => 'login-btn-section-end',
            'type'   => 'section',
            'indent' => false,
       ),

       //register btn color
       array(
            'id'     => 'register-btn-section-start',
            'type'   => 'section',
            'title'  => __( 'Register button in header', 'dina-kala' ),
            'indent' => true,
        ),
       array(
            'id'          => 'register_btn_color',
            'type'        => 'color',
            'title'       => __( 'Register button color', 'dina-kala' ),
            'default'     => '#28a745',
            'validate'    => 'color',
            'transparent' => false,
        ),
        array(
            'id'          => 'register_btn_text_color',
            'type'        => 'color',
            'title'       => __( 'Register button text color', 'dina-kala' ),
            'default'     => '#ffffff',
            'validate'    => 'color',
            'transparent' => false,
        ),
        array(
            'id'       => 'register_btn_hover_color',
            'type'     => 'color',
            'title'    => __( 'Register button hover and click color', 'dina-kala' ),
            'default'  => '#218838',
            'validate' => 'color',
            'transparent' => false,
        ),
        array(
            'id'          => 'register_btn_hover_text_color',
            'type'        => 'color',
            'title'       => __( 'Register button hover and click text color', 'dina-kala' ),
            'default'     => '#ffffff',
            'validate'    => 'color',
            'transparent' => false,
        ),
        array(
            'id'     => 'register-btn-section-end',
            'type'   => 'section',
            'indent' => false,
       ),
        
        //Site Background Section
        array(
            'id'     => 'bg-section-start',
            'type'   => 'section',
            'title'  => __( 'Site Background', 'dina-kala' ),
            'indent' => true,
        ),
        array(
            'id'       => 'site_bg',
            'type'     => 'image_select',
            'output'   => array( 'body.dina-light.theme-dinakala:not(.page-template-elementor_canvas)' ),   // An array of CSS selectors
            'tiles'    => true,
            'title'    => __( 'Background', 'dina-kala' ),
            'subtitle' => __( 'Select a picture as a background.', 'dina-kala' ),
            'options'  => $background_patterns,
            'default'  => RE_URI . 'assets/img/patterns/bg.png',
            'required' => array( 'bg_switch', '!=', true ),
        ),
        array(
            'id'       => 'bg_switch',
            'type'     => 'switch',
            'title'    => __( 'Custom background', 'dina-kala' ),
            'subtitle' => __( 'Choose a background color or upload a custom photo', 'dina-kala' ),
            'default'  => false
        ),
        array(         
            'id'       => 'site_bg_custom',
            'output'    => array( 'body.dina-light.theme-dinakala:not(.page-template-elementor_canvas)' ), // An array of CSS selectors
            'type'     => 'background',
            'title'    => __( 'Customize the site background according to your taste.', 'dina-kala' ),
            'default'  => array(
                'background-color' => '#F5F5F5',
            ),
            'required' => array( 'bg_switch', '=', true ),
        ),
        array(
            'id'     => 'bg-section-end',
            'type'   => 'section',
            'indent' => false,
       ),
    )
) );

Redux::setSection( $opt_name, array(
    'title'            => __( 'Dark mode settings', 'dina-kala' ),
    'icon'             => 'fal fa-moon',
    'id'               => 'dark-mode',
    'subsection'       => true,
    'fields'           => array(
        array( 
            'id'       => 'dark_mode_docs',
            'type'     => 'raw',
            'content'  => dina_admin_info( '', 'https://i-design.ir/docs/dinakala/?p=2185', 'info' )
        ),
        array(
            'id'       => 'dina_dark_mode',
            'type'     => 'switch',
            'title'    => __( 'Dark Mode', 'dina-kala' ),
            'subtitle' => __( 'By activating this option, the ability to switch to dark mode will be added to your site.', 'dina-kala' ),
            'default'  => false
        ),

        array(
            'id'       => 'dina_dark_theme',
            'type'     => 'image_select',
            'title'    => __( 'Dark mode theme', 'dina-kala' ),
            'options'  => array(
                'dark-first-style' => array(
                    'alt' => __( 'First style', 'dina-kala' ),
                    'img' => RE_URI . 'assets/img/dark/dark1.png'
                ),
                'dark-second-style' => array(
                    'alt' => __( 'Second style', 'dina-kala' ),
                    'img' => RE_URI . 'assets/img/dark/dark2.png'
                ),
            ),
            'default'  => 'dark-first-style',
            'required' => array( 'dina_dark_mode', '=', true ),
        ),

        array(
            'id'       => 'dina_dark_mode_switch',
            'type'     => 'switch',
            'title'    => __( 'Show dark mode switch button', 'dina-kala' ),
            'default'  => true,
            'required' => array( 'dina_dark_mode', '=', true ),
        ),

        array(
            'id'       => 'dina_dark_mode_default',
            'type'     => 'switch',
            'title'    => __( 'Dark mode is enabled by default', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'dina_dark_mode', '=', true ),
        ),

        array(
            'id'       => 'dina_dark_mode_adapting',
            'type'     => 'switch',
            'title'    => __( 'Adapting to operating system settings', 'dina-kala' ),
            'subtitle' => __( 'By activating this option, if the dark mode is enabled in the operating system of the visitor (Android, iOS, Windows, etc.), the dark mode will be activated automatically.', 'dina-kala' ),
            'default'  => false,
            'required' => array( 
                array( 'dina_dark_mode', '=', true ), 
                array( 'dina_dark_mode_default', '!=', true ) 
            )
        ),

        array(
            'id'       => 'ch_dark_custom_color',
            'type'     => 'switch',
            'title'    => __( 'Change template color in dark mode', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'dina_dark_mode', '=', true ),
        ),

        array(
            'id'          => 'dark_custom_color',
            'type'        => 'color',
            'title'       => __( 'Template color in dark mode', 'dina-kala' ),
            'subtitle' => __( 'Choose the color scheme for the template in dark mode, this color will be displayed as the main theme of the site in most sections, such as the menu and widgets.', 'dina-kala' ),
            'default'     => '#17A2B8',
            'validate'    => 'color',
            'transparent' => false,
            'required' => array( 'ch_dark_custom_color', '=', true ),
        ),

        array(
            'id'       => 'ch_dark_price_color',
            'type'     => 'switch',
            'title'    => __( 'Change price color in dark mode', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'dina_dark_mode', '=', true ),
        ),

        array(
            'id'          => 'dark_price_color',
            'type'        => 'color',
            'title'       => __( 'Price color in dark mode', 'dina-kala' ),
            'default'     => '#39b156',
            'validate'    => 'color',
            'transparent' => false,
            'required'    => array( 'ch_dark_price_color', '=', true ),
        ),

        array(
            'id'       => 'ch_dark_coming_price_color',
            'type'     => 'switch',
            'title'    => __( 'Color change free prices, call and soon in dark mode', 'dina-kala' ),
            'default'  => false
        ),

        array(
            'id'          => 'dark_free_price_color',
            'type'        => 'color',
            'title'       => __( 'Free or call prices color', 'dina-kala' ),
            'subtitle'    => __( 'Choose the color for the free or call prices in dark mode', 'dina-kala' ),
            'default'     => '#39b156',
            'validate'    => 'color',
            'transparent' => false,
            'required'    => array( 'ch_dark_coming_price_color', '=', true ),
        ),

        array(
            'id'          => 'dark_coming_price_color',
            'type'        => 'color',
            'title'       => __( 'Comingsoon color', 'dina-kala' ),
            'subtitle'    => __( 'Choose the color for the Comingsoon prices in dark mode', 'dina-kala' ),
            'default'     => '#39b156',
            'validate'    => 'color',
            'transparent' => false,
            'required'    => array( 'ch_dark_coming_price_color', '=', true ),
        ),

        //Dark mode logo
        array(
            'id'       => 'dark-mode-logo-section-start',
            'type'     => 'section',
            'title'    => __( 'Logo settings in dark mode', 'dina-kala' ),
            'indent'   => true,
            'required' => array( 'dina_dark_mode', '=', true ),
        ),
        array(
            'id'       => 'ch_dark_site_logo',
            'type'     => 'switch',
            'title'    => __( 'Change logo in dark mode', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'dina_dark_mode', '=', true ),
        ),            
        array(
            'id'       => 'dark_site_logo',
            'type'     => 'media',
            'url'      => true,
            'readonly' => false,
            'title'    => __( 'Your logo', 'dina-kala' ),
            'compiler' => 'true',
            'desc'     => __( 'Upload your site logo from this section.', 'dina-kala' ),
            'subtitle' => __( 'Appropriate size: 160 pixel(w) in 57 pixel(h)', 'dina-kala' ),
            'default'  => array( 'url' => get_template_directory_uri()."/images/logo.png" ),
            'required' => array( 'ch_dark_site_logo', '=', true ),
        ),
        array(
            'id'       => 'dark_site_logo_retina',
            'type'     => 'media',
            'url'      => true,
            'readonly' => false,
            'title'    => __( 'Retina logo', 'dina-kala' ),
            'compiler' => 'true',
            'desc'     => __( 'Upload a site logo in a two-dimensional size to the current logo', 'dina-kala' ),
            'subtitle' => __( 'Appropriate size: 320 pixel(w) in 114 pixel(h)', 'dina-kala' ),
            'default'  => array( 'url' => get_template_directory_uri()."/images/logo2x.png" ),
            'required' => array( 'ch_dark_site_logo', '=', true ),
        ),
        array(
            'id'     => 'dark-mode-section-end',
            'type'   => 'section',
            'indent' => false,
        ),

        //Site background section in dark mode
        array(
            'id'       => 'dark-bg-section-start',
            'type'     => 'section',
            'title'    => __( 'Site background in dark mode', 'dina-kala' ),
            'indent'   => true,
            'required' => array( 'dina_dark_mode', '=', true ),
        ),
        array(         
            'id'      => 'dark_site_bg_custom',
            'output'  => array( 'body.dina-dark.theme-dinakala:not(.page-template-elementor_canvas)' ),
            'type'    => 'background',
            'title'   => __( 'Background in dark mode', 'dina-kala' ),
            'default' => array(
                'background-color' => '#121212',
            ),
            'required' => array( 'dina_dark_mode', '=', true ),
        ),
        array(
            'id'     => 'dark-bg-section-end',
            'type'   => 'section',
            'indent' => false,
        ),

        //dark-fstyle-section-start
        array(
            'id'       => 'dark-fstyle-section-start',
            'type'     => 'section',
            'title'    => __( 'Dark mode footer background settings', 'dina-kala' ),
            'indent'   => true,
            'required' => array( 'dina_dark_mode', '=', true ),
        ),
        array(         
            'id'      => 'dark_site_fbg_custom',
            'output'  => array( 'body.dina-dark .sfooter' ),
            'type'    => 'background',
            'title'   => __("Background footer in dark mode",'dina-kala' ),
            'default' => array(
                'background-color' => '#272727',
            ),
            'required' => array( 'dina_dark_mode', '=', true ),
        ),
        array(
            'id'     => 'fstyle-dark-mode-section-end',
            'type'   => 'section',
            'indent' => false,
        ),
    )
) );