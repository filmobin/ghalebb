<?php  ?>

<!-- Footer Area -->
<?php if ( dina_opt( 'show_info_bar' ) || dina_opt( 'show_footer_text' ) || dina_opt( 'show_addr' ) || is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) || is_active_sidebar( 'footer-4' ) ) : ?>
<footer class="container-fluid sfooter<?php if ( dina_opt( 'hide_footer' ) ) { echo ' hide-footer-m'; } ?>">
    <div class="container<?php if ( dina_opt( 'return_top_style_two' ) ) { echo ' return-top-two-con'; } ?>">

        <?php 
            if ( dina_opt( 'return_top_style_two' ) ) { ?>
                <div class="return-top return-top-two">
                    <?php _e( 'Back to top', 'dina-kala' ); ?>
                    <i class="fal fa-chevron-up" aria-hidden="true"></i>
                </div>
        <?php 
            }
        ?>

        <?php
        if ( dina_opt( 'footer_text_pos' ) == 'footer-text-beginning' )
            dina_footer_text( 'footer-text-beginning' );
        ?>

            <?php
            if ( dina_opt( 'show_info_bar' ) ) { ?>
                <div class="row info-bar">

                    <?php if ( dina_opt( 'info_bar_prods' ) ) { ?>
                    <div class="dina-info-icon col">
                        <?php 
                        $count_prods = wp_count_posts( 'product' );
                        $icon = class_exists( 'WooCommerce' ) && ! dina_opt( 'edit_bar_prods' ) ? 'fal fa-shopping-bag' : dina_opt( 'bar_prods_icon' );
                        $value = class_exists( 'WooCommerce' ) && ! dina_opt( 'edit_bar_prods' ) ? $count_prods->publish . '+' : do_shortcode( dina_opt( 'bar_prods_value' ) );
                        $title = class_exists( 'WooCommerce' ) && ! dina_opt( 'edit_bar_prods' ) ? __( 'Products', 'dina-kala' ) : dina_opt( 'bar_prods_title' );
                        ?>
                        <i class="<?php echo $icon; ?>" aria-hidden="true"></i>
                        <span class="count-num"><?php echo $value; ?></span>
                        <span class="count-text"><?php echo $title; ?></span>
                    </div>
                    <?php } ?>

                    <?php if ( dina_opt( 'info_bar_sales' ) ) { ?>
                    <div class="dina-info-icon col">
                        <?php
                        $icon = class_exists( 'WooCommerce' ) && ! dina_opt( 'edit_bar_sales' ) ? 'fal fa-box-check' : dina_opt( 'bar_sales_icon' );
                        $value = class_exists( 'WooCommerce' ) && ! dina_opt( 'edit_bar_sales' ) ? di_woo_get_total_sales() . '+' : do_shortcode( dina_opt( 'bar_sales_value' ) );
                        $title = class_exists( 'WooCommerce' ) && ! dina_opt( 'edit_bar_sales' ) ? __( 'Order completed', 'dina-kala' ) : dina_opt( 'bar_sales_title' );
                        ?>
                        <i class="<?php echo $icon; ?>" aria-hidden="true"></i>
                        <span class="count-num"><?php echo $value; ?></span>
                        <span class="count-text"><?php echo $title; ?></span>
                    </div>
                    <?php } ?>

                    <?php if ( dina_opt( 'info_bar_users' ) ) { ?>
                    <div class="dina-info-icon col">
                        <?php 
                        $usercount = count_users();
                        $icon = ! dina_opt( 'edit_bar_users' ) ? 'fal fa-users' : dina_opt( 'bar_users_icon' );
                        $value = ! dina_opt( 'edit_bar_users' ) ? $usercount['total_users'] . '+' : do_shortcode( dina_opt( 'bar_users_value' ) );
                        $title = ! dina_opt( 'edit_bar_users' ) ? __( 'Members', 'dina-kala' ) : dina_opt( 'bar_users_title' );
                        ?>
                        <?php $result = $usercount['total_users']; ?>
                        <i class="<?php echo $icon; ?>" aria-hidden="true"></i>
                        <span class="count-num"><?php echo $value; ?></span>
                        <span class="count-text"><?php echo $title; ?></span>
                    </div>
                    <?php } ?>

                    <?php if ( dina_opt( 'info_bar_posts' ) ) { ?>
                    <div class="dina-info-icon col">
                        <?php 
                        $count_posts = wp_count_posts( 'post' );
                        $icon = ! dina_opt( 'edit_bar_posts' ) ? 'fal fa-file-alt' : dina_opt( 'bar_posts_icon' );
                        $value = ! dina_opt( 'edit_bar_posts' ) ? $count_posts->publish . '+' : do_shortcode( dina_opt( 'bar_posts_value' ) );
                        $title = ! dina_opt( 'edit_bar_posts' ) ? __( 'Blog content', 'dina-kala' ) : dina_opt( 'bar_posts_title' );
                        ?>
                        <i class="<?php echo $icon; ?>" aria-hidden="true"></i>
                        <span class="count-num"><?php echo $value; ?></span>
                        <span class="count-text"><?php echo $title; ?></span>
                    </div>
                    <?php } ?>

                    <?php if ( dina_opt( 'active_bar_info5' ) ) { ?>
                    <div class="dina-info-icon col">
                        <?php 
                        $icon = dina_opt( 'bar_info5_icon' );
                        $value = do_shortcode( dina_opt( 'bar_info5_value' ) );
                        $title = dina_opt( 'bar_info5_title' );
                        ?>
                        <i class="<?php echo $icon; ?>" aria-hidden="true"></i>
                        <span class="count-num"><?php echo $value; ?></span>
                        <span class="count-text"><?php echo $title; ?></span>
                    </div>
                    <?php } ?>

                    <?php if ( dina_opt( 'active_bar_info6' ) ) { ?>
                    <div class="dina-info-icon col">
                        <?php 
                        $icon = dina_opt( 'bar_info6_icon' );
                        $value = do_shortcode( dina_opt( 'bar_info6_value' ) );
                        $title = dina_opt( 'bar_info6_title' );
                        ?>
                        <i class="<?php echo $icon; ?>" aria-hidden="true"></i>
                        <span class="count-num"><?php echo $value; ?></span>
                        <span class="count-text"><?php echo $title; ?></span>
                    </div>
                    <?php } ?>

                </div>
        <?php } ?>

        <?php
        if ( dina_opt( 'footer_text_pos' ) == 'footer-text-site-info' )
            dina_footer_text( 'footer-text-site-info' );
        ?>

        <?php if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) || is_active_sidebar( 'footer-4' ) ) {
            $fwidget_class = dina_opt( 'hide_footer_widgets' ) ? 'row fwidgets mobile-hidden' : 'row fwidgets';
        ?>
        <div class="<?php echo $fwidget_class ?>">
            <?php
            $footer_widgets = (int)dina_opt( 'footer_widgets' );
            $col            = ( $footer_widgets > 3 ? 3 : 4 );
            $col_mobile     = (int)dina_opt( 'footer_widgets_mobile' ) == 1 ? 'col-12' : 'col-6';
            for ( $x = 1; $x <= $footer_widgets; $x++ ) {
            echo '<div class="col-lg-'. $col .' col-md-6 '. $col_mobile .' fwidget fwidget-'. $x .'">';
            if ( is_active_sidebar( 'footer-'. $x ) ) {
                dynamic_sidebar( 'footer-'. $x );
            }
            echo '</div>';
            }
            ?>
        </div>
        <?php } ?>

        <?php
        if ( dina_opt( 'footer_text_pos' ) == 'footer-text-widgets' )
            dina_footer_text( 'footer-text-widgets' );
        ?>

        <?php if ( dina_opt( 'show_addr' ) ) { ?>
        <?php $contact_nofollow = ( dina_opt( 'contact_link_nofollow' ) ? ' rel="nofollow"' : '' ); ?>
        <div class="row footer-addr">
            <div class="<?php echo dina_opt( 'show_apps' ) ? 'col-md-9 col-12' : 'col-12 no-apps-icon'; ?> addr-con">
                <?php if ( ( dina_opt( 'addr_text' ) != '' ) && ( dina_opt( 'show_faddr' ) ) ) { ?>
                <div class="addr-text col-md-7 col-12"><i class="fal fa-map-marker-alt" aria-hidden="true"></i>
                    <?php echo dina_opt( 'addr_text' ); ?>
                </div>
                <?php } ?>
                <div class="ftel col-md-5 col-12">
                    
                    <?php if ( ( dina_opt( 'site_tel' ) != '' ) && ( dina_opt( 'show_ftel' ) ) ) { ?>
                        <?php if ( dina_opt( 'site_ftel_link' ) ) {
                            $ftel_link = dina_opt( 'custom_ftel_link' ) ? dina_opt( 'custom_ftel_link_addr' ) : 'tel:' . dina_remove_dash( dina_opt( 'site_tel' ) ); ?>
                        <a href="<?php echo $ftel_link; ?>" target="_blank"<?php echo $contact_nofollow; ?>>
                        <?php } ?>
                            <span class="foot-tel">
                                <i class="fal fa-phone" aria-hidden="true"></i>
                                <span class="top-val" id="site-tel"><?php  echo dina_opt( 'site_tel' ); ?></span>
                            </span>
                        <?php if ( dina_opt( 'site_ftel_link' ) ) { ?>
                        </a>
                        <?php } ?>
                    <?php } ?>

                    <?php if ( dina_opt( 'replace_email' ) ) { ?>
                        <?php if ( ( dina_opt( 'site_tel2' ) != '' ) && ( dina_opt( 'show_ftel' ) ) ) { ?>
                            <?php if ( dina_opt( 'site_ftel_link' ) ) {
                                $fmail_link = dina_opt( 'custom_fmail_link' ) ? dina_opt( 'custom_fmail_link_addr' ) : 'tel:' . dina_remove_dash( dina_opt( 'site_tel2' ) ); ?>
                            <a href="<?php echo $fmail_link; ?>" target="_blank"<?php echo $contact_nofollow; ?>>
                            <?php } ?>
                                <span class="foot-tel">
                                    <i class="fal fa-phone-rotary" aria-hidden="true"></i>
                                    <span class="top-val" id="site-tel2"><?php  echo dina_opt( 'site_tel2' ); ?></span>
                                </span>
                            <?php if ( dina_opt( 'site_ftel_link' ) ) { ?>
                            </a>
                            <?php } ?>
                        <?php } ?>
                    <?php } else { ?>
                        <?php if ( ( dina_opt( 'site_email' ) != '' ) && ( dina_opt( 'show_fmail' ) ) ) { ?>
                            <?php if ( dina_opt( 'site_fmail_link' ) ) {
                                $fmail_link = dina_opt( 'custom_fmail_link' ) ? dina_opt( 'custom_fmail_link_addr' ) : 'mailto:' . dina_opt( 'site_email' );
                            ?>
                            <a href="<?php echo $fmail_link ; ?>" target="_blank"<?php echo $contact_nofollow; ?>>
                            <?php } ?>
                                <span class="foot-tel">
                                    <i class="fal fa-envelope" aria-hidden="true"></i>
                                    <span class="top-val" id="site-email"><?php echo dina_opt( 'site_email' ); ?></span>
                                </span>
                            <?php if ( dina_opt( 'site_fmail_link' ) ) { ?>
                            </a>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                    
                </div>
            </div>

            <?php if ( dina_opt( 'show_apps' ) ) { ?>
            <div class="col-md-3 col-12 apps-icon">
                <?php if ( dina_opt( 'and_link' ) != '' ) { ?>
                <a href="<?php echo dina_opt( 'and_link' ); ?>" rel="nofollow" class="btn <?php echo dina_opt( 'apps_btn_style' ); ?>-success and-btn"><i class="fab fa-android" aria-hidden="true"></i><?php _e( ' Android' , 'dina-kala' ); ?></a>
                <?php } ?>
                <?php if ( dina_opt( 'ios_link' ) != '' ) { ?>
                <a href="<?php echo dina_opt( 'ios_link' ); ?>" rel="nofollow" class="btn <?php echo dina_opt( 'apps_btn_style' ); ?>-secondary ios-btn"><i class="fab fa-apple" aria-hidden="true"></i> <?php _e( ' IOS' , 'dina-kala' ); ?></a>
                <?php } ?>
            </div>
            <?php } ?>
            
        </div>
        <?php } ?>

        <?php
        if ( dina_opt( 'footer_text_pos' ) == 'footer-text-end' )
            dina_footer_text( 'footer-text-end' );
        ?>

    </div>
</footer>
<?php endif; ?>
<!-- Footer Area -->

<!-- Copyright area -->
<div class="container-fluid copyright<?php if ( dina_opt( 'hide_copy' ) ) { echo ' hide-copy-m'; } ?>">
    <div class="container">
        <div class="row">
        <div class="col-md-6 col-12 copy-text">
            <?php echo dina_opt( 'copy_text' ); ?>
        </div>
        <?php if ( dina_opt( 'show_footer_social' ) ) { ?>
        <?php $social_nofollow = ( dina_opt( 'nofollow_social_link' ) ? ' rel="nofollow"' : '' ); ?>
        <div class="col-md-6 col-12 social-footer">
            <?php
            $classes = dina_opt( 'footer_social_circle' ) ? 'footer-social-circle' : 'footer-social-square';
            dina_social_links( $classes, false ) ?>
        </div>
        <?php } ?>
        </div>
    </div>
</div>
<!-- Copyright area -->