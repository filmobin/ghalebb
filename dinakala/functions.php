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

// Theme's constants
if ( ! defined( 'DI_URI' ) )
    define( 'DI_URI', get_template_directory_uri() );

if ( ! defined( 'DI_DIR' ) )
    define( 'DI_DIR', get_template_directory() );

if ( ! defined( 'DI_VER' ) )
	define( 'DI_VER', '6.1.3' );

require_once ABSPATH . 'wp-admin/includes/plugin.php';
// Theme's Languages
if ( is_plugin_active( 'redux-framework/redux-framework.php' ) ) {
    load_theme_textdomain( 'dina-kala', DI_DIR . '/languages' );
} else {
    add_action( 'redux/init', 'dina_load_mo', 99 );
}
function dina_load_mo() {
    if ( version_compare( $GLOBALS['wp_version'], '6.7', '<' ) ) {
        load_theme_textdomain( 'dina-kala', DI_DIR . '/languages' );
    } else {
        load_textdomain( 'dina-kala', DI_DIR . '/languages/' . determine_locale() . '.mo' );
    }
}

function dina_localisation() {
    function dina_localised( $locale ) {
        if ( isset( $_GET['l'] ) ) {
            return sanitize_key( $_GET['l'] );
        }
        return $locale;
    }
    add_filter( 'locale', 'dina_localised' );
}
add_action( 'after_setup_theme', 'dina_localisation' );

//Include Theme Files
if ( ! class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/includes/ReduxCore/framework.php' ) )
    require_once( dirname( __FILE__ ) . '/includes/ReduxCore/framework.php' );

if ( ! isset( $redux_demo ) && file_exists( dirname( __FILE__ ) . '/includes/admin-panel-config.php' ) )
    require_once( dirname( __FILE__ ) . '/includes/admin-panel-config.php' );


if ( class_exists( 'Redux' ) )
    Redux::init( 'di_data' );

//Dina Get Options
if ( ! function_exists( 'dina_opt' ) ) {
	function dina_opt( $option_name, $arg_name = null ) {
        
        global $di_data;
        if ( ! empty ( $arg_name ) && isset( $di_data [ $option_name ][ $arg_name ] ) ) {
            return $di_data [ $option_name ][ $arg_name ];
        } elseif ( isset( $di_data [ $option_name ] ) ) {
            return $di_data [ $option_name ];
        } else {
            return;
        }
	}
}

//dina_active_elpro
function dina_active_elpro() {
    if ( is_plugin_active( 'elementor-pro/elementor-pro.php' ) || class_exists ( 'Header_Footer_Elementor' ) ) {
        return true;
    } else {
        return false;
    }
}

require_once DI_DIR . '/plugins/plugin.php';
require_once DI_DIR . '/includes/classes/dina-login.php';
require_once DI_DIR . '/includes/meta-box.php';
require_once DI_DIR . '/includes/recaptchalib.php';
require_once DI_DIR . '/includes/dynamic_style.php';
require_once DI_DIR . '/includes/d-sidebar.php';
require_once DI_DIR . '/includes/thumbnail-upscale.php';
require_once DI_DIR . '/includes/single-post-func.php';
require_once DI_DIR . '/includes/shortcodes.php';
if ( class_exists( 'WooCommerce' ) ) {
    require_once DI_DIR . '/includes/woo.php';
}
require_once DI_DIR . '/includes/header-codes.php';
require_once DI_DIR . '/includes/footer-codes.php';
require_once DI_DIR . '/includes/menu-icon.php';
require_once DI_DIR . '/includes/mmenu_walker.php';
require_once DI_DIR . '/includes/views.php';
require_once DI_DIR . '/includes/fa-cheets.php';
if ( class_exists( 'WooCommerce' ) && class_exists( 'WeDevs_Dokan' ) ) {
require_once DI_DIR . '/includes/dokan.php';
}
if ( ! function_exists( 'yoast_breadcrumb' ) && ! class_exists( 'RankMath' ) ) {
require_once DI_DIR . '/includes/visual-term-description-editor/visual-term-description-editor.php';
}
//Widgets
require_once DI_DIR . '/includes/widgets/simple-link-list-widget/simple-link-list-widget.php';
require_once DI_DIR . '/includes/widgets/dina-logo-slider.php';
require_once DI_DIR . '/includes/widgets/image-banner.php';
require_once DI_DIR . '/includes/widgets/logo-namad.php';
require_once DI_DIR . '/includes/widgets/epay.php';

if ( class_exists( 'WooCommerce' ) ) {
    
    //require_once DI_DIR . '/includes/widgets/category-filter.php';
    require_once DI_DIR . '/includes/widgets/products.php';
    require_once DI_DIR . '/includes/widgets/viewed-products.php';
    require_once DI_DIR . '/includes/widgets/stock-status.php';
    
    if ( dina_opt( 'product_brand' ) ) {
        require_once DI_DIR . '/includes/widgets/brand-filter.php';
        require_once DI_DIR . '/includes/widgets/brand-info.php';
        require_once DI_DIR . '/includes/brand.php';
    }
    
}

require_once DI_DIR . '/includes/widgets/posts.php';
require_once DI_DIR . '/includes/widgets/fnews.php';

//Register Elementor Widgets
if ( did_action( 'elementor/loaded' ) ) {
    require_once DI_DIR . '/includes/elementor.php';
}
if ( dina_opt( 'mega_style' ) == 'second' ) {
    require_once DI_DIR . '/includes/yamm-s.php';
} else {
    require_once DI_DIR . '/includes/yamm.php';
}
if ( dina_opt( 'ajax_search' ) ) {
    require_once DI_DIR . '/includes/searchwp-live-ajax-search/searchwp-live-ajax-search.php';
}

if ( dina_opt( 'change_user_avatar' ) ) {
    require_once DI_DIR . '/includes/user-avatar.php';
}

require_once DI_DIR . '/includes/dina-demos.php';
require_once DI_DIR . '/includes/dina-comment.php';

//Register Theme's styles
add_action( 'wp_enqueue_scripts','dina_styles' );
function dina_styles() {

    $dina_bootstrap_style = ( is_rtl() ? 'bootstrap-rtl.min.css' : 'bootstrap.min.css' );
    wp_register_style( 'dina-bootstrap', DI_URI . '/css/' . $dina_bootstrap_style, array(), DI_VER);
    wp_enqueue_style( 'dina-bootstrap' );

    wp_register_style( 'dina-awe', DI_URI . '/css/fontawesome.min.css', array(), DI_VER);
    wp_enqueue_style( 'dina-awe' );

    wp_register_style( 'dina-style', DI_URI . '/style.css', array() , DI_VER);
    wp_enqueue_style( 'dina-style' );

    if ( ! dina_opt( 'custom_font' ) ) {
        wp_register_style( 'dina-font', DI_URI . '/css/'. dina_opt( 'theme_font' ) .'.css', array() , DI_VER);
        wp_enqueue_style( 'dina-font' );
    }
    
    if ( dina_opt( 'full_width_style' ) ) {
        wp_register_style( 'dina-full', DI_URI . '/css/full-width.css', array() , DI_VER);
        wp_enqueue_style( 'dina-full' );
    }

    if ( class_exists( 'WeDevs_Dokan' ) ) {
        wp_register_style( 'dina-dokan', DI_URI . '/css/dokan.css', array(), DI_VER);
        wp_enqueue_style( 'dina-dokan' );
    }

    if ( class_exists( 'YITH_WCAF' ) ) {
        wp_register_style( 'dina-affiliate', DI_URI . '/css/affiliate.css', array(), DI_VER);
        wp_enqueue_style( 'dina-affiliate' );
    }

    wp_register_style( 'dina-simple-lightbox', DI_URI . '/css/simpleLightbox.min.css', array(), DI_VER);
    wp_enqueue_style( 'dina-simple-lightbox' );
    
    wp_register_style( 'dina-user-panel', DI_URI . '/css/my-account.css', array(), DI_VER);

    if ( dina_opt( 'dina_dark_mode' ) ) {
        wp_register_style( 'dina-style-dark', DI_URI . '/css/dina-dark.css', array(), DI_VER);
        wp_enqueue_style( 'dina-style-dark' );
    }
    
    if ( ! is_rtl() ) {
        wp_register_style( 'dina-style-ltr', DI_URI . '/css/ltr.css', array(), DI_VER);
        wp_enqueue_style( 'dina-style-ltr' );
    }
}

//Register Theme's Scripts
add_action( 'init', 'dina_scripts' );
function dina_scripts() {
    if ( is_admin() ) return;
    if ( dina_opt( 'dina_dark_mode' ) )
        wp_enqueue_script( 'dina-js-dark', DI_URI . '/js/dark-theme.js', array( 'jquery' ), DI_VER, true);
    wp_enqueue_script( 'dina-js-boot', DI_URI . '/js/bootstrap.min.js', array( 'jquery' ), DI_VER, true);
    wp_enqueue_script( 'dina-js-main', DI_URI . '/js/main.js', array( 'jquery' ), DI_VER, true);
    wp_enqueue_script( 'dina-js-owl', DI_URI . '/js/owl-carousel.js', array( 'jquery' ), DI_VER, true);
    wp_enqueue_script( 'dina-js-simple-lightbox', DI_URI . '/js/simpleLightbox.min.js', array( 'jquery' ), DI_VER, true);
    wp_enqueue_script( 'dina-js-theme', DI_URI . '/js/theme.js', array( 'jquery' ), DI_VER, true);
    wp_register_script( 'dina-add-cart-ajax', DI_URI . '/js/add-cart-ajax.js', array( 'jquery' ), DI_VER, true);
    wp_register_script( 'dina-easy-ticker', DI_URI . '/js/jquery.easy-ticker.min.js', array( 'jquery' ), DI_VER, true);
    wp_register_script( 'dina-comment-repeater', DI_URI . '/js/repeater.js', array( 'jquery' ), DI_VER, true);
}

add_action ( 'wp_footer', 'dina_quick_view_scripts', 10 );
function dina_quick_view_scripts() {
    if ( is_admin() || ! class_exists( 'WooCommerce' ) ) 
        return;

    wp_enqueue_script( 'wc-add-to-cart-variation' );
    if ( version_compare( WC()->version, '3.0.0', '>=' ) ) {
        wp_enqueue_script( 'wc-single-product' );
    }
}

add_action( 'wp_footer', 'dina_vcrtl_conflict', 11 );
function dina_vcrtl_conflict() { 
    if ( defined( 'WPB_VC_VERSION' ) && is_singular( 'product' ) ) {
        wp_deregister_script( 'flexslider' );
        wp_enqueue_script( 'flexslider', DI_URI . '/js/jquery.flexslider.min.js', array( 'jquery' ), DI_VER, true);
    }
}

//Add Admin Scripts
add_action( 'admin_enqueue_scripts', 'dina_upload_script' );
function dina_upload_script() {
    wp_enqueue_media();
    wp_enqueue_script( 'ads_script', DI_URI . '/js/upload-media.js', false, DI_VER, true );
}

//Theme Setup Options
add_action( 'after_switch_theme', 'dina_activation_hook' );
function dina_activation_hook() {
    if ( get_option( 'dinakala_theme_activated' ) != '1' ) {
        update_option( 'dinakala_theme_activated', '1' );
        update_option( 'woocommerce_enable_signup_and_login_from_checkout', 'yes' );
        update_option( 'woocommerce_enable_myaccount_registration', 'yes' );
        update_option( 'woocommerce_registration_generate_username', 'no' );
        update_option( 'woocommerce_registration_generate_password', 'no' );
        update_option( 'wc_feature_woocommerce_brands_enabled', 'no' );
        update_option( 'woocommerce_remote_variant_assignment', 1 );
        flush_rewrite_rules();
    }
}

// Add Theme Support
add_action( 'after_setup_theme', 'dina_support' );
function dina_support() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script' ) );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
    add_theme_support( 'rank-math-breadcrumbs' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'header-footer-elementor' );
    if ( dina_opt( 'custom_post_thumb' ) ) {
        $width  = dina_opt( 'post_thumb_width' );
        $height = dina_opt( 'post_thumb_height' );
        add_image_size( 'dpost_thumbnail', $width, $height, true);
    }
}

