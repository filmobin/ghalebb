<?php
/*
Theme Designed By: Meysam Hosseinkhani
Email: Meysam98@Gmail.com
Author Website: i-design.ir
*/
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
    exit;

//Add Dokan link to my account page
add_filter ( 'woocommerce_account_menu_items', 'dokan_acc_link' );
function dokan_acc_link( $menu_links ) {
    if ( user_seller() ) {
        $new = array( 'dokan-link' => __( 'Vendor Dashboard' , 'dina-kala' ) ); 
    } else {
        $new = array( 'dokan-link-become' => __( 'Become a Vendor' , 'dina-kala' ) ); 
    }
    $menu_links = array_slice( $menu_links, 0, 1, true )
    + $new 
    + array_slice( $menu_links, 1, NULL, true );
    return $menu_links;
}
add_filter( 'woocommerce_get_endpoint_url', 'dokan_hook_endpoint', 5, 4 );
function dokan_hook_endpoint( $url, $endpoint, $value, $permalink ) {
    if ( $endpoint === 'dokan-link' ) {
        $url = esc_url( user_dashboard() );
    } elseif ( $endpoint === 'dokan-link-become' ) {
        $url = esc_url( dokan_get_page_url( 'myaccount', 'dina-kala', 'account-migration' ) );
    }
    return $url;
}

//Get Seller Dashboard Address
function user_dashboard() {
    if ( ! is_user_logged_in() )
        return;

    $user = wp_get_current_user();

    if ( user_can( $user, 'dokandar' ) ) {
        $seller_dashboard = dokan_get_option( 'dashboard', 'dokan_pages' );
        if ( $seller_dashboard != -1 ) {
            $seller_page = get_permalink( $seller_dashboard );
        }
    }
    return $seller_page;
}

//Check User is Dokan Seller
function user_seller() {
    $user_id = '';

    if ( is_user_logged_in() ) {
        $user = wp_get_current_user();
        $user_id = get_current_user_id();
    }

    $user_seller = dokan_is_user_seller( $user_id );

    if ( $user_seller )
        return true;
}

//dina_dokan_dashboard_wrap_start
add_action( 'dokan_dashboard_wrap_start', 'dina_dokan_dashboard_wrap_start', 10);
function dina_dokan_dashboard_wrap_start() {
    $container_class = dina_opt( 'user_panel_style' ) == 'upanel-one' ? 'container-fluid dina-userpanel-style-one main-con' : 'container dina-userpanel-style-two main-con';
?>
    <div class="<?php echo $container_class ?>">
    <?php if ( dina_opt( 'show_bread' ) && dina_opt( 'user_panel_style' ) != 'upanel-one'  ) { dina_breadcrumb(); } ?>
        <div class="row">
            <article role="main" class="col-12">
<?php
}

//dina_dokan_dashboard_wrap_end
add_action( 'dokan_dashboard_wrap_end', 'dina_dokan_dashboard_wrap_end', 10);
function dina_dokan_dashboard_wrap_end() {
?>
        </article>
    </div>
</div>
<?php }

//Set template of Dokan dashboard
add_filter( 'page_template', 'dina_dokan_page_template' );
function dina_dokan_page_template( $page_template ) {
    if ( class_exists( 'WUPP_User_Panel' ) )
        return $page_template;

    if ( wc_post_content_has_shortcode( 'dokan-dashboard' ) )
        $page_template = DI_DIR . '/dashboard.php'; 

    if ( wc_post_content_has_shortcode( 'dokan-dashboard' ) && dina_opt( 'user_panel_style' ) == 'upanel-one' )
        add_filter( 'show_admin_bar', '__return_false' );

    return $page_template;
}


//Remove shippng tab from WooCommerce single product page
add_filter( 'woocommerce_product_tabs', 'dina_remove_shipping_product_tab', 98 );
function dina_remove_shipping_product_tab( $tabs ) {
    if ( ! dina_opt( 'hide_dokan_shipping' ) )
        return $tabs;
    unset( $tabs['shipping'] );
    return $tabs;
}

//Remove seller product tab from WooCommerce single product page
add_filter( 'woocommerce_product_tabs', 'dina_remove_seller_product_tab', 98 );
function dina_remove_seller_product_tab( $tabs) {
    if ( ! dina_opt( 'hide_dokan_seller_info' ) )
        return $tabs;
    unset( $tabs['seller'] );
    return $tabs;
}

//Remove more seller product tab from WooCommerce single product page
add_filter( 'woocommerce_product_tabs', 'dina_remove_more_seller_product_tab', 98 );
function dina_remove_more_seller_product_tab( $tabs) {
    unset( $tabs['more_seller_product'] );
    return $tabs;
}

//Add vendor's name to product's meta
add_action( 'woocommerce_product_meta_start', 'dina_product_vendor', 12);
function dina_product_vendor() {
    if ( ! dina_opt( 'show_product_vendor' ) )
        return;
    global $product;
    $author = get_post_field( 'post_author', $product->get_id() );
    $author_data = get_userdata( absint( $author ) );
    $store_info = dokan_get_store_info( $author_data->ID );
    $store_name = ! empty( $store_info['store_name'] ) ? esc_html( $store_info['store_name'] ) : esc_attr( $author_data->display_name );
?>
<span class="vendor_wrapper"><?php _e( 'Vendor:', 'dina-kala' ) ?>
    <span class="product-vendor"><?php printf( '<a href="%s">%s</a>', esc_url( dokan_get_store_url( $author_data->ID ) ), $store_name ); ?></span>
</span>
<?php
}

//Get product's vendor 
add_action( 'dina_after_shop_loop_item', 'dina_get_product_vendor' );
function dina_get_product_vendor() {
    if ( ! dina_opt( 'show_product_vendor_archive' ) )
        return;
    global $product;

    $author      = get_post_field( 'post_author', $product->get_id() );
    $author_data = get_userdata( absint( $author ) );
?>

    <div class="product-vendor-name">
        <i class="fal fa-store" aria-hidden="true"></i>
        <?php _e( 'Vendor:', 'dina-kala' ); ?>
        <?php echo esc_attr( $author_data->display_name ); ?>
    </div>

<?php
}

//Remove Dokan FontAwesome Library
add_action( 'wp_enqueue_scripts', 'remove_default_stylesheet' );
function remove_default_stylesheet() {
    wp_dequeue_style( 'dokan-fontawesome' );
    wp_deregister_style( 'dokan-fontawesome' );
}

//Products per page of the More Products tab
add_filter( 'dokan_get_more_products_per_page', function( $post_per_page) {
    return 4;
});

add_action ( 'dokan_dashboard_content_before', 'dina_dokan_dashboard_content_before', 99 );
add_action ( 'dokan_dashboard_content_after', 'dina_dokan_dashboard_content_after' );
function dina_dokan_dashboard_content_before() {
    echo '<div class="col-lg-9 col-12 dina-dokan-dashboard-content-con"><div class="shadow-box dina-dokan-dashboard-content">';
}

function dina_dokan_dashboard_content_after() {
    echo '</div></div>';
}