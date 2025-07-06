<?php
/*
Theme Designed By: Meysam Hosseinkhani
Email: Meysam98@Gmail.com
Author Website: i-design.ir
*/
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
exit;

add_action( 'wp_head', 'custom_styles', 160 );

function custom_styles() {
?>

<style>
    :root {
        --dina-custom-color: <?= dina_opt( 'custom_color' ) ?>;
        --woocommerce: <?= dina_opt( 'custom_color' ) ?>;
        --dina-msg-bgcolor: <?= dina_opt( 'msg_bgcolor' ) ?>;
        --dina-msg-fcolor: <?= dina_opt( 'msg_fcolor' ) ?>;
        --dina-head-bg-color: <?= dina_opt( 'head_bg_color' ) ?>;
        --dina-head-text-color: <?= dina_opt( 'head_text_color' ) ?>;
        --dina-menu-bg-color: <?= dina_opt( 'menu_bg_color' ) ?>;
        --dina-menu-text-color: <?= dina_opt( 'menu_text_color' ) ?>;
        --dina-footer-text-color: <?= dina_opt( 'footer_text_color' ) ?>;
        --dina-add-btn-color: <?= dina_opt( 'add_btn_color' ) ?>;
        --dina-add-btn-text-color: <?= dina_opt( 'add_btn_text_color' ) ?>;
        --dina-register-btn-text-color: <?= dina_opt( 'register_btn_text_color' ) ?>;
        --dina-register-btn-color: <?= dina_opt( 'register_btn_color' ) ?>;
        --dina-register-btn-hover-text-color: <?= dina_opt( 'register_btn_hover_text_color' ) ?>;
        --dina-register-btn-hover-color: <?= dina_opt( 'register_btn_hover_color' ) ?>;
        --dina-login-btn-text-color: <?= dina_opt( 'login_btn_text_color' ) ?>;
        --dina-login-btn-color: <?= dina_opt( 'login_btn_color' ) ?>;
        --dina-login-btn-hover-text-color: <?= dina_opt( 'login_btn_hover_text_color' ) ?>;
        --dina-login-btn-hover-color: <?= dina_opt( 'login_btn_hover_color' ) ?>;

        --dina-login-page-btn-text-color: <?= dina_opt( 'login_page_btn_text_color' ) ?>;
        --dina-login-page-btn-color: <?= dina_opt( 'login_page_btn_color' ) ?>;
        --dina-login-page-btn-hover-text-color: <?= dina_opt( 'login_page_btn_hover_text_color' ) ?>;
        --dina-login-page-btn-hover-color: <?= dina_opt( 'login_page_btn_hover_color' ) ?>;

        --dina-price-font-size: <?= dina_opt( 'price_font_size' ) ?>px;
        --dina-content-font-size: <?= dina_opt( 'content_font_size' ) ?>px;
        --dina-h1-font-size: <?= dina_opt( 'h1_font_size' ) ?>px;
        --dina-h2-font-size: <?= dina_opt( 'h2_font_size' ) ?>px;
        --dina-h3-font-size: <?= dina_opt( 'h3_font_size' ) ?>px;
        --dina-h4-font-size: <?= dina_opt( 'h4_font_size' ) ?>px;
        --dina-h5-font-size: <?= dina_opt( 'h5_font_size' ) ?>px;
        --dina-h6-font-size: <?= dina_opt( 'h6_font_size' ) ?>px;
        --dina-copy-bg-color: <?= dina_opt( 'copy_bg_color' ) ?>;
        --dina-copy-text-color: <?= dina_opt( 'copy_text_color' ) ?>;
        --dina-menu-label-bg-color: <?= dina_opt( 'menu_label_bg_color' ) ?>;
        --dina-menu-label-text-color: <?= dina_opt( 'menu_label_text_color' ) ?>;
        --dina-dis-color: <?= dina_opt( 'dis_color' ) ?>;
        --dina-dis-text-color: <?= dina_opt( 'dis_text_color' ) ?>;
        --dina-price-color: <?= dina_opt( 'price_color' ) ?>;
        --dina-shop-box-bg: <?= dina_opt( 'shop_box_bg' ) ?>;
        --dina-read-product-color: <?= dina_opt( 'read_product_color' ) ?>;
        --dina-read-product-text-color: <?= dina_opt( 'read_product_text_color' ) ?>;
        --dina-read-product-hover-color: <?= dina_opt( 'read_product_hover_color' ) ?>;
        --dina-read-product-hover-text-color: <?= dina_opt( 'read_product_hover_text_color' ) ?>;
        --dina-woo-btn-bg: <?= dina_adjustBrightness( dina_opt( 'custom_color' ), -0.2 ) ?>;
        --dina-bnr-hover-title: <?= hex2rgba( dina_opt( 'custom_color' ), 0.5 ) ?>;
        --dina-social-btn-color: <?= dina_opt( 'social_btn_color' ) ?>;
        --dina-second-social-btn-color: <?= dina_opt( 'second_social_btn_color' ) ?>;
        --dina-third-social-btn-color: <?= dina_opt( 'third_social_btn_color' ) ?>;
        --dina-fourth-social-btn-color: <?= dina_opt( 'fourth_social_btn_color' ) ?>;
        --dina-fifth-social-btn-color: <?= dina_opt( 'fifth_social_btn_color' ) ?>;
        --dina-slider-tab-color: <?= hex2rgba( dina_opt( 'slider_tab_color' ), 0.9 ) ?>;
        --dina-slider-tab-color-active-border: <?= hex2rgba( dina_opt( 'slider_tab_color_active' ), 0.5 ) ?>;
        --dina-slider-tab-color-active: <?= hex2rgba( dina_opt( 'slider_tab_color_active' ), 0.9 ) ?>;
        --dina-dashboard-bg-color: <?= dina_opt( 'dashboard_bg_color' ) ?>;
        --dina-dashboard-text-color: <?= dina_opt( 'dashboard_text_color' ) ?>;
        --dina-total-orders-bg-color: <?= dina_opt( 'total_orders_bg_color' ) ?>;
        --dina-completed-orders-bg-color: <?= dina_opt( 'completed_orders_bg_color' ) ?>;
        --dina-wallet-inventory-bg-color: <?= dina_opt( 'wallet_inventory_bg_color' ) ?>;
        --dina-registration-date-bg-color: <?= dina_opt( 'registration_date_bg_color' ) ?>;
        --dina-panel-widgets-text-color: <?= dina_opt( 'panel_widgets_text_color' ) ?>;
        --dina-input-border-radius: <?= ! dina_opt( 'rounded_corners' ) ? 0 : dina_opt( 'input_border_radius' ) ?>px;
        <?php if ( dina_opt( 'show_page_loading' ) ) {
        if ( ! empty ( dina_opt( 'custom_loading_image', 'url' ) || ! empty ( dina_opt( 'load_img' ) ) ) ) { ?>
        --dina-loading-img: url(<?php echo ( ! dina_opt( 'show_custom_loading' ) ? dina_opt( 'load_img' ) : dina_to_https( dina_opt( 'custom_loading_image', 'url' ) ) ); ?>);
        <?php }
        } 
        if ( dina_opt( 'change_coming_price_color' ) ) { ?>
            --dina-free-price-color: <?= dina_opt( 'free_price_color' ) ?>;
            --dina-coming-price-color: <?= dina_opt( 'coming_price_color' ) ?>;
        <?php } ?>
    }

    <?php if ( dina_opt( 'ch_dark_custom_color' ) ) { ?>
        :root .dina-dark {
            --dina-custom-color: <?= dina_opt( 'dark_custom_color' ) ?>;
            --dina-woo-btn-bg: <?= dina_adjustBrightness( dina_opt( 'dark_custom_color' ), -0.2 ) ?>;
        }
    <?php } ?>

    <?php if ( dina_opt( 'dina_dark_mode' ) && dina_opt( 'user_panel_dark_mode' ) ) { ?>
        :root .dina-dark {
            --dina-dashboard-bg-color: <?= dina_opt( 'dark_dashboard_bg_color' ) ?>;
            --dina-dashboard-text-color: <?= dina_opt( 'dark_dashboard_text_color' ) ?>;
            --dina-total-orders-bg-color: <?= dina_opt( 'dark_total_orders_bg_color' ) ?>;
            --dina-completed-orders-bg-color: <?= dina_opt( 'dark_completed_orders_bg_color' ) ?>;
            --dina-wallet-inventory-bg-color: <?= dina_opt( 'dark_wallet_inventory_bg_color' ) ?>;
            --dina-registration-date-bg-color: <?= dina_opt( 'dark_registration_date_bg_color' ) ?>;
            --dina-panel-widgets-text-color: <?= dina_opt( 'dark_panel_widgets_text_color' ) ?>;
        }
    <?php } ?>

    <?php if ( dina_opt( 'ch_dark_price_color' ) ) { ?>
        :root .dina-dark {
            --dina-price-color: <?= dina_opt( 'dark_price_color' ) ?>;
            <?php if ( dina_opt( 'ch_dark_coming_price_color' ) ) { ?>
            --dina-free-price-color: <?= dina_opt( 'dark_free_price_color' ) ?>;
            --dina-coming-price-color: <?= dina_opt( 'dark_coming_price_color' ) ?>;
            <?php } ?>
        }
    <?php } ?>

    <?php
    if ( dina_opt( 'custom_font' ) ) {
        echo dina_custom_font();
    } 
    ?>

    <?php if ( dina_opt( 'ch_scroll_bar' ) ) { ?>
        body::-webkit-scrollbar-thumb{background:var(--dina-custom-color)}
        body::-webkit-scrollbar-thumb:hover{background:var(--dina-custom-color)}
    <?php } ?>

    <?php if ( function_exists( 'digits_version' ) ) { ?>
    .dig_ma-box, .dig_ma-box input, .dig_ma-box input::placeholder, .dig_ma-box ::placeholder, .dig_ma-box label, .dig_ma-box button, .dig_ma-box select, .dig_ma-box * {font-family: 'dana', sans-serif !important;}
    <?php } ?>

    <?php if ( ! dina_opt( 'show_loading_bar' ) ) { ?>
    .pace {display: none}
    <?php } ?>

    <?php if ( dina_opt( 'show_return_top' ) ) {
    $side = ( dina_opt( 'return_top_left' ) ? 'left' : 'right' ); ?>
    #back-top { bottom:<?php echo dina_opt( 'return_top_bottom' ); ?>px;<?php echo $side ?>:<?php echo dina_opt( 'return_top_right' ); ?>px;}
    <?php } ?>

    <?php if ( dina_opt( 'show_social_btn' ) ) {
    $side = ( dina_opt( 'social_btn_left' ) ? 'right' : 'left' ); ?>
    .di-socialbtn {bottom:<?php echo dina_opt( 'social_btn_bottom' ); ?>px;<?php echo $side ?>:<?php echo dina_opt( 'social_btn_right' ); ?>px;}
    <?php 
    } ?>

    <?php if ( dina_opt( 'ajax_search' ) ) { ?>
    .searchwp-live-search-no-min-chars::after {content: '<?php _e( 'Please type...', 'dina-kala' ) ?>';}
    <?php } ?>

    <?php if ( dina_opt( 'change_coming_price_color' ) ) { ?>
        .dina-coming-price,.dina-coming-product .dina-product-table-price{color:var(--dina-coming-price-color)}
        .dina-free-price,.dina-free-product .dina-product-table-price{color:var(--dina-free-price-color)}
    <?php } ?>

    <?php
        if ( is_user_logged_in() ) {
            for( $num = 1; $num <= 10 ; $num++ ) {
                if ( dina_opt( 'dashboard_link_'. di_dig2word( $num ) ) ) {
                    echo ".woocommerce-MyAccount-navigation-link--dina-dashboard-link-". di_dig2word( $num ) ." a:before {content: '". difa_search( dina_opt( 'dashboard_link_'. di_dig2word( $num ) .'_icon' ) ) ."'}";
                }
            }
        }
    ?>

    <?php if ( ! empty ( dina_opt( 'img_msg_image', 'url' ) ) && dina_opt( 'show_img_msg' ) ) { ?>
        .head-img-msg{background-image: url(<?php echo dina_to_https( dina_opt( 'img_msg_image', 'url' ) ); ?>)}
    <?php } ?>

    <?php if ( ! empty ( dina_opt( 'img_msg_image_mobile', 'url' ) ) && dina_opt( 'show_img_msg' ) ) { ?>
        @media screen and (max-width:768px) {
            .head-img-msg-con{display: block}
            .head-img-msg{background-image: url(<?php echo dina_to_https( dina_opt( 'img_msg_image_mobile', 'url' ) ); ?>)}
        }
    <?php } ?>

    <?php if ( dina_opt( 'show_features_limited' ) ) { ?>
        .dina-features-limited ul.dina-features-ul{-webkit-line-clamp:<?php echo (int)dina_opt( 'features_limited_line' ); ?>}
    <?php } ?>

    <?php
    if ( ! empty( dina_opt( 'custom_css' ) ) ) {
        print_r( dina_opt( 'custom_css' ) ) . "\n";
    }
    ?>

    <?php do_action ( 'dina_header_styles' ); ?>

</style>

<?php
    if ( ! empty( dina_opt( 'header_codes' ) ) ) {
        print_r( dina_opt( 'header_codes' ) ) . "\n";
    }
}

