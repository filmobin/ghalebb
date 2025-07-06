<?php
/*
Theme Designed By: Meysam Hosseinkhani
Email: Meysam98@Gmail.com
Author Website: i-design.ir
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
    exit;

wp_enqueue_style( 'dina-user-panel' );
add_filter( 'body_class', 'dina_myaccount_body_class' );

if ( ! is_user_logged_in() ) {

    if ( dina_opt( 'woo_login_template' ) ) {

        remove_action( 'dina_footer', 'dina_footer_codes' );
        remove_action( 'wp_footer', 'dina_js_gallery_codes' );
        remove_action( 'wp_footer', 'dina_auto_update_cart' );
        remove_action( 'wp_footer', 'dina_sticky_add_to_cart' );
        remove_action( 'wp_footer', 'dina_add_btn_modal' );
        remove_action( 'wp_footer', 'dina_site_popup' );
        remove_action( 'wp_footer', 'dina_side_panels' );
        ?>
        <!DOCTYPE html>
        <html <?php language_attributes(); ?>>
            <head>
                <link rel="shortcut icon" href="<?php echo dina_to_https( dina_opt( 'site_favicon', 'url' ) ); ?>" type="image/x-icon" />
                <link rel="apple-touch-icon" href="<?php echo dina_to_https( dina_opt( 'site_favicon', 'url' ) ); ?>">
                <meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <meta http-equiv="X-UA-Compatible" content="ie=edge">
                <?php if ( ! dina_opt( 'dis_mobile_color' ) ) { ?>
                <meta name="theme-color" content="<?php echo ( dina_opt( 'ch_mobile_color' ) ? dina_opt( 'mobile_bar_color' ) : dina_opt( 'custom_color' ) ); ?>" />
                <?php } ?>
                <meta name="fontiran.com:license" content="B3L8B">
                <?php if (is_singular() ) wp_enqueue_script( 'comment-reply' ) ?>
                <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
                <?php wp_head(); ?>
            </head>
            <body <?php body_class(); ?> <?php if ( dina_opt( 'site_schema' ) ) {?>itemscope itemtype="https://schema.org/WebPage"<?php } ?>>
                <div class="dina-login-page">

                    <?php
                    $box_class  = 'shadow-box dina-login-form-wrapper';
                    $box_class .= dina_opt( 'login_box_blur' ) ? ' dina-login-blur' : '';
                    $box_class .= dina_opt( 'login_box_blur_dark' ) ? ' dina-login-blur-dark' : '';
                    ?>

                    <div class       = "<?= $box_class ?>">
                        <?php if ( dina_opt( 'dina_dark_mode' ) && dina_opt( 'dina_dark_mode_switch' ) ) { ?>
                            <div class="btn-di-toggle">
                                <i aria-hidden="true" class="di-toggle-icon fal fa-moon" data-toggle="tooltip" data-placement="top" title="<?php _e( 'Dark mode', 'dina-kala' ); ?>"></i>
                                <i aria-hidden="true" class="di-toggle-icon fal fa-sun" data-toggle="tooltip" data-placement="top" title="<?php _e( 'Light mode', 'dina-kala' ); ?>"></i>
                            </div>
                        <?php } ?>
                        <?php dina_login_logo( true, ' dina-login-logo', true ) ?>
                        <h1> <?php _e( 'Login | Register', 'dina-kala') ?></h1>
                        <?php the_content() ?>
                    </div>
                    <div class="dina-return-home">
                        <?php
                        $return_link = sprintf(
                            '<a href="%s"><i class="fal fa-chevron-right" aria-hidden="true"></i>%s</a>',
                            esc_url( home_url( '/' ) ),
                            sprintf(
                                _x( 'Go to %s', 'site', 'dina-kala' ),
                                get_bloginfo( 'title', 'display' )
                            )
                        );
                        echo $return_link;
                        ?>
                    </div>
                </div>

                <?php
                if ( function_exists( 'dina_footer' ) )
                    dina_footer();
                else
                    do_action( 'dina_footer' );

                wp_footer();
                ?>
            </body>
        </html>
    <?php
    } else {
        get_header();

        //dina_detect_user_panel_link
        add_action( 'wp_footer', 'dina_detect_user_panel_link', 100 );
        function dina_detect_user_panel_link() {
            ?>
            <script>
                jQuery(document).ready(function ( $) {
                    var loc = window.location.href;
                    $(".woocommerce-MyAccount-navigation ul a").each(function() {
                        if (loc.indexOf( $(this).attr("href")) != -1) {
                            $(".woocommerce-MyAccount-navigation ul li").removeClass("is-active");
                            $(this).closest("li").addClass("is-active");
                        }
                    });
                });
            </script>
            <?php
        }
        ?>

        <div class="container main-con">
        <?php if ( dina_opt( 'show_bread' ) ) { dina_breadcrumb(); } ?>
        <div class="row">
        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
            <article role="main" class="col-12">
                <div class="shadow-box page-con">
                    <h1 class="ptitle"></i>
                        <?php the_title(); ?>
                    </h1>
                    <?php the_content(); ?>
                </div>
            </article>
            <?php 
            endwhile;
        endif;
        ?>
        </div>
        </div>
        <?php
        get_footer();

    }

} else {

    dina_get_user_panel_header();

    //dina_detect_user_panel_link
    add_action( 'wp_footer', 'dina_detect_user_panel_link', 100 );
    function dina_detect_user_panel_link() {
        ?>
        <script>
            jQuery(document).ready(function ( $) {
                var loc = window.location.href;
                $(".woocommerce-MyAccount-navigation ul a").each(function() {
                    if (loc.indexOf( $(this).attr("href")) != -1) {
                        $(".woocommerce-MyAccount-navigation ul li").removeClass("is-active");
                        $(this).closest("li").addClass("is-active");
                    }
                });
            });
        </script>
        <?php
    }
    
    $container_class = dina_opt( 'user_panel_style' ) == 'upanel-one' ? 'container-fluid dina-userpanel-style-one main-con' : 'container dina-userpanel-style-two main-con';
    ?>
    <div class="<?php echo $container_class ?>">
        <?php if ( dina_opt( 'show_bread' ) && dina_opt( 'user_panel_style' ) != 'upanel-one'  ) { dina_breadcrumb(); } ?>
        <div class="row">
            <?php if ( have_posts() ) : ?>
                <article role="main" class="col-12">
                    <?php while ( have_posts() ) : the_post(); ?>
                    <?php the_content(); ?>
                    <?php endwhile; ?>
                </article>
            <?php endif; ?>
        </div>
    </div>
    <?php
    dina_get_user_panel_footer();
}

