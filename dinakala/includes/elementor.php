<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

require_once get_template_directory() . '/includes/el-widgets/fa.php';

class Dina_Elementor_Widgets {

	protected static $instance = null;

	public static function get_instance() {
		if ( ! isset( static::$instance ) ) {
			static::$instance = new static;
		}

		return static::$instance;
	}

	protected function __construct() {

        //Include Control Files
        require_once( 'el-widgets/controls/dina-autocomplete.php' );
		
		//Include WooCommerce Widgets
		if ( class_exists( 'WooCommerce' ) ) {
			require_once( 'el-widgets/dina-products.php' );
			require_once( 'el-widgets/dina-products-grid.php' );
			require_once( 'el-widgets/dina-products-column.php' );
			require_once( 'el-widgets/dina-products-table.php' );
			require_once( 'el-widgets/dina-timed-products.php' );
			require_once( 'el-widgets/dina-special-offer.php' );
			require_once( 'el-widgets/dina-offer.php' );
			require_once( 'el-widgets/dina-daily-discount.php' );
			require_once( 'el-widgets/dina-category-slider.php' );
			require_once( 'el-widgets/dina-category-grid.php' );
			require_once( 'el-widgets/dina-category-column.php' );
			require_once( 'el-widgets/dina-viewed-products.php' );
			if ( dina_opt( 'product_brand' ) ) {
				require_once( 'el-widgets/dina-brand-slider.php' );
				require_once( 'el-widgets/dina-brand-grid.php' );
			    require_once( 'el-widgets/dina-brand-column.php' );
			}
		}

		//Include Site Widgets
		require_once( 'el-widgets/dina-services.php' );
		require_once( 'el-widgets/dina-posts.php' );
		require_once( 'el-widgets/dina-posts-grid.php' );
		require_once( 'el-widgets/dina-ads-image.php' );
		require_once( 'el-widgets/dina-logo-slider.php' );
		require_once( 'el-widgets/dina-slider.php' );
		require_once( 'el-widgets/dina-daily-slider.php' );
		require_once( 'el-widgets/dina-text-box.php' );
		require_once( 'el-widgets/dina-site-info.php' );
		require_once( 'el-widgets/dina-ticker.php' );
		require_once( 'el-widgets/dina-social-links.php' );
		require_once( 'el-widgets/dina-aparat-embed.php' );

		//Include Header Widgets
		if ( dina_active_elpro() ) {
			require_once( 'el-widgets/header-widgets/dina-header-logo.php' );
			require_once( 'el-widgets/header-widgets/dina-search-bar.php' );
			require_once( 'el-widgets/header-widgets/dina-user-btns.php' );
			require_once( 'el-widgets/header-widgets/dina-mobile-user-btns.php' );
			require_once( 'el-widgets/header-widgets/dina-mobile-menu-btn.php' );
			require_once( 'el-widgets/header-widgets/dina-shopping-cart.php' );
			require_once( 'el-widgets/header-widgets/dina-whishlist-btn.php' );
			require_once( 'el-widgets/header-widgets/dina-compare-btn.php' );
			require_once( 'el-widgets/header-widgets/dina-dark-mode-toggle.php' );
		}

		add_action( 'elementor/controls/register', [ $this, 'dina_register_controls' ] );
		add_action( 'elementor/widgets/register', [ $this, 'dina_register_widgets' ] );
	}

    public function dina_register_controls() {
        \Elementor\Plugin::instance()->controls_manager->register( new \Elementor\Dina_Autocomplete() );
    }

