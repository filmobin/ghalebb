<?php
/**
 * Dina Order Tracking Shortcode
 */

defined( 'ABSPATH' ) || exit;

add_shortcode( 'dina_order_tracking', 'dina_order_tracking_callback' );
function dina_order_tracking_callback( $atts ) {

	$atts = shortcode_atts( array(
		'email' => '',
		'phone' => '',
		'desc'  => ''
	), $atts);

	if ( is_null( WC()->cart ) )
		return;

	$email_field = ! empty( $atts['email'] ) ? $atts['email'] : false;
	$phone_field = ! empty( $atts['phone'] ) ? $atts['phone'] : false;
	$desc        = isset( $atts['desc'] ) && $atts['desc'] === 'false' ? 0 : 1;

	ob_start();
?>
	<div class="woocommerce">
		<form action="" method="post" class="woocommerce-form woocommerce-form-track-order dina-form-track-order track_order" id="dina-form-track-order">

			<?php do_action( 'dina_order_tracking_form_start' ); ?>

			<?php if ( $desc != 0 ) { ?>
			<p><?php esc_html_e( 'To track your order please enter your Order ID in the box below and press the "Track" button. This was given to you on your receipt you should have received.', 'dina-kala' ); ?></p>
			<?php } ?>

			<p class="form-row <?php if ( $email_field == true || $phone_field == true ) { ?>form-row-first<?php } ?>"><label for="orderid"><?php esc_html_e( 'Order ID', 'dina-kala' ); ?></label> <input class="input-text" type="text" name="orderid" id="orderid" value="<?php echo isset( $_POST['orderid'] ) ? esc_attr( wp_unslash( $_POST['orderid'] ) ) : ''; ?>" placeholder="<?php esc_attr_e( 'Found in your order confirmation email.', 'dina-kala' ); ?>" /></p>
			<?php if ( $phone_field == true ) { ?>
			<p class="form-row form-row-last"><label for="order_phone"><?php esc_html_e( 'Billing phone', 'dina-kala' ); ?></label> <input class="input-text" type="text" name="order_phone" id="order_phone" value="<?php echo isset( $_POST['order_phone'] ) ? esc_attr( wp_unslash( $_POST['order_phone'] ) ) : ''; ?>" placeholder="<?php esc_attr_e( 'Phone you used during checkout.', 'dina-kala' ); ?>" /></p>
			<?php } elseif ( $email_field == true ) { ?>
			<p class="form-row form-row-last"><label for="order_email"><?php esc_html_e( 'Billing email', 'dina-kala' ); ?></label> <input class="input-text" type="text" name="order_email" id="order_email" value="<?php echo isset( $_POST['order_email'] ) ? esc_attr( wp_unslash( $_POST['order_email'] ) ) : ''; ?>" placeholder="<?php esc_attr_e( 'Email you used during checkout.', 'dina-kala' ); ?>" /></p>
			<?php } ?>
			<div class="clear"></div>

			<?php do_action( 'dina_order_tracking_form' ); ?>

			<p class="form-row">
			<button type="submit" id="dina-track-btn" class="dina-track-btn button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="track" value="<?php esc_attr_e( 'Track', 'dina-kala' ); ?>"><i class="fal fa-search"></i><?php esc_html_e( 'Track', 'dina-kala' ); ?></button>
			</p>
			<input type="hidden" name="action" value="dina_order_tracking" />
			<?php wp_nonce_field( 'dina-order_tracking', 'dina-order-tracking-nonce' ); ?>

			<?php
			do_action( 'dina_order_tracking_form_end' );
			?>

		</form>

		<div id="dina-response-container"></div>

		<script type="text/javascript">
		jQuery(document).on('click','#dina-track-btn', function (a){
			a.preventDefault();
			jQuery("#dina-track-btn .fal").removeClass("fa-search").addClass("fa-spinner-third fa-spin");
			jQuery('#dina-response-container').slideUp(600);
			var form = jQuery('#dina-form-track-order');
  			jQuery.ajax({
				type: 'POST',
				url: '<?php echo admin_url('admin-ajax.php'); ?>',
				data: jQuery(form).serialize(),
				datatype: 'json',
				success: function (result) {
					console.log(result.status);
					var messagehtml = '';
					if(result.status == true) {
						messagehtml = result.message;
					} else {
						messagehtml = result.message;
					}
					jQuery('#dina-response-container').empty();
					jQuery('#dina-response-container').append(messagehtml);
					jQuery("#dina-track-btn .fal").removeClass("fa-spinner-third fa-spin").addClass("fa-search");
					jQuery('#dina-response-container').slideDown(600)
				},
				error: function (error) {
					console.log("error");
					jQuery('#dina-response-container').empty();
					jQuery('#dina-response-container').append(error);
					jQuery('#dina-response-container').slideDown(600)
					jQuery("#dina-track-btn .fal").removeClass("fa-spinner-third fa-spin").addClass("fa-search");
				}
			});
		});
  	</script>
	</div>

<?php 
$content = ob_get_clean();
return $content;
}

