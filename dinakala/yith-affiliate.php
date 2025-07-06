<?php
/*
Theme Designed By: Meysam Hosseinkhani
Email: Meysam98@Gmail.com
Author Website: i-design.ir
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
    exit;

$user_is_affiliate = defined( 'YITH_WCAF_PREMIUM' ) ? YITH_WCAF_Affiliate_Handler()->is_user_affiliate() : YITH_WCAF_Affiliates()->is_user_affiliate();

if ( ! is_user_logged_in()  ) {
    $login_url = dina_login_url();
    wp_redirect( $login_url );
    exit;
}

wp_enqueue_style( 'dina-user-panel' );
add_filter( 'body_class', 'dina_myaccount_body_class' );

dina_get_user_panel_header();

$container_class = dina_opt( 'user_panel_style' ) == 'upanel-one' ? 'container-fluid dina-userpanel-style-one woocommerce-account dina-yith-affiliate main-con' : 'container dina-userpanel-style-two woocommerce-account dina-yith-affiliate main-con';
?>

<div class="<?php echo $container_class ?>">
<?php if ( dina_opt( 'show_bread' ) && dina_opt( 'user_panel_style' ) != 'upanel-one'  ) { dina_breadcrumb(); } ?>
    <div class="row">
    <?php if ( have_posts() ) : ?>
        <article role="main" class="col-12">
        <?php while ( have_posts() ) : the_post(); ?>
            <?php dina_before_account_navigation(); ?>
            <?php
            if ( defined( 'YITH_WCAF_PREMIUM' ) ) { ?>

            <?php
            $atts = array(
                'show_right_column'    => true,
                'show_left_column'     => true,
                'show_dashboard_links' => true,
                'dashboard_links'      => yith_wcaf_get_dashboard_navigation_menu(),
            );
            ?>
            <div id="dinaAccountNav" class="yith-wcaf-dashboard-navigation-con">
            <?php
	            yith_wcaf_get_template( 'navigation-menu.php', $atts, 'shortcodes' );
            ?>
            </div>

            <?php } else { ?>

            <?php
            $atts = array(
                'show_right_column'    => true,
                'show_left_column'     => true,
                'show_dashboard_links' => true,
            );
            ?>
            <div id="dinaAccountNav" class="yith-wcaf-dashboard-navigation-con">
            <?php
	            yith_wcaf_get_template( 'dashboard-navigation.php', $atts, 'shortcodes' );
            ?>
            </div>

            <?php } ?>
            
            <?php dina_after_account_navigation(); ?>

            <?php do_action( 'dina_before_myaccount_content' ); ?>

            <div class="woocommerce-MyAccount-content">
                <?php the_content(); ?>
            </div>

            <?php do_action( 'dina_after_myaccount_content' );
        endwhile; ?>
        </article>
    <?php 
        endif;
    ?>
    </div>
</div>
<?php    
dina_get_user_panel_footer();