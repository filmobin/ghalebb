<?php 

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
    exit;

require_once DI_DIR . '/includes/mobile-nav-bar.php';

//Dina Side Panels
add_action( 'wp_footer', 'dina_side_panels' );
function dina_side_panels() {

    if ( ! is_admin() ) { ?>
        <div class="overlay-blur"></div>

    <?php 
    if ( class_exists( 'WooCommerce' ) && ! dina_opt( 'product_catalog_mode' ) ) { ?>
    <!-- side cart -->
    <?php 
    $side_open   = ( dina_opt( 'ajax_add_open_cart' ) && ! di_elementor_edit_mode() ) ? ' dina-open-side' : '';
    $remove_cart = dina_opt( 'remove_mini_cart_btn' ) ? ' dina-remove-cart-btn' : '';
    ?>
    <div id="dinaSideCart" class="dina-side-cart dina-side-panel<?php echo $side_open . $remove_cart; ?>">
    
        <div class="side-head">
            <a href="javascript:void(0)" class="mclosebtn" aria-label="<?php _e( 'Close', 'dina-kala' ); ?>" data-title="<?php _e( 'Close', 'dina-kala' ); ?>" rel="nofollow" onclick="closeCart()">
                <i class="fal fa-times" aria-hidden="true"></i>
            </a>
            <div class="side-title">
                <i class="fal fa-shopping-bag" aria-hidden="true"></i> <?php _e( 'Shopping cart', 'dina-kala' ); ?>
            </div>
        </div>

        <?php do_action( 'dina-before-side-cart' ); ?>

        <div class="widget_shopping_cart_content">
            <?php 
                if ( ! dina_opt( 'remove_cart_fragments' ) )
                    wp_enqueue_script( 'wc-cart-fragments' );
                woocommerce_mini_cart();
            ?>
        </div>
        
        <?php do_action( 'dina-after-side-cart' ); ?>

        <?php if ( ! dina_opt( 'hide_side_panel_icon' ) ) { ?>
            <?php if ( dina_opt( 'change_side_panels_icon' ) && ! empty ( dina_to_https( dina_opt( 'cart_panel_image', 'url' ) ) ) ) { ?>
                <img src="<?php echo dina_to_https( dina_opt( 'cart_panel_image', 'url' ) ) ?>" class="dina-side-image" width="300" height="300" alt="<?php _e( 'Shopping cart', 'dina-kala' ) ?>" title="<?php _e( 'Shopping cart', 'dina-kala' ) ?>">
            <?php } else { ?>
                <i class="<?php echo dina_opt( 'cart_panel_icon' ) ?> side-icon" aria-hidden="true"></i>
        <?php } } ?>

    </div>
    <div id="dinaCanvasCart" class="overlay3" onclick="closeCart()"></div>
    <!-- side cart -->
    <?php } ?>

    <?php if ( ( ! dina_opt( 'replace_userbtns_shortcode' ) && ! is_user_logged_in() ) && ( ! dina_opt( 'ch_login_link' ) && ! is_user_logged_in() ) ) { ?>
    <!-- side login -->
    <div id="dinaSideLogin" class="dina-side-login dina-side-panel">
        <div class="side-head">
            <a href="javascript:void(0)" class="mclosebtn" aria-label="<?php _e( 'Close', 'dina-kala' ); ?>" data-title="<?php _e( 'Close', 'dina-kala' ); ?>" rel="nofollow" onclick="closeLogin()">
                <i class="fal fa-times" aria-hidden="true"></i>
            </a>
            <div class="side-title">
                <i class="fal fa-user-circle" aria-hidden="true"></i> <?php _e( 'Login to the site', 'dina-kala' ); ?>
            </div>
        </div>

        
        <?php
        //Dinakala login form
        echo (new DinakalaLogin)->renderForm();
        ?>

        <?php if ( dina_opt( 'show_login_notices' ) ) { ?>
            <div class="row dina-login-notices-wrapper">
                <div class="col-12 dina-login-notices-text">
                    <?php echo do_shortcode( dina_opt( 'login_notices_text' ) ); ?>
                </div>
            </div>
        <?php } ?>
        
        <?php if ( ! dina_opt( 'hide_side_panel_icon' ) ) { ?>
            <?php if ( dina_opt( 'change_side_panels_icon' ) && ! empty ( dina_to_https( dina_opt( 'login_panel_image', 'url' ) ) ) ) { ?>
                <img src="<?php echo dina_to_https( dina_opt( 'login_panel_image', 'url' ) ) ?>" class="dina-side-image" width="300" height="300" alt="<?php _e( 'Login to the site', 'dina-kala' ) ?>" title="<?php _e( 'Login to the site', 'dina-kala' ) ?>">
            <?php } else { ?>
                <i class="<?php echo dina_opt( 'login_panel_icon' ) ?> side-icon" aria-hidden="true"></i>
        <?php } } ?>

    </div>
    <div id="dinaCanvasLogin" class="overlay3" onclick="closeLogin()"></div>
    <!-- side login -->
    <?php } ?>

    <?php if ( is_user_logged_in() ) { ?>
    <!-- side user-menu -->
    <div id="dinaUmenu" class="dina-user-menu dina-side-panel">
        <div class="side-head">
            <a href="javascript:void(0)" class="closebtn" aria-label="<?php _e( 'Close', 'dina-kala' ); ?>" data-title="<?php _e( 'Close', 'dina-kala' ); ?>" rel="nofollow" onclick="closeUmenu()">
                <i class="fal fa-times" aria-hidden="true"></i>
            </a>
            <?php 
                $user = wp_get_current_user(); 
                echo get_avatar(get_current_user_id() , 65,'' ,$user->display_name ); ?>
            <span class="side-uname">
                <?php echo $user->display_name; ?>
            </span>
            <?php
            if ( class_exists( 'WooCommerce' ) && ! empty ( dina_get_wallet() ) ) {       
                echo '<span class="m-wallet">'. __( 'Wallet Inventory: ', 'dina-kala' ) . dina_get_wallet() .'</span>';
            }
            ?>
        </div>
        <?php if ( dina_opt( 'replace_user_menu' ) && has_nav_menu( 'user_menu' ) ) { ?>
        <?php
            wp_nav_menu( array(
                'menu'              => 'user_menu',
                'theme_location'    => 'user_menu',
                'menu_class'        => 'usmenu',
                'depth'             => 1,
                'container'         => ''
                )
            );
        ?>
        <?php } elseif ( class_exists( 'WooCommerce' ) ) { ?>
            <ul class="usmenu">
                <?php get_template_part( 'includes/umenu' ); ?>
            </ul>
        <?php } ?>

        <?php if ( ! dina_opt( 'hide_side_panel_icon' ) ) { ?>
            <?php if ( dina_opt( 'change_side_panels_icon' ) && ! empty ( dina_to_https( dina_opt( 'user_panel_image', 'url' ) ) ) ) { ?>
                <img src="<?php echo dina_to_https( dina_opt( 'user_panel_image', 'url' ) ) ?>" class="dina-side-image" width="300" height="300" alt="<?php _e( 'User menu', 'dina-kala' ) ?>" title="<?php _e( 'User menu', 'dina-kala' ) ?>">
            <?php } else { ?>
                <i class="<?php echo dina_opt( 'user_panel_icon' ) ?> side-icon" aria-hidden="true"></i>
        <?php } } ?>

    </div>
    <div id="dinaCanvasUser" class="overlay3" onclick="closeUmenu()"></div>
    <!-- side user-menu -->
    <?php } ?>

    <!-- mobile menu -->
    <div id="dinaNav" class="dina-side-nav dina-side-panel">
        <div class="side-head<?php if ( dina_opt( 'mobile_search' ) ) { echo ' nsearch'; } ?>">

            <a href="javascript:void(0)" class="mclosebtn" aria-label="<?php _e( 'Close', 'dina-kala' ); ?>" data-title="<?php _e( 'Close', 'dina-kala' ); ?>" rel="nofollow" onclick="closeNav()">
                <i class="fal fa-times" aria-hidden="true"></i>
            </a>

            <?php
            if ( dina_opt( 'dina_dark_mode' ) && dina_opt( 'dina_dark_mode_switch' ) ) {
            ?>
                <div class="btn-di-toggle di-toggle-mobile">
                    <i aria-hidden="true" class="di-toggle-icon fal fa-moon" title="<?php _e( 'Dark mode', 'dina-kala' ); ?>"></i>
                    <i aria-hidden="true" class="di-toggle-icon fal fa-sun" title="<?php _e( 'Light mode', 'dina-kala' ); ?>"></i>
                </div>
            <?php
            }
            
            if ( dina_opt( 'show_mobile_logo' ) )
                dina_site_logo( false, ' mobile-menu-logo', false );

            do_action( 'dina_after_nav_logo' );
            
            if ( ! dina_opt( 'mobile_search' ) )
                di_search_form( 'msform', 'mobile-search-cat', false );

            do_action( 'dina_after_nav_search' );
            
            ?>

        </div>
        <?php
        $dina_remove_parent_link = ( dina_opt( 'remove_parent_link' ) ? ' dina-remove-parent-link' : '' );
        ?>
        <nav id="cssmenu" class="dina-mobile-menu<?php echo $dina_remove_parent_link; ?>" <?php if ( dina_opt( 'site_schema' ) ) {?>itemscope itemtype="https://schema.org/SiteNavigationElement"<?php } ?>>
            <?php
            if ( dina_opt( 'replace_mobile_menu' ) && has_nav_menu( 'mobile_menu' ) ) {
                wp_nav_menu(array(
                    'menu'              => 'mobile_menu',
                    'theme_location'    => 'mobile_menu',
                    'container_id'      => 'cssmenu',
                    'fallback_cb'       => 'CSS_Menu_Maker_fallback',
                    'walker' => new CSS_Menu_Maker_Walker()
                ) );
            } else {
                wp_nav_menu(array(
                    'menu'              => 'mega_menu',
                    'theme_location'    => 'mega_menu',
                    'container_id'      => 'cssmenu',
                    'fallback_cb'       => 'CSS_Menu_Maker_fallback',
                    'walker' => new CSS_Menu_Maker_Walker()
                ) );
            }
            
            ?>
       </nav>

        <?php if ( ! dina_opt( 'hide_side_panel_icon' ) ) { ?>
            <?php if ( dina_opt( 'change_side_panels_icon' ) && ! empty ( dina_to_https( dina_opt( 'menu_panel_image', 'url' ) ) ) ) { ?>
                <img src="<?php echo dina_to_https( dina_opt( 'menu_panel_image', 'url' ) ) ?>" class="dina-side-image" width="300" height="300" alt="<?php _e( 'Menu', 'dina-kala' ) ?>" title="<?php _e( 'Menu', 'dina-kala' ) ?>">
            <?php } else { ?>
                <i class="<?php echo dina_opt( 'menu_panel_icon' ) ?> side-icon" aria-hidden="true"></i>
        <?php } } ?>

    </div>

    <div id="dinaCanvasNav" class="overlay3" onclick="closeNav()"></div>
    <!-- mobile menu -->

    <?php
    }
}