//Rregister navigation menu
register_nav_menus( array(
    'mega_menu'   => __( 'Mega Menu', 'dina-kala' ),
    'header' => __( 'Header Menu', 'dina-kala' ),
) );

if ( dina_opt( 'replace_user_menu' ) ) {
    register_nav_menus( array(
        'user_menu'   => __( 'User Menu', 'dina-kala' ),
    ) );
}

if ( dina_opt( 'replace_mobile_menu' ) ) {
    register_nav_menus( array(
        'mobile_menu'   => __( 'Mobile Menu', 'dina-kala' ),
    ) );
}

//Redux Menu
if ( ! function_exists ( 'remove_redux_menu' ) ) {
    add_action( 'admin_menu', 'remove_redux_menu', 12);
    function remove_redux_menu()
    {
        remove_submenu_page( 'tools.php', 'redux-about' );
    }
}

//Redux Styles
add_action( 'admin_enqueue_scripts', 'redux_custom_styles' );
function redux_custom_styles( $page ) {
    wp_enqueue_style( 'redux-custom-style', DI_URI .'/includes/admin.css' );
}

//Add dashboard font
add_action( 'admin_init', 'dina_dashboard_font' );
function dina_dashboard_font() {
    wp_enqueue_style( 'dina-dashboard-font', DI_URI . '/css/'. dina_opt( 'theme_font' ) .'.css', array()  );
}

//Add dashboard font style
add_action( 'admin_head', 'dina_admin_head' );
function dina_admin_head()
{
    if ( ! dina_opt( 'change_dashboard_font' ) )
        return;
    ?>
    
    <style type="text/css">
        body.rtl #wpadminbar a,.rtl #wpadminbar,#wpadminbar,body{font-family:dana!important}
        .rtl #wpadminbar *{font-family:dana}
        h1,h2,h3,h4,h5,h6{font-family:dana-md!important}
    </style>
    <?php
}

//Fontawesome admin icons
add_action( 'admin_init', 'fa_dashboard' );
function fa_dashboard()
{
    wp_enqueue_style( 'fa_di_admin', DI_URI . '/css/fontawesome.min.css' );
    wp_enqueue_style( 'irico_di_admin', DI_URI . '/css/ir-icons.css' );
}

//Widget tag's number
add_filter( 'widget_tag_cloud_args', 'dina_tag_cloud_limit' );
function dina_tag_cloud_limit( $args) { 
    // Check if taxonomy option of the widget is set to tags
    if ( isset( $args['taxonomy'] ) ) {
        $args['number'] = dina_opt( 'tag_number' ); // Number of tags to show
        }
    return $args;
}

//Loads admin-side menu-icon scripts and styles
add_action( 'admin_enqueue_scripts', 'admin_menu_icon_styles' );
function admin_menu_icon_styles( $page)
{
if ( $page == 'nav-menus.php' )
    {
    wp_enqueue_style( 'select2', DI_URI . '/includes/select2.min.css' );
    wp_enqueue_style( 'menu-icon-admin-style', DI_URI . '/includes/menu-icon-admin.css' );
    wp_enqueue_script( 'my_s2', DI_URI . '/includes/select2.min.js' );
    wp_enqueue_script( 'my_s1', DI_URI . '/includes/select2.js' );
    }
}

//Pagination
function dina_pagination( $query = NULL, $format = NULL ) {

    global $wp_query;

    if ( $wp_query->max_num_pages <= 1 ) return;

    $query  = ! empty ( $query ) ? $query : $wp_query;
    $format = ! empty ( $format ) ? '?paged'. $format .'=%#%' : '?paged=%#%';

    $big = 999999999;

    $page_format = paginate_links(array(
        'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        'format'    => $format,
        'current'   => max( 1, get_query_var( 'paged' ) ),
        'total'     => $query->max_num_pages,
        'prev_text' => __( '<i class="fal fa-chevron-right" aria-hidden="true" title="Next"></i>', 'dina-kala' ),
        'next_text' => __( '<i class="fal fa-chevron-left" aria-hidden="true" title="Prev"></i>', 'dina-kala' ),
        'type'      => 'array'
    ) );

    if ( is_array( $page_format ) ) {
        $paged = ( get_query_var( 'paged' ) == 0 ) ? 1 : get_query_var( 'paged' );
        echo '<div class="col-12 pagination"><ul>';

        foreach ( $page_format as $page ) {
            $class = '';

            if ( strpos( $page, 'prev' ) !== false ) {
                $page = str_replace('<a', '<a rel="prev"', $page );
                $class = 'prev';
            } elseif ( strpos( $page, 'next' ) !== false ) {
                $page = str_replace( '<a', '<a rel="next"', $page );
                $class = 'next';
            } elseif ( strpos( $page, 'current' ) !== false ) {
                $class = 'active';
            }
            
            echo '<li>'. $page .'</li>';
        }

        echo '</ul></div>';
    }
}

function p_img() { 
   if ( has_post_thumbnail() ) {
        the_post_thumbnail( 'woocommerce_thumbnail', [ 'loading' => 'eager'] );
    } else {
        prod_default_thumb();
    }
}

function pr_img() { 
    global $product;

    if ( ! is_object( $product ) ) 
        return;
        
    $post_type = get_post_type( $product->get_id() );
    echo '<div class="img-con">';

        do_action( 'dina_before_shop_loop_item_img' );
        ?>
        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="product-link" target="<?php echo dina_link_target(); ?>">
        <?php

        if ( has_post_thumbnail() ) {
            the_post_thumbnail( 'woocommerce_thumbnail', [ 'loading' => 'eager'] );
        } elseif ( $post_type == 'product_variation' && ! has_post_thumbnail() ) {

            if ( has_post_thumbnail( $product->get_parent_id() ) ) {
                echo get_the_post_thumbnail( $product->get_parent_id(), 'woocommerce_thumbnail', ['loading' => 'eager'] );
            } else {
                prod_default_thumb();
            }
            
        } else {
            prod_default_thumb();
        }
        
        if ( dina_opt( 'show_sec_img' ) ) {
            
            $attachment_ids = $product->get_gallery_image_ids();
            if ( is_array( $attachment_ids ) && ! empty( $attachment_ids ) ) {
                $first_image_url = wp_get_attachment_image_src( $attachment_ids[0], 'woocommerce_thumbnail' );
                $width           = ( isset( $first_image_url[1] ) ? ' width="' . $first_image_url[1] . '"' : '' );
                $height          = ( isset( $first_image_url[2] ) ? ' height="' . $first_image_url[2] . '"' : '' );
                echo '<img'. $width . $height .' src="'. $first_image_url[0] .'" alt="'. get_the_title() .'" class="second-img wp-post-image" loading="eager">';
            }

        }
        ?>
        </a>
        <?php
        do_action( 'dina_after_shop_loop_item_img' );

    echo '</div>';
}

