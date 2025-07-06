<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1 for parent theme Dinakala
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */
require_once get_template_directory() . '/plugins/class-tgm-plugin-activation.php';
require_once DI_DIR . '/includes/activatezhk/validate-locked.php';

add_action( 'tgmpa_register', 'dina_register_required_plugins' );

function dina_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	*/

	$plugins = array(
		array(
			'name'     => __( 'WooCommerce', 'dina-kala' ),
			'slug'     => 'woocommerce',
			'required' => true,
		),
		array(
			'name'     => __( 'Elementor Page Builder', 'dina-kala' ),
			'slug'     => 'elementor',
			'required' => true,
		),
		array(
			'name'   => __( 'Theme Demo Importer', 'dina-kala' ),
			'slug'   => 'one-click-demo-import',
			'source' => get_template_directory() . '/plugins/one-click-demo-import.zip',
		),
		array(
			'name' => __( 'Variation Swatches for WooCommerce', 'dina-kala' ),
			'slug' => 'woo-variation-swatches',
		),
		array(
			'name' => __( 'Contact Form 7', 'dina-kala' ),
			'slug' => 'contact-form-7',
		),
	);

	if ( is_rtl() ) {
		$plugins[] = array(
			'name' => __( 'Persian Woocommerce', 'dina-kala' ),
			'slug' => 'persian-woocommerce',
		);
	}

	if ( ! class_exists( 'YITH_WCWL' ) ) {
		$plugins[] = array(
			'name' => __( 'YITH WooCommerce Wishlist', 'dina-kala' ),
			'slug' => 'yith-woocommerce-wishlist',
		);
	}

	if ( ! class_exists( 'YITH_Woocompare' ) ) {
		$plugins[] = array(
			'name'   => __( 'WooCommerce Compare List', 'dina-kala' ),
			'slug'   => 'woocommerce-compare-list',
			'source' => get_template_directory() . '/plugins/woocommerce-compare-list.zip',
		);
	}

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'dina_tgmpa',            // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
		
		'strings'      => array(
			'page_title'                      => __( 'Install Required Plugins', 'dina-kala' ),
			'menu_title'                      => __( 'Install Plugins', 'dina-kala' ),
			
			'installing'                      => __( 'Installing Plugin: %s', 'dina-kala' ),
			
			'updating'                        => __( 'Updating Plugin: %s', 'dina-kala' ),
			'oops'                            => __( 'Something went wrong with the plugin API.', 'dina-kala' ),
			'notice_can_install_required'     => _n_noop(
				
				'This theme requires the following plugin: %1$s.',
				'This theme requires the following plugins: %1$s.',
				'dina-kala'
			),
			'notice_can_install_recommended'  => _n_noop(
				
				'This theme recommends the following plugin: %1$s.',
				'This theme recommends the following plugins: %1$s.',
				'dina-kala'
			),
			'notice_ask_to_update'            => _n_noop(
				
				'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
				'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
				'dina-kala'
			),
			'notice_ask_to_update_maybe'      => _n_noop(
				
				'There is an update available for: %1$s.',
				'There are updates available for the following plugins: %1$s.',
				'dina-kala'
			),
			'notice_can_activate_required'    => _n_noop(
				
				'The following required plugin is currently inactive: %1$s.',
				'The following required plugins are currently inactive: %1$s.',
				'dina-kala'
			),
			'notice_can_activate_recommended' => _n_noop(
				
				'The following recommended plugin is currently inactive: %1$s.',
				'The following recommended plugins are currently inactive: %1$s.',
				'dina-kala'
			),
			'install_link'                    => _n_noop(
				'Begin installing plugin',
				'Begin installing plugins',
				'dina-kala'
			),
			'update_link' 					  => _n_noop(
				'Begin updating plugin',
				'Begin updating plugins',
				'dina-kala'
			),
			'activate_link'                   => _n_noop(
				'Begin activating plugin',
				'Begin activating plugins',
				'dina-kala'
			),
			'return'                          => __( 'Return to Required Plugins Installer', 'dina-kala' ),
			'plugin_activated'                => __( 'Plugin activated successfully.', 'dina-kala' ),
			'activated_successfully'          => __( 'The following plugin was activated successfully:', 'dina-kala' ),
			
			'plugin_already_active'           => __( 'No action taken. Plugin %1$s was already active.', 'dina-kala' ),
			
			'plugin_needs_higher_version'     => __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'dina-kala' ),
			
			'complete'                        => __( 'All plugins installed and activated successfully. %1$s', 'dina-kala' ),
			'dismiss'                         => __( 'Dismiss this notice', 'dina-kala' ),
			'notice_cannot_install_activate'  => __( 'There are one or more required or recommended plugins to install, update or activate.', 'dina-kala' ),
			'contact_admin'                   => __( 'Please contact the administrator of this site for help.', 'dina-kala' ),

			'nag_type'                        => '', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
		),
	);

	tgmpa( $plugins, $config );
}