//Dina Footer Codes
add_action( 'dina_footer', 'dina_footer_codes' );
function dina_footer_codes() {

    if ( is_admin() )
        return;

    if ( is_singular( 'product' ) && dina_opt( 'mobile_sticky_add' ) && dina_check_product_purchasable() ) { 
        dina_mobile_sticky_add();
    }
    
    if ( ! dina_opt( 'hide_mobile_bar' ) && ! empty( dina_opt( 'mobile_bar_btns' ) ) ) {
        $mftitle     = dina_opt( 'mobile_bar_title' );
        $title_class = dina_opt( 'mobile_bar_title' ) ? ' mobile-footer-no-title' : ' mobile-footer-title'; 
        $blur_class  = dina_opt( 'mobile_bar_blur' ) ? ' di-box-blur' : ''; ?>
        <div class="mobile-footer<?php echo $title_class . $blur_class; ?>">
            <ul>
            <?php 
                $i = 0;
                foreach( dina_opt( 'mobile_bar_btns' ) as $btn ) {
                    if ( $i > 4 ) break;
                    switch ( $btn ) {
                        case 'back-top':
                            dina_nav_back_top_btn( $mftitle );
                            $i++;
                            break;
                        case 'wishlist':
                            dina_nav_wishlist_btn( $mftitle );
                            $i++;
                            break;
                        case 'home-add-cart':
                            dina_nav_home_buy_btn( $mftitle );
                            $i++;
                            break;
                        case 'compare-btn':
                            dina_nav_compare_btn( $mftitle );
                            $i++;
                            break;
                        case 'cart-btn':
                            dina_nav_cart_btn( $mftitle );
                            $i++;
                            break;
                        case 'my-account':
                            dina_nav_my_account_btn( $mftitle );
                            $i++;
                            break;
                        case 'menu':
                            dina_nav_menu_btn( $mftitle );
                            $i++;
                            break;
                        case 'dark-mode':
                            dina_nav_dark_mode( $mftitle );
                            $i++;
                            break;
                        case 'custom-btn-one':
                            dina_nav_custom_btn_one( $mftitle );
                            $i++;
                            break;
                        case 'custom-btn-two':
                            dina_nav_custom_btn_two( $mftitle );
                            $i++;
                            break;
                    }
                }
            ?>
            </ul>
        </div>
    <?php }

    if ( dina_opt( 'show_alert_app' ) ) { ?>
        <div class="alert alert-dark alert-app alert-dismissible fade show" role="alert">
            <button type="button" class="alert-app-close close" data-dismiss="alert" aria-label="Close">
                <i class="fal fa-times" aria-hidden="true"></i>
            </button>
            <span class="alert-app-title">
                <?php echo dina_opt( 'alert_app_title' ); ?>
            </span>
            <?php if ( dina_opt( 'and_link' ) != '' ) { ?>
                <a href="<?php echo dina_opt( 'and_link' ); ?>" rel="nofollow" class="btn btn-success and-btn"><i class="fab fa-android" aria-hidden="true"></i><?php _e( ' Android' , 'dina-kala' ); ?></a>
                <?php } ?>
                <?php if ( dina_opt( 'ios_link' ) != '' ) { ?>
                <a href="<?php echo dina_opt( 'ios_link' ); ?>" rel="nofollow" class="btn btn-secondary ios-btn"><i class="fab fa-apple" aria-hidden="true"></i> <?php _e( ' IOS' , 'dina-kala' ); ?></a>
            <?php } ?>
        </div>
    <?php }

    if ( dina_opt( 'show_return_top' ) && !dina_opt( 'return_top_style_two' ) ) { ?>
        <div id="back-top">
            <a href="#top">
                <i class="fal fa-chevron-up" aria-hidden="true"></i>
            </a>
        </div>
    <?php }
    
    if ( dina_opt( 'show_social_btn' ) ) {
        $classes   = array();
        $classes[] = dina_opt( 'social_btn_left' ) ? 'social-right' : 'social-left';
        $classes[] = dina_opt( 'social_btn_style' );
        $classes[] = dina_opt( 'social_btn_mobile' ) ? 'social-mobile' : 'social-desktop';
        $classes[] = dina_opt( 'social_circle_style' ) ? 'social-circle-style' : 'social-square-style';

        if ( dina_opt( 'social_btn_style' ) == 'dina-social-first-style' ) {
            $placement = 'top';
        } elseif ( dina_opt( 'social_btn_style' ) == 'dina-social-second-style' && dina_opt( 'social_btn_left' ) ) {
            $placement = 'left';
        } else{
            $placement = 'right';
        }
        ?>

        <div class="di-socialbtn <?php echo implode( ' ', $classes ); ?>">

            <?php
            if ( dina_opt( 'social_btn_fix_title' ) ) {
                $tooltip = ''; ?>
                <span class="di-socialbtn-title">
                    <?php echo dina_opt( 'social_btn_title' ); ?>
                </span>
            <?php
            } else {
                $tooltip = ' data-title="'. dina_opt( 'social_btn_title' ) .'" data-toggle="tooltip" data-placement="'. $placement .'" ';
            } ?>
            
            <?php $social_btn_animation = dina_opt( 'social_btn_style' ) == 'dina-social-first-style' && dina_opt( 'social_btn_animation' ) ? ' di-social-animate' : ''; ?>
            <a aria-label="<?php echo dina_opt( 'social_btn_title' ); ?>" href="<?php echo dina_opt( 'social_btn_link' ); ?>"<?php echo $tooltip; ?>title="<?php echo dina_opt( 'social_btn_title' ); ?>" target="_blank">
                <?php if ( ! empty ( dina_to_https( dina_opt( 'social_btn_img', 'url' ) ) ) ) { ?>
                    <img src="<?php echo dina_to_https( dina_opt( 'social_btn_img', 'url' ) ); ?>" width="60" height="60" alt="<?php echo dina_opt( 'social_btn_title' ); ?>" class="di-socialbtn-one-img<?php echo $social_btn_animation ?>">
                <?php } else { ?>
                    <span class="di-social-button di-socialbtn-one <?php echo dina_opt( 'social_btn_icon' ) . $social_btn_animation; ?>" aria-hidden="true"></span>
                <?php } ?>
            </a>

            <?php for ( $num = 2; $num < 6; $num++ ) {
                $number = di_num2word( $num );
                $class  = di_dig2word( $num ) ?>
        
            <?php
            if ( dina_opt( 'show_'. $number .'_social_btn' ) ) {
            $social_btn_animation = dina_opt( 'social_btn_style' ) == 'dina-social-first-style' && dina_opt( $number .'_social_btn_animation' ) ? ' di-social-animate' : '';
            ?>
            <a class="di-second-socialbtn" aria-label="<?php echo dina_opt( $number .'_social_btn_title' ); ?>" href="<?php echo dina_opt( $number .'_social_btn_link' ); ?>" data-title="<?php echo dina_opt( $number .'_social_btn_title' ); ?>" data-toggle="tooltip" data-placement="<?php echo $placement; ?>" title="<?php echo dina_opt( $number .'_social_btn_title' ); ?>" target="_blank">
                <?php if ( ! empty ( dina_to_https( dina_opt( $number .'_social_btn_img', 'url' ) ) ) ) { ?>
                    <img src="<?php echo dina_to_https( dina_opt( $number .'_social_btn_img', 'url' ) ); ?>" width="60" height="60" alt="<?php echo dina_opt( $number .'_social_btn_title' ); ?>" class="di-socialbtn-<?php echo $class; ?>-img<?php echo $social_btn_animation ?>">
                <?php } else { ?>
                    <span class="di-social-button di-socialbtn-<?php echo $class; ?> <?php echo dina_opt( $number .'_social_btn_icon' ) . $social_btn_animation; ?>" aria-hidden="true"></span>
                <?php } ?>
            </a>
            <?php } ?>

            <?php } ?>

        </div>
    <?php } ?>

<?php
}

