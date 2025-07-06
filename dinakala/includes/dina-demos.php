<?php
/*
Theme Designed By: Meysam Hosseinkhani
Email: Meysam98@Gmail.com
Author Website: i-design.ir
*/
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
    exit;

//Loads demo import styles
add_action( 'admin_enqueue_scripts', 'dina_demo_import_styles' );
function dina_demo_import_styles( $page)
{
    if ( isset( $_GET['page'] ) && $_GET['page'] === 'dina-demo-import' ) {
        wp_enqueue_style( 'demo-import', DI_URI . '/includes/assets/demo-import.css' );   
    }
}

//Define Theme Demos
function dina_import_files() {
    return [
      [
        'import_file_name'           => __( 'Digital Products Store', 'dina-kala' ),
        'import_file_id'             =>'digital',
        'import_file_url'            => 'https://i-design.ir/dina-demos/digital/demo-content.xml',
        'import_widget_file_url'     => 'https://i-design.ir/dina-demos/digital/widgets.wie',
        'import_customizer_file_url' => 'https://i-design.ir/dina-demos/digital/customizer.json',
        'import_redux'               => [
          [
            'file_url'    => 'https://i-design.ir/dina-demos/digital/redux.json',
            'option_name' => 'di_data',
          ],
        ],
        'import_preview_image_url'   => 'https://i-design.ir/dina-demos/digital/dina-digital.png',
        'preview_url'                => 'https://dina.i-design.ir/',
      ],
      [
        'import_file_name'           => __( 'Clothing store', 'dina-kala' ),
        'import_file_id'             => 'clothing',
        'import_file_url'            => 'https://i-design.ir/dina-demos/poshak/demo-content.xml',
        'import_widget_file_url'     => 'https://i-design.ir/dina-demos/poshak/widgets.wie',
        'import_customizer_file_url' => 'https://i-design.ir/dina-demos/poshak/customizer.json',
        'import_redux'               => [
          [
            'file_url'    => 'https://i-design.ir/dina-demos/poshak/redux.json',
            'option_name' => 'di_data',
          ],
        ],
        'import_preview_image_url'   => 'https://i-design.ir/dina-demos/poshak/dina-poshak.png',
        'preview_url'                => 'https://dinac.i-design.ir/',
      ],
      [
        'import_file_name'           => __( 'Supermarket', 'dina-kala' ),
        'import_file_id'             => 'supermarket',
        'import_file_url'            => 'https://i-design.ir/dina-demos/market/demo-content.xml',
        'import_widget_file_url'     => 'https://i-design.ir/dina-demos/market/widgets.wie',
        'import_customizer_file_url' => 'https://i-design.ir/dina-demos/market/customizer.json',
        'import_redux'               => [
          [
            'file_url'    => 'https://i-design.ir/dina-demos/market/redux.json',
            'option_name' => 'di_data',
          ],
        ],
        'import_preview_image_url'   => 'https://i-design.ir/dina-demos/market/dina-market.png',
        'preview_url'                => 'https://dinama.i-design.ir/',
      ],
      [
        'import_file_name'           => __( 'Handicraft store', 'dina-kala' ),
        'import_file_id'             => 'handicraft',
        'import_file_url'            => 'https://i-design.ir/dina-demos/handicraft/demo-content.xml',
        'import_widget_file_url'     => 'https://i-design.ir/dina-demos/handicraft/widgets.wie',
        'import_customizer_file_url' => 'https://i-design.ir/dina-demos/handicraft/customizer.json',
        'import_redux'               => [
          [
            'file_url'    => 'https://i-design.ir/dina-demos/handicraft/redux.json',
            'option_name' => 'di_data',
          ],
        ],
        'import_preview_image_url'   => 'https://i-design.ir/dina-demos/handicraft/dina-handicraft.png',
        'preview_url'                => 'https://dinaha.i-design.ir/',
      ],
      [
        'import_file_name'           => __( 'Flower and plant shop', 'dina-kala' ),
        'import_file_id'             => 'plant',
        'import_file_url'            => 'https://i-design.ir/dina-demos/plant/demo-content.xml',
        'import_widget_file_url'     => 'https://i-design.ir/dina-demos/plant/widgets.wie',
        'import_customizer_file_url' => 'https://i-design.ir/dina-demos/plant/customizer.json',
        'import_redux'               => [
          [
            'file_url'    => 'https://i-design.ir/dina-demos/plant/redux.json',
            'option_name' => 'di_data',
          ],
        ],
        'import_preview_image_url'   => 'https://i-design.ir/dina-demos/plant/dina-plant.png',
        'preview_url'                => 'https://dinapl.i-design.ir/',
      ],
      [
        'import_file_name'           => __( 'Jewelry store', 'dina-kala' ),
        'import_file_id'             => 'persian-jewelry',
        'import_file_url'            => 'https://i-design.ir/dina-demos/jewelry/demo-content.xml',
        'import_widget_file_url'     => 'https://i-design.ir/dina-demos/jewelry/widgets.wie',
        'import_customizer_file_url' => 'https://i-design.ir/dina-demos/jewelry/customizer.json',
        'import_redux'               => [
          [
            'file_url'    => 'https://i-design.ir/dina-demos/jewelry/redux.json',
            'option_name' => 'di_data',
          ],
        ],
        'import_preview_image_url'   => 'https://i-design.ir/dina-demos/jewelry/dina-jewelry.png',
        'preview_url'                => 'https://dinaef.i-design.ir/',
      ],
      [
        'import_file_name'           => __( 'Jewelry store (English demo)', 'dina-kala' ),
        'import_file_id'             => 'jewelry',
        'import_file_url'            => 'https://i-design.ir/dina-demos/english/demo-content.xml',
        'import_widget_file_url'     => 'https://i-design.ir/dina-demos/english/widgets.wie',
        'import_customizer_file_url' => 'https://i-design.ir/dina-demos/english/customizer.json',
        'import_redux'               => [
          [
            'file_url'    => 'https://i-design.ir/dina-demos/english/redux.json',
            'option_name' => 'di_data',
          ],
        ],
        'import_preview_image_url'   => 'https://i-design.ir/dina-demos/english/dina-english.png',
        'preview_url'                => 'https://dinaen.i-design.ir/',
      ],
    ];
  }
  add_filter( 'ocdi/import_files', 'dina_import_files' );

