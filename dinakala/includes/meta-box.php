<?php
/**
 *
 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
 *
 * @category YourThemeOrPlugin
 * @package  Demo_CMB2
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/CMB2/CMB2
*/

/**
 * Get the bootstrap! If using the plugin from wordpress.org, REMOVE THIS!
 */

if ( file_exists( dirname( __FILE__ ) . '/cmb2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/cmb2/init.php';
} elseif ( file_exists( dirname( __FILE__ ) . '/CMB2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/CMB2/init.php';
}

if ( file_exists( dirname( __FILE__ ) . '/cmb2/cmb-field-select2.php' ) ) {
	require_once dirname( __FILE__ ) . '/cmb2/cmb-field-select2.php';
}

if ( file_exists( dirname( __FILE__ ) . '/cmb2/fa.php' ) ) {
	require_once dirname( __FILE__ ) . '/cmb2/fa.php';
}

// Enqueue 
function dina_cmb2_conditional_logic_scripts() {
	wp_enqueue_script( 'dina-cmb2-conditional-logic', DI_URI . '/includes/cmb2/js/cmb2-conditional-logic.js', array(), DI_VER );
}
add_action( 'admin_enqueue_scripts', 'dina_cmb2_conditional_logic_scripts' );

/**
 * CMB2 Field Type: Select2 asset path
 *
 * Filter the path to front end assets (JS/CSS).
 */
function dina_cmb2_field_select2_asset_path() {
	return DI_URI . '/includes/cmb2';
}
add_filter( 'pw_cmb2_field_select2_asset_path', 'dina_cmb2_field_select2_asset_path' );
/**
 * Conditionally displays a metabox when used as a callback in the 'show_on_cb' cmb2_box parameter
 *
 * @param  CMB2 $product CMB2 object.
 *
 * @return bool      True if metabox should show
 */
function dina_show_if_front_page( $product ) {
	// Don't show this metabox if it's not the front page template.
	if ( get_option( 'page_on_front' ) !== $product->object_id ) {
		return false;
	}
	return true;
}

/**
 * Conditionally displays a field when used as a callback in the 'show_on_cb' field parameter
 *
 * @param  CMB2_Field $field Field object.
 *
 * @return bool              True if metabox should show
 */
function dina_hide_if_no_cats( $field ) {
	// Don't show this field if not in the cats category.
	if ( ! has_tag( 'cats', $field->object_id ) ) {
		return false;
	}
	return true;
}

/**
 * Manually render a field.
 *
 * @param  array      $field_args Array of field arguments.
 * @param  CMB2_Field $field      The field object.
 */
function dina_render_row_cb( $field_args, $field ) {
	$classes     = $field->row_classes();
	$id          = $field->args( 'id' );
	$label       = $field->args( 'name' );
	$name        = $field->args( '_name' );
	$value       = $field->escaped_value();
	$description = $field->args( 'description' );
	?>
	<div class="custom-field-row <?php echo esc_attr( $classes ); ?>">
		<p><label for="<?php echo esc_attr( $id ); ?>"><?php echo esc_html( $label ); ?></label></p>
		<p><input id="<?php echo esc_attr( $id ); ?>" type="text" name="<?php echo esc_attr( $name ); ?>" value="<?php echo $value; ?>"/></p>
		<p class="description"><?php echo esc_html( $description ); ?></p>
	</div>
	<?php
}

/**
 * Manually render a field column display.
 *
 * @param  array      $field_args Array of field arguments.
 * @param  CMB2_Field $field      The field object.
 */
function dina_display_text_small_column( $field_args, $field ) {
	?>
	<div class="custom-column-display <?php echo esc_attr( $field->row_classes() ); ?>">
		<p><?php echo $field->escaped_value(); ?></p>
		<p class="description"><?php echo esc_html( $field->args( 'description' ) ); ?></p>
	</div>
	<?php
}

/**
 * Conditionally displays a message if the $post_id is 2
 *
 * @param  array      $field_args Array of field parameters.
 * @param  CMB2_Field $field      Field object.
 */
function dina_before_row_if_2( $field_args, $field ) {
	if ( 2 == $field->object_id ) {
		echo '<p>Testing <b>"before_row"</b> parameter (on $post_id 2)</p>';
	} else {
		echo '<p>Testing <b>"before_row"</b> parameter (<b>NOT</b> on $post_id 2)</p>';
	}
}

//\fe7f0b55ea269f297164af3d1fb::f0606b1c9cd4899bd4282fe88a();
add_action( 'cmb2_admin_init', 'dina_register_metabox' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_admin_init' or 'cmb2_init' hook.
 */
function dina_register_metabox() {
	
	global $font_awesome_icons;

	$prefix = 'dina_';

	//Product Settings MetaBox
	$product = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => esc_html__( 'Product Settings (DinaKala)', 'dina-kala' ),
		'object_types'  => array( 'product' ), // Post type
		// 'show_on_cb' => 'dina_show_if_front_page', // function should return a bool value
		// 'context'    => 'normal',
		'priority'   => 'high',
		// 'show_names' => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
		// 'classes'    => 'extra-class', // Extra cmb2-wrap classes
		// 'classes_cb' => 'dina_add_some_classes', // Add classes through a callback.
		// 'mb_callback_args' => array( '__block_editor_compatible_meta_box' => false ),
	) );

	$product->add_field( array(
		'name'       => esc_html__( 'Text under product title (under title)', 'dina-kala' ),
		'id'         => $prefix . 'under_title',
		'type'       => 'text',
	) );

	$product->add_field( array(
		'name' => esc_html__( 'Product Label', 'dina-kala' ),
		'desc' => esc_html__( 'This tag is displayed on the product image in the archive pages', 'dina-kala' ),
		'id'   => $prefix . 'plabel',
		'type' => 'text_small',
	) );

	$product->add_field( array(
		'name'             => esc_html__( 'Product Label Color', 'dina-kala' ),
		'desc'             => esc_html__( 'Select the label color', 'dina-kala' ),
		'id'               => $prefix . 'plabel_color',
		'type'             => 'pw_select',
		'default'          => 'none',
		'options'          => array(
			'none'   => __( 'Select', 'dina-kala' ),
			'red'    => __( 'Red', 'dina-kala' ),
			'green'  => __( 'Green', 'dina-kala' ),
			'blue'   => __( 'Blue', 'dina-kala' ),
			'yellow' => __( 'Yellow', 'dina-kala' ),
			'orange' => __( 'Orange', 'dina-kala' ),
			'purple' => __( 'Purple', 'dina-kala' ),
			'black'  => __( 'Black', 'dina-kala' ),
		),
	) );

	$product->add_field( array(
		'name' => esc_html__( 'Comingsoon Mode', 'dina-kala' ),
		'desc' => esc_html__( 'View Comingsoon instead of price', 'dina-kala' ),
		'id'   => $prefix . 'coming',
		'type' => 'checkbox',
	) );

	$product->add_field( array(
		'name' => esc_html__( 'Call mode', 'dina-kala' ),
		'desc' => esc_html__( 'By activating this mode, without the need to set the product price to 0, the call phrase will be displayed instead of the product price', 'dina-kala' ),
		'id'   => $prefix . 'call_mode',
		'type' => 'checkbox',
	) );

	$product->add_field( array(
		'name' => esc_html__( 'Comingsoon text', 'dina-kala' ),
		'desc' => esc_html__( 'If it is empty, the text set in the template settings will be used', 'dina-kala' ),
		'id'   => $prefix . 'coming_text',
		'type' => 'text_small',
	) );

	$product->add_field( array(
		'name' => esc_html__( 'Special Product', 'dina-kala' ),
		'desc' => esc_html__( 'View Product in Special Offer Products section', 'dina-kala' ),
		'id'   => $prefix . 'special',
		'type' => 'checkbox',
	) );

	$product->add_field( array(
		'name' => esc_html__( 'Video Review', 'dina-kala' ),
		'desc' => esc_html__( 'Upload an video review of the Product', 'dina-kala' ),
		'id'   => $prefix . 'rvideo',
		'text'    => array(
		'add_upload_file_text' => esc_html__( 'Add Video', 'dina-kala' )
		),
		'type' => 'file',
	) );

	$product->add_field( array(
		'name' => esc_html__( 'Aparat Video', 'dina-kala' ),
		'desc' => esc_html__( 'Enter only id of the video (example: 4pN2B)', 'dina-kala' ),
		'id'   => $prefix . 'aparat',
		'type' => 'text_small',
	) );

	$product->add_field( array(
		'name' => esc_html__( 'Audio Review', 'dina-kala' ),
		'desc' => esc_html__( 'Upload an audio review of the product', 'dina-kala' ),
		'id'   => $prefix . 'raudio',
		'text'    => array(
		'add_upload_file_text' => esc_html__( 'Add Audio', 'dina-kala' )
		),
		'type' => 'file',
	) );

	$product->add_field( array(
		'name'             => esc_html__( 'Product Sidebar Setting', 'dina-kala' ),
		'id'               => $prefix . 'pside',
		'type'             => 'radio_inline',
		'show_option_none' => esc_html__( 'Default Settings', 'dina-kala' ),
		'options'          => array(
			'wside' => esc_html__( 'Without Sidebar', 'dina-kala' ),
			'rside' => esc_html__( 'Right Sidebar', 'dina-kala' ),
			'lside' => esc_html__( 'Left Sidebar', 'dina-kala' ),
		),
	) );

	$product->add_field( array(
		'name'             => esc_html__( 'Additional product information', 'dina-kala' ),
		'id'               => $prefix . 'prod_info_text',
		'desc'             => esc_html__( 'This item is displayed below the product price and can be defined for all products in the Theme settings > Product Settings section.', 'dina-kala' ),
		'type'    		   => 'wysiwyg',
		'options' => array(
			'media_buttons' => true,
			'textarea_rows' => get_option( 'default_post_edit_rows', 5),
		),
	) );

	$product_features = $product->add_field( array(
		'id'          => $prefix . 'product_features',
		'type'        => 'group',
		'description' => esc_html__( 'Product features shown above product price', 'dina-kala' ),
		'options'     => array(
			'group_title'    => esc_html__( 'Feature {#}', 'dina-kala' ),
			'add_button'     => esc_html__( 'Add Another Feature', 'dina-kala' ),
			'remove_button'  => esc_html__( 'Remove Feature', 'dina-kala' ),
			'sortable'       => true,
			'closed'         => true,                                                                         // true to have the groups closed by default
			'remove_confirm' => esc_html__( 'Are you sure you want to remove this feature?', 'dina-kala' ),
		),
	) );

	$product->add_group_field( $product_features, array(
		'name'       => esc_html__( 'Feature Title', 'dina-kala' ),
		'id'         => 'ftitle',
		'type'       => 'text',
	) );

	$product->add_group_field( $product_features, array(
		'name'       => esc_html__( 'Feature Description', 'dina-kala' ),
		'id'         => 'fdesc',
		'type'       => 'text',
	) );

	$product->add_group_field( $product_features, array(
		'name'       => esc_html__( 'Feature Icon', 'dina-kala' ),
		'id'         => 'ficon',
		'type'       => 'pw_select',
		'classes'    => 'ficon_select',
		'default'    => 'none',
		'options'    => $font_awesome_icons,
	) );

	$product->add_field( array(
		'name' => esc_html__( 'Displays cons and pros section', 'dina-kala' ),
		'id'   => $prefix . 'cons_pros',
		'type' => 'checkbox',
	) );

	$product_pros = $product->add_field( array(
		'id'          => $prefix . 'product_pros',
		'type'        => 'group',
		'description' => esc_html__( 'Product pros shown above product description', 'dina-kala' ),
		'options'     => array(
			'group_title'    => esc_html__( 'Pros {#}', 'dina-kala' ),
			'add_button'     => esc_html__( 'Add Another Pros', 'dina-kala' ),
			'remove_button'  => esc_html__( 'Remove Pros', 'dina-kala' ),
			'sortable'       => true,
			'closed'      => true, 
			'remove_confirm' => esc_html__( 'Are you sure you want to remove this Pros?', 'dina-kala' ),
		),
	) );

	$product->add_group_field( $product_pros, array(
		'name'       => esc_html__( 'Pros Title', 'dina-kala' ),
		'id'         => 'ptitle',
		'type'       => 'text',
	) );

	$product_cons = $product->add_field( array(
		'id'          => $prefix . 'product_cons',
		'type'        => 'group',
		'description' => esc_html__( 'Product cons shown above product description', 'dina-kala' ),
		'options'     => array(
			'group_title'    => esc_html__( 'Cons {#}', 'dina-kala' ),
			'add_button'     => esc_html__( 'Add Another Cons', 'dina-kala' ),
			'remove_button'  => esc_html__( 'Remove Cons', 'dina-kala' ),
			'sortable'       => true,
			'closed'      => true, 
			'remove_confirm' => esc_html__( 'Are you sure you want to remove this Cons?', 'dina-kala' ),
		),
	) );

	$product->add_group_field( $product_cons, array(
		'name'       => esc_html__( 'Cons Title', 'dina-kala' ),
		'id'         => 'ctitle',
		'type'       => 'text',
	) );

	//Page Settings MetaBox
	$page = new_cmb2_box( array(
		'id'            => $prefix . 'pagesetting',
		'title'         => esc_html__( 'Page Settings (DinaKala)', 'dina-kala' ),
		'object_types'  => array( 'page' ),
		'priority'   => 'high',
    ) );

	$page->add_field( array(
		'name' => esc_html__( 'Lock content', 'dina-kala' ),
		'desc' => esc_html__( 'Display page content to logged in users', 'dina-kala' ),
		'id'   => $prefix . 'lock_page_content',
		'type' => 'checkbox',
	) );
    
    $page->add_field( array(
		'name'             => esc_html__( 'Page Sidebar Setting', 'dina-kala' ),
		'id'               => $prefix . 'pageside',
		'type'             => 'radio_inline',
		'show_option_none' => esc_html__( 'Default Settings', 'dina-kala' ),
		'options'          => array(
			'wside' => esc_html__( 'Without Sidebar', 'dina-kala' ),
			'rside'   => esc_html__( 'Right Sidebar', 'dina-kala' ),
			'lside'     => esc_html__( 'Left Sidebar', 'dina-kala' ),
		),
	) );
	
	//Post Settings MetaBox
	$post = new_cmb2_box( array(
		'id'            => $prefix . 'postsetting',
		'title'         => esc_html__( 'Post Settings (DinaKala)', 'dina-kala' ),
		'object_types'  => array( 'post' ),
		'priority'   => 'high',
    ) );

	$post->add_field( array(
		'name'             => esc_html__( 'Post Sidebar Setting', 'dina-kala' ),
		'id'               => $prefix . 'postside',
		'type'             => 'radio_inline',
		'show_option_none' => esc_html__( 'Default Settings', 'dina-kala' ),
		'options'          => array(
			'wside' => esc_html__( 'Without Sidebar', 'dina-kala' ),
			'rside'   => esc_html__( 'Right Sidebar', 'dina-kala' ),
			'lside'     => esc_html__( 'Left Sidebar', 'dina-kala' ),
		),
	) );

	$post->add_field( array(
		'name' => esc_html__( 'Lock content', 'dina-kala' ),
		'desc' => esc_html__( 'Display post content to logged in users', 'dina-kala' ),
		'id'   => $prefix . 'lock_post_content',
		'type' => 'checkbox',
	) );

	$post->add_field( array(
		'name' => esc_html__( 'Hide related posts', 'dina-kala' ),
		'desc' => esc_html__( 'By activating this option, related posts in this post will be disabled', 'dina-kala' ),
		'id'   => $prefix . 'hide_related_posts',
		'type' => 'checkbox',
	) );

	$post->add_field( array(
		'name'       => esc_html__( 'Reading time', 'dina-kala' ),
		'id'         => $prefix . 'reading_time',
		'type'       => 'text',
	) );

	$post->add_field( array(
		'name' => esc_html__( 'Video thumbnail', 'dina-kala' ),
		'desc' => esc_html__( 'With this feature, you can display a video instead of a thumbnail at the top of the post content', 'dina-kala' ),
		'id'   => $prefix . 'post_video_thumb',
		'type' => 'file',
		'text'    => array(
		'add_upload_file_text' => esc_html__( 'Add Video', 'dina-kala' )
		),
	) );

	$post->add_field( array(
		'name'       => esc_html__( 'Or Aparat', 'dina-kala' ),
		'desc' => esc_html__( 'Just enter the video ID, for example: Uxmit', 'dina-kala' ),
		'id'         => $prefix . 'post_aparat_thumb',
		'type'       => 'text',
	) );

	//DL-BOX MetaBox
	if ( dina_opt( 'dl_box_product' ) ) {
		$dl_box_post_type = array( 'post', 'product' );
	} else {
		$dl_box_post_type = array( 'post' );
	}

	$dlbox = new_cmb2_box( array(
		'id'            => $prefix . 'dlbox',
		'title'         => esc_html__( 'Download Box Settings (DinaKala)', 'dina-kala' ),
		'object_types'  => $dl_box_post_type,
		'priority'   => 'high',
    ) );

	$dlbox->add_field( array(
		'name' => esc_html__( 'Show download box?', 'dina-kala' ),
		'id'   => $prefix . 'show_dlbox',
		'type' => 'checkbox',
	) );

	$dlbox->add_field( array(
		'name'       => esc_html__( 'File Name', 'dina-kala' ),
		'id'         => $prefix . 'dlbox_title',
		'type'       => 'text',
	) );

	$dlbox->add_field( array(
		'name'       => esc_html__( 'File Size', 'dina-kala' ),
		'id'         => $prefix . 'dlbox_size',
		'type'       => 'text',
	) );

	$dlbox->add_field( array(
		'name'       => esc_html__( 'File Password', 'dina-kala' ),
		'id'         => $prefix . 'dlbox_pass',
		'default' => dina_opt( 'dl_box_pass' ),
		'type'       => 'text',
	) );

	$dlbox_links = $dlbox->add_field( array(
		'id'          => $prefix . 'dlbox_files',
		'type'        => 'group',
		'description' => esc_html__( 'Files', 'dina-kala' ),
		'options'     => array(
			'group_title'    => esc_html__( 'File {#}', 'dina-kala' ),
			'add_button'     => esc_html__( 'Add Another File', 'dina-kala' ),
			'remove_button'  => esc_html__( 'Remove File', 'dina-kala' ),
			'sortable'       => true,
			'closed'      => true,
			'remove_confirm' => esc_html__( 'Are you sure you want to remove this File?', 'dina-kala' ),
		),
	) );

	$dlbox->add_group_field( $dlbox_links, array(
		'name'       => esc_html__( 'File Name', 'dina-kala' ),
		'id'         => $prefix . 'dlbox_file',
		'type'       => 'text',
	) );

	$dlbox->add_group_field( $dlbox_links, array(
		'name'       => esc_html__( 'File Link', 'dina-kala' ),
		'id'         => $prefix . 'dlbox_link',
		'type'       => 'text_url',
	) );

	$dlbox->add_group_field( $dlbox_links, array(
		'name' => esc_html__( 'File titles?', 'dina-kala' ),
		'desc' => esc_html__( 'By selecting this option, the text entered in the file title field will be placed as a subtitle on top of the next files. Leave the link blank.', 'dina-kala' ),
		'id'   => $prefix . 'dlbox_subtitle',
		'type' => 'checkbox',
	) );

	//Additional Product Button title & link MetaBox
	if ( dina_opt( 'show_add_prod_btn' ) && !dina_opt( 'show_add_prod_popup' ) && dina_opt( 'add_per_prod_link' ) ) {
		$popup = new_cmb2_box( array(
			'id'            => $prefix . 'add_btn_link',
			'title'         => esc_html__( 'Additional product button title & link settings (DinaKala)', 'dina-kala' ),
			'object_types'  => array( 'product' ),
			'priority'      => 'high',
		) );

		$popup->add_field( array(
			'name'       => esc_html__( 'Additional product button title', 'dina-kala' ),
			'id'         => $prefix . 'add_prod_per_btn_title',
			'desc'       => esc_html__( 'If empty, the value specified in the theme settings will be used.', 'dina-kala' ),
			'type'       => 'text',
		) );
	
		$popup->add_field( array(
			'name'       => esc_html__( 'Additional product button link', 'dina-kala' ),
			'id'         => $prefix . 'add_prod_per_btn_link',
			'desc'       => esc_html__( 'If empty, the value specified in the theme settings will be used.', 'dina-kala' ),
			'type'       => 'text_url',
		) );

		$popup->add_field( array(
			'name'             => esc_html__( 'Link Target', 'dina-kala' ),
			'id'               => $prefix . 'add_prod_per_btn_target',
			'type'             => 'select',
			'default'          => 'none',
			'options'          => array(
					'none'    =>  __( 'Default', 'dina-kala' ),
					'_blank'  =>  __( 'New Window', 'dina-kala' ),
					'_self'   =>  __( 'Same Window', 'dina-kala' ),
			),
		) );

	}

	//PopUp per product metabox
	if ( dina_opt( 'show_add_prod_btn' ) && dina_opt( 'show_add_prod_popup' ) && dina_opt( 'add_per_prod_popup' ) ) {
		$popup = new_cmb2_box( array(
			'id'            => $prefix . 'popup',
			'title'         => esc_html__( 'Additional product button pop-up settings (DinaKala)', 'dina-kala' ),
			'object_types'  => array( 'product' ),
			'priority'   => 'high',
		) );

		$popup->add_field( array(
			'name'       => esc_html__( 'Additional product button title', 'dina-kala' ),
			'id'         => $prefix . 'add_prod_btn_title',
			'desc'       => esc_html__( 'If empty, the value specified in the theme settings will be used.', 'dina-kala' ),
			'type'       => 'text',
		) );
	
		$popup->add_field( array(
			'name'       => esc_html__( 'Pop-up title', 'dina-kala' ),
			'id'         => $prefix . 'popup_title',
			'desc'       => esc_html__( 'If empty, the value specified in the theme settings will be used.', 'dina-kala' ),
			'type'       => 'text',
		) );

		$popup->add_field( array(
			'name'             => esc_html__( 'Pop-up Content', 'dina-kala' ),
			'id'               => $prefix . 'popup_content',
			'desc'             => esc_html__( 'This content is displayed when the additional product button is clicked and can be defined for all products in the Theme settings > Product Settings section (You can also use the shortcode).', 'dina-kala' ),
			'type'    		   => 'wysiwyg',
			'options' => array(
				'media_buttons' => true,
				'textarea_rows' => get_option( 'default_post_edit_rows', 5),
				//'teeny' => true,
			),
		) );
	}

	for ( $num = 2; $num < 6; $num++ ) {
		$btn_number = di_num2word( $num );
		$btn_word   = di_trnum ( $num );
		//Additional Product Button title & link MetaBox
		if ( dina_opt( $btn_number .'_show_add_prod_btn' ) && ! dina_opt( $btn_number .'_show_add_prod_popup' ) && dina_opt( $btn_number .'_add_per_prod_link' ) ) {
			$popup = new_cmb2_box( array(
				'id'           => $prefix . $btn_number .'_add_btn_link',
				'title'        => sprintf( __( '%s additional product button title & link settings (DinaKala)', 'dina-kala' ), $btn_word ),
				'object_types' => array( 'product' ),
				'priority'     => 'high',
			) );

			$popup->add_field( array(
				'name' => sprintf( __( '%s additional product button title', 'dina-kala' ), $btn_word ),
				'id'   => $prefix . $btn_number .'_add_prod_per_btn_title',
				'desc' => esc_html__( 'If empty, the value specified in the theme settings will be used.', 'dina-kala' ),
				'type' => 'text',
			) );
		
			$popup->add_field( array(
				'name' => sprintf( __( '%s additional product button link', 'dina-kala' ), $btn_word ),
				'id'   => $prefix . $btn_number .'_add_prod_per_btn_link',
				'desc' => esc_html__( 'If empty, the value specified in the theme settings will be used.', 'dina-kala' ),
				'type' => 'text_url',
			) );

			$popup->add_field( array(
				'name'    => esc_html__( 'Link Target', 'dina-kala' ),
				'id'      => $prefix . $btn_number .'_add_prod_per_btn_target',
				'type'    => 'select',
				'default' => 'none',
				'options' => array(
						'none'   => __( 'Default', 'dina-kala' ),
						'_blank' => __( 'New Window', 'dina-kala' ),
						'_self'  => __( 'Same Window', 'dina-kala' ),
				),
			) );

		}

		//Button PopUp per product metabox
		if ( dina_opt( $btn_number .'_show_add_prod_btn' ) && dina_opt( $btn_number .'_show_add_prod_popup' ) && dina_opt( $btn_number .'_add_per_prod_popup' ) ) {
			$popup = new_cmb2_box( array(
				'id'           => $prefix . $btn_number .'_popup',
				'title'        => sprintf( __( '%s additional product button pop-up settings (DinaKala)', 'dina-kala' ), $btn_word ),
				'object_types' => array( 'product' ),
				'priority'     => 'high',
			) );

			$popup->add_field( array(
				'name' => sprintf( __( '%s additional product button title', 'dina-kala' ), $btn_word ),
				'id'   => $prefix . $btn_number .'_add_prod_btn_title',
				'desc' => esc_html__( 'If empty, the value specified in the theme settings will be used.', 'dina-kala' ),
				'type' => 'text',
			) );
		
			$popup->add_field( array(
				'name' => esc_html__( 'Pop-up title', 'dina-kala' ),
				'id'   => $prefix . $btn_number .'_popup_title',
				'desc' => esc_html__( 'If empty, the value specified in the theme settings will be used.', 'dina-kala' ),
				'type' => 'text',
			) );

			$popup->add_field( array(
				'name'    => esc_html__( 'Pop-up Content', 'dina-kala' ),
				'id'      => $prefix . $btn_number .'_popup_content',
				'desc'    => sprintf( __( 'This content is displayed when the %s additional product button is clicked and can be defined for all products in the Theme settings > Product Settings section (You can also use the shortcode).', 'dina-kala' ), $btn_word ),
				'type'    => 'wysiwyg',
				'options' => array(
					'media_buttons' => true,
					'textarea_rows' => get_option( 'default_post_edit_rows', 5),
				),
			) );
		}
	}

	//Custom tab MetaBox one
	if ( dina_opt( 'custom_product_tab_one' ) ) {
		$cu_tab = new_cmb2_box( array(
			'id'           => $prefix . 'tab',
			'title'        => esc_html__( 'Additional product tab settings (DinaKala)', 'dina-kala' ),
			'object_types' => array( 'product' ),
			'priority'     => 'high',
		) );

		$cu_tab->add_field( array(
			'name'       => esc_html__( 'Tab title', 'dina-kala' ),
			'id'         => $prefix . 'tab_title',
			'type'       => 'text',
		) );

		$cu_tab->add_field( array(
			'name'    => esc_html__( 'Tab Icon', 'dina-kala' ),
			'id'      => $prefix . 'tab_icon',
			'type'    => 'pw_select',
			'classes' => 'ficon_select',
			'default' => 'none',
			'options' => $font_awesome_icons,
		) );

		$cu_tab->add_field( array(
			'name'    => esc_html__( 'Tab Content', 'dina-kala' ),
			'id'      => $prefix . 'tab_content',
			'type'    => 'wysiwyg',
			'options' => array(
				'wpautop'       => true,
				'media_buttons' => true,
				'textarea_rows' => get_option( 'default_post_edit_rows', 5),
				//'teeny' => true,
			),
		) );//End custom tab MetaBox one
	}

	//Custom tab MetaBox two
	if ( dina_opt( 'custom_product_tab_two' ) ) {
		
		$cu_tab = new_cmb2_box( array(
			'id'            => $prefix . 'tab_two',
			'title'         => esc_html__( 'Additional product tab two settings (DinaKala)', 'dina-kala' ),
			'object_types'  => array( 'product' ),
			'priority'   => 'high',
		) );

		$cu_tab->add_field( array(
			'name'       => esc_html__( 'Tab title', 'dina-kala' ),
			'id'         => $prefix . 'tab_title_two',
			'type'       => 'text',
		) );

		$cu_tab->add_field( array(
			'name'       => esc_html__( 'Tab Icon', 'dina-kala' ),
			'id'         => $prefix . 'tab_icon_two',
			'type'       => 'pw_select',
			'classes'    => 'ficon_select',
			'default'    => 'none',
			'options'    => $font_awesome_icons,
		) );

		$cu_tab->add_field( array(
			'name'             => esc_html__( 'Tab Content', 'dina-kala' ),
			'id'               => $prefix . 'tab_content_two',
			'type'    		   => 'wysiwyg',
			'options' => array(
				'wpautop' => true,
				'media_buttons' => true,
				'textarea_rows' => get_option( 'default_post_edit_rows', 5),
				//'teeny' => true,
			),
		) );//End custom tab MetaBox two
	}
	
	//Custom tab MetaBox three
	if ( dina_opt( 'custom_product_tab_three' ) ) {
		
		$cu_tab = new_cmb2_box( array(
			'id'            => $prefix . 'tab_three',
			'title'         => esc_html__( 'Additional product tab three settings (DinaKala)', 'dina-kala' ),
			'object_types'  => array( 'product' ),
			'priority'   => 'high',
		) );

		$cu_tab->add_field( array(
			'name'       => esc_html__( 'Tab title', 'dina-kala' ),
			'id'         => $prefix . 'tab_title_three',
			'type'       => 'text',
		) );

		$cu_tab->add_field( array(
			'name'       => esc_html__( 'Tab Icon', 'dina-kala' ),
			'id'         => $prefix . 'tab_icon_three',
			'type'       => 'pw_select',
			'classes'    => 'ficon_select',
			'default'    => 'none',
			'options'    => $font_awesome_icons,
		) );

		$cu_tab->add_field( array(
			'name'             => esc_html__( 'Tab Content', 'dina-kala' ),
			'id'               => $prefix . 'tab_content_three',
			'type'    		   => 'wysiwyg',
			'options' => array(
				'wpautop' => true,
				'media_buttons' => true,
				'textarea_rows' => get_option( 'default_post_edit_rows', 5),
				//'teeny' => true,
			),
		) );//End custom tab MetaBox three
	}

	//FAQ tab
	$faq_tab = new_cmb2_box( array(
		'id'           => $prefix . 'faq',
		'title'        => esc_html__( 'Product FAQs (DinaKala)', 'dina-kala' ),
		'object_types' => array( 'product' ),
		'priority'     => 'high',
	) );

	$faq_tab->add_field( array(
		'name' => esc_html__( 'Show FAQ tab?', 'dina-kala' ),
		'id'   => $prefix . 'show_faq',
		'desc' => esc_html__( 'To display the FAQ tab, you must enable the option to display this section in "Theme settings > Product Settings > Additional product tab".', 'dina-kala' ),
		'type' => 'checkbox',
	) );

	$faq_entry = $faq_tab->add_field( array(
		'id'          => $prefix . 'faqs',
		'type'        => 'group',
		'title'       => esc_html__( 'FAQ(s)', 'dina-kala' ),
		'description' => esc_html__( 'In this section, enter frequently asked questions and their answers.', 'dina-kala' ),
		'options'     => array(
			'group_title'    => esc_html__( 'FAQ {#}', 'dina-kala' ),
			'add_button'     => esc_html__( 'Add Another FAQ', 'dina-kala' ),
			'remove_button'  => esc_html__( 'Remove FAQ', 'dina-kala' ),
			'sortable'       => true,
			'closed'         => true,
			'remove_confirm' => esc_html__( 'Are you sure you want to remove this FAQ?', 'dina-kala' ),
		),
	) );

	$faq_tab->add_group_field( $faq_entry, array(
		'name'       => esc_html__( 'Question', 'dina-kala' ),
		'id'         => $prefix . 'faq_question',
		'type'       => 'textarea_small',
	) );

	$faq_tab->add_group_field( $faq_entry, array(
		'name'       => esc_html__( 'Answer', 'dina-kala' ),
		'id'         => $prefix . 'faq_answer',
		'type'     => 'wysiwyg',
		'options'  => array(
			'wpautop' => true,
			'media_buttons' => true,
			'textarea_rows' => get_option( 'default_post_edit_rows', 5 ),
		),
	) );
	//End FAQ tab



	//Product Meta's MetaBox
	$product_meta = new_cmb2_box( array(
		'id'            => $prefix . 'pmeta',
		'title'         => esc_html__( 'Additional product meta settings (DinaKala)', 'dina-kala' ),
		'object_types'  => array( 'product' ),
		'priority'   => 'high',
    ) );

	$product_meta_fields = $product_meta->add_field( array(
		'id'          => $prefix . 'pmeta_fields',
		'type'        => 'group',
		'description' => esc_html__( 'Additional product meta', 'dina-kala' ),
		'options'     => array(
			'group_title'    => esc_html__( 'Meta {#}', 'dina-kala' ),
			'add_button'     => esc_html__( 'Add Another Meta', 'dina-kala' ),
			'remove_button'  => esc_html__( 'Remove Meta', 'dina-kala' ),
			'sortable'       => true,
			'closed'         => true,
			'remove_confirm' => esc_html__( 'Are you sure you want to remove this Meta?', 'dina-kala' ),
		),
	) );

	$product_meta->add_group_field( $product_meta_fields, array(
		'name'       => esc_html__( 'Meta Name', 'dina-kala' ),
		'id'         => $prefix . 'pmeta_name',
		'type'       => 'text',
	) );

	$product_meta->add_group_field( $product_meta_fields, array(
		'name'       => esc_html__( 'Meta Value', 'dina-kala' ),
		'id'         => $prefix . 'pmeta_value',
		'type'       => 'text',
	) );

	$product_meta->add_group_field( $product_meta_fields, array(
		'name'       => esc_html__( 'Meta Link', 'dina-kala' ),
		'id'         => $prefix . 'pmeta_link',
		'type'       => 'text_url',
	) );

	$product_meta->add_group_field( $product_meta_fields, array(
		'name'       => esc_html__( 'Meta Icon', 'dina-kala' ),
		'id'         => $prefix . 'pmeta_icon',
		'type'       => 'pw_select',
		'classes'    => 'ficon_select',
		'default'    => 'none',
		'options'    => $font_awesome_icons,
	) );

	if ( dina_opt( 'public_product_meta_one_per_product' ) || dina_opt( 'public_product_meta_two_per_product' ) || dina_opt( 'public_product_meta_three_per_product' ) || dina_opt( 'public_product_meta_four_per_product' ) || dina_opt( 'public_product_meta_five_per_product' ) ) {

		$product_meta->add_field( array(
			'name' => esc_html__( 'Edit public product metas', 'dina-kala' ),
			'type' => 'title',
			'id'   => $prefix . 'product_public_meta_head'
		) );

		for ( $num = 1; $num < 6; $num++ ) {

			$meta_number = di_dig2word( $num );

			if ( dina_opt( 'public_product_meta_'. $meta_number .'_per_product' ) ) {

				$value = ! empty ( dina_opt( 'public_product_meta_'. $meta_number .'_title' ) ) ? dina_opt( 'public_product_meta_'. $meta_number .'_title' ) : $num;

				$product_meta->add_field( array(
					'name'       => sprintf( __( 'Public meta value (%s)', 'dina-kala' ), $value ),
					'id'         => $prefix . 'public_meta_value_'. $meta_number,
					'type'       => 'text',
				) );
			
				$product_meta->add_field( array(
					'name'       => sprintf( __( 'Public meta link (%s)', 'dina-kala' ), $value ),
					'id'         => $prefix . 'public_meta_link_'. $meta_number,
					'type'       => 'text_url',
				) );
			}
		}

	}


	if ( dina_opt( 'product_page_message_one_per_product' ) || dina_opt( 'product_page_message_two_per_product' ) || dina_opt( 'product_page_message_three_per_product' ) || dina_opt( 'product_page_message_four_per_product' ) ) {

		//Product page messages MetaBox
		$product_message = new_cmb2_box( array(
			'id'           => $prefix . 'pmessage',
			'title'        => esc_html__( 'Product page messages (DinaKala)', 'dina-kala' ),
			'object_types' => array( 'product' ),
			'priority'     => 'high',
		) );

		for ( $num = 1; $num < 5; $num++ ) {

			$message_number = di_dig2word( $num );
			$message_word   = di_trnum( $num );

			if ( dina_opt( 'product_page_message_'. $message_number .'_per_product' ) ) {
				$product_message->add_field( array(
					'name'    => sprintf( __( 'Product page message (%s message)', 'dina-kala' ), $message_word ),
					'id'      => $prefix . 'product_message_content_'. $message_number,
					'type'    => 'wysiwyg',
					'options' => array(
						'media_buttons' => true,
						'textarea_rows' => get_option( 'default_post_edit_rows', 5),
						//'teeny' => true,
					),
				) );
			}
		}//End For

	}//End if product_page_message_#number_per_product

}//End dina_register_metabox

//Brand MetaBox
add_action( 'cmb2_admin_init', 'dina_register_brand_metabox' );
function dina_register_brand_metabox() {
	
	$brand_term = new_cmb2_box( array(
		'id'               => 'dina_brand',
		'title'            => esc_html__( 'Brand Logo (DinaKala)', 'dina-kala' ), // Doesn't output for term boxes
		'object_types'     => array( 'term' ), // Tells CMB2 to use term_meta vs post_meta
		'taxonomies'       => array( dina_opt( 'product_brand_taxonomy' ) ), // Tells CMB2 which taxonomies should have these fields
		'new_term_section' => true,
	) );

	$brand_term->add_field( array(
		'name' => esc_html__( 'Brand Logo', 'dina-kala' ),
		'id'   => 'dina_brand_logo',
		'type' => 'file',
		'text'    => array(
		'add_upload_file_text' => esc_html__( 'Add Logo', 'dina-kala' )
		),
	) );
}

//Category additional product button title & link
if ( dina_opt( 'add_cat_prod_link' ) ) {
	add_action( 'cmb2_admin_init', 'dina_category_add_product_button_title_link' );
}
function dina_category_add_product_button_title_link() {
	$prefix = 'dina_';
	$product_btn_title_link = new_cmb2_box( array(
		'id'               => 'dina_category_product_btn_title_link',
		'title'            => esc_html__( 'Additional product button title & link settings (DinaKala)', 'dina-kala' ),
		'object_types'     => array( 'term' ),
		'taxonomies'       => array( 'product_cat' ),
		'new_term_section' => false,
	) );

	$product_btn_title_link->add_field( array(
		'name' => esc_html__( 'Additional product button title & link settings', 'dina-kala' ),
		'type' => 'title',
		'id'   => 'dina_category_product_btn_title'
	) );

	$product_btn_title_link->add_field( array(
		'name' => esc_html__( 'Additional product button title', 'dina-kala' ),
		'id'   => $prefix . 'add_prod_cat_btn_title',
		'desc' => esc_html__( 'If empty, the value specified in the theme settings will be used.', 'dina-kala' ),
		'type' => 'text',
	) );

	$product_btn_title_link->add_field( array(
		'name' => esc_html__( 'Additional product button link', 'dina-kala' ),
		'id'   => $prefix . 'add_prod_cat_btn_link',
		'desc' => esc_html__( 'If empty, the value specified in the theme settings will be used.', 'dina-kala' ),
		'type' => 'text_url',
	) );
}

//Category additional product button pop-up title & content
if ( dina_opt( 'add_cat_prod_popup' ) ) {
	add_action( 'cmb2_admin_init', 'dina_category_add_product_button_title_content' );
}
function dina_category_add_product_button_title_content() {
	$prefix = 'dina_';
	$product_btn_title_content = new_cmb2_box( array(
		'id'               => $prefix . 'category_product_btn_popup_title_content',
		'title'            => esc_html__( 'Additional product button Pop-up title and content settings (DinaKala)', 'dina-kala' ),
		'object_types'     => array( 'term' ),
		'taxonomies'       => array( 'product_cat' ),
		'new_term_section' => false,
	) );

	$product_btn_title_content->add_field( array(
		'name' => esc_html__( 'Additional product button Pop-up title and content settings', 'dina-kala' ),
		'type' => 'title',
		'id'   => $prefix . 'category_product_btn_title_content'
	) );

	$product_btn_title_content->add_field( array(
		'name'       => esc_html__( 'Additional product button title', 'dina-kala' ),
		'id'         => $prefix . 'add_prod_cat_btn_title',
		'desc'       => esc_html__( 'If empty, the value specified in the theme settings will be used.', 'dina-kala' ),
		'type'       => 'text',
	) );

	$product_btn_title_content->add_field( array(
		'name'       => esc_html__( 'Pop-up title', 'dina-kala' ),
		'id'         => $prefix . 'add_prod_cat_btn_popup_title',
		'desc'       => esc_html__( 'If empty, the value specified in the theme settings will be used.', 'dina-kala' ),
		'type'       => 'text',
	) );

	$product_btn_title_content->add_field( array(
		'name'     => esc_html__( 'Pop-up content', 'dina-kala' ),
		'id'       => $prefix . 'add_prod_cat_btn_popup_content',
		'desc'     => esc_html__( 'If empty, the value specified in the theme settings will be used.', 'dina-kala' ),
		'type'     => 'wysiwyg',
		'options'  => array(
			'wpautop' => true,
			'media_buttons' => true,
			'textarea_rows' => get_option( 'default_post_edit_rows', 5 ),
		),
	) );
}

//Archive Advertising Banner
add_action( 'cmb2_admin_init', 'dina_archive_ads_banner' );
function dina_archive_ads_banner() {

	$archive_ads_banner = new_cmb2_box( array(
		'id'               => 'archive_ads_banner',
		'title'            => esc_html__( 'Advertising Banner (DinaKala)', 'dina-kala' ),
		'object_types'     => array( 'term' ), 
		'taxonomies'       => array( 'categort', 'post_tag', 'product_cat', 'product_tag', dina_opt( 'product_brand_taxonomy' ) ),
		'new_term_section' => false,
	) );

	$archive_ads_banner->add_field( array(
		'name' => esc_html__( 'Advertising Banner', 'dina-kala' ),
		'type' => 'title',
		'id'   => 'archive_ads_banner_title'
	) );

	$archive_ads_banner->add_field( array(
		'name' => esc_html__( 'Banner image', 'dina-kala' ),
		'id'   => 'dina_archive_ads_image',
		'type' => 'file',
		'text' => array(
			'add_upload_file_text' => esc_html__( 'Add Image', 'dina-kala' )
		),
	) );

	$archive_ads_banner->add_field( array(
		'name' => esc_html__( 'Mobile banner image', 'dina-kala' ),
		'desc' => __( 'If it is empty, the desktop mode image will be used', 'dina-kala' ),
		'id'   => 'dina_archive_ads_image_mobile',
		'type' => 'file',
		'text' => array(
			'add_upload_file_text' => esc_html__( 'Add Image', 'dina-kala' )
		),
	) );

	$archive_ads_banner->add_field( array(
		'name' => esc_html__( 'Banner title', 'dina-kala' ),
		'id'   => 'dina_archive_ads_title',
		'type' => 'text',
	) );
	
	$archive_ads_banner->add_field( array(
		'name' => esc_html__( 'Banner link', 'dina-kala' ),
		'id'   => 'dina_archive_ads_link',
		'type' => 'text_url',
	) );

	$archive_ads_banner->add_field( array(
		'name' => esc_html__( 'Banner Code or shortcode', 'dina-kala' ),
		'desc' => esc_html__( 'Enter the html code or short code you want', 'dina-kala' ),
		'id'   => 'dina_archive_ads_code_text',
		'type' => 'textarea_small',
	) );
	
}

//Second Category Description
add_action( 'cmb2_admin_init', 'dina_register_second_cat_desc' );
function dina_register_second_cat_desc() {

	$second_cat_desc = new_cmb2_box( array(
		'id'               => 'second_cat_desc',
		'title'            => esc_html__( 'Additional Description (DinaKala)', 'dina-kala' ),
		'object_types'     => array( 'term' ), 
		'taxonomies'       => array( 'product_cat', 'product_tag', dina_opt( 'product_brand_taxonomy' ) ),
		'new_term_section' => false,
	) );

	$second_cat_desc->add_field( array(
		'name' => esc_html__( 'Additional Description', 'dina-kala' ),
		'desc' => esc_html__( 'This description will be displayed on the category page at the top or bottom of the category. The location of this description depends on the location of the main category description.', 'dina-kala' ),
		'id'   => 'dina_second_cat_desc',
		'type'    		   => 'wysiwyg',
		'options' => array(
			'wpautop' => true,
			'media_buttons' => true,
			'textarea_rows' => get_option( 'default_post_edit_rows', 5 ),
			//'teeny' => true,
		),
	) );
}

//Category additional product info
add_action( 'cmb2_admin_init', 'dina_category_add_product_info' );
function dina_category_add_product_info() {

	$second_cat_desc = new_cmb2_box( array(
		'id'               => 'dina_category_product_info',
		'title'            => esc_html__( 'Additional product information (DinaKala)', 'dina-kala' ),
		'object_types'     => array( 'term' ), 
		'taxonomies'       => array( 'product_cat' ),
		'new_term_section' => false,
	) );

	$second_cat_desc->add_field( array(
		'name' => esc_html__( 'Additional product information text', 'dina-kala' ),
		'desc'             => esc_html__( 'This item is displayed below the product price and can be defined for all products in the Theme settings > Product Settings section or in product edit page.', 'dina-kala' ),
		'id'   => 'dina_category_product_info_text',
		'type'    		   => 'wysiwyg',
		'options' => array(
			'wpautop' => true,
			'media_buttons' => true,
			'textarea_rows' => get_option( 'default_post_edit_rows', 5 ),
			//'teeny' => true,
		),
	) );
}

//Product archive slider
if ( dina_opt( 'cat_slider_show' ) ) {
	add_action( 'cmb2_admin_init', 'dina_register_cat_slider' );
}
function dina_register_cat_slider() {
	$prefix = 'dina_cat_slide_';
	$cat_slider = new_cmb2_box( array(
		'id'               => 'cat_slider',
		'title'            => esc_html__( 'Product archive slider (DinaKala)', 'dina-kala' ),
		'object_types'     => array( 'term' ), 
		'taxonomies'       => array( 'product_cat', 'product_tag', dina_opt( 'product_brand_taxonomy' ) ),
		'new_term_section' => false,
	) );

	$cat_slider_fields = $cat_slider->add_field( array(
		'id'          => $prefix . 'fields',
		'type'        => 'group',
		'description' => esc_html__( 'Product archive slider (DinaKala)', 'dina-kala' ),
		'options'     => array(
			'group_title'    => esc_html__( 'Slide {#}', 'dina-kala' ),
			'add_button'     => esc_html__( 'Add Another Slide', 'dina-kala' ),
			'remove_button'  => esc_html__( 'Remove Slide', 'dina-kala' ),
			'sortable'       => true,
			'closed'      => true,
			'remove_confirm' => esc_html__( 'Are you sure you want to remove this Slide?', 'dina-kala' ),
		),
	) );

	$cat_slider->add_group_field( $cat_slider_fields, array(
		'name'       => esc_html__( 'Slide Title', 'dina-kala' ),
		'id'         => $prefix . 'title',
		'type'       => 'text',
	) );

	$cat_slider->add_group_field( $cat_slider_fields, array(
		'name'       => esc_html__( 'Slide Link', 'dina-kala' ),
		'id'         => $prefix . 'link',
		'type'       => 'text_url',
	) );

	$cat_slider->add_group_field( $cat_slider_fields, array(
		'name' => esc_html__( 'Open the link in a new window?', 'dina-kala' ),
		'id'   => $prefix . 'link_target',
		'type' => 'checkbox',
	) );

	$cat_slider->add_group_field( $cat_slider_fields, array(
		'name' => esc_html__( 'Add nofollow attribute to the link', 'dina-kala' ),
		'id'   => $prefix . 'link_follow',
		'type' => 'checkbox',
	) );

	$cat_slider->add_group_field( $cat_slider_fields, array(
		'name' => esc_html__( 'Slide Image', 'dina-kala' ),
		'id'   => $prefix . 'image',
		'type' => 'file',
		'text'    => array(
		'add_upload_file_text' => esc_html__( 'Add Image', 'dina-kala' )
		),
	) );
}

//Shop page slider
if ( dina_opt( 'shop_slider_show' ) ) {
	add_action( 'cmb2_admin_init', 'dina_register_shop_page_slider' );
}
function dina_register_shop_page_slider() {
	$prefix = 'dina_shop_slide_';
	$shop_page_id = get_option( 'woocommerce_shop_page_id' );
	$shop_slider = new_cmb2_box( array(
		'id'               => 'shop_slider',
		'title'            => esc_html__( 'Shop page slider (DinaKala)', 'dina-kala' ),
		'object_types'     => array( 'page' ),
		'show_on'      => array( 'key' => 'id', 'value' => $shop_page_id ),
		'context'      => 'normal',
		'priority'     => 'high',
	) );

	$shop_slider_fields = $shop_slider->add_field( array(
		'id'          => $prefix . 'fields',
		'type'        => 'group',
		'description' => esc_html__( 'Shop page slider', 'dina-kala' ),
		'options'     => array(
			'group_title'    => esc_html__( 'Slide {#}', 'dina-kala' ),
			'add_button'     => esc_html__( 'Add Another Slide', 'dina-kala' ),
			'remove_button'  => esc_html__( 'Remove Slide', 'dina-kala' ),
			'sortable'       => true,
			'closed'      => true,
			'remove_confirm' => esc_html__( 'Are you sure you want to remove this Slide?', 'dina-kala' ),
		),
	) );

	$shop_slider->add_group_field( $shop_slider_fields, array(
		'name'       => esc_html__( 'Slide Title', 'dina-kala' ),
		'id'         => $prefix . 'title',
		'type'       => 'text',
	) );

	$shop_slider->add_group_field( $shop_slider_fields, array(
		'name'       => esc_html__( 'Slide Link', 'dina-kala' ),
		'id'         => $prefix . 'link',
		'type'       => 'text_url',
	) );

	$shop_slider->add_group_field( $shop_slider_fields, array(
		'name' => esc_html__( 'Open the link in a new window?', 'dina-kala' ),
		'id'   => $prefix . 'link_target',
		'type' => 'checkbox',
	) );

	$shop_slider->add_group_field( $shop_slider_fields, array(
		'name' => esc_html__( 'Add nofollow attribute to the link', 'dina-kala' ),
		'id'   => $prefix . 'link_follow',
		'type' => 'checkbox',
	) );

	$shop_slider->add_group_field( $shop_slider_fields, array(
		'name' => esc_html__( 'Slide Image', 'dina-kala' ),
		'id'   => $prefix . 'image',
		'type' => 'file',
		'text'    => array(
		'add_upload_file_text' => esc_html__( 'Add Image', 'dina-kala' )
		),
	) );
}