//dina_js_footer_codes
if ( ! empty( dina_opt( 'footer_codes' ) ) ) {
    add_action( 'wp_footer', 'dina_js_footer_codes' );
}
function dina_js_footer_codes() { 
    
    print_r( dina_opt( 'footer_codes' ) ) . "\n";
}

//dina_js_gallery_codes
//add_action( 'wp_footer', 'dina_js_gallery_codes', 999 );
function dina_js_gallery_codes() {
    if ( is_singular( 'product' ) ) {
    ?>
        <script type="text/javascript">
            
        </script>
    <?php
    }
}

//dina_auto_update_cart
add_action( 'wp_footer', 'dina_auto_update_cart', 100 );
function dina_auto_update_cart() { 
    if ( ! class_exists( 'WooCommerce' ) ) 
        return;
    if ( is_cart() ) { ?>
    <script>
    var timeout;
    jQuery( function( $ ) {
        $( '.woocommerce' ).on( 'change', 'input.qty', function() {
            if ( timeout !== undefined ) {
                clearTimeout( timeout );
            }
            timeout = setTimeout(function() {
                $("[name='update_cart']").trigger("click");
            }, 1000 );
        });
        $( '.woocommerce' ).on( 'click', "button.plus, button.minus", function() {
            if ( timeout !== undefined ) {
                clearTimeout( timeout );
            }
            timeout = setTimeout(function() {
                $("[name='update_cart']").trigger("click");
            }, 500 );
        });
    } );
    </script>
<?php }
}

