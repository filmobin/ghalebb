<?php 

if ( dina_opt( 'show_product_brand' ) ) {
add_action( 'woocommerce_product_meta_start', 'dina_product_brand', 12);
}

function dina_product_brand() {
    if ( ! empty( get_the_terms( get_the_ID(), dina_opt( 'product_brand_taxonomy' ) ) ) ) {
    ?>
        <span class="brand_wrapper"><?php _e( 'Brand:', 'dina-kala' ) ?>
            <span class="product-brand"><?php the_terms( get_the_ID(), dina_opt( 'product_brand_taxonomy' ), '', '، ', '' );  ?></span>
        </span>
    <?php
    }
}

// Register dina_taxonomy_brand
add_action( 'init', 'dina_taxonomy_brand', 0 );
function dina_taxonomy_brand()  {

    $brand_slug     = dina_opt( 'product_brand_slug' ) ?: 'brand';
    $brand_taxonomy = dina_opt( 'product_brand_taxonomy' ) ?: 'brand';

    $labels = array(
        'name'                       => __( 'Brand', 'dina-kala' ),
        'singular_name'              => __( 'Brand', 'dina-kala' ),
        'menu_name'                  => __( 'Brand of products', 'dina-kala' ),
        'all_items'                  => __( 'All Brands', 'dina-kala' ),
        'parent_item'                => __( 'Parent brand', 'dina-kala' ),
        'parent_item_colon'          => __( 'Parent brand', 'dina-kala' ),
        'new_item_name'              => __( 'New brand name', 'dina-kala' ),
        'add_new_item'               => __( 'Add new brand', 'dina-kala' ),
        'edit_item'                  => __( 'Edit brand', 'dina-kala' ),
        'update_item'                => __( 'Update brand', 'dina-kala' ),
        'separate_items_with_commas' => __( 'Separate brands with commas', 'dina-kala' ),
        'search_items'               => __( 'Search brands', 'dina-kala' ),
        'add_or_remove_items'        => __( 'Add or remove brands', 'dina-kala' ),
        'choose_from_most_used'      => __( 'Choose from most used brand', 'dina-kala' ),
    );

    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'query_var'                  => true,
        'rewrite'                    => array( 'slug' => $brand_slug, 'with_front' => false ),
    );

    register_taxonomy( $brand_taxonomy, 'product', $args );
    register_taxonomy_for_object_type( $brand_taxonomy, 'product' );

}

// Register dina_taxonomy_brand
add_action( 'init', 'dina_disable_woocommerce_brands' );
function dina_disable_woocommerce_brands()  {
    if ( get_option( 'dinakala_disable_woocommerce_brands' ) != '1' ) {
        update_option( 'dinakala_disable_woocommerce_brands', '1' );
        update_option( 'wc_feature_woocommerce_brands_enabled', 'no' );
        update_option( 'woocommerce_remote_variant_assignment', 1 );
        flush_rewrite_rules();
    }
}

add_filter( 'woocommerce_structured_data_product', 'dina_woocommerce_structured_data_product_offer', 10, 2 );
function dina_woocommerce_structured_data_product_offer( $markup, $product ) {
    
    $brand_id = dina_get_primary_brand( get_the_ID() );

    if ( ! dina_opt( 'add_brand_schema' ) || empty ( $brand_id ) )
        return $markup;
        
    $brand = get_term( $brand_id, dina_opt( 'product_brand_taxonomy' ) );

    if ( ! empty( $brand ) ) {

        $markup[ 'brand' ] = array(
            '@type'  => 'Brand',
            'name'   => $brand -> name,
        );

        return $markup;
    }
}


if ( dina_opt( 'show_product_brand_tab' ) ) {
    add_filter( 'woocommerce_product_tabs', 'dina_woocommerce_product_tabs_brand' );
}

function dina_woocommerce_product_tabs_brand( $tabs ) {

    $brand_id = dina_get_primary_brand( get_the_ID() );

    if ( empty ( $brand_id ) )
        return $tabs;
        
    $brand = get_term( $brand_id, dina_opt( 'product_brand_taxonomy' ) );

    if ( ! empty( $brand ) ) {
        $tabs['dina_brand'] = array(
            'title'     => dina_opt( 'product_brand_tab_title' ),
            'priority'  => 20,
            'callback'  => 'dina_woocommerce_product_tabs_brand_content'
        );
    }

    return $tabs;
}