function po_img( $id = null ) { 
    ?>

    <div class="img-con">
        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="post-link" target="<?php echo dina_link_target(); ?>">
            <?php
            if ( has_post_thumbnail() ) {
                if ( dina_opt( 'custom_post_thumb' ) ) {
                    the_post_thumbnail( 'dpost_thumbnail', ['loading' => 'eager'] );
                } else {
                    the_post_thumbnail( 'woocommerce_thumbnail', ['loading' => 'eager'] );
                }
            } else { 
                prod_default_thumb();
            }
            ?>
        </a>

        <?php if ( dina_opt( 'show_post_cat' ) && ! empty ( $id ) ) {
                $post_categories = get_post_primary_category( $id, 'category' ); 
                $primary_category = $post_categories['primary_category']; ?>
                <span class="post-cat<?php echo dina_opt( 'post_cat_style' ) === 'second' ? ' post-cat-style-two' : ''; ?>">
                    <?php echo $primary_category->name; ?>
                </span>
        <?php } ?>

        <?php if ( dina_opt( 'show_post_pub' ) ) {

            if ( dina_opt( 'post_pub_style' ) === 'first' ) {
                echo '<span class="post-pub">';
                    echo get_jdate_publish_time();
                echo '</span>';
            } elseif ( dina_opt( 'post_pub_style' ) === 'second' ) {
                echo '<span class="post-pub-style-two">';
                    echo '<span class="post-pub-day">'. get_jdate_publish_time_two( 'j' ) .'</span>';
                    echo '<span class="post-pub-month">'. get_jdate_publish_time_two( 'F' ) .'</span>';
                    //echo '<span class="post-pub-year">'. get_jdate_publish_time_two( 'Y' ) .'</span>';
                echo '</span>';
            }
        } ?>
    </div>
<?php
}

//Product Default Thumb Image
function prod_default_thumb() {
    $thumb_width = ( ! empty ( dina_opt( 'prod_default_thumb', 'width' ) ) ) ? dina_opt( 'prod_default_thumb', 'width' ) : '150';
    $thumb_height = ( ! empty ( dina_opt( 'prod_default_thumb', 'height' ) ) ) ? dina_opt( 'prod_default_thumb', 'height' ) : '150';
    echo '<img src="'. dina_to_https( dina_opt( 'prod_default_thumb', 'url' ) ) .'" width="'. $thumb_width .'" height="'. $thumb_height .'" alt="'.the_title_attribute( 'echo=0' ).'" class="post-thumb" loading="eager">';
}

// Remove admin bar
add_action( 'after_setup_theme', 'dina_remove_admin_bar' );
function dina_remove_admin_bar() {
    if ( ! dina_opt( 'show_abar' ) )
        return;
    
    if ( ( current_user_can( 'edit_posts' ) && dina_opt( 'show_abar_editor' ) ) || ( current_user_can( 'administrator' ) && dina_opt( 'show_abar_admin' ) ) ) {
        add_filter( 'show_admin_bar', '__return_true' );
    } else {
        add_filter( 'show_admin_bar', '__return_false' );
    }
}

// dina_add_capabilities
add_action( 'init', 'dina_add_capabilities' );
function dina_add_capabilities() {
    
    if ( get_option( 'dina_capabilities_added' ) )
        return;

    $roles = ['subscriber', 'customer', 'seller'];
    $capabilities = ['view_ticket', 'create_ticket', 'close_ticket', 'reply_ticket', 'attach_files'];

    foreach ( $roles as $role_name ) {
        $role = get_role( $role_name );
        if ( $role ) {
            foreach ( $capabilities as $cap ) {
                $role->add_cap( $cap );
            }
        }
    }

    update_option( 'dina_capabilities_added', true );
}

add_filter( 'comment_form_fields', 'dina_move_comment_field_to_bottom' );
function dina_move_comment_field_to_bottom( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;
    return $fields;
}

function get_post_primary_category( $post_id, $term='category', $return_all_categories=false ) {
    $return = array();

    if ( class_exists( 'WPSEO_Primary_Term' ) ) {
        // Show Primary category by Yoast if it is enabled & set
        $wpseo_primary_term = new WPSEO_Primary_Term( $term, $post_id );
        $primary_term = get_term( $wpseo_primary_term->get_primary_term() );

        if ( ! is_wp_error( $primary_term) ) {
            $return['primary_category'] = $primary_term;
        }
    }

    if (empty( $return['primary_category'] ) || $return_all_categories) {
        $categories_list = get_the_terms( $post_id, $term);

        if (empty( $return['primary_category'] ) && ! empty( $categories_list) ) {
            $return['primary_category'] = $categories_list[0];  //get the first category
        }
        if ( $return_all_categories) {
            $return['all_categories'] = array();

            if ( ! empty( $categories_list) ) {
                foreach( $categories_list as &$category) {
                    $return['all_categories'][] = $category->term_id;
                }
            }
        }
    }
    return $return;
}

//get_jdate_publish_time
function get_jdate_publish_time() {

	$greg_date = get_post_time( 'j F Y' );
    $timestamp = strtotime( $greg_date );
    $lang = get_bloginfo("language"); 

    if ( $lang != 'fa-IR' ) {
        echo $greg_date;
    } elseif ( defined( 'PW_VERSION' ) && PW_VERSION >= '4.0.0' ) {
        echo get_the_date( 'j F Y' );
    } elseif ( function_exists( 'jdate' ) ) {
		echo jdate( 'j F Y', $timestamp);
	} elseif ( function_exists( 'parsidate' ) ) {
        echo parsidate( 'j F Y', $timestamp);
    } elseif ( function_exists( 'wpp_jdate' ) ) {
        echo wpp_jdate( 'j F Y', $timestamp);
    } elseif ( function_exists( 'wp_date' ) ) {
        echo wp_date( 'j F Y', $timestamp);
    } else {
		echo $greg_date;
	}
}

//get_jdate_publish_time_two
function get_jdate_publish_time_two( $arg ) {

    if ( empty ( $arg ) )
        return;

	$greg_date = get_post_time( $arg );
    $timestamp = strtotime( $greg_date );
    $lang = get_bloginfo("language");

    if ( $lang != 'fa-IR' ) {
        $date = $greg_date;
    } elseif ( defined( 'PW_VERSION' ) && PW_VERSION >= '4.0.0' ) {
        $date = get_the_date( $arg );
    } elseif ( function_exists( 'jdate' ) ) {
		$date = jdate( $arg, $timestamp );
	} elseif ( function_exists( 'parsidate' ) ) {
        $date = parsidate( $arg, $timestamp );
    } elseif ( function_exists( 'wpp_jdate' ) ) {
        $date = wpp_jdate( $arg, $timestamp );
    } elseif ( function_exists( 'wp_date' ) ) {
        $date = wp_date( $arg, $timestamp );
    } else {
		$date = $greg_date;
	}

    return $date;
}

function dina_get_modified_date() {
    $lang = get_bloginfo("language"); 
    return ( $lang == 'fa-IR' ? get_the_modified_time( 'j F Y' ) : get_post_modified_time( 'j F Y' ) );
}

//Check site direction is RTL
function dina_rtl() {
    if ( is_rtl() ) {
        return 'true';
    } else {
        return 'false';
    }
}

//Check site direction
function dina_dir() {
    if ( is_rtl() ) {
        echo 'rtl';
    } else {
        echo 'ltr';
    }
}

//dina_custom_excerpt_length
add_filter( 'excerpt_length', 'dina_custom_excerpt_length', 999 );
function dina_custom_excerpt_length( $length ) {
    return 20;
}

//dina_remove_brackets_excerpt
add_filter( 'excerpt_more', 'dina_custom_excerpt_more' );
function dina_custom_excerpt_more( $excerpt ) {
    return ' ...';
}

//Dina remove dashes
function dina_remove_dash( $input) {
    $output = preg_replace("/[^A-Za-z0-9]/", "", $input);
    return $output;
}

//Dina Header Banner
function dina_header_banner() {

    if ( ! empty( dina_to_https( dina_opt( 'head_banner', 'url' ) ) ) ) { ?>

    <div class="row head-banner-row<?php if ( ! dina_opt( 'show_head_mobile' ) ) { echo ' mobile-hidden'; }?>">
        <div class="col-12 bnr-image shadow-box">
            <?php
            $link_target = dina_opt( 'head_banner_newtab' ) ? ' target="_blank"' : '';
            $link_rel = dina_opt( 'head_banner_nofollow' ) ? ' rel="nofollow"' : '';
            ?>
            <a href="<?php echo dina_opt( 'head_banner_link' ); ?>" title="<?php echo dina_opt( 'head_banner_title' ); ?>" aria-label="<?php echo dina_opt( 'head_banner_title' ); ?>"<?php echo $link_target . $link_rel; ?>>
                <?php
                    $headb_width = ( ! empty ( dina_opt( 'head_banner', 'width' ) ) ) ? dina_opt( 'head_banner', 'width' ) : '1260';
                    $headb_height = ( ! empty ( dina_opt( 'head_banner', 'height' ) ) ) ? dina_opt( 'head_banner', 'height' ) : '142'; 
                ?>

                <picture>
                    <?php if ( ! empty( dina_opt( 'head_banner_mobile', 'url' ) ) ) { ?>
                        <source media="(max-width: 768px)" srcset="<?php echo dina_to_https( dina_opt( 'head_banner_mobile', 'url' ) ); ?>">
                    <?php } ?>
                    <img src="<?php echo dina_to_https( dina_opt( 'head_banner', 'url' ) ); ?>"
                    alt="<?php echo dina_opt( 'head_banner_title' ); ?>"
                    class="head-banner shadow-box"
                    width="<?php echo $headb_width; ?>"
                    height="<?php echo $headb_height; ?>" />
                </picture>
            </a>
        </div>
    </div>

<?php
    }
}

