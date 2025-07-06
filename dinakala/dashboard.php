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
?>

<?php if ( have_posts() ) : ?>
<?php while ( have_posts() ) : the_post(); ?>
<?php the_content(); ?>
<?php 
endwhile;
endif;

dina_get_user_panel_footer();