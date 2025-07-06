<?php
//dina_back_top_btn
function dina_nav_back_top_btn( $mftitle ) {
    
    if ( dina_check_side() == 2 ) { ?>            
        <li class="open-side" onclick="openSide()">
            <span aria-hidden="true" class="fal fa-filter f-icon" title="<?php _e( 'Show filters', 'dina-kala' ); ?>"></span>
            <?php if ( ! $mftitle ) { ?>
                <span class="mf-title"><?php _e( 'Filters', 'dina-kala' ); ?></span>
            <?php } ?>
        </li>
        <?php } elseif ( dina_check_side() == 1 ) { ?>
        <li class="open-side" onclick="openSide()">
            <span aria-hidden="true" class="fal fa-ellipsis-h f-icon" title="<?php _e( 'Show sidebar', 'dina-kala' ); ?>">
            </span>
            <?php if ( ! $mftitle ) { ?>
                <span class="mf-title"><?php _e( 'Sidebar', 'dina-kala' ); ?></span>
            <?php } ?>
        </li>
        <?php } else { ?>
            <?php if ( ! dina_opt( 'ch_back_top_btn' ) ) { ?>
                <li class="return-top">
                    <span aria-hidden="true" class="fal fa-chevron-up f-icon" title="<?php _e( 'Return Top', 'dina-kala' ); ?>">
                    </span>
                    <?php if ( ! $mftitle ) { ?>
                        <span class="mf-title"><?php _e( 'Return', 'dina-kala' ); ?></span>
                    <?php } ?>
                </li>
            <?php } else { ?>
                <li>
                    <a href="<?php echo dina_opt( 'back_top_btn_link' ); ?>" title="<?php echo dina_opt( 'back_top_btn_title' ); ?>">
                        <span aria-hidden="true" class="f-icon <?php echo dina_opt( 'back_top_btn_icon' ); ?>" title="<?php echo dina_opt( 'back_top_btn_title' ); ?>">
                        </span>
                        <?php if ( ! $mftitle ) { ?>
                            <span class="mf-title"><?php echo dina_opt( 'back_top_btn_title' ); ?></span>
                        <?php } ?>
                    </a>
                </li>
            <?php } 
        }
}

//dina_nav_wishlist_btn
function dina_nav_wishlist_btn( $mftitle ) {
    
    if ( ! dina_opt( 'ch_whish_btn' ) ) { 
        
        if ( dina_opt( 'show_wish_list' ) ) { 
            if ( class_exists( 'WooCommerce' ) && class_exists( 'YITH_WCWL' ) ) {
                $wcwl_url = esc_url( YITH_WCWL()->get_wishlist_url() ); ?>
                <li>
                    <a href="<?php echo $wcwl_url; ?>" title="<?php _e( 'Wishlist', 'dina-kala' ); ?>" rel="nofollow">
                        <span aria-hidden="true" class="fal fa-heart f-icon" title="<?php _e( 'Wishlist', 'dina-kala' ); ?>">
                            <span class="wish-amount">
                                <?php echo do_shortcode( '[yith_wcwl_items_count]' ); ?>
                            </span>
                        </span>
                        <?php if ( !$mftitle ) { ?>
                            <span class="mf-title"><?php _e( 'Wishlist ', 'dina-kala' ); ?></span>
                        <?php } ?>
                    </a>
                </li>
        <?php 
            } 
        } ?>
    <?php } else { ?>
        <li>
            <a href="<?php echo dina_opt( 'whish_btn_link' ); ?>" title="<?php echo dina_opt( 'whish_btn_title' ); ?>">
                <span aria-hidden="true" class="f-icon <?php echo dina_opt( 'whish_btn_icon' ); ?>" title="<?php echo dina_opt( 'whish_btn_title' ); ?>">
                </span>
                <?php if ( !$mftitle ) { ?>
                    <span class="mf-title"><?php echo dina_opt( 'whish_btn_title' ); ?></span>
                <?php } ?>
            </a>
        </li>
    <?php }
}