	public function dina_register_widgets() {
		
		//Call WooCommerce Widgets
		if ( class_exists( 'WooCommerce' ) ) {
			\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Dina_Woo_Products() );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Dina_Woo_Products_Grid() );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Dina_Columnar_Products_Slider() );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Dina_Woo_Products_Table() );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Dina_Timed_Products() );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Special_Offer() );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Dina_Dialy_Discount() );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Dina_Woo_Offer() );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Category_Slider() );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Dina_Category_Grid() );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Dina_Columnar_Category_Slider() );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Dina_Recently_Viewed_Products() );
			if ( dina_opt( 'product_brand' ) ) {
				\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Brands_Slider() );
				\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Dina_Brands_Grid() );
				\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Dina_Columnar_Brand_Slider() );
			}
		}

		//Call Site Widgets
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Our_Service_Box() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Dina_Blog_Posts() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Dina_Blog_Posts_Grid() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Dina_Ads_Image() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Logo_Slider() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Slider() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Dina_Daily_Slider() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Text_Box() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Dina_Site_Info() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Dina_Text_Ticker() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Dina_Social_Links() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Dina_Aparat_Embed() );

		//Call Header Widgets
		if ( dina_active_elpro() ) {
			\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Dina_Header_Logo() );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Dina_Search_Bar() );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Dina_User_Buttons() );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Dina_Mobile_User_Buttons() );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Dina_Mobile_Menu_Btn() );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Dina_Shopping_Cart() );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Dina_Wishlist_Btn() );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Dina_Compare_Btn() );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Dina_Dark_Mode_Toggle() );
		}
		
	}

}

add_action( 'init', 'dina_elementor_init' );
function dina_elementor_init() {
	Dina_Elementor_Widgets::get_instance();
}

function dina_add_elementor_widget_categories( $elements_manager ) {

	$elements_manager->add_category(
		'dina-kala',
		[
			'title' => __( 'DinaKala', 'dina-kala' ),
			'icon' => 'fa fa-plug',
		]
	);

	if ( dina_active_elpro() ) {
		$elements_manager->add_category(
			'dina-kala-header',
			[
				'title' => __( 'DinaKala header widgets', 'dina-kala' ),
				'icon' => 'fa fa-plug',
			]
		);
	}
}
add_action( 'elementor/elements/categories_registered', 'dina_add_elementor_widget_categories' );

//Disable Elementor Google Fonts
add_filter( 'elementor/frontend/print_google_fonts', '__return_false' );

//Register Elementor Location's
add_action( 'elementor/theme/register_locations', 'dina_register_elementor_locations' );
function dina_register_elementor_locations( $elementor_theme_manager ) {

	$elementor_theme_manager->register_location( 'header' );
	$elementor_theme_manager->register_location( 'footer' );
	// $elementor_theme_manager->register_location( 'single' );
	// $elementor_theme_manager->register_location( 'archive' );

}

//Register elementor preview mode script
add_action( 'elementor/preview/enqueue_scripts', 'dina_elementor_script' );
function dina_elementor_script() {
    wp_enqueue_script( 'dina-js-elementor', DI_URI . '/js/elementor.js', array( 'jquery' ), DI_VER, true);
}

//Register Elementor Panel styles
add_action( 'elementor/editor/before_enqueue_scripts', function() {
    wp_register_style( 'el-style', DI_URI . '/css/elementor.css', array() , DI_VER);
    wp_enqueue_style( 'el-style' );
    wp_register_style( 'dina-awe', DI_URI . '/css/fontawesome.min.css', array() , DI_VER);
    wp_enqueue_style( 'dina-awe' );
	wp_register_style( 'dina-irico', DI_URI . '/css/ir-icons.css', array() , DI_VER);
    wp_enqueue_style( 'dina-irico' );
});

function dina_register_widgets_styles() {
	wp_register_style( 'dina-table-loadmore', DI_URI . '/css/dina-table-loadmore.css', array( 'dina-style' ), DI_VER );
	wp_register_style( 'dina-column', DI_URI . '/css/dina-column.css', array( 'dina-style' ), DI_VER );
}
add_action( 'wp_enqueue_scripts', 'dina_register_widgets_styles' );

