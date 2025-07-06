<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
    exit;

//Dina register ajax script
add_action( 'wp_enqueue_scripts', 'dina_ajax_script' );
function dina_ajax_script() {
    wp_register_script( 'dina-ajax-script', DI_URI . '/js/dina-ajax.js', array( 'jquery' ), DI_VER, true);
    
    // Localize the script with new data
    $script_data_array = array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'security' => wp_create_nonce( 'dina_ajax' ),
    );

    wp_localize_script( 'dina-ajax-script', 'dinaproduct', $script_data_array );
    wp_enqueue_script( 'dina-ajax-script' );
}

//Product quick view on product archive pages
add_action( 'wp_ajax_load_post_by_ajax', 'load_post_by_ajax_callback' );
add_action( 'wp_ajax_nopriv_load_post_by_ajax', 'load_post_by_ajax_callback' );
function load_post_by_ajax_callback() {
    

    check_ajax_referer( 'dina_ajax', 'security' );

    $product_id = $_POST['id'];
    
    $args = array(
        'post_type'   => 'product',
        'post_status' => 'publish',
        'p'           => $_POST['id'],
    );
 
    $posts = new WP_Query( $args );
 
    $arr_response = array();
    
    if ( $posts->have_posts() ) {
 
        while( $posts->have_posts() ) {

            $product = wc_get_product( $product_id );
            
            $posts->the_post();

            $mtitle = '<a class="qucik-view-link" href="'. get_permalink() .'"><i class="fal fa-bags-shopping" aria-hidden="true"></i>'. get_the_title() .'</a>';
            
            $images = $product->get_gallery_image_ids(); 

            if ( ! empty( $images) ) {

                $img_gallery = '<div id="carouselQuickView" class="carousel slide" data-ride="carousel">
                <a class="quick-view-details" href="'.get_permalink().'">'.__( 'View Details', 'dina-kala' ).'</a>
                <div class="carousel-inner">';
                $img_gallery .= '<div class="carousel-item active">';   
                $img_gallery .= get_the_post_thumbnail( $product_id , 'woocommerce_thumbnail' );
                $img_gallery .= '</div>';

                foreach ( $images as $image ) { 
                    $image_attr   = wp_get_attachment_image_src( $image, 'woocommerce_thumbnail' );
                    $width        = ( isset( $image_attr[1] ) ? ' width="' . $image_attr[1] . '"' : '' );
                    $height       = ( isset( $image_attr[2] ) ? ' height="' . $image_attr[2] . '"' : '' );
                    $img_gallery .= '<div class="carousel-item">';
                    $img_gallery .= '<img src="'.$image_attr[0].'" alt="'. get_the_title() .'"'. $width . $height .' />';
                    $img_gallery .= '</div>';
                }

                $img_gallery .= '</div><a class="carousel-control-prev" href="#carouselQuickView" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselQuickView" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
                </div>';

            } else {

                $img_gallery = get_the_post_thumbnail( $product_id , 'woocommerce_thumbnail' );
                $img_gallery .= '<a class="quick-view-details" href="'.get_permalink().'">'.__( 'View Details', 'dina-kala' ).'</a>';
                
            }

            ob_start();
            
            woocommerce_template_single_meta();
            
            dina_woo_product_features();

            if ( dina_opt( 'add_prod_btn_location' ) == 'location2' ) {
                dina_add_product_btn();
            }


            if ( dina_opt( 'product_catalog_mode' ) && dina_opt( 'product_catalog_price_mode' ) ) {
                //Show Nothing
            } else {
                $variable_class = '';

                if ( dina_opt( 'remove_dub_price_range' ) && $product->is_type( 'variable' ) ) {
                    $min_var_reg_price  = $product->get_variation_regular_price( 'min', true );
                    $min_var_sale_price = $product->get_variation_sale_price( 'min', true );
                    $max_var_reg_price  = $product->get_variation_regular_price( 'max', true );
                    $max_var_sale_price = $product->get_variation_sale_price( 'max', true );
                    if ( ! ( $min_var_reg_price == $max_var_reg_price) || ! ( $min_var_sale_price == $max_var_sale_price) ) {
                        $variable_class = ' variable-price';
                    }
                }

                echo '<div class="price-con'. $variable_class .'">';

                if ( $product->is_in_stock() ) {
                    woocommerce_template_single_price();
                } else {
                    echo '<div class="quick-not-stock-price">';
                        echo dina_outofstock_text();
                    echo '</div>';
                }
            }
            
            $coming = get_post_meta( $product_id, 'dina_coming', true );

            if ( ! dina_opt( 'product_catalog_mode' ) && ! show_login_price() && ! $coming && $product->is_purchasable() && $product->is_in_stock() ) { 
                woocommerce_template_single_add_to_cart();
            }
            echo '</div>';
            
            $content = ob_get_clean();

            if ( ! $product->is_type( 'external' ) && ( dina_opt( 'ajax_add' ) && get_option( 'woocommerce_enable_ajax_add_to_cart' ) === 'yes' && get_option( 'woocommerce_cart_redirect_after_add' ) === 'no' ) ) {
                $quickajax = 'quickajax';
            } else {
                $quickajax = 'quickajax-disable';
            }

            $arr_response = array(
                'title'       => $mtitle,
                'img_gallery' => $img_gallery,
                'content'     => $content,
                'quickajax'   => $quickajax,
            );
        }
        wp_reset_postdata();
    }
 
    echo json_encode( $arr_response);
 
    wp_die();
}