//dina_nav_home_buy_btn
function dina_nav_home_buy_btn( $mftitle ) {
    
    if ( is_singular( 'product' ) && ! dina_opt( 'mobile_sticky_add' ) ) { ?>
        <li class="go-to-add">
            <span aria-hidden="true" class="fal fa-cart-plus f-icon" title="<?php _e( 'Add to cart', 'dina-kala' ); ?>">
            </span>
            <?php if ( !$mftitle) { ?>
                <span class="mf-title"><?php _e( 'Buy', 'dina-kala' ); ?></span>
            <?php } ?>
        </li>
        <?php } else { ?>
        <li>
            <a href="<?php echo esc_url( home_url() ); ?>" title="<?php bloginfo( 'name' ); ?> | <?php bloginfo( 'description' ); ?>">
                <span aria-hidden="true" class="fal fa-home f-icon" title="<?php _e( 'Home', 'dina-kala' ); ?>">
                </span>
                <?php if ( !$mftitle) { ?>
                    <span class="mf-title"><?php _e( 'Home', 'dina-kala' ); ?></span>
                <?php } ?>
            </a>
        </li>
        <?php }
}

//dina_nav_compare_btn
function dina_nav_compare_btn( $mftitle ) {
    
    if ( ! dina_opt( 'ch_compare_btn' ) ) { ?>
        <?php 
        if ( class_exists( 'WooCommerce' ) && class_exists( 'YITH_Woocompare' ) ) {
            global $yith_woocompare; ?>
        <li class="dina-yith-compare">
            <a href="<?php echo $yith_woocompare->obj->view_table_url() ?>" class="compare-link" rel="nofollow" title="<?php _e( 'Compare ', 'dina-kala' ); ?>">
                <span aria-hidden="true" class="fal fa-random f-icon">
                </span>
                <?php if ( !$mftitle ) { ?>
                    <span class="mf-title"><?php _e( 'Compare ', 'dina-kala' ); ?></span>
                <?php } ?>
            </a>
        </li>
        <?php } elseif ( class_exists( 'WooCommerce' ) && defined( 'WCCM_VERISON' ) ) {
        $compare_url = wccm_get_compare_page_link( wccm_get_compare_list() );
        $compare_count = count(wccm_get_compare_list() ); ?>
        <li>
            <a href="<?php echo $compare_url; ?>" class="compare-link" rel="nofollow" title="<?php _e( 'Compare ', 'dina-kala' ); ?>">
                <span aria-hidden="true" class="fal fa-random f-icon">
                    <span class="compare-amount"><?php echo $compare_count; ?></span>
                </span>
                <?php if ( !$mftitle ) { ?>
                    <span class="mf-title"><?php _e( 'Compare ', 'dina-kala' ); ?></span>
                <?php } ?>
            </a>
        </li>
        <?php } ?>
    <?php } else { ?>
        <li>
            <a href="<?php echo dina_opt( 'compare_btn_link' ); ?>" title="<?php echo dina_opt( 'compare_btn_title' ); ?>">
                <span aria-hidden="true" class="f-icon <?php echo dina_opt( 'compare_btn_icon' ); ?>"></span>
                <?php if ( !$mftitle ) { ?>
                    <span class="mf-title"><?php echo dina_opt( 'compare_btn_title' ); ?></span>
                <?php } ?>
            </a>
        </li>
    <?php }
}

//dina_nav_cart_btn
function dina_nav_cart_btn( $mftitle ) {
    
    if ( ! class_exists( 'WooCommerce' ) || dina_opt( 'product_catalog_mode' ) ) 
        return;
    ?>
        <?php if ( ! dina_opt( 'direct_cart_link' ) ) { ?>
            <li onclick="dinaOpenCart()">
                <span aria-hidden="true" class="fal fa-shopping-bag f-icon" title="<?php _e( 'Shopping Cart', 'dina-kala' ); ?>">
                    <span class="dina-cart-amount">
                        <?php echo dina_cart_amount() ?></span>
                    </span>
                <?php if ( ! $mftitle ) { ?>
                    <span class="mf-title"><?php _e( 'Cart', 'dina-kala' ); ?></span>
                <?php } ?>
            </li>
        <?php } else { ?>
            <li>
                <a href="<?php echo wc_get_cart_url() ?>" title="<?php _e( 'Shopping Cart', 'dina-kala' ); ?>">
                    <span aria-hidden="true" class="fal fa-shopping-bag f-icon">
                        <span class="dina-cart-amount">
                            <?php echo dina_cart_amount() ?></span>
                        </span>
                    <?php if ( ! $mftitle ) { ?>
                        <span class="mf-title"><?php _e( 'Cart', 'dina-kala' ); ?></span>
                    <?php } ?>
                </a>
            </li>
        <?php } ?>
    <?php
}

