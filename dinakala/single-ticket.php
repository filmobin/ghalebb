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

get_header(); 
?>

<div class="container woocommerce-account main-con">
<?php if ( dina_opt( 'show_bread' ) ) { dina_breadcrumb(); } ?>
<div class="row">
<article role="main" class="col-12">
    <div class="woocommerce">
<?php

if ( class_exists( 'WooCommerce' ) )
    require_once WP_PLUGIN_DIR .'/woocommerce/templates/myaccount/navigation.php';	

if ( have_posts() ) : while ( have_posts() ) : the_post();
do_action( 'dina_before_myaccount_content' );
?>
<div class="woocommerce-MyAccount-content">   
    <?php the_content(); ?>
</div>
<?php
do_action( 'dina_after_myaccount_content' );
endwhile;
endif;
?>

</div>
</article>
</div>
</div>

<?php get_footer(); ?>