//Quick view modal
if ( dina_opt( 'show_quick_view' ) ) {
    add_action( 'wp_footer', 'dina_quick_view_modal' );
}
function dina_quick_view_modal() {
    ?>
    <!-- Modal -->
    <div class="modal fade bd-example-modal-lg" id="postModal" tabindex="-1" role="dialog" aria-labelledby="postModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title" id="postModalLabel"></div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="fal fa-times" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="modal-body woocommerce">
                    <div class="container-fluid single-product product-quick-view">
                        <div class="row product">

                            <div class="col-md-5 quick-gallery">
                            </div>

                            <div class="col-md-7 summary entry-summary scrollable">
                                <div class="summary-content">   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php 
} 


//Product Compare on product archive pages
if ( defined( 'WCCM_VERISON' ) ) {
add_action( 'wp_ajax_dina_ajax_compare', 'dina_ajax_compare_callback' );
add_action( 'wp_ajax_nopriv_dina_ajax_compare', 'dina_ajax_compare_callback' );
}
function dina_ajax_compare_callback() {
    check_ajax_referer( 'dina_ajax', 'security' );
    $product_id = $_POST['id'];

    if ( in_array( $product_id, wccm_get_compare_list() ) ) {
        dina_remove_product_from_compare_list( $product_id );
        $compare_title = __( 'Compare Product', 'dina-kala' );
    } else {
        dina_add_product_to_compare_list( $product_id );
        $compare_title = __( 'Remove From Compare', 'dina-kala' );
    }

    $compare_count = count(wccm_get_compare_list() );
    $compare_url   = wccm_get_compare_page_link( wccm_get_compare_list() );
    
 
    $arr_response = array();
    
    $arr_response = array(
        'title'       => $compare_title,
        'conut'       => $compare_count,
        'compare_url' => $compare_url,
    );

    echo json_encode( $arr_response);
 
    wp_die();
}

//Add Product to compare list function
function dina_add_product_to_compare_list( $product_id ) {
	$product = wc_get_product( $product_id );
	if ( ! $product ) {
		return;
	}

	$list   = wccm_get_compare_list();
	$list[] = $product_id;

	wccm_set_compare_list( $list );
}

//Remove Product from compare list function
function dina_remove_product_from_compare_list( $product_id ) {
	$list = wccm_get_compare_list();

	foreach ( wp_parse_id_list( $product_id ) as $product_id ) {
		$key = array_search( $product_id, $list );
		if ( $key !== false ) {
			unset( $list[$key] );
		}
	}

	wccm_set_compare_list( $list );
}


//Product Compare url and number
if ( defined( 'WCCM_VERISON' ) ) {
add_action( 'wp_ajax_dina_ajax_compare_number', 'dina_ajax_compare_number_callback' );
add_action( 'wp_ajax_nopriv_dina_ajax_compare_number', 'dina_ajax_compare_number_callback' );
}
function dina_ajax_compare_number_callback() {
    check_ajax_referer( 'dina_ajax', 'security' );

    $compare_count = count(wccm_get_compare_list() );
    $compare_url   = wccm_get_compare_page_link( wccm_get_compare_list() );
    $arr_response  = array();
    $arr_response  = array(
        'conut'       => $compare_count,
        'compare_url' => $compare_url,
    );

    echo json_encode( $arr_response);
 
    wp_die();
}