add_action( 'wp_ajax_dina_order_tracking', 'dina_order_tracking_content_callback' );
add_action( 'wp_ajax_nopriv_dina_order_tracking', 'dina_order_tracking_content_callback' );
function dina_order_tracking_content_callback(){
	
	if ( is_null( WC()->cart ) )
		return;

	$nonce_value = wc_get_var( $_POST['dina-order-tracking-nonce'], wc_get_var( $_POST['_wpnonce'], '' ) ); // @codingStandardsIgnoreLine.

  	$returnArray = array( 'status' => false );

	if ( isset( $_POST['orderid'] ) && wp_verify_nonce( $nonce_value, 'dina-order_tracking' ) ) {

		$order_id    = dinafa_digits( $_POST['orderid'] );
		$order_id    = empty( $order_id ) ? 0 : ltrim( wc_clean( wp_unslash( $order_id ) ), '#' );
		if ( isset( $_POST['order_phone'] ) ) {
			$order_phone = dinafa_digits( $_POST['order_phone'] );
			$order_phone = empty( $order_phone ) ? '' : preg_replace('/[^0-9]/', '', wp_unslash( $order_phone ));
		}
		$order_email = isset( $_POST['order_email'] ) ? sanitize_email( wp_unslash( $_POST['order_email'] ) ) : '';

		if ( ! $order_id ) {
			$message = wc_print_notice( __( 'Please enter a valid order ID', 'dina-kala' ), 'error', array(), true );
		} elseif ( isset( $_POST['order_phone'] ) && ! $order_phone ) {
			$message = wc_print_notice( __( 'Please enter a valid phone number', 'dina-kala' ), 'error', array(), true );
		} elseif ( isset( $_POST['order_email'] ) && ! $order_email ) {
			$message = wc_print_notice( __( 'Please enter a valid email address', 'dina-kala' ), 'error', array(), true );
		} else {
			$order = wc_get_order( apply_filters( 'dina_shortcode_order_tracking_order_id', $order_id ) );

			if ( ! $order ||  ! $order->get_id() || ! is_a( $order, 'WC_Order' ) ) {
				$message = wc_print_notice( __( 'Sorry, the order could not be found. Please contact us if you are having difficulty finding your order details.', 'dina-kala' ), 'error', array(), true );
			} elseif ( ! isset( $_POST['order_phone'] ) && ! isset( $_POST['order_email'] ) ) {
				ob_start();
				
				echo '<div class="woocommerce dina-status-'.  $order->get_status() .'">';
				wc_get_template(
					'order/tracking.php',
					array(
						'order' => $order,
					)
				);
				echo '</div>';
				$message = ob_get_clean();
			} elseif ( isset( $_POST['order_email'] ) && strtolower( $order->get_billing_email() ) === strtolower( $order_email ) ) {
				ob_start();
				echo '<div class="woocommerce dina-status-'.  $order->get_status() .'">';
				wc_get_template(
					'order/tracking.php',
					array(
						'order' => $order,
					)
				);
				echo '</div>';
				$message = ob_get_clean();
			} elseif ( isset( $_POST['order_phone'] ) && strtolower( $order->get_billing_phone() ) === strtolower( $order_phone ) ) {
				ob_start();
				echo '<div class="woocommerce dina-status-'.  $order->get_status() .'">';
				wc_get_template(
					'order/tracking.php',
					array(
						'order' => $order,
					)
				);
				echo '</div>';
				$message = ob_get_clean();
			} else {
				$message = wc_print_notice( __( 'Sorry, the order could not be found. Please contact us if you are having difficulty finding your order details.', 'dina-kala' ), 'error', array(), true );
			}
		}
		
		$returnArray = array( 'status' => true, 'message' => $message);
	} else {
		$returnArray = array( 'status' => false, 'message' => __( 'Sorry, the order could not be found. Please contact us if you are having difficulty finding your order details.', 'dina-kala' ) );
	}
	wp_send_json($returnArray);
	exit;
}

//Add Sequential Order Number for WooCommerce plugin compatibility for order tracking 
add_filter( 'dina_shortcode_order_tracking_order_id', 'dina_order_id_from_order_number', 10, 1 );
function dina_order_id_from_order_number( $order_id ) {
    if( ! class_exists('Wt_Advanced_Order_Number_Common') )
        return $order_id;
    if( Wt_Advanced_Order_Number_Common::is_wc_hpos_enabled() ) {
        $orders = wc_get_orders([
            'return'     => 'ids',
            'limit'      => 1,
            'meta_query' => [
                [
                    'key'        => '_order_number',
                    'value'      => $order_id,
                    'comparison' => '='
                ],
            ],
        ]);
    } else {
        $orders = get_posts( [
            'numberposts' => 1,
            'meta_key'    => '_order_number',
            'meta_value'  => $order_id,
            'post_type'   => 'shop_order',
            'post_status' => 'any',
            'fields'      => 'ids',
        ] );
    }

    $order_id = $orders ? current($orders) : null;

    if ( $order_id !== null ) {
        return $order_id;
    }
    return $order_id;
}