//dina_nav_menu_btn
function dina_nav_menu_btn( $mftitle ) {
    ?>
        <li onclick="openNav()">
            <span aria-hidden="true" class="fal fa-bars f-icon" title="<?php _e( 'Menu', 'dina-kala' ); ?>">
            </span>
            <?php if ( ! $mftitle ) { ?>
            <span class="mf-title"><?php _e( 'Menu', 'dina-kala' ); ?></span>
            <?php } ?>
        </li>
    <?php
}

//dina_nav_menu_btn
function dina_nav_dark_mode( $mftitle ) {
    if ( dina_opt( 'dina_dark_mode' ) ) {
    ?>
        <li class="btn-di-toggle di-toggle-mobile">
            <span aria-hidden="true" class="di-toggle-icon fal fa-moon f-icon" title="<?php _e( 'Dark mode', 'dina-kala' ); ?>"></span>
            <span aria-hidden="true" class="di-toggle-icon fal fa-sun f-icon" title="<?php _e( 'Light mode', 'dina-kala' ); ?>"></span>
            <?php if ( ! $mftitle ) { ?>
            <span class="mf-title"><?php _e( 'Dark mode', 'dina-kala' ); ?></span>
            <?php } ?>
        </li>
    <?php
    }
}

//dina_nav_my_account_btn
function dina_nav_my_account_btn( $mftitle ) {
    if ( ! is_user_logged_in() ) {
        if (function_exists( 'digits_version' ) && dina_opt( 'digits_mode' ) ) {
            $digits_mode = ( dina_opt( 'digits_page' ) ? 'digitlink' : 'digitpopup' ); ?>
            <li class="digitsbtn <?php echo $digits_mode; ?>">
                <span aria-hidden="true" class="fal fa-user f-icon" title="<?php _e( 'My Account', 'dina-kala' ); ?>"></span>
                <?php if ( ! $mftitle ) { ?>
                <span class="mf-title"><?php _e( 'My Account', 'dina-kala' ); ?></span>
                <?php } ?>
            </li>
        <?php } else { ?>
            <li>
                <a title="<?php _e( 'My Account', 'dina-kala' ); ?>" <?php if ( dina_opt( 'ch_login_link' ) ) { echo 'href="'. dina_opt( 'login_link' ) .'"'; } else { echo 'rel="nofollow" href="#" onclick="openLogin()"'; } ?>>
                    <span aria-hidden="true" class="fal fa-user f-icon" title="<?php _e( 'My Account', 'dina-kala' ); ?>"></span>
                    <?php if ( ! $mftitle ) { ?>
                    <span class="mf-title"><?php _e( 'My Account', 'dina-kala' ); ?></span>
                    <?php } ?>
                </a>
            </li>
        <?php } ?>
    <?php } else { ?>
        <li onclick="openUmenu()">
            <span aria-hidden="true" class="fal fa-user f-icon" title="<?php _e( 'User Menu', 'dina-kala' ); ?>"></span>
            <?php if ( ! $mftitle ) { ?>
            <span class="mf-title"><?php _e( 'User Menu', 'dina-kala' ); ?></span>
            <?php } ?>
        </li>
    <?php }
}

//dina_back_top_btn
function dina_nav_custom_btn_one( $mftitle ) {
     ?>
    <li>
        <a href="<?php echo dina_opt( 'mobile_nav_btn_one_link' ); ?>" title="<?php echo dina_opt( 'mobile_nav_btn_one_title' ); ?>">
            <span aria-hidden="true" class="f-icon <?php echo dina_opt( 'mobile_nav_btn_one_icon' ); ?>" title="<?php echo dina_opt( 'mobile_nav_btn_one_title' ); ?>">
            </span>
            <?php if ( ! $mftitle ) { ?>
                <span class="mf-title"><?php echo dina_opt( 'mobile_nav_btn_one_title' ); ?></span>
            <?php } ?>
        </a>
    </li>
    <?php
}

//dina_nav_custom_btn_two
function dina_nav_custom_btn_two( $mftitle ) {
     ?>
    <li>
        <a href="<?php echo dina_opt( 'mobile_nav_btn_two_link' ); ?>" title="<?php echo dina_opt( 'mobile_nav_btn_two_title' ); ?>">
            <span aria-hidden="true" class="f-icon <?php echo dina_opt( 'mobile_nav_btn_two_icon' ); ?>" title="<?php echo dina_opt( 'mobile_nav_btn_two_title' ); ?>">
            </span>
            <?php if ( ! $mftitle ) { ?>
                <span class="mf-title"><?php echo dina_opt( 'mobile_nav_btn_two_title' ); ?></span>
            <?php } ?>
        </a>
    </li>
    <?php
}