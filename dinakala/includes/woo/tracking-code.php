<?php
use Automattic\WooCommerce\Internal\DataStores\Orders\CustomOrdersTableController;

// For displaying in Order page columns.
add_action( 'admin_init','dina_register_order_origin_column' );
function dina_register_order_origin_column() {

    $screen_id = wc_get_container()->get(CustomOrdersTableController::class)->custom_orders_table_usage_is_enabled() ? wc_get_page_screen_id( 'shop-order' ) : 'shop_order';
    
    // HPOS and non-HPOS use different hooks.
    add_filter( "manage_{$screen_id}_columns", 'dina_set_tracking_column' );
    add_filter( "manage_edit-{$screen_id}_columns", 'dina_set_tracking_column' );
    
    // HPOS and non-HPOS use different hooks.
    add_action( "manage_{$screen_id}_custom_column", 'dina_custom_shop_order_column', 10, 2 );
    add_action( "manage_{$screen_id}_posts_custom_column", 'dina_custom_shop_order_column', 10, 2 );
}

function dina_set_tracking_column( $columns) {
    $columns['tracking_column'] = dina_opt( 'order_tracking_code_title' );
    return $columns;
}

// Add the data to the custom columns for the order post type:
function dina_custom_shop_order_column( $column, $post_id ) {
    
    $order = wc_get_order( $post_id );

	if ( ! $order ) 
        return;

    switch ( $column ) {
        case 'tracking_column' :
            echo esc_html( $order->get_meta( 'tracking_column' ) );
            break;
    }
}

// For display and saving in order details page.
add_action( 'add_meta_boxes', 'dina_tracking_code_meta_box' );
function dina_tracking_code_meta_box() {

    $woo_hpos_active = get_option( 'woocommerce_custom_orders_table_enabled' );
	$object_types = ( 'yes' == $woo_hpos_active ) ? array( 'woocommerce_page_wc-orders' ) : array( 'shop_order' );

    add_meta_box(
        'tracking_column', //ID
        dina_opt( 'order_tracking_code_title' ), //Title
		'dina_shop_order_display_callback', //callback
		$object_types, //WP_Screen
        'side', //Context
        'high' //Priority
    );
}

// For displaying it correctly
function dina_shop_order_display_callback( $order ) {

    $order = ( $order instanceof WP_Post ) ? wc_get_order( $order->ID ) : $order;

    if ( ! $order )
        return;

    $tracking_column = $order->get_meta( 'tracking_column' );
    $tracking_type   = $order->get_meta( 'tracking_type' );

    echo '<div class="dina-tracking-metabox">';
    echo '<input type="hidden" name="tracking_column_field_nonce" value="'. wp_create_nonce() .'">';
    echo '<textarea style="width:100%" id="tracking_column" name="tracking_column">' . esc_attr( $tracking_column ) . '</textarea>';
    $none_checked = empty( $tracking_type ) || $tracking_type == 'none' ? ' checked="checked"' : '';
    ?>
    <div class="dina-radio-row">
        <label for="none"><input type="radio" name="tracking_type" value="none" id="none"<?php echo $none_checked; ?> />  <?php _e( "None", 'dina-kala' ); ?></label>
        <label for="post-co"><input type="radio" name="tracking_type" value="post-co" id="post-co" <?php checked( $tracking_type, "post-co" ); ?> />  <?php _e( "Post Company", 'dina-kala' ); ?></label>
        <label for="tipax-co"><input type="radio" name="tracking_type" value="tipax-co" id="tipax-co" <?php checked( $tracking_type, "tipax-co" ); ?> /> <?php _e( "Tipax Co", 'dina-kala' ); ?></label>
        <label for="chapar-co"><input type="radio" name="tracking_type" value="chapar-co" id="chapar-co" <?php checked( $tracking_type, "chapar-co" ); ?> /> <?php _e( "Chapar Co", 'dina-kala' ); ?></label>
        <label for="barbari"><input type="radio" name="tracking_type" value="barbari" id="barbari" <?php checked( $tracking_type, "barbari" ); ?> /> <?php _e( "Barbari", 'dina-kala' ); ?></label>
    </div>
    <?php
    echo '</div>';
}

