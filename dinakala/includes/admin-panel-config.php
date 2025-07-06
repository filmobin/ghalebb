<?php
/**
 * ReduxFramework admin-panel Config File
 * For full documentation, please visit: http://docs.reduxframework.com/
 */

//load_theme_textdomain( 'dina-kala', get_template_directory() . '/languages' );

if ( ! class_exists( 'Redux' ) ) {
    return;
}

//FontAwesome Icons
require_once( dirname( __FILE__ ) . '/admin-panel/fa.php' );
require_once( dirname( __FILE__ ) . '/admin-panel/fab.php' );
require_once( dirname( __FILE__ ) . '/admin-panel/iricons.php' );

$alliconArray = array_merge( $iconArray, $biconArray, $iriconArray );
// This is your option name where all the Redux data is stored.
$opt_name = "di_data";

//Redux's constants
define ( 'RE_URI' , get_template_directory_uri() . '/includes/ReduxCore/' );
define ( 'RE_DIR' , get_template_directory() . '/includes/ReduxCore/' );

// Background Patterns Reader
$background_patterns_path = RE_DIR . 'assets/img/patterns/';
$background_patterns_url  = RE_URI . 'assets/img/patterns/';
$background_patterns      = array();

if ( is_dir( $background_patterns_path ) ) {

    if ( $background_patterns_dir = opendir( $background_patterns_path ) ) {
        $background_patterns = array();

        while ( ( $background_patterns_file = readdir( $background_patterns_dir ) ) !== false ) {

            if ( stristr( $background_patterns_file, '.png' ) !== false || stristr( $background_patterns_file, '.jpg' ) !== false ) {
                $name              = explode( '.', $background_patterns_file );
                $name              = str_replace( '.' . end( $name ), '', $background_patterns_file );
                $background_patterns[] = array(
                    'alt' => $name,
                    'img' => $background_patterns_url . $background_patterns_file
                );
            }
        }
    }
}

//Footer Background Patterns Reader
$footer_patterns_path = RE_DIR . 'assets/img/fbg/';
$footer_patterns_url  = RE_URI . 'assets/img/fbg/';
$footer_patterns      = array();

if ( is_dir( $footer_patterns_path ) ) {

    if ( $footer_patterns_dir = opendir( $footer_patterns_path ) ) {
        $footer_patterns = array();

        while ( ( $footer_patterns_file = readdir( $footer_patterns_dir ) ) !== false ) {

            if ( stristr( $footer_patterns_file, '.png' ) !== false || stristr( $footer_patterns_file, '.jpg' ) !== false ) {
                $name              = explode( '.', $footer_patterns_file );
                $name              = str_replace( '.' . end( $name ), '', $footer_patterns_file );
                $footer_patterns[] = array(
                    'alt' => $name,
                    'img' => $footer_patterns_url . $footer_patterns_file
                );
            }
        }
    }
}

$col_number = [];
foreach( range(1, 100) as $number )
{
    $col_number[$number] = $number;
}

//Dina product attributes array
if ( ! function_exists( 'dina_product_attributes_array' ) ) {
    function dina_product_attributes_array() {

        if ( ! function_exists( 'wc_get_attribute_taxonomies' ) ) {
            return;
        }
        $attributes = array();

        foreach ( wc_get_attribute_taxonomies() as $attribute ) {
            $attributes[ 'pa_' . $attribute->attribute_name ] = $attribute->attribute_label;
        }

        return $attributes;
    }
}

/**
 * ---> SET ARGUMENTS
 * All the possible arguments for Redux.
 * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
 * */

$theme = wp_get_theme(); // For use with some settings. Not necessary.

$args = array(
    // TYPICAL -> Change these values as you need/desire
    'opt_name'             => $opt_name,
    // This is where your data is stored in the database and also becomes your global variable name.
    'display_name'         => $theme->get( 'Name' ),
    // Name that appears at the top of your panel
    'display_version'      => $theme->get( 'Version' ),
    // Version that appears at the top of your panel
    'menu_type'            => 'submenu',
    //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
    'allow_sub_menu'       => true,
    // Show the sections below the admin menu item or not
    'menu_title'           => __( 'Theme Settings', 'dina-kala' ),
    'page_title'           => __( 'Theme Settings', 'dina-kala' ),
    // You will need to generate a Google API key to use this feature.
    // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
    'google_api_key'       => '',
    // Set it you want google fonts to update weekly. A google_api_key value is required.
    'google_update_weekly' => false,
    // Must be defined to add google fonts to the typography module
    'async_typography'     => true,
    // Use a asynchronous font on the front end or font string
    //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
    'admin_bar'            => true,
    // Show the panel pages on the admin bar
    'admin_bar_icon'       => 'dashicons-admin-generic',
    // Choose an icon for the admin bar menu
    'admin_bar_priority'   => 50,
    // Choose an priority for the admin bar menu
    'global_variable'      => '',
    // Set a different name for your global variable other than the opt_name
    'dev_mode'             => true,
    'text_domain'          => 'dina-kala',
    // Show the time the page took to load, etc
    'update_notice'        => true,
    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
    'customizer'           => true,
    // Enable basic customizer support
    //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
    //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

    // OPTIONAL -> Give you extra features
    'page_priority'        => null,
    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
    'page_parent'          => 'themes.php',
    // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
    'page_permissions'     => 'manage_options',
    // Permissions needed to access the options panel.
    'menu_icon'            => '',
    // Specify a custom URL to an icon
    'last_tab'             => '',
    // Force your panel to always open to a specific tab (by id)
    'page_icon'            => 'icon-themes',
    // Icon displayed in the admin panel next to your menu_title
    'page_slug'            => '',
    // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
    'save_defaults'        => true,
    // On load save the defaults to DB before user clicks save or not
    'default_show'         => false,
    // If true, shows the default value next to each field that is not the default value.
    'default_mark'         => '',
    // What to print by the field's title if the value shown is default. Suggested: *
    'show_import_export'   => true,
    // Shows the Import/Export panel when not used as a field.

    // CAREFUL -> These options are for advanced use only
    'transient_time'       => 60 * MINUTE_IN_SECONDS,
    'output'               => true,
    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
    'output_tag'           => true,
    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
    // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
    'database'             => '',
    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
    'use_cdn'              => false,
    'forced_dev_mode_off' => true,
    'show_options_object' => false,
    // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

    // HINTS
    'hints'                => array(
        'icon'          => 'fal fa-question-circle',
        'icon_position' => 'right',
        'icon_color'    => 'lightgray',
        'icon_size'     => 'normal',
        'tip_style'     => array(
            'color'   => 'red',
            'shadow'  => true,
            'rounded' => false,
            'style'   => '',
        ),
        'tip_position'  => array(
            'my' => 'top left',
            'at' => 'bottom right',
        ),
        'tip_effect'    => array(
            'show' => array(
                'effect'   => 'slide',
                'duration' => '500',
                'event'    => 'mouseover',
            ),
            'hide' => array(
                'effect'   => 'slide',
                'duration' => '500',
                'event'    => 'click mouseleave',
            ),
        ),
    ),
    // Set the theme of the option panel.  Use 'wp' to use a more modern style, default is classic.
    'admin_theme'               => 'wp',

    // Enable or disable flyout menus when hovering over a menu with submenus.
    'flyout_submenus'           => true,

    // Mode to display fonts (auto|block|swap|fallback|optional)
    // See: https://developer.mozilla.org/en-US/docs/Web/CSS/@font-face/font-display.
    'font_display'              => 'swap',
    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
    'database'                  => '',
    'network_admin'             => true,
    'search'                    => true,
    'disable_google_fonts_link' => true,
    );
