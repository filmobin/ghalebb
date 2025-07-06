<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
    exit;

?>

<header class="dina-site-header<?php if ( !is_front_page() && ( ! dina_opt( 'show_bread' ) || ! dina_opt( 'show_bread_mobile' ) ) ) { echo ' no-bread'; }  ?>" <?php if ( dina_opt( 'site_schema' ) ) {?>itemscope itemtype="https://schema.org/Organization" <?php } ?>>
       <?php if ( dina_opt( 'site_schema' ) ) { 
        echo '<meta itemprop="url" content="'. esc_url( home_url() ) .'">';
        echo '<meta itemprop="name" content="'. esc_html( get_bloginfo( 'name' ) ) .'">';
        } ?>
    <!-- Header Div -->
        <div class="container-fluid dina-header header<?php if ( dina_opt( 'fixed_head_mobile' ) ) { echo ' fixed-mobile'; } ?>">
            <div class="container">
                
                <?php if ( !dina_opt( 'hide_top_bar' ) ) { ?>
                <div class="row head-mc<?php if ( dina_opt( 'head_pos' ) == 2) {echo ' left-head'; } ?>">

                    <!-- Header Menu -->
                    <nav class="col-md-6 head-menu<?php if ( dina_opt( 'mobile_head_menu' ) ) {echo ' visible-mobile';} ?>" <?php if ( dina_opt( 'site_schema' ) ) {?>itemscope itemtype="https://schema.org/SiteNavigationElement" <?php } ?>>
                        <?php
                        if ( has_nav_menu( 'header' ) ) {
                            wp_nav_menu( array(
                                'menu'              => 'header',
                                'theme_location'    => 'header',
                                'depth'             => 1,
                                'container'         => 'div'
                                )
                            );
                        }
                        ?>
                    </nav>
                    <!-- Header Menu -->
                    
                    <?php if ( dina_opt( 'show_contact' ) && !dina_opt( 'show_head_social' ) ) {
                    $contact_nofollow    = ( dina_opt( 'contact_link_nofollow' ) ? ' rel="nofollow"' : '' );
                    $contact_link_target = empty( dina_opt( 'contact_link_target' ) ) ? '_blank' : dina_opt( 'contact_link_target' );
                    ?>
                    <!-- Header Contact -->
                    <div class="col-md-6 head-contact<?php echo dina_opt( 'show_contact_mobile' ) ? ' visible-mobile' : ''; ?>">
                        <meta itemprop="address" content="<?php echo dina_opt( 'addr_text' ); ?>">
                        <meta itemprop="image" content="<?php echo dina_to_https( dina_opt( 'site_logo_retina', 'url' ) ); ?>">

                        <?php if ( ! empty ( dina_opt( 'site_tel' ) ) ) { ?>
                        <div class="head-phone" <?php if ( dina_opt( 'site_schema' ) ) {?>itemprop="telephone"<?php } ?>>
                            <?php if ( dina_opt( 'site_tel_link' ) ) {
                                $tel_link = dina_opt( 'custom_tel_link' ) ? dina_opt( 'custom_tel_link_addr' ) : 'tel:' . dina_remove_dash( dina_opt( 'site_tel' ) ); ?>
                            <a href="<?php echo $tel_link; ?>" target="<?= $contact_link_target ?>"<?php echo $contact_nofollow; ?>>
                            <?php } ?>
                                <i class="fal fa-phone" aria-hidden="true"></i>
                                <?php echo dina_opt( 'site_tel' ); ?>
                            <?php if ( dina_opt( 'site_tel_link' ) ) { ?>
                            </a>
                            <?php } ?>
                        </div>
                        <?php } ?>

                        <?php if ( dina_opt( 'replace_email' ) && ! empty ( dina_opt( 'site_tel2' ) ) ) { ?>
                            <div class="head-phone" <?php if ( dina_opt( 'site_schema' ) ) {?>itemprop="telephone"<?php } ?>>
                                <?php if ( dina_opt( 'site_tel_link' ) ) {
                                    $email_link = dina_opt( 'custom_email_link' ) ? dina_opt( 'custom_email_link_addr' ) : 'tel:' . dina_remove_dash( dina_opt( 'site_tel2' ) ); ?>
                                <a href="<?php echo $email_link; ?>" target="<?= $contact_link_target ?>"<?php echo $contact_nofollow; ?>>
                                <?php } ?>
                                    <i class="fal fa-phone-rotary" aria-hidden="true"></i>
                                    <?php echo dina_opt( 'site_tel2' ); ?>
                                <?php if ( dina_opt( 'site_tel_link' ) ) { ?>
                                </a>
                                <?php } ?>
                            </div>
                        <?php } elseif ( ! empty ( dina_opt( 'site_email' ) ) ) { ?>
                            <div class="head-email" <?php if ( dina_opt( 'site_schema' ) ) {?>itemprop="email"<?php } ?>>
                                <?php if ( dina_opt( 'site_email_link' ) ) {
                                $email_link = dina_opt( 'custom_email_link' ) ? dina_opt( 'custom_email_link_addr' ) : 'mailto:' . dina_opt( 'site_email' ); ?>
                                <a href="<?php echo $email_link; ?>" target="<?= $contact_link_target ?>"<?php echo $contact_nofollow; ?>>
                                <?php } ?>
                                    <i class="fal fa-envelope" aria-hidden="true"></i>
                                    <?php echo dina_opt( 'site_email' ); ?>
                                <?php if ( dina_opt( 'site_email_link' ) ) { ?>
                                </a>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                    <!-- Header Contact -->
                    <?php } ?>

                    <?php
                    if ( dina_opt( 'show_head_social' ) ) { //Header Social Links
                    ?>
                    <!-- Header Social -->
                    <div class="col-md-6 head-social<?php echo dina_opt( 'show_head_social_mobile' ) ? ' visible-mobile' : ''; ?>">
                        <?php dina_social_links( 'head-social-ul', true ) ?>
                    </div>
                    <!-- Header Social -->
                    <?php } ?>

                </div>
                <?php } ?>

                <div class="row logo-box<?php if ( dina_opt( 'logo_pos' ) == 2) {echo ' left-logo'; } if ( dina_opt( 'mobile_logo_pos' ) == 1) {echo ' mobile-right-logo'; } elseif ( dina_opt( 'mobile_logo_pos' ) == 3) { echo ' mobile-middle-logo'; if ( dina_opt( 'reverse_middle_logo_btns' ) ) echo ' mobile-reverse-btns'; } ?>">

                        <div class="<?php echo dina_opt( 'mobile_logo_pos' ) == 3 ? 'col-3' : 'col-6'; if ( dina_opt( 'mobile_user_btn_style' ) ) { echo ' mobile-text-style'; } ?> mobile-btns">
                            <?php if ( dina_opt( 'mobile_logo_pos' ) != 3) { ?>
                                <?php if ( ! dina_opt( 'ch_menu_cart' ) ) { ?>
                                    <span class="btn btn-light mmenu<?php if ( dina_opt( 'mobile_menu_text_style' ) ) { echo ' menu-btn-text-style'; } ?>" onclick="openNav()">
                                        <i aria-hidden="true" data-title="<?php _e( 'Menu', 'dina-kala' ); ?>" class="fal fa-bars"></i>
                                    </span>
                                <?php } elseif ( class_exists( 'WooCommerce' ) && ! dina_opt( 'product_catalog_mode' ) ) { ?>
                                    <?php if ( ! dina_opt( 'direct_cart_link' ) ) { ?>
                                        <span class="btn btn-light mobile-header-cart" onclick="dinaOpenCart()">
                                            <span aria-hidden="true" class="fal fa-shopping-bag">
                                                <span class="dina-cart-amount">
                                                    <?php echo dina_cart_amount() ?>
                                                </span>
                                            </span>
                                        </span>
                                    <?php } else { ?>
                                        <a class="btn btn-light mobile-header-cart" title="<?php _e( 'Shopping cart', 'dina-kala' ); ?>" href="<?php echo wc_get_cart_url() ?>">
                                            <span aria-hidden="true" class="fal fa-shopping-bag">
                                                <span class="dina-cart-amount">
                                                    <?php echo dina_cart_amount() ?>
                                                </span>
                                            </span>
                                        </a>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>

                            <?php if ( dina_opt( 'show_user_btn' ) ) { ?>
                            <?php if ( ! is_user_logged_in() ) { ?>
                                <?php
                                if ( dina_opt( 'replace_userbtns_shortcode' ) ) {
                                    echo do_shortcode( dina_opt( 'userbtns_shortcode' ) );
                                } elseif ( function_exists( 'digits_version' ) && dina_opt( 'digits_mode' ) ) {
                                    $digits_mode = ( dina_opt( 'digits_page' ) ? 'digitlink' : 'digitpopup' ); ?>
                                    <span title="<?php _e( 'Login Or Register', 'dina-kala' ); ?>" class="btn btn-light mlogin mergedbtn digitsbtn <?php echo $digits_mode; ?>">
                                        <i aria-hidden="true" data-title="<?php _e( 'Login', 'dina-kala' ); ?>" class="fal fa-user"></i>
                                        <span class="login-separator">|</span>
                                        <i aria-hidden="true" data-title="<?php _e( 'Register', 'dina-kala' ); ?>" class="fal fa-user-plus"></i>
                                    </span>
                                <?php } else { ?>
                                    <a title="<?php _e( 'Login Or Register', 'dina-kala' ); ?>" class="btn btn-light mlogin mergedbtn" <?php if ( dina_opt( 'ch_login_link' ) ) { echo 'href="'. dina_opt( 'login_link' ) .'"'; } else { echo 'href="#" onclick="openLogin()"'; } ?>>
                                        <i aria-hidden="true" data-title="<?php _e( 'Login', 'dina-kala' ); ?>" class="fal fa-user"></i>
                                        <span class="login-separator">|</span>
                                        <i aria-hidden="true" data-title="<?php _e( 'Register', 'dina-kala' ); ?>" class="fal fa-user-plus"></i>
                                    </a>
                                <?php } } else { ?>
                                <a title="<?php _e( 'User Menu', 'dina-kala' ); ?>" class="btn btn-light musermenu" onclick="openUmenu()">
                                    <i aria-hidden="true" data-title="<?php _e( 'User Menu', 'dina-kala' ); ?>" class="fal fa-user"></i>
                                </a>
                            <?php } } ?>

                        </div>

                        <div class="col-md-3 <?php echo dina_opt( 'mobile_logo_pos' ) == 3 ? 'col-6' : 'col-6'; ?> logo dina-logo">
                            <?php

                            if ( is_front_page() && dina_opt( 'add_home_heading' ) ) { echo '<h1>'; } 

                            dina_site_logo( true, ' header-logo', true );
                                
                            if ( is_front_page() && dina_opt( 'add_home_heading' ) ) { echo '</h1>'; }

                            ?>
                        </div>

                        <?php if ( dina_opt( 'mobile_logo_pos' ) == 3) { ?>
                            <div class="col-3 mobile-btns mobile-menu-btns">
                                <?php if ( ! dina_opt( 'ch_menu_cart' ) ) { ?>
                                    <span class="btn btn-light mmenu<?php if ( dina_opt( 'mobile_menu_text_style' ) ) { echo ' menu-btn-text-style'; } ?>" onclick="openNav()">
                                        <i aria-hidden="true" data-title="<?php echo dina_opt( 'mobile_menu_text' ) ?>" class="fal fa-bars"></i>
                                    </span>
                                <?php } elseif ( ! dina_opt( 'product_catalog_mode' ) ) { ?>
                                    <?php if ( ! dina_opt( 'direct_cart_link' ) ) { ?>
                                        <span class="btn btn-light mobile-header-cart" onclick="dinaOpenCart()">
                                            <span aria-hidden="true" class="fal fa-shopping-bag">
                                                <span class="dina-cart-amount">
                                                    <?php echo dina_cart_amount() ?>
                                                </span>
                                            </span>
                                        </span>
                                    <?php } else { ?>
                                        <a class="btn btn-light mobile-header-cart" title="<?php _e( 'Shopping cart', 'dina-kala' ); ?>" href="<?php echo wc_get_cart_url() ?>">
                                            <span aria-hidden="true" class="fal fa-shopping-bag">
                                                <span class="dina-cart-amount">
                                                    <?php echo dina_cart_amount() ?>
                                                </span>
                                            </span>
                                        </a>
                                    <?php } ?>
                                <?php } ?>
                        </div>
                        <?php } ?>
                        
                        <?php 
                        $search_classes   = array();
                        $search_classes[] = dina_opt( 'mobile_search' ) ? 'mobile-search-con' : '';
                        $search_classes[] = dina_opt( 'mobile_search' ) && dina_opt( 'cart_mobile_search' ) ? 'cart-mobile-search-con' : '';
                        ?>

                        <div class="<?php echo esc_attr( implode( ' ', $search_classes ) ); ?> col-md-6 search-con">
                            <?php
                            $ajax_search = dina_opt( 'ajax_search' ) ? true : false;
                            di_search_form( 'col-md-11', 'desktop-search-cat', $ajax_search );
                            ?>
                            <?php if ( dina_opt( 'mobile_search' ) && dina_opt( 'cart_mobile_search' ) ) { ?>
                                <?php if ( ! dina_opt( 'direct_cart_link' ) ) { ?>
                                    <span class="cart-mobile-search" onclick="dinaOpenCart()">
                                        <span aria-hidden="true" class="fal fa-shopping-bag ">
                                            <span class="dina-cart-amount">
                                                <?php echo dina_cart_amount() ?>
                                            </span>
                                        </span>
                                    </span>
                                <?php } else { ?>
                                    <a class="cart-mobile-search" title="<?php _e( 'Shopping cart', 'dina-kala' ); ?>" href="<?php echo wc_get_cart_url() ?>">
                                        <span aria-hidden="true" class="fal fa-shopping-bag ">
                                            <span class="dina-cart-amount">
                                                <?php echo dina_cart_amount() ?>
                                            </span>
                                        </span>
                                    </a>
                                <?php } ?>
                            <?php } ?>
                        </div>

                        <?php if ( dina_opt( 'show_user_btn' ) ) { ?>
                            <?php if ( ! is_user_logged_in() ) { ?>

                            <div class="col-md-3 user-btn">
                                <?php
                                if ( dina_opt( 'replace_userbtns_shortcode' ) ) { 
                                    echo do_shortcode( dina_opt( 'userbtns_shortcode' ) );
                                } elseif ( function_exists( 'digits_version' ) && dina_opt( 'digits_mode' ) ) { 
                                    $digits_mode = ( dina_opt( 'digits_page' ) ? 'digitlink' : 'digitpopup' );
                                    $btn_classes = dina_opt( 'user_btn_style' ) ? 'register-link digitsbtn '. $digits_mode : 'btn btn-success btn-register digitsbtn ' . $digits_mode;
                                ?>
                                    <span title="<?php _e( 'Login Or Register', 'dina-kala' ); ?>" class="<?php echo $btn_classes; ?>">
                                        <i aria-hidden="true" class="fal fa-user"></i>
                                        <?php _e( 'Login | Register', 'dina-kala' ); ?>
                                    </span>
                                <?php } else {
                                    $btn_classes = dina_opt( 'user_btn_style' ) ? 'register-link merge-btn' : 'btn btn-success btn-register merge-btn';
                                    $login_link  = dina_opt( 'ch_login_link' ) ? 'href="'. dina_opt( 'login_link' ) .'"' : 'href="#" onclick="openLogin()"';
                                ?>
                                    <a title="<?php _e( 'Login Or Register', 'dina-kala' ); ?>" <?php echo $login_link ?>
                                    class="<?php echo $btn_classes ?>">
                                        <i aria-hidden="true" class="fal fa-user"></i>
                                        <?php _e( 'Login | Register', 'dina-kala' ); ?>
                                    </a>
                                <?php } ?>
                            </div>
                            <?php } else {
                            $user = wp_get_current_user(); ?>

                            <div class="col-md-3 drop-con">
                                <div class="dropdown user-drop">
                                    <button class="dropdown-toggle user-menu" type="button">
                                    <?php if ( class_exists( 'WooCommerce' ) ) { ?>
                                        <a href="<?php echo esc_url( dina_myaccount_link() ); ?>" title="<?php _e( 'Dashboard', 'dina-kala' ); ?>">
                                    <?php } ?>
                                        <?php echo get_avatar( get_current_user_id() , 32, '', $user->display_name ); ?>
                                        <span class="user-name">
                                            <?php echo $user->display_name; ?>
                                            <?php if ( ! empty ( dina_get_wallet() ) ) {       
                                                echo '<span class="wallet"> | '. dina_get_wallet() .'</span>';
                                            } ?>
                                        </span>
                                        <span class="fal fa-chevron-down user-chevron-down" aria-hidden="true"></span>
                                    <?php if ( class_exists( 'WooCommerce' ) ) { ?>
                                        </a>
                                    <?php } ?>
                                    </button>

                                    <?php if ( dina_opt( 'replace_user_menu' ) && has_nav_menu( 'user_menu' ) ) { ?>
                                        <?php
                                            wp_nav_menu( array(
                                                'menu'              => 'user_menu',
                                                'theme_location'    => 'user_menu',
                                                'menu_class'        => 'dropdown-menu user-menu mu-menu col-12',
                                                'depth'             => 1,
                                                'container'         => ''
                                                )
                                            );
                                        ?>
                                    <?php } elseif ( class_exists( 'WooCommerce' ) ) { ?>
                                        <ul class="dropdown-menu user-menu mu-menu col-12">
                                            <?php get_template_part( 'includes/umenu' ); ?>
                                        </ul>
                                    <?php } ?>
                                </div>
                            </div>
                            
                        <?php } } ?>
                </div>
            </div>
        </div>
        <!-- Header Div -->

        <!-- Navbar -->
        <div class="dina-navbar<?php if ( dina_opt( 'fixed_head_top' ) ) {echo ' dina-sticky-nav';} ?>">
            <nav class="navbar navbar-expand-sm<?php if ( dina_opt( 'focus_nav' ) ) {echo ' focus-nav';} ?>" <?php if ( dina_opt( 'site_schema' ) ) {?>itemscope itemtype="https://schema.org/SiteNavigationElement"<?php } ?>>
                <div class="container nav-con">
                    <!-- Collect the nav links from WordPress -->
                    <div class="collapse navbar-collapse" id="bootstrap-nav-collapse">
                        <?php 
                        $args = array(
                            'theme_location' => 'mega_menu',
                            'depth'             => 4,
                            'container'         => 'div',
                            'fallback_cb'       => 'Yamm_Nav_Walker_menu_fallback',
                            'walker'            => new Yamm_Nav_Walker()
                            );

                        $args['menu_class'] = 'nav navbar-nav ';

                        $args['menu_class'] .= ( dina_opt( 'mega_style' ) == 'second' ? 'yamm-s ' : 'yamm ' );

                        $args['menu_class'] .= ( is_rtl() ? 'dina-menu-rtl ' : 'dina-menu-ltr ' );

                        $args['menu_class'] .= ( dina_opt( 'menu_hover_bottom' ) ? 'menu-hover-bottom ' : 'menu-hover-top ' );

                        if ( dina_opt( 'fixed_head_logo' ) ) {
                            $args['items_wrap'] = dina_sticky_logo();
                        }

                        wp_nav_menu( $args );
                    ?>
                    </div><!-- ./collapse -->

                    <?php if ( dina_opt( 'menu_bar_btn' ) ) { ?>
                    <a class="btn <?php echo dina_opt( 'menu_bar_btn_color' ); ?> dina-menu-bar-btn" href="<?php echo dina_opt( 'menu_bar_btn_link' ); ?>" title="<?php echo dina_opt( 'menu_bar_btn_text' ); ?>">
                        <span class="dina-menu-btn-icon <?php echo dina_opt( 'menu_bar_btn_icon' ); ?>"></span>
                        <?php echo dina_opt( 'menu_bar_btn_text' ); ?>
                    </a>
                    <?php } ?>

                    <?php do_action( 'dina_before_header_btns' ); ?>

                    <?php
                    if ( dina_opt( 'dina_dark_mode' ) && dina_opt( 'dina_dark_mode_switch' ) ) {
                    ?>
                        <div class="btn-di-toggle">
                            <i aria-hidden="true" class="di-toggle-icon fal fa-moon" data-toggle="tooltip" data-placement="top" title="<?php _e( 'Dark mode', 'dina-kala' ); ?>"></i>
                            <i aria-hidden="true" class="di-toggle-icon fal fa-sun" data-toggle="tooltip" data-placement="top" title="<?php _e( 'Light mode', 'dina-kala' ); ?>"></i>
                        </div>
                    <?php
                    }
                    ?>

                    <?php
                    if ( dina_opt( 'show_wish_list' ) ) {
                        if ( class_exists( 'WooCommerce' ) && class_exists( 'YITH_WCWL' ) ) {
                            $wcwl_url = esc_url( YITH_WCWL()->get_wishlist_url() ); ?>
                            <div class="btn-wish dina-yith-wcwl-btn">
                                <a href="<?php echo $wcwl_url; ?>" aria-label="<?php _e( 'Wishlist', 'dina-kala' ); ?>" rel="nofollow" class="wish-icon" data-toggle="tooltip" data-placement="top" title="<?php _e( 'Wishlist', 'dina-kala' ); ?>">
                                    <i aria-hidden="true" class="fal fa-heart"></i>
                                    <i class="wish-amount"><?php echo do_shortcode( '[yith_wcwl_items_count]' ); ?></i>
                                </a>
                            </div>
                        <?php 
                        }
                    } ?>

                    <?php 
                    if ( dina_opt( 'show_compare_btn' ) ) {
                    if ( class_exists( 'WooCommerce' ) && class_exists( 'YITH_Woocompare' ) ) {
                        global $yith_woocompare; ?>
                        <div class="btn-compare dina-yith-compare">
                            <a href="<?php echo $yith_woocompare->obj->view_table_url() ?>" aria-label="<?php _e( 'Compare Products', 'dina-kala' ); ?>" rel="nofollow" class="compare-icon compare-link" data-toggle="tooltip" data-placement="top" title="<?php _e( 'Compare Products', 'dina-kala' ); ?>">
                                <i aria-hidden="true" class="fal fa-random"></i>
                            </a>
                        </div>
                    <?php } elseif ( class_exists( 'WooCommerce' ) && defined( 'WCCM_VERISON' ) ) {
                    $compare_url = wccm_get_compare_page_link( wccm_get_compare_list() );
                    $compare_count = count(wccm_get_compare_list() ); ?>
                        <div class="btn-compare">
                            <a href="<?php echo $compare_url; ?>" aria-label="<?php _e( 'Compare Products', 'dina-kala' ); ?>" rel="nofollow" class="compare-icon compare-link" data-toggle="tooltip" data-placement="top" title="<?php _e( 'Compare Products', 'dina-kala' ); ?>">
                                <i aria-hidden="true" class="fal fa-random"></i>
                                <i class="compare-amount"><?php echo $compare_count; ?></i>
                            </a>
                        </div>
                    <?php } } ?>

                    <?php if ( class_exists( 'WooCommerce' ) && ! dina_opt( 'product_catalog_mode' ) && dina_opt( 'show_cart_btn' ) ) { ?>
                    <div class="btn-cart">
                        <?php if ( ! dina_opt( 'direct_cart_link' ) ) { ?>
                            <span class="shop-icon" data-toggle="tooltip" data-placement="top" title="<?php _e( 'Shopping cart', 'dina-kala' ); ?>" onclick="dinaOpenCart()">
                                <i aria-hidden="true" class="fal fa-shopping-bag"></i>
                                <i class="dina-cart-amount">
                                    <?php echo dina_cart_amount() ?>
                                </i>
                            </span>
                        <?php } else { ?>
                            <a class="shop-icon" data-toggle="tooltip" data-placement="top" title="<?php _e( 'Shopping cart', 'dina-kala' ); ?>" href="<?php echo wc_get_cart_url() ?>">
                                <i aria-hidden="true" class="fal fa-shopping-bag"></i>
                                <i class="dina-cart-amount">
                                    <?php echo dina_cart_amount() ?>
                                </i>
                            </a>
                        <?php } ?>
                    </div>
                    <?php } ?>

                    <?php do_action( 'dina_after_header_btns' ); ?>

                </div><!-- /.container -->
            </nav>
        </div>
        <!-- Navbar -->

    </header>