//Disable elementor use mini cart template
function dina_disable_elementor_use_mini_cart_template() {
	update_option( 'elementor_use_mini_cart_template', 'no' );
}
add_action( 'init', 'dina_disable_elementor_use_mini_cart_template' );

//dina_table_load_more_scripts
add_action( 'wp_enqueue_scripts', 'dina_table_load_more_scripts' );
function dina_table_load_more_scripts() {
	wp_register_script( 'dina-table-loadmore', DI_URI . '/js/dina-table.js', array('jquery'), DI_VER, true );
	wp_localize_script( 'dina-table-loadmore', 'dina_table_loadmore_params', array(
		'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php'
	) );
}

//dina_table_loadmore_ajax_handler
function dina_table_loadmore_ajax_handler() {
	
	$vars        = $_POST['vars'];
	$prod_sort   = $vars['prod_sort'];
	$per_page    = (int)$vars['perpage'];
	$prod_filter = $vars['filter'];
	$term        = $vars['term'];
	$stock       = $vars['stock'];

    $tax_query = array();
    array_push( $tax_query, array( 'relation' => 'AND' ) );			
    array_push( $tax_query, array(
        'taxonomy' => 'product_visibility',
        'field'    => 'name',
        'terms'    => 'exclude-from-catalog',
        'operator' => 'NOT IN',
    ) );

    switch ( $prod_sort) {
        case 'latest':
            $args = array(
            'posts_per_page' => $per_page,
            'post_type'      => 'product',
            'post_status'    => 'publish',
            'order'          => 'DESC'  );
            break;
        case 'latest-updated':
            $args = array(
            'posts_per_page'      => $per_page,
            'post_type'           => 'product',
            'post_status'         => 'publish',
            'orderby'             => 'modified',
            'ignore_sticky_posts' => '1',
            'order'               => 'DESC'  );
            break;
        case 'menu_order':
            $args = array(
            'posts_per_page' => $per_page,
            'post_type'      => 'product',
            'post_status'    => 'publish',
            'orderby'        => 'menu_order title',
            'order'          => 'ASC'  );
            break;
        case 'saled':
            $args = array(
                'posts_per_page' => $per_page,
                'post_type'      => 'product',
                'post_status'    => 'publish',
                'meta_key'       => 'total_sales',
                'orderby'        => 'meta_value_num',
                'order'          => 'DESC'
            );
            break;
        case 'discounted':
            $args = array(
                'posts_per_page' => $per_page,
                'post_status'    => 'publish',
                'order'          => 'DESC',
                'post_type'      => 'product',
                'post__in'       => array_merge( array( 0 ), wc_get_product_ids_on_sale() )
            );
            break;
        case 'coming_soon':
            $args = array(
                'posts_per_page' => $per_page,
                'post_type'      => 'product',
                'post_status'    => 'publish',
                'meta_key'       => 'dina_coming',
                'meta_value'     => 'on',
                'order'          => 'DESC'
            );
            break;
        case 'rand_discounted':
            $args = array(
                'posts_per_page' => $per_page,
                'post_status'    => 'publish',
                'orderby'        => 'rand',
                'post_type'      => 'product',
                'post__in'       => array_merge( array( 0 ), wc_get_product_ids_on_sale() )
            );
            break;
        case 'viewed':
            $args = array(
                'posts_per_page' => $per_page,
                'post_type'      => 'product',
                'post_status'    => 'publish',
                'meta_key'       => dina_opt( 'views_meta_key' ),
                'orderby'        => 'meta_value_num',
                'order'          => 'DESC'
            );
            break;
        case 'price-desc':
            $args = array(
                'posts_per_page' => $per_page,
                'post_type'      => 'product',
                'post_status'    => 'publish',
                'orderby'        => 'meta_value_num',
                'meta_key'       => '_price',
                'order'          => 'DESC'
            );
            break;
        case 'price-asc':
            $args = array(
                'posts_per_page' => $per_page,
                'post_type'      => 'product',
                'post_status'    => 'publish',
                'orderby'        => 'meta_value_num',
                'meta_key'       => '_price',
                'order'          => 'ASC'
            );
            break;
        case 'random':
            $args = array(
            'posts_per_page' => $per_page,
            'post_type'      => 'product',
            'post_status'    => 'publish',
            'orderby'        => 'rand'
            );
            break;
        case 'special':
            $args = array (
                'posts_per_page' => $per_page,
                'post_type'      => 'product',
                'post_status'    => 'publish',
                'order'          => 'DESC',
            );
            array_push( $tax_query, array(
                'taxonomy' => 'product_visibility',
                'field'    => 'name',
                'terms'    => 'featured',
            ) );
            break;
        case 'rand_special':
            $args = array (
                'posts_per_page' => $per_page,
                'post_type'      => 'product',
                'post_status'    => 'publish',
                'orderby'        => 'rand',
            );
            array_push( $tax_query, array(
                'taxonomy' => 'product_visibility',
                'field'    => 'name',
                'terms'    => 'featured',
            ) );
            break;
        default:
        $args = array(
            'posts_per_page' => $per_page,
            'post_type'      => 'product',
            'post_status'    => 'publish',
            'order'          => 'DESC'
        );
    }

    if ( $prod_filter ) {

        if ( $prod_filter == 'category' && ! empty( $term ) ) {

            $term = explode( ',', $term );

            array_push( $tax_query, array(
                'taxonomy' => 'product_cat',
                'field'    => 'term_id',
                'terms'    => $term
            ) );

        } elseif ( $prod_filter == 'tag' && ! empty( $term ) ) {

            $term = explode( ',', $term );

            array_push( $tax_query, array(
                'taxonomy' => 'product_tag',
                'field'    => 'term_id',
                'terms'    => $term
            ) );

        } elseif ( $prod_filter == 'brand' && ! empty( $term ) ) {
            
            $term = explode( ',', $term );

            array_push( $tax_query, array(
                'taxonomy' => dina_opt( 'product_brand_taxonomy' ),
                'field'    => 'term_id',
                'terms'    => $term
            ) );

        } elseif ( $prod_filter == 'product-ids' && ! empty( $term ) ) {
            $args['post__in'] = $term;
        }
    }
 
	if ( 'yes' === $stock ) {
        $args['meta_query'] = array(
            'relation' => 'AND',
            array(
                'key'     => '_stock_status',
                'value'   => 'outofstock',
                'compare' => 'NOT IN'
            )
        );
    }

    $args['tax_query'] = $tax_query;

    $args[] = array(
        'no_found_rows'          => true,
        'update_post_term_cache' => false
    );

    $args['paged'] = (int)$_POST['current'] + 1;
        
    $productsquery = new WP_Query( $args );
 
	if( $productsquery->have_posts() ) :

        $table_args = $_POST['table'];
 
		while( $productsquery->have_posts() ): $productsquery->the_post();

            global $product;
 
            get_template_part( 'template-parts/table-row', '', $table_args );
 
		endwhile;
 
	endif;
	die;
} 
add_action('wp_ajax_loadmore', 'dina_table_loadmore_ajax_handler');
add_action('wp_ajax_nopriv_loadmore', 'dina_table_loadmore_ajax_handler');