//dina_sticky_add_to_cart
add_action( 'wp_footer', 'dina_sticky_add_to_cart' );
function dina_sticky_add_to_cart() { 
    global $post, $product;

    if ( dina_opt( 'product_catalog_mode' ) || ! dina_opt( 'show_sticky_add' ) || ! dina_opt( 'desktop_sticky_add' ) )
        return;

    if ( is_singular( 'product' ) ) {

    $coming = get_post_meta( $product->get_id(), 'dina_coming', true );

    if ( $product->is_type( 'simple' ) && dina_is_call( $product->get_id() ) )
        return;

    if ( ! show_login_price() && ! $coming && ( $product->is_purchasable() || $product->is_type( 'external' ) ) && $product->is_in_stock() ) { ?>
    <div class="dina-sticky-add-cart">

        <div class="dina-sticky-thumb">
            <?php if ( has_post_thumbnail() ) {
                the_post_thumbnail( 'thumbnail' );
            } else {
                prod_default_thumb();
            } ?>
        </div>

        <div class="dina-sticky-title">
            <?php the_title(); ?>
        </div>

        <div class="dina-sticky-price">
            <?php woocommerce_template_single_price(); ?>
        </div>

        <div class="dina-sticky-add">
        <?php if ( $product->is_type( 'simple' ) )  { ?>
            <?php woocommerce_simple_add_to_cart(); ?>
        <?php } elseif ( $product->is_type( 'variable' ) ) { ?>
            <span class="single_add_to_cart_button button alt go-to-add">
                <?php _e( 'Select options' , 'dina-kala' ); ?>
            </span>
        <?php } elseif ( $product->is_type( 'external' ) ) { ?>
            <?php woocommerce_external_add_to_cart(); ?>
        <?php } ?>
        </div>

    </div>
<?php } }
}