//Dina archive header banner
function dina_archive_header_banner() {
    if ( is_archive() ) {
        $term_id           = get_queried_object_id();
        $code_banner       = get_term_meta( $term_id, 'dina_archive_ads_code', true );
        $archive_ads_code_text = get_term_meta( $term_id, 'dina_archive_ads_code_text', true );
        if ( ! empty ( $archive_ads_code_text ) ) {
        ?>
            <div class="row head-banner-row head-banner-row-archive">
                <div class="col-12 dina-code-banner">
                    <?= do_shortcode( $archive_ads_code_text ) ?>
                </div>
            </div>
        <?php
        }
        $archive_ads_image        = get_term_meta( $term_id, 'dina_archive_ads_image', true );
        $archive_ads_image_mobile = get_term_meta( $term_id, 'dina_archive_ads_image_mobile', true );
        if ( ! empty ( $archive_ads_image ) ) {
            $image_id = attachment_url_to_postid( esc_url( $archive_ads_image ) );
            $image_attributes = wp_get_attachment_image_src( $image_id, 'full' );
            $archive_ads_title = get_term_meta( $term_id, 'dina_archive_ads_title', true );
            $archive_ads_link = get_term_meta( $term_id, 'dina_archive_ads_link', true );
            ?>
            <div class="row head-banner-row head-banner-row-archive">
                <div class="col-12 bnr-image shadow-box">
                    <a href="<?php echo $archive_ads_link; ?>" title="<?php echo $archive_ads_title; ?>" aria-label="<?php echo $archive_ads_title; ?>">
                        <?php 
                            $width  = ( isset( $image_attributes[1] ) ? ' width="' . $image_attributes[1] . '"' : '' );
                            $height = ( isset( $image_attributes[2] ) ? ' height="' . $image_attributes[2] . '"' : '' );
                        ?>
                        <picture>
                        <?php if ( ! empty( $archive_ads_image_mobile ) ) { ?>
                            <source media="(max-width: 768px)" srcset="<?php echo dina_to_https( esc_url( $archive_ads_image_mobile ) ); ?>">
                        <?php } ?>
                        <img src="<?php echo dina_to_https( esc_url( $archive_ads_image ) ); ?>" alt="<?php echo $archive_ads_title; ?>" class="head-banner shadow-box"<?php echo $width . $height; ?> />
                        </picture>
                    </a>
                </div>
            </div>
        <?php    
        }
    }
}

//Run Shortcodes in the_excerpt
add_filter( 'the_excerpt', 'shortcode_unautop' );
add_filter( 'the_excerpt', 'do_shortcode' );
add_filter( 'get_the_excerpt', 'do_shortcode' );
add_filter( 'get_the_excerpt', 'shortcode_unautop' );

/* Convert hexdec color string to rgb(a) string */
function hex2rgba( $hex, $alpha = '' ) {
    $hex = str_replace( "#", "", $hex );
    if ( strlen( $hex ) == 3 ) {
        $r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
        $g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
        $b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
    } else {
        $r = hexdec( substr( $hex, 0, 2 ) );
        $g = hexdec( substr( $hex, 2, 2 ) );
        $b = hexdec( substr( $hex, 4, 2 ) );
    }
    $rgb = $r . ',' . $g . ',' . $b;

    if ( '' == $alpha ) {
        return $rgb;
    } else {
        $alpha = floatval( $alpha );

        return 'rgba( ' . $rgb . ',' . $alpha . ' )';
    }
}

// Add Body Classes
add_filter( 'body_class', 'dina_body_class' );
function dina_body_class( $classes ) {
    // Check RTL Or LTR
    $classes[] = ( is_rtl() ? 'rtl' : 'ltr' );
    // Add body class for dark mode
    if ( dina_opt( 'dina_dark_mode_default' ) ) {
        $classes[] = 'dina-dark';
    } else {
        $classes[] = 'dina-light';
    }
    // Add body class for dark mode adapting
    if ( dina_opt( 'dina_dark_mode_adapting' ) ) {
        $classes[] = 'dina-dark-os';
    }
    // Add body class for dark mode theme
    $classes[] = ( dina_opt( 'dina_dark_theme' ) == 'dark-second-style' ? 'dark-second-style' : 'dark-first-style' );
    // Add body class for mobile bar
    $classes[] = ( dina_opt( 'hide_mobile_bar' ) ? 'no-bbar' : '' );
    // Add body class for category widget
    $classes[] = ( dina_opt( 'open_cat_widget' ) ? 'dina-open-cat' : '' );
    // Add body class for category widget
    $classes[] = ( ! dina_opt( 'rounded_corners' ) ? 'dina-not-rounded' : '' );
    // Add body class for fit elementor header width
    $classes[] = ( dina_opt( 'elementor_fit_header' ) ? 'dina-fit-header' : '' );
    // Add body class for fit elementor footer width
    $classes[] = ( dina_opt( 'elementor_fit_footer' ) ? 'dina-fit-footer' : '' );
    // Add body class for closed filters
    $classes[] = ( is_post_type_archive( 'product' ) && dina_opt( 'show_filters_closed' ) ? ' dina-filters-closed' : '' );
 
    return $classes;
}

// Get YITH Wishlist product's count
if ( defined( 'YITH_WCWL' ) && ! function_exists( 'yith_wcwl_get_items_count' ) ) {
    function yith_wcwl_get_items_count() {
      ob_start();
        echo esc_html( yith_wcwl_count_all_products() );
      return ob_get_clean();
    }
  
    add_shortcode( 'yith_wcwl_items_count', 'yith_wcwl_get_items_count' );
  }
  
  if ( defined( 'YITH_WCWL' ) && ! function_exists( 'yith_wcwl_ajax_update_count' ) ) {
    function yith_wcwl_ajax_update_count() {
      wp_send_json( array(
        'count' => yith_wcwl_count_all_products()
      ) );
    }
  
    add_action( 'wp_ajax_yith_wcwl_update_wishlist_count', 'yith_wcwl_ajax_update_count' );
    add_action( 'wp_ajax_nopriv_yith_wcwl_update_wishlist_count', 'yith_wcwl_ajax_update_count' );
  }
  
  if ( defined( 'YITH_WCWL' ) && ! function_exists( 'yith_wcwl_enqueue_custom_script' ) ) {
    function yith_wcwl_enqueue_custom_script() {
      wp_add_inline_script(
        'jquery-yith-wcwl',
        "
          jQuery( function( $ ) {
            $( document ).on( 'added_to_wishlist removed_from_wishlist', function() {
              $.get( yith_wcwl_l10n.ajax_url, {
                action: 'yith_wcwl_update_wishlist_count'
              }, function( data ) {
                $( '.dina-yith-wcwl-btn .wish-amount' ).html( data.count );
              } );
            } );
          } );
        "
      );
    }
  
    add_action( 'wp_enqueue_scripts', 'yith_wcwl_enqueue_custom_script', 20 );
}

//Dina Download Box
function dina_dl_box( $post_id) {

    $dlbox_title = get_post_meta( $post_id, 'dina_dlbox_title', true );
    $dlbox_size  = get_post_meta( $post_id, 'dina_dlbox_size', true );
    $dlbox_pass  = get_post_meta( $post_id, 'dina_dlbox_pass', true );
    $dlbox_files = get_post_meta( $post_id, 'dina_dlbox_files', true );

    ob_start();
    ?>

    <div class="dlbox">
        <div class="dltitle">
            <i class="fal fa-cloud-download"></i><?php echo $dlbox_title; ?>
        </div>

        <?php if ( ! is_user_logged_in() && dina_opt( 'dl_box_login' ) ) {
            if ( function_exists( 'digits_version' ) && dina_opt( 'digits_mode' ) ) {
                $digits_mode = ( dina_opt( 'digits_page' ) ? 'digitsbtn digitlink' : 'digitsbtn digitpopup' );
                $login_msg   = '<span class="dina-dl-login-links btn btn-outline-dina '. $digits_mode .'">'.__( 'Login or register to view links', 'dina-kala' ).'</span>';
            } else {
                $login_link  = ( dina_opt( 'ch_login_link' ) ? 'href="'. dina_opt( 'login_link' ) .'"' : 'rel="nofollow" href="javascript:void(0)" onclick="openLogin()"' );
                $login_msg   = '<a title="'. __( 'Login Or Register', 'dina-kala' ) .'" '. $login_link .'>';
                $login_msg  .= '<span class="dina-dl-login-links btn btn-outline-dina"><i class="fal fa-lock btn-icon" aria-hidden="true"></i>'.__( 'Login or register to view links', 'dina-kala' ).'</span>';
                $login_msg  .= '</a>';
            }
            echo '<div class="dlbox-links">';
            echo $login_msg;
            echo '</div>';

         } else { ?>

        <div class="dlbox-links">
            <?php 
            if ( ! empty( $dlbox_files ) ) {
                foreach ( (array) $dlbox_files as $key => $file ) {
                    if ( isset( $file['dina_dlbox_subtitle'] ) && $file['dina_dlbox_subtitle'] ) {
                        $file_name = esc_html( $file['dina_dlbox_file'] );
                        if ( ! empty( $file_name) ) {
                            echo '<div class="plain">'.$file_name.'</div>';
                        }
                    } else {
                        $file_name = esc_html( $file['dina_dlbox_file'] );
                        $file_link = esc_html( $file['dina_dlbox_link'] ); 
                        if ( ! empty( $file_name) && ! empty( $file_link ) ) {
                            echo '<a href="'. $file_link .'" title="'. $file_name .'" class="flink"><i class="fal fa-download"></i>'. $file_name .'</a>';
                        }
                    }
                }
            } ?>
        </div>

        <?php } ?>

        <div class="row fdet">

            <?php if ( ! empty ( $dlbox_size ) ) { ?>
            <div class="col-md-4 sdet">
                <i class="fal fa-save"></i>
                <span aria-hidden="true">
                    <?php _e( 'File size:', 'dina-kala' ); ?>
                    <?php echo $dlbox_size; ?>
                </span>
            </div>
            <?php } ?>

            <?php if ( ! empty ( $dlbox_pass ) ) { ?>
            <div class="col-md-4 sdet">
                <i class="fal fa-lock"></i>
                <span aria-hidden="true">
                <?php _e( 'Password:', 'dina-kala' ); ?>
                <?php echo $dlbox_pass; ?>
                </span>
            </div>
            <?php } ?>

            <?php if ( ! empty ( dina_opt( 'dl_guide_text' ) ) ) { ?>
            <div class="col-md-4 sdet">
                <span class="dhelp" data-toggle="modal" data-target="#dhelp">
                    <i class="fal fa-question-circle"></i>
                    <span aria-hidden="true">
                        <?php _e( 'Download guide', 'dina-kala' ); ?>
                    </span>
                </span>
            </div>
            <?php } ?>

        </div>

        <?php if ( ! empty( dina_opt( 'dl_guide_text' ) ) ) { ?>
        <!-- Dl-Box Help Modal -->
        <div class="modal fade dhelp-modal" id="dhelp">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">
                    <i class="fal fa-question-circle"></i>
                    <?php echo dina_opt( 'dl_guide_title' ); ?>
                </div>
                <button type="button" class="close" data-dismiss="modal">
                    <i class="fal fa-times" aria-hidden="true"></i>
                </button>
            </div>
            <div class="modal-body">
                <?php echo dina_opt( 'dl_guide_text' ); ?>
            </div>
            </div>
        </div>
        </div>
        <!-- Dl-Box Help Modal -->
        <?php } ?>

    </div>
<?php 
    $dl_box = ob_get_clean();
    return $dl_box;
}

