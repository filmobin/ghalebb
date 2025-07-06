<?php
/*
Theme Designed By: Meysam Hosseinkhani
Email: Meysam98@Gmail.com
Author Website: i-design.ir
*/
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
    exit;

//Check Meintenance Mode
dina_check_maintenance();
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
		
		
		
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-B9MK4TFLV8"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-B9MK4TFLV8');
</script>
    </head>
    
    <body <?php body_class(); ?> <?php if ( dina_opt( 'site_schema' ) ) {?>itemscope itemtype="https://schema.org/WebPage"<?php } ?>>

    <?php 
        if ( function_exists( 'wp_body_open' ) ) {
            wp_body_open();
        } else {
            do_action( 'wp_body_open' );
        }

        if ( function_exists( 'dina_header' ) ) {
            dina_header();
        } else {
            do_action( 'dina_header' );
        }
    ?>

    <?php
    // Elementor header location
    //Support Elementor Header & Footer Builder
    if ( function_exists( 'get_hfe_header_id' ) && get_hfe_header_id() != false ) {
        hfe_render_header();
    } elseif ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'header' ) ) {
        get_template_part( 'template-parts/header' );
    }