//Product Additional Button Modal
add_action( 'wp_footer', 'dina_add_btn_modal' );
function dina_add_btn_modal() {
    global $post;
    
    if ( ! dina_opt( 'show_add_prod_popup' ) || ! is_object( $post ) || ! is_singular( 'product' ) ) 
        return;

        //check popup title and contect per product
        $product_popup_title   = esc_html( get_post_meta( get_the_ID(), 'dina_popup_title', true ) );
        $product_popup_content = dina_output_content( 'dina_popup_content', get_the_ID() );
 
        //check popup title and content per product category
        $product_cats      = wp_get_object_terms( get_the_ID(), 'product_cat', array( 'fields' => 'ids' ) );
        $cat_popup_title   = '';
        $cat_popup_content = '';

        foreach ( $product_cats as $cat ) {
            //check popup title
            if ( ! empty ( get_term_meta( $cat, 'dina_add_prod_cat_btn_popup_title', true ) ) ) {
                $cat_popup_title = get_term_meta( $cat, 'dina_add_prod_cat_btn_popup_title', true );
            }

            //check popup content
            if ( ! empty ( get_term_meta( $cat, 'dina_add_prod_cat_btn_popup_content', true ) ) ) {
                $cat_popup_content = get_term_meta( $cat, 'dina_add_prod_cat_btn_popup_content', true );
            }
        }

        //popup title final check
        if ( dina_opt( 'add_per_prod_popup' ) && $product_popup_title != '' ) {
            $popup_title = $product_popup_title;
        } elseif ( dina_opt( 'add_cat_prod_popup' ) && $cat_popup_title != '' ) {
            $popup_title = $cat_popup_title;
        } else {
            $popup_title = dina_opt( 'add_prod_popup_title' );
        }

        //popup content final check
        if ( dina_opt( 'add_per_prod_popup' ) && $product_popup_content != '' ) {
            $popup_content = $product_popup_content;
        } elseif ( dina_opt( 'add_cat_prod_popup' ) && $cat_popup_content != '' ) {
            $popup_content = dina_wpautop_content( $cat_popup_content );
        } else {
            $popup_content = dina_wpautop_content( dina_opt( 'add_prod_popup_text' ) );
        }
    ?>
    <!-- Add Btn Modal -->
    <div class="modal fade" id="addbtnModal">
        <div class="modal-dialog <?php echo dina_opt( 'add_prod_popup_size' ); ?> modal-dialog-centered">
            <div class="modal-content">

            <!-- Add Btn Modal Header -->
            <div class="modal-header">
                <div class="modal-title">
                    <i aria-hidden="true" class="<?php echo dina_opt( 'add_prod_btn_icon' ); ?>"></i>
                    <?php echo $popup_title; ?>
                </div>
                <button type="button" class="close" data-dismiss="modal">
                    <i class="fal fa-times" aria-hidden="true"></i>
                </button>
            </div>

            <!-- Add Btn Modal body -->
            <div class="modal-body">
               <?php echo $popup_content; ?>
            </div>

            </div>
        </div>
    </div>
<?php
}

//Product Additional Button Modal
add_action( 'template_redirect', function() {
    if ( is_product() ) {
        add_action( 'wp_footer', function() {
            for ( $num = 2; $num < 6; $num++ ) {
                $btn_number = di_num2word( $num );
                if ( dina_opt( $btn_number . '_show_add_prod_popup' ) ) {
                    dina_add_btns_modal( $btn_number );
                }
            }
        });
    }
});

function dina_add_btns_modal( $btn_number ) {
    global $post;
    
    if ( ! is_object( $post ) ) 
        return;

    //check popup title and contect per product
    $product_popup_title   = esc_html( get_post_meta( get_the_ID(), 'dina_'. $btn_number .'_popup_title', true ) );
    $product_popup_content = dina_output_content( 'dina_'. $btn_number .'_popup_content', get_the_ID() );

    //check popup title and content per product category
    $product_cats      = wp_get_object_terms( get_the_ID(), 'product_cat', array( 'fields' => 'ids' ) );
    $cat_popup_title   = '';
    $cat_popup_content = '';

    foreach ( $product_cats as $cat ) {
        //check popup title
        if ( ! empty ( get_term_meta( $cat, 'dina_'. $btn_number .'_add_prod_cat_btn_popup_title', true ) ) ) {
            $cat_popup_title = get_term_meta( $cat, 'dina_'. $btn_number .'_add_prod_cat_btn_popup_title', true );
        }

        //check popup content
        if ( ! empty ( get_term_meta( $cat, 'dina_'. $btn_number .'_add_prod_cat_btn_popup_content', true ) ) ) {
            $cat_popup_content = get_term_meta( $cat, 'dina_'. $btn_number .'_add_prod_cat_btn_popup_content', true );
        }
    }

    //popup title final check
    if ( dina_opt( $btn_number . '_add_per_prod_popup' ) && $product_popup_title != '' ) {
        $popup_title = $product_popup_title;
    } elseif ( dina_opt( $btn_number . '_add_cat_prod_popup' ) && $cat_popup_title != '' ) {
        $popup_title = $cat_popup_title;
    } else {
        $popup_title = dina_opt( $btn_number . '_add_prod_popup_title' );
    }

    //popup content final check
    if ( dina_opt( $btn_number . '_add_per_prod_popup' ) && $product_popup_content != '' ) {
        $popup_content = $product_popup_content;
    } elseif ( dina_opt( $btn_number . '_add_cat_prod_popup' ) && $cat_popup_content != '' ) {
        $popup_content = dina_wpautop_content( $cat_popup_content );
    } else {
        $popup_content = dina_wpautop_content( dina_opt( $btn_number . '_add_prod_popup_text' ) );
    }
    ?>
    <!-- Add Btn Modal -->
    <div class="modal fade" id="<?= $btn_number ?>_addbtnModal">
        <div class="modal-dialog <?php echo dina_opt( $btn_number . '_add_prod_popup_size' ); ?> modal-dialog-centered">
            <div class="modal-content">

            <!-- Add Btn Modal Header -->
            <div class="modal-header">
                <div class="modal-title">
                    <i aria-hidden="true" class="<?php echo dina_opt( $btn_number . '_add_prod_btn_icon' ); ?>"></i>
                    <?php echo $popup_title; ?>
                </div>
                <button type="button" class="close" data-dismiss="modal">
                    <i class="fal fa-times" aria-hidden="true"></i>
                </button>
            </div>

            <!-- Add Btn Modal body -->
            <div class="modal-body">
               <?php echo $popup_content; ?>
            </div>

            </div>
        </div>
    </div>
<?php
}
 	