//Required and recommended theme plugins.
function dina_register_plugins( $plugins ) {
  $theme_plugins = [
    [
        'name'     => __( 'WooCommerce', 'dina-kala' ), 
        'slug'     => 'woocommerce', 
        'required' => true,                     
    ],
    [
        'name'     => __( 'Elementor Page Builder', 'dina-kala' ), 
        'slug'     => 'elementor', 
        'required' => true,                     
    ],
    [
        'name'     => __( 'YITH WooCommerce Wishlist', 'dina-kala' ),
        'slug'     => 'yith-woocommerce-wishlist',
        'required' => false,
    ],
    [
        'name'     => __( 'WooCommerce Compare List', 'dina-kala' ),
        'slug'     => 'woocommerce-compare-list',
        'source'   => get_template_directory() . '/plugins/woocommerce-compare-list.zip',
        'required' => false,
    ],
    [
      'name'     => __( 'Contact Form 7', 'dina-kala' ),
      'slug'     => 'contact-form-7',
      'required' => false,
    ],
  ];
 
  return array_merge( $plugins, $theme_plugins );
}
add_filter( 'ocdi/register_plugins', 'dina_register_plugins' );

//Change intro text
function dina_plugin_intro_text( $default_text ) {
    $default_text = '<div class="ocdi__intro-text">';
    $default_text .= __( '<p><strong>Important notice:</strong></p>', 'dina-kala' );
    $default_text .= __( '<p>Please install and activate the required plugins for the skin before importing your desired demo. Home page, favorites and comparisons are also set when importing, so if you have pages with this name, delete them before importing.</p>', 'dina-kala' );
    $default_text .= '</div>';
    return $default_text;
}
add_filter( 'ocdi/plugin_intro_text', 'dina_plugin_intro_text' );