//DinaKala Search form
function di_search_form( $class, $id, $ajax ) {
    if ( dina_opt( 'replace_search_shortcode' ) ) {
        echo do_shortcode( dina_opt( 'search_shortcode' ) );
    } else {
?>
    <form class="<?php echo $class; ?> dina-search-bar" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <?php if ( ! dina_opt( 'search_others' ) ) { ?>
            <input type="hidden" name="post_type" value="product" />
        <?php } ?>
        <div class="input-group search-form dina-ajax-search-wrapper">
            <?php 

            if ( class_exists( 'WooCommerce' ) && dina_opt( 'search_cat' ) ) {
                
                $get_terms_args = array(
                    'taxonomy'   => 'product_cat',
                    'hide_empty' => true,
                    'orderby'    => 'name',
                    'order'      => 'ASC',
                    'parent'     => 0,
                    'exclude'    => ! empty ( dina_opt( 'search_cat_cats' ) ) ? dina_opt( 'search_cat_cats' ) : array(),
                    'number'     => 1
                );

                $categories_exist = get_terms( $get_terms_args );

                if ( ! is_wp_error( $categories_exist ) && ! empty( $categories_exist ) ) {
                    $dropdown_args = array(
                        'taxonomy'        => 'product_cat',
                        'hide_empty'      => true,
                        'show_count'      => 0,
                        'id'              => $id,
                        'show_option_all' => __( 'Category', 'dina-kala' ),
                        'value_field'     => 'slug',
                        'name'            => 'product_cat',
                        'class'           => 'product_cat',
                        'echo'            => 0
                    );

                    if ( dina_opt( 'search_cat_sort' ) ) {
                        $dropdown_args['orderby'] = 'name';
                        $dropdown_args['order']   = 'ASC';
                    }

                    if ( dina_opt( 'search_cat_parent' ) ) {
                        $dropdown_args['parent'] = 0;
                    }

                    if ( ! empty ( dina_opt( 'search_cat_cats' ) ) ) {
                        $dropdown_args['exclude'] = dina_opt( 'search_cat_cats' );
                    }

                    if ( dina_opt( 'search_cat_hierarchical' ) ) {
                        $dropdown_args['hierarchical'] = 1;
                    }

                    $categories = wp_dropdown_categories( $dropdown_args );
                    ?>
                    <div class="input-group-before prod-cat">
                        <?= $categories ?>
                    </div>
                    <?php
                }
            } ?>

            <?php $placeholder = dina_opt( 'search_others' ) ? __( 'Search...', 'dina-kala' ) : __( 'Search Products...', 'dina-kala' ) ?>
            <input autocomplete="off"<?php if ( $ajax ) { echo ' data-swplive="true"'; } ?> name="s" type="text" class="form-control search-input" placeholder="<?= $placeholder ?>" aria-label="<?php _e("Search", 'dina-kala' ); ?>" required>
            <div class="input-group-append">
                <button class="btn btn-search" type="submit" aria-label="<?php _e("Search", 'dina-kala' ); ?>">
                    <i class="fal fa-search" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </form>
<?php
    }
}

//Change wordpress login logo
if ( dina_opt( 'login_logo_switch' ) ) {
    add_action( 'login_head', 'dina_wp_login_logo' );
}
function dina_wp_login_logo() {
    echo '<style type="text/css">
    h1 a {background-image: url( '. dina_to_https( dina_opt( 'site_logo_retina', 'url' ) ) .' ) !important;
    width: 320px!important;
    height: 114px!important;
    background-size: contain!important;
    margin-bottom: 0px!important;
    }
    </style>';
}

//Change wordpress login logo link
add_filter( 'login_headerurl', 'dina_login_headerurl', 10, 2 );
function dina_login_headerurl() {
    return esc_url( home_url() );
}

//Remove wallet checkout styles
add_action( 'wp_enqueue_scripts', 'remove_wallet_stylesheet', 22 );
function remove_wallet_stylesheet() {
    if ( ! class_exists( 'WooCommerce' ) ) 
        return;
    if ( is_checkout() ) {
        wp_deregister_script( 'jquery-ui-tooltip' );
        wp_dequeue_script( 'jquery-ui-tooltip' );
        wp_deregister_style( 'woo-wallet-payment-jquery-ui' );
        wp_dequeue_style( 'woo-wallet-payment-jquery-ui' );
    }
}

add_action( 'admin_enqueue_scripts', 'dina_remove_googleapis', 999 );
function dina_remove_googleapis() {
    wp_deregister_style( 'elementor-admin-top-bar-fonts' );
    wp_dequeue_style( 'elementor-admin-top-bar-fonts' );
}

//dina_adjustBrightness
if ( ! function_exists( 'dina_adjustBrightness' ) ) {
    function dina_adjustBrightness( $hexCode, $adjustPercent ) {
        $hexCode = ltrim( $hexCode, '#' );
    
        if ( strlen( $hexCode ) == 3 ) {
            $hexCode = $hexCode[0] . $hexCode[0] . $hexCode[1] . $hexCode[1] . $hexCode[2] . $hexCode[2];
        }
    
        $hexCode = array_map( 'hexdec', str_split( $hexCode, 2 ) );
    
        foreach ( $hexCode as & $color ) {
            $adjustableLimit = $adjustPercent < 0 ? $color : 255 - $color;
            $adjustAmount = ceil( $adjustableLimit * $adjustPercent );
    
            $color = str_pad( dechex( $color + $adjustAmount ), 2, '0', STR_PAD_LEFT );
        }
    
        return '#' . implode( $hexCode );
    }
}

//Dina Replace Http to Https
function dina_to_https( $url ) {
    if ( is_ssl() ) {
        $url = str_replace( "http://", "https://", $url );
    }
    return $url;
}

//Remove Woo_Variation_Swatches actions
if ( ! class_exists( 'Woo_Variation_Swatches_Pro' ) ) {
	remove_filter( 'woocommerce_product_data_tabs', 'add_wvs_pro_preview_tab' );
	remove_filter( 'woocommerce_product_data_panels', 'add_wvs_pro_preview_tab_panel' );
}
if ( class_exists( 'Woo_Variation_Swatches' ) ) {
    remove_filter( 'pre_update_option_woocommerce_thumbnail_image_width', 'wvs_clear_transient' );
    remove_filter( 'pre_update_option_woocommerce_thumbnail_cropping', 'wvs_clear_transient' );
}