function dina_woocommerce_product_tabs_brand_content() {
    
    $brand_id = dina_get_primary_brand( get_the_ID() );

    if ( empty ( $brand_id ) )
        return;

    $brand      = get_term( $brand_id, dina_opt( 'product_brand_taxonomy' ) );
    $brand_link = get_term_link( $brand -> term_id, dina_opt( 'product_brand_taxonomy' ) );

    if ( dina_opt( 'product_tab_scroll' ) ) {
        echo product_tab_title( dina_opt( 'product_brand_tab_title' ) );
    }

    dina_brand_logo();

    if ( ! empty( $brand -> name ) ) {
        echo '<a href="'. $brand_link .'" class="brand-link" title="'. $brand -> name .'">';
            echo '<h3 class="brand-name">'. $brand -> name .'</h3>';
        echo '</a>';
    }

    if ( ! empty( $brand -> description ) ) {
        echo '<div class="brand-description">'. $brand -> description .'</div>';
    }
}

function dina_brand_logo() {

    $brand_id = dina_get_primary_brand( get_the_ID() );

    if ( empty ( $brand_id ) )
        return;
    
    $brand = get_term( $brand_id, dina_opt( 'product_brand_taxonomy' ) );
    
    if ( ! empty( $brand ) ) {
        $brand_logo = get_term_meta( $brand -> term_id, 'dina_brand_logo', true );
        if ( ! empty( $brand_logo ) ) {
            $brand_link = get_term_link( $brand -> term_id, dina_opt( 'product_brand_taxonomy' ) );
            if ( ! dina_opt( 'remove_brand_logo_link') ) {
                echo '<a href="'. $brand_link .'" class="brand-link" title="'. $brand -> name .'">';
            }
                    echo '<img src="'. $brand_logo . '" alt="'. $brand -> name .'" title="'. $brand -> name .'" class="brand-logo">';
            if ( ! dina_opt( 'remove_brand_logo_link') ) {
                echo '</a>';
            }
        }
    }
}

//dina_rewrite_rules
add_action( 'created_term', 'dina_flush_rewrite_on_term_update', 10, 3 );
add_action( 'edited_term', 'dina_flush_rewrite_on_term_update', 10, 3 );
function dina_flush_rewrite_on_term_update( $term_id, $tt_id, $taxonomy ) {
    if ( $taxonomy === dina_opt( 'product_brand_taxonomy' ) ) {
        flush_rewrite_rules();
    }
}

//Get product primary brand
function dina_get_primary_brand( $product_id ) {

    $brand_taxonomy = dina_opt( 'product_brand_taxonomy' );
    $brands         = get_the_terms( $product_id, $brand_taxonomy );

    if ( empty( $brands ) )
        return;

    $primary_brand_id = class_exists( 'WPSEO_Options' ) ? get_post_meta( $product_id, '_yoast_wpseo_primary_'. $brand_taxonomy, true ) : get_post_meta( $product_id, 'rank_math_primary_'. $brand_taxonomy, true );
    
    if ( ! empty ( $primary_brand_id ) ) {
        return $primary_brand_id;
    } else {
        $brand = array_pop( $brands );
        return $brand -> term_id;
    }
}

// dina_brand_rewrite_rules
add_action( 'init', 'dina_brand_rewrite_rules' );
function dina_brand_rewrite_rules() {
    $brand_slug     = dina_opt( 'product_brand_slug' ) ?: 'brand';
    $brand_taxonomy = dina_opt( 'product_brand_taxonomy' ) ?: 'brand';
    add_rewrite_rule(
        '^' . $brand_slug . '/([^/]*)/?$',
        'index.php?' . $brand_taxonomy . '=$matches[1]',
        'top'
    );
}

// dina_flush_rewrite_rules
add_action( 'init', 'dina_flush_rewrite_rules' );
function dina_flush_rewrite_rules() {
    if ( ! get_option( 'dina_rewrite_flushed' ) ) {
        flush_rewrite_rules();
        update_option( 'dina_rewrite_flushed', true );
    }
}