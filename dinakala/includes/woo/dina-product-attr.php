<?php
/*
Theme Designed By: Meysam Hosseinkhani
Email: Meysam98@Gmail.com
Demo Website: Dinakala.I-design.ir
Author Website: i-design.ir
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
    exit;

//Dina get product attributes table
if ( ! function_exists( 'dina_get_product_attributes_table' ) ) {
    function dina_get_product_attributes_table( $id ) {

        $product = wc_get_product( $id );
    
        $product_attributes = array();
    
        // Display weight and dimensions before attribute list.
        $display_dimensions = apply_filters( 'wc_product_enable_dimensions_display', $product->has_weight() || $product->has_dimensions() );
    
        if ( $display_dimensions && $product->has_weight() ) {
            $product_attributes['weight'] = array(
                'label' => __( 'Weight', 'dina-kala' ),
                'value' => wc_format_weight( $product->get_weight() ),
            );
        }
    
        if ( $display_dimensions && $product->has_dimensions() ) {
            $product_attributes['dimensions'] = array(
                'label' => __( 'Dimensions', 'dina-kala' ),
                'value' => wc_format_dimensions( $product->get_dimensions( false ) ),
            );
        }
    
        // Add product attributes to list.
        $attributes = array_filter( $product->get_attributes(), 'wc_attributes_array_filter_visible' );
    
        foreach ( $attributes as $attribute ) {
    
            $values = array();
    
            if ( $attribute->is_taxonomy() ) {
                $attribute_taxonomy = $attribute->get_taxonomy_object();
                $attribute_values   = wc_get_product_terms( $product->get_id(), $attribute->get_name(), array( 'fields' => 'all' ) );
    
                foreach ( $attribute_values as $attribute_value ) {
    
                    $value_name = esc_html( $attribute_value->name );
    
                    if ( $value_name == dina_opt( 'attr_symbol_tick' ) ) {
                        $value_name = '<i class="dina-attr-icon fal fa-check" title="'. dina_opt( 'attr_symbol_tick' ) .'" aria-hidden="true"></i>';
                    } elseif ( $value_name == dina_opt( 'attr_symbol_cross' ) ) {
                        $value_name = '<i class="dina-attr-icon fal fa-times" title="'. dina_opt( 'attr_symbol_cross' ) .'" aria-hidden="true"></i>';
                    }
    
                    if ( $attribute_taxonomy->attribute_public ) {
                        $values[] = '<a href="' . esc_url( get_term_link( $attribute_value->term_id, $attribute->get_name() ) ) . '" rel="tag">' . do_shortcode( $value_name ) . '</a>';
                    } else {
                        $values[] = do_shortcode( $value_name );
                    }
                }
            } else {
                $values = $attribute->get_options();
    
                foreach ( $values as &$value ) {
    
                    if ( $value == dina_opt( 'attr_symbol_tick' ) ) {
                        $value = '<i class="dina-attr-icon fal fa-check" title="'. dina_opt( 'attr_symbol_tick' ) .'" aria-hidden="true"></i>';
                    } elseif ( $value == dina_opt( 'attr_symbol_cross' ) ) {
                        $value = '<i class="dina-attr-icon fal fa-times" title="'. dina_opt( 'attr_symbol_cross' ) .'" aria-hidden="true"></i>';
                    }
    
                    $value = make_clickable( $value );
                }
            }
    
            $product_attributes[ 'attribute_' . sanitize_title_with_dashes( $attribute->get_name() ) ] = array(
                'label' => wc_attribute_label( $attribute->get_name() ),
                'value' => apply_filters( 'woocommerce_attribute', wptexturize( implode( ', ', $values ) ), $attribute, $values ),
            );
    
        }
    
        /**
         * Hook: woocommerce_display_product_attributes.
         * $product_attributes Array of atributes to display; label, value.
         *  $product Showing attributes for this product.
        */
        $product_attributes = apply_filters( 'woocommerce_display_product_attributes', $product_attributes, $product );
    
        if ( ! $product_attributes ) {
            return;
        }
    
        
        $output = '<table class="woocommerce-product-attributes shop_attributes">';
            $output .= '<tbody>';
        foreach ( $product_attributes as $product_attribute_key => $product_attribute ) :
            $output .= '<tr class="woocommerce-product-attributes-item woocommerce-product-attributes-item--'. esc_attr( $product_attribute_key ) .'">';
                $output .= '<th class="woocommerce-product-attributes-item__label">'. wp_kses_post( $product_attribute['label'] ) .'</th>';
                $output .= '<td class="woocommerce-product-attributes-item__value">'. wp_kses_post( $product_attribute['value'] ) .'</td>';
            $output .= '</tr>';
        endforeach;
            $output .= '</tbody>';
        $output .= '</table>';

        return $output;
    }
}

//dina_woo_add_product_class
if ( ! function_exists( 'dina_replace_attr_class' ) ) {
    add_filter( 'post_class', 'dina_replace_attr_class' );
    function dina_replace_attr_class( $classes ) {
        global $product;
        if ( is_single() && 'product' == get_post_type() ) {
            $classes[] .= 'dina-replace-attr';
        }
        return $classes;
    }
}

//Remove additional_information tab from WooCommerce single product page
if ( ! function_exists( 'dina_remove_additional_information_tab' ) ) {
    add_filter( 'woocommerce_product_tabs', 'dina_remove_additional_information_tab', 98 );
    function dina_remove_additional_information_tab( $tabs) {
        unset( $tabs['additional_information'] );
        return $tabs;
    }
}

//dina_additional_information_tab
if ( ! function_exists( 'dina_additional_information_tab' ) ) {
    add_filter( 'woocommerce_product_tabs', 'dina_additional_information_tab' );
    function dina_additional_information_tab( $tabs ) {
        
        $features = dina_get_product_attributes_table( get_the_ID() );
        
        if ( empty( $features ) )
            return $tabs;
        
        $tabs['dina_additional_information'] = array(
            'title'     => __( 'Product Features', 'dina-kala' ),
            'priority'  => 15,
            'callback'  => 'dina_additional_information_tab_content'
        );
    
        return $tabs;
        
    }
}

//dina_additional_information_tab_content
if ( ! function_exists( 'dina_additional_information_tab_content' ) ) {
    function dina_additional_information_tab_content() {

        if ( dina_opt( 'product_tab_scroll' ) ) {
            echo product_tab_title( __( 'Product Features', 'dina-kala' ) );
        }

        echo dina_get_product_attributes_table( get_the_ID() );
    }
}