//Dina archive description
function dina_archive_description() {

    global $wp_query;

    if ( is_search() )
        return;

    if ( dina_opt( 'show_first_text_cat' ) && $wp_query->get( 'paged' ) > 1 )
        return;

    $cat_full = ( ! dina_opt( 'show_full_text_cat' ) ? ' class="cat-text dina-more-less" data-more="'. __( 'Show More', 'dina-kala' ) .'" data-less="'. __( 'Show Less', 'dina-kala' ) .'"' : '' );
    if ( class_exists( 'WooCommerce' ) && is_shop() ) { 
        $shop_page = get_post( wc_get_page_id( 'shop' ) );
        $allowed_html = wp_kses_allowed_html( 'post' );
        // This is needed for the search product block to work.
			$allowed_html = array_merge(
				$allowed_html,
				array(
					'form'   => array(
						'action'         => true,
						'accept'         => true,
						'accept-charset' => true,
						'enctype'        => true,
						'method'         => true,
						'name'           => true,
						'target'         => true,
					),

					'input'  => array(
						'type'        => true,
						'id'          => true,
						'class'       => true,
						'placeholder' => true,
						'name'        => true,
						'value'       => true,
					),

					'button' => array(
						'type'  => true,
						'class' => true,
						'label' => true,
					),

					'svg'    => array(
						'hidden'    => true,
						'role'      => true,
						'focusable' => true,
						'xmlns'     => true,
						'width'     => true,
						'height'    => true,
						'viewbox'   => true,
					),
					'path'   => array(
						'd' => true,
					),
				)
			);
            if ( ! empty ( $shop_page->post_content ) ) {
                echo '<div class="shadow-box cat-desc col-12">
                <div'. $cat_full .'><div class="dina-more-less-content">'. wc_format_content( wp_kses( $shop_page->post_content, $allowed_html ) ) .'</div></div>
                </div>';
            }
    } else {
        the_archive_description( '<div class="shadow-box cat-desc col-12">
        <div'. $cat_full .'><div class="dina-more-less-content">','</div></div>
        </div>' );
    }
    
}

//Get logo Link
function dina_logo_link() {

    $logo_link = '';

    if ( ! dina_opt( 'change_logo_link' ) ) {
        $logo_link = esc_url( home_url() );
    } else {
        $logo_link = esc_url( dina_opt( 'logo_link' ) );
    }

    return $logo_link;
}

//Get Woocomemrce MyAccount Link
function dina_myaccount_link() {
    return class_exists( 'WooCommerce' ) ? wc_get_page_permalink( 'myaccount' ) : '#';
}

//Dina Check Sidebar
function dina_check_side() {
    $post_id = get_the_ID();
    $side = 0;
    $pside = get_post_meta( $post_id, 'dina_pside', true );
    $postside = get_post_meta( $post_id, 'dina_postside', true );
    $pageside = get_post_meta( $post_id, 'dina_pageside', true );
    $ticket_page = 0;
    $aff_page = 0;
    $dokan_page = 0;
    if ( class_exists( 'WooCommerce' ) && class_exists( 'WeDevs_Dokan' ) ) {
        if ( $post_id === dokan_get_option( 'dashboard', 'dokan_pages' ) ) {
            $dokan_page = 1;
        } 
    }
    if ( class_exists( 'Awesome_Support' ) ) { 
        $ticket_id = wpas_get_option( 'ticket_list' );
        $ticket_submit_id = wpas_get_option( 'ticket_submit' );
        if (is_array( $ticket_submit_id) ) {
            $ticket_submit = $ticket_submit_id[0];
        }
        else{
            $ticket_submit = $ticket_submit_id;
        }
        if ( ( $post_id === (int)$ticket_id) || ( $post_id === (int)$ticket_submit) ) {
            $ticket_page = 1; 
        } 
    }
    if ( class_exists( 'Affiliate_WP' ) ) {
        if ( $post_id === affwp_get_affiliate_area_page_id() ) {
            $aff_page = 1;
        }
    }
    if ( class_exists( 'YITH_WCAF' ) ) {
        if ( $post_id === (int)get_option( 'yith_wcaf_dashboard_page_id' ) ) {
            $aff_page = 1;
        }
    }

    if ( ( class_exists( 'WooCommerce' ) && is_woocommerce() && is_archive() ) && dina_opt( 'product_archive_side' ) != 0 ) {
        $side = 2;
    } elseif ( ( class_exists( 'WooCommerce' ) && is_woocommerce() && is_archive() ) && dina_opt( 'product_archive_side' ) == 0) {
        $side = 0;
    } elseif ( is_page_template() || ( class_exists( 'WooCommerce' ) && is_account_page() ) || $dokan_page == 1 || $aff_page == 1 || $ticket_page == 1) {
        $side = 0;
    } elseif ( is_single() && 'post' == get_post_type() && $postside != 'wside' ) {
        $side = 1;
    } elseif ( is_single() && 'product' == get_post_type() && $pside != 'wside' ) {
        if ( ( $pside == 'rside' || $pside == 'lside' ) && $pside != 'wside' ) {
            $side = 1;
        } elseif ( dina_opt( 'product_side' ) > 0 && $pside != 'wside' ) {
            $side = 1;
        }
    } elseif ( dina_is_blog() ) {
        $side = 1;
    } elseif ( is_page() && ( $pageside != 'rside' && $pageside != 'lside' ) && dina_opt( 'page_side' ) == 0 ) {
        $side = 0;
    } elseif ( ( is_page() && $pageside != 'wside' ) || ( is_front_page() && $pageside != 'wside' ) ) {
        $side = 1;
    } elseif ( is_archive() && dina_opt( 'post_archive_side' ) != 0 ) {
        $side = 1;
    }
    return $side;
}

//Get terms link
function dina_get_term_links( $term_tax, $term_ids ) {
    
    if ( is_array( $term_ids ) ) {	
        $term_tax_link = ( $term_tax == 'category' ? 'cat' : $term_tax );
        $term_tax_link = ( $term_tax == 'post_tag' ? 'tag' : $term_tax );
        if ( count( $term_ids ) == 1 ) {
            $term_link = get_term_link( (int)$term_ids[0], $term_tax );
        } else {
            $term_link = get_home_url() . '/?' .$term_tax_link.'=';
            foreach( $term_ids as $id ) {
                if ( term_exists( (int)$id ) ) {
                    $term       = get_term( (int)$id, $term_tax );
                    $slug       = $term->slug;
                    $term_link .= $slug . ',';
                }
            }
        }
    } else {
		$term_link = get_term_link( (int)$term_ids, $term_tax );
    }
    return $term_link;
}

//Disable RSS Feeds in WordPress
function dina_disable_feed() {
    $site_url = get_bloginfo( 'url' );
    wp_die( sprintf( __( 'No feed available,please visit our <a href="%s">homepage</a>!', 'dina-kala' ), $site_url ) );
}
     
if ( dina_opt( 'dis_rss_feeds' ) ) {
    add_action( 'do_feed', 'dina_disable_feed', 1);
    add_action( 'do_feed_rdf', 'dina_disable_feed', 1);
    add_action( 'do_feed_rss', 'dina_disable_feed', 1);
    add_action( 'do_feed_rss2', 'dina_disable_feed', 1);
    add_action( 'do_feed_atom', 'dina_disable_feed', 1);
    add_action( 'do_feed_rss2_comments', 'dina_disable_feed', 1);
    add_action( 'do_feed_atom_comments', 'dina_disable_feed', 1);
    remove_action( 'wp_head', 'feed_links_extra', 3 );
    remove_action( 'wp_head', 'feed_links', 2 );
}

//Function to set custom 404 page
if ( ! function_exists( 'dina_custom_404_page' ) ) {
	function dina_custom_404_page( $template ) {
		global $wp_query;
		$custom_404 = dina_opt( 'custom_404_page' );
		if ( $custom_404 == 'default' || empty( $custom_404 )  ) return $template;

		$wp_query->query( 'page_id=' . $custom_404 );
		$wp_query->the_post();
		$template = get_page_template();
		rewind_posts();

		return $template;
	}
    add_filter( '404_template', 'dina_custom_404_page', 999 );
}

//dina_breadcrumb
if ( ! function_exists( 'dina_breadcrumb' ) ) {
    function dina_breadcrumb() {

        do_action( 'dina_before_breadcrumb' );

        if ( ! dina_opt( 'show_bread' ) )
            return;

        if ( function_exists( 'yoast_breadcrumb' ) ) {
            $breadcrumbs_enabled = WPSEO_Options::get( 'breadcrumbs-enable', false );
        }

        if ( dina_opt( 'bread_crumbs_sync' ) && function_exists( 'yoast_breadcrumb' ) && $breadcrumbs_enabled ) {
            yoast_breadcrumb( '<div class="row bread-row"><nav class="col-12 shadow-box breadcrumbs">','</nav></div>' );
        } elseif ( dina_opt( 'bread_crumbs_sync' ) && function_exists( 'rank_math_the_breadcrumbs' ) ) {
            echo '<div class="row bread-row"><nav class="col-12 shadow-box breadcrumbs">';
            rank_math_the_breadcrumbs();
            echo '</nav></div>';
        } elseif ( class_exists( 'WooCommerce' ) ) {
            woocommerce_breadcrumb();
        }

        do_action( 'dina_after_breadcrumb' );
    }
}

//Allowed mime types and file extensions 
add_filter( 'upload_mimes', 'dina_add_fonts_to_allowed_mimes' );
function dina_add_fonts_to_allowed_mimes( $mimes ) {
    $mimes['woff']  = 'application/x-font-woff';
    $mimes['woff2'] = 'application/x-font-woff2';
    $mimes['ttf']   = 'application/x-font-ttf';
    $mimes['svg']   = 'image/svg+xml';
    $mimes['eot']   = 'application/vnd.ms-fontobject';
    $mimes['otf']   = 'font/otf';

    return $mimes;
}

//Correct the mome types and extension for the font types.
add_filter( 'wp_check_filetype_and_ext', 'dina_update_mime_types', 10, 3 );
function dina_update_mime_types( $defaults, $file, $filename ) {
    if ( 'ttf' === pathinfo( $filename, PATHINFO_EXTENSION ) ) {
        $defaults['type'] = 'application/x-font-ttf';
        $defaults['ext']  = 'ttf';
    }

    if ( 'otf' === pathinfo( $filename, PATHINFO_EXTENSION ) ) {
        $defaults['type'] = 'application/x-font-otf';
        $defaults['ext']  = 'otf';
    }

    return $defaults;
}

//Disable the gutenberg block editor
if ( dina_opt( 'dis_widget_editor' ) ) {
    // Disables the block editor from managing widgets in the Gutenberg plugin.
    add_filter( 'gutenberg_use_widgets_block_editor', '__return_false' );
    // Disables the block editor from managing widgets.
    add_filter( 'use_widgets_block_editor', '__return_false' );
}

//dina_is_blog
function dina_is_blog() {
    if ( ! is_front_page() && is_home() ) {  
        return true;
    } else {
        return false;
    }
}

//dina_add_site_favicon_admin
function dina_add_site_favicon_admin() {
	echo '<link rel="shortcut icon" href="'. dina_to_https( dina_opt( 'site_favicon', 'url' ) ) .'" type="image/x-icon" />';
}
add_action( 'login_head', 'dina_add_site_favicon_admin' );
add_action( 'admin_head', 'dina_add_site_favicon_admin' );

//dina_link_target
function dina_link_target() {
    return ( dina_opt( 'open_prod_new_tab' ) ? '_blank' : '_self' );
}

//dina_perc_of_num
function dina_perc_of_num( $num1, $num2, $round = false ) {

    $division = $num1 / $num2;

    $result = $division * 100;

    if ( $round == true ) {
        return round ( $result );
    } else {
        return $result;
    }
    
}

function dina_page_loading() {
    if ( ! dina_opt( 'show_page_loading' ) )
        return;
    
    if ( dina_opt( 'show_custom_loading' ) && ! empty ( dina_opt( 'custom_loading_image', 'url' ) ) ) {
        echo '<div class="se-pre-con"></div>';
    } elseif ( ! empty ( dina_opt( 'load_img' ) ) ) {
        echo '<div class="se-pre-con"></div>';
    } else {
        return;
    }
}

//dina_modify_nav_menu_item_title
add_filter( "nav_menu_item_title", "dina_modify_nav_menu_item_title", 10, 4 );
function dina_modify_nav_menu_item_title( $title, $menu_item, $args, $depth) { 

    $item_icon = "";
    if ( ! empty( $menu_item->icon_image) ) {
        $item_icon = '<img src="'.$menu_item->icon_image.'" width="22" height="22" alt="'.$title.'" class="cu-menu-icon">';
    } elseif ( ! empty( $menu_item->icon ) && $menu_item->icon != 'none' ) {
        $item_icon = '<i class="'.$menu_item->icon.'"></i>';
    }

    $item_dlabel = "";
    if ( ! empty( $menu_item->dlabel ) ) {
        $item_dlabel = '<span class="dmenu_label">'.$menu_item->dlabel.'</span>';
    }

    return $item_icon . $title . $item_dlabel; 
}

//dina_locked_content
function dina_locked_content() {
    if ( function_exists( 'digits_version' ) && dina_opt( 'digits_mode' ) ) {
        $digits_mode = ( dina_opt( 'digits_page' ) ? 'digitsbtn digitlink' : 'digitsbtn digitpopup' );
        $login_msg   = '<span class="'. $digits_mode .'">'.__( 'You must be logged in to view content.', 'dina-kala' ).'</span>';
    } else {
        $login_link  = ( dina_opt( 'ch_login_link' ) ? 'href="'. dina_opt( 'login_link' ) .'"' : 'rel="nofollow" href="javascript:void(0)" onclick="openLogin()"' );
        $login_msg   = '<a title="'. __( 'Login Or Register', 'dina-kala' ) .'" class="login-price-link" '. $login_link .'>';
        $login_msg  .= '<span>'.__( 'You must be logged in to view content.', 'dina-kala' ).'</span>';
        $login_msg  .= '</a>';
    } ?>
    <div class="dina-locked-content">
        <i class="fal fa-user-lock dina-locked-content-icon" aria-hidden="true"></i>
        <div class="dina-locked-content-text">
            <?php echo $login_msg; ?>
        </div>
    </div>
<?php
}

//Dina Login redirect to user specific URL.
if ( dina_opt( 'dina_login_redirect' ) ) {
    //add_filter( 'login_redirect', 'dina_wp_login_redirect', 10, 3 );
}
function dina_wp_login_redirect ( $redirect_to, $request, $user ) {
    $redirect_to = dina_opt( 'dina_login_redirect_url' );

    if ( empty( $redirect_to ) ) {
        $redirect_to = dina_myaccount_link();
    }

    return $redirect_to;
}

//Dina WC Login redirect to user specific URL.
if ( dina_opt( 'dina_login_redirect' ) ) {
    add_filter( 'woocommerce_login_redirect', 'dina_wc_login_redirect', 99, 2 );
}
function dina_wc_login_redirect( $url, $user ) {
    $redirect_to = dina_opt( 'dina_login_redirect_url' );

    if ( empty( $redirect_to ) ) {
        $redirect_to = dina_myaccount_link();
    }

    return $redirect_to;
}

//Dina Logout redirect to user specific URL.
if ( dina_opt( 'dina_logout_redirect' ) ) {
    add_action( 'wp_logout', 'dina_wp_logout_redirect' );
}
function dina_wp_logout_redirect() {
    $dina_logout_redirect = dina_opt( 'dina_logout_redirect_url' );

    if ( empty( $dina_logout_redirect ) ) {
        $dina_logout_redirect = dina_myaccount_link();
    }

    wp_redirect( $dina_logout_redirect );
    exit();
}

//Dina site logo
function dina_site_logo( $schema, $class, $strong ) {
    ?>
    <a href="<?php echo dina_logo_link(); ?>" title="<?php bloginfo( 'name' ); ?> | <?php bloginfo( 'description' ); ?>" class="dina-logo-link" rel="home">

        <?php
            $logo_src        = dina_to_https( dina_opt( 'site_logo', 'url' ) );
            $logo_retina_src = ( ! empty( dina_opt( 'site_logo_retina', 'url' ) ) ) ? dina_to_https( dina_opt( 'site_logo_retina', 'url' ) ) : $logo_src;
            $logo_width      = ( ! empty( dina_opt( 'site_logo', 'width' ) ) ) ? dina_opt( 'site_logo', 'width' ) : '160';
            $logo_height     = ( ! empty( dina_opt( 'site_logo', 'height' ) ) ) ? dina_opt( 'site_logo', 'height' ) : '57';
            $alt_text        = get_post_meta( dina_opt( 'site_logo', 'id' ), '_wp_attachment_image_alt', true);
            $alt             = ! empty( $alt_text  ) ? $alt_text  : get_bloginfo( 'name' ) . ' | ' . get_bloginfo( 'description' );
            $light_style     = ( dina_opt( 'dina_dark_mode' ) && dina_opt( 'ch_dark_site_logo' ) ) ? ' dina-light-logo' : '';
            $logo_schema     = $schema && dina_opt( 'site_schema' ) ? 'itemprop="logo"' : '';
        ?>

        <img <?php echo $logo_schema; ?>
        src="<?php echo $logo_src; ?>"
        srcset="<?php echo $logo_retina_src; ?> 2x"
        width="<?php echo $logo_width; ?>"
        height="<?php echo $logo_height; ?>"
        alt="<?php echo $alt; ?>"
        title="<?php echo $alt; ?>"
        class="img-logo<?php echo $light_style . $class; ?>"/>

        <?php
        if ( dina_opt( 'dina_dark_mode' ) && dina_opt( 'ch_dark_site_logo' ) ) {
            $logo_src        = dina_to_https( dina_opt( 'dark_site_logo', 'url' ) );
            $logo_retina_src = ( ! empty( dina_opt( 'dark_site_logo_retina', 'url' ) ) ) ? dina_to_https( dina_opt( 'dark_site_logo_retina', 'url' ) ) : $logo_src;
            $logo_width      = ( ! empty( dina_opt( 'dark_site_logo', 'width' ) ) ) ? dina_opt( 'dark_site_logo', 'width' ) : '160';
            $logo_height     = ( ! empty( dina_opt( 'dark_site_logo', 'height' ) ) ) ? dina_opt( 'dark_site_logo', 'height' ) : '57';
            $logo_schema     = dina_opt( 'site_schema' ) ? 'itemprop="logo"' : '';
        ?>

            <img <?php echo $logo_schema; ?>
            src="<?php echo $logo_src; ?>"
            srcset="<?php echo $logo_retina_src; ?> 2x"
            width="<?php echo $logo_width; ?>"
            height="<?php echo $logo_height; ?>"
            alt="<?php echo $alt; ?>"
            title="<?php echo $alt; ?>"
            class="img-logo dina-dark-logo<?php echo $class; ?>"/>

        <?php } ?>

        <?php if ( $strong ) { ?>
            <strong><?php bloginfo( 'name' ); ?> | <?php bloginfo( 'description' ); ?> </strong>
        <?php } ?>
    </a>
<?php
}

//Dina sticky logo
function dina_sticky_logo() {
    if ( ! dina_opt( 'fixed_head_logo' ) )
        return '';
                            
    if ( dina_opt( 'change_fixed_logo' ) && ! empty( dina_to_https( dina_opt( 'sticky_logo', 'url' ) ) ) ) {
        $logo        = dina_to_https( dina_opt( 'sticky_logo', 'url' ) );
        $logo_retina = dina_to_https( dina_opt( 'sticky_logo', 'url' ) );
    } else {
        $logo        = dina_to_https( dina_opt( 'site_logo', 'url' ) );
        $logo_retina = dina_to_https( dina_opt( 'site_logo_retina', 'url' ) );
    }

    if ( dina_opt( 'dina_dark_mode' ) && dina_opt( 'ch_dark_site_logo' ) ) {
        $dark_logo        = dina_to_https( dina_opt( 'dark_site_logo', 'url' ) );
        $dark_logo_retina = dina_to_https( dina_opt( 'dark_site_logo_retina', 'url' ) );
    }

    $light_style = ( dina_opt( 'dina_dark_mode' ) && dina_opt( 'ch_dark_site_logo' ) ) ? ' dina-light-logo' : '';

    $sticky_logo = '<li class="sticky-logo">
                        <a href="'. dina_logo_link() .'" title="'. get_bloginfo( 'name' ) .' | '. get_bloginfo( 'description' ) .'" rel="home" class="menu-logo">';   

    $sticky_logo .=  '<img src="'. $logo .'" srcset="'. $logo_retina .' 2x" alt="'. get_bloginfo( 'name' ) .' | '. get_bloginfo( 'description' ) .'" width="107" height="37" data-no-lazy="1" title="'. get_bloginfo( 'name' ) .' | '. get_bloginfo( 'description' ) .'" class="img-logo dina-sticky-logo'. $light_style .'"/>';

    if ( dina_opt( 'dina_dark_mode' ) && dina_opt( 'ch_dark_site_logo' ) ) {
        $sticky_logo .=  '<img src="'. $dark_logo .'" srcset="'. $dark_logo_retina .' 2x" alt="'. get_bloginfo( 'name' ) .' | '. get_bloginfo( 'description' ) .'" width="107" height="37" data-no-lazy="1" title="'. get_bloginfo( 'name' ) .' | '. get_bloginfo( 'description' ) .'" class="img-logo dina-sticky-logo dina-sticky-dark-logo"/>';
    }
    
    $sticky_logo .=     '</a>
                    </li>';
    
    $items_wrap = '<ul id="%1$s" class="%2$s">'. $sticky_logo .'%3$s';
    $items_wrap .= '</ul>';

    return $items_wrap;
        
}

//dina_ajax_search_configs
add_filter( 'searchwp_live_search_configs', 'dina_ajax_search_configs' );
function dina_ajax_search_configs() {
    $ajax_search_configs = array(
        'default' => array(                         // 'default' config
            'engine' => 'default',                  // search engine to use (if SearchWP is available)
            'input' => array(
                'delay'     => dina_opt( 'ajax_delay' ),                 // wait 500ms before triggering a search
                'min_chars' => dina_opt( 'ajax_min_chars' ),                   // wait for at least 3 characters before triggering a search
            ),
            'results' => array(
                'position'  => 'bottom',            // where to position the results (bottom|top)
                'width'     => 'auto',              // whether the width should automatically match the input (auto|css)
                'offset'    => array(
                    'x' => 0,                       // x offset (in pixels)
                    'y' => 5,                       // y offset (in pixels)
                ),
            ),
            'spinner' => array(                     // powered by http://fgnass.github.io/spin.js/
                'lines'         => 10,              // number of lines in the spinner
                'length'        => 8,               // length of each line
                'width'         => 4,               // line thickness
                'radius'        => 8,               // radius of inner circle
                'corners'       => 1,               // corner roundness (0..1)
                'rotate'        => 0,               // rotation offset
                'direction'     => 1,               // 1: clockwise, -1: counterclockwise
                'color'         => '#000',          // #rgb or #rrggbb or array of colors
                'speed'         => 1,               // rounds per second
                'trail'         => 60,              // afterglow percentage
                'shadow'        => false,           // whether to render a shadow
                'hwaccel'       => false,           // whether to use hardware acceleration
                'className'     => 'spinner',       // CSS class assigned to spinner
                'zIndex'        => 2000000000,      // z-index of spinner
                'top'           => '50%',           // top position (relative to parent)
                'left'          => '50%',           // left position (relative to parent)
            ),
        ),
    );

    return $ajax_search_configs;
}

function dina_footer_text( $class ) {
    if ( ! dina_opt( 'show_footer_text' ) )
        return;

    if ( dina_opt( 'footer_text_main' ) && ! is_front_page() ) 
        return; 
    ?>
    <div class="row footer-section-text <?php echo $class ?>">
        <?php if ( dina_opt( 'ftext_title' ) != '' ) { ?>
        <div class="col-12 footer-text-title">
            <h3>
                <?php echo dina_opt( 'ftext_title' ); ?>
            </h3>
        </div>
        <?php } ?>
        <?php if ( dina_opt( 'ftext_text' ) != '' ) { ?>
            <?php if ( dina_opt( 'less_footer_text' ) ) { ?>
                <div class="col-12 footer-text footer-less dina-more-less" data-more="<?php _e( 'Show More', 'dina-kala' ) ?>" data-less="<?php _e( 'Show Less', 'dina-kala' ) ?>">
                    <div class="dina-more-less-content">
                    <?php echo dina_wpautop_content ( dina_opt( 'ftext_text' ) ); ?>
                    </div>
                </div>
            <?php } else { ?>
                <div class="col-12 footer-text">
                    <?php echo dina_wpautop_content ( dina_opt( 'ftext_text' ) ); ?>
                </div>
            <?php } ?>
        <?php } ?>
    </div>
    <?php 
}

//Convert digit 2 word
function di_dig2word( $num ) {
    
    $words = [
        1  => 'one',
        2  => 'two',
        3  => 'three',
        4  => 'four',
        5  => 'five',
        6  => 'six',
        7  => 'seven',
        8  => 'eight',
        9  => 'nine',
        10 => 'ten'
    ];

    return $words[$num] ?? 'undefined';
}

//Convert number 2 word
function di_num2word( $num ) {
    $words = [
        1  => 'first',
        2  => 'second',
        3  => 'third',
        4  => 'fourth',
        5  => 'fifth',
        6  => 'sixth',
        7  => 'seventh',
        8  => 'eighth',
        9  => 'ninth',
        10 => 'tenth'
    ];

    return $words[$num] ?? 'undefined';
}

// di_trnum
function di_trnum( $num ) {
    $words = [
        1 => __( 'First', 'dina-kala' ),
        2 => __( 'Second', 'dina-kala' ),
        3 => __( 'Third', 'dina-kala' ),
        4 => __( 'Fourth', 'dina-kala' ),
        5 => __( 'Fifth', 'dina-kala' ),
        6 => __( 'Sixth', 'dina-kala' ),
        7 => __( 'Seventh', 'dina-kala' ),
        8 => __( 'Eighth', 'dina-kala' ),
        9 => __( 'Ninth', 'dina-kala' )
    ];

    return $words[$num] ?? __( 'Undefined', 'dina-kala' );
}

//dina_check_maintenance
function dina_check_maintenance() {
    
    if ( ! dina_opt( 'maintenance' ) )
        return;
    
    if ( current_user_can( 'administrator' ) || ( dina_opt( 'maintenance_editor' ) && current_user_can( 'edit_posts' ) ) )
        return;
    
    get_template_part( 'under-page' );
    die();
}

//di_elementor_edit_mode
function di_elementor_edit_mode() {
    $elementor_edit_mode = false;
    if ( did_action( 'elementor/loaded' ) ) {
        if ( ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) || ( \Elementor\Plugin::$instance->preview->is_preview_mode() ) ) {
            $elementor_edit_mode = true;
        }
    }
    return $elementor_edit_mode;
}

