<!doctype html>
<?php
/*
Theme Designed By: Meysam Hosseinkhani
Email: Meysam98@Gmail.com
Author Website: i-design.ir
*/
   // Exit if accessed directly
   if ( ! defined( 'ABSPATH' ) )
    exit;

?>
<html <?php language_attributes(); ?>>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <?php if ( ! dina_opt( 'dis_mobile_color' ) ) { ?>
    <meta name="theme-color" content="<?php echo ( dina_opt( 'ch_mobile_color' ) ? dina_opt( 'mobile_bar_color' ) : dina_opt( 'custom_color' ) ); ?>" />
    <?php } ?>
    <title>
        <?php bloginfo( 'name' ); ?>
    </title>
    <link rel="shortcut icon" href="<?php echo dina_to_https( dina_opt( 'site_favicon', 'url' ) ); ?>" type="image/x-icon" />
    <link rel="apple-touch-icon" href="<?php echo dina_to_https( dina_opt( 'site_favicon', 'url' ) ); ?>">
    <style>
        .container.under{
            color:<?php echo dina_opt( 'maintenance_text_color' ); ?>!important;
        }
    </style>
    <?php wp_head(); ?>
</head>

<body class="maintenance-mode<?php echo is_rtl() ? ' rtl' : ' ltr'; ?>">
    <div class="container-fluid">
        <div class="row container under">

            <h1 class="col-12">
                <a href="<?php echo dina_logo_link(); ?>" title="<?php bloginfo( 'name' );?> | <?php bloginfo( 'description' ); ?>" rel="home">
                <?php 
                    if ( ! empty ( dina_opt( 'site_logo_retina', 'url' ) ) ) {
                        $logo_width  = ( ! empty( dina_opt( 'site_logo_retina', 'width' ) ) ) ? dina_opt( 'site_logo_retina', 'width' ) : '320';
                        $logo_height = ( ! empty( dina_opt( 'site_logo_retina', 'height' ) ) ) ? dina_opt( 'site_logo_retina', 'height' ) : '114';
                        $logo_src    = dina_to_https( dina_opt( 'site_logo_retina', 'url' ) );
                    } else {
                        $logo_width  = ( ! empty( dina_opt( 'site_logo', 'width' ) ) ) ? dina_opt( 'site_logo', 'width' ) : '160';
                        $logo_height = ( ! empty( dina_opt( 'site_logo', 'height' ) ) ) ? dina_opt( 'site_logo', 'height' ) : '57';
                        $logo_src    = dina_to_https( dina_opt( 'site_logo', 'url' ) );
                    }
                ?>
                    <img class="skip-lazy" src="<?php echo $logo_src; ?>" width="<?php echo $logo_width; ?>" height="<?php echo $logo_height; ?>" alt="<?php bloginfo( 'name' );?> | <?php bloginfo( 'description' ); ?>" title="<?php bloginfo( 'name' );?> | <?php bloginfo( 'description' ); ?>" />
                </a>
            </h1>

            <?php
            //show maintenance mode countdown
            $date = dina_opt( 'date_counter' );
            if ( dina_opt( 'show_counter' ) && ! empty( $date ) ) {
                
                $date = date( "Y/m/d", strtotime( $date ) );
                
                $now = time(); // or your date as well
                $end_date = strtotime( $date);
                $diff = $end_date - $now;
                $datediff = round( $diff / (60 * 60 * 24) );
                if ( $datediff > -1 ) {
            ?>
                <div class="salecount <?php echo dina_opt( 'counter_style' );  echo ! dina_opt( 'counter_circle' ) ? ' sale-not-circle' : ''; ?> col-12" data-datediff="<?php echo $datediff; ?>" data-format="<?php echo dina_opt( 'counter_format' ); ?>" data-countdown="<?php echo $date; ?>" data-dir="<?php dina_dir() ?>" data-seconds="<?php _e( 'Seconds' , 'dina-kala' ); ?>" data-minutes="<?php _e( 'Minutes' , 'dina-kala' ); ?>" data-hours="<?php _e( 'Hours' , 'dina-kala' ); ?>" data-days="<?php _e( 'Days' , 'dina-kala' ); ?>" data-weeks="<?php _e( 'Weeks' , 'dina-kala' ); ?>">
                </div>
            <?php }
            }  ?>

            <h2 class="col-12">
                <?php echo dina_opt( 'maintenance_title' ); ?>
            </h2>
            <h3>
                <?php echo dina_opt( 'maintenance_msg' ); ?>
            </h3>

            <?php if ( dina_opt( 'maintenance_social' ) ) { ?>
                <?php $social_nofollow = ( dina_opt( 'nofollow_social_link' ) ? ' rel="nofollow"' : '' ); ?>
                <div class="col-12 social-footer under-social">
                    <?php dina_social_links( '', false ) ?>
                </div>
            <?php } ?>
        </div>
    </div>
    <?php 
    
    if ( function_exists( 'dina_footer' ) ) {
        dina_footer();
    } else {
        do_action( 'dina_footer' );
    }

    wp_footer(); ?>
</body>

</html>