//Modify plugin page attributes
function dina_plugin_page_setup( $default_settings ) {
    $default_settings['parent_slug'] = 'themes.php';
    $default_settings['page_title']  = __( 'Theme Demo Importer' , 'dina-kala' );
    $default_settings['menu_title']  = __( 'Theme Demo Importer' , 'dina-kala' );
    $default_settings['capability']  = 'import';
    $default_settings['menu_slug']   = 'dina-demo-import';
 
    return $default_settings;
}
add_filter( 'ocdi/plugin_page_setup', 'dina_plugin_page_setup' );

//Before Import Custom Code Execution
function dina_before_content_import( $selected_import ) {
  Redux::setOption( 'di_data','product_brand', '1' );
  Redux::setOption( 'di_data','product_brand_slug', 'brand' );
  Redux::setOption( 'di_data','product_brand_taxonomy', 'brand' );
}
add_action( 'ocdi/before_content_import', 'dina_before_content_import' );

//After Import Custom Code Execution
function dina_after_import_setup( $selected_import) {
  if ( 'jewelry' != $selected_import['import_file_id'] ) {

    // Assign menus to their locations.
    $main_menu = get_term_by( 'name', 'فهرست اصلی', 'nav_menu' );
    $header_menu = get_term_by( 'name', 'فهرست هدر', 'nav_menu' );
    set_theme_mod( 'nav_menu_locations', [
            'mega_menu' => $main_menu->term_id,
            'header' => $header_menu->term_id, 
        ]
    );

    // Assign front page and posts page (blog page).
    $front_page_id = get_page_by_title( 'صفحه اصلی' );
    $blog_page_id  = get_page_by_title( 'وبلاگ' );

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );
    update_option( 'page_for_posts', $blog_page_id->ID );

    // Assign compare page.
    $compare_page_id  = get_page_by_title( 'مقایسه محصولات' );
    update_option( 'wccm_compare_page', $compare_page_id->ID );

    // Assign Woo Currency.
    update_option( 'woocommerce_currency', 'IRT' );
    update_option( 'woocommerce_currency_pos', 'right_space' );
    update_option( 'woocommerce_price_num_decimals', 0 );
    update_option( 'woocommerce_enable_signup_and_login_from_checkout', 'yes' );
    update_option( 'woocommerce_enable_myaccount_registration', 'yes' );
    update_option( 'woocommerce_registration_generate_username', 'no' );
    update_option( 'woocommerce_registration_generate_password', 'no' );
    update_option( 'wc_feature_woocommerce_brands_enabled', 'no' );
    update_option( 'woocommerce_remote_variant_assignment', 1 );
  } else {

    // Assign menus to their locations.
    $main_menu = get_term_by( 'name', 'MegaMenu', 'nav_menu' );
    set_theme_mod( 'nav_menu_locations', [
            'mega_menu' => $main_menu->term_id,
        ]
    );

    $header_menu = get_term_by( 'name', 'Header Menu', 'nav_menu' );
    set_theme_mod( 'nav_menu_locations', [
            'header' => $header_menu->term_id, 
        ]
    );

    // Assign front page and posts page (blog page).
    $front_page_id = get_page_by_title( 'Home Page' );
    $blog_page_id  = get_page_by_title( 'Blog' );

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );
    update_option( 'page_for_posts', $blog_page_id->ID );

    // Assign compare page.
    $compare_page_id  = get_page_by_title( 'Compare' );
    update_option( 'wccm_compare_page', $compare_page_id->ID );

    // Assign Woo Currency.
    update_option( 'woocommerce_currency', 'USD' );
    update_option( 'woocommerce_currency_pos', 'left' );
    update_option( 'woocommerce_price_num_decimals', 2 );
  }

  //enable_elementor_on_custom_post_types();
  flush_rewrite_rules();

}
add_action( 'ocdi/after_import', 'dina_after_import_setup' );

function enable_elementor_on_custom_post_types() {
  $post_types   = get_option( 'elementor_cpt_support', array( 'page', 'all_posts' ) );
  $post_types[] = 'post';
  $post_types[] = 'e-landing-page';
  $post_types[] = 'product';

  update_option( 'elementor_cpt_support', $post_types );
  update_option( 'elementor_disable_color_schemes', 'yes' );
  update_option( 'elementor_disable_typography_schemes', 'yes' );
}