//dina_modify_paginate
add_filter( 'paginate_links', 'dina_modify_paginate' );
function dina_modify_paginate( $link ) {
    if ( is_paged() )
        $link= str_replace( 'page/1/', '', $link );
    return $link;
}

//Count number of sellers
function dina_count_sellers() {  
    $count = 0;
    if ( class_exists( 'WeDevs_Dokan' ) ) {
        $dokan_sellers = dokan_get_seller_count();
        $count = $dokan_sellers[ 'active' ];
    }
    return $count;
}

//dina_translated_post_ids
function dina_translated_post_ids( $post_id) {

    global $sitepress;

    $translated_ids = Array();

    if ( ! isset( $sitepress ) )
        return;

    $trid = $sitepress->get_element_trid( $post_id, 'post_product' );
    $translations = $sitepress->get_element_translations( $trid, 'product' );

    foreach( $translations as $lang=>$translation) {
        $translated_ids[] = $translation->element_id;
    }

    return $translated_ids;
}

if ( dina_opt( 'change_wordpress_email' ) ) {
    add_filter( 'wp_mail_from', 'dina_sender_email' );
    add_filter( 'wp_mail_from_name', 'dina_sender_name' );
}

//Change email address
function dina_sender_email( $original_email_address ) {
    return dina_opt( 'wordpress_email_address' );
}