// Panel Intro text -> before the form
if ( ! isset( $args['global_variable'] ) || $args['global_variable'] !== false ) {
    if ( ! empty( $args['global_variable'] ) ) {
        $v = $args['global_variable'];
    } else {
        $v = str_replace( '-', '_', $args['opt_name'] );
    }
    $args['intro_text'] = '';
} else {
    $args['intro_text'] = '';
}

// Add content after the form.
$args['footer_text'] = '';

Redux::setArgs( $opt_name, $args );

/*
    * ---> END ARGUMENTS
*/


/*
    * ---> START HELP TABS
*/

$tabs = array(
    array(
        'id'      => 'redux-help-tab-1',
        'title'   => __( 'Template guide', 'dina-kala' ),
        'content' => __( 'If you have questions about working with the template, contact meysam98@gmail.com.', 'dina-kala' )
    ),
);
Redux::set_help_tab( $opt_name, $tabs );
/*
    * <--- END HELP TABS
*/


// START SECTIONS

// Home settings
require_once DI_DIR . '/includes/admin-panel/home-settings.php';

// General settings
require_once DI_DIR . '/includes/admin-panel/general-settings.php';

// Product Settings
require_once DI_DIR . '/includes/admin-panel/product-settings.php';

// Woocommerce Settings
require_once DI_DIR . '/includes/admin-panel/woocommerce-settings.php';

// Dokan Settings
require_once DI_DIR . '/includes/admin-panel/dokan-settings.php';

// User panel settings
require_once DI_DIR . '/includes/admin-panel/user-panel-settings.php';

// Product brand settings
require_once DI_DIR . '/includes/admin-panel/brand-settings.php';

// Comment Settings
require_once DI_DIR . '/includes/admin-panel/comment-settings.php';

// Dokan settings
require_once DI_DIR . '/includes/admin-panel/post-settings.php';

// Page settings
require_once DI_DIR . '/includes/admin-panel/page-settings.php';

// Popup settings
require_once DI_DIR . '/includes/admin-panel/popup-settings.php';

// Social Media
require_once DI_DIR . '/includes/admin-panel/social-media.php';

// Custom Codes
require_once DI_DIR . '/includes/admin-panel/custom-codes.php';

// Dinakala guide
require_once DI_DIR . '/includes/admin-panel/dinakala-guide.php';

// END SECTIONS

// If Redux is running as a plugin, this will remove the demo notice and links
add_action( 'redux/loaded', 'dina_remove_demo' );
if ( ! function_exists( 'dina_remove_demo' ) ) {
    function dina_remove_demo() {
        // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
        if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
            remove_filter( 'plugin_row_meta', array(
                ReduxFrameworkPlugin::instance(),
                'plugin_metalinks'
            ), null, 2 );

            // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
            remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
        }
    }
}

function removeDemoModeLink() { // Be sure to rename this function to something more unique
    if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
        remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks' ), null, 2 );
    }
    if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
        remove_action( 'admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );    
    }
}
add_action( 'init', 'removeDemoModeLink' );

// dina_admin_info
function dina_admin_info( $text = null, $link = null, $color = 'success' )
{
    $text = empty ( $text ) ? __( 'View the training documentation of this section of the settings', 'dina-kala' ) : $text;
    ob_start();
    ?>
    <div class="dina-admin-info dina-alert dina-alert-<?= $color ?>">
        <?php if ( ! empty( $link ) ) { ?>
            <a href=<?= $link ?> target="_blank">
        <?php } ?>
            <i class="fal fa-question-circle"></i>
            <?= $text ?>
        <?php if ( ! empty( $link ) ) { ?>
            </a>
        <?php } ?>
    </div>
    <?php
    $info = ob_get_clean();
    return $info;
}