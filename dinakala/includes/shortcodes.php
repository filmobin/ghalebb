<?php

//Display name
function dina_display_name_shortcode() {
    $user = wp_get_current_user();
    $display_name = $user->display_name;
    return $display_name;
}
add_shortcode( 'dina_display_name', 'dina_display_name_shortcode' );

//First name
function dina_first_name_shortcode() {
    $user = wp_get_current_user();
    $first_name = $user->first_name;
    return $first_name;
}
add_shortcode( 'dina_first_name', 'dina_first_name_shortcode' );

//Last name
function dina_last_name_shortcode() {
    $user = wp_get_current_user();
    $last_name = $user->last_name;
    return $last_name;
}
add_shortcode( 'dina_last_name', 'dina_last_name_shortcode' );

//Shortlink
function dina_short_link_shortcode() {
    $short_link = wp_get_shortlink();
    return $short_link;
}
add_shortcode( 'dina_short_link', 'dina_short_link_shortcode' );

//Shortlink
function dina_title_shortcode() {
    $title = get_the_title();
    return $title;
}
add_shortcode( 'dina_title', 'dina_title_shortcode' );

//Dina order_tracking Shortcode
function dina_order_tracking_code( $atts ) {

    $order_id = $atts['order_id'];

    if ( empty ( $order_id ) )
        return;

    //$order = wc_get_order( $order_id );
    $order = wc_get_order( apply_filters( 'dina_shortcode_order_tracking_order_id', $order_id ) );

    if ( ! $order ) 
        return;

    $tracking_code = $order->get_meta( 'tracking_column' );
    
    return $tracking_code;
}
add_shortcode( 'dina_order_tracking_code', 'dina_order_tracking_code' );

//Dina aparat video Shortcode
function dina_aparat_video( $atts ) {
    if ( empty ( $atts['id'] ) )
        return;
   
    return '<div class="h_iframe-aparat_embed_frame"><span style="display: block;padding-top: 57%"></span><iframe src="https://www.aparat.com/video/video/embed/videohash/'. $atts['id'] .'/vt/frame" title="'. get_the_title( get_the_ID() ) .'" allowFullScreen="true" webkitallowfullscreen="true" mozallowfullscreen="true"></iframe></div>';
}
add_shortcode( 'dina_aparat', 'dina_aparat_video' );

//Dina today date
function dina_date_shortcode( $atts ) {

    $format = isset ( $atts['format'] ) ? $atts['format'] : '';
    
    switch ( $format ) {
        case 1:
            $format = ! is_rtl() ? 'l, j F Y' : 'l، j F Y';
            break;
        case 2:
            $format = 'j F Y';
            break;
        case 3:
            $format = ! is_rtl() ? 'j/m/Y' : 'Y/m/j';
            break;
        default:
            $format = ! is_rtl() ? 'l, j F Y' : 'l، j F Y';
    }

    $output = dina_date( $format );

    if ( ! empty ( $atts['farsi'] ) )
        $output = '<span class="dina-farsi">'. $output .'</span>';

    return $output;
}
add_shortcode( 'dina_date', 'dina_date_shortcode' );

//dina_update_date_shortcode
function dina_update_date_shortcode( $atts ) {

    $format = isset ( $atts['format'] ) ? $atts['format'] : '';

    switch ( $format ) {
        case 1:
            $format = ! is_rtl() ? 'l, j F Y' : 'l، j F Y';
            break;
        case 2:
            $format = 'j F Y';
            break;
        case 3:
            $format = ! is_rtl() ? 'j/m/Y' : 'Y/m/j';
            break;
        default:
            $format = ! is_rtl() ? 'l, j F Y' : 'l، j F Y';
    }

    $lang   = get_bloginfo("language");
    $output = ( $lang == 'fa-IR' ? get_the_modified_time( $format ) : get_post_modified_time( $format ) );

    if ( ! empty ( $atts['farsi'] ) )
        $output = '<span class="dina-farsi">'. $output .'</span>';

    return $output;
}
add_shortcode( 'dina_update_date', 'dina_update_date_shortcode' );

//dina_date
function dina_date( $format ) {
    if( ! is_rtl() ) {
        $date = date( $format );
    } elseif ( function_exists( 'eng_number' ) ) {
		$date = parsidate( $format );
	} elseif ( function_exists( 'wp_date' ) ) {
		$date = wp_date( $format );
	} elseif ( function_exists( 'jdate' ) ) {
        $date = jdate( $format );
    } elseif ( function_exists( 'wpp_jdate' ) ) {
        $date = wpp_jdate( $format );
    } else {
		$date = date( $format );
	}

    return $date;
}