//Save tracking_column Meta field value
add_action( 'woocommerce_process_shop_order_meta', 'save_tracking_column_metabox_field_value', 10, 2 );
if ( ! function_exists( 'save_tracking_column_metabox_field_value' ) )
{
    function save_tracking_column_metabox_field_value( $order_id, $post) {
        // Check if our nonce is set.
        if ( ! isset( $_REQUEST['tracking_column_field_nonce'] ) && ! wp_verify_nonce( $_REQUEST['tracking_column_field_nonce'] ) ) {
            return $order_id;
        }

        $order = wc_get_order($order_id); // Get the WC_Order object

        // Sanitize text input value and update the meta field in the database.
        $order->update_meta_data( 'tracking_column', sanitize_text_field( $_POST['tracking_column'] ) );
        $order->update_meta_data( 'tracking_type', sanitize_text_field( $_POST['tracking_type'] ) );
        $order->save();
    }
}

// Showing the info on My orders page

//New column on My orders page
add_filter( 'woocommerce_account_orders_columns', 'dina_add_account_orders_column', 1, 1 );
function dina_add_account_orders_column( $columns ) {
    $columns['tracking-column'] = dina_opt( 'order_tracking_code_title' );

    return $columns;
}

add_action( 'woocommerce_my_account_my_orders_column_tracking-column', 'dina_add_account_orders_column_rows' );
function dina_add_account_orders_column_rows( $order ) {
    // Example with a custom field
    if ( $value = $order->get_meta( 'tracking_column' ) ) {
    ?>
		<span class="dina-order-tracking-code">
			<span class="dina-order-tracking-text" data-toggle="tooltip" data-placement="top" title="<?php _e( 'Click to copy the code', 'dina-kala' ); ?>">
				<?php echo esc_html( $value ) ?>
			</span>
			<span class="link-copy"><?php _e( 'Code copied!', 'dina-kala' ) ?></span>
        </span>
	<?php
    }
}

// Showing tracking code on View order page and on Thank you page
add_action( 'woocommerce_thankyou', 'dina_tracking_on_thankyou_page', 2 );
add_action( 'woocommerce_view_order', 'dina_tracking_on_thankyou_page', 2 );
function dina_tracking_on_thankyou_page( $order_id ) {

    $order = wc_get_order( $order_id );

	if ( ! $order ) 
        return;

    $tracking_code = $order->get_meta( 'tracking_column' );
    $tracking_type = $order->get_meta( 'tracking_type' );

    if ( ! empty ( $tracking_code ) ) {  ?>
    <table class="woocommerce-table shop_table dina-order-tracking-code-table">
        <tbody>        
            <tr>
                <td>
                    <strong>
                        <i class="<?php echo dina_opt( 'order_tracking_code_icon' ) ?>"></i>
                        <?php echo dina_opt( 'order_tracking_code_title' ) . ': ' ?>
                    </strong>
                    <span class="dina-order-tracking-code">
                        <span class="dina-order-tracking-text" data-toggle="tooltip" data-placement="top" title="<?php _e( 'Click to copy the code', 'dina-kala' ); ?>">
                            <?php echo esc_html( $tracking_code ) ?>
                        </span>
                        <span class="link-copy"><?php _e( 'Code copied!', 'dina-kala' ) ?></span>
                    </span>
                </td>
                <?php if ( ! empty ( $tracking_type ) && $tracking_type != 'none'  ) {
                    
                    switch ( $tracking_type ) {
                        case "post-co":
                            $tracking_link = 'https://tracking.post.ir/?id='. $tracking_code;
                            break;
                        case "tipax-co":
                            $tracking_link = 'https://tipaxco.com/tracking?id='. $tracking_code;
                            break;
                        case "chapar-co":
                            $tracking_link = 'https://chaparnet.com/track/'. $tracking_code;
                            break;
                        default:
                            $tracking_link = '';
                    }

                    if ( ! empty( $tracking_link ) ) {
                    ?>
                <td>
                    <a href="<?php echo $tracking_link ?>" class="btn btn-outline-dina dina-order-tracking-code-btn" target="_blank">
                        <i class="<?php echo dina_opt( 'order_tracking_code_icon' ) ?>"></i>
                        <?php _e( 'Order tracking', 'dina-kala' ) ?>
                    </a>
                </td>
                <?php } } ?>
            </tr>
        </tbody>
    </table>
<?php }
}

add_filter( 'pwoosms_order_sms_body_before_replace', function ( $content, $shortcodes, $replacements, $order_id, $order ) {
    
    $tracking_code = $order->get_meta( 'tracking_column', true );

    $shortcodes[]   = '{dina_tracking_code}';
    $replacements[] = $tracking_code;

    return str_ireplace( $shortcodes, $replacements, $content );
}, 10, 5 );