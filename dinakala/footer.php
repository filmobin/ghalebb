<?php
/*
Theme Designed By: Meysam Hosseinkhani
Email: Meysam98@Gmail.com
Author Website: i-design.ir
*/
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
    exit;

//dina_before_footer
do_action( 'dina_before_footer' );

// Elementor footer location
//Support Elementor Header & Footer Builder
if ( function_exists( 'get_hfe_footer_id' ) && get_hfe_footer_id() != false ) {
    hfe_render_footer();
} elseif ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'footer' ) ) {
    get_template_part( 'template-parts/footer' );
}

if ( function_exists( 'dina_footer' ) ) {
    dina_footer();
} else {
    do_action( 'dina_footer' );
}
wp_footer();
?>



</body>
</html>