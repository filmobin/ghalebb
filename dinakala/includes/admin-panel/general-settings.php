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
    'title'            => __( 'General settings', 'dina-kala' ),
    'id'               => 'general_setting',
    'icon'             => 'fal fa-cogs',
) );

Redux::setSection( $opt_name, array(
    'title'      => __( 'Maintenance mode', 'dina-kala' ),
    'icon'       => 'fal fa-tools',
    'id'         => 'maintenance_mode',
    'desc'       => __( 'In the site maintenance mode it will be unavailable to users and only the administrator can view it', 'dina-kala' ),
    'subsection' => true,
    'fields'     => array(
        array( 
            'id'       => 'maintenance_docs',
            'type'     => 'raw',
            'content'  => dina_admin_info( '', 'https://i-design.ir/docs/dinakala/?p=2187', 'info' )
        ),
        array(
            'id'       => 'maintenance',
            'type'     => 'switch',
            'title'    => __( 'Enable maintenance mode', 'dina-kala' ),
            'subtitle' => __( 'In this case, the site will be unavailable to users', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'maintenance_editor',
            'type'     => 'switch',
            'title'    => __( 'Display site for author users', 'dina-kala' ),
            'subtitle' => __( 'Display site for users who have the ability to edit and publish content.', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'maintenance', '=', true ),
        ),
        array(
            'id'       => 'maintenance_social',
            'type'     => 'switch',
            'title'    => __( 'Display the link of social networks', 'dina-kala' ),
            'subtitle' => __( 'Display the link of social networks in maintenance mode', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'maintenance', '=', true ),
        ),
        array(
            'id'       => 'show_counter',
            'type'     => 'switch',
            'title'    => __( 'Enable date countdown', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'maintenance', '=', true ),
        ),
        array(
            'id'          => 'date_counter',
            'type'        => 'date',
            'title'       => __( 'Completion date', 'dina-kala' ),
            'subtitle' => __( 'Completion date of the countdown', 'dina-kala' ),
            'placeholder' => __( 'Click to enter a date', 'dina-kala' ),
            'required'    => array( 'show_counter', '=', true ),
        ),
        array(
            'id'       => 'counter_style',
            'type'     => 'select',
            'title'    => __( 'Countdown style', 'dina-kala' ),
            'options'  => array(
                'sale-count-black'    =>  __( 'Black', 'dina-kala' ),
                'sale-count-white'    =>  __( 'White', 'dina-kala' ),
                'sale-count-gray'     =>  __( 'Gray', 'dina-kala' ),
                'sale-count-outline'  =>  __( 'Outline', 'dina-kala' ),
            ),
            'default'  => 'sale-count-outline',
            'required'    => array( 'show_counter', '=', true ),
        ),
        array(
            'id'       => 'counter_format',
            'type'     => 'select',
            'title'    => __( 'Countdown format', 'dina-kala' ),
            'options'  => array(
                'wdhm' => __( 'Week: Day: Hour: Minute: Second', 'dina-kala' ),
                'dhm'  => __( 'Day: Hour: Minute: Second', 'dina-kala' ),
            ),
            'default'  => 'wdhm',
            'required'    => array( 'show_counter', '=', true ),
        ),
        array(
            'id'       => 'counter_circle',
            'type'     => 'switch',
            'title'    => __( 'Circle style', 'dina-kala' ),
            'default'  => true,
            'required'    => array( 'show_counter', '=', true ),
        ),
        array(
            'id'       => 'maintenance_title',
            'type'     => 'text',
            'title'    => __( 'Title', 'dina-kala' ),
            'subtitle' => __( 'Maintenance mode title', 'dina-kala' ),
            'default'  => __( 'Maintenance Mode', 'dina-kala' ),
            'required' => array( 'maintenance', '=', true ),
        ),
        array(
            'id'      => 'maintenance_msg',
            'type'    => 'editor',
            'title'   => __( 'Message', 'dina-kala' ),
            'default'  => __( 'Site is under construction, please be patient.', 'dina-kala' ),
            'args'    => array(
                'wpautop'       => true,
                'media_buttons' => true,
                'textarea_rows' => 5,
                'teeny'         => false,
                'quicktags'     => true,
            ),
            'required' => array( 'maintenance', '=', true ),
        ),

        array(
            'id' => 'maintenance-style-section-start',
            'type' => 'section',
            'title'    => __( 'Maintenance mode style settings', 'dina-kala' ),
            'indent' => true,
            'required' => array( 'maintenance', '=', true ),
        ),
        array(
            'id'       => 'maintenance_text_color',
            'type'     => 'color',
            'title'    => __( 'Maintenance mode text color', 'dina-kala' ),
            'default'  => '#212529',
            'validate' => 'color',
            'transparent' => false,
            'required' => array( 
                array( 'maintenance', '=', true ), 
            )
        ),
        array(
            'id'       => 'maintenance_bg',
            'type'     => 'image_select',
            'output'    => array( '.maintenance-mode' ),
            'tiles'    => true,
            'title'    => __( 'Maintenance mode background', 'dina-kala' ),
            'subtitle' => __("Select an image as the background of the maintenance mode.",'dina-kala' ),
            'options'  => $footer_patterns,
            'default'  => RE_URI . 'assets/img/fbg/0.png',
            'required' => array( 
                array( 'maintenance', '=', true ), 
                array( 'mbg_switch', '!=', true ) 
            )
        ),
        array(
            'id'       => 'mbg_switch',
            'type'     => 'switch',
            'title'    => __( 'Custom Maintenance mode Background', 'dina-kala' ),
            'subtitle' => __( 'Choose a background color or upload a custom photo to the Maintenance mode', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'maintenance', '=', true ),
        ),
        array(         
            'id'       => 'maintenance_custom_bg',
            'output'    => array( '.maintenance-mode' ),
            'type'     => 'background',
            'title'    => __( 'Maintenance mode background', 'dina-kala' ),
            'default'  => array(
                'background-color' => '#F4F5F9',
            ),
            'required' => array( 
                array( 'maintenance', '=', true ),
                array( 'mbg_switch', '=', true ) 
            )
        ),
        array(
            'id' => 'maintenance-style-section-end',
            'type' => 'section',
            'indent' => false,
        ),
    ),
) );

Redux::setSection( $opt_name, array(
    'title'      => __( 'Header settings', 'dina-kala' ),
    'icon'       => 'fal fa-browser',
    'id'         => 'header-setting',
    'subsection' => true,
    'desc'       => __( 'Customize site header', 'dina-kala' ),
    'fields'     => array(
        array( 
            'id'       => 'header_setting_docs',
            'type'     => 'raw',
            'content'  => dina_admin_info( '', 'https://i-design.ir/docs/dinakala/?p=2189', 'info' )
        ),
        array(
            'id'       => 'head_pos',
            'type'     => 'image_select',
            'title'    =>  __( 'Header Menu position', 'dina-kala' ),
            'subtitle' => __( 'Locate the Header Menu.', 'dina-kala' ),
            'options'  => array(
                '1' => array(
                    'alt' => __( 'Right', 'dina-kala' ),
                    'img' => RE_URI . 'assets/img/rmenu.png'
                ),
                '2' => array(
                    'alt' => __( 'Left', 'dina-kala' ),
                    'img' => RE_URI . 'assets/img/lmenu.png'
                ),
            ),
            'default'  => '1'
        ),
        array(
            'id'       => 'logo_pos',
            'type'     => 'image_select',
            'title'    =>  __( 'Logo position', 'dina-kala' ),
            'subtitle' => __( 'Locate the site logo.', 'dina-kala' ),
            'options'  => array(
                '1' => array(
                    'alt' => __( 'Right alignment', 'dina-kala' ),
                    'img' => RE_URI . 'assets/img/rlogo.png'
                ),
                '2' => array(
                    'alt' => __( 'Left alignment', 'dina-kala' ),
                    'img' => RE_URI . 'assets/img/llogo.png'
                ),
            ),
            'default'  => '1'
        ),
        array(
            'id'       => 'mobile_logo_pos',
            'type'     => 'image_select',
            'title'    =>  __( 'Mobile logo position', 'dina-kala' ),
            'subtitle' => __( 'Locate the site logo in mobile.', 'dina-kala' ),
            'options'  => array(
                '1' => array(
                    'alt' => __( 'Right alignment', 'dina-kala' ),
                    'img' => RE_URI . 'assets/img/rlogo.png'
                ),
                '3' => array(
                    'alt' => __( 'Middle alignment', 'dina-kala' ),
                    'img' => RE_URI . 'assets/img/mlogo.png'
                ),
                '2' => array(
                    'alt' => __( 'Left alignment', 'dina-kala' ),
                    'img' => RE_URI . 'assets/img/llogo.png'
                ),
            ),
            'default'  => '2'
        ),
        array(
            'id'       => 'reverse_middle_logo_btns',
            'type'     => 'switch',
            'title'    => __( 'Reverse the location of user buttons and menu', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'mobile_logo_pos', '=', '3' ),
        ),
        array(
            'id'       => 'add_home_heading',
            'type'     => 'switch',
            'title'    => __( 'Add an H1 tag to the logo', 'dina-kala' ),
            'subtitle' => __( 'Add an H1 tag to the logo on the home page', 'dina-kala' ),
            'default'  => true,
        ),
        array(
            'id'       => 'hide_top_bar',
            'type'     => 'switch',
            'title'    => __( 'Hide Site Top Bar (Contact, Menu and Social)', 'dina-kala' ),
            'subtitle' => __( 'By Activating this option site top bar not displayed.', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'show_cart_btn',
            'type'     => 'switch',
            'title'    => __( 'Show Cart button', 'dina-kala' ),
            'subtitle' => __( 'Show Cart button in menu bar', 'dina-kala' ),
            'default'  => true,
        ),
        array(
            'id'       => 'direct_cart_link',
            'type'     => 'switch',
            'title'    => __( 'Direct link to shopping cart', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'show_cart_btn', '=', true ),
        ),
        array(
            'id'       => 'show_wish_list',
            'type'     => 'switch',
            'title'    => __( 'Show Wishlist button', 'dina-kala' ),
            'subtitle' => __( 'Show Wishlist button in menu bar', 'dina-kala' ),
            'default'  => true,
        ),
        array(
            'id'       => 'show_compare_btn',
            'type'     => 'switch',
            'title'    => __( 'Show Compare button', 'dina-kala' ),
            'subtitle' => __( 'Show Compare button in menu bar', 'dina-kala' ),
            'default'  => true,
        ),
       
        array(
            'id'       => 'show_loading_bar',
            'type'     => 'switch',
            'title'    => __( 'Loading bar', 'dina-kala' ),
            'subtitle' => __( 'View the loading bar at the top of the site', 'dina-kala' ),
            'default'  => true,
        ),

        array(
            'id' => 'mobile-header-section-start',
            'type' => 'section',
            'title'    => __( 'Mobile header settings', 'dina-kala' ),
            'indent' => true,
        ),
        array(
            'id'       => 'ch_menu_cart',
            'type'     => 'switch',
            'title'    => __( 'Change mobile menu button to shopping cart', 'dina-kala' ),
            'subtitle' => __( 'Enabling this option will change the mobile menu open button to the shopping cart, you can display the menu button in the bottom bar of the mobile from the mobile navigation bar settings.', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'cart_mobile_search',
            'type'     => 'switch',
            'title'    => __( 'Display the shopping cart button next to the search box', 'dina-kala' ),
            'subtitle' => __( 'This option works in the case that the search box display mode under the logo is active in mobile mode', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'     => 'mobile-header-section-end',
            'type'   => 'section',
            'indent' => false,
        ),

        array(
            'id' => 'bread-section-start',
            'type' => 'section',
            'title'    => __( 'Breadcrumbs settings', 'dina-kala' ),
            'indent' => true,
        ),
        array(
            'id'       => 'show_bread',
            'type'     => 'switch',
            'title'    => __( 'Breadcrumbs', 'dina-kala' ),
            'subtitle' => __( 'Show the breadcrumbs (your links on the route sign)', 'dina-kala' ),
            'default'  => true,
        ),
        array(
            'id'       => 'bread_crumbs_sync',
            'type'     => 'switch',
            'title'    => __( 'Compatibility with RankMath and Yoast SEO plugins', 'dina-kala' ),
            'subtitle' => __( 'By activating this option, if RankMath and Yoast SEO plugins are active, the breadcrumbs section of these plugins will be displayed', 'dina-kala' ),
            'default'  => true,
            'required' => array( 'show_bread', '=', true ),
        ),
        array(
            'id'       => 'show_bread_mobile',
            'type'     => 'switch',
            'title'    => __( 'Show breadcrumbs in mobile mode', 'dina-kala' ),
            'default'  => true,
            'required' => array( 'show_bread', '=', true ),
        ),
        array(
            'id'       => 'change_home_text',
            'type'     => 'switch',
            'title'    => __( 'Change home text', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'show_bread', '=', true ),
        ),
        array(
            'id'       => 'home_text',
            'type'     => 'text',
            'title'    => __( 'Home text', 'dina-kala' ),
            'required' => array( 'change_home_text', '=', true ),
        ),
        array(
            'id'     => 'bread-section-end',
            'type'   => 'section',
            'indent' => false,
        ),

        array(
            'id' => 'menu-section-start',
            'type' => 'section',
            'title'    => __( 'Menu settings', 'dina-kala' ),
            'indent' => true,
        ),
        array(
            'id'       => 'mobile_head_menu',
            'type'     => 'switch',
            'title'    => __( 'Display header menu in mobile mode', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'hide_top_bar', '!=', true ),
        ),
        array(
            'id'       => 'maga_column',
            'type'     => 'select',
            'title'    => __( 'Number of Megamenu columns', 'dina-kala' ),
            'options'  => array(
                'three' => __( 'Three columns', 'dina-kala' ),
                'four' =>  __( 'Four columns', 'dina-kala' ),
                'five' =>  __( 'Five columns', 'dina-kala' ),
                'six' =>  __( 'Six columns', 'dina-kala' ),
                'seven' =>  __( 'Seven columns', 'dina-kala' ),
                'eight' =>  __( 'Eight columns', 'dina-kala' ),
            ),
            'default'  => 'four',
        ),
        array(
            'id'       => 'mega_style',
            'type'     => 'select',
            'title'    => __( 'Megamenu style', 'dina-kala' ),
            'options'  => array(
                'first' => __( 'First style', 'dina-kala' ),
                'second' =>  __( 'Second style', 'dina-kala' ),
            ),
            'default'  => 'first',
        ),
        array(
            'id'       => 'menu_hover_bottom',
            'type'     => 'switch',
            'title'    => __( 'Show the hover menu line at the bottom', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'fixed_head_top',
            'type'     => 'switch',
            'title'    => __( 'Fixed menu', 'dina-kala' ),
            'subtitle' => __( 'Fixed the header menu when scrolling through the site', 'dina-kala' ),
            'default'  => true,
        ),
        array(
            'id'       => 'fixed_head_mobile',
            'type'     => 'switch',
            'title'    => __( 'Fixed menu in mobile', 'dina-kala' ),
            'subtitle' => __( 'Fixed the header menu when scrolling through the site in mobile mode', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'fixed_head_logo',
            'type'     => 'switch',
            'title'    => __( 'Display the logo in the sticky menu', 'dina-kala' ),
            'subtitle' => __( 'Display the logo in the computer sticky menu', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'change_fixed_logo',
            'type'     => 'switch',
            'title'    => __( 'Replace the sticky menu logo', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'fixed_head_logo', '=', true ),
        ),
        array(
            'id'       => 'sticky_logo',
            'type'     => 'media',
            'url'      => true,
            'readonly' => false,
            'title'    => __( 'Sticky logo', 'dina-kala' ),
            'compiler' => 'true',
            'subtitle' => __( 'Appropriate size: 107 pixel(w) in 37 pixel(h)', 'dina-kala' ),
            'required' => array( 'change_fixed_logo', '=', true ),
        ),
        array(
            'id'       => 'show_mobile_logo',
            'type'     => 'switch',
            'title'    => __( 'Display the logo in the mobile side menu', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'replace_mobile_menu',
            'type'     => 'switch',
            'title'    => __( 'Replace mobile menu with custom menu', 'dina-kala' ),
            'subtitle' => __( 'Enabling this option will add a separate place for the mobile side menu to the menu management page.', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'focus_nav',
            'type'     => 'switch',
            'title'    => __( 'Page darkening', 'dina-kala' ),
            'subtitle' => __( 'Darken the page by hovering over the menu', 'dina-kala' ),
            'default'  => true,
        ),
        array(
            'id'       => 'remove_parent_link',
            'type'     => 'switch',
            'title'    => __( 'Remove the parent menus link', 'dina-kala' ),
            'subtitle' => __( 'Remove the parent menus link in the mobile menu', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'mobile_menu_text_style',
            'type'     => 'switch',
            'title'    => __( 'Mobile menu button text style', 'dina-kala' ),
            'subtitle' => __( 'Show mobile menu button in text style', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'mobile_menu_text',
            'type'     => 'text',
            'title'    => __( 'Mobile menu button text', 'dina-kala' ),
            'default'  => __( 'Menu', 'dina-kala' ),
            'required' => array( 'mobile_menu_text_style', '=', true ),
        ),
        array(
            'id'       => 'menu_label_text_color',
            'type'     => 'color',
            'title'    => __( 'Menu label text color', 'dina-kala' ),
            'subtitle' => __( 'The text color of the labels added from the menu management page', 'dina-kala' ),
            'default'  => '#ffffff',
            'validate' => 'color',
            'transparent' => false,
        ),
        array(
            'id'       => 'menu_label_bg_color',
            'type'     => 'color',
            'title'    => __( 'Menu label background color', 'dina-kala' ),
            'subtitle' => __( 'The background color of the labels added from the menu management page', 'dina-kala' ),
            'default'  => '#EF5350',
            'validate' => 'color',
            'transparent' => false,
        ),
        array(
            'id'     => 'menu-section-end',
            'type'   => 'section',
            'indent' => false,
       ),

       //menu-btn-section-start
       array(
        'id' => 'menu-btn-section-start',
        'type' => 'section',
        'title'    => __( 'Menu bar button settings', 'dina-kala' ),
        'indent' => true,
        ),
        array(
            'id'       => 'menu_bar_btn',
            'type'     => 'switch',
            'title'    => __( 'Menu bar button', 'dina-kala' ),
            'subtitle' => __( 'Display the button in the top menu of the site', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'menu_bar_btn_icon',
            'type'     => 'select',
            'select2'  => array( 'containerCssClass' => 'fal' ),
            'title'    => __( 'Button icon', 'dina-kala' ),
            'class'    => ' dina-font-icon',
            'default'  => 'fal fa-badge-percent',
            'options'  => $alliconArray,
            'required' => array( 'menu_bar_btn', '=', true ),
        ),
        array(
            'id'       => 'menu_bar_btn_color',
            'type'     => 'select',
            'title'    => __( 'Color', 'dina-kala' ),
            'options'  => array(
                'btn-outline-dina'  =>  __( 'Theme Color', 'dina-kala' ),
                'btn-outline-info'  =>  __( 'Blue', 'dina-kala' ),
                'btn-outline-primary'  =>  __( 'Dark Blue', 'dina-kala' ),
                'btn-outline-warning' =>  __( 'Yellow', 'dina-kala' ),
                'btn-outline-success'  =>  __( 'Green', 'dina-kala' ),
                'btn-outline-dark'  =>  __( 'Dark', 'dina-kala' ),
                'btn-outline-danger'  =>  __( 'Red', 'dina-kala' ),
                'btn-info'  =>  __( 'Solid Blue', 'dina-kala' ),
                'btn-primary'  =>  __( 'Solid Dark Blue', 'dina-kala' ),
                'btn-warning' =>  __( 'Solid Yellow', 'dina-kala' ),
                'btn-success'  =>  __( 'Solid Green', 'dina-kala' ),
                'btn-dark'  =>  __( 'Solid Dark', 'dina-kala' ),
                'btn-danger'  =>  __( 'Solid Red', 'dina-kala' )
            ),
            'default'  => 'btn-danger',
            'required' => array( 'menu_bar_btn', '=', true ),
        ),
        array(
            'id'       => 'menu_bar_btn_text',
            'type'     => 'text',
            'title'    => __( 'Button text', 'dina-kala' ),
            'default'  => __( 'Title', 'dina-kala' ),
            'required' => array( 'menu_bar_btn', '=', true ),
        ),
        array(
            'id'       => 'menu_bar_btn_link',
            'type'     => 'text',
            'title'    => __( 'Button link', 'dina-kala' ),
            'default'  => '#',
            'required' => array( 'menu_bar_btn', '=', true ),
        ),
        array(
            'id'     => 'menu-btn-section-end',
            'type'   => 'section',
            'indent' => false,
        ),
        //menu-btn-section-end

        array(
            'id' => 'search-section-start',
            'type' => 'section',
            'title'    => __( 'Search settings', 'dina-kala' ),
            'indent' => true,
        ),
        array(
            'id'       => 'mobile_search',
            'type'     => 'switch',
            'title'    => __( 'Move search box from site menu to site logo on mobile', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'ajax_search',
            'type'     => 'switch',
            'title'    => __( 'Ajax live search', 'dina-kala' ),
            'subtitle' => __( 'Enabling this feature will show search results by entering a keyword', 'dina-kala' ),
            'default'  => true,
        ),
        array(
            'id'       => 'ajax_count',
            'type'     => 'spinner', 
            'title'    => __( 'Number of Ajax search results', 'dina-kala' ),
            'default'  => '10',
            'min'      => '1',
            'step'     => '1',
            'max'      => '20',
            'required' => array( 'ajax_search', '=', true ),
        ),
        array(
            'id'       => 'ajax_delay',
            'type'     => 'spinner', 
            'title'    => __( 'Delay in displaying results (milliseconds)', 'dina-kala' ),
            'default'  => '50',
            'min'      => '50',
            'step'     => '50',
            'max'      => '5000',
            'required' => array( 'ajax_search', '=', true ),
        ),
        array(
            'id'       => 'ajax_min_chars',
            'type'     => 'spinner', 
            'title'    => __( 'Minimum character to start search', 'dina-kala' ),
            'default'  => '1',
            'min'      => '1',
            'step'     => '1',
            'max'      => '100',
            'required' => array( 'ajax_search', '=', true ),
        ),
        array(
            'id'       => 'ajax_search_stock',
            'type'     => 'switch',
            'title'    => __( 'Sort results by stock status', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'ajax_search', '=', true ),
        ),
        array(
            'id'       => 'hide_outstock_result',
            'type'     => 'switch',
            'title'    => __( 'Hide out of stock products', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'ajax_search', '=', true ),
        ),
        array(
            'id'       => 'search_cat',
            'type'     => 'switch',
            'title'    => __( 'Show Search Category', 'dina-kala' ),
            'subtitle' => __( 'Show category box in search section', 'dina-kala' ),
            'default'  => true,
        ),
        array(
            'id'       => 'search_cat_sort',
            'type'     => 'switch',
            'title'    => __( 'Sort categories alphabetically', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'search_cat', '=', true )
        ),
        array(
            'id'       => 'search_cat_hierarchical',
            'type'     => 'switch',
            'title'    => __( 'Display hierarchy', 'dina-kala' ),
            'default'  => true,
            'required' => array( 'search_cat', '=', true )
        ),
        array(
            'id'       => 'search_cat_parent',
            'type'     => 'switch',
            'title'    => __( 'Parent categories only', 'dina-kala' ),
            'subtitle' => __( 'By activating this option, only the first level categories are displayed', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'search_cat', '=', true )
        ),
        array(
            'id'    => 'search_cat_cats',
            'type'     => 'select',
            'ajax'     => true,
            'multi'    => true,
            'title'    => __( 'Hide categories', 'dina-kala' ), 
            'subtitle' => __( 'Selected categories are not displayed in the search box', 'dina-kala' ),
            'data'  => 'terms',
            'args'  => array(
                'taxonomies' => array( 'product_cat' ),
                'hide_empty' => false,
            ),
            'required' => array( 'search_cat', '=', true )
        ),
        array(
            'id'       => 'search_others',
            'type'     => 'switch',
            'title'    => __( 'Search pages and posts', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'search_by_sku',
            'type'     => 'switch',
            'title'    => __( 'Search by product SKU', 'dina-kala' ),
            'default'  => true,
        ),
        array(
            'id'       => 'replace_search_shortcode',
            'type'     => 'switch',
            'title'    => __( 'Insert shortcode instead of search form', 'dina-kala' ),
            'subtitle' => __( 'The content of this shortcode will be displayed instead of the search box', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'search_shortcode',
            'type'     => 'text',
            'title'    => __( 'Search shortcode', 'dina-kala' ),
            'subtitle'  => __( 'With this feature, you can use the shortcode of other search plugins', 'dina-kala' ),
            'required' => array( 'replace_search_shortcode', '=', true ),
        ),
        array(
            'id'     => 'search-section-end',
            'type'   => 'section',
            'indent' => false,
        ),

        
        array(
            'id' => 'user-btn-section-start',
            'type' => 'section',
            'title'    => __( 'Settings of user buttons', 'dina-kala' ),
            'indent' => true,
        ),
        array(
            'id'       => 'show_user_btn',
            'type'     => 'switch',
            'title'    => __( 'User Buttons', 'dina-kala' ),
            'subtitle' => __( 'Show user buttons (login, register and user menu) in the header section', 'dina-kala' ),
            'default'  => true,
        ),
        array(
            'id'       => 'user_btn_style',
            'type'     => 'switch',
            'title'    => __( 'User Buttons Text style', 'dina-kala' ),
            'subtitle' => __( 'Show user buttons (login and register) in text style', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'show_user_btn', '=', true ),
        ),
        array(
            'id'       => 'mobile_user_btn_style',
            'type'     => 'switch',
            'title'    => __( 'Text style of user buttons in mobile mode', 'dina-kala' ),
            'subtitle' => __( 'Show user buttons (login and register) in text style in mobile mode', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'show_user_btn', '=', true ),
        ),
        
        array(
            'id'       => 'replace_user_menu',
            'type'     => 'switch',
            'title'    => __( 'Replace the user menu with a custom menu', 'dina-kala' ),
            'subtitle' => __( 'Added a place in WordPress menus to replace the user menu (this menu options are displayed instead of the user menu)', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'show_user_btn', '=', true ),
        ),
        array(
            'id'       => 'replace_userbtns_shortcode',
            'type'     => 'switch',
            'title'    => __( 'Insert shortcode instead of user buttons', 'dina-kala' ),
            'subtitle' => __( 'The content of this shortcode will be displayed instead of the user buttons', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'userbtns_shortcode',
            'type'     => 'text',
            'title'    => __( 'User buttons shortcode', 'dina-kala' ),
            'subtitle'  => __( 'With this feature, you can use the shortcode of other user panel plugins', 'dina-kala' ),
            'required' => array( 'replace_userbtns_shortcode', '=', true ),
        ),
        array(
            'id' => 'user-btn-section-end',
            'type' => 'section',
            'indent' => false,
        ),

        array(
            'id' => 'msg-section-start',
            'type' => 'section',
            'title'    => __( 'Message section settings', 'dina-kala' ),
            'indent' => true,
        ),
        array(
            'id'       => 'show_msg',
            'type'     => 'switch',
            'title'    => __( 'Show message', 'dina-kala' ),
            'subtitle' => __( 'Show message section', 'dina-kala' ),
            'default'  => true,
        ),
        array(
            'id'       => 'hide_msg_logged',
            'type'     => 'switch',
            'title'    => __( 'Hide for logged in users', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'show_msg', '=', true )
        ),
        array(
            'id'=>'site_msg',
            'type' => 'textarea',
            'title'    => __( 'Text message', 'dina-kala' ),
            'default' => __( 'Sell Easy with DinaKala and Start Making Your Internet Money!', 'dina-kala' ),
            'allowed_html' => array(
                'a' => array(
                    'href' => array(),
                    'title'    => array()
                ),
                'br' => array(),
                'em' => array(),
                'strong' => array()
            ),
            'required' => array(
                array( 'show_msg', '=', true ), 
                array( 'show_img_msg', '!=', true ) 
            )
        ),
        array(
            'id'       => 'msg_icon',
            'type'     => 'select',
            'select2'  => array( 'containerCssClass' => 'fa' ),
            'title'    => __( 'Icon', 'dina-kala' ),
            'class'    => ' dina-font-icon',
            'default'  => 'fal fa-bell',
            'options'  => $alliconArray,
            'required' => array( 
                array( 'show_msg', '=', true ), 
                array( 'show_img_msg', '!=', true ) 
            )
        ),
        array(
            'id'       => 'msg_btn',
            'type'     => 'switch',
            'title'    => __( 'Show button', 'dina-kala' ),
            'default'  => false,
            'required' => array( 
                array( 'show_msg', '=', true ), 
                array( 'show_img_msg', '!=', true ) 
            )
        ),
        array(
            'id'       => 'msg_btn_icon',
            'type'     => 'select',
            'select2'  => array( 'containerCssClass' => 'fa' ),
            'title'    => __( 'Button icon', 'dina-kala' ),
            'class'    => ' dina-font-icon',
            'default'  => 'fal fa-arrow-left',
            'options'  => $alliconArray,
            'required' => array( 
                array( 'msg_btn', '=', true ), 
                array( 'show_img_msg', '!=', true ) 
            )
        ),
        array(
            'id'       => 'msg_btn_icon_before',
            'type'     => 'switch',
            'title'    => __( 'Show icon before text', 'dina-kala' ),
            'default'  => false,
            'required' => array( 
                array( 'msg_btn', '=', true ), 
                array( 'show_img_msg', '!=', true ) 
            )
        ),
        array(
            'id'       => 'msg_btn_color',
            'type'     => 'select',
            'title'    => __( 'Button color', 'dina-kala' ),
            'options'  => array(
                'btn-outline-dina'  =>  __( 'Theme Color', 'dina-kala' ),
                'btn-outline-info'  =>  __( 'Blue', 'dina-kala' ),
                'btn-outline-primary'  =>  __( 'Dark Blue', 'dina-kala' ),
                'btn-outline-warning' =>  __( 'Yellow', 'dina-kala' ),
                'btn-outline-success'  =>  __( 'Green', 'dina-kala' ),
                'btn-outline-dark'  =>  __( 'Dark', 'dina-kala' ),
                'btn-outline-danger'  =>  __( 'Red', 'dina-kala' ),
                'btn-info'  =>  __( 'Solid Blue', 'dina-kala' ),
                'btn-primary'  =>  __( 'Solid Dark Blue', 'dina-kala' ),
                'btn-warning' =>  __( 'Solid Yellow', 'dina-kala' ),
                'btn-success'  =>  __( 'Solid Green', 'dina-kala' ),
                'btn-dark'  =>  __( 'Solid Dark', 'dina-kala' ),
                'btn-danger'  =>  __( 'Solid Red', 'dina-kala' )
            ),
            'default'  => 'btn-success',
            'required' => array( 'msg_btn', '=', true ),
        ),
        array(
            'id'       => 'msg_btn_text',
            'type'     => 'text',
            'title'    => __( 'Button text', 'dina-kala' ),
            'default'  => __( 'View and buy', 'dina-kala' ),
            'required' => array( 'msg_btn', '=', true ),
        ),
        array(
            'id'       => 'msg_btn_link',
            'type'     => 'text',
            'title'    => __( 'Button link', 'dina-kala' ),
            'default'  => '#',
            'required' => array( 'msg_btn', '=', true ),
        ),
        array(
            'id'       => 'user_close',
            'type'     => 'switch',
            'title'    => __( 'User closure', 'dina-kala' ),
            'default'  => true,
            'required' => array( 
                array( 'show_msg', '=', true ), 
                array( 'show_img_msg', '!=', true ) 
            )
        ),
        array(
            'id'       => 'msg_reshown',
            'type'     => 'text',
            'validate' => 'numeric',
            'title'    => __( 'Show again after a few days', 'dina-kala' ),
            'subtitle' => __( 'After this time, message section will be displayed again, enter 0 to not display.', 'dina-kala' ),
            'default'  => 0,
            'required' => array( 'user_close', '=', true ),
        ),
        array(
        'id'       => 'msg_bgcolor',
        'type'     => 'color',
        'title'    => __( 'Background color', 'dina-kala' ),
        'default'  => '#37474F',
        'validate' => 'color',
        'transparent' => false,
        'required' => array( 
            array( 'show_msg', '=', true ), 
            array( 'show_img_msg', '!=', true ) 
        )
        ),
        array(
        'id'       => 'msg_fcolor',
        'type'     => 'color',
        'title'    => __( 'Text message color', 'dina-kala' ),
        'default'  => '#ffffff',
        'validate' => 'color',
        'transparent' => false,
        'required' => array( 
            array( 'show_msg', '=', true ), 
            array( 'show_img_msg', '!=', true ) 
        )
        ),
        //show_img_msg
        array(
            'id'       => 'show_img_msg',
            'type'     => 'switch',
            'title'    => __( 'Replace the message with an image', 'dina-kala' ),
            'subtitle' => __( 'By activating this option, the image you want will be displayed instead of the message at the top of the site', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'show_msg', '=', true ),
        ),
        array(
            'id'       => 'img_msg_image',
            'type'     => 'media',
            'url'      => true,
            'readonly' => false,
            'title'    => __( 'Message image', 'dina-kala' ),
            'compiler' => 'true',
            'mode'      => false,
            'desc'     => __( 'Upload your message image.', 'dina-kala' ),
            'subtitle' => __( 'Appropriate size: 2560 pixel(w) in 60 pixel(h). This image is displayed in different screen sizes, cut from the sides and is not displayed in mobile mode. Place the subject of the image in the center of the image.', 'dina-kala' ),
            'required' => array( 'show_img_msg', '=', true ),
        ),
        array(
            'id'       => 'img_msg_image_mobile',
            'type'     => 'media',
            'url'      => true,
            'readonly' => false,
            'title'    => __( 'Mobile message image', 'dina-kala' ),
            'compiler' => 'true',
            'mode'      => false,
            'desc'     => __( 'Upload your message image for mobile devices.', 'dina-kala' ),
            'subtitle' => __( 'Appropriate size: 425 pixel(w) in 60 pixel(h). This image is displayed in mobile mode. Place the subject of the image in the center of the image.', 'dina-kala' ),
            'required' => array( 'show_img_msg', '=', true ),
        ),
        array(
            'id'       => 'img_msg_title',
            'type'     => 'text',
            'title'    => __( 'Message image title', 'dina-kala' ),
            'default'  => __( 'Image title', 'dina-kala' ),
            'required' => array( 'show_img_msg', '=', true ),
        ),
        array(
            'id'       => 'img_msg_link',
            'type'     => 'text',
            'title'    => __( 'Message image link', 'dina-kala' ),
            'default'  => '#',
            'required' => array( 'show_img_msg', '=', true ),
        ),
        array(
            'id' => 'msg-section-end',
            'type' => 'section',
            'indent' => false,
        ),

        array(
            'id' => 'contact-section-start',
            'type' => 'section',
            'title'    => __( 'Contact information settings', 'dina-kala' ),
            'indent' => true,
        ),
        array(
            'id'       => 'show_head_social',
            'type'     => 'switch',
            'title'    => __( 'Show social networks in header', 'dina-kala' ),
            'subtitle' => __( 'Show social networks instead of contact information', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'show_head_social_mobile',
            'type'     => 'switch',
            'title'    => __( 'Show social networks in mobile mode', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'show_head_social', '=', true ),
        ),

        array(
            'id'       => 'show_contact',
            'type'     => 'switch',
            'title'    => __( 'Contact information', 'dina-kala' ),
            'subtitle' => __( 'Show contact information', 'dina-kala' ),
            'default'  => true,
            'required' => array( 'show_head_social', '!=', true ),
        ),
        array(
            'id'       => 'show_contact_mobile',
            'type'     => 'switch',
            'title'    => __( 'Show contact information in mobile mode', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'show_contact', '=', true ),
        ),
        array(
            'id'       => 'site_tel_link',
            'type'     => 'switch',
            'title'    => __( 'Linking phone', 'dina-kala' ),
            'default'  => true,
            'required' => array( 'show_contact', '=', true ),
        ),
        array(
            'id'       => 'custom_tel_link',
            'type'     => 'switch',
            'title'    => __( 'Link phone number to desired address', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'site_tel_link', '=', true ),
        ),
        array(
            'id'       => 'custom_tel_link_addr',
            'type'     => 'text',
            'title'    => __( 'Phone number link', 'dina-kala' ),
            'default'  => '#',
            'required' => array( 'custom_tel_link', '=', true ),
        ),
        array(
            'id'       => 'site_email_link',
            'type'     => 'switch',
            'title'    => __( 'Linking email', 'dina-kala' ),
            'default'  => true,
            'required' => array( 'show_contact', '=', true ),
        ),
        array(
            'id'       => 'custom_email_link',
            'type'     => 'switch',
            'title'    => __( 'Link email to desired address', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'site_email_link', '=', true ),
        ),
        array(
            'id'       => 'custom_email_link_addr',
            'type'     => 'text',
            'title'    => __( 'Email link', 'dina-kala' ),
            'default'  => '#',
            'required' => array( 'custom_email_link', '=', true ),
        ),
        array(
            'id'       => 'contact_link_nofollow',
            'type'     => 'switch',
            'title'    => __( 'Add nofollow property to links', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'show_contact', '=', true )
        ),
        array(
            'id'      => 'contact_link_target',
            'type'    => 'select',
            'title'   => __( 'Links Target', 'dina-kala' ),
            'options' => array(
                '_blank' => __( 'New Window', 'dina-kala' ),
                '_self'  => __( 'Same Window', 'dina-kala' ),
            ),
            'default'  => '_blank',
            'required' => array( 'show_contact', '=', true )
        ),
        array(
            'id'       => 'site_tel',
            'type'     => 'text',
            'title'    => __( 'Phone', 'dina-kala' ),
            'default'  => '09123332222',
        ),
        array(
            'id'       => 'replace_email',
            'type'     => 'switch',
            'title'    => __( 'Replace email with phone', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'site_email',
            'type'     => 'text',
            'title'    => __( 'Email', 'dina-kala' ),
            'default'  => 'info@site.com',
            'required' => array( 'replace_email', '!=', true )
        ),
        array(
            'id'       => 'site_tel2',
            'type'     => 'text',
            'title'    => __( 'Phone2', 'dina-kala' ),
            'default'  => '09123332222',
            'required' => array( 'replace_email', '=', true ),
        ),
        array(
            'id' => 'contact-section-end',
            'type' => 'section',
            'indent' => false,
        ),
        //contact-section-end

        //hstyle-section-start
        array(
            'id' => 'hstyle-section-start',
            'type' => 'section',
            'title'    => __( 'Header style settings', 'dina-kala' ),
            'indent' => true,
        ),
        array(
        'id'       => 'head_bg_color',
        'type'     => 'color',
        'title'    => __( 'Header background color', 'dina-kala' ),
        'subtitle' => __( 'Choose the color scheme for the site header background color', 'dina-kala' ),
        'default'  => '#ffffff',
        'validate' => 'color',
        'transparent' => false,
        ),
        array(
        'id'       => 'head_text_color',
        'type'     => 'color',
        'title'    => __( 'Header text color', 'dina-kala' ),
        'subtitle' => __( 'Choose the color scheme for the site header text color', 'dina-kala' ),
        'default'  => '#505763',
        'validate' => 'color',
        'transparent' => false,
        ),
        array(
        'id'       => 'menu_bg_color',
        'type'     => 'color',
        'title'    => __( 'Primary menu background color', 'dina-kala' ),
        'subtitle' => __( 'Choose the color scheme for the primary menu background color', 'dina-kala' ),
        'default'  => '#F7F6F6',
        'validate' => 'color',
        'transparent' => false,
        ),
        array(
        'id'       => 'menu_text_color',
        'type'     => 'color',
        'title'    => __( 'Primary menu text color', 'dina-kala' ),
        'subtitle' => __( 'Choose the color scheme for the primary menu text color', 'dina-kala' ),
        'default'  => '#4D4D4D',
        'validate' => 'color',
        'transparent' => false,
        ),
        array(
            'id' => 'hstyle-section-end',
            'type' => 'section',
            'indent' => false ,
        ),

        array(
            'id' => 'head-banner-section-start',
            'type' => 'section',
            'title'    => __( 'Header advertising banner settings', 'dina-kala' ),
            'subtitle' => __( 'This banner is displayed on the archive pages, postd and products at the bottom of the breadcrumbs.', 'dina-kala' ),
            'indent' => true,
        ),
        array(
            'id'       => 'show_head_banner',
            'type'     => 'switch',
            'title'    => __( 'Show header banner', 'dina-kala' ),
            'default'  => false
        ),
        array(
            'id'       => 'show_head_mobile',
            'type'     => 'switch',
            'title'    => __( 'Show header banner in mobile mode', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'show_head_banner', '=', true ),
        ),
        array(
            'id'       => 'head_banner',
            'type'     => 'media',
            'url'      => true,
            'readonly' => false,
            'title'    => __( 'Header banner image', 'dina-kala' ),
            'compiler' => 'true',
            'subtitle' =>  __( 'Appropriate size: 1260 pixel(w) in 142 pixel(h)', 'dina-kala' ),
            'required' => array( 'show_head_banner', '=', true ),
        ),
        array(
            'id'       => 'head_banner_mobile',
            'type'     => 'media',
            'url'      => true,
            'readonly' => false,
            'title'    => __( 'Header banner image in mobile mode', 'dina-kala' ),
            'compiler' => 'true',
            'subtitle' =>  __( 'If it is empty, the desktop mode image will be used', 'dina-kala' ),
            'required' => array( 'show_head_mobile', '=', true ),
        ),
        array(
            'id'       => 'head_banner_link',
            'type'     => 'text',
            'title'    => __( 'Header banner link', 'dina-kala' ),
            'default'  => '#',
            'required' => array( 'show_head_banner', '=', true ),
        ),
        array(
            'id'       => 'head_banner_title',
            'type'     => 'text',
            'title'    => __( 'Header banner title', 'dina-kala' ),
            'default'  => '#',
            'required' => array( 'show_head_banner', '=', true ),
        ),
        array(
            'id'       => 'head_banner_newtab',
            'type'     => 'switch',
            'title'    => __( 'Open the link in a new tab', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'show_head_banner', '=', true ),
        ),
        array(
            'id'       => 'head_banner_nofollow',
            'type'     => 'switch',
            'title'    => __( 'Add nofollow property to link', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'show_head_banner', '=', true ),
        ),
        array(
            'id' => 'head-banner-section-end',
            'type' => 'section',
            'indent' => false ,
        ),

    )
) );

Redux::setSection( $opt_name, array(
    'title'      => __( 'Footer settings', 'dina-kala' ),
    'icon'       => 'fal fa-columns',
    'id'         => 'footer-setting',
    'subsection' => true,
    'desc'       => __( 'Customize site footer', 'dina-kala' ),
    'fields'     => array(
        array( 
            'id'       => 'footer_setting_docs',
            'type'     => 'raw',
            'content'  => dina_admin_info( '', 'https://i-design.ir/docs/dinakala/?p=2191', 'info' )
        ),
        array(
            'id'       => 'footer_widgets',
            'type'     => 'image_select',
            'title'    =>  __( 'Footer widgets columns', 'dina-kala' ),
            'options'  => array(
                '4' => array(
                    'alt' => __( 'Four columns', 'dina-kala' ),
                    'img' => RE_URI . 'assets/img/4col.png'
                ),
                '3' => array(
                    'alt' => __( 'Three columns', 'dina-kala' ),
                    'img' => RE_URI . 'assets/img/3col.png'
                ),
            ),
            'default'  => '4'
        ),
        array(
            'id'       => 'hide_footer',
            'type'     => 'switch',
            'title'    => __( 'Hide footer in mobile mode', 'dina-kala' ),
            'subtitle' => __( 'Hide footer section include footer widgets, info bar, address and application icons in mobile mode', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'show_footer_social',
            'type'     => 'switch',
            'title'    => __( 'Show social networks', 'dina-kala' ),
            'subtitle' => __( 'Show social network links in footer', 'dina-kala' ),
            'default'  => true,
        ),
        array(
            'id'       => 'footer_social_circle',
            'type'     => 'switch',
            'title'    => __( 'Circle style', 'dina-kala' ),
            'default'  => true,
            'required' => array( 'show_footer_social', '=', true ),
        ),

        //footer-widgets-section-start
        array(
            'id' => 'footer-widgets-section-start',
            'type' => 'section',
            'title'    => __( 'Footer Widgets Settings', 'dina-kala' ),
            'indent' => true,
        ),
        array(
            'id'       => 'hide_footer_widgets',
            'type'     => 'switch',
            'title'    => __( 'Hiding footer widgets in mobile mode', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'footer_widgets',
            'type'     => 'image_select',
            'title'    =>  __( 'Number of footer widgets columns', 'dina-kala' ),
            'options'  => array(
                '4' => array(
                    'alt' => __( 'Four columns', 'dina-kala' ),
                    'img' => RE_URI . 'assets/img/4col.png'
                ),
                '3' => array(
                    'alt' => __( 'Three columns', 'dina-kala' ),
                    'img' => RE_URI . 'assets/img/3col.png'
                ),
            ),
            'default'  => '4'
        ),
        array(
            'id'       => 'footer_widgets_mobile',
            'type'     => 'image_select',
            'title'    =>  __( 'Number of columns of footer widgets in mobile mode', 'dina-kala' ),
            'options'  => array(
                '1' => array(
                    'alt' => __( 'One columns', 'dina-kala' ),
                    'img' => RE_URI . 'assets/img/1col.png'
                ),
                '2' => array(
                    'alt' => __( 'Two columns', 'dina-kala' ),
                    'img' => RE_URI . 'assets/img/2col.png'
                ),
            ),
            'default'  => '1',
            'required' => array( 'hide_footer_widgets', '!=', true ),
        ),
        array(
            'id'       => 'footer_widgets_title_tag',
            'type'     => 'select',
            'title'    => __( 'Footer widgets title tag', 'dina-kala' ),
            'options'  => array(
                'div' => __( 'div', 'dina-kala' ),
                'h2'  => __( 'h2', 'dina-kala' ),
                'h3'  => __( 'h3', 'dina-kala' ),
                'h4'  => __( 'h4', 'dina-kala' ),
                'h5'  => __( 'h5', 'dina-kala' ),
            ),
            'default'  => 'h3',
        ),
        array(
            'id' => 'footer-widgets-section-end',
            'type' => 'section',
            'indent' => false,
        ),

        //info-section-start
        array(
            'id' => 'info-section-start',
            'type' => 'section',
            'title'    => __( 'Site information settings', 'dina-kala' ),
            'indent' => true,
        ),
        array(
            'id'       => 'show_info_bar',
            'type'     => 'switch',
            'title'    => __( 'Site information section', 'dina-kala' ),
            'subtitle' => __( 'Display information section in the footer section to show the number of users, purchases and ...', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'info_bar_prods',
            'type'     => 'switch',
            'title'    => __( 'Show products count', 'dina-kala' ),
            'default'  => true,
            'required' => array( 'show_info_bar', '=', true ),
        ),
        array(
            'id'       => 'edit_bar_prods',
            'type'     => 'switch',
            'title'    => __( 'Edit products count', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'info_bar_prods', '=', true ),
        ),
        array(
            'id'       => 'bar_prods_title',
            'type'     => 'text',
            'title'    => __( 'Products count title', 'dina-kala' ),
            'default'  => __( 'Products', 'dina-kala' ),
            'required' => array( 'edit_bar_prods', '=', true ),
        ),
        array(
            'id'       => 'bar_prods_value',
            'type'     => 'text',
            'title'    => __( 'Products count value', 'dina-kala' ),
            'desc'     => __( 'You can also use the shortcode', 'dina-kala' ),
            'default'  => '+1',
            'required' => array( 'edit_bar_prods', '=', true ),
        ),
        array(
            'id'       => 'bar_prods_icon',
            'type'     => 'select',
            'select2'  => array( 'containerCssClass' => 'fa' ),
            'title'    => __( 'Products count icon', 'dina-kala' ),
            'class'    => ' dina-font-icon',
            'default'  => 'fal fa-shopping-bag',
            'options'  => $alliconArray,
            'required' => array( 'edit_bar_prods', '=', true ),
        ),
        array(
            'id'       => 'info_bar_sales',
            'type'     => 'switch',
            'title'    => __( 'Show sales count', 'dina-kala' ),
            'default'  => true,
            'required' => array( 'show_info_bar', '=', true ),
        ),
        array(
            'id'       => 'info_bar_sales_status',
            'type'     => 'select',
            'title'    => __( 'Orders status', 'dina-kala' ),
            'default'  => 'wc-completed',
            'options'  => class_exists( 'WooCommerce' ) ? wc_get_order_statuses() : '',
            'required' => array(
                            array( 'info_bar_sales', '=', true ),
                            array( 'edit_bar_sales', '!=', true )
                        )
        ),
        array(
            'id'       => 'edit_bar_sales',
            'type'     => 'switch',
            'title'    => __( 'Edit sales count', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'info_bar_sales', '=', true ),
        ),
        array(
            'id'       => 'bar_sales_title',
            'type'     => 'text',
            'title'    => __( 'Sales count title', 'dina-kala' ),
            'default'  => __( 'Order completed', 'dina-kala' ),
            'required' => array( 'edit_bar_sales', '=', true ),
        ),
        array(
            'id'       => 'bar_sales_value',
            'type'     => 'text',
            'title'    => __( 'Sales count value', 'dina-kala' ),
            'desc'     => __( 'You can also use the shortcode', 'dina-kala' ),
            'default'  => '+1',
            'required' => array( 'edit_bar_sales', '=', true ),
        ),
        array(
            'id'       => 'bar_sales_icon',
            'type'     => 'select',
            'select2'  => array( 'containerCssClass' => 'fa' ),
            'title'    => __( 'Sales count icon', 'dina-kala' ),
            'class'    => ' dina-font-icon',
            'default'  => 'fal fa-box-check',
            'options'  => $alliconArray,
            'required' => array( 'edit_bar_sales', '=', true ),
        ),
        array(
            'id'       => 'info_bar_users',
            'type'     => 'switch',
            'title'    => __( 'Show users count', 'dina-kala' ),
            'default'  => true,
            'required' => array( 'show_info_bar', '=', true ),
        ),
        array(
            'id'       => 'edit_bar_users',
            'type'     => 'switch',
            'title'    => __( 'Edit users count', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'info_bar_users', '=', true ),
        ),
        array(
            'id'       => 'bar_users_title',
            'type'     => 'text',
            'title'    => __( 'Users count title', 'dina-kala' ),
            'default'  => __( 'Members', 'dina-kala' ),
            'required' => array( 'edit_bar_users', '=', true ),
        ),
        array(
            'id'       => 'bar_users_value',
            'type'     => 'text',
            'title'    => __( 'Users count value', 'dina-kala' ),
            'desc'     => __( 'You can also use the shortcode', 'dina-kala' ),
            'default'  => '+1',
            'required' => array( 'edit_bar_users', '=', true ),
        ),
        array(
            'id'       => 'bar_users_icon',
            'type'     => 'select',
            'select2'  => array( 'containerCssClass' => 'fa' ),
            'title'    => __( 'Users count icon', 'dina-kala' ),
            'class'    => ' dina-font-icon',
            'default'  => 'fal fa-users',
            'options'  => $alliconArray,
            'required' => array( 'edit_bar_users', '=', true ),
        ),
        array(
            'id'       => 'info_bar_posts',
            'type'     => 'switch',
            'title'    => __( 'Show posts count', 'dina-kala' ),
            'default'  => true,
            'required' => array( 'show_info_bar', '=', true ),
        ),
        array(
            'id'       => 'edit_bar_posts',
            'type'     => 'switch',
            'title'    => __( 'Edit posts count', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'info_bar_posts', '=', true ),
        ),
        array(
            'id'       => 'bar_posts_title',
            'type'     => 'text',
            'title'    => __( 'Posts count title', 'dina-kala' ),
            'default'  => __( 'Blog content', 'dina-kala' ),
            'required' => array( 'edit_bar_posts', '=', true ),
        ),
        array(
            'id'       => 'bar_posts_value',
            'type'     => 'text',
            'title'    => __( 'Posts count value', 'dina-kala' ),
            'desc'     => __( 'You can also use the shortcode', 'dina-kala' ),
            'default'  => '+1',
            'required' => array( 'edit_bar_posts', '=', true ),
        ),
        array(
            'id'       => 'bar_posts_icon',
            'type'     => 'select',
            'select2'  => array( 'containerCssClass' => 'fa' ),
            'title'    => __( 'Posts count icon', 'dina-kala' ),
            'class'    => ' dina-font-icon',
            'default'  => 'fal fa-file-alt',
            'options'  => $alliconArray,
            'required' => array( 'edit_bar_posts', '=', true ),
        ),

        array(
            'id'       => 'active_bar_info5',
            'type'     => 'switch',
            'title'    => __( 'Activating the fifth icon', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'show_info_bar', '=', true ),
        ),
        array(
            'id'       => 'bar_info5_title',
            'type'     => 'text',
            'title'    => __( 'Fifth icon title', 'dina-kala' ),
            'default'  => __( 'Title', 'dina-kala' ),
            'required' => array( 'active_bar_info5', '=', true ),
        ),
        array(
            'id'       => 'bar_info5_value',
            'type'     => 'text',
            'title'    => __( 'Fifth icon value', 'dina-kala' ),
            'desc'     => __( 'You can also use the shortcode', 'dina-kala' ),
            'default'  => '+1',
            'required' => array( 'active_bar_info5', '=', true ),
        ),
        array(
            'id'       => 'bar_info5_icon',
            'type'     => 'select',
            'select2'  => array( 'containerCssClass' => 'fa' ),
            'title'    => __( 'Fifth icon', 'dina-kala' ),
            'class'    => ' dina-font-icon',
            'default'  => 'fal fa-file-alt',
            'options'  => $alliconArray,
            'required' => array( 'active_bar_info5', '=', true ),
        ),

        array(
            'id'       => 'active_bar_info6',
            'type'     => 'switch',
            'title'    => __( 'Activating the sixth icon', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'show_info_bar', '=', true ),
        ),
        array(
            'id'       => 'bar_info6_title',
            'type'     => 'text',
            'title'    => __( 'Sixth icon title', 'dina-kala' ),
            'default'  => __( 'Title', 'dina-kala' ),
            'required' => array( 'active_bar_info6', '=', true ),
        ),
        array(
            'id'       => 'bar_info6_value',
            'type'     => 'text',
            'title'    => __( 'Sixth icon value', 'dina-kala' ),
            'desc'     => __( 'You can also use the shortcode', 'dina-kala' ),
            'default'  => '+1',
            'required' => array( 'active_bar_info6', '=', true ),
        ),
        array(
            'id'       => 'bar_info6_icon',
            'type'     => 'select',
            'select2'  => array( 'containerCssClass' => 'fa' ),
            'title'    => __( 'Sixth icon', 'dina-kala' ),
            'class'    => ' dina-font-icon',
            'default'  => 'fal fa-file-alt',
            'options'  => $alliconArray,
            'required' => array( 'active_bar_info6', '=', true ),
        ),
        array(
            'id' => 'info-section-end',
            'type' => 'section',
            'indent' => false,
        ),
        //info-section-end

        //addr-section-start
        array(
            'id' => 'addr-section-start',
            'type' => 'section',
            'title'    => __( 'Address section settings', 'dina-kala' ),
            'indent' => true,
        ),
        array(
            'id'       => 'show_addr',
            'type'     => 'switch',
            'title'    => __( 'Address section', 'dina-kala' ),
            'subtitle' => __( 'Display the Address section in the footer', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'show_faddr',
            'type'     => 'switch',
            'title'    => __( 'View Address', 'dina-kala' ),
            'subtitle' => __( 'View Address in the footer', 'dina-kala' ),
            'default'  => true,
            'required' => array( 'show_addr', '=', true ),
        ),
        array(
            'id'       => 'addr_text',
            'type'     => 'text',
            'title'    => __( 'Address', 'dina-kala' ),
            'default'  => __( 'Tehran Province, Tehran, Central Street, Central Building, No. 7', 'dina-kala' ),
            'required' => array( 'show_faddr', '=', true ),
        ),
        array(
            'id'       => 'show_ftel',
            'type'     => 'switch',
            'title'    => __( 'View phone', 'dina-kala' ),
            'subtitle' => __( 'View phone in the footer', 'dina-kala' ),
            'desc'     => __( 'You can change the phone number from "Theme Settings > General settings > Header settings > Contact information settings".', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'show_addr', '=', true ),
        ),
        array(
            'id'       => 'site_ftel_link',
            'type'     => 'switch',
            'title'    => __( 'Linking phone', 'dina-kala' ),
            'default'  => true,
            'required' => array( 'show_ftel', '=', true ),
        ),
        array(
            'id'       => 'custom_ftel_link',
            'type'     => 'switch',
            'title'    => __( 'Link phone number to desired address', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'site_ftel_link', '=', true ),
        ),
        array(
            'id'       => 'custom_ftel_link_addr',
            'type'     => 'text',
            'title'    => __( 'Phone number link', 'dina-kala' ),
            'default'  => '#',
            'required' => array( 'custom_ftel_link', '=', true ),
        ),
        array(
            'id'       => 'show_fmail',
            'type'     => 'switch',
            'title'    => __( 'View email', 'dina-kala' ),
            'subtitle' => __( 'View email in the footer', 'dina-kala' ),
            'desc'     => __( 'You can change the email from "Theme Settings > General settings > Header settings > Contact information settings".', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'show_addr', '=', true ),
        ),
        array(
            'id'       => 'site_fmail_link',
            'type'     => 'switch',
            'title'    => __( 'Linking email', 'dina-kala' ),
            'default'  => true,
            'required' => array( 'show_fmail', '=', true ),
        ),
        array(
            'id'       => 'custom_fmail_link',
            'type'     => 'switch',
            'title'    => __( 'Link email to desired address', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'site_fmail_link', '=', true ),
        ),
        array(
            'id'       => 'custom_fmail_link_addr',
            'type'     => 'text',
            'title'    => __( 'Email link', 'dina-kala' ),
            'default'  => '#',
            'required' => array( 'custom_fmail_link', '=', true ),
        ),
        array(
            'id'       => 'show_apps',
            'type'     => 'switch',
            'title'    => __( 'Application Buttons', 'dina-kala' ),
            'subtitle' => __( 'Display application buttons in the footer', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'show_addr', '=', true ),
        ),
        array(
            'id'       => 'apps_btn_style',
            'type'     => 'select',
            'title'    => __( 'Button style', 'dina-kala' ),
            'options'  => array(
                'btn-outline'  =>  __( 'Outline Style', 'dina-kala' ),
                'btn'  =>  __( 'Solid style', 'dina-kala' ),
            ),
            'default'  => 'btn-outline',
            'required' => array( 'show_apps', '=', true ),
        ),
        array(
            'id'       => 'and_link',
            'type'     => 'text',
            'title'    => __( 'Android Link', 'dina-kala' ),
            'default'  => '#',
            'required' => array( 'show_apps', '=', true ),
        ),
        array(
            'id'       => 'ios_link',
            'type'     => 'text',
            'title'    => __( 'IOS Link', 'dina-kala' ),
            'default'  => '#',
            'required' => array( 'show_apps', '=', true ),
        ),
        array(
            'id' => 'addr-section-end',
            'type' => 'section',
            'indent' => false,
        ),
        //addr-section-end

        //alert-app-section-start
        array(
            'id' => 'alert-app-section-start',
            'type' => 'section',
            'title'    => __( 'Application download bar settings', 'dina-kala' ),
            'indent' => true,
        ),
        array(
            'id'       => 'show_alert_app',
            'type'     => 'switch',
            'title'    => __( 'Application download bar', 'dina-kala' ),
            'subtitle' => __( 'Show application download bar on mobile', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'alert_app_title',
            'type'     => 'text',
            'title'    => __( 'Download bar title', 'dina-kala' ),
            'default'  => __( 'Optimal display in mobile application' , 'dina-kala' ),
            'required' => array( 'show_alert_app', '=', true ),
        ),
        array(
            'id' => 'alert-app-section-end',
            'type' => 'section',
            'indent' => false,
        ),
        //alert-app-section-end

        //ftext-section-start
        array(
            'id' => 'ftext-section-start',
            'type' => 'section',
            'title'    => __( 'Footer text settings', 'dina-kala' ),
            'indent' => true,
        ),
        array(
            'id'       => 'show_footer_text',
            'type'     => 'switch',
            'title'    => __( 'Display text section of footer', 'dina-kala' ),
            'subtitle' => __( 'Show a section to display text in the footer area', 'dina-kala' ),
            'default'  => false
        ),
        array(
            'id'       => 'footer_text_main',
            'type'     => 'switch',
            'title'    => __( 'Show footer text only in main page', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'show_footer_text', '=', true ),
        ),
        array(
            'id'       => 'less_footer_text',
            'type'     => 'switch',
            'title'    => __( 'Show summary text', 'dina-kala' ),
            'subtitle' => __( 'Show summary text instead of full', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'show_footer_text', '=', true ),
        ),
        array(
            'id'       => 'footer_text_pos',
            'type'     => 'select',
            'title'    => __( 'Display position', 'dina-kala' ),
            'options'  => array(
                'footer-text-beginning' => __( 'Beginning of footer', 'dina-kala' ),
                'footer-text-site-info' => __( 'Bottom of site information', 'dina-kala' ),
                'footer-text-widgets'   => __( 'Bottom of footer widgets', 'dina-kala' ),
                'footer-text-end'       => __( 'End of footer', 'dina-kala' ),
            ),
            'default'  => 'footer-text-end',
            'required' => array( 'show_footer_text', '=', true ),
        ),
        array(
            'id'       => 'ftext_title',
            'default'  => __( 'Footer text', 'dina-kala' ),
            'type'     => 'text',
            'title'    => __( 'Footer text section title', 'dina-kala' ),
            'required' => array( 'show_footer_text', '=', true ),
        ),
        array(
            'id'      => 'ftext_text',
            'type'    => 'editor',
            'title'   => __( 'Footer section text', 'dina-kala' ),
            'default' => __( '<p>This text is editable through the theme settings section. You can display text in the footer section of the site.</p>', 'dina-kala' ),
            'args'    => array(
                'wpautop'       => true,
                'media_buttons' => true,
                'textarea_rows' => 5,
                'teeny'         => false,
                'quicktags'     => true,
            ),
            'required' => array( 'show_footer_text', '=', true ),            
        ),
        array(
            'id'     => 'ftext-section-end',
            'type'   => 'section',
            'indent' => false,
        ),
        //ftext-section-end

        //copy-section-start
        array(
            'id'     => 'copy-section-start',
            'type'   => 'section',
            'title'  => __( 'Copyright settings', 'dina-kala' ),
            'indent' => true,
        ),
        array(
            'id'       => 'hide_copy',
            'type'     => 'switch',
            'title'    => __( 'Hide copyright in mobile mode', 'dina-kala' ),
            'subtitle' => __( 'Hide copyright section include copyright text and social icons in mobile mode', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'copy_text',
            'type'     => 'editor',
            'title'    => __( 'Copyright text', 'dina-kala' ),
            'subtitle' => __( 'Change the text in the site footer.', 'dina-kala' ),
            'default'  => __( 'All rights reserved to our site.', 'dina-kala' ),
            'args'     => array(
                'wpautop'       => true,
                'media_buttons' => true,
                'textarea_rows' => 5,
                'teeny'         => false,
                'quicktags'     => true,
            ),
        ),
        array(
            'id'          => 'copy_bg_color',
            'type'        => 'color',
            'title'       => __( 'Copyright Background color', 'dina-kala' ),
            'subtitle'    => __( 'Choose the color scheme for the copyright background color', 'dina-kala' ),
            'default'     => '#ffffff',
            'validate'    => 'color',
            'transparent' => false,
        ),
        array(
            'id'          => 'copy_text_color',
            'type'        => 'color',
            'title'       => __( 'Copyright text color', 'dina-kala' ),
            'subtitle'    => __( 'Choose the color scheme for the copyright text color', 'dina-kala' ),
            'default'     => '#212529',
            'validate'    => 'color',
            'transparent' => false,
        ),
        array(
            'id'     => 'copy-section-end',
            'type'   => 'section',
            'indent' => false,
        ),
        //copy-section-end
        
        //fstyle-section-start
        array(
            'id'     => 'fstyle-section-start',
            'type'   => 'section',
            'title'  => __( 'Footer style settings', 'dina-kala' ),
            'indent' => true,
        ),
        array(
            'id'          => 'footer_text_color',
            'type'        => 'color',
            'title'       => __( 'Footer site text color', 'dina-kala' ),
            'default'     => '#212529',
            'validate'    => 'color',
            'transparent' => false,
        ),
        array(
            'id'       => 'footer_bg',
            'type'     => 'image_select',
            'output'   => array( 'body.dina-light .sfooter' ),
            'tiles'    => true,
            'title'    => __( 'Footer site background', 'dina-kala' ),
            'subtitle' => __("Select an image as the background of the site's footer.",'dina-kala' ),
            'options'  => $footer_patterns,
            'default'  => RE_URI . 'assets/img/fbg/0.png',
            'required' => array( 'fbg_switch', '!=', true ),
        ),
        array(
            'id'       => 'fbg_switch',
            'type'     => 'switch',
            'title'    => __( 'Custom Footer Background', 'dina-kala' ),
            'subtitle' => __( 'Choose a background color or upload a custom photo to the site footer', 'dina-kala' ),
            'default'  => false
        ),
        array(         
            'id'      => 'site_fbg_custom',
            'output'  => array( 'body.dina-light .sfooter' ),
            'type'    => 'background',
            'title'   => __("Customize the background of the site's footer to your liking.",'dina-kala' ),
            'default' => array(
                'background-color' => '#2d2d2d',
            ),
            'required' => array( 'fbg_switch', '=', true ),
        ),
        array(
            'id'     => 'fstyle-section-end',
            'type'   => 'section',
            'indent' => false,
        ),
        //fstyle-section-end
    )
) );

Redux::setSection( $opt_name, array(
    'title'      => __( 'Mobile Navigation Bar', 'dina-kala' ),
    'icon'       => 'fal fa-mobile-android',
    'id'         => 'mobile-nav-setting',
    'subsection' => true,
    'fields'     => array(
        array( 
            'id'       => 'mobile_nav_docs',
            'type'     => 'raw',
            'content'  => dina_admin_info( '', 'https://i-design.ir/docs/dinakala/?p=2193', 'info' )
        ),
        array(
            'id'       => 'hide_mobile_bar',
            'type'     => 'switch',
            'title'    => __( 'Hide mobile navigation bar' , 'dina-kala' ),
            'subtitle' => __( 'Hide the bottom bar displayed at the bottom of the site in mobile mode' , 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'mobile_bar_title',
            'type'     => 'switch',
            'title'    => __( 'Hide mobile navigation bar titles' , 'dina-kala' ),
            'subtitle' => __( 'Hide the mobile navigation bar icon title' , 'dina-kala' ),
            'default'  => false,
            'required' => array( 'hide_mobile_bar', '!=', true ),
        ),
        array(
            'id'       => 'mobile_bar_blur',
            'type'     => 'switch',
            'title' => __( 'Enable transparent background mode' , 'dina-kala' ),
            'default'  => false,
            'required' => array( 'hide_mobile_bar', '!=', true ),
        ),
        array(
            'id'       => 'mobile_bar_btns',
            'type'     => 'select',
            'multi'    => true,
            'sortable' => true,
            'title'    => __( 'Mobile navigation bar buttons', 'dina-kala' ), 
            'subtitle' => __( 'In this section, you can select up to 5 buttons to display in the mobile navigation bar. No more than 5 items will be displayed in the output.', 'dina-kala' ),
            'desc'     => __( 'No more than 5 items will be displayed in the output.', 'dina-kala' ),
            'options'  => array(
                'back-top'       => __( 'Back top / Filters', 'dina-kala' ),
                'wishlist'       => __( 'Wishlist', 'dina-kala' ),
                'home-add-cart'  => __( 'Home / Buy product', 'dina-kala' ),
                'compare-btn'    => __( 'Compare', 'dina-kala' ),
                'cart-btn'       => __( 'Shopping cart', 'dina-kala' ),
                'my-account'     => __( 'My Account', 'dina-kala' ),
                'menu'           => __( 'Menu', 'dina-kala' ),
                'dark-mode'      => __( 'Dark mode', 'dina-kala' ),
                'custom-btn-one' => __( 'Custom button one', 'dina-kala' ),
                'custom-btn-two' => __( 'Custom button two', 'dina-kala' ),
            ),
            'required' => array( 'hide_mobile_bar', '!=', true ),
            'default'  => array( 'back-top', 'wishlist', 'home-add-cart', 'compare-btn', 'cart-btn' )
        ),

        array(
            'id'       => 'mobile-nav-btn-one-section-start',
            'type'     => 'section',
            'title'    => __( 'Settings of the first custom mobile navigation bar button', 'dina-kala' ),
            'indent'   => true,
            'required' => array( 'hide_mobile_bar', '!=', true ),
        ),
        array(
            'id'       => 'mobile_nav_btn_one',
            'type'     => 'switch',
            'title'    => __( 'Enable Button' , 'dina-kala' ),
            'subtitle' => __( 'Enable first custom mobile navigation bar button' , 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'mobile_nav_btn_one_title',
            'type'     => 'text',
            'title'    => __( 'Button title', 'dina-kala' ),
            'default'  => __( 'Button one', 'dina-kala' ),
            'required' => array( 'mobile_nav_btn_one', '=', true ),
        ),
        array(
            'id'       => 'mobile_nav_btn_one_link',
            'type'     => 'text',
            'title'    => __( 'Button link', 'dina-kala' ),
            'default'  => '#',
            'required' => array( 'mobile_nav_btn_one', '=', true ),
        ),
        array(
            'id'       => 'mobile_nav_btn_one_icon',
            'type'     => 'select',
            'select2'  => array( 'containerCssClass' => 'fa' ),
            'title'    => __( 'Button icon', 'dina-kala' ),
            'class'    => ' dina-font-icon',
            'default'  => 'fab fa-whatsapp',
            'options'  => $alliconArray,
            'required' => array( 'mobile_nav_btn_one', '=', true ),
        ),
        array(
            'id'     => 'mobile-nav-btn-one-section-end',
            'type'   => 'section',
            'indent' => false,
        ),

        array(
            'id'       => 'mobile-nav-btn-two-section-start',
            'type'     => 'section',
            'title'    => __( 'Settings of the second custom mobile navigation bar button', 'dina-kala' ),
            'indent'   => true,
            'required' => array( 'hide_mobile_bar', '!=', true ),
        ),
        array(
            'id'       => 'mobile_nav_btn_two',
            'type'     => 'switch',
            'title'    => __( 'Enable Button' , 'dina-kala' ),
            'subtitle' => __( 'Enable second custom mobile navigation bar button' , 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'mobile_nav_btn_two_title',
            'type'     => 'text',
            'title'    => __( 'Button title', 'dina-kala' ),
            'default'  => __( 'Button two', 'dina-kala' ),
            'required' => array( 'mobile_nav_btn_two', '=', true ),
        ),
        array(
            'id'       => 'mobile_nav_btn_two_link',
            'type'     => 'text',
            'title'    => __( 'Button link', 'dina-kala' ),
            'default'  => '#',
            'required' => array( 'mobile_nav_btn_two', '=', true ),
        ),
        array(
            'id'       => 'mobile_nav_btn_two_icon',
            'type'     => 'select',
            'select2'  => array( 'containerCssClass' => 'fa' ),
            'title'    => __( 'Button icon', 'dina-kala' ),
            'class'    => ' dina-font-icon',
            'default'  => 'fab fa-instagram',
            'options'  => $alliconArray,
            'required' => array( 'mobile_nav_btn_two', '=', true ),
        ),
        array(
            'id'     => 'mobile-nav-btn-two-section-end',
            'type'   => 'section',
            'indent' => false,
        ),

        array(
            'id'       => 'back-top-section-start',
            'type'     => 'section',
            'title'    => __( 'Mobile Back to top Button settings', 'dina-kala' ),
            'indent'   => true,
            'required' => array( 'hide_mobile_bar', '!=', true ),
        ),
        array(
            'id'       => 'ch_back_top_btn',
            'type'     => 'switch',
            'title'    => __( 'Change Back to top Button' , 'dina-kala' ),
            'subtitle' => __( 'Change Back to top Button displayed at the bottom of the site in mobile mode' , 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'back_top_btn_title',
            'type'     => 'text',
            'title'    => __( 'Button title', 'dina-kala' ),
            'default'  => __( 'Return', 'dina-kala' ),
            'required' => array( 'ch_back_top_btn', '=', true ),
        ),
        array(
            'id'       => 'back_top_btn_link',
            'type'     => 'text',
            'title'    => __( 'Button link', 'dina-kala' ),
            'default'  => '#',
            'required' => array( 'ch_back_top_btn', '=', true ),
        ),
        array(
            'id'       => 'back_top_btn_icon',
            'type'     => 'select',
            'select2'  => array( 'containerCssClass' => 'fa' ),
            'title'    => __( 'Button icon', 'dina-kala' ),
            'class'    => ' dina-font-icon',
            'default'  => 'fal fa-chevron-up',
            'options'  => $alliconArray,
            'required' => array( 'ch_back_top_btn', '=', true ),
        ),
        array(
            'id'     => 'back-top-section-end',
            'type'   => 'section',
            'indent' => false,
        ),
        
        array(
            'id'       => 'whish-section-start',
            'type'     => 'section',
            'title'    => __( 'Wishlist Button settings', 'dina-kala' ),
            'indent'   => true,
            'required' => array( 'hide_mobile_bar', '!=', true ),
        ),
        array(
            'id'       => 'ch_whish_btn',
            'type'     => 'switch',
            'title'    => __( 'Change Wishlist Button' , 'dina-kala' ),
            'subtitle' => __( 'Change Wishlist Button displayed at the bottom of the site in mobile mode' , 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'whish_btn_title',
            'type'     => 'text',
            'title'    => __( 'Button title', 'dina-kala' ),
            'default'  => __( 'Wishlist ', 'dina-kala' ),
            'required' => array( 'ch_whish_btn', '=', true ),
        ),
        array(
            'id'       => 'whish_btn_link',
            'type'     => 'text',
            'title'    => __( 'Button link', 'dina-kala' ),
            'default'  => '#',
            'required' => array( 'ch_whish_btn', '=', true ),
        ),
        array(
            'id'       => 'whish_btn_icon',
            'type'     => 'select',
            'select2'  => array( 'containerCssClass' => 'fa' ),
            'title'    => __( 'Button icon', 'dina-kala' ),
            'class'    => ' dina-font-icon',
            'default'  => 'fal fa-heart',
            'options'  => $alliconArray,
            'required' => array( 'ch_whish_btn', '=', true ),
        ),
        array(
            'id'     => 'whish-section-end',
            'type'   => 'section',
            'indent' => false,
        ),
        
        array(
            'id'       => 'compare-section-start',
            'type'     => 'section',
            'title'    => __( 'Compare Button settings', 'dina-kala' ),
            'indent'   => true,
            'required' => array( 'hide_mobile_bar', '!=', true ),
        ),
        array(
            'id'       => 'ch_compare_btn',
            'type'     => 'switch',
            'title'    => __( 'Change Compare Button' , 'dina-kala' ),
            'subtitle' => __( 'Change Compare Button displayed at the bottom of the site in mobile mode' , 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'compare_btn_title',
            'type'     => 'text',
            'title'    => __( 'Button title', 'dina-kala' ),
            'default'  => __( 'Compare ', 'dina-kala' ),
            'required' => array( 'ch_compare_btn', '=', true ),
        ),
        array(
            'id'       => 'compare_btn_link',
            'type'     => 'text',
            'title'    => __( 'Button link', 'dina-kala' ),
            'default'  => '#',
            'required' => array( 'ch_compare_btn', '=', true ),
        ),
        array(
            'id'       => 'compare_btn_icon',
            'type'     => 'select',
            'select2'  => array( 'containerCssClass' => 'fa' ),
            'title'    => __( 'Button icon', 'dina-kala' ),
            'class'    => ' dina-font-icon',
            'default'  => 'fal fa-random',
            'options'  => $alliconArray,
            'required' => array( 'ch_compare_btn', '=', true ),
        ),
        array(
            'id'     => 'compare-section-end',
            'type'   => 'section',
            'indent' => false,
        ),

    )
) );

Redux::setSection( $opt_name, array(
    'title'      => __( 'Floating social networks', 'dina-kala' ),
    'icon'       => 'fab fa-facebook-square',
    'id'         => 'floating-social-setting',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'floating_social_docs',
            'type'     => 'raw',
            'content'  => dina_admin_info( '', 'https://i-design.ir/docs/dinakala/?p=2194', 'info' )
        ),
        array(
            'id'       => 'social_btn_left',
            'type'     => 'switch',
            'title'    => __( 'Show buttons on the right', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'social_btn_mobile',
            'type'     => 'switch',
            'title'    => __( 'Show buttons on mobile devices', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'social_btn_fix_title',
            'type'     => 'switch',
            'title'    => __( 'Display the title of the first button as fixed', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'social_circle_style',
            'type'     => 'switch',
            'title'    => __( 'Circle style (in the case that the icon is selected)', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'social_btn_style',
            'type'     => 'select',
            'title'    => __( 'Display style', 'dina-kala' ),
            'options'  => array(
                'dina-social-first-style'  =>  __( 'First style', 'dina-kala' ),
                'dina-social-second-style' =>  __( 'Second style', 'dina-kala' ),
            ),
            'default'  => 'dina-social-first-style',
        ),
        array(
            'id'       => 'social_btn_bottom',
            'type'     => 'text',
            'title'    =>  __( 'Distance from the bottom', 'dina-kala' ),
            'default'  => '40',
            'required' => array( 'social_btn_style', '=', 'dina-social-first-style' ),
        ),
        array(
            'id'       => 'social_btn_right',
            'type'     => 'text',
            'title'    => __( 'Distance from the side', 'dina-kala' ),
            'default'  => '20',
            'required' => array( 'social_btn_style', '=', 'dina-social-first-style' ),
        ),

        array(
            'id'     => 'first-social-section-start',
            'type'   => 'section',
            'title'  => __( 'First social network button settings', 'dina-kala' ),
            'indent' => true,
        ),
        array(
            'id'       => 'show_social_btn',
            'type'     => 'switch',
            'title'    => __( 'Show social network button', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'social_btn_animation',
            'type'     => 'switch',
            'title'    => __( 'Activate animation', 'dina-kala' ),
            'default'  => false,
            'required' => array(
                array( 'show_social_btn', '=', true ),
                array( 'social_btn_style', '=', 'dina-social-first-style' ),
            )
        ),
        array(
            'id'       => 'social_btn_icon',
            'type'     => 'select',
            'select2'  => array( 'containerCssClass' => 'fa' ),
            'title'    => __( 'Social network button icon', 'dina-kala' ),
            'class'    => ' dina-font-icon',
            'default'  => 'fab fa-telegram-plane',
            'options'  => $alliconArray,
            'required' => array( 'show_social_btn', '=', true ),
        ),
        array(
            'id'       => 'social_btn_img',
            'type'     => 'media',
            'url'      => true,
            'readonly' => false,
            'title'    => __( 'Or custom icon', 'dina-kala' ),
            'compiler' => 'true',
            'desc'     => __( 'Suitable size: 60px by 60px', 'dina-kala' ),
            'required' => array( 'show_social_btn', '=', true ),
        ),
        array(
            'id'          => 'social_btn_color',
            'type'        => 'color',
            'title'       => __( 'Social network button color', 'dina-kala' ),
            'default'     => '#31AAFF',
            'validate'    => 'color',
            'transparent' => false,
            'required'    => array( 'show_social_btn', '=', true ),
        ),
        array(
            'id'       => 'social_btn_title',
            'type'     => 'text',
            'title'    =>  __( 'Social network button title', 'dina-kala' ),
            'default'  => __( 'Telegram', 'dina-kala' ),
            'required' => array( 'show_social_btn', '=', true ),
        ),
        array(
            'id'       => 'social_btn_link',
            'type'     => 'text',
            'title'    =>  __( 'Social network button link', 'dina-kala' ),
            'default'  => '#',
            'required' => array( 'show_social_btn', '=', true ),
        ),
        array(
            'id'     => 'first-social-section-end',
            'type'   => 'section',
            'indent' => false,
        ),

        array(
            'id'     => 'second-social-section-start',
            'type'   => 'section',
            'title'  => __( 'Second social network button settings', 'dina-kala' ),
            'indent' => true,
        ),
        array(
            'id'       => 'show_second_social_btn',
            'type'     => 'switch',
            'title'    => __( 'Show second social network button', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'second_social_btn_animation',
            'type'     => 'switch',
            'title'    => __( 'Activate animation', 'dina-kala' ),
            'default'  => false,
            'required' => array(
                array( 'show_second_social_btn', '=', true ),
                array( 'social_btn_style', '=', 'dina-social-first-style' ),
            )
        ),
        array(
            'id'          => 'second_social_btn_color',
            'type'        => 'color',
            'title'       => __( 'Second social network button color', 'dina-kala' ),
            'default'     => '#AC34A7',
            'validate'    => 'color',
            'transparent' => false,
            'required'    => array( 'show_second_social_btn', '=', true ),
        ),
        array(
            'id'       => 'second_social_btn_title',
            'type'     => 'text',
            'title'    =>  __( 'Second social network button title', 'dina-kala' ),
            'default'  => __( 'Instagram', 'dina-kala' ),
            'required' => array( 'show_second_social_btn', '=', true ),
        ),
        array(
            'id'       => 'second_social_btn_link',
            'type'     => 'text',
            'title'    =>  __( 'Second social network button link', 'dina-kala' ),
            'default'  => '#',
            'required' => array( 'show_second_social_btn', '=', true ),
        ),
        array(
            'id'       => 'second_social_btn_icon',
            'type'     => 'select',
            'select2'  => array( 'containerCssClass' => 'fa' ),
            'title'    => __( 'Second social network button icon', 'dina-kala' ),
            'class'    => ' dina-font-icon',
            'default'  => 'fab fa-instagram',
            'options'  => $alliconArray,
            'required' => array( 'show_second_social_btn', '=', true ),
        ),
        array(
            'id'       => 'second_social_btn_img',
            'type'     => 'media',
            'url'      => true,
            'readonly' => false,
            'title'    => __( 'Or custom icon', 'dina-kala' ),
            'compiler' => 'true',
            'desc'     => __( 'Suitable size: 60px by 60px', 'dina-kala' ),
            'required' => array( 'show_second_social_btn', '=', true ),
        ),
        array(
            'id'     => 'second-social-section-end',
            'type'   => 'section',
            'indent' => false,
        ),

        array(
            'id'     => 'third-social-section-start',
            'type'   => 'section',
            'title'  => __( 'Third social network button settings', 'dina-kala' ),
            'indent' => true,
        ),
        array(
            'id'       => 'show_third_social_btn',
            'type'     => 'switch',
            'title'    => __( 'Show third social network button', 'dina-kala' ),
            'default'  => false,
        ),

        array(
            'id'       => 'third_social_btn_animation',
            'type'     => 'switch',
            'title'    => __( 'Activate animation', 'dina-kala' ),
            'default'  => false,
            'required' => array(
                array( 'show_third_social_btn', '=', true ),
                array( 'social_btn_style', '=', 'dina-social-first-style' ),
            )
        ),

        array(
            'id'          => 'third_social_btn_color',
            'type'        => 'color',
            'title'       => __( 'Third social network button color', 'dina-kala' ),
            'default'     => '#47C054',
            'validate'    => 'color',
            'transparent' => false,
            'required'    => array( 'show_third_social_btn', '=', true ),
        ),
        array(
            'id'       => 'third_social_btn_title',
            'type'     => 'text',
            'title'    =>  __( 'Third social network button title', 'dina-kala' ),
            'default'  => __( 'Whatsapp', 'dina-kala' ),
            'required' => array( 'show_third_social_btn', '=', true ),
        ),
        array(
            'id'       => 'third_social_btn_link',
            'type'     => 'text',
            'title'    =>  __( 'Third social network button link', 'dina-kala' ),
            'default'  => '#',
            'required' => array( 'show_third_social_btn', '=', true ),
        ),
        array(
            'id'       => 'third_social_btn_icon',
            'type'     => 'select',
            'select2'  => array( 'containerCssClass' => 'fa' ),
            'title'    => __( 'Third social network button icon', 'dina-kala' ),
            'class'    => ' dina-font-icon',
            'default'  => 'fab fa-whatsapp',
            'options'  => $alliconArray,
            'required' => array( 'show_third_social_btn', '=', true ),
        ),
        array(
            'id'       => 'third_social_btn_img',
            'type'     => 'media',
            'url'      => true,
            'readonly' => false,
            'title'    => __( 'Or custom icon', 'dina-kala' ),
            'compiler' => 'true',
            'desc'     => __( 'Suitable size: 60px by 60px', 'dina-kala' ),
            'required' => array( 'show_third_social_btn', '=', true ),
        ),
        array(
            'id'     => 'third-social-section-end',
            'type'   => 'section',
            'indent' => false,
        ),

        array(
            'id'     => 'fourth-social-section-start',
            'type'   => 'section',
            'title'  => __( 'Fourth social network button settings', 'dina-kala' ),
            'indent' => true,
        ),
        array(
            'id'       => 'show_fourth_social_btn',
            'type'     => 'switch',
            'title'    => __( 'Show fourth social network button', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'fourth_social_btn_animation',
            'type'     => 'switch',
            'title'    => __( 'Activate animation', 'dina-kala' ),
            'default'  => false,
            'required' => array(
                array( 'show_fourth_social_btn', '=', true ),
                array( 'social_btn_style', '=', 'dina-social-first-style' ),
            )
        ),
        array(
            'id'          => 'fourth_social_btn_color',
            'type'        => 'color',
            'title'       => __( 'Fourth social network button color', 'dina-kala' ),
            'default'     => '#ec145b',
            'validate'    => 'color',
            'transparent' => false,
            'required'    => array( 'show_fourth_social_btn', '=', true ),
        ),
        array(
            'id'       => 'fourth_social_btn_title',
            'type'     => 'text',
            'title'    =>  __( 'Fourth social network button title', 'dina-kala' ),
            'default'  => __( 'Aparat', 'dina-kala' ),
            'required' => array( 'show_fourth_social_btn', '=', true ),
        ),
        array(
            'id'       => 'fourth_social_btn_link',
            'type'     => 'text',
            'title'    =>  __( 'Fourth social network button link', 'dina-kala' ),
            'default'  => '#',
            'required' => array( 'show_fourth_social_btn', '=', true ),
        ),
        array(
            'id'       => 'fourth_social_btn_icon',
            'type'     => 'select',
            'select2'  => array( 'containerCssClass' => 'fa' ),
            'title'    => __( 'Fourth social network button icon', 'dina-kala' ),
            'class'    => ' dina-font-icon',
            'default'  => 'dico ico-aparat',
            'options'  => $alliconArray,
            'required' => array( 'show_fourth_social_btn', '=', true ),
        ),
        array(
            'id'       => 'fourth_social_btn_img',
            'type'     => 'media',
            'url'      => true,
            'readonly' => false,
            'title'    => __( 'Or custom icon', 'dina-kala' ),
            'compiler' => 'true',
            'desc'     => __( 'Suitable size: 60px by 60px', 'dina-kala' ),
            'required' => array( 'show_fourth_social_btn', '=', true ),
        ),
        array(
            'id'     => 'fourth-social-section-end',
            'type'   => 'section',
            'indent' => false,
        ),

        array(
            'id'     => 'fifth-social-section-start',
            'type'   => 'section',
            'title'  => __( 'Fifth social network button settings', 'dina-kala' ),
            'indent' => true,
        ),
        array(
            'id'       => 'show_fifth_social_btn',
            'type'     => 'switch',
            'title'    => __( 'Show fifth social network button', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'fifth_social_btn_animation',
            'type'     => 'switch',
            'title'    => __( 'Activate animation', 'dina-kala' ),
            'default'  => false,
            'required' => array(
                array( 'show_fifth_social_btn', '=', true ),
                array( 'social_btn_style', '=', 'dina-social-first-style' ),
            )
        ),
        array(
            'id'          => 'fifth_social_btn_color',
            'type'        => 'color',
            'title'       => __( 'Fifth social network button color', 'dina-kala' ),
            'default'     => '#000000',
            'validate'    => 'color',
            'transparent' => false,
            'required'    => array( 'show_fifth_social_btn', '=', true ),
        ),
        array(
            'id'       => 'fifth_social_btn_title',
            'type'     => 'text',
            'title'    =>  __( 'Fifth social network button title', 'dina-kala' ),
            'default'  => __( 'Threads', 'dina-kala' ),
            'required' => array( 'show_fifth_social_btn', '=', true ),
        ),
        array(
            'id'       => 'fifth_social_btn_link',
            'type'     => 'text',
            'title'    =>  __( 'Fifth social network button link', 'dina-kala' ),
            'default'  => '#',
            'required' => array( 'show_fifth_social_btn', '=', true ),
        ),
        array(
            'id'       => 'fifth_social_btn_icon',
            'type'     => 'select',
            'select2'  => array( 'containerCssClass' => 'fa' ),
            'title'    => __( 'Fifth social network button icon', 'dina-kala' ),
            'class'    => ' dina-font-icon',
            'default'  => 'dico ico-threads',
            'options'  => $alliconArray,
            'required' => array( 'show_fifth_social_btn', '=', true ),
        ),
        array(
            'id'       => 'fifth_social_btn_img',
            'type'     => 'media',
            'url'      => true,
            'readonly' => false,
            'title'    => __( 'Or custom icon', 'dina-kala' ),
            'compiler' => 'true',
            'desc'     => __( 'Suitable size: 60px by 60px', 'dina-kala' ),
            'required' => array( 'show_fifth_social_btn', '=', true ),
        ),
        array(
            'id'     => 'fifth-social-section-end',
            'type'   => 'section',
            'indent' => false,
        )
    )
) );

Redux::setSection( $opt_name, array(
    'title'      => __( 'Other settings', 'dina-kala' ),
    'icon'       => 'fal fa-cog',
    'id'         => 'side-setting',
    'subsection' => true,
    'fields'     => array(
        array( 
            'id'       => 'other_settings_docs',
            'type'     => 'raw',
            'content'  => dina_admin_info( '', 'https://i-design.ir/docs/dinakala/?p=2195', 'info' )
        ),
        array(
            'id'       => 'side_sticky',
            'type'     => 'switch',
            'title'    => __( 'Sticky Sidebar' , 'dina-kala' ),
            'subtitle' => __( 'In this case the widgets and the content section remain fixed while scrolling the page so that no space is left.' , 'dina-kala' ),
            'default'  => true,
        ),
        array(
            'id'       => 'widgets_title_tag',
            'type'     => 'select',
            'title'    => __( 'Widgets title tag', 'dina-kala' ),
            'options'  => array(
                'div' => __( 'div', 'dina-kala' ),
                'h2'  => __( 'h2', 'dina-kala' ),
                'h3'  => __( 'h3', 'dina-kala' ),
                'h4'  => __( 'h4', 'dina-kala' ),
                'h5'  => __( 'h5', 'dina-kala' ),
            ),
            'default'  => 'h3',
        ),
        array(
            'id'       => 'site_schema',
            'type'     => 'switch',
            'title'    => __( 'Schema Codes' , 'dina-kala' ),
            'subtitle' => __( 'Add Schema codes to product sections and content' , 'dina-kala' ),
            'default'  => true,
        ),
        array(
            'id'       => 'dis_widget_editor',
            'type'     => 'switch',
            'title'    => __( 'Classic widgets' , 'dina-kala' ),
            'subtitle' => __( 'Enables the previous "classic" widgets settings screens in Appearance - Widgets and the Customizer. Disables the block editor from managing widgets.' , 'dina-kala' ),
            'default'  => true,
        ),
        array(
            'id'       => 'dis_rss_feeds',
            'type'     => 'switch',
            'title'    => __( 'Disable RSS feeds' , 'dina-kala' ),
            'subtitle' => __( 'Disable WordPress RSS feeds' , 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'tag_number',
            'type'     => 'text',
            'title'    => __( 'Number of Widget tags', 'dina-kala' ),
            'subtitle' => __( 'The number of tags displayed in the cloud tag widget.', 'dina-kala' ),
            'default'  => 32,
        ),
        array(
            'id'       => 'open_cat_widget',
            'type'     => 'switch',
            'title'    => __( 'Open subcategories in the category widget', 'dina-kala' ),
            'subtitle' => __( 'Open subcategories in the category widget by default', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'not_count_admin_views',
            'type'     => 'switch',
            'title'    => __( 'Not counting the number of visits by admin and author users', 'dina-kala' ),
            'subtitle' => __( 'Not counting the number of visits by admin and author users in the statistics of visits to products and posts', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'remove_menu_icon',
            'type'     => 'switch',
            'title'    => __( 'Remove menus icon', 'dina-kala' ),
            'subtitle' => __( 'By activating this option, the possibility of inserting icons for menus will be removed. In sites that have many menus, activating this item will make the menu management page faster.', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'change_views_meta',
            'type'     => 'switch',
            'title'    => __( 'Change the default post meta key of views', 'dina-kala' ),
            'subtitle' => __( 'If the view statistics of your posts and products have been stored in another template or plugin, you can change the name of the key to save views in the template with the previous key so that the new statistics are a continuation of your previous statistics.', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'views_meta_key',
            'type'     => 'text',
            'title'    => __( 'Post meta key name', 'dina-kala' ),
            'default'  => 'post_views_count',
            'required' => array( 'change_views_meta', '=', true )
        ),

        array(
            'id'     => 'side-panels-section-start',
            'type'   => 'section',
            'title'  => __( 'Side panels settings', 'dina-kala' ),
            'indent' => true,
        ),
        array(
            'id'       => 'hide_side_panel_icon',
            'type'     => 'switch',
            'title'    => __( 'Hide side panels icons', 'dina-kala' ),
            'subtitle' => __( 'Panels of the user menu, mobile menu, search and login', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'change_side_panels_icon',
            'type'     => 'switch',
            'title'    => __( 'Change panels icon', 'dina-kala' ),
            'subtitle' => __( 'with the desired icon or image', 'dina-kala' ),
            'default'  => false,
        ),

        array(
            'id'       => 'menu_panel_icon',
            'type'     => 'select',
            'select2'  => array( 'containerCssClass' => 'fal' ),
            'title'    => __( 'Mobile menu panel icon', 'dina-kala' ),
            'class'    => ' dina-font-icon',
            'default'  => 'fal fa-file-search',
            'options'  => $alliconArray,
            'required' => array( 'change_side_panels_icon', '=', true ),
        ),
        array(
            'id'       => 'menu_panel_image',
            'type'     => 'media',
            'title'    => __( 'Or image', 'dina-kala' ),
            'desc'     => __( 'Upload your custom icon image from this section.', 'dina-kala' ),
            'subtitle' => __( 'Appropriate size: 300 pixel(w) in 300 pixel(h)', 'dina-kala' ),
            'url'      => true,
            'readonly' => false,
            'compiler' => 'true',
            'default'  => '',
            'required' => array( 'change_side_panels_icon', '=', true ),
        ),

        array(
            'id'       => 'cart_panel_icon',
            'type'     => 'select',
            'select2'  => array( 'containerCssClass' => 'fal' ),
            'title'    => __( 'Shopping cart panel icon', 'dina-kala' ),
            'class'    => ' dina-font-icon',
            'default'  => 'fal fa-bags-shopping',
            'options'  => $alliconArray,
            'required' => array( 'change_side_panels_icon', '=', true ),
        ),
        array(
            'id'       => 'cart_panel_image',
            'type'     => 'media',
            'title'    => __( 'Or image', 'dina-kala' ),
            'desc'     => __( 'Upload your custom icon image from this section.', 'dina-kala' ),
            'subtitle' => __( 'Appropriate size: 300 pixel(w) in 300 pixel(h)', 'dina-kala' ),
            'url'      => true,
            'readonly' => false,
            'compiler' => 'true',
            'default'  => '',
            'required' => array( 'change_side_panels_icon', '=', true ),
        ),

        array(
            'id'       => 'login_panel_icon',
            'type'     => 'select',
            'select2'  => array( 'containerCssClass' => 'fal' ),
            'title'    => __( 'User login panel icon', 'dina-kala' ),
            'class'    => ' dina-font-icon',
            'default'  => 'fal fa-user-circle',
            'options'  => $alliconArray,
            'required' => array( 'change_side_panels_icon', '=', true ),
        ),
        array(
            'id'       => 'login_panel_image',
            'type'     => 'media',
            'title'    => __( 'Or image', 'dina-kala' ),
            'desc'     => __( 'Upload your custom icon image from this section.', 'dina-kala' ),
            'subtitle' => __( 'Appropriate size: 300 pixel(w) in 300 pixel(h)', 'dina-kala' ),
            'url'      => true,
            'readonly' => false,
            'compiler' => 'true',
            'default'  => '',
            'required' => array( 'change_side_panels_icon', '=', true ),
        ),

        array(
            'id'       => 'user_panel_icon',
            'type'     => 'select',
            'select2'  => array( 'containerCssClass' => 'fal' ),
            'title'    => __( 'User menu panel icon', 'dina-kala' ),
            'class'    => ' dina-font-icon',
            'default'  => 'fal fa-id-card',
            'options'  => $alliconArray,
            'required' => array( 'change_side_panels_icon', '=', true ),
        ),
        array(
            'id'       => 'user_panel_image',
            'type'     => 'media',
            'title'    => __( 'Or image', 'dina-kala' ),
            'desc'     => __( 'Upload your custom icon image from this section.', 'dina-kala' ),
            'subtitle' => __( 'Appropriate size: 300 pixel(w) in 300 pixel(h)', 'dina-kala' ),
            'url'      => true,
            'readonly' => false,
            'compiler' => 'true',
            'default'  => '',
            'required' => array( 'change_side_panels_icon', '=', true ),
        ),

        array(
            'id'     => 'side-panels-section-end',
            'type'   => 'section',
            'indent' => false,
        ),

        array(
            'id'     => '404-page-section-start',
            'type'   => 'section',
            'title'  => __( '404 page settings', 'dina-kala' ),
            'indent' => true,
        ),
        array(
            'id'       => 'custom_404_page',
            'type'     => 'select',
            'ajax'     => true,
            'multi'    => false,
            'data'     => 'pages',
            'title'    => __( 'Custom 404 page', 'dina-kala' ),
            'subtitle' => __( 'Select a page that will be shown as your default 404 error page.', 'dina-kala' ),
        ),
        array(
            'id'     => '404-page-section-end',
            'type'   => 'section',
            'indent' => false,
        ),

        array(
            'id'     => 'rtop-section-start',
            'type'   => 'section',
            'title'  => __( 'Sticky Back to top button settings', 'dina-kala' ),
            'indent' => true,
        ),
        array(
            'id'       => 'show_return_top',
            'type'     => 'switch',
            'title'    => __( 'Back to top button', 'dina-kala' ),
            'subtitle' => __( 'Show back to top button', 'dina-kala' ),
            'default'  => true,
        ),
        array(
            'id'       => 'return_top_left',
            'type'     => 'switch',
            'title'    => __( 'Show button on the left', 'dina-kala' ),
            'required' => array(
                array( 'show_return_top', '=', true ), 
                array( 'return_top_style_two', '!=', true ) 
            ),
            'default'  => false,
        ),
        array(
            'id'       => 'return_top_bottom',
            'type'     => 'text',
            'title'    =>  __( 'Distance from the bottom', 'dina-kala' ),
            'default'  => '40',
            'required' => array(
                array( 'show_return_top', '=', true ), 
                array( 'return_top_style_two', '!=', true ) 
            )
        ),
        array(
            'id'       => 'return_top_right',
            'type'     => 'text',
            'title'    => __( 'Distance from the side', 'dina-kala' ),
            'default'  => '20',
            'required' => array(
                array( 'show_return_top', '=', true ), 
                array( 'return_top_style_two', '!=', true ) 
            )
        ),
        array(
            'id'       => 'return_top_style_two',
            'type'     => 'switch',
            'title'    => __( 'Activate the second style of the button', 'dina-kala' ),
            'subtitle' => __( 'Show back to top button in footer', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'show_return_top', '=', true ),
        ),
        array(
            'id'     => 'rtop-section-end',
            'type'   => 'section',
            'indent' => false,
        ),

        array(
            'id'     => 'abar-section-start',
            'type'   => 'section',
            'title'  => __( 'Admin bar settings', 'dina-kala' ),
            'indent' => true,
        ),
        array(
            'id'       => 'show_abar',
            'type'     => 'switch',
            'title'    => __( 'Hide the Admin Bar', 'dina-kala' ),
            'subtitle' => __( 'Hide admin bar when viewing site', 'dina-kala' ),
            'default'  => true,
        ),
        array(
            'id'       => 'show_abar_admin',
            'type'     => 'switch',
            'title'    => __( 'Show only for admin', 'dina-kala' ),
            'subtitle' => __( 'Show admin bar only for site admin', 'dina-kala' ),
            'default'  => true,
            'required' => array( 'show_abar', '=', true ),
        ),
        array(
            'id'       => 'show_abar_editor',
            'type'     => 'switch',
            'title'    => __( 'Display for author users', 'dina-kala' ),
            'subtitle' => __( 'Display for users who have the ability to edit and publish content.', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'show_abar', '=', true ),
        ),
        array(
            'id'     => 'abar-section-end',
            'type'   => 'section',
            'indent' => false,
        ),

        array(
            'id'     => 'loading-section-start',
            'type'   => 'section',
            'title'  => __( 'Loading settings', 'dina-kala' ),
            'indent' => true,
        ),
        array(
            'id'       => 'show_page_loading',
            'type'     => 'switch',
            'title'    => __( 'Display loading', 'dina-kala' ),
            'subtitle' => __( 'Show loading mode when loading pages', 'dina-kala' ),
            'default'  => true,
        ),
        array( 
            'id'       => 'load_img',
            'type'     => 'select_image',
            'title'    => __( 'Loading image', 'dina-kala' ),
            'subtitle' => __( 'Select image loading', 'dina-kala' ),
            'options'  => Array(
                Array (
                     'alt'  => __( 'Image 1', 'dina-kala' ),
                     'img'  => RE_URI .'assets/img/loading/loader0.gif',
                ),
                Array (
                     'alt'  => __( 'Image 2', 'dina-kala' ),
                     'img'  => RE_URI .'assets/img/loading/loader1.gif',
                ),
                Array (
                     'alt'  => __( 'Image 3', 'dina-kala' ),
                     'img'  => RE_URI .'assets/img/loading/loader2.gif',
                ),
                Array (
                     'alt'  => __( 'Image 4', 'dina-kala' ),
                     'img'  => RE_URI .'assets/img/loading/loader3.gif',
                ),
                Array (
                     'alt'  => __( 'Image 5', 'dina-kala' ),
                     'img'  => RE_URI .'assets/img/loading/loader4.gif',
                ),
                Array (
                     'alt'  => __( 'Image 6', 'dina-kala' ),
                     'img'  => RE_URI .'assets/img/loading/loader5.gif',
                ),
                Array (
                     'alt'  => __( 'Image 7', 'dina-kala' ),
                     'img'  => RE_URI .'assets/img/loading/loader6.gif',
                ),
                Array (
                     'alt'  => __( 'Image 8', 'dina-kala' ),
                     'img'  => RE_URI .'assets/img/loading/loader7.gif',
                ),
                Array (
                     'alt'  => __( 'Image 9', 'dina-kala' ),
                     'img'  => RE_URI .'assets/img/loading/loader8.gif',
                ),
                Array (
                     'alt'  => __( 'Image 10', 'dina-kala' ),
                     'img'  => RE_URI .'assets/img/loading/loader9.gif',
                ),
                Array (
                     'alt'  => __( 'Image 11', 'dina-kala' ),
                     'img'  => RE_URI .'assets/img/loading/loader10.gif',
                )
                
            ),
            'default'  => RE_URI .'assets/img/loading/loader0.gif',
            'required' => array( 
                array( 'show_page_loading', '=', true ),
                array( 'show_custom_loading', '!=', true ),
            )
        ),
        array(
            'id'       => 'show_custom_loading',
            'type'     => 'switch',
            'title'    => __( 'Display Custom loading image', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'show_page_loading', '=', true ),
        ),
        array(
            'id'       => 'custom_loading_image',
            'type'     => 'media',
            'url'      => true,
            'readonly' => false,
            'title'    => __( 'Your custom loading image', 'dina-kala' ),
            'compiler' => 'true',
            'desc'     => __( 'Upload your custom loading image from this section.', 'dina-kala' ),
            'default'  => array( 'url' => RE_URI .'assets/img/loading/loader0.gif' ),
            'required' => array( 'show_custom_loading', '=', true ),
        ),
        array(
            'id'     => 'loading-section-end',
            'type'   => 'section',
            'indent' => false,
        ),

        //elementor-section-start
        array(
            'id'     => 'elementor-section-start',
            'type'   => 'section',
            'title'  => __( 'Elementor settings', 'dina-kala' ),
            'indent' => true,
        ),
        array(
            'id'       => 'elementor_tag_id_name',
            'type'     => 'switch',
            'title'    => __( 'Select product tags by ID instead of their name', 'dina-kala' ),
            'subtitle' => __( 'On sites with a lot of tags, activating this will fix the problem of browser slowdowns and crashes (in the WooCommerce Product Block Filter Widget)', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'elementor_fit_header',
            'type'     => 'switch',
            'title'    => __( 'Aligning the width of the header container with the width of the template', 'dina-kala' ),
            'subtitle' => __( 'If you have created the header with Elementor, activating this option will make the width of the header equal to the width of the template', 'dina-kala' ),
            'default'  => true,
        ),
        array(
            'id'       => 'elementor_fit_footer',
            'type'     => 'switch',
            'title'    => __( 'Aligning the width of the footer container with the width of the template', 'dina-kala' ),
            'subtitle' => __( 'If you have created the footer with Elementor, activating this option will make the width of the footer equal to the width of the template', 'dina-kala' ),
            'default'  => true,
        ),
        array(
            'id'     => 'elementor-section-end',
            'type'   => 'section',
            'indent' => false,
        ),

        //elementor-section-start
        array(
            'id'     => 'email-section-start',
            'type'   => 'section',
            'title'  => __( 'Email settings', 'dina-kala' ),
            'indent' => true,
        ),
        array(
            'id'       => 'change_wordpress_email',
            'type'     => 'switch',
            'title'    => __( 'Changing the name and address of WordPress emails', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'wordpress_email_name',
            'type'     => 'text',
            'title'    => __( 'Name of the sender', 'dina-kala' ),
            'default'  => get_bloginfo( 'name' ),
            'required' => array( 'change_wordpress_email', '=', true ),
        ),
        array(
            'id'       => 'wordpress_email_address',
            'type'     => 'text',
            'title'    => __( 'Email address of the sender', 'dina-kala' ),
            'default'  => get_bloginfo( 'admin_email' ),
            'required' => array( 'change_wordpress_email', '=', true ),
        ),
        array(
            'id'     => 'email-section-end',
            'type'   => 'section',
            'indent' => false,
        ),
    )
) );