function dina_custom_font() {
    //Custom Font Normal
    $dina_font = '@font-face{font-family:dana;font-display: swap;font-fallback:arial, sans-serif,tahoma;font-weight:400;src:';

    if ( ! empty( dina_opt( 'theme_font_woff2', 'url' ) ) ) {
        $dina_font .= "url(". dina_to_https( dina_opt( 'theme_font_woff2', 'url' ) ) .") format( 'woff2' ),";
    }

    if ( ! empty( dina_opt( 'theme_font_woff', 'url' ) ) ) {
        $dina_font .= "url(". dina_to_https( dina_opt( 'theme_font_woff', 'url' ) ) .") format( 'woff' ),";
    }

    if ( ! empty( dina_opt( 'theme_font_ttf', 'url' ) ) ) {
        $dina_font .= "url(". dina_to_https( dina_opt( 'theme_font_ttf', 'url' ) ) .") format( 'ttf' ),";
    }

    if ( ! empty( dina_opt( 'theme_font_eot', 'url' ) ) ) {
        $dina_font .= "url(". dina_to_https( dina_opt( 'theme_font_eot', 'url' ) ) .") format( 'eot' ),";
    }

    if ( ! empty( dina_opt( 'theme_font_svg', 'url' ) ) ) {
        $dina_font .= "url(". dina_to_https( dina_opt( 'theme_font_svg', 'url' ) ) .") format( 'svg' )";
    }
    
    $dina_font .= ';}';

    //Custom Font Bold
    $dina_font .= '@font-face{font-family:dana-md;font-display:swap;font-fallback:arial,sans-serif,tahoma;font-weight:500;src:';

    if ( dina_opt( 'custom_bold_font' ) && ! empty( dina_opt( 'theme_font_bold_woff2', 'url' ) ) ) {
        $dina_font .= "url(". dina_to_https( dina_opt( 'theme_font_bold_woff2', 'url' ) ) .") format( 'woff2' ),";
    } elseif ( ! empty( dina_opt( 'theme_font_woff2', 'url' ) ) ) {
        $dina_font .= "url(". dina_to_https( dina_opt( 'theme_font_woff2', 'url' ) ) .") format( 'woff2' ),";
    }

    if ( dina_opt( 'custom_bold_font' ) && ! empty( dina_opt( 'theme_font_bold_woff', 'url' ) ) ) {
        $dina_font .= "url(". dina_to_https( dina_opt( 'theme_font_bold_woff', 'url' ) ) .") format( 'woff' ),";
    } elseif ( ! empty( dina_opt( 'theme_font_woff', 'url' ) ) ) {
        $dina_font .= "url(". dina_to_https( dina_opt( 'theme_font_woff', 'url' ) ) .") format( 'woff' ),";
    }

    if ( dina_opt( 'custom_bold_font' ) && ! empty( dina_opt( 'theme_font_bold_ttf', 'url' ) ) ) {
        $dina_font .= "url(". dina_to_https( dina_opt( 'theme_font_bold_ttf', 'url' ) ) .") format( 'ttf' ),";
    } elseif ( ! empty( dina_opt( 'theme_font_ttf', 'url' ) ) ) {
        $dina_font .= "url(". dina_to_https( dina_opt( 'theme_font_ttf', 'url' ) ) .") format( 'ttf' ),";
    }

    if ( dina_opt( 'custom_bold_font' ) && ! empty( dina_opt( 'theme_font_bold_eot', 'url' ) ) ) {
        $dina_font .= "url(". dina_to_https( dina_opt( 'theme_font_bold_eot', 'url' ) ) .") format( 'eot' ),";
    } elseif ( ! empty( dina_opt( 'theme_font_eot', 'url' ) ) ) {
        $dina_font .= "url(". dina_to_https( dina_opt( 'theme_font_eot', 'url' ) ) .") format( 'eot' ),";
    }

    if ( dina_opt( 'custom_bold_font' ) && ! empty( dina_opt( 'theme_font_bold_svg', 'url' ) ) ) {
        $dina_font .= "url(". dina_to_https( dina_opt( 'theme_font_bold_svg', 'url' ) ) .") format( 'svg' )";
    } elseif ( ! empty( dina_opt( 'theme_font_svg', 'url' ) ) ) {
        $dina_font .= "url(". dina_to_https( dina_opt( 'theme_font_svg', 'url' ) ) .") format( 'svg' )";
    }
    
    $dina_font .= ';}';

    //Custom Font Farsi Digits
    $dina_font .= '@font-face{font-family:dana-fd;font-display:swap;font-fallback:arial,sans-serif,tahoma;font-weight:400;src:';

    if ( dina_opt( 'custom_farsi_font' ) && ! empty( dina_opt( 'theme_font_farsi_woff2', 'url' ) ) ) {
        $dina_font .= "url(". dina_to_https( dina_opt( 'theme_font_farsi_woff2', 'url' ) ) .") format( 'woff2' ),";
    } elseif ( ! empty( dina_opt( 'theme_font_woff2', 'url' ) ) ) {
        $dina_font .= "url(". dina_to_https( dina_opt( 'theme_font_woff2', 'url' ) ) .") format( 'woff2' ),";
    }

    if ( dina_opt( 'custom_farsi_font' ) && ! empty( dina_opt( 'theme_font_farsi_woff', 'url' ) ) ) {
        $dina_font .= "url(". dina_to_https( dina_opt( 'theme_font_farsi_woff', 'url' ) ) .") format( 'woff' ),";
    } elseif ( ! empty( dina_opt( 'theme_font_woff', 'url' ) ) ) {
        $dina_font .= "url(". dina_to_https( dina_opt( 'theme_font_woff', 'url' ) ) .") format( 'woff' ),";
    }

    if ( dina_opt( 'custom_farsi_font' ) && ! empty( dina_opt( 'theme_font_farsi_ttf', 'url' ) ) ) {
        $dina_font .= "url(". dina_to_https( dina_opt( 'theme_font_farsi_ttf', 'url' ) ) .") format( 'ttf' ),";
    } elseif ( ! empty( dina_opt( 'theme_font_ttf', 'url' ) ) ) {
        $dina_font .= "url(". dina_to_https( dina_opt( 'theme_font_ttf', 'url' ) ) .") format( 'ttf' ),";
    }
    
    if ( dina_opt( 'custom_farsi_font' ) && ! empty( dina_opt( 'theme_font_farsi_eot', 'url' ) ) ) {
        $dina_font .= "url(". dina_to_https( dina_opt( 'theme_font_farsi_eot', 'url' ) ) .") format( 'eot' ),";
    } elseif ( ! empty( dina_opt( 'theme_font_eot', 'url' ) ) ) {
        $dina_font .= "url(". dina_to_https( dina_opt( 'theme_font_eot', 'url' ) ) .") format( 'eot' ),";
    }

    if ( dina_opt( 'custom_farsi_font' ) && ! empty( dina_opt( 'theme_font_farsi_svg', 'url' ) ) ) {
        $dina_font .= "url(". dina_to_https( dina_opt( 'theme_font_farsi_svg', 'url' ) ) .") format( 'svg' )";
    } elseif ( ! empty( dina_opt( 'theme_font_svg', 'url' ) ) ) {
        $dina_font .= "url(". dina_to_https( dina_opt( 'theme_font_svg', 'url' ) ) .") format( 'svg' )";
    }
    
    $dina_font .= ';}';

    $dina_font .= 'body,html{font-family:dana,Arial,sans-serif,tahoma;font-size:15px}';

    //Return Custom Font
    return $dina_font;
}