//Product & Post Share Modal
add_action( 'wp_footer', 'dina_share_modal' );
function dina_share_modal() { 
    global $post;
    

    if ( ! is_object( $post ) ) 
        return;

    if ( ( is_singular( 'product' ) && dina_opt( 'share_prod' ) ) || ( is_singular( 'post' ) && dina_opt( 'share_post' ) ) ) {
    ?>
    <!-- The Share Modal -->
    <div class="modal fade" id="shareModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <!-- Share Modal Header -->
            <div class="modal-header">
                <div class="modal-title"><i class="fal fa-share-alt" aria-hidden="true"></i><?php _e( 'Share on social networks', 'dina-kala' ) ?></div>
                <button type="button" class="close" data-dismiss="modal">
                    <i class="fal fa-times" aria-hidden="true"></i>
                </button>
            </div>
            <!-- Share Modal body -->
            <div class="modal-body">
                <ul class="social-box">
                <?php $share_nofollow = ( dina_opt( 'nofollow_share_link' ) ? ' rel="nofollow noopener"' : '' ); ?>
                <?php 
                    if ( class_exists( 'YITH_WCAF' ) ) {
                        if ( defined( 'YITH_WCAF_PREMIUM' ) ) {
                            $user_is_affiliate = YITH_WCAF_Affiliate_Handler()->is_user_affiliate();
                        } else {
                            $user_is_affiliate = YITH_WCAF_Affiliates()->is_user_affiliate();
                        }
                    }
                ?>
                <?php if ( ( function_exists( 'affwp_is_affiliate' ) && affwp_is_affiliate( get_current_user_id() ) ) || ( class_exists( 'YITH_WCAF' ) && $user_is_affiliate ) ) {  ?>

                    <?php if ( dina_opt( 'share_facebook' ) ) { ?>
                    <li class="social-face">
                        <a data-toggle="tooltip" data-placement="top" title="<?php _e( 'Facebook', 'dina-kala' ); ?>" href="http://www.facebook.com/sharer.php?u=<?php echo wp_get_shortlink(); ?>&ref=<?php echo get_current_user_id(); ?>" target="_blank"<?php echo $share_nofollow; ?>>
                            <i class="fab fa-facebook-f" aria-hidden="true"></i>
                        </a>
                    </li>
                    <?php } ?>

                    <?php if ( dina_opt( 'share_google' ) ) { ?>
                    <li class="social-google">
                        <a data-toggle="tooltip" data-placement="top" title="<?php _e( 'Google+', 'dina-kala' ); ?>" href="https://plus.google.com/share?url=<?php echo wp_get_shortlink(); ?>&ref=<?php echo get_current_user_id(); ?>" target="_blank"<?php echo $share_nofollow; ?>>
                            <i class="fab fa-google-plus-g" aria-hidden="true"></i>
                        </a>
                    </li>
                    <?php } ?>

                    <?php if ( dina_opt( 'share_pinterest' ) ) { ?>
                    <li class="social-pin">
                        <a data-toggle="tooltip" data-placement="top" title="<?php _e( 'Pinterest', 'dina-kala' ); ?>" href="http://pinterest.com/pin/create/link/?url=<?php echo wp_get_shortlink(); ?>&ref=<?php echo get_current_user_id(); ?>" target="_blank"<?php echo $share_nofollow; ?>>
                            <i class="fab fa-pinterest-p" aria-hidden="true"></i>
                        </a>
                    </li>
                    <?php } ?>

                    <?php if ( dina_opt( 'share_twitter' ) ) { ?>
                    <li class="social-twi">
                        <a data-toggle="tooltip" data-placement="top" title="<?php _e( 'Twitter', 'dina-kala' ); ?>" href="http://www.twitter.com/share?url=<?php echo wp_get_shortlink(); ?>&ref=<?php echo get_current_user_id(); ?>" target="_blank"<?php echo $share_nofollow; ?>>
                            <i class="dico ico-twitter-x " aria-hidden="true"></i>
                        </a>
                    </li>
                    <?php } ?>

                    <?php if ( dina_opt( 'share_linkedin' ) ) { ?>
                    <li class="social-link">
                        <a data-toggle="tooltip" data-placement="top" title="<?php _e( 'Linkedin', 'dina-kala' ); ?>" href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo get_permalink(); ?>&ref=<?php echo get_current_user_id(); ?>" target="_blank"<?php echo $share_nofollow; ?>>
                            <i class="fab fa-linkedin-in" aria-hidden="true"></i>
                        </a>
                    </li>
                    <?php } ?>

                    <?php if ( dina_opt( 'share_telegram' ) ) { ?>
                    <li class="social-tele">
                        <a data-toggle="tooltip" data-placement="top" title="<?php _e( 'Telegram', 'dina-kala' ); ?>" href="https://telegram.me/share/url?url=<?php echo wp_get_shortlink(); ?>&ref=<?php echo get_current_user_id(); ?>" target="_blank"<?php echo $share_nofollow; ?>>
                            <i class="fab fa-telegram-plane" aria-hidden="true"></i>
                        </a>
                    </li>
                    <?php } ?>

                    <?php if ( dina_opt( 'share_whatsapp' ) ) { ?>
                    <li class="social-wts">
                        <a data-toggle="tooltip" data-placement="top" title="<?php _e( 'Whatsapp', 'dina-kala' ); ?>" href="https://wa.me/?text=<?php echo wp_get_shortlink(); ?>&ref=<?php echo get_current_user_id(); ?>" target="_blank"<?php echo $share_nofollow; ?>>
                            <i class="fab fa-whatsapp" aria-hidden="true"></i>
                        </a>
                    </li>
                    <?php } ?>

                    <?php if ( dina_opt( 'share_email' ) ) { ?>
                    <li class="social-email">
                        <a data-toggle="tooltip" data-placement="top" title="<?php _e( 'Email', 'dina-kala' ); ?>" href="mailto:?subject=<?php the_title(); ?>&body=<?php echo wp_get_shortlink(); ?>&ref=<?php echo get_current_user_id(); ?>" target="_blank"<?php echo $share_nofollow; ?>>
                            <i class="fal fa-envelope" aria-hidden="true"></i>
                        </a>
                    </li>
                    <?php } ?>

                <?php } else { ?>

                    <?php if ( dina_opt( 'share_facebook' ) ) { ?>
                    <li class="social-face">
                        <a data-toggle="tooltip" data-placement="top" title="<?php _e( 'Facebook', 'dina-kala' ); ?>" href="http://www.facebook.com/sharer.php?u=<?php echo wp_get_shortlink(); ?>" target="_blank"<?php echo $share_nofollow; ?>>
                        <i class="fab fa-facebook-f" aria-hidden="true"></i>
                        </a>
                    </li>
                    <?php } ?>

                    <?php if ( dina_opt( 'share_google' ) ) { ?>
                    <li class="social-google">
                        <a data-toggle="tooltip" data-placement="top" title="<?php _e( 'Google+', 'dina-kala' ); ?>" href="https://plus.google.com/share?url=<?php echo wp_get_shortlink(); ?>" target="_blank"<?php echo $share_nofollow; ?>>
                        <i class="fab fa-google-plus-g" aria-hidden="true"></i>
                        </a>
                    </li>
                    <?php } ?>

                    <?php if ( dina_opt( 'share_pinterest' ) ) { ?>
                    <li class="social-pin">
                        <a data-toggle="tooltip" data-placement="top" title="<?php _e( 'Pinterest', 'dina-kala' ); ?>" href="http://pinterest.com/pin/create/link/?url=<?php echo wp_get_shortlink(); ?>" target="_blank"<?php echo $share_nofollow; ?>>
                        <i class="fab fa-pinterest-p" aria-hidden="true"></i>
                        </a>
                    </li>
                    <?php } ?>

                    <?php if ( dina_opt( 'share_twitter' ) ) { ?>
                    <li class="social-twi">
                        <a data-toggle="tooltip" data-placement="top" title="<?php _e( 'Twitter', 'dina-kala' ); ?>" href="http://www.twitter.com/share?url=<?php echo wp_get_shortlink(); ?>" target="_blank"<?php echo $share_nofollow; ?>>
                        <i class="dico ico-twitter-x" aria-hidden="true"></i>
                        </a>
                    </li>
                    <?php } ?>

                    <?php if ( dina_opt( 'share_linkedin' ) ) { ?>
                    <li class="social-link">
                        <a data-toggle="tooltip" data-placement="top" title="<?php _e( 'Linkedin', 'dina-kala' ); ?>" href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo get_permalink(); ?>" target="_blank"<?php echo $share_nofollow; ?>>
                        <i class="fab fa-linkedin-in" aria-hidden="true"></i>
                        </a>
                    </li>
                    <?php } ?>

                    <?php if ( dina_opt( 'share_telegram' ) ) { ?>
                    <li class="social-tele">
                        <a data-toggle="tooltip" data-placement="top" title="<?php _e( 'Telegram', 'dina-kala' ); ?>" href="https://telegram.me/share/url?url=<?php echo wp_get_shortlink(); ?>" target="_blank"<?php echo $share_nofollow; ?>>
                        <i class="fab fa-telegram-plane" aria-hidden="true"></i>
                        </a>
                    </li>
                    <?php } ?>

                    <?php if ( dina_opt( 'share_whatsapp' ) ) { ?>
                    <li class="social-wts">
                        <a data-toggle="tooltip" data-placement="top" title="<?php _e( 'Whatsapp', 'dina-kala' ); ?>" href="https://wa.me/?text=<?php echo wp_get_shortlink(); ?>" target="_blank"<?php echo $share_nofollow; ?>>
                            <i class="fab fa-whatsapp" aria-hidden="true"></i>
                        </a>
                    </li>
                    <?php } ?>

                    <?php if ( dina_opt( 'share_email' ) ) { ?>
                    <li class="social-email">
                        <a data-toggle="tooltip" data-placement="top" title="<?php _e( 'Email', 'dina-kala' ); ?>" href="mailto:?subject=<?php the_title(); ?>&body=<?php echo wp_get_shortlink(); ?>" target="_blank"<?php echo $share_nofollow; ?>>
                            <i class="fal fa-envelope" aria-hidden="true"></i>
                        </a>
                    </li>
                    <?php } ?>

                <?php } ?>
                </ul>

                <?php if ( dina_opt( 'share_copy' ) ) { ?>
                    <div class="short-con">
                    <?php if ( ( function_exists( 'affwp_is_affiliate' ) && affwp_is_affiliate( get_current_user_id() ) ) || ( class_exists( 'YITH_WCAF' ) && $user_is_affiliate ) ) {  ?>
                        <span class="short-text"><?php _e( 'Marketing link:', 'dina-kala' ) ?></span>
                        <span class="short-link"><?php echo wp_get_shortlink() . '&ref=' . get_current_user_id(); ?></span>
                    <?php } else { ?>
                        <span class="short-text"><?php _e( 'Shortlink:', 'dina-kala' ) ?></span>
                        <span class="short-link"><?php echo wp_get_shortlink(); ?></span>
                        <span data-toggle="tooltip" data-placement="top" title="<?php _e( 'Copy Link', 'dina-kala' ); ?>" class="short-btn" onclick="copyToClipboard( '.short-link' )"><i class="fal fa-copy" aria-hidden="true"></i></span>
                    <?php } ?>
                    </div>
                    <div class="link-copy"><?php _e( 'Link copied!', 'dina-kala' ); ?></div>
                <?php } ?>

            </div>

            </div>
        </div>
    </div>
<?php } }

