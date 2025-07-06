<?php
/*
Theme Designed By: Meysam Hosseinkhani
Email: Meysam98@Gmail.com
Author Website: i-design.ir
*/
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
    exit;

if ( ! is_user_logged_in() ) {
    $login_url = dina_login_url();
    wp_redirect( $login_url );
    exit;
}

wp_enqueue_style( 'dina-user-panel' );
add_filter( 'body_class', 'dina_myaccount_body_class' );

dina_get_user_panel_header();

$container_class = dina_opt( 'user_panel_style' ) == 'upanel-one' ? 'container-fluid dina-userpanel-style-one main-con woocommerce-account' : 'container dina-userpanel-style-two main-con woocommerce-account';

if ( have_posts() ) :
?>

    <div class="<?php echo $container_class ?>">
        <?php if ( dina_opt( 'show_bread' ) && dina_opt( 'user_panel_style' ) != 'upanel-one'  ) { dina_breadcrumb(); } ?>
        <div class="row">
            <article role="main" class="col-12">
                <?php
                while ( have_posts() ) : the_post();
                if ( affwp_is_affiliate() )
                the_content();
                endwhile;
                ?>
            </article>
        </div>
    </div>

<?php 

endif;

dina_get_user_panel_footer();