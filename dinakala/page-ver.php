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
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <?php if ( ! dina_opt( 'dis_mobile_color' ) ) { ?>
    <meta name="theme-color" content="<?php echo ( dina_opt( 'ch_mobile_color' ) ? dina_opt( 'mobile_bar_color' ) : dina_opt( 'custom_color' ) ); ?>" />
    <?php } ?>
    <title>
        <?php bloginfo( 'name' ); ?>
    </title>
    <link rel="shortcut icon" href="<?php echo dina_to_https( dina_opt( 'site_favicon', 'url' ) ); ?>" type="image/x-icon" />
    <link rel="apple-touch-icon" href="<?php echo dina_to_https( dina_opt( 'site_favicon', 'url' ) ); ?>">
    <link rel="stylesheet" media="screen" type="text/css" href="<?php echo DI_URI; ?>/css/bootstrap-rtl.min.css">
    <link rel="stylesheet" media="screen" type="text/css" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
    <link rel="stylesheet" media="screen" type="text/css" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/<?php echo dina_opt( 'theme_font' );  ?>.css" />
</head>

<body class="maintenance-mode<?php echo is_rtl() ? ' rtl' : ' ltr'; ?>">
    <div class="container-fluid">
        <div class="row">
            <div class="container under">
                <h1>
                    <a href="<?php echo dina_logo_link(); ?>" title="<?php bloginfo( 'name' );?> | <?php bloginfo( 'description' ); ?>" rel="home">
                    <?php 
                    $logo_width = ( ! empty( dina_opt( 'site_logo_retina', 'width' ) ) ) ? dina_opt( 'site_logo_retina', 'width' ) : '320';
                    $logo_height = ( ! empty( dina_opt( 'site_logo_retina', 'height' ) ) ) ? dina_opt( 'site_logo_retina', 'height' ) : '114'; ?>
                        <img class="skip-lazy" src="<?php echo dina_to_https( dina_opt( 'site_logo_retina', 'url' ) ); ?>" width="<?php echo $logo_width; ?>" height="<?php echo $logo_height; ?>" alt="<?php bloginfo( 'name' );?> | <?php bloginfo( 'description' ); ?>" title="<?php bloginfo( 'name' );?> | <?php bloginfo( 'description' ); ?>" />
                    </a>
                </h1>
                <h2>
                    <?php _e( 'Register version', 'dina-kala' ); ?>
                </h2>
                <h3 style="font-size:18px;margin:20px auto;display:table">
                    <?php _e( 'Please activate theme with your license key to all features work.' , 'dina-kala' ) ?>
                    <a class="btn btn-info" style="margin:10px auto;display:table" href="<?php echo admin_url( 'themes.php?page=d5afca6d89ba2775bce9973177ff', '' ); ?>"><?php _e( 'Register License' , 'dina-kala' ) ?></a>
                </h3>
            </div>
        </div>
    </div>
</body>

</html>