<?php
/*
Theme Designed By: Meysam Hosseinkhani
Email: Meysam98@Gmail.com
Author Website: i-design.ir
*/
/*
 * Template Name: User Panel (DinaKala)
*/
// Exit if accessed directly
__( 'User Panel (DinaKala)', 'dina-kala' );

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
        <article role="main" class="col-12">
            <div class="woocommerce">
                
                <?php
                if ( class_exists( 'WooCommerce' ) ) 
                require_once WP_PLUGIN_DIR .'/woocommerce/templates/myaccount/navigation.php';
                ?>

                <?php if ( have_posts() ) : while ( have_posts() ) : the_post();
                do_action( 'dina_before_myaccount_content' );
                ?>
                <div class="woocommerce-MyAccount-content">   
                <?php the_content(); ?>
                </div>
                <?php do_action( 'dina_after_myaccount_content' ); ?>
                <?php endwhile; endif; ?>

            </div>
        </article>
    </div>
</div>

<?php dina_get_user_panel_footer(); ?>