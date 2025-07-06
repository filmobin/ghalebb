<?php
/*
Theme Designed By : Meysam Hosseinkhani
Email: Meysam98@Gmail.com
Demo Website: Dinakala.I-design.ir
Author Website: i-design.ir
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
    exit;

require_once DI_DIR . '/includes/admin-panel/otp-test.php';

Redux::setSection( $opt_name, array(
    'title'  => __( 'User panel', 'dina-kala' ),
    'id'     => 'user_panel_setting',
    'desc'   => __( 'User panel settings', 'dina-kala' ),
    'icon'   => 'fal fa-user',
    'fields' => array(
        array( 
            'id'       => 'user_panel_docs',
            'type'     => 'raw',
            'content'  => dina_admin_info( '', 'https://i-design.ir/docs/dinakala/?p=2210', 'info' )
        ),
        array(
            'id'       => 'remove_myacc_hooks',
            'type'     => 'switch',
            'title'    => __( 'Remove template hooks from WooCommerce user panel' , 'dina-kala' ),
            'subtitle' => __( 'Enabling this option removes the template code from the WooCommerce user panel. Enabling this option is used to eliminate interference with other user panel plugins.','dina-kala' ),
            'default'  => false,
        ),

        array(
            'id'       => 'change_user_avatar',
            'type'     => 'switch',
            'title'    => __( 'Ability to change profile picture' , 'dina-kala' ),
            'subtitle' => __( 'Adding the ability to change the profile image (avatar) to the user panel','dina-kala' ),
            'default'  => true,
        ),

        array(
            'id'       => 'remove_download',
            'type'     => 'switch',
            'title'    => __( 'Remove download option' , 'dina-kala' ),
            'subtitle' => __( 'Remove download option from menu and user panel' , 'dina-kala' ),
            'default'  => false,
        ),

        array(
            'id'      => 'woo_ac_orders',
            'type'    => 'switch',
            'title'   => __( 'Change my orders page to accordion mode', 'dina-kala' ),
            'default' => true,
        ),

        array(
            'id'      => 'woo_ac_downloads',
            'type'    => 'switch',
            'title'   => __( 'Change the file download page to accordion mode', 'dina-kala' ),
            'default' => true,
        ),

        array(
            'id'      => 'comments_user_panel',
            'type'    => 'switch',
            'title'   => __( 'Display the "My Comments" option in the user panel', 'dina-kala' ),
            'default' => false,
        ),

        //dashboard-slider-section-start
        array(
            'id'       => 'dashboard-slider-section-start',
            'type'     => 'section',
            'title'    => __( 'Dashboard slider settings', 'dina-kala' ),
            'subtitle' => __( 'This slider is displayed on the User Panel', 'dina-kala' ),
            'indent'   => true,
        ),
        array(
            'id'      => 'show_dashboard_slider',
            'type'    => 'switch',
            'title'   => __( 'Show dashboard slider', 'dina-kala' ),
            'default' => false
        ),
        array(
            'id'       => 'dashboard_slider_mobile',
            'type'     => 'switch',
            'title'    => __( 'Show dashboard slider in mobile mode', 'dina-kala' ),
            'default'  => true,
            'required' => array( 'show_dashboard_slider', '=', true ),
        ),
        array(
            'id'       => 'dashboard_slider_title',
            'type'     => 'switch',
            'title'    => __( 'Show slide titles instead of navigation points', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'show_dashboard_slider', '=', true ),
        ),
        array(
            'id'       => 'dashboard_slider_mobile_title',
            'type'     => 'switch',
            'title'    => __( 'Show the title of the slides on mobile', 'dina-kala' ),
            'default'  => false,
            'required' => array( 
                array( 'dashboard_slider_mobile', '=', true ), 
                array( 'dashboard_slider_title', '=', true ) 
            )
        ),
        array(
            'id'       => 'dashboard_slider_arrows',
            'type'     => 'switch',
            'title'    => __( 'Show arrows', 'dina-kala' ),
            'default'  => true,
            'required' => array( 'show_dashboard_slider', '=', true ),
        ),
        array(
            'id'       => 'dashboard_slider_dots',
            'type'     => 'switch',
            'title'    => __( 'Show navigation\'s dots', 'dina-kala' ),
            'default'  => true,
            'required' => array( 'show_dashboard_slider', '=', true ),
        ),
        array(
            'id'       => 'dashboard_slider_auto_play',
            'type'     => 'switch',
            'title'    => __( 'Auto play', 'dina-kala' ),
            'default'  => true,
            'required' => array( 'show_dashboard_slider', '=', true ),
        ),
        array(
            'id'            => 'dashboard_slider_time',
            'type'          => 'slider',
            'title'         => __( 'Auto play speed(ms)', 'dina-kala' ),
            'default'       => 8000,
            'min'           => 1000,
            'step'          => 1000,
            'max'           => 20000,
            'display_value' => 'label',
            'required'      => array( 'dashboard_slider_auto_play', '=', true ),
        ),
        array(
            'id'       => 'dashboard_slider_pause_over',
            'type'     => 'switch',
            'title'    => __( 'Pause slider on mouse over', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'show_dashboard_slider', '=', true ),
        ),
        array(
            'id'       => 'dashboard_slider_newtab',
            'type'     => 'switch',
            'title'    => __( 'Open the links in a new tab', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'show_dashboard_slider', '=', true ),
        ),
        array(
            'id'       => 'dashboard_slider_nofollow',
            'type'     => 'switch',
            'title'    => __( 'Add nofollow property to links', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'show_dashboard_slider', '=', true ),
        ),
        array(
            'id'          => 'dashboard_slider',
            'type'        => 'slides',
            'title'       => __( 'Sliders', 'dina-kala' ),
            'subtitle'    => __( 'Upload slider images from this section.', 'dina-kala' ),
            'desc'        => '',
            'placeholder' => array(
                'title' => __( 'Title', 'dina-kala' ),
                'url'   => __( 'Link', 'dina-kala' ),
            ),
            'show'     => array( 'description' => false, 'title' => true, 'url' => true ),
            'required' => array( 'show_dashboard_slider', '=', true ),
        ),
        array(
            'id'     => 'dashboard-slider-section-end',
            'type'   => 'section',
            'indent' => false,
        ),

          //dashboard-banner-section-start
        array(
            'id'       => 'dashboard-banner-section-start',
            'type'     => 'section',
            'title'    => __( 'Dashboard banner settings', 'dina-kala' ),
            'subtitle' => __( 'This banner is displayed on the User Panel', 'dina-kala' ),
            'indent'   => true,
        ),
        array(
            'id'      => 'show_dashboard_banner',
            'type'    => 'switch',
            'title'   => __( 'Show Dashboard banner', 'dina-kala' ),
            'default' => false
        ),
        array(
            'id'       => 'show_dashboard_mobile',
            'type'     => 'switch',
            'title'    => __( 'Show Dashboard banner in mobile mode', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'show_dashboard_banner', '=', true ),
        ),
        array(
            'id'       => 'dashboard_banner',
            'type'     => 'media',
            'url'      => true,
            'readonly' => false,
            'title'    => __( 'Dashboard banner image', 'dina-kala' ),
            'compiler' => 'true',
            'subtitle' => __( 'Appropriate size: 1260 pixel(w) in 142 pixel(h)', 'dina-kala' ),
            'required' => array( 'show_dashboard_banner', '=', true ),
        ),
        array(
            'id'       => 'dashboard_banner_link',
            'type'     => 'text',
            'title'    => __( 'Dashboard banner link', 'dina-kala' ),
            'default'  => '#',
            'required' => array( 'show_dashboard_banner', '=', true ),
        ),
        array(
            'id'       => 'dashboard_banner_title',
            'type'     => 'text',
            'title'    => __( 'Dashboard banner title', 'dina-kala' ),
            'default'  => '#',
            'required' => array( 'show_dashboard_banner', '=', true ),
        ),
        array(
            'id'       => 'dashboard_banner_newtab',
            'type'     => 'switch',
            'title'    => __( 'Open the link in a new tab', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'show_dashboard_banner', '=', true ),
        ),
        array(
            'id'       => 'dashboard_banner_nofollow',
            'type'     => 'switch',
            'title'    => __( 'Add nofollow property to link', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'show_dashboard_banner', '=', true ),
        ),
        array(
            'id'     => 'dashboard-banner-section-end',
            'type'   => 'section',
            'indent' => false,
        ),
    )
) );

Redux::setSection( $opt_name, array(
    'title'      => __( 'Login and registration', 'dina-kala' ),
    'id'         => 'login_registration_setting',
    'desc'       => __( 'Login and registration settings', 'dina-kala' ),
    'icon'       => 'fal fa-user-plus',
    'subsection' => true,
    'fields'     => array(
        array( 
            'id'       => 'login_registration_docs',
            'type'     => 'raw',
            'content'  => dina_admin_info( '', 'https://i-design.ir/docs/dinakala/?p=3584', 'info' )
        ),
        // login-section-start
        array(
            'id'       => 'login-section-start',
            'type'     => 'section',
            'title'    => esc_html__( 'Login settings', 'dina-kala' ),
            'indent'   => true,
        ),
        array(
            'id'       => 'redirect_wpadmin_woo',
            'type'     => 'switch',
            'title'    => __( 'Redirect WordPress login page to theme login page' , 'dina-kala' ),
            'subtitle' => __( 'By activating this option, the WordPress login page (wp-login and wp-admin) will be redirected to the theme login page.','dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'       => 'woo_login_template',
            'type'     => 'switch',
            'title'    => __( 'Changing the WooCommerce login and registration page template' , 'dina-kala' ),
            'subtitle' => __( 'Changing the WooCommerce login and registration page template to the template login and registration page','dina-kala' ),
            'default'  => true,
        ),
        array(
            'id'       => 'digits_mode',
            'type'     => 'switch',
            'title'    => __( 'Compatibility with Digits plugin', 'dina-kala' ),
            'subtitle' => __( 'If you have a Digit plugin installed, the login and registration button will be connected to this plugin', 'dina-kala' ),
            'desc'     => __( 'We recommend you to use Dinakala SMS login and registration', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'show_user_btn', '=', true ),
        ),
        array(
            'id'       => 'digits_page',
            'type'     => 'switch',
            'title'    => __( 'Link to Digits page instead of pop-up mode', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'digits_mode', '=', true ),
        ),
        array(
            'id'       => 'ch_login_link',
            'type'     => 'switch',
            'title'    => __( 'Change the login/registration button link', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'show_user_btn', '=', true ),
        ),
        array(
            'id'          => 'login_link',
            'type'        => 'text',
            'title'       => __( 'Link to the login/registration page', 'dina-kala' ),
            'Subtitle'    => __( 'Full page link', 'dina-kala' ),
            'description' => __( 'Example: http://example.com/login', 'dina-kala' ),
            'default'     => '#',
            'required'    => array( 'ch_login_link', '=', true ),
        ),
        array(
            'id'       => 'remove_registration_link',
            'type'     => 'switch',
            'title'    => __( 'Remove registration link', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'show_user_btn', '=', true ),
        ),
        array(
            'id'       => 'ch_registration_link',
            'type'     => 'switch',
            'title'    => __( 'Change the registration link', 'dina-kala' ),
            'default'  => false,
            'required' => array(
                array( 'show_user_btn', '=', true ),
                array( 'remove_registration_link', '!=', true )
            )
        ),
        array(
            'id'          => 'registration_link',
            'type'        => 'text',
            'title'       => __( 'Link to the Registration page', 'dina-kala' ),
            'Subtitle'    => __( 'Full page link', 'dina-kala' ),
            'description' => __( 'Example: http://example.com/register', 'dina-kala' ),
            'default'     => '#',
            'required'    => array( 'ch_registration_link', '=', true ),
        ),
        array(
            'id'       => 'ch_reset_pw_link',
            'type'     => 'switch',
            'title'    => __( 'Change password reset link', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'show_user_btn', '=', true ),
        ),
        array(
            'id'          => 'reset_pw_link',
            'type'        => 'text',
            'title'       => __( 'Link to the password reset page', 'dina-kala' ),
            'Subtitle'    => __( 'Full page link', 'dina-kala' ),
            'description' => __( 'Example: http://example.com/reset-password', 'dina-kala' ),
            'default'     => '#',
            'required'    => array( 'ch_reset_pw_link', '=', true ),
        ),
        array(
            'id'       => 'show_login_notices',
            'type'     => 'switch',
            'title'    => __( 'Show login panel tips', 'dina-kala' ),
            'subtitle' => __( 'With this feature, you can display a text in the ajax login panel of the template', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'      => 'login_notices_text',
            'type'    => 'editor',
            'title'   => __( 'Login tips', 'dina-kala' ),
            'default'  => __( 'Text', 'dina-kala' ),
            'args'    => array(
                'wpautop'       => true,
                'media_buttons' => true,
                'textarea_rows' => 5,
                'teeny'         => false,
                'quicktags'     => true,
            ),
            'required' => array( 'show_login_notices', '=', true ),
        ),
        array(
            'id'       => 'dina_login_redirect',
            'type'     => 'switch',
            'title'    => __( 'Redirection after login', 'dina-kala' ),
            'subtitle' => __( 'Redirect to your desired address after login', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'show_user_btn', '=', true ),
        ),
        array(
            'id'       => 'dina_login_redirect_url',
            'type'     => 'text',
            'title'    => __( 'Redirect address after login', 'dina-kala' ),
            'required' => array( 'dina_login_redirect', '=', true ),
        ),
        array(
            'id'       => 'dina_logout_redirect',
            'type'     => 'switch',
            'title'    => __( 'Redirection after logout', 'dina-kala' ),
            'subtitle' => __( 'Redirect to your desired address after logout', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'show_user_btn', '=', true ),
        ),
        array(
            'id'       => 'dina_logout_redirect_url',
            'type'     => 'text',
            'title'    => __( 'Redirect address after logout', 'dina-kala' ),
            'required' => array( 'dina_logout_redirect', '=', true ),
        ),

        // login-section-end
        array(
            'id'       => 'login-section-end',
            'type'     => 'section',
            'indent'   => false,
        ),

        // sms-login-register-section-start
        array(
            'id'       => 'sms-login-register-section-start',
            'type'     => 'section',
            'title'    => esc_html__( 'SMS login and registration settings', 'dina-kala' ),
            'indent'   => true,
        ),

        array(
            'id'       => 'sms_login_register',
            'type'     => 'switch',
            'title'    => esc_html__( 'Activating login and registration with SMS', 'dina-kala' ),
            'subtitle' => esc_html__( 'By activating this option, the login and registration feature will be added in the login side panel and login page by mobile number and one-time password.', 'dina-kala' ),
            'default'  => false
        ),

        array(
            'id'       => 'sms_login_main',
            'type'     => 'switch',
            'title'    => esc_html__( 'Display SMS login form as main form', 'dina-kala' ),
            'default'  => false,
            'required' => array(
                array( 'sms_login_register', '=', true ),
                array( 'hide_user_pass_login', '!=', true )
            )
        ),

        array(
            'id'       => 'hide_user_pass_login',
            'type'     => 'switch',
            'title'    => esc_html__( 'Delete login by username and password', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'sms_login_register', '=', true )
        ),

        array(
            'id'       => 'search_digits_users',
            'type'     => 'switch',
            'title'    => esc_html__( 'Search in Digits plugin users', 'dina-kala' ),
            'subtitle' => esc_html__( 'If the Digits plugin is already installed on your site, by activating this option, you can make the SMS login and membership section of the template compatible with the Digits plugin.', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'sms_login_register', '=', true )
        ),

        array(
            'id'       => 'other_otp_plugin',
            'type'     => 'switch',
            'title'    => esc_html__( 'Search other SMS plugin users', 'dina-kala' ),
            'subtitle' => esc_html__( 'If another SMS plugin has been installed on your site and you want the SMS login and subscription section of the template to search the users of that plugin, you can enter the name of the phone number storage key of that plugin.', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'sms_login_register', '=', true )
        ),

        array(
            'id'       => 'other_otp_plugin_key',
            'type'     => 'text',
            'title'    => esc_html__( 'Phone number key', 'dina-kala' ),
            'required' => array( 'other_otp_plugin', '=', true )
        ),

        array(
            'id'            => 'otp_digits',
            'type'          => 'slider',
            'title'         => esc_html__( 'Number of OTP code digits', 'dina-kala' ),
            'default'       => 5,
            'min'           => 3,
            'step'          => 1,
            'max'           => 6,
            'display_value' => 'label',
            'required'      => array( 'sms_login_register', '=', true )
        ),

        array(
            'id'            => 'resend_code_time',
            'type'          => 'slider',
            'title'         => esc_html__( 'Time to resend the code', 'dina-kala' ),
            'default'       => 1,
            'min'           => 1,
            'step'          => 1,
            'max'           => 5,
            'display_value' => 'label',
            'required'      => array( 'sms_login_register', '=', true )
        ),

        array(
            'id'     => 'sms-login-register-section-end',
            'type'   => 'section',
            'indent' => false,
        ),

        // one-click-login-register-section-start
        array(
            'id'       => 'one-click-login-register-section-start',
            'type'     => 'section',
            'title'    => esc_html__( 'One-click login and registration settings', 'dina-kala' ),
            'indent'   => true,
            'required' => array( 'sms_login_register', '=', true )
        ),

        array(
            'id'       => 'one_click_login_register',
            'type'     => 'switch',
            'title'    => esc_html__( 'One-click login and registration activation', 'dina-kala' ),
            'subtitle' => esc_html__( "By activating this option, if there is no user account with the user's mobile number at the time of login, a user account will be created for him.", 'dina-kala' ),
            'default'  => false
        ),

        array(
            'id'       => 'default_username',
            'type'     => 'text',
            'title'    => esc_html__( 'Default username', 'dina-kala' ),
            'subtitle' => esc_html__( 'Specify the default username in English letters (eg siteuser). When creating a new user, a unique number will be added to the end of this name.', 'dina-kala' ),
            'required' => array(
                array( 'one_click_login_register', '=', true ),
                array( 'default_username_phone', '!=', true )
            )
        ),

        array(
            'id'       => 'default_username_phone',
            'type'     => 'switch',
            'title'    => esc_html__( 'Use phone number as default username', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'one_click_login_register', '=', true )
        ),

        array(
            'id'       => 'default_nickname',
            'type'     => 'text',
            'title'    => esc_html__( 'Default nickname', 'dina-kala' ),
            'subtitle' => esc_html__( 'Specify the default display name (eg site user).', 'dina-kala' ),
            'required' => array(
                array( 'one_click_login_register', '=', true ),
                array( 'default_nickname_phone', '!=', true )
            )
        ),

        array(
            'id'       => 'default_nickname_phone',
            'type'     => 'switch',
            'title'    => esc_html__( 'Use phone number as default display name', 'dina-kala' ),
            'default'  => false,
            'required' => array( 'one_click_login_register', '=', true )
        ),

        array(
            'id'       => 'one-click-login-register-section-end',
            'type'     => 'section',
            'indent'   => false
        ),

        // force-number-popup-section-start
        array(
            'id'       => 'force-number-popup-section-start',
            'type'     => 'section',
            'title'    => esc_html__( 'Mobile number registration pop-up settings', 'dina-kala' ),
            'indent'   => true,
            'required' => array( 'sms_login_register', '=', true )
        ),

        array(
            'id'       => 'force_number_popup',
            'type'     => 'switch',
            'title'    => esc_html__( 'Mobile number registration pop-up', 'dina-kala' ),
            'subtitle' => esc_html__( 'By activating this option, if the user enters the site and the mobile number is not registered for him, he will not be able to use the site until he registers his number in the phone number entry pop-up and confirms it.', 'dina-kala' ),
            'default'  => false
        ),

        array(
            'id'      => 'force_number_popup_title',
            'type'    => 'text',
            'title'   => esc_html__( 'Popup title', 'dina-kala' ),
            'default' => esc_html__( 'Mobile number registration', 'dina-kala' ),
            'required' => array( 'force_number_popup', '=', true )
        ),

        array(
            'id'      => 'force_number_popup_desc',
            'type'    => 'text',
            'title'   => esc_html__( 'Popup description', 'dina-kala' ),
            'default' => esc_html__( 'Please enter your mobile number in order to use all the features of the site', 'dina-kala' ),
            'required' => array( 'force_number_popup', '=', true )
        ),

        array(
            'id'       => 'force-number-popup-section-end',
            'type'     => 'section',
            'indent'   => false
        ),
        // force-number-popup-section-end

        // register-fields-section-start
        array(
            'id'       => 'register-fields-section-start',
            'type'     => 'section',
            'title'    => esc_html__( 'Settings of registration fields', 'dina-kala' ),
            'indent'   => true,
        ),

        array(
            'id'       => 'reg_field_fname',
            'type'     => 'select',
            'title'    => esc_html__( 'Name', 'dina-kala' ),
            'options'  => array(
                'hide'     => esc_html__( 'Do not display', 'dina-kala' ),
                'required' => esc_html__( 'Required', 'dina-kala' ),
                'optional' => esc_html__( 'Optional', 'dina-kala' )
            ),
            'default'  => 'optional',
        ),

        array(
            'id'       => 'reg_field_lname',
            'type'     => 'select',
            'title'    => esc_html__( 'Last name', 'dina-kala' ),
            'options'  => array(
                'hide'     => esc_html__( 'Do not display', 'dina-kala' ),
                'required' => esc_html__( 'Required', 'dina-kala' ),
                'optional' => esc_html__( 'Optional', 'dina-kala' )
            ),
            'default'  => 'optional',
        ),

        array(
            'id'       => 'reg_field_uname',
            'type'     => 'select',
            'title'    => esc_html__( 'Username', 'dina-kala' ),
            'options'  => array(
                'hide'     => esc_html__( 'Do not display', 'dina-kala' ),
                'required' => esc_html__( 'Required', 'dina-kala' ),
                'optional' => esc_html__( 'Optional', 'dina-kala' )
            ),
            'default'  => 'required',
        ),

        array(
            'id'       => 'reg_field_pass',
            'type'     => 'select',
            'title'    => esc_html__( 'Password', 'dina-kala' ),
            'options'  => array(
                'hide'     => esc_html__( 'Do not display', 'dina-kala' ),
                'required' => esc_html__( 'Required', 'dina-kala' ),
                'optional' => esc_html__( 'Optional', 'dina-kala' )
            ),
            'default'  => 'required',
        ),

        array(
            'id'       => 'reg_field_email',
            'type'     => 'select',
            'title'    => esc_html__( 'Email', 'dina-kala' ),
            'options'  => array(
                'hide'     => esc_html__( 'Do not display', 'dina-kala' ),
                'required' => esc_html__( 'Required', 'dina-kala' ),
                'optional' => esc_html__( 'Optional', 'dina-kala' )
            ),
            'default'  => 'required',
        ),

        array(
            'id'       => 'reg_field_mobile',
            'type'     => 'select',
            'title'    => esc_html__( 'Mobile number', 'dina-kala' ),
            'options'  => array(
                'hide'     => esc_html__( 'Do not display', 'dina-kala' ),
                'required' => esc_html__( 'Required', 'dina-kala' ),
                'optional' => esc_html__( 'Optional', 'dina-kala' )
            ),
            'default'  => 'optional',
        ),

        array(
            'id'       => 'verify_reg_field_mobile',
            'type'     => 'switch',
            'title'    => esc_html__( 'Mobile number validation by verification code', 'dina-kala' ),
            'subtitle' => esc_html__( 'By activating this option, if SMS login and registration is active and SMS panel settings are completed, a confirmation code will be sent to the entered number.', 'dina-kala' ),
            'default'  => false,
            'required' => array(
                array( 'sms_login_register', '=', true ),
                array( 'reg_field_mobile', '!=', 'hide' )
            )
        ),

        array(
            'id'     => 'register-fields-section-end',
            'type'   => 'section',
            'indent' => false,
        ),
        // register-fields-section-end

        // google-recapcha-section-start
        array(
            'id'       => 'google-recapcha-section-start',
            'type'     => 'section',
            'title'    => esc_html__( 'Google captcha settings', 'dina-kala' ),
            'indent'   => true,
        ),
        array(
            'id'       => 'recapcha_login',
            'type'     => 'switch',
            'title'    => __( 'Google Captcha in the login section', 'dina-kala' ),
            'subtitle' => __( 'Activate Google Captcha in login form', 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'          => 'site_key',
            'type'        => 'text',
            'title'       => __( 'Site key', 'dina-kala' ),
            'description' => __( 'Get it from the link: <a href="https://www.google.com/recaptcha/" target="_blank"> Google</a>', 'dina-kala' ),
            'required'    => array( 'recapcha_login', '=', true ),
        ),
        array(
            'id'          => 'site_secret',
            'type'        => 'text',
            'title'       => __( 'Security key', 'dina-kala' ),
            'description' => __( 'Get it from the link: <a href="https://www.google.com/recaptcha/" target="_blank"> Google</a>', 'dina-kala' ),
            'required'    => array( 'recapcha_login', '=', true ),
        ),
        // google-recapcha-section-end
        array(
            'id'       => 'google-recapcha-section-end',
            'type'     => 'section',
            'indent'   => false,
        ),

    )
) );

Redux::setSection( $opt_name, array(
    'title'      => __( 'SMS panel', 'dina-kala' ),
    'id'         => 'sms_panel_setting',
    'desc'       => __( 'SMS panel settings', 'dina-kala' ),
    'icon'       => 'fal fa-envelope',
    'subsection' => true,
    'fields'     => array(
        array( 
            'id'       => 'sms_panel_docs',
            'type'     => 'raw',
            'content'  => dina_admin_info( '', 'https://i-design.ir/docs/dinakala/?p=3585', 'info' )
        ),
        array(
            'id'       => 'sms_panel',
            'type'     => 'select',
            'title'    => esc_html__( 'SMS panel', 'dina-kala' ),
            'options'  => array(
                'meli-payamak'      => esc_html__( 'Meli Payamak (payamak-panel)', 'dina-kala' ),
                'faraz-sms'         => esc_html__( 'Faraz sms (IPPANEL)', 'dina-kala' ),
                'kave-negar-lookup' => esc_html__( 'Kave Negar', 'dina-kala' ),
                'sms-ir'            => esc_html__( 'sms.ir', 'dina-kala' ),
                'rastak-sms'        => esc_html__( 'Rastak sms', 'dina-kala' ),
                'raygan-sms'        => esc_html__( 'Raygan sms (Trez)', 'dina-kala' ),
            ),
            'default'  => 'meli-payamak',
        ),
        array(
            'id'       => 'sms_uname',
            'type'     => 'text',
            'title'    => esc_html__( 'Panel username', 'dina-kala' ),
            'required' => array( 'sms_panel', '=', array( 'meli-payamak', 'faraz-sms' ) )
        ),

        array(
            'id'       => 'sms_password',
            'type'     => 'password',
            'title'    => esc_html__( 'Panel password', 'dina-kala' ),
            'required' => array( 'sms_panel', '=', array( 'meli-payamak', 'faraz-sms' ) )
        ),

        array(
            'id'       => 'sms_pattern',
            'type'     => 'text',
            'title'    => esc_html__( 'Pattern code', 'dina-kala' ),
            'required' => array( 'sms_panel', '=', array( 'meli-payamak', 'faraz-sms', 'rastak-sms', 'kave-negar-lookup', 'sms-ir', 'raygan-sms' ) )
        ),

        array(
            'id'       => 'sms_var',
            'type'     => 'text',
            'title'    => esc_html__( 'Code variable', 'dina-kala' ),
            'required' => array( 'sms_panel', '=', array( 'sms-ir', 'faraz-sms', 'rastak-sms' ) )
        ),

        array(
            'id'       => 'sms_api',
            'type'     => 'text',
            'title'    => esc_html__( 'API key', 'dina-kala' ),
            'required' => array( 'sms_panel', '=', array( 'kave-negar-lookup', 'sms-ir', 'rastak-sms', 'raygan-sms' ) )
        ),

        array(
            'id'       => 'sms_sender_number',
            'type'     => 'text',
            'title'    => esc_html__( 'Panel sender number', 'dina-kala' ),
            'required' => array( 'sms_panel', '=', array( 'faraz-sms', 'rastak-sms', 'raygan-sms' ) )
        ),

        array( 
            'id'       => 'test_sms',
            'type'     => 'raw',
            'title'    => esc_html__( 'SMS sending test', 'dina-kala' ),
            'subtitle' => esc_html__( 'Be sure to save the settings once before performing the test', 'dina-kala' ),
            'content'  => dina_otp_test_form()
        ),

    )
) );

Redux::setSection( $opt_name, array(
    'title'      => __( 'User panel custom links', 'dina-kala' ),
    'id'         => 'user_panel_custom_links',
    'desc'       => __( 'User panel custom links settings', 'dina-kala' ),
    'icon'       => 'fal fa-link',
    'subsection' => true,
    'fields'     => array(
        array( 
            'id'       => 'user_panel_custom_links_docs',
            'type'     => 'raw',
            'content'  => dina_admin_info( '', 'https://i-design.ir/docs/dinakala/?p=3586', 'info' )
        ),
        //Link one
        array(
            'id'      => 'dashboard_link_one',
            'type'    => 'switch',
            'title'   => __( 'Activate the first link', 'dina-kala' ),
            'default' => false,
        ),
        array(
            'id'       => 'dashboard_link_one_title',
            'type'     => 'text',
            'title'    => __( 'Title', 'dina-kala' ),
            'default'  => __( 'First link', 'dina-kala' ),
            'required' => array( 'dashboard_link_one', '=', true ),
        ),
        array(
            'id'       => 'dashboard_link_one_url',
            'type'     => 'text',
            'title'    => __( 'Link', 'dina-kala' ),
            'default'  => '#',
            'required' => array( 'dashboard_link_one', '=', true ),
        ),
        array(
            'id'       => 'dashboard_link_one_icon',
            'type'     => 'select',
            'select2'  => array( 'containerCssClass' => 'fa' ),
            'title'    => __( 'Icon', 'dina-kala' ),
            'class'    => ' dina-font-icon',
            'default'  => 'fal fa-link',
            'options'  => $iconArray,
            'required' => array( 'dashboard_link_one', '=', true ),
        ),

        //Link two
        array(
            'id'      => 'dashboard_link_two',
            'type'    => 'switch',
            'title'   => __( 'Activate the second link', 'dina-kala' ),
            'default' => false,
        ),
        array(
            'id'       => 'dashboard_link_two_title',
            'type'     => 'text',
            'title'    => __( 'Title', 'dina-kala' ),
            'default'  => __( 'Second link', 'dina-kala' ),
            'required' => array( 'dashboard_link_two', '=', true ),
        ),
        array(
            'id'       => 'dashboard_link_two_url',
            'type'     => 'text',
            'title'    => __( 'Link', 'dina-kala' ),
            'default'  => '#',
            'required' => array( 'dashboard_link_two', '=', true ),
        ),
        array(
            'id'       => 'dashboard_link_two_icon',
            'type'     => 'select',
            'select2'  => array( 'containerCssClass' => 'fa' ),
            'title'    => __( 'Icon', 'dina-kala' ),
            'class'    => ' dina-font-icon',
            'default'  => 'fal fa-link',
            'options'  => $iconArray,
            'required' => array( 'dashboard_link_two', '=', true ),
        ),

        //Link three
        array(
            'id'      => 'dashboard_link_three',
            'type'    => 'switch',
            'title'   => __( 'Activate the third link', 'dina-kala' ),
            'default' => false,
        ),
        array(
            'id'       => 'dashboard_link_three_title',
            'type'     => 'text',
            'title'    => __( 'Title', 'dina-kala' ),
            'default'  => __( 'Third link', 'dina-kala' ),
            'required' => array( 'dashboard_link_three', '=', true ),
        ),
        array(
            'id'       => 'dashboard_link_three_url',
            'type'     => 'text',
            'title'    => __( 'Link', 'dina-kala' ),
            'default'  => '#',
            'required' => array( 'dashboard_link_three', '=', true ),
        ),
        array(
            'id'       => 'dashboard_link_three_icon',
            'type'     => 'select',
            'select2'  => array( 'containerCssClass' => 'fa' ),
            'title'    => __( 'Icon', 'dina-kala' ),
            'class'    => ' dina-font-icon',
            'default'  => 'fal fa-link',
            'options'  => $iconArray,
            'required' => array( 'dashboard_link_three', '=', true ),
        ),

        //Link four
        array(
            'id'      => 'dashboard_link_four',
            'type'    => 'switch',
            'title'   => __( 'Activate the fourth link', 'dina-kala' ),
            'default' => false,
        ),
        array(
            'id'       => 'dashboard_link_four_title',
            'type'     => 'text',
            'title'    => __( 'Title', 'dina-kala' ),
            'default'  => __( 'Fourth link', 'dina-kala' ),
            'required' => array( 'dashboard_link_four', '=', true ),
        ),
        array(
            'id'       => 'dashboard_link_four_url',
            'type'     => 'text',
            'title'    => __( 'Link', 'dina-kala' ),
            'default'  => '#',
            'required' => array( 'dashboard_link_four', '=', true ),
        ),
        array(
            'id'       => 'dashboard_link_four_icon',
            'type'     => 'select',
            'select2'  => array( 'containerCssClass' => 'fa' ),
            'title'    => __( 'Icon', 'dina-kala' ),
            'class'    => ' dina-font-icon',
            'default'  => 'fal fa-link',
            'options'  => $iconArray,
            'required' => array( 'dashboard_link_four', '=', true ),
        ),

        //Link five
        array(
            'id'      => 'dashboard_link_five',
            'type'    => 'switch',
            'title'   => __( 'Activate the fifth link', 'dina-kala' ),
            'default' => false,
        ),
        array(
            'id'       => 'dashboard_link_five_title',
            'type'     => 'text',
            'title'    => __( 'Title', 'dina-kala' ),
            'default'  => __( 'Fifth link', 'dina-kala' ),
            'required' => array( 'dashboard_link_five', '=', true ),
        ),
        array(
            'id'       => 'dashboard_link_five_url',
            'type'     => 'text',
            'title'    => __( 'Link', 'dina-kala' ),
            'default'  => '#',
            'required' => array( 'dashboard_link_five', '=', true ),
        ),
        array(
            'id'       => 'dashboard_link_five_icon',
            'type'     => 'select',
            'select2'  => array( 'containerCssClass' => 'fa' ),
            'title'    => __( 'Icon', 'dina-kala' ),
            'class'    => ' dina-font-icon',
            'default'  => 'fal fa-link',
            'options'  => $iconArray,
            'required' => array( 'dashboard_link_five', '=', true ),
        ),

        //Link six
        array(
            'id'      => 'dashboard_link_six',
            'type'    => 'switch',
            'title'   => __( 'Activate the sixth link', 'dina-kala' ),
            'default' => false,
        ),
        array(
            'id'       => 'dashboard_link_six_title',
            'type'     => 'text',
            'title'    => __( 'Title', 'dina-kala' ),
            'default'  => __( 'Sixth link', 'dina-kala' ),
            'required' => array( 'dashboard_link_six', '=', true ),
        ),
        array(
            'id'       => 'dashboard_link_six_url',
            'type'     => 'text',
            'title'    => __( 'Link', 'dina-kala' ),
            'default'  => '#',
            'required' => array( 'dashboard_link_six', '=', true ),
        ),
        array(
            'id'       => 'dashboard_link_six_icon',
            'type'     => 'select',
            'select2'  => array( 'containerCssClass' => 'fa' ),
            'title'    => __( 'Icon', 'dina-kala' ),
            'class'    => ' dina-font-icon',
            'default'  => 'fal fa-link',
            'options'  => $iconArray,
            'required' => array( 'dashboard_link_six', '=', true ),
        ),

        //Link seven
        array(
            'id'      => 'dashboard_link_seven',
            'type'    => 'switch',
            'title'   => __( 'Activate the seventh link', 'dina-kala' ),
            'default' => false,
        ),
        array(
            'id'       => 'dashboard_link_seven_title',
            'type'     => 'text',
            'title'    => __( 'Title', 'dina-kala' ),
            'default'  => __( 'Seventh link', 'dina-kala' ),
            'required' => array( 'dashboard_link_seven', '=', true ),
        ),
        array(
            'id'       => 'dashboard_link_seven_url',
            'type'     => 'text',
            'title'    => __( 'Link', 'dina-kala' ),
            'default'  => '#',
            'required' => array( 'dashboard_link_seven', '=', true ),
        ),
        array(
            'id'       => 'dashboard_link_seven_icon',
            'type'     => 'select',
            'select2'  => array( 'containerCssClass' => 'fa' ),
            'title'    => __( 'Icon', 'dina-kala' ),
            'class'    => ' dina-font-icon',
            'default'  => 'fal fa-link',
            'options'  => $iconArray,
            'required' => array( 'dashboard_link_seven', '=', true ),
        ),

        //Link eight
        array(
            'id'      => 'dashboard_link_eight',
            'type'    => 'switch',
            'title'   => __( 'Activate the eighth link', 'dina-kala' ),
            'default' => false,
        ),
        array(
            'id'       => 'dashboard_link_eight_title',
            'type'     => 'text',
            'title'    => __( 'Title', 'dina-kala' ),
            'default'  => __( 'Eighth link', 'dina-kala' ),
            'required' => array( 'dashboard_link_eight', '=', true ),
        ),
        array(
            'id'       => 'dashboard_link_eight_url',
            'type'     => 'text',
            'title'    => __( 'Link', 'dina-kala' ),
            'default'  => '#',
            'required' => array( 'dashboard_link_eight', '=', true ),
        ),
        array(
            'id'       => 'dashboard_link_eight_icon',
            'type'     => 'select',
            'select2'  => array( 'containerCssClass' => 'fa' ),
            'title'    => __( 'Icon', 'dina-kala' ),
            'class'    => ' dina-font-icon',
            'default'  => 'fal fa-link',
            'options'  => $iconArray,
            'required' => array( 'dashboard_link_eight', '=', true ),
        ),

        //Link nine
        array(
            'id'      => 'dashboard_link_nine',
            'type'    => 'switch',
            'title'   => __( 'Activate the ninth link', 'dina-kala' ),
            'default' => false,
        ),
        array(
            'id'       => 'dashboard_link_nine_title',
            'type'     => 'text',
            'title'    => __( 'Title', 'dina-kala' ),
            'default'  => __( 'Ninth link', 'dina-kala' ),
            'required' => array( 'dashboard_link_nine', '=', true ),
        ),
        array(
            'id'       => 'dashboard_link_nine_url',
            'type'     => 'text',
            'title'    => __( 'Link', 'dina-kala' ),
            'default'  => '#',
            'required' => array( 'dashboard_link_nine', '=', true ),
        ),
        array(
            'id'       => 'dashboard_link_nine_icon',
            'type'     => 'select',
            'select2'  => array( 'containerCssClass' => 'fa' ),
            'title'    => __( 'Icon', 'dina-kala' ),
            'class'    => ' dina-font-icon',
            'default'  => 'fal fa-link',
            'options'  => $iconArray,
            'required' => array( 'dashboard_link_nine', '=', true ),
        ),

        //Link ten
        array(
            'id'      => 'dashboard_link_ten',
            'type'    => 'switch',
            'title'   => __( 'Activate the tenth link', 'dina-kala' ),
            'default' => false,
        ),
        array(
            'id'       => 'dashboard_link_ten_title',
            'type'     => 'text',
            'title'    => __( 'Title', 'dina-kala' ),
            'default'  => __( 'Tenth link', 'dina-kala' ),
            'required' => array( 'dashboard_link_ten', '=', true ),
        ),
        array(
            'id'       => 'dashboard_link_ten_url',
            'type'     => 'text',
            'title'    => __( 'Link', 'dina-kala' ),
            'default'  => '#',
            'required' => array( 'dashboard_link_ten', '=', true ),
        ),
        array(
            'id'       => 'dashboard_link_ten_icon',
            'type'     => 'select',
            'select2'  => array( 'containerCssClass' => 'fa' ),
            'title'    => __( 'Icon', 'dina-kala' ),
            'class'    => ' dina-font-icon',
            'default'  => 'fal fa-link',
            'options'  => $iconArray,
            'required' => array( 'dashboard_link_ten', '=', true ),
        ),
    )
) );

Redux::setSection( $opt_name, array(
    'title'      => __( 'User panel messages', 'dina-kala' ),
    'id'         => 'user_panel_messages',
    'desc'       => __( 'Settings for user panel messages', 'dina-kala' ),
    'icon'       => 'fal fa-comment-lines',
    'subsection' => true,
    'fields'     => array(
        array( 
            'id'       => 'user_panel_messages_docs',
            'type'     => 'raw',
            'content'  => dina_admin_info( '', 'https://i-design.ir/docs/dinakala/?p=3587', 'info' )
        ),
        array(
            'id'      => 'show_dashboard_message',
            'type'    => 'switch',
            'title'   => __( 'Display messages in users panel' , 'dina-kala' ),
            'default' => true,
        ),

        array(
            'id'      => 'show_dashboard_message_one',
            'type'    => 'switch',
            'title'   => __( 'Display the first message in users panel' , 'dina-kala' ),
            'default' => true,
            'required' => array( 'show_dashboard_message', '=', true ),
        ),
        array(
            'id'       => 'dashboard_message_one',
            'type'     => 'editor',
            'title'    => __( 'The text of the first message', 'dina-kala' ),
            'subtitle' => __( 'The text of the first message displayed in the user panel', 'dina-kala' ),
            'desc'     => __( 'You can also use the shortcode. For example: [dina_first_name] = first name, [dina_last_name] = last name, [dina_display_name] = display name', 'dina-kala' ),
            'default'  => __( 'From your account dashboard you can view your recent orders, manage your billing address, and edit your password and account details.', 'dina-kala' ),
            'args'     => array(
                'wpautop'       => true,
                'media_buttons' => true,
                'textarea_rows' => 5,
                'teeny'         => true,
                'quicktags'     => true,
            ),
            'required' => array( 'show_dashboard_message_one', '=', true ),
        ),

        array(
            'id'      => 'show_dashboard_message_two',
            'type'    => 'switch',
            'title'   => __( 'Display the second message in users panel' , 'dina-kala' ),
            'default' => true,
            'required' => array( 'show_dashboard_message', '=', true ),
        ),
        array(
            'id'       => 'dashboard_message_two',
            'type'     => 'editor',
            'title'    => __( 'The text of the second message', 'dina-kala' ),
            'subtitle' => __( 'The text of the second message displayed in the user panel', 'dina-kala' ),
            'desc'     => __( 'You can also use the shortcode. For example: [dina_first_name] = first name, [dina_last_name] = last name, [dina_display_name] = display name', 'dina-kala' ),
            'default'  => '',
            'args'     => array(
                'wpautop'       => true,
                'media_buttons' => true,
                'textarea_rows' => 5,
                'teeny'         => true,
                'quicktags'     => true,
            ),
            'required' => array( 'show_dashboard_message_two', '=', true ),
        ),

        array(
            'id'      => 'show_dashboard_message_three',
            'type'    => 'switch',
            'title'   => __( 'Display the third message in users panel' , 'dina-kala' ),
            'default' => true,
            'required' => array( 'show_dashboard_message', '=', true ),
        ),
        array(
            'id'       => 'dashboard_message_three',
            'type'     => 'editor',
            'title'    => __( 'The text of the third message', 'dina-kala' ),
            'subtitle' => __( 'The text of the third message displayed in the user panel', 'dina-kala' ),
            'desc'     => __( 'You can also use the shortcode. For example: [dina_first_name] = first name, [dina_last_name] = last name, [dina_display_name] = display name', 'dina-kala' ),
            'default'  => '',
            'args'     => array(
                'wpautop'       => true,
                'media_buttons' => true,
                'textarea_rows' => 5,
                'teeny'         => true,
                'quicktags'     => true,
            ),
            'required' => array( 'show_dashboard_message_three', '=', true ),
        ),

        array(
            'id'      => 'show_dashboard_message_four',
            'type'    => 'switch',
            'title'   => __( 'Display the fourth message in users panel' , 'dina-kala' ),
            'default' => false,
            'required' => array( 'show_dashboard_message', '=', true ),
        ),
        array(
            'id'       => 'dashboard_message_four',
            'type'     => 'editor',
            'title'    => __( 'The text of the fourth message', 'dina-kala' ),
            'subtitle' => __( 'The text of the fourth message displayed in the user panel', 'dina-kala' ),
            'desc'     => __( 'You can also use the shortcode. For example: [dina_first_name] = first name, [dina_last_name] = last name, [dina_display_name] = display name', 'dina-kala' ),
            'default'  => '',
            'args'     => array(
                'wpautop'       => true,
                'media_buttons' => true,
                'textarea_rows' => 5,
                'teeny'         => true,
                'quicktags'     => true,
            ),
            'required' => array( 'show_dashboard_message_four', '=', true ),
        ),

        array(
            'id'      => 'show_dashboard_message_five',
            'type'    => 'switch',
            'title'   => __( 'Display the fifth message in users panel' , 'dina-kala' ),
            'default' => false,
            'required' => array( 'show_dashboard_message', '=', true ),
        ),
        array(
            'id'       => 'dashboard_message_five',
            'type'     => 'editor',
            'title'    => __( 'The text of the fifth message', 'dina-kala' ),
            'subtitle' => __( 'The text of the fifth message displayed in the user panel', 'dina-kala' ),
            'desc'     => __( 'You can also use the shortcode. For example: [dina_first_name] = first name, [dina_last_name] = last name, [dina_display_name] = display name', 'dina-kala' ),
            'default'  => '',
            'args'     => array(
                'wpautop'       => true,
                'media_buttons' => true,
                'textarea_rows' => 5,
                'teeny'         => true,
                'quicktags'     => true,
            ),
            'required' => array( 'show_dashboard_message_five', '=', true ),
        ),
    )
) );

Redux::setSection( $opt_name, array(
    'title'      => __( 'Style settings', 'dina-kala' ),
    'id'         => 'user_panel_style_settings',
    'desc'       => __( 'Style settings of login and membership section and user panel', 'dina-kala' ),
    'icon'       => 'fal fa-paint-brush',
    'subsection' => true,
    'fields'     => array(
        array( 
            'id'       => 'user_panel_style_docs',
            'type'     => 'raw',
            'content'  => dina_admin_info( '', 'https://i-design.ir/docs/dinakala/?p=3588', 'info' )
        ),
        array(
            'id'       => 'user_panel_style',
            'type'     => 'select',
            'title'    => __( 'User panel style', 'dina-kala' ),
            'options'  => array(
                'upanel-one' => __( 'Style 1', 'dina-kala' ),
                'upanel-two' => __( 'Style 2', 'dina-kala' ),
            ),
            'default'  => 'upanel-one',
        ),

        array(
            'id'       => 'change_login_page_logo',
            'type'     => 'switch',
            'title'    => __( 'Change login and registration page logo', 'dina-kala' ),
            'default'  => false
        ),

        array(
            'id'       => 'login_page_logo',
            'type'     => 'media',
            'url'      => true,
            'readonly' => false,
            'title'    => __( 'Login and registration page logo', 'dina-kala' ),
            'compiler' => 'true',
            'subtitle' => __( 'Appropriate size: 320 pixel(w) in 114 pixel(h)', 'dina-kala' ),
            'required' => array( 'change_login_page_logo', '=', true ),
        ),

        array(
            'id'       => 'login_page_dark_logo',
            'type'     => 'media',
            'url'      => true,
            'readonly' => false,
            'title'    => __( 'Login and registration page dark logo', 'dina-kala' ),
            'compiler' => 'true',
            'subtitle' => __( 'Appropriate size: 320 pixel(w) in 114 pixel(h)', 'dina-kala' ),
            'required' => array(
                array( 'change_login_page_logo', '=', true ),
                array( 'dina_dark_mode', '=', true )
            )
        ),

        //login btn color
        array(
            'id'     => 'login-page-btn-section-start',
            'type'   => 'section',
            'title'  => __( 'Login button in login page', 'dina-kala' ),
            'indent' => true,
        ),
        array(
            'id'          => 'login_page_btn_color',
            'type'        => 'color',
            'title'       => __( 'Login button color', 'dina-kala' ),
            'default'     => '#28a745',
            'validate'    => 'color',
            'transparent' => false,
        ),
        array(
            'id'          => 'login_page_btn_text_color',
            'type'        => 'color',
            'title'       => __( 'Login button text color', 'dina-kala' ),
            'default'     => '#ffffff',
            'validate'    => 'color',
            'transparent' => false,
        ),
        array(
            'id'          => 'login_page_btn_hover_color',
            'type'        => 'color',
            'title'       => __( 'Login button hover and click color', 'dina-kala' ),
            'default'     => '#218838',
            'validate'    => 'color',
            'transparent' => false,
        ),
        array(
            'id'          => 'login_page_btn_hover_text_color',
            'type'        => 'color',
            'title'       => __( 'Login button hover and click text color', 'dina-kala' ),
            'default'     => '#ffffff',
            'validate'    => 'color',
            'transparent' => false,
        ),
        array(
            'id'     => 'login-page-btn-section-end',
            'type'   => 'section',
            'indent' => false,
        ),

        //User panel style section start
        array(
            'id'     => 'user-panel-style-section-start',
            'type'   => 'section',
            'title'  => __( 'User panel style settings', 'dina-kala' ),
            'indent' => true,
        ),
        array(
            'id'          => 'dashboard_bg_color',
            'type'        => 'color',
            'title'       => __( 'Dashboard menu background color', 'dina-kala' ),
            'default'     => '#172b4d',
            'validate'    => 'color',
            'transparent' => false,
        ),
        array(
            'id'          => 'dashboard_text_color',
            'type'        => 'color',
            'title'       => __( 'Dashboard menu text color', 'dina-kala' ),
            'default'     => '#ffffff',
            'validate'    => 'color',
            'transparent' => false,
        ),
        array(
            'id'          => 'total_orders_bg_color',
            'type'        => 'color',
            'title'       => __( 'Total Orders background color', 'dina-kala' ),
            'default'     => '#2bc999',
            'validate'    => 'color',
            'transparent' => false,
        ),
        array(
            'id'          => 'completed_orders_bg_color',
            'type'        => 'color',
            'title'       => __( 'Completed orders background color', 'dina-kala' ),
            'default'     => '#fbb41a',
            'validate'    => 'color',
            'transparent' => false,
        ),
        array(
            'id'       => 'completed_orders_title',
            'type'     => 'text',
            'title'    => __( 'Title', 'dina-kala' ),
            'default'  => __( 'Completed', 'dina-kala' ),
        ),
        array(
            'id'       => 'completed_orders_icon',
            'type'     => 'select',
            'select2'  => array( 'containerCssClass' => 'fa' ),
            'title'    => __( 'Icon', 'dina-kala' ),
            'class'    => ' dina-font-icon',
            'default'  => 'fal fa-box-check',
            'options'  => $iconArray,
        ),
        array(
            'id'       => 'completed_orders_status',
            'type'     => 'select',
            'title'    => __( 'Orders status', 'dina-kala' ),
            'default'  => 'wc-completed',
            'options'  => class_exists( 'WooCommerce' ) ? wc_get_order_statuses() : '',
        ),
        array(
            'id'          => 'wallet_inventory_bg_color',
            'type'        => 'color',
            'title'       => __( 'Pending payment orders background color', 'dina-kala' ),
            'default'     => '#34afff',
            'validate'    => 'color',
            'transparent' => false,
        ),
        array(
            'id'       => 'pending_orders_title',
            'type'     => 'text',
            'title'    => __( 'Title', 'dina-kala' ),
            'default'  => __( 'Pending payment', 'dina-kala' ),
        ),
        array(
            'id'       => 'pending_orders_icon',
            'type'     => 'select',
            'select2'  => array( 'containerCssClass' => 'fa' ),
            'title'    => __( 'Icon', 'dina-kala' ),
            'class'    => ' dina-font-icon',
            'default'  => 'fal fa-box-usd',
            'options'  => $iconArray,
        ),
        array(
            'id'       => 'pending_orders_status',
            'type'     => 'select',
            'title'    => __( 'Orders status', 'dina-kala' ),
            'default'  => 'wc-pending',
            'options'  => class_exists( 'WooCommerce' ) ? wc_get_order_statuses() : '',
        ),
        array(
            'id'          => 'registration_date_bg_color',
            'type'        => 'color',
            'title'       => __( 'Processing orders background color', 'dina-kala' ),
            'default'     => '#ff5e5b',
            'validate'    => 'color',
            'transparent' => false,
        ),
        array(
            'id'       => 'processing_orders_title',
            'type'     => 'text',
            'title'    => __( 'Title', 'dina-kala' ),
            'default'  => __( 'Processing', 'dina-kala' ),
        ),
        array(
            'id'       => 'processing_orders_icon',
            'type'     => 'select',
            'select2'  => array( 'containerCssClass' => 'fa' ),
            'title'    => __( 'Icon', 'dina-kala' ),
            'class'    => ' dina-font-icon',
            'default'  => 'fal fa-sync',
            'options'  => $iconArray,
        ),
        array(
            'id'       => 'processing_orders_status',
            'type'     => 'select',
            'title'    => __( 'Orders status', 'dina-kala' ),
            'default'  => 'wc-processing',
            'options'  => class_exists( 'WooCommerce' ) ? wc_get_order_statuses() : '',
        ),
        array(
            'id'          => 'panel_widgets_text_color',
            'type'        => 'color',
            'title'       => __( 'Text color of panel widgets', 'dina-kala' ),
            'default'     => '#ffffff',
            'validate'    => 'color',
            'transparent' => false,
        ),
        array(
            'id'     => 'user-panel-style-section-end',
            'type'   => 'section',
            'indent' => false,
        ),

        //User panel style in dark mode section start
        array(
            'id'       => 'user-panel-dark-section-start',
            'type'     => 'section',
            'title'    => __( 'User panel style settings in dark mode', 'dina-kala' ),
            'indent'   => true,
            'required' => array( 'dina_dark_mode', '=', true ),
        ),
        array(
            'id'      => 'user_panel_dark_mode',
            'type'    => 'switch',
            'title'   => __( 'Changing the style of the user panel in dark mode' , 'dina-kala' ),
            'default' => false,
        ),
        array(
            'id'          => 'dark_dashboard_bg_color',
            'type'        => 'color',
            'title'       => __( 'Dashboard menu background color', 'dina-kala' ),
            'default'     => '#172b4d',
            'validate'    => 'color',
            'transparent' => false,
            'required'    => array( 'user_panel_dark_mode', '=', true ),
        ),
        array(
            'id'          => 'dark_dashboard_text_color',
            'type'        => 'color',
            'title'       => __( 'Dashboard menu text color', 'dina-kala' ),
            'default'     => '#ffffff',
            'validate'    => 'color',
            'transparent' => false,
            'required'    => array( 'user_panel_dark_mode', '=', true ),
        ),
        array(
            'id'          => 'dark_total_orders_bg_color',
            'type'        => 'color',
            'title'       => __( 'Total Orders background color', 'dina-kala' ),
            'default'     => '#2bc999',
            'validate'    => 'color',
            'transparent' => false,
            'required'    => array( 'user_panel_dark_mode', '=', true ),
        ),
        array(
            'id'          => 'dark_completed_orders_bg_color',
            'type'        => 'color',
            'title'       => __( 'Completed orders background color', 'dina-kala' ),
            'default'     => '#fbb41a',
            'validate'    => 'color',
            'transparent' => false,
            'required'    => array( 'user_panel_dark_mode', '=', true ),
        ),
        array(
            'id'          => 'dark_wallet_inventory_bg_color',
            'type'        => 'color',
            'title'       => __( 'Wallet Inventory background color', 'dina-kala' ),
            'default'     => '#34afff',
            'validate'    => 'color',
            'transparent' => false,
            'required'    => array( 'user_panel_dark_mode', '=', true ),
        ),
        array(
            'id'          => 'dark_registration_date_bg_color',
            'type'        => 'color',
            'title'       => __( 'Registration date background color', 'dina-kala' ),
            'default'     => '#ff5e5b',
            'validate'    => 'color',
            'transparent' => false,
            'required'    => array( 'user_panel_dark_mode', '=', true ),
        ),
        array(
            'id'          => 'dark_panel_widgets_text_color',
            'type'        => 'color',
            'title'       => __( 'Text color of panel widgets', 'dina-kala' ),
            'default'     => '#ffffff',
            'validate'    => 'color',
            'transparent' => false,
            'required'    => array( 'user_panel_dark_mode', '=', true ),
        ),
        array(
            'id'     => 'user-panel-dark-section-end',
            'type'   => 'section',
            'indent' => false,
        ),

        // Login and Regsiter page style section start
        array(
            'id'     => 'login-register-style-section-start',
            'type'   => 'section',
            'title'  => __( 'Login and registration page style settings', 'dina-kala' ),
            'indent' => true,
        ),
        array(
            'id'       => 'login_page_bg',
            'type'     => 'image_select',
            'output'   => array( 'body.dina-light.dina-login-page:not(.page-template-elementor_canvas)' ),
            'tiles'    => true,
            'title'    => __( 'Login and registration page background', 'dina-kala' ),
            'subtitle' => __("Select an image as the background of the login and registration page.",'dina-kala' ),
            'options'  => $footer_patterns,
            'default'  => RE_URI . 'assets/img/fbg/0.png'
        ),
        array(
            'id'       => 'login_page_bg_switch',
            'type'     => 'switch',
            'title'    => __( 'Custom login and registration page Background', 'dina-kala' ),
            'subtitle' => __( 'Choose a background color or upload a custom photo', 'dina-kala' ),
            'default'  => false,
        ),
        array(         
            'id'      => 'login_page_custom_bg',
            'output'  => array( 'body.dina-light.dina-login-page:not(.page-template-elementor_canvas)' ),
            'type'    => 'background',
            'title'   => __( 'Login and registration page background', 'dina-kala' ),
            'default' => array(
                'background-color' => '#f4f5f9',
            ),
            'required' => array( 'login_page_bg_switch', '=', true ),
        ),
        array(
            'id'       => 'login_box_blur',
            'type'     => 'switch',
            'title' => __( 'Enable the transparent background of the login and registration box' , 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'     => 'login-register-style-section-end',
            'type'   => 'section',
            'indent' => false,
        ),

        // Login and Regsiter page style in dark mode section start
        array(
            'id'     => 'dark-login-register-style-section-start',
            'type'   => 'section',
            'title'  => __( 'Login and registration page style in dark mode settings', 'dina-kala' ),
            'indent' => true,
            'required' => array( 'dina_dark_mode', '=', true ),
        ),
        array(
            'id'       => 'dark_login_page_bg',
            'type'     => 'image_select',
            'output'   => array( 'body.dina-dark.dina-login-page:not(.page-template-elementor_canvas)' ),
            'tiles'    => true,
            'title'    => __( 'Login and registration page background', 'dina-kala' ),
            'subtitle' => __("Select an image as the background of the login and registration page.",'dina-kala' ),
            'options'  => $footer_patterns,
            'default'  => RE_URI . 'assets/img/fbg/0.png'
        ),
        array(
            'id'       => 'dark_login_page_bg_switch',
            'type'     => 'switch',
            'title'    => __( 'Custom login and registration page Background', 'dina-kala' ),
            'subtitle' => __( 'Choose a background color or upload a custom photo', 'dina-kala' ),
            'default'  => false,
        ),
        array(         
            'id'      => 'dark_login_page_custom_bg',
            'output'  => array( 'body.dina-dark.dina-login-page:not(.page-template-elementor_canvas)' ),
            'type'    => 'background',
            'title'   => __( 'Login and registration page background', 'dina-kala' ),
            'default' => array(
                'background-color' => '#f4f5f9',
            ),
            'required' => array( 'login_page_bg_switch', '=', true ),
        ),
        array(
            'id'       => 'login_box_blur_dark',
            'type'     => 'switch',
            'title' => __( 'Enable the transparent background of the login and registration box' , 'dina-kala' ),
            'default'  => false,
        ),
        array(
            'id'     => 'login-register-style-section-end',
            'type'   => 'section',
            'indent' => false,
        ),
    )
) );