// dina_site_popup
add_action( 'wp_footer', 'dina_site_popup' );
function dina_site_popup() {
    
    if ( ! dina_opt( 'enable_site_popup' ) )
        return;

    if ( dina_opt( 'site_popup_home' ) && ! is_front_page() )
        return;

    $modal_classes = '';

    switch ( dina_opt( 'site_popup_image_pos' ) ) {
        case 'top':
            $modal_classes .= ' modal-image-top';
            break;
        case 'right':
            $modal_classes .= ' modal-image-right';
            break;
        case 'left':
            $modal_classes .= ' modal-image-left';
            break;
        case 'full-image':
            $modal_classes .= ' modal-image-full';
            break;

        default:
          $modal_classes .= ' modal-image-top';
    }

    $modal_classes .= dina_opt( 'show_site_popup_image' ) ? ' modal-with-image' : ' modal-not-image';

    $modal_classes .= dina_opt( 'site_popup_one_time' ) ? ' modal-one-time' : '';

    if ( dina_opt( 'site_popup_one_time' ) && dina_opt( 'site_popup_reshown' ) > 0 ) {
        $popup_reshown = dina_opt( 'site_popup_reshown' );
    } else {
        $popup_reshown = "null";
    }
    
    if ( dina_opt( 'site_popup_close_any' ) ) {
        $popup_close_any = 'class="modal fade popup-close-any"';
    } else {
        $popup_close_any = 'class="modal fade" data-backdrop="static"';
    }

    ?>
    <!-- Popup Modal -->
    <div <?php echo $popup_close_any; ?> data-keyboard="false" id="dinaSitePopup" data-reshown="<?php echo $popup_reshown; ?>">
        <div class="modal-dialog <?php echo dina_opt( 'site_popup_size' ); ?> modal-dialog-centered<?php echo $modal_classes; ?>">

            <div class="modal-content ">

                <button type="button" class="close" data-dismiss="modal">
                    <i class="fal fa-times" aria-hidden="true"></i>
                </button>

                <?php if ( dina_opt( 'show_site_popup_image' ) ) {
                    $image_width = ( ! empty( dina_opt( 'site_popup_image', 'width' ) ) ) ? dina_opt( 'site_popup_image', 'width' ) : '140';
                    $image_height = ( ! empty( dina_opt( 'site_popup_image', 'height' ) ) ) ? dina_opt( 'site_popup_image', 'height' ) : '60'; 
                ?>

                    <div class="modal-image col-md-5 col-12">
                        <?php if ( ! empty ( dina_opt( 'site_popup_image_link' ) ) ) { ?>
                            <a class="site-popup-image-link" href="<?php echo dina_opt( 'site_popup_image_link' ); ?>"<?php echo dina_opt( 'open_site_popup_image_link_new_tab' ) ? ' target="_blank"' : ''; ?>>
                        <?php } ?>
                        <img src="<?php echo dina_to_https( dina_opt( 'site_popup_image', 'url' ) ); ?>" width="<?php echo $image_width; ?>" height="<?php echo $image_height; ?>" alt="<?php echo dina_opt( 'site_popup_title' ); ?>" title="<?php echo dina_opt( 'site_popup_title' ); ?>" />
                        <?php if ( ! empty ( dina_opt( 'site_popup_image_link' ) ) ) { ?>
                            </a>
                        <?php } ?>
                    </div>
                <?php } ?>

                <?php if ( dina_opt( 'site_popup_image_pos' ) != 'full-image' ) { ?>
                <div class="modal-text col-md-7 col-12">
                    <?php echo do_shortcode( dina_opt( 'site_popup_content_text' ) ); ?>
                    
                    <?php if ( dina_opt( 'show_site_popup_button' ) ) { ?>
                        <a class="btn btn-lg <?php echo dina_opt( 'site_popup_button_color' ); ?> site-popup-button" href="<?php echo dina_opt( 'site_popup_button_link' ); ?>"<?php echo dina_opt( 'open_site_popup_link_new_tab' ) ? ' target="_blank"' : ''; ?>>
                            <?php echo '<span class="'. dina_opt( 'site_popup_button_icon' ) . '"></span> ' . dina_opt( 'site_popup_button_title' ); ?>
                        </a>
                    <?php } ?>
                </div>
                <?php } ?>

            </div>
        </div>
    </div>
<?php 
}

if ( dina_opt( 'maintenance' ) && ! current_user_can( 'administrator' ) )
{
    remove_action( 'dina_footer', 'dina_footer_codes' );
    remove_action( 'wp_footer', 'dina_js_gallery_codes' );
    remove_action( 'wp_footer', 'dina_auto_update_cart' );
    remove_action( 'wp_footer', 'dina_sticky_add_to_cart' );
    remove_action( 'wp_footer', 'dina_add_btn_modal' );
    remove_action( 'wp_footer', 'dina_site_popup' );
}