//dina_get_posts_by_query
function dina_get_posts_by_query() {
    $search_string = isset( $_POST['q'] ) ? sanitize_text_field( wp_unslash( $_POST['q'] ) ) : ''; // phpcs:ignore
    $post_type     = isset( $_POST['post_type'] ) ? $_POST['post_type'] : 'post'; // phpcs:ignore
    $results       = array();

    $query = new WP_Query(
        array(
            's'              => $search_string,
            'post_type'      => $post_type,
            'posts_per_page' => - 1,
        )
    );

    if ( ! isset( $query->posts ) ) {
        return;
    }

    foreach ( $query->posts as $post ) {
        $results[] = array(
            'id'   => $post->ID,
            'text' => $post->post_title,
        );
    }

    wp_send_json( $results );
}
add_action( 'wp_ajax_dina_get_posts_by_query', 'dina_get_posts_by_query' );
add_action( 'wp_ajax_nopriv_dina_get_posts_by_query', 'dina_get_posts_by_query' );

//dina_get_posts_title_by_id
function dina_get_posts_title_by_id() {
    $ids       = isset( $_POST['id'] ) ? $_POST['id'] : array(); // phpcs:ignore
    $post_type = isset( $_POST['post_type'] ) ? $_POST['post_type'] : 'post'; // phpcs:ignore
    $results   = array();

    $query = new WP_Query(
        array(
            'post_type'      => $post_type,
            'post__in'       => $ids,
            'posts_per_page' => - 1,
            'orderby'        => 'post__in',
        )
    );

    if ( ! isset( $query->posts ) ) {
        return;
    }

    foreach ( $query->posts as $post ) {
        $results[ $post->ID ] = $post->post_title;
    }

    wp_send_json( $results );
}
add_action( 'wp_ajax_dina_get_posts_title_by_id', 'dina_get_posts_title_by_id' );
add_action( 'wp_ajax_nopriv_dina_get_posts_title_by_id', 'dina_get_posts_title_by_id' );
    