//Change sender name
function dina_sender_name( $original_email_from ) {
    return dina_opt( 'wordpress_email_name' );
}

//dina_get_wallet
function dina_get_wallet() {

    $wallet = '';

    if ( defined( 'nirweb_wallet' ) ) {
        $wallet_meta = get_user_meta( get_current_user_id(), 'nirweb_wallet_balance', true );
        $wallet      = wc_price( $wallet_meta );
    } elseif ( class_exists( 'WooWallet' ) ) {
        $wallet = woo_wallet()->wallet->get_wallet_balance( get_current_user_id() );
    }

    return $wallet;
}

// dina_login_url
function dina_login_url() {
    return dina_opt( 'ch_login_link' ) ? dina_opt( 'login_link' ) : esc_url( dina_myaccount_link() );
}

// dina_reset_pw_url
function dina_reset_pw_url() {
    return dina_opt( 'ch_reset_pw_link' ) ? dina_opt( 'reset_pw_link' ) : esc_url( wp_lostpassword_url() );
}

// dinafa_digits
function dinafa_digits( $number ) {
    $persian_arabic_digits = [ '۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹', '٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩' ];
    $english_digits = range( 0, 9 );

    return str_replace( $persian_arabic_digits, $english_digits, $number );
}

// dina_output_content
function dina_output_content( $meta_key, $post_id = 0 ) {
	global $wp_embed;

	$post_id = $post_id ? $post_id : get_the_id();

	$content = get_post_meta( $post_id, $meta_key, 1 );
	$content = $wp_embed->autoembed( $content );
	$content = $wp_embed->run_shortcode( $content );
	$content = wpautop( $content );
	$content = do_shortcode( $content );

	return $content;
}

// dina_wpautop_content
function dina_wpautop_content( $content ) {
	global $wp_embed;
    
	$content = $wp_embed->autoembed( $content );
	$content = $wp_embed->run_shortcode( $content );
	$content = wpautop( $content );
	$content = do_shortcode( $content );

	return $content;
}

// dina_get_current_page_url
function dina_get_current_page_url() {
    $protocol = is_ssl() ? 'https://' : 'http://';

    $current_url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

    return esc_url( $current_url );
}



// نمایش قیمت فقط برای متغیرهای موجود در ووکامرس
add_filter( 'woocommerce_variable_price_html', 'display_price_for_in_stock_variations', 10, 2 );
function display_price_for_in_stock_variations( $price, $product ) {
    $prices = array(); // آرایه‌ای برای ذخیره قیمت متغیرهای موجود
    foreach ( $product->get_available_variations() as $variation ) {
        if ( $variation['is_in_stock'] ) { // بررسی موجود بودن متغیر
            $prices[] = $variation['display_price']; // اضافه کردن قیمت متغیر موجود
        }
    }
    
    if ( ! empty( $prices ) ) { // اگر حداقل یک متغیر موجود باشد
        $min_price = min( $prices ); // کمترین قیمت
        $max_price = max( $prices ); // بیشترین قیمت
        if ( $min_price === $max_price ) { // اگر فقط یک قیمت موجود باشد
            $price = wc_price( $min_price ); // نمایش تک قیمت
        } else { // اگر بازه قیمتی وجود داشته باشد
            $price = wc_price( $min_price ) . ' - ' . wc_price( $max_price ); // نمایش بازه
        }
    } else { // اگر هیچ متغیری موجود نباشد
        $price = 'ناموجود'; // نمایش پیام "ناموجود"
    }
    
    return $price;
}