//dina_get_taxonomies_title_by_id
function dina_get_taxonomies_title_by_id() {
    $ids     = isset( $_POST['id'] ) ? $_POST['id'] : array(); // phpcs:ignore
    $results = array();

    $args = array(
        'include' => $ids,
    );

    $terms = get_terms( $args );

    if ( is_array( $terms ) && $terms ) {
        foreach ( $terms as $term ) {
            if ( is_object( $term ) ) {
                $results[ $term->term_id ] = $term->name;
            }
        }
    }

    wp_send_json( $results );
}
add_action( 'wp_ajax_dina_get_taxonomies_title_by_id', 'dina_get_taxonomies_title_by_id' );
add_action( 'wp_ajax_nopriv_dina_get_taxonomies_title_by_id', 'dina_get_taxonomies_title_by_id' );

//dina_get_taxonomies_by_query
function dina_get_taxonomies_by_query() {
    $search_string = isset( $_POST['q'] ) ? sanitize_text_field( wp_unslash( $_POST['q'] ) ) : ''; // phpcs:ignore
    $taxonomy      = isset( $_POST['taxonomy'] ) ? $_POST['taxonomy'] : ''; // phpcs:ignore
    $results       = array();

    $args = array(
        'taxonomy'   => $taxonomy,
        'hide_empty' => false,
        'search'     => $search_string,
    );

    $terms = get_terms( $args );

    if ( is_array( $terms ) && $terms ) {
        foreach ( $terms as $term ) {
            if ( is_object( $term ) ) {
                $results[] = array(
                    'id'   => $term->term_id,
                    'text' => $term->name,
                );
            }
        }
    }

    wp_send_json( $results );
}
add_action( 'wp_ajax_dina_get_taxonomies_by_query', 'dina_get_taxonomies_by_query' );
add_action( 'wp_ajax_nopriv_dina_get_taxonomies_by_query', 'dina_get_taxonomies_by_query' );

//dina_product_filter_options
function dina_product_filter_options() {

    $filter_options = array(
        'category'    => __( 'Products category', 'dina-kala' ),
        'tag'         => __( 'Products tag', 'dina-kala' ),
        'product-ids' => __( 'Product ID', 'dina-kala' ),
    );
    
    if ( dina_opt( 'product_brand' ) ) {

        $brand_option = array(
            'brand' => __( 'Products brand', 'dina-kala' )
        );

        $filter_options = array_merge( $filter_options, $brand_option);
